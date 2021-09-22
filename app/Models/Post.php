<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parcel;

class Post extends Model
{
    use HasFactory;
    public function getParcels()
    {
        return $this->hasMany(Parcel::class, 'post_id', 'id');
    }
}
