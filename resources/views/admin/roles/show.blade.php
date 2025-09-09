<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Role Details: :name', ['name' => $role->name]) }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.roles.edit', $role) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Edit Role
                </a>
                <a href="{{ route('admin.roles.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    Back to Roles
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Role Information -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Role Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role ID</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $role->id }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role Name</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $role->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $role->description ?? 'No description provided' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created At</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $role->created_at->format('M d, Y H:i') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Updated</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $role->updated_at->format('M d, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Users with this Role -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Users with this Role</h3>
                            @if($role->users->count() > 0)
                                <div class="space-y-2">
                                    @foreach($role->users->take(10) as $user)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                                            </div>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                Active
                                            </span>
                                        </div>
                                    @endforeach
                                    @if($role->users->count() > 10)
                                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-2">
                                            And {{ $role->users->count() - 10 }} more users...
                                        </p>
                                    @endif
                                </div>
                            @else
                                <p class="text-gray-500 dark:text-gray-400 text-center py-8">
                                    No users are currently assigned to this role.
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="mt-8 bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                        <h4 class="text-lg font-semibold mb-4">Role Statistics</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $role->users->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Total Users</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $role->users->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">This Month</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $role->users->where('created_at', '>=', now()->startOfYear())->count() }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">This Year</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>