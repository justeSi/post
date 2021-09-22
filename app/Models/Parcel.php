<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Parcel extends Model
{
    use HasFactory;
    public function getPost()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
