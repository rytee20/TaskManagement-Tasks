<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTeamMembers extends Model
{
    use HasFactory;

    protected $table = 'task_team_members';
    public $incrementing = false; // Не использовать автоинкремент
    protected $primaryKey = null; // Первичный ключ отсутствует (используем составной ключ)
    public $timestamps = true;

    public function task()
    {
        return $this->belongsTo(Tasks::class, 'task_id', 'task_id');
    }
}
