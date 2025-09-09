<footer class="bg-gradient-to-r from-gray-900 via-gray-800 to-black text-white">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- About Section -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                        School Portal
                    </h3>
                </div>
                <p class="text-gray-300 text-sm leading-relaxed">
                    Empowering education through innovative technology. Connecting students, teachers, and administrators in a seamless digital learning environment.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-lg flex items-center justify-center transition-all duration-200 transform hover:scale-110">
                        <i class="fab fa-facebook-f text-white"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 rounded-lg flex items-center justify-center transition-all duration-200 transform hover:scale-110">
                        <i class="fab fa-twitter text-white"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 rounded-lg flex items-center justify-center transition-all duration-200 transform hover:scale-110">
                        <i class="fab fa-instagram text-white"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 rounded-lg flex items-center justify-center transition-all duration-200 transform hover:scale-110">
                        <i class="fab fa-youtube text-white"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-white">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 text-sm">Dashboard</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 text-sm">Courses</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 text-sm">Assignments</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 text-sm">Grades</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 text-sm">Announcements</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-white">Support</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 text-sm">Help Center</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 text-sm">Contact Us</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 text-sm">FAQ</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 text-sm">System Status</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-blue-400 transition-colors duration-200 text-sm">Report Issue</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-white">Contact Info</h4>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-map-marker-alt text-white text-xs"></i>
                        </div>
                        <div>
                            <p class="text-gray-300 text-sm">123 Education Street</p>
                            <p class="text-gray-300 text-sm">Academic City, AC 12345</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-white text-xs"></i>
                        </div>
                        <p class="text-gray-300 text-sm">+1 (555) 123-4567</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-white text-xs"></i>
                        </div>
                        <p class="text-gray-300 text-sm">support@schoolportal.com</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter Signup -->
        <div class="bg-gradient-to-r from-blue-900/50 to-purple-900/50 rounded-2xl p-8 mb-8 border border-white/10">
            <div class="text-center max-w-2xl mx-auto">
                <h3 class="text-2xl font-bold text-white mb-4">Stay Updated</h3>
                <p class="text-gray-300 mb-6">Subscribe to our newsletter for the latest updates, announcements, and educational insights.</p>
                <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                    <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <button class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 shadow-lg">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-700 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-6 text-sm text-gray-400">
                    <p>&copy; {{ date('Y') }} School Portal. All rights reserved.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-blue-400 transition-colors duration-200">Privacy Policy</a>
                        <a href="#" class="hover:text-blue-400 transition-colors duration-200">Terms of Service</a>
                        <a href="#" class="hover:text-blue-400 transition-colors duration-200">Cookie Policy</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2 text-sm text-gray-400">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span>All systems operational</span>
                    </div>
                    <div class="text-sm text-gray-400">
                        Version 2.0.1
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>