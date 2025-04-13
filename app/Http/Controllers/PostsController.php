<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostsController extends Controller
{
    /**
     * 投稿一覧を表示する（自分＋フォロー中のユーザー）
     */
    public function index()
    {
        // 現在ログインしているユーザー
        $user = Auth::user();

        // フォローしているユーザーのIDを取得
        $followingIds = $user->following()->pluck('followed_id')->toArray();

        // 自分のIDも追加（自分の投稿も含める）
        $followingIds[] = $user->id;

        // フォローしているユーザーの投稿と自分の投稿を取得
        $posts = Post::with('user')
            ->whereIn('user_id', $followingIds) // フォローしているユーザーの投稿
            ->latest() // 最新順に並べ替え
            ->get();

        // ビューにデータを渡す
        return view('posts.index', ['posts' => $posts]);
    }



    /**
     * 投稿を保存する
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post' => 'required|string|min:1|max:150',
        ], [
            'post.required' => '投稿内容は必須です。',
            'post.string' => '投稿内容は文字列で入力してください。',
            'post.min' => '投稿内容は1文字以上で入力してください。',
            'post.max' => '投稿内容は150文字以内で入力してください。',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'post' => $validated['post'],
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * 投稿編集フォーム（※通常モーダル利用で不要なら省略可）
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            abort(403); // 他人の投稿にはアクセス禁止
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * 投稿を更新する
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'post' => 'required|string|min:1|max:150',
        ]);

        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->update([
            'post' => $validated['post'],
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * 投稿を削除する
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
