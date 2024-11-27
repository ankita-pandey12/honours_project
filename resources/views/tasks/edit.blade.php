@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-grey-900 px-6">
    <!-- Card Container with Reduced Height, Centered Content, and Minimal Padding -->
    <div class="w-full max-w-2xl bg-gray-900 p-10 rounded-lg border-2 shadow-lg transition-all duration-500 hover:shadow-lg hover:border-blue-500 hover:ring-4 hover:ring-blue-500 mt-10">
        <!-- Card Title -->
        <h2 class="text-2xl font-bold text-white text-center mb-4">Edit Task</h2>
        
        <!-- Form -->
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-lg font-medium text-gray-300 mb-1">Title</label>
                <input type="text" name="title" id="title"
                    class="w-full px-4 py-2 text-gray-900 bg-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                    value="{{ old('title', $task->title) }}" placeholder="Enter task title" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-lg font-medium text-gray-300 mb-1">Description</label>
                <textarea name="description" id="description"
                    class="w-full h-16 px-4 py-2 text-gray-900 bg-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Enter task description" required>{{ old('description', $task->description) }}</textarea>
            </div>

            <!-- Priority -->
            <div class="mb-4">
                <label for="priority" class="block text-lg font-medium text-gray-300 mb-1">Priority</label>
                <select name="priority" id="priority"
                    class="w-full px-4 py-2 text-gray-900 bg-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                    required>
                    <option value="" disabled>-- Select Priority --</option>
                    <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <!-- Due Date -->
            <div class="mb-4">
                <label for="due_date" class="block text-lg font-medium text-gray-300 mb-1">Due Date</label>
                <input type="date" name="due_date" id="due_date"
                    class="w-full px-4 py-2 text-gray-900 bg-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                    value="{{ old('due_date', $task->due_date) }}" required>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit"
                    class="w-full py-3 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    Update Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
