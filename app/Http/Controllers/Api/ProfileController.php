<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * /editでプロフィール表示する用のAPI
     *
     * @return void
     */
    public function show(Request $request)
    {
        $user = $request->user();
        return [
            'name' => $user->name,
            'email' => $user->email
        ];
    }

    /**
     * /editでプロフィール更新する用のAPI
     *
     * @return void
     */
    public function update(Request $request)
    {
        // バリデーション
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email'
        ]);

        // UPDATE
        $user = $request->user();
        $user
            ->fill([
                'name' => $request->name,
                'email' => $request->email
            ])
            ->save();
    }
}
