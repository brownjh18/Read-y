<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'School Portal') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-blue-50 via-white to-green-50 min-h-screen">
    <!-- Modern Navbar Header -->
    <nav class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 shadow-xl border-b border-blue-700">
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo/Brand -->
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">School Portal</h1>
                        <p class="text-blue-200 text-xs font-medium">Management System</p>
                    </div>
                </div>

                <!-- Page Title -->
                <div class="hidden md:block flex-1 text-center">
                    <h2 class="text-lg font-semibold text-white">
                        @yield('header', 'Dashboard')
                    </h2>
                </div>

                <!-- User Menu & Notifications -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <button class="relative p-3 text-blue-200 hover:text-white hover:bg-blue-700 rounded-xl transition-all duration-200 shadow-lg">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute -top-1 -right-1 h-5 w-5 bg-orange-500 text-white text-xs rounded-full flex items-center justify-center font-bold shadow-lg">3</span>
                    </button>

                    <!-- User Profile -->
                    <div class="flex items-center space-x-3">
                        <div class="hidden md:block text-right">
                            <p class="text-white font-semibold text-sm">{{ Auth::user()->name }}</p>
                            <p class="text-blue-200 text-xs capitalize">{{ Auth::user()->role->name ?? 'User' }}</p>
                        </div>
                        <div class="relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=fff&background=4f46e5&size=40"
                                 alt="Profile"
                                 class="w-10 h-10 rounded-full border-2 border-white shadow-lg">
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-blue-900 rounded-full"></div>
                        </div>
                    </div>

                    <!-- User Dropdown -->
                    <x-dropdown align="right" width="64">
                        <x-slot name="trigger">
                            <button class="p-2 text-blue-200 hover:text-white hover:bg-blue-700 rounded-lg transition-all duration-200">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="p-3 bg-white rounded-xl shadow-xl border border-gray-200">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                    <p class="text-xs text-gray-400 mt-1 capitalize">{{ Auth::user()->role->name ?? 'User' }}</p>
                                </div>
                                <div class="py-2">
                                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
                                        <i class="fas fa-user mr-3 text-gray-500"></i>
                                        Profile Settings
                                    </x-dropdown-link>

                                    <x-dropdown-link href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
                                        <i class="fas fa-cog mr-3 text-gray-500"></i>
                                        Preferences
                                    </x-dropdown-link>

                                    <hr class="my-2 border-gray-200">

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault(); this.closest('form').submit();"
                                                class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg">
                                            <i class="fas fa-sign-out-alt mr-3"></i>
                                            Log Out
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="flex w-80 flex-col">
            <div class="flex flex-col flex-grow bg-gradient-to-b from-blue-900 via-blue-800 to-blue-900 shadow-xl overflow-y-auto">
                <!-- Sidebar Header -->
                <div class="flex items-center justify-center h-20 px-6 bg-gradient-to-r from-blue-800 to-blue-900 border-b border-blue-700">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-graduation-cap text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-white font-bold text-lg">School Portal</h1>
                            <p class="text-blue-200 text-xs font-semibold">{{ Auth::user()->role->name ?? 'User' }} Portal</p>
                        </div>
                    </div>
                </div>

                <!-- Profile Preview -->
                <div class="p-6 border-b border-blue-700">
                    <div class="bg-gradient-to-r from-blue-800 to-blue-900 rounded-2xl p-4 border border-blue-700 shadow-lg">
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=fff&background=4f46e5&size=64"
                                     alt="Profile"
                                     class="w-16 h-16 rounded-full border-2 border-white shadow-lg">
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 border-3 border-blue-900 rounded-full animate-pulse"></div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-white font-semibold text-lg">{{ Auth::user()->name }}</h3>
                                <p class="text-blue-200 text-sm capitalize font-medium">{{ Auth::user()->role->name ?? 'User' }}</p>
                                <p class="text-blue-300 text-xs">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-3 text-center border border-green-400 shadow-lg">
                                <div class="text-white font-bold text-lg">
                                    @if(Auth::user()->isStudent())
                                        {{ auth()->user()->enrolledCourses->count() ?? 0 }}
                                    @elseif(Auth::user()->isTeacher())
                                        {{ auth()->user()->assignedCourses->count() }}
                                    @else
                                        {{ $userCount ?? 0 }}
                                    @endif
                                </div>
                                <div class="text-green-100 text-xs font-medium">
                                    @if(Auth::user()->isStudent())
                                        Courses
                                    @elseif(Auth::user()->isTeacher())
                                        Teaching
                                    @else
                                        Users
                                    @endif
                                </div>
                            </div>
                            <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg p-3 text-center border border-orange-400 shadow-lg">
                                <div class="text-white font-bold text-lg">
                                    @if(Auth::user()->isStudent())
                                        {{ (auth()->user()->pendingAssignments ?? collect())->count() }}
                                    @elseif(Auth::user()->isTeacher())
                                        {{ auth()->user()->assignments->count() }}
                                    @else
                                        {{ $departmentCount ?? 0 }}
                                    @endif
                                </div>
                                <div class="text-orange-100 text-xs font-medium">
                                    @if(Auth::user()->isStudent())
                                        Pending
                                    @elseif(Auth::user()->isTeacher())
                                        Assignments
                                    @else
                                        Depts
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white border-l-4 border-orange-500 shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                        <i class="fas fa-tachometer-alt mr-3 text-blue-300"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    @if(Auth::user()->isAdmin())
                        <!-- User Management -->
                        <div class="space-y-1">
                            <div class="px-4 py-2 text-blue-200 text-xs font-semibold uppercase tracking-wide">User Management</div>
                            <a href="{{ route('admin.users.index') }}" class="sidebar-nav-link {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-users mr-3"></i>
                                <span>Manage Users</span>
                            </a>
                            <a href="{{ route('admin.roles.index') }}" class="sidebar-nav-link {{ request()->routeIs('admin.roles.*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-user-tag mr-3"></i>
                                <span>Manage Roles</span>
                            </a>
                        </div>

                        <!-- Academic Management -->
                        <div class="space-y-1">
                            <div class="px-4 py-2 text-blue-200 text-xs font-semibold uppercase tracking-wide">Academic Management</div>
                            <a href="{{ route('admin.departments.index') }}" class="sidebar-nav-link {{ request()->routeIs('admin.departments.*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-building mr-3"></i>
                                <span>Departments</span>
                            </a>
                            <a href="{{ route('admin.programs.index') }}" class="sidebar-nav-link {{ request()->routeIs('admin.programs.*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-graduation-cap mr-3"></i>
                                <span>Programs</span>
                            </a>
                            <a href="{{ route('admin.courses.index') }}" class="sidebar-nav-link {{ request()->routeIs('admin.courses.*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-book mr-3"></i>
                                <span>Courses</span>
                            </a>
                            <a href="{{ route('admin.course-assignments.index') }}" class="sidebar-nav-link {{ request()->routeIs('admin.course-assignments.*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-link mr-3"></i>
                                <span>Assignments</span>
                            </a>
                        </div>

                        <!-- Reports & Analytics -->
                        <div class="space-y-1">
                            <div class="px-4 py-2 text-blue-200 text-xs font-semibold uppercase tracking-wide">Reports & Analytics</div>
                            <a href="{{ route('admin.reports.users') }}" class="sidebar-nav-link {{ request()->routeIs('admin.reports.users') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-users mr-3"></i>
                                <span>User Reports</span>
                            </a>
                            <a href="{{ route('admin.reports.academic') }}" class="sidebar-nav-link {{ request()->routeIs('admin.reports.academic') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-graduation-cap mr-3"></i>
                                <span>Academic Reports</span>
                            </a>
                        </div>

                        <!-- System Settings -->
                        <div class="space-y-1">
                            <div class="px-4 py-2 text-blue-200 text-xs font-semibold uppercase tracking-wide">System Settings</div>
                            <a href="#" class="sidebar-nav-link text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white">
                                <i class="fas fa-sliders-h mr-3"></i>
                                <span>General Settings</span>
                            </a>
                            <a href="#" class="sidebar-nav-link text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white">
                                <i class="fas fa-envelope mr-3"></i>
                                <span>Email Settings</span>
                            </a>
                        </div>

                    @elseif(Auth::user()->isTeacher())
                        <!-- Teacher Menu -->
                        <div class="space-y-1">
                            <div class="px-4 py-2 text-blue-200 text-xs font-semibold uppercase tracking-wide">Teaching</div>
                            <a href="{{ route('teacher.courses.index') }}" class="sidebar-nav-link {{ request()->routeIs('teacher.courses.*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-chalkboard-teacher mr-3"></i>
                                <span>My Courses</span>
                            </a>
                            <a href="{{ route('teacher.assignments.index') }}" class="sidebar-nav-link {{ request()->routeIs('teacher.assignments.*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-tasks mr-3"></i>
                                <span>Assignments</span>
                            </a>
                            <a href="{{ route('teacher.submissions.index') }}" class="sidebar-nav-link {{ request()->routeIs('teacher.submissions.*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-file-alt mr-3"></i>
                                <span>Submissions</span>
                            </a>
                        </div>

                    @elseif(Auth::user()->isStudent())
                        <!-- Student Menu -->
                        <div class="space-y-1">
                            <div class="px-4 py-2 text-blue-200 text-xs font-semibold uppercase tracking-wide">Learning</div>
                            <a href="{{ route('student.courses.index') }}" class="sidebar-nav-link {{ request()->routeIs('student.courses.*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-book-open mr-3"></i>
                                <span>My Courses</span>
                            </a>
                            <a href="{{ route('student.assignments.index') }}" class="sidebar-nav-link {{ request()->routeIs('student.assignments.*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-clipboard-list mr-3"></i>
                                <span>Assignments</span>
                            </a>
                            <a href="{{ route('student.grades.index') }}" class="sidebar-nav-link {{ request()->routeIs('student.grades.*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white' }}">
                                <i class="fas fa-chart-line mr-3"></i>
                                <span>My Grades</span>
                            </a>
                        </div>
                    @endif

                    <!-- Quick Actions -->
                    <div class="space-y-1">
                        <div class="px-4 py-2 text-blue-200 text-xs font-semibold uppercase tracking-wide">Quick Actions</div>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.users.create') }}" class="sidebar-nav-link text-blue-200 hover:bg-gradient-to-r hover:from-green-500 hover:to-green-600 hover:text-white">
                                <i class="fas fa-user-plus mr-3"></i>
                                <span>Add User</span>
                            </a>
                        @elseif(Auth::user()->isTeacher())
                            <a href="{{ route('teacher.assignments.create') }}" class="sidebar-nav-link text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white">
                                <i class="fas fa-plus-circle mr-3"></i>
                                <span>New Assignment</span>
                            </a>
                        @elseif(Auth::user()->isStudent())
                            <a href="{{ route('student.assignments.index') }}" class="sidebar-nav-link text-blue-200 hover:bg-gradient-to-r hover:from-blue-700 hover:to-blue-800 hover:text-white">
                                <i class="fas fa-upload mr-3"></i>
                                <span>Submit Work</span>
                            </a>
                        @endif
                    </div>
                </nav>

                <!-- Sidebar Footer -->
                <div class="p-4 border-t border-blue-700">
                    <div class="bg-gradient-to-r from-blue-800 to-blue-900 rounded-lg p-3 border border-blue-700 shadow-lg">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-blue-200 font-medium">System Status</span>
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                <span class="text-green-400 font-semibold">Online</span>
                            </div>
                        </div>
                        <div class="mt-2 text-xs text-blue-300">
                            Last updated: <span class="text-white font-medium">{{ now()->format('M d, H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 ml-80">
            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gradient-to-br from-blue-50 via-white to-green-50">
                <div class="p-6">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Modern Footer - Full Width -->
    <footer class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 shadow-xl border-t border-blue-700">
        <div class="max-w-full mx-auto px-6 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-sm text-blue-200 mb-2 md:mb-0">
                    © 2024 School Portal. All rights reserved.
                </div>
                <div class="flex space-x-6 text-sm">
                    <a href="#" class="text-blue-200 hover:text-white transition-colors duration-200">Privacy Policy</a>
                    <a href="#" class="text-blue-200 hover:text-white transition-colors duration-200">Terms of Service</a>
                    <a href="#" class="text-blue-200 hover:text-white transition-colors duration-200">Contact</a>
                </div>
            </div>
        </div>
    </footer>


    <style>
    .sidebar-nav-link {
        @apply flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .animate-fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    .animate-bounce-in {
        animation: bounceIn 0.6s ease-out;
    }

    .animate-slide-up {
        animation: slideUp 0.5s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes bounceIn {
        0% { opacity: 0; transform: scale(0.3); }
        50% { opacity: 1; transform: scale(1.05); }
        70% { transform: scale(0.9); }
        100% { opacity: 1; transform: scale(1); }
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    </style>

</body>
</html>