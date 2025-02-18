<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasUuids;
    
    protected $fillable = [
        'type',
        'source',
        'author',
        'title',
        'description',
        'url',
        'urlToImage',
        'content',
        'publishedAt',
        'category',
        'platform',
    ];
}
