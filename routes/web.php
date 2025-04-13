<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// 認証が必要ないルート
require __DIR__ . '/auth.php';

// 認証が必要なルート
Route::middleware(['auth'])->group(function () {

// トップページ
Route::get('/top', [PostsController::class, 'index'])->name('top');

// 投稿関連（CRUD操作）
Route::resource('posts', PostsController::class)->except(['show']);

// ユーザー検索
Route::get('/search', [UsersController::class, 'search'])->name('users.search');

// フォロー・フォロワー関連
Route::get('/follow-list', [FollowsController::class, 'followList'])->name('follow.list');
Route::get('/follower-list', [FollowsController::class, 'followerList'])->name('follower.list');
Route::post('/follow/{id}', [FollowsController::class, 'follow'])->name('follow');
Route::delete('/unfollow/{id}', [FollowsController::class, 'unfollow'])->name('unfollow');

// フォローリストの投稿一覧
Route::get('/follow-list/posts', [PostsController::class, 'followListPosts'])->name('follow.list.posts');

// フォロワーリストの投稿一覧
Route::get('/follower-list/posts', [PostsController::class, 'followerListPosts'])->name('follower.list.posts');

// プロフィール関連
// 自分のプロフィール表示
Route::get('/profile', [ProfileController::class, 'showOwnProfile'])->name('profile');

// プロフィール編集
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// 他のユーザーのプロフィール
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

// ログアウト
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
