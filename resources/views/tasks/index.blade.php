@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-800 px-6 py-12">
    <div class="max-w-6xl mx-auto bg-gray-900 p-8 rounded-lg shadow-lg">
        <!-- Page Title -->
        <h2 class="text-3xl font-bold text-white mb-8 text-center">Task List</h2>

        <!-- Tasks Table -->
        @if($tasks->isEmpty())
            <p class="text-gray-300 text-center">No tasks available. <a href="{{ url('/tasks/create') }}" class="text-blue-500 hover:underline">Create one</a>.</p>
        @else
            <table class="w-full bg-gray-800 text-white border border-gray-700 rounded-lg overflow-hidden">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="text-left px-4 py-2">Title</th>
                        <th class="text-left px-4 py-2">Description</th>
                        <th class="text-center px-4 py-2">Priority</th>
                        <th class="text-center px-4 py-2">Due Date</th>
                        <th class="text-center px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr class="border-t border-gray-700">
                            <td class="px-4 py-2">{{ $task->title }}</td>
                            <td class="px-4 py-2">{{ $task->description }}</td>
                            <td class="px-4 py-2 text-center">
                                @if($task->priority === 'high')
                                    <span class="text-red-500 font-bold">High</span>
                                @elseif($task->priority === 'medium')
                                    <span class="text-yellow-500 font-bold">Medium</span>
                                @else
                                    <span class="text-green-500 font-bold">Low</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ url('/tasks/' . $task->id) }}" class="text-blue-400 hover:underline">View</a> |
                                <a href="{{ url('/tasks/' . $task->id . '/edit') }}" class="text-yellow-400 hover:underline">Edit</a> |
                                <form action="{{ url('/tasks/' . $task->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
