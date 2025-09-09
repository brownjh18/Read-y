<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Course Details') }}
            </h2>
            <a href="{{ route('student.courses.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Back to Courses
            </a>
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

                    <!-- Course Header -->
                    <div class="mb-8">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $course->name }}</h3>
                                <p class="text-xl text-gray-600 dark:text-gray-400">{{ $course->code }}</p>
                                <p class="text-lg text-gray-500 dark:text-gray-500 mt-1">{{ $course->program->name }} - {{ $course->program->department->name }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $course->credits }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Credits</div>
                            </div>
                        </div>

                        @if($course->description)
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <p class="text-gray-700 dark:text-gray-300">{{ $course->description }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Course Statistics -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg text-center">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $assignments->count() }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Total Assignments</div>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 p-6 rounded-lg text-center">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $assignments->where('studentSubmission')->count() }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Submitted</div>
                        </div>
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-6 rounded-lg text-center">
                            <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $assignments->where('studentSubmission', null)->count() }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Pending</div>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-6 rounded-lg text-center">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                                @if($assignments->count() > 0)
                                    {{ number_format($assignments->where('studentSubmission')->avg(function($assignment) {
                                        return $assignment->studentSubmission ? ($assignment->studentSubmission->marks / $assignment->total_marks) * 100 : 0;
                                    }), 1) }}%
                                @else
                                    -
                                @endif
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Avg Grade</div>
                        </div>
                    </div>

                    <!-- Assignments Section -->
                    <div class="mb-8">
                        <h4 class="text-xl font-semibold mb-4">Course Assignments</h4>

                        @if($assignments->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($assignments as $assignment)
                                    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg border border-gray-200 dark:border-gray-600 hover:shadow-lg transition-shadow duration-200">
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                <h5 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $assignment->title }}</h5>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">By {{ $assignment->teacher->name }}</p>
                                            </div>
                                            <span class="px-2 py-1 text-xs rounded-full
                                                @if($assignment->due_date && \Carbon\Carbon::parse($assignment->due_date) > now()) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                                {{ $assignment->due_date && \Carbon\Carbon::parse($assignment->due_date) > now() ? 'Active' : 'Overdue' }}
                                            </span>
                                        </div>

                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                                            {{ Str::limit($assignment->description, 100) }}
                                        </p>

                                        <div class="flex justify-between items-center text-sm mb-4">
                                            <span class="text-gray-500 dark:text-gray-400">
                                                Due: @if($assignment->due_date){{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}@else N/A @endif
                                            </span>
                                            <span class="text-gray-500 dark:text-gray-400">
                                                {{ $assignment->total_marks }} marks
                                            </span>
                                        </div>

                                        <!-- Submission Status -->
                                        @if($assignment->studentSubmission)
                                            <div class="mb-4 p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        <span class="text-sm font-medium text-green-800 dark:text-green-200">Submitted</span>
                                                    </div>
                                                    @if($assignment->studentSubmission->marks)
                                                        <span class="text-sm font-bold text-green-600 dark:text-green-400">
                                                            {{ $assignment->studentSubmission->marks }}/{{ $assignment->total_marks }}
                                                        </span>
                                                    @else
                                                        <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded-full">
                                                            Awaiting Grade
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="mb-4 p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                    </svg>
                                                    <span class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Not Submitted</span>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="flex space-x-2">
                                            <a href="{{ route('student.assignments.show', $assignment) }}"
                                               class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-center text-sm transition duration-200">
                                                View Details
                                            </a>
                                            @if(!$assignment->studentSubmission && $assignment->due_date && \Carbon\Carbon::parse($assignment->due_date) > now())
                                                <a href="{{ route('student.assignments.submit', $assignment) }}"
                                                   class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-center text-sm transition duration-200">
                                                    Submit
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-lg text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">No Assignments Yet</h3>
                                <p class="text-gray-600 dark:text-gray-400">Assignments for this course will appear here when they are created by your teacher.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Back Button -->
                    <div class="flex justify-start">
                        <a href="{{ route('student.courses.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                            Back to Courses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>