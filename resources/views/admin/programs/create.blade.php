<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create New Program') }}
            </h2>
            <a href="{{ route('admin.programs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Back to Programs
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.programs.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Program Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Code -->
                        <div class="mb-4">
                            <x-input-label for="code" :value="__('Program Code')" />
                            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required />
                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Unique code for the program (e.g., BSC-CS, MSC-IT)
                            </p>
                        </div>

                        <!-- Department -->
                        <div class="mb-4">
                            <x-input-label for="department_id" :value="__('Department')" />
                            <select id="department_id" name="department_id"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Select Department</option>
                                @foreach(\App\Models\Department::all() as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }} ({{ $department->code }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                        </div>

                        <!-- Level -->
                        <div class="mb-4">
                            <x-input-label for="level" :value="__('Program Level')" />
                            <select id="level" name="level"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Select Level</option>
                                <option value="undergraduate" {{ old('level') == 'undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                                <option value="postgraduate" {{ old('level') == 'postgraduate' ? 'selected' : '' }}>Postgraduate</option>
                                <option value="diploma" {{ old('level') == 'diploma' ? 'selected' : '' }}>Diploma</option>
                                <option value="certificate" {{ old('level') == 'certificate' ? 'selected' : '' }}>Certificate</option>
                            </select>
                            <x-input-error :messages="$errors->get('level')" class="mt-2" />
                        </div>

                        <!-- Duration -->
                        <div class="mb-4">
                            <x-input-label for="duration_years" :value="__('Duration (Years)')" />
                            <x-text-input id="duration_years" class="block mt-1 w-full" type="number" name="duration_years" :value="old('duration_years')" required min="1" max="10" />
                            <x-input-error :messages="$errors->get('duration_years')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4"
                                      class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                      placeholder="Describe the program's curriculum and objectives...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('admin.programs.index') }}" class="mr-4 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Create Program') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>