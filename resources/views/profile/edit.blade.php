<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="bg-gradient-to-r from-blue-500 to-purple-500 p-3 rounded-xl">
                <i class="fas fa-user text-white text-xl"></i>
            </div>
            <div>
                <h2 class="font-bold text-2xl bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Profile Settings
                </h2>
                <p class="text-sm text-gray-600">Manage your account information and preferences</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Profile Header Card -->
            <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 rounded-2xl p-8 mb-8 text-white relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10 flex items-center space-x-6">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-3xl font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ Auth::user()->name }}</h1>
                        <p class="text-blue-100 text-lg capitalize">{{ Auth::user()->role->name ?? 'User' }}</p>
                        <p class="text-blue-200">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Profile Information Card -->
                    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 overflow-hidden hover:shadow-2xl transition-all duration-300">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 p-6">
                            <div class="flex items-center space-x-3">
                                <div class="bg-white/20 p-3 rounded-xl">
                                    <i class="fas fa-user-edit text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">Profile Information</h3>
                                    <p class="text-blue-100">Update your personal details</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Password Update Card -->
                    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 overflow-hidden hover:shadow-2xl transition-all duration-300">
                        <div class="bg-gradient-to-r from-green-500 to-teal-500 p-6">
                            <div class="flex items-center space-x-3">
                                <div class="bg-white/20 p-3 rounded-xl">
                                    <i class="fas fa-lock text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">Security Settings</h3>
                                    <p class="text-green-100">Change your password</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Account Stats Card -->
                    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 p-6 hover:shadow-2xl transition-all duration-300">
                        <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-chart-line text-blue-500 mr-2"></i>
                            Account Overview
                        </h4>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Member since</span>
                                <span class="font-semibold text-gray-800">{{ Auth::user()->created_at->format('M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Last login</span>
                                <span class="font-semibold text-gray-800">Today</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Account status</span>
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Active</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Card -->
                    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 p-6 hover:shadow-2xl transition-all duration-300">
                        <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-bolt text-yellow-500 mr-2"></i>
                            Quick Actions
                        </h4>
                        <div class="space-y-3">
                            <a href="{{ route('dashboard') }}" class="flex items-center p-3 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl hover:from-blue-100 hover:to-purple-100 transition-all duration-200 group">
                                <i class="fas fa-tachometer-alt text-blue-500 mr-3 group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium text-gray-700">Go to Dashboard</span>
                            </a>
                            <a href="#" class="flex items-center p-3 bg-gradient-to-r from-green-50 to-teal-50 rounded-xl hover:from-green-100 hover:to-teal-100 transition-all duration-200 group">
                                <i class="fas fa-cog text-green-500 mr-3 group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium text-gray-700">Preferences</span>
                            </a>
                            <a href="#" class="flex items-center p-3 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl hover:from-purple-100 hover:to-pink-100 transition-all duration-200 group">
                                <i class="fas fa-question-circle text-purple-500 mr-3 group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium text-gray-700">Help & Support</span>
                            </a>
                        </div>
                    </div>

                    <!-- Danger Zone Card -->
                    <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-red-200 overflow-hidden hover:shadow-2xl transition-all duration-300">
                        <div class="bg-gradient-to-r from-red-500 to-pink-500 p-6">
                            <div class="flex items-center space-x-3">
                                <div class="bg-white/20 p-3 rounded-xl">
                                    <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">Danger Zone</h3>
                                    <p class="text-red-100">Irreversible actions</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>
</x-app-layout>
