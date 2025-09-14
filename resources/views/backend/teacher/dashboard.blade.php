<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - School Management System</title>
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
                    <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                </div>
                <span class="text-xl font-bold ml-2 text-dark">EduManage</span>
            </div>

            <!-- Teacher Profile Summary -->
            <div class="px-4 py-3 bg-gray-50 rounded-lg mx-2">
                <div class="flex items-center">
                    <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/women/65.jpg" alt="Teacher">
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-dark">Ms. Sarah Johnson</h3>
                        <p class="text-xs text-gray-500">Mathematics Teacher</p>
                        <p class="text-xs text-gray-500">ID: TEA-2023</p>
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
                    <i class="fas fa-users mr-2"></i>
                    My Classes
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-clipboard-check mr-2"></i>
                    Attendance
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Grades & Results
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Schedule
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-tasks mr-2"></i>
                    Assignments
                </a>
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
                    <h1 class="text-xl md:text-2xl font-bold text-dark ml-4">Teacher Dashboard</h1>
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
                                <span class="absolute top-0 right-0 bg-secondary rounded-full h-4 w-4 text-xs text-white flex items-center justify-center">5</span>
                            </button>
                        </div>
                        <div class="ml-4 flex items-center">
                            <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="User" class="h-8 w-8 md:h-10 md:w-10 rounded-full">
                            <span class="ml-2 font-medium text-dark hidden md:block">Ms. Johnson</span>
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
                            <i class="fas fa-users text-primary text-xl md:text-2xl"></i>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h2 class="text-sm md:text-base text-gray-500">Total Students</h2>
                            <p class="text-xl md:text-2xl font-bold text-dark">142</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 md:p-6 flex items-center">
                        <div class="bg-green-100 p-3 md:p-4 rounded-full">
                            <i class="fas fa-book text-secondary text-xl md:text-2xl"></i>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h2 class="text-sm md:text-base text-gray-500">Classes</h2>
                            <p class="text-xl md:text-2xl font-bold text-dark">6</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 md:p-6 flex items-center">
                        <div class="bg-purple-100 p-3 md:p-4 rounded-full">
                            <i class="fas fa-clipboard-check text-purple-600 text-xl md:text-2xl"></i>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h2 class="text-sm md:text-base text-gray-500">Attendance Due</h2>
                            <p class="text-xl md:text-2xl font-bold text-dark">3</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 md:p-6 flex items-center">
                        <div class="bg-yellow-100 p-3 md:p-4 rounded-full">
                            <i class="fas fa-tasks text-yellow-600 text-xl md:text-2xl"></i>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h2 class="text-sm md:text-base text-gray-500">Assignments to Grade</h2>
                            <p class="text-xl md:text-2xl font-bold text-dark">24</p>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6 mb-6">
                    <!-- Class Performance -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow p-4 md:p-6">
                        <h2 class="text-lg font-bold text-dark mb-4">Class Performance Overview</h2>
                        <div class="chart-container">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>

                    <!-- Upcoming Schedule -->
                    <div class="bg-white rounded-lg shadow p-4 md:p-6">
                        <h2 class="text-lg font-bold text-dark mb-4">Today's Schedule</h2>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <div class="bg-red-100 text-red-600 p-2 rounded-lg">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">8:00 AM - Mathematics</p>
                                    <p class="text-xs text-gray-500">Class 03 - Section A</p>
                                </div>
                            </li>
                            <li class="flex items-center">
                                <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">10:00 AM - Mathematics</p>
                                    <p class="text-xs text-gray-500">Class 05 - Section B</p>
                                </div>
                            </li>
                            <li class="flex items-center">
                                <div class="bg-green-100 text-green-600 p-2 rounded-lg">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">12:00 PM - Faculty Meeting</p>
                                    <p class="text-xs text-gray-500">Conference Room</p>
                                </div>
                            </li>
                            <li class="flex items-center">
                                <div class="bg-purple-100 text-purple-600 p-2 rounded-lg">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">2:00 PM - Mathematics</p>
                                    <p class="text-xs text-gray-500">Class 04 - Section C</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- My Classes and Recent Activities -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
                    <!-- My Classes -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow">
                        <div class="p-4 md:p-6 border-b">
                            <h2 class="text-lg font-bold text-dark">My Classes</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
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
                                                    <div class="text-sm font-medium text-gray-900">Class 03</div>
                                                    <div class="text-xs text-gray-500">Mathematics</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Section A</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Morning</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">24 Students</td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <button class="bg-primary hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="bg-green-100 p-2 rounded-lg">
                                                    <i class="fas fa-calculator text-green-600"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">Class 04</div>
                                                    <div class="text-xs text-gray-500">Mathematics</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Section C</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Day</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">22 Students</td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <button class="bg-primary hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="bg-red-100 p-2 rounded-lg">
                                                    <i class="fas fa-calculator text-red-600"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">Class 05</div>
                                                    <div class="text-xs text-gray-500">Mathematics</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Section B</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">Morning</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">26 Students</td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <button class="bg-primary hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm">View</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Quick Actions & Notifications -->
                    <div class="space-y-6">
                        <!-- Quick Actions -->
                        <div class="bg-white rounded-lg shadow p-4 md:p-6">
                            <h2 class="text-lg font-bold text-dark mb-4">Quick Actions</h2>
                            <div class="action-buttons grid grid-cols-2 gap-3 md:gap-4">
                                <a href="#" class="bg-primary hover:bg-indigo-700 text-white rounded-lg p-3 flex flex-col items-center justify-center transition duration-200 text-center">
                                    <i class="fas fa-clipboard-check text-xl mb-2"></i>
                                    <span class="text-xs md:text-sm">Take Attendance</span>
                                </a>
                                <a href="#" class="bg-secondary hover:bg-emerald-600 text-white rounded-lg p-3 flex flex-col items-center justify-center transition duration-200 text-center">
                                    <i class="fas fa-edit text-xl mb-2"></i>
                                    <span class="text-xs md:text-sm">Enter Grades</span>
                                </a>
                                <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg p-3 flex flex-col items-center justify-center transition duration-200 text-center">
                                    <i class="fas fa-tasks text-xl mb-2"></i>
                                    <span class="text-xs md:text-sm">Create Assignment</span>
                                </a>
                                <a href="#" class="bg-purple-600 hover:bg-purple-700 text-white rounded-lg p-3 flex flex-col items-center justify-center transition duration-200 text-center">
                                    <i class="fas fa-calendar-plus text-xl mb-2"></i>
                                    <span class="text-xs md:text-sm">Add Schedule</span>
                                </a>
                            </div>
                        </div>

                        <!-- Notifications -->
                        <div class="bg-white rounded-lg shadow p-4 md:p-6">
                            <h2 class="text-lg font-bold text-dark mb-4">Recent Notifications</h2>
                            <ul class="space-y-3">
                                <li class="flex items-center">
                                    <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                        <i class="fas fa-info-circle"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">New curriculum guidelines available</p>
                                        <p class="text-xs text-gray-500">2 hours ago</p>
                                    </div>
                                </li>
                                <li class="flex items-center">
                                    <div class="bg-green-100 text-green-600 p-2 rounded-lg">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">Your grade submission was received</p>
                                        <p class="text-xs text-gray-500">Yesterday</p>
                                    </div>
                                </li>
                                <li class="flex items-center">
                                    <div class="bg-yellow-100 text-yellow-600 p-2 rounded-lg">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">Meeting reminder: Tomorrow at 10 AM</p>
                                        <p class="text-xs text-gray-500">2 days ago</p>
                                    </div>
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

            // Class Performance Chart
            const ctx = document.getElementById('performanceChart').getContext('2d');
            const performanceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Class 03-A', 'Class 04-C', 'Class 05-B', 'Class 02-B', 'Class 06-A'],
                    datasets: [{
                        label: 'Average Grade (%)',
                        data: [85, 78, 92, 75, 88],
                        backgroundColor: [
                            'rgba(79, 70, 229, 0.7)',
                            'rgba(16, 185, 129, 0.7)',
                            'rgba(239, 68, 68, 0.7)',
                            'rgba(245, 158, 11, 0.7)',
                            'rgba(139, 92, 246, 0.7)'
                        ],
                        borderColor: [
                            'rgb(79, 70, 229)',
                            'rgb(16, 185, 129)',
                            'rgb(239, 68, 68)',
                            'rgb(245, 158, 11)',
                            'rgb(139, 92, 246)'
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
