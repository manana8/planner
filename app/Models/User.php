<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public $timestamps = false; // По умолчанию Eloquent ожидает, что столбцы «create_at» и «update_at» будут существовать в ваших >таблицах. Если вы не хотите, чтобы эти столбцы автоматически управлялись >Eloquent, установите для свойства $timestamps вашей модели значение false.

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_users', 'user_id', 'task_id')->withPivot('role');
    }

    public function activeTasks()
    {
        return $this->tasks()->whereNull('data_of_done')->orderBy('deadline');
    }

    public function doneTasks()
    {
        return $this->tasks()->whereNotNull('data_of_done')->orderByDesc('data_of_done');
    }

    public function comment()
    {
        return $this->hasOne(TaskComment::class, 'user_id', 'id');
    }
}
