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
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80');
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
            background-color: rgba(255, 255, 255, 0.95);
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
                    <i class="fas fa-graduation-cap text-white text-2xl"></i>
                </div>
                <span class="text-xl font-bold ml-2 text-white">Greenfield International</span>
            </div>

            <div class="hidden md:flex space-x-8">
                <a href="#home" class="text-white hover:text-accent font-medium">Home</a>
                <a href="#about" class="text-white hover:text-accent font-medium">About</a>
                <a href="#academics" class="text-white hover:text-accent font-medium">Academics</a>
                <a href="#admissions" class="text-white hover:text-accent font-medium">Admissions</a>
                <a href="#contact" class="text-white hover:text-accent font-medium">Contact</a>
            </div>

            <div>
                <a href="#" class="bg-white text-primary px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition duration-300">Portal Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero min-h-screen flex items-center pt-16">
        <div class="container mx-auto px-4">
            <div class="hero-content max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Shaping Future Leaders Through Quality Education</h1>
                <p class="text-xl text-gray-200 mb-8">Greenfield International School provides a nurturing environment where students excel academically, socially, and personally.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#admissions" class="bg-primary hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-center font-medium transition duration-300">Apply Now</a>
                    <a href="#about" class="bg-white hover:bg-gray-100 text-primary px-6 py-3 rounded-lg text-center font-medium transition duration-300">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="stats-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat-card bg-light rounded-lg p-6 text-center">
                    <div class="bg-primary p-3 rounded-full inline-flex">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-dark mt-4">1,200+</h3>
                    <p class="text-gray-600">Students</p>
                </div>
                <div class="stat-card bg-light rounded-lg p-6 text-center">
                    <div class="bg-secondary p-3 rounded-full inline-flex">
                        <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-dark mt-4">80+</h3>
                    <p class="text-gray-600">Qualified Teachers</p>
                </div>
                <div class="stat-card bg-light rounded-lg p-6 text-center">
                    <div class="bg-accent p-3 rounded-full inline-flex">
                        <i class="fas fa-book text-white text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-dark mt-4">12</h3>
                    <p class="text-gray-600">Academic Programs</p>
                </div>
                <div class="stat-card bg-light rounded-lg p-6 text-center">
                    <div class="bg-purple-600 p-3 rounded-full inline-flex">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-dark mt-4">98%</h3>
                    <p class="text-gray-600">Graduation Rate</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">About Our School</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Greenfield International School is committed to providing a world-class education that prepares students for success in a rapidly changing global community.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://images.unsplash.com/photo-1591123120675-6f7f1aae0e5b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80" alt="School Campus" class="rounded-lg shadow-lg">
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-dark mb-4">Our Mission & Vision</h3>
                    <p class="text-gray-600 mb-4">Our mission is to nurture young minds through a balanced approach to education that focuses on academic excellence, character development, and lifelong learning skills.</p>
                    <p class="text-gray-600 mb-6">We envision a community of empowered learners who are prepared to meet the challenges of the future with confidence, compassion, and critical thinking skills.</p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-start">
                            <div class="bg-primary p-2 rounded-full mr-3">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <p class="text-gray-600">Safe and inclusive learning environment</p>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary p-2 rounded-full mr-3">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <p class="text-gray-600">Modern facilities and technology</p>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary p-2 rounded-full mr-3">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <p class="text-gray-600">Experienced and dedicated faculty</p>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary p-2 rounded-full mr-3">
                                <i class="fas fa-check text-white"></i>
                            </div>
                            <p class="text-gray-600">Comprehensive extracurricular programs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Academics Section -->
    <section id="academics" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Academic Programs</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">We offer a comprehensive curriculum designed to meet the diverse needs and interests of our students.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="class-card bg-light rounded-lg overflow-hidden shadow">
                    <img src="https://images.unsplash.com/photo-1462536943532-57a629f6cc60?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1173&q=80" alt="Early Learning" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-dark mb-2">Early Learning (Play - KG-02)</h3>
                        <p class="text-gray-600 mb-4">Our early learning program focuses on developing social, emotional, and cognitive skills through play-based learning.</p>
                        <a href="#" class="text-primary font-medium hover:underline">Learn More</a>
                    </div>
                </div>

                <div class="class-card bg-light rounded-lg overflow-hidden shadow">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1172&q=80" alt="Elementary School" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-dark mb-2">Elementary (Class 01 - 05)</h3>
                        <p class="text-gray-600 mb-4">Our elementary program builds a strong foundation in core subjects while encouraging curiosity and creativity.</p>
                        <a href="#" class="text-primary font-medium hover:underline">Learn More</a>
                    </div>
                </div>

                <div class="class-card bg-light rounded-lg overflow-hidden shadow">
                    <img src="https://images.unsplash.com/photo-1591123120675-6f7f1aae0e5b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80" alt="Middle School" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-dark mb-2">Beyond Classroom</h3>
                        <p class="text-gray-600 mb-4">We offer a wide range of extracurricular activities including sports, arts, and technology clubs.</p>
                        <a href="#" class="text-primary font-medium hover:underline">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Admissions Section -->
    <section id="admissions" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Admissions Process</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Join our community of learners and leaders. Our admissions process is designed to be straightforward and transparent.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="bg-primary w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">1</span>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-2">Inquiry & Application</h3>
                    <p class="text-gray-600">Submit an online inquiry form and our admissions team will contact you to guide you through the process.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="bg-primary w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">2</span>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-2">School Tour & Assessment</h3>
                    <p class="text-gray-600">Visit our campus for a tour and assessment to determine the appropriate grade level for your child.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow text-center">
                    <div class="bg-primary w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">3</span>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-2">Enrollment</h3>
                    <p class="text-gray-600">Complete the enrollment process by submitting required documents and paying the registration fee.</p>
                </div>
            </div>

            <div class="text-center">
                <a href="#" class="bg-primary hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300">Start Application</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">What Parents Say</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Hear from our community of parents and guardians about their experience with Greenfield International School.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="testimonial-card bg-light p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Parent" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-bold text-dark">Sarah Johnson</h4>
                            <p class="text-gray-600">Parent of Class 3 Student</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"The teachers at Greenfield are exceptional. They've helped my daughter develop not just academically, but also as a confident and curious individual."</p>
                    <div class="flex mt-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                </div>

                <div class="testimonial-card bg-light p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Parent" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-bold text-dark">Michael Chen</h4>
                            <p class="text-gray-600">Parent of KG-2 Student</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"We chose Greenfield for its balanced approach to education. Our son loves going to school every day, and we've seen tremendous growth in his social skills."</p>
                    <div class="flex mt-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                </div>

                <div class="testimonial-card bg-light p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Parent" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-bold text-dark">Priya Sharma</h4>
                            <p class="text-gray-600">Parent of Class 5 Student</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"The facilities at Greenfield are outstanding. The sports program has helped my son develop teamwork skills while staying active and healthy."</p>
                    <div class="flex mt-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Contact Us</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">We'd love to hear from you. Reach out to us with any questions or to schedule a visit to our campus.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <form class="bg-white p-6 rounded-lg shadow">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 mb-2">Full Name</label>
                            <input type="text" id="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="phone" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 mb-2">Message</label>
                            <textarea id="message" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                        </div>
                        <button type="submit" class="bg-primary hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300 w-full">Send Message</button>
                    </form>
                </div>

                <div>
                    <div class="bg-white p-6 rounded-lg shadow mb-6">
                        <h3 class="text-xl font-bold text-dark mb-4">Contact Information</h3>
                        <div class="flex items-start mb-4">
                            <div class="bg-primary p-2 rounded-full mr-3">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium text-dark">Address</p>
                                <p class="text-gray-600">123 Education Street, Academic District, City 12345</p>
                            </div>
                        </div>
                        <div class="flex items-start mb-4">
                            <div class="bg-primary p-2 rounded-full mr-3">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium text-dark">Phone</p>
                                <p class="text-gray-600">(123) 456-7890</p>
                            </div>
                        </div>
                        <div class="flex items-start mb-4">
                            <div class="bg-primary p-2 rounded-full mr-3">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium text-dark">Email</p>
                                <p class="text-gray-600">info@greenfieldschool.edu</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-xl font-bold text-dark mb-4">School Hours</h3>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Monday - Friday</span>
                            <span class="font-medium">7:30 AM - 3:30 PM</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Saturday</span>
                            <span class="font-medium">8:00 AM - 12:00 PM</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sunday</span>
                            <span class="font-medium">Closed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="bg-primary p-2 rounded-lg">
                            <i class="fas fa-graduation-cap text-white text-2xl"></i>
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
