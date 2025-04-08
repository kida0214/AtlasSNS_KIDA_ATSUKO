<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['following_id', 'followed_id']; // ここを追加

    // 関連を定義
// Follow.php (Follow モデル)

public function follower()
{
    return $this->belongsTo(User::class, 'followed_id');
}

public function following()
{
    return $this->belongsTo(User::class, 'following_id');
}
}
