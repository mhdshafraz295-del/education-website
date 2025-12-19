
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

        /* Enhanced Courses Dropdown in Sidebar */
        .nav-item.has-dropdown {
            position: relative;
        }

        .nav-item.has-dropdown .nav-link {
            position: relative;
        }

        .dropdown-arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
            font-size: 12px;
        }

        .nav-item.has-dropdown.open .dropdown-arrow {
            transform: rotate(180deg);
        }

        .course-badge {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: auto;
            min-width: 20px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(245, 87, 108, 0.3);
        }

        .sidebar.collapsed .course-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            padding: 3px 6px;
        }

        .courses-dropdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin-left: 35px;
            margin-top: 5px;
        }

        .nav-item.has-dropdown.open .courses-dropdown {
            max-height: 500px;
        }

        .sidebar.collapsed .courses-dropdown {
            display: none;
        }

        .course-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.05);
            position: relative;
            overflow: hidden;
        }

        .course-dropdown-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
        }

        .course-dropdown-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .course-dropdown-item:hover::before {
            transform: scaleY(1);
        }

        .course-dropdown-item.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .course-dropdown-item.active::before {
            transform: scaleY(1);
        }

        .course-dropdown-icon {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .course-dropdown-icon.purple {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 0 8px rgba(102, 126, 234, 0.6);
        }

        .course-dropdown-icon.blue {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            box-shadow: 0 0 8px rgba(79, 172, 254, 0.6);
        }

        .course-dropdown-icon.green {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            box-shadow: 0 0 8px rgba(67, 233, 123, 0.6);
        }

        .course-dropdown-icon.orange {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            box-shadow: 0 0 8px rgba(250, 112, 154, 0.6);
        }

        .course-dropdown-icon.red {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
            box-shadow: 0 0 8px rgba(255, 107, 107, 0.6);
        }

        .course-dropdown-icon.teal {
            background: linear-gradient(135deg, #2afadf 0%, #4c83ff 100%);
            box-shadow: 0 0 8px rgba(42, 250, 223, 0.6);
        }

        .course-dropdown-text {
            flex: 1;
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .course-dropdown-progress {
            font-size: 11px;
            opacity: 0.8;
            white-space: nowrap;
        }

        .courses-dropdown-footer {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .view-all-courses {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px 12px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            font-size: 13px;
            font-weight: 600;
        }

        .view-all-courses:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        /* All Courses Modal */
        .all-courses-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 10000;
            animation: fadeIn 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .all-courses-modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .all-courses-modal-content {
            background: #f5f7fa;
            width: 95%;
            max-width: 1400px;
            max-height: 95vh;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4);
            animation: slideUpModal 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex;
            flex-direction: column;
        }

        .all-courses-modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .all-courses-modal-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .all-courses-modal-header h2 {
            color: white;
            font-size: 32px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            z-index: 1;
        }

        .all-courses-modal-header h2 i {
            font-size: 36px;
        }

        .all-courses-modal-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .all-courses-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .all-courses-modal-close i {
            color: white;
            font-size: 20px;
        }

        .all-courses-toolbar {
            background: white;
            padding: 25px 40px;
            border-bottom: 2px solid #e0e6ed;
            display: flex;
            gap: 20px;
            align-items: center;
            flex-wrap: wrap;
        }

        .courses-search-box {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .courses-search-box input {
            width: 100%;
            padding: 12px 45px 12px 45px;
            border: 2px solid #e0e6ed;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .courses-search-box input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .courses-search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
            font-size: 16px;
        }

        .courses-filter-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .filter-label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
        }

        .filter-select {
            padding: 10px 35px 10px 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            font-size: 14px;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%237f8c8d' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
        }

        .filter-select:focus {
            outline: none;
            border-color: #667eea;
        }

        .view-toggle {
            display: flex;
            gap: 5px;
            background: #e0e6ed;
            padding: 4px;
            border-radius: 10px;
        }

        .view-toggle-btn {
            background: transparent;
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #7f8c8d;
        }

        .view-toggle-btn.active {
            background: white;
            color: #667eea;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .view-toggle-btn i {
            font-size: 16px;
        }

        .all-courses-modal-body {
            padding: 40px;
            overflow-y: auto;
            flex: 1;
        }

        .courses-stats-bar {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .courses-stat-item {
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .courses-stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .courses-stat-icon.purple {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .courses-stat-icon.blue {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .courses-stat-icon.green {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .courses-stat-icon.orange {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .courses-stat-info h4 {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 2px 0;
        }

        .courses-stat-info p {
            font-size: 13px;
            color: #7f8c8d;
            margin: 0;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .course-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .course-card-banner {
            height: 180px;
            position: relative;
            overflow: hidden;
        }

        .course-card-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.5) 100%);
            z-index: 1;
        }

        .course-card-category {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(255, 255, 255, 0.95);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: #667eea;
            z-index: 2;
        }

        .course-card-favorite {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .course-card-favorite:hover {
            transform: scale(1.1);
            background: white;
        }

        .course-card-favorite i {
            color: #ff6b6b;
            font-size: 16px;
        }

        .course-card-content {
            padding: 20px;
        }

        .course-card-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 10px 0;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .course-card-instructor {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
        }

        .instructor-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
        }

        .instructor-name {
            font-size: 14px;
            color: #7f8c8d;
        }

        .course-card-meta {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e6ed;
        }

        .course-card-meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
            color: #7f8c8d;
        }

        .course-card-meta-item i {
            color: #667eea;
        }

        .course-card-progress-section {
            margin-bottom: 15px;
        }

        .course-card-progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .course-card-progress-label {
            font-size: 13px;
            color: #7f8c8d;
            font-weight: 600;
        }

        .course-card-progress-percent {
            font-size: 14px;
            font-weight: 700;
            color: #667eea;
        }

        .course-card-progress-bar {
            height: 8px;
            background: #e0e6ed;
            border-radius: 10px;
            overflow: hidden;
        }

        .course-card-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            transition: width 0.5s ease;
        }

        .course-card-footer {
            display: flex;
            gap: 10px;
        }

        .course-card-btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .course-card-btn.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .course-card-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .course-card-btn.secondary {
            background: #f5f7fa;
            color: #667eea;
        }

        .course-card-btn.secondary:hover {
            background: #e0e6ed;
        }

        /* List View Styles */
        .courses-list {
            display: none;
            flex-direction: column;
            gap: 20px;
        }

        .courses-list.active {
            display: flex;
        }

        .courses-grid.active {
            display: grid;
        }

        .course-list-item {
            background: white;
            border-radius: 16px;
            padding: 25px;
            display: flex;
            gap: 25px;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .course-list-item:hover {
            transform: translateX(5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .course-list-thumbnail {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }

        .course-list-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .course-list-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
        }

        .course-list-title {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 5px 0;
        }

        .course-list-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .course-list-progress-section {
            width: 200px;
            flex-shrink: 0;
        }

        /* Course Detail Modal */
        .course-detail-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 11000;
            animation: fadeIn 0.3s ease;
            backdrop-filter: blur(8px);
        }

        .course-detail-modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .course-detail-content {
            background: white;
            width: 95%;
            max-width: 1200px;
            max-height: 90vh;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 90px rgba(0, 0, 0, 0.5);
            animation: slideUpModal 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex;
            flex-direction: column;
        }

        .course-detail-header {
            position: relative;
            padding: 50px 40px;
            color: white;
            overflow: hidden;
        }

        .course-detail-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .course-detail-header-content {
            position: relative;
            z-index: 1;
        }

        .course-detail-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.25);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .course-detail-title {
            font-size: 36px;
            font-weight: 700;
            margin: 0 0 15px 0;
            line-height: 1.2;
        }

        .course-detail-instructor {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .instructor-avatar-large {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
        }

        .instructor-info h4 {
            font-size: 18px;
            margin: 0 0 3px 0;
        }

        .instructor-info p {
            font-size: 14px;
            margin: 0;
            opacity: 0.9;
        }

        .course-detail-meta-bar {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .course-detail-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
        }

        .course-detail-meta-item i {
            font-size: 18px;
        }

        .course-detail-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .course-detail-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .course-detail-close i {
            color: white;
            font-size: 20px;
        }

        .course-detail-body {
            padding: 40px;
            overflow-y: auto;
            flex: 1;
        }

        .course-detail-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            border-bottom: 2px solid #e0e6ed;
            overflow-x: auto;
        }

        .course-tab {
            padding: 12px 24px;
            border: none;
            background: transparent;
            color: #7f8c8d;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .course-tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }

        .course-tab:hover {
            color: #667eea;
        }

        .course-tab-content {
            display: none;
        }

        .course-tab-content.active {
            display: block;
        }

        .course-progress-detail {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            border-radius: 16px;
            color: white;
            margin-bottom: 30px;
        }

        .progress-detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .progress-detail-header h3 {
            font-size: 24px;
            margin: 0;
        }

        .progress-percentage-large {
            font-size: 48px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 15px;
        }

        .progress-bar-large {
            height: 12px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .progress-fill-large {
            height: 100%;
            background: white;
            border-radius: 10px;
            transition: width 0.8s ease;
        }

        .progress-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 15px;
        }

        .progress-stat {
            text-align: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
        }

        .progress-stat-value {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .progress-stat-label {
            font-size: 13px;
            opacity: 0.9;
        }

        .lessons-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .lesson-item {
            background: white;
            border: 2px solid #e0e6ed;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .lesson-item:hover {
            border-color: #667eea;
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .lesson-item.completed {
            background: #f0f9ff;
            border-color: #43e97b;
        }

        .lesson-item.current {
            border-color: #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .lesson-number {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .lesson-item.completed .lesson-number {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .lesson-info {
            flex: 1;
        }

        .lesson-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin: 0 0 5px 0;
        }

        .lesson-meta {
            display: flex;
            gap: 15px;
            font-size: 13px;
            color: #7f8c8d;
        }

        .lesson-status {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        .lesson-status.completed {
            color: #43e97b;
        }

        .lesson-status.current {
            color: #667eea;
        }

        .lesson-status.locked {
            color: #95a5a6;
        }

        .assignments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .assignment-card {
            background: white;
            border: 2px solid #e0e6ed;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .assignment-card:hover {
            border-color: #667eea;
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .assignment-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .assignment-status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .assignment-status-badge.pending {
            background: #fff3cd;
            color: #856404;
        }

        .assignment-status-badge.submitted {
            background: #d1ecf1;
            color: #0c5460;
        }

        .assignment-status-badge.graded {
            background: #d4edda;
            color: #155724;
        }

        .assignment-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin: 0 0 10px 0;
        }

        .assignment-due {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 15px;
        }

        .assignment-actions {
            display: flex;
            gap: 10px;
        }

        .assignment-btn {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .assignment-btn.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .assignment-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .course-action-buttons {
            display: flex;
            gap: 15px;
            padding: 25px 40px;
            background: #f5f7fa;
            border-top: 2px solid #e0e6ed;
        }

        .course-action-btn {
            flex: 1;
            padding: 16px 24px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .course-action-btn.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .course-action-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .course-action-btn.secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .course-action-btn.secondary:hover {
            background: #667eea;
            color: white;
        }

        .course-action-btn i {
            font-size: 18px;
        }

        /* Transcript Modal */
        .transcript-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 11000;
            animation: fadeIn 0.3s ease;
            backdrop-filter: blur(8px);
        }

        .transcript-modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .transcript-content {
            background: white;
            width: 95%;
            max-width: 1100px;
            max-height: 95vh;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 90px rgba(0, 0, 0, 0.5);
            animation: slideUpModal 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex;
            flex-direction: column;
        }

        .transcript-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .transcript-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .transcript-header-content {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .transcript-logo {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .transcript-title {
            font-size: 32px;
            font-weight: 700;
            margin: 0 0 10px 0;
        }

        .transcript-subtitle {
            font-size: 16px;
            opacity: 0.95;
        }

        .transcript-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 2;
        }

        .transcript-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .transcript-close i {
            color: white;
            font-size: 20px;
        }

        .transcript-body {
            padding: 40px;
            overflow-y: auto;
            flex: 1;
            background: #f5f7fa;
        }

        .transcript-info-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .transcript-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
        }

        .transcript-info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .transcript-info-label {
            font-size: 13px;
            color: #7f8c8d;
            font-weight: 600;
            text-transform: uppercase;
        }

        .transcript-info-value {
            font-size: 16px;
            color: #2c3e50;
            font-weight: 600;
        }

        .transcript-semester {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .semester-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e0e6ed;
        }

        .semester-title {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .semester-gpa {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .semester-gpa-item {
            text-align: center;
        }

        .semester-gpa-label {
            font-size: 12px;
            color: #7f8c8d;
            margin-bottom: 3px;
        }

        .semester-gpa-value {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
        }

        .transcript-table {
            width: 100%;
            border-collapse: collapse;
        }

        .transcript-table thead th {
            background: #f5f7fa;
            padding: 12px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #7f8c8d;
            text-transform: uppercase;
            border-bottom: 2px solid #e0e6ed;
        }

        .transcript-table tbody td {
            padding: 15px 12px;
            border-bottom: 1px solid #e0e6ed;
            color: #2c3e50;
        }

        .transcript-table tbody tr:hover {
            background: #f8f9fa;
        }

        .course-code {
            font-weight: 600;
            color: #667eea;
        }

        .grade-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            text-align: center;
            min-width: 45px;
        }

        .grade-badge.a, .grade-badge.a-plus {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .grade-badge.b, .grade-badge.b-plus {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .grade-badge.c, .grade-badge.c-plus {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }

        .grade-badge.d {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
            color: white;
        }

        .transcript-summary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 30px;
            color: white;
            margin-top: 30px;
        }

        .summary-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }

        .summary-item {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .summary-value {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .summary-label {
            font-size: 14px;
            opacity: 0.9;
        }

        .transcript-footer {
            display: flex;
            gap: 15px;
            padding: 25px 40px;
            background: white;
            border-top: 2px solid #e0e6ed;
        }

        .transcript-btn {
            flex: 1;
            padding: 16px 24px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .transcript-btn.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .transcript-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .transcript-btn.secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .transcript-btn.secondary:hover {
            background: #f5f7fa;
        }

        .transcript-btn i {
            font-size: 18px;
        }

        /* Print Styles */
        @media print {
            body * {
                visibility: hidden;
            }
            
            .transcript-modal,
            .transcript-modal * {
                visibility: visible;
            }
            
            .transcript-modal {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: auto;
                background: white;
            }
            
            .transcript-content {
                box-shadow: none;
                max-height: none;
                border-radius: 0;
            }
            
            .transcript-close,
            .transcript-footer {
                display: none !important;
            }
            
            .transcript-body {
                padding: 20px;
                overflow: visible;
            }
            
            .transcript-semester {
                page-break-inside: avoid;
            }
        }

        /* Enhanced Button Animations */
        .course-card-btn {
            position: relative;
            overflow: hidden;
        }

        .course-card-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .course-card-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .course-card-btn span,
        .course-card-btn i {
            position: relative;
            z-index: 1;
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

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
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

        /* Mobile Menu Button */
        .mobile-menu-btn {
            display: none;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 20px;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .mobile-menu-btn:active {
            transform: scale(0.95);
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

        .notification-wrapper {
            position: relative;
        }

        .notification-btn {
            position: relative;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .notification-btn:active {
            transform: scale(0.95);
        }

        .notification-btn i {
            font-size: 20px;
            color: white;
            animation: bellShake 2s ease-in-out infinite;
        }

        @keyframes bellShake {
            0%, 50%, 100% { transform: rotate(0deg); }
            10%, 30% { transform: rotate(-10deg); }
            20%, 40% { transform: rotate(10deg); }
        }

        .notification-btn:hover i {
            animation: none;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            font-size: 11px;
            min-width: 22px;
            height: 22px;
            border-radius: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid white;
            box-shadow: 0 2px 8px rgba(245, 87, 108, 0.4);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @keyframes modalSlideUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(30px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .notification-dropdown {
            position: absolute;
            top: 65px;
            right: 0;
            width: 380px;
            max-height: 500px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: 1000;
            overflow: hidden;
        }

        .notification-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .notification-header {
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
        }

        .mark-all-read {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mark-all-read:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .notification-list {
            max-height: 380px;
            overflow-y: auto;
        }

        .notification-item {
            padding: 16px 20px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            gap: 12px;
            position: relative;
        }

        .notification-item:hover {
            background: #f8f9fa;
        }

        .notification-item.unread {
            background: #f0f4ff;
        }

        .notification-item.unread::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 18px;
        }

        .notification-icon.info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .notification-icon.success {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .notification-icon.warning {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }

        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-weight: 600;
            color: #2c3e50;
            margin: 0 0 4px 0;
            font-size: 14px;
        }

        .notification-text {
            color: #7f8c8d;
            font-size: 13px;
            margin: 0 0 4px 0;
        }

        .notification-time {
            color: #95a5a6;
            font-size: 11px;
        }

        .notification-footer {
            padding: 15px;
            text-align: center;
            border-top: 1px solid #f0f0f0;
        }

        .view-all-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .view-all-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .empty-notifications {
            padding: 60px 20px;
            text-align: center;
            color: #95a5a6;
        }

        .empty-notifications i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        /* All Notifications Modal */
        .notifications-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 10000;
            animation: fadeIn 0.3s ease;
        }

        .notifications-modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .notifications-modal-content {
            background: white;
            width: 90%;
            max-width: 900px;
            max-height: 90vh;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUpModal 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        @keyframes slideUpModal {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .notifications-modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 25px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notifications-modal-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .notifications-modal-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .notifications-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .notifications-modal-toolbar {
            padding: 20px 30px;
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .notification-search {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .notification-search input {
            width: 100%;
            padding: 12px 40px 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .notification-search input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .notification-search i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #95a5a6;
        }

        .notification-filters {
            display: flex;
            gap: 10px;
        }

        .filter-btn {
            padding: 10px 20px;
            border: 2px solid #e9ecef;
            background: white;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            color: #7f8c8d;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            border-color: #667eea;
            color: #667eea;
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }

        .notifications-modal-body {
            flex: 1;
            overflow-y: auto;
            padding: 20px 30px;
        }

        .notification-full-item {
            background: white;
            border: 2px solid #f0f0f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .notification-full-item:hover {
            border-color: #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .notification-full-item.unread {
            background: linear-gradient(to right, #f0f4ff 0%, white 100%);
            border-color: #667eea;
        }

        .notification-full-header {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 12px;
        }

        .notification-full-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .notification-full-content {
            flex: 1;
        }

        .notification-full-title {
            font-size: 16px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 8px 0;
        }

        .notification-full-text {
            color: #7f8c8d;
            font-size: 14px;
            line-height: 1.6;
            margin: 0 0 10px 0;
        }

        .notification-full-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 12px;
            color: #95a5a6;
        }

        .notification-full-meta i {
            margin-right: 5px;
        }

        .notification-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }

        .notification-action-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .notification-action-btn.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .notification-action-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .notification-action-btn.secondary {
            background: #f8f9fa;
            color: #7f8c8d;
        }

        .notification-action-btn.secondary:hover {
            background: #e9ecef;
        }

        /* Detail View Modals */
        .detail-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 10001;
        }

        .detail-modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .detail-modal-content {
            background: white;
            width: 90%;
            max-width: 800px;
            max-height: 85vh;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            animation: slideUpModal 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .detail-modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 25px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .detail-modal-header h3 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .detail-modal-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .detail-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .detail-modal-body {
            flex: 1;
            overflow-y: auto;
            padding: 30px;
        }

        .detail-section {
            margin-bottom: 25px;
        }

        .detail-section h4 {
            color: #2c3e50;
            font-size: 16px;
            margin: 0 0 12px 0;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-info-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }

        .detail-info-label {
            font-size: 12px;
            color: #7f8c8d;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .detail-info-value {
            font-size: 15px;
            color: #2c3e50;
            font-weight: 600;
        }

        .detail-description {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #e9ecef;
            line-height: 1.6;
            color: #2c3e50;
        }

        .detail-file-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .detail-file-item {
            background: white;
            border: 2px solid #e9ecef;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
        }

        .detail-file-item:hover {
            border-color: #667eea;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
        }

        .detail-file-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .detail-file-info {
            flex: 1;
        }

        .detail-file-name {
            font-weight: 600;
            color: #2c3e50;
            margin: 0 0 4px 0;
        }

        .detail-file-meta {
            font-size: 12px;
            color: #7f8c8d;
        }

        .detail-file-download {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .detail-file-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .detail-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
        }

        .detail-status-badge.success {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .detail-status-badge.warning {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }

        .detail-status-badge.info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .detail-modal-footer {
            padding: 20px 30px;
            background: #f8f9fa;
            border-top: 2px solid #e9ecef;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .detail-modal-btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .detail-modal-btn.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .detail-modal-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .detail-modal-btn.secondary {
            background: white;
            color: #7f8c8d;
            border: 2px solid #e9ecef;
        }

        .detail-modal-btn.secondary:hover {
            background: #f8f9fa;
            border-color: #667eea;
            color: #667eea;
        }

        .grade-display {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 20px;
        }

        .grade-display h2 {
            margin: 0;
            font-size: 48px;
            font-weight: 700;
        }

        .grade-display p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }

        /* All Notifications Modal */
        .notifications-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 10000;
            animation: fadeIn 0.3s ease;
        }

        .notifications-modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .notifications-modal-content {
            background: white;
            width: 90%;
            max-width: 900px;
            max-height: 90vh;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .notifications-modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 25px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notifications-modal-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .notifications-modal-close {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .notifications-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .notifications-modal-toolbar {
            padding: 20px 30px;
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .notification-search {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .notification-search input {
            width: 100%;
            padding: 12px 40px 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .notification-search input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .notification-search i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #95a5a6;
        }

        .notification-filters {
            display: flex;
            gap: 10px;
        }

        .filter-btn {
            padding: 10px 20px;
            border: 2px solid #e9ecef;
            background: white;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            color: #7f8c8d;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            border-color: #667eea;
            color: #667eea;
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }

        .notifications-modal-body {
            flex: 1;
            overflow-y: auto;
            padding: 20px 30px;
        }

        .notification-full-item {
            background: white;
            border: 2px solid #f0f0f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .notification-full-item:hover {
            border-color: #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .notification-full-item.unread {
            background: linear-gradient(to right, #f0f4ff 0%, white 100%);
            border-color: #667eea;
        }

        .notification-full-header {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 12px;
        }

        .notification-full-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .notification-full-content {
            flex: 1;
        }

        .notification-full-title {
            font-size: 16px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 8px 0;
        }

        .notification-full-text {
            color: #7f8c8d;
            font-size: 14px;
            line-height: 1.6;
            margin: 0 0 10px 0;
        }

        .notification-full-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 12px;
            color: #95a5a6;
        }

        .notification-full-meta i {
            margin-right: 5px;
        }

        .notification-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #f0f0f0;
        }

        .notification-action-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .notification-action-btn.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .notification-action-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .notification-action-btn.secondary {
            background: #f8f9fa;
            color: #7f8c8d;
        }

        .notification-action-btn.secondary:hover {
            background: #e9ecef;
        }

        .no-notifications {
            text-align: center;
            padding: 60px 20px;
            color: #95a5a6;
        }

        .no-notifications i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .no-notifications h3 {
            margin: 0 0 10px 0;
            color: #7f8c8d;
        }

        .user-profile-wrapper {
            position: relative;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 10px 16px;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
        }

        .user-profile:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .user-profile.active {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 100%);
            border-color: #667eea;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
            border: 3px solid white;
            position: relative;
        }

        .user-avatar::after {
            content: '';
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 12px;
            height: 12px;
            background: #43e97b;
            border: 2px solid white;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.6;
            }
        }

        .user-profile-wrapper {
            position: relative;
        }

        .user-profile {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-profile:hover {
            background: rgba(102, 126, 234, 0.05);
            border-radius: 12px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .user-info h4 {
            font-size: 15px;
            color: #2c3e50;
            margin-bottom: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .user-info h4 .fa-circle-check {
            animation: verifiedBounce 3s ease-in-out infinite;
        }

        @keyframes verifiedBounce {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
        }

        .user-info p {
            font-size: 12px;
            color: #7f8c8d;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .user-info p i {
            font-size: 10px;
            color: #95a5a6;
        }

        .dropdown-arrow {
            margin-left: 8px;
            transition: transform 0.3s ease;
            color: #7f8c8d;
        }

        .user-profile.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        .profile-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2), 
                        0 0 0 1px rgba(255, 255, 255, 0.5);
            padding: 16px;
            min-width: 360px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow: hidden;
        }

        .profile-dropdown::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #667eea 100%);
            background-size: 200% auto;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% {
                background-position: 0% 0%;
            }
            50% {
                background-position: 100% 0%;
            }
        }

        .profile-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-dropdown-header {
            padding: 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-size: 200% auto;
            border-radius: 16px;
            margin-bottom: 16px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
            animation: headerGradient 6s ease infinite;
        }

        @keyframes headerGradient {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }

        .profile-dropdown-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .profile-dropdown-header > * {
            position: relative;
            z-index: 1;
        }

        .profile-completion {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid rgba(255,255,255,0.2);
        }

        .profile-completion-text {
            font-size: 11px;
            opacity: 0.9;
            margin-bottom: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-completion-bar {
            height: 6px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .profile-completion-fill {
            height: 100%;
            background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
            border-radius: 10px;
            width: 85%;
            transition: width 0.6s ease;
            box-shadow: 0 0 10px rgba(67, 233, 123, 0.5);
        }

        .profile-dropdown-header .dropdown-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            color: #667eea;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: 700;
            margin: 0 auto 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15),
                        0 0 0 4px rgba(255,255,255,0.3);
            transition: all 0.3s ease;
            position: relative;
        }

        .profile-dropdown-header .dropdown-avatar::after {
            content: '';
            position: absolute;
            bottom: 3px;
            right: 3px;
            width: 18px;
            height: 18px;
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            border: 3px solid white;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .profile-dropdown:hover .dropdown-avatar {
            transform: scale(1.05) rotate(5deg);
        }

        .profile-dropdown-header h3 {
            font-size: 18px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .profile-dropdown-header p {
            font-size: 13px;
            opacity: 0.9;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 16px;
        }

        .profile-stat {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 16px 12px;
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(102, 126, 234, 0.1);
            position: relative;
            overflow: hidden;
        }

        .profile-stat::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .profile-stat:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.2);
            border-color: #667eea;
        }

        .profile-stat:hover::before {
            opacity: 1;
        }

        .profile-stat-value {
            font-size: 20px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 4px;
        }

        .profile-stat-label {
            font-size: 11px;
            color: #7f8c8d;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .profile-menu {
            list-style: none;
        }

        .profile-menu-item {
            margin-bottom: 4px;
        }

        .profile-menu-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            color: #2c3e50;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 14px;
            position: relative;
            overflow: hidden;
        }

        .profile-menu-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            transform: translateX(-3px);
            transition: transform 0.3s ease;
        }

        .profile-menu-link:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.12) 0%, rgba(118, 75, 162, 0.12) 100%);
            color: #667eea;
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
        }

        .profile-menu-link:hover::before {
            transform: translateX(0);
        }

        .profile-menu-link i {
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .profile-menu-link:hover i {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: rotate(5deg) scale(1.1);
        }

        .profile-menu-badge {
            margin-left: auto;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(255, 107, 107, 0.3);
        }

        .profile-menu-divider {
            height: 1px;
            background: #e0e0e0;
            margin: 8px 0;
        }

        .profile-menu-link.logout {
            color: #e74c3c;
        }

        .profile-menu-link.logout::before {
            background: linear-gradient(180deg, #e74c3c 0%, #c0392b 100%);
        }

        .profile-menu-link.logout i {
            background: rgba(231, 76, 60, 0.1);
        }

        .profile-menu-link.logout:hover {
            background: linear-gradient(135deg, rgba(231, 76, 60, 0.12) 0%, rgba(192, 57, 43, 0.12) 100%);
            color: #c0392b;
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.2);
        }

        .profile-menu-link.logout:hover i {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
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
            grid-template-columns: 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        @media (min-width: 1200px) {
            .content-grid {
                grid-template-columns: 2fr 1fr;
            }
        }

        .content-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: visible;
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
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .course-item {
            display: flex;
            flex-direction: column;
            gap: 16px;
            padding: 24px;
            background: white;
            border: 1px solid #e0e6ed;
            border-radius: 16px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .course-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .course-item:hover {
            transform: translateY(-8px);
            border-color: transparent;
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.2),
                        0 0 0 1px rgba(102, 126, 234, 0.1);
            z-index: 10;
        }

        .course-item:hover::before {
            transform: scaleX(1);
        }

        .course-item-header {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .course-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: relative;
        }

        .course-icon::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 18px;
            background: inherit;
            opacity: 0.3;
            filter: blur(10px);
            z-index: -1;
            transition: opacity 0.3s ease;
        }

        .course-item:hover .course-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .course-item:hover .course-icon::after {
            opacity: 0.5;
        }

        .course-info {
            flex: 1;
            min-width: 0;
        }

        .course-info h4 {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
            line-height: 1.3;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .course-status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .course-status-badge.active {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(67, 233, 123, 0.3);
        }

        .course-status-badge.completed {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .course-info p {
            font-size: 14px;
            color: #7f8c8d;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .course-info p i {
            font-size: 12px;
            color: #95a5a6;
        }

        .course-progress {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
            border-radius: 12px;
            margin-top: 12px;
        }

        .progress-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .progress-label {
            font-size: 12px;
            color: #7f8c8d;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .progress-percent {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .progress-bar-wrapper {
            position: relative;
            flex: 1;
            margin-left: 20px;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 10px;
            overflow: visible;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
            transition: width 0.6s ease;
            position: relative;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.4);
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            right: -4px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            background: white;
            border: 3px solid #667eea;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        }

        .course-item:hover .progress-fill {
            background: linear-gradient(90deg, #764ba2 0%, #667eea 100%);
        }

        .course-meta {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-top: 12px;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            margin-top: 12px;
        }

        .course-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #7f8c8d;
        }

        .course-meta-item i {
            font-size: 14px;
            color: #667eea;
        }

        .course-actions {
            display: flex;
            gap: 8px;
            margin-top: 16px;
        }

        .course-action-btn {
            flex: 1;
            padding: 10px 16px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .course-action-btn.primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .course-action-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .course-action-btn.secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .course-action-btn.secondary:hover {
            background: #667eea;
            color: white;
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

        /* ============================================
           RESPONSIVE DESIGN - MEDIA QUERIES
           ============================================ */

        /* Large Tablets and Small Laptops (1024px and below) */
        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            /* Student Profile Section */
            .student-profile-grid {
                grid-template-columns: 1fr !important;
            }

            /* Notification Dropdown */
            .notification-dropdown {
                width: 350px;
                right: -20px;
            }

            .profile-dropdown {
                min-width: 300px;
                right: -10px;
            }
        }

        /* Tablets (768px and below) */
        @media (max-width: 768px) {
            /* Sidebar */
            .sidebar {
                transform: translateX(-100%);
                z-index: 9999;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            /* Main Content */
            .main-content {
                margin-left: 0;
                padding: 20px 15px;
            }

            .main-content.expanded {
                margin-left: 0;
            }

            /* Header */
            .header {
                flex-direction: column;
                gap: 15px;
                padding: 20px;
            }

            .header-left {
                width: 100%;
            }

            .mobile-menu-btn {
                display: flex;
            }

            .header-left h1 {
                font-size: 22px;
            }

            .header-left p {
                font-size: 13px;
            }

            .header-right {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 12px;
            }

            .search-box {
                order: -1;
                width: 100%;
            }

            .search-box input {
                width: 100%;
                font-size: 14px;
            }

            /* Courses */
            .course-list {
                grid-template-columns: 1fr;
            }

            .course-item {
                padding: 20px;
            }

            .course-item-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .course-icon {
                width: 56px;
                height: 56px;
                font-size: 24px;
            }

            .course-progress {
                flex-direction: column;
                gap: 12px;
            }

            .progress-bar-wrapper {
                margin-left: 0;
                width: 100%;
            }

            .course-actions {
                flex-direction: column;
            }

            .course-action-btn {
                width: 100%;
            }

            /* Stats Grid */
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            /* Student Profile Section - Mobile */
            div[style*="grid-template-columns: 280px 1fr"] {
                display: block !important;
            }

            div[style*="grid-template-columns: 280px 1fr"] > * {
                margin-bottom: 20px;
            }

            /* Student Info Cards */
            div[style*="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr))"] {
                grid-template-columns: 1fr !important;
            }

            div[style*="grid-template-columns: repeat(2, 1fr)"] {
                grid-template-columns: 1fr !important;
            }

            div[style*="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr))"] {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            /* User Profile */
            .user-profile {
                padding: 8px 12px;
                gap: 8px;
            }

            .user-avatar {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .user-info h4 {
                font-size: 13px;
            }

            .user-info p {
                font-size: 11px;
            }

            /* Dropdowns */
            .notification-dropdown {
                position: fixed;
                top: auto;
                right: 10px;
                left: 10px;
                width: auto;
                max-height: 70vh;
                overflow-y: auto;
            }

            .profile-dropdown {
                position: fixed;
                top: auto;
                right: 10px;
                left: 10px;
                width: auto;
                min-width: auto;
                max-height: 80vh;
                overflow-y: auto;
            }

            .profile-stats {
                grid-template-columns: repeat(3, 1fr);
                gap: 6px;
            }

            .profile-stat {
                padding: 10px 8px;
            }

            .profile-stat-value {
                font-size: 16px;
            }

            .profile-stat-label {
                font-size: 10px;
            }

            /* Content Cards */
            .content-card {
                padding: 20px;
            }

            .card-header h2 {
                font-size: 18px;
            }

            /* Tables */
            .assignments-table,
            .courses-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .assignments-table th,
            .assignments-table td,
            .courses-table th,
            .courses-table td {
                padding: 10px;
                font-size: 13px;
            }

            /* Modals */
            .modal-content {
                width: 95%;
                max-width: 95%;
                margin: 20px auto;
                max-height: 90vh;
                overflow-y: auto;
            }

            .modal-header h2 {
                font-size: 20px;
            }

            /* Notification Items */
            .notification-item {
                padding: 12px;
            }

            .notification-icon {
                width: 40px;
                height: 40px;
            }

            .notification-title {
                font-size: 13px;
            }

            .notification-text {
                font-size: 12px;
            }

            /* Edit Submission Modal */
            .file-upload-area {
                padding: 30px;
            }

            .upload-icon {
                font-size: 40px;
            }

            /* Calendar Buttons */
            .calendar-buttons {
                flex-wrap: wrap;
            }

            .calendar-btn {
                flex: 1 1 calc(50% - 5px);
                min-width: auto;
            }

            /* Action Buttons */
            .action-buttons {
                flex-wrap: wrap;
                gap: 8px;
            }

            .action-btn {
                flex: 1;
                min-width: calc(50% - 4px);
                padding: 10px 16px;
                font-size: 13px;
            }

            /* Filters */
            .filter-buttons {
                flex-wrap: wrap;
                gap: 8px;
            }

            .filter-btn {
                padding: 8px 16px;
                font-size: 13px;
            }
        }

        /* Mobile Phones (480px and below) */
        @media (max-width: 480px) {
            /* Header */
            .header-left h1 {
                font-size: 20px;
            }

            .header-left p {
                font-size: 12px;
            }

            /* Stats Cards */
            .stat-card {
                padding: 20px;
            }

            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }

            .stat-content h3 {
                font-size: 28px;
            }

            .stat-content p {
                font-size: 13px;
            }

            /* Student Profile Section */
            div[style*="padding: 35px"] {
                padding: 20px !important;
            }

            div[style*="font-size: 24px"] h2 {
                font-size: 20px !important;
            }

            /* Profile Avatar */
            div[style*="width: 120px; height: 120px"] {
                width: 100px !important;
                height: 100px !important;
                font-size: 40px !important;
            }

            /* User Profile Dropdown */
            .user-info h4 {
                font-size: 12px;
            }

            .user-info p {
                display: none; 
            }

            .dropdown-arrow {
                display: none;
            }

            /* Profile Menu */
            .profile-menu-link {
                padding: 10px 14px;
                font-size: 13px;
            }

            /* Modal */
            .modal-content {
                width: 100%;
                height: 100vh;
                max-height: 100vh;
                margin: 0;
                border-radius: 0;
            }

            .modal-header {
                padding: 15px 20px;
            }

            .modal-body {
                padding: 15px;
            }

            .modal-footer {
                padding: 15px 20px;
            }

            /* Notification Modal */
            .notifications-header {
                padding: 15px;
            }

            .notifications-header h2 {
                font-size: 18px;
            }

            .search-filter-bar {
                flex-direction: column;
                gap: 10px;
            }

            .search-bar {
                width: 100%;
            }

            .filter-buttons {
                width: 100%;
                justify-content: flex-start;
            }

            /* Tables - Stack on very small screens */
            .assignments-table thead {
                display: none;
            }

            .assignments-table tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                padding: 15px;
            }

            .assignments-table td {
                display: block;
                text-align: left !important;
                padding: 8px 0;
                border: none;
            }

            .assignments-table td:before {
                content: attr(data-label);
                font-weight: 600;
                display: inline-block;
                width: 120px;
                color: #7f8c8d;
            }

            /* Action Buttons - Full Width */
            .action-btn {
                width: 100%;
                flex: none;
            }

            .calendar-btn {
                width: 100%;
                flex: none;
            }

            /* Quick Actions */
            div[style*="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr))"] button {
                font-size: 13px !important;
                padding: 12px !important;
            }

            /* File Upload */
            .file-upload-area {
                padding: 20px;
            }

            .upload-icon {
                font-size: 32px;
            }

            .upload-text {
                font-size: 14px;
            }

            /* Sidebar Navigation */
            .nav-link {
                padding: 10px 12px;
                font-size: 14px;
            }

            .nav-link i {
                font-size: 18px;
            }

            /* Content Cards */
            .content-card {
                padding: 15px;
                border-radius: 12px;
            }

            .card-header {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }

            .view-all {
                align-self: flex-end;
            }

            /* All Courses Modal Responsive */
            .all-courses-modal-content {
                width: 100%;
                max-height: 100vh;
                border-radius: 0;
            }

            .all-courses-modal-header {
                padding: 20px;
            }

            .all-courses-modal-header h2 {
                font-size: 24px;
            }

            .all-courses-toolbar {
                padding: 15px 20px;
                flex-direction: column;
            }

            .courses-search-box {
                width: 100%;
            }

            .courses-filter-group {
                width: 100%;
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-select {
                width: 100%;
            }

            .view-toggle {
                width: 100%;
                justify-content: center;
            }

            .all-courses-modal-body {
                padding: 20px;
            }

            .courses-stats-bar {
                grid-template-columns: repeat(2, 1fr);
            }

            .courses-grid {
                grid-template-columns: 1fr;
            }

            .course-card-banner {
                height: 150px;
            }

            .course-list-item {
                flex-direction: column;
                padding: 20px;
            }

            .course-list-thumbnail {
                width: 100%;
                height: 150px;
            }

            .course-list-progress-section {
                width: 100%;
            }
        }

        /* Extra Small Devices (360px and below) */
        @media (max-width: 360px) {
            .header-left h1 {
                font-size: 18px;
            }

            .stat-content h3 {
                font-size: 24px;
            }

            .profile-stats {
                grid-template-columns: 1fr;
            }

            .notification-wrapper,
            .user-profile-wrapper {
                position: static;
            }

            .profile-dropdown,
            .notification-dropdown {
                position: fixed;
                top: 60px;
                left: 5px;
                right: 5px;
                width: auto;
            }
        }

        /* Landscape Orientation for Mobile */
        @media (max-height: 600px) and (orientation: landscape) {
            .sidebar {
                overflow-y: auto;
            }

            .modal-content {
                max-height: 95vh;
                overflow-y: auto;
            }

            .profile-dropdown,
            .notification-dropdown {
                max-height: 85vh;
            }
        }

        /* Touch Device Optimizations */
        @media (hover: none) and (pointer: coarse) {
            .nav-link,
            .action-btn,
            .filter-btn,
            .profile-menu-link,
            .calendar-btn {
                min-height: 44px; /* Apple's recommended touch target size */
            }

            .user-profile {
                min-height: 48px;
            }

            .notification-btn {
                min-width: 44px;
                min-height: 44px;
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
                <li class="nav-item has-dropdown" id="coursesNavItem">
                    <a href="#" class="nav-link" onclick="toggleCoursesDropdown(event)">
                        <i class="fas fa-book"></i>
                        <span class="nav-text">My Courses</span>
                        <span class="course-badge">6</span>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </a>
                    <div class="courses-dropdown">
                        <a href="#" class="course-dropdown-item active">
                            <span class="course-dropdown-icon purple"></span>
                            <span class="course-dropdown-text">Web Development</span>
                            <span class="course-dropdown-progress">75%</span>
                        </a>
                        <a href="#" class="course-dropdown-item">
                            <span class="course-dropdown-icon blue"></span>
                            <span class="course-dropdown-text">Database Systems</span>
                            <span class="course-dropdown-progress">60%</span>
                        </a>
                        <a href="#" class="course-dropdown-item">
                            <span class="course-dropdown-icon green"></span>
                            <span class="course-dropdown-text">Data Structures</span>
                            <span class="course-dropdown-progress">90%</span>
                        </a>
                        <a href="#" class="course-dropdown-item">
                            <span class="course-dropdown-icon orange"></span>
                            <span class="course-dropdown-text">Machine Learning</span>
                            <span class="course-dropdown-progress">45%</span>
                        </a>
                        <a href="#" class="course-dropdown-item">
                            <span class="course-dropdown-icon red"></span>
                            <span class="course-dropdown-text">Mobile App Dev</span>
                            <span class="course-dropdown-progress">30%</span>
                        </a>
                        <a href="#" class="course-dropdown-item">
                            <span class="course-dropdown-icon teal"></span>
                            <span class="course-dropdown-text">Cloud Computing</span>
                            <span class="course-dropdown-progress">55%</span>
                        </a>
                        <div class="courses-dropdown-footer">
                            <a href="#" class="view-all-courses" onclick="event.preventDefault(); openAllCoursesModal();">
                                <i class="fas fa-th-large"></i>
                                <span>View All Courses</span>
                            </a>
                        </div>
                    </div>
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
                <button class="mobile-menu-btn" onclick="toggleSidebar()" title="Toggle Menu">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Student'); ?>! 👋</h1>
                    <p>Here's what's happening with your courses today</p>
                </div>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <input type="text" placeholder="Search courses, assignments...">
                    <i class="fas fa-search"></i>
                </div>
                <div class="notification-wrapper">
                    <button class="notification-btn" onclick="toggleNotifications()">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge" id="notificationCount">5</span>
                    </button>
                    <div class="notification-dropdown" id="notificationDropdown">
                        <div class="notification-header">
                            <h3>Notifications</h3>
                            <button class="mark-all-read" onclick="markAllAsRead()">Mark all read</button>
                        </div>
                        <div class="notification-list">
                            <div class="notification-item unread" onclick="markAsRead(this)">
                                <div class="notification-icon success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-title">Assignment Submitted</p>
                                    <p class="notification-text">Your Web Development assignment has been submitted successfully.</p>
                                    <span class="notification-time">5 minutes ago</span>
                                </div>
                            </div>
                            <div class="notification-item unread" onclick="markAsRead(this)">
                                <div class="notification-icon info">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-title">New Course Material</p>
                                    <p class="notification-text">Dr. Smith added new lecture notes in Database Management.</p>
                                    <span class="notification-time">1 hour ago</span>
                                </div>
                            </div>
                            <div class="notification-item unread" onclick="markAsRead(this)">
                                <div class="notification-icon warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-title">Exam Reminder</p>
                                    <p class="notification-text">Your Mathematics exam is scheduled for tomorrow at 10:00 AM.</p>
                                    <span class="notification-time">2 hours ago</span>
                                </div>
                            </div>
                            <div class="notification-item" onclick="markAsRead(this)">
                                <div class="notification-icon info">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-title">Grade Posted</p>
                                    <p class="notification-text">Your grade for Computer Science midterm is now available.</p>
                                    <span class="notification-time">1 day ago</span>
                                </div>
                            </div>
                            <div class="notification-item" onclick="markAsRead(this)">
                                <div class="notification-icon success">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="notification-title">Attendance Marked</p>
                                    <p class="notification-text">Your attendance has been marked for today's Physics lecture.</p>
                                    <span class="notification-time">2 days ago</span>
                                </div>
                            </div>
                        </div>
                        <div class="notification-footer">
                            <button class="view-all-btn" onclick="viewAllNotifications()">View All Notifications</button>
                        </div>
                    </div>
                </div>
                <div class="user-profile-wrapper">
                    <div class="user-profile" onclick="toggleProfileDropdown()">
                        <div class="user-avatar">
                            <?php echo strtoupper(substr($_SESSION['username'] ?? 'S', 0, 1)); ?>
                        </div>
                        <div class="user-info">
                            <h4>
                                <?php echo htmlspecialchars($_SESSION['username'] ?? 'Student'); ?>
                                <i class="fas fa-circle-check" style="font-size: 12px; color: #667eea;" title="Verified Student"></i>
                            </h4>
                            <p>
                                <i class="fas fa-id-badge"></i>
                                <?php echo htmlspecialchars($_SESSION['student_id'] ?? 'STU001'); ?>
                            </p>
                        </div>
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </div>
                    <div class="profile-dropdown" id="profileDropdown">
                        <div class="profile-dropdown-header">
                            <div class="dropdown-avatar">
                                <?php echo strtoupper(substr($_SESSION['username'] ?? 'S', 0, 1)); ?>
                            </div>
                            <h3><?php echo htmlspecialchars($_SESSION['username'] ?? 'Student Name'); ?></h3>
                            <p><?php echo htmlspecialchars($_SESSION['email'] ?? 'student@university.edu'); ?></p>
                            <div class="profile-completion">
                                <div class="profile-completion-text">
                                    <span>Profile Completion</span>
                                    <span style="font-weight: 600;">85%</span>
                                </div>
                                <div class="profile-completion-bar">
                                    <div class="profile-completion-fill"></div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-stats">
                            <div class="profile-stat">
                                <div class="profile-stat-value">3.8</div>
                                <div class="profile-stat-label">GPA</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-value">128</div>
                                <div class="profile-stat-label">Credits</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-value">92%</div>
                                <div class="profile-stat-label">Attendance</div>
                            </div>
                        </div>
                        <ul class="profile-menu">
                            <li class="profile-menu-item">
                                <a href="#" class="profile-menu-link">
                                    <i class="fas fa-user"></i>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li class="profile-menu-item">
                                <a href="#" class="profile-menu-link">
                                    <i class="fas fa-cog"></i>
                                    <span>Account Settings</span>
                                </a>
                            </li>
                            <li class="profile-menu-item">
                                <a href="#" class="profile-menu-link" onclick="event.preventDefault(); openTranscript();">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Academic Records</span>
                                </a>
                            </li>
                            <li class="profile-menu-item">
                                <a href="#" class="profile-menu-link">
                                    <i class="fas fa-credit-card"></i>
                                    <span>Payment History</span>
                                    <span class="profile-menu-badge">2 Due</span>
                                </a>
                            </li>
                            <li class="profile-menu-item">
                                <a href="#" class="profile-menu-link">
                                    <i class="fas fa-bell"></i>
                                    <span>Notification Settings</span>
                                </a>
                            </li>
                            <div class="profile-menu-divider"></div>
                            <li class="profile-menu-item">
                                <a href="#" class="profile-menu-link">
                                    <i class="fas fa-question-circle"></i>
                                    <span>Help & Support</span>
                                </a>
                            </li>
                            <li class="profile-menu-item">
                                <a href="#" class="profile-menu-link">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Privacy & Security</span>
                                </a>
                            </li>
                            <div class="profile-menu-divider"></div>
                            <li class="profile-menu-item">
                                <a href="../../public/index.php" class="profile-menu-link logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Student Profile Section -->
        <div style="background: white; border-radius: 20px; padding: 35px; margin-bottom: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px;">
                <h2 style="font-size: 24px; font-weight: 700; color: #2c3e50; display: flex; align-items: center; gap: 12px;">
                    <i class="fas fa-user-graduate" style="color: #667eea;"></i> Student Profile & Overview
                </h2>
                <button style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 600; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(102,126,234,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <i class="fas fa-edit"></i> Edit Profile
                </button>
            </div>

            <div style="display: grid; grid-template-columns: 280px 1fr; gap: 30px;">
                <!-- Left: Student Info Card -->
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 16px; padding: 30px; text-align: center; color: white; box-shadow: 0 8px 24px rgba(102,126,234,0.3);">
                    <div style="width: 120px; height: 120px; border-radius: 50%; background: white; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; font-size: 48px; font-weight: 700; color: #667eea; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <?php echo strtoupper(substr($_SESSION['username'] ?? 'S', 0, 1)); ?>
                    </div>
                    <h3 style="font-size: 22px; margin-bottom: 8px;"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Student Name'); ?></h3>
                    <p style="opacity: 0.9; margin-bottom: 5px; font-size: 14px;">Student ID: <?php echo htmlspecialchars($_SESSION['student_id'] ?? 'STU001'); ?></p>
                    <p style="opacity: 0.8; margin-bottom: 20px; font-size: 13px;">Computer Science Major</p>
                    
                    <div style="background: rgba(255,255,255,0.2); border-radius: 12px; padding: 15px; margin-bottom: 15px; backdrop-filter: blur(10px);">
                        <div style="font-size: 13px; opacity: 0.9; margin-bottom: 5px;">Current Semester</div>
                        <div style="font-size: 20px; font-weight: 700;">Fall 2025</div>
                    </div>
                    
                    <div style="background: rgba(255,255,255,0.2); border-radius: 12px; padding: 15px; backdrop-filter: blur(10px);">
                        <div style="font-size: 13px; opacity: 0.9; margin-bottom: 5px;">Academic Year</div>
                        <div style="font-size: 20px; font-weight: 700;">3rd Year</div>
                    </div>
                </div>

                <!-- Right: Details Grid -->
                <div>
                    <!-- Quick Stats -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 25px;">
                        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; padding: 20px; color: white;">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <div>
                                    <div style="font-size: 32px; font-weight: 700; margin-bottom: 5px;">3.8</div>
                                    <div style="font-size: 14px; opacity: 0.9;">Current GPA</div>
                                </div>
                                <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                            </div>
                        </div>
                        <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px; padding: 20px; color: white;">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <div>
                                    <div style="font-size: 32px; font-weight: 700; margin-bottom: 5px;">128</div>
                                    <div style="font-size: 14px; opacity: 0.9;">Credits Earned</div>
                                </div>
                                <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                    <i class="fas fa-book-open"></i>
                                </div>
                            </div>
                        </div>
                        <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border-radius: 12px; padding: 20px; color: white;">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <div>
                                    <div style="font-size: 32px; font-weight: 700; margin-bottom: 5px;">92%</div>
                                    <div style="font-size: 14px; opacity: 0.9;">Attendance</div>
                                </div>
                                <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Student Information -->
                    <div style="background: #f8f9fa; border-radius: 12px; padding: 25px; margin-bottom: 20px;">
                        <h4 style="font-size: 16px; font-weight: 700; color: #2c3e50; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-info-circle" style="color: #667eea;"></i> Personal Information
                        </h4>
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                            <div>
                                <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 5px; text-transform: uppercase; font-weight: 600;">Email Address</div>
                                <div style="font-size: 14px; color: #2c3e50; font-weight: 500;">student@university.edu</div>
                            </div>
                            <div>
                                <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 5px; text-transform: uppercase; font-weight: 600;">Phone Number</div>
                                <div style="font-size: 14px; color: #2c3e50; font-weight: 500;">+1 (555) 123-4567</div>
                            </div>
                            <div>
                                <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 5px; text-transform: uppercase; font-weight: 600;">Date of Birth</div>
                                <div style="font-size: 14px; color: #2c3e50; font-weight: 500;">January 15, 2003</div>
                            </div>
                            <div>
                                <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 5px; text-transform: uppercase; font-weight: 600;">Enrollment Date</div>
                                <div style="font-size: 14px; color: #2c3e50; font-weight: 500;">September 2023</div>
                            </div>
                            <div>
                                <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 5px; text-transform: uppercase; font-weight: 600;">Department</div>
                                <div style="font-size: 14px; color: #2c3e50; font-weight: 500;">Computer Science</div>
                            </div>
                            <div>
                                <div style="font-size: 12px; color: #7f8c8d; margin-bottom: 5px; text-transform: uppercase; font-weight: 600;">Expected Graduation</div>
                                <div style="font-size: 14px; color: #2c3e50; font-weight: 500;">May 2027</div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px;">
                        <button style="background: white; border: 2px solid #e0e0e0; padding: 15px; border-radius: 12px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; color: #2c3e50;" onmouseover="this.style.borderColor='#667eea'; this.style.background='#f0f4ff'" onmouseout="this.style.borderColor='#e0e0e0'; this.style.background='white'">
                            <i class="fas fa-file-download" style="color: #667eea;"></i> Transcript
                        </button>
                        <button style="background: white; border: 2px solid #e0e0e0; padding: 15px; border-radius: 12px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; color: #2c3e50;" onmouseover="this.style.borderColor='#4facfe'; this.style.background='#f0faff'" onmouseout="this.style.borderColor='#e0e0e0'; this.style.background='white'">
                            <i class="fas fa-money-bill-wave" style="color: #4facfe;"></i> Payments
                        </button>
                        <button style="background: white; border: 2px solid #e0e0e0; padding: 15px; border-radius: 12px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; color: #2c3e50;" onmouseover="this.style.borderColor='#43e97b'; this.style.background='#f0fff4'" onmouseout="this.style.borderColor='#e0e0e0'; this.style.background='white'">
                            <i class="fas fa-calendar-alt" style="color: #43e97b;"></i> Schedule
                        </button>
                        <button style="background: white; border: 2px solid #e0e0e0; padding: 15px; border-radius: 12px; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; color: #2c3e50;" onmouseover="this.style.borderColor='#fa709a'; this.style.background='#fff0f4'" onmouseout="this.style.borderColor='#e0e0e0'; this.style.background='white'">
                            <i class="fas fa-id-card" style="color: #fa709a;"></i> ID Card
                        </button>
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
                        <div class="course-item-header">
                            <div class="course-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <div class="course-info">
                                <h4>
                                    Web Development
                                    <span class="course-status-badge active">Active</span>
                                </h4>
                                <p>
                                    <span><i class="fas fa-user"></i> Prof. John Smith</span>
                                    <span><i class="fas fa-book"></i> 24 lessons</span>
                                </p>
                            </div>
                        </div>
                        <div class="course-progress">
                            <div class="progress-info">
                                <span class="progress-label">Progress</span>
                                <div class="progress-percent">75%</div>
                            </div>
                            <div class="progress-bar-wrapper">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 75%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="course-meta">
                            <div class="course-meta-item">
                                <i class="fas fa-clock"></i>
                                <span>18 hrs left</span>
                            </div>
                            <div class="course-meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>Due: Dec 30</span>
                            </div>
                        </div>
                        <div class="course-actions">
                            <button class="course-action-btn primary" onclick="continueCourse('web-development', 75, 'Lesson 19: Advanced CSS Grid')">
                                <i class="fas fa-play"></i>
                                Continue Learning
                            </button>
                            <button class="course-action-btn secondary" onclick="openCourseDetail('web-development', 'active', 75)" title="Course Details">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="course-item">
                        <div class="course-item-header">
                            <div class="course-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                <i class="fas fa-database"></i>
                            </div>
                            <div class="course-info">
                                <h4>
                                    Database Management
                                    <span class="course-status-badge active">Active</span>
                                </h4>
                                <p>
                                    <span><i class="fas fa-user"></i> Prof. Sarah Johnson</span>
                                    <span><i class="fas fa-book"></i> 18 lessons</span>
                                </p>
                            </div>
                        </div>
                        <div class="course-progress">
                            <div class="progress-info">
                                <span class="progress-label">Progress</span>
                                <div class="progress-percent">60%</div>
                            </div>
                            <div class="progress-bar-wrapper">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 60%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="course-meta">
                            <div class="course-meta-item">
                                <i class="fas fa-clock"></i>
                                <span>24 hrs left</span>
                            </div>
                            <div class="course-meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>Due: Jan 5</span>
                            </div>
                        </div>
                        <div class="course-actions">
                            <button class="course-action-btn primary" onclick="continueCourse('database-management', 60, 'Lesson 11: Advanced Queries')">
                                <i class="fas fa-play"></i>
                                Continue Learning
                            </button>
                            <button class="course-action-btn secondary" onclick="openCourseDetail('database-systems', 'active', 60)" title="Course Details">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="course-item">
                        <div class="course-item-header">
                            <div class="course-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                <i class="fas fa-brain"></i>
                            </div>
                            <div class="course-info">
                                <h4>
                                    Artificial Intelligence
                                    <span class="course-status-badge active">Active</span>
                                </h4>
                                <p>
                                    <span><i class="fas fa-user"></i> Prof. Michael Brown</span>
                                    <span><i class="fas fa-book"></i> 32 lessons</span>
                                </p>
                            </div>
                        </div>
                        <div class="course-progress">
                            <div class="progress-info">
                                <span class="progress-label">Progress</span>
                                <div class="progress-percent">45%</div>
                            </div>
                            <div class="progress-bar-wrapper">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 45%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="course-meta">
                            <div class="course-meta-item">
                                <i class="fas fa-clock"></i>
                                <span>42 hrs left</span>
                            </div>
                            <div class="course-meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>Due: Jan 15</span>
                            </div>
                        </div>
                        <div class="course-actions">
                            <button class="course-action-btn primary">
                                <i class="fas fa-play"></i>
                                Continue Learning
                            </button>
                            <button class="course-action-btn secondary">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="course-item">
                        <div class="course-item-header">
                            <div class="course-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="course-info">
                                <h4>
                                    Mobile App Development
                                    <span class="course-status-badge completed">Completed</span>
                                </h4>
                                <p>
                                    <span><i class="fas fa-user"></i> Prof. Emily Davis</span>
                                    <span><i class="fas fa-book"></i> 28 lessons</span>
                                </p>
                            </div>
                        </div>
                        <div class="course-progress">
                            <div class="progress-info">
                                <span class="progress-label">Progress</span>
                                <div class="progress-percent">90%</div>
                            </div>
                            <div class="progress-bar-wrapper">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 90%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="course-meta">
                            <div class="course-meta-item">
                                <i class="fas fa-check-circle"></i>
                                <span>27/28 Complete</span>
                            </div>
                            <div class="course-meta-item">
                                <i class="fas fa-star"></i>
                                <span>4.8 Rating</span>
                            </div>
                        </div>
                        <div class="course-actions">
                            <button class="course-action-btn primary" onclick="downloadCertificate('mobile-dev')" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                <i class="fas fa-certificate"></i>
                                Get Certificate
                            </button>
                            <button class="course-action-btn secondary" onclick="reviewCourse('mobile-dev')" title="Review Course">
                                <i class="fas fa-redo"></i>
                            </button>
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

    <!-- All Notifications Modal -->
    <div class="notifications-modal" id="notificationsModal">
        <div class="notifications-modal-content">
            <div class="notifications-modal-header">
                <h2><i class="fas fa-bell"></i> All Notifications</h2>
                <button class="notifications-modal-close" onclick="closeNotificationsModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="notifications-modal-toolbar">
                <div class="notification-search">
                    <input type="text" id="notificationSearchInput" placeholder="Search notifications..." onkeyup="filterNotifications()">
                    <i class="fas fa-search"></i>
                </div>
                <div class="notification-filters">
                    <button class="filter-btn active" data-filter="all" onclick="filterByType('all')">All</button>
                    <button class="filter-btn" data-filter="unread" onclick="filterByType('unread')">Unread</button>
                    <button class="filter-btn" data-filter="read" onclick="filterByType('read')">Read</button>
                </div>
            </div>
            <div class="notifications-modal-body" id="allNotificationsList">
                <div class="notification-full-item unread" data-type="success">
                    <div class="notification-full-header">
                        <div class="notification-full-icon success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="notification-full-content">
                            <h4 class="notification-full-title">Assignment Submitted Successfully</h4>
                            <p class="notification-full-text">Your Web Development assignment "Build a Responsive Website" has been submitted successfully. Your instructor will review it within 48 hours.</p>
                            <div class="notification-full-meta">
                                <span><i class="far fa-clock"></i>5 minutes ago</span>
                                <span><i class="fas fa-tag"></i>Assignment</span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-actions">
                        <button class="notification-action-btn primary" onclick="viewAssignment()"><i class="fas fa-eye"></i> View Submission</button>
                        <button class="notification-action-btn secondary" onclick="markNotificationRead(this)"><i class="fas fa-check"></i> Mark as Read</button>
                    </div>
                </div>

                <div class="notification-full-item unread" data-type="info">
                    <div class="notification-full-header">
                        <div class="notification-full-icon info">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="notification-full-content">
                            <h4 class="notification-full-title">New Course Material Available</h4>
                            <p class="notification-full-text">Dr. Smith has uploaded new lecture notes and slides for "Database Management Systems - Chapter 5: SQL Advanced Queries". Don't forget to review before tomorrow's class.</p>
                            <div class="notification-full-meta">
                                <span><i class="far fa-clock"></i>1 hour ago</span>
                                <span><i class="fas fa-tag"></i>Course Material</span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-actions">
                        <button class="notification-action-btn primary" onclick="viewMaterial()"><i class="fas fa-book"></i> View Material</button>
                        <button class="notification-action-btn secondary" onclick="markNotificationRead(this)"><i class="fas fa-check"></i> Mark as Read</button>
                    </div>
                </div>

                <div class="notification-full-item unread" data-type="warning">
                    <div class="notification-full-header">
                        <div class="notification-full-icon warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="notification-full-content">
                            <h4 class="notification-full-title">Exam Reminder - Mathematics Final</h4>
                            <p class="notification-full-text">Your Mathematics final exam is scheduled for tomorrow, December 20, 2025 at 10:00 AM in Room 301. Duration: 2 hours. Please arrive 15 minutes early with your student ID.</p>
                            <div class="notification-full-meta">
                                <span><i class="far fa-clock"></i>2 hours ago</span>
                                <span><i class="fas fa-tag"></i>Exam</span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-actions">
                        <button class="notification-action-btn primary" onclick="viewExamDetails()"><i class="fas fa-calendar"></i> View Details</button>
                        <button class="notification-action-btn secondary" onclick="markNotificationRead(this)"><i class="fas fa-check"></i> Mark as Read</button>
                    </div>
                </div>

                <div class="notification-full-item" data-type="info">
                    <div class="notification-full-header">
                        <div class="notification-full-icon info">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="notification-full-content">
                            <h4 class="notification-full-title">Grade Posted - Computer Science Midterm</h4>
                            <p class="notification-full-text">Your grade for Computer Science midterm examination is now available. You scored 92/100. Great job! Click to view detailed feedback.</p>
                            <div class="notification-full-meta">
                                <span><i class="far fa-clock"></i>1 day ago</span>
                                <span><i class="fas fa-tag"></i>Grades</span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-actions">
                        <button class="notification-action-btn primary" onclick="viewGrade()"><i class="fas fa-chart-line"></i> View Grade</button>
                        <button class="notification-action-btn secondary" onclick="deleteNotification(this)"><i class="fas fa-trash"></i> Delete</button>
                    </div>
                </div>

                <div class="notification-full-item" data-type="success">
                    <div class="notification-full-header">
                        <div class="notification-full-icon success">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="notification-full-content">
                            <h4 class="notification-full-title">Attendance Marked</h4>
                            <p class="notification-full-text">Your attendance has been successfully marked for today's Physics lecture (PHY301). Total attendance: 42/45 classes (93.3%).</p>
                            <div class="notification-full-meta">
                                <span><i class="far fa-clock"></i>2 days ago</span>
                                <span><i class="fas fa-tag"></i>Attendance</span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-actions">
                        <button class="notification-action-btn primary" onclick="viewAttendance()"><i class="fas fa-calendar-check"></i> View Record</button>
                        <button class="notification-action-btn secondary" onclick="deleteNotification(this)"><i class="fas fa-trash"></i> Delete</button>
                    </div>
                </div>

                <div class="notification-full-item" data-type="warning">
                    <div class="notification-full-header">
                        <div class="notification-full-icon warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="notification-full-content">
                            <h4 class="notification-full-title">Assignment Deadline Approaching</h4>
                            <p class="notification-full-text">Reminder: Your English Literature essay assignment is due in 3 days (December 22, 2025). Make sure to submit before the deadline to avoid late penalties.</p>
                            <div class="notification-full-meta">
                                <span><i class="far fa-clock"></i>3 days ago</span>
                                <span><i class="fas fa-tag"></i>Deadline</span>
                            </div>
                        </div>
                    </div>
                    <div class="notification-actions">
                        <button class="notification-action-btn primary" onclick="viewAssignment()"><i class="fas fa-tasks"></i> View Assignment</button>
                        <button class="notification-action-btn secondary" onclick="deleteNotification(this)"><i class="fas fa-trash"></i> Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Courses Dropdown
        function toggleCoursesDropdown(event) {
            event.preventDefault();
            const navItem = document.getElementById('coursesNavItem');
            const sidebar = document.getElementById('sidebar');
            
            
            if (sidebar.classList.contains('collapsed')) {
            
                sidebar.classList.remove('collapsed');
                document.getElementById('mainContent').classList.remove('expanded');
                
                
                setTimeout(() => {
                    navItem.classList.toggle('open');
                }, 300);
            } else {
                navItem.classList.toggle('open');
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const coursesNavItem = document.getElementById('coursesNavItem');
            
            if (window.innerWidth <= 768) {
                // Mobile: Toggle sidebar visibility
                sidebar.classList.toggle('active');
                
    
                const profileDropdown = document.getElementById('profileDropdown');
                const notificationDropdown = document.getElementById('notificationDropdown');
                if (profileDropdown) profileDropdown.classList.remove('show');
                if (notificationDropdown) notificationDropdown.classList.remove('show');
            } else {
                // Desktop: Toggle sidebar collapse
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                
            
                if (sidebar.classList.contains('collapsed')) {
                    coursesNavItem.classList.remove('open');
                }
            }
        }

        // Handle mobile sidebar overlay
        if (window.innerWidth <= 768) {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            // Create overlay for mobile
            const overlay = document.createElement('div');
            overlay.style.cssText = 'position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 999; display: none;';
            overlay.id = 'sidebarOverlay';
            document.body.appendChild(overlay);
            
            // Close sidebar when clicking overlay
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.style.display = 'none';
            });
            
            // Show/hide overlay with sidebar
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'class') {
                        if (sidebar.classList.contains('active')) {
                            overlay.style.display = 'block';
                        } else {
                            overlay.style.display = 'none';
                        }
                    }
                });
            });
            observer.observe(sidebar, { attributes: true });
            
    
            const navLinks = sidebar.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('active');
                        overlay.style.display = 'none';
                    }
                });
            });
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (window.innerWidth > 768) {
                // Desktop mode
                sidebar.classList.remove('active');
                if (overlay) overlay.style.display = 'none';
            } else {

                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
            }
        });

    
        if (window.innerWidth <= 768) {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.remove('collapsed');
        }

        // Notification Functions
        function toggleNotifications() {
            const dropdown = document.getElementById('notificationDropdown');
            dropdown.classList.toggle('show');
    
            const profileDropdown = document.getElementById('profileDropdown');
            if (profileDropdown.classList.contains('show')) {
                toggleProfileDropdown();
            }
        }

        // Profile Dropdown Functions
        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            const profileBtn = document.querySelector('.user-profile');
            dropdown.classList.toggle('show');
            profileBtn.classList.toggle('active');
            
            // Close notification dropdown if open
            const notificationDropdown = document.getElementById('notificationDropdown');
            if (notificationDropdown && notificationDropdown.classList.contains('show')) {
                notificationDropdown.classList.remove('show');
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const profileWrapper = document.querySelector('.user-profile-wrapper');
            const notificationWrapper = document.querySelector('.notification-wrapper');
            
            // Close profile dropdown
            if (profileWrapper && !profileWrapper.contains(event.target)) {
                const profileDropdown = document.getElementById('profileDropdown');
                const profileBtn = document.querySelector('.user-profile');
                if (profileDropdown && profileDropdown.classList.contains('show')) {
                    profileDropdown.classList.remove('show');
                    profileBtn.classList.remove('active');
                }
            }
            
            // Close notification dropdown
            if (notificationWrapper && !notificationWrapper.contains(event.target)) {
                const notificationDropdown = document.getElementById('notificationDropdown');
                if (notificationDropdown && notificationDropdown.classList.contains('show')) {
                    notificationDropdown.classList.remove('show');
                }
            }
        });

        function markAsRead(element) {
            element.classList.remove('unread');
            updateNotificationCount();
        }

        function markAllAsRead() {
            const unreadItems = document.querySelectorAll('.notification-item.unread');
            unreadItems.forEach(item => {
                item.classList.remove('unread');
            });
            updateNotificationCount();
        }

        function updateNotificationCount() {
            const unreadCount = document.querySelectorAll('.notification-item.unread').length;
            const badge = document.getElementById('notificationCount');
            if (unreadCount > 0) {
                badge.textContent = unreadCount;
                badge.style.display = 'flex';
            } else {
                badge.style.display = 'none';
            }
        }

        function viewAllNotifications() {
            document.getElementById('notificationsModal').classList.add('show');
            document.getElementById('notificationDropdown').classList.remove('show');
            document.body.style.overflow = 'hidden';
        }

        function closeNotificationsModal() {
            document.getElementById('notificationsModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        function filterByType(type) {
            const allItems = document.querySelectorAll('.notification-full-item');
            const filterBtns = document.querySelectorAll('.filter-btn');
            
            // Update active button
            filterBtns.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Filter notifications
            allItems.forEach(item => {
                if (type === 'all') {
                    item.style.display = 'block';
                } else if (type === 'unread') {
                    item.style.display = item.classList.contains('unread') ? 'block' : 'none';
                } else if (type === 'read') {
                    item.style.display = !item.classList.contains('unread') ? 'block' : 'none';
                }
            });
        }

        function filterNotifications() {
            const searchTerm = document.getElementById('notificationSearchInput').value.toLowerCase();
            const allItems = document.querySelectorAll('.notification-full-item');
            
            allItems.forEach(item => {
                const title = item.querySelector('.notification-full-title').textContent.toLowerCase();
                const text = item.querySelector('.notification-full-text').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || text.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function markNotificationRead(button) {
            const item = button.closest('.notification-full-item');
            item.classList.remove('unread');
            button.textContent = 'Read';
            button.disabled = true;
            button.style.opacity = '0.5';
            updateNotificationCount();
        }

        function deleteNotification(button) {
            if (confirm('Are you sure you want to delete this notification?')) {
                const item = button.closest('.notification-full-item');
                item.style.animation = 'slideUp 0.3s ease reverse';
                setTimeout(() => {
                    item.remove();
                    updateNotificationCount();
                }, 300);
            }
        }

        function viewAssignment() {
            document.getElementById('assignmentDetailModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function viewMaterial() {
            document.getElementById('materialDetailModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function viewExamDetails() {
            document.getElementById('examDetailModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeDetailModal(modalId) {
            document.getElementById(modalId).classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Close detail modal when clicking outside
        document.querySelectorAll('.detail-modal').forEach(modal => {
            modal.addEventListener('click', function(event) {
                if (event.target === this) {
                    this.classList.remove('show');
                    document.body.style.overflow = 'auto';
                }
            });
        });

        function viewGrade() {
            document.getElementById('gradeDetailModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function viewAttendance() {
            document.getElementById('attendanceDetailModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('notificationsModal');
            if (event.target === modal) {
                closeNotificationsModal();
            }
        });

    
        document.addEventListener('click', function(event) {
            const wrapper = event.target.closest('.notification-wrapper');
            const dropdown = document.getElementById('notificationDropdown');
            
            if (!wrapper && dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        });

        // Initialize notification count
        updateNotificationCount();

        // Download file function
        function downloadFile(fileName, fileUrl) {
            // Create a temporary anchor element
            const link = document.createElement('a');
            link.href = fileUrl || '#';
            link.download = fileName;
            link.style.display = 'none';
            
            // Append to body, click, and remove
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Show success message
            showNotificationMessage('Downloading ' + fileName + '...', 'success');
        }

        // View file function
        function viewFile(fileName, fileUrl) {
            if (fileUrl && fileUrl !== '#') {
                // Open in new tab
                window.open(fileUrl, '_blank');
                showNotificationMessage('Opening ' + fileName + '...', 'info');
            } else {
                // Simulate viewing - in real app, this would open file viewer
                alert('File Viewer\n\nOpening: ' + fileName + '\n\nIn a production environment, this would open the file in a document viewer.');
            }
        }


        function editSubmission(assignmentId) {
            // Close the detail modal
            closeDetailModal('assignmentDetailModal');
            
            // Show the edit submission modal
            setTimeout(function() {
                const editModal = document.getElementById('editSubmissionModal');
                if (editModal) {
                    editModal.classList.add('show');
                    document.body.style.overflow = 'hidden';
                    
                    // Populate with existing data
                    document.getElementById('editAssignmentId').value = assignmentId || 'ASG001';
                    document.getElementById('editComments').value = 'I have completed all the requirements for this assignment. The website is fully responsive and tested on multiple devices and browsers. Please review and provide feedback.';
                    
                    showNotificationMessage('Opening assignment editor...', 'info');
                }
            }, 300);
        }

        // Submit edited assignment
        function submitEditedAssignment() {
            const assignmentId = document.getElementById('editAssignmentId').value;
            const comments = document.getElementById('editComments').value;
            const fileInput = document.getElementById('editFileUpload');
            
            if (!comments.trim()) {
                showNotificationMessage('Please add comments about your submission', 'warning');
                return;
            }
            
            // In production, this would send data to server
            showNotificationMessage('Updating submission...', 'info');
            
            setTimeout(function() {
                closeDetailModal('editSubmissionModal');
                showNotificationMessage('Assignment submission updated successfully!', 'success');
                
                // Refresh the notification list (in 
                setTimeout(function() {
                    showNotificationMessage('Refreshing notifications...', 'info');
                }, 1000);
            }, 1500);
        }

        // Add new file to submission
        function addFileToSubmission() {
            const fileInput = document.getElementById('editFileUpload');
            fileInput.click();
        }

        // Handle file selection
        function handleFileSelection() {
            const fileInput = document.getElementById('editFileUpload');
            const fileList = document.getElementById('editFileList');
            
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const fileSize = (file.size / 1024).toFixed(2);
                const fileIcon = getFileIcon(file.name);
                
                const fileItem = document.createElement('li');
                fileItem.className = 'detail-file-item';
                fileItem.innerHTML = `
                    <div class="detail-file-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="${fileIcon}"></i>
                    </div>
                    <div class="detail-file-info">
                        <p class="detail-file-name">${file.name}</p>
                        <p class="detail-file-meta">${file.type || 'Unknown'} • ${fileSize} KB • Just added</p>
                    </div>
                    <button class="detail-file-download" onclick="removeFile(this)" style="background: #fa709a;">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                `;
                
                fileList.appendChild(fileItem);
                showNotificationMessage('File added: ' + file.name, 'success');
            }
        }

        // Get file icon based on extension
        function getFileIcon(fileName) {
            const ext = fileName.split('.').pop().toLowerCase();
            const iconMap = {
                'html': 'fas fa-file-code',
                'css': 'fas fa-file-code',
                'js': 'fas fa-file-code',
                'pdf': 'fas fa-file-pdf',
                'doc': 'fas fa-file-word',
                'docx': 'fas fa-file-word',
                'xls': 'fas fa-file-excel',
                'xlsx': 'fas fa-file-excel',
                'ppt': 'fas fa-file-powerpoint',
                'pptx': 'fas fa-file-powerpoint',
                'zip': 'fas fa-file-archive',
                'rar': 'fas fa-file-archive',
                'jpg': 'fas fa-file-image',
                'jpeg': 'fas fa-file-image',
                'png': 'fas fa-file-image',
                'gif': 'fas fa-file-image'
            };
            
            return iconMap[ext] || 'fas fa-file';
        }

        // Remove file from list
        function removeFile(button) {
            const fileItem = button.closest('.detail-file-item');
            const fileName = fileItem.querySelector('.detail-file-name').textContent;
            
            // Add fade out animation
            fileItem.style.animation = 'fadeOut 0.3s ease-out';
            
            setTimeout(function() {
                fileItem.remove();
                updateFileCount();
                showNotificationMessage('File removed: ' + fileName, 'info');
            }, 300);
        }

        // Handle drag and drop
        function handleFileDrop(event) {
            event.preventDefault();
            const files = event.dataTransfer.files;
            
            if (files.length > 0) {
                const fileInput = document.getElementById('editFileUpload');
                fileInput.files = files;
                handleFileSelection();
            }
        }

        // Update file count
        function updateFileCount() {
            const fileList = document.getElementById('editFileList');
            const count = fileList ? fileList.querySelectorAll('.detail-file-item').length : 0;
            const countElement = document.getElementById('fileCount');
            if (countElement) {
                countElement.textContent = count;
            }
        }

        // Clear all files
        function clearAllFiles() {
            if (confirm('Are you sure you want to remove all files? This action cannot be undone.')) {
                const fileList = document.getElementById('editFileList');
                const items = fileList.querySelectorAll('.detail-file-item');
                
                items.forEach(function(item, index) {
                    setTimeout(function() {
                        item.style.animation = 'fadeOut 0.3s ease-out';
                        setTimeout(function() {
                            item.remove();
                            updateFileCount();
                        }, 300);
                    }, index * 100);
                });
                
                setTimeout(function() {
                    showNotificationMessage('All files removed', 'info');
                }, items.length * 100 + 400);
            }
        }

        // Character count for comments
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('editComments');
            if (textarea) {
                textarea.addEventListener('input', function() {
                    const charCountElement = document.getElementById('charCount');
                    if (charCountElement) {
                        charCountElement.textContent = this.value.length;
                    }
                });
            }
        });

        
        function printGradeReport() {
    
            const modalContent = document.getElementById('gradeDetailModal').querySelector('.detail-modal-body');
            
            
            const printWindow = window.open('', '_blank', 'width=800,height=600');
            

            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Grade Report - Print</title>
                    <style>
                        body {
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                            padding: 40px;
                            line-height: 1.6;
                            color: #333;
                        }
                        h1 {
                            color: #667eea;
                            border-bottom: 3px solid #667eea;
                            padding-bottom: 10px;
                            margin-bottom: 30px;
                        }
                        h2 {
                            color: #4facfe;
                            margin-top: 30px;
                            margin-bottom: 15px;
                        }
                        .grade-display {
                            text-align: center;
                            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                            color: white;
                            padding: 30px;
                            border-radius: 10px;
                            margin: 20px 0;
                        }
                        .grade-display h2 {
                            color: white;
                            font-size: 48px;
                            margin: 0;
                        }
                        .info-grid {
                            display: grid;
                            grid-template-columns: repeat(2, 1fr);
                            gap: 15px;
                            margin: 20px 0;
                        }
                        .info-item {
                            padding: 15px;
                            border: 1px solid #e0e0e0;
                            border-radius: 8px;
                        }
                        .info-label {
                            font-weight: 600;
                            color: #666;
                            font-size: 12px;
                            text-transform: uppercase;
                            margin-bottom: 5px;
                        }
                        .info-value {
                            font-size: 16px;
                            color: #333;
                        }
                        .score-item {
                            padding: 15px;
                            border-left: 4px solid #43e97b;
                            margin: 10px 0;
                            background: #f8f9fa;
                        }
                        ul {
                            list-style: none;
                            padding: 0;
                        }
                        li {
                            margin: 10px 0;
                            padding-left: 20px;
                            position: relative;
                        }
                        li:before {
                            content: "•";
                            position: absolute;
                            left: 0;
                            color: #667eea;
                            font-weight: bold;
                        }
                        @media print {
                            body { padding: 20px; }
                            .no-print { display: none; }
                        }
                    </style>
                </head>
                <body>
                    <h1>📊 Official Grade Report</h1>
                    <div class="grade-display">
                        <h2>92/100</h2>
                        <p style="margin: 0; font-size: 20px;">Excellent Performance! Grade: A</p>
                    </div>
                    
                    <h2>Exam Information</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Course</div>
                            <div class="info-value">Computer Science</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Exam Type</div>
                            <div class="info-value">Midterm Examination</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Exam Date</div>
                            <div class="info-value">Dec 15, 2025</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Posted On</div>
                            <div class="info-value">Dec 18, 2025</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Instructor</div>
                            <div class="info-value">Prof. Johnson</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Class Average</div>
                            <div class="info-value">78/100</div>
                        </div>
                    </div>
                    
                    <h2>Score Breakdown</h2>
                    <div class="score-item">
                        <strong>Multiple Choice Questions</strong> (Section A)<br>
                        Score: <strong>23/25</strong>
                    </div>
                    <div class="score-item">
                        <strong>Short Answer Questions</strong> (Section B)<br>
                        Score: <strong>28/30</strong>
                    </div>
                    <div class="score-item">
                        <strong>Essay Questions</strong> (Section C)<br>
                        Score: <strong>41/45</strong>
                    </div>
                    
                    <h2>Instructor Feedback</h2>
                    <p><strong>Strengths:</strong></p>
                    <ul>
                        <li>Excellent understanding of data structures and algorithms</li>
                        <li>Clear and well-structured answers</li>
                        <li>Strong problem-solving skills demonstrated</li>
                    </ul>
                    <p><strong>Areas for Improvement:</strong></p>
                    <ul>
                        <li>Time complexity analysis could be more detailed</li>
                        <li>Consider adding more code comments in programming questions</li>
                    </ul>
                    
                    <h2>Performance Statistics</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Your Rank</div>
                            <div class="info-value" style="color: #43e97b; font-weight: bold;">5th / 45 Students</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Percentile</div>
                            <div class="info-value" style="color: #4facfe; font-weight: bold;">89th Percentile</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Grade Point</div>
                            <div class="info-value" style="color: #667eea; font-weight: bold;">4.0 / 4.0</div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 50px; padding-top: 20px; border-top: 2px solid #e0e0e0; text-align: center; color: #666; font-size: 12px;">
                        <p>Generated on: ${new Date().toLocaleDateString()} at ${new Date().toLocaleTimeString()}</p>
                        <p>This is an official grade report. For questions, please contact the instructor.</p>
                    </div>
                    
                    <div class="no-print" style="text-align: center; margin-top: 30px;">
                        <button onclick="window.print()" style="padding: 12px 30px; background: #667eea; color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer;">
                            Print Report
                        </button>
                        <button onclick="window.close()" style="padding: 12px 30px; background: #6c757d; color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; margin-left: 10px;">
                            Close
                        </button>
                    </div>
                </body>
                </html>
            `);
            
            printWindow.document.close();
            showNotificationMessage('Opening print preview...', 'success');
        }

        // Download full attendance report function
        function downloadAttendanceReport() {
            // Create CSV content
            const csvContent = `Attendance Report - Physics (PHY301)
Generated: ${new Date().toLocaleDateString()} ${new Date().toLocaleTimeString()}

Summary:
Total Classes,Present,Absent,Attendance Rate
45,42,3,93.3%

Detailed Record:
Date,Day,Type,Time,Status
December 19 2025,Thursday,Lecture: Quantum Mechanics,10:00 AM - 11:30 AM,Present
December 17 2025,Tuesday,Lab Session: Optics Experiment,2:00 PM - 4:00 PM,Present
December 15 2025,Sunday,Lecture: Thermodynamics,10:00 AM - 11:30 AM,Present
December 12 2025,Thursday,Lecture: Electromagnetism,10:00 AM - 11:30 AM,Absent
December 10 2025,Tuesday,Lab Session: Mechanics,2:00 PM - 4:00 PM,Present

Monthly Breakdown:
Month,Classes,Attended,Attendance Rate
September,12,12,100%
October,14,14,100%
November,10,8,80%
December,9,8,88.9%

Course Information:
Instructor: Dr. Sarah Williams
Semester: Fall 2025
Required Attendance: 75% Minimum
Status: Meets Requirement

Note: This report includes all attendance records for the current semester.
For questions or discrepancies please contact the course instructor.`;

            // Create blob and download
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);
            
            link.setAttribute('href', url);
            link.setAttribute('download', 'Attendance_Report_PHY301_' + new Date().getTime() + '.csv');
            link.style.visibility = 'hidden';
            
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            showNotificationMessage('Downloading attendance report...', 'success');
        }

        // All Courses Modal Functions
        function openAllCoursesModal() {
            document.getElementById('allCoursesModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeAllCoursesModal() {
            document.getElementById('allCoursesModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('allCoursesModal');
            if (event.target === modal) {
                closeAllCoursesModal();
            }
        });

        // Toggle View (Grid/List)
        function toggleView(view) {
            const gridView = document.getElementById('coursesGrid');
            const listView = document.getElementById('coursesList');
            const gridBtn = document.getElementById('gridViewBtn');
            const listBtn = document.getElementById('listViewBtn');

            if (view === 'grid') {
                gridView.classList.add('active');
                listView.classList.remove('active');
                gridBtn.classList.add('active');
                listBtn.classList.remove('active');
            } else {
                gridView.classList.remove('active');
                listView.classList.add('active');
                gridBtn.classList.remove('active');
                listBtn.classList.add('active');
            }
        }

        // Filter Courses
        function filterCourses() {
            const searchInput = document.getElementById('courseSearchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const cards = document.querySelectorAll('.course-card, .course-list-item');

            cards.forEach(card => {
                const courseName = card.querySelector('.course-card-title, .course-list-title').textContent.toLowerCase();
                const instructor = card.querySelector('.instructor-name').textContent.toLowerCase();
                const category = card.querySelector('.course-card-category').textContent.toLowerCase();
                const status = card.getAttribute('data-status');

                const matchesSearch = courseName.includes(searchInput) || 
                                     instructor.includes(searchInput) || 
                                     category.includes(searchInput);
                const matchesStatus = statusFilter === 'all' || status === statusFilter;

                if (matchesSearch && matchesStatus) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Sort Courses
        function sortCourses() {
            const sortBy = document.getElementById('sortFilter').value;
            const gridView = document.getElementById('coursesGrid');
            const listView = document.getElementById('coursesList');
            
            const gridCards = Array.from(gridView.querySelectorAll('.course-card'));
            const listItems = Array.from(listView.querySelectorAll('.course-list-item'));

            function sortElements(elements) {
                return elements.sort((a, b) => {
                    if (sortBy === 'name') {
                        const nameA = a.querySelector('.course-card-title, .course-list-title').textContent;
                        const nameB = b.querySelector('.course-card-title, .course-list-title').textContent;
                        return nameA.localeCompare(nameB);
                    } else if (sortBy === 'progress') {
                        const progressA = parseInt(a.getAttribute('data-progress'));
                        const progressB = parseInt(b.getAttribute('data-progress'));
                        return progressB - progressA;
                    } else if (sortBy === 'instructor') {
                        const instructorA = a.querySelector('.instructor-name').textContent;
                        const instructorB = b.querySelector('.instructor-name').textContent;
                        return instructorA.localeCompare(instructorB);
                    }
                    return 0;
                });
            }

            const sortedGridCards = sortElements(gridCards);
            const sortedListItems = sortElements(listItems);

            sortedGridCards.forEach(card => gridView.appendChild(card));
            sortedListItems.forEach(item => listView.appendChild(item));
        }

        // Toggle Favorite
        document.addEventListener('click', function(e) {
            if (e.target.closest('.course-card-favorite')) {
                const btn = e.target.closest('.course-card-favorite');
                const icon = btn.querySelector('i');
                
                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    showNotificationMessage('Added to favorites!', 'success');
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    showNotificationMessage('Removed from favorites!', 'info');
                }
            }
        });

        // Course Data
        const courseData = {
            'web-development': {
                badge: 'CS 301',
                title: 'Web Development Fundamentals',
                instructor: 'Prof. John Smith',
                instructorTitle: 'Professor of Computer Science',
                avatar: 'JS',
                lessons: 24,
                duration: '36 Hours',
                students: 245,
                rating: '4.8 (156 reviews)',
                description: 'Master the fundamentals of web development including HTML5, CSS3, JavaScript, and modern frameworks. This comprehensive course covers everything from basic web page creation to advanced responsive design and interactive web applications.',
                gradient: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                curriculum: [
                    { number: 1, title: 'Introduction to Web Development', duration: '45 min', type: 'Video', status: 'completed' },
                    { number: 2, title: 'HTML5 Fundamentals', duration: '1h 20min', type: 'Video', status: 'completed' },
                    { number: 3, title: 'CSS3 Styling Basics', duration: '1h 15min', type: 'Video', status: 'completed' },
                    { number: 4, title: 'Flexbox and Grid Layout', duration: '1h 30min', type: 'Video', status: 'completed' },
                    { number: 5, title: 'Responsive Web Design', duration: '1h 45min', type: 'Video', status: 'current' },
                    { number: 6, title: 'JavaScript Basics', duration: '2h 10min', type: 'Video', status: 'locked' },
                    { number: 7, title: 'DOM Manipulation', duration: '1h 40min', type: 'Video', status: 'locked' },
                    { number: 8, title: 'Event Handling', duration: '1h 25min', type: 'Video', status: 'locked' }
                ],
                assignments: [
                    { title: 'Build a Landing Page', due: 'Dec 25, 2025', status: 'pending' },
                    { title: 'Responsive Portfolio Site', due: 'Dec 28, 2025', status: 'pending' },
                    { title: 'JavaScript Calculator', due: 'Jan 5, 2026', status: 'pending' }
                ]
            },
            'database-systems': {
                badge: 'CS 402',
                title: 'Advanced Database Systems',
                instructor: 'Dr. Mary Johnson',
                instructorTitle: 'Associate Professor of Data Science',
                avatar: 'MJ',
                lessons: 18,
                duration: '28 Hours',
                students: 189,
                rating: '4.7 (98 reviews)',
                description: 'Deep dive into database management systems, SQL optimization, NoSQL databases, and distributed data systems. Learn advanced querying, indexing strategies, and database design patterns.',
                gradient: 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
                curriculum: [
                    { number: 1, title: 'Database Fundamentals', duration: '50 min', type: 'Video', status: 'completed' },
                    { number: 2, title: 'SQL Basics', duration: '1h 30min', type: 'Video', status: 'completed' },
                    { number: 3, title: 'Advanced SQL Queries', duration: '1h 45min', type: 'Video', status: 'current' },
                    { number: 4, title: 'Database Design', duration: '2h 00min', type: 'Video', status: 'locked' }
                ],
                assignments: [
                    { title: 'Database Schema Design', due: 'Dec 22, 2025', status: 'submitted' },
                    { title: 'Query Optimization Project', due: 'Dec 29, 2025', status: 'pending' }
                ]
            },
            'data-structures': {
                badge: 'CS 201',
                title: 'Data Structures & Algorithms',
                instructor: 'Prof. Robert Brown',
                instructorTitle: 'Senior Professor of Computer Science',
                avatar: 'RB',
                lessons: 32,
                duration: '48 Hours',
                students: 312,
                rating: '4.9 (234 reviews)',
                description: 'Comprehensive study of fundamental data structures and algorithms including arrays, linked lists, trees, graphs, sorting, and searching algorithms with complexity analysis.',
                gradient: 'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)',
                curriculum: [
                    { number: 1, title: 'Arrays and Lists', duration: '1h 00min', type: 'Video', status: 'completed' },
                    { number: 2, title: 'Stacks and Queues', duration: '1h 15min', type: 'Video', status: 'completed' },
                    { number: 3, title: 'Trees and Graphs', duration: '2h 00min', type: 'Video', status: 'completed' },
                    { number: 4, title: 'Sorting Algorithms', duration: '1h 45min', type: 'Video', status: 'completed' }
                ],
                assignments: [
                    { title: 'Binary Search Tree Implementation', due: 'Nov 15, 2025', status: 'graded' },
                    { title: 'Graph Algorithms', due: 'Nov 28, 2025', status: 'graded' }
                ]
            },
            'machine-learning': {
                badge: 'CS 501',
                title: 'Machine Learning & AI',
                instructor: 'Dr. Sarah Davis',
                instructorTitle: 'Professor of Artificial Intelligence',
                avatar: 'SD',
                lessons: 28,
                duration: '42 Hours',
                students: 156,
                rating: '4.8 (89 reviews)',
                description: 'Introduction to machine learning concepts, algorithms, and practical applications. Covers supervised and unsupervised learning, neural networks, and deep learning basics.',
                gradient: 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)',
                curriculum: [
                    { number: 1, title: 'Introduction to ML', duration: '1h 00min', type: 'Video', status: 'completed' },
                    { number: 2, title: 'Linear Regression', duration: '1h 30min', type: 'Video', status: 'completed' },
                    { number: 3, title: 'Classification Algorithms', duration: '1h 45min', type: 'Video', status: 'current' },
                    { number: 4, title: 'Neural Networks', duration: '2h 15min', type: 'Video', status: 'locked' }
                ],
                assignments: [
                    { title: 'Linear Regression Model', due: 'Dec 20, 2025', status: 'submitted' },
                    { title: 'Image Classification', due: 'Dec 27, 2025', status: 'pending' }
                ]
            },
            'mobile-dev': {
                badge: 'CS 351',
                title: 'Mobile App Development',
                instructor: 'Prof. Tom Wilson',
                instructorTitle: 'Assistant Professor of Mobile Computing',
                avatar: 'TW',
                lessons: 26,
                duration: '40 Hours',
                students: 198,
                rating: '4.6 (112 reviews)',
                description: 'Build native and cross-platform mobile applications using modern frameworks. Learn iOS and Android development, UI/UX principles, and app deployment.',
                gradient: 'linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%)',
                curriculum: [
                    { number: 1, title: 'Mobile Development Intro', duration: '45 min', type: 'Video', status: 'completed' },
                    { number: 2, title: 'React Native Basics', duration: '1h 30min', type: 'Video', status: 'current' },
                    { number: 3, title: 'UI Components', duration: '1h 45min', type: 'Video', status: 'locked' },
                    { number: 4, title: 'Navigation', duration: '1h 20min', type: 'Video', status: 'locked' }
                ],
                assignments: [
                    { title: 'Build Todo App', due: 'Dec 24, 2025', status: 'pending' },
                    { title: 'Weather App Project', due: 'Jan 2, 2026', status: 'pending' }
                ]
            },
            'cloud-computing': {
                badge: 'CS 450',
                title: 'Cloud Computing & DevOps',
                instructor: 'Dr. Anna Lee',
                instructorTitle: 'Professor of Cloud Architecture',
                avatar: 'AL',
                lessons: 22,
                duration: '34 Hours',
                students: 167,
                rating: '4.7 (95 reviews)',
                description: 'Master cloud platforms (AWS, Azure, GCP), containerization, orchestration, CI/CD pipelines, and infrastructure as code for modern application deployment.',
                gradient: 'linear-gradient(135deg, #2afadf 0%, #4c83ff 100%)',
                curriculum: [
                    { number: 1, title: 'Cloud Computing Basics', duration: '1h 00min', type: 'Video', status: 'completed' },
                    { number: 2, title: 'AWS Services', duration: '1h 40min', type: 'Video', status: 'completed' },
                    { number: 3, title: 'Docker Containers', duration: '1h 30min', type: 'Video', status: 'completed' },
                    { number: 4, title: 'Kubernetes', duration: '2h 00min', type: 'Video', status: 'completed' }
                ],
                assignments: [
                    { title: 'Deploy App to AWS', due: 'Nov 10, 2025', status: 'graded' },
                    { title: 'Container Orchestration', due: 'Nov 25, 2025', status: 'graded' }
                ]
            }
        };

        // Open Course Detail Modal
        function openCourseDetail(courseId, status, progress) {
            const course = courseData[courseId];
            if (!course) return;

            const modal = document.getElementById('courseDetailModal');
            const header = document.getElementById('courseDetailHeader');
            
            // Set gradient background
            header.style.background = course.gradient;
            
            // Update header information
            document.getElementById('courseBadge').textContent = course.badge;
            document.getElementById('courseTitle').textContent = course.title;
            document.getElementById('instructorName').textContent = course.instructor;
            document.getElementById('instructorTitle').textContent = course.instructorTitle;
            document.getElementById('instructorAvatar').textContent = course.avatar;
            document.getElementById('instructorAvatar').style.background = course.gradient;
            document.getElementById('courseLessons').textContent = course.lessons + ' Lessons';
            document.getElementById('courseDuration').textContent = course.duration;
            document.getElementById('courseStudents').textContent = course.students + ' Students';
            document.getElementById('courseRating').textContent = course.rating;
            
            // Update progress
            document.getElementById('progressPercentageLarge').textContent = progress + '%';
            document.getElementById('progressFillLarge').style.width = progress + '%';
            
            const completedCount = Math.round((progress / 100) * course.lessons);
            document.getElementById('completedLessons').textContent = completedCount + '/' + course.lessons;
            document.getElementById('hoursSpent').textContent = Math.round((progress / 100) * parseInt(course.duration)) + 'h';
            document.getElementById('assignmentsCompleted').textContent = course.assignments.filter(a => a.status !== 'pending').length + '/' + course.assignments.length;
            document.getElementById('courseGrade').textContent = (75 + Math.random() * 15).toFixed(0) + '%';
            
            // Update description
            document.getElementById('courseDescription').textContent = course.description;
            
            // Load curriculum
            loadCurriculum(course.curriculum);
            
            // Load assignments
            loadAssignments(course.assignments);
            
            // Update main action button
            const mainBtn = document.getElementById('mainCourseActionBtn');
            if (status === 'completed') {
                mainBtn.innerHTML = '<i class="fas fa-redo"></i><span>Review Course</span>';
            } else {
                mainBtn.innerHTML = '<i class="fas fa-play"></i><span>Continue Learning</span>';
            }
            
            // Show modal
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        // Close Course Detail Modal
        function closeCourseDetail() {
            document.getElementById('courseDetailModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Close on outside click
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('courseDetailModal');
            if (event.target === modal) {
                closeCourseDetail();
            }
        });

        // Switch Course Tabs
        function switchCourseTab(tabName) {
            // Remove active class from all tabs and contents
            document.querySelectorAll('.course-tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.course-tab-content').forEach(content => content.classList.remove('active'));
            
            // Add active class to selected tab and content
            event.target.classList.add('active');
            document.getElementById(tabName + '-tab').classList.add('active');
        }

        // Load Curriculum
        function loadCurriculum(lessons) {
            const container = document.getElementById('lessonsList');
            container.innerHTML = '';
            
            lessons.forEach(lesson => {
                const statusIcon = lesson.status === 'completed' ? 'check-circle' : 
                                  lesson.status === 'current' ? 'play-circle' : 'lock';
                const statusText = lesson.status === 'completed' ? 'Completed' : 
                                  lesson.status === 'current' ? 'Continue' : 'Locked';
                const statusClass = lesson.status;
                
                const lessonHTML = `
                    <div class="lesson-item ${statusClass}" onclick="${lesson.status !== 'locked' ? 'startLesson(' + lesson.number + ')' : ''}">
                        <div class="lesson-number">${lesson.number}</div>
                        <div class="lesson-info">
                            <h4 class="lesson-title">${lesson.title}</h4>
                            <div class="lesson-meta">
                                <span><i class="fas fa-clock"></i> ${lesson.duration}</span>
                                <span><i class="fas fa-video"></i> ${lesson.type}</span>
                            </div>
                        </div>
                        <div class="lesson-status ${statusClass}">
                            <i class="fas fa-${statusIcon}"></i>
                            ${statusText}
                        </div>
                    </div>
                `;
                container.innerHTML += lessonHTML;
            });
        }

        // Load Assignments
        function loadAssignments(assignments) {
            const container = document.getElementById('assignmentsGrid');
            container.innerHTML = '';
            
            assignments.forEach(assignment => {
                const assignmentHTML = `
                    <div class="assignment-card">
                        <div class="assignment-header">
                            <span class="assignment-status-badge ${assignment.status}">${assignment.status.toUpperCase()}</span>
                        </div>
                        <h4 class="assignment-title">${assignment.title}</h4>
                        <div class="assignment-due">
                            <i class="fas fa-calendar-alt"></i>
                            Due: ${assignment.due}
                        </div>
                        <div class="assignment-actions">
                            <button class="assignment-btn primary" onclick="openAssignment('${assignment.title}')">
                                ${assignment.status === 'pending' ? '<i class="fas fa-upload"></i> Submit' : 
                                  assignment.status === 'submitted' ? '<i class="fas fa-eye"></i> View' : 
                                  '<i class="fas fa-file-download"></i> Download'}
                            </button>
                        </div>
                    </div>
                `;
                container.innerHTML += assignmentHTML;
            });
        }

        // Start Learning
        function startLearning() {
            showNotificationMessage('Redirecting to course player...', 'success');
            setTimeout(() => {
                closeCourseDetail();
                // In real application, redirect to course player page
                // window.location.href = '/course-player.php';
            }, 1000);
        }

        // Start Lesson
        function startLesson(lessonNumber) {
            showNotificationMessage('Loading lesson ' + lessonNumber + '...', 'success');
            setTimeout(() => {
                closeCourseDetail();
                // Redirect to lesson player
            }, 800);
        }

        // Open Assignment
        function openAssignment(title) {
            showNotificationMessage('Opening assignment: ' + title, 'info');
        }

        // Download Certificate
        function downloadCertificate(courseId) {
            const course = courseData[courseId];
            if (!course) return;
            
            showNotificationMessage('Generating certificate for ' + course.title + '...', 'success');
            
            setTimeout(() => {
                // Create certificate content
                const certificateContent = `CERTIFICATE OF COMPLETION

Course: ${course.title}
Course Code: ${course.badge}
Student Name: ${document.querySelector('.user-info h4')?.textContent || 'Student'}
Completion Date: ${new Date().toLocaleDateString()}
Instructor: ${course.instructor}

This certifies that the above-named student has successfully completed
the course requirements and demonstrated proficiency in the subject matter.

Grade: A (Excellent)
Credit Hours: ${parseInt(course.duration)}
Institution: EduPortal University

Generated on: ${new Date().toLocaleString()}`;

                const blob = new Blob([certificateContent], { type: 'text/plain' });
                const link = document.createElement('a');
                const url = URL.createObjectURL(blob);
                
                link.setAttribute('href', url);
                link.setAttribute('download', 'Certificate_' + courseId + '_' + new Date().getTime() + '.txt');
                link.style.visibility = 'hidden';
                
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                showNotificationMessage('Certificate downloaded successfully!', 'success');
            }, 1500);
        }

        // Continue Course - Main dashboard function
        function continueCourse(courseId, progress, lessonName) {
            // Show loading notification
            showNotificationMessage('Loading ' + lessonName + '...', 'info');
            
            // Animate the button
            event.target.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
            event.target.disabled = true;
            
            // Simulate loading and navigation
            setTimeout(() => {
                // Store progress in session/local storage
                localStorage.setItem('currentCourse', courseId);
                localStorage.setItem('currentLesson', lessonName);
                localStorage.setItem('courseProgress', progress);
                
                // Show success message
                showNotificationMessage('Redirecting to course player...', 'success');
                
                // In real application, redirect to course player
                setTimeout(() => {
                    // window.location.href = '/course-player.php?course=' + courseId + '&lesson=' + encodeURIComponent(lessonName);
                    // For demo, just show notification and reset button
                    showNotificationMessage('Course player would open here. Progress: ' + progress + '%', 'success');
                    event.target.innerHTML = '<i class="fas fa-play"></i> Continue Learning';
                    event.target.disabled = false;
                }, 1000);
            }, 800);
        }

        // Review Course
        function reviewCourse(courseId) {
            showNotificationMessage('Opening course review...', 'info');
            
            setTimeout(() => {
                // Open the course detail modal in review mode
                openCourseDetail(courseId, 'completed', 100);
            }, 500);
        }

        // Quick Access: Resume Last Course
        function resumeLastCourse() {
            const lastCourse = localStorage.getItem('currentCourse');
            const lastLesson = localStorage.getItem('currentLesson');
            const lastProgress = localStorage.getItem('courseProgress');
            
            if (lastCourse && lastLesson) {
                continueCourse(lastCourse, lastProgress || 0, lastLesson);
            } else {
                showNotificationMessage('No recent course found. Please select a course to start learning!', 'info');
            }
        }

        // Track Learning Time
        let learningStartTime = null;
        let learningTimerId = null;

        function startLearningTimer() {
            learningStartTime = new Date();
            
            // Update learning time every minute
            learningTimerId = setInterval(() => {
                if (learningStartTime) {
                    const timeSpent = Math.floor((new Date() - learningStartTime) / 60000); // minutes
                    console.log('Learning time:', timeSpent, 'minutes');
                    
                    // Update to server/database every 5 minutes
                    if (timeSpent > 0 && timeSpent % 5 === 0) {
                        updateLearningProgress(timeSpent);
                    }
                }
            }, 60000); // Check every minute
        }

        function stopLearningTimer() {
            if (learningTimerId) {
                clearInterval(learningTimerId);
                learningTimerId = null;
            }
            
            if (learningStartTime) {
                const timeSpent = Math.floor((new Date() - learningStartTime) / 60000);
                if (timeSpent > 0) {
                    updateLearningProgress(timeSpent);
                }
                learningStartTime = null;
            }
        }

        function updateLearningProgress(minutes) {
            // Send to server to update learning statistics
            console.log('Updating learning progress:', minutes, 'minutes');
            // In real app: fetch('/api/update-learning-time', { method: 'POST', body: JSON.stringify({ minutes }) });
        }

        // Auto-save course progress
        window.addEventListener('beforeunload', function() {
            stopLearningTimer();
        });

        // Initialize: Check for resume capability
        document.addEventListener('DOMContentLoaded', function() {
            const lastCourse = localStorage.getItem('currentCourse');
            if (lastCourse) {
                // Could show a "Resume Learning" banner or quick action button
                console.log('User has a course in progress:', lastCourse);
            }
            
            // Update transcript student info from session
            const studentName = document.querySelector('.user-info h4')?.textContent;
            const studentId = '<?php echo htmlspecialchars($_SESSION["student_id"] ?? "STU2023001"); ?>';
            
            if (document.getElementById('transcriptStudentName')) {
                document.getElementById('transcriptStudentName').textContent = studentName || 'Student';
            }
            if (document.getElementById('transcriptStudentId')) {
                document.getElementById('transcriptStudentId').textContent = studentId;
            }
        });

        // Transcript Functions
        function openTranscript() {
            const modal = document.getElementById('transcriptModal');
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
            
            // Close profile dropdown if open
            const profileDropdown = document.getElementById('profileDropdown');
            if (profileDropdown) {
                profileDropdown.classList.remove('show');
            }
            
            showNotificationMessage('Loading academic transcript...', 'info');
        }

        function closeTranscript() {
            const modal = document.getElementById('transcriptModal');
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Close transcript when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('transcriptModal');
            if (event.target === modal) {
                closeTranscript();
            }
        });

        // Print Transcript
        function printTranscript() {
            showNotificationMessage('Preparing transcript for printing...', 'info');
            
            setTimeout(() => {
                window.print();
            }, 500);
        }

        // Download Transcript as PDF
        function downloadTranscript() {
            showNotificationMessage('Generating PDF transcript...', 'info');
            
            setTimeout(() => {
                // Get student info
                const studentName = document.getElementById('transcriptStudentName')?.textContent || 'Student';
                const studentId = document.getElementById('transcriptStudentId')?.textContent || 'STU000';
                
                // Create transcript text content
                const transcriptContent = `
OFFICIAL ACADEMIC TRANSCRIPT
EduPortal University
Computer Science Department
================================================================================

STUDENT INFORMATION
Name: ${studentName}
Student ID: ${studentId}
Program: Bachelor of Science in Computer Science
Date of Birth: January 15, 2002
Matriculation Date: September 1, 2023
Expected Graduation: May 2027

================================================================================
FALL 2023
Credits: 16 | Semester GPA: 3.75

Course Code | Course Title                          | Credits | Grade | Points
------------|---------------------------------------|---------|-------|--------
CS 101      | Introduction to Programming           | 4       | A     | 4.0
CS 150      | Data Structures                       | 4       | A     | 4.0
MATH 201    | Calculus I                            | 4       | B+    | 3.3
ENG 110     | English Composition                   | 4       | A     | 4.0

================================================================================
SPRING 2024
Credits: 18 | Semester GPA: 3.85

Course Code | Course Title                          | Credits | Grade | Points
------------|---------------------------------------|---------|-------|--------
CS 201      | Algorithms & Analysis                 | 4       | A     | 4.0
CS 250      | Object-Oriented Programming           | 4       | A+    | 4.0
CS 270      | Computer Architecture                 | 4       | B+    | 3.3
MATH 202    | Calculus II                           | 4       | A     | 4.0
PHYS 101    | Physics I                             | 2       | B     | 3.0

================================================================================
FALL 2024
Credits: 16 | Semester GPA: 3.90

Course Code | Course Title                          | Credits | Grade | Points
------------|---------------------------------------|---------|-------|--------
CS 301      | Web Development Fundamentals          | 4       | A     | 4.0
CS 402      | Database Management Systems           | 4       | A     | 4.0
CS 450      | Operating Systems                     | 4       | A+    | 4.0
CS 351      | Mobile App Development                | 4       | B+    | 3.3

================================================================================
FALL 2025 (CURRENT SEMESTER)
Credits: 18 | Status: In Progress

Course Code | Course Title                          | Credits | Status
------------|---------------------------------------|---------|------------------
CS 501      | Machine Learning & AI                 | 4       | 75% Complete
CS 510      | Cloud Computing                       | 4       | 60% Complete
CS 520      | Software Engineering                  | 4       | 45% Complete
CS 530      | Cybersecurity Fundamentals            | 3       | 55% Complete
MATH 301    | Linear Algebra                        | 3       | 70% Complete

================================================================================
CUMULATIVE ACADEMIC SUMMARY

Cumulative GPA:         3.83
Credits Earned:         68
Credits In Progress:    18
Credits Required:       120
Degree Progress:        57%
Grade Average:          A-

================================================================================
GRADING SCALE
A+ (4.0)  | A (4.0)   | A- (3.7)
B+ (3.3)  | B (3.0)   | B- (2.7)
C+ (2.3)  | C (2.0)   | C- (1.7)
D+ (1.3)  | D (1.0)   | F (0.0)

================================================================================
NOTE:
This is an official academic transcript. All information is accurate as of 
${new Date().toLocaleDateString()} ${new Date().toLocaleTimeString()}.

For official purposes, please request a certified copy from the Registrar's 
Office.

Institution: EduPortal University
Address: 123 Education Street, Learning City, LC 12345
Phone: (555) 123-4567
Email: registrar@eduportal.edu

================================================================================
Generated: ${new Date().toLocaleString()}
Document ID: TR-${Date.now()}
`;

                // Create and download file
                const blob = new Blob([transcriptContent], { type: 'text/plain;charset=utf-8' });
                const link = document.createElement('a');
                const url = URL.createObjectURL(blob);
                
                link.setAttribute('href', url);
                link.setAttribute('download', 'Academic_Transcript_' + studentId + '_' + new Date().toISOString().split('T')[0] + '.txt');
                link.style.visibility = 'hidden';
                
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                showNotificationMessage('Transcript downloaded successfully!', 'success');
            }, 1500);
        }

        // Request Official Transcript (for email/mail delivery)
        function requestOfficialTranscript() {
            showNotificationMessage('Submitting official transcript request...', 'info');
            
            setTimeout(() => {
                showNotificationMessage('Request submitted! Official transcript will be sent within 3-5 business days.', 'success');
            }, 1000);
        }

        // Download grade report PDF function
        function downloadGradeReport() {
            
            showNotificationMessage('Generating grade report PDF...', 'info');
            
            setTimeout(function() {
                // Simulate PDF download
                const link = document.createElement('a');
                link.href = '#'; 
                link.download = 'Grade_Report_' + new Date().getTime() + '.pdf';
                showNotificationMessage('Grade report downloaded successfully!', 'success');
            }, 1500);
        }

        
        function showNotificationMessage(message, type) {
            
            const existingToast = document.getElementById('notificationToast');
            if (existingToast) {
                existingToast.remove();
            }
            
            // Create toast element
            const toast = document.createElement('div');
            toast.id = 'notificationToast';
            toast.style.cssText = `
                position: fixed;
                bottom: 30px;
                right: 30px;
                background: ${type === 'success' ? '#43e97b' : type === 'info' ? '#4facfe' : '#fa709a'};
                color: white;
                padding: 16px 24px;
                border-radius: 12px;
                box-shadow: 0 8px 32px rgba(0,0,0,0.2);
                z-index: 100000;
                font-size: 14px;
                font-weight: 500;
                animation: slideInUp 0.3s ease-out;
                max-width: 400px;
            `;
            
            
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideInUp {
                    from {
                        transform: translateY(100px);
                        opacity: 0;
                    }
                    to {
                        transform: translateY(0);
                        opacity: 1;
                    }
                }
                @keyframes slideOutDown {
                    from {
                        transform: translateY(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateY(100px);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
            
            // Add icon based on type
            const icon = type === 'success' ? '✓' : type === 'info' ? 'ℹ' : '!';
            toast.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : type === 'info' ? 'info-circle' : 'exclamation-circle'}"></i> ${message}`;
            
            document.body.appendChild(toast);
            
            // Auto remove after 3 seconds
            setTimeout(function() {
                toast.style.animation = 'slideOutDown 0.3s ease-out';
                setTimeout(function() {
                    toast.remove();
                }, 300);
            }, 3000);
        }

        // Calendar Integration Functions
        function getExamEventDetails() {
            return {
                title: 'Mathematics Final Examination',
                description: 'Final exam covering Linear Algebra, Calculus, Differential Equations, and Probability & Statistics. Total Marks: 100. Important: Bring Student ID, calculator (non-programmable), and stationery. Location: Room 301, Main Building',
                location: 'Room 301, Main Building',
                startDate: '20251220T100000',
                endDate: '20251220T120000',
                startDateISO: '2025-12-20T10:00:00',
                endDateISO: '2025-12-20T12:00:00',
                timezone: 'Asia/Karachi'
            };
        }

        // Add to Google Calendar
        function addToGoogleCalendar() {
            console.log('addToGoogleCalendar called');
            try {
                var event = getExamEventDetails();
                
                var googleCalendarUrl = 'https://calendar.google.com/calendar/render?action=TEMPLATE' +
                    '&text=' + encodeURIComponent(event.title) +
                    '&dates=' + event.startDate + 'Z/' + event.endDate + 'Z' +
                    '&details=' + encodeURIComponent(event.description) +
                    '&location=' + encodeURIComponent(event.location) +
                    '&sf=true&output=xml';
                
                console.log('Opening Google Calendar URL:', googleCalendarUrl);
                window.open(googleCalendarUrl, '_blank');
                showNotificationMessage('Opening Google Calendar...', 'success');
                return false;
            } catch (error) {
                console.error('Google Calendar Error:', error);
                alert('Error opening Google Calendar: ' + error.message);
                showNotificationMessage('Error opening Google Calendar', 'warning');
                return false;
            }
        }

        // Add to Outlook Calendar
        function addToOutlookCalendar() {
            console.log('addToOutlookCalendar called');
            try {
                var event = getExamEventDetails();
                
                var outlookUrl = 'https://outlook.live.com/calendar/0/deeplink/compose?' +
                    'subject=' + encodeURIComponent(event.title) +
                    '&startdt=' + encodeURIComponent(event.startDateISO) +
                    '&enddt=' + encodeURIComponent(event.endDateISO) +
                    '&body=' + encodeURIComponent(event.description) +
                    '&location=' + encodeURIComponent(event.location) +
                    '&path=/calendar/action/compose&rru=addevent';
                
                console.log('Opening Outlook Calendar URL:', outlookUrl);
                window.open(outlookUrl, '_blank');
                showNotificationMessage('Opening Outlook Calendar...', 'success');
                return false;
            } catch (error) {
                console.error('Outlook Calendar Error:', error);
                alert('Error opening Outlook Calendar: ' + error.message);
                showNotificationMessage('Error opening Outlook Calendar', 'warning');
                return false;
            }
        }

        // Add to Apple Calendar (Download ICS)
        function addToAppleCalendar() {
            console.log('addToAppleCalendar called');
            downloadICSFile();
            return false;
        }

        // Download ICS File (works for all calendar apps)
        function downloadICSFile() {
            console.log('downloadICSFile called');
            try {
                var event = getExamEventDetails();
                
                var now = new Date();
                var timestamp = now.toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z';
                
                // Create ICS content with proper escaping
                var icsLines = [
                    'BEGIN:VCALENDAR',
                    'VERSION:2.0',
                    'PRODID:-//Student Portal//Exam Schedule//EN',
                    'CALSCALE:GREGORIAN',
                    'METHOD:PUBLISH',
                    'X-WR-CALNAME:Exam Schedule',
                    'X-WR-TIMEZONE:' + event.timezone,
                    'BEGIN:VEVENT',
                    'UID:exam-' + timestamp + '@studentportal.edu',
                    'DTSTAMP:' + timestamp,
                    'DTSTART:' + event.startDate + 'Z',
                    'DTEND:' + event.endDate + 'Z',
                    'SUMMARY:' + event.title,
                    'DESCRIPTION:' + event.description.replace(/\n/g, '\\n'),
                    'LOCATION:' + event.location,
                    'STATUS:CONFIRMED',
                    'SEQUENCE:0',
                    'BEGIN:VALARM',
                    'TRIGGER:-PT30M',
                    'DESCRIPTION:Exam Reminder - 30 minutes before',
                    'ACTION:DISPLAY',
                    'END:VALARM',
                    'END:VEVENT',
                    'END:VCALENDAR'
                ];
                
                var icsContent = icsLines.join('\r\n');
                console.log('ICS Content created, length:', icsContent.length);

                // Create blob and download
                var blob = new Blob([icsContent], { type: 'text/calendar;charset=utf-8' });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'Mathematics_Final_Exam.ics';
                link.style.display = 'none';
                
                document.body.appendChild(link);
                console.log('Clicking download link...');
                link.click();
                
                // Clean up
                setTimeout(function() {
                    document.body.removeChild(link);
                    window.URL.revokeObjectURL(link.href);
                    console.log('Cleanup complete');
                }, 100);
                
                showNotificationMessage('Calendar file downloaded! Open it with your calendar app.', 'success');
                return false;
            } catch (error) {
                console.error('ICS Download Error:', error);
                alert('Error downloading calendar file: ' + error.message);
                showNotificationMessage('Error downloading calendar file', 'warning');
                return false;
            }
        }

        // Make functions globally accessible
        window.addToGoogleCalendar = addToGoogleCalendar;
        window.addToOutlookCalendar = addToOutlookCalendar;
        window.addToAppleCalendar = addToAppleCalendar;
        window.downloadICSFile = downloadICSFile;

        // Add event listeners when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Setting up calendar button event listeners...');
            
            // Google Calendar button
            var googleBtn = document.getElementById('googleCalBtn');
            if (googleBtn) {
                googleBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Google Calendar button clicked');
                    addToGoogleCalendar();
                });
                console.log('Google Calendar button listener added');
            } else {
                console.warn('Google Calendar button not found');
            }
            
            // Outlook Calendar button
            var outlookBtn = document.getElementById('outlookCalBtn');
            if (outlookBtn) {
                outlookBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Outlook Calendar button clicked');
                    addToOutlookCalendar();
                });
                console.log('Outlook Calendar button listener added');
            } else {
                console.warn('Outlook Calendar button not found');
            }
            
            // Apple Calendar button
            var appleBtn = document.getElementById('appleCalBtn');
            if (appleBtn) {
                appleBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Apple Calendar button clicked');
                    addToAppleCalendar();
                });
                console.log('Apple Calendar button listener added');
            } else {
                console.warn('Apple Calendar button not found');
            }
            
            // Download ICS button
            var downloadBtn = document.getElementById('downloadIcsBtn');
            if (downloadBtn) {
                downloadBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Download ICS button clicked');
                    downloadICSFile();
                });
                console.log('Download ICS button listener added');
            } else {
                console.warn('Download ICS button not found');
            }
            
            // Quick Add button in footer
            var quickBtn = document.getElementById('quickAddCalBtn');
            if (quickBtn) {
                quickBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Quick Add button clicked');
                    addToGoogleCalendar();
                });
                console.log('Quick Add button listener added');
            } else {
                console.warn('Quick Add button not found');
            }
            
            console.log('All calendar button listeners setup complete');
        });
    </script>

    <!-- Assignment Submission Detail Modal -->
    <div class="detail-modal" id="assignmentDetailModal">
        <div class="detail-modal-content">
            <div class="detail-modal-header">
                <h3><i class="fas fa-file-alt"></i> Assignment Submission Details</h3>
                <button class="detail-modal-close" onclick="closeDetailModal('assignmentDetailModal')">&times;</button>
            </div>
            <div class="detail-modal-body">
                <div class="detail-section">
                    <span class="detail-status-badge success"><i class="fas fa-check-circle"></i> Submitted</span>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-info-circle"></i> Assignment Information</h4>
                    <div class="detail-info-grid">
                        <div class="detail-info-item">
                            <div class="detail-info-label">Course</div>
                            <div class="detail-info-value">Web Development</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Assignment Title</div>
                            <div class="detail-info-value">Build a Responsive Website</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Due Date</div>
                            <div class="detail-info-value">Dec 20, 2025</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Submitted On</div>
                            <div class="detail-info-value">Dec 19, 2025 - 10:30 AM</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Status</div>
                            <div class="detail-info-value" style="color: #43e97b;">On Time</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Instructor</div>
                            <div class="detail-info-value">Dr. John Smith</div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-clipboard-list"></i> Assignment Description</h4>
                    <div class="detail-description">
                        Create a fully responsive website using HTML5, CSS3, and JavaScript. The website should include a homepage, about page, and contact form. Must be mobile-friendly and follow modern web design principles. Include animations and ensure cross-browser compatibility.
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-paperclip"></i> Submitted Files</h4>
                    <ul class="detail-file-list">
                        <li class="detail-file-item">
                            <div class="detail-file-icon">
                                <i class="fas fa-file-code"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">index.html</p>
                                <p class="detail-file-meta">HTML Document • 45 KB • Uploaded 5 mins ago</p>
                            </div>
                            <button class="detail-file-download" onclick="downloadFile('index.html', '#')"><i class="fas fa-download"></i> Download</button>
                        </li>
                        <li class="detail-file-item">
                            <div class="detail-file-icon">
                                <i class="fas fa-file-code"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">styles.css</p>
                                <p class="detail-file-meta">CSS Document • 28 KB • Uploaded 5 mins ago</p>
                            </div>
                            <button class="detail-file-download" onclick="downloadFile('styles.css', '#')"><i class="fas fa-download"></i> Download</button>
                        </li>
                        <li class="detail-file-item">
                            <div class="detail-file-icon">
                                <i class="fas fa-file-code"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">script.js</p>
                                <p class="detail-file-meta">JavaScript • 15 KB • Uploaded 5 mins ago</p>
                            </div>
                            <button class="detail-file-download" onclick="downloadFile('script.js', '#')"><i class="fas fa-download"></i> Download</button>
                        </li>
                    </ul>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-comment-dots"></i> Comments</h4>
                    <div class="detail-description">
                        I have completed all the requirements for this assignment. The website is fully responsive and tested on multiple devices and browsers. Please review and provide feedback.
                    </div>
                </div>
            </div>
            <div class="detail-modal-footer">
                <button class="detail-modal-btn secondary" onclick="closeDetailModal('assignmentDetailModal')">Close</button>
                <button class="detail-modal-btn primary" onclick="editSubmission('ASG001')"><i class="fas fa-edit"></i> Edit Submission</button>
            </div>
        </div>
    </div>

    <!-- Edit Submission Modal -->
    <div class="detail-modal" id="editSubmissionModal">
        <div class="detail-modal-content" style="max-width: 1000px; animation: modalSlideUp 0.4s ease-out;">
            <div class="detail-modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <h3><i class="fas fa-edit"></i> Edit Assignment Submission</h3>
                <button class="detail-modal-close" onclick="closeDetailModal('editSubmissionModal')" style="color: white; opacity: 0.9;">&times;</button>
            </div>
            <div class="detail-modal-body" style="max-height: calc(90vh - 180px); overflow-y: auto;">
                
                <!-- Status Banner -->
                <div class="detail-section" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); padding: 20px; border-radius: 15px; color: white; box-shadow: 0 4px 15px rgba(250,112,154,0.2);">
                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px);">
                                <i class="fas fa-edit" style="font-size: 28px;"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0 0 5px 0; font-size: 20px;">Editing Mode Active</h4>
                                <p style="margin: 0; font-size: 14px; opacity: 0.9;">Make changes to your submission before the deadline</p>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 5px;">Time Remaining</div>
                            <div style="font-size: 24px; font-weight: 700;">13h 30m</div>
                        </div>
                    </div>
                </div>

                <!-- Assignment Info Card -->
                <div class="detail-section" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 25px; border-radius: 15px; border: 2px solid #e0e0e0;">
                    <h4 style="margin: 0 0 20px 0; display: flex; align-items: center; gap: 10px; color: #667eea;">
                        <i class="fas fa-info-circle"></i> Assignment Details
                    </h4>
                    <input type="hidden" id="editAssignmentId" value="ASG001">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                        <div style="background: white; padding: 18px; border-radius: 12px; border-left: 4px solid #43e97b; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                            <div style="font-size: 12px; color: #999; text-transform: uppercase; font-weight: 600; margin-bottom: 8px;">
                                <i class="fas fa-book-open"></i> Course
                            </div>
                            <div style="font-size: 16px; font-weight: 600; color: #333;">Web Development</div>
                        </div>
                        <div style="background: white; padding: 18px; border-radius: 12px; border-left: 4px solid #4facfe; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                            <div style="font-size: 12px; color: #999; text-transform: uppercase; font-weight: 600; margin-bottom: 8px;">
                                <i class="fas fa-tasks"></i> Assignment
                            </div>
                            <div style="font-size: 16px; font-weight: 600; color: #333;">Build a Responsive Website</div>
                        </div>
                        <div style="background: white; padding: 18px; border-radius: 12px; border-left: 4px solid #fa709a; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                            <div style="font-size: 12px; color: #999; text-transform: uppercase; font-weight: 600; margin-bottom: 8px;">
                                <i class="fas fa-calendar-alt"></i> Due Date
                            </div>
                            <div style="font-size: 16px; font-weight: 600; color: #fa709a;">Dec 20, 2025</div>
                        </div>
                        <div style="background: white; padding: 18px; border-radius: 12px; border-left: 4px solid #667eea; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                            <div style="font-size: 12px; color: #999; text-transform: uppercase; font-weight: 600; margin-bottom: 8px;">
                                <i class="fas fa-user-tie"></i> Instructor
                            </div>
                            <div style="font-size: 16px; font-weight: 600; color: #333;">Dr. John Smith</div>
                        </div>
                    </div>
                </div>

                <!-- File Upload Zone -->
                <div class="detail-section">
                    <h4 style="margin: 0 0 15px 0; display: flex; align-items: center; gap: 10px; color: #667eea;">
                        <i class="fas fa-cloud-upload-alt"></i> File Management
                    </h4>
                    
                    <!-- Drag and Drop Zone -->
                    <div id="dropZone" style="border: 3px dashed #cbd5e0; border-radius: 15px; padding: 40px; text-align: center; background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%); cursor: pointer; transition: all 0.3s ease; margin-bottom: 20px;"
                         onclick="document.getElementById('editFileUpload').click()"
                         ondragover="event.preventDefault(); this.style.borderColor='#667eea'; this.style.background='linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%)'; this.style.transform='scale(1.02)';"
                         ondragleave="this.style.borderColor='#cbd5e0'; this.style.background='linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%)'; this.style.transform='scale(1)';"
                         ondrop="handleFileDrop(event); this.style.borderColor='#cbd5e0'; this.style.background='linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%)'; this.style.transform='scale(1)';">
                        <div style="font-size: 64px; color: #667eea; margin-bottom: 15px;">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <h4 style="margin: 0 0 10px 0; color: #333; font-size: 20px;">Drop files here or click to browse</h4>
                        <p style="margin: 0; color: #718096; font-size: 14px;">Supports: HTML, CSS, JS, PDF, DOC, DOCX, ZIP (Max 50MB per file)</p>
                        <input type="file" id="editFileUpload" style="display: none;" onchange="handleFileSelection()" multiple accept=".html,.css,.js,.pdf,.doc,.docx,.zip,.rar">
                    </div>

                    <!-- Current Files List -->
                    <div style="background: white; padding: 20px; border-radius: 15px; border: 2px solid #e0e0e0;">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                            <h5 style="margin: 0; color: #333; font-size: 16px;">
                                <i class="fas fa-folder-open"></i> Submitted Files (<span id="fileCount">3</span>)
                            </h5>
                            <button onclick="clearAllFiles()" style="background: none; border: 1px solid #fa709a; color: #fa709a; padding: 8px 16px; border-radius: 8px; cursor: pointer; font-size: 13px; transition: all 0.3s ease;">
                                <i class="fas fa-trash-alt"></i> Clear All
                            </button>
                        </div>
                        <ul class="detail-file-list" id="editFileList" style="max-height: 300px; overflow-y: auto;">
                            <li class="detail-file-item" style="animation: slideInLeft 0.3s ease-out;">
                                <div class="detail-file-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                    <i class="fas fa-file-code"></i>
                                </div>
                                <div class="detail-file-info">
                                    <p class="detail-file-name">index.html</p>
                                    <p class="detail-file-meta">HTML Document • 45 KB • Uploaded 5 mins ago</p>
                                </div>
                                <button class="detail-file-download" onclick="removeFile(this)" style="background: #fa709a; transition: all 0.3s ease;" onmouseover="this.style.background='#e5637c'" onmouseout="this.style.background='#fa709a'">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </li>
                            <li class="detail-file-item" style="animation: slideInLeft 0.4s ease-out;">
                                <div class="detail-file-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                    <i class="fas fa-file-code"></i>
                                </div>
                                <div class="detail-file-info">
                                    <p class="detail-file-name">styles.css</p>
                                    <p class="detail-file-meta">CSS Document • 28 KB • Uploaded 5 mins ago</p>
                                </div>
                                <button class="detail-file-download" onclick="removeFile(this)" style="background: #fa709a; transition: all 0.3s ease;" onmouseover="this.style.background='#e5637c'" onmouseout="this.style.background='#fa709a'">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </li>
                            <li class="detail-file-item" style="animation: slideInLeft 0.5s ease-out;">
                                <div class="detail-file-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <i class="fas fa-file-code"></i>
                                </div>
                                <div class="detail-file-info">
                                    <p class="detail-file-name">script.js</p>
                                    <p class="detail-file-meta">JavaScript • 15 KB • Uploaded 5 mins ago</p>
                                </div>
                                <button class="detail-file-download" onclick="removeFile(this)" style="background: #fa709a; transition: all 0.3s ease;" onmouseover="this.style.background='#e5637c'" onmouseout="this.style.background='#fa709a'">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="detail-section">
                    <h4 style="margin: 0 0 15px 0; display: flex; align-items: center; gap: 10px; color: #667eea;">
                        <i class="fas fa-comment-dots"></i> Submission Notes
                    </h4>
                    <div style="background: white; padding: 20px; border-radius: 15px; border: 2px solid #e0e0e0;">
                        <label style="display: block; margin-bottom: 10px; color: #666; font-size: 14px; font-weight: 600;">
                            <i class="fas fa-pen"></i> Describe your changes or updates (Required)
                        </label>
                        <textarea 
                            id="editComments" 
                            style="width: 100%; min-height: 140px; padding: 18px; border: 2px solid #e0e0e0; border-radius: 12px; font-family: 'Segoe UI', sans-serif; font-size: 14px; line-height: 1.8; resize: vertical; transition: all 0.3s ease; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);"
                            placeholder="Example: Updated the navigation menu, fixed responsive issues on mobile devices, added form validation to the contact page..."
                            onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='inset 0 2px 4px rgba(0,0,0,0.05), 0 0 0 4px rgba(102,126,234,0.1)';"
                            onblur="this.style.borderColor='#e0e0e0'; this.style.boxShadow='inset 0 2px 4px rgba(0,0,0,0.05)';"
                        ></textarea>
                        <div style="margin-top: 10px; font-size: 13px; color: #999;">
                            <i class="fas fa-lightbulb"></i> <span id="charCount">0</span> characters • Be specific about what you changed
                        </div>
                    </div>
                </div>

                <!-- Guidelines Card -->
                <div class="detail-section" style="background: linear-gradient(135deg, #fff5e6 0%, #ffe5cc 100%); padding: 25px; border-radius: 15px; border-left: 5px solid #ff9800; box-shadow: 0 4px 15px rgba(255,152,0,0.1);">
                    <h4 style="margin: 0 0 15px 0; color: #e67e00; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-exclamation-triangle"></i> Submission Guidelines
                    </h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <i class="fas fa-check-circle" style="color: #43e97b; font-size: 20px; margin-top: 2px;"></i>
                            <div>
                                <strong style="color: #333; display: block; margin-bottom: 3px;">Edit Until Deadline</strong>
                                <span style="color: #666; font-size: 13px;">Changes allowed before due date</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <i class="fas fa-sync-alt" style="color: #4facfe; font-size: 20px; margin-top: 2px;"></i>
                            <div>
                                <strong style="color: #333; display: block; margin-bottom: 3px;">Version Control</strong>
                                <span style="color: #666; font-size: 13px;">Previous files will be replaced</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <i class="fas fa-file-archive" style="color: #667eea; font-size: 20px; margin-top: 2px;"></i>
                            <div>
                                <strong style="color: #333; display: block; margin-bottom: 3px;">File Size Limit</strong>
                                <span style="color: #666; font-size: 13px;">Maximum 50 MB per file</span>
                            </div>
                        </div>
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <i class="fas fa-file-alt" style="color: #fa709a; font-size: 20px; margin-top: 2px;"></i>
                            <div>
                                <strong style="color: #333; display: block; margin-bottom: 3px;">Supported Formats</strong>
                                <span style="color: #666; font-size: 13px;">HTML, CSS, JS, PDF, DOC, ZIP</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Enhanced Footer -->
            <div class="detail-modal-footer" style="background: #f8f9fa; border-top: 2px solid #e0e0e0; padding: 20px 30px; display: flex; gap: 15px; justify-content: space-between; align-items: center;">
                <div style="font-size: 13px; color: #666;">
                    <i class="fas fa-shield-alt"></i> Your work is automatically saved as draft
                </div>
                <div style="display: flex; gap: 12px;">
                    <button class="detail-modal-btn secondary" onclick="closeDetailModal('editSubmissionModal')" style="padding: 12px 28px; font-size: 15px;">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button class="detail-modal-btn primary" onclick="submitEditedAssignment()" style="padding: 12px 32px; font-size: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 4px 15px rgba(102,126,234,0.3);">
                        <i class="fas fa-paper-plane"></i> Update Submission
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Material Detail Modal -->
    <div class="detail-modal" id="materialDetailModal">
        <div class="detail-modal-content">
            <div class="detail-modal-header">
                <h3><i class="fas fa-book"></i> Course Material Details</h3>
                <button class="detail-modal-close" onclick="closeDetailModal('materialDetailModal')">&times;</button>
            </div>
            <div class="detail-modal-body">
                <div class="detail-section">
                    <span class="detail-status-badge info"><i class="fas fa-info-circle"></i> New Material</span>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-info-circle"></i> Material Information</h4>
                    <div class="detail-info-grid">
                        <div class="detail-info-item">
                            <div class="detail-info-label">Course</div>
                            <div class="detail-info-value">Database Management</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Chapter</div>
                            <div class="detail-info-value">Chapter 5</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Topic</div>
                            <div class="detail-info-value">SQL Advanced Queries</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Uploaded By</div>
                            <div class="detail-info-value">Dr. Smith</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Upload Date</div>
                            <div class="detail-info-value">Dec 19, 2025</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Material Type</div>
                            <div class="detail-info-value">Lecture Notes & Slides</div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-align-left"></i> Description</h4>
                    <div class="detail-description">
                        This material covers advanced SQL queries including JOINs, subqueries, aggregation functions, window functions, and complex query optimization techniques. Students should review this before tomorrow's class. Practice exercises are included in the PDF.
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-file-pdf"></i> Available Materials</h4>
                    <ul class="detail-file-list">
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">Chapter5_SQLAdvanced_Lecture.pdf</p>
                                <p class="detail-file-meta">PDF Document • 2.5 MB • 35 pages</p>
                            </div>
                            <button class="detail-file-download"><i class="fas fa-eye"></i> View</button>
                        </li>
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                                <i class="fas fa-file-powerpoint"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">SQL_Advanced_Slides.pptx</p>
                                <p class="detail-file-meta">PowerPoint • 4.2 MB • 48 slides</p>
                            </div>
                            <button class="detail-file-download"><i class="fas fa-eye"></i> View</button>
                        </li>
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                <i class="fas fa-file-code"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">practice_queries.sql</p>
                                <p class="detail-file-meta">SQL File • 15 KB • Practice exercises</p>
                            </div>
                            <button class="detail-file-download" onclick="downloadFile('practice_queries.sql', '#')"><i class="fas fa-download"></i> Download</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="detail-modal-footer">
                <button class="detail-modal-btn secondary" onclick="closeDetailModal('materialDetailModal')">Close</button>
                <button class="detail-modal-btn primary" onclick="showNotificationMessage('Downloading all course materials...', 'success')"><i class="fas fa-download"></i> Download All</button>
            </div>
        </div>
    </div>

    <!-- Exam Details Modal -->
    <div class="detail-modal" id="examDetailModal">
        <div class="detail-modal-content">
            <div class="detail-modal-header">
                <h3><i class="fas fa-calendar-check"></i> Exam Details</h3>
                <button class="detail-modal-close" onclick="closeDetailModal('examDetailModal')">&times;</button>
            </div>
            <div class="detail-modal-body">
                <div class="detail-section">
                    <span class="detail-status-badge warning"><i class="fas fa-exclamation-triangle"></i> Upcoming Exam</span>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-info-circle"></i> Exam Information</h4>
                    <div class="detail-info-grid">
                        <div class="detail-info-item">
                            <div class="detail-info-label">Course</div>
                            <div class="detail-info-value">Mathematics</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Exam Type</div>
                            <div class="detail-info-value">Final Examination</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Date</div>
                            <div class="detail-info-value">December 20, 2025</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Time</div>
                            <div class="detail-info-value">10:00 AM - 12:00 PM</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Duration</div>
                            <div class="detail-info-value">2 Hours</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Location</div>
                            <div class="detail-info-value">Room 301, Main Building</div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-clipboard-list"></i> Exam Details</h4>
                    <div class="detail-description">
                        <p style="margin: 0 0 15px 0;"><strong>Topics Covered:</strong></p>
                        <ul style="margin: 0; padding-left: 20px; line-height: 1.8;">
                            <li>Linear Algebra (Matrices, Determinants, Eigenvalues)</li>
                            <li>Calculus (Derivatives, Integrals, Applications)</li>
                            <li>Differential Equations</li>
                            <li>Probability and Statistics</li>
                        </ul>
                        <p style="margin: 15px 0 0 0;"><strong>Total Marks:</strong> 100</p>
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-exclamation-circle"></i> Important Instructions</h4>
                    <div class="detail-description">
                        <ul style="margin: 0; padding-left: 20px; line-height: 1.8;">
                            <li>Arrive 15 minutes before the exam starts</li>
                            <li>Bring your Student ID card (mandatory)</li>
                            <li>Calculators are allowed (non-programmable only)</li>
                            <li>No mobile phones or electronic devices</li>
                            <li>Bring your own stationery (pens, pencils, eraser)</li>
                        </ul>
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-book-open"></i> Study Materials</h4>
                    <ul class="detail-file-list">
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">Mathematics_Final_StudyGuide.pdf</p>
                                <p class="detail-file-meta">PDF Document • 3.8 MB</p>
                            </div>
                            <button class="detail-file-download" onclick="downloadFile('Mathematics_Final_StudyGuide.pdf', '#')"><i class="fas fa-download"></i> Download</button>
                        </li>
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">Practice_Problems.pdf</p>
                                <p class="detail-file-meta">PDF Document • 1.2 MB</p>
                            </div>
                            <button class="detail-file-download" onclick="downloadFile('Practice_Problems.pdf', '#')"><i class="fas fa-download"></i> Download</button>
                        </li>
                    </ul>
                </div>

                <!-- Add to Calendar Section -->
                <div class="detail-section" style="background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%); padding: 25px; border-radius: 15px; border-left: 5px solid #00acc1;">
                    <h4 style="margin: 0 0 20px 0; color: #00838f; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-calendar-plus"></i> Add to Your Calendar
                    </h4>
                    <p style="margin: 0 0 20px 0; color: #00695c; font-size: 14px; line-height: 1.6;">
                        Never miss this exam! Add it to your preferred calendar application with one click. 
                        The event includes exam details, location, and a reminder 30 minutes before.
                    </p>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
                        <button type="button" id="googleCalBtn" style="background: linear-gradient(135deg, #4285f4 0%, #3367d6 100%); color: white; border: none; padding: 14px 20px; border-radius: 12px; cursor: pointer; font-size: 14px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 10px; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(66,133,244,0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(66,133,244,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(66,133,244,0.3)'">
                            <i class="fab fa-google"></i> Google Calendar
                        </button>
                        <button type="button" id="outlookCalBtn" style="background: linear-gradient(135deg, #0078d4 0%, #005a9e 100%); color: white; border: none; padding: 14px 20px; border-radius: 12px; cursor: pointer; font-size: 14px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 10px; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0,120,212,0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,120,212,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,120,212,0.3)'">
                            <i class="fab fa-microsoft"></i> Outlook
                        </button>
                        <button type="button" id="appleCalBtn" style="background: linear-gradient(135deg, #555555 0%, #333333 100%); color: white; border: none; padding: 14px 20px; border-radius: 12px; cursor: pointer; font-size: 14px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 10px; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.3)'">
                            <i class="fab fa-apple"></i> Apple Calendar
                        </button>
                        <button type="button" id="downloadIcsBtn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 14px 20px; border-radius: 12px; cursor: pointer; font-size: 14px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 10px; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(102,126,234,0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(102,126,234,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(102,126,234,0.3)'">
                            <i class="fas fa-download"></i> Download .ics
                        </button>
                    </div>
                    <div style="margin-top: 15px; padding: 15px; background: rgba(255,255,255,0.6); border-radius: 10px; display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-bell" style="font-size: 20px; color: #ff9800;"></i>
                        <div style="font-size: 13px; color: #555; line-height: 1.6;">
                            <strong>Auto Reminder:</strong> You'll receive a notification 30 minutes before the exam starts.
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail-modal-footer">
                <button class="detail-modal-btn secondary" onclick="closeDetailModal('examDetailModal')">Close</button>
                <button type="button" class="detail-modal-btn primary" id="quickAddCalBtn"><i class="fas fa-calendar-plus"></i> Quick Add to Calendar</button>
            </div>
        </div>
    </div>

    <!-- Grade Details Modal -->
    <div class="detail-modal" id="gradeDetailModal">
        <div class="detail-modal-content">
            <div class="detail-modal-header">
                <h3><i class="fas fa-chart-line"></i> Grade Details</h3>
                <button class="detail-modal-close" onclick="closeDetailModal('gradeDetailModal')">&times;</button>
            </div>
            <div class="detail-modal-body">
                <div class="detail-section">
                    <div class="grade-display">
                        <h2>92/100</h2>
                        <p>Excellent Performance! Grade: A</p>
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-info-circle"></i> Exam Information</h4>
                    <div class="detail-info-grid">
                        <div class="detail-info-item">
                            <div class="detail-info-label">Course</div>
                            <div class="detail-info-value">Computer Science</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Exam Type</div>
                            <div class="detail-info-value">Midterm Examination</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Exam Date</div>
                            <div class="detail-info-value">Dec 15, 2025</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Posted On</div>
                            <div class="detail-info-value">Dec 18, 2025</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Instructor</div>
                            <div class="detail-info-value">Prof. Johnson</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Class Average</div>
                            <div class="detail-info-value">78/100</div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-clipboard-list"></i> Score Breakdown</h4>
                    <ul class="detail-file-list">
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">Multiple Choice Questions</p>
                                <p class="detail-file-meta">Section A • 25 questions</p>
                            </div>
                            <div style="font-size: 18px; font-weight: 700; color: #43e97b;">23/25</div>
                        </li>
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">Short Answer Questions</p>
                                <p class="detail-file-meta">Section B • 5 questions</p>
                            </div>
                            <div style="font-size: 18px; font-weight: 700; color: #4facfe;">28/30</div>
                        </li>
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">Essay Questions</p>
                                <p class="detail-file-meta">Section C • 2 questions</p>
                            </div>
                            <div style="font-size: 18px; font-weight: 700; color: #667eea;">41/45</div>
                        </li>
                    </ul>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-comment-dots"></i> Instructor Feedback</h4>
                    <div class="detail-description">
                        <p style="margin: 0 0 12px 0;"><strong>Strengths:</strong></p>
                        <ul style="margin: 0 0 15px 0; padding-left: 20px; line-height: 1.8;">
                            <li>Excellent understanding of data structures and algorithms</li>
                            <li>Clear and well-structured answers</li>
                            <li>Strong problem-solving skills demonstrated</li>
                        </ul>
                        <p style="margin: 0 0 12px 0;"><strong>Areas for Improvement:</strong></p>
                        <ul style="margin: 0; padding-left: 20px; line-height: 1.8;">
                            <li>Time complexity analysis could be more detailed</li>
                            <li>Consider adding more code comments in programming questions</li>
                        </ul>
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-chart-bar"></i> Performance Statistics</h4>
                    <div class="detail-info-grid">
                        <div class="detail-info-item" style="border-left-color: #43e97b;">
                            <div class="detail-info-label">Your Rank</div>
                            <div class="detail-info-value" style="color: #43e97b;">5th / 45 Students</div>
                        </div>
                        <div class="detail-info-item" style="border-left-color: #4facfe;">
                            <div class="detail-info-label">Percentile</div>
                            <div class="detail-info-value" style="color: #4facfe;">89th Percentile</div>
                        </div>
                        <div class="detail-info-item" style="border-left-color: #667eea;">
                            <div class="detail-info-label">Grade Point</div>
                            <div class="detail-info-value" style="color: #667eea;">4.0 / 4.0</div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-file-download"></i> Download Options</h4>
                    <ul class="detail-file-list">
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">Grade Report (Official)</p>
                                <p class="detail-file-meta">PDF Document • Includes detailed breakdown</p>
                            </div>
                            <button class="detail-file-download" onclick="downloadGradeReport()"><i class="fas fa-download"></i> Download</button>
                        </li>
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">Answer Sheet</p>
                                <p class="detail-file-meta">PDF Document • Your submitted answers</p>
                            </div>
                            <button class="detail-file-download" onclick="viewFile('Answer_Sheet.pdf', '#')"><i class="fas fa-eye"></i> View</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="detail-modal-footer">
                <button class="detail-modal-btn secondary" onclick="closeDetailModal('gradeDetailModal')">Close</button>
                <button class="detail-modal-btn primary" onclick="printGradeReport()"><i class="fas fa-print"></i> Print Grade Report</button>
            </div>
        </div>
    </div>

    <!-- Attendance Record Modal -->
    <div class="detail-modal" id="attendanceDetailModal">
        <div class="detail-modal-content">
            <div class="detail-modal-header">
                <h3><i class="fas fa-calendar-check"></i> Attendance Record</h3>
                <button class="detail-modal-close" onclick="closeDetailModal('attendanceDetailModal')">&times;</button>
            </div>
            <div class="detail-modal-body">
                <div class="detail-section">
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 20px;">
                        <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); padding: 25px; border-radius: 12px; text-align: center; color: white;">
                            <h2 style="margin: 0 0 5px 0; font-size: 36px;">42</h2>
                            <p style="margin: 0; opacity: 0.9;">Present</p>
                        </div>
                        <div style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); padding: 25px; border-radius: 12px; text-align: center; color: white;">
                            <h2 style="margin: 0 0 5px 0; font-size: 36px;">3</h2>
                            <p style="margin: 0; opacity: 0.9;">Absent</p>
                        </div>
                        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 25px; border-radius: 12px; text-align: center; color: white;">
                            <h2 style="margin: 0 0 5px 0; font-size: 36px;">93.3%</h2>
                            <p style="margin: 0; opacity: 0.9;">Total</p>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-info-circle"></i> Course Information</h4>
                    <div class="detail-info-grid">
                        <div class="detail-info-item">
                            <div class="detail-info-label">Course</div>
                            <div class="detail-info-value">Physics (PHY301)</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Instructor</div>
                            <div class="detail-info-value">Dr. Sarah Williams</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Total Classes</div>
                            <div class="detail-info-value">45 Sessions</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Semester</div>
                            <div class="detail-info-value">Fall 2025</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Required Attendance</div>
                            <div class="detail-info-value">75% Minimum</div>
                        </div>
                        <div class="detail-info-item">
                            <div class="detail-info-label">Status</div>
                            <div class="detail-info-value" style="color: #43e97b; font-weight: 700;">✓ Meets Requirement</div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-calendar-alt"></i> Recent Attendance History</h4>
                    <ul class="detail-file-list">
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">December 19, 2025 - Thursday</p>
                                <p class="detail-file-meta">Lecture: Quantum Mechanics • 10:00 AM - 11:30 AM</p>
                            </div>
                            <span class="detail-status-badge success">Present</span>
                        </li>
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">December 17, 2025 - Tuesday</p>
                                <p class="detail-file-meta">Lab Session: Optics Experiment • 2:00 PM - 4:00 PM</p>
                            </div>
                            <span class="detail-status-badge success">Present</span>
                        </li>
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">December 15, 2025 - Sunday</p>
                                <p class="detail-file-meta">Lecture: Thermodynamics • 10:00 AM - 11:30 AM</p>
                            </div>
                            <span class="detail-status-badge success">Present</span>
                        </li>
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">December 12, 2025 - Thursday</p>
                                <p class="detail-file-meta">Lecture: Electromagnetism • 10:00 AM - 11:30 AM</p>
                            </div>
                            <span class="detail-status-badge warning">Absent</span>
                        </li>
                        <li class="detail-file-item">
                            <div class="detail-file-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="detail-file-info">
                                <p class="detail-file-name">December 10, 2025 - Tuesday</p>
                                <p class="detail-file-meta">Lab Session: Mechanics • 2:00 PM - 4:00 PM</p>
                            </div>
                            <span class="detail-status-badge success">Present</span>
                        </li>
                    </ul>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-exclamation-circle"></i> Important Note</h4>
                    <div class="detail-description">
                        <p style="margin: 0; line-height: 1.6;">
                            Your current attendance rate is <strong style="color: #43e97b;">93.3%</strong>, which exceeds the minimum required attendance of 75%. 
                            Keep up the good work! Remember that consistent attendance is crucial for academic success. 
                            If you have any valid reasons for absence, please submit a leave application through the student portal.
                        </p>
                    </div>
                </div>

                <div class="detail-section">
                    <h4><i class="fas fa-chart-pie"></i> Monthly Breakdown</h4>
                    <div class="detail-info-grid">
                        <div class="detail-info-item" style="border-left-color: #43e97b;">
                            <div class="detail-info-label">September</div>
                            <div class="detail-info-value" style="color: #43e97b;">12/12 (100%)</div>
                        </div>
                        <div class="detail-info-item" style="border-left-color: #43e97b;">
                            <div class="detail-info-label">October</div>
                            <div class="detail-info-value" style="color: #43e97b;">14/14 (100%)</div>
                        </div>
                        <div class="detail-info-item" style="border-left-color: #fa709a;">
                            <div class="detail-info-label">November</div>
                            <div class="detail-info-value" style="color: #fa709a;">8/10 (80%)</div>
                        </div>
                        <div class="detail-info-item" style="border-left-color: #4facfe;">
                            <div class="detail-info-label">December</div>
                            <div class="detail-info-value" style="color: #4facfe;">8/9 (88.9%)</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail-modal-footer">
                <button class="detail-modal-btn secondary" onclick="closeDetailModal('attendanceDetailModal')">Close</button>
                <button class="detail-modal-btn primary" onclick="downloadAttendanceReport()"><i class="fas fa-download"></i> Download Full Report</button>
            </div>
        </div>
    </div>

    <!-- All Courses Modal -->
    <div class="all-courses-modal" id="allCoursesModal">
        <div class="all-courses-modal-content">
            <div class="all-courses-modal-header">
                <h2>
                    <i class="fas fa-graduation-cap"></i>
                    My Courses Library
                </h2>
                <button class="all-courses-modal-close" onclick="closeAllCoursesModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="all-courses-toolbar">
                <div class="courses-search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search courses by name, instructor, or code..." id="courseSearchInput" onkeyup="filterCourses()">
                </div>

                <div class="courses-filter-group">
                    <span class="filter-label">Status:</span>
                    <select class="filter-select" id="statusFilter" onchange="filterCourses()">
                        <option value="all">All Courses</option>
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                        <option value="upcoming">Upcoming</option>
                    </select>
                </div>

                <div class="courses-filter-group">
                    <span class="filter-label">Sort by:</span>
                    <select class="filter-select" id="sortFilter" onchange="sortCourses()">
                        <option value="name">Name</option>
                        <option value="progress">Progress</option>
                        <option value="date">Date Added</option>
                        <option value="instructor">Instructor</option>
                    </select>
                </div>

                <div class="view-toggle">
                    <button class="view-toggle-btn active" onclick="toggleView('grid')" id="gridViewBtn">
                        <i class="fas fa-th"></i>
                    </button>
                    <button class="view-toggle-btn" onclick="toggleView('list')" id="listViewBtn">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>

            <div class="all-courses-modal-body">
                <!-- Stats Bar -->
                <div class="courses-stats-bar">
                    <div class="courses-stat-item">
                        <div class="courses-stat-icon purple">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="courses-stat-info">
                            <h4>6</h4>
                            <p>Total Courses</p>
                        </div>
                    </div>
                    <div class="courses-stat-item">
                        <div class="courses-stat-icon blue">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        <div class="courses-stat-info">
                            <h4>4</h4>
                            <p>In Progress</p>
                        </div>
                    </div>
                    <div class="courses-stat-item">
                        <div class="courses-stat-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="courses-stat-info">
                            <h4>2</h4>
                            <p>Completed</p>
                        </div>
                    </div>
                    <div class="courses-stat-item">
                        <div class="courses-stat-icon orange">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="courses-stat-info">
                            <h4>62%</h4>
                            <p>Avg Progress</p>
                        </div>
                    </div>
                </div>

                <!-- Grid View -->
                <div class="courses-grid active" id="coursesGrid">
                    <!-- Course Card 1 -->
                    <div class="course-card" data-course="web-development" data-status="active" data-progress="75">
                        <div class="course-card-banner" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <span class="course-card-category">CS 301</span>
                            <button class="course-card-favorite">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <div class="course-card-content">
                            <h3 class="course-card-title">Web Development Fundamentals</h3>
                            <div class="course-card-instructor">
                                <div class="instructor-avatar">JS</div>
                                <span class="instructor-name">Prof. John Smith</span>
                            </div>
                            <div class="course-card-meta">
                                <div class="course-card-meta-item">
                                    <i class="fas fa-book-open"></i>
                                    <span>24 Lessons</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>36 Hours</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>245 Students</span>
                                </div>
                            </div>
                            <div class="course-card-progress-section">
                                <div class="course-card-progress-header">
                                    <span class="course-card-progress-label">Progress</span>
                                    <span class="course-card-progress-percent">75%</span>
                                </div>
                                <div class="course-card-progress-bar">
                                    <div class="course-card-progress-fill" style="width: 75%;"></div>
                                </div>
                            </div>
                            <div class="course-card-footer">
                                <button class="course-card-btn primary" onclick="openCourseDetail('web-development', 'active', 75)">
                                    <i class="fas fa-play"></i>
                                    <span>Continue</span>
                                </button>
                                <button class="course-card-btn secondary" onclick="openCourseDetail('web-development', 'active', 75)">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Course Card 2 -->
                    <div class="course-card" data-course="database-systems" data-status="active" data-progress="60">
                        <div class="course-card-banner" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                            <span class="course-card-category">CS 402</span>
                            <button class="course-card-favorite">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="course-card-content">
                            <h3 class="course-card-title">Advanced Database Systems</h3>
                            <div class="course-card-instructor">
                                <div class="instructor-avatar" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">MJ</div>
                                <span class="instructor-name">Dr. Mary Johnson</span>
                            </div>
                            <div class="course-card-meta">
                                <div class="course-card-meta-item">
                                    <i class="fas fa-book-open"></i>
                                    <span>18 Lessons</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>28 Hours</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>189 Students</span>
                                </div>
                            </div>
                            <div class="course-card-progress-section">
                                <div class="course-card-progress-header">
                                    <span class="course-card-progress-label">Progress</span>
                                    <span class="course-card-progress-percent">60%</span>
                                </div>
                                <div class="course-card-progress-bar">
                                    <div class="course-card-progress-fill" style="width: 60%; background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);"></div>
                                </div>
                            </div>
                            <div class="course-card-footer">
                                <button class="course-card-btn primary" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);" onclick="openCourseDetail('database-systems', 'active', 60)">
                                    <i class="fas fa-play"></i>
                                    <span>Continue</span>
                                </button>
                                <button class="course-card-btn secondary" onclick="openCourseDetail('database-systems', 'active', 60)">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Course Card 3 -->
                    <div class="course-card" data-course="data-structures" data-status="completed" data-progress="100">
                        <div class="course-card-banner" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                            <span class="course-card-category">CS 201</span>
                            <button class="course-card-favorite">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <div class="course-card-content">
                            <h3 class="course-card-title">Data Structures & Algorithms</h3>
                            <div class="course-card-instructor">
                                <div class="instructor-avatar" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">RB</div>
                                <span class="instructor-name">Prof. Robert Brown</span>
                            </div>
                            <div class="course-card-meta">
                                <div class="course-card-meta-item">
                                    <i class="fas fa-book-open"></i>
                                    <span>32 Lessons</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>48 Hours</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>312 Students</span>
                                </div>
                            </div>
                            <div class="course-card-progress-section">
                                <div class="course-card-progress-header">
                                    <span class="course-card-progress-label">Completed</span>
                                    <span class="course-card-progress-percent" style="color: #43e97b;">100%</span>
                                </div>
                                <div class="course-card-progress-bar">
                                    <div class="course-card-progress-fill" style="width: 100%; background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);"></div>
                                </div>
                            </div>
                            <div class="course-card-footer">
                                <button class="course-card-btn primary" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);" onclick="openCourseDetail('data-structures', 'completed', 100)">
                                    <i class="fas fa-redo"></i>
                                    <span>Review</span>
                                </button>
                                <button class="course-card-btn secondary" onclick="downloadCertificate('data-structures')">
                                    <i class="fas fa-certificate"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Course Card 4 -->
                    <div class="course-card" data-course="machine-learning" data-status="active" data-progress="45">
                        <div class="course-card-banner" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                            <span class="course-card-category">CS 501</span>
                            <button class="course-card-favorite">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="course-card-content">
                            <h3 class="course-card-title">Machine Learning & AI</h3>
                            <div class="course-card-instructor">
                                <div class="instructor-avatar" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">SD</div>
                                <span class="instructor-name">Dr. Sarah Davis</span>
                            </div>
                            <div class="course-card-meta">
                                <div class="course-card-meta-item">
                                    <i class="fas fa-book-open"></i>
                                    <span>28 Lessons</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>42 Hours</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>156 Students</span>
                                </div>
                            </div>
                            <div class="course-card-progress-section">
                                <div class="course-card-progress-header">
                                    <span class="course-card-progress-label">Progress</span>
                                    <span class="course-card-progress-percent">45%</span>
                                </div>
                                <div class="course-card-progress-bar">
                                    <div class="course-card-progress-fill" style="width: 45%; background: linear-gradient(90deg, #fa709a 0%, #fee140 100%);"></div>
                                </div>
                            </div>
                            <div class="course-card-footer">
                                <button class="course-card-btn primary" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);" onclick="openCourseDetail('machine-learning', 'active', 45)">
                                    <i class="fas fa-play"></i>
                                    <span>Continue</span>
                                </button>
                                <button class="course-card-btn secondary" onclick="openCourseDetail('machine-learning', 'active', 45)">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Course Card 5 -->
                    <div class="course-card" data-course="mobile-dev" data-status="active" data-progress="30">
                        <div class="course-card-banner" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);">
                            <span class="course-card-category">CS 351</span>
                            <button class="course-card-favorite">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <div class="course-card-content">
                            <h3 class="course-card-title">Mobile App Development</h3>
                            <div class="course-card-instructor">
                                <div class="instructor-avatar" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);">TW</div>
                                <span class="instructor-name">Prof. Tom Wilson</span>
                            </div>
                            <div class="course-card-meta">
                                <div class="course-card-meta-item">
                                    <i class="fas fa-book-open"></i>
                                    <span>26 Lessons</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>40 Hours</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>198 Students</span>
                                </div>
                            </div>
                            <div class="course-card-progress-section">
                                <div class="course-card-progress-header">
                                    <span class="course-card-progress-label">Progress</span>
                                    <span class="course-card-progress-percent">30%</span>
                                </div>
                                <div class="course-card-progress-bar">
                                    <div class="course-card-progress-fill" style="width: 30%; background: linear-gradient(90deg, #ff6b6b 0%, #ee5a6f 100%);"></div>
                                </div>
                            </div>
                            <div class="course-card-footer">
                                <button class="course-card-btn primary" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);" onclick="openCourseDetail('mobile-dev', 'active', 30)">
                                    <i class="fas fa-play"></i>
                                    <span>Continue</span>
                                </button>
                                <button class="course-card-btn secondary" onclick="openCourseDetail('mobile-dev', 'active', 30)">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Course Card 6 -->
                    <div class="course-card" data-course="cloud-computing" data-status="completed" data-progress="100">
                        <div class="course-card-banner" style="background: linear-gradient(135deg, #2afadf 0%, #4c83ff 100%);">
                            <span class="course-card-category">CS 450</span>
                            <button class="course-card-favorite">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="course-card-content">
                            <h3 class="course-card-title">Cloud Computing & DevOps</h3>
                            <div class="course-card-instructor">
                                <div class="instructor-avatar" style="background: linear-gradient(135deg, #2afadf 0%, #4c83ff 100%);">AL</div>
                                <span class="instructor-name">Dr. Anna Lee</span>
                            </div>
                            <div class="course-card-meta">
                                <div class="course-card-meta-item">
                                    <i class="fas fa-book-open"></i>
                                    <span>22 Lessons</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>34 Hours</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>167 Students</span>
                                </div>
                            </div>
                            <div class="course-card-progress-section">
                                <div class="course-card-progress-header">
                                    <span class="course-card-progress-label">Completed</span>
                                    <span class="course-card-progress-percent" style="color: #2afadf;">100%</span>
                                </div>
                                <div class="course-card-progress-bar">
                                    <div class="course-card-progress-fill" style="width: 100%; background: linear-gradient(90deg, #2afadf 0%, #4c83ff 100%);"></div>
                                </div>
                            </div>
                            <div class="course-card-footer">
                                <button class="course-card-btn primary" style="background: linear-gradient(135deg, #2afadf 0%, #4c83ff 100%);" onclick="openCourseDetail('cloud-computing', 'completed', 100)">
                                    <i class="fas fa-redo"></i>
                                    <span>Review</span>
                                </button>
                                <button class="course-card-btn secondary" onclick="downloadCertificate('cloud-computing')">
                                    <i class="fas fa-certificate"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- List View -->
                <div class="courses-list" id="coursesList">
                    <!-- Course List Item 1 -->
                    <div class="course-list-item" data-course="web-development" data-status="active" data-progress="75">
                        <div class="course-list-thumbnail" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                        <div class="course-list-details">
                            <div class="course-list-header">
                                <div>
                                    <h3 class="course-list-title">Web Development Fundamentals</h3>
                                    <div class="course-card-instructor">
                                        <div class="instructor-avatar">JS</div>
                                        <span class="instructor-name">Prof. John Smith</span>
                                    </div>
                                </div>
                                <span class="course-card-category">CS 301</span>
                            </div>
                            <div class="course-list-meta">
                                <div class="course-card-meta-item">
                                    <i class="fas fa-book-open"></i>
                                    <span>24 Lessons</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>36 Hours</span>
                                </div>
                                <div class="course-card-meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>245 Students</span>
                                </div>
                            </div>
                        </div>
                        <div class="course-list-progress-section">
                            <div class="course-card-progress-header">
                                <span class="course-card-progress-label">Progress</span>
                                <span class="course-card-progress-percent">75%</span>
                            </div>
                            <div class="course-card-progress-bar">
                                <div class="course-card-progress-fill" style="width: 75%;"></div>
                            </div>
                            <button class="course-card-btn primary" style="margin-top: 10px;" onclick="openCourseDetail('web-development', 'active', 75)">
                                <i class="fas fa-play"></i>
                                <span>Continue</span>
                            </button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Transcript Modal -->
    <div class="transcript-modal" id="transcriptModal">
        <div class="transcript-content">
            <div class="transcript-header">
                <button class="transcript-close" onclick="closeTranscript()">
                    <i class="fas fa-times"></i>
                </button>
                <div class="transcript-header-content">
                    <div class="transcript-logo">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h2 class="transcript-title">Official Academic Transcript</h2>
                    <p class="transcript-subtitle">EduPortal University • Computer Science Department</p>
                </div>
            </div>

            <div class="transcript-body">
                <!-- Student Information -->
                <div class="transcript-info-card">
                    <div class="transcript-info-grid">
                        <div class="transcript-info-item">
                            <span class="transcript-info-label">Student Name</span>
                            <span class="transcript-info-value" id="transcriptStudentName">John Doe</span>
                        </div>
                        <div class="transcript-info-item">
                            <span class="transcript-info-label">Student ID</span>
                            <span class="transcript-info-value" id="transcriptStudentId">STU2023001</span>
                        </div>
                        <div class="transcript-info-item">
                            <span class="transcript-info-label">Program</span>
                            <span class="transcript-info-value">Bachelor of Science in Computer Science</span>
                        </div>
                        <div class="transcript-info-item">
                            <span class="transcript-info-label">Date of Birth</span>
                            <span class="transcript-info-value">January 15, 2002</span>
                        </div>
                        <div class="transcript-info-item">
                            <span class="transcript-info-label">Matriculation Date</span>
                            <span class="transcript-info-value">September 1, 2023</span>
                        </div>
                        <div class="transcript-info-item">
                            <span class="transcript-info-label">Expected Graduation</span>
                            <span class="transcript-info-value">May 2027</span>
                        </div>
                    </div>
                </div>

                <!-- Fall 2023 Semester -->
                <div class="transcript-semester">
                    <div class="semester-header">
                        <div class="semester-title">
                            <i class="fas fa-calendar-alt" style="color: #667eea;"></i>
                            Fall 2023
                        </div>
                        <div class="semester-gpa">
                            <div class="semester-gpa-item">
                                <div class="semester-gpa-label">Credits</div>
                                <div class="semester-gpa-value">16</div>
                            </div>
                            <div class="semester-gpa-item">
                                <div class="semester-gpa-label">GPA</div>
                                <div class="semester-gpa-value">3.75</div>
                            </div>
                        </div>
                    </div>
                    <table class="transcript-table">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Credits</th>
                                <th>Grade</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="course-code">CS 101</span></td>
                                <td>Introduction to Programming</td>
                                <td>4</td>
                                <td><span class="grade-badge a">A</span></td>
                                <td>4.0</td>
                            </tr>
                            <tr>
                                <td><span class="course-code">CS 150</span></td>
                                <td>Data Structures</td>
                                <td>4</td>
                                <td><span class="grade-badge a">A</span></td>
                                <td>4.0</td>
                            </tr>
                            <tr>
                                <td><span class="course-code">MATH 201</span></td>
                                <td>Calculus I</td>
                                <td>4</td>
                                <td><span class="grade-badge b-plus">B+</span></td>
                                <td>3.3</td>
                            </tr>
                            <tr>
                                <td><span class="course-code">ENG 110</span></td>
                                <td>English Composition</td>
                                <td>4</td>
                                <td><span class="grade-badge a">A</span></td>
                                <td>4.0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Spring 2024 Semester -->
                <div class="transcript-semester">
                    <div class="semester-header">
                        <div class="semester-title">
                            <i class="fas fa-calendar-alt" style="color: #667eea;"></i>
                            Spring 2024
                        </div>
                        <div class="semester-gpa">
                            <div class="semester-gpa-item">
                                <div class="semester-gpa-label">Credits</div>
                                <div class="semester-gpa-value">18</div>
                            </div>
                            <div class="semester-gpa-item">
                                <div class="semester-gpa-label">GPA</div>
                                <div class="semester-gpa-value">3.85</div>
                            </div>
                        </div>
                    </div>
                    <table class="transcript-table">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Credits</th>
                                <th>Grade</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="course-code">CS 201</span></td>
                                <td>Algorithms & Analysis</td>
                                <td>4</td>
                                <td><span class="grade-badge a">A</span></td>
                                <td>4.0</td>
                            </tr>
                            <tr>
                                <td><span class="course-code">CS 250</span></td>
                                <td>Object-Oriented Programming</td>
                                <td>4</td>
                                <td><span class="grade-badge a-plus">A+</span></td>
                                <td>4.0</td>
                            </tr>
                            <tr>
                                <td><span class="course-code">CS 270</span></td>
                                <td>Computer Architecture</td>
                                <td>4</td>
                                <td><span class="grade-badge b-plus">B+</span></td>
                                <td>3.3</td>
                            </tr>
                            <tr>
                                <td><span class="course-code">MATH 202</span></td>
                                <td>Calculus II</td>
                                <td>4</td>
                                <td><span class="grade-badge a">A</span></td>
                                <td>4.0</td>
                            </tr>
                            <tr>
                                <td><span class="course-code">PHYS 101</span></td>
                                <td>Physics I</td>
                                <td>2</td>
                                <td><span class="grade-badge b">B</span></td>
                                <td>3.0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Fall 2024 Semester -->
                <div class="transcript-semester">
                    <div class="semester-header">
                        <div class="semester-title">
                            <i class="fas fa-calendar-alt" style="color: #667eea;"></i>
                            Fall 2024
                        </div>
                        <div class="semester-gpa">
                            <div class="semester-gpa-item">
                                <div class="semester-gpa-label">Credits</div>
                                <div class="semester-gpa-value">16</div>
                            </div>
                            <div class="semester-gpa-item">
                                <div class="semester-gpa-label">GPA</div>
                                <div class="semester-gpa-value">3.90</div>
                            </div>
                        </div>
                    </div>
                    <table class="transcript-table">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Credits</th>
                                <th>Grade</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="course-code">CS 301</span></td>
                                <td>Web Development Fundamentals</td>
                                <td>4</td>
                                <td><span class="grade-badge a">A</span></td>
                                <td>4.0</td>
                            </tr>
                            <tr>
                                <td><span class="course-code">CS 402</span></td>
                                <td>Database Management Systems</td>
                                <td>4</td>
                                <td><span class="grade-badge a">A</span></td>
                                <td>4.0</td>
                            </tr>
                            <tr>
                                <td><span class="course-code">CS 450</span></td>
                                <td>Operating Systems</td>
                                <td>4</td>
                                <td><span class="grade-badge a-plus">A+</span></td>
                                <td>4.0</td>
                            </tr>
                            <tr>
                                <td><span class="course-code">CS 351</span></td>
                                <td>Mobile App Development</td>
                                <td>4</td>
                                <td><span class="grade-badge b-plus">B+</span></td>
                                <td>3.3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Fall 2025 (Current) Semester -->
                <div class="transcript-semester">
                    <div class="semester-header">
                        <div class="semester-title">
                            <i class="fas fa-calendar-alt" style="color: #43e97b;"></i>
                            Fall 2025 (Current)
                        </div>
                        <div class="semester-gpa">
                            <div class="semester-gpa-item">
                                <div class="semester-gpa-label">Credits</div>
                                <div class="semester-gpa-value">18</div>
                            </div>
                            <div class="semester-gpa-item">
                                <div class="semester-gpa-label">Status</div>
                                <div class="semester-gpa-value" style="font-size: 16px; color: #43e97b;">In Progress</div>
                            </div>
                        </div>
                    </div>
                    <table class="transcript-table">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Credits</th>
                                <th>Grade</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="course-code">CS 501</span></td>
                                <td>Machine Learning & AI</td>
                                <td>4</td>
                                <td>-</td>
                                <td><span style="color: #667eea; font-weight: 600;">75% Complete</span></td>
                            </tr>
                            <tr>
                                <td><span class="course-code">CS 510</span></td>
                                <td>Cloud Computing</td>
                                <td>4</td>
                                <td>-</td>
                                <td><span style="color: #667eea; font-weight: 600;">60% Complete</span></td>
                            </tr>
                            <tr>
                                <td><span class="course-code">CS 520</span></td>
                                <td>Software Engineering</td>
                                <td>4</td>
                                <td>-</td>
                                <td><span style="color: #667eea; font-weight: 600;">45% Complete</span></td>
                            </tr>
                            <tr>
                                <td><span class="course-code">CS 530</span></td>
                                <td>Cybersecurity Fundamentals</td>
                                <td>3</td>
                                <td>-</td>
                                <td><span style="color: #667eea; font-weight: 600;">55% Complete</span></td>
                            </tr>
                            <tr>
                                <td><span class="course-code">MATH 301</span></td>
                                <td>Linear Algebra</td>
                                <td>3</td>
                                <td>-</td>
                                <td><span style="color: #667eea; font-weight: 600;">70% Complete</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Academic Summary -->
                <div class="transcript-summary">
                    <h3 class="summary-title">Cumulative Academic Summary</h3>
                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-value">3.83</div>
                            <div class="summary-label">Cumulative GPA</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value">68</div>
                            <div class="summary-label">Credits Earned</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value">18</div>
                            <div class="summary-label">Credits In Progress</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value">120</div>
                            <div class="summary-label">Credits Required</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value">57%</div>
                            <div class="summary-label">Degree Progress</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-value">A-</div>
                            <div class="summary-label">Grade Average</div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 30px; padding: 20px; background: white; border-radius: 12px; border-left: 4px solid #667eea;">
                    <p style="margin: 0; color: #7f8c8d; font-size: 14px; line-height: 1.6;">
                        <strong>Note:</strong> This is an official academic transcript. All information is accurate as of December 19, 2025. 
                        For official purposes, please request a certified copy from the Registrar's Office.
                    </p>
                </div>
            </div>

            <div class="transcript-footer">
                <button class="transcript-btn secondary" onclick="closeTranscript()">
                    <i class="fas fa-arrow-left"></i>
                    <span>Close</span>
                </button>
                <button class="transcript-btn primary" onclick="printTranscript()">
                    <i class="fas fa-print"></i>
                    <span>Print Transcript</span>
                </button>
                <button class="transcript-btn primary" onclick="downloadTranscript()">
                    <i class="fas fa-download"></i>
                    <span>Download PDF</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Course Detail Modal -->
    <div class="course-detail-modal" id="courseDetailModal">
        <div class="course-detail-content">
            <div class="course-detail-header" id="courseDetailHeader">
                <button class="course-detail-close" onclick="closeCourseDetail()">
                    <i class="fas fa-times"></i>
                </button>
                <div class="course-detail-header-content">
                    <span class="course-detail-badge" id="courseBadge">CS 301</span>
                    <h2 class="course-detail-title" id="courseTitle">Web Development Fundamentals</h2>
                    <div class="course-detail-instructor">
                        <div class="instructor-avatar-large" id="instructorAvatar">JS</div>
                        <div class="instructor-info">
                            <h4 id="instructorName">Prof. John Smith</h4>
                            <p id="instructorTitle">Professor of Computer Science</p>
                        </div>
                    </div>
                    <div class="course-detail-meta-bar">
                        <div class="course-detail-meta-item">
                            <i class="fas fa-book-open"></i>
                            <span id="courseLessons">24 Lessons</span>
                        </div>
                        <div class="course-detail-meta-item">
                            <i class="fas fa-clock"></i>
                            <span id="courseDuration">36 Hours</span>
                        </div>
                        <div class="course-detail-meta-item">
                            <i class="fas fa-users"></i>
                            <span id="courseStudents">245 Students</span>
                        </div>
                        <div class="course-detail-meta-item">
                            <i class="fas fa-star"></i>
                            <span id="courseRating">4.8 (156 reviews)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="course-detail-body">
                <div class="course-detail-tabs">
                    <button class="course-tab active" onclick="switchCourseTab('overview')">
                        <i class="fas fa-home"></i> Overview
                    </button>
                    <button class="course-tab" onclick="switchCourseTab('curriculum')">
                        <i class="fas fa-list"></i> Curriculum
                    </button>
                    <button class="course-tab" onclick="switchCourseTab('assignments')">
                        <i class="fas fa-tasks"></i> Assignments
                    </button>
                    <button class="course-tab" onclick="switchCourseTab('resources')">
                        <i class="fas fa-folder"></i> Resources
                    </button>
                </div>

                <!-- Overview Tab -->
                <div class="course-tab-content active" id="overview-tab">
                    <div class="course-progress-detail">
                        <div class="progress-detail-header">
                            <h3>Your Progress</h3>
                        </div>
                        <div class="progress-percentage-large" id="progressPercentageLarge">75%</div>
                        <div class="progress-bar-large">
                            <div class="progress-fill-large" id="progressFillLarge" style="width: 75%;"></div>
                        </div>
                        <div class="progress-stats">
                            <div class="progress-stat">
                                <div class="progress-stat-value" id="completedLessons">18/24</div>
                                <div class="progress-stat-label">Lessons</div>
                            </div>
                            <div class="progress-stat">
                                <div class="progress-stat-value" id="hoursSpent">27h</div>
                                <div class="progress-stat-label">Time Spent</div>
                            </div>
                            <div class="progress-stat">
                                <div class="progress-stat-value" id="assignmentsCompleted">8/12</div>
                                <div class="progress-stat-label">Assignments</div>
                            </div>
                            <div class="progress-stat">
                                <div class="progress-stat-value" id="courseGrade">88%</div>
                                <div class="progress-stat-label">Grade</div>
                            </div>
                        </div>
                    </div>

                    <h3 style="margin-bottom: 20px; color: #2c3e50;">Course Description</h3>
                    <p style="color: #7f8c8d; line-height: 1.8; margin-bottom: 30px;" id="courseDescription">
                        Master the fundamentals of web development including HTML5, CSS3, JavaScript, and modern frameworks. 
                        This comprehensive course covers everything from basic web page creation to advanced responsive design 
                        and interactive web applications. Perfect for beginners and those looking to strengthen their foundation.
                    </p>

                    <h3 style="margin-bottom: 20px; color: #2c3e50;">What You'll Learn</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-bottom: 30px;">
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <i class="fas fa-check-circle" style="color: #43e97b; font-size: 20px; margin-top: 2px;"></i>
                            <span style="color: #2c3e50;">Build responsive websites from scratch</span>
                        </div>
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <i class="fas fa-check-circle" style="color: #43e97b; font-size: 20px; margin-top: 2px;"></i>
                            <span style="color: #2c3e50;">Master HTML5 semantic elements</span>
                        </div>
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <i class="fas fa-check-circle" style="color: #43e97b; font-size: 20px; margin-top: 2px;"></i>
                            <span style="color: #2c3e50;">Style with advanced CSS3</span>
                        </div>
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <i class="fas fa-check-circle" style="color: #43e97b; font-size: 20px; margin-top: 2px;"></i>
                            <span style="color: #2c3e50;">Create interactive JavaScript apps</span>
                        </div>
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <i class="fas fa-check-circle" style="color: #43e97b; font-size: 20px; margin-top: 2px;"></i>
                            <span style="color: #2c3e50;">Implement modern web frameworks</span>
                        </div>
                        <div style="display: flex; align-items: start; gap: 12px;">
                            <i class="fas fa-check-circle" style="color: #43e97b; font-size: 20px; margin-top: 2px;"></i>
                            <span style="color: #2c3e50;">Deploy projects to production</span>
                        </div>
                    </div>
                </div>

                <!-- Curriculum Tab -->
                <div class="course-tab-content" id="curriculum-tab">
                    <h3 style="margin-bottom: 20px; color: #2c3e50;">Course Curriculum</h3>
                    <div class="lessons-list" id="lessonsList">
                        <!-- Lessons will be dynamically loaded -->
                    </div>
                </div>

                <!-- Assignments Tab -->
                <div class="course-tab-content" id="assignments-tab">
                    <h3 style="margin-bottom: 20px; color: #2c3e50;">Course Assignments</h3>
                    <div class="assignments-grid" id="assignmentsGrid">
                        <!-- Assignments will be dynamically loaded -->
                    </div>
                </div>

                <!-- Resources Tab -->
                <div class="course-tab-content" id="resources-tab">
                    <h3 style="margin-bottom: 20px; color: #2c3e50;">Course Resources</h3>
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        <div style="background: white; border: 2px solid #e0e6ed; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 20px; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#667eea'" onmouseout="this.style.borderColor='#e0e6ed'">
                            <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div style="flex: 1;">
                                <h4 style="margin: 0 0 5px 0; color: #2c3e50;">Course Syllabus</h4>
                                <p style="margin: 0; color: #7f8c8d; font-size: 14px;">Complete course outline and schedule - PDF (2.4 MB)</p>
                            </div>
                            <button style="padding: 10px 20px; background: #667eea; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                                <i class="fas fa-download"></i> Download
                            </button>
                        </div>
                        <div style="background: white; border: 2px solid #e0e6ed; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 20px; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#667eea'" onmouseout="this.style.borderColor='#e0e6ed'">
                            <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">
                                <i class="fas fa-code"></i>
                            </div>
                            <div style="flex: 1;">
                                <h4 style="margin: 0 0 5px 0; color: #2c3e50;">Source Code Examples</h4>
                                <p style="margin: 0; color: #7f8c8d; font-size: 14px;">All code examples and projects - ZIP (15.8 MB)</p>
                            </div>
                            <button style="padding: 10px 20px; background: #4facfe; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                                <i class="fas fa-download"></i> Download
                            </button>
                        </div>
                        <div style="background: white; border: 2px solid #e0e6ed; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 20px; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.borderColor='#667eea'" onmouseout="this.style.borderColor='#e0e6ed'">
                            <div style="width: 50px; height: 50px; border-radius: 12px; background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">
                                <i class="fas fa-book"></i>
                            </div>
                            <div style="flex: 1;">
                                <h4 style="margin: 0 0 5px 0; color: #2c3e50;">Reference Materials</h4>
                                <p style="margin: 0; color: #7f8c8d; font-size: 14px;">Additional reading and documentation - PDF (5.2 MB)</p>
                            </div>
                            <button style="padding: 10px 20px; background: #43e97b; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                                <i class="fas fa-download"></i> Download
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="course-action-buttons">
                <button class="course-action-btn secondary" onclick="closeCourseDetail()">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Courses</span>
                </button>
                <button class="course-action-btn primary" id="mainCourseActionBtn" onclick="startLearning()">
                    <i class="fas fa-play"></i>
                    <span>Continue Learning</span>
                </button>
            </div>
        </div>
    </div>

</body>
</html>
