<nav x-data="{ open: false, notifications: false }" class="bg-white/95 backdrop-blur-lg shadow-lg border-b border-white/20 sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 group logo-container">
                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-1.5 rounded-md logo-icon transition-transform duration-200">
                            <i class="fas fa-graduation-cap text-white text-lg"></i>
                        </div>
                        <div class="hidden sm:block">
                            <h1 class="text-lg font-bold gradient-text">
                                Read-y Portal
                            </h1>
                            <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role->name ?? 'User' }}</p>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link-enhanced">
                        <i class="fas fa-tachometer-alt mr-2"></i>
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(Auth::user()->isAdmin())
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="nav-link-enhanced">
                            <i class="fas fa-users mr-2"></i>
                            Users
                        </x-nav-link>
                        <x-nav-link :href="route('admin.courses.index')" :active="request()->routeIs('admin.courses.*')" class="nav-link-enhanced">
                            <i class="fas fa-book mr-2"></i>
                            Courses
                        </x-nav-link>
                        <x-nav-link :href="route('admin.reports.users')" :active="request()->routeIs('admin.reports.*')" class="nav-link-enhanced">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Reports
                        </x-nav-link>
                    @elseif(Auth::user()->isTeacher())
                        <x-nav-link :href="route('teacher.courses.index')" :active="request()->routeIs('teacher.courses.*')" class="nav-link-enhanced">
                            <i class="fas fa-chalkboard-teacher mr-2"></i>
                            My Courses
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.assignments.index')" :active="request()->routeIs('teacher.assignments.*')" class="nav-link-enhanced">
                            <i class="fas fa-tasks mr-2"></i>
                            Assignments
                        </x-nav-link>
                        <x-nav-link :href="route('teacher.submissions.index')" :active="request()->routeIs('teacher.submissions.*')" class="nav-link-enhanced">
                            <i class="fas fa-file-alt mr-2"></i>
                            Submissions
                        </x-nav-link>
                    @elseif(Auth::user()->isStudent())
                        <x-nav-link :href="route('student.courses.index')" :active="request()->routeIs('student.courses.*')" class="nav-link-enhanced">
                            <i class="fas fa-book-open mr-2"></i>
                            My Courses
                        </x-nav-link>
                        <x-nav-link :href="route('student.assignments.index')" :active="request()->routeIs('student.assignments.*')" class="nav-link-enhanced">
                            <i class="fas fa-clipboard-list mr-2"></i>
                            Assignments
                        </x-nav-link>
                        <x-nav-link :href="route('student.grades.index')" :active="request()->routeIs('student.grades.*')" class="nav-link-enhanced">
                            <i class="fas fa-chart-line mr-2"></i>
                            Grades
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- User Menu & Notifications -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <!-- Notifications Bell -->
                <button @click="notifications = !notifications"
                        class="relative p-1.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-md transition-all duration-200 notification-bell">
                    <i class="fas fa-bell text-base"></i>
                    <span class="absolute -top-0.5 -right-0.5 h-3 w-3 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs rounded-full flex items-center justify-center animate-pulse">3</span>
                </button>

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-2 bg-gradient-to-r from-blue-50 to-purple-50 hover:from-blue-100 hover:to-purple-100 px-3 py-1.5 rounded-lg border border-white/50 shadow-sm hover:shadow-md transition-all duration-200 group user-dropdown-trigger">
                            <div class="relative">
                                <div class="w-7 h-7 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-semibold text-xs">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>
                            <div class="hidden md:block text-left">
                                <div class="text-sm font-semibold text-gray-900 group-hover:text-gray-700">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role->name ?? 'User' }}</div>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 group-hover:text-gray-600 transition-colors duration-200 text-xs"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-2">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                <p class="text-xs text-gray-400 mt-1 capitalize">{{ Auth::user()->role->name ?? 'User' }}</p>
                            </div>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                            <i class="fas fa-user mr-3 text-gray-400"></i>
                            {{ __('Profile Settings') }}
                        </x-dropdown-link>

                        <x-dropdown-link href="#" class="flex items-center">
                            <i class="fas fa-cog mr-3 text-gray-400"></i>
                            Preferences
                        </x-dropdown-link>

                        <hr class="my-2">

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="flex items-center text-red-600 hover:text-red-700">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center sm:hidden">
                <!-- Mobile Notifications -->
                <button class="relative p-1.5 mr-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-md transition-colors duration-200">
                    <i class="fas fa-bell text-base"></i>
                    <span class="absolute -top-0.5 -right-0.5 h-3 w-3 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                </button>

                <!-- Hamburger Menu -->
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-1.5 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-900 transition duration-200 ease-in-out">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2" class="sm:hidden bg-white/95 backdrop-blur-lg border-t border-white/20 shadow-lg" :class="{'block': open, 'hidden': !open}">

        <!-- Mobile User Info -->
        <div class="px-4 py-3 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-purple-50">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500 capitalize">{{ Auth::user()->role->name ?? 'User' }}</div>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Links -->
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="mobile-nav-link {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>

            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.users.index') }}" class="mobile-nav-link {{ request()->routeIs('admin.users.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                    <i class="fas fa-users mr-3"></i>
                    Users
                </a>
                <a href="{{ route('admin.courses.index') }}" class="mobile-nav-link {{ request()->routeIs('admin.courses.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                    <i class="fas fa-book mr-3"></i>
                    Courses
                </a>
                <a href="{{ route('admin.reports.users') }}" class="mobile-nav-link {{ request()->routeIs('admin.reports.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                    <i class="fas fa-chart-bar mr-3"></i>
                    Reports
                </a>
            @elseif(Auth::user()->isTeacher())
                <a href="{{ route('teacher.courses.index') }}" class="mobile-nav-link {{ request()->routeIs('teacher.courses.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                    <i class="fas fa-chalkboard-teacher mr-3"></i>
                    My Courses
                </a>
                <a href="{{ route('teacher.assignments.index') }}" class="mobile-nav-link {{ request()->routeIs('teacher.assignments.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                    <i class="fas fa-tasks mr-3"></i>
                    Assignments
                </a>
                <a href="{{ route('teacher.submissions.index') }}" class="mobile-nav-link {{ request()->routeIs('teacher.submissions.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                    <i class="fas fa-file-alt mr-3"></i>
                    Submissions
                </a>
            @elseif(Auth::user()->isStudent())
                <a href="{{ route('student.courses.index') }}" class="mobile-nav-link {{ request()->routeIs('student.courses.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                    <i class="fas fa-book-open mr-3"></i>
                    My Courses
                </a>
                <a href="{{ route('student.assignments.index') }}" class="mobile-nav-link {{ request()->routeIs('student.assignments.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                    <i class="fas fa-clipboard-list mr-3"></i>
                    Assignments
                </a>
                <a href="{{ route('student.grades.index') }}" class="mobile-nav-link {{ request()->routeIs('student.grades.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                    <i class="fas fa-chart-line mr-3"></i>
                    Grades
                </a>
            @endif
        </div>

        <!-- Mobile User Actions -->
        <div class="border-t border-gray-200 pt-4 pb-3">
            <div class="px-2 space-y-1">
                <a href="{{ route('profile.edit') }}" class="mobile-nav-link text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                    <i class="fas fa-user mr-3"></i>
                    Profile Settings
                </a>
                <a href="#" class="mobile-nav-link text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                    <i class="fas fa-cog mr-3"></i>
                    Preferences
                </a>
                <hr class="my-2 border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mobile-nav-link w-full text-left text-red-600 hover:text-red-700 hover:bg-red-50">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Notifications Panel -->
    <div x-show="notifications" @click.away="notifications = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-x-full" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform translate-x-full" class="fixed right-4 top-20 z-50 w-80 bg-white rounded-lg shadow-xl border border-gray-200 hidden" style="display: none;">
        <div class="p-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Notifications</h3>
        </div>
        <div class="max-h-96 overflow-y-auto">
            <div class="p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-tasks text-blue-600"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">New assignment submitted</p>
                        <p class="text-sm text-gray-500">John Doe submitted "Math Assignment 1"</p>
                        <p class="text-xs text-gray-400 mt-1">2 minutes ago</p>
                    </div>
                </div>
            </div>
            <div class="p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">Assignment graded</p>
                        <p class="text-sm text-gray-500">Your submission for "Physics Lab" has been graded</p>
                        <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                    </div>
                </div>
            </div>
            <div class="p-4 hover:bg-gray-50 cursor-pointer">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-yellow-600"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900">Upcoming deadline</p>
                        <p class="text-sm text-gray-500">"Chemistry Project" is due tomorrow</p>
                        <p class="text-xs text-gray-400 mt-1">3 hours ago</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 border-t border-gray-200">
            <a href="#" class="text-sm text-blue-600 hover:text-blue-800">View all notifications</a>
        </div>
    </div>
