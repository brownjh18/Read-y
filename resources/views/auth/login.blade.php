<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - Read-y School Portal</title>

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
            min-height: 600px;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="login-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23login-pattern)"/></svg>');
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

        .form-group {
            margin-bottom: 20px;
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

        .error-message {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .checkbox-input {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            accent-color: #667eea;
        }

        .checkbox-label {
            color: #666;
            font-size: 0.9rem;
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
            <h1>Welcome Back!</h1>
            <p>Continue your learning journey with our comprehensive school management system. Access your courses, assignments, and academic resources all in one place.</p>
        </div>

        <!-- Right Side - Login Form -->
        <div class="auth-right">
            <div class="auth-header">
                <h2>Sign In</h2>
                <p>Enter your credentials to access your account</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success mb-4" style="background: #d4edda; color: #155724; padding: 12px; border-radius: 8px; border: 1px solid #c3e6cb;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                           type="email" name="email" value="{{ old('email') }}"
                           required autofocus autocomplete="username" placeholder="Enter your email">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-input {{ $errors->has('password') ? 'error' : '' }}"
                           type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="checkbox-group">
                    <input id="remember_me" type="checkbox" class="checkbox-input" name="remember">
                    <label for="remember_me" class="checkbox-label">Remember me</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary-custom">
                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                </button>

                <!-- Auth Links -->
                <div class="auth-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot your password?</a>
                    @endif
                    <br>
                    <span style="color: #666;">Don't have an account? </span>
                    <a href="{{ route('register') }}">Create one here</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
