<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create New Assignment') }}
            </h2>
            <a href="{{ route('teacher.assignments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Back to Assignments
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('teacher.assignments.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Course Selection -->
                        <div class="mb-4">
                            <x-input-label for="course_id" :value="__('Select Course')" />
                            <select id="course_id" name="course_id"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Choose a course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->code }} - {{ $course->name }} ({{ $course->program->name }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
                        </div>

                        <!-- Assignment Title -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Assignment Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Assignment Description')" />
                            <textarea id="description" name="description" rows="6"
                                      class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                      placeholder="Provide detailed instructions for the assignment...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Due Date -->
                        <div class="mb-4">
                            <x-input-label for="due_date" :value="__('Due Date')" />
                            <x-text-input id="due_date" class="block mt-1 w-full" type="datetime-local" name="due_date" :value="old('due_date')" required />
                            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Students must submit before this date and time</p>
                        </div>

                        <!-- Total Marks -->
                        <div class="mb-4">
                            <x-input-label for="total_marks" :value="__('Total Marks')" />
                            <x-text-input id="total_marks" class="block mt-1 w-full" type="number" name="total_marks" :value="old('total_marks', 100)" required min="1" max="100" />
                            <x-input-error :messages="$errors->get('total_marks')" class="mt-2" />
                        </div>

                        <!-- File Upload -->
                        <div class="mb-6">
                            <x-input-label for="file" :value="__('Assignment File (Optional)')" />
                            <input id="file" type="file" name="file" accept=".pdf,.doc,.docx,.txt"
                                   class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" />
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload assignment instructions, rubrics, or reference materials (PDF, DOC, DOCX, TXT - Max 10MB)</p>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('teacher.assignments.index') }}" class="mr-4 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Create Assignment') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>