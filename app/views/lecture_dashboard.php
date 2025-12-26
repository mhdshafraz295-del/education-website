
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Dashboard - Education Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #2c3e50;
        }

    
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, #6a11cb 0%, #2575fc 100%);
            padding: 20px;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 30px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
        }

        .logo i {
            font-size: 32px;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
            white-space: nowrap;
        }

        .sidebar.collapsed .logo-text,
        .sidebar.collapsed .nav-text {
            display: none;
        }

        .toggle-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .toggle-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 8px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .nav-link i {
            font-size: 20px;
            min-width: 20px;
        }

        .nav-text {
            font-size: 15px;
            font-weight: 500;
            white-space: nowrap;
        }


        .main-content {
            margin-left: 280px;
            padding: 30px;
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: 80px;
        }
        
        .header {
            background: white;
            padding: 25px 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .header-left h1 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .header-left p {
            color: #7f8c8d;
            font-size: 14px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 10px 40px 10px 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            width: 250px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: #6a11cb;
        }

        .search-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
        }

        .notification-btn {
            position: relative;
            background: #f8f9fa;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .notification-btn:hover {
            background: #e9ecef;
        }

        .notification-btn i {
            font-size: 18px;
            color: #2c3e50;
        }

        .notification-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #e74c3c;
            color: white;
            font-size: 10px;
            padding: 2px 5px;
            border-radius: 10px;
            font-weight: 600;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .user-profile:hover {
            background: #f8f9fa;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
        }

        .user-info h4 {
            font-size: 14px;
            color: #2c3e50;
            margin-bottom: 2px;
        }

        .user-info p {
            font-size: 12px;
            color: #7f8c8d;
        }

        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .stat-icon.purple {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .stat-content h3 {
            font-size: 32px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stat-content p {
            color: #7f8c8d;
            font-size: 14px;
        }

        
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .content-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-header h2 {
            font-size: 20px;
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header h2 i {
            color: #6a11cb;
        }

        .view-all {
            color: #6a11cb;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .view-all:hover {
            color: #2575fc;
        }

        .add-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
        }

    
        .course-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .course-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border: 2px solid #e0e6ed;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .course-item:hover {
            border-color: #6a11cb;
            background: #f8f9ff;
        }

        .course-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            flex-shrink: 0;
        }

        .course-info {
            flex: 1;
        }

        .course-info h4 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .course-info p {
            font-size: 13px;
            color: #7f8c8d;
            margin-bottom: 8px;
        }

        .course-meta {
            display: flex;
            gap: 15px;
            font-size: 12px;
            color: #7f8c8d;
        }

        .course-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .course-actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .action-btn.edit {
            background: #e3f2fd;
            color: #1976d2;
        }

        .action-btn.edit:hover {
            background: #1976d2;
            color: white;
        }

        .action-btn.delete {
            background: #ffebee;
            color: #c62828;
        }

        .action-btn.delete:hover {
            background: #c62828;
            color: white;
        }

        .action-btn.view {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .action-btn.view:hover {
            background: #7b1fa2;
            color: white;
        }

        
        .schedule-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .schedule-item {
            padding: 15px;
            background: #f8f9fa;
            border-left: 4px solid #6a11cb;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .schedule-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .schedule-time {
            display: inline-block;
            padding: 4px 10px;
            background: #6a11cb;
            color: white;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .schedule-item h4 {
            font-size: 15px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .schedule-item p {
            font-size: 13px;
            color: #7f8c8d;
        }

    
        .students-table {
            width: 100%;
            border-collapse: collapse;
        }

        .students-table th {
            text-align: left;
            padding: 15px;
            background: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
            border-bottom: 2px solid #e0e6ed;
        }

        .students-table td {
            padding: 15px;
            border-bottom: 1px solid #e0e6ed;
            font-size: 14px;
        }

        .students-table tr:hover {
            background: #f8f9fa;
        }

        .student-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .student-details h4 {
            font-size: 14px;
            color: #2c3e50;
            margin-bottom: 2px;
        }

        .student-details p {
            font-size: 12px;
            color: #7f8c8d;
        }

        .grade-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .grade-badge.excellent {
            background: #d4edda;
            color: #155724;
        }

        .grade-badge.good {
            background: #d1ecf1;
            color: #0c5460;
        }

        .grade-badge.average {
            background: #fff3cd;
            color: #856404;
        }

        .grade-badge.poor {
            background: #f8d7da;
            color: #721c24;
        }


        .quick-actions {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .quick-action-card {
            padding: 20px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .quick-action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(106, 17, 203, 0.3);
        }

        .quick-action-card i {
            font-size: 28px;
        }

        .quick-action-card h4 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .quick-action-card p {
            font-size: 12px;
            opacity: 0.9;
        }

        
        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: 20px;
            }

            .header-right {
                width: 100%;
                justify-content: space-between;
            }

            .search-box input {
                width: 100%;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }
        }


        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card,
        .content-card {
            animation: fadeIn 0.5s ease-out;
        }

    
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            z-index: 999;
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="#" class="logo">
                <i class="fas fa-chalkboard-teacher"></i>
                <span class="logo-text">Lecturer Panel</span>
            </a>
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <nav>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link active" onclick="event.preventDefault(); showSection('dashboard');">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); showSection('courses');">
                        <i class="fas fa-book"></i>
                        <span class="nav-text">My Courses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); showSection('students');">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Students</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); showSection('assignments');">
                        <i class="fas fa-tasks"></i>
                        <span class="nav-text">Assignments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); showSection('exams');">
                        <i class="fas fa-file-alt"></i>
                        <span class="nav-text">Exams</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); showSection('grades');">
                        <i class="fas fa-chart-line"></i>
                        <span class="nav-text">Grades</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-calendar-alt"></i>
                        <span class="nav-text">Schedule</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-upload"></i>
                        <span class="nav-text">Materials</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-comments"></i>
                        <span class="nav-text">Messages</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span class="nav-text">Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/education_site/app/views/login.php" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    
    <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
        <i class="fas fa-bars"></i>
    </button>

    
    <main class="main-content" id="mainContent">
        
        <div class="header">
            <div class="header-left">
                <h1>Welcome back, Prof. <?php echo htmlspecialchars($_SESSION['username'] ?? 'Lecturer'); ?>! 👋</h1>
                <p>Here's an overview of your courses and students</p>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <input type="text" placeholder="Search courses, students...">
                    <i class="fas fa-search"></i>
                </div>
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">4</span>
                </button>
                <div class="user-profile">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($_SESSION['username'] ?? 'L', 0, 1)); ?>
                    </div>
                    <div class="user-info">
                        <h4><?php echo htmlspecialchars($_SESSION['username'] ?? 'Lecturer'); ?></h4>
                        <p>ID: <?php echo htmlspecialchars($_SESSION['user_id'] ?? 'LEC001'); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div id="mainDashboardContent">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-content">
                    <h3>5</h3>
                    <p>Active Courses</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-content">
                    <h3>248</h3>
                    <p>Total Students</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="stat-content">
                    <h3>18</h3>
                    <p>Pending Assignments</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orange">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-content">
                    <h3>3</h3>
                    <p>Upcoming Exams</p>
                </div>
            </div>
        </div>

        
        <div class="content-grid">
        
            <div class="content-card">
                <div class="card-header">
                    <h2><i class="fas fa-book"></i> My Courses</h2>
                    <button class="add-btn">
                        <i class="fas fa-plus"></i>
                        Add Course
                    </button>
                </div>
                <div class="course-list">
                    <div class="course-item">
                        <div class="course-icon" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="course-info">
                            <h4>Web Development</h4>
                            <p>CS301 • Fall 2025</p>
                            <div class="course-meta">
                                <span><i class="fas fa-users"></i> 58 students</span>
                                <span><i class="fas fa-clock"></i> Mon, Wed, Fri</span>
                            </div>
                        </div>
                        <div class="course-actions">
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>

                    <div class="course-item">
                        <div class="course-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="course-info">
                            <h4>Database Management</h4>
                            <p>CS302 • Fall 2025</p>
                            <div class="course-meta">
                                <span><i class="fas fa-users"></i> 42 students</span>
                                <span><i class="fas fa-clock"></i> Tue, Thu</span>
                            </div>
                        </div>
                        <div class="course-actions">
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>

                    <div class="course-item">
                        <div class="course-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div class="course-info">
                            <h4>Artificial Intelligence</h4>
                            <p>CS401 • Fall 2025</p>
                            <div class="course-meta">
                                <span><i class="fas fa-users"></i> 35 students</span>
                                <span><i class="fas fa-clock"></i> Mon, Wed</span>
                            </div>
                        </div>
                        <div class="course-actions">
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>

                    <div class="course-item">
                        <div class="course-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="course-info">
                            <h4>Data Structures</h4>
                            <p>CS201 • Fall 2025</p>
                            <div class="course-meta">
                                <span><i class="fas fa-users"></i> 68 students</span>
                                <span><i class="fas fa-clock"></i> Tue, Thu, Fri</span>
                            </div>
                        </div>
                        <div class="course-actions">
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="content-card">
                <div class="card-header">
                    <h2><i class="fas fa-calendar-day"></i> Today's Schedule</h2>
                    <a href="#" class="view-all">View All →</a>
                </div>
                <div class="schedule-list">
                    <div class="schedule-item">
                        <span class="schedule-time">09:00 AM</span>
                        <h4>Web Development</h4>
                        <p>Room 301 • 58 students</p>
                    </div>
                    <div class="schedule-item">
                        <span class="schedule-time">11:00 AM</span>
                        <h4>Database Management</h4>
                        <p>Room 205 • 42 students</p>
                    </div>
                    <div class="schedule-item">
                        <span class="schedule-time">02:00 PM</span>
                        <h4>Data Structures</h4>
                        <p>Room 403 • 68 students</p>
                    </div>
                    <div class="schedule-item">
                        <span class="schedule-time">04:00 PM</span>
                        <h4>Office Hours</h4>
                        <p>Office 201 • Open</p>
                    </div>
                </div>
            </div>
        </div>

    
        <div class="content-card">
            <div class="card-header">
                <h2><i class="fas fa-chart-line"></i> Recent Student Performance</h2>
                <a href="#" class="view-all">View All →</a>
            </div>
            <table class="students-table">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Course</th>
                        <th>Last Assignment</th>
                        <th>Grade</th>
                        <th>Average</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="student-cell">
                                <div class="student-avatar">JD</div>
                                <div class="student-details">
                                    <h4>John Doe</h4>
                                    <p>STU12345</p>
                                </div>
                            </div>
                        </td>
                        <td>Web Development</td>
                        <td>React Components</td>
                        <td>95/100</td>
                        <td><span class="grade-badge excellent">92% A</span></td>
                        <td>
                            <div class="course-actions">
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="student-cell">
                                <div class="student-avatar">SM</div>
                                <div class="student-details">
                                    <h4>Sarah Miller</h4>
                                    <p>STU12346</p>
                                </div>
                            </div>
                        </td>
                        <td>Database Management</td>
                        <td>SQL Queries</td>
                        <td>88/100</td>
                        <td><span class="grade-badge good">85% B</span></td>
                        <td>
                            <div class="course-actions">
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="student-cell">
                                <div class="student-avatar">MB</div>
                                <div class="student-details">
                                    <h4>Michael Brown</h4>
                                    <p>STU12347</p>
                                </div>
                            </div>
                        </td>
                        <td>Artificial Intelligence</td>
                        <td>ML Model</td>
                        <td>92/100</td>
                        <td><span class="grade-badge excellent">89% B+</span></td>
                        <td>
                            <div class="course-actions">
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="student-cell">
                                <div class="student-avatar">EW</div>
                                <div class="student-details">
                                    <h4>Emily Wilson</h4>
                                    <p>STU12348</p>
                                </div>
                            </div>
                        </td>
                        <td>Data Structures</td>
                        <td>Binary Trees</td>
                        <td>78/100</td>
                        <td><span class="grade-badge average">76% C</span></td>
                        <td>
                            <div class="course-actions">
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="student-cell">
                                <div class="student-avatar">DJ</div>
                                <div class="student-details">
                                    <h4>David Jones</h4>
                                    <p>STU12349</p>
                                </div>
                            </div>
                        </td>
                        <td>Web Development</td>
                        <td>CSS Layouts</td>
                        <td>90/100</td>
                        <td><span class="grade-badge excellent">88% B+</span></td>
                        <td>
                            <div class="course-actions">
                                <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="content-card" style="margin-top: 30px;">
            <div class="card-header">
                <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
            </div>
            <div class="quick-actions">
                <div class="quick-action-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <i class="fas fa-plus-circle"></i>
                    <div>
                        <h4>Create Assignment</h4>
                        <p>Add new assignment for students</p>
                    </div>
                </div>
                <div class="quick-action-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                    <i class="fas fa-file-upload"></i>
                    <div>
                        <h4>Upload Material</h4>
                        <p>Share lecture notes & resources</p>
                    </div>
                </div>
                <div class="quick-action-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                    <i class="fas fa-calendar-plus"></i>
                    <div>
                        <h4>Schedule Exam</h4>
                        <p>Set up upcoming examination</p>
                    </div>
                </div>
                <div class="quick-action-card" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);">
                    <i class="fas fa-chart-bar"></i>
                    <div>
                        <h4>View Reports</h4>
                        <p>Access performance analytics</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- End Main Dashboard Content -->

        <!-- My Courses Dashboard Section -->
        <div id="coursesSection" style="display: none;">
            <div class="section-header-main" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding: 25px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 15px; color: white; box-shadow: 0 10px 30px rgba(106, 17, 203, 0.3);">
                <div>
                    <h1 style="margin: 0; font-size: 28px; font-weight: 700;"><i class="fas fa-book" style="margin-right: 10px;"></i>My Courses</h1>
                    <p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">Manage your teaching courses and track student progress</p>
                </div>
                <button onclick="alert('Add new course')" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 12px 24px; border-radius: 10px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px; font-size: 14px; transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                    <i class="fas fa-plus"></i> Create New Course
                </button>
            </div>

            <!-- Course Stats Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
                <!-- Total Courses Card -->
                <div style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(106, 17, 203, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Total Courses</div>
                            <div style="font-size: 36px; font-weight: 700;">5</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-book" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-calendar"></i> Fall 2025</div>
                </div>

                <!-- Total Students Card -->
                <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Total Students</div>
                            <div style="font-size: 36px; font-weight: 700;">248</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-graduate" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-arrow-up"></i> 12% from last semester</div>
                </div>

                <!-- Avg Attendance Card -->
                <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(67, 233, 123, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Avg Attendance</div>
                            <div style="font-size: 36px; font-weight: 700;">87%</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-check" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-check-circle"></i> Above target</div>
                </div>

                <!-- Active Assignments Card -->
                <div style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(250, 112, 154, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Active Assignments</div>
                            <div style="font-size: 36px; font-weight: 700;">18</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-tasks" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-clock"></i> 5 due this week</div>
                </div>
            </div>

            <!-- Courses Grid -->
            <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); margin-bottom: 30px;">
                <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-graduation-cap" style="margin-right: 10px; color: #6a11cb;"></i>Active Courses</h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 20px;">
                    <!-- Course 1 - Web Development -->
                    <div style="background: white; border: 2px solid #f0f0f0; border-radius: 15px; padding: 25px; transition: all 0.3s; cursor: pointer;" onmouseover="this.style.boxShadow='0 10px 30px rgba(106,17,203,0.2)'; this.style.transform='translateY(-5px)'; this.style.borderColor='#6a11cb'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'; this.style.borderColor='#f0f0f0'">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 20px;">
                            <div style="flex: 1;">
                                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white;">
                                        <i class="fas fa-laptop-code" style="font-size: 28px;"></i>
                                    </div>
                                    <div>
                                        <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">Web Development</h3>
                                        <div style="font-size: 13px; color: #7f8c8d;">CS301 • Fall 2025</div>
                                    </div>
                                </div>
                            </div>
                            <div style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Active</div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin: 20px 0;">
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Students</div>
                                <div style="font-size: 18px; font-weight: 700; color: #6a11cb;">58</div>
                            </div>
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Assignments</div>
                                <div style="font-size: 18px; font-weight: 700; color: #6a11cb;">5</div>
                            </div>
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Avg Grade</div>
                                <div style="font-size: 18px; font-weight: 700; color: #6a11cb;">B+</div>
                            </div>
                        </div>

                        <div style="margin: 15px 0;">
                            <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 8px;">Course Completion: 65%</div>
                            <div style="background: #f0f0f0; border-radius: 10px; height: 8px; overflow: hidden;">
                                <div style="background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%); height: 100%; width: 65%; border-radius: 10px;"></div>
                            </div>
                        </div>

                        <div style="display: flex; gap: 8px; margin-top: 20px;">
                            <button style="flex: 1; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; border: none; padding: 10px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button style="background: #f8f9fa; color: #6a11cb; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button style="background: #f8f9fa; color: #6a11cb; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;">
                                <i class="fas fa-chart-bar"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Course 2 - Database Management -->
                    <div style="background: white; border: 2px solid #f0f0f0; border-radius: 15px; padding: 25px; transition: all 0.3s; cursor: pointer;" onmouseover="this.style.boxShadow='0 10px 30px rgba(79,172,254,0.2)'; this.style.transform='translateY(-5px)'; this.style.borderColor='#4facfe'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'; this.style.borderColor='#f0f0f0'">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 20px;">
                            <div style="flex: 1;">
                                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white;">
                                        <i class="fas fa-database" style="font-size: 28px;"></i>
                                    </div>
                                    <div>
                                        <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">Database Management</h3>
                                        <div style="font-size: 13px; color: #7f8c8d;">CS302 • Fall 2025</div>
                                    </div>
                                </div>
                            </div>
                            <div style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Active</div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin: 20px 0;">
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Students</div>
                                <div style="font-size: 18px; font-weight: 700; color: #4facfe;">45</div>
                            </div>
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Assignments</div>
                                <div style="font-size: 18px; font-weight: 700; color: #4facfe;">4</div>
                            </div>
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Avg Grade</div>
                                <div style="font-size: 18px; font-weight: 700; color: #4facfe;">A-</div>
                            </div>
                        </div>

                        <div style="margin: 15px 0;">
                            <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 8px;">Course Completion: 58%</div>
                            <div style="background: #f0f0f0; border-radius: 10px; height: 8px; overflow: hidden;">
                                <div style="background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%); height: 100%; width: 58%; border-radius: 10px;"></div>
                            </div>
                        </div>

                        <div style="display: flex; gap: 8px; margin-top: 20px;">
                            <button style="flex: 1; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none; padding: 10px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;">
                                <i class="fas fa-chart-bar"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Course 3 - Data Structures -->
                    <div style="background: white; border: 2px solid #f0f0f0; border-radius: 15px; padding: 25px; transition: all 0.3s; cursor: pointer;" onmouseover="this.style.boxShadow='0 10px 30px rgba(67,233,123,0.2)'; this.style.transform='translateY(-5px)'; this.style.borderColor='#43e97b'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'; this.style.borderColor='#f0f0f0'">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 20px;">
                            <div style="flex: 1;">
                                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white;">
                                        <i class="fas fa-project-diagram" style="font-size: 28px;"></i>
                                    </div>
                                    <div>
                                        <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">Data Structures</h3>
                                        <div style="font-size: 13px; color: #7f8c8d;">CS201 • Fall 2025</div>
                                    </div>
                                </div>
                            </div>
                            <div style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Active</div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin: 20px 0;">
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Students</div>
                                <div style="font-size: 18px; font-weight: 700; color: #43e97b;">62</div>
                            </div>
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Assignments</div>
                                <div style="font-size: 18px; font-weight: 700; color: #43e97b;">3</div>
                            </div>
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Avg Grade</div>
                                <div style="font-size: 18px; font-weight: 700; color: #43e97b;">B</div>
                            </div>
                        </div>

                        <div style="margin: 15px 0;">
                            <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 8px;">Course Completion: 72%</div>
                            <div style="background: #f0f0f0; border-radius: 10px; height: 8px; overflow: hidden;">
                                <div style="background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%); height: 100%; width: 72%; border-radius: 10px;"></div>
                            </div>
                        </div>

                        <div style="display: flex; gap: 8px; margin-top: 20px;">
                            <button style="flex: 1; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border: none; padding: 10px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;">
                                <i class="fas fa-chart-bar"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Course 4 - Computer Networks -->
                    <div style="background: white; border: 2px solid #f0f0f0; border-radius: 15px; padding: 25px; transition: all 0.3s; cursor: pointer;" onmouseover="this.style.boxShadow='0 10px 30px rgba(250,112,154,0.2)'; this.style.transform='translateY(-5px)'; this.style.borderColor='#fa709a'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'; this.style.borderColor='#f0f0f0'">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 20px;">
                            <div style="flex: 1;">
                                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white;">
                                        <i class="fas fa-network-wired" style="font-size: 28px;"></i>
                                    </div>
                                    <div>
                                        <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">Computer Networks</h3>
                                        <div style="font-size: 13px; color: #7f8c8d;">CS402 • Fall 2025</div>
                                    </div>
                                </div>
                            </div>
                            <div style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Active</div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin: 20px 0;">
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Students</div>
                                <div style="font-size: 18px; font-weight: 700; color: #fa709a;">38</div>
                            </div>
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Assignments</div>
                                <div style="font-size: 18px; font-weight: 700; color: #fa709a;">3</div>
                            </div>
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Avg Grade</div>
                                <div style="font-size: 18px; font-weight: 700; color: #fa709a;">B+</div>
                            </div>
                        </div>

                        <div style="margin: 15px 0;">
                            <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 8px;">Course Completion: 45%</div>
                            <div style="background: #f0f0f0; border-radius: 10px; height: 8px; overflow: hidden;">
                                <div style="background: linear-gradient(90deg, #fa709a 0%, #fee140 100%); height: 100%; width: 45%; border-radius: 10px;"></div>
                            </div>
                        </div>

                        <div style="display: flex; gap: 8px; margin-top: 20px;">
                            <button style="flex: 1; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; border: none; padding: 10px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button style="background: #f8f9fa; color: #fa709a; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button style="background: #f8f9fa; color: #fa709a; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;">
                                <i class="fas fa-chart-bar"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Course 5 - Software Engineering -->
                    <div style="background: white; border: 2px solid #f0f0f0; border-radius: 15px; padding: 25px; transition: all 0.3s; cursor: pointer;" onmouseover="this.style.boxShadow='0 10px 30px rgba(255,106,0,0.2)'; this.style.transform='translateY(-5px)'; this.style.borderColor='#ff6a00'" onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'; this.style.borderColor='#f0f0f0'">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 20px;">
                            <div style="flex: 1;">
                                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white;">
                                        <i class="fas fa-code" style="font-size: 28px;"></i>
                                    </div>
                                    <div>
                                        <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">Software Engineering</h3>
                                        <div style="font-size: 13px; color: #7f8c8d;">CS303 • Fall 2025</div>
                                    </div>
                                </div>
                            </div>
                            <div style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Active</div>
                        </div>
                        
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin: 20px 0;">
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Students</div>
                                <div style="font-size: 18px; font-weight: 700; color: #ff6a00;">45</div>
                            </div>
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Assignments</div>
                                <div style="font-size: 18px; font-weight: 700; color: #ff6a00;">3</div>
                            </div>
                            <div style="background: #f8f9fa; padding: 12px; border-radius: 10px; text-align: center;">
                                <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Avg Grade</div>
                                <div style="font-size: 18px; font-weight: 700; color: #ff6a00;">A</div>
                            </div>
                        </div>

                        <div style="margin: 15px 0;">
                            <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 8px;">Course Completion: 80%</div>
                            <div style="background: #f0f0f0; border-radius: 10px; height: 8px; overflow: hidden;">
                                <div style="background: linear-gradient(90deg, #ff6a00 0%, #ee0979 100%); height: 100%; width: 80%; border-radius: 10px;"></div>
                            </div>
                        </div>

                        <div style="display: flex; gap: 8px; margin-top: 20px;">
                            <button style="flex: 1; background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%); color: white; border: none; padding: 10px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                <i class="fas fa-eye"></i> View Details
                            </button>
                            <button style="background: #f8f9fa; color: #ff6a00; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button style="background: #f8f9fa; color: #ff6a00; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;">
                                <i class="fas fa-chart-bar"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Schedule This Week -->
            <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); margin-bottom: 30px;">
                <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-calendar-week" style="margin-right: 10px; color: #4facfe;"></i>Teaching Schedule This Week</h2>
                
                <div style="display: grid; gap: 15px;">
                    <!-- Monday -->
                    <div style="background: #f8f9fa; border-radius: 12px; padding: 20px;">
                        <div style="font-weight: 700; color: #2c3e50; margin-bottom: 15px; font-size: 15px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-calendar-day" style="color: #6a11cb;"></i> Monday, Dec 22
                        </div>
                        <div style="display: grid; gap: 12px;">
                            <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #6a11cb; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <div style="font-weight: 600; color: #2c3e50; font-size: 15px; margin-bottom: 5px;">CS301 - Web Development</div>
                                    <div style="color: #7f8c8d; font-size: 13px;"><i class="fas fa-map-marker-alt"></i> Room A-301 • <i class="fas fa-users"></i> 58 students</div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 700; color: #6a11cb; font-size: 15px;">08:00 AM</div>
                                    <div style="color: #7f8c8d; font-size: 12px;">90 min</div>
                                </div>
                            </div>
                            <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #43e97b; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <div style="font-weight: 600; color: #2c3e50; font-size: 15px; margin-bottom: 5px;">CS201 - Data Structures</div>
                                    <div style="color: #7f8c8d; font-size: 13px;"><i class="fas fa-map-marker-alt"></i> Room B-204 • <i class="fas fa-users"></i> 62 students</div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 700; color: #43e97b; font-size: 15px;">02:00 PM</div>
                                    <div style="color: #7f8c8d; font-size: 12px;">60 min</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wednesday -->
                    <div style="background: #f8f9fa; border-radius: 12px; padding: 20px;">
                        <div style="font-weight: 700; color: #2c3e50; margin-bottom: 15px; font-size: 15px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-calendar-day" style="color: #4facfe;"></i> Wednesday, Dec 24
                        </div>
                        <div style="display: grid; gap: 12px;">
                            <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #4facfe; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <div style="font-weight: 600; color: #2c3e50; font-size: 15px; margin-bottom: 5px;">CS302 - Database Management</div>
                                    <div style="color: #7f8c8d; font-size: 13px;"><i class="fas fa-map-marker-alt"></i> Lab C-101 • <i class="fas fa-users"></i> 45 students</div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 700; color: #4facfe; font-size: 15px;">10:00 AM</div>
                                    <div style="color: #7f8c8d; font-size: 12px;">120 min</div>
                                </div>
                            </div>
                            <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #fa709a; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <div style="font-weight: 600; color: #2c3e50; font-size: 15px; margin-bottom: 5px;">CS402 - Computer Networks</div>
                                    <div style="color: #7f8c8d; font-size: 13px;"><i class="fas fa-map-marker-alt"></i> Room D-215 • <i class="fas fa-users"></i> 38 students</div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 700; color: #fa709a; font-size: 15px;">03:00 PM</div>
                                    <div style="color: #7f8c8d; font-size: 12px;">90 min</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Friday -->
                    <div style="background: #f8f9fa; border-radius: 12px; padding: 20px;">
                        <div style="font-weight: 700; color: #2c3e50; margin-bottom: 15px; font-size: 15px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-calendar-day" style="color: #ff6a00;"></i> Friday, Dec 26
                        </div>
                        <div style="display: grid; gap: 12px;">
                            <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #ff6a00; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <div style="font-weight: 600; color: #2c3e50; font-size: 15px; margin-bottom: 5px;">CS303 - Software Engineering</div>
                                    <div style="color: #7f8c8d; font-size: 13px;"><i class="fas fa-map-marker-alt"></i> Room E-102 • <i class="fas fa-users"></i> 45 students</div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 700; color: #ff6a00; font-size: 15px;">09:00 AM</div>
                                    <div style="color: #7f8c8d; font-size: 12px;">90 min</div>
                                </div>
                            </div>
                            <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #6a11cb; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <div style="font-weight: 600; color: #2c3e50; font-size: 15px; margin-bottom: 5px;">CS301 - Web Development</div>
                                    <div style="color: #7f8c8d; font-size: 13px;"><i class="fas fa-map-marker-alt"></i> Lab A-105 • <i class="fas fa-users"></i> 58 students</div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 700; color: #6a11cb; font-size: 15px;">11:30 AM</div>
                                    <div style="color: #7f8c8d; font-size: 12px;">90 min</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-history" style="margin-right: 10px; color: #fa709a;"></i>Recent Activities</h2>
                
                <div style="display: grid; gap: 12px;">
                    <div style="display: flex; gap: 15px; padding: 15px; background: #f8f9fa; border-radius: 10px;">
                        <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                            <i class="fas fa-file-upload" style="font-size: 18px;"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 600; color: #2c3e50; margin-bottom: 5px;">Uploaded lecture slides</div>
                            <div style="font-size: 13px; color: #7f8c8d;">CS301 - Web Development • Chapter 5: JavaScript Fundamentals</div>
                            <div style="font-size: 12px; color: #95a5a6; margin-top: 5px;"><i class="fas fa-clock"></i> 2 hours ago</div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 15px; padding: 15px; background: #f8f9fa; border-radius: 10px;">
                        <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                            <i class="fas fa-check-double" style="font-size: 18px;"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 600; color: #2c3e50; margin-bottom: 5px;">Graded assignments</div>
                            <div style="font-size: 13px; color: #7f8c8d;">CS302 - Database Management • Assignment 3: SQL Queries</div>
                            <div style="font-size: 12px; color: #95a5a6; margin-top: 5px;"><i class="fas fa-clock"></i> 5 hours ago</div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 15px; padding: 15px; background: #f8f9fa; border-radius: 10px;">
                        <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                            <i class="fas fa-calendar-plus" style="font-size: 18px;"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 600; color: #2c3e50; margin-bottom: 5px;">Scheduled exam</div>
                            <div style="font-size: 13px; color: #7f8c8d;">CS201 - Data Structures • Midterm Exam - Jan 15, 2026</div>
                            <div style="font-size: 12px; color: #95a5a6; margin-top: 5px;"><i class="fas fa-clock"></i> Yesterday</div>
                        </div>
                    </div>

                    <div style="display: flex; gap: 15px; padding: 15px; background: #f8f9fa; border-radius: 10px;">
                        <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                            <i class="fas fa-bullhorn" style="font-size: 18px;"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 600; color: #2c3e50; margin-bottom: 5px;">Posted announcement</div>
                            <div style="font-size: 13px; color: #7f8c8d;">CS303 - Software Engineering • Project deadline extended</div>
                            <div style="font-size: 12px; color: #95a5a6; margin-top: 5px;"><i class="fas fa-clock"></i> 2 days ago</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End My Courses Dashboard Section -->

        <!-- Students Dashboard Section -->
        <div id="studentsSection" style="display: none;">
            <div class="section-header-main" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding: 25px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 15px; color: white; box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);">
                <div>
                    <h1 style="margin: 0; font-size: 28px; font-weight: 700;"><i class="fas fa-users" style="margin-right: 10px;"></i>Students Management</h1>
                    <p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">View and manage all students across your courses</p>
                </div>
                <button onclick="alert('Add new student')" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 12px 24px; border-radius: 10px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px; font-size: 14px; transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                    <i class="fas fa-user-plus"></i> Add Student
                </button>
            </div>

            <!-- Student Stats Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
                <!-- Total Students Card -->
                <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Total Students</div>
                            <div style="font-size: 36px; font-weight: 700;">248</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-graduate" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-arrow-up"></i> 15 new this semester</div>
                </div>

                <!-- Active Students Card -->
                <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(67, 233, 123, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Active Students</div>
                            <div style="font-size: 36px; font-weight: 700;">235</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user-check" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-check-circle"></i> 95% attendance</div>
                </div>

                <!-- Avg Performance Card -->
                <div style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(250, 112, 154, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Avg Performance</div>
                            <div style="font-size: 36px; font-weight: 700;">B+</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-chart-line" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-arrow-up"></i> 8% improvement</div>
                </div>

                <!-- At Risk Card -->
                <div style="background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(255, 106, 0, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">At Risk</div>
                            <div style="font-size: 36px; font-weight: 700;">13</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-exclamation-triangle" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-info-circle"></i> Need attention</div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); margin-bottom: 30px;">
                <div style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center;">
                    <div style="flex: 1; min-width: 250px;">
                        <input type="text" placeholder="Search by name, ID, or email..." style="width: 100%; padding: 12px 15px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 14px;">
                    </div>
                    <select style="padding: 12px 15px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 14px; cursor: pointer;">
                        <option>All Courses</option>
                        <option>CS301 - Web Development</option>
                        <option>CS302 - Database Management</option>
                        <option>CS201 - Data Structures</option>
                        <option>CS402 - Computer Networks</option>
                        <option>CS303 - Software Engineering</option>
                    </select>
                    <select style="padding: 12px 15px; border: 1px solid #e0e0e0; border-radius: 10px; font-size: 14px; cursor: pointer;">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>At Risk</option>
                        <option>Excellent</option>
                    </select>
                    <button style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none; padding: 12px 20px; border-radius: 10px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                        <i class="fas fa-filter"></i> Apply Filters
                    </button>
                </div>
            </div>

            <!-- Students List -->
            <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); margin-bottom: 30px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                    <h2 style="margin: 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-list" style="margin-right: 10px; color: #4facfe;"></i>All Students</h2>
                    <div style="display: flex; gap: 10px;">
                        <button style="background: #f8f9fa; color: #2c3e50; border: 1px solid #e0e0e0; padding: 8px 15px; border-radius: 8px; cursor: pointer; font-size: 13px;">
                            <i class="fas fa-download"></i> Export
                        </button>
                        <button style="background: #f8f9fa; color: #2c3e50; border: 1px solid #e0e0e0; padding: 8px 15px; border-radius: 8px; cursor: pointer; font-size: 13px;">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </div>
                </div>

                <!-- Students Table -->
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f8f9fa; border-bottom: 2px solid #e0e0e0;">
                                <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Student</th>
                                <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Student ID</th>
                                <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Email</th>
                                <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Course</th>
                                <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Performance</th>
                                <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Attendance</th>
                                <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Status</th>
                                <th style="padding: 15px; text-align: center; font-weight: 600; color: #2c3e50; font-size: 13px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Student 1 -->
                            <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 14px;">JS</div>
                                        <div>
                                            <div style="font-weight: 600; color: #2c3e50; font-size: 14px;">John Smith</div>
                                            <div style="font-size: 12px; color: #7f8c8d;">Computer Science</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 15px; color: #2c3e50; font-size: 14px;">STU2024001</td>
                                <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">john.smith@university.edu</td>
                                <td style="padding: 15px; color: #2c3e50; font-size: 13px;">CS301</td>
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="flex: 1; background: #f0f0f0; border-radius: 10px; height: 8px; max-width: 80px;">
                                            <div style="background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%); height: 100%; width: 85%; border-radius: 10px;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #43e97b; font-size: 13px;">A-</span>
                                    </div>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="font-weight: 600; color: #2c3e50; font-size: 14px;">92%</span>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Excellent</span>
                                </td>
                                <td style="padding: 15px; text-align: center;">
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer; margin-right: 5px;" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer; margin-right: 5px;" title="Message">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer;" title="More">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Student 2 -->
                            <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 14px;">EM</div>
                                        <div>
                                            <div style="font-weight: 600; color: #2c3e50; font-size: 14px;">Emily Martinez</div>
                                            <div style="font-size: 12px; color: #7f8c8d;">Computer Science</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 15px; color: #2c3e50; font-size: 14px;">STU2024002</td>
                                <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">emily.martinez@university.edu</td>
                                <td style="padding: 15px; color: #2c3e50; font-size: 13px;">CS302</td>
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="flex: 1; background: #f0f0f0; border-radius: 10px; height: 8px; max-width: 80px;">
                                            <div style="background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%); height: 100%; width: 78%; border-radius: 10px;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #43e97b; font-size: 13px;">B+</span>
                                    </div>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="font-weight: 600; color: #2c3e50; font-size: 14px;">88%</span>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Active</span>
                                </td>
                                <td style="padding: 15px; text-align: center;">
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer; margin-right: 5px;" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer; margin-right: 5px;" title="Message">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer;" title="More">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Student 3 -->
                            <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 14px;">MC</div>
                                        <div>
                                            <div style="font-weight: 600; color: #2c3e50; font-size: 14px;">Michael Chen</div>
                                            <div style="font-size: 12px; color: #7f8c8d;">Computer Science</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 15px; color: #2c3e50; font-size: 14px;">STU2024003</td>
                                <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">michael.chen@university.edu</td>
                                <td style="padding: 15px; color: #2c3e50; font-size: 13px;">CS201</td>
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="flex: 1; background: #f0f0f0; border-radius: 10px; height: 8px; max-width: 80px;">
                                            <div style="background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%); height: 100%; width: 95%; border-radius: 10px;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #43e97b; font-size: 13px;">A+</span>
                                    </div>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="font-weight: 600; color: #2c3e50; font-size: 14px;">98%</span>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Excellent</span>
                                </td>
                                <td style="padding: 15px; text-align: center;">
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer; margin-right: 5px;" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer; margin-right: 5px;" title="Message">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer;" title="More">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Student 4 -->
                            <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 14px;">SJ</div>
                                        <div>
                                            <div style="font-weight: 600; color: #2c3e50; font-size: 14px;">Sarah Johnson</div>
                                            <div style="font-size: 12px; color: #7f8c8d;">Computer Science</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 15px; color: #2c3e50; font-size: 14px;">STU2024004</td>
                                <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">sarah.johnson@university.edu</td>
                                <td style="padding: 15px; color: #2c3e50; font-size: 13px;">CS402</td>
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="flex: 1; background: #f0f0f0; border-radius: 10px; height: 8px; max-width: 80px;">
                                            <div style="background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%); height: 100%; width: 72%; border-radius: 10px;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #43e97b; font-size: 13px;">B</span>
                                    </div>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="font-weight: 600; color: #2c3e50; font-size: 14px;">85%</span>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Active</span>
                                </td>
                                <td style="padding: 15px; text-align: center;">
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer; margin-right: 5px;" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer; margin-right: 5px;" title="Message">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer;" title="More">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Student 5 -->
                            <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 14px;">DW</div>
                                        <div>
                                            <div style="font-weight: 600; color: #2c3e50; font-size: 14px;">David Wilson</div>
                                            <div style="font-size: 12px; color: #7f8c8d;">Computer Science</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 15px; color: #2c3e50; font-size: 14px;">STU2024005</td>
                                <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">david.wilson@university.edu</td>
                                <td style="padding: 15px; color: #2c3e50; font-size: 13px;">CS303</td>
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="flex: 1; background: #f0f0f0; border-radius: 10px; height: 8px; max-width: 80px;">
                                            <div style="background: linear-gradient(90deg, #ff6a00 0%, #ee0979 100%); height: 100%; width: 55%; border-radius: 10px;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #ff6a00; font-size: 13px;">C+</span>
                                    </div>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="font-weight: 600; color: #2c3e50; font-size: 14px;">68%</span>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="background: #fee; color: #e74c3c; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">At Risk</span>
                                </td>
                                <td style="padding: 15px; text-align: center;">
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer; margin-right: 5px;" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer; margin-right: 5px;" title="Message">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer;" title="More">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Student 6 -->
                            <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 14px;">LA</div>
                                        <div>
                                            <div style="font-weight: 600; color: #2c3e50; font-size: 14px;">Lisa Anderson</div>
                                            <div style="font-size: 12px; color: #7f8c8d;">Computer Science</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 15px; color: #2c3e50; font-size: 14px;">STU2024006</td>
                                <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">lisa.anderson@university.edu</td>
                                <td style="padding: 15px; color: #2c3e50; font-size: 13px;">CS301</td>
                                <td style="padding: 15px;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="flex: 1; background: #f0f0f0; border-radius: 10px; height: 8px; max-width: 80px;">
                                            <div style="background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%); height: 100%; width: 88%; border-radius: 10px;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #43e97b; font-size: 13px;">A</span>
                                    </div>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="font-weight: 600; color: #2c3e50; font-size: 14px;">94%</span>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Excellent</span>
                                </td>
                                <td style="padding: 15px; text-align: center;">
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer; margin-right: 5px;" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer; margin-right: 5px;" title="Message">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 6px 12px; border-radius: 6px; cursor: pointer;" title="More">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 25px; padding-top: 20px; border-top: 1px solid #f0f0f0;">
                    <div style="color: #7f8c8d; font-size: 14px;">Showing 1-6 of 248 students</div>
                    <div style="display: flex; gap: 8px;">
                        <button style="background: #f8f9fa; color: #7f8c8d; border: 1px solid #e0e0e0; padding: 8px 12px; border-radius: 6px; cursor: pointer;">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none; padding: 8px 12px; border-radius: 6px; cursor: pointer; font-weight: 600;">1</button>
                        <button style="background: #f8f9fa; color: #2c3e50; border: 1px solid #e0e0e0; padding: 8px 12px; border-radius: 6px; cursor: pointer;">2</button>
                        <button style="background: #f8f9fa; color: #2c3e50; border: 1px solid #e0e0e0; padding: 8px 12px; border-radius: 6px; cursor: pointer;">3</button>
                        <button style="background: #f8f9fa; color: #2c3e50; border: 1px solid #e0e0e0; padding: 8px 12px; border-radius: 6px; cursor: pointer;">...</button>
                        <button style="background: #f8f9fa; color: #2c3e50; border: 1px solid #e0e0e0; padding: 8px 12px; border-radius: 6px; cursor: pointer;">42</button>
                        <button style="background: #f8f9fa; color: #2c3e50; border: 1px solid #e0e0e0; padding: 8px 12px; border-radius: 6px; cursor: pointer;">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Performance Overview Chart -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                <!-- Performance Distribution -->
                <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                    <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-chart-bar" style="margin-right: 10px; color: #6a11cb;"></i>Performance Distribution</h2>
                    
                    <div style="display: grid; gap: 15px;">
                        <div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                <span style="color: #2c3e50; font-weight: 600; font-size: 14px;">Grade A (90-100)</span>
                                <span style="color: #43e97b; font-weight: 700; font-size: 14px;">82 students (33%)</span>
                            </div>
                            <div style="background: #f0f0f0; border-radius: 10px; height: 12px; overflow: hidden;">
                                <div style="background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%); height: 100%; width: 33%; border-radius: 10px;"></div>
                            </div>
                        </div>
                        <div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                <span style="color: #2c3e50; font-weight: 600; font-size: 14px;">Grade B (80-89)</span>
                                <span style="color: #4facfe; font-weight: 700; font-size: 14px;">98 students (40%)</span>
                            </div>
                            <div style="background: #f0f0f0; border-radius: 10px; height: 12px; overflow: hidden;">
                                <div style="background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%); height: 100%; width: 40%; border-radius: 10px;"></div>
                            </div>
                        </div>
                        <div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                <span style="color: #2c3e50; font-weight: 600; font-size: 14px;">Grade C (70-79)</span>
                                <span style="color: #fa709a; font-weight: 700; font-size: 14px;">50 students (20%)</span>
                            </div>
                            <div style="background: #f0f0f0; border-radius: 10px; height: 12px; overflow: hidden;">
                                <div style="background: linear-gradient(90deg, #fa709a 0%, #fee140 100%); height: 100%; width: 20%; border-radius: 10px;"></div>
                            </div>
                        </div>
                        <div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                <span style="color: #2c3e50; font-weight: 600; font-size: 14px;">Below C (<70)</span>
                                <span style="color: #ff6a00; font-weight: 700; font-size: 14px;">18 students (7%)</span>
                            </div>
                            <div style="background: #f0f0f0; border-radius: 10px; height: 12px; overflow: hidden;">
                                <div style="background: linear-gradient(90deg, #ff6a00 0%, #ee0979 100%); height: 100%; width: 7%; border-radius: 10px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Performers -->
                <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                    <h2 style="margin: 0 0 20px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-trophy" style="margin-right: 10px; color: #ffd700;"></i>Top Performers</h2>
                    
                    <div style="display: grid; gap: 15px;">
                        <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #f8f9fa; border-radius: 10px;">
                            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 12px;">1</div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #2c3e50; font-size: 13px;">Michael Chen</div>
                                <div style="font-size: 11px; color: #7f8c8d;">GPA: 4.0</div>
                            </div>
                            <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 4px 10px; border-radius: 15px; font-size: 11px; font-weight: 700;">A+</div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #f8f9fa; border-radius: 10px;">
                            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #c0c0c0 0%, #e8e8e8 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 12px;">2</div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #2c3e50; font-size: 13px;">Lisa Anderson</div>
                                <div style="font-size: 11px; color: #7f8c8d;">GPA: 3.9</div>
                            </div>
                            <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 4px 10px; border-radius: 15px; font-size: 11px; font-weight: 700;">A</div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px; padding: 12px; background: #f8f9fa; border-radius: 10px;">
                            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #cd7f32 0%, #d4a574 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 12px;">3</div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #2c3e50; font-size: 13px;">John Smith</div>
                                <div style="font-size: 11px; color: #7f8c8d;">GPA: 3.7</div>
                            </div>
                            <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 4px 10px; border-radius: 15px; font-size: 11px; font-weight: 700;">A-</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Students Dashboard Section -->

        <!-- Assignments Dashboard Section -->
        <div id="assignmentsSection" style="display: none;">
            <div class="section-header-main" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding: 25px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 15px; color: white; box-shadow: 0 10px 30px rgba(67, 233, 123, 0.3);">
                <div>
                    <h1 style="margin: 0; font-size: 28px; font-weight: 700;"><i class="fas fa-tasks" style="margin-right: 10px;"></i>Assignments Management</h1>
                    <p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">Create, manage and grade assignments for your courses</p>
                </div>
                <button onclick="alert('Create new assignment')" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 12px 24px; border-radius: 10px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px; font-size: 14px; transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                    <i class="fas fa-plus"></i> Create Assignment
                </button>
            </div>

            <!-- Assignment Stats Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
                <!-- Total Assignments Card -->
                <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(67, 233, 123, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Total Assignments</div>
                            <div style="font-size: 36px; font-weight: 700;">42</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-tasks" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-calendar"></i> This semester</div>
                </div>

                <!-- Active Assignments Card -->
                <div style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(106, 17, 203, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Active Assignments</div>
                            <div style="font-size: 36px; font-weight: 700;">18</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-clock" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-hourglass-half"></i> Currently open</div>
                </div>

                <!-- Pending Grading Card -->
                <div style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(250, 112, 154, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Pending Grading</div>
                            <div style="font-size: 36px; font-weight: 700;">127</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-clipboard-check" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-exclamation-circle"></i> Need review</div>
                </div>

                <!-- Avg Submission Rate Card -->
                <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Submission Rate</div>
                            <div style="font-size: 36px; font-weight: 700;">89%</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-chart-line" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-arrow-up"></i> Above average</div>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div style="background: white; border-radius: 15px; padding: 20px 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); margin-bottom: 30px;">
                <div style="display: flex; gap: 20px; border-bottom: 2px solid #f0f0f0;">
                    <button onclick="showAssignmentTab('active')" id="assignmentTabActive" style="background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #43e97b; border-bottom: 3px solid #43e97b; margin-bottom: -2px; font-size: 14px;">
                        <i class="fas fa-clock"></i> Active (18)
                    </button>
                    <button onclick="showAssignmentTab('grading')" id="assignmentTabGrading" style="background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #7f8c8d; border-bottom: 3px solid transparent; margin-bottom: -2px; font-size: 14px;">
                        <i class="fas fa-clipboard-check"></i> Pending Grading (127)
                    </button>
                    <button onclick="showAssignmentTab('completed')" id="assignmentTabCompleted" style="background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #7f8c8d; border-bottom: 3px solid transparent; margin-bottom: -2px; font-size: 14px;">
                        <i class="fas fa-check-circle"></i> Completed (24)
                    </button>
                </div>
            </div>

            <!-- Active Assignments Tab -->
            <div id="activeAssignmentsTab" style="display: block;">
                <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); margin-bottom: 30px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                        <h2 style="margin: 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-list" style="margin-right: 10px; color: #43e97b;"></i>Active Assignments</h2>
                        <select style="padding: 10px 15px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 14px; cursor: pointer;">
                            <option>All Courses</option>
                            <option>CS301 - Web Development</option>
                            <option>CS302 - Database Management</option>
                            <option>CS201 - Data Structures</option>
                        </select>
                    </div>

                    <!-- Assignments Grid -->
                    <div style="display: grid; gap: 20px;">
                        <!-- Assignment 1 -->
                        <div style="border: 2px solid #f0f0f0; border-radius: 12px; padding: 20px; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 5px 20px rgba(67,233,123,0.2)'; this.style.borderColor='#43e97b'" onmouseout="this.style.boxShadow='none'; this.style.borderColor='#f0f0f0'">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <i class="fas fa-code" style="font-size: 22px;"></i>
                                        </div>
                                        <div style="flex: 1;">
                                            <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">JavaScript Functions & Arrays</h3>
                                            <div style="font-size: 13px; color: #7f8c8d;">CS301 - Web Development</div>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Active</span>
                                    <span style="background: #fff3e0; color: #f39c12; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Due in 3 days</span>
                                </div>
                            </div>

                            <p style="color: #7f8c8d; margin: 0 0 15px 0; font-size: 14px; line-height: 1.6;">Create a comprehensive JavaScript program demonstrating advanced array methods and function concepts...</p>

                            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin: 15px 0;">
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Due Date</div>
                                    <div style="font-weight: 700; color: #2c3e50; font-size: 13px;">Dec 25</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Submissions</div>
                                    <div style="font-weight: 700; color: #43e97b; font-size: 13px;">45/58</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Graded</div>
                                    <div style="font-weight: 700; color: #fa709a; font-size: 13px;">12/45</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Avg Score</div>
                                    <div style="font-weight: 700; color: #6a11cb; font-size: 13px;">82%</div>
                                </div>
                            </div>

                            <div style="margin: 15px 0;">
                                <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 8px;">Submission Progress</div>
                                <div style="background: #f0f0f0; border-radius: 10px; height: 8px; overflow: hidden;">
                                    <div style="background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%); height: 100%; width: 78%; border-radius: 10px;"></div>
                                </div>
                            </div>

                            <div style="display: flex; gap: 8px; margin-top: 15px;">
                                <button style="flex: 1; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border: none; padding: 10px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                    <i class="fas fa-clipboard-check"></i> Grade Submissions
                                </button>
                                <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Download">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Assignment 2 -->
                        <div style="border: 2px solid #f0f0f0; border-radius: 12px; padding: 20px; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 5px 20px rgba(67,233,123,0.2)'; this.style.borderColor='#43e97b'" onmouseout="this.style.boxShadow='none'; this.style.borderColor='#f0f0f0'">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <i class="fas fa-database" style="font-size: 22px;"></i>
                                        </div>
                                        <div style="flex: 1;">
                                            <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">SQL Query Optimization</h3>
                                            <div style="font-size: 13px; color: #7f8c8d;">CS302 - Database Management</div>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Active</span>
                                    <span style="background: #ffebee; color: #e74c3c; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Due tomorrow</span>
                                </div>
                            </div>

                            <p style="color: #7f8c8d; margin: 0 0 15px 0; font-size: 14px; line-height: 1.6;">Write and optimize complex SQL queries for the given database schema...</p>

                            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin: 15px 0;">
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Due Date</div>
                                    <div style="font-weight: 700; color: #2c3e50; font-size: 13px;">Dec 23</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Submissions</div>
                                    <div style="font-weight: 700; color: #43e97b; font-size: 13px;">38/45</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Graded</div>
                                    <div style="font-weight: 700; color: #fa709a; font-size: 13px;">25/38</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Avg Score</div>
                                    <div style="font-weight: 700; color: #6a11cb; font-size: 13px;">88%</div>
                                </div>
                            </div>

                            <div style="margin: 15px 0;">
                                <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 8px;">Submission Progress</div>
                                <div style="background: #f0f0f0; border-radius: 10px; height: 8px; overflow: hidden;">
                                    <div style="background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%); height: 100%; width: 84%; border-radius: 10px;"></div>
                                </div>
                            </div>

                            <div style="display: flex; gap: 8px; margin-top: 15px;">
                                <button style="flex: 1; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; border: none; padding: 10px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                    <i class="fas fa-clipboard-check"></i> Grade Submissions
                                </button>
                                <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button style="background: #f8f9fa; color: #4facfe; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Download">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Assignment 3 -->
                        <div style="border: 2px solid #f0f0f0; border-radius: 12px; padding: 20px; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 5px 20px rgba(67,233,123,0.2)'; this.style.borderColor='#43e97b'" onmouseout="this.style.boxShadow='none'; this.style.borderColor='#f0f0f0'">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <i class="fas fa-project-diagram" style="font-size: 22px;"></i>
                                        </div>
                                        <div style="flex: 1;">
                                            <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">Binary Tree Implementation</h3>
                                            <div style="font-size: 13px; color: #7f8c8d;">CS201 - Data Structures</div>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Active</span>
                                    <span style="background: #fff3e0; color: #f39c12; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Due in 5 days</span>
                                </div>
                            </div>

                            <p style="color: #7f8c8d; margin: 0 0 15px 0; font-size: 14px; line-height: 1.6;">Implement a complete binary search tree with insert, delete, and traversal operations...</p>

                            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin: 15px 0;">
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Due Date</div>
                                    <div style="font-weight: 700; color: #2c3e50; font-size: 13px;">Dec 27</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Submissions</div>
                                    <div style="font-weight: 700; color: #43e97b; font-size: 13px;">52/62</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Graded</div>
                                    <div style="font-weight: 700; color: #fa709a; font-size: 13px;">30/52</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Avg Score</div>
                                    <div style="font-weight: 700; color: #6a11cb; font-size: 13px;">76%</div>
                                </div>
                            </div>

                            <div style="margin: 15px 0;">
                                <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 8px;">Submission Progress</div>
                                <div style="background: #f0f0f0; border-radius: 10px; height: 8px; overflow: hidden;">
                                    <div style="background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%); height: 100%; width: 84%; border-radius: 10px;"></div>
                                </div>
                            </div>

                            <div style="display: flex; gap: 8px; margin-top: 15px;">
                                <button style="flex: 1; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border: none; padding: 10px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                    <i class="fas fa-clipboard-check"></i> Grade Submissions
                                </button>
                                <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Download">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Grading Tab -->
            <div id="gradingAssignmentsTab" style="display: none;">
                <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                    <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-clipboard-list" style="margin-right: 10px; color: #fa709a;"></i>Pending Grading</h2>
                    
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background: #f8f9fa; border-bottom: 2px solid #e0e0e0;">
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Student</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Assignment</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Course</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Submitted</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Status</th>
                                    <th style="padding: 15px; text-align: center; font-weight: 600; color: #2c3e50; font-size: 13px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                    <td style="padding: 15px;">
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 12px;">JS</div>
                                            <div style="font-weight: 600; color: #2c3e50; font-size: 14px;">John Smith</div>
                                        </div>
                                    </td>
                                    <td style="padding: 15px; color: #2c3e50; font-size: 14px;">JavaScript Functions</td>
                                    <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">CS301</td>
                                    <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">2 hours ago</td>
                                    <td style="padding: 15px;">
                                        <span style="background: #fff3e0; color: #f39c12; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Pending</span>
                                    </td>
                                    <td style="padding: 15px; text-align: center;">
                                        <button style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                            <i class="fas fa-edit"></i> Grade
                                        </button>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                    <td style="padding: 15px;">
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 12px;">EM</div>
                                            <div style="font-weight: 600; color: #2c3e50; font-size: 14px;">Emily Martinez</div>
                                        </div>
                                    </td>
                                    <td style="padding: 15px; color: #2c3e50; font-size: 14px;">SQL Query Optimization</td>
                                    <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">CS302</td>
                                    <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">5 hours ago</td>
                                    <td style="padding: 15px;">
                                        <span style="background: #fff3e0; color: #f39c12; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Pending</span>
                                    </td>
                                    <td style="padding: 15px; text-align: center;">
                                        <button style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                            <i class="fas fa-edit"></i> Grade
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Completed Assignments Tab -->
            <div id="completedAssignmentsTab" style="display: none;">
                <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                    <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-check-double" style="margin-right: 10px; color: #43e97b;"></i>Completed Assignments</h2>
                    
                    <div style="display: grid; gap: 15px;">
                        <div style="background: #f8f9fa; border-radius: 10px; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
                            <div style="flex: 1;">
                                <h4 style="margin: 0 0 8px 0; font-size: 16px; font-weight: 700; color: #2c3e50;">React Component Design</h4>
                                <div style="font-size: 13px; color: #7f8c8d; margin-bottom: 8px;">CS301 - Web Development • Completed on Dec 15, 2025</div>
                                <div style="display: flex; gap: 15px; font-size: 13px;">
                                    <span style="color: #43e97b; font-weight: 600;"><i class="fas fa-users"></i> 58 submissions</span>
                                    <span style="color: #6a11cb; font-weight: 600;"><i class="fas fa-chart-bar"></i> Avg: 85%</span>
                                </div>
                            </div>
                            <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600;">
                                <i class="fas fa-eye"></i> View Results
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Assignments Dashboard Section -->

        <!-- Exams Dashboard Section -->
        <div id="examsSection" style="display: none;">
            <div class="section-header-main" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding: 25px; background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%); border-radius: 15px; color: white; box-shadow: 0 10px 30px rgba(255, 106, 0, 0.3);">
                <div>
                    <h1 style="margin: 0; font-size: 28px; font-weight: 700;"><i class="fas fa-file-alt" style="margin-right: 10px;"></i>Exams Management</h1>
                    <p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">Create, schedule and manage exams for your courses</p>
                </div>
                <button onclick="alert('Create new exam')" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 12px 24px; border-radius: 10px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px; font-size: 14px; transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                    <i class="fas fa-plus"></i> Create Exam
                </button>
            </div>

            <!-- Exam Stats Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
                <!-- Total Exams Card -->
                <div style="background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(255, 106, 0, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Total Exams</div>
                            <div style="font-size: 36px; font-weight: 700;">18</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-file-alt" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-calendar"></i> This semester</div>
                </div>

                <!-- Upcoming Exams Card -->
                <div style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(106, 17, 203, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Upcoming Exams</div>
                            <div style="font-size: 36px; font-weight: 700;">5</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-clock" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-calendar-check"></i> Next 30 days</div>
                </div>

                <!-- Completed Exams Card -->
                <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(67, 233, 123, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Completed Exams</div>
                            <div style="font-size: 36px; font-weight: 700;">10</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-check-circle" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-trophy"></i> Graded & finalized</div>
                </div>

                <!-- Average Score Card -->
                <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Average Score</div>
                            <div style="font-size: 36px; font-weight: 700;">78%</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-chart-bar" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-arrow-up"></i> +5% from last term</div>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div style="background: white; border-radius: 15px; padding: 20px 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); margin-bottom: 30px;">
                <div style="display: flex; gap: 20px; border-bottom: 2px solid #f0f0f0;">
                    <button onclick="showExamTab('upcoming')" id="examTabUpcoming" style="background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #ff6a00; border-bottom: 3px solid #ff6a00; margin-bottom: -2px; font-size: 14px;">
                        <i class="fas fa-calendar-day"></i> Upcoming (5)
                    </button>
                    <button onclick="showExamTab('completed')" id="examTabCompleted" style="background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #7f8c8d; border-bottom: 3px solid transparent; margin-bottom: -2px; font-size: 14px;">
                        <i class="fas fa-check-double"></i> Completed (10)
                    </button>
                    <button onclick="showExamTab('draft')" id="examTabDraft" style="background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #7f8c8d; border-bottom: 3px solid transparent; margin-bottom: -2px; font-size: 14px;">
                        <i class="fas fa-file-edit"></i> Drafts (3)
                    </button>
                </div>
            </div>

            <!-- Upcoming Exams Tab -->
            <div id="upcomingExamsTab" style="display: block;">
                <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); margin-bottom: 30px;">
                    <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-calendar-alt" style="margin-right: 10px; color: #ff6a00;"></i>Upcoming Exams</h2>

                    <!-- Exams Grid -->
                    <div style="display: grid; gap: 20px;">
                        <!-- Exam 1 - Urgent -->
                        <div style="border: 2px solid #f0f0f0; border-radius: 12px; padding: 20px; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 5px 20px rgba(255,106,0,0.2)'; this.style.borderColor='#ff6a00'" onmouseout="this.style.boxShadow='none'; this.style.borderColor='#f0f0f0'">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <i class="fas fa-code" style="font-size: 22px;"></i>
                                        </div>
                                        <div style="flex: 1;">
                                            <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">Web Development Final Exam</h3>
                                            <div style="font-size: 13px; color: #7f8c8d;">CS301 - Web Development</div>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <span style="background: #ffebee; color: #e74c3c; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Tomorrow</span>
                                    <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Published</span>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px; margin: 15px 0;">
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Date</div>
                                    <div style="font-weight: 700; color: #2c3e50; font-size: 13px;">Dec 23</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Time</div>
                                    <div style="font-weight: 700; color: #2c3e50; font-size: 13px;">10:00 AM</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Duration</div>
                                    <div style="font-weight: 700; color: #ff6a00; font-size: 13px;">2 hours</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Students</div>
                                    <div style="font-weight: 700; color: #6a11cb; font-size: 13px;">58</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Venue</div>
                                    <div style="font-weight: 700; color: #2c3e50; font-size: 13px;">Hall A</div>
                                </div>
                            </div>

                            <div style="background: #fff3e0; border-left: 4px solid #f39c12; padding: 12px 15px; border-radius: 8px; margin: 15px 0;">
                                <div style="font-size: 13px; color: #e67e22; font-weight: 600;"><i class="fas fa-exclamation-triangle"></i> Reminder: Exam is scheduled for tomorrow at 10:00 AM</div>
                            </div>

                            <div style="display: flex; gap: 8px; margin-top: 15px;">
                                <button style="flex: 1; background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%); color: white; border: none; padding: 10px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                <button style="background: #f8f9fa; color: #ff6a00; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button style="background: #f8f9fa; color: #ff6a00; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Print">
                                    <i class="fas fa-print"></i>
                                </button>
                                <button style="background: #f8f9fa; color: #ff6a00; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Send Notification">
                                    <i class="fas fa-bell"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Exam 2 -->
                        <div style="border: 2px solid #f0f0f0; border-radius: 12px; padding: 20px; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 5px 20px rgba(255,106,0,0.2)'; this.style.borderColor='#ff6a00'" onmouseout="this.style.boxShadow='none'; this.style.borderColor='#f0f0f0'">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <i class="fas fa-database" style="font-size: 22px;"></i>
                                        </div>
                                        <div style="flex: 1;">
                                            <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">Database Management Midterm</h3>
                                            <div style="font-size: 13px; color: #7f8c8d;">CS302 - Database Management</div>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <span style="background: #fff3e0; color: #f39c12; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">In 3 days</span>
                                    <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Published</span>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px; margin: 15px 0;">
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Date</div>
                                    <div style="font-weight: 700; color: #2c3e50; font-size: 13px;">Dec 25</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Time</div>
                                    <div style="font-weight: 700; color: #2c3e50; font-size: 13px;">2:00 PM</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Duration</div>
                                    <div style="font-weight: 700; color: #ff6a00; font-size: 13px;">1.5 hours</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Students</div>
                                    <div style="font-weight: 700; color: #6a11cb; font-size: 13px;">45</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Venue</div>
                                    <div style="font-weight: 700; color: #2c3e50; font-size: 13px;">Lab 3</div>
                                </div>
                            </div>

                            <div style="display: flex; gap: 8px; margin-top: 15px;">
                                <button style="flex: 1; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; border: none; padding: 10px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                <button style="background: #f8f9fa; color: #6a11cb; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button style="background: #f8f9fa; color: #6a11cb; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Print">
                                    <i class="fas fa-print"></i>
                                </button>
                                <button style="background: #f8f9fa; color: #6a11cb; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Send Notification">
                                    <i class="fas fa-bell"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Exam 3 -->
                        <div style="border: 2px solid #f0f0f0; border-radius: 12px; padding: 20px; transition: all 0.3s;" onmouseover="this.style.boxShadow='0 5px 20px rgba(255,106,0,0.2)'; this.style.borderColor='#ff6a00'" onmouseout="this.style.boxShadow='none'; this.style.borderColor='#f0f0f0'">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <i class="fas fa-project-diagram" style="font-size: 22px;"></i>
                                        </div>
                                        <div style="flex: 1;">
                                            <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">Data Structures Quiz 3</h3>
                                            <div style="font-size: 13px; color: #7f8c8d;">CS201 - Data Structures</div>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <span style="background: #fff3e0; color: #f39c12; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">In 1 week</span>
                                    <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Published</span>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px; margin: 15px 0;">
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Date</div>
                                    <div style="font-weight: 700; color: #2c3e50; font-size: 13px;">Dec 29</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Time</div>
                                    <div style="font-weight: 700; color: #2c3e50; font-size: 13px;">9:00 AM</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Duration</div>
                                    <div style="font-weight: 700; color: #ff6a00; font-size: 13px;">1 hour</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Students</div>
                                    <div style="font-weight: 700; color: #6a11cb; font-size: 13px;">62</div>
                                </div>
                                <div style="background: #f8f9fa; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 11px; color: #7f8c8d; margin-bottom: 5px;">Venue</div>
                                    <div style="font-weight: 700; color: #2c3e50; font-size: 13px;">Hall C</div>
                                </div>
                            </div>

                            <div style="display: flex; gap: 8px; margin-top: 15px;">
                                <button style="flex: 1; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border: none; padding: 10px; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Print">
                                    <i class="fas fa-print"></i>
                                </button>
                                <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 10px 15px; border-radius: 8px; cursor: pointer;" title="Send Notification">
                                    <i class="fas fa-bell"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exam Calendar View -->
                <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                    <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-calendar-week" style="margin-right: 10px; color: #ff6a00;"></i>Exam Schedule</h2>
                    
                    <div style="display: grid; gap: 12px;">
                        <div style="display: grid; grid-template-columns: 100px 1fr; gap: 15px; padding: 15px; background: #f8f9fa; border-radius: 10px; border-left: 4px solid #ff6a00;">
                            <div>
                                <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 4px;">Dec 23</div>
                                <div style="font-weight: 700; color: #2c3e50; font-size: 16px;">Tomorrow</div>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #2c3e50; margin-bottom: 5px;">Web Development Final Exam</div>
                                <div style="font-size: 13px; color: #7f8c8d;"><i class="fas fa-clock"></i> 10:00 AM - 12:00 PM • Hall A • 58 Students</div>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 100px 1fr; gap: 15px; padding: 15px; background: #f8f9fa; border-radius: 10px; border-left: 4px solid #6a11cb;">
                            <div>
                                <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 4px;">Dec 25</div>
                                <div style="font-weight: 700; color: #2c3e50; font-size: 16px;">In 3 Days</div>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #2c3e50; margin-bottom: 5px;">Database Management Midterm</div>
                                <div style="font-size: 13px; color: #7f8c8d;"><i class="fas fa-clock"></i> 2:00 PM - 3:30 PM • Lab 3 • 45 Students</div>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 100px 1fr; gap: 15px; padding: 15px; background: #f8f9fa; border-radius: 10px; border-left: 4px solid #43e97b;">
                            <div>
                                <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 4px;">Dec 29</div>
                                <div style="font-weight: 700; color: #2c3e50; font-size: 16px;">In 1 Week</div>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #2c3e50; margin-bottom: 5px;">Data Structures Quiz 3</div>
                                <div style="font-size: 13px; color: #7f8c8d;"><i class="fas fa-clock"></i> 9:00 AM - 10:00 AM • Hall C • 62 Students</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Completed Exams Tab -->
            <div id="completedExamsTab" style="display: none;">
                <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                    <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-check-circle" style="margin-right: 10px; color: #43e97b;"></i>Completed Exams</h2>
                    
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background: #f8f9fa; border-bottom: 2px solid #e0e0e0;">
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Exam Name</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Course</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Date</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Participants</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Avg Score</th>
                                    <th style="padding: 15px; text-align: center; font-weight: 600; color: #2c3e50; font-size: 13px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                    <td style="padding: 15px; font-weight: 600; color: #2c3e50; font-size: 14px;">React Fundamentals Midterm</td>
                                    <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">CS301</td>
                                    <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">Dec 15, 2025</td>
                                    <td style="padding: 15px; color: #2c3e50; font-size: 13px;">58/58</td>
                                    <td style="padding: 15px;">
                                        <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">84%</span>
                                    </td>
                                    <td style="padding: 15px; text-align: center;">
                                        <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 8px 15px; border-radius: 6px; cursor: pointer; margin-right: 5px;">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                        <button style="background: #f8f9fa; color: #6a11cb; border: 1px solid #e0e0e0; padding: 8px 15px; border-radius: 6px; cursor: pointer;">
                                            <i class="fas fa-download"></i> Export
                                        </button>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                    <td style="padding: 15px; font-weight: 600; color: #2c3e50; font-size: 14px;">SQL Basics Quiz 2</td>
                                    <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">CS302</td>
                                    <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">Dec 10, 2025</td>
                                    <td style="padding: 15px; color: #2c3e50; font-size: 13px;">45/45</td>
                                    <td style="padding: 15px;">
                                        <span style="background: #fff3e0; color: #f39c12; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">72%</span>
                                    </td>
                                    <td style="padding: 15px; text-align: center;">
                                        <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 8px 15px; border-radius: 6px; cursor: pointer; margin-right: 5px;">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                        <button style="background: #f8f9fa; color: #6a11cb; border: 1px solid #e0e0e0; padding: 8px 15px; border-radius: 6px; cursor: pointer;">
                                            <i class="fas fa-download"></i> Export
                                        </button>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                    <td style="padding: 15px; font-weight: 600; color: #2c3e50; font-size: 14px;">Trees & Graphs Final</td>
                                    <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">CS201</td>
                                    <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">Dec 5, 2025</td>
                                    <td style="padding: 15px; color: #2c3e50; font-size: 13px;">62/62</td>
                                    <td style="padding: 15px;">
                                        <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">79%</span>
                                    </td>
                                    <td style="padding: 15px; text-align: center;">
                                        <button style="background: #f8f9fa; color: #43e97b; border: 1px solid #e0e0e0; padding: 8px 15px; border-radius: 6px; cursor: pointer; margin-right: 5px;">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                        <button style="background: #f8f9fa; color: #6a11cb; border: 1px solid #e0e0e0; padding: 8px 15px; border-radius: 6px; cursor: pointer;">
                                            <i class="fas fa-download"></i> Export
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Draft Exams Tab -->
            <div id="draftExamsTab" style="display: none;">
                <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                    <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-file-edit" style="margin-right: 10px; color: #f39c12;"></i>Draft Exams</h2>
                    
                    <div style="display: grid; gap: 15px;">
                        <div style="background: #f8f9fa; border-radius: 10px; padding: 20px; border: 2px dashed #e0e0e0;">
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <div style="flex: 1;">
                                    <h4 style="margin: 0 0 8px 0; font-size: 16px; font-weight: 700; color: #2c3e50;">Advanced JavaScript Final</h4>
                                    <div style="font-size: 13px; color: #7f8c8d; margin-bottom: 10px;">CS301 - Web Development</div>
                                    <div style="display: flex; gap: 10px; font-size: 13px;">
                                        <span style="background: #fff3e0; color: #f39c12; padding: 4px 10px; border-radius: 15px; font-weight: 600;"><i class="fas fa-edit"></i> Draft</span>
                                        <span style="color: #7f8c8d;">Last edited: 2 days ago</span>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <button style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                        <i class="fas fa-edit"></i> Continue Editing
                                    </button>
                                    <button style="background: #f8f9fa; color: #e74c3c; border: 1px solid #e0e0e0; padding: 8px 12px; border-radius: 6px; cursor: pointer;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div style="background: #f8f9fa; border-radius: 10px; padding: 20px; border: 2px dashed #e0e0e0;">
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <div style="flex: 1;">
                                    <h4 style="margin: 0 0 8px 0; font-size: 16px; font-weight: 700; color: #2c3e50;">Normalization Quiz</h4>
                                    <div style="font-size: 13px; color: #7f8c8d; margin-bottom: 10px;">CS302 - Database Management</div>
                                    <div style="display: flex; gap: 10px; font-size: 13px;">
                                        <span style="background: #fff3e0; color: #f39c12; padding: 4px 10px; border-radius: 15px; font-weight: 600;"><i class="fas fa-edit"></i> Draft</span>
                                        <span style="color: #7f8c8d;">Last edited: 1 week ago</span>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <button style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                        <i class="fas fa-edit"></i> Continue Editing
                                    </button>
                                    <button style="background: #f8f9fa; color: #e74c3c; border: 1px solid #e0e0e0; padding: 8px 12px; border-radius: 6px; cursor: pointer;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Exams Dashboard Section -->

        <!-- Grades Dashboard Section -->
        <div id="gradesSection" style="display: none;">
            <div class="section-header-main" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding: 25px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 15px; color: white; box-shadow: 0 10px 30px rgba(250, 112, 154, 0.3);">
                <div>
                    <h1 style="margin: 0; font-size: 28px; font-weight: 700;"><i class="fas fa-chart-line" style="margin-right: 10px;"></i>Grades Management</h1>
                    <p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 14px;">Manage and analyze student grades across all courses</p>
                </div>
                <button onclick="alert('Export grades report')" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 12px 24px; border-radius: 10px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px; font-size: 14px; transition: all 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                    <i class="fas fa-download"></i> Export Report
                </button>
            </div>

            <!-- Grade Stats Cards -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px;">
                <!-- Total Students Card -->
                <div style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(250, 112, 154, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Total Students</div>
                            <div style="font-size: 36px; font-weight: 700;">248</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-users" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-graduation-cap"></i> Across all courses</div>
                </div>

                <!-- Average GPA Card -->
                <div style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(106, 17, 203, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Average GPA</div>
                            <div style="font-size: 36px; font-weight: 700;">3.24</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-star" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-arrow-up"></i> +0.15 from last term</div>
                </div>

                <!-- Pending Grades Card -->
                <div style="background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(255, 106, 0, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Pending Grades</div>
                            <div style="font-size: 36px; font-weight: 700;">127</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-clock" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-exclamation-circle"></i> Need submission</div>
                </div>

                <!-- Pass Rate Card -->
                <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 15px; padding: 25px; color: white; box-shadow: 0 10px 30px rgba(67, 233, 123, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                        <div>
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Pass Rate</div>
                            <div style="font-size: 36px; font-weight: 700;">91%</div>
                        </div>
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-check-circle" style="font-size: 26px;"></i>
                        </div>
                    </div>
                    <div style="font-size: 13px; opacity: 0.8;"><i class="fas fa-trophy"></i> Excellent performance</div>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div style="background: white; border-radius: 15px; padding: 20px 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); margin-bottom: 30px;">
                <div style="display: flex; gap: 20px; border-bottom: 2px solid #f0f0f0;">
                    <button onclick="showGradeTab('overview')" id="gradeTabOverview" style="background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #fa709a; border-bottom: 3px solid #fa709a; margin-bottom: -2px; font-size: 14px;">
                        <i class="fas fa-chart-pie"></i> Overview
                    </button>
                    <button onclick="showGradeTab('bycourse')" id="gradeTabByCourse" style="background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #7f8c8d; border-bottom: 3px solid transparent; margin-bottom: -2px; font-size: 14px;">
                        <i class="fas fa-book"></i> By Course
                    </button>
                    <button onclick="showGradeTab('distribution')" id="gradeTabDistribution" style="background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #7f8c8d; border-bottom: 3px solid transparent; margin-bottom: -2px; font-size: 14px;">
                        <i class="fas fa-chart-bar"></i> Distribution
                    </button>
                    <button onclick="showGradeTab('pending')" id="gradeTabPending" style="background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #7f8c8d; border-bottom: 3px solid transparent; margin-bottom: -2px; font-size: 14px;">
                        <i class="fas fa-clipboard-list"></i> Pending
                    </button>
                </div>
            </div>

            <!-- Overview Tab -->
            <div id="overviewGradeTab" style="display: block;">
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 30px;">
                    <!-- Grade Distribution Chart -->
                    <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                        <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-chart-bar" style="margin-right: 10px; color: #fa709a;"></i>Overall Grade Distribution</h2>
                        
                        <div style="display: grid; gap: 15px;">
                            <!-- A Grade -->
                            <div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span style="font-weight: 600; color: #2c3e50;">A (90-100%)</span>
                                    <span style="font-weight: 700; color: #43e97b;">68 students (27.4%)</span>
                                </div>
                                <div style="background: #f0f0f0; border-radius: 10px; height: 12px; overflow: hidden;">
                                    <div style="background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%); height: 100%; width: 27.4%; border-radius: 10px;"></div>
                                </div>
                            </div>

                            <!-- B Grade -->
                            <div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span style="font-weight: 600; color: #2c3e50;">B (80-89%)</span>
                                    <span style="font-weight: 700; color: #4facfe;">95 students (38.3%)</span>
                                </div>
                                <div style="background: #f0f0f0; border-radius: 10px; height: 12px; overflow: hidden;">
                                    <div style="background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%); height: 100%; width: 38.3%; border-radius: 10px;"></div>
                                </div>
                            </div>

                            <!-- C Grade -->
                            <div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span style="font-weight: 600; color: #2c3e50;">C (70-79%)</span>
                                    <span style="font-weight: 700; color: #f39c12;">62 students (25.0%)</span>
                                </div>
                                <div style="background: #f0f0f0; border-radius: 10px; height: 12px; overflow: hidden;">
                                    <div style="background: linear-gradient(90deg, #fa709a 0%, #fee140 100%); height: 100%; width: 25%; border-radius: 10px;"></div>
                                </div>
                            </div>

                            <!-- D Grade -->
                            <div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span style="font-weight: 600; color: #2c3e50;">D (60-69%)</span>
                                    <span style="font-weight: 700; color: #ff6a00;">18 students (7.3%)</span>
                                </div>
                                <div style="background: #f0f0f0; border-radius: 10px; height: 12px; overflow: hidden;">
                                    <div style="background: linear-gradient(90deg, #ff6a00 0%, #ee0979 100%); height: 100%; width: 7.3%; border-radius: 10px;"></div>
                                </div>
                            </div>

                            <!-- F Grade -->
                            <div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span style="font-weight: 600; color: #2c3e50;">F (0-59%)</span>
                                    <span style="font-weight: 700; color: #e74c3c;">5 students (2.0%)</span>
                                </div>
                                <div style="background: #f0f0f0; border-radius: 10px; height: 12px; overflow: hidden;">
                                    <div style="background: #e74c3c; height: 100%; width: 2%; border-radius: 10px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div style="display: grid; gap: 15px; align-content: start;">
                        <div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                            <h3 style="margin: 0 0 15px 0; font-size: 16px; font-weight: 700; color: #2c3e50;">Top Performers</h3>
                            <div style="display: grid; gap: 10px;">
                                <div style="display: flex; align-items: center; gap: 10px; padding: 10px; background: #f8f9fa; border-radius: 8px;">
                                    <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 11px;">1</div>
                                    <div style="flex: 1;">
                                        <div style="font-weight: 600; color: #2c3e50; font-size: 13px;">Sarah Johnson</div>
                                        <div style="font-size: 11px; color: #7f8c8d;">GPA: 3.95</div>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px; padding: 10px; background: #f8f9fa; border-radius: 8px;">
                                    <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 11px;">2</div>
                                    <div style="flex: 1;">
                                        <div style="font-weight: 600; color: #2c3e50; font-size: 13px;">Mike Chen</div>
                                        <div style="font-size: 11px; color: #7f8c8d;">GPA: 3.89</div>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px; padding: 10px; background: #f8f9fa; border-radius: 8px;">
                                    <div style="width: 30px; height: 30px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 11px;">3</div>
                                    <div style="flex: 1;">
                                        <div style="font-weight: 600; color: #2c3e50; font-size: 13px;">Emma Davis</div>
                                        <div style="font-size: 11px; color: #7f8c8d;">GPA: 3.85</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                            <h3 style="margin: 0 0 15px 0; font-size: 16px; font-weight: 700; color: #2c3e50;">At-Risk Students</h3>
                            <div style="display: grid; gap: 10px;">
                                <div style="display: flex; align-items: center; gap: 10px; padding: 10px; background: #fff3e0; border-radius: 8px; border-left: 3px solid #f39c12;">
                                    <div style="flex: 1;">
                                        <div style="font-weight: 600; color: #2c3e50; font-size: 13px;">Alex Thompson</div>
                                        <div style="font-size: 11px; color: #7f8c8d;">GPA: 1.95</div>
                                    </div>
                                    <i class="fas fa-exclamation-triangle" style="color: #f39c12;"></i>
                                </div>
                                <div style="display: flex; align-items: center; gap: 10px; padding: 10px; background: #ffebee; border-radius: 8px; border-left: 3px solid #e74c3c;">
                                    <div style="flex: 1;">
                                        <div style="font-weight: 600; color: #2c3e50; font-size: 13px;">Lisa Brown</div>
                                        <div style="font-size: 11px; color: #7f8c8d;">GPA: 1.72</div>
                                    </div>
                                    <i class="fas fa-exclamation-circle" style="color: #e74c3c;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Grade Updates -->
                <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                    <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-history" style="margin-right: 10px; color: #fa709a;"></i>Recent Grade Updates</h2>
                    
                    <div style="display: grid; gap: 12px;">
                        <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: #f8f9fa; border-radius: 10px;">
                            <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 18px;">A</div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #2c3e50; margin-bottom: 4px;">John Smith - JavaScript Functions Assignment</div>
                                <div style="font-size: 13px; color: #7f8c8d;">CS301 Web Development • Grade: 92% • 2 hours ago</div>
                            </div>
                            <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Submitted</span>
                        </div>

                        <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: #f8f9fa; border-radius: 10px;">
                            <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 18px;">B</div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #2c3e50; margin-bottom: 4px;">Emily Martinez - SQL Query Optimization</div>
                                <div style="font-size: 13px; color: #7f8c8d;">CS302 Database Management • Grade: 85% • 5 hours ago</div>
                            </div>
                            <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Submitted</span>
                        </div>

                        <div style="display: flex; align-items: center; gap: 15px; padding: 15px; background: #f8f9fa; border-radius: 10px;">
                            <div style="width: 45px; height: 45px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 18px;">A</div>
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #2c3e50; margin-bottom: 4px;">David Lee - Binary Tree Implementation</div>
                                <div style="font-size: 13px; color: #7f8c8d;">CS201 Data Structures • Grade: 91% • 1 day ago</div>
                            </div>
                            <span style="background: #e8f5e9; color: #2ecc71; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">Submitted</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- By Course Tab -->
            <div id="bycourseGradeTab" style="display: none;">
                <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                    <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-book-open" style="margin-right: 10px; color: #fa709a;"></i>Grades by Course</h2>
                    
                    <div style="display: grid; gap: 20px;">
                        <!-- CS301 Course -->
                        <div style="border: 2px solid #f0f0f0; border-radius: 12px; padding: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <i class="fas fa-code" style="font-size: 22px;"></i>
                                        </div>
                                        <div>
                                            <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">CS301 - Web Development</h3>
                                            <div style="font-size: 13px; color: #7f8c8d;">58 Students • Fall 2025</div>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-size: 13px; color: #7f8c8d; margin-bottom: 5px;">Class Average</div>
                                    <div style="font-size: 24px; font-weight: 700; color: #43e97b;">82.5%</div>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; margin-top: 15px;">
                                <div style="background: #e8f5e9; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #43e97b; margin-bottom: 4px;">18</div>
                                    <div style="font-size: 11px; color: #2ecc71; font-weight: 600;">A (31%)</div>
                                </div>
                                <div style="background: #e3f2fd; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #4facfe; margin-bottom: 4px;">22</div>
                                    <div style="font-size: 11px; color: #2196f3; font-weight: 600;">B (38%)</div>
                                </div>
                                <div style="background: #fff3e0; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #f39c12; margin-bottom: 4px;">13</div>
                                    <div style="font-size: 11px; color: #f39c12; font-weight: 600;">C (22%)</div>
                                </div>
                                <div style="background: #ffe0e0; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #ff6a00; margin-bottom: 4px;">4</div>
                                    <div style="font-size: 11px; color: #ff6a00; font-weight: 600;">D (7%)</div>
                                </div>
                                <div style="background: #ffebee; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #e74c3c; margin-bottom: 4px;">1</div>
                                    <div style="font-size: 11px; color: #e74c3c; font-weight: 600;">F (2%)</div>
                                </div>
                            </div>
                        </div>

                        <!-- CS302 Course -->
                        <div style="border: 2px solid #f0f0f0; border-radius: 12px; padding: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <i class="fas fa-database" style="font-size: 22px;"></i>
                                        </div>
                                        <div>
                                            <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">CS302 - Database Management</h3>
                                            <div style="font-size: 13px; color: #7f8c8d;">45 Students • Fall 2025</div>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-size: 13px; color: #7f8c8d; margin-bottom: 5px;">Class Average</div>
                                    <div style="font-size: 24px; font-weight: 700; color: #4facfe;">78.3%</div>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; margin-top: 15px;">
                                <div style="background: #e8f5e9; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #43e97b; margin-bottom: 4px;">12</div>
                                    <div style="font-size: 11px; color: #2ecc71; font-weight: 600;">A (27%)</div>
                                </div>
                                <div style="background: #e3f2fd; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #4facfe; margin-bottom: 4px;">18</div>
                                    <div style="font-size: 11px; color: #2196f3; font-weight: 600;">B (40%)</div>
                                </div>
                                <div style="background: #fff3e0; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #f39c12; margin-bottom: 4px;">11</div>
                                    <div style="font-size: 11px; color: #f39c12; font-weight: 600;">C (24%)</div>
                                </div>
                                <div style="background: #ffe0e0; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #ff6a00; margin-bottom: 4px;">3</div>
                                    <div style="font-size: 11px; color: #ff6a00; font-weight: 600;">D (7%)</div>
                                </div>
                                <div style="background: #ffebee; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #e74c3c; margin-bottom: 4px;">1</div>
                                    <div style="font-size: 11px; color: #e74c3c; font-weight: 600;">F (2%)</div>
                                </div>
                            </div>
                        </div>

                        <!-- CS201 Course -->
                        <div style="border: 2px solid #f0f0f0; border-radius: 12px; padding: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white;">
                                            <i class="fas fa-project-diagram" style="font-size: 22px;"></i>
                                        </div>
                                        <div>
                                            <h3 style="margin: 0 0 5px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">CS201 - Data Structures</h3>
                                            <div style="font-size: 13px; color: #7f8c8d;">62 Students • Fall 2025</div>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-size: 13px; color: #7f8c8d; margin-bottom: 5px;">Class Average</div>
                                    <div style="font-size: 24px; font-weight: 700; color: #43e97b;">76.8%</div>
                                </div>
                            </div>

                            <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; margin-top: 15px;">
                                <div style="background: #e8f5e9; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #43e97b; margin-bottom: 4px;">15</div>
                                    <div style="font-size: 11px; color: #2ecc71; font-weight: 600;">A (24%)</div>
                                </div>
                                <div style="background: #e3f2fd; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #4facfe; margin-bottom: 4px;">24</div>
                                    <div style="font-size: 11px; color: #2196f3; font-weight: 600;">B (39%)</div>
                                </div>
                                <div style="background: #fff3e0; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #f39c12; margin-bottom: 4px;">18</div>
                                    <div style="font-size: 11px; color: #f39c12; font-weight: 600;">C (29%)</div>
                                </div>
                                <div style="background: #ffe0e0; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #ff6a00; margin-bottom: 4px;">4</div>
                                    <div style="font-size: 11px; color: #ff6a00; font-weight: 600;">D (6%)</div>
                                </div>
                                <div style="background: #ffebee; padding: 12px; border-radius: 8px; text-align: center;">
                                    <div style="font-size: 20px; font-weight: 700; color: #e74c3c; margin-bottom: 4px;">1</div>
                                    <div style="font-size: 11px; color: #e74c3c; font-weight: 600;">F (2%)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Distribution Tab -->
            <div id="distributionGradeTab" style="display: none;">
                <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                    <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-chart-area" style="margin-right: 10px; color: #fa709a;"></i>Grade Distribution Analysis</h2>
                    
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 30px;">
                        <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 12px; padding: 25px; color: white;">
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 10px;">Highest Performing Course</div>
                            <div style="font-size: 24px; font-weight: 700; margin-bottom: 5px;">CS301 - Web Development</div>
                            <div style="font-size: 16px; opacity: 0.9;">Average: 82.5%</div>
                        </div>
                        <div style="background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%); border-radius: 12px; padding: 25px; color: white;">
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 10px;">Needs Improvement</div>
                            <div style="font-size: 24px; font-weight: 700; margin-bottom: 5px;">CS201 - Data Structures</div>
                            <div style="font-size: 16px; opacity: 0.9;">Average: 76.8%</div>
                        </div>
                    </div>

                    <div style="background: #f8f9fa; border-radius: 12px; padding: 25px;">
                        <h3 style="margin: 0 0 20px 0; font-size: 18px; font-weight: 700; color: #2c3e50;">Performance Trends</h3>
                        <div style="display: grid; gap: 15px;">
                            <div style="padding: 15px; background: white; border-radius: 8px; border-left: 4px solid #43e97b;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <div style="font-weight: 600; color: #2c3e50; margin-bottom: 4px;">Excellent (A Grade)</div>
                                        <div style="font-size: 13px; color: #7f8c8d;">Increased by 12% from last semester</div>
                                    </div>
                                    <div style="font-size: 24px; font-weight: 700; color: #43e97b;">27.4%</div>
                                </div>
                            </div>
                            <div style="padding: 15px; background: white; border-radius: 8px; border-left: 4px solid #4facfe;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <div style="font-weight: 600; color: #2c3e50; margin-bottom: 4px;">Good (B Grade)</div>
                                        <div style="font-size: 13px; color: #7f8c8d;">Stable performance</div>
                                    </div>
                                    <div style="font-size: 24px; font-weight: 700; color: #4facfe;">38.3%</div>
                                </div>
                            </div>
                            <div style="padding: 15px; background: white; border-radius: 8px; border-left: 4px solid #f39c12;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <div style="font-weight: 600; color: #2c3e50; margin-bottom: 4px;">Average (C Grade)</div>
                                        <div style="font-size: 13px; color: #7f8c8d;">Decreased by 5% from last semester</div>
                                    </div>
                                    <div style="font-size: 24px; font-weight: 700; color: #f39c12;">25.0%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Grades Tab -->
            <div id="pendingGradeTab" style="display: none;">
                <div style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 2px 15px rgba(0,0,0,0.08);">
                    <h2 style="margin: 0 0 25px 0; font-size: 22px; font-weight: 700; color: #2c3e50;"><i class="fas fa-clipboard-list" style="margin-right: 10px; color: #fa709a;"></i>Pending Grade Submissions</h2>
                    
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background: #f8f9fa; border-bottom: 2px solid #e0e0e0;">
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Assessment</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Course</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Type</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Pending</th>
                                    <th style="padding: 15px; text-align: left; font-weight: 600; color: #2c3e50; font-size: 13px;">Due Date</th>
                                    <th style="padding: 15px; text-align: center; font-weight: 600; color: #2c3e50; font-size: 13px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                    <td style="padding: 15px; font-weight: 600; color: #2c3e50; font-size: 14px;">JavaScript Functions Assignment</td>
                                    <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">CS301</td>
                                    <td style="padding: 15px;">
                                        <span style="background: #e3f2fd; color: #2196f3; padding: 4px 10px; border-radius: 15px; font-size: 12px; font-weight: 600;">Assignment</span>
                                    </td>
                                    <td style="padding: 15px; color: #2c3e50; font-size: 13px;">33 submissions</td>
                                    <td style="padding: 15px; color: #e74c3c; font-size: 13px;">Tomorrow</td>
                                    <td style="padding: 15px; text-align: center;">
                                        <button style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                            <i class="fas fa-edit"></i> Grade Now
                                        </button>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                    <td style="padding: 15px; font-weight: 600; color: #2c3e50; font-size: 14px;">Database Midterm Exam</td>
                                    <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">CS302</td>
                                    <td style="padding: 15px;">
                                        <span style="background: #fff3e0; color: #f39c12; padding: 4px 10px; border-radius: 15px; font-size: 12px; font-weight: 600;">Exam</span>
                                    </td>
                                    <td style="padding: 15px; color: #2c3e50; font-size: 13px;">45 submissions</td>
                                    <td style="padding: 15px; color: #f39c12; font-size: 13px;">In 3 days</td>
                                    <td style="padding: 15px; text-align: center;">
                                        <button style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                            <i class="fas fa-edit"></i> Grade Now
                                        </button>
                                    </td>
                                </tr>
                                <tr style="border-bottom: 1px solid #f0f0f0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                    <td style="padding: 15px; font-weight: 600; color: #2c3e50; font-size: 14px;">Binary Tree Quiz</td>
                                    <td style="padding: 15px; color: #7f8c8d; font-size: 13px;">CS201</td>
                                    <td style="padding: 15px;">
                                        <span style="background: #e8f5e9; color: #2ecc71; padding: 4px 10px; border-radius: 15px; font-size: 12px; font-weight: 600;">Quiz</span>
                                    </td>
                                    <td style="padding: 15px; color: #2c3e50; font-size: 13px;">49 submissions</td>
                                    <td style="padding: 15px; color: #2ecc71; font-size: 13px;">In 1 week</td>
                                    <td style="padding: 15px; text-align: center;">
                                        <button style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 13px;">
                                            <i class="fas fa-edit"></i> Grade Now
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Grades Dashboard Section -->

    </main>

    <script>
        function showSection(sectionName) {
            const mainDashboard = document.getElementById('mainDashboardContent');
            const coursesSection = document.getElementById('coursesSection');
            const studentsSection = document.getElementById('studentsSection');
            const assignmentsSection = document.getElementById('assignmentsSection');
            const examsSection = document.getElementById('examsSection');
            const gradesSection = document.getElementById('gradesSection');

            // Hide all sections
            if (mainDashboard) mainDashboard.style.display = 'none';
            if (coursesSection) coursesSection.style.display = 'none';
            if (studentsSection) studentsSection.style.display = 'none';
            if (assignmentsSection) assignmentsSection.style.display = 'none';
            if (examsSection) examsSection.style.display = 'none';
            if (gradesSection) gradesSection.style.display = 'none';

            // Show requested section
            if (sectionName === 'dashboard') {
                if (mainDashboard) mainDashboard.style.display = 'block';
            } else if (sectionName === 'courses') {
                if (coursesSection) coursesSection.style.display = 'block';
            } else if (sectionName === 'students') {
                if (studentsSection) studentsSection.style.display = 'block';
            } else if (sectionName === 'assignments') {
                if (assignmentsSection) assignmentsSection.style.display = 'block';
            } else if (sectionName === 'exams') {
                if (examsSection) examsSection.style.display = 'block';
            } else if (sectionName === 'grades') {
                if (gradesSection) gradesSection.style.display = 'block';
            }
        }

        function showAssignmentTab(tabName) {
            // Get all tab buttons
            const activeBtn = document.getElementById('assignmentTabActive');
            const gradingBtn = document.getElementById('assignmentTabGrading');
            const completedBtn = document.getElementById('assignmentTabCompleted');

            // Get all tab contents
            const activeTab = document.getElementById('activeAssignmentsTab');
            const gradingTab = document.getElementById('gradingAssignmentsTab');
            const completedTab = document.getElementById('completedAssignmentsTab');

            // Reset all button styles
            const inactiveStyle = 'background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #7f8c8d; border-bottom: 3px solid transparent; margin-bottom: -2px; font-size: 14px;';
            const activeStyle = 'background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #43e97b; border-bottom: 3px solid #43e97b; margin-bottom: -2px; font-size: 14px;';

            activeBtn.style.cssText = inactiveStyle;
            gradingBtn.style.cssText = inactiveStyle;
            completedBtn.style.cssText = inactiveStyle;

            // Hide all tabs
            activeTab.style.display = 'none';
            gradingTab.style.display = 'none';
            completedTab.style.display = 'none';

            // Show selected tab and activate button
            if (tabName === 'active') {
                activeTab.style.display = 'block';
                activeBtn.style.cssText = activeStyle;
            } else if (tabName === 'grading') {
                gradingTab.style.display = 'block';
                gradingBtn.style.cssText = activeStyle;
                gradingBtn.style.color = '#fa709a';
                gradingBtn.style.borderBottomColor = '#fa709a';
            } else if (tabName === 'completed') {
                completedTab.style.display = 'block';
                completedBtn.style.cssText = activeStyle;
            }
        }

        function showExamTab(tabName) {
            // Get all tab buttons
            const upcomingBtn = document.getElementById('examTabUpcoming');
            const completedBtn = document.getElementById('examTabCompleted');
            const draftBtn = document.getElementById('examTabDraft');

            // Get all tab contents
            const upcomingTab = document.getElementById('upcomingExamsTab');
            const completedTab = document.getElementById('completedExamsTab');
            const draftTab = document.getElementById('draftExamsTab');

            // Reset all button styles
            const inactiveStyle = 'background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #7f8c8d; border-bottom: 3px solid transparent; margin-bottom: -2px; font-size: 14px;';
            const activeStyle = 'background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #ff6a00; border-bottom: 3px solid #ff6a00; margin-bottom: -2px; font-size: 14px;';

            upcomingBtn.style.cssText = inactiveStyle;
            completedBtn.style.cssText = inactiveStyle;
            draftBtn.style.cssText = inactiveStyle;

            // Hide all tabs
            upcomingTab.style.display = 'none';
            completedTab.style.display = 'none';
            draftTab.style.display = 'none';

            // Show selected tab and activate button
            if (tabName === 'upcoming') {
                upcomingTab.style.display = 'block';
                upcomingBtn.style.cssText = activeStyle;
            } else if (tabName === 'completed') {
                completedTab.style.display = 'block';
                completedBtn.style.cssText = activeStyle;
                completedBtn.style.color = '#43e97b';
                completedBtn.style.borderBottomColor = '#43e97b';
            } else if (tabName === 'draft') {
                draftTab.style.display = 'block';
                draftBtn.style.cssText = activeStyle;
                draftBtn.style.color = '#f39c12';
                draftBtn.style.borderBottomColor = '#f39c12';
            }
        }

        function showGradeTab(tabName) {
            // Get all tab buttons
            const overviewBtn = document.getElementById('gradeTabOverview');
            const bycourseBtn = document.getElementById('gradeTabByCourse');
            const distributionBtn = document.getElementById('gradeTabDistribution');
            const pendingBtn = document.getElementById('gradeTabPending');

            // Get all tab contents
            const overviewTab = document.getElementById('overviewGradeTab');
            const bycourseTab = document.getElementById('bycourseGradeTab');
            const distributionTab = document.getElementById('distributionGradeTab');
            const pendingTab = document.getElementById('pendingGradeTab');

            // Reset all button styles
            const inactiveStyle = 'background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #7f8c8d; border-bottom: 3px solid transparent; margin-bottom: -2px; font-size: 14px;';
            const activeStyle = 'background: none; border: none; padding: 12px 20px; cursor: pointer; font-weight: 600; color: #fa709a; border-bottom: 3px solid #fa709a; margin-bottom: -2px; font-size: 14px;';

            overviewBtn.style.cssText = inactiveStyle;
            bycourseBtn.style.cssText = inactiveStyle;
            distributionBtn.style.cssText = inactiveStyle;
            pendingBtn.style.cssText = inactiveStyle;

            // Hide all tabs
            overviewTab.style.display = 'none';
            bycourseTab.style.display = 'none';
            distributionTab.style.display = 'none';
            pendingTab.style.display = 'none';

            // Show selected tab and activate button
            if (tabName === 'overview') {
                overviewTab.style.display = 'block';
                overviewBtn.style.cssText = activeStyle;
            } else if (tabName === 'bycourse') {
                bycourseTab.style.display = 'block';
                bycourseBtn.style.cssText = activeStyle;
            } else if (tabName === 'distribution') {
                distributionTab.style.display = 'block';
                distributionBtn.style.cssText = activeStyle;
            } else if (tabName === 'pending') {
                pendingTab.style.display = 'block';
                pendingBtn.style.cssText = activeStyle;
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        }

        function toggleMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

    
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const mobileToggle = document.querySelector('.mobile-menu-toggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !mobileToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
    </script>
</body>
</html>
