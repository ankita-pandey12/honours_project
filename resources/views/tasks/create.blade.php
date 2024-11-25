@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-black px-6">
    <!-- Card Container with Decent Width, Centered Content, and Increased Padding -->
    <div class="w-full max-w-2xl bg-gray-900 p-10 rounded-lg border-4 border-white shadow-lg transition-all duration-500 hover:shadow-2xl hover:border-red-500 hover:ring-4 hover:ring-red-500 mt-12">
        <!-- Card Title -->
        <h2 class="text-2xl font-bold text-white text-center mb-8">Create a New Task</h2>
        
        <!-- Form -->
        <form action="{{ url('/tasks') }}" method="POST">
            @csrf

            <!-- Title -->
            <div class="mb-8">
                <label for="title" class="block text-lg font-medium text-gray-300 mb-2">Title</label>
                <input type="text" name="title" id="title"
                    class="w-full px-6 py-3 text-gray-900 bg-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter task title" required>
            </div>

            <!-- Description -->
            <div class="mb-8">
                <label for="description" class="block text-lg font-medium text-gray-300 mb-2">Description</label>
                <textarea name="description" id="description"
                    class="w-full h-24 px-6 py-3 text-gray-900 bg-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter task description" required></textarea>
            </div>

            <!-- Priority -->
            <div class="mb-8">
                <label for="priority" class="block text-lg font-medium text-gray-300 mb-2">Priority</label>
                <select name="priority" id="priority"
                    class="w-full px-6 py-3 text-gray-900 bg-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                    <option value="" disabled selected>-- Select Priority --</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <!-- Due Date -->
            <div class="mb-8">
                <label for="due_date" class="block text-lg font-medium text-gray-300 mb-2">Due Date</label>
                <input type="date" name="due_date" id="due_date"
                    class="w-full px-6 py-3 text-gray-900 bg-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-6"> <!-- Added margin-top here -->
                <button type="submit"
                    class="w-full py-4 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    Create Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
