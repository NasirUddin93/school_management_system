<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
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
            <nav>
                <a href="/admin/dashboard" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark">
                    <i class="fas fa-home mr-2"></i>
                    Dashboard
                </a>
                <a href="{{ route('classes.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    All Classes
                </a>
                <a href="{{ route('sections.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    All Sections
                </a>
                <a href="{{ route('shifts.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    All Shifts
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    All Class Sections
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    All Students
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    Students
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    Students
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    Students
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    Students
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    Students
                </a>

                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-chalkboard-teacher mr-2"></i>
                    Teachers
                </a>
                <a href="#" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-book mr-2"></i>
                    Classes & Sections
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
                    <i class="fas fa-cog mr-2"></i>
                    Settings
                </a>
                                    <form method="POST" action="{{ route('admin.logout') }}" >
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
                    <h1 class="text-xl md:text-2xl font-bold text-dark ml-4">Dashboard</h1>
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
                            <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="User" class="h-8 w-8 md:h-10 md:w-10 rounded-full">
                            <span class="ml-2 font-medium text-dark hidden md:block">Admin User</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            {{-- <main class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Stats Overview -->
                <div class="stats-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-4 md:p-6 flex items-center">
                        <div class="bg-blue-100 p-3 md:p-4 rounded-full">
                            <i class="fas fa-users text-primary text-xl md:text-2xl"></i>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h2 class="text-sm md:text-base text-gray-500">Total Students</h2>
                            <p class="text-xl md:text-2xl font-bold text-dark">1,245</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 md:p-6 flex items-center">
                        <div class="bg-green-100 p-3 md:p-4 rounded-full">
                            <i class="fas fa-chalkboard-teacher text-secondary text-xl md:text-2xl"></i>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h2 class="text-sm md:text-base text-gray-500">Total Teachers</h2>
                            <p class="text-xl md:text-2xl font-bold text-dark">48</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 md:p-6 flex items-center">
                        <div class="bg-purple-100 p-3 md:p-4 rounded-full">
                            <i class="fas fa-book text-purple-600 text-xl md:text-2xl"></i>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h2 class="text-sm md:text-base text-gray-500">Classes</h2>
                            <p class="text-xl md:text-2xl font-bold text-dark">12</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4 md:p-6 flex items-center">
                        <div class="bg-yellow-100 p-3 md:p-4 rounded-full">
                            <i class="fas fa-clipboard-check text-yellow-600 text-xl md:text-2xl"></i>
                        </div>
                        <div class="ml-3 md:ml-4">
                            <h2 class="text-sm md:text-base text-gray-500">Today's Attendance</h2>
                            <p class="text-xl md:text-2xl font-bold text-dark">92%</p>
                        </div>
                    </div>
                </div>

                <!-- Charts and Recent Activities -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6 mb-6">
                    <!-- Attendance Chart -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow p-4 md:p-6">
                        <h2 class="text-lg font-bold text-dark mb-4">Monthly Attendance Overview</h2>
                        <div class="chart-container">
                            <canvas id="attendanceChart"></canvas>
                        </div>
                    </div>

                    <!-- Recent Activities -->
                    <div class="bg-white rounded-lg shadow p-4 md:p-6">
                        <h2 class="text-lg font-bold text-dark mb-4">Recent Activities</h2>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <i class="fas fa-user-plus text-primary"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">New student registered</p>
                                    <p class="text-xs text-gray-500">2 minutes ago</p>
                                </div>
                            </li>
                            <li class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-full">
                                    <i class="fas fa-check-circle text-secondary"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">Exam results published</p>
                                    <p class="text-xs text-gray-500">1 hour ago</p>
                                </div>
                            </li>
                            <li class="flex items-center">
                                <div class="bg-yellow-100 p-2 rounded-full">
                                    <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">Low attendance alert</p>
                                    <p class="text-xs text-gray-500">5 hours ago</p>
                                </div>
                            </li>
                            <li class="flex items-center">
                                <div class="bg-purple-100 p-2 rounded-full">
                                    <i class="fas fa-chalkboard-teacher text-purple-600"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">Teacher assigned to class</p>
                                    <p class="text-xs text-gray-500">Yesterday</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Recent Students and Quick Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
                    <!-- Recent Students -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow">
                        <div class="p-4 md:p-6 border-b">
                            <h2 class="text-lg font-bold text-dark">Recent Students</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Class</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Shift</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 flex-shrink-0">
                                                    <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
                                                </div>
                                                <div class="ml-2 md:ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Ali Ahmed</div>
                                                    <div class="text-xs text-gray-500">Roll: 001</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">Class 03</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">A</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">Morning</td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 flex-shrink-0">
                                                    <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/women/44.jpg" alt="">
                                                </div>
                                                <div class="ml-2 md:ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Fatima Khan</div>
                                                    <div class="text-xs text-gray-500">Roll: 012</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">KG-02</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">B</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">Day</td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 flex-shrink-0">
                                                    <img class="h-8 w-8 rounded-full" src="https://randomuser.me/api/portraits/men/22.jpg" alt="">
                                                </div>
                                                <div class="ml-2 md:ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Usman Ali</div>
                                                    <div class="text-xs text-gray-500">Roll: 022</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">Class 05</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">C</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">Morning</td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Inactive</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow p-4 md:p-6">
                        <h2 class="text-lg font-bold text-dark mb-4">Quick Actions</h2>
                        <div class="action-buttons grid grid-cols-2 gap-3 md:gap-4">
                            <a href="#" class="bg-primary hover:bg-indigo-700 text-white rounded-lg p-3 flex flex-col items-center justify-center transition duration-200 text-center">
                                <i class="fas fa-user-plus text-xl mb-2"></i>
                                <span class="text-xs md:text-sm">Add Student</span>
                            </a>
                            <a href="#" class="bg-secondary hover:bg-emerald-600 text-white rounded-lg p-3 flex flex-col items-center justify-center transition duration-200 text-center">
                                <i class="fas fa-chalkboard-teacher text-xl mb-2"></i>
                                <span class="text-xs md:text-sm">Add Teacher</span>
                            </a>
                            <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg p-3 flex flex-col items-center justify-center transition duration-200 text-center">
                                <i class="fas fa-clipboard-check text-xl mb-2"></i>
                                <span class="text-xs md:text-sm">Take Attendance</span>
                            </a>
                            <a href="#" class="bg-purple-600 hover:bg-purple-700 text-white rounded-lg p-3 flex flex-col items-center justify-center transition duration-200 text-center">
                                <i class="fas fa-chart-bar text-xl mb-2"></i>
                                <span class="text-xs md:text-sm">Enter Results</span>
                            </a>
                        </div>

                        <!-- Upcoming Events -->
                        <div class="mt-6 md:mt-8">
                            <h2 class="text-lg font-bold text-dark mb-4">Upcoming Events</h2>
                            <ul class="space-y-3">
                                <li class="flex items-center">
                                    <div class="bg-red-100 text-red-600 p-2 rounded-lg">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">Annual Sports Day</p>
                                        <p class="text-xs text-gray-500">June 15, 2023</p>
                                    </div>
                                </li>
                                <li class="flex items-center">
                                    <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">Mid-Term Exams</p>
                                        <p class="text-xs text-gray-500">July 1-5, 2023</p>
                                    </div>
                                </li>
                                <li class="flex items-center">
                                    <div class="bg-green-100 text-green-600 p-2 rounded-lg">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium">Result Declaration</p>
                                        <p class="text-xs text-gray-500">July 15, 2023</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </main> --}}
            <div class="mt-10">
                <main>
                    @yield('content')
                    @yield('scripts')
                </main>
            </div>
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

            // Sample chart data
            const ctx = document.getElementById('attendanceChart').getContext('2d');
            const attendanceChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Attendance Rate (%)',
                        data: [85, 92, 78, 90, 95, 88],
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        pointBackgroundColor: 'rgba(79, 70, 229, 1)',
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: false,
                            min: 70,
                            max: 100
                        }
                    }
                }
            });

            // Update chart on window resize
            $(window).on('resize', function() {
                attendanceChart.resize();
            });
        });
    </script>
</body>
</html>
