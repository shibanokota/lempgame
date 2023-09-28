<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'image',
    ];
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
    public function isLiked($user_id)
    {
        return $this->likes()->where('user_id', $user_id)->exists();
    }
    public static function getDate($from, $until)
    {
        //created_atが20xx/xx/xx ~ 20xx/xx/xxのデータを取得
        $posts = Post::whereBetween("created_at", [$from, $until])->orderBy('created_at', 'desc')->get();

        return $posts;
    }
}