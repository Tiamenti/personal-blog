<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class PostCategory extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $casts = [
        'created_at' => 'date:d.m.Y H:i:s',
    ];
}
