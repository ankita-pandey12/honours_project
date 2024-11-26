@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-white mb-4 text-center">Completed Tasks</h2>

    @if($tasks->isEmpty())
        <p class="text-white text-center">No completed tasks to view.</p>
    @else
        <div class="overflow-x-auto mx-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-200 mx-auto">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300">Title</th>
                        <th class="px-4 py-2 border border-gray-300">Description</th>
                        <th class="px-4 py-2 border border-gray-300">Priority</th>
                        <th class="px-4 py-2 border border-gray-300">Due Date</th>
                        <th class="px-4 py-2 border border-gray-300">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-700 text-gray-300">
                    @foreach ($tasks as $task)
                        <tr class="{{ $loop->odd ? 'bg-gray-600' : 'bg-gray-700' }}">
                            <td class="px-4 py-2 border border-gray-300">{{ $task->title }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $task->description }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ ucfirst($task->priority) }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') }}</td>
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