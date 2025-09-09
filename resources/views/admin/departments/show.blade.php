<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Department Details: :name', ['name' => $department->name]) }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.departments.edit', $department) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Edit Department
                </a>
                <a href="{{ route('admin.departments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    Back to Departments
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Department Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Department Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department ID</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $department->id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department Name</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $department->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department Code</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $department->code }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $department->description ?? 'No description provided' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Head of Department</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                                        @if($department->headOfDepartment)
                                            {{ $department->headOfDepartment->name }} ({{ $department->headOfDepartment->email }})
                                        @else
                                            Not assigned
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created At</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $department->created_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Programs in this Department -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Programs in this Department</h3>
                            @if($department->programs->count() > 0)
                                <div class="space-y-2">
                                    @foreach($department->programs as $program)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $program->name }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $program->code }} - {{ $program->level }}</p>
                                            </div>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                {{ $program->duration_years }} years
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400 text-center py-8">
                                    No programs are currently assigned to this department.
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="mt-8 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                        <h4 class="text-lg font-semibold mb-4">Department Statistics</h4>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $department->programs->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Total Programs</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $department->programs->sum('courses_count') }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Total Courses</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $department->programs->where('level', 'undergraduate')->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Undergraduate Programs</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $department->programs->where('level', 'postgraduate')->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Postgraduate Programs</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>