<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;

class TasksController extends Controller
{
    public function getTasks(Request $request)
    {
        $status = $request->query('status');
        $teamMemberId = $request->query('team_member_id');

        $query = Tasks::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($teamMemberId) {
            $query->whereHas('taskTeamMembers', function ($query) use ($teamMemberId) {
                $query->where('team_member_id', $teamMemberId);
            });
        }

        $tasks = $query->get();

        return response()->json($tasks);
    }

    public function createTask()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'status' => 'required|in:завершено,в работе,остановлено,не начато',
        ]);

        $task = new Tasks();
        $task->task_name = $validated['task_name'];
        $task->status = $validated['status'];
        $task->save();

        return redirect('/tasks/create')->with('success', 'Задача успешно добавлена!');
    }
}
