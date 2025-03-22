<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;

class FollowsController extends Controller
{
    // フォロー中のユーザー一覧を表示
    public function followList()
    {
        $user = Auth::user();

        // フォローしているユーザーの取得
        $followingUsers = $user->following;

        // フォローしているユーザーの投稿を取得
        $followedPosts = Post::whereIn('user_id', $followingUsers->pluck('id'))->latest()->get();

        // ビューにデータを渡す
        return view('follows.followList', compact('followingUsers', 'followedPosts'));
    }

    // フォロワー一覧を表示
    public function followerList()
    {
        $user = Auth::user();

        // フォロワーの取得
        $followers = $user->followers;

        // フォロワーの投稿を取得
        $followerPosts = Post::whereIn('user_id', $followers->pluck('id'))->latest()->get();

        return view('follows.followerList', compact('followers', 'followerPosts'));
    }

    // ユーザーをフォローする処理
    public function follow($id)
    {
        $user = Auth::user();

        // すでにフォローしているかチェック
        if (!$user->isFollowing($id)) {
            Follow::create([
                'following_id' => $user->id,
                'followed_id' => $id,
            ]);
        }

        return back();
    }

    // フォローを解除する処理
    public function unfollow($id)
    {
        $user = Auth::user();

        // フォロー解除処理
        Follow::where('following_id', $user->id)
            ->where('followed_id', $id)
            ->delete();

        return back();
    }
}
