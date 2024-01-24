<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // spécifie les champs remplissable
    protected $fillable = [
        'title',
        'slug',
        'content'
    ];

    // champs banis
    protected $guarded = [];
}
