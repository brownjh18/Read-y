<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('General Settings') }}
        </h2>
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

                    <form method="POST" action="{{ route('admin.settings.general') }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Application Settings -->
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Application Settings</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <x-input-label for="app_name" :value="__('Application Name')" />
                                        <x-text-input id="app_name" class="block mt-1 w-full" type="text" name="app_name" :value="config('app.name')" />
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">The name displayed in the application</p>
                                    </div>

                                    <div>
                                        <x-input-label for="app_url" :value="__('Application URL')" />
                                        <x-text-input id="app_url" class="block mt-1 w-full" type="url" name="app_url" :value="config('app.url')" />
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">The base URL of the application</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Academic Year Settings -->
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Academic Settings</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <x-input-label for="current_academic_year" :value="__('Current Academic Year')" />
                                        <x-text-input id="current_academic_year" class="block mt-1 w-full" type="text" name="current_academic_year" value="2024-2025" />
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Format: YYYY-YYYY</p>
                                    </div>

                                    <div>
                                        <x-input-label for="semester" :value="__('Current Semester')" />
                                        <select id="semester" name="semester" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            <option value="1">Semester 1</option>
                                            <option value="2">Semester 2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- System Settings -->
                            <div>
                                <h3 class="text-lg font-semibold mb-4">System Settings</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input id="maintenance_mode" name="maintenance_mode" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                        <label for="maintenance_mode" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">
                                            Enable Maintenance Mode
                                        </label>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">When enabled, only administrators can access the system</p>

                                    <div class="flex items-center">
                                        <input id="registration_enabled" name="registration_enabled" type="checkbox" checked class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                        <label for="registration_enabled" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">
                                            Allow New User Registration
                                        </label>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Allow students and teachers to register new accounts</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Save Settings') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>