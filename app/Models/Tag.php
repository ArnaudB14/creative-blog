<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'post_id', 'created_at', 'updated_at'];

    protected static function boot() {
        parent::boot();
    
        static::creating(function ($tag) {
            $tag->slug = Str::slug($tag->name);
        });
    }

    public function post(){
        return $this->belongsToMany(Post::class);
    }
}
