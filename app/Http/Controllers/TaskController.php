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

    public function index()
    {
        // Fetch all tasks from the database
        $tasks = Task::orderBy('created_at', 'desc')->get();

        // Pass tasks to the view
        return view('tasks.index', compact('tasks'));
    }


}
