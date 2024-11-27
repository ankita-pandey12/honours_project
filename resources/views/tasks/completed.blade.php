@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6" style="max-width: 1200px; margin: 0 auto;">
    <h2 class="text-2xl font-semibold text-white mb-4 text-center">Completed Tasks</h2>

    @if($tasks->isEmpty())
        <p class="text-white text-center">No completed tasks to view.</p>
    @else
        <div class="overflow-x-auto mx-auto p-4">
            <table class="min-w-full table-auto border-collapse border border-gray-200 mx-auto">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300 text-center">#</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Title</th>
                        <th class="px-4 py-2 border border-gray-300 text-center">Description</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Priority</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Due Date</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 text-gray-300">
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="px-4 py-2 border border-gray-300 text-center">{{ $loop->iteration }}</td> <!-- Display the index here -->
                            <td class="px-4 py-2 border border-gray-300 text-center">{{ $task->title }}</td>
                            <td class="px-4 py-2 border border-gray-300 text-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 300px;">{{ $task->description }}</td>
                            <td class="px-4 py-2 border border-gray-300 capitalize text-center">{{ $task->priority }}</td>
                            <td class="px-4 py-2 border border-gray-300 text-center">
                                {{ \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-2 border border-gray-300 text-center">
                                <span class="text-green-600 font-semibold">Completed</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
