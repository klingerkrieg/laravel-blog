<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "publish_date",
        "image",
        "name",
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

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    protected static function booted() {
        static::creating(function($request){
            $request->user_id = Auth::id();
        });
    }

    public function setNameAttribute($subject){
        $this->attributes["name"] = $subject;

        
        if ($this->slug != "")
            return;#evitar que seja alterado

        $product = Product::withTrashed()
                        ->orderByDesc("id")
                        ->firstWhere("slug",$subject);
        $id = "";
        if ($product){
            $id = "_".($product->id + 1);
        }

        $this->attributes["slug"] = Str::slug($subject).$id;
    }
}
