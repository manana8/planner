<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_of_history_create',
        'task_id',
        'title_before',
        'text_before',
        'category_id_before',
        'deadline_before',
        'status_before',
    ];
}
