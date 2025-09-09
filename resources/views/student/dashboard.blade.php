<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        {{ __('Student Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-purple-600 via-purple-700 to-purple-800 overflow-hidden shadow-2xl sm:rounded-2xl mb-8 border border-purple-500">
            <div class="p-6 lg:p-8 bg-gradient-to-r from-purple-600/90 to-purple-800/90 backdrop-blur-sm">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <h1 class="ml-4 text-2xl font-bold text-white">
                        Welcome back, {{ auth()->user()->name }}! 🎓
                    </h1>
                </div>

                <p class="mt-4 text-purple-100 leading-relaxed">
                    Ready to continue your learning journey with our comprehensive educational platform.
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
                                    Enrolled Courses
                                </dt>
                                <dd class="text-2xl font-bold text-white">
                                    {{ auth()->user()->enrolledCourses->count() ?? 0 }}
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
                            <i class="fas fa-clipboard-list text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-orange-100 truncate">
                                    Pending Assignments
                                </dt>
                                <dd class="text-2xl font-bold text-white">
                                    {{ (auth()->user()->pendingAssignments ?? collect())->count() }}
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
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-green-100 truncate">
                                    Submitted Assignments
                                </dt>
                                <dd class="text-2xl font-bold text-white">
                                    {{ (auth()->user()->submittedAssignments ?? collect())->count() }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-pink-500 to-pink-600 overflow-hidden shadow-2xl sm:rounded-2xl border border-pink-400">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-chart-line text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-pink-100 truncate">
                                    Average Grade
                                </dt>
                                <dd class="text-2xl font-bold text-white">
                                    @if(auth()->user()->averageGrade)
                                        {{ number_format(auth()->user()->averageGrade, 1) }}%
                                    @else
                                        --
                                    @endif
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
                        <p class="text-gray-600">Stay on top of your upcoming tasks</p>
                    </div>
                    <a href="{{ route('student.assignments.index') }}"
                        class="mt-4 sm:mt-0 inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fas fa-eye mr-2"></i>
                        View All
                    </a>
                </div>

                @if((auth()->user()->pendingAssignments ?? collect())->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach((auth()->user()->pendingAssignments ?? collect())->take(6) as $assignment)
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
                                            <i class="fas fa-exclamation-circle mr-1"></i>Overdue
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
                                            <i class="fas fa-star mr-2 text-yellow-500"></i>
                                            <span>{{ $assignment->total_marks }} marks</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex space-x-3">
                                    <a href="{{ route('student.assignments.show', $assignment) }}"
                                        class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium text-center transition-all duration-200 transform hover:scale-105">
                                        <i class="fas fa-eye mr-2"></i>
                                        View
                                    </a>
                                    @if(!$assignment->studentSubmission)
                                        <a href="{{ route('student.assignments.submit', $assignment) }}"
                                            class="flex-1 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium text-center transition-all duration-200 transform hover:scale-105">
                                            <i class="fas fa-upload mr-2"></i>
                                            Submit
                                        </a>
                                    @else
                                        <div class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium text-center">
                                            <i class="fas fa-check-circle mr-2"></i>
                                            Submitted
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-dashed border-blue-200 rounded-2xl p-12 text-center">
                        <div class="w-20 h-20 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-check-circle text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">All Caught Up! 🎉</h3>
                        <p class="text-gray-600 mb-6 text-lg">Excellent work! You've completed all your assignments.</p>
                        <a href="{{ route('student.assignments.index') }}"
                            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-lg rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-list-check mr-3"></i>
                            View All Assignments
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Grades -->
        @if((auth()->user()->recentGrades ?? collect())->count() > 0)
        <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200 mb-8">
            <div class="p-6 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">
                            <i class="fas fa-chart-line text-green-600 mr-3"></i>
                            Recent Grades
                        </h3>
                        <p class="text-gray-600">Track your academic performance</p>
                    </div>
                    <a href="{{ route('student.grades.index') }}"
                        class="mt-4 sm:mt-0 inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-teal-600 text-white font-semibold rounded-xl hover:from-green-700 hover:to-teal-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fas fa-eye mr-2"></i>
                        View All
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach((auth()->user()->recentGrades ?? collect())->take(6) as $grade)
                        <div class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-xl border border-gray-200 shadow-lg">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex-1">
                                    <h4 class="font-bold text-lg text-gray-900 mb-2 line-clamp-2">{{ $grade->assignment->title }}</h4>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-book mr-2 text-blue-500"></i>
                                        <span class="truncate">{{ $grade->assignment->course->name }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-r from-green-50 to-green-100 p-4 rounded-lg mb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-700">Score</span>
                                    <span class="text-lg font-bold text-green-600">{{ $grade->marks }}/{{ $grade->assignment->total_marks }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Percentage</span>
                                    <span class="text-lg font-bold text-green-600">{{ number_format(($grade->marks / $grade->assignment->total_marks) * 100, 1) }}%</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center text-sm text-gray-600">
                                <span>Graded: {{ $grade->graded_at ? \Carbon\Carbon::parse($grade->graded_at)->format('M d, Y') : 'N/A' }}</span>
                            </div>

                            @if($grade->feedback)
                                <div class="mt-4 p-3 bg-blue-50 border-l-4 border-blue-400 rounded">
                                    <div class="flex">
                                        <i class="fas fa-comment text-blue-400 mr-2 mt-1"></i>
                                        <div>
                                            <p class="text-sm font-medium text-blue-800">Feedback</p>
                                            <p class="text-sm text-blue-700">{{ Str::limit($grade->feedback, 100) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

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
                <p class="mt-2 text-gray-600">Access your most frequently used features</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-6 rounded-xl border border-blue-200 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-book-open text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">
                            <a href="{{ route('student.courses.index') }}" class="hover:text-blue-600 transition-colors">My Courses</a>
                        </h3>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        View enrolled courses and materials.
                    </p>
                </div>

                <div class="bg-gradient-to-r from-orange-50 to-orange-100 p-6 rounded-xl border border-orange-200 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clipboard-list text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">
                            <a href="{{ route('student.assignments.index') }}" class="hover:text-orange-600 transition-colors">Assignments</a>
                        </h3>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Manage your tasks and submissions.
                    </p>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-green-100 p-6 rounded-xl border border-green-200 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">
                            <a href="{{ route('student.grades.index') }}" class="hover:text-green-600 transition-colors">My Grades</a>
                        </h3>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        View performance and feedback.
                    </p>
                </div>

                <div class="bg-gradient-to-r from-purple-50 to-purple-100 p-6 rounded-xl border border-purple-200 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <h3 class="ml-3 text-lg font-semibold text-gray-900">
                            <a href="{{ route('student.profile.edit') }}" class="hover:text-purple-600 transition-colors">My Profile</a>
                        </h3>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Update your information.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>