<header class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 20% 80%, rgba(255,255,255,0.3) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(255,255,255,0.3) 0%, transparent 50%), radial-gradient(circle at 40% 40%, rgba(255,255,255,0.2) 0%, transparent 50%);"></div>
    </div>

    <!-- Animated Background Shapes -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/10 rounded-full animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-white/5 rounded-full animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/5 rounded-full animate-pulse" style="animation-delay: 4s;"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="text-center">
            <!-- Icon -->
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl mb-8 animate-bounce">
                <i class="fas fa-graduation-cap text-3xl text-white"></i>
            </div>

            <!-- Title -->
            <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-fade-in">
                <span class="bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                    {{ $title ?? 'Welcome to Read-y Portal' }}
                </span>
            </h1>

            <!-- Subtitle -->
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto leading-relaxed animate-slide-up" style="animation-delay: 0.2s;">
                {{ $subtitle ?? 'Empowering education through innovative technology and seamless digital experiences' }}
            </p>

            <!-- Action Buttons -->
            @if(isset($showActions) && $showActions)
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-up" style="animation-delay: 0.4s;">
                @if(Auth::check())
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-bold text-lg rounded-xl hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Admin Dashboard
                        </a>
                    @elseif(Auth::user()->isTeacher())
                        <a href="{{ route('teacher.dashboard') }}" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-bold text-lg rounded-xl hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                            <i class="fas fa-chalkboard-teacher mr-3"></i>
                            Teacher Dashboard
                        </a>
                    @elseif(Auth::user()->isStudent())
                        <a href="{{ route('student.dashboard') }}" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-bold text-lg rounded-xl hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                            <i class="fas fa-user-graduate mr-3"></i>
                            Student Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-bold text-lg rounded-xl hover:bg-blue-50 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                        <i class="fas fa-sign-in-alt mr-3"></i>
                        Get Started
                    </a>
                @endif

                <a href="#features" class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-bold text-lg rounded-xl hover:bg-white/20 transition-all duration-300 transform hover:scale-105 border border-white/20">
                    <i class="fas fa-info-circle mr-3"></i>
                    Learn More
                </a>
            </div>
            @endif

            <!-- Stats or Additional Content -->
            @if(isset($showStats) && $showStats)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16 animate-slide-up" style="animation-delay: 0.6s;">
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">500+</div>
                    <div class="text-blue-100">Active Students</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">50+</div>
                    <div class="text-blue-100">Expert Teachers</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-white mb-2">100+</div>
                    <div class="text-blue-100">Courses Available</div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Bottom Wave -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" class="w-full h-auto">
            <path fill="#ffffff" d="M0,32L48,37.3C96,43,192,53,288,58.7C384,64,480,64,576,58.7C672,53,768,43,864,48C960,53,1056,75,1152,80C1248,85,1344,75,1392,69.3L1440,64L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
        </svg>
    </div>
</header>

<style>
/* Custom animations for header */
@keyframes fade-in {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slide-up {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}

.animate-fade-in {
    animation: fade-in 1s ease-out;
}

.animate-slide-up {
    animation: slide-up 1s ease-out;
}

.animate-bounce {
    animation: bounce 2s infinite;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    header .text-4xl {
        font-size: 2.5rem;
    }

    header .text-6xl {
        font-size: 3rem;
    }

    header .py-16 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    header .py-24 {
        padding-top: 4rem;
        padding-bottom: 4rem;
    }
}

/* Hover effects */
header a:hover {
    transform: translateY(-2px) scale(1.05);
}

header .backdrop-blur-sm:hover {
    backdrop-filter: blur(20px);
}
</style>