<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected static function boot() {
        parent::boot();
    
        static::creating(function ($status) {
            $status->slug = Str::slug($status->name);
        });

        static::updating(function ($status) {
            $status->slug = Str::slug($status->name);
        });
    }

    public function post(){
        return $this->hasMany(Post::class);
    }
}
