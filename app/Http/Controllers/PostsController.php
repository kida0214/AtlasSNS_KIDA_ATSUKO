<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostsController extends Controller
{
    /**
     * 投稿一覧を表示する
     */
    public function index()
    {
        // 投稿と関連するユーザー情報を事前に読み込み、新しい順に並び替え
        $posts = Post::with('user')->latest()->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * 投稿を保存する
     */
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'post' => 'required|string|min:1|max:150',
        ], [
            'post.required' => '投稿内容は必須です。',
            'post.string' => '投稿内容は文字列で入力してください。',
            'post.min' => '投稿内容は1文字以上で入力してください。',
            'post.max' => '投稿内容は150文字以内で入力してください。',
        ]);

        // 投稿を保存
        Post::create([
            'user_id' => Auth::id(), // 現在のユーザーID
            'post' => $validated['post'],
        ]);

        // 投稿一覧ページにリダイレクト
        return redirect()->route('posts.index');
    }

    /**
     * 投稿編集フォームを表示する
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id); // 投稿を取得

        // 投稿編集ページを表示
        return view('posts.edit', compact('post'));
    }

    /**
     * 投稿を更新する
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $validated = $request->validate([
            'post' => 'required|string|min:1|max:150',
        ]);

        // 投稿を取得し更新
        $post = Post::findOrFail($id);
        $post->update([
            'post' => $validated['post'],
        ]);

        // 投稿一覧ページにリダイレクト
        return redirect()->route('posts.index');
    }

    /**
     * 投稿を削除する
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // 投稿を削除
        $post->delete();

        // 投稿一覧ページにリダイレクト
        return redirect()->route('posts.index');
    }

    /**
     * フォローしているユーザーの投稿を表示する
     */
    public function followListPosts()
    {
        $user = Auth::user();

        // フォローしているユーザーの投稿を取得
        $posts = Post::whereIn('user_id', $user->following()->pluck('id')) // 'following' リレーションを使ってフォローしているユーザーIDを取得
            ->latest()
            ->get();

        // フォローしているユーザーの投稿一覧ページに渡す
        return view('follows.followListPosts', compact('posts'));
    }

    /**
     * フォロワーのユーザーの投稿を表示する
     */
    public function followerListPosts()
    {
        $user = Auth::user();

        // フォロワーのユーザーの投稿を取得
        $posts = Post::whereIn('user_id', $user->followers()->pluck('id')) // 'followers' リレーションを使ってフォロワーのユーザーIDを取得
            ->latest()
            ->get();

        // フォロワーのユーザーの投稿一覧ページに渡す
        return view('follows.followerListPosts', compact('posts'));
    }
}
