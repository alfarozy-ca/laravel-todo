<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $table = 'todos';
    protected $fillable = [
        'description',
        'completed',
    ];

    // protected $timestamps = false;
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
