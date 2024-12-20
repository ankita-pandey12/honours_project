<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Show create task form
    public function create()
    {
        return view('tasks.create');
    }

    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'user_id' => Auth::id(),
            'is_completed' => false,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    // Show all tasks for the authenticated user
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())
            ->orderByRaw("
            CASE priority 
                WHEN 'high' THEN 1 
                WHEN 'medium' THEN 2 
                WHEN 'low' THEN 3 
                ELSE 4 
            END
        ")
            ->get()
            ->map(function ($task) {
                // Format the due_date
                $task->formatted_due_date = \Carbon\Carbon::parse($task->due_date)->format('jS M Y');
                return $task;
            });

        return view('tasks.index', compact('tasks'));
    }


    // Toggle the status of a task
    public function toggleStatus(Request $request)
    {
        $taskIds = $request->input('task_ids', []);

        if (!empty($taskIds)) {
            foreach ($taskIds as $taskId) {
                $task = Task::where('id', $taskId)
                    ->where('user_id', Auth::id())
                    ->first();

                if ($task) {
                    $task->is_completed = !$task->is_completed;
                    $task->save();
                }
            }

            return redirect()->route('tasks.index')->with('success', 'Task status updated successfully.');
        }

        return redirect()->route('tasks.index')->with('error', 'No tasks selected to update.');
    }

    // Delete selected tasks
    public function deleteSelected(Request $request)
    {
        $taskIds = $request->input('task_ids', []);

        if (!empty($taskIds)) {
            Task::whereIn('id', $taskIds)
                ->where('user_id', Auth::id())
                ->delete();

            return redirect()->route('tasks.index')->with('success', 'Selected tasks have been deleted.');
        }

        return redirect()->route('tasks.index')->with('error', 'No tasks selected to delete.');
    }

    // Get completed tasks
    public function completedTasks()
    {
        $tasks = Task::where('user_id', Auth::id())
            ->where('is_completed', true)
            ->orderBy('due_date', 'asc')
            ->get()
            ->map(function ($task) {
                $task->formatted_due_date = \Carbon\Carbon::parse($task->due_date)->format('jS M Y');
                return $task;
            });

        return view('tasks.completed', compact('tasks'));
    }


    // Get today's tasks
    public function todayTasks()
    {
        $today = now()->timezone('Asia/Kolkata')->toDateString();

        $tasks = Task::where('user_id', Auth::id())
            ->whereDate('due_date', $today)
            ->orderByRaw("
                CASE priority 
                    WHEN 'high' THEN 1 
                    WHEN 'medium' THEN 2 
                    WHEN 'low' THEN 3 
                    ELSE 4 
                END
            ")
            ->get()
            ->map(function ($task) {
                $task->formatted_due_date = \Carbon\Carbon::parse($task->due_date)->format('jS M Y');
                return $task;
            });

        return view('tasks.today', compact('tasks'));
    }

    //Edit the tasks 
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
}
