<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Content extends Model
{
    protected $fillable = ['title', 'description', 'is_hidden'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->title);
    }
}
