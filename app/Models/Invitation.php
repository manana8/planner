<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id_from',
        'user_id_to',
        'task_id',
        'status',
    ];

    public function task()
    {
        return $this->hasOne(Task::class, 'id', 'task_id');
    }
}
