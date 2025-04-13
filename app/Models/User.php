<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // フォローしているかどうかを判定するメソッド
    public function isFollowing($userId)
    {
        return $this->following()->where('followed_id', $userId)->exists();
    }

// 自分がフォローしているユーザー一覧（＝相手）
public function following()
{
    return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
}

// 自分をフォローしているユーザー一覧（＝フォロワー）
public function followers()
{
    return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
}



    // フォローしているユーザー数をカウント
    public function followingCount()
    {
        return $this->following()->count();
    }

    // フォロワー数をカウント
    public function followerCount()
    {
        return $this->followers()->count();
    }

    // ユーザーが持つ投稿を取得（1対多のリレーション）
    public function posts()
    {
        return $this->hasMany(Post::class);  // ユーザーが複数の投稿を持つ
    }

    // アイコン画像の取得
public function getIconImageAttribute($value)
{
    return !empty($value) && file_exists(public_path('storage/' . $value))
        ? 'storage/' . $value
        : 'images/icon1.png';
}
}
