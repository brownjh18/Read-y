<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Course Details: :name', ['name' => $course->name]) }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.courses.edit', $course) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Edit Course
                </a>
                <a href="{{ route('admin.courses.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    Back to Courses
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Course Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Course Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Course ID</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $course->id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Course Name</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $course->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Course Code</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $course->code }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Program</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $course->program->name }} ({{ $course->program->code }})</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $course->program->department->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Credits</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $course->credits }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Semester</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">Semester {{ $course->semester }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($course->status === 'active') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                        @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                        {{ ucfirst($course->status) }}
                                    </span>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $course->description ?? 'No description provided' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created At</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $course->created_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Course Statistics -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Course Statistics</h3>
                            <div class="space-y-4">
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Total Lectures</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Scheduled for this course</p>
                                        </div>
                                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $course->lectures->count() }}</div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Assignments</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Created for this course</p>
                                        </div>
                                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $course->assignments->count() }}</div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Enrolled Students</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Currently enrolled</p>
                                        </div>
                                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $course->enrollments->count() }}</div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Average Grade</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Course performance</p>
                                        </div>
                                        <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">
                                            {{ $course->grades->avg('marks') ? number_format($course->grades->avg('marks'), 1) : 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="mt-8">
                        <h4 class="text-lg font-semibold mb-4">Recent Activity</h4>
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <div class="space-y-3">
                                @if($course->lectures->count() > 0)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            Latest lecture: <strong>{{ $course->lectures->sortByDesc('created_at')->first()->title }}</strong>
                                            on {{ $course->lectures->sortByDesc('created_at')->first()->lecture_date->format('M d, Y') }}
                                        </p>
                                    </div>
                                @endif

                                @if($course->assignments->count() > 0)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            Latest assignment: <strong>{{ $course->assignments->sortByDesc('created_at')->first()->title }}</strong>
                                            due {{ $course->assignments->sortByDesc('created_at')->first()->due_date->format('M d, Y') }}
                                        </p>
                                    </div>
                                @endif

                                @if($course->lectures->count() === 0 && $course->assignments->count() === 0)
                                    <p class="text-gray-500 dark:text-gray-400 text-center py-4">
                                        No recent activity for this course.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>