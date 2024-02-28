<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'text',
        'category_id',
        'deadline',
        'status',
        'data_of_create',
        'data_of_done',
    ];

    public $timestamps = false;

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function history()
    {
        return $this->hasOne(Category::class, 'task_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
