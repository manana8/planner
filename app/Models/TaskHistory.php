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
        'type'
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id_before');
    }

    public function task()
    {
        return $this->hasOne(Category::class, 'task_id', 'id');
    }

    public $timestamps = false;
}