</nav>

<style>
.nav-link-enhanced {
    @apply px-4 py-2 rounded-lg font-medium transition-all duration-200 flex items-center relative overflow-hidden;
}

.nav-link-enhanced::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
    transition: left 0.5s;
}

.nav-link-enhanced:hover::before {
    left: 100%;
}

.nav-link-enhanced:hover {
    @apply bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 transform scale-105 shadow-lg;
}

.mobile-nav-link {
    @apply flex items-center px-4 py-3 text-base font-medium rounded-lg transition-all duration-200 relative;
}

.mobile-nav-link:hover {
    @apply bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700;
}

/* Enhanced notification bell animation */
@keyframes bell-ring {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(5deg); }
    75% { transform: rotate(-5deg); }
}

.notification-bell:hover {
    animation: bell-ring 0.5s ease-in-out;
}

/* Enhanced user dropdown */
.user-dropdown-trigger {
    position: relative;
    overflow: hidden;
}

.user-dropdown-trigger::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    transition: left 0.5s;
}

.user-dropdown-trigger:hover::before {
    left: 100%;
}

/* Logo animation */
.logo-container:hover .logo-icon {
    animation: logo-bounce 0.6s ease-in-out;
}

@keyframes logo-bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-5px); }
    60% { transform: translateY(-3px); }
}

/* Mobile menu enhancements */
.mobile-menu-enter {
    transform: translateX(100%);
    opacity: 0;
}

.mobile-menu-enter-active {
    transform: translateX(0);
    opacity: 1;
    transition: all 0.3s ease-out;
}

.mobile-menu-exit {
    transform: translateX(0);
    opacity: 1;
}

.mobile-menu-exit-active {
    transform: translateX(100%);
    opacity: 0;
    transition: all 0.3s ease-in;
}

/* Gradient text effects */
.gradient-text {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Enhanced focus states */
.nav-link-enhanced:focus,
.mobile-nav-link:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
}

/* Loading states */
.nav-loading {
    position: relative;
    pointer-events: none;
}

.nav-loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid transparent;
    border-top: 2px solid #667eea;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
</nav>
