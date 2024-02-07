<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'category_id',
        'deadline',
        'status',
        'data_of_create',
        'data_of_done',
    ];
}
