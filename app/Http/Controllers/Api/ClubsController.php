<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Club;
use App\Member;

class ClubsController extends Controller
{
    /**
     * POST /api/clubs
     *
     * club作成
     */
    public function store(Request $request)
    {
        // バリデーション
        $this->validate($request,
            [
                'name' => 'required|max:255'
            ],
            [],
            [
                'name' => 'クラブ名'
            ]);

        // INSERT
        $user = $request->user();
        $club = new Club([
            'name' => $request->name
        ]);
        DB::transaction(function() use ($user, $club, $request) {
            // club作成 & memberをmanager権限で作成
            $user->clubs()->save(
                $club,
                [
                    'role_type' => Member::ROLE_TYPE['manager']
                ]
            );
            // // clubに指定のユーザをmember権限で紐づける
            $club->users()
                ->wherePivot('role_type', Member::ROLE_TYPE['member'])
                ->sync($request->userIds);
        }); // transaction

        // 200の結果返却
        return $club;
    }
}
