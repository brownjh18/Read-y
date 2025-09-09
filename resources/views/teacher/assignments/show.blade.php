<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Assignment Details: ') . $assignment->title }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('teacher.assignments.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Assignments
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

                    <!-- Assignment Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-blue-800 dark:text-blue-200">Assignment Details</h3>
                            <div class="space-y-3">
                                <div>
                                    <strong>Title:</strong>
                                    <p class="mt-1">{{ $assignment->title }}</p>
                                </div>
                                <div>
                                    <strong>Description:</strong>
                                    <p class="mt-1">{{ $assignment->description }}</p>
                                </div>
                                <div>
                                    <strong>Due Date:</strong>
                                    <p class="mt-1 @if($assignment->due_date && \Carbon\Carbon::parse($assignment->due_date) < now()) text-red-600 @else text-green-600 @endif">
                                        @if($assignment->due_date)
                                            {{ \Carbon\Carbon::parse($assignment->due_date)->format('F d, Y \a\t g:i A') }}
                                            @if(\Carbon\Carbon::parse($assignment->due_date) < now())
                                                <span class="text-red-500 text-sm">(Overdue)</span>
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <strong>Total Marks:</strong>
                                    <p class="mt-1">{{ $assignment->total_marks }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-50 dark:bg-green-900/20 p-6 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-green-800 dark:text-green-200">Course Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <strong>Course:</strong>
                                    <p class="mt-1">{{ $assignment->course->name }} ({{ $assignment->course->code }})</p>
                                </div>
                                <div>
                                    <strong>Program:</strong>
                                    <p class="mt-1">{{ $assignment->course->program->name }}</p>
                                </div>
                                <div>
                                    <strong>Department:</strong>
                                    <p class="mt-1">{{ $assignment->course->program->department->name }}</p>
                                </div>
                                <div>
                                    <strong>Credits:</strong>
                                    <p class="mt-1">{{ $assignment->course->credits }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $assignment->submissions->count() }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Total Submissions</div>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $assignment->submissions->where('status', 'graded')->count() }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Graded</div>
                        </div>
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $assignment->submissions->where('status', 'submitted')->count() }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Pending Grading</div>
                        </div>
                        <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg text-center">
                            <div class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $assignment->submissions->where('status', 'late')->count() }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Late Submissions</div>
                        </div>
                    </div>

                    <!-- Submissions Section -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4">Student Submissions</h3>
                        @if($assignment->submissions->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Student</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Submitted</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Marks</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($assignment->submissions as $submission)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $submission->student->name }}</div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $submission->student->email }}</div>
                                                    @if($submission->student->student_id)
                                                        <div class="text-xs text-gray-400 dark:text-gray-500">ID: {{ $submission->student->student_id }}</div>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                    {{ $submission->submitted_at ? $submission->submitted_at->format('M d, Y g:i A') : 'Not submitted' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        @if($submission->status === 'graded') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                        @elseif($submission->status === 'submitted') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                        @elseif($submission->status === 'late') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                        @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 @endif">
                                                        {{ ucfirst($submission->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                                    @if($submission->marks !== null)
                                                        <span class="font-medium">{{ $submission->marks }}/{{ $assignment->total_marks }}</span>
                                                        <span class="text-xs text-gray-400">({{ number_format(($submission->marks / $assignment->total_marks) * 100, 1) }}%)</span>
                                                    @else
                                                        <span class="text-gray-400">Not graded</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="{{ route('teacher.submissions.show', $submission) }}"
                                                       class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">
                                                        View Details
                                                    </a>
                                                    @if($submission->status === 'submitted' || $submission->status === 'late')
                                                        <a href="{{ route('teacher.submissions.show', $submission) }}#grade"
                                                           class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                                            Grade
                                                        </a>
                                                    @endif
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
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Submissions Yet</h3>
                                <p class="text-gray-600 dark:text-gray-400">Students haven't submitted their assignments yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>