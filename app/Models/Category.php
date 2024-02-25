<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
    ];

    public $timestamps = false;

    public function tasks()
    {
        return $this->hasMany(Task::class,'category_id', 'id');
    }
    public function taskHistories()
{
    return $this->hasMany(TaskHistory::class,'category_id_before', 'id');
}
}
