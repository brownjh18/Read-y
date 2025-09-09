<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Read-y School Portal - Your Complete Educational Platform</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="50" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="30" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .btn-custom {
            background: #fff;
            color: #667eea;
            font-weight: bold;
            border-radius: 30px;
            padding: 12px 30px;
            transition: all 0.3s ease;
            border: 2px solid #fff;
            text-decoration: none;
            display: inline-block;
        }

        .btn-custom:hover {
            background: transparent;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .btn-outline-custom {
            background: transparent;
            color: #fff;
            font-weight: bold;
            border-radius: 30px;
            padding: 12px 30px;
            transition: all 0.3s ease;
            border: 2px solid #fff;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-custom:hover {
            background: #fff;
            color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .features {
            padding: 80px 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .features h2 {
            font-weight: bold;
            margin-bottom: 40px;
            color: #333;
        }

        .feature-box {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0px 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.8);
            position: relative;
            overflow: hidden;
        }

        .feature-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .feature-box:hover {
            transform: translateY(-15px);
            box-shadow: 0px 20px 40px rgba(0,0,0,0.15);
        }

        .feature-box h4 {
            color: #667eea;
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .feature-box p {
            color: #666;
            line-height: 1.6;
        }

        .about {
            padding: 80px 0;
            background: white;
        }

        .about h2 {
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
        }

        .about p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        .contact {
            padding: 80px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: relative;
        }

        .contact::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="contact-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23contact-pattern)"/></svg>');
            pointer-events: none;
        }

        .contact h2 {
            font-weight: bold;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .contact p {
            font-size: 1.1rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: #ecf0f1;
            padding: 30px 0;
            text-align: center;
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 5px 30px rgba(0,0,0,0.15);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #667eea !important;
        }

        .navbar-nav .nav-link {
            color: #333 !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #667eea !important;
        }

        .btn-navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-navbar:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .feature-box {
                margin-bottom: 30px;
            }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        .animate-slide-up {
            animation: slideUp 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-graduation-cap me-2"></i>
                Read-y School Portal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a href="{{ route('login') }}" class="btn btn-navbar">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero" id="home">
        <div class="container animate-fade-in">
            <h1>Welcome to Read-y School Portal</h1>
            <p class="mt-3">Your one-stop platform for learning, teaching, and managing school activities with modern technology and intuitive design.</p>
            <div class="mt-4">
                <a href="{{ route('login') }}" class="btn-custom me-3">Get Started</a>
                <a href="#features" class="btn-outline-custom">Learn More</a>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section class="features text-center" id="features">
        <div class="container">
            <h2 class="animate-slide-up">Why Choose Read-y?</h2>
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="feature-box animate-slide-up">
                        <div class="text-center mb-4">
                            <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                        </div>
                        <h4>🎓 For Students</h4>
                        <p>Access textbooks, notes, assignments, and performance reports anytime, anywhere. Track your progress and stay connected with your learning journey.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box animate-slide-up">
                        <div class="text-center mb-4">
                            <i class="fas fa-chalkboard-teacher fa-3x text-success"></i>
                        </div>
                        <h4>👩‍🏫 For Teachers</h4>
                        <p>Manage lectures, assignments, grading, and communicate effectively with students. Streamline your teaching workflow with powerful tools.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box animate-slide-up">
                        <div class="text-center mb-4">
                            <i class="fas fa-cog fa-3x text-warning"></i>
                        </div>
                        <h4>🏫 For Admins</h4>
                        <p>Handle subscriptions, payments, student management, and school-wide resources. Maintain complete control over your institution.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section class="about text-center" id="about">
        <div class="container">
            <h2>About Read-y</h2>
            <p class="mt-3 animate-slide-up">
                Read-y is designed to simplify education by integrating learning resources,
                communication, and management tools in one comprehensive portal. Our mission is to make
                education accessible, engaging, and efficient for everyone involved in the learning process.
                <br><br>
                Whether you're a student seeking knowledge, a teacher sharing wisdom, or an administrator
                managing operations, Read-y provides the perfect platform to achieve your educational goals.
            </p>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section class="contact text-center" id="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p class="mt-3">
                        <i class="fas fa-envelope me-2"></i>
                        Email: support@readyportal.com
                    </p>
                    <p>
                        <i class="fas fa-phone me-2"></i>
                        Phone: +256 760 255970
                    </p>
                    <p class="mt-4">
                        Have questions or need support? Our dedicated team is here to help you 24/7.
                        Reach out to us for any assistance with your educational journey.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Read-y School Portal</h5>
                    <p>Empowering education through technology and innovation.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; {{ date('Y') }} Read-y School Portal. All Rights Reserved.</p>
                    <p>Made with <i class="fas fa-heart text-danger"></i> for education</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation delays
        const featureBoxes = document.querySelectorAll('.feature-box');
        featureBoxes.forEach((box, index) => {
            box.style.animationDelay = `${index * 0.2}s`;
        });
    </script>

</body>
</html>
