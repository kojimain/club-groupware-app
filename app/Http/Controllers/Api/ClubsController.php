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
     * GET /api/clubs
     *
     * club一覧
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return $user->clubs()->get();
    }

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

    /**
     * PUT|PATCH /api/clubs
     *
     * club更新
     */
    public function update(Request $request)
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

        // UPDATE
        $user = $request->user();
        $club = $user->clubs()->findOrFail($request->club);
        $club
            ->fill([
                'name' => $request->name
            ])
            ->save();

        // 結果返却
        return $club;
    }

    /**
     * GET /api/clubs/{club}
     *
     * club表示
     */
    public function show(Request $request)
    {
        $user = $request->user();
        return $user->clubs()->findOrFail($request->club);
    }

    /**
     * DELETE /api/clubs/{club}
     *
     * club削除
     */
    public function destroy(Request $request)
    {
        $user = $request->user();
        $club = $user->clubs()
            ->wherePivot('role_type', Member::ROLE_TYPE['manager'])
            ->findOrFail($request->club)
            ->delete();
    }
}
