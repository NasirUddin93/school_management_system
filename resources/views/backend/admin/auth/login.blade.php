
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - AutoElite</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#1e40af',
                        accent: '#f59e0b',
                        light: '#f3f4f6',
                        dark: '#1f2937'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .login-container:hover {
            box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.15);
        }
        .car-bg {
            background: url("{{ asset('images/Cars/Car_31.jpg') }}");
        }
        .input-field:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
        }
        .error-message {
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
        .error-message.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex flex-col md:flex-row w-full max-w-4xl mx-4">
        <!-- Left side - Login Form -->
        <div class="w-full md:w-1/2 bg-white p-8 rounded-l-lg login-container">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-primary">TTC Car</h1>
                <p class="text-gray-600">Premium Car Marketplace</p>
            </div>

            <h2 class="text-2xl font-bold mb-2 text-center">Admin Login</h2>
            <p class="text-gray-600 text-center mb-8">Access your administrator dashboard</p>

            <div id="errorMessage" class="error-message bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                Invalid email or password. Please try again.
            </div>

            <form action="{{ route('admin.login.submit') }}" method="POST" id="loginForm" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" class="w-full pl-10 pr-4 py-2 border rounded-lg input-field focus:border-primary" placeholder="admin@example.com" required>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" class="w-full pl-10 pr-4 py-2 border rounded-lg input-field focus:border-primary" placeholder="Enter your password" required>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>

                    <a href="#" class="text-sm text-primary hover:text-secondary">Forgot Password?</a>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-secondary text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                    Sign In
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="/" class="text-primary hover:text-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Home
                </a>
            </div>

            <div class="mt-8 border-t pt-6">
                <p class="text-center text-sm text-gray-600">
                    <i class="fas fa-shield-alt mr-2 text-primary"></i> Your admin data is securely encrypted
                </p>
            </div>
        </div>

        <!-- Right side - Image and Info -->
        <div class="w-full md:w-1/2 car-bg rounded-r-lg hidden md:block relative">
            <div class="absolute inset-0 bg-primary opacity-90 mix-blend-multiply"></div>
            <div class="relative z-10 flex flex-col justify-center h-full p-12 text-white">
                <h2 class="text-3xl font-bold mb-4">TTC Car Admin Portal</h2>
                <p class="text-lg mb-6">Manage your car inventory, orders, customers, and analytics from a single dashboard.</p>

                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 p-2 rounded-full mr-4">
                            <i class="fas fa-car text-xl"></i>
                        </div>
                        <p>Manage vehicle inventory</p>
                    </div>
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 p-2 rounded-full mr-4">
                            <i class="fas fa-chart-line text-xl"></i>
                        </div>
                        <p>View sales analytics</p>
                    </div>
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 p-2 rounded-full mr-4">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <p>Manage customer accounts</p>
                    </div>
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 p-2 rounded-full mr-4">
                            <i class="fas fa-cog text-xl"></i>
                        </div>
                        <p>Configure website settings</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const errorMessage = document.getElementById('errorMessage');

            // Simulate login process
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                // Simple validation
                if (!email || !password) {
                    showError('Please fill in all fields');
                    return;
                }

                // Email format validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    showError('Please enter a valid email address');
                    return;
                }

                // Simulate login process - in a real application, this would be an API call
                simulateLogin(email, password);
            });

            function simulateLogin(email, password) {
                // Show loading state
                const submitButton = loginForm.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Authenticating...';
                submitButton.disabled = true;

                // Simulate API call delay
                setTimeout(() => {
                    // For demo purposes, accept specific credentials
                    if (email === 'admin@autoelite.com' && password === 'admin123') {
                        // Successful login
                        window.location.href = 'dashboard.html'; // Redirect to dashboard
                    } else {
                        // Failed login
                        showError('Invalid email or password. Please try again.');
                        submitButton.textContent = originalText;
                        submitButton.disabled = false;
                    }
                }, 1500);
            }

            function showError(message) {
                errorMessage.textContent = message;
                errorMessage.classList.add('show');

                // Hide error after 5 seconds
                setTimeout(() => {
                    errorMessage.classList.remove('show');
                }, 5000);
            }
        });
    </script> --}}
</body>
</html>
