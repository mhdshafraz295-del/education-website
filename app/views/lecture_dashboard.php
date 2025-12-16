
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
                    <a href="#" class="nav-link active">
                        <i class="fas fa-home"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-book"></i>
                        <span class="nav-text">My Courses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Students</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-tasks"></i>
                        <span class="nav-text">Assignments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        <span class="nav-text">Exams</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
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
                    <a href="/logout.php" class="nav-link">
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
    </main>

    <script>
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
