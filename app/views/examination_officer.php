
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination Officer Dashboard - Education Portal</title>
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
            background: linear-gradient(180deg, #dc2626 0%, #991b1b 100%);
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
            border-color: #dc2626;
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
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
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

        .stat-icon.red {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
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
            color: #dc2626;
        }

        .view-all {
            color: #dc2626;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .view-all:hover {
            color: #991b1b;
        }

        .add-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
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
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3);
        }

        
        .exams-table {
            width: 100%;
            border-collapse: collapse;
        }

        .exams-table th {
            text-align: left;
            padding: 15px;
            background: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
            border-bottom: 2px solid #e0e6ed;
        }

        .exams-table td {
            padding: 15px;
            border-bottom: 1px solid #e0e6ed;
            font-size: 14px;
        }

        .exams-table tr:hover {
            background: #f8f9fa;
        }

        .exam-info h4 {
            font-size: 15px;
            color: #2c3e50;
            margin-bottom: 3px;
        }

        .exam-info p {
            font-size: 12px;
            color: #7f8c8d;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.scheduled {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-badge.ongoing {
            background: #fef3c7;
            color: #92400e;
        }

        .status-badge.completed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-badge.cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .action-btns {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .action-btn.view {
            background: #dbeafe;
            color: #1e40af;
        }

        .action-btn.view:hover {
            background: #1e40af;
            color: white;
        }

        .action-btn.edit {
            background: #fef3c7;
            color: #92400e;
        }

        .action-btn.edit:hover {
            background: #92400e;
            color: white;
        }

        .action-btn.delete {
            background: #fee2e2;
            color: #991b1b;
        }

        .action-btn.delete:hover {
            background: #991b1b;
            color: white;
        }

    
        .exam-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .exam-item {
            padding: 15px;
            background: #f8f9fa;
            border-left: 4px solid #dc2626;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .exam-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .exam-date {
            display: inline-block;
            padding: 4px 10px;
            background: #dc2626;
            color: white;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .exam-item h4 {
            font-size: 15px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .exam-item p {
            font-size: 13px;
            color: #7f8c8d;
        }

    
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .quick-action-card {
            padding: 20px;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
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
            box-shadow: 0 8px 20px rgba(220, 38, 38, 0.3);
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
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
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
                <i class="fas fa-file-alt"></i>
                <span class="logo-text">Exam Panel</span>
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
                        <i class="fas fa-clipboard-list"></i>
                        <span class="nav-text">All Exams</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-calendar-plus"></i>
                        <span class="nav-text">Schedule Exam</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-graduate"></i>
                        <span class="nav-text">Students</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-text">Results</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">Invigilators</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-door-open"></i>
                        <span class="nav-text">Exam Halls</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-export"></i>
                        <span class="nav-text">Reports</span>
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
                <h1>Examination Dashboard 📋</h1>
                <p>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Examination Officer'); ?>!</p>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <input type="text" placeholder="Search exams, students...">
                    <i class="fas fa-search"></i>
                </div>
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">6</span>
                </button>
                <div class="user-profile">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($_SESSION['username'] ?? 'E', 0, 1)); ?>
                    </div>
                    <div class="user-info">
                        <h4><?php echo htmlspecialchars($_SESSION['username'] ?? 'Exam Officer'); ?></h4>
                        <p>ID: <?php echo htmlspecialchars($_SESSION['user_id'] ?? 'EXM001'); ?></p>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon red">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stat-content">
                    <h3>24</h3>
                    <p>Total Exams</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <h3>8</h3>
                    <p>Upcoming Exams</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>12</h3>
                    <p>Completed Exams</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orange">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-content">
                    <h3>856</h3>
                    <p>Registered Students</p>
                </div>
            </div>
        </div>

        
        <div class="content-grid">
            
            <div class="content-card">
                <div class="card-header">
                    <h2><i class="fas fa-clipboard-list"></i> Scheduled Exams</h2>
                    <button class="add-btn">
                        <i class="fas fa-plus"></i>
                        Schedule New
                    </button>
                </div>
                <table class="exams-table">
                    <thead>
                        <tr>
                            <th>Exam</th>
                            <th>Date & Time</th>
                            <th>Hall</th>
                            <th>Students</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="exam-info">
                                    <h4>Web Development Final</h4>
                                    <p>CS301 • 3 hours</p>
                                </div>
                            </td>
                            <td>Dec 18, 2025<br><small>09:00 AM</small></td>
                            <td>Hall A-301</td>
                            <td>58</td>
                            <td><span class="status-badge scheduled">Scheduled</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="exam-info">
                                    <h4>Database Management</h4>
                                    <p>CS302 • 2.5 hours</p>
                                </div>
                            </td>
                            <td>Dec 19, 2025<br><small>02:00 PM</small></td>
                            <td>Hall B-205</td>
                            <td>42</td>
                            <td><span class="status-badge scheduled">Scheduled</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="exam-info">
                                    <h4>Artificial Intelligence</h4>
                                    <p>CS401 • 3 hours</p>
                                </div>
                            </td>
                            <td>Dec 16, 2025<br><small>10:00 AM</small></td>
                            <td>Hall C-402</td>
                            <td>35</td>
                            <td><span class="status-badge ongoing">Ongoing</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="exam-info">
                                    <h4>Data Structures Midterm</h4>
                                    <p>CS201 • 2 hours</p>
                                </div>
                            </td>
                            <td>Dec 14, 2025<br><small>11:00 AM</small></td>
                            <td>Hall A-304</td>
                            <td>68</td>
                            <td><span class="status-badge completed">Completed</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="exam-info">
                                    <h4>Computer Networks</h4>
                                    <p>CS303 • 3 hours</p>
                                </div>
                            </td>
                            <td>Dec 20, 2025<br><small>09:00 AM</small></td>
                            <td>Hall B-208</td>
                            <td>52</td>
                            <td><span class="status-badge scheduled">Scheduled</span></td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            
            <div class="content-card">
                <div class="card-header">
                    <h2><i class="fas fa-calendar-alt"></i> This Week</h2>
                    <a href="#" class="view-all">View All →</a>
                </div>
                <div class="exam-list">
                    <div class="exam-item">
                        <span class="exam-date">Dec 18 • 09:00 AM</span>
                        <h4>Web Development Final</h4>
                        <p>Hall A-301 • 58 students</p>
                    </div>
                    <div class="exam-item">
                        <span class="exam-date">Dec 19 • 02:00 PM</span>
                        <h4>Database Management</h4>
                        <p>Hall B-205 • 42 students</p>
                    </div>
                    <div class="exam-item">
                        <span class="exam-date">Dec 20 • 09:00 AM</span>
                        <h4>Computer Networks</h4>
                        <p>Hall B-208 • 52 students</p>
                    </div>
                    <div class="exam-item">
                        <span class="exam-date">Dec 21 • 01:00 PM</span>
                        <h4>Software Engineering</h4>
                        <p>Hall A-302 • 45 students</p>
                    </div>
                    <div class="exam-item">
                        <span class="exam-date">Dec 22 • 10:00 AM</span>
                        <h4>Operating Systems</h4>
                        <p>Hall C-403 • 38 students</p>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="content-card">
            <div class="card-header">
                <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
            </div>
            <div class="quick-actions">
                <div class="quick-action-card" style="background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);">
                    <i class="fas fa-calendar-plus"></i>
                    <div>
                        <h4>Schedule Exam</h4>
                        <p>Create new examination</p>
                    </div>
                </div>
                <div class="quick-action-card" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                    <i class="fas fa-users"></i>
                    <div>
                        <h4>Assign Invigilators</h4>
                        <p>Manage exam supervision</p>
                    </div>
                </div>
                <div class="quick-action-card" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <i class="fas fa-file-upload"></i>
                    <div>
                        <h4>Upload Results</h4>
                        <p>Enter exam marks</p>
                    </div>
                </div>
                <div class="quick-action-card" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <i class="fas fa-file-export"></i>
                    <div>
                        <h4>Generate Report</h4>
                        <p>Export exam statistics</p>
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
