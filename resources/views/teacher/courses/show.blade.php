<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Course Details: ') . $course->name }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('teacher.assignments.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Assignment
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Course Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-blue-800 dark:text-blue-200">Course Information</h3>
                            <div class="space-y-2">
                                <p><strong>Code:</strong> {{ $course->code }}</p>
                                <p><strong>Name:</strong> {{ $course->name }}</p>
                                <p><strong>Description:</strong> {{ $course->description ?: 'No description available' }}</p>
                                <p><strong>Credits:</strong> {{ $course->credits }}</p>
                                <p><strong>Semester:</strong> {{ $course->semester }}</p>
                            </div>
                        </div>

                        <div class="bg-green-50 dark:bg-green-900/20 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-green-800 dark:text-green-200">Program Details</h3>
                            <div class="space-y-2">
                                <p><strong>Program:</strong> {{ $course->program->name }}</p>
                                <p><strong>Department:</strong> {{ $course->program->department->name }}</p>
                                <p><strong>Level:</strong> {{ ucfirst($course->program->level) }}</p>
                                <p><strong>Duration:</strong> {{ $course->program->duration_years }} years</p>
                            </div>
                        </div>
                    </div>

                    <!-- Course Statistics -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $course->assignments->count() }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Assignments</div>
                        </div>
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $course->assignments->flatMap->submissions->count() }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Total Submissions</div>
                        </div>
                        <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $course->assignments->flatMap->submissions->where('status', 'submitted')->count() }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Pending Grading</div>
                        </div>
                    </div>

                    <!-- Assignments Section -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4">Course Assignments</h3>
                        @if($course->assignments->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Due Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Submissions</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($course->assignments as $assignment)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $assignment->title }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                    @if($assignment->due_date)
                                                        {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                    {{ $assignment->submissions->count() }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="{{ route('teacher.assignments.show', $assignment) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">View Details</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-lg text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Assignments Yet</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Create your first assignment for this course.</p>
                                <a href="{{ route('teacher.assignments.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Create First Assignment
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Lectures Section -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4">Course Lectures</h3>
                        @if($course->lectures->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Time</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($course->lectures as $lecture)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $lecture->title }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                    @if($lecture->lecture_date)
                                                        {{ \Carbon\Carbon::parse($lecture->lecture_date)->format('M d, Y') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                    {{ $lecture->start_time }} - {{ $lecture->end_time }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        @if($lecture->status === 'completed') bg-green-100 text-green-800
                                                        @elseif($lecture->status === 'scheduled') bg-blue-100 text-blue-800
                                                        @else bg-red-100 text-red-800 @endif">
                                                        {{ ucfirst($lecture->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-lg text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Lectures Scheduled</h3>
                                <p class="text-gray-600 dark:text-gray-400">Lectures will be scheduled by the administration.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>