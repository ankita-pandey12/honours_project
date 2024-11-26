@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6" style="max-width: 1200px; margin: 0 auto;">
    <h2 class="text-2xl font-semibold text-white mb-4 text-center">Tasks List</h2>

    <!-- Check if there are any tasks -->
    @if($tasks->isEmpty())
        <p class="text-white text-center">No tasks to view.</p>
    @else
        <!-- Form to update task status and delete tasks -->
        <form action="{{ route('tasks.deleteSelected') }}" method="POST" class="text-center">
            @csrf
            <!-- Wrapper div for table alignment -->
            <div class="overflow-x-auto mx-auto p-4">
                <table class="min-w-full table-auto border-collapse border border-gray-200 mx-auto">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-2 border border-gray-300 text-center">#</th> <!-- Index column -->
                            <th class="px-2 py-2 border border-gray-300" style="width: 80px;">Select</th> <!-- Adjusted width for Select -->
                            <th class="px-4 py-2 border border-gray-300">Title</th> <!-- Adjusted width for Title -->
                            <th class="px-4 py-2 border border-gray-300">Description</th> <!-- Adjusted width for Description -->
                            <th class="px-4 py-2 border border-gray-300">Priority</th>
                            <th class="px-4 py-2 border border-gray-300">Due Date</th>
                            <th class="px-4 py-2 border border-gray-300">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-900 text-gray-300">
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="px-4 py-2 border border-gray-300 text-center">{{ $loop->iteration }}</td> <!-- Index number -->
                                <td class="px-2 py-2 border border-gray-300 text-center" style="width: 80px;">
                                    <!-- Checkbox to mark task as complete -->
                                    <input type="checkbox" name="task_ids[]" value="{{ $task->id }} "
                                        {{ $task->is_completed ? 'checked' : '' }}
                                        class="form-checkbox h-5 w-5 text-blue-600">
                                </td>
                                <td class="px-4 py-2 border border-gray-300 text-left">{{ $task->title }}</td>
                                <td class="px-4 py-2 border border-gray-300 break-words text-left" style="max-width: 320px; word-wrap: break-word;">
                                    {{ $task->description }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 text-center capitalize">{{ $task->priority }}</td>
                                <td class="px-4 py-2 border border-gray-300 text-center">
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
                    class="bg-red-600 text-white font-semibold py-2 px-6 rounded hover:bg-red-700 transition-colors">
                    Delete Selected Tasks
                </button>

                <!-- Mark as Completed Button -->
                <button type="submit" formaction="{{ route('tasks.toggleStatus') }}"
                    class="bg-blue-600 text-white font-semibold py-2 px-6 rounded hover:bg-blue-700 transition-colors"
                    style="background-color: #00781d">
                    Mark as Completed/Incomplete
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
