<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'start_date', 'type', 'category_id', 'tag_id', 'user_id'];


    //Relations
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'ad_tag');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
