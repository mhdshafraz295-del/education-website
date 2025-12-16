
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Education Portal</title>
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
            background: linear-gradient(180deg, #1e3c72 0%, #2a5298 100%);
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
            color: #ffd700;
        }

        .logo-text {
            font-size: 24px;
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
            border-color: #1e3c72;
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
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
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
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
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
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--card-color), transparent);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-icon.purple {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-icon.green {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .stat-content h3 {
            font-size: 36px;
            color: #2c3e50;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .stat-content p {
            color: #7f8c8d;
            font-size: 14px;
            font-weight: 500;
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            margin-top: 5px;
        }

        .stat-trend.up {
            color: #27ae60;
        }

        .stat-trend.down {
            color: #e74c3c;
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

        .content-card.full-width {
            grid-column: 1 / -1;
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
            color: #1e3c72;
        }

        .view-all {
            color: #1e3c72;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .view-all:hover {
            color: #2a5298;
        }

    
        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table th {
            text-align: left;
            padding: 15px;
            background: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
            border-bottom: 2px solid #e0e6ed;
        }

        .users-table td {
            padding: 15px;
            border-bottom: 1px solid #e0e6ed;
            font-size: 14px;
            color: #2c3e50;
        }

        .users-table tr:hover {
            background: #f8f9fa;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar-small {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .user-details h4 {
            font-size: 14px;
            color: #2c3e50;
            margin-bottom: 2px;
        }

        .user-details p {
            font-size: 12px;
            color: #7f8c8d;
        }

        .role-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .role-badge.student {
            background: #e3f2fd;
            color: #1976d2;
        }

        .role-badge.lecturer {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .role-badge.exam {
            background: #fff3e0;
            color: #f57c00;
        }

        .role-badge.library {
            background: #e8f5e9;
            color: #388e3c;
        }

        .role-badge.admin {
            background: #ffebee;
            color: #c62828;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.active {
            background: #d4edda;
            color: #155724;
        }

        .status-badge.inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .status-badge.pending {
            background: #fff3cd;
            color: #856404;
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

        
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .activity-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            border-radius: 10px;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            background: #e9ecef;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            flex-shrink: 0;
        }

        .activity-icon.blue {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .activity-icon.green {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .activity-icon.orange {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .activity-icon.purple {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .activity-content {
            flex: 1;
        }

        .activity-content h4 {
            font-size: 14px;
            color: #2c3e50;
            margin-bottom: 4px;
        }

        .activity-content p {
            font-size: 12px;
            color: #7f8c8d;
        }

        .activity-time {
            font-size: 11px;
            color: #95a5a6;
            margin-top: 4px;
        }

        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .quick-action-btn {
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            text-align: left;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .quick-action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .quick-action-btn i {
            font-size: 24px;
        }

        .quick-action-btn span {
            font-size: 14px;
            font-weight: 600;
        }

        
        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            animation: fadeIn 0.3s ease;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 10px 50px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 25px 30px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            border-radius: 20px 20px 0 0;
        }

        .modal-header h2 {
            font-size: 22px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .close-btn {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 24px;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
        }

        .form-group label .required {
            color: #e74c3c;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: #1e3c72;
            box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.1);
        }

        .form-control.error {
            border-color: #e74c3c;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .role-selector {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 10px;
        }

        .role-option {
            position: relative;
        }

        .role-option input[type="radio"] {
            display: none;
        }

        .role-card {
            padding: 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .role-card i {
            font-size: 28px;
            margin-bottom: 8px;
            display: block;
        }

        .role-card span {
            font-size: 13px;
            font-weight: 600;
            color: #2c3e50;
        }

        .role-option input[type="radio"]:checked + .role-card {
            border-color: #1e3c72;
            background: linear-gradient(135deg, rgba(30, 60, 114, 0.1) 0%, rgba(42, 82, 152, 0.1) 100%);
        }

        .role-card.student {
            color: #1976d2;
        }

        .role-card.lecturer {
            color: #7b1fa2;
        }

        .role-card.exam {
            color: #f57c00;
        }

        .role-card.library {
            color: #388e3c;
        }

        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: #e0e6ed;
            border-radius: 2px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
        }

        .password-strength-bar.weak {
            width: 33%;
            background: #e74c3c;
        }

        .password-strength-bar.medium {
            width: 66%;
            background: #f39c12;
        }

        .password-strength-bar.strong {
            width: 100%;
            background: #27ae60;
        }

        .password-strength-text {
            font-size: 12px;
            margin-top: 5px;
            color: #7f8c8d;
        }

        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        .modal-footer {
            padding: 20px 30px;
            border-top: 2px solid #f0f0f0;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-cancel {
            background: #f8f9fa;
            color: #2c3e50;
        }

        .btn-cancel:hover {
            background: #e9ecef;
        }

        .btn-submit {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30, 60, 114, 0.3);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
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

            .form-row {
                grid-template-columns: 1fr;
            }

            .role-selector {
                grid-template-columns: 1fr;
            }

            .modal-content {
                width: 95%;
                margin: 10px;
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
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
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
                <i class="fas fa-user-shield"></i>
                <span class="logo-text">Admin Panel</span>
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
                    <a href="#" class="nav-link" onclick="openUserManagementModal(); return false;">
                        <i class="fas fa-users"></i>
                        <span class="nav-text">User Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="openStudentsModal(); return false;">
                        <i class="fas fa-user-graduate"></i>
                        <span class="nav-text">Students</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="openLecturersModal(); return false;">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span class="nav-text">Lecturers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-book"></i>
                        <span class="nav-text">Courses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        <span class="nav-text">Examinations</span>
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
                        <span class="nav-text">Finance</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-text">Reports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-bell"></i>
                        <span class="nav-text">Notifications</span>
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
                <h1>Admin Dashboard 📊</h1>
                <p>Welcome back, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Administrator'); ?>!</p>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <input type="text" placeholder="Search users, courses...">
                    <i class="fas fa-search"></i>
                </div>
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">5</span>
                </button>
                <div class="user-profile">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($_SESSION['username'] ?? 'A', 0, 1)); ?>
                    </div>
                    <div class="user-info">
                        <h4><?php echo htmlspecialchars($_SESSION['username'] ?? 'Administrator'); ?></h4>
                        <p>System Administrator</p>
                    </div>
                </div>
            </div>
        </div>

    
        <div class="stats-grid">
            <div class="stat-card" style="--card-color: #4facfe;">
                <div class="stat-icon blue">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>1,248</h3>
                    <p>Total Users</p>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> 12% from last month
                    </div>
                </div>
            </div>
            <div class="stat-card" style="--card-color: #667eea;">
                <div class="stat-icon purple">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-content">
                    <h3>856</h3>
                    <p>Active Students</p>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> 8% from last month
                    </div>
                </div>
            </div>
            <div class="stat-card" style="--card-color: #43e97b;">
                <div class="stat-icon green">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="stat-content">
                    <h3>142</h3>
                    <p>Lecturers</p>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> 5% from last month
                    </div>
                </div>
            </div>
            <div class="stat-card" style="--card-color: #fa709a;">
                <div class="stat-icon orange">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-content">
                    <h3>68</h3>
                    <p>Active Courses</p>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> 3% from last month
                    </div>
                </div>
            </div>
        </div>

        
        <div class="content-grid">
    
            <div class="content-card">
                <div class="card-header">
                    <h2><i class="fas fa-users"></i> Recent Registrations</h2>
                    <a href="#" class="view-all" onclick="openUserManagementModal(); return false;">View All →</a>
                </div>
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar-small">JD</div>
                                    <div class="user-details">
                                        <h4>John Doe</h4>
                                        <p>john.doe@example.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="role-badge student">Student</span></td>
                            <td><span class="status-badge active">Active</span></td>
                            <td>Dec 16, 2025</td>
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
                                <div class="user-cell">
                                    <div class="user-avatar-small">SM</div>
                                    <div class="user-details">
                                        <h4>Sarah Miller</h4>
                                        <p>sarah.m@example.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="role-badge lecturer">Lecturer</span></td>
                            <td><span class="status-badge active">Active</span></td>
                            <td>Dec 15, 2025</td>
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
                                <div class="user-cell">
                                    <div class="user-avatar-small">MB</div>
                                    <div class="user-details">
                                        <h4>Michael Brown</h4>
                                        <p>michael.b@example.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="role-badge student">Student</span></td>
                            <td><span class="status-badge pending">Pending</span></td>
                            <td>Dec 15, 2025</td>
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
                                <div class="user-cell">
                                    <div class="user-avatar-small">EW</div>
                                    <div class="user-details">
                                        <h4>Emily Wilson</h4>
                                        <p>emily.w@example.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="role-badge exam">Exam Officer</span></td>
                            <td><span class="status-badge active">Active</span></td>
                            <td>Dec 14, 2025</td>
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
                                <div class="user-cell">
                                    <div class="user-avatar-small">DJ</div>
                                    <div class="user-details">
                                        <h4>David Jones</h4>
                                        <p>david.j@example.com</p>
                                    </div>
                                </div>
                            </td>
                            <td><span class="role-badge library">Library Officer</span></td>
                            <td><span class="status-badge active">Active</span></td>
                            <td>Dec 14, 2025</td>
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
                    <h2><i class="fas fa-history"></i> Recent Activity</h2>
                    <a href="#" class="view-all">View All →</a>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon blue">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            <h4>New User Registration</h4>
                            <p>John Doe registered as Student</p>
                            <div class="activity-time">2 minutes ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon green">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Course Created</h4>
                            <p>Web Development course added</p>
                            <div class="activity-time">15 minutes ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon orange">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Exam Scheduled</h4>
                            <p>Database exam on Dec 18</p>
                            <div class="activity-time">1 hour ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon purple">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Payment Received</h4>
                            <p>Student fee payment processed</p>
                            <div class="activity-time">2 hours ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon blue">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Library Book Issued</h4>
                            <p>Database Systems book borrowed</p>
                            <div class="activity-time">3 hours ago</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="content-grid">
            
            <div class="content-card">
                <div class="card-header">
                    <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
                </div>
                <div class="quick-actions">
                    <button class="quick-action-btn" onclick="openAddUserModal()" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <i class="fas fa-user-plus"></i>
                        <span>Add New User</span>
                    </button>
                    <button class="quick-action-btn" onclick="openCreateCourseModal()" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                        <i class="fas fa-book"></i>
                        <span>Create Course</span>
                    </button>
                    <button class="quick-action-btn" onclick="openScheduleExamModal()" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <i class="fas fa-file-alt"></i>
                        <span>Schedule Exam</span>
                    </button>
                    <button class="quick-action-btn" onclick="openNotificationModal()" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-bell"></i>
                        <span>Send Notification</span>
                    </button>
                </div>
            </div>

    
            <div class="content-card">
                <div class="card-header">
                    <h2><i class="fas fa-server"></i> System Overview</h2>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="activity-content">
                            <h4>System Status</h4>
                            <p>All systems operational</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon blue">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Database</h4>
                            <p>Connected - 45.2MB used</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon orange">
                            <i class="fas fa-hdd"></i>
                        </div>
                        <div class="activity-content">
                            <h4>Storage</h4>
                            <p>2.4GB of 10GB used (24%)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add User Modal -->
    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-user-plus"></i> Add New User</h2>
                <button class="close-btn" onclick="closeAddUserModal()">&times;</button>
            </div>
            <form id="addUserForm" onsubmit="handleSubmitUser(event)">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name <span class="required">*</span></label>
                            <input type="text" name="full_name" class="form-control" placeholder="John Doe" required>
                            <span class="error-message" id="nameError">Please enter a valid name</span>
                        </div>
                        <div class="form-group">
                            <label>Username <span class="required">*</span></label>
                            <input type="text" name="username" class="form-control" placeholder="johndoe" required>
                            <span class="error-message" id="usernameError">Username must be at least 3 characters</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email <span class="required">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                            <span class="error-message" id="emailError">Please enter a valid email</span>
                        </div>
                        <div class="form-group">
                            <label>Phone Number <span class="required">*</span></label>
                            <input type="tel" name="phone" class="form-control" placeholder="+1234567890" required>
                            <span class="error-message" id="phoneError">Please enter a valid phone number</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Password <span class="required">*</span></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required oninput="checkPasswordStrength()">
                            <div class="password-strength">
                                <div class="password-strength-bar" id="passwordStrengthBar"></div>
                            </div>
                            <div class="password-strength-text" id="passwordStrengthText"></div>
                            <span class="error-message" id="passwordError">Password must be at least 8 characters</span>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password <span class="required">*</span></label>
                            <input type="password" name="confirm_password" id="confirmPassword" class="form-control" placeholder="••••••••" required oninput="checkPasswordMatch()">
                            <span class="error-message" id="confirmPasswordError">Passwords do not match</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Address <span class="required">*</span></label>
                        <textarea name="address" class="form-control" rows="3" placeholder="123 Main Street, City, Country" required></textarea>
                        <span class="error-message" id="addressError">Please enter an address</span>
                    </div>

                    <div class="form-group">
                        <label>Select Role <span class="required">*</span></label>
                        <div class="role-selector">
                            <div class="role-option">
                                <input type="radio" name="role" id="roleStudent" value="student" required>
                                <label for="roleStudent" class="role-card student">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Student</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="role" id="roleLecturer" value="lecturer">
                                <label for="roleLecturer" class="role-card lecturer">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Lecturer</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="role" id="roleExam" value="examination_officer">
                                <label for="roleExam" class="role-card exam">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Exam Officer</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="role" id="roleLibrary" value="library_officer">
                                <label for="roleLibrary" class="role-card library">
                                    <i class="fas fa-book-reader"></i>
                                    <span>Library Officer</span>
                                </label>
                            </div>
                        </div>
                        <span class="error-message" id="roleError">Please select a role</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="closeAddUserModal()">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-submit" id="submitBtn">
                        <i class="fas fa-check"></i> Add User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Create Course Modal -->
    <div id="createCourseModal" class="modal">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <h2><i class="fas fa-book"></i> Create New Course</h2>
                <button class="close-btn" onclick="closeCourseModal()">&times;</button>
            </div>
            <form id="createCourseForm" onsubmit="handleSubmitCourse(event)">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Course Name <span class="required">*</span></label>
                            <input type="text" name="course_name" class="form-control" placeholder="Web Development Fundamentals" required>
                            <span class="error-message" id="courseNameError">Please enter a course name</span>
                        </div>
                        <div class="form-group">
                            <label>Course Code <span class="required">*</span></label>
                            <input type="text" name="course_code" class="form-control" placeholder="CS301" required>
                            <span class="error-message" id="courseCodeError">Please enter a course code</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Course Description <span class="required">*</span></label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Enter a detailed description of the course objectives, topics covered, and learning outcomes..." required></textarea>
                        <span class="error-message" id="descriptionError">Please enter a description</span>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Department <span class="required">*</span></label>
                            <select name="department" class="form-control" required>
                                <option value="">Select Department</option>
                                <option value="computer_science">Computer Science</option>
                                <option value="engineering">Engineering</option>
                                <option value="business">Business Administration</option>
                                <option value="arts">Arts & Humanities</option>
                                <option value="science">Natural Sciences</option>
                                <option value="medicine">Medicine & Health</option>
                                <option value="education">Education</option>
                                <option value="law">Law</option>
                            </select>
                            <span class="error-message" id="departmentError">Please select a department</span>
                        </div>
                        <div class="form-group">
                            <label>Credits <span class="required">*</span></label>
                            <input type="number" name="credits" class="form-control" placeholder="3" min="1" max="10" required>
                            <span class="error-message" id="creditsError">Please enter credits (1-10)</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Semester <span class="required">*</span></label>
                            <select name="semester" class="form-control" required>
                                <option value="">Select Semester</option>
                                <option value="fall_2025">Fall 2025</option>
                                <option value="spring_2026">Spring 2026</option>
                                <option value="summer_2026">Summer 2026</option>
                                <option value="fall_2026">Fall 2026</option>
                            </select>
                            <span class="error-message" id="semesterError">Please select a semester</span>
                        </div>
                        <div class="form-group">
                            <label>Duration (Weeks) <span class="required">*</span></label>
                            <input type="number" name="duration" class="form-control" placeholder="12" min="1" max="52" required>
                            <span class="error-message" id="durationError">Please enter duration</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Assigned Lecturer <span class="required">*</span></label>
                            <select name="lecturer" class="form-control" required>
                                <option value="">Select Lecturer</option>
                                <option value="lec001">Dr. Sarah Johnson - Computer Science</option>
                                <option value="lec002">Prof. Michael Chen - Engineering</option>
                                <option value="lec003">Dr. Emily Davis - Business</option>
                                <option value="lec004">Prof. Robert Wilson - Mathematics</option>
                                <option value="lec005">Dr. Jessica Brown - Literature</option>
                            </select>
                            <span class="error-message" id="lecturerError">Please select a lecturer</span>
                        </div>
                        <div class="form-group">
                            <label>Maximum Students <span class="required">*</span></label>
                            <input type="number" name="max_students" class="form-control" placeholder="50" min="1" max="500" required>
                            <span class="error-message" id="maxStudentsError">Please enter max students</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Start Date <span class="required">*</span></label>
                            <input type="date" name="start_date" class="form-control" required>
                            <span class="error-message" id="startDateError">Please select a start date</span>
                        </div>
                        <div class="form-group">
                            <label>End Date <span class="required">*</span></label>
                            <input type="date" name="end_date" class="form-control" required>
                            <span class="error-message" id="endDateError">Please select an end date</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Course Level <span class="required">*</span></label>
                        <div class="role-selector" style="grid-template-columns: repeat(4, 1fr);">
                            <div class="role-option">
                                <input type="radio" name="level" id="levelBeginner" value="beginner" required>
                                <label for="levelBeginner" class="role-card" style="color: #10b981;">
                                    <i class="fas fa-seedling"></i>
                                    <span>Beginner</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="level" id="levelIntermediate" value="intermediate">
                                <label for="levelIntermediate" class="role-card" style="color: #3b82f6;">
                                    <i class="fas fa-layer-group"></i>
                                    <span>Intermediate</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="level" id="levelAdvanced" value="advanced">
                                <label for="levelAdvanced" class="role-card" style="color: #f59e0b;">
                                    <i class="fas fa-star"></i>
                                    <span>Advanced</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="level" id="levelExpert" value="expert">
                                <label for="levelExpert" class="role-card" style="color: #dc2626;">
                                    <i class="fas fa-crown"></i>
                                    <span>Expert</span>
                                </label>
                            </div>
                        </div>
                        <span class="error-message" id="levelError">Please select a course level</span>
                    </div>

                    <div class="form-group">
                        <label>Prerequisites</label>
                        <input type="text" name="prerequisites" class="form-control" placeholder="CS101, CS102 (Optional)">
                    </div>

                    <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" name="is_published" id="isPublished" style="width: auto;">
                        <label for="isPublished" style="margin: 0; cursor: pointer;">Publish course immediately</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="closeCourseModal()">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-submit" id="submitCourseBtn" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                        <i class="fas fa-check"></i> Create Course
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Schedule Exam Modal -->
    <div id="scheduleExamModal" class="modal">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <h2><i class="fas fa-file-alt"></i> Schedule New Exam</h2>
                <button class="close-btn" onclick="closeExamModal()">&times;</button>
            </div>
            <form id="scheduleExamForm" onsubmit="handleSubmitExam(event)">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Exam Title <span class="required">*</span></label>
                            <input type="text" name="exam_title" class="form-control" placeholder="Web Development Final Exam" required>
                            <span class="error-message" id="examTitleError">Please enter an exam title</span>
                        </div>
                        <div class="form-group">
                            <label>Exam Code <span class="required">*</span></label>
                            <input type="text" name="exam_code" class="form-control" placeholder="EXM-CS301-F01" required>
                            <span class="error-message" id="examCodeError">Please enter an exam code</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Select Course <span class="required">*</span></label>
                            <select name="course" class="form-control" required onchange="updateExamInfo(this)">
                                <option value="">Choose a course</option>
                                <option value="cs301" data-students="58">CS301 - Web Development</option>
                                <option value="cs302" data-students="42">CS302 - Database Management</option>
                                <option value="cs401" data-students="35">CS401 - Artificial Intelligence</option>
                                <option value="cs201" data-students="68">CS201 - Data Structures</option>
                                <option value="cs303" data-students="52">CS303 - Computer Networks</option>
                                <option value="cs402" data-students="45">CS402 - Software Engineering</option>
                            </select>
                            <span class="error-message" id="courseError">Please select a course</span>
                        </div>
                        <div class="form-group">
                            <label>Exam Type <span class="required">*</span></label>
                            <select name="exam_type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="midterm">Midterm Exam</option>
                                <option value="final">Final Exam</option>
                                <option value="quiz">Quiz</option>
                                <option value="practical">Practical Exam</option>
                                <option value="oral">Oral Exam</option>
                            </select>
                            <span class="error-message" id="examTypeError">Please select exam type</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Exam Date <span class="required">*</span></label>
                            <input type="date" name="exam_date" id="examDate" class="form-control" required>
                            <span class="error-message" id="examDateError">Please select exam date</span>
                        </div>
                        <div class="form-group">
                            <label>Start Time <span class="required">*</span></label>
                            <input type="time" name="start_time" class="form-control" required>
                            <span class="error-message" id="startTimeError">Please select start time</span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Duration (Minutes) <span class="required">*</span></label>
                            <input type="number" name="duration" class="form-control" placeholder="120" min="15" max="300" required oninput="calculateEndTime()">
                            <span class="error-message" id="durationError">Duration: 15-300 minutes</span>
                        </div>
                        <div class="form-group">
                            <label>End Time <span class="required">*</span></label>
                            <input type="time" name="end_time" id="endTime" class="form-control" readonly style="background: #f8f9fa;">
                            <small style="font-size: 11px; color: #7f8c8d;">Auto-calculated</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Exam Hall <span class="required">*</span></label>
                            <select name="exam_hall" class="form-control" required onchange="updateHallCapacity(this)">
                                <option value="">Select Exam Hall</option>
                                <option value="hall_a301" data-capacity="60">Hall A-301 (Capacity: 60)</option>
                                <option value="hall_a302" data-capacity="50">Hall A-302 (Capacity: 50)</option>
                                <option value="hall_b205" data-capacity="45">Hall B-205 (Capacity: 45)</option>
                                <option value="hall_b208" data-capacity="55">Hall B-208 (Capacity: 55)</option>
                                <option value="hall_c402" data-capacity="40">Hall C-402 (Capacity: 40)</option>
                                <option value="hall_c403" data-capacity="40">Hall C-403 (Capacity: 40)</option>
                            </select>
                            <span class="error-message" id="hallError">Please select an exam hall</span>
                        </div>
                        <div class="form-group">
                            <label>Expected Students <span class="required">*</span></label>
                            <input type="number" name="expected_students" id="expectedStudents" class="form-control" placeholder="50" min="1" required>
                            <small id="capacityWarning" style="font-size: 11px; color: #7f8c8d;"></small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Total Marks <span class="required">*</span></label>
                            <input type="number" name="total_marks" class="form-control" placeholder="100" min="1" max="1000" required>
                            <span class="error-message" id="totalMarksError">Please enter total marks</span>
                        </div>
                        <div class="form-group">
                            <label>Passing Marks <span class="required">*</span></label>
                            <input type="number" name="passing_marks" class="form-control" placeholder="40" min="1" required oninput="validatePassingMarks()">
                            <span class="error-message" id="passingMarksError">Must be less than total marks</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Assigned Invigilators <span class="required">*</span></label>
                        <select name="invigilators[]" class="form-control" multiple size="4" required style="height: auto;">
                            <option value="inv001">Dr. Sarah Johnson - Computer Science</option>
                            <option value="inv002">Prof. Michael Chen - Engineering</option>
                            <option value="inv003">Dr. Emily Davis - Business</option>
                            <option value="inv004">Prof. Robert Wilson - Mathematics</option>
                            <option value="inv005">Dr. Jessica Brown - Literature</option>
                            <option value="inv006">Prof. David Martinez - Physics</option>
                        </select>
                        <small style="font-size: 11px; color: #7f8c8d;">Hold Ctrl/Cmd to select multiple</small>
                    </div>

                    <div class="form-group">
                        <label>Special Instructions</label>
                        <textarea name="instructions" class="form-control" rows="3" placeholder="Enter any special instructions for students (e.g., allowed materials, calculators, etc.)..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Exam Status <span class="required">*</span></label>
                        <div class="role-selector" style="grid-template-columns: repeat(3, 1fr);">
                            <div class="role-option">
                                <input type="radio" name="status" id="statusScheduled" value="scheduled" required checked>
                                <label for="statusScheduled" class="role-card" style="color: #3b82f6;">
                                    <i class="fas fa-calendar-check"></i>
                                    <span>Scheduled</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="status" id="statusDraft" value="draft">
                                <label for="statusDraft" class="role-card" style="color: #f59e0b;">
                                    <i class="fas fa-edit"></i>
                                    <span>Draft</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="status" id="statusPublished" value="published">
                                <label for="statusPublished" class="role-card" style="color: #10b981;">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Published</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" name="send_notification" id="sendNotification" style="width: auto;" checked>
                        <label for="sendNotification" style="margin: 0; cursor: pointer;">Send notification to students</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="closeExamModal()">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-submit" id="submitExamBtn" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <i class="fas fa-check"></i> Schedule Exam
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Send Notification Modal -->
    <div id="notificationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h2><i class="fas fa-bell"></i> Send Notification</h2>
                <button class="close-btn" onclick="closeNotificationModal()">&times;</button>
            </div>
            <form id="notificationForm" onsubmit="handleSubmitNotification(event)">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Notification Title <span class="required">*</span></label>
                        <input type="text" name="notification_title" class="form-control" placeholder="Important Announcement" required>
                        <span class="error-message" id="notificationTitleError">Please enter a title</span>
                    </div>

                    <div class="form-group">
                        <label>Message <span class="required">*</span></label>
                        <textarea name="message" id="notificationMessage" class="form-control" rows="6" placeholder="Enter your notification message here..." required oninput="updateCharCount()"></textarea>
                        <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                            <span class="error-message" id="messageError">Please enter a message</span>
                            <small id="charCount" style="font-size: 11px; color: #7f8c8d;">0 / 500 characters</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Target Audience <span class="required">*</span></label>
                        <div class="role-selector" style="grid-template-columns: repeat(2, 1fr);">
                            <div class="role-option">
                                <input type="radio" name="target" id="targetAll" value="all" required checked onchange="toggleSpecificSelection()">
                                <label for="targetAll" class="role-card" style="color: #667eea;">
                                    <i class="fas fa-users"></i>
                                    <span>All Users</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="target" id="targetStudents" value="students" onchange="toggleSpecificSelection()">
                                <label for="targetStudents" class="role-card student">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Students Only</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="target" id="targetLecturers" value="lecturers" onchange="toggleSpecificSelection()">
                                <label for="targetLecturers" class="role-card lecturer">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Lecturers Only</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="target" id="targetStaff" value="staff" onchange="toggleSpecificSelection()">
                                <label for="targetStaff" class="role-card" style="color: #f59e0b;">
                                    <i class="fas fa-briefcase"></i>
                                    <span>Staff Only</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="target" id="targetSpecific" value="specific" onchange="toggleSpecificSelection()">
                                <label for="targetSpecific" class="role-card" style="color: #10b981;">
                                    <i class="fas fa-user-check"></i>
                                    <span>Specific Users</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="target" id="targetCourse" value="course" onchange="toggleSpecificSelection()">
                                <label for="targetCourse" class="role-card" style="color: #3b82f6;">
                                    <i class="fas fa-book"></i>
                                    <span>Course Members</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="specificUsersGroup" style="display: none;">
                        <label>Select Specific Users</label>
                        <select name="specific_users[]" class="form-control" multiple size="5" style="height: auto;">
                            <option value="user001">John Doe - Student (STU00001)</option>
                            <option value="user002">Sarah Johnson - Lecturer (LEC00001)</option>
                            <option value="user003">Michael Brown - Student (STU00002)</option>
                            <option value="user004">Emily Wilson - Exam Officer (EXM00001)</option>
                            <option value="user005">David Jones - Library Officer (LIB00001)</option>
                            <option value="user006">Jane Smith - Student (STU00003)</option>
                        </select>
                        <small style="font-size: 11px; color: #7f8c8d;">Hold Ctrl/Cmd to select multiple users</small>
                    </div>

                    <div class="form-group" id="courseSelectGroup" style="display: none;">
                        <label>Select Course</label>
                        <select name="course_id" class="form-control">
                            <option value="">Choose a course</option>
                            <option value="cs301">CS301 - Web Development (58 students)</option>
                            <option value="cs302">CS302 - Database Management (42 students)</option>
                            <option value="cs401">CS401 - Artificial Intelligence (35 students)</option>
                            <option value="cs201">CS201 - Data Structures (68 students)</option>
                            <option value="cs303">CS303 - Computer Networks (52 students)</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Priority Level <span class="required">*</span></label>
                            <select name="priority" class="form-control" required>
                                <option value="normal">Normal</option>
                                <option value="important">Important</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Notification Type <span class="required">*</span></label>
                            <select name="notification_type" class="form-control" required>
                                <option value="announcement">Announcement</option>
                                <option value="reminder">Reminder</option>
                                <option value="alert">Alert</option>
                                <option value="update">Update</option>
                                <option value="event">Event</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Delivery Method <span class="required">*</span></label>
                        <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" name="delivery_method[]" id="deliveryInApp" value="in_app" checked>
                                <label for="deliveryInApp" style="margin: 0; cursor: pointer;">In-App</label>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" name="delivery_method[]" id="deliveryEmail" value="email" checked>
                                <label for="deliveryEmail" style="margin: 0; cursor: pointer;">Email</label>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" name="delivery_method[]" id="deliverySMS" value="sms">
                                <label for="deliverySMS" style="margin: 0; cursor: pointer;">SMS</label>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" name="delivery_method[]" id="deliveryPush" value="push">
                                <label for="deliveryPush" style="margin: 0; cursor: pointer;">Push Notification</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Schedule Send</label>
                            <select name="schedule_type" id="scheduleType" class="form-control" onchange="toggleScheduleDateTime()">
                                <option value="now">Send Immediately</option>
                                <option value="later">Schedule for Later</option>
                            </select>
                        </div>
                        <div class="form-group" id="scheduleDateTime" style="display: none;">
                            <label>Schedule Date & Time</label>
                            <input type="datetime-local" name="schedule_datetime" class="form-control">
                        </div>
                    </div>

                    <div class="form-group" style="background: #f8f9fa; padding: 15px; border-radius: 10px;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                            <i class="fas fa-info-circle" style="color: #667eea;"></i>
                            <strong style="color: #2c3e50;">Estimated Recipients</strong>
                        </div>
                        <p id="recipientCount" style="font-size: 14px; color: #7f8c8d; margin: 0;">
                            Approximately <strong>1,248</strong> users will receive this notification
                        </p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="closeNotificationModal()">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-submit" id="submitNotificationBtn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-paper-plane"></i> Send Notification
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Send Notification Modal -->
    <di id="notificationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h2><i class="fas fa-bell"></i> Send Notification</h2>
                <button class="close-btn" onclick="closeNotificationModal()">&times;</button>
            </div>
            <form id="notificationForm" onsubmit="handleSubmitNotification(event)">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Notification Title <span class="required">*</span></label>
                        <input type="text" name="notification_title" class="form-control" placeholder="Important Announcement" required>
                        <span class="error-message" id="notificationTitleError">Please enter a title</span>
                    </div>

                    <div class="form-group">
                        <label>Message <span class="required">*</span></label>
                        <textarea name="message" id="notificationMessage" class="form-control" rows="6" placeholder="Enter your notification message here..." required oninput="updateCharCount()"></textarea>
                        <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                            <span class="error-message" id="messageError">Please enter a message</span>
                            <small id="charCount" style="font-size: 11px; color: #7f8c8d;">0 / 500 characters</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Target Audience <span class="required">*</span></label>
                        <div class="role-selector" style="grid-template-columns: repeat(2, 1fr);">
                            <div class="role-option">
                                <input type="radio" name="target" id="targetAll" value="all" required checked onchange="toggleSpecificSelection()">
                                <label for="targetAll" class="role-card" style="color: #667eea;">
                                    <i class="fas fa-users"></i>
                                    <span>All Users</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="target" id="targetStudents" value="students" onchange="toggleSpecificSelection()">
                                <label for="targetStudents" class="role-card student">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Students Only</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="target" id="targetLecturers" value="lecturers" onchange="toggleSpecificSelection()">
                                <label for="targetLecturers" class="role-card lecturer">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Lecturers Only</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="target" id="targetStaff" value="staff" onchange="toggleSpecificSelection()">
                                <label for="targetStaff" class="role-card" style="color: #f59e0b;">
                                    <i class="fas fa-briefcase"></i>
                                    <span>Staff Only</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="target" id="targetSpecific" value="specific" onchange="toggleSpecificSelection()">
                                <label for="targetSpecific" class="role-card" style="color: #10b981;">
                                    <i class="fas fa-user-check"></i>
                                    <span>Specific Users</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="target" id="targetCourse" value="course" onchange="toggleSpecificSelection()">
                                <label for="targetCourse" class="role-card" style="color: #3b82f6;">
                                    <i class="fas fa-book"></i>
                                    <span>Course Members</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="specificUsersGroup" style="display: none;">
                        <label>Select Specific Users</label>
                        <select name="specific_users[]" class="form-control" multiple size="5" style="height: auto;" onchange="updateRecipientCount()">
                            <option value="user001">John Doe - Student (STU00001)</option>
                            <option value="user002">Sarah Johnson - Lecturer (LEC00001)</option>
                            <option value="user003">Michael Brown - Student (STU00002)</option>
                            <option value="user004">Emily Wilson - Exam Officer (EXM00001)</option>
                            <option value="user005">David Jones - Library Officer (LIB00001)</option>
                            <option value="user006">Jane Smith - Student (STU00003)</option>
                        </select>
                        <small style="font-size: 11px; color: #7f8c8d;">Hold Ctrl/Cmd to select multiple users</small>
                    </div>

                    <div class="form-group" id="courseSelectGroup" style="display: none;">
                        <label>Select Course</label>
                        <select name="course_id" class="form-control" onchange="updateRecipientCount()">
                            <option value="">Choose a course</option>
                            <option value="cs301">CS301 - Web Development (58 students)</option>
                            <option value="cs302">CS302 - Database Management (42 students)</option>
                            <option value="cs401">CS401 - Artificial Intelligence (35 students)</option>
                            <option value="cs201">CS201 - Data Structures (68 students)</option>
                            <option value="cs303">CS303 - Computer Networks (52 students)</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Priority Level <span class="required">*</span></label>
                            <select name="priority" class="form-control" required>
                                <option value="normal">Normal</option>
                                <option value="important">Important</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Notification Type <span class="required">*</span></label>
                            <select name="notification_type" class="form-control" required>
                                <option value="announcement">Announcement</option>
                                <option value="reminder">Reminder</option>
                                <option value="alert">Alert</option>
                                <option value="update">Update</option>
                                <option value="event">Event</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Delivery Method <span class="required">*</span></label>
                        <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" name="delivery_method[]" id="deliveryInApp" value="in_app" checked>
                                <label for="deliveryInApp" style="margin: 0; cursor: pointer;">In-App</label>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" name="delivery_method[]" id="deliveryEmail" value="email" checked>
                                <label for="deliveryEmail" style="margin: 0; cursor: pointer;">Email</label>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" name="delivery_method[]" id="deliverySMS" value="sms">
                                <label for="deliverySMS" style="margin: 0; cursor: pointer;">SMS</label>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" name="delivery_method[]" id="deliveryPush" value="push">
                                <label for="deliveryPush" style="margin: 0; cursor: pointer;">Push Notification</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Schedule Send</label>
                            <select name="schedule_type" id="scheduleType" class="form-control" onchange="toggleScheduleDateTime()">
                                <option value="now">Send Immediately</option>
                                <option value="later">Schedule for Later</option>
                            </select>
                        </div>
                        <div class="form-group" id="scheduleDateTime" style="display: none;">
                            <label>Schedule Date & Time</label>
                            <input type="datetime-local" name="schedule_datetime" class="form-control">
                        </div>
                    </div>

                    <div class="form-group" style="background: #f8f9fa; padding: 15px; border-radius: 10px;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                            <i class="fas fa-info-circle" style="color: #667eea;"></i>
                            <strong style="color: #2c3e50;">Estimated Recipients</strong>
                        </div>
                        <p id="recipientCount" style="font-size: 14px; color: #7f8c8d; margin: 0;">
                            Approximately <strong>1,248</strong> users will receive this notification
                        </p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" onclick="closeNotificationModal()">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-submit" id="submitNotificationBtn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-paper-plane"></i> Send Notification
                    </button>
                </div>
            </form>
        </div>
    </di>
    <div id="userManagementModal" class="modal">
        <div class="modal-content" style="max-width: 1200px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
                <h2><i class="fas fa-users-cog"></i> User Management</h2>
                <button class="close-btn" onclick="closeUserManagementModal()">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                
                <div style="padding: 25px 30px; background: #f8f9fa; border-bottom: 2px solid #e0e6ed;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                        <div style="display: flex; gap: 10px; flex-wrap: wrap; flex: 1;">
                            <div style="position: relative; flex: 1; min-width: 250px;">
                                <input type="text" id="userSearchInput" class="form-control" placeholder="Search by name, email, ID..." oninput="filterUsers()" style="padding-left: 40px;">
                                <i class="fas fa-search" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #7f8c8d;"></i>
                            </div>
                            <select id="roleFilter" class="form-control" onchange="filterUsers()" style="width: auto; min-width: 150px;">
                                <option value="all">All Roles</option>
                                <option value="student">Students</option>
                                <option value="lecturer">Lecturers</option>
                                <option value="examination_officer">Exam Officers</option>
                                <option value="library_officer">Library Officers</option>
                                <option value="admin">Administrators</option>
                            </select>
                            <select id="statusFilter" class="form-control" onchange="filterUsers()" style="width: auto; min-width: 150px;">
                                <option value="all">All Status</option>
                                <option value="active">Active</option>
                                <option value="pending">Pending</option>
                                <option value="inactive">Inactive</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn" onclick="openAddUserModal(); closeUserManagementModal();" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                                <i class="fas fa-user-plus"></i> Add User
                            </button>
                            <button class="btn" onclick="exportUsers()" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                                <i class="fas fa-download"></i> Export
                            </button>
                        </div>
                    </div>
                    
                    
                    <div id="bulkActionsBar" style="display: none; margin-top: 15px; padding: 12px 15px; background: white; border-radius: 8px; border: 2px solid #667eea;">
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                            <span id="selectedCount" style="font-weight: 600; color: #2c3e50;">0 users selected</span>
                            <div style="display: flex; gap: 8px;">
                                <button onclick="bulkActivate()" style="padding: 8px 15px; background: #10b981; color: white; border: none; border-radius: 6px; font-size: 13px; cursor: pointer;">
                                    <i class="fas fa-check-circle"></i> Activate
                                </button>
                                <button onclick="bulkSuspend()" style="padding: 8px 15px; background: #f59e0b; color: white; border: none; border-radius: 6px; font-size: 13px; cursor: pointer;">
                                    <i class="fas fa-pause-circle"></i> Suspend
                                </button>
                                <button onclick="bulkDelete()" style="padding: 8px 15px; background: #e74c3c; color: white; border: none; border-radius: 6px; font-size: 13px; cursor: pointer;">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                                <button onclick="clearSelection()" style="padding: 8px 15px; background: #6c757d; color: white; border: none; border-radius: 6px; font-size: 13px; cursor: pointer;">
                                    <i class="fas fa-times"></i> Clear
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div style="padding: 30px; max-height: 60vh; overflow-y: auto;">
                    <table class="users-table" id="managementUsersTable">
                        <thead>
                            <tr>
                                <th style="width: 40px;">
                                    <input type="checkbox" id="selectAllUsers" onchange="toggleSelectAll()" style="cursor: pointer;">
                                </th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Joined Date</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody">
                            <tr data-user-id="1" data-role="student" data-status="active">
                                <td><input type="checkbox" class="user-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small">JD</div>
                                        <div class="user-details">
                                            <h4>John Doe</h4>
                                            <p>john.doe@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="role-badge student">Student</span></td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>Dec 16, 2025</td>
                                <td>2 hours ago</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewUserDetails(1)" title="View Details"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit" onclick="editUser(1)" title="Edit User"><i class="fas fa-edit"></i></button>
                                        <button class="action-btn delete" onclick="deleteUser(1)" title="Delete User"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-user-id="2" data-role="lecturer" data-status="active">
                                <td><input type="checkbox" class="user-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small">SM</div>
                                        <div class="user-details">
                                            <h4>Sarah Miller</h4>
                                            <p>sarah.m@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="role-badge lecturer">Lecturer</span></td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>Dec 15, 2025</td>
                                <td>1 day ago</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewUserDetails(2)" title="View Details"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit" onclick="editUser(2)" title="Edit User"><i class="fas fa-edit"></i></button>
                                        <button class="action-btn delete" onclick="deleteUser(2)" title="Delete User"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-user-id="3" data-role="student" data-status="pending">
                                <td><input type="checkbox" class="user-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small">MB</div>
                                        <div class="user-details">
                                            <h4>Michael Brown</h4>
                                            <p>michael.b@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="role-badge student">Student</span></td>
                                <td><span class="status-badge pending">Pending</span></td>
                                <td>Dec 15, 2025</td>
                                <td>Never</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewUserDetails(3)" title="View Details"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit" onclick="editUser(3)" title="Edit User"><i class="fas fa-edit"></i></button>
                                        <button class="action-btn delete" onclick="deleteUser(3)" title="Delete User"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-user-id="4" data-role="examination_officer" data-status="active">
                                <td><input type="checkbox" class="user-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small">EW</div>
                                        <div class="user-details">
                                            <h4>Emily Wilson</h4>
                                            <p>emily.w@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="role-badge exam">Exam Officer</span></td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>Dec 14, 2025</td>
                                <td>5 hours ago</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewUserDetails(4)" title="View Details"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit" onclick="editUser(4)" title="Edit User"><i class="fas fa-edit"></i></button>
                                        <button class="action-btn delete" onclick="deleteUser(4)" title="Delete User"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-user-id="5" data-role="library_officer" data-status="active">
                                <td><input type="checkbox" class="user-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small">DJ</div>
                                        <div class="user-details">
                                            <h4>David Jones</h4>
                                            <p>david.j@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="role-badge library">Library Officer</span></td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>Dec 14, 2025</td>
                                <td>3 hours ago</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewUserDetails(5)" title="View Details"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit" onclick="editUser(5)" title="Edit User"><i class="fas fa-edit"></i></button>
                                        <button class="action-btn delete" onclick="deleteUser(5)" title="Delete User"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-user-id="6" data-role="student" data-status="inactive">
                                <td><input type="checkbox" class="user-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small">JS</div>
                                        <div class="user-details">
                                            <h4>Jane Smith</h4>
                                            <p>jane.smith@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="role-badge student">Student</span></td>
                                <td><span class="status-badge inactive">Inactive</span></td>
                                <td>Dec 10, 2025</td>
                                <td>5 days ago</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewUserDetails(6)" title="View Details"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit" onclick="editUser(6)" title="Edit User"><i class="fas fa-edit"></i></button>
                                        <button class="action-btn delete" onclick="deleteUser(6)" title="Delete User"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-user-id="7" data-role="lecturer" data-status="active">
                                <td><input type="checkbox" class="user-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small">RC</div>
                                        <div class="user-details">
                                            <h4>Robert Chen</h4>
                                            <p>robert.chen@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="role-badge lecturer">Lecturer</span></td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>Dec 12, 2025</td>
                                <td>Today</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewUserDetails(7)" title="View Details"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit" onclick="editUser(7)" title="Edit User"><i class="fas fa-edit"></i></button>
                                        <button class="action-btn delete" onclick="deleteUser(7)" title="Delete User"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-user-id="8" data-role="student" data-status="suspended">
                                <td><input type="checkbox" class="user-checkbox" onchange="updateBulkActions()"></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small">AL</div>
                                        <div class="user-details">
                                            <h4>Alice Lee</h4>
                                            <p>alice.lee@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="role-badge student">Student</span></td>
                                <td><span class="status-badge suspended" style="background: #ffebee; color: #c62828;">Suspended</span></td>
                                <td>Dec 08, 2025</td>
                                <td>1 week ago</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewUserDetails(8)" title="View Details"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit" onclick="editUser(8)" title="Edit User"><i class="fas fa-edit"></i></button>
                                        <button class="action-btn delete" onclick="deleteUser(8)" title="Delete User"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div id="noResultsMessage" style="display: none; text-align: center; padding: 40px; color: #7f8c8d;">
                        <i class="fas fa-search" style="font-size: 48px; margin-bottom: 15px; opacity: 0.3;"></i>
                        <h3 style="margin: 0 0 10px 0;">No users found</h3>
                        <p style="margin: 0;">Try adjusting your filters or search query</p>
                    </div>
                </div>

                
                <div style="padding: 20px 30px; border-top: 2px solid #e0e6ed; background: #f8f9fa; display: flex; justify-content: space-between; align-items: center;">
                    <div style="color: #7f8c8d; font-size: 14px;">
                        Showing <strong id="showingCount">8</strong> of <strong>1,248</strong> users
                    </div>
                    <div style="display: flex; gap: 5px;">
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #7f8c8d;">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button style="padding: 8px 12px; border: 1px solid #1e3c72; background: #1e3c72; border-radius: 6px; cursor: pointer; color: white; font-weight: 600;">1</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #2c3e50;">2</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #2c3e50;">3</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #7f8c8d;">...</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #2c3e50;">156</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #7f8c8d;">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div id="studentsModal" class="modal">
        <div class="modal-content" style="max-width: 1400px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h2><i class="fas fa-user-graduate"></i> Students Management</h2>
                <button class="close-btn" onclick="closeStudentsModal()">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                
                <div style="padding: 25px 30px; background: #f8f9fa; border-bottom: 2px solid #e0e6ed;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 15px;">
                        <div style="display: flex; gap: 10px; flex-wrap: wrap; flex: 1;">
                            <div style="position: relative; flex: 1; min-width: 250px;">
                                <input type="text" id="studentSearchInput" class="form-control" placeholder="Search by name, ID, email..." oninput="filterStudents()" style="padding-left: 40px;">
                                <i class="fas fa-search" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #7f8c8d;"></i>
                            </div>
                            <select id="courseFilterStudent" class="form-control" onchange="filterStudents()" style="width: auto; min-width: 200px;">
                                <option value="all">All Courses</option>
                                <option value="cs301">CS301 - Web Development</option>
                                <option value="cs302">CS302 - Database Management</option>
                                <option value="cs401">CS401 - Artificial Intelligence</option>
                                <option value="cs201">CS201 - Data Structures</option>
                                <option value="cs303">CS303 - Computer Networks</option>
                            </select>
                            <select id="statusFilterStudent" class="form-control" onchange="filterStudents()" style="width: auto; min-width: 150px;">
                                <option value="all">All Status</option>
                                <option value="active">Active</option>
                                <option value="probation">On Probation</option>
                                <option value="graduated">Graduated</option>
                                <option value="suspended">Suspended</option>
                            </select>
                            <select id="yearFilterStudent" class="form-control" onchange="filterStudents()" style="width: auto; min-width: 150px;">
                                <option value="all">All Years</option>
                                <option value="1">Year 1</option>
                                <option value="2">Year 2</option>
                                <option value="3">Year 3</option>
                                <option value="4">Year 4</option>
                            </select>
                        </div>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn" onclick="openAddUserModal(); closeStudentsModal();" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                                <i class="fas fa-user-plus"></i> Add Student
                            </button>
                            <button class="btn" onclick="exportStudents()" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                                <i class="fas fa-download"></i> Export
                            </button>
                        </div>
                    </div>
                    
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
                        <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #667eea;">
                            <div style="font-size: 24px; font-weight: 700; color: #2c3e50;">856</div>
                            <div style="font-size: 12px; color: #7f8c8d; margin-top: 5px;">Total Students</div>
                        </div>
                        <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #10b981;">
                            <div style="font-size: 24px; font-weight: 700; color: #2c3e50;">745</div>
                            <div style="font-size: 12px; color: #7f8c8d; margin-top: 5px;">Active</div>
                        </div>
                        <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #f59e0b;">
                            <div style="font-size: 24px; font-weight: 700; color: #2c3e50;">3.45</div>
                            <div style="font-size: 12px; color: #7f8c8d; margin-top: 5px;">Avg GPA</div>
                        </div>
                        <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #3b82f6;">
                            <div style="font-size: 24px; font-weight: 700; color: #2c3e50;">87%</div>
                            <div style="font-size: 12px; color: #7f8c8d; margin-top: 5px;">Attendance</div>
                        </div>
                        <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #dc2626;">
                            <div style="font-size: 24px; font-weight: 700; color: #2c3e50;">42</div>
                            <div style="font-size: 12px; color: #7f8c8d; margin-top: 5px;">New This Month</div>
                        </div>
                    </div>
                </div>

            
                <div style="padding: 30px; max-height: 60vh; overflow-y: auto;">
                    <table class="users-table" id="studentsTable">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Student</th>
                                <th>Year</th>
                                <th>Courses</th>
                                <th>GPA</th>
                                <th>Attendance</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="studentsTableBody">
                            <tr data-student-id="STU00001" data-course="cs301,cs201" data-status="active" data-year="2">
                                <td><strong style="color: #667eea;">STU00001</strong></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">JD</div>
                                        <div class="user-details">
                                            <h4>John Doe</h4>
                                            <p>john.doe@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span style="font-weight: 600;">Year 2</span></td>
                                <td>
                                    <span style="display: inline-block; padding: 4px 8px; background: #e3f2fd; color: #1976d2; border-radius: 5px; font-size: 11px; margin-right: 3px;">5 Courses</span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <span style="font-weight: 700; color: #10b981;">3.8</span>
                                        <i class="fas fa-arrow-up" style="color: #10b981; font-size: 10px;"></i>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 60px; height: 6px; background: #e0e6ed; border-radius: 3px; overflow: hidden;">
                                            <div style="width: 92%; height: 100%; background: #10b981;"></div>
                                        </div>
                                        <span style="font-size: 12px; font-weight: 600;">92%</span>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewStudentProfile('STU00001')" title="View Profile"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit" onclick="viewStudentTranscript('STU00001')" title="Transcript" style="background: #e3f2fd; color: #1976d2;"><i class="fas fa-file-alt"></i></button>
                                        <button class="action-btn" onclick="editStudent('STU00001')" title="Edit" style="background: #fef3c7; color: #92400e;"><i class="fas fa-edit"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-student-id="STU00002" data-course="cs302,cs303" data-status="active" data-year="3">
                                <td><strong style="color: #667eea;">STU00002</strong></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">JS</div>
                                        <div class="user-details">
                                            <h4>Jane Smith</h4>
                                            <p>jane.smith@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span style="font-weight: 600;">Year 3</span></td>
                                <td>
                                    <span style="display: inline-block; padding: 4px 8px; background: #e3f2fd; color: #1976d2; border-radius: 5px; font-size: 11px; margin-right: 3px;">6 Courses</span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <span style="font-weight: 700; color: #10b981;">3.9</span>
                                        <i class="fas fa-arrow-up" style="color: #10b981; font-size: 10px;"></i>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 60px; height: 6px; background: #e0e6ed; border-radius: 3px; overflow: hidden;">
                                            <div style="width: 95%; height: 100%; background: #10b981;"></div>
                                        </div>
                                        <span style="font-size: 12px; font-weight: 600;">95%</span>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewStudentProfile('STU00002')" title="View Profile"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit" onclick="viewStudentTranscript('STU00002')" title="Transcript" style="background: #e3f2fd; color: #1976d2;"><i class="fas fa-file-alt"></i></button>
                                        <button class="action-btn" onclick="editStudent('STU00002')" title="Edit" style="background: #fef3c7; color: #92400e;"><i class="fas fa-edit"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-student-id="STU00003" data-course="cs401" data-status="probation" data-year="2">
                                <td><strong style="color: #667eea;">STU00003</strong></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">MB</div>
                                        <div class="user-details">
                                            <h4>Michael Brown</h4>
                                            <p>michael.b@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span style="font-weight: 600;">Year 2</span></td>
                                <td>
                                    <span style="display: inline-block; padding: 4px 8px; background: #e3f2fd; color: #1976d2; border-radius: 5px; font-size: 11px; margin-right: 3px;">4 Courses</span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <span style="font-weight: 700; color: #f59e0b;">2.4</span>
                                        <i class="fas fa-arrow-down" style="color: #e74c3c; font-size: 10px;"></i>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 60px; height: 6px; background: #e0e6ed; border-radius: 3px; overflow: hidden;">
                                            <div style="width: 68%; height: 100%; background: #f59e0b;"></div>
                                        </div>
                                        <span style="font-size: 12px; font-weight: 600;">68%</span>
                                    </div>
                                </td>
                                <td><span class="status-badge" style="background: #fff3e0; color: #f57c00;">On Probation</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewStudentProfile('STU00003')" title="View Profile"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit" onclick="viewStudentTranscript('STU00003')" title="Transcript" style="background: #e3f2fd; color: #1976d2;"><i class="fas fa-file-alt"></i></button>
                                        <button class="action-btn" onclick="editStudent('STU00003')" title="Edit" style="background: #fef3c7; color: #92400e;"><i class="fas fa-edit"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-student-id="STU00004" data-course="cs201,cs303" data-status="active" data-year="1">
                                <td><strong style="color: #667eea;">STU00004</strong></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">EJ</div>
                                        <div class="user-details">
                                            <h4>Emma Johnson</h4>
                                            <p>emma.j@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span style="font-weight: 600;">Year 1</span></td>
                                <td>
                                    <span style="display: inline-block; padding: 4px 8px; background: #e3f2fd; color: #1976d2; border-radius: 5px; font-size: 11px; margin-right: 3px;">5 Courses</span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <span style="font-weight: 700; color: #10b981;">3.6</span>
                                        <i class="fas fa-arrow-up" style="color: #10b981; font-size: 10px;"></i>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 60px; height: 6px; background: #e0e6ed; border-radius: 3px; overflow: hidden;">
                                            <div style="width: 88%; height: 100%; background: #10b981;"></div>
                                        </div>
                                        <span style="font-size: 12px; font-weight: 600;">88%</span>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewStudentProfile('STU00004')" title="View Profile"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit" onclick="viewStudentTranscript('STU00004')" title="Transcript" style="background: #e3f2fd; color: #1976d2;"><i class="fas fa-file-alt"></i></button>
                                        <button class="action-btn" onclick="editStudent('STU00004')" title="Edit" style="background: #fef3c7; color: #92400e;"><i class="fas fa-edit"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-student-id="STU00005" data-course="cs301,cs302,cs401" data-status="active" data-year="4">
                                <td><strong style="color: #667eea;">STU00005</strong></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">DW</div>
                                        <div class="user-details">
                                            <h4>David Wilson</h4>
                                            <p>david.w@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span style="font-weight: 600;">Year 4</span></td>
                                <td>
                                    <span style="display: inline-block; padding: 4px 8px; background: #e3f2fd; color: #1976d2; border-radius: 5px; font-size: 11px; margin-right: 3px;">7 Courses</span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <span style="font-weight: 700; color: #10b981;">4.0</span>
                                        <i class="fas fa-arrow-up" style="color: #10b981; font-size: 10px;"></i>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 60px; height: 6px; background: #e0e6ed; border-radius: 3px; overflow: hidden;">
                                            <div style="width: 98%; height: 100%; background: #10b981;"></div>
                                        </div>
                                        <span style="font-size: 12px; font-weight: 600;">98%</span>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewStudentProfile('STU00005')" title="View Profile"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn edit" onclick="viewStudentTranscript('STU00005')" title="Transcript" style="background: #e3f2fd; color: #1976d2;"><i class="fas fa-file-alt"></i></button>
                                        <button class="action-btn" onclick="editStudent('STU00005')" title="Edit" style="background: #fef3c7; color: #92400e;"><i class="fas fa-edit"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div id="noStudentsMessage" style="display: none; text-align: center; padding: 40px; color: #7f8c8d;">
                        <i class="fas fa-user-graduate" style="font-size: 48px; margin-bottom: 15px; opacity: 0.3;"></i>
                        <h3 style="margin: 0 0 10px 0;">No students found</h3>
                        <p style="margin: 0;">Try adjusting your filters or search query</p>
                    </div>
                </div>

                
                <div style="padding: 20px 30px; border-top: 2px solid #e0e6ed; background: #f8f9fa; display: flex; justify-content: space-between; align-items: center;">
                    <div style="color: #7f8c8d; font-size: 14px;">
                        Showing <strong id="showingStudentsCount">5</strong> of <strong>856</strong> students
                    </div>
                    <div style="display: flex; gap: 5px;">
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #7f8c8d;">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button style="padding: 8px 12px; border: 1px solid #667eea; background: #667eea; border-radius: 6px; cursor: pointer; color: white; font-weight: 600;">1</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #2c3e50;">2</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #2c3e50;">3</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #7f8c8d;">...</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #2c3e50;">108</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #7f8c8d;">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lecturers Management Modal -->
    <div id="lecturersModal" class="modal">
        <div class="modal-content" style="max-width: 1400px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <h2><i class="fas fa-chalkboard-teacher"></i> Lecturers Management</h2>
                <button class="close-btn" onclick="closeLecturersModal()">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                <!-- Lecturers Controls -->
                <div style="padding: 25px 30px; background: #f8f9fa; border-bottom: 2px solid #e0e6ed;">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 15px;">
                        <div style="display: flex; gap: 10px; flex-wrap: wrap; flex: 1;">
                            <div style="position: relative; flex: 1; min-width: 250px;">
                                <input type="text" id="lecturerSearchInput" class="form-control" placeholder="Search by name, ID, email, department..." oninput="filterLecturers()" style="padding-left: 40px;">
                                <i class="fas fa-search" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #7f8c8d;"></i>
                            </div>
                            <select id="departmentFilter" class="form-control" onchange="filterLecturers()" style="width: auto; min-width: 200px;">
                                <option value="all">All Departments</option>
                                <option value="computer_science">Computer Science</option>
                                <option value="engineering">Engineering</option>
                                <option value="business">Business</option>
                                <option value="mathematics">Mathematics</option>
                                <option value="physics">Physics</option>
                            </select>
                            <select id="statusFilterLecturer" class="form-control" onchange="filterLecturers()" style="width: auto; min-width: 150px;">
                                <option value="all">All Status</option>
                                <option value="active">Active</option>
                                <option value="on_leave">On Leave</option>
                                <option value="sabbatical">Sabbatical</option>
                                <option value="retired">Retired</option>
                            </select>
                        </div>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn" onclick="openAddUserModal(); closeLecturersModal();" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                                <i class="fas fa-user-plus"></i> Add Lecturer
                            </button>
                            <button class="btn" onclick="exportLecturers()" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                                <i class="fas fa-download"></i> Export
                            </button>
                        </div>
                    </div>
                    
                    <!-- Quick Stats -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
                        <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #f093fb;">
                            <div style="font-size: 24px; font-weight: 700; color: #2c3e50;">142</div>
                            <div style="font-size: 12px; color: #7f8c8d; margin-top: 5px;">Total Lecturers</div>
                        </div>
                        <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #10b981;">
                            <div style="font-size: 24px; font-weight: 700; color: #2c3e50;">128</div>
                            <div style="font-size: 12px; color: #7f8c8d; margin-top: 5px;">Active</div>
                        </div>
                        <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #3b82f6;">
                            <div style="font-size: 24px; font-weight: 700; color: #2c3e50;">68</div>
                            <div style="font-size: 12px; color: #7f8c8d; margin-top: 5px;">Total Courses</div>
                        </div>
                        <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #f59e0b;">
                            <div style="font-size: 24px; font-weight: 700; color: #2c3e50;">4.2</div>
                            <div style="font-size: 12px; color: #7f8c8d; margin-top: 5px;">Avg Rating</div>
                        </div>
                        <div style="background: white; padding: 15px; border-radius: 10px; border-left: 4px solid #dc2626;">
                            <div style="font-size: 24px; font-weight: 700; color: #2c3e50;">856</div>
                            <div style="font-size: 12px; color: #7f8c8d; margin-top: 5px;">Total Students</div>
                        </div>
                    </div>
                </div>

                <!-- Lecturers Table -->
                <div style="padding: 30px; max-height: 60vh; overflow-y: auto;">
                    <table class="users-table" id="lecturersTable">
                        <thead>
                            <tr>
                                <th>Lecturer ID</th>
                                <th>Lecturer</th>
                                <th>Department</th>
                                <th>Courses</th>
                                <th>Students</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="lecturersTableBody">
                            <tr data-lecturer-id="LEC00001" data-department="computer_science" data-status="active">
                                <td><strong style="color: #f093fb;">LEC00001</strong></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">SJ</div>
                                        <div class="user-details">
                                            <h4>Dr. Sarah Johnson</h4>
                                            <p>sarah.j@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="display: inline-block; padding: 5px 10px; background: #e3f2fd; color: #1976d2; border-radius: 5px; font-size: 12px; font-weight: 600;">Computer Science</span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-book" style="color: #667eea; font-size: 12px;"></i>
                                        <span style="font-weight: 600;">5 Courses</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-user-graduate" style="color: #f59e0b; font-size: 12px;"></i>
                                        <span style="font-weight: 600;">248 Students</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-star" style="color: #fbbf24; font-size: 12px;"></i>
                                        <span style="font-weight: 700; color: #2c3e50;">4.8</span>
                                        <span style="font-size: 11px; color: #7f8c8d;">(156)</span>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewLecturerProfile('LEC00001')" title="View Profile"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn" onclick="viewLecturerCourses('LEC00001')" title="Courses" style="background: #e3f2fd; color: #1976d2;"><i class="fas fa-book"></i></button>
                                        <button class="action-btn edit" onclick="editLecturer('LEC00001')" title="Edit"><i class="fas fa-edit"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-lecturer-id="LEC00002" data-department="engineering" data-status="active">
                                <td><strong style="color: #f093fb;">LEC00002</strong></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">MC</div>
                                        <div class="user-details">
                                            <h4>Prof. Michael Chen</h4>
                                            <p>michael.c@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="display: inline-block; padding: 5px 10px; background: #fef3c7; color: #92400e; border-radius: 5px; font-size: 12px; font-weight: 600;">Engineering</span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-book" style="color: #667eea; font-size: 12px;"></i>
                                        <span style="font-weight: 600;">4 Courses</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-user-graduate" style="color: #f59e0b; font-size: 12px;"></i>
                                        <span style="font-weight: 600;">185 Students</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-star" style="color: #fbbf24; font-size: 12px;"></i>
                                        <span style="font-weight: 700; color: #2c3e50;">4.6</span>
                                        <span style="font-size: 11px; color: #7f8c8d;">(124)</span>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewLecturerProfile('LEC00002')" title="View Profile"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn" onclick="viewLecturerCourses('LEC00002')" title="Courses" style="background: #e3f2fd; color: #1976d2;"><i class="fas fa-book"></i></button>
                                        <button class="action-btn edit" onclick="editLecturer('LEC00002')" title="Edit"><i class="fas fa-edit"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-lecturer-id="LEC00003" data-department="business" data-status="active">
                                <td><strong style="color: #f093fb;">LEC00003</strong></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">ED</div>
                                        <div class="user-details">
                                            <h4>Dr. Emily Davis</h4>
                                            <p>emily.d@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="display: inline-block; padding: 5px 10px; background: #d1fae5; color: #065f46; border-radius: 5px; font-size: 12px; font-weight: 600;">Business</span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-book" style="color: #667eea; font-size: 12px;"></i>
                                        <span style="font-weight: 600;">6 Courses</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-user-graduate" style="color: #f59e0b; font-size: 12px;"></i>
                                        <span style="font-weight: 600;">312 Students</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-star" style="color: #fbbf24; font-size: 12px;"></i>
                                        <span style="font-weight: 700; color: #2c3e50;">4.9</span>
                                        <span style="font-size: 11px; color: #7f8c8d;">(203)</span>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewLecturerProfile('LEC00003')" title="View Profile"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn" onclick="viewLecturerCourses('LEC00003')" title="Courses" style="background: #e3f2fd; color: #1976d2;"><i class="fas fa-book"></i></button>
                                        <button class="action-btn edit" onclick="editLecturer('LEC00003')" title="Edit"><i class="fas fa-edit"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-lecturer-id="LEC00004" data-department="mathematics" data-status="on_leave">
                                <td><strong style="color: #f093fb;">LEC00004</strong></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">RW</div>
                                        <div class="user-details">
                                            <h4>Prof. Robert Wilson</h4>
                                            <p>robert.w@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="display: inline-block; padding: 5px 10px; background: #f3e5f5; color: #6a1b9a; border-radius: 5px; font-size: 12px; font-weight: 600;">Mathematics</span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-book" style="color: #667eea; font-size: 12px;"></i>
                                        <span style="font-weight: 600;">3 Courses</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-user-graduate" style="color: #f59e0b; font-size: 12px;"></i>
                                        <span style="font-weight: 600;">95 Students</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-star" style="color: #fbbf24; font-size: 12px;"></i>
                                        <span style="font-weight: 700; color: #2c3e50;">4.3</span>
                                        <span style="font-size: 11px; color: #7f8c8d;">(87)</span>
                                    </div>
                                </td>
                                <td><span class="status-badge" style="background: #fff3e0; color: #f57c00;">On Leave</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewLecturerProfile('LEC00004')" title="View Profile"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn" onclick="viewLecturerCourses('LEC00004')" title="Courses" style="background: #e3f2fd; color: #1976d2;"><i class="fas fa-book"></i></button>
                                        <button class="action-btn edit" onclick="editLecturer('LEC00004')" title="Edit"><i class="fas fa-edit"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-lecturer-id="LEC00005" data-department="physics" data-status="active">
                                <td><strong style="color: #f093fb;">LEC00005</strong></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">JB</div>
                                        <div class="user-details">
                                            <h4>Dr. Jessica Brown</h4>
                                            <p>jessica.b@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span style="display: inline-block; padding: 5px 10px; background: #fee2e2; color: #991b1b; border-radius: 5px; font-size: 12px; font-weight: 600;">Physics</span>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-book" style="color: #667eea; font-size: 12px;"></i>
                                        <span style="font-weight: 600;">4 Courses</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-user-graduate" style="color: #f59e0b; font-size: 12px;"></i>
                                        <span style="font-weight: 600;">142 Students</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-star" style="color: #fbbf24; font-size: 12px;"></i>
                                        <span style="font-weight: 700; color: #2c3e50;">4.7</span>
                                        <span style="font-size: 11px; color: #7f8c8d;">(98)</span>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewLecturerProfile('LEC00005')" title="View Profile"><i class="fas fa-eye"></i></button>
                                        <button class="action-btn" onclick="viewLecturerCourses('LEC00005')" title="Courses" style="background: #e3f2fd; color: #1976d2;"><i class="fas fa-book"></i></button>
                                        <button class="action-btn edit" onclick="editLecturer('LEC00005')" title="Edit"><i class="fas fa-edit"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div id="noLecturersMessage" style="display: none; text-align: center; padding: 40px; color: #7f8c8d;">
                        <i class="fas fa-chalkboard-teacher" style="font-size: 48px; margin-bottom: 15px; opacity: 0.3;"></i>
                        <h3 style="margin: 0 0 10px 0;">No lecturers found</h3>
                        <p style="margin: 0;">Try adjusting your filters or search query</p>
                    </div>
                </div>

                
                <div style="padding: 20px 30px; border-top: 2px solid #e0e6ed; background: #f8f9fa; display: flex; justify-content: space-between; align-items: center;">
                    <div style="color: #7f8c8d; font-size: 14px;">
                        Showing <strong id="showingLecturersCount">5</strong> of <strong>142</strong> lecturers
                    </div>
                    <div style="display: flex; gap: 5px;">
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #7f8c8d;">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button style="padding: 8px 12px; border: 1px solid #f093fb; background: #f093fb; border-radius: 6px; cursor: pointer; color: white; font-weight: 600;">1</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #2c3e50;">2</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #2c3e50;">3</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #7f8c8d;">...</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #2c3e50;">29</button>
                        <button style="padding: 8px 12px; border: 1px solid #e0e6ed; background: white; border-radius: 6px; cursor: pointer; color: #7f8c8d;">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        function openAddUserModal() {
            document.getElementById('addUserModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeAddUserModal() {
            document.getElementById('addUserModal').classList.remove('show');
            document.getElementById('addUserForm').reset();
            document.body.style.overflow = 'auto';
            
            document.getElementById('passwordStrengthBar').className = 'password-strength-bar';
            document.getElementById('passwordStrengthText').textContent = '';
        }

        
window.onclick = function(event) {
    const userModal = document.getElementById('addUserModal');
    const courseModal = document.getElementById('createCourseModal');
    const examModal = document.getElementById('scheduleExamModal');
    const notificationModal = document.getElementById('notificationModal');
    const userManagementModal = document.getElementById('userManagementModal');
    const studentsModal = document.getElementById('studentsModal');
    const lecturersModal = document.getElementById('lecturersModal');
    if (event.target === userModal) {
        closeAddUserModal();
    }
    if (event.target === courseModal) {
        closeCourseModal();
    }
    if (event.target === examModal) {
        closeExamModal();
    }
    if (event.target === notificationModal) {
        closeNotificationModal();
    }
    if (event.target === userManagementModal) {
        closeUserManagementModal();
    }
    if (event.target === lecturersModal) {
        closeLecturersModal();
    }
    if (event.target === studentsModal) {
        closeStudentsModal();
    }
}


function openScheduleExamModal() {
    document.getElementById('scheduleExamModal').classList.add('show');
    document.body.style.overflow = 'hidden';
    
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('examDate').setAttribute('min', today);
}

function closeExamModal() {
    document.getElementById('scheduleExamModal').classList.remove('show');
    document.getElementById('scheduleExamForm').reset();
    document.body.style.overflow = 'auto';
    document.getElementById('capacityWarning').textContent = '';
}


function updateExamInfo(select) {
    const selectedOption = select.options[select.selectedIndex];
    const students = selectedOption.getAttribute('data-students');
    if (students) {
        document.getElementById('expectedStudents').value = students;
        validateHallCapacity();
    }
}


function updateHallCapacity(select) {
    validateHallCapacity();
}

function validateHallCapacity() {
    const hallSelect = document.querySelector('select[name="exam_hall"]');
    const studentsInput = document.getElementById('expectedStudents');
    const warning = document.getElementById('capacityWarning');
    
    if (hallSelect.value && studentsInput.value) {
        const selectedOption = hallSelect.options[hallSelect.selectedIndex];
        const capacity = parseInt(selectedOption.getAttribute('data-capacity'));
        const students = parseInt(studentsInput.value);
        
        if (students > capacity) {
            warning.textContent = '⚠️ Students exceed hall capacity!';
            warning.style.color = '#e74c3c';
        } else {
            warning.textContent = `✓ ${capacity - students} seats remaining`;
            warning.style.color = '#27ae60';
        }
    }
}


function calculateEndTime() {
    const startTimeInput = document.querySelector('input[name="start_time"]');
    const durationInput = document.querySelector('input[name="duration"]');
    const endTimeInput = document.getElementById('endTime');
    
    if (startTimeInput.value && durationInput.value) {
        const [hours, minutes] = startTimeInput.value.split(':').map(Number);
        const duration = parseInt(durationInput.value);
        
        const startDate = new Date();
        startDate.setHours(hours, minutes, 0);
        startDate.setMinutes(startDate.getMinutes() + duration);
        
        const endHours = String(startDate.getHours()).padStart(2, '0');
        const endMinutes = String(startDate.getMinutes()).padStart(2, '0');
        endTimeInput.value = `${endHours}:${endMinutes}`;
    }
}

function validatePassingMarks() {
    const totalMarks = parseInt(document.querySelector('input[name="total_marks"]').value);
    const passingMarks = parseInt(document.querySelector('input[name="passing_marks"]').value);
    const errorMsg = document.getElementById('passingMarksError');
    const passingInput = document.querySelector('input[name="passing_marks"]');
    
    if (totalMarks && passingMarks && passingMarks >= totalMarks) {
        passingInput.classList.add('error');
        errorMsg.classList.add('show');
    } else {
        passingInput.classList.remove('error');
        errorMsg.classList.remove('show');
    }
}


function handleSubmitExam(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const submitBtn = document.getElementById('submitExamBtn');
    

    const totalMarks = parseInt(formData.get('total_marks'));
    const passingMarks = parseInt(formData.get('passing_marks'));
    if (passingMarks >= totalMarks) {
        alert('Passing marks must be less than total marks!');
        return;
    }
    

    const warning = document.getElementById('capacityWarning');
    if (warning.textContent.includes('exceed')) {
        if (!confirm('Students exceed hall capacity. Continue anyway?')) {
            return;
        }
    }
    
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Scheduling...';

    
    setTimeout(() => {
        alert('Exam scheduled successfully!');
        closeExamModal();
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-check"></i> Schedule Exam';
        
        
    }, 1500);

    
    
}


function openNotificationModal() {
    document.getElementById('notificationModal').classList.add('show');
    document.body.style.overflow = 'hidden';
    updateRecipientCount();
}

function closeNotificationModal() {
    document.getElementById('notificationModal').classList.remove('show');
    document.getElementById('notificationForm').reset();
    document.body.style.overflow = 'auto';
    document.getElementById('charCount').textContent = '0 / 500 characters';
    document.getElementById('specificUsersGroup').style.display = 'none';
    document.getElementById('courseSelectGroup').style.display = 'none';
    document.getElementById('scheduleDateTime').style.display = 'none';
}


function toggleSpecificSelection() {
    const specificGroup = document.getElementById('specificUsersGroup');
    const courseGroup = document.getElementById('courseSelectGroup');
    const targetSpecific = document.getElementById('targetSpecific');
    const targetCourse = document.getElementById('targetCourse');
    
    if (targetSpecific.checked) {
        specificGroup.style.display = 'block';
        courseGroup.style.display = 'none';
    } else if (targetCourse.checked) {
        specificGroup.style.display = 'none';
        courseGroup.style.display = 'block';
    } else {
        specificGroup.style.display = 'none';
        courseGroup.style.display = 'none';
    }
    
    updateRecipientCount();
}


function updateCharCount() {
    const message = document.getElementById('notificationMessage').value;
    const charCount = document.getElementById('charCount');
    const length = message.length;
    charCount.textContent = `${length} / 500 characters`;
    
    if (length > 500) {
        charCount.style.color = '#e74c3c';
    } else if (length > 400) {
        charCount.style.color = '#f39c12';
    } else {
        charCount.style.color = '#7f8c8d';
    }
}


function toggleScheduleDateTime() {
    const scheduleType = document.getElementById('scheduleType').value;
    const scheduleDateTime = document.getElementById('scheduleDateTime');
    
    if (scheduleType === 'later') {
        scheduleDateTime.style.display = 'block';
        const now = new Date();
        now.setMinutes(now.getMinutes() + 30);
        const datetimeLocal = now.toISOString().slice(0, 16);
        document.querySelector('input[name="schedule_datetime"]').value = datetimeLocal;
    } else {
        scheduleDateTime.style.display = 'none';
    }
}


function updateRecipientCount() {
    const recipientCount = document.getElementById('recipientCount');
    const target = document.querySelector('input[name="target"]:checked')?.value;
    
    let count = 0;
    let text = '';
    
    switch(target) {
        case 'all':
            count = 1248;
            text = `Approximately <strong>${count}</strong> users will receive this notification`;
            break;
        case 'students':
            count = 856;
            text = `Approximately <strong>${count}</strong> students will receive this notification`;
            break;
        case 'lecturers':
            count = 142;
            text = `Approximately <strong>${count}</strong> lecturers will receive this notification`;
            break;
        case 'staff':
            count = 250;
            text = `Approximately <strong>${count}</strong> staff members will receive this notification`;
            break;
        case 'specific':
            const selectedUsers = document.querySelector('select[name="specific_users[]"]');
            count = selectedUsers ? selectedUsers.selectedOptions.length : 0;
            text = `<strong>${count}</strong> user(s) selected`;
            break;
        case 'course':
            const selectedCourse = document.querySelector('select[name="course_id"]')?.value;
            if (selectedCourse) {
                const courseOption = document.querySelector(`select[name="course_id"] option[value="${selectedCourse}"]`);
                const match = courseOption?.textContent.match(/\((\d+) students\)/);
                count = match ? parseInt(match[1]) : 0;
            }
            text = count > 0 ? `<strong>${count}</strong> students in selected course` : 'Please select a course';
            break;
        default:
            text = 'Select target audience to see recipient count';
    }
    
    recipientCount.innerHTML = text;
}


function openUserManagementModal() {
    document.getElementById('userManagementModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeUserManagementModal() {
    document.getElementById('userManagementModal').classList.remove('show');
    document.body.style.overflow = 'auto';
    clearSelection();
}


function filterUsers() {
    const searchInput = document.getElementById('userSearchInput').value.toLowerCase();
    const roleFilter = document.getElementById('roleFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('#usersTableBody tr');
    const noResults = document.getElementById('noResultsMessage');
    
    let visibleCount = 0;
    
    rows.forEach(row => {
        const userName = row.querySelector('.user-details h4').textContent.toLowerCase();
        const userEmail = row.querySelector('.user-details p').textContent.toLowerCase();
        const userRole = row.getAttribute('data-role');
        const userStatus = row.getAttribute('data-status');
        
        const matchesSearch = userName.includes(searchInput) || userEmail.includes(searchInput);
        const matchesRole = roleFilter === 'all' || userRole === roleFilter;
        const matchesStatus = statusFilter === 'all' || userStatus === statusFilter;
        
        if (matchesSearch && matchesRole && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    

    if (visibleCount === 0) {
        noResults.style.display = 'block';
        document.getElementById('managementUsersTable').style.display = 'none';
    } else {
        noResults.style.display = 'none';
        document.getElementById('managementUsersTable').style.display = 'table';
    }
    
    document.getElementById('showingCount').textContent = visibleCount;
}


function toggleSelectAll() {
    const selectAll = document.getElementById('selectAllUsers');
    const checkboxes = document.querySelectorAll('.user-checkbox');
    
    checkboxes.forEach(checkbox => {
        const row = checkbox.closest('tr');
        if (row.style.display !== 'none') {
            checkbox.checked = selectAll.checked;
        }
    });
    
    updateBulkActions();
}


function updateBulkActions() {
    const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
    const bulkActionsBar = document.getElementById('bulkActionsBar');
    const selectedCount = document.getElementById('selectedCount');
    
    if (checkedBoxes.length > 0) {
        bulkActionsBar.style.display = 'block';
        selectedCount.textContent = `${checkedBoxes.length} user${checkedBoxes.length > 1 ? 's' : ''} selected`;
    } else {
        bulkActionsBar.style.display = 'none';
        document.getElementById('selectAllUsers').checked = false;
    }
}


function clearSelection() {
    document.querySelectorAll('.user-checkbox').forEach(cb => cb.checked = false);
    document.getElementById('selectAllUsers').checked = false;
    updateBulkActions();
}


function bulkActivate() {
    const selectedUsers = getSelectedUserIds();
    if (confirm(`Activate ${selectedUsers.length} selected user(s)?`)) {
        alert(`${selectedUsers.length} user(s) activated successfully!`);
        clearSelection();
        
    }
}

function bulkSuspend() {
    const selectedUsers = getSelectedUserIds();
    if (confirm(`Suspend ${selectedUsers.length} selected user(s)?`)) {
        alert(`${selectedUsers.length} user(s) suspended successfully!`);
        clearSelection();
    
    }
}

function bulkDelete() {
    const selectedUsers = getSelectedUserIds();
    if (confirm(`Are you sure you want to delete ${selectedUsers.length} selected user(s)? This action cannot be undone!`)) {
        alert(`${selectedUsers.length} user(s) deleted successfully!`);
        clearSelection();
        
    }
}

function getSelectedUserIds() {
    const selectedIds = [];
    document.querySelectorAll('.user-checkbox:checked').forEach(checkbox => {
        const row = checkbox.closest('tr');
        selectedIds.push(row.getAttribute('data-user-id'));
    });
    return selectedIds;
}


function viewUserDetails(userId) {
    alert(`Viewing details for user ID: ${userId}\\n\\nThis would open a detailed view modal with:\\n- Personal Information\\n- Activity History\\n- Enrolled Courses\\n- Performance Metrics\\n- Login History`);
    
}

function editUser(userId) {
    alert(`Editing user ID: ${userId}\\n\\nThis would open an edit form with:\\n- Editable user information\\n- Role management\\n- Status control\\n- Permissions settings`);
    closeUserManagementModal();
    
}

function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user? This action cannot be undone!')) {
        alert(`User ${userId} deleted successfully!`);
        
    }
}


function exportUsers() {
    alert('Exporting users to CSV...\\n\\nThis would generate a CSV file with:\\n- All visible users (based on filters)\\n- User details\\n- Export timestamp');
    
}


function openStudentsModal() {
    document.getElementById('studentsModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeStudentsModal() {
    document.getElementById('studentsModal').classList.remove('show');
    document.body.style.overflow = 'auto';
}

function openLecturersModal() {
    document.getElementById('lecturersModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closeLecturersModal() {
    document.getElementById('lecturersModal').classList.remove('show');
    document.body.style.overflow = 'auto';
}

function filterLecturers() {
    const searchInput = document.getElementById('lecturerSearchInput').value.toLowerCase();
    const departmentFilter = document.getElementById('departmentFilter').value;
    const statusFilter = document.getElementById('statusFilterLecturer').value;
    const rows = document.querySelectorAll('#lecturersTableBody tr');
    const noResults = document.getElementById('noLecturersMessage');
    
    let visibleCount = 0;
    
    rows.forEach(row => {
        const lecturerId = row.getAttribute('data-lecturer-id').toLowerCase();
        const lecturerName = row.querySelector('.user-details h4').textContent.toLowerCase();
        const lecturerEmail = row.querySelector('.user-details p').textContent.toLowerCase();
        const lecturerDepartment = row.getAttribute('data-department');
        const lecturerStatus = row.getAttribute('data-status');
        
        const matchesSearch = lecturerName.includes(searchInput) || 
                            lecturerEmail.includes(searchInput) || 
                            lecturerId.includes(searchInput);
        const matchesDepartment = departmentFilter === 'all' || lecturerDepartment === departmentFilter;
        const matchesStatus = statusFilter === 'all' || lecturerStatus === statusFilter;
        
        if (matchesSearch && matchesDepartment && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    
    document.getElementById('showingLecturersCount').textContent = visibleCount;
    
    
    if (visibleCount === 0) {
        noResults.style.display = 'block';
        document.getElementById('lecturersTable').style.display = 'none';
    } else {
        noResults.style.display = 'none';
        document.getElementById('lecturersTable').style.display = 'table';
    }
}

function viewLecturerProfile(lecturerId) {
    alert('View profile for lecturer: ' + lecturerId + '\n\nThis will show:\n- Personal information\n- Qualifications\n- Research interests\n- Publications\n- Contact details\n- Performance history');
}

function viewLecturerCourses(lecturerId) {
    alert('View courses for lecturer: ' + lecturerId + '\n\nThis will show:\n- Current courses\n- Past courses\n- Student counts\n- Ratings and feedback\n- Schedules and timetables');
}

function editLecturer(lecturerId) {
    alert('Edit lecturer: ' + lecturerId + '\n\nThis will allow you to update:\n- Personal information\n- Department assignment\n- Contact details\n- Status\n- Qualifications');
}

function exportLecturers() {
    alert('Export lecturers data\n\nThis will export the filtered lecturer list to:\n- CSV format\n- Excel format\n- PDF report\n\nIncluding course assignments, student counts, and ratings.');
}

function filterStudents() {
    const searchInput = document.getElementById('studentSearchInput').value.toLowerCase();
    const courseFilter = document.getElementById('courseFilterStudent').value;
    const statusFilter = document.getElementById('statusFilterStudent').value;
    const yearFilter = document.getElementById('yearFilterStudent').value;
    const rows = document.querySelectorAll('#studentsTableBody tr');
    const noResults = document.getElementById('noStudentsMessage');
    
    let visibleCount = 0;
    
    rows.forEach(row => {
        const studentId = row.getAttribute('data-student-id').toLowerCase();
        const studentName = row.querySelector('.user-details h4').textContent.toLowerCase();
        const studentEmail = row.querySelector('.user-details p').textContent.toLowerCase();
        const studentCourses = row.getAttribute('data-course');
        const studentStatus = row.getAttribute('data-status');
        const studentYear = row.getAttribute('data-year');
        
        const matchesSearch = studentName.includes(searchInput) || 
                            studentEmail.includes(searchInput) || 
                            studentId.includes(searchInput);
        const matchesCourse = courseFilter === 'all' || studentCourses.includes(courseFilter);
        const matchesStatus = statusFilter === 'all' || studentStatus === statusFilter;
        const matchesYear = yearFilter === 'all' || studentYear === yearFilter;
        
        if (matchesSearch && matchesCourse && matchesStatus && matchesYear) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    

    if (visibleCount === 0) {
        noResults.style.display = 'block';
        document.getElementById('studentsTable').style.display = 'none';
    } else {
        noResults.style.display = 'none';
        document.getElementById('studentsTable').style.display = 'table';
    }
    
    document.getElementById('showingStudentsCount').textContent = visibleCount;
}


function viewStudentProfile(studentId) {
    alert(`Viewing profile for Student: ${studentId}\\n\\nThis would show:\\n- Personal Information\\n- Contact Details\\n- Emergency Contacts\\n- Enrollment History\\n- Current Courses\\n- Academic Performance\\n- Attendance Records\\n- Financial Status\\n- Documents & Certificates`);

}


function viewStudentTranscript(studentId) {
    alert(`Viewing transcript for Student: ${studentId}\\n\\nThis would display:\\n- Complete academic transcript\\n- Semester-wise grades\\n- Course credits\\n- GPA calculation\\n- Academic standing\\n- Honors & awards\\n- Transfer credits\\n- Print/Download options`);
    
}


function editStudent(studentId) {
    alert(`Editing Student: ${studentId}\\n\\nThis would allow editing:\\n- Personal information\\n- Course enrollments\\n- Academic status\\n- Contact details\\n- Permissions\\n- Financial information`);
    
}


function exportStudents() {
    alert('Exporting students to CSV...\\n\\nThis would generate a CSV file with:\\n- All visible students (based on filters)\\n- Student details\\n- Academic information\\n- Export timestamp');
    
}

function handleSubmitNotification(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const submitBtn = document.getElementById('submitNotificationBtn');
    
    
    const message = document.getElementById('notificationMessage').value;
    if (message.length > 500) {
        alert('Message is too long! Maximum 500 characters allowed.');
        return;
    }
    
    
    const deliveryMethods = formData.getAll('delivery_method[]');
    if (deliveryMethods.length === 0) {
        alert('Please select at least one delivery method!');
        return;
    }
    
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';

    
    setTimeout(() => {
        alert('Notification sent successfully!');
        closeNotificationModal();
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Notification';
        
        
    }, 1500);

    
    
}

document.addEventListener('DOMContentLoaded', function() {
    
    const startTimeInput = document.querySelector('input[name="start_time"]');
    if (startTimeInput) {
        startTimeInput.addEventListener('change', calculateEndTime);
    }
    
    const expectedStudentsInput = document.getElementById('expectedStudents');
    if (expectedStudentsInput) {
        expectedStudentsInput.addEventListener('input', validateHallCapacity);
    }
});

function openCreateCourseModal() {
    document.getElementById('createCourseModal').classList.add('show');
    document.body.style.overflow = 'hidden';
    
    const today = new Date().toISOString().split('T')[0];
    document.querySelector('input[name="start_date"]').value = today;
}

function closeCourseModal() {
    document.getElementById('createCourseModal').classList.remove('show');
    document.getElementById('createCourseForm').reset();
    document.body.style.overflow = 'auto';
}


function handleSubmitCourse(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const submitBtn = document.getElementById('submitCourseBtn');
    

    const startDate = new Date(formData.get('start_date'));
    const endDate = new Date(formData.get('end_date'));
    if (endDate <= startDate) {
        alert('End date must be after start date!');
        return;
    }
    

    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating...';

    
    setTimeout(() => {
        alert('Course created successfully!');
        closeCourseModal();
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-check"></i> Create Course';
        
        
        
    }, 1500);

    
}

function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('passwordStrengthText');

            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            strengthBar.className = 'password-strength-bar';
            if (strength <= 1) {
                strengthBar.classList.add('weak');
                strengthText.textContent = 'Weak password';
                strengthText.style.color = '#e74c3c';
            } else if (strength <= 3) {
                strengthBar.classList.add('medium');
                strengthText.textContent = 'Medium strength';
                strengthText.style.color = '#f39c12';
            } else {
                strengthBar.classList.add('strong');
                strengthText.textContent = 'Strong password';
                strengthText.style.color = '#27ae60';
            }
        }

        
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const errorMsg = document.getElementById('confirmPasswordError');
            const confirmField = document.getElementById('confirmPassword');

            if (confirmPassword && password !== confirmPassword) {
                confirmField.classList.add('error');
                errorMsg.classList.add('show');
            } else {
                confirmField.classList.remove('error');
                errorMsg.classList.remove('show');
            }
        }

    
        function handleSubmitUser(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            const submitBtn = document.getElementById('submitBtn');
            
    
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating...';

            
            setTimeout(() => {
                
                
                alert('User created successfully!');
                closeAddUserModal();
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-check"></i> Add User';
                
                
        }, 1500);
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
        
    