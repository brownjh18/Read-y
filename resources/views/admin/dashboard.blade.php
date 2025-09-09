<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        {{ __('Admin Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 overflow-hidden shadow-2xl sm:rounded-2xl mb-8 border border-blue-500">
            <div class="p-6 lg:p-8 bg-gradient-to-r from-blue-600/90 to-blue-800/90 backdrop-blur-sm">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <h1 class="ml-4 text-2xl font-bold text-white">
                        Welcome back, {{ Auth::user()->name }}!
                    </h1>
                </div>

                <p class="mt-4 text-blue-100 leading-relaxed">
                    Here's what's happening with your school portal today. Manage your institution efficiently with our comprehensive dashboard.
                </p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 overflow-hidden shadow-2xl sm:rounded-2xl border border-blue-400">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-blue-100 truncate">
                                    Total Users
                                </dt>
                                <dd class="text-2xl font-bold text-white">
                                    {{ $userCount ?? 0 }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-green-600 overflow-hidden shadow-2xl sm:rounded-2xl border border-green-400">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-user-tag text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-green-100 truncate">
                                    Total Roles
                                </dt>
                                <dd class="text-2xl font-bold text-white">
                                    {{ $roleCount ?? 0 }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-orange-500 to-orange-600 overflow-hidden shadow-2xl sm:rounded-2xl border border-orange-400">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-building text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-orange-100 truncate">
                                    Total Departments
                                </dt>
                                <dd class="text-2xl font-bold text-white">
                                    {{ $departmentCount ?? 0 }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-purple-600 overflow-hidden shadow-2xl sm:rounded-2xl border border-purple-400">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-book text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-purple-100 truncate">
                                    Total Courses
                                </dt>
                                <dd class="text-2xl font-bold text-white">
                                    {{ $courseCount ?? 0 }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- User Distribution Chart -->
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-pie text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">User Distribution</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-pie text-white text-xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">User Analytics Chart</p>
                            <p class="text-sm text-gray-400 mt-1">Interactive chart will be displayed here</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Enrollment Trends -->
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">Enrollment Trends</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-line text-white text-xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Enrollment Analytics Chart</p>
                            <p class="text-sm text-gray-400 mt-1">Interactive chart will be displayed here</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200">
            <div class="p-6 lg:p-8 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-bolt text-white"></i>
                    </div>
                    <h1 class="ml-3 text-2xl font-bold text-gray-900">
                        Quick Actions
                    </h1>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user-plus text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">
                            <a href="{{ route('admin.users.create') }}" class="hover:text-blue-600 transition-colors">Add User</a>
                        </h3>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Create a new user account for students, teachers, or administrators.
                    </p>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-xl border border-green-200 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-building text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">
                            <a href="{{ route('admin.departments.create') }}" class="hover:text-green-600 transition-colors">Add Department</a>
                        </h3>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Create a new academic department for your institution.
                    </p>
                </div>

                <div class="bg-gradient-to-r from-orange-50 to-orange-100 p-6 rounded-xl border border-orange-200 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">
                            <a href="{{ route('admin.programs.create') }}" class="hover:text-orange-600 transition-colors">Add Program</a>
                        </h3>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Create a new academic program for students to enroll in.
                    </p>
                </div>

                <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-6 rounded-xl border border-purple-200 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-book text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">
                            <a href="{{ route('admin.courses.create') }}" class="hover:text-purple-600 transition-colors">Add Course</a>
                    </h3>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Create a new course for students to take.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>