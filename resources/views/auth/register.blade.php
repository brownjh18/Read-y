<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register - Read-y School Portal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            min-height: 700px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .auth-left {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: white;
            position: relative;
        }

        .auth-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="register-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23register-pattern)"/></svg>');
            pointer-events: none;
        }

        .auth-left h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            z-index: 1;
            position: relative;
        }

        .auth-left p {
            font-size: 1.1rem;
            text-align: center;
            opacity: 0.9;
            line-height: 1.6;
            z-index: 1;
            position: relative;
        }

        .auth-right {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .auth-header p {
            color: #666;
            font-size: 0.95rem;
        }

        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1;
            margin-bottom: 20px;
        }

        .form-group.full-width {
            flex: none;
            width: 100%;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-input.error {
            border-color: #e74c3c;
        }

        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            cursor: pointer;
        }

        .form-select:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .role-description {
            font-size: 0.85rem;
            color: #666;
            margin-top: 5px;
            font-style: italic;
        }

        .btn-primary-custom {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .auth-links {
            text-align: center;
            margin-top: 20px;
        }

        .auth-links a {
            color: #667eea;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .auth-links a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .brand-logo {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 2;
        }

        .brand-logo a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }

        .brand-logo i {
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                margin: 20px;
                min-height: auto;
            }

            .auth-left {
                padding: 30px 20px;
                min-height: 300px;
            }

            .auth-left h1 {
                font-size: 2rem;
            }

            .auth-right {
                padding: 30px 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <!-- Brand Logo -->
    <div class="brand-logo">
        <a href="{{ route('welcome') }}">
            <i class="fas fa-graduation-cap"></i>
            Read-y Portal
        </a>
    </div>

    <div class="auth-container animate-fade-in">
        <!-- Left Side - Visual Content -->
        <div class="auth-left">
            <h1>Join Our Community</h1>
            <p>Start your educational journey today. Whether you're a student, teacher, or administrator, our platform provides everything you need to succeed in your academic endeavors.</p>
        </div>

        <!-- Right Side - Registration Form -->
        <div class="auth-right">
            <div class="auth-header">
                <h2>Create Account</h2>
                <p>Join thousands of users in our educational community</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <input id="name" class="form-input {{ $errors->has('name') ? 'error' : '' }}"
                           type="text" name="name" value="{{ old('name') }}"
                           required autofocus autocomplete="name" placeholder="Enter your full name">
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                           type="email" name="email" value="{{ old('email') }}"
                           required autocomplete="username" placeholder="Enter your email address">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Role Selection -->
                <div class="form-group">
                    <label for="role" class="form-label">Account Type</label>
                    <select id="role" name="role" class="form-select {{ $errors->has('role') ? 'error' : '' }}" required>
                        <option value="">Select your role</option>
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>🎓 Student</option>
                        <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>👨‍🏫 Teacher</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>🏢 Administrator</option>
                    </select>
                    @error('role')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <div class="role-description">
                        Choose the role that best describes your position in the school system.
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                           type="password" name="password" required autocomplete="new-password" placeholder="Create a strong password">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" class="form-input {{ $errors->has('password_confirmation') ? 'error' : '' }}"
                           type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
                    @error('password_confirmation')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary-custom">
                    <i class="fas fa-user-plus me-2"></i>Create Account
                </button>

                <!-- Auth Links -->
                <div class="auth-links">
                    <span style="color: #666;">Already have an account? </span>
                    <a href="{{ route('login') }}">Sign in here</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
