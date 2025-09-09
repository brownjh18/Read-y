<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Assignment Details') }}
            </h2>
            <a href="{{ route('student.assignments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Back to Assignments
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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

                    <!-- Assignment Header -->
                    <div class="mb-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $assignment->title }}</h3>
                                <p class="text-lg text-gray-600 dark:text-gray-400">{{ $assignment->course->name }} ({{ $assignment->course->code }})</p>
                            </div>
                            <span class="px-3 py-1 text-sm rounded-full
                                @if($assignment->due_date && \Carbon\Carbon::parse($assignment->due_date) > now()) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                {{ $assignment->due_date && \Carbon\Carbon::parse($assignment->due_date) > now() ? 'Active' : 'Overdue' }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-sm text-gray-600 dark:text-gray-400">Total Marks</div>
                                <div class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $assignment->total_marks }}</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-sm text-gray-600 dark:text-gray-400">Due Date</div>
                                <div class="text-xl font-bold text-gray-900 dark:text-gray-100">
                                    @if($assignment->due_date)
                                        {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}
                                    @else
                                        No due date
                                    @endif
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-sm text-gray-600 dark:text-gray-400">Teacher</div>
                                <div class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $assignment->teacher->name }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Assignment Description -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold mb-3">Assignment Description</h4>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $assignment->description }}</p>
                        </div>
                    </div>

                    <!-- Assignment File (if exists) -->
                    @if($assignment->file_path)
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold mb-3">Assignment File</h4>
                            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 p-4 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ basename($assignment->file_path) }}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">Click to download</p>
                                        </div>
                                    </div>
                                    <a href="{{ Storage::url($assignment->file_path) }}" target="_blank"
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition duration-200">
                                        Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Submission Status -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold mb-3">Submission Status</h4>
                        @if($submission)
                            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8 text-green-600 dark:text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Assignment Submitted</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                Submitted on {{ \Carbon\Carbon::parse($submission->submitted_at)->format('M d, Y \a\t g:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                    @if($submission->marks)
                                        <div class="text-right">
                                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $submission->marks }}/{{ $assignment->total_marks }}</div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ number_format(($submission->marks / $assignment->total_marks) * 100, 1) }}%
                                            </div>
                                        </div>
                                    @else
                                        <span class="px-3 py-1 text-sm bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded-full">
                                            Awaiting Grade
                                        </span>
                                    @endif
                                </div>

                                @if($submission->comments)
                                    <div class="mt-4 p-3 bg-white dark:bg-gray-800 rounded border">
                                        <p class="text-sm text-gray-700 dark:text-gray-300"><strong>Your Comments:</strong> {{ $submission->comments }}</p>
                                    </div>
                                @endif

                                @if($submission->feedback)
                                    <div class="mt-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded border border-blue-200 dark:border-blue-800">
                                        <p class="text-sm text-gray-700 dark:text-gray-300"><strong>Teacher Feedback:</strong> {{ $submission->feedback }}</p>
                                    </div>
                                @endif

                                @if($submission->file_path)
                                    <div class="mt-4 flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 text-gray-600 dark:text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ basename($submission->file_path) }}</span>
                                        </div>
                                        <a href="{{ Storage::url($submission->file_path) }}" target="_blank"
                                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm">
                                            Download
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 p-4 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Not Submitted Yet</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">Submit your assignment before the due date</p>
                                        </div>
                                    </div>
                                    @if($assignment->due_date && \Carbon\Carbon::parse($assignment->due_date) > now())
                                        <a href="{{ route('student.assignments.submit', $assignment) }}"
                                           class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm transition duration-200">
                                            Submit Assignment
                                        </a>
                                    @else
                                        <span class="px-3 py-1 text-sm bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded-full">
                                            Past Due Date
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center">
                        <a href="{{ route('student.assignments.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                            Back to Assignments
                        </a>

                        @if(!$submission && $assignment->due_date && \Carbon\Carbon::parse($assignment->due_date) > now())
                            <a href="{{ route('student.assignments.submit', $assignment) }}"
                               class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition duration-200">
                                Submit Assignment
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>