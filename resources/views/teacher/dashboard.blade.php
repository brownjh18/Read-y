<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        {{ __('Teacher Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-green-600 via-green-700 to-green-800 overflow-hidden shadow-2xl sm:rounded-2xl mb-8 border border-green-500">
            <div class="p-6 lg:p-8 bg-gradient-to-r from-green-600/90 to-green-800/90 backdrop-blur-sm">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-chalkboard-teacher text-white text-xl"></i>
                    </div>
                    <h1 class="ml-4 text-2xl font-bold text-white">
                        Welcome back, {{ auth()->user()->name }}! 👨‍🏫
                    </h1>
                </div>

                <p class="mt-4 text-green-100 leading-relaxed">
                    Empower your students' learning journey with our comprehensive teaching tools.
                </p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 overflow-hidden shadow-2xl sm:rounded-2xl border border-blue-400">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-book-open text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-blue-100 truncate">
                                    My Courses
                                </dt>
                                <dd class="text-2xl font-bold text-white">
                                    {{ auth()->user()->assignedCourses->count() }}
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
                            <i class="fas fa-clipboard-list text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-green-100 truncate">
                                    Assignments Created
                                </dt>
                                <dd class="text-2xl font-bold text-white">
                                    {{ auth()->user()->assignments->count() }}
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
                            <i class="fas fa-file-alt text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-orange-100 truncate">
                                    Pending Grading
                                </dt>
                                <dd class="text-2xl font-bold text-white">
                                    {{ auth()->user()->assignments->flatMap->submissions->where('status', 'submitted')->count() }}
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
                            <i class="fas fa-users text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-purple-100 truncate">
                                    Total Students
                                </dt>
                                <dd class="text-2xl font-bold text-white">
                                    {{ auth()->user()->assignedCourses->flatMap->enrollments->unique('student_id')->count() }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Assignments -->
        <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200 mb-8">
            <div class="p-6 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">
                            <i class="fas fa-clipboard-list text-blue-600 mr-3"></i>
                            Recent Assignments
                        </h3>
                        <p class="text-gray-600">Track your created assignments and student progress</p>
                    </div>
                    <a href="{{ route('teacher.assignments.index') }}"
                        class="mt-4 sm:mt-0 inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fas fa-eye mr-2"></i>
                        View All
                    </a>
                </div>

                @if(auth()->user()->assignments->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach(auth()->user()->assignments->take(6) as $assignment)
                            <div class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-xl border border-gray-200 shadow-lg hover-lift animate-slide-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2">{{ $assignment->title }}</h4>
                                        <div class="flex items-center text-sm text-gray-600 mb-3">
                                            <i class="fas fa-book mr-2 text-blue-500"></i>
                                            <span class="truncate">{{ $assignment->course->name }}</span>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full ml-3 flex-shrink-0
                                        @if($assignment->due_date && \Carbon\Carbon::parse($assignment->due_date) > now())
                                            bg-green-100 text-green-800
                                        @elseif($assignment->due_date && \Carbon\Carbon::parse($assignment->due_date)->diffInDays(now()) <= 1)
                                            bg-yellow-100 text-yellow-800
                                        @else
                                            bg-red-100 text-red-800 @endif">
                                        @if($assignment->due_date && \Carbon\Carbon::parse($assignment->due_date) > now())
                                            <i class="fas fa-clock mr-1"></i>Active
                                        @elseif($assignment->due_date && \Carbon\Carbon::parse($assignment->due_date)->diffInDays(now()) <= 1)
                                            <i class="fas fa-exclamation-triangle mr-1"></i>Due Soon
                                        @else
                                            <i class="fas fa-times-circle mr-1"></i>Expired
                                        @endif
                                    </span>
                                </div>

                                <div class="space-y-3 mb-4">
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-calendar-alt mr-2 text-purple-500"></i>
                                            <span>Due: @if($assignment->due_date){{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y') }}@else N/A @endif</span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <i class="fas fa-users mr-2 text-green-500"></i>
                                            <span>{{ $assignment->submissions->count() }} submissions</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <i class="fas fa-star mr-2 text-yellow-500"></i>
                                        <span class="text-gray-600">{{ $assignment->total_marks }} marks</span>
                                    </div>
                                </div>

                                <div class="flex space-x-3">
                                    <a href="{{ route('teacher.assignments.show', $assignment) }}"
                                        class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium text-center transition-all duration-200 transform hover:scale-105">
                                        <i class="fas fa-eye mr-2"></i>
                                        View
                                    </a>
                                    <a href="{{ route('teacher.assignments.edit', $assignment) }}"
                                        class="flex-1 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium text-center transition-all duration-200 transform hover:scale-105">
                                        <i class="fas fa-edit mr-2"></i>
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-dashed border-blue-200 rounded-2xl p-12 text-center">
                        <div class="w-20 h-20 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-plus-circle text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Create Your First Assignment! 📝</h3>
                        <p class="text-gray-600 mb-6 text-lg">Start engaging your students with interactive assignments and track their progress.</p>
                        <a href="{{ route('teacher.assignments.create') }}"
                            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-lg rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-plus mr-3"></i>
                            Create Assignment
                        </a>
                    </div>
                @endif
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
                <p class="mt-2 text-gray-600">Access your most frequently used teaching tools</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-book-open text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">
                            <a href="{{ route('teacher.courses.index') }}" class="hover:text-blue-600 transition-colors">My Courses</a>
                        </h3>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Manage teaching load and course content.
                    </p>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-xl border border-green-200 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clipboard-list text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">
                            <a href="{{ route('teacher.assignments.index') }}" class="hover:text-green-600 transition-colors">Assignments</a>
                        </h3>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Track student tasks and submissions.
                    </p>
                </div>

                <div class="bg-gradient-to-r from-orange-50 to-orange-100 p-6 rounded-xl border border-orange-200 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-plus-circle text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">
                            <a href="{{ route('teacher.assignments.create') }}" class="hover:text-orange-600 transition-colors">Create Assignment</a>
                        </h3>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Add new tasks for your students.
                    </p>
                </div>

                <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-6 rounded-xl border border-purple-200 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">
                            <a href="{{ route('teacher.submissions.index') }}" class="hover:text-purple-600 transition-colors">Grade Submissions</a>
                        </h3>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Review and grade student work.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>