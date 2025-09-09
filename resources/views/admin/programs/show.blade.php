<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Program Details: :name', ['name' => $program->name]) }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.programs.edit', $program) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Edit Program
                </a>
                <a href="{{ route('admin.programs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    Back to Programs
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Program Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Program Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Program ID</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $program->id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Program Name</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $program->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Program Code</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $program->code }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $program->department->name }} ({{ $program->department->code }})</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Level</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ ucfirst($program->level) }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Duration</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $program->duration_years }} years</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $program->description ?? 'No description provided' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created At</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $program->created_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Courses in this Program -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Courses in this Program</h3>
                            @if($program->courses->count() > 0)
                                <div class="space-y-2">
                                    @foreach($program->courses as $course)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $course->name }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $course->code }} - Semester {{ $course->semester }}</p>
                                            </div>
                                            <div class="text-right">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    @if($course->status === 'active') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                    @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                                    {{ $course->credits }} credits
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400 text-center py-8">
                                    No courses are currently assigned to this program.
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="mt-8 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                        <h4 class="text-lg font-semibold mb-4">Program Statistics</h4>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $program->courses->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Total Courses</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $program->courses->sum('credits') }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Total Credits</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $program->courses->where('status', 'active')->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Active Courses</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $program->courses->max('semester') }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Max Semester</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>