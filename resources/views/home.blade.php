<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greenfield International School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#10B981',
                        accent: '#f59e0b',
                        dark: '#1F2937',
                        light: '#F9FAFB'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/01 (4).jpeg');
            background-size: cover;
            background-position: center;
        }

        .stat-card {
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .class-card {
            transition: all 0.3s ease;
        }

        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .teacher-card {
            transition: transform 0.3s ease;
        }

        .teacher-card:hover {
            transform: translateY(-5px);
        }

        .gallery-item {
            overflow: hidden;
            border-radius: 8px;
        }

        .gallery-item img {
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .testimonial-card {
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            transition: background-color 0.3s ease;
        }

        .navbar.scrolled {
            background-color: rgba(31, 41, 55, 0.95); /* dark */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .hero-content {
                text-align: center;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="navbar fixed w-full z-50 py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-primary p-2 rounded-lg">
                    <!-- <i class="fas fa-graduation-cap text-white text-2xl"></i> -->
                    <img src="{{ asset('images/01 (51).jpeg') }}" alt="School Logo" class="w-10 h-10">
                </div>
                <span class="text-xl font-bold ml-2 text-white">Greenfield International</span>
            </div>

            <div class="hidden md:flex space-x-8">
                <a href="#home" class="text-white hover:text-accent font-medium">Home</a>
                <a href="#about" class="text-white hover:text-accent font-medium">About</a>
                <a href="#academics" class="text-white hover:text-accent font-medium">Academics</a>
                <a href="#admissions" class="text-white hover:text-accent font-medium">Admissions</a>
                <a href="#contact" class="text-white hover:text-accent font-medium">Contact</a>
                <a href="frontend/payments" class="text-white hover:text-accent font-medium">Payment</a>
            </div>

            <div>
                <a href="#" class="bg-white text-primary px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition duration-300">Portal Login</a>
            </div>
        </div>
    </nav>

    @include('frontend.components.hero')
    @include('frontend.components.slider')
    @include('frontend.components.counter')
    @include('frontend.components.about')
    @include('frontend.components.academic_program')
    @include('frontend.components.admission_process')
    @include('frontend.components.testimonials')
    @include('frontend.components.gallery')
    @include('frontend.components.contact')

    <!-- Footer -->
    <footer class="bg-dark text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="bg-primary p-2 rounded-lg">
                        <!-- <i class="fas fa-graduation-cap text-white text-2xl"></i> -->
                        
                        <img src="{{ asset('images/01 (51).jpeg') }}" alt="School Logo" class="w-10 h-10">
                        </div>
                        <span class="text-xl font-bold ml-2">Greenfield International</span>
                    </div>
                    <p class="text-gray-400 mb-4">Providing quality education since 1995. Shaping future leaders through innovative teaching and learning.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#academics" class="text-gray-400 hover:text-white">Academics</a></li>
                        <li><a href="#admissions" class="text-gray-400 hover:text-white">Admissions</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">Programs</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Early Learning</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Elementary School</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Middle School</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Sports</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Arts & Music</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">Newsletter</h3>
                    <p class="text-gray-400 mb-4">Subscribe to our newsletter to receive updates about school events and news.</p>
                    <form>
                        <div class="flex">
                            <input type="email" placeholder="Your email" class="px-4 py-2 w-full rounded-l-lg focus:outline-none text-dark">
                            <button type="submit" class="bg-primary hover:bg-blue-700 px-4 py-2 rounded-r-lg"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2023 Greenfield International School. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
                navbar.classList.remove('bg-transparent');
            } else {
                navbar.classList.remove('scrolled');
                navbar.classList.add('bg-transparent');
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>
