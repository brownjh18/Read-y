<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Academic Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Academic Statistics</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $departments->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Departments</div>
                            </div>
                            <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $departments->sum('programs_count') }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Programs</div>
                            </div>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $departments->sum(function($dept) { return $dept->programs->sum('courses_count'); }) }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Courses</div>
                            </div>
                            <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $departments->sum(function($dept) { return $dept->programs->sum(function($prog) { return $prog->courses->sum('credits'); }); }) }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Total Credits</div>
                            </div>
                        </div>
                    </div>

                    @foreach($departments as $department)
                        <div class="mb-8">
                            <h4 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
                                {{ $department->name }} ({{ $department->code }})
                            </h4>

                            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-blue-600 dark:text-blue-400">{{ $department->programs->count() }}</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">Programs</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-green-600 dark:text-green-400">{{ $department->programs->sum('courses_count') }}</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">Courses</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-purple-600 dark:text-purple-400">{{ $department->programs->sum(function($prog) { return $prog->courses->sum('credits'); }) }}</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">Credits</div>
                                    </div>
                                </div>

                                @if($department->programs->count() > 0)
                                    <div class="space-y-3">
                                        @foreach($department->programs as $program)
                                            <div class="bg-white dark:bg-gray-600 p-4 rounded-lg">
                                                <div class="flex justify-between items-start mb-2">
                                                    <div>
                                                        <h5 class="font-semibold text-gray-900 dark:text-gray-100">{{ $program->name }}</h5>
                                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $program->code }} • {{ ucfirst($program->level) }} • {{ $program->duration_years }} years</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $program->courses->count() }} courses</span>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ $program->courses->sum('credits') }} credits</p>
                                                    </div>
                                                </div>

                                                @if($program->courses->count() > 0)
                                                    <div class="mt-3">
                                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Courses:</p>
                                                        <div class="flex flex-wrap gap-2">
                                                            @foreach($program->courses as $course)
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                                    @if($course->status === 'active') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                                    @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                                                    {{ $course->code }} ({{ $course->credits }}cr)
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 dark:text-gray-400 text-center py-4">
                                        No programs in this department yet.
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    @if($departments->count() === 0)
                        <div class="text-center py-12">
                            <p class="text-gray-500 dark:text-gray-400 text-lg">No departments found.</p>
                            <p class="text-gray-400 dark:text-gray-500 mt-2">Start by creating departments and programs.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>