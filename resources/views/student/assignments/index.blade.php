<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Assignments') }}
            </h2>
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

                    @if($assignments->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($assignments as $assignment)
                                <div class="bg-white dark:bg-gray-700 p-6 rounded-lg border border-gray-200 dark:border-gray-600 hover:shadow-lg transition-shadow duration-200">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $assignment->title }}</h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $assignment->course->name }}</p>
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

                                    <div class="space-y-2 mb-4">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500 dark:text-gray-400">Due Date:</span>
                                            <span class="text-gray-900 dark:text-gray-100">
                                                @if($assignment->due_date)
                                                    {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}
                                                @else
                                                    No due date
                                                @endif
                                            </span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500 dark:text-gray-400">Marks:</span>
                                            <span class="text-gray-900 dark:text-gray-100">{{ $assignment->total_marks }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500 dark:text-gray-400">Teacher:</span>
                                            <span class="text-gray-900 dark:text-gray-100">{{ $assignment->teacher->name }}</span>
                                        </div>
                                    </div>

                                    <div class="flex space-x-2">
                                        <a href="{{ route('student.assignments.show', $assignment) }}"
                                           class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-center text-sm transition duration-200">
                                            View Details
                                        </a>
                                        <a href="{{ route('student.assignments.submit', $assignment) }}"
                                           class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-center text-sm transition duration-200">
                                            Submit
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $assignments->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800 rounded-lg p-8 text-center">
                            <svg class="mx-auto h-16 w-16 text-green-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">No Pending Assignments</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">Great job! You've submitted all available assignments.</p>
                            <a href="{{ route('student.dashboard') }}"
                               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-green-700 border border-transparent rounded-lg font-bold text-base text-white uppercase tracking-wider hover:from-green-700 hover:to-green-800 active:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 focus:ring-opacity-50 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 ease-in-out">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                                </svg>
                                <span>Back to Dashboard</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>