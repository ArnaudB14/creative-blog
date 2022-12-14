<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'description', 'category_id', 'status_id', 'tag_id', 'file_path', 'created_at', 'updated_at'];

    protected static function boot() {
        parent::boot();
    
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });

        static::updating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function tag(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
