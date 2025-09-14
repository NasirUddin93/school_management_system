{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - School Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#10B981',
                        dark: '#1F2937',
                        light: '#F9FAFB'
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
            z-index: 50;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
        }
        .overlay.active {
            display: block;
        }
        .chart-container {
            position: relative;
            height: 250px;
        }
        .progress-bar {
            transition: width 1s ease-in-out;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                height: 100vh;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            .header-content {
                flex-direction: column;
                align-items: flex-start;
            }
            .search-box {
                width: 100%;
                margin-top: 1rem;
                margin-bottom: 1rem;
            }
        }
        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .action-buttons {
                flex-direction: column;
            }
            .action-buttons a {
                margin-bottom: 0.5rem;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Overlay for mobile when sidebar is open -->
        <div class="overlay" id="overlay"></div>

        <!-- Sidebar -->
        <div class="sidebar bg-white w-64 space-y-6 py-7 px-2 fixed inset-y-0 left-0 transform md:relative md:translate-x-0">
            <div class="flex justify-center items-center">
                <div class="bg-primary p-2 rounded-lg">
                    <i class="fas fa-graduation-cap text-white text-2xl"></i>
                </div>
                <span class="text-xl font-bold ml-2 text-dark">EduManage</span>
            </div>

            <!-- Student Profile Summary -->
            <div class="px-4 py-3 bg-gray-50 rounded-lg mx-2">
                <div class="flex items-center">
                    <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Student">
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-dark">Ali Ahmed</h3>
                        <p class="text-xs text-gray-500">Class 03 - Section A</p>
                        <p class="text-xs text-gray-500">Roll No: 001</p>
                    </div>
                </div>
            </div>

            <nav>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 bg-primary text-white flex items-center">
                    <i class="fas fa-home mr-2"></i>
                    Dashboard
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-user mr-2"></i>
                    My Profile
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-clipboard-check mr-2"></i>
                    Attendance
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Exam Results
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-book mr-2"></i>
                    Subjects
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Schedule
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-file-alt mr-2"></i>
                    Assignments
                </a>
                <form method="POST" action="{{ route('logout') }}" >
                        @csrf
                        <button type="submit" class="navigation-item block py-2.5 px-4 rounded transition duration-200 w-full text-left">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:ml-0">
            <!-- Header -->
            <header class="flex justify-between items-center p-4 bg-white shadow">
                <div class="flex items-center">
                    <button class="md:hidden ml-2 text-dark" id="menu-toggle">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-xl md:text-2xl font-bold text-dark ml-4">Student Dashboard</h1>
                </div>
                <div class="header-content flex flex-col md:flex-row md:items-center w-full md:w-auto">
                    <div class="search-box relative">
                        <input type="text" placeholder="Search..." class="bg-gray-100 rounded-full py-2 px-4 pl-10 w-full focus:outline-none focus:ring-2 focus:ring-primary">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-500"></i>
                    </div>
                    <div class="flex items-center ml-0 md:ml-4 mt-2 md:mt-0">
                        <div class="ml-4 relative">
                            <button class="bg-gray-100 rounded-full p-2">
                                <i class="fas fa-bell text-gray-600"></i>
                                <span class="absolute top-0 right-0 bg-secondary rounded-full h-4 w-4 text-xs text-white flex items-center justify-center">3</span>
                            </button>
                        </div>
                        <div class="ml-4 flex items-center">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="h-8 w-8 md:h-10 md:w-10 rounded-full">
                            <span class="ml-2 font-medium text-dark hidden md:block">Ali Ahmed</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Stats Overview -->
                <div class="stats-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-4 md:p-6 flex items-center">
                        <div class="bg-blue-100 p-3 md:p-4 rounded-full">
                            <i class="fas fa-clipboard-check text-primary text-xl md:text-2xl"></i>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h2 class="text-sm md:text-base text-gray-500">Attendance</h2>
                            <p class="text-xl md:text-2xl font-bold text-dark">92%</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 md:p-6 flex items-center">
                        <div class="bg-green-100 p-3 md:p-4 rounded-full">
                            <i class="fas fa-chart-line text-secondary text-xl md:text-2xl"></i>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h2 class="text-sm md:text-base text-gray-500">Overall Grade</h2>
                            <p class="text-xl md:text-2xl font-bold text-dark">A-</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 md:p-6 flex items-center">
                        <div class="bg-purple-100 p-3 md:p-4 rounded-full">
                            <i class="fas fa-book text-purple-600 text-xl md:text-2xl"></i>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h2 class="text-sm md:text-base text-gray-500">Subjects</h2>
                            <p class="text-xl md:text-2xl font-bold text-dark">6</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 md:p-6 flex items-center">
                        <div class="bg-yellow-100 p-3 md:p-4 rounded-full">
                            <i class="fas fa-tasks text-yellow-600 text-xl md:text-2xl"></i>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h2 class="text-sm md:text-base text-gray-500">Assignments Due</h2>
                            <p class="text-xl md:text-2xl font-bold text-dark">3</p>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6 mb-6">
                    <!-- Academic Performance -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow p-4 md:p-6">
                        <h2 class="text-lg font-bold text-dark mb-4">Academic Performance</h2>
                        <div class="chart-container">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-lg shadow p-4 md:p-6">
                        <h2 class="text-lg font-bold text-dark mb-4">Upcoming Events</h2>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <div class="bg-red-100 text-red-600 p-2 rounded-lg">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">Maths Test</p>
                                    <p class="text-xs text-gray-500">Tomorrow, 10:00 AM</p>
                                </div>
                            </li>
                            <li class="flex items-center">
                                <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">Science Project Submission</p>
                                    <p class="text-xs text-gray-500">June 15, 2023</p>
                                </div>
                            </li>
                            <li class="flex items-center">
                                <div class="bg-green-100 text-green-600 p-2 rounded-lg">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">Annual Day Rehearsal</p>
                                    <p class="text-xs text-gray-500">June 20, 2023</p>
                                </div>
                            </li>
                            <li class="flex items-center">
                                <div class="bg-purple-100 text-purple-600 p-2 rounded-lg">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">Parent-Teacher Meeting</p>
                                    <p class="text-xs text-gray-500">June 25, 2023</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Subjects and Recent Results -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
                    <!-- Subjects -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow">
                        <div class="p-4 md:p-6 border-b">
                            <h2 class="text-lg font-bold text-dark">My Subjects</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Schedule</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="bg-blue-100 p-2 rounded-lg">
                                                    <i class="fas fa-calculator text-blue-600"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">Mathematics</div>
                                                    <div class="text-xs text-gray-500">Mr. Ahmed</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Mr. Ahmed</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Mon, Wed, Fri</td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full progress-bar" style="width: 85%"></div>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">85%</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="bg-green-100 p-2 rounded-lg">
                                                    <i class="fas fa-flask text-green-600"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">Science</div>
                                                    <div class="text-xs text-gray-500">Ms. Fatima</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Ms. Fatima</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Tue, Thu</td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-green-600 h-2.5 rounded-full progress-bar" style="width: 72%"></div>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">72%</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="bg-red-100 p-2 rounded-lg">
                                                    <i class="fas fa-language text-red-600"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">English</div>
                                                    <div class="text-xs text-gray-500">Mr. Johnson</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Mr. Johnson</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Mon, Tue, Thu</td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-red-600 h-2.5 rounded-full progress-bar" style="width: 90%"></div>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">90%</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Quick Links & Recent Results -->
                    <div class="space-y-6">
                        <!-- Quick Links -->
                        <div class="bg-white rounded-lg shadow p-4 md:p-6">
                            <h2 class="text-lg font-bold text-dark mb-4">Quick Links</h2>
                            <div class="action-buttons grid grid-cols-2 gap-3 md:gap-4">
                                <a href="#" class="bg-primary hover:bg-indigo-700 text-white rounded-lg p-3 flex flex-col items-center justify-center transition duration-200 text-center">
                                    <i class="fas fa-tasks text-xl mb-2"></i>
                                    <span class="text-xs md:text-sm">Assignments</span>
                                </a>
                                <a href="#" class="bg-secondary hover:bg-emerald-600 text-white rounded-lg p-3 flex flex-col items-center justify-center transition duration-200 text-center">
                                    <i class="fas fa-book-open text-xl mb-2"></i>
                                    <span class="text-xs md:text-sm">Study Material</span>
                                </a>
                                <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg p-3 flex flex-col items-center justify-center transition duration-200 text-center">
                                    <i class="fas fa-chart-bar text-xl mb-2"></i>
                                    <span class="text-xs md:text-sm">Results</span>
                                </a>
                                <a href="#" class="bg-purple-600 hover:bg-purple-700 text-white rounded-lg p-3 flex flex-col items-center justify-center transition duration-200 text-center">
                                    <i class="fas fa-calendar-alt text-xl mb-2"></i>
                                    <span class="text-xs md:text-sm">Schedule</span>
                                </a>
                            </div>
                        </div>

                        <!-- Recent Results -->
                        <div class="bg-white rounded-lg shadow p-4 md:p-6">
                            <h2 class="text-lg font-bold text-dark mb-4">Recent Results</h2>
                            <ul class="space-y-3">
                                <li class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium">Mathematics Quiz</p>
                                        <p class="text-xs text-gray-500">June 10, 2023</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">18/20</span>
                                </li>
                                <li class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium">Science Test</p>
                                        <p class="text-xs text-gray-500">June 5, 2023</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">42/50</span>
                                </li>
                                <li class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium">English Assignment</p>
                                        <p class="text-xs text-gray-500">June 3, 2023</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">9/10</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle mobile menu
            $('#menu-toggle').click(function() {
                $('.sidebar').toggleClass('active');
                $('#overlay').toggleClass('active');
            });

            // Close sidebar when clicking overlay
            $('#overlay').click(function() {
                $('.sidebar').removeClass('active');
                $('#overlay').removeClass('active');
            });

            // Academic Performance Chart
            const ctx = document.getElementById('performanceChart').getContext('2d');
            const performanceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Mathematics', 'Science', 'English', 'Social Studies', 'Art', 'Physical Ed'],
                    datasets: [{
                        label: 'Average Score (%)',
                        data: [85, 78, 92, 75, 88, 95],
                        backgroundColor: [
                            'rgba(79, 70, 229, 0.7)',
                            'rgba(16, 185, 129, 0.7)',
                            'rgba(239, 68, 68, 0.7)',
                            'rgba(245, 158, 11, 0.7)',
                            'rgba(139, 92, 246, 0.7)',
                            'rgba(14, 165, 233, 0.7)'
                        ],
                        borderColor: [
                            'rgb(79, 70, 229)',
                            'rgb(16, 185, 129)',
                            'rgb(239, 68, 68)',
                            'rgb(245, 158, 11)',
                            'rgb(139, 92, 246)',
                            'rgb(14, 165, 233)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });

            // Animate progress bars
            setTimeout(function() {
                $('.progress-bar').each(function() {
                    $(this).css('width', $(this).attr('style').split(';')[0].split(':')[1]);
                });
            }, 500);

            // Update chart on window resize
            $(window).on('resize', function() {
                performanceChart.resize();
            });
        });
    </script>
</body>
</html>
