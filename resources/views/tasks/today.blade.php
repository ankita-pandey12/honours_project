@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-white mb-4 text-center">Today's Tasks List</h2>

    <!-- Check if there are any tasks -->
    @if($tasks->isEmpty())
        <p class="text-white text-center">No tasks to view.</p>
    @else
        <!-- Form to update task status and delete tasks -->
        <form action="{{ route('tasks.deleteSelected') }}" method="POST" class="text-center">
            @csrf
            <div class="overflow-x-auto mx-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-200 mx-auto">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300">#</th> <!-- Index column -->
                            <th class="px-4 py-2 border border-gray-300">Select</th>
                            <th class="px-4 py-2 border border-gray-300">Title</th>
                            <th class="px-4 py-2 border border-gray-300">Description</th>
                            <th class="px-4 py-2 border border-gray-300">Priority</th>
                            <th class="px-4 py-2 border border-gray-300">Due Date</th>
                            <th class="px-4 py-2 border border-gray-300">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900 text-gray-300">
                        @foreach ($tasks as $task)
                            <tr class="{{ $loop->odd ? 'bg-gray-600' : 'bg-gray-700' }}">
                                <td class="px-4 py-2 border border-gray-300 text-center">{{ $loop->iteration }}</td> <!-- Index number -->
                                <td class="px-4 py-2 border border-gray-300 text-center">
                                    <!-- Checkbox to mark task as complete -->
                                    <input type="checkbox" name="task_ids[]" value="{{ $task->id }} "
                                        {{ $task->is_completed ? 'checked' : '' }}
                                        class="form-checkbox h-5 w-5 text-blue-600">
                                </td>
                                <td class="px-4 py-2 border border-gray-300">{{ $task->title }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $task->description }}</td>
                                <td class="px-4 py-2 border border-gray-300 capitalize">{{ $task->priority }}</td>
                                <td class="px-4 py-2 border border-gray-300">
                                    {{ \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 text-center">
                                    @if ($task->is_completed)
                                        <span class="font-semibold text-green-600">Completed</span>
                                    @else
                                        <span class="font-semibold text-red-600">Incomplete</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-center mt-4 space-x-8">
                <!-- Delete Selected Tasks Button -->
                <button type="submit"
                    class="bg-red-600 text-white font-semibold py-2 px-6 rounded hover:bg-red-700 transition-colors duration-300 transform hover:scale-105">
                    Delete Selected Tasks
                </button>
            </div>
        </form>
    @endif
</div>
@endsection