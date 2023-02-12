<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'image_path', 'user_id'];

    protected $hidden = [];

    protected $visible = [];

    public function coment(){
        return $this->hasMany(Coment::class);
    }
}
