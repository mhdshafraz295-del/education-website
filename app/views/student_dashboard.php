
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Education Portal</title>
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
            width: 260px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
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
            margin-left: 260px;
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
            border-color: #667eea;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        }

        .card-header h2 {
            font-size: 20px;
            color: #2c3e50;
        }

        .view-all {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .view-all:hover {
            color: #764ba2;
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
            border-color: #667eea;
            background: #f8f9ff;
        }

        .course-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
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
        }

        .course-progress {
            text-align: right;
        }

        .progress-percent {
            font-size: 18px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 5px;
        }

        .progress-bar {
            width: 100px;
            height: 6px;
            background: #e0e6ed;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        
        .event-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .event-item {
            padding: 15px;
            border-left: 4px solid #667eea;
            background: #f8f9ff;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .event-item:hover {
            transform: translateX(5px);
        }

        .event-date {
            display: inline-block;
            padding: 4px 10px;
            background: #667eea;
            color: white;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .event-item h4 {
            font-size: 15px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .event-item p {
            font-size: 13px;
            color: #7f8c8d;
        }

        
        .assignments-table {
            width: 100%;
            border-collapse: collapse;
        }

        .assignments-table th {
            text-align: left;
            padding: 15px;
            background: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
        }

        .assignments-table td {
            padding: 15px;
            border-bottom: 1px solid #e0e6ed;
            font-size: 14px;
        }

        .assignments-table tr:hover {
            background: #f8f9fa;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-badge.submitted {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-badge.graded {
            background: #d4edda;
            color: #155724;
        }

        .action-btn {
            padding: 6px 15px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: #764ba2;
        }

        
        @media (max-width: 1024px) {
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
    </style>
</head>
<body>
    
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="#" class="logo">
                <i class="fas fa-graduation-cap"></i>
                <span class="logo-text">EduPortal</span>
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
                        <i class="fas fa-book-reader"></i>
                        <span class="nav-text">Library</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-credit-card"></i>
                        <span class="nav-text">Payments</span>
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

    
    <main class="main-content" id="mainContent">
        
        <div class="header">
            <div class="header-left">
                <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Student'); ?>! 👋</h1>
                <p>Here's what's happening with your courses today</p>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <input type="text" placeholder="Search courses, assignments...">
                    <i class="fas fa-search"></i>
                </div>
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <div class="user-profile">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($_SESSION['username'] ?? 'S', 0, 1)); ?>
                    </div>
                    <div class="user-info">
                        <h4><?php echo htmlspecialchars($_SESSION['username'] ?? 'Student'); ?></h4>
                        <p>Student ID: <?php echo htmlspecialchars($_SESSION['student_id'] ?? 'STU001'); ?></p>
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
                    <h3>6</h3>
                    <p>Active Courses</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="stat-content">
                    <h3>12</h3>
                    <p>Pending Assignments</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stat-content">
                    <h3>3.8</h3>
                    <p>Average GPA</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orange">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <h3>85%</h3>
                    <p>Attendance Rate</p>
                </div>
            </div>
        </div>

        
        <div class="content-grid">
            
            <div class="content-card">
                <div class="card-header">
                    <h2>My Courses</h2>
                    <a href="#" class="view-all">View All →</a>
                </div>
                <div class="course-list">
                    <div class="course-item">
                        <div class="course-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <div class="course-info">
                            <h4>Web Development</h4>
                            <p>Prof. John Smith • 24 lessons</p>
                        </div>
                        <div class="course-progress">
                            <div class="progress-percent">75%</div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 75%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="course-item">
                        <div class="course-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="course-info">
                            <h4>Database Management</h4>
                            <p>Prof. Sarah Johnson • 18 lessons</p>
                        </div>
                        <div class="course-progress">
                            <div class="progress-percent">60%</div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 60%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="course-item">
                        <div class="course-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div class="course-info">
                            <h4>Artificial Intelligence</h4>
                            <p>Prof. Michael Brown • 32 lessons</p>
                        </div>
                        <div class="course-progress">
                            <div class="progress-percent">45%</div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 45%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="course-item">
                        <div class="course-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="course-info">
                            <h4>Mobile App Development</h4>
                            <p>Prof. Emily Davis • 28 lessons</p>
                        </div>
                        <div class="course-progress">
                            <div class="progress-percent">90%</div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 90%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="content-card">
                <div class="card-header">
                    <h2>Upcoming Events</h2>
                    <a href="#" class="view-all">View All →</a>
                </div>
                <div class="event-list">
                    <div class="event-item">
                        <span class="event-date">Dec 18, 2025</span>
                        <h4>Database Exam</h4>
                        <p>Final examination - Room 304</p>
                    </div>
                    <div class="event-item">
                        <span class="event-date">Dec 20, 2025</span>
                        <h4>AI Project Submission</h4>
                        <p>Group project deadline</p>
                    </div>
                    <div class="event-item">
                        <span class="event-date">Dec 22, 2025</span>
                        <h4>Web Dev Workshop</h4>
                        <p>React.js Advanced Topics</p>
                    </div>
                    <div class="event-item">
                        <span class="event-date">Dec 25, 2025</span>
                        <h4>Holiday Break</h4>
                        <p>Winter vacation begins</p>
                    </div>
                    <div class="event-item">
                        <span class="event-date">Jan 05, 2026</span>
                        <h4>Classes Resume</h4>
                        <p>Spring semester starts</p>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="content-card">
            <div class="card-header">
                <h2>Recent Assignments</h2>
                <a href="#" class="view-all">View All →</a>
            </div>
            <table class="assignments-table">
                <thead>
                    <tr>
                        <th>Assignment</th>
                        <th>Course</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>React Components Assignment</td>
                        <td>Web Development</td>
                        <td>Dec 19, 2025</td>
                        <td><span class="status-badge pending">Pending</span></td>
                        <td>-</td>
                        <td><button class="action-btn">Submit</button></td>
                    </tr>
                    <tr>
                        <td>SQL Queries Practice</td>
                        <td>Database Management</td>
                        <td>Dec 17, 2025</td>
                        <td><span class="status-badge submitted">Submitted</span></td>
                        <td>-</td>
                        <td><button class="action-btn">View</button></td>
                    </tr>
                    <tr>
                        <td>Machine Learning Model</td>
                        <td>Artificial Intelligence</td>
                        <td>Dec 15, 2025</td>
                        <td><span class="status-badge graded">Graded</span></td>
                        <td>92/100</td>
                        <td><button class="action-btn">View</button></td>
                    </tr>
                    <tr>
                        <td>Mobile UI Design</td>
                        <td>Mobile App Development</td>
                        <td>Dec 21, 2025</td>
                        <td><span class="status-badge pending">Pending</span></td>
                        <td>-</td>
                        <td><button class="action-btn">Submit</button></td>
                    </tr>
                    <tr>
                        <td>REST API Implementation</td>
                        <td>Web Development</td>
                        <td>Dec 10, 2025</td>
                        <td><span class="status-badge graded">Graded</span></td>
                        <td>88/100</td>
                        <td><button class="action-btn">View</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        }

    
        if (window.innerWidth <= 768) {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.remove('collapsed');
        }
    </script>
</body>
</html>
