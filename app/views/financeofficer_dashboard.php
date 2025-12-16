
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Officer Dashboard - Education Portal</title>
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

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, #134e4a 0%, #0f766e 100%);
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
            color: #10b981;
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

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 30px;
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: 80px;
        }

        /* Header */
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
            border-color: #0f766e;
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
            background: linear-gradient(135deg, #134e4a 0%, #0f766e 100%);
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
            background: var(--card-color);
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

        .stat-icon.green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .stat-icon.blue {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .stat-icon.orange {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .stat-icon.red {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .stat-content h3 {
            font-size: 32px;
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
            color: #10b981;
        }

        .stat-trend.down {
            color: #ef4444;
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
            color: #0f766e;
        }

        .view-all {
            color: #0f766e;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .view-all:hover {
            color: #134e4a;
        }

        
        .transactions-table {
            width: 100%;
            border-collapse: collapse;
        }

        .transactions-table th {
            text-align: left;
            padding: 15px;
            background: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
            border-bottom: 2px solid #e0e6ed;
        }

        .transactions-table td {
            padding: 15px;
            border-bottom: 1px solid #e0e6ed;
            font-size: 14px;
            color: #2c3e50;
        }

        .transactions-table tr:hover {
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
            background: linear-gradient(135deg, #134e4a 0%, #0f766e 100%);
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

        .amount {
            font-weight: 700;
            font-size: 15px;
        }

        .amount.credit {
            color: #10b981;
        }

        .amount.debit {
            color: #ef4444;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.completed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-badge.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-badge.failed {
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

        .action-btn.print {
            background: #f3e8ff;
            color: #6b21a8;
        }

        .action-btn.print:hover {
            background: #6b21a8;
            color: white;
        }
        
        .payment-summary {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .summary-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .summary-item h4 {
            font-size: 14px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .summary-item p {
            font-size: 12px;
            color: #7f8c8d;
        }

        .summary-amount {
            font-size: 24px;
            font-weight: 700;
            color: #0f766e;
        }

    
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .quick-action-btn {
            padding: 20px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        }

        .quick-action-btn i {
            font-size: 24px;
        }

        .quick-action-btn span {
            font-size: 14px;
            font-weight: 600;
        }

        
        .chart-container {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 10px;
            color: #7f8c8d;
            font-size: 14px;
        }


        .pending-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .pending-item {
            padding: 15px;
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .pending-item:hover {
            background: #fde68a;
            transform: translateX(5px);
        }

        .pending-item h4 {
            font-size: 15px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .pending-item p {
            font-size: 13px;
            color: #7f8c8d;
            margin-bottom: 8px;
        }

        .pending-amount {
            font-size: 18px;
            font-weight: 700;
            color: #d97706;
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
            background: linear-gradient(135deg, #134e4a 0%, #0f766e 100%);
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
                <i class="fas fa-dollar-sign"></i>
                <span class="logo-text">Finance Panel</span>
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
                        <i class="fas fa-receipt"></i>
                        <span class="nav-text">Transactions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-graduate"></i>
                        <span class="nav-text">Student Fees</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-clock"></i>
                        <span class="nav-text">Pending Payments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span class="nav-text">Invoices</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        <span class="nav-text">Reports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-wallet"></i>
                        <span class="nav-text">Expenses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-history"></i>
                        <span class="nav-text">Payment History</span>
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
                <h1>Finance Dashboard 💰</h1>
                <p>Welcome back, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Finance Officer'); ?>!</p>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <input type="text" placeholder="Search transactions...">
                    <i class="fas fa-search"></i>
                </div>
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">7</span>
                </button>
                <div class="user-profile">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($_SESSION['username'] ?? 'F', 0, 1)); ?>
                    </div>
                    <div class="user-info">
                        <h4><?php echo htmlspecialchars($_SESSION['username'] ?? 'Finance Officer'); ?></h4>
                        <p>Finance Department</p>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="stats-grid">
            <div class="stat-card" style="--card-color: #10b981;">
                <div class="stat-icon green">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-content">
                    <h3>$248,500</h3>
                    <p>Total Revenue</p>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> 12% this month
                    </div>
                </div>
            </div>
            <div class="stat-card" style="--card-color: #3b82f6;">
                <div class="stat-icon blue">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>1,248</h3>
                    <p>Completed Payments</p>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> 8% this month
                    </div>
                </div>
            </div>
            <div class="stat-card" style="--card-color: #f59e0b;">
                <div class="stat-icon orange">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>142</h3>
                    <p>Pending Payments</p>
                    <div class="stat-trend down">
                        <i class="fas fa-arrow-down"></i> 3% this month
                    </div>
                </div>
            </div>
            <div class="stat-card" style="--card-color: #ef4444;">
                <div class="stat-icon red">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-content">
                    <h3>28</h3>
                    <p>Overdue Payments</p>
                    <div class="stat-trend up">
                        <i class="fas fa-arrow-up"></i> Requires attention
                    </div>
                </div>
            </div>
        </div>

    
        <div class="content-grid">
            
            <div class="content-card">
                <div class="card-header">
                    <h2><i class="fas fa-receipt"></i> Recent Transactions</h2>
                    <a href="#" class="view-all">View All →</a>
                </div>
                <table class="transactions-table">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
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
                            <td>Tuition Fee</td>
                            <td><span class="amount credit">+$2,500</span></td>
                            <td><span class="status-badge completed">Completed</span></td>
                            <td>Dec 16, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn print"><i class="fas fa-print"></i></button>
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
                            <td>Lab Fee</td>
                            <td><span class="amount credit">+$150</span></td>
                            <td><span class="status-badge completed">Completed</span></td>
                            <td>Dec 16, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn print"><i class="fas fa-print"></i></button>
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
                            <td>Library Fee</td>
                            <td><span class="amount credit">+$50</span></td>
                            <td><span class="status-badge pending">Pending</span></td>
                            <td>Dec 15, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn print"><i class="fas fa-print"></i></button>
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
                            <td>Exam Fee</td>
                            <td><span class="amount credit">+$100</span></td>
                            <td><span class="status-badge completed">Completed</span></td>
                            <td>Dec 15, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn print"><i class="fas fa-print"></i></button>
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
                            <td>Tuition Fee</td>
                            <td><span class="amount credit">+$2,500</span></td>
                            <td><span class="status-badge failed">Failed</span></td>
                            <td>Dec 14, 2025</td>
                            <td>
                                <div class="action-btns">
                                    <button class="action-btn view"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn print"><i class="fas fa-print"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Payment Summary -->
            <div class="content-card">
                <div class="card-header">
                    <h2><i class="fas fa-chart-pie"></i> Payment Summary</h2>
                    <a href="#" class="view-all">View All →</a>
                </div>
                <div class="payment-summary">
                    <div class="summary-item">
                        <div>
                            <h4>Today's Collection</h4>
                            <p>Total payments received</p>
                        </div>
                        <div class="summary-amount">$8,450</div>
                    </div>
                    <div class="summary-item">
                        <div>
                            <h4>This Week</h4>
                            <p>Weekly revenue</p>
                        </div>
                        <div class="summary-amount">$42,350</div>
                    </div>
                    <div class="summary-item">
                        <div>
                            <h4>This Month</h4>
                            <p>Monthly revenue</p>
                        </div>
                        <div class="summary-amount">$248,500</div>
                    </div>
                    <div class="summary-item">
                        <div>
                            <h4>Outstanding</h4>
                            <p>Pending collections</p>
                        </div>
                        <div class="summary-amount" style="color: #f59e0b;">$34,200</div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="content-grid">
            
            <div class="content-card">
                <div class="card-header">
                    <h2><i class="fas fa-hourglass-half"></i> Pending Payments</h2>
                    <a href="#" class="view-all">View All →</a>
                </div>
                <div class="pending-list">
                    <div class="pending-item">
                        <h4>Semester Tuition Fee</h4>
                        <p>Alice Johnson - STU12350</p>
                        <span class="pending-amount">$2,500</span>
                    </div>
                    <div class="pending-item">
                        <h4>Lab Equipment Fee</h4>
                        <p>Robert Smith - STU12351</p>
                        <span class="pending-amount">$200</span>
                    </div>
                    <div class="pending-item">
                        <h4>Library Late Fee</h4>
                        <p>Lisa Anderson - STU12352</p>
                        <span class="pending-amount">$25</span>
                    </div>
                    <div class="pending-item">
                        <h4>Exam Registration</h4>
                        <p>Mark Thompson - STU12353</p>
                        <span class="pending-amount">$150</span>
                    </div>
                    <div class="pending-item">
                        <h4>Sports Fee</h4>
                        <p>Jennifer White - STU12354</p>
                        <span class="pending-amount">$75</span>
                    </div>
                </div>
            </div>

            
            <div class="content-card">
                <div class="card-header">
                    <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
                </div>
                <div class="quick-actions">
                    <button class="quick-action-btn" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                        <i class="fas fa-plus-circle"></i>
                        <span>Add Payment</span>
                    </button>
                    <button class="quick-action-btn" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                        <i class="fas fa-file-invoice"></i>
                        <span>Generate Invoice</span>
                    </button>
                    <button class="quick-action-btn" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                        <i class="fas fa-file-export"></i>
                        <span>Export Report</span>
                    </button>
                    <button class="quick-action-btn" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                        <i class="fas fa-bell"></i>
                        <span>Send Reminder</span>
                    </button>
                </div>
                
                <div class="card-header" style="margin-top: 30px;">
                    <h2><i class="fas fa-chart-bar"></i> Revenue Chart</h2>
                </div>
                <div class="chart-container">
                    <p><i class="fas fa-chart-line" style="font-size: 48px; margin-bottom: 10px;"></i><br>Revenue chart will be displayed here</p>
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
