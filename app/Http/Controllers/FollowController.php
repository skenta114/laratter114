<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class FollowController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user)
    {
        Auth::user()->followings()->attach($user->id);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // ターゲットユーザのデータ
        $user = User::find($id);
        // ターゲットユーザのフォロワー一覧
        $followers = $user->followers;
        // ターゲットユーザのフォローしている人一覧
        $followings  = $user->followings;

        return response()->view('user.show', compact('user', 'followers', 'followings'));
    }

    public function myfollowsshow()
    {
        $user = Auth::user(); // ログインしているユーザーを取得
        $myfollowing = $user->following()->get(); // フォローしているユーザーを取得
        $myfollowers = $user->followers()->get(); // フォロワーを取得

        return view('follows.myfollowshow', compact('myfollowing', 'myfollowers'));
    }

    public function destroy(User $user)
    {
        Auth::user()->followings()->detach($user->id);
        return redirect()->back();
    }
}
