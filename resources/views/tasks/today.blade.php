@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6" style="max-width: 1200px; margin: 0 auto;">
    <h2 class="text-2xl font-semibold text-white mb-4 text-center">Today's Tasks List</h2>

    <!-- Check if there are any tasks -->
    @if($tasks->isEmpty())
    <p class="text-white text-center">No tasks to view.</p>
    @else
    <!-- Constrain the table width -->
    <div class="overflow-x-auto mx-auto p-4">
        <table class="min-w-full table-auto border-collapse border border-gray-200 mx-auto w-full">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2 border border-gray-300 text-center">#</th> <!-- Index column -->
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
                    <td class="px-4 py-2 border border-gray-300 text-center">{{ $task->title }}</td>
                    <td class="px-4 py-2 border border-gray-300 break-words text-center" style="max-width: 320px; word-wrap: break-word;">
                        {{ $task->description }}
                    </td>
                    <td class="px-4 py-2 border border-gray-300 text-center capitalize">
                        @if($task->priority === 'high')
                        <span class="text-orange-500">{{ $task->priority }}</span>
                        @elseif($task->priority === 'medium')
                        <span class="text-yellow-300">{{ $task->priority }}</span>
                        @elseif($task->priority === 'low')
                        <span class="text-green-300">{{ $task->priority }}</span>
                        @endif
                    </td>

                    <td class="px-4 py-2 border border-gray-300 text-center">
                        {{ $task->formatted_due_date }}
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
    @endif
</div>
@endsection