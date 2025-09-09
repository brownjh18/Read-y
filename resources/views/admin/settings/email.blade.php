<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Email Settings') }}
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

                    <form method="POST" action="{{ route('admin.settings.email') }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- SMTP Settings -->
                            <div>
                                <h3 class="text-lg font-semibold mb-4">SMTP Configuration</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <x-input-label for="mail_mailer" :value="__('Mail Driver')" />
                                        <select id="mail_mailer" name="mail_mailer" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            <option value="smtp" {{ config('mail.mailer') === 'smtp' ? 'selected' : '' }}>SMTP</option>
                                            <option value="log" {{ config('mail.mailer') === 'log' ? 'selected' : '' }}>Log</option>
                                            <option value="mailgun" {{ config('mail.mailer') === 'mailgun' ? 'selected' : '' }}>Mailgun</option>
                                        </select>
                                    </div>

                                    <div>
                                        <x-input-label for="mail_host" :value="__('SMTP Host')" />
                                        <x-text-input id="mail_host" class="block mt-1 w-full" type="text" name="mail_host" :value="config('mail.host')" />
                                    </div>

                                    <div>
                                        <x-input-label for="mail_port" :value="__('SMTP Port')" />
                                        <x-text-input id="mail_port" class="block mt-1 w-full" type="number" name="mail_port" :value="config('mail.port')" />
                                    </div>

                                    <div>
                                        <x-input-label for="mail_encryption" :value="__('Encryption')" />
                                        <select id="mail_encryption" name="mail_encryption" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            <option value="tls" {{ config('mail.encryption') === 'tls' ? 'selected' : '' }}>TLS</option>
                                            <option value="ssl" {{ config('mail.encryption') === 'ssl' ? 'selected' : '' }}>SSL</option>
                                            <option value="" {{ config('mail.encryption') === null ? 'selected' : '' }}>None</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Authentication -->
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Authentication</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <x-input-label for="mail_username" :value="__('SMTP Username')" />
                                        <x-text-input id="mail_username" class="block mt-1 w-full" type="text" name="mail_username" :value="config('mail.username')" />
                                    </div>

                                    <div>
                                        <x-input-label for="mail_password" :value="__('SMTP Password')" />
                                        <x-text-input id="mail_password" class="block mt-1 w-full" type="password" name="mail_password" :value="config('mail.password')" />
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Leave blank to keep current password</p>
                                    </div>
                                </div>
                            </div>

                            <!-- From Address -->
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Sender Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <x-input-label for="mail_from_address" :value="__('From Email Address')" />
                                        <x-text-input id="mail_from_address" class="block mt-1 w-full" type="email" name="mail_from_address" :value="config('mail.from.address')" />
                                    </div>

                                    <div>
                                        <x-input-label for="mail_from_name" :value="__('From Name')" />
                                        <x-text-input id="mail_from_name" class="block mt-1 w-full" type="text" name="mail_from_name" :value="config('mail.from.name')" />
                                    </div>
                                </div>
                            </div>

                            <!-- Email Notifications -->
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Email Notifications</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input id="notify_new_registration" name="notify_new_registration" type="checkbox" checked class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                        <label for="notify_new_registration" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">
                                            Notify admin on new user registration
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="notify_assignment_submissions" name="notify_assignment_submissions" type="checkbox" checked class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                        <label for="notify_assignment_submissions" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">
                                            Notify teachers on assignment submissions
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input id="notify_grade_updates" name="notify_grade_updates" type="checkbox" checked class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                        <label for="notify_grade_updates" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">
                                            Notify students on grade updates
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="button" class="mr-4 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg" onclick="testEmailConnection()">
                                Test Connection
                            </button>
                            <x-primary-button>
                                {{ __('Save Email Settings') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function testEmailConnection() {
            alert('Email connection test would be implemented here');
        }
    </script>
</x-app-layout>