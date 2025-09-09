<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Assignment') }}
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
                    <form method="POST" action="{{ route('teacher.assignments.update', $assignment) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Course Selection -->
                        <div class="mb-4">
                            <x-input-label for="course_id" :value="__('Select Course')" />
                            <select id="course_id" name="course_id"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Choose a course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ old('course_id', $assignment->course_id) == $course->id ? 'selected' : '' }}>
                                        {{ $course->code }} - {{ $course->name }} ({{ $course->program->name }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
                        </div>

                        <!-- Assignment Title -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Assignment Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $assignment->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Assignment Description')" />
                            <textarea id="description" name="description" rows="6"
                                      class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                      placeholder="Provide detailed instructions for the assignment...">{{ old('description', $assignment->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Due Date -->
                        <div class="mb-4">
                            <x-input-label for="due_date" :value="__('Due Date')" />
                            <x-text-input id="due_date" class="block mt-1 w-full" type="datetime-local" name="due_date" :value="old('due_date', $assignment->due_date ? \Carbon\Carbon::parse($assignment->due_date)->format('Y-m-d\TH:i') : '')" required />
                            <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Students must submit before this date and time</p>
                        </div>

                        <!-- Total Marks -->
                        <div class="mb-4">
                            <x-input-label for="total_marks" :value="__('Total Marks')" />
                            <x-text-input id="total_marks" class="block mt-1 w-full" type="number" name="total_marks" :value="old('total_marks', $assignment->total_marks)" required min="1" max="100" />
                            <x-input-error :messages="$errors->get('total_marks')" class="mt-2" />
                        </div>

                        <!-- Current File -->
                        @if($assignment->file_path)
                            <div class="mb-4">
                                <x-input-label :value="__('Current File')" />
                                <div class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-md">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Current file: <a href="{{ Storage::url($assignment->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">{{ basename($assignment->file_path) }}</a>
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- File Upload -->
                        <div class="mb-6">
                            <x-input-label for="file" :value="__('Update File (Optional)')" />
                            <input id="file" type="file" name="file" accept=".pdf,.doc,.docx,.txt"
                                   class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" />
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload a new file to replace the current one (PDF, DOC, DOCX, TXT - Max 10MB). Leave empty to keep current file.</p>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('teacher.assignments.index') }}" class="mr-4 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Update Assignment') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>