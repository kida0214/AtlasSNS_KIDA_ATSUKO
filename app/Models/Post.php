<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * モデルで一括割り当て可能な属性
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',  // 投稿者ID
        'post',   // 投稿内容
    ];

    /**
     * 投稿者とのリレーション（1対多）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
