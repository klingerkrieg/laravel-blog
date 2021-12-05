<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "publish_date",
        "image",
        "subject",
        "text",
        "slug",
        "user_id"
    ];

    protected $dates = [
        "deleted_at",
        "publish_date"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected static function booted() {
        static::creating(function($request){
            $request->user_id = Auth::id();
        });
    }

    public function setSubjectAttribute($subject){
        $this->attributes["subject"] = $subject;

        
        if ($this->slug != "")
            return;#evitar que seja alterado

        $post = Post::withTrashed()
                        ->orderByDesc("id")
                        ->firstWhere("slug",$subject);
        $id = "";
        if ($post){
            $id = "_".($post->id + 1);
        }

        $this->attributes["slug"] = Str::slug($subject).$id;
    }
}
