{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
        <div class="overlay" id="overlay"></div>

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
                    Classes
                </a>
                <a href="{{ route('sections.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    Sections
                </a>
                <a href="{{ route('shifts.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    Shifts
                </a>
                <a href="{{ route('class-sections.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-book mr-2"></i>
                    Class Sections
                </a>
                <a href="{{ route('students.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    Students
                </a>
                <a href="{{ route('teachers.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    Teachers
                </a>
                <a href="{{ route('subjects.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    Subjects
                </a>
                <a href="{{ route('fee_types.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    Fee Type
                </a>
                <a href="{{ route('exams.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    Exams
                </a>
                <a href="{{ route('enrollments.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-users mr-2"></i>
                    Enrollments
                </a>

                <a href="{{ route('academic-years.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-chalkboard-teacher mr-2"></i>
                    Academic Years
                </a>
                <a href="{{ route('class-subjects.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-book mr-2"></i>
                    Class Subjects
                </a>
                <a href="{{ route('fee-structures.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-clipboard-check mr-2"></i>
                    Fee Structures
                </a>
                <a href="{{ route('academic-years.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Exam Results
                </a>
                <a href="{{ route('teacher-assignments.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-cog mr-2"></i>
                    Teacher Assignments
                </a>
                <a href="{{ route('attendances.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-cog mr-2"></i>
                    Attendances
                </a>
                <a href="{{ route('exam-results.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-cog mr-2"></i>
                    Exam Results
                </a>
                <a href="{{ route('student-fees.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-cog mr-2"></i>
                    Student Fees
                </a>
                <a href="{{ route('teacher-assignments.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-cog mr-2"></i>
                    Payments
                </a>
                <a href="{{ route('student-fines.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                    <i class="fas fa-cog mr-2"></i>
                    Student Fines
                </a>
                    <form method="POST" action="{{ route('admin.logout') }}" >
                        @csrf
                        <button type="submit" class="navigation-item block py-2.5 px-4 rounded transition duration-200 w-full text-left">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
            </nav>
        </div>

        <div class="flex-1 flex flex-col md:ml-0">
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
</html> --}}


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
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .submenu.active {
            max-height: 500px;
        }
        .menu-item {
            position: relative;
        }
        .menu-item.has-submenu::after {
            content: '\f107';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 1rem;
            transition: transform 0.3s ease;
        }
        .menu-item.has-submenu.active::after {
            transform: rotate(180deg);
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
        <div class="sidebar bg-white w-64 space-y-6 py-7 px-2 fixed inset-y-0 left-0 transform md:relative md:translate-x-0 overflow-y-auto">
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

                <!-- Academic Management Submenu -->
                <div class="menu-item has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                        <i class="fas fa-book-open mr-2"></i>
                        Academic Management
                    </a>
                    <div class="submenu pl-8">
                        <a href="{{ route('classes.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-chalkboard mr-2"></i>
                            Classes
                        </a>
                        <a href="{{ route('sections.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-object-group mr-2"></i>
                            Sections
                        </a>
                        <a href="{{ route('shifts.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-clock mr-2"></i>
                            Shifts
                        </a>
                        <a href="{{ route('class-sections.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-chalkboard-teacher mr-2"></i>
                            Class Sections
                        </a>
                        <a href="{{ route('subjects.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-book mr-2"></i>
                            Subjects
                        </a>
                        <a href="{{ route('class-subjects.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-tasks mr-2"></i>
                            Class Subjects
                        </a>
                        <a href="{{ route('academic-years.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Academic Years
                        </a>
                    </div>
                </div>

                <!-- People Management Submenu -->
                <div class="menu-item has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                        <i class="fas fa-users mr-2"></i>
                        People Management
                    </a>
                    <div class="submenu pl-8">
                        <a href="{{ route('students.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-user-graduate mr-2"></i>
                            Students
                        </a>
                        <a href="{{ route('teachers.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-chalkboard-teacher mr-2"></i>
                            Teachers
                        </a>
                        <a href="{{ route('teacher-assignments.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-user-tie mr-2"></i>
                            Teacher Assignments
                        </a>
                    </div>
                </div>

                <!-- Exam Management Submenu -->
                <div class="menu-item has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                        <i class="fas fa-file-alt mr-2"></i>
                        Exam Management
                    </a>
                    <div class="submenu pl-8">
                        <a href="{{ route('exams.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-clipboard-list mr-2"></i>
                            Exams
                        </a>
                        <a href="{{ route('exam-results.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-chart-line mr-2"></i>
                            Exam Results
                        </a>
                    </div>
                </div>

                <!-- Financial Management Submenu -->
                <div class="menu-item has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                        <i class="fas fa-money-bill-wave mr-2"></i>
                        Financial Management
                    </a>
                    <div class="submenu pl-8">
                        <a href="{{ route('fee_types.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-tags mr-2"></i>
                            Fee Types
                        </a>
                        <a href="{{ route('fee-structures.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-clipboard-check mr-2"></i>
                            Fee Structures
                        </a>
                        <a href="{{ route('student-fees.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-credit-card mr-2"></i>
                            Student Fees
                        </a>
                        <a href="{{ route('student-fines.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            Student Fines
                        </a>
                        <a href="{{ route('payments.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-money-check mr-2"></i>
                            Payments
                        </a>
                    </div>
                </div>

                <!-- Operations Submenu -->
                <div class="menu-item has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                        <i class="fas fa-cogs mr-2"></i>
                        Operations
                    </a>
                    <div class="submenu pl-8">
                        <a href="{{ route('enrollments.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-user-plus mr-2"></i>
                            Enrollments
                        </a>
                        <a href="{{ route('attendances.index') }}" class="py-2.5 px-4 rounded transition duration-200 hover:bg-primary hover:text-white flex items-center text-dark mt-2">
                            <i class="fas fa-calendar-check mr-2"></i>
                            Attendances
                        </a>
                    </div>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('admin.logout') }}" >
                    @csrf
                    <button type="submit" class="navigation-item block py-2.5 px-4 rounded transition duration-200 w-full text-left hover:bg-primary hover:text-white mt-2">
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

            // Toggle submenus
            $('.submenu-toggle').click(function(e) {
                e.preventDefault();
                const menuItem = $(this).parent('.menu-item');
                menuItem.toggleClass('active');
                menuItem.find('.submenu').toggleClass('active');
            });

            // Sample chart data
            const ctx = document.getElementById('attendanceChart');
            if (ctx) {
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
            }
        });
    </script>
</body>
</html>
