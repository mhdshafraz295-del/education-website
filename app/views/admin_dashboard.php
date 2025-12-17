
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

        /* Higher z-index for modals that open on top of other modals */
        #scheduleExamModal {
            z-index: 2100;
        }

        #scheduleExamModal.show {
            background-color: rgba(0, 0, 0, 0.7);
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

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: scale(1);
            }
            to {
                opacity: 0;
                transform: scale(0.95);
            }
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

    
        .form-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            position: relative;
            padding: 0 50px;
        }

        .form-steps::before {
            content: '';
            position: absolute;
            top: 25px;
            left: 50px;
            right: 50px;
            height: 3px;
            background: #e0e6ed;
            z-index: 0;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            position: relative;
            z-index: 1;
        }

        .step-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #e0e6ed;
            color: #95a5a6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .step.active .step-number {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(67, 233, 123, 0.3);
        }

        .step.completed .step-number {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
        }

        .step-text {
            font-size: 13px;
            font-weight: 600;
            color: #95a5a6;
            transition: all 0.3s ease;
        }

        .step.active .step-text {
            color: #2c3e50;
        }

        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        .step-title {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .step-title i {
            color: #43e97b;
        }

        .form-hint {
            font-size: 12px;
            color: #7f8c8d;
            margin-top: 5px;
            display: block;
        }

        .character-count {
            text-align: right;
            font-size: 12px;
            color: #7f8c8d;
            margin-top: 5px;
        }

        .character-count .current {
            font-weight: 600;
            color: #2c3e50;
        }

        .file-upload-area {
            border: 2px dashed #e0e6ed;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: #43e97b;
            background: rgba(67, 233, 123, 0.05);
        }

        .file-upload-label {
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .file-upload-label i {
            font-size: 48px;
            color: #43e97b;
        }

        .file-upload-label span {
            font-size: 14px;
            color: #2c3e50;
            font-weight: 600;
        }

        .file-upload-label small {
            font-size: 12px;
            color: #7f8c8d;
        }

        .file-preview {
            position: relative;
            margin-top: 15px;
        }

        .file-preview img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .remove-file {
            position: absolute;
            top: -10px;
            right: calc(50% - 110px);
            background: #e74c3c;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .remove-file:hover {
            background: #c0392b;
            transform: scale(1.1);
        }

        .duration-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 10px;
        }

        .duration-option input[type="radio"] {
            display: none;
        }

        .duration-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 20px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .duration-option label i {
            font-size: 32px;
            color: #43e97b;
        }

        .duration-option label span {
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .duration-option input[type="radio"]:checked + label {
            border-color: #43e97b;
            background: rgba(67, 233, 123, 0.1);
        }

        .settings-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .settings-section h4 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .settings-section h4 i {
            color: #43e97b;
        }

        #learningOutcomes {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 15px;
        }

        .outcome-item {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .outcome-item input {
            flex: 1;
        }

        .btn-remove-outcome {
            background: #e74c3c;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-remove-outcome:hover {
            background: #c0392b;
            transform: scale(1.05);
        }

        .btn-add-more {
            background: white;
            border: 2px dashed #43e97b;
            color: #43e97b;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            width: fit-content;
        }

        .btn-add-more:hover {
            background: rgba(67, 233, 123, 0.1);
            border-color: #38f9d7;
        }

        .feature-toggles {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .toggle-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: white;
            border-radius: 10px;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 52px;
            height: 28px;
            flex-shrink: 0;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        input:checked + .toggle-slider:before {
            transform: translateX(24px);
        }

        .toggle-info {
            flex: 1;
        }

        .toggle-info strong {
            display: block;
            color: #2c3e50;
            font-size: 14px;
            margin-bottom: 3px;
        }

        .toggle-info p {
            font-size: 12px;
            color: #7f8c8d;
            margin: 0;
        }

        .status-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 10px;
        }

        .status-option input[type="radio"] {
            display: none;
        }

        .status-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 20px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .status-option label i {
            font-size: 32px;
        }

        .status-option label span {
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .status-option label small {
            font-size: 11px;
            color: #7f8c8d;
        }

        .status-option input[type="radio"]:checked + label {
            border-color: #43e97b;
            background: rgba(67, 233, 123, 0.1);
        }

        .status-option:nth-child(1) label i {
            color: #95a5a6;
        }

        .status-option:nth-child(2) label i {
            color: #27ae60;
        }

        .status-option:nth-child(3) label i {
            color: #e67e22;
        }

        .form-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f0f0f0;
        }

        .btn-prev,
        .btn-next {
            padding: 12px 30px;
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

        .btn-prev {
            background: #f8f9fa;
            color: #2c3e50;
        }

        .btn-prev:hover {
            background: #e9ecef;
        }

        .btn-next {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 233, 123, 0.3);
        }

        @media (max-width: 768px) {
            .form-steps {
                padding: 0 20px;
            }

            .form-steps::before {
                left: 20px;
                right: 20px;
            }

            .step-text {
                font-size: 11px;
            }

            .step-number {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .duration-options,
            .status-options {
                grid-template-columns: 1fr;
            }

            .form-navigation {
                flex-direction: column;
                gap: 10px;
            }

            .btn-prev,
            .btn-next {
                width: 100%;
                justify-content: center;
            }
        }

        
        .exam-format-options {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 10px;
        }

        .format-option input[type="radio"] {
            display: none;
        }

        .format-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 20px 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .format-option label i {
            font-size: 32px;
            color: #fa709a;
        }

        .format-option label span {
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .format-option label small {
            font-size: 11px;
            color: #7f8c8d;
        }

        .format-option input[type="radio"]:checked + label {
            border-color: #fa709a;
            background: rgba(250, 112, 154, 0.1);
        }

        .venue-selector {
            display: flex;
            gap: 10px;
        }

        .venue-selector select {
            flex: 1;
        }

        .invigilator-item {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
        }

        .invigilator-item select {
            flex: 1;
        }

        .btn-remove-invigilator {
            background: #e74c3c;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .btn-remove-invigilator:hover {
            background: #c0392b;
            transform: scale(1.05);
        }

        .instruction-item {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 10px;
        }

        .instruction-item input {
            flex: 1;
        }

        .materials-checklist {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkbox-label:hover {
            background: rgba(250, 112, 154, 0.05);
        }

        .checkbox-label input[type="checkbox"] {
            display: none;
        }

        .checkmark-inline {
            width: 20px;
            height: 20px;
            border: 2px solid #e0e6ed;
            border-radius: 4px;
            display: inline-block;
            position: relative;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .checkbox-label input:checked ~ .checkmark-inline {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            border-color: #fa709a;
        }

        .checkbox-label input:checked ~ .checkmark-inline:after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 14px;
            font-weight: bold;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .checkbox-label span:last-child {
            font-size: 14px;
            color: #2c3e50;
            font-weight: 500;
        }

        .exam-next-btn {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .exam-next-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(250, 112, 154, 0.3);
        }

        .exam-submit-btn {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .exam-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(250, 112, 154, 0.3);
        }

        @media (max-width: 768px) {
            .exam-format-options {
                grid-template-columns: 1fr;
            }

            .materials-checklist {
                grid-template-columns: 1fr;
            }
        }

        
        .recipient-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-top: 10px;
        }

        .recipient-card input[type="radio"] {
            display: none;
        }

        .recipient-card label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 20px 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            height: 100%;
        }

        .recipient-card label i {
            font-size: 32px;
            color: #667eea;
        }

        .recipient-card label span {
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .recipient-card label small {
            font-size: 11px;
            color: #7f8c8d;
        }

        .recipient-card input[type="radio"]:checked + label {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .filter-section-notification {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .filter-section-notification h4 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-section-notification h4 i {
            color: #667eea;
        }

        .estimated-recipients {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            background: #e3f2fd;
            border-radius: 8px;
            margin-top: 15px;
            color: #1976d2;
            font-size: 14px;
        }

        .estimated-recipients strong {
            font-weight: 700;
        }

        .notification-type-selector {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 10px;
        }

        .type-checkbox input[type="checkbox"] {
            display: none;
        }

        .type-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 18px 12px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .type-box i {
            font-size: 28px;
            color: #667eea;
        }

        .type-box span {
            font-size: 13px;
            font-weight: 600;
            color: #2c3e50;
        }

        .type-checkbox input:checked ~ .type-box {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .priority-selector {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 10px;
        }

        .priority-option input[type="radio"] {
            display: none;
        }

        .priority-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            padding: 18px 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .priority-option label i {
            font-size: 24px;
        }

        .priority-option:nth-child(1) label i {
            color: #95a5a6;
        }

        .priority-option:nth-child(2) label i {
            color: #f39c12;
        }

        .priority-option:nth-child(3) label i {
            color: #e74c3c;
        }

        .priority-option label span {
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .priority-option label small {
            font-size: 11px;
            color: #7f8c8d;
        }

        .priority-option input[type="radio"]:checked + label {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .message-tools {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .char-counter {
            font-size: 12px;
            color: #7f8c8d;
        }

        .message-templates {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-template {
            padding: 6px 12px;
            border: 1px solid #667eea;
            background: white;
            color: #667eea;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-template:hover {
            background: #667eea;
            color: white;
        }

        .file-upload-zone {
            border: 2px dashed #e0e6ed;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .file-upload-zone:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }

        .upload-zone-label {
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .upload-zone-label i {
            font-size: 40px;
            color: #667eea;
        }

        .upload-zone-label span {
            font-size: 14px;
            color: #2c3e50;
            font-weight: 600;
        }

        .upload-zone-label small {
            font-size: 12px;
            color: #7f8c8d;
        }

        .attachments-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 15px;
        }

        .attachment-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .attachment-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .attachment-info i {
            font-size: 20px;
            color: #667eea;
        }

        .btn-remove-attachment {
            background: #e74c3c;
            color: white;
            border: none;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-remove-attachment:hover {
            background: #c0392b;
        }

        .notification-preview {
            margin-bottom: 25px;
        }

        .notification-preview h4 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notification-preview h4 i {
            color: #667eea;
        }

        .preview-box {
            background: white;
            border: 2px solid #e0e6ed;
            border-radius: 12px;
            overflow: hidden;
        }

        .preview-header {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-bottom: 2px solid #e0e6ed;
        }

        .preview-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .preview-title {
            flex: 1;
        }

        .preview-title h5 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .preview-title p {
            font-size: 12px;
            color: #7f8c8d;
            margin: 0;
        }

        .preview-priority {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            background: #f39c12;
            color: white;
        }

        .preview-priority.low {
            background: #95a5a6;
        }

        .preview-priority.high {
            background: #e74c3c;
        }

        .preview-body {
            padding: 20px;
            min-height: 100px;
        }

        .preview-body p {
            font-size: 14px;
            color: #2c3e50;
            line-height: 1.6;
        }

        .preview-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: #f8f9fa;
            border-top: 1px solid #e0e6ed;
            font-size: 12px;
            color: #7f8c8d;
        }

        .preview-date,
        .preview-channels {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .send-time-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 10px;
        }

        .radio-box {
            cursor: pointer;
        }

        .radio-box input[type="radio"] {
            display: none;
        }

        .radio-box span {
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .radio-box i {
            font-size: 24px;
            color: #667eea;
        }

        .radio-box strong {
            font-size: 14px;
            color: #2c3e50;
        }

        .radio-box small {
            font-size: 12px;
            color: #7f8c8d;
        }

        .radio-box input:checked ~ span {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .notification-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 25px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .summary-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .summary-item i {
            font-size: 24px;
            color: #667eea;
        }

        .summary-item strong {
            display: block;
            font-size: 13px;
            color: #2c3e50;
            margin-bottom: 3px;
        }

        .summary-item p {
            font-size: 12px;
            color: #7f8c8d;
            margin: 0;
        }

        .notif-next-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .notif-next-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .notif-submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .notif-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        
        .user-mgmt-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #e1e8ed;
            flex-wrap: wrap;
            gap: 15px;
        }

        .toolbar-left {
            flex: 1;
            min-width: 300px;
        }

        .toolbar-right {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-box-inline {
            position: relative;
            width: 100%;
            max-width: 500px;
        }

        .search-box-inline i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 14px;
        }

        .search-box-inline input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .search-box-inline input:focus {
            outline: none;
            border-color: #4facfe;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
        }

        .filter-select {
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-select:hover {
            border-color: #4facfe;
        }

        .filter-select:focus {
            outline: none;
            border-color: #4facfe;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
        }

        .btn-toolbar {
            padding: 10px 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-toolbar:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-toolbar.primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            border: none;
        }

        .btn-toolbar.primary:hover {
            background: linear-gradient(135deg, #3d9ce5 0%, #00d9e5 100%);
        }

        .user-stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            background: white;
        }

        .user-stat-card {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 12px;
            border: 1px solid #e1e8ed;
            transition: all 0.3s;
        }

        .user-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .user-stat-card i {
            font-size: 32px;
            color: #4facfe;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(79, 172, 254, 0.1);
            border-radius: 10px;
        }

        .user-stat-card h4 {
            margin: 0;
            font-size: 28px;
            color: #2c3e50;
            font-weight: 700;
        }

        .user-stat-card p {
            margin: 0;
            font-size: 14px;
            color: #6c757d;
        }

        .user-table-container {
            padding: 20px;
            overflow-x: auto;
        }

        .user-management-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .user-management-table thead {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .user-management-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .user-management-table td {
            padding: 15px;
            border-bottom: 1px solid #e1e8ed;
            font-size: 14px;
            color: #495057;
        }

        .user-management-table tbody tr {
            transition: all 0.3s;
        }

        .user-management-table tbody tr:hover {
            background: #f8f9fa;
        }

        .user-cell-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar-small {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .user-details h4 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .user-details p {
            margin: 3px 0 0 0;
            font-size: 12px;
            color: #6c757d;
        }

        .role-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
            display: inline-block;
        }

        .role-badge.student {
            background: rgba(79, 172, 254, 0.15);
            color: #4facfe;
        }

        .role-badge.lecturer {
            background: rgba(102, 126, 234, 0.15);
            color: #667eea;
        }

        .role-badge.exam {
            background: rgba(67, 233, 123, 0.15);
            color: #43e97b;
        }

        .role-badge.library {
            background: rgba(250, 112, 154, 0.15);
            color: #fa709a;
        }

        .role-badge.finance {
            background: rgba(254, 225, 64, 0.15);
            color: #d4a800;
        }

        .role-badge.admin {
            background: rgba(255, 107, 107, 0.15);
            color: #ff6b6b;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: capitalize;
            display: inline-block;
        }

        .status-badge.active {
            background: rgba(67, 233, 123, 0.15);
            color: #43e97b;
        }

        .status-badge.inactive {
            background: rgba(255, 107, 107, 0.15);
            color: #ff6b6b;
        }

        .status-badge.pending {
            background: rgba(254, 225, 64, 0.15);
            color: #d4a800;
        }

        .action-btns {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            font-size: 14px;
        }

        .action-btn.view {
            background: rgba(79, 172, 254, 0.15);
            color: #4facfe;
        }

        .action-btn.view:hover {
            background: #4facfe;
            color: white;
            transform: scale(1.1);
        }

        .action-btn.edit {
            background: rgba(254, 225, 64, 0.15);
            color: #d4a800;
        }

        .action-btn.edit:hover {
            background: #fee140;
            color: #2c3e50;
            transform: scale(1.1);
        }

        .action-btn.delete {
            background: rgba(255, 107, 107, 0.15);
            color: #ff6b6b;
        }

        .action-btn.delete:hover {
            background: #ff6b6b;
            color: white;
            transform: scale(1.1);
        }

        .user-pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #e1e8ed;
            flex-wrap: wrap;
            gap: 15px;
        }

        .pagination-info {
            color: #6c757d;
            font-size: 14px;
        }

        .pagination-controls {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .pagination-btn {
            min-width: 35px;
            height: 35px;
            padding: 0 12px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pagination-btn:hover:not(:disabled) {
            background: #f8f9fa;
            border-color: #4facfe;
            color: #4facfe;
        }

        .pagination-btn.active {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            border-color: #4facfe;
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-size {
            display: flex;
            align-items: center;
        }

        .bulk-actions-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 -4px 12px rgba(0,0,0,0.2);
            z-index: 9999;
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(100%);
            }
            to {
                transform: translateY(0);
            }
        }

        .selected-count {
            font-size: 16px;
            font-weight: 500;
        }

        .bulk-actions {
            display: flex;
            gap: 10px;
        }

        .bulk-action-btn {
            padding: 10px 20px;
            border: 1px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.1);
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .bulk-action-btn:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        .bulk-action-btn.danger {
            background: rgba(255, 107, 107, 0.3);
            border-color: rgba(255, 107, 107, 0.5);
        }

        .bulk-action-btn.danger:hover {
            background: rgba(255, 107, 107, 0.5);
        }

        .checkbox-container {
            display: block;
            position: relative;
            padding-left: 25px;
            cursor: pointer;
            font-size: 14px;
            user-select: none;
        }

        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkbox-container .checkmark {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            height: 20px;
            width: 20px;
            background-color: white;
            border: 2px solid #ddd;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .checkbox-container:hover input ~ .checkmark {
            border-color: #4facfe;
        }

        .checkbox-container input:checked ~ .checkmark {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border-color: #4facfe;
        }

        .checkbox-container .checkmark:after {
            content: "";
            position: absolute;
            display: none;
            left: 6px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .checkbox-container input:checked ~ .checkmark:after {
            display: block;
        }

        /* Students Management Styles */
        .students-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-bottom: 2px solid #e1e8ed;
            flex-wrap: wrap;
            gap: 15px;
        }

        .student-stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            padding: 20px;
            background: #f8f9fa;
        }

        .student-stat-card {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 25px;
            background: white;
            border-radius: 15px;
            border-left: 4px solid;
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .student-stat-card.purple {
            border-left-color: #667eea;
        }

        .student-stat-card.blue {
            border-left-color: #4facfe;
        }

        .student-stat-card.green {
            border-left-color: #43e97b;
        }

        .student-stat-card.yellow {
            border-left-color: #fee140;
        }

        .student-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 28px;
            flex-shrink: 0;
        }

        .student-stat-card.purple .stat-icon {
            background: rgba(102, 126, 234, 0.15);
            color: #667eea;
        }

        .student-stat-card.blue .stat-icon {
            background: rgba(79, 172, 254, 0.15);
            color: #4facfe;
        }

        .student-stat-card.green .stat-icon {
            background: rgba(67, 233, 123, 0.15);
            color: #43e97b;
        }

        .student-stat-card.yellow .stat-icon {
            background: rgba(254, 225, 64, 0.15);
            color: #d4a800;
        }

        .stat-content h4 {
            margin: 0;
            font-size: 32px;
            color: #2c3e50;
            font-weight: 700;
            line-height: 1;
        }

        .stat-content p {
            margin: 5px 0;
            font-size: 14px;
            color: #6c757d;
        }

        .stat-change {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 12px;
            margin-top: 5px;
        }

        .stat-change.positive {
            background: rgba(67, 233, 123, 0.15);
            color: #43e97b;
        }

        .stat-change.negative {
            background: rgba(255, 107, 107, 0.15);
            color: #ff6b6b;
        }

        .stat-change.neutral {
            background: rgba(108, 117, 125, 0.15);
            color: #6c757d;
        }

        .student-table-container {
            padding: 20px;
            overflow-x: auto;
            background: white;
        }

        .student-management-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .student-management-table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .student-management-table th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .student-management-table td {
            padding: 16px;
            border-bottom: 1px solid #e1e8ed;
            font-size: 14px;
            color: #495057;
            vertical-align: middle;
        }

        .student-management-table tbody tr {
            transition: all 0.3s;
        }

        .student-management-table tbody tr:hover {
            background: #f8f9fa;
        }

        .dept-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;
        }

        .dept-badge.cs {
            background: rgba(102, 126, 234, 0.15);
            color: #667eea;
        }

        .dept-badge.eng {
            background: rgba(250, 112, 154, 0.15);
            color: #fa709a;
        }

        .dept-badge.bus {
            background: rgba(79, 172, 254, 0.15);
            color: #4facfe;
        }

        .dept-badge.med {
            background: rgba(67, 233, 123, 0.15);
            color: #43e97b;
        }

        .dept-badge.law {
            background: rgba(255, 107, 107, 0.15);
            color: #ff6b6b;
        }

        .dept-badge.arts {
            background: rgba(254, 225, 64, 0.15);
            color: #d4a800;
        }

        .year-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: rgba(108, 117, 125, 0.15);
            color: #6c757d;
            display: inline-block;
        }

        .gpa-display {
            display: flex;
            flex-direction: column;
            gap: 5px;
            min-width: 80px;
        }

        .gpa-display strong {
            font-size: 16px;
            color: #2c3e50;
        }

        .gpa-bar {
            width: 100%;
            height: 6px;
            background: #e1e8ed;
            border-radius: 3px;
            overflow: hidden;
        }

        .gpa-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .status-badge.on_leave {
            background: rgba(254, 225, 64, 0.15);
            color: #d4a800;
        }

        .status-badge.graduated {
            background: rgba(67, 233, 123, 0.15);
            color: #43e97b;
        }

        .status-badge.suspended {
            background: rgba(255, 107, 107, 0.15);
            color: #ff6b6b;
        }

        .contact-info {
            display: flex;
            gap: 10px;
        }

        .contact-info a {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 14px;
        }

        .contact-info a:hover {
            background: #667eea;
            color: white;
            transform: scale(1.1);
        }

        .action-btn.transcript {
            background: rgba(102, 126, 234, 0.15);
            color: #667eea;
        }

        .action-btn.transcript:hover {
            background: #667eea;
            color: white;
            transform: scale(1.1);
        }

        /* Lecturers Management Styles */
        .lecturers-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);
            border-bottom: 2px solid #e1e8ed;
            flex-wrap: wrap;
            gap: 15px;
        }

        .lecturer-stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            padding: 20px;
            background: #f8f9fa;
        }

        .lecturer-stat-card {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 25px;
            background: white;
            border-radius: 15px;
            border-left: 4px solid;
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .lecturer-stat-card.orange {
            border-left-color: #fa709a;
        }

        .lecturer-stat-card.blue {
            border-left-color: #4facfe;
        }

        .lecturer-stat-card.purple {
            border-left-color: #667eea;
        }

        .lecturer-stat-card.green {
            border-left-color: #43e97b;
        }

        .lecturer-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .lecturer-stat-card.orange .stat-icon {
            background: rgba(250, 112, 154, 0.15);
            color: #fa709a;
        }

        .lecturer-stat-card.blue .stat-icon {
            background: rgba(79, 172, 254, 0.15);
            color: #4facfe;
        }

        .lecturer-stat-card.purple .stat-icon {
            background: rgba(102, 126, 234, 0.15);
            color: #667eea;
        }

        .lecturer-stat-card.green .stat-icon {
            background: rgba(67, 233, 123, 0.15);
            color: #43e97b;
        }

        .lecturer-table-container {
            padding: 20px;
            overflow-x: auto;
            background: white;
        }

        .lecturer-management-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .lecturer-management-table thead {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }

        .lecturer-management-table th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .lecturer-management-table td {
            padding: 16px;
            border-bottom: 1px solid #e1e8ed;
            font-size: 14px;
            color: #495057;
            vertical-align: middle;
        }

        .lecturer-management-table tbody tr {
            transition: all 0.3s;
        }

        .lecturer-management-table tbody tr:hover {
            background: #f8f9fa;
        }

        .qual-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;
        }

        .qual-badge.phd {
            background: rgba(102, 126, 234, 0.15);
            color: #667eea;
        }

        .qual-badge.masters {
            background: rgba(79, 172, 254, 0.15);
            color: #4facfe;
        }

        .qual-badge.bachelors {
            background: rgba(108, 117, 125, 0.15);
            color: #6c757d;
        }

        .exp-display {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .exp-display strong {
            font-size: 14px;
            color: #2c3e50;
        }

        .exp-display small {
            font-size: 11px;
            color: #6c757d;
        }

        .courses-count {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #495057;
            font-weight: 500;
        }

        .courses-count i {
            color: #fa709a;
        }

        .rating-display {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .rating-display .stars {
            display: flex;
            gap: 2px;
            font-size: 14px;
            color: #ffc107;
        }

        .rating-display span {
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .status-badge.retired {
            background: rgba(108, 117, 125, 0.15);
            color: #6c757d;
        }

        .action-btn.courses {
            background: rgba(250, 112, 154, 0.15);
            color: #fa709a;
        }

        .action-btn.courses:hover {
            background: #fa709a;
            color: white;
            transform: scale(1.1);
        }

        /* Courses Management Styles */
        .courses-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: linear-gradient(135deg, #f0fff4 0%, #ffffff 100%);
            border-bottom: 2px solid #e1e8ed;
            flex-wrap: wrap;
            gap: 15px;
        }

        .course-stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            padding: 20px;
            background: #f8f9fa;
        }

        .course-stat-card {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 25px;
            background: white;
            border-radius: 15px;
            border-left: 4px solid;
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .course-stat-card.green {
            border-left-color: #43e97b;
        }

        .course-stat-card.blue {
            border-left-color: #4facfe;
        }

        .course-stat-card.purple {
            border-left-color: #667eea;
        }

        .course-stat-card.yellow {
            border-left-color: #fee140;
        }

        .course-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .course-stat-card.green .stat-icon {
            background: rgba(67, 233, 123, 0.15);
            color: #43e97b;
        }

        .course-stat-card.blue .stat-icon {
            background: rgba(79, 172, 254, 0.15);
            color: #4facfe;
        }

        .course-stat-card.purple .stat-icon {
            background: rgba(102, 126, 234, 0.15);
            color: #667eea;
        }

        .course-stat-card.yellow .stat-icon {
            background: rgba(254, 225, 64, 0.15);
            color: #d4a800;
        }

        .course-table-container {
            padding: 20px;
            overflow-x: auto;
            background: white;
        }

        .course-management-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .course-management-table thead {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .course-management-table th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .course-management-table td {
            padding: 16px;
            border-bottom: 1px solid #e1e8ed;
            font-size: 14px;
            color: #495057;
            vertical-align: middle;
        }

        .course-management-table tbody tr {
            transition: all 0.3s;
        }

        .course-management-table tbody tr:hover {
            background: #f8f9fa;
        }

        .course-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .course-thumbnail {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            flex-shrink: 0;
        }

        .course-details h4 {
            margin: 0;
            font-size: 15px;
            font-weight: 600;
            color: #2c3e50;
            line-height: 1.3;
        }

        .course-details p {
            margin: 4px 0 0 0;
            font-size: 12px;
            color: #6c757d;
            line-height: 1.3;
        }

        .level-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: rgba(67, 233, 123, 0.15);
            color: #43e97b;
            display: inline-block;
        }

        .instructor-mini {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .instructor-mini img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #43e97b;
        }

        .instructor-mini span {
            font-size: 13px;
            color: #495057;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .enrollment-info {
            display: flex;
            flex-direction: column;
            gap: 6px;
            min-width: 90px;
        }

        .progress-bar-small {
            width: 100%;
            height: 6px;
            background: #e1e8ed;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .enrollment-info span {
            font-size: 13px;
            font-weight: 600;
            color: #2c3e50;
        }

        .duration-display {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #495057;
        }

        .duration-display i {
            color: #43e97b;
        }

        .status-badge.draft {
            background: rgba(108, 117, 125, 0.15);
            color: #6c757d;
        }

        .status-badge.completed {
            background: rgba(67, 233, 123, 0.15);
            color: #43e97b;
        }

        .action-btn.students {
            background: rgba(67, 233, 123, 0.15);
            color: #43e97b;
        }

        .action-btn.students:hover {
            background: #43e97b;
            color: white;
            transform: scale(1.1);
        }

        /* Examinations Management Styles */
        .examinations-header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .examinations-toolbar {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            align-items: center;
        }

        .examinations-toolbar .search-box {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .examinations-toolbar .search-box input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .examinations-toolbar .search-box input:focus {
            outline: none;
            border-color: #f093fb;
            box-shadow: 0 0 0 3px rgba(240, 147, 251, 0.1);
        }

        .examinations-toolbar .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #f093fb;
            font-size: 14px;
        }

        .examinations-toolbar .toolbar-filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .examinations-toolbar .toolbar-filters select {
            padding: 10px 15px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .examinations-toolbar .toolbar-filters select:hover,
        .examinations-toolbar .toolbar-filters select:focus {
            border-color: #f093fb;
            outline: none;
        }

        .examinations-toolbar .toolbar-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .exam-stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .exam-stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .exam-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .exam-stat-card.total {
            border-left: 4px solid #f093fb;
        }

        .exam-stat-card.scheduled {
            border-left: 4px solid #4facfe;
        }

        .exam-stat-card.completed {
            border-left: 4px solid #43e97b;
        }

        .exam-stat-card.average {
            border-left: 4px solid #fa709a;
        }

        .exam-stat-card .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .exam-stat-card.total .stat-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .exam-stat-card.scheduled .stat-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .exam-stat-card.completed .stat-icon {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .exam-stat-card.average .stat-icon {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
        }

        .exam-stat-card .stat-info h3 {
            margin: 0;
            font-size: 28px;
            color: #2c3e50;
            font-weight: 700;
        }

        .exam-stat-card .stat-info p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #7f8c8d;
        }

        /* Table Container for Examinations */
        #examinationsModal .table-container {
            overflow-x: auto;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .examinations-management-table {
            width: 100%;
            min-width: 1200px;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
        }

        .examinations-management-table thead {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .examinations-management-table th {
            padding: 12px 10px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            white-space: nowrap;
        }

        .examinations-management-table th:first-child {
            width: 40px;
        }

        .examinations-management-table th:nth-child(2) {
            width: 280px;
        }

        .examinations-management-table th:nth-child(3) {
            width: 120px;
        }

        .examinations-management-table th:nth-child(4) {
            width: 100px;
        }

        .examinations-management-table th:nth-child(5) {
            width: 140px;
        }

        .examinations-management-table th:nth-child(6) {
            width: 90px;
        }

        .examinations-management-table th:nth-child(7) {
            width: 100px;
        }

        .examinations-management-table th:nth-child(8) {
            width: 120px;
        }

        .examinations-management-table th:nth-child(9) {
            width: 110px;
        }

        .examinations-management-table th:nth-child(10) {
            width: 140px;
        }

        .examinations-management-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #ecf0f1;
            font-size: 13px;
            vertical-align: middle;
        }

        .examinations-management-table tbody tr:hover {
            background: #f8f9fa;
        }

        .exam-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .exam-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .exam-icon.final {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .exam-icon.midterm {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .exam-icon.quiz {
            background: linear-gradient(135deg, #ffd89b 0%, #19547b 100%);
            color: white;
        }

        .exam-icon.practical {
            background: linear-gradient(135deg, #00d4ff 0%, #090979 100%);
            color: white;
        }

        .exam-details h4 {
            margin: 0;
            font-size: 14px;
            color: #2c3e50;
            font-weight: 600;
            line-height: 1.3;
        }

        .exam-details p {
            margin: 3px 0 0;
            font-size: 12px;
            color: #7f8c8d;
            line-height: 1.3;
        }

        .course-mini {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .course-code {
            font-weight: 700;
            color: #2c3e50;
            font-size: 14px;
        }

        .exam-type-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
        }

        .exam-type-badge.final {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .exam-type-badge.midterm {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .exam-type-badge.quiz {
            background: linear-gradient(135deg, #ffd89b 0%, #19547b 100%);
            color: white;
        }

        .exam-type-badge.practical {
            background: linear-gradient(135deg, #00d4ff 0%, #090979 100%);
            color: white;
        }

        .datetime-display {
            display: flex;
            flex-direction: column;
            gap: 5px;
            font-size: 13px;
        }

        .datetime-display i {
            width: 16px;
            color: #f093fb;
            margin-right: 5px;
        }

        .duration-badge {
            display: inline-block;
            padding: 6px 12px;
            background: #ecf0f1;
            border-radius: 6px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 13px;
        }

        .students-count {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #2c3e50;
        }

        .students-count i {
            color: #f093fb;
        }

        .score-display {
            color: #95a5a6;
            font-style: italic;
        }

        .score-display-with-bar {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .score-value {
            font-weight: 700;
            font-size: 15px;
            color: #2c3e50;
        }

        .score-bar {
            width: 100%;
            height: 6px;
            background: #ecf0f1;
            border-radius: 3px;
            overflow: hidden;
        }

        .score-fill {
            height: 100%;
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .examinations-management-table .status-badge.scheduled {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .examinations-management-table .status-badge.in-progress {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
            animation: pulse 2s infinite;
        }

        .examinations-management-table .status-badge.completed {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }

        .examinations-management-table .status-badge.graded {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .examinations-management-table .status-badge.cancelled {
            background: #e74c3c;
            color: white;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .action-btn.monitor {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .action-btn.results {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .action-btn.download {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        /* Compact action buttons for examinations table */
        .examinations-management-table .action-btns {
            display: flex;
            gap: 6px;
            justify-content: center;
        }

        .examinations-management-table .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        
        .modal-content.large-modal {
            max-width: 95%;
            width: 95%;
        }

        
        .btn-primary {
            padding: 10px 20px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(240, 147, 251, 0.3);
            white-space: nowrap;
            min-width: 140px;
            height: 38px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(240, 147, 251, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary i {
            font-size: 13px;
        }

        .btn-secondary {
            padding: 10px 20px;
            background: white;
            color: #2c3e50;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            white-space: nowrap;
            min-width: 140px;
            height: 38px;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(240, 147, 251, 0.3);
        }

        .btn-secondary:active {
            transform: translateY(0);
        }

        .btn-secondary i {
            font-size: 13px;
        }

        /* Responsive button adjustments */
        @media (max-width: 1200px) {
            .btn-primary,
            .btn-secondary {
                padding: 10px 18px;
                font-size: 13px;
                gap: 6px;
            }
        }

        @media (max-width: 992px) {
            .examinations-toolbar .toolbar-actions {
                width: 100%;
            }

            .btn-primary,
            .btn-secondary {
                flex: 1;
                justify-content: center;
                padding: 10px 16px;
                font-size: 13px;
            }
        }

        @media (max-width: 768px) {
            .btn-primary,
            .btn-secondary {
                padding: 10px 14px;
                font-size: 12px;
                white-space: nowrap;
            }

            .btn-primary i,
            .btn-secondary i {
                font-size: 12px;
            }
        }

        @media (max-width: 576px) {
            .examinations-toolbar {
                gap: 10px;
            }

            .examinations-toolbar .toolbar-actions {
                flex-direction: column;
                width: 100%;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
                padding: 12px;
                font-size: 13px;
            }
        }

        
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-top: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .pagination-info {
            font-size: 14px;
            color: #2c3e50;
        }

        .pagination-info strong {
            color: #f093fb;
            font-weight: 700;
        }

        .pagination {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .page-btn {
            padding: 8px 14px;
            border: 2px solid #e1e8ed;
            background: white;
            color: #2c3e50;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            min-width: 40px;
            height: 36px;
        }

        .page-btn:hover:not(:disabled) {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
        }

        .page-btn.active {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border-color: transparent;
            box-shadow: 0 2px 8px rgba(240, 147, 251, 0.3);
        }

        .page-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .page-size-selector {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-size-selector label {
            font-size: 14px;
            color: #2c3e50;
            font-weight: 600;
        }

        .page-size-selector select {
            padding: 8px 12px;
            border: 2px solid #e1e8ed;
            border-radius: 6px;
            background: white;
            color: #2c3e50;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 120px;
            height: 36px;
        }

        .page-size-selector select:hover,
        .page-size-selector select:focus {
            border-color: #f093fb;
            outline: none;
        }

        @media (max-width: 992px) {
            .pagination-container {
                justify-content: center;
                gap: 12px;
            }

            .pagination-info,
            .pagination,
            .page-size-selector {
                width: 100%;
                justify-content: center;
            }

            .pagination-info {
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .pagination-container {
                padding: 15px;
            }

            .page-btn {
                padding: 6px 10px;
                font-size: 12px;
                min-width: 36px;
                height: 32px;
            }

            .page-size-selector select {
                font-size: 12px;
                padding: 6px 10px;
                min-width: 100px;
                height: 32px;
            }

            .pagination {
                gap: 5px;
            }
        }

        /* Examinations Calendar Styles */
        .calendar-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .calendar-nav-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .calendar-nav-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(240, 147, 251, 0.4);
        }

        .calendar-title {
            text-align: center;
        }

        .calendar-title h3 {
            margin: 0 0 10px 0;
            font-size: 24px;
            color: #2c3e50;
        }

        .view-toggles {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .view-toggle-btn {
            padding: 8px 16px;
            background: white;
            color: #2c3e50;
            border: 2px solid #e1e8ed;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .view-toggle-btn.active {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border-color: transparent;
        }

        .view-toggle-btn:hover:not(.active) {
            border-color: #f093fb;
        }

        .calendar-legend {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #2c3e50;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        .legend-color.scheduled {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .legend-color.in-progress {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .legend-color.completed {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .legend-color.today {
            background: #f093fb;
            border: 3px solid #fff;
            box-shadow: 0 0 0 2px #f093fb;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .calendar-weekday {
            text-align: center;
            font-weight: 700;
            color: #f093fb;
            padding: 15px 0;
            font-size: 14px;
            text-transform: uppercase;
        }

        .calendar-day {
            position: relative;
            min-height: 100px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .calendar-day:hover {
            background: #fff;
            border-color: #f093fb;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(240, 147, 251, 0.2);
        }

        .calendar-day.today {
            background: linear-gradient(135deg, rgba(240, 147, 251, 0.1) 0%, rgba(245, 87, 108, 0.1) 100%);
            border-color: #f093fb;
        }

        .calendar-day.other-month {
            opacity: 0.4;
        }

        .calendar-day.has-exams {
            background: linear-gradient(135deg, rgba(79, 172, 254, 0.05) 0%, rgba(0, 242, 254, 0.05) 100%);
        }

        .day-number {
            display: block;
            font-size: 16px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .exam-indicator {
            background: white;
            padding: 6px 8px;
            border-radius: 6px;
            font-size: 11px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
            border-left: 3px solid;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .exam-indicator.scheduled {
            border-left-color: #4facfe;
            background: linear-gradient(135deg, rgba(79, 172, 254, 0.1) 0%, rgba(0, 242, 254, 0.1) 100%);
        }

        .exam-indicator.in-progress {
            border-left-color: #fa709a;
            background: linear-gradient(135deg, rgba(250, 112, 154, 0.1) 0%, rgba(254, 225, 64, 0.1) 100%);
        }

        .exam-indicator.completed {
            border-left-color: #43e97b;
            background: linear-gradient(135deg, rgba(67, 233, 123, 0.1) 0%, rgba(56, 249, 215, 0.1) 100%);
        }

        .exam-indicator i {
            font-size: 10px;
        }

        .exam-indicator span {
            font-weight: 600;
            color: #2c3e50;
        }

        .exam-details-sidebar {
            position: fixed;
            right: -400px;
            top: 0;
            width: 400px;
            height: 100vh;
            background: white;
            box-shadow: -4px 0 20px rgba(0,0,0,0.15);
            transition: right 0.3s ease;
            z-index: 2200;
            overflow-y: auto;
        }

        .exam-details-sidebar.show {
            right: 0;
        }

        .sidebar-header {
            padding: 20px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 18px;
        }

        .close-sidebar {
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-sidebar:hover {
            background: rgba(255,255,255,0.3);
            transform: rotate(90deg);
        }

        .sidebar-content {
            padding: 20px;
        }

        .sidebar-exam-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid;
        }

        .sidebar-exam-card.scheduled {
            border-left-color: #4facfe;
        }

        .sidebar-exam-card.in-progress {
            border-left-color: #fa709a;
        }

        .sidebar-exam-card.completed {
            border-left-color: #43e97b;
        }

        .exam-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .exam-time {
            font-size: 13px;
            color: #7f8c8d;
            font-weight: 600;
        }

        .exam-status-badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .exam-status-badge.scheduled {
            background: #4facfe;
            color: white;
        }

        .exam-status-badge.in-progress {
            background: #fa709a;
            color: white;
        }

        .exam-status-badge.completed {
            background: #43e97b;
            color: white;
        }

        .sidebar-exam-card h4 {
            margin: 0 0 12px 0;
            font-size: 16px;
            color: #2c3e50;
        }

        .exam-card-info {
            display: flex;
            gap: 15px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .exam-card-info div {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: #7f8c8d;
        }

        .exam-card-info i {
            color: #f093fb;
        }

        .exam-card-actions {
            display: flex;
            gap: 8px;
        }

        .sidebar-btn {
            flex: 1;
            padding: 8px 12px;
            background: white;
            border: 2px solid #e1e8ed;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            color: #2c3e50;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .sidebar-btn:hover {
            background: #f093fb;
            color: white;
            border-color: transparent;
        }

        .calendar-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            flex-wrap: wrap;
        }

        @media (max-width: 1200px) {
            .calendar-grid {
                gap: 8px;
                padding: 15px;
            }

            .calendar-day {
                min-height: 80px;
                padding: 8px;
            }

            .exam-indicator {
                font-size: 10px;
                padding: 4px 6px;
            }
        }

        @media (max-width: 992px) {
            .calendar-controls {
                flex-direction: column;
                gap: 15px;
            }

            .calendar-nav-btn {
                width: 100%;
                justify-content: center;
            }

            .exam-details-sidebar {
                width: 100%;
                right: -100%;
            }
        }

        @media (max-width: 768px) {
            .calendar-grid {
                gap: 5px;
                padding: 10px;
            }

            .calendar-day {
                min-height: 60px;
                padding: 5px;
            }

            .day-number {
                font-size: 14px;
            }

            .exam-indicator {
                font-size: 9px;
                padding: 3px 5px;
            }

            .exam-indicator span {
                display: none;
            }

            .calendar-weekday {
                padding: 10px 0;
                font-size: 12px;
            }

            .view-toggle-btn {
                padding: 6px 12px;
                font-size: 12px;
            }

            .view-toggle-btn span {
                display: none;
            }
        }

        /* Library Management Styles */
        .library-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .library-toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .library-toolbar .search-box {
            position: relative;
            flex: 1;
            min-width: 300px;
        }

        .library-toolbar .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 1;
        }

        .library-toolbar .search-box input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .library-toolbar .search-box input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .library-toolbar .toolbar-filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .library-toolbar .toolbar-filters select {
            padding: 12px 40px 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            appearance: none;
        }

        .library-toolbar .toolbar-filters select:hover {
            border-color: #667eea;
        }

        .library-toolbar .toolbar-actions {
            display: flex;
            gap: 10px;
            margin-left: auto;
        }

        .library-stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .library-stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-left: 4px solid;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .library-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .library-stat-card.total {
            border-left-color: #667eea;
        }

        .library-stat-card.available {
            border-left-color: #00d4aa;
        }

        .library-stat-card.borrowed {
            border-left-color: #ffc107;
        }

        .library-stat-card.overdue {
            border-left-color: #ff4757;
        }

        .library-stat-card .stat-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 28px;
        }

        .library-stat-card.total .stat-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .library-stat-card.available .stat-icon {
            background: linear-gradient(135deg, #00d4aa 0%, #00b894 100%);
            color: white;
        }

        .library-stat-card.borrowed .stat-icon {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
            color: white;
        }

        .library-stat-card.overdue .stat-icon {
            background: linear-gradient(135deg, #ff4757 0%, #e84118 100%);
            color: white;
        }

        .library-stat-card .stat-info h3 {
            font-size: 32px;
            font-weight: 700;
            margin: 0 0 5px 0;
            color: #2c3e50;
        }

        .library-stat-card .stat-info p {
            font-size: 14px;
            color: #7f8c8d;
            margin: 0;
        }

        .library-management-table {
            width: 100%;
            min-width: 1400px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .library-management-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 16px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .library-management-table th:first-child {
            border-top-left-radius: 10px;
            width: 50px;
        }

        .library-management-table th:last-child {
            border-top-right-radius: 10px;
            width: 180px;
        }

        .library-management-table th:nth-child(2) {
            width: 350px;
        }

        .library-management-table th:nth-child(3) {
            width: 180px;
        }

        .library-management-table th:nth-child(4) {
            width: 150px;
        }

        .library-management-table th:nth-child(5) {
            width: 130px;
        }

        .library-management-table th:nth-child(6) {
            width: 100px;
        }

        .library-management-table th:nth-child(7) {
            width: 100px;
        }

        .library-management-table th:nth-child(8) {
            width: 120px;
        }

        .library-management-table tbody tr {
            background: white;
            transition: all 0.3s ease;
        }

        .library-management-table tbody tr:hover {
            background: #f8f9fa;
            transform: scale(1.01);
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .library-management-table td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 13px;
        }

        .book-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .book-cover {
            width: 50px;
            height: 70px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            flex-shrink: 0;
        }

        .book-details h4 {
            margin: 0 0 4px 0;
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .book-details p {
            margin: 0;
            font-size: 12px;
            color: #7f8c8d;
        }

        .author-info strong {
            color: #2c3e50;
            font-weight: 600;
        }

        .isbn-code {
            font-family: 'Courier New', monospace;
            background: #f8f9fa;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            color: #495057;
        }

        .category-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .category-badge.science {
            background: #e3f2fd;
            color: #1976d2;
        }

        .category-badge.technology {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .category-badge.engineering {
            background: #fff3e0;
            color: #e65100;
        }

        .category-badge.mathematics {
            background: #e0f2f1;
            color: #00695c;
        }

        .category-badge.literature {
            background: #fce4ec;
            color: #c2185b;
        }

        .category-badge.business {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .category-badge.medicine {
            background: #ffebee;
            color: #c62828;
        }

        .copy-count, .available-count {
            font-weight: 600;
            color: #495057;
        }

        .library-management-table .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .library-management-table .status-badge.available {
            background: linear-gradient(135deg, #00d4aa 0%, #00b894 100%);
            color: white;
        }

        .library-management-table .status-badge.borrowed {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
            color: white;
        }

        .library-management-table .status-badge.reserved {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .library-management-table .status-badge.maintenance {
            background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
            color: white;
        }

        #libraryBulkActionsBar {
            margin-top: 20px;
        }

        /* Library Responsive Styles */
        @media (max-width: 1400px) {
            .library-toolbar {
                flex-direction: column;
            }

            .library-toolbar .toolbar-actions {
                margin-left: 0;
                width: 100%;
            }

            .library-toolbar .toolbar-actions button {
                flex: 1;
            }
        }

        @media (max-width: 992px) {
            .library-stats-row {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .library-toolbar .search-box {
                min-width: 100%;
            }

            .library-toolbar .toolbar-filters {
                width: 100%;
            }

            .library-toolbar .toolbar-filters select {
                flex: 1;
            }

            .library-stats-row {
                grid-template-columns: 1fr;
            }

            .library-stat-card {
                padding: 20px;
            }

            .library-stat-card .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }

            .library-stat-card .stat-info h3 {
                font-size: 28px;
            }
        }

        @media (max-width: 576px) {
            .library-toolbar {
                padding: 15px;
                gap: 15px;
            }

            .library-toolbar .toolbar-actions {
                flex-direction: column;
            }

            .library-toolbar .toolbar-actions button {
                width: 100%;
            }
        }

        /* Finance Management Styles */
        .finance-header {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .finance-toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .finance-toolbar .search-box {
            position: relative;
            flex: 1;
            min-width: 300px;
        }

        .finance-toolbar .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 1;
        }

        .finance-toolbar .search-box input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .finance-toolbar .search-box input:focus {
            outline: none;
            border-color: #11998e;
            box-shadow: 0 0 0 3px rgba(17, 153, 142, 0.1);
        }

        .finance-toolbar .toolbar-filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .finance-toolbar .toolbar-filters select {
            padding: 12px 40px 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            appearance: none;
        }

        .finance-toolbar .toolbar-filters select:hover {
            border-color: #11998e;
        }

        .finance-toolbar .toolbar-actions {
            display: flex;
            gap: 10px;
            margin-left: auto;
        }

        .finance-stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .finance-stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-left: 4px solid;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .finance-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .finance-stat-card.total-revenue {
            border-left-color: #11998e;
        }

        .finance-stat-card.collected {
            border-left-color: #00d4aa;
        }

        .finance-stat-card.pending {
            border-left-color: #ffc107;
        }

        .finance-stat-card.overdue {
            border-left-color: #ff4757;
        }

        .finance-stat-card .stat-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 28px;
        }

        .finance-stat-card.total-revenue .stat-icon {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }

        .finance-stat-card.collected .stat-icon {
            background: linear-gradient(135deg, #00d4aa 0%, #00b894 100%);
            color: white;
        }

        .finance-stat-card.pending .stat-icon {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
            color: white;
        }

        .finance-stat-card.overdue .stat-icon {
            background: linear-gradient(135deg, #ff4757 0%, #e84118 100%);
            color: white;
        }

        .finance-stat-card .stat-info h3 {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 5px 0;
            color: #2c3e50;
        }

        .finance-stat-card .stat-info p {
            font-size: 14px;
            color: #7f8c8d;
            margin: 0 0 8px 0;
        }

        .stat-change {
            font-size: 12px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .stat-change.positive {
            background: #d4edda;
            color: #155724;
        }

        .stat-change.negative {
            background: #f8d7da;
            color: #721c24;
        }

        .stat-change.neutral {
            background: #e7f3ff;
            color: #004085;
        }

        .finance-management-table {
            width: 100%;
            min-width: 1500px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .finance-management-table th {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            padding: 16px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .finance-management-table th:first-child {
            border-top-left-radius: 10px;
            width: 50px;
        }

        .finance-management-table th:last-child {
            border-top-right-radius: 10px;
            width: 150px;
        }

        .finance-management-table th:nth-child(2) {
            width: 150px;
        }

        .finance-management-table th:nth-child(3) {
            width: 250px;
        }

        .finance-management-table th:nth-child(4) {
            width: 130px;
        }

        .finance-management-table th:nth-child(5) {
            width: 120px;
        }

        .finance-management-table th:nth-child(6) {
            width: 120px;
        }

        .finance-management-table th:nth-child(7) {
            width: 120px;
        }

        .finance-management-table th:nth-child(8) {
            width: 130px;
        }

        .finance-management-table th:nth-child(9) {
            width: 110px;
        }

        .finance-management-table tbody tr {
            background: white;
            transition: all 0.3s ease;
        }

        .finance-management-table tbody tr:hover {
            background: #f8f9fa;
            transform: scale(1.01);
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }

        .finance-management-table td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 13px;
        }

        .transaction-id {
            font-family: 'Courier New', monospace;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .student-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            flex-shrink: 0;
        }

        .student-details h4 {
            margin: 0 0 4px 0;
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .student-details p {
            margin: 0;
            font-size: 12px;
            color: #7f8c8d;
        }

        .fee-type-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .fee-type-badge.tuition {
            background: #e3f2fd;
            color: #1976d2;
        }

        .fee-type-badge.library {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .fee-type-badge.hostel {
            background: #fff3e0;
            color: #e65100;
        }

        .fee-type-badge.exam {
            background: #e0f2f1;
            color: #00695c;
        }

        .fee-type-badge.fine {
            background: #ffebee;
            color: #c62828;
        }

        .fee-type-badge.other {
            background: #f5f5f5;
            color: #616161;
        }

        .amount, .paid-amount, .balance-amount {
            font-weight: 700;
            font-size: 14px;
        }

        .amount {
            color: #2c3e50;
        }

        .paid-amount {
            color: #00d4aa;
        }

        .balance-amount {
            color: #ff4757;
        }

        .balance-amount.zero {
            color: #95a5a6;
        }

        .due-date {
            color: #495057;
            font-weight: 500;
        }

        .due-date.overdue {
            color: #ff4757;
            font-weight: 700;
        }

        .finance-management-table .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .finance-management-table .status-badge.paid {
            background: linear-gradient(135deg, #00d4aa 0%, #00b894 100%);
            color: white;
        }

        .finance-management-table .status-badge.pending {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
            color: white;
        }

        .finance-management-table .status-badge.overdue {
            background: linear-gradient(135deg, #ff4757 0%, #e84118 100%);
            color: white;
        }

        .finance-management-table .status-badge.partial {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        #financeBulkActionsBar {
            margin-top: 20px;
        }

        /* Add Payment Modal Styles */
        .medium-modal {
            max-width: 900px;
            width: 90%;
        }

        .payment-form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .form-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #11998e;
        }

        .form-section h3 {
            margin: 0 0 20px 0;
            font-size: 16px;
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section h3 i {
            color: #11998e;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 15px;
        }

        .form-row:last-child {
            margin-bottom: 0;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        .required {
            color: #ff4757;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #11998e;
            box-shadow: 0 0 0 3px rgba(17, 153, 142, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .search-input-wrapper {
            position: relative;
        }

        .search-input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 1;
        }

        .search-input-wrapper input {
            padding-left: 45px;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .input-with-icon input {
            padding-left: 45px;
        }

        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 2px solid #11998e;
            border-radius: 8px;
            margin-top: 5px;
            max-height: 300px;
            overflow-y: auto;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            z-index: 10;
        }

        .search-result-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            cursor: pointer;
            transition: background 0.2s ease;
            border-bottom: 1px solid #f0f0f0;
        }

        .search-result-item:last-child {
            border-bottom: none;
        }

        .search-result-item:hover {
            background: #f8f9fa;
        }

        .result-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }

        .result-info {
            display: flex;
            flex-direction: column;
        }

        .result-info strong {
            font-size: 14px;
            color: #2c3e50;
            margin-bottom: 3px;
        }

        .result-info span {
            font-size: 12px;
            color: #7f8c8d;
        }

        .selected-student-card {
            display: flex;
            align-items: center;
            gap: 15px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            border: 2px solid #11998e;
            margin-top: 15px;
        }

        .student-card-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            flex-shrink: 0;
        }

        .student-card-details {
            flex: 1;
        }

        .student-card-details h4 {
            margin: 0 0 5px 0;
            font-size: 16px;
            color: #2c3e50;
        }

        .student-card-details p {
            margin: 0;
            font-size: 13px;
            color: #7f8c8d;
        }

        .remove-student {
            width: 35px;
            height: 35px;
            border: none;
            background: #ff4757;
            color: white;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .remove-student:hover {
            background: #e84118;
            transform: scale(1.1);
        }

        .payment-method-selector {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .payment-method-option {
            position: relative;
            cursor: pointer;
        }

        .payment-method-option input[type=\"radio\"] {
            position: absolute;
            opacity: 0;
        }

        .payment-method-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 20px;
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-height: 100px;
        }

        .payment-method-option label i {
            font-size: 32px;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .payment-method-option label span {
            font-size: 13px;
            font-weight: 600;
            color: #495057;
            transition: all 0.3s ease;
        }

        .payment-method-option input[type=\"radio\"]:checked + label {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border-color: #11998e;
        }

        .payment-method-option input[type=\"radio\"]:checked + label i,
        .payment-method-option input[type=\"radio\"]:checked + label span {
            color: white;
        }

        .payment-method-option label:hover {
            border-color: #11998e;
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(17, 153, 142, 0.2);
        }

        .checkbox-options {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 12px;
            background: white;
            border-radius: 8px;
            transition: background 0.2s ease;
        }

        .checkbox-label:hover {
            background: #f0f0f0;
        }

        .checkbox-label input[type=\"checkbox\"] {
            position: absolute;
            opacity: 0;
        }

        .checkbox-custom {
            width: 22px;
            height: 22px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .checkbox-label input[type=\"checkbox\"]:checked + .checkbox-custom {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border-color: #11998e;
        }

        .checkbox-label input[type=\"checkbox\"]:checked + .checkbox-custom::after {
            content: \"\\f00c\";
            font-family: \"Font Awesome 5 Free\";
            font-weight: 900;
            color: white;
            font-size: 12px;
        }

        .checkbox-text {
            font-size: 14px;
            color: #495057;
            font-weight: 500;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            padding-top: 20px;
            border-top: 2px solid #e0e0e0;
        }

        /* Reports Modal Styles */
        .reports-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .report-categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .report-category-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 2px solid #e0e0e0;
        }

        .report-category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .category-header {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .report-category-card.academic .category-header {
            background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);
        }

        .report-category-card.financial .category-header {
            background: linear-gradient(135deg, #11998e20 0%, #38ef7d20 100%);
        }

        .report-category-card.student .category-header {
            background: linear-gradient(135deg, #f093fb20 0%, #f5576c20 100%);
        }

        .report-category-card.faculty .category-header {
            background: linear-gradient(135deg, #ffc10720 0%, #ff980020 100%);
        }

        .report-category-card.examination .category-header {
            background: linear-gradient(135deg, #4facfe20 0%, #00f2fe20 100%);
        }

        .report-category-card.library .category-header {
            background: linear-gradient(135deg, #43e97b20 0%, #38f9d720 100%);
        }

        .category-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 24px;
            color: white;
        }

        .report-category-card.academic .category-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .report-category-card.financial .category-icon {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .report-category-card.student .category-icon {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .report-category-card.faculty .category-icon {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        }

        .report-category-card.examination .category-icon {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .report-category-card.library .category-icon {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .category-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
        }

        .category-description {
            padding: 15px 20px;
            font-size: 13px;
            color: #7f8c8d;
            background: #f8f9fa;
            border-bottom: 1px solid #e0e0e0;
        }

        .report-list {
            padding: 15px;
        }

        .report-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            margin-bottom: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .report-item:last-child {
            margin-bottom: 0;
        }

        .report-item:hover {
            background: white;
            border-color: #667eea;
            transform: translateX(5px);
        }

        .report-item > i {
            font-size: 24px;
            color: #667eea;
            width: 30px;
            text-align: center;
        }

        .report-info {
            flex: 1;
        }

        .report-info h4 {
            margin: 0 0 4px 0;
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        .report-info p {
            margin: 0;
            font-size: 12px;
            color: #7f8c8d;
        }

        .generate-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .generate-btn:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .custom-report-section {
            background: linear-gradient(135deg, #667eea10 0%, #764ba210 100%);
            padding: 25px;
            border-radius: 12px;
            border: 2px solid #667eea30;
            margin-bottom: 25px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .section-header h3 {
            margin: 0 0 8px 0;
            font-size: 20px;
            color: #2c3e50;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .section-header h3 i {
            color: #667eea;
        }

        .section-header p {
            margin: 0;
            font-size: 14px;
            color: #7f8c8d;
        }

        .custom-report-form {
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        .form-row-inline {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            align-items: end;
        }

        .form-field {
            display: flex;
            flex-direction: column;
        }

        .form-field label {
            font-size: 13px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        .form-field select {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-field select:hover,
        .form-field select:focus {
            border-color: #667eea;
            outline: none;
        }

        .form-field button {
            margin-top: 0;
        }

        .report-stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-left: 4px solid;
            transition: all 0.3s ease;
        }

        .stat-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .stat-box:nth-child(1) {
            border-left-color: #667eea;
        }

        .stat-box:nth-child(2) {
            border-left-color: #00d4aa;
        }

        .stat-box:nth-child(3) {
            border-left-color: #4facfe;
        }

        .stat-box:nth-child(4) {
            border-left-color: #ffc107;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 24px;
            color: white;
        }

        .stat-icon.academic {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-icon.success {
            background: linear-gradient(135deg, #00d4aa 0%, #00b894 100%);
        }

        .stat-icon.info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-icon.warning {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        }

        .stat-details h4 {
            margin: 0 0 4px 0;
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
        }

        .stat-details p {
            margin: 0;
            font-size: 13px;
            color: #7f8c8d;
        }

        /* Reports Responsive Styles */
        @media (max-width: 1200px) {
            .report-categories-grid {
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .report-categories-grid {
                grid-template-columns: 1fr;
            }

            .form-row-inline {
                grid-template-columns: 1fr;
            }

            .report-stats-overview {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .report-stats-overview {
                grid-template-columns: 1fr;
            }

            .category-header {
                flex-direction: column;
                text-align: center;
            }
        }

        /* Payment Form Responsive Styles */
        @media (max-width: 768px) {
            .medium-modal {
                width: 95%;
                max-width: none;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .payment-method-selector {
                grid-template-columns: repeat(2, 1fr);
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions button {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .payment-method-selector {
                grid-template-columns: 1fr;
            }

            .form-section {
                padding: 15px;
            }
        }

        /* Finance Responsive Styles */
        @media (max-width: 1400px) {
            .finance-toolbar {
                flex-direction: column;
            }

            .finance-toolbar .toolbar-actions {
                margin-left: 0;
                width: 100%;
            }

            .finance-toolbar .toolbar-actions button {
                flex: 1;
            }
        }

        @media (max-width: 992px) {
            .finance-stats-row {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .finance-toolbar .search-box {
                min-width: 100%;
            }

            .finance-toolbar .toolbar-filters {
                width: 100%;
            }

            .finance-toolbar .toolbar-filters select {
                flex: 1;
            }

            .finance-stats-row {
                grid-template-columns: 1fr;
            }

            .finance-stat-card {
                padding: 20px;
            }

            .finance-stat-card .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 24px;
            }

            .finance-stat-card .stat-info h3 {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            .finance-toolbar {
                padding: 15px;
                gap: 15px;
            }

            .finance-toolbar .toolbar-actions {
                flex-direction: column;
            }

            .finance-toolbar .toolbar-actions button {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .recipient-cards {
                grid-template-columns: 1fr;
            }

            .notification-type-selector {
                grid-template-columns: repeat(2, 1fr);
            }

            .priority-selector {
                grid-template-columns: 1fr;
            }

            .send-time-options {
                grid-template-columns: 1fr;
            }

            .notification-summary {
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

            .form-row {
                grid-template-columns: 1fr;
            }

            
            .user-mgmt-toolbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
                background: #f8f9fa;
                border-bottom: 1px solid #e1e8ed;
                flex-wrap: wrap;
                gap: 15px;
            }

            .toolbar-left {
                flex: 1;
                min-width: 300px;
            }

            .toolbar-right {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            .search-box-inline {
                position: relative;
                width: 100%;
                max-width: 500px;
            }

            .search-box-inline i {
                position: absolute;
                left: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: #6c757d;
                font-size: 14px;
            }

            .search-box-inline input {
                width: 100%;
                padding: 12px 15px 12px 40px;
                border: 1px solid #ddd;
                border-radius: 8px;
                font-size: 14px;
                transition: all 0.3s;
            }

            .search-box-inline input:focus {
                outline: none;
                border-color: #4facfe;
                box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
            }

            .filter-select {
                padding: 10px 15px;
                border: 1px solid #ddd;
                border-radius: 8px;
                font-size: 14px;
                background: white;
                cursor: pointer;
                transition: all 0.3s;
            }

            .filter-select:hover {
                border-color: #4facfe;
            }

            .filter-select:focus {
                outline: none;
                border-color: #4facfe;
                box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
            }

            .btn-toolbar {
                padding: 10px 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background: white;
                cursor: pointer;
                font-size: 14px;
                font-weight: 500;
                transition: all 0.3s;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }

            .btn-toolbar:hover {
                background: #f8f9fa;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            }

            .btn-toolbar.primary {
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                color: white;
                border: none;
            }

            .btn-toolbar.primary:hover {
                background: linear-gradient(135deg, #3d9ce5 0%, #00d9e5 100%);
            }

            .user-stats-row {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
                padding: 20px;
                background: white;
            }

            .user-stat-card {
                display: flex;
                align-items: center;
                gap: 15px;
                padding: 20px;
                background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
                border-radius: 12px;
                border: 1px solid #e1e8ed;
                transition: all 0.3s;
            }

            .user-stat-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            }

            .user-stat-card i {
                font-size: 32px;
                color: #4facfe;
                width: 50px;
                height: 50px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(79, 172, 254, 0.1);
                border-radius: 10px;
            }

            .user-stat-card h4 {
                margin: 0;
                font-size: 28px;
                color: #2c3e50;
                font-weight: 700;
            }

            .user-stat-card p {
                margin: 0;
                font-size: 14px;
                color: #6c757d;
            }

            .user-table-container {
                padding: 20px;
                overflow-x: auto;
            }

            .user-management-table {
                width: 100%;
                border-collapse: collapse;
                background: white;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            }

            .user-management-table thead {
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                color: white;
            }

            .user-management-table th {
                padding: 15px;
                text-align: left;
                font-weight: 600;
                font-size: 14px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .user-management-table td {
                padding: 15px;
                border-bottom: 1px solid #e1e8ed;
                font-size: 14px;
                color: #495057;
            }

            .user-management-table tbody tr {
                transition: all 0.3s;
            }

            .user-management-table tbody tr:hover {
                background: #f8f9fa;
            }

            .user-cell-info {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .user-avatar-small {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: 700;
                font-size: 14px;
                flex-shrink: 0;
            }

            .user-details h4 {
                margin: 0;
                font-size: 14px;
                font-weight: 600;
                color: #2c3e50;
            }

            .user-details p {
                margin: 3px 0 0 0;
                font-size: 12px;
                color: #6c757d;
            }

            .role-badge {
                padding: 6px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                text-transform: capitalize;
                display: inline-block;
            }

            .role-badge.student {
                background: rgba(79, 172, 254, 0.15);
                color: #4facfe;
            }

            .role-badge.lecturer {
                background: rgba(102, 126, 234, 0.15);
                color: #667eea;
            }

            .role-badge.exam {
                background: rgba(67, 233, 123, 0.15);
                color: #43e97b;
            }

            .role-badge.library {
                background: rgba(250, 112, 154, 0.15);
                color: #fa709a;
            }

            .role-badge.finance {
                background: rgba(254, 225, 64, 0.15);
                color: #d4a800;
            }

            .role-badge.admin {
                background: rgba(255, 107, 107, 0.15);
                color: #ff6b6b;
            }

            .status-badge {
                padding: 6px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                text-transform: capitalize;
                display: inline-block;
            }

            .status-badge.active {
                background: rgba(67, 233, 123, 0.15);
                color: #43e97b;
            }

            .status-badge.inactive {
                background: rgba(255, 107, 107, 0.15);
                color: #ff6b6b;
            }

            .status-badge.pending {
                background: rgba(254, 225, 64, 0.15);
                color: #d4a800;
            }

            .action-btns {
                display: flex;
                gap: 8px;
            }

            .action-btn {
                width: 35px;
                height: 35px;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s;
                font-size: 14px;
            }

            .action-btn.view {
                background: rgba(79, 172, 254, 0.15);
                color: #4facfe;
            }

            .action-btn.view:hover {
                background: #4facfe;
                color: white;
                transform: scale(1.1);
            }

            .action-btn.edit {
                background: rgba(254, 225, 64, 0.15);
                color: #d4a800;
            }

            .action-btn.edit:hover {
                background: #fee140;
                color: #2c3e50;
                transform: scale(1.1);
            }

            .action-btn.delete {
                background: rgba(255, 107, 107, 0.15);
                color: #ff6b6b;
            }

            .action-btn.delete:hover {
                background: #ff6b6b;
                color: white;
                transform: scale(1.1);
            }

            .user-pagination {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
                background: #f8f9fa;
                border-top: 1px solid #e1e8ed;
                flex-wrap: wrap;
                gap: 15px;
            }

            .pagination-info {
                color: #6c757d;
                font-size: 14px;
            }

            .pagination-controls {
                display: flex;
                gap: 8px;
                align-items: center;
            }

            .pagination-btn {
                min-width: 35px;
                height: 35px;
                padding: 0 12px;
                border: 1px solid #ddd;
                background: white;
                border-radius: 8px;
                cursor: pointer;
                font-size: 14px;
                font-weight: 500;
                transition: all 0.3s;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .pagination-btn:hover:not(:disabled) {
                background: #f8f9fa;
                border-color: #4facfe;
                color: #4facfe;
            }

            .pagination-btn.active {
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                color: white;
                border-color: #4facfe;
            }

            .pagination-btn:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }

            .pagination-size {
                display: flex;
                align-items: center;
            }

            .bulk-actions-bar {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
                color: white;
                padding: 15px 30px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                box-shadow: 0 -4px 12px rgba(0,0,0,0.2);
                z-index: 9999;
                animation: slideUp 0.3s ease-out;
            }

            @keyframes slideUp {
                from {
                    transform: translateY(100%);
                }
                to {
                    transform: translateY(0);
                }
            }

            .selected-count {
                font-size: 16px;
                font-weight: 500;
            }

            .bulk-actions {
                display: flex;
                gap: 10px;
            }

            .bulk-action-btn {
                padding: 10px 20px;
                border: 1px solid rgba(255,255,255,0.3);
                background: rgba(255,255,255,0.1);
                color: white;
                border-radius: 8px;
                cursor: pointer;
                font-size: 14px;
                font-weight: 500;
                transition: all 0.3s;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }

            .bulk-action-btn:hover {
                background: rgba(255,255,255,0.2);
                transform: translateY(-2px);
            }

            .bulk-action-btn.danger {
                background: rgba(255, 107, 107, 0.3);
                border-color: rgba(255, 107, 107, 0.5);
            }

            .bulk-action-btn.danger:hover {
                background: rgba(255, 107, 107, 0.5);
            }

            .checkbox-container {
                display: block;
                position: relative;
                padding-left: 25px;
                cursor: pointer;
                font-size: 14px;
                user-select: none;
            }

            .checkbox-container input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }

            .checkbox-container .checkmark {
                position: absolute;
                top: 50%;
                left: 0;
                transform: translateY(-50%);
                height: 20px;
                width: 20px;
                background-color: white;
                border: 2px solid #ddd;
                border-radius: 4px;
                transition: all 0.3s;
            }

            .checkbox-container:hover input ~ .checkmark {
                border-color: #4facfe;
            }

            .checkbox-container input:checked ~ .checkmark {
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                border-color: #4facfe;
            }

            .checkbox-container .checkmark:after {
                content: "";
                position: absolute;
                display: none;
                left: 6px;
                top: 2px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 2px 2px 0;
                transform: rotate(45deg);
            }

            .checkbox-container input:checked ~ .checkmark:after {
                display: block;
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

        
        .section-container {
            display: none;
        }

        .section-container.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        .section-header {
            background: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .section-title h1 {
            font-size: 32px;
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-title h1 i {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
        }

        .section-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .action-button {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
        }

        .action-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .filter-section {
            background: white;
            padding: 25px 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .filter-group label {
            font-size: 13px;
            font-weight: 600;
            color: #2c3e50;
        }

        .filter-control {
            padding: 10px 15px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .filter-control:focus {
            outline: none;
            border-color: #1e3c72;
        }

        .filter-button {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-button.primary {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
        }

        .filter-button.secondary {
            background: #f8f9fa;
            color: #2c3e50;
        }

        .filter-button:hover {
            transform: translateY(-2px);
        }

        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .item-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .item-header {
            padding: 20px;
            position: relative;
            color: white;
        }

        .item-header.course {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .item-header.exam {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .item-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .item-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .item-code {
            font-size: 13px;
            opacity: 0.9;
            font-weight: 600;
        }

        .item-body {
            padding: 20px;
        }

        .item-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 15px;
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #5a6c7d;
        }

        .info-row i {
            width: 20px;
            color: #1e3c72;
        }

        .info-row strong {
            color: #2c3e50;
        }

        .item-footer {
            padding: 15px 20px;
            background: #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-actions {
            display: flex;
            gap: 8px;
        }

        .icon-btn {
            width: 36px;
            height: 36px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .icon-btn.view {
            background: #e3f2fd;
            color: #1976d2;
        }

        .icon-btn.view:hover {
            background: #1976d2;
            color: white;
        }

        .icon-btn.edit {
            background: #fff3e0;
            color: #f57c00;
        }

        .icon-btn.edit:hover {
            background: #f57c00;
            color: white;
        }

        .icon-btn.delete {
            background: #ffebee;
            color: #c62828;
        }

        .icon-btn.delete:hover {
            background: #c62828;
            color: white;
        }

        .item-stats {
            display: flex;
            gap: 15px;
            font-size: 13px;
            color: #5a6c7d;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stat-item i {
            color: #1e3c72;
        }

        .no-items {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .no-items i {
            font-size: 64px;
            color: #e0e6ed;
            margin-bottom: 20px;
        }

        .no-items h3 {
            font-size: 20px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .no-items p {
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        .level-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .level-badge.beginner {
            background: #d4edda;
            color: #155724;
        }

        .level-badge.intermediate {
            background: #d1ecf1;
            color: #0c5460;
        }

        .level-badge.advanced {
            background: #fff3cd;
            color: #856404;
        }

        .level-badge.expert {
            background: #f8d7da;
            color: #721c24;
        }

        .exam-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
        }

        .exam-status.scheduled {
            background: #d1ecf1;
            color: #0c5460;
        }

        .exam-status.ongoing {
            background: #d4edda;
            color: #155724;
        }

        .exam-status.completed {
            background: #e2e3e5;
            color: #383d41;
        }

        .exam-status.cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        /* Enhanced Courses UI Styles */
        .courses-stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-mini-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 4px solid;
            transition: all 0.3s ease;
        }

        .stat-mini-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-mini-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-mini-content h4 {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stat-mini-content p {
            font-size: 13px;
            color: #7f8c8d;
            font-weight: 500;
        }

        .counter {
            display: inline-block;
        }

        .view-toggle {
            display: flex;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 4px;
            gap: 4px;
        }

        .view-btn {
            padding: 8px 12px;
            border: none;
            background: transparent;
            color: #6c757d;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .view-btn:hover {
            background: white;
            color: #2c3e50;
        }

        .view-btn.active {
            background: white;
            color: #1e3c72;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .filter-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .filter-left, .filter-right {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-container input[type="checkbox"] {
            display: none;
        }

        .checkmark {
            width: 20px;
            height: 20px;
            border: 2px solid #e0e6ed;
            border-radius: 4px;
            display: inline-block;
            position: relative;
            transition: all 0.3s ease;
        }

        .checkbox-container input:checked ~ .checkmark {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            border-color: #43e97b;
        }

        .checkbox-container input:checked ~ .checkmark:after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 14px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .bulk-actions-courses {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            background: #e3f2fd;
            border-radius: 8px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .bulk-actions-courses span {
            font-size: 13px;
            font-weight: 600;
            color: #1976d2;
        }

        .bulk-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .bulk-btn:not(.danger) {
            background: white;
            color: #1976d2;
            border: 1px solid #1976d2;
        }

        .bulk-btn:not(.danger):hover {
            background: #1976d2;
            color: white;
        }

        .bulk-btn.danger {
            background: white;
            color: #c62828;
            border: 1px solid #c62828;
        }

        .bulk-btn.danger:hover {
            background: #c62828;
            color: white;
        }

        .sort-control {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sort-control label {
            font-size: 13px;
            font-weight: 600;
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .filter-control.compact {
            padding: 8px 12px;
            font-size: 13px;
        }

        .results-count {
            font-size: 13px;
            color: #7f8c8d;
            padding: 8px 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .results-count strong {
            color: #2c3e50;
            font-weight: 700;
        }

        .course-card {
            position: relative;
        }

        .card-checkbox {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 10;
            cursor: pointer;
        }

        .card-checkbox input[type="checkbox"] {
            display: none;
        }

        .checkbox-custom {
            width: 22px;
            height: 22px;
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            position: relative;
            transition: all 0.3s ease;
        }

        .card-checkbox input:checked ~ .checkbox-custom {
            background: white;
            border-color: white;
        }

        .card-checkbox input:checked ~ .checkbox-custom:after {
            content: '✓';
            position: absolute;
            color: #43e97b;
            font-size: 16px;
            font-weight: bold;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .item-badge.pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .item-badge.upcoming {
            background: rgba(255, 193, 7, 0.3);
        }

        .course-progress-section {
            padding: 12px 0;
            margin-bottom: 12px;
            border-bottom: 1px solid #f0f0f0;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .progress-label {
            font-size: 12px;
            color: #7f8c8d;
            font-weight: 600;
        }

        .progress-value {
            font-size: 13px;
            color: #2c3e50;
            font-weight: 700;
        }

        .progress-bar-container {
            height: 6px;
            background: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            border-radius: 10px;
            transition: width 0.5s ease;
            position: relative;
            overflow: hidden;
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }

        .quick-preview {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 5;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .course-card:hover .quick-preview {
            opacity: 1;
            visibility: visible;
        }

        .preview-content {
            color: white;
            text-align: left;
        }

        .preview-content h4 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #43e97b;
        }

        .preview-content p {
            font-size: 14px;
            margin-bottom: 8px;
            color: rgba(255, 255, 255, 0.9);
        }

        .preview-content strong {
            color: white;
            font-weight: 600;
        }

        .items-grid.list-view {
            grid-template-columns: 1fr;
        }

        .items-grid.list-view .item-card {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 20px;
            align-items: center;
        }

        .items-grid.list-view .item-header {
            width: 200px;
        }

        .items-grid.list-view .item-body {
            flex: 1;
        }

        .items-grid.list-view .item-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
        }

        @media (max-width: 768px) {
            .items-grid {
                grid-template-columns: 1fr;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                flex-direction: column;
                align-items: flex-start;
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
                    <a href="#" class="nav-link" onclick="showCoursesSection(); return false;">
                        <i class="fas fa-book"></i>
                        <span class="nav-text">Courses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="showExaminationsSection(); return false;">
                        <i class="fas fa-file-alt"></i>
                        <span class="nav-text">Examinations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="showLibrarySection()">
                        <i class="fas fa-book-reader"></i>
                        <span class="nav-text">Library</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="showFinanceSection()">
                        <i class="fas fa-credit-card"></i>
                        <span class="nav-text">Finance</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="showReportsSection()">
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

    
    <div class="modal" id="createCourseModal">
        <div class="modal-content" style="max-width: 900px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <h2><i class="fas fa-graduation-cap"></i> Create New Course</h2>
                <button class="close-btn" onclick="closeModal('createCourseModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="createCourseForm" method="POST" action="" enctype="multipart/form-data">
                    
                    
                    <div class="form-steps">
                        <div class="step active" data-step="1">
                            <div class="step-number">1</div>
                            <div class="step-text">Basic Info</div>
                        </div>
                        <div class="step" data-step="2">
                            <div class="step-number">2</div>
                            <div class="step-text">Details</div>
                        </div>
                        <div class="step" data-step="3">
                            <div class="step-number">3</div>
                            <div class="step-text">Settings</div>
                        </div>
                    </div>

                    
                    <div class="form-step active" data-step="1">
                        <h3 class="step-title"><i class="fas fa-info-circle"></i> Basic Information</h3>
                        
                        <div class="form-group">
                            <label>Course Title <span class="required">*</span></label>
                            <input type="text" name="course_title" class="form-control" placeholder="e.g., Introduction to Web Development" required>
                            <small class="form-hint">Enter a clear and descriptive course title</small>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Course Code <span class="required">*</span></label>
                                <input type="text" name="course_code" class="form-control" placeholder="e.g., CS101" required>
                            </div>
                            <div class="form-group">
                                <label>Credits <span class="required">*</span></label>
                                <input type="number" name="credits" class="form-control" min="1" max="10" placeholder="3" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Course Description <span class="required">*</span></label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Provide a comprehensive description of the course objectives and content..." required></textarea>
                            <div class="character-count">
                                <span class="current">0</span> / <span class="max">500</span> characters
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Course Category <span class="required">*</span></label>
                            <select name="category" class="form-control" required>
                                <option value="">Select Category</option>
                                <option value="computer_science">Computer Science</option>
                                <option value="mathematics">Mathematics</option>
                                <option value="engineering">Engineering</option>
                                <option value="business">Business Administration</option>
                                <option value="sciences">Natural Sciences</option>
                                <option value="humanities">Humanities</option>
                                <option value="arts">Arts & Design</option>
                                <option value="health">Health Sciences</option>
                                <option value="social_sciences">Social Sciences</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Course Thumbnail</label>
                            <div class="file-upload-area">
                                <input type="file" id="courseThumbnail" name="thumbnail" accept="image/*" hidden>
                                <label for="courseThumbnail" class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Click to upload or drag and drop</span>
                                    <small>PNG, JPG or JPEG (Max 2MB)</small>
                                </label>
                                <div class="file-preview" style="display: none;">
                                    <img src="" alt="Preview" id="thumbnailPreview">
                                    <button type="button" class="remove-file" onclick="removeThumbnail()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                
                    <div class="form-step" data-step="2">
                        <h3 class="step-title"><i class="fas fa-list-ul"></i> Course Details</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Semester <span class="required">*</span></label>
                                <select name="semester" class="form-control" required>
                                    <option value="">Select Semester</option>
                                    <option value="1">First Semester</option>
                                    <option value="2">Second Semester</option>
                                    <option value="summer">Summer Session</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Academic Year <span class="required">*</span></label>
                                <input type="text" name="academic_year" class="form-control" placeholder="2024/2025" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Course Level <span class="required">*</span></label>
                                <select name="level" class="form-control" required>
                                    <option value="">Select Level</option>
                                    <option value="100">100 Level</option>
                                    <option value="200">200 Level</option>
                                    <option value="300">300 Level</option>
                                    <option value="400">400 Level</option>
                                    <option value="500">500 Level (Masters)</option>
                                    <option value="600">600 Level (PhD)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Max Students</label>
                                <input type="number" name="max_students" class="form-control" placeholder="50" min="1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Prerequisites</label>
                            <input type="text" name="prerequisites" class="form-control" placeholder="e.g., CS100, MATH101">
                            <small class="form-hint">Enter course codes separated by commas</small>
                        </div>

                        <div class="form-group">
                            <label>Assigned Lecturer <span class="required">*</span></label>
                            <select name="lecturer_id" class="form-control" required>
                                <option value="">Select Lecturer</option>
                                <option value="1">Dr. John Smith - Computer Science</option>
                                <option value="2">Prof. Sarah Johnson - Mathematics</option>
                                <option value="3">Dr. Michael Brown - Engineering</option>
                                <option value="4">Dr. Emily Davis - Business</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Course Duration <span class="required">*</span></label>
                            <div class="duration-options">
                                <div class="duration-option">
                                    <input type="radio" name="duration" value="8" id="duration-8" required>
                                    <label for="duration-8">
                                        <i class="fas fa-calendar"></i>
                                        <span>8 Weeks</span>
                                    </label>
                                </div>
                                <div class="duration-option">
                                    <input type="radio" name="duration" value="12" id="duration-12">
                                    <label for="duration-12">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>12 Weeks</span>
                                    </label>
                                </div>
                                <div class="duration-option">
                                    <input type="radio" name="duration" value="16" id="duration-16">
                                    <label for="duration-16">
                                        <i class="fas fa-calendar-check"></i>
                                        <span>16 Weeks</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Start Date <span class="required">*</span></label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>End Date <span class="required">*</span></label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                        </div>
                    </div>

                
                    <div class="form-step" data-step="3">
                        <h3 class="step-title"><i class="fas fa-cog"></i> Course Settings</h3>
                        
                        <div class="settings-section">
                            <h4><i class="fas fa-graduation-cap"></i> Learning Outcomes</h4>
                            <div id="learningOutcomes">
                                <div class="outcome-item">
                                    <input type="text" name="outcomes[]" class="form-control" placeholder="Enter learning outcome">
                                    <button type="button" class="btn-remove-outcome" onclick="removeOutcome(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn-add-more" onclick="addLearningOutcome()">
                                <i class="fas fa-plus-circle"></i> Add Another Outcome
                            </button>
                        </div>

                        <div class="settings-section">
                            <h4><i class="fas fa-file-alt"></i> Assessment & Grading</h4>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Assignment Weight (%)</label>
                                    <input type="number" name="assignment_weight" class="form-control" min="0" max="100" placeholder="30">
                                </div>
                                <div class="form-group">
                                    <label>Exam Weight (%)</label>
                                    <input type="number" name="exam_weight" class="form-control" min="0" max="100" placeholder="70">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Passing Grade (%)</label>
                                    <input type="number" name="passing_grade" class="form-control" min="0" max="100" placeholder="50" required>
                                </div>
                                <div class="form-group">
                                    <label>Grading Scale</label>
                                    <select name="grading_scale" class="form-control">
                                        <option value="letter">Letter (A, B, C, D, F)</option>
                                        <option value="percentage">Percentage (0-100)</option>
                                        <option value="gpa">GPA (0.0-4.0)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="settings-section">
                            <h4><i class="fas fa-toggle-on"></i> Course Features</h4>
                            <div class="feature-toggles">
                                <div class="toggle-item">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="allow_enrollment" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <div class="toggle-info">
                                        <strong>Allow Enrollment</strong>
                                        <p>Students can enroll in this course</p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="discussion_forum">
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <div class="toggle-info">
                                        <strong>Discussion Forum</strong>
                                        <p>Enable course discussion board</p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="automatic_grading">
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <div class="toggle-info">
                                        <strong>Automatic Grading</strong>
                                        <p>Auto-calculate final grades</p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="certificate">
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <div class="toggle-info">
                                        <strong>Issue Certificate</strong>
                                        <p>Award certificate upon completion</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="settings-section">
                            <h4><i class="fas fa-eye"></i> Visibility & Access</h4>
                            <div class="form-group">
                                <label>Course Status <span class="required">*</span></label>
                                <div class="status-options">
                                    <div class="status-option">
                                        <input type="radio" name="status" value="draft" id="status-draft" required>
                                        <label for="status-draft">
                                            <i class="fas fa-file-alt"></i>
                                            <span>Draft</span>
                                            <small>Not visible to students</small>
                                        </label>
                                    </div>
                                    <div class="status-option">
                                        <input type="radio" name="status" value="published" id="status-published">
                                        <label for="status-published">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Published</span>
                                            <small>Visible and enrollable</small>
                                        </label>
                                    </div>
                                    <div class="status-option">
                                        <input type="radio" name="status" value="archived" id="status-archived">
                                        <label for="status-archived">
                                            <i class="fas fa-archive"></i>
                                            <span>Archived</span>
                                            <small>Completed, read-only</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                
                    <div class="form-navigation">
                        <button type="button" class="btn btn-prev" onclick="previousStep()" style="display: none;">
                            <i class="fas fa-arrow-left"></i> Previous
                        </button>
                        <button type="button" class="btn btn-next" onclick="nextStep()">
                            Next <i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="submit" class="btn btn-submit" style="display: none;">
                            <i class="fas fa-check"></i> Create Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal" id="scheduleExamModal">
        <div class="modal-content" style="max-width: 900px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <h2><i class="fas fa-file-alt"></i> Schedule New Examination</h2>
                <button class="close-btn" onclick="closeModal('scheduleExamModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="scheduleExamForm" method="POST" action="">
                    
                
                    <div class="form-steps">
                        <div class="step active" data-step="1">
                            <div class="step-number">1</div>
                            <div class="step-text">Exam Info</div>
                        </div>
                        <div class="step" data-step="2">
                            <div class="step-number">2</div>
                            <div class="step-text">Schedule</div>
                        </div>
                        <div class="step" data-step="3">
                            <div class="step-number">3</div>
                            <div class="step-text">Settings</div>
                        </div>
                    </div>

                
                    <div class="form-step active" data-step="1">
                        <h3 class="step-title"><i class="fas fa-info-circle"></i> Examination Information</h3>
                        
                        <div class="form-group">
                            <label>Exam Title <span class="required">*</span></label>
                            <input type="text" name="exam_title" class="form-control" placeholder="e.g., Mid-Semester Examination - Web Development" required>
                            <small class="form-hint">Enter a clear and descriptive exam title</small>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Exam Code <span class="required">*</span></label>
                                <input type="text" name="exam_code" class="form-control" placeholder="e.g., EX-CS101-2024" required>
                            </div>
                            <div class="form-group">
                                <label>Exam Type <span class="required">*</span></label>
                                <select name="exam_type" class="form-control" required>
                                    <option value="">Select Type</option>
                                    <option value="midterm">Mid-Semester Exam</option>
                                    <option value="final">Final Exam</option>
                                    <option value="quiz">Quiz</option>
                                    <option value="test">Class Test</option>
                                    <option value="practical">Practical Exam</option>
                                    <option value="oral">Oral Examination</option>
                                    <option value="project">Project Defense</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Course/Subject <span class="required">*</span></label>
                            <select name="course_id" class="form-control" required>
                                <option value="">Select Course</option>
                                <option value="1">CS101 - Introduction to Web Development</option>
                                <option value="2">CS102 - Data Structures and Algorithms</option>
                                <option value="3">MATH201 - Calculus II</option>
                                <option value="4">ENG101 - Engineering Drawing</option>
                                <option value="5">BUS201 - Business Management</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Exam Description</label>
                            <textarea name="exam_description" class="form-control" rows="4" placeholder="Provide additional details about the examination scope, chapters covered, format, etc..."></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Academic Level <span class="required">*</span></label>
                                <select name="level" class="form-control" required>
                                    <option value="">Select Level</option>
                                    <option value="100">100 Level</option>
                                    <option value="200">200 Level</option>
                                    <option value="300">300 Level</option>
                                    <option value="400">400 Level</option>
                                    <option value="500">500 Level (Masters)</option>
                                    <option value="600">600 Level (PhD)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Semester <span class="required">*</span></label>
                                <select name="semester" class="form-control" required>
                                    <option value="">Select Semester</option>
                                    <option value="1">First Semester</option>
                                    <option value="2">Second Semester</option>
                                    <option value="summer">Summer Session</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Exam Format <span class="required">*</span></label>
                            <div class="exam-format-options">
                                <div class="format-option">
                                    <input type="radio" name="format" value="written" id="format-written" required>
                                    <label for="format-written">
                                        <i class="fas fa-pen"></i>
                                        <span>Written Exam</span>
                                        <small>Paper-based exam</small>
                                    </label>
                                </div>
                                <div class="format-option">
                                    <input type="radio" name="format" value="online" id="format-online">
                                    <label for="format-online">
                                        <i class="fas fa-laptop"></i>
                                        <span>Online Exam</span>
                                        <small>Computer-based test</small>
                                    </label>
                                </div>
                                <div class="format-option">
                                    <input type="radio" name="format" value="practical" id="format-practical">
                                    <label for="format-practical">
                                        <i class="fas fa-flask"></i>
                                        <span>Practical</span>
                                        <small>Lab/Hands-on exam</small>
                                    </label>
                                </div>
                                <div class="format-option">
                                    <input type="radio" name="format" value="hybrid" id="format-hybrid">
                                    <label for="format-hybrid">
                                        <i class="fas fa-random"></i>
                                        <span>Hybrid</span>
                                        <small>Mixed format</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-step" data-step="2">
                        <h3 class="step-title"><i class="fas fa-calendar-alt"></i> Schedule & Logistics</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Exam Date <span class="required">*</span></label>
                                <input type="date" name="exam_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Duration (Minutes) <span class="required">*</span></label>
                                <select name="duration" class="form-control" required>
                                    <option value="">Select Duration</option>
                                    <option value="30">30 Minutes</option>
                                    <option value="45">45 Minutes</option>
                                    <option value="60">1 Hour</option>
                                    <option value="90">1.5 Hours</option>
                                    <option value="120">2 Hours</option>
                                    <option value="150">2.5 Hours</option>
                                    <option value="180">3 Hours</option>
                                    <option value="240">4 Hours</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Start Time <span class="required">*</span></label>
                                <input type="time" name="start_time" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>End Time <span class="required">*</span></label>
                                <input type="time" name="end_time" class="form-control" required>
                                <small class="form-hint">Automatically calculated based on duration</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Examination Venue <span class="required">*</span></label>
                            <div class="venue-selector">
                                <select name="venue_type" class="form-control" id="venueType" required>
                                    <option value="">Select Venue Type</option>
                                    <option value="hall">Examination Hall</option>
                                    <option value="classroom">Classroom</option>
                                    <option value="lab">Computer Lab</option>
                                    <option value="auditorium">Auditorium</option>
                                    <option value="online">Online (Remote)</option>
                                    <option value="field">Field/Outdoor</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="venueLocationGroup">
                            <label>Venue Location/Room <span class="required">*</span></label>
                            <input type="text" name="venue_location" class="form-control" placeholder="e.g., Main Hall A, Room 204, Lab 3" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Total Marks <span class="required">*</span></label>
                                <input type="number" name="total_marks" class="form-control" min="1" placeholder="100" required>
                            </div>
                            <div class="form-group">
                                <label>Passing Marks <span class="required">*</span></label>
                                <input type="number" name="passing_marks" class="form-control" min="1" placeholder="50" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Exam Supervisor/Invigilator <span class="required">*</span></label>
                            <select name="supervisor_id" class="form-control" required>
                                <option value="">Select Supervisor</option>
                                <option value="1">Dr. John Smith</option>
                                <option value="2">Prof. Sarah Johnson</option>
                                <option value="3">Dr. Michael Brown</option>
                                <option value="4">Dr. Emily Davis</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Additional Invigilators</label>
                            <div id="invigilatorsList">
                                <div class="invigilator-item">
                                    <select name="invigilators[]" class="form-control">
                                        <option value="">Select Invigilator</option>
                                        <option value="5">Ms. Jennifer Wilson</option>
                                        <option value="6">Mr. David Lee</option>
                                        <option value="7">Dr. Lisa Anderson</option>
                                        <option value="8">Prof. Robert Taylor</option>
                                    </select>
                                    <button type="button" class="btn-remove-invigilator" onclick="removeInvigilator(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn-add-more" onclick="addInvigilator()">
                                <i class="fas fa-plus-circle"></i> Add Another Invigilator
                            </button>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Expected Students</label>
                                <input type="number" name="expected_students" class="form-control" min="1" placeholder="50">
                            </div>
                            <div class="form-group">
                                <label>Seating Capacity</label>
                                <input type="number" name="seating_capacity" class="form-control" min="1" placeholder="60">
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-step" data-step="3">
                        <h3 class="step-title"><i class="fas fa-cog"></i> Exam Settings & Instructions</h3>
                        
                        <div class="settings-section">
                            <h4><i class="fas fa-clipboard-list"></i> Exam Instructions</h4>
                            <div id="instructionsList">
                                <div class="instruction-item">
                                    <input type="text" name="instructions[]" class="form-control" placeholder="Enter exam instruction" value="Students must arrive 15 minutes before exam time">
                                    <button type="button" class="btn-remove-outcome" onclick="removeInstruction(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="instruction-item">
                                    <input type="text" name="instructions[]" class="form-control" placeholder="Enter exam instruction" value="No electronic devices allowed except calculators">
                                    <button type="button" class="btn-remove-outcome" onclick="removeInstruction(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn-add-more" onclick="addInstruction()">
                                <i class="fas fa-plus-circle"></i> Add Another Instruction
                            </button>
                        </div>

                        <div class="settings-section">
                            <h4><i class="fas fa-file-alt"></i> Materials Required</h4>
                            <div class="materials-checklist">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="materials[]" value="answer_sheet">
                                    <span class="checkmark-inline"></span>
                                    <span>Answer Sheets</span>
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="materials[]" value="question_paper">
                                    <span class="checkmark-inline"></span>
                                    <span>Question Papers</span>
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="materials[]" value="calculator">
                                    <span class="checkmark-inline"></span>
                                    <span>Calculator Allowed</span>
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="materials[]" value="graph_paper">
                                    <span class="checkmark-inline"></span>
                                    <span>Graph Paper</span>
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="materials[]" value="formula_sheet">
                                    <span class="checkmark-inline"></span>
                                    <span>Formula Sheet</span>
                                </label>
                                <label class="checkbox-label">
                                    <input type="checkbox" name="materials[]" value="drawing_tools">
                                    <span class="checkmark-inline"></span>
                                    <span>Drawing Tools</span>
                                </label>
                            </div>
                        </div>

                        <div class="settings-section">
                            <h4><i class="fas fa-tools"></i> Exam Features</h4>
                            <div class="feature-toggles">
                                <div class="toggle-item">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="allow_late_entry">
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <div class="toggle-info">
                                        <strong>Allow Late Entry</strong>
                                        <p>Students can enter up to 15 minutes after start time</p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="randomize_questions">
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <div class="toggle-info">
                                        <strong>Randomize Questions</strong>
                                        <p>Different question order for each student</p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="enable_proctoring" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <div class="toggle-info">
                                        <strong>Enable Proctoring</strong>
                                        <p>Strict supervision and monitoring</p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="send_reminders" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <div class="toggle-info">
                                        <strong>Send Reminders</strong>
                                        <p>Automatic email/SMS reminders to students</p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="publish_results">
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <div class="toggle-info">
                                        <strong>Auto-Publish Results</strong>
                                        <p>Results visible to students after marking</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="settings-section">
                            <h4><i class="fas fa-bell"></i> Notification Settings</h4>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Notify Students</label>
                                    <select name="notify_timing" class="form-control">
                                        <option value="immediate">Immediately</option>
                                        <option value="1_day">1 Day Before</option>
                                        <option value="3_days">3 Days Before</option>
                                        <option value="1_week">1 Week Before</option>
                                        <option value="custom">Custom Date</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Notification Method</label>
                                    <select name="notification_method" class="form-control">
                                        <option value="both">Email & SMS</option>
                                        <option value="email">Email Only</option>
                                        <option value="sms">SMS Only</option>
                                        <option value="portal">Portal Notification</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="settings-section">
                            <h4><i class="fas fa-eye"></i> Exam Status</h4>
                            <div class="form-group">
                                <div class="status-options">
                                    <div class="status-option">
                                        <input type="radio" name="status" value="draft" id="exam-status-draft" required>
                                        <label for="exam-status-draft">
                                            <i class="fas fa-file-alt"></i>
                                            <span>Draft</span>
                                            <small>Not visible to students</small>
                                        </label>
                                    </div>
                                    <div class="status-option">
                                        <input type="radio" name="status" value="scheduled" id="exam-status-scheduled">
                                        <label for="exam-status-scheduled">
                                            <i class="fas fa-calendar-check"></i>
                                            <span>Scheduled</span>
                                            <small>Confirmed and visible</small>
                                        </label>
                                    </div>
                                    <div class="status-option">
                                        <input type="radio" name="status" value="published" id="exam-status-published">
                                        <label for="exam-status-published">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Published</span>
                                            <small>Active and ongoing</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Additional Notes</label>
                            <textarea name="admin_notes" class="form-control" rows="3" placeholder="Internal notes for administration purposes (not visible to students)"></textarea>
                        </div>
                    </div>

                    
                    <div class="form-navigation">
                        <button type="button" class="btn btn-prev" onclick="previousExamStep()" style="display: none;">
                            <i class="fas fa-arrow-left"></i> Previous
                        </button>
                        <button type="button" class="btn btn-next exam-next-btn" onclick="nextExamStep()">
                            Next <i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="submit" class="btn btn-submit exam-submit-btn" style="display: none;">
                            <i class="fas fa-check"></i> Schedule Exam
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal" id="sendNotificationModal">
        <div class="modal-content" style="max-width: 900px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h2><i class="fas fa-paper-plane"></i> Send Notification</h2>
                <button class="close-btn" onclick="closeModal('sendNotificationModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="sendNotificationForm" method="POST" action="">
                    
    
                    <div class="form-steps">
                        <div class="step active" data-step="1">
                            <div class="step-number">1</div>
                            <div class="step-text">Recipients</div>
                        </div>
                        <div class="step" data-step="2">
                            <div class="step-number">2</div>
                            <div class="step-text">Message</div>
                        </div>
                        <div class="step" data-step="3">
                            <div class="step-number">3</div>
                            <div class="step-text">Review & Send</div>
                        </div>
                    </div>

                    
                    <div class="form-step active" data-step="1">
                        <h3 class="step-title"><i class="fas fa-users"></i> Select Recipients</h3>
                        
                        <div class="form-group">
                            <label>Target Audience <span class="required">*</span></label>
                            <div class="recipient-cards">
                                <div class="recipient-card">
                                    <input type="radio" name="audience" value="all_students" id="audience-all-students" required>
                                    <label for="audience-all-students">
                                        <i class="fas fa-user-graduate"></i>
                                        <span>All Students</span>
                                        <small>1,245 recipients</small>
                                    </label>
                                </div>
                                <div class="recipient-card">
                                    <input type="radio" name="audience" value="all_lecturers" id="audience-all-lecturers">
                                    <label for="audience-all-lecturers">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                        <span>All Lecturers</span>
                                        <small>85 recipients</small>
                                    </label>
                                </div>
                                <div class="recipient-card">
                                    <input type="radio" name="audience" value="all_staff" id="audience-all-staff">
                                    <label for="audience-all-staff">
                                        <i class="fas fa-user-tie"></i>
                                        <span>All Staff</span>
                                        <small>156 recipients</small>
                                    </label>
                                </div>
                                <div class="recipient-card">
                                    <input type="radio" name="audience" value="everyone" id="audience-everyone">
                                    <label for="audience-everyone">
                                        <i class="fas fa-globe"></i>
                                        <span>Everyone</span>
                                        <small>1,486 recipients</small>
                                    </label>
                                </div>
                                <div class="recipient-card">
                                    <input type="radio" name="audience" value="custom" id="audience-custom">
                                    <label for="audience-custom">
                                        <i class="fas fa-filter"></i>
                                        <span>Custom Selection</span>
                                        <small>Filter by criteria</small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        
                        <div id="customFilters" style="display: none;">
                            <div class="filter-section-notification">
                                <h4><i class="fas fa-sliders-h"></i> Filter Recipients</h4>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>User Role</label>
                                        <select name="filter_role" class="form-control" multiple>
                                            <option value="student">Students</option>
                                            <option value="lecturer">Lecturers</option>
                                            <option value="exam_officer">Exam Officers</option>
                                            <option value="library_officer">Library Officers</option>
                                            <option value="finance_officer">Finance Officers</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Academic Level</label>
                                        <select name="filter_level" class="form-control" multiple>
                                            <option value="100">100 Level</option>
                                            <option value="200">200 Level</option>
                                            <option value="300">300 Level</option>
                                            <option value="400">400 Level</option>
                                            <option value="500">Masters</option>
                                            <option value="600">PhD</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select name="filter_department" class="form-control">
                                            <option value="">All Departments</option>
                                            <option value="cs">Computer Science</option>
                                            <option value="eng">Engineering</option>
                                            <option value="math">Mathematics</option>
                                            <option value="bus">Business Administration</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Course Enrollment</label>
                                        <select name="filter_course" class="form-control">
                                            <option value="">Any Course</option>
                                            <option value="1">CS101 - Web Development</option>
                                            <option value="2">CS102 - Data Structures</option>
                                            <option value="3">MATH201 - Calculus II</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="estimated-recipients">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Estimated Recipients: <strong id="recipientCount">0</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Additional Recipients (Optional)</label>
                            <input type="email" name="additional_emails" class="form-control" placeholder="email1@example.com, email2@example.com">
                            <small class="form-hint">Enter email addresses separated by commas</small>
                        </div>
                    </div>

                    
                    <div class="form-step" data-step="2">
                        <h3 class="step-title"><i class="fas fa-edit"></i> Compose Message</h3>
                        
                        <div class="form-group">
                            <label>Notification Type <span class="required">*</span></label>
                            <div class="notification-type-selector">
                                <label class="type-checkbox">
                                    <input type="checkbox" name="notification_type[]" value="email" checked>
                                    <span class="type-box">
                                        <i class="fas fa-envelope"></i>
                                        <span>Email</span>
                                    </span>
                                </label>
                                <label class="type-checkbox">
                                    <input type="checkbox" name="notification_type[]" value="sms">
                                    <span class="type-box">
                                        <i class="fas fa-sms"></i>
                                        <span>SMS</span>
                                    </span>
                                </label>
                                <label class="type-checkbox">
                                    <input type="checkbox" name="notification_type[]" value="push">
                                    <span class="type-box">
                                        <i class="fas fa-bell"></i>
                                        <span>Push</span>
                                    </span>
                                </label>
                                <label class="type-checkbox">
                                    <input type="checkbox" name="notification_type[]" value="portal">
                                    <span class="type-box">
                                        <i class="fas fa-browser"></i>
                                        <span>Portal</span>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Message Category <span class="required">*</span></label>
                            <select name="category" class="form-control" required>
                                <option value="">Select Category</option>
                                <option value="announcement">📢 General Announcement</option>
                                <option value="urgent">🚨 Urgent Alert</option>
                                <option value="exam">📝 Examination Notice</option>
                                <option value="event">📅 Event Reminder</option>
                                <option value="deadline">⏰ Deadline Alert</option>
                                <option value="payment">💳 Payment Notice</option>
                                <option value="results">📊 Results Notification</option>
                                <option value="maintenance">🔧 System Maintenance</option>
                                <option value="other">📌 Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Message Priority <span class="required">*</span></label>
                            <div class="priority-selector">
                                <div class="priority-option">
                                    <input type="radio" name="priority" value="low" id="priority-low" required>
                                    <label for="priority-low">
                                        <i class="fas fa-circle"></i>
                                        <span>Low</span>
                                        <small>Normal delivery</small>
                                    </label>
                                </div>
                                <div class="priority-option">
                                    <input type="radio" name="priority" value="medium" id="priority-medium">
                                    <label for="priority-medium">
                                        <i class="fas fa-circle"></i>
                                        <span>Medium</span>
                                        <small>Priority delivery</small>
                                    </label>
                                </div>
                                <div class="priority-option">
                                    <input type="radio" name="priority" value="high" id="priority-high">
                                    <label for="priority-high">
                                        <i class="fas fa-circle"></i>
                                        <span>High</span>
                                        <small>Urgent delivery</small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Subject/Title <span class="required">*</span></label>
                            <input type="text" name="subject" class="form-control" placeholder="e.g., Important Exam Schedule Update" required>
                        </div>

                        <div class="form-group">
                            <label>Message Content <span class="required">*</span></label>
                            <textarea name="message" id="notificationMessage" class="form-control" rows="8" placeholder="Type your message here..." required></textarea>
                            <div class="message-tools">
                                <div class="char-counter">
                                    <span id="charCount">0</span> / 1000 characters
                                </div>
                                <div class="message-templates">
                                    <button type="button" class="btn-template" onclick="loadTemplate('exam')">
                                        <i class="fas fa-file-alt"></i> Exam Template
                                    </button>
                                    <button type="button" class="btn-template" onclick="loadTemplate('event')">
                                        <i class="fas fa-calendar"></i> Event Template
                                    </button>
                                    <button type="button" class="btn-template" onclick="loadTemplate('deadline')">
                                        <i class="fas fa-clock"></i> Deadline Template
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Add Link (Optional)</label>
                            <input type="url" name="link_url" class="form-control" placeholder="https://example.com">
                            <small class="form-hint">Add a clickable link to your notification</small>
                        </div>

                        <div class="form-group">
                            <label>Attachments (Optional)</label>
                            <div class="file-upload-zone">
                                <input type="file" id="notificationAttachments" name="attachments[]" multiple hidden>
                                <label for="notificationAttachments" class="upload-zone-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Click to upload files</span>
                                    <small>PDF, DOC, DOCX, JPG, PNG (Max 5MB each)</small>
                                </label>
                                <div id="attachmentsList" class="attachments-list"></div>
                            </div>
                        </div>
                    </div>

                
                    <div class="form-step" data-step="3">
                        <h3 class="step-title"><i class="fas fa-check-circle"></i> Review & Send</h3>
                        
                        <div class="notification-preview">
                            <h4><i class="fas fa-eye"></i> Preview</h4>
                            <div class="preview-box">
                                <div class="preview-header">
                                    <div class="preview-icon">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="preview-title">
                                        <h5 id="previewSubject">Your notification subject will appear here</h5>
                                        <p id="previewCategory">Category: Not selected</p>
                                    </div>
                                    <span class="preview-priority" id="previewPriority">MEDIUM</span>
                                </div>
                                <div class="preview-body">
                                    <p id="previewMessage">Your message content will appear here...</p>
                                </div>
                                <div class="preview-footer">
                                    <span class="preview-date">
                                        <i class="fas fa-clock"></i> Now
                                    </span>
                                    <span class="preview-channels" id="previewChannels">
                                        <i class="fas fa-envelope"></i> Email
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="settings-section">
                            <h4><i class="fas fa-cog"></i> Delivery Options</h4>
                            
                            <div class="form-group">
                                <label>Send Time</label>
                                <div class="send-time-options">
                                    <label class="radio-box">
                                        <input type="radio" name="send_time" value="immediate" checked>
                                        <span>
                                            <i class="fas fa-bolt"></i>
                                            <strong>Send Now</strong>
                                            <small>Immediate delivery</small>
                                        </span>
                                    </label>
                                    <label class="radio-box">
                                        <input type="radio" name="send_time" value="scheduled">
                                        <span>
                                            <i class="fas fa-calendar-alt"></i>
                                            <strong>Schedule</strong>
                                            <small>Send at specific time</small>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div id="scheduleDateTime" style="display: none;">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>Schedule Date</label>
                                        <input type="date" name="schedule_date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Schedule Time</label>
                                        <input type="time" name="schedule_time" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="settings-section">
                            <h4><i class="fas fa-shield-alt"></i> Notification Settings</h4>
                            <div class="feature-toggles">
                                <div class="toggle-item">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="require_acknowledgment">
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <div class="toggle-info">
                                        <strong>Require Acknowledgment</strong>
                                        <p>Recipients must confirm they've read the message</p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="send_reminder" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <div class="toggle-info">
                                        <strong>Send Reminder</strong>
                                        <p>Auto-remind unread notifications after 24 hours</p>
                                    </div>
                                </div>
                                <div class="toggle-item">
                                    <label class="toggle-switch">
                                        <input type="checkbox" name="track_delivery">
                                        <span class="toggle-slider"></span>
                                    </label>
                                    <div class="toggle-info">
                                        <strong>Track Delivery</strong>
                                        <p>Monitor who has received and read the notification</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="notification-summary">
                            <div class="summary-item">
                                <i class="fas fa-users"></i>
                                <div>
                                    <strong>Recipients</strong>
                                    <p id="summaryRecipients">Not selected</p>
                                </div>
                            </div>
                            <div class="summary-item">
                                <i class="fas fa-paper-plane"></i>
                                <div>
                                    <strong>Channels</strong>
                                    <p id="summaryChannels">Email</p>
                                </div>
                            </div>
                            <div class="summary-item">
                                <i class="fas fa-flag"></i>
                                <div>
                                    <strong>Priority</strong>
                                    <p id="summaryPriority">Medium</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-navigation">
                        <button type="button" class="btn btn-prev" onclick="previousNotificationStep()" style="display: none;">
                            <i class="fas fa-arrow-left"></i> Previous
                        </button>
                        <button type="button" class="btn btn-next notif-next-btn" onclick="nextNotificationStep()">
                            Next <i class="fas fa-arrow-right"></i>
                        </button>
                        <button type="submit" class="btn btn-submit notif-submit-btn" style="display: none;">
                            <i class="fas fa-paper-plane"></i> Send Notification
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal" id="addUserModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-user-plus"></i> Add New User</h2>
                <button class="close-btn" onclick="closeModal('addUserModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" method="POST" action="">
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name <span class="required">*</span></label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name <span class="required">*</span></label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Username <span class="required">*</span></label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password <span class="required">*</span></label>
                        <input type="password" name="password" class="form-control" required>
                        <div class="password-strength">
                            <div class="password-strength-bar"></div>
                        </div>
                        <div class="password-strength-text"></div>
                    </div>
                    <div class="form-group">
                        <label>Select Role <span class="required">*</span></label>
                        <div class="role-selector">
                            <div class="role-option">
                                <input type="radio" name="role" value="student" id="role-student" required>
                                <label for="role-student" class="role-card student">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Student</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="role" value="lecturer" id="role-lecturer">
                                <label for="role-lecturer" class="role-card lecturer">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Lecturer</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="role" value="exam_officer" id="role-exam">
                                <label for="role-exam" class="role-card exam">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Exam Officer</span>
                                </label>
                            </div>
                            <div class="role-option">
                                <input type="radio" name="role" value="library_officer" id="role-library">
                                <label for="role-library" class="role-card library">
                                    <i class="fas fa-book-reader"></i>
                                    <span>Library Officer</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" onclick="closeModal('addUserModal')">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" form="addUserForm" class="btn btn-submit">
                    <i class="fas fa-check"></i> Add User
                </button>
            </div>
        </div>
    </div>

    <!-- User Management Modal -->
    <div class="modal" id="userManagementModal">
        <div class="modal-content" style="max-width: 1200px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <h2><i class="fas fa-users-cog"></i> User Management</h2>
                <button class="close-btn" onclick="closeModal('userManagementModal')">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                
                <!-- User Management Toolbar -->
                <div class="user-mgmt-toolbar">
                    <div class="toolbar-left">
                        <div class="search-box-inline">
                            <i class="fas fa-search"></i>
                            <input type="text" id="userSearchInput" placeholder="Search users by name, email, or ID..." onkeyup="filterUsers()">
                        </div>
                    </div>
                    <div class="toolbar-right">
                        <select class="filter-select" id="roleFilter" onchange="filterUsers()">
                            <option value="">All Roles</option>
                            <option value="student">Students</option>
                            <option value="lecturer">Lecturers</option>
                            <option value="exam_officer">Exam Officers</option>
                            <option value="library_officer">Library Officers</option>
                            <option value="finance_officer">Finance Officers</option>
                            <option value="admin">Admins</option>
                        </select>
                        <select class="filter-select" id="statusFilter" onchange="filterUsers()">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                        </select>
                        <button class="btn-toolbar primary" onclick="openAddUserModal()">
                            <i class="fas fa-user-plus"></i> Add New User
                        </button>
                        <button class="btn-toolbar" onclick="exportUsers()">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                </div>

                
                <div class="user-stats-row">
                    <div class="user-stat-card">
                        <i class="fas fa-users"></i>
                        <div>
                            <h4>1,245</h4>
                            <p>Total Users</p>
                        </div>
                    </div>
                    <div class="user-stat-card">
                        <i class="fas fa-user-graduate"></i>
                        <div>
                            <h4>1,089</h4>
                            <p>Students</p>
                        </div>
                    </div>
                    <div class="user-stat-card">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <div>
                            <h4>85</h4>
                            <p>Lecturers</p>
                        </div>
                    </div>
                    <div class="user-stat-card">
                        <i class="fas fa-user-tie"></i>
                        <div>
                            <h4>71</h4>
                            <p>Staff</p>
                        </div>
                    </div>
                </div>

        
                <div class="user-table-container">
                    <table class="user-management-table" id="userManagementTable">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkbox-container">
                                        <input type="checkbox" id="selectAllUsers" onchange="toggleSelectAll(this)">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Joined Date</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            
                            <tr data-role="student" data-status="active">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="user-checkbox" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">JD</div>
                                        <div class="user-details">
                                            <h4>John Doe</h4>
                                            <p>ID: STU-2024-001</p>
                                        </div>
                                    </div>
                                </td>
                                <td>john.doe@university.edu</td>
                                <td><span class="role-badge student">Student</span></td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>Jan 15, 2024</td>
                                <td>2 hours ago</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewUser(1)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editUser(1)" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteUser(1)" title="Delete User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-role="lecturer" data-status="active">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="user-checkbox" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">SJ</div>
                                        <div class="user-details">
                                            <h4>Dr. Sarah Johnson</h4>
                                            <p>ID: LEC-2023-045</p>
                                        </div>
                                    </div>
                                </td>
                                <td>sarah.johnson@university.edu</td>
                                <td><span class="role-badge lecturer">Lecturer</span></td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>Sep 10, 2023</td>
                                <td>1 day ago</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewUser(2)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editUser(2)" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteUser(2)" title="Delete User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-role="student" data-status="pending">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="user-checkbox" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">MB</div>
                                        <div class="user-details">
                                            <h4>Michael Brown</h4>
                                            <p>ID: STU-2024-098</p>
                                        </div>
                                    </div>
                                </td>
                                <td>michael.brown@university.edu</td>
                                <td><span class="role-badge student">Student</span></td>
                                <td><span class="status-badge pending">Pending</span></td>
                                <td>Dec 10, 2024</td>
                                <td>Never</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewUser(3)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editUser(3)" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteUser(3)" title="Delete User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-role="exam_officer" data-status="active">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="user-checkbox" value="4">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">ED</div>
                                        <div class="user-details">
                                            <h4>Emily Davis</h4>
                                            <p>ID: EXM-2022-012</p>
                                        </div>
                                    </div>
                                </td>
                                <td>emily.davis@university.edu</td>
                                <td><span class="role-badge exam">Exam Officer</span></td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>Mar 5, 2022</td>
                                <td>5 hours ago</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewUser(4)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editUser(4)" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteUser(4)" title="Delete User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-role="student" data-status="inactive">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="user-checkbox" value="5">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">RW</div>
                                        <div class="user-details">
                                            <h4>Robert Wilson</h4>
                                            <p>ID: STU-2023-156</p>
                                        </div>
                                    </div>
                                </td>
                                <td>robert.wilson@university.edu</td>
                                <td><span class="role-badge student">Student</span></td>
                                <td><span class="status-badge inactive">Inactive</span></td>
                                <td>Aug 20, 2023</td>
                                <td>3 months ago</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewUser(5)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editUser(5)" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteUser(5)" title="Delete User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                
                <div class="user-pagination">
                    <div class="pagination-info">
                        Showing <strong>1-5</strong> of <strong>1,245</strong> users
                    </div>
                    <div class="pagination-controls">
                        <button class="pagination-btn" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">4</button>
                        <button class="pagination-btn">5</button>
                        <span>...</span>
                        <button class="pagination-btn">249</button>
                        <button class="pagination-btn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="pagination-size">
                        <select class="filter-select" onchange="changePageSize(this.value)">
                            <option value="5">5 per page</option>
                            <option value="10">10 per page</option>
                            <option value="25">25 per page</option>
                            <option value="50">50 per page</option>
                            <option value="100">100 per page</option>
                        </select>
                    </div>
                </div>

                
                <div class="bulk-actions-bar" id="bulkActionsBar" style="display: none;">
                    <span class="selected-count"><strong id="selectedCount">0</strong> users selected</span>
                    <div class="bulk-actions">
                        <button class="bulk-action-btn" onclick="bulkActivate()">
                            <i class="fas fa-check-circle"></i> Activate
                        </button>
                        <button class="bulk-action-btn" onclick="bulkDeactivate()">
                            <i class="fas fa-ban"></i> Deactivate
                        </button>
                        <button class="bulk-action-btn" onclick="bulkExport()">
                            <i class="fas fa-download"></i> Export Selected
                        </button>
                        <button class="bulk-action-btn danger" onclick="bulkDelete()">
                            <i class="fas fa-trash"></i> Delete Selected
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal" id="studentsModal">
        <div class="modal-content" style="max-width: 1400px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h2><i class="fas fa-user-graduate"></i> Student Management</h2>
                <button class="close-btn" onclick="closeModal('studentsModal')">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                
                
                <div class="students-toolbar">
                    <div class="toolbar-left">
                        <div class="search-box-inline">
                            <i class="fas fa-search"></i>
                            <input type="text" id="studentSearchInput" placeholder="Search by name, ID, email, or department..." onkeyup="filterStudents()">
                        </div>
                    </div>
                    <div class="toolbar-right">
                        <select class="filter-select" id="departmentFilter" onchange="filterStudents()">
                            <option value="">All Departments</option>
                            <option value="computer_science">Computer Science</option>
                            <option value="engineering">Engineering</option>
                            <option value="business">Business</option>
                            <option value="medicine">Medicine</option>
                            <option value="law">Law</option>
                            <option value="arts">Arts</option>
                        </select>
                        <select class="filter-select" id="yearFilter" onchange="filterStudents()">
                            <option value="">All Years</option>
                            <option value="1">Year 1</option>
                            <option value="2">Year 2</option>
                            <option value="3">Year 3</option>
                            <option value="4">Year 4</option>
                        </select>
                        <select class="filter-select" id="studentStatusFilter" onchange="filterStudents()">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="on_leave">On Leave</option>
                            <option value="graduated">Graduated</option>
                            <option value="suspended">Suspended</option>
                        </select>
                        <button class="btn-toolbar primary" onclick="openAddStudentModal()">
                            <i class="fas fa-user-plus"></i> Add Student
                        </button>
                        <button class="btn-toolbar" onclick="exportStudents()">
                            <i class="fas fa-file-excel"></i> Export
                        </button>
                        <button class="btn-toolbar" onclick="importStudents()">
                            <i class="fas fa-file-import"></i> Import
                        </button>
                    </div>
                </div>

            
                <div class="student-stats-row">
                    <div class="student-stat-card purple">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <h4>1,089</h4>
                            <p>Total Students</p>
                            <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 5.2%</span>
                        </div>
                    </div>
                    <div class="student-stat-card blue">
                        <div class="stat-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stat-content">
                            <h4>1,045</h4>
                            <p>Active Students</p>
                            <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 2.8%</span>
                        </div>
                    </div>
                    <div class="student-stat-card green">
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-content">
                            <h4>28</h4>
                            <p>Graduating Soon</p>
                            <span class="stat-change neutral"><i class="fas fa-minus"></i> 0%</span>
                        </div>
                    </div>
                    <div class="student-stat-card yellow">
                        <div class="stat-icon">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <div class="stat-content">
                            <h4>16</h4>
                            <p>On Leave</p>
                            <span class="stat-change negative"><i class="fas fa-arrow-down"></i> 1.2%</span>
                        </div>
                    </div>
                </div>

            
                <div class="student-table-container">
                    <table class="student-management-table" id="studentManagementTable">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkbox-container">
                                        <input type="checkbox" id="selectAllStudents" onchange="toggleSelectAllStudents(this)">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <th>Student</th>
                                <th>Student ID</th>
                                <th>Department</th>
                                <th>Year</th>
                                <th>GPA</th>
                                <th>Status</th>
                                <th>Contact</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="studentTableBody">
                            
                            <tr data-department="computer_science" data-year="3" data-status="active">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="student-checkbox" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            <img src="https://i.pravatar.cc/150?img=1" alt="Student" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        </div>
                                        <div class="user-details">
                                            <h4>Alex Johnson</h4>
                                            <p>alex.johnson@university.edu</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>STU2022001</strong></td>
                                <td>
                                    <span class="dept-badge cs">Computer Science</span>
                                </td>
                                <td><span class="year-badge">Year 3</span></td>
                                <td>
                                    <div class="gpa-display">
                                        <strong>3.85</strong>
                                        <div class="gpa-bar">
                                            <div class="gpa-fill" style="width: 96.25%;"></div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="contact-info">
                                        <a href="tel:+1234567890" title="Call"><i class="fas fa-phone"></i></a>
                                        <a href="mailto:alex.johnson@university.edu" title="Email"><i class="fas fa-envelope"></i></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewStudent(1)" title="View Profile">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editStudent(1)" title="Edit Student">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn transcript" onclick="viewTranscript(1)" title="View Transcript">
                                            <i class="fas fa-file-alt"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteStudent(1)" title="Delete Student">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="engineering" data-year="2" data-status="active">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="student-checkbox" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                                            <img src="https://i.pravatar.cc/150?img=5" alt="Student" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        </div>
                                        <div class="user-details">
                                            <h4>Sarah Martinez</h4>
                                            <p>sarah.martinez@university.edu</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>STU2023042</strong></td>
                                <td>
                                    <span class="dept-badge eng">Engineering</span>
                                </td>
                                <td><span class="year-badge">Year 2</span></td>
                                <td>
                                    <div class="gpa-display">
                                        <strong>3.92</strong>
                                        <div class="gpa-bar">
                                            <div class="gpa-fill" style="width: 98%;"></div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="contact-info">
                                        <a href="tel:+1234567891" title="Call"><i class="fas fa-phone"></i></a>
                                        <a href="mailto:sarah.martinez@university.edu" title="Email"><i class="fas fa-envelope"></i></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewStudent(2)" title="View Profile">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editStudent(2)" title="Edit Student">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn transcript" onclick="viewTranscript(2)" title="View Transcript">
                                            <i class="fas fa-file-alt"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteStudent(2)" title="Delete Student">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="business" data-year="4" data-status="active">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="student-checkbox" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                            <img src="https://i.pravatar.cc/150?img=8" alt="Student" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        </div>
                                        <div class="user-details">
                                            <h4>David Chen</h4>
                                            <p>david.chen@university.edu</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>STU2021089</strong></td>
                                <td>
                                    <span class="dept-badge bus">Business</span>
                                </td>
                                <td><span class="year-badge">Year 4</span></td>
                                <td>
                                    <div class="gpa-display">
                                        <strong>3.45</strong>
                                        <div class="gpa-bar">
                                            <div class="gpa-fill" style="width: 86.25%;"></div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="contact-info">
                                        <a href="tel:+1234567892" title="Call"><i class="fas fa-phone"></i></a>
                                        <a href="mailto:david.chen@university.edu" title="Email"><i class="fas fa-envelope"></i></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewStudent(3)" title="View Profile">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editStudent(3)" title="Edit Student">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn transcript" onclick="viewTranscript(3)" title="View Transcript">
                                            <i class="fas fa-file-alt"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteStudent(3)" title="Delete Student">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="medicine" data-year="1" data-status="on_leave">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="student-checkbox" value="4">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                            <img src="https://i.pravatar.cc/150?img=9" alt="Student" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        </div>
                                        <div class="user-details">
                                            <h4>Emily Brown</h4>
                                            <p>emily.brown@university.edu</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>STU2024156</strong></td>
                                <td>
                                    <span class="dept-badge med">Medicine</span>
                                </td>
                                <td><span class="year-badge">Year 1</span></td>
                                <td>
                                    <div class="gpa-display">
                                        <strong>3.68</strong>
                                        <div class="gpa-bar">
                                            <div class="gpa-fill" style="width: 92%;"></div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="status-badge on_leave">On Leave</span></td>
                                <td>
                                    <div class="contact-info">
                                        <a href="tel:+1234567893" title="Call"><i class="fas fa-phone"></i></a>
                                        <a href="mailto:emily.brown@university.edu" title="Email"><i class="fas fa-envelope"></i></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewStudent(4)" title="View Profile">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editStudent(4)" title="Edit Student">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn transcript" onclick="viewTranscript(4)" title="View Transcript">
                                            <i class="fas fa-file-alt"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteStudent(4)" title="Delete Student">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="law" data-year="3" data-status="suspended">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="student-checkbox" value="5">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);">
                                            <img src="https://i.pravatar.cc/150?img=12" alt="Student" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        </div>
                                        <div class="user-details">
                                            <h4>Michael Davis</h4>
                                            <p>michael.davis@university.edu</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>STU2022214</strong></td>
                                <td>
                                    <span class="dept-badge law">Law</span>
                                </td>
                                <td><span class="year-badge">Year 3</span></td>
                                <td>
                                    <div class="gpa-display">
                                        <strong>2.95</strong>
                                        <div class="gpa-bar">
                                            <div class="gpa-fill" style="width: 73.75%;"></div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="status-badge suspended">Suspended</span></td>
                                <td>
                                    <div class="contact-info">
                                        <a href="tel:+1234567894" title="Call"><i class="fas fa-phone"></i></a>
                                        <a href="mailto:michael.davis@university.edu" title="Email"><i class="fas fa-envelope"></i></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewStudent(5)" title="View Profile">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editStudent(5)" title="Edit Student">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn transcript" onclick="viewTranscript(5)" title="View Transcript">
                                            <i class="fas fa-file-alt"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteStudent(5)" title="Delete Student">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="user-pagination">
                    <div class="pagination-info">
                        Showing <strong>1-5</strong> of <strong>1,089</strong> students
                    </div>
                    <div class="pagination-controls">
                        <button class="pagination-btn" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">4</button>
                        <button class="pagination-btn">5</button>
                        <span>...</span>
                        <button class="pagination-btn">218</button>
                        <button class="pagination-btn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="pagination-size">
                        <select class="filter-select" onchange="changeStudentPageSize(this.value)">
                            <option value="5">5 per page</option>
                            <option value="10">10 per page</option>
                            <option value="25">25 per page</option>
                            <option value="50">50 per page</option>
                            <option value="100">100 per page</option>
                        </select>
                    </div>
                </div>

                <!-- Bulk Actions Bar -->
                <div class="bulk-actions-bar" id="studentBulkActionsBar" style="display: none;">
                    <span class="selected-count"><strong id="studentSelectedCount">0</strong> students selected</span>
                    <div class="bulk-actions">
                        <button class="bulk-action-btn" onclick="bulkEnrollCourse()">
                            <i class="fas fa-book"></i> Enroll in Course
                        </button>
                        <button class="bulk-action-btn" onclick="bulkSendNotification()">
                            <i class="fas fa-bell"></i> Send Notification
                        </button>
                        <button class="bulk-action-btn" onclick="bulkExportStudents()">
                            <i class="fas fa-download"></i> Export Selected
                        </button>
                        <button class="bulk-action-btn" onclick="bulkGenerateReports()">
                            <i class="fas fa-file-pdf"></i> Generate Reports
                        </button>
                        <button class="bulk-action-btn danger" onclick="bulkDeleteStudents()">
                            <i class="fas fa-trash"></i> Delete Selected
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lecturers Management Modal -->
    <div class="modal" id="lecturersModal">
        <div class="modal-content" style="max-width: 1400px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <h2><i class="fas fa-chalkboard-teacher"></i> Lecturer Management</h2>
                <button class="close-btn" onclick="closeModal('lecturersModal')">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                
                <!-- Lecturers Toolbar -->
                <div class="lecturers-toolbar">
                    <div class="toolbar-left">
                        <div class="search-box-inline">
                            <i class="fas fa-search"></i>
                            <input type="text" id="lecturerSearchInput" placeholder="Search by name, ID, email, or specialization..." onkeyup="filterLecturers()">
                        </div>
                    </div>
                    <div class="toolbar-right">
                        <select class="filter-select" id="lecturerDepartmentFilter" onchange="filterLecturers()">
                            <option value="">All Departments</option>
                            <option value="computer_science">Computer Science</option>
                            <option value="engineering">Engineering</option>
                            <option value="business">Business</option>
                            <option value="medicine">Medicine</option>
                            <option value="law">Law</option>
                            <option value="arts">Arts</option>
                        </select>
                        <select class="filter-select" id="lecturerQualificationFilter" onchange="filterLecturers()">
                            <option value="">All Qualifications</option>
                            <option value="phd">PhD</option>
                            <option value="masters">Master's</option>
                            <option value="bachelors">Bachelor's</option>
                        </select>
                        <select class="filter-select" id="lecturerStatusFilter" onchange="filterLecturers()">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="on_leave">On Leave</option>
                            <option value="retired">Retired</option>
                        </select>
                        <button class="btn-toolbar primary" onclick="openAddLecturerModal()">
                            <i class="fas fa-user-plus"></i> Add Lecturer
                        </button>
                        <button class="btn-toolbar" onclick="exportLecturers()">
                            <i class="fas fa-file-excel"></i> Export
                        </button>
                        <button class="btn-toolbar" onclick="assignCourses()">
                            <i class="fas fa-book"></i> Assign Courses
                        </button>
                    </div>
                </div>

                
                <div class="lecturer-stats-row">
                    <div class="lecturer-stat-card orange">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-content">
                            <h4>85</h4>
                            <p>Total Lecturers</p>
                            <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 3.5%</span>
                        </div>
                    </div>
                    <div class="lecturer-stat-card blue">
                        <div class="stat-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stat-content">
                            <h4>78</h4>
                            <p>Active Lecturers</p>
                            <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 2.1%</span>
                        </div>
                    </div>
                    <div class="lecturer-stat-card purple">
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-content">
                            <h4>62</h4>
                            <p>PhD Holders</p>
                            <span class="stat-change neutral"><i class="fas fa-minus"></i> 0%</span>
                        </div>
                    </div>
                    <div class="lecturer-stat-card green">
                        <div class="stat-icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <div class="stat-content">
                            <h4>142</h4>
                            <p>Active Courses</p>
                            <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 4.8%</span>
                        </div>
                    </div>
                </div>

                
                <div class="lecturer-table-container">
                    <table class="lecturer-management-table" id="lecturerManagementTable">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkbox-container">
                                        <input type="checkbox" id="selectAllLecturers" onchange="toggleSelectAllLecturers(this)">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <th>Lecturer</th>
                                <th>Lecturer ID</th>
                                <th>Department</th>
                                <th>Qualification</th>
                                <th>Experience</th>
                                <th>Courses</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="lecturerTableBody">
                            
                            <tr data-department="computer_science" data-qualification="phd" data-status="active">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="lecturer-checkbox" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                                            <img src="https://i.pravatar.cc/150?img=33" alt="Lecturer" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        </div>
                                        <div class="user-details">
                                            <h4>Dr. Robert Williams</h4>
                                            <p>robert.williams@university.edu</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>LEC2018001</strong></td>
                                <td>
                                    <span class="dept-badge cs">Computer Science</span>
                                </td>
                                <td><span class="qual-badge phd">PhD</span></td>
                                <td>
                                    <div class="exp-display">
                                        <strong>12 years</strong>
                                        <small>Since 2013</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="courses-count">
                                        <i class="fas fa-book"></i> 8 courses
                                    </div>
                                </td>
                                <td>
                                    <div class="rating-display">
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <span>4.7</span>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewLecturer(1)" title="View Profile">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editLecturer(1)" title="Edit Lecturer">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn courses" onclick="manageCourses(1)" title="Manage Courses">
                                            <i class="fas fa-book"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteLecturer(1)" title="Delete Lecturer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="engineering" data-qualification="phd" data-status="active">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="lecturer-checkbox" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            <img src="https://i.pravatar.cc/150?img=47" alt="Lecturer" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        </div>
                                        <div class="user-details">
                                            <h4>Prof. Sarah Mitchell</h4>
                                            <p>sarah.mitchell@university.edu</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>LEC2015023</strong></td>
                                <td>
                                    <span class="dept-badge eng">Engineering</span>
                                </td>
                                <td><span class="qual-badge phd">PhD</span></td>
                                <td>
                                    <div class="exp-display">
                                        <strong>18 years</strong>
                                        <small>Since 2007</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="courses-count">
                                        <i class="fas fa-book"></i> 6 courses
                                    </div>
                                </td>
                                <td>
                                    <div class="rating-display">
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <span>4.9</span>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewLecturer(2)" title="View Profile">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editLecturer(2)" title="Edit Lecturer">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn courses" onclick="manageCourses(2)" title="Manage Courses">
                                            <i class="fas fa-book"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteLecturer(2)" title="Delete Lecturer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="business" data-qualification="masters" data-status="active">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="lecturer-checkbox" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                            <img src="https://i.pravatar.cc/150?img=60" alt="Lecturer" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        </div>
                                        <div class="user-details">
                                            <h4>Dr. James Anderson</h4>
                                            <p>james.anderson@university.edu</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>LEC2019045</strong></td>
                                <td>
                                    <span class="dept-badge bus">Business</span>
                                </td>
                                <td><span class="qual-badge masters">Master's</span></td>
                                <td>
                                    <div class="exp-display">
                                        <strong>8 years</strong>
                                        <small>Since 2017</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="courses-count">
                                        <i class="fas fa-book"></i> 5 courses
                                    </div>
                                </td>
                                <td>
                                    <div class="rating-display">
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <span>4.3</span>
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewLecturer(3)" title="View Profile">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editLecturer(3)" title="Edit Lecturer">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn courses" onclick="manageCourses(3)" title="Manage Courses">
                                            <i class="fas fa-book"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteLecturer(3)" title="Delete Lecturer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="medicine" data-qualification="phd" data-status="on_leave">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="lecturer-checkbox" value="4">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                                            <img src="https://i.pravatar.cc/150?img=48" alt="Lecturer" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        </div>
                                        <div class="user-details">
                                            <h4>Dr. Lisa Thompson</h4>
                                            <p>lisa.thompson@university.edu</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>LEC2016089</strong></td>
                                <td>
                                    <span class="dept-badge med">Medicine</span>
                                </td>
                                <td><span class="qual-badge phd">PhD</span></td>
                                <td>
                                    <div class="exp-display">
                                        <strong>15 years</strong>
                                        <small>Since 2010</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="courses-count">
                                        <i class="fas fa-book"></i> 4 courses
                                    </div>
                                </td>
                                <td>
                                    <div class="rating-display">
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <span>4.8</span>
                                    </div>
                                </td>
                                <td><span class="status-badge on_leave">On Leave</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewLecturer(4)" title="View Profile">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editLecturer(4)" title="Edit Lecturer">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn courses" onclick="manageCourses(4)" title="Manage Courses">
                                            <i class="fas fa-book"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteLecturer(4)" title="Delete Lecturer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="law" data-qualification="phd" data-status="retired">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="lecturer-checkbox" value="5">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="user-cell-info">
                                        <div class="user-avatar-small" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);">
                                            <img src="https://i.pravatar.cc/150?img=68" alt="Lecturer" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                                        </div>
                                        <div class="user-details">
                                            <h4>Prof. Michael Brown</h4>
                                            <p>michael.brown@university.edu</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>LEC2005012</strong></td>
                                <td>
                                    <span class="dept-badge law">Law</span>
                                </td>
                                <td><span class="qual-badge phd">PhD</span></td>
                                <td>
                                    <div class="exp-display">
                                        <strong>25 years</strong>
                                        <small>Since 2000</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="courses-count">
                                        <i class="fas fa-book"></i> 0 courses
                                    </div>
                                </td>
                                <td>
                                    <div class="rating-display">
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <span>4.6</span>
                                    </div>
                                </td>
                                <td><span class="status-badge retired">Retired</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewLecturer(5)" title="View Profile">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editLecturer(5)" title="Edit Lecturer">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn courses" onclick="manageCourses(5)" title="Manage Courses">
                                            <i class="fas fa-book"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteLecturer(5)" title="Delete Lecturer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                
                <div class="user-pagination">
                    <div class="pagination-info">
                        Showing <strong>1-5</strong> of <strong>85</strong> lecturers
                    </div>
                    <div class="pagination-controls">
                        <button class="pagination-btn" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">4</button>
                        <button class="pagination-btn">5</button>
                        <span>...</span>
                        <button class="pagination-btn">17</button>
                        <button class="pagination-btn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="pagination-size">
                        <select class="filter-select" onchange="changeLecturerPageSize(this.value)">
                            <option value="5">5 per page</option>
                            <option value="10">10 per page</option>
                            <option value="25">25 per page</option>
                            <option value="50">50 per page</option>
                            <option value="100">100 per page</option>
                        </select>
                    </div>
                </div>

                
                <div class="bulk-actions-bar" id="lecturerBulkActionsBar" style="display: none;">
                    <span class="selected-count"><strong id="lecturerSelectedCount">0</strong> lecturers selected</span>
                    <div class="bulk-actions">
                        <button class="bulk-action-btn" onclick="bulkAssignCourses()">
                            <i class="fas fa-book"></i> Assign Courses
                        </button>
                        <button class="bulk-action-btn" onclick="bulkSendLecturerNotification()">
                            <i class="fas fa-bell"></i> Send Notification
                        </button>
                        <button class="bulk-action-btn" onclick="bulkExportLecturers()">
                            <i class="fas fa-download"></i> Export Selected
                        </button>
                        <button class="bulk-action-btn" onclick="bulkGenerateLecturerReports()">
                            <i class="fas fa-file-pdf"></i> Generate Reports
                        </button>
                        <button class="bulk-action-btn danger" onclick="bulkDeleteLecturers()">
                            <i class="fas fa-trash"></i> Delete Selected
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="coursesModal">
        <div class="modal-content" style="max-width: 1500px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <h2><i class="fas fa-book"></i> Course Management</h2>
                <button class="close-btn" onclick="closeModal('coursesModal')">&times;</button>
            </div>
            <div class="modal-body" style="padding: 0;">
                
                
                <div class="courses-toolbar">
                    <div class="toolbar-left">
                        <div class="search-box-inline">
                            <i class="fas fa-search"></i>
                            <input type="text" id="courseSearchInput" placeholder="Search by course name, code, or instructor..." onkeyup="filterCourses()">
                        </div>
                    </div>
                    <div class="toolbar-right">
                        <select class="filter-select" id="courseDepartmentFilter" onchange="filterCourses()">
                            <option value="">All Departments</option>
                            <option value="computer_science">Computer Science</option>
                            <option value="engineering">Engineering</option>
                            <option value="business">Business</option>
                            <option value="medicine">Medicine</option>
                            <option value="law">Law</option>
                            <option value="arts">Arts</option>
                        </select>
                        <select class="filter-select" id="courseLevelFilter" onchange="filterCourses()">
                            <option value="">All Levels</option>
                            <option value="100">100 Level</option>
                            <option value="200">200 Level</option>
                            <option value="300">300 Level</option>
                            <option value="400">400 Level</option>
                        </select>
                        <select class="filter-select" id="courseStatusFilter" onchange="filterCourses()">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="completed">Completed</option>
                            <option value="draft">Draft</option>
                        </select>
                        <button class="btn-toolbar primary" onclick="openAddCourseModal()">
                            <i class="fas fa-plus"></i> Add Course
                        </button>
                        <button class="btn-toolbar" onclick="exportCourses()">
                            <i class="fas fa-file-excel"></i> Export
                        </button>
                        <button class="btn-toolbar" onclick="generateCatalog()">
                            <i class="fas fa-book-open"></i> Catalog
                        </button>
                    </div>
                </div>

                
                <div class="course-stats-row">
                    <div class="course-stat-card green">
                        <div class="stat-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="stat-content">
                            <h4>142</h4>
                            <p>Total Courses</p>
                            <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 6.2%</span>
                        </div>
                    </div>
                    <div class="course-stat-card blue">
                        <div class="stat-icon">
                            <i class="fas fa-play-circle"></i>
                        </div>
                        <div class="stat-content">
                            <h4>118</h4>
                            <p>Active Courses</p>
                            <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 4.5%</span>
                        </div>
                    </div>
                    <div class="course-stat-card purple">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <h4>2,847</h4>
                            <p>Total Enrollments</p>
                            <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 8.1%</span>
                        </div>
                    </div>
                    <div class="course-stat-card yellow">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-content">
                            <h4>4.6</h4>
                            <p>Avg. Rating</p>
                            <span class="stat-change neutral"><i class="fas fa-minus"></i> 0%</span>
                        </div>
                    </div>
                </div>

                
                <div class="course-table-container">
                    <table class="course-management-table" id="courseManagementTable">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkbox-container">
                                        <input type="checkbox" id="selectAllCourses" onchange="toggleSelectAllCourses(this)">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <th>Course</th>
                                <th>Course Code</th>
                                <th>Department</th>
                                <th>Level</th>
                                <th>Instructor</th>
                                <th>Students</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="courseTableBody">
                        
                            <tr data-department="computer_science" data-level="300" data-status="active">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="course-checkbox" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="course-info">
                                        <div class="course-thumbnail">
                                            <i class="fas fa-laptop-code"></i>
                                        </div>
                                        <div class="course-details">
                                            <h4>Advanced Web Development</h4>
                                            <p>Full-stack development with modern frameworks</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>CS301</strong></td>
                                <td>
                                    <span class="dept-badge cs">Computer Science</span>
                                </td>
                                <td><span class="level-badge">300</span></td>
                                <td>
                                    <div class="instructor-mini">
                                        <img src="https://i.pravatar.cc/150?img=33" alt="Instructor">
                                        <span>Dr. Robert Williams</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="enrollment-info">
                                        <div class="progress-bar-small">
                                            <div class="progress-fill" style="width: 85%;"></div>
                                        </div>
                                        <span>85/100</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="duration-display">
                                        <i class="fas fa-clock"></i> 14 weeks
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewCourse(1)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editCourse(1)" title="Edit Course">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn students" onclick="viewCourseStudents(1)" title="View Students">
                                            <i class="fas fa-users"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteCourse(1)" title="Delete Course">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="engineering" data-level="200" data-status="active">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="course-checkbox" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="course-info">
                                        <div class="course-thumbnail">
                                            <i class="fas fa-cogs"></i>
                                        </div>
                                        <div class="course-details">
                                            <h4>Mechanical Engineering Fundamentals</h4>
                                            <p>Introduction to mechanical systems and design</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>ENG201</strong></td>
                                <td>
                                    <span class="dept-badge eng">Engineering</span>
                                </td>
                                <td><span class="level-badge">200</span></td>
                                <td>
                                    <div class="instructor-mini">
                                        <img src="https://i.pravatar.cc/150?img=47" alt="Instructor">
                                        <span>Prof. Sarah Mitchell</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="enrollment-info">
                                        <div class="progress-bar-small">
                                            <div class="progress-fill" style="width: 60%;"></div>
                                        </div>
                                        <span>30/50</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="duration-display">
                                        <i class="fas fa-clock"></i> 12 weeks
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewCourse(2)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editCourse(2)" title="Edit Course">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn students" onclick="viewCourseStudents(2)" title="View Students">
                                            <i class="fas fa-users"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteCourse(2)" title="Delete Course">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="business" data-level="400" data-status="active">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="course-checkbox" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="course-info">
                                        <div class="course-thumbnail">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                        <div class="course-details">
                                            <h4>Strategic Management</h4>
                                            <p>Business strategy and competitive advantage</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>BUS401</strong></td>
                                <td>
                                    <span class="dept-badge bus">Business</span>
                                </td>
                                <td><span class="level-badge">400</span></td>
                                <td>
                                    <div class="instructor-mini">
                                        <img src="https://i.pravatar.cc/150?img=60" alt="Instructor">
                                        <span>Dr. James Anderson</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="enrollment-info">
                                        <div class="progress-bar-small">
                                            <div class="progress-fill" style="width: 100%;"></div>
                                        </div>
                                        <span>45/45</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="duration-display">
                                        <i class="fas fa-clock"></i> 16 weeks
                                    </div>
                                </td>
                                <td><span class="status-badge active">Active</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewCourse(3)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editCourse(3)" title="Edit Course">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn students" onclick="viewCourseStudents(3)" title="View Students">
                                            <i class="fas fa-users"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteCourse(3)" title="Delete Course">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="medicine" data-level="100" data-status="inactive">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="course-checkbox" value="4">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="course-info">
                                        <div class="course-thumbnail">
                                            <i class="fas fa-heartbeat"></i>
                                        </div>
                                        <div class="course-details">
                                            <h4>Introduction to Anatomy</h4>
                                            <p>Human anatomy and physiology basics</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>MED101</strong></td>
                                <td>
                                    <span class="dept-badge med">Medicine</span>
                                </td>
                                <td><span class="level-badge">100</span></td>
                                <td>
                                    <div class="instructor-mini">
                                        <img src="https://i.pravatar.cc/150?img=48" alt="Instructor">
                                        <span>Dr. Lisa Thompson</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="enrollment-info">
                                        <div class="progress-bar-small">
                                            <div class="progress-fill" style="width: 0%;"></div>
                                        </div>
                                        <span>0/80</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="duration-display">
                                        <i class="fas fa-clock"></i> 18 weeks
                                    </div>
                                </td>
                                <td><span class="status-badge inactive">Inactive</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewCourse(4)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editCourse(4)" title="Edit Course">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn students" onclick="viewCourseStudents(4)" title="View Students">
                                            <i class="fas fa-users"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteCourse(4)" title="Delete Course">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="law" data-level="300" data-status="draft">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="course-checkbox" value="5">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="course-info">
                                        <div class="course-thumbnail">
                                            <i class="fas fa-gavel"></i>
                                        </div>
                                        <div class="course-details">
                                            <h4>Constitutional Law</h4>
                                            <p>Study of constitutional principles and cases</p>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>LAW302</strong></td>
                                <td>
                                    <span class="dept-badge law">Law</span>
                                </td>
                                <td><span class="level-badge">300</span></td>
                                <td>
                                    <div class="instructor-mini">
                                        <img src="https://i.pravatar.cc/150?img=68" alt="Instructor">
                                        <span>Prof. Michael Brown</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="enrollment-info">
                                        <div class="progress-bar-small">
                                            <div class="progress-fill" style="width: 0%;"></div>
                                        </div>
                                        <span>0/60</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="duration-display">
                                        <i class="fas fa-clock"></i> 14 weeks
                                    </div>
                                </td>
                                <td><span class="status-badge draft">Draft</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewCourse(5)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editCourse(5)" title="Edit Course">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn students" onclick="viewCourseStudents(5)" title="View Students">
                                            <i class="fas fa-users"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteCourse(5)" title="Delete Course">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="user-pagination">
                    <div class="pagination-info">
                        Showing <strong>1-5</strong> of <strong>142</strong> courses
                    </div>
                    <div class="pagination-controls">
                        <button class="pagination-btn" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">4</button>
                        <button class="pagination-btn">5</button>
                        <span>...</span>
                        <button class="pagination-btn">29</button>
                        <button class="pagination-btn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="pagination-size">
                        <select class="filter-select" onchange="changeCoursePageSize(this.value)">
                            <option value="5">5 per page</option>
                            <option value="10">10 per page</option>
                            <option value="25">25 per page</option>
                            <option value="50">50 per page</option>
                            <option value="100">100 per page</option>
                        </select>
                    </div>
                </div>

                
                <div class="bulk-actions-bar" id="courseBulkActionsBar" style="display: none;">
                    <span class="selected-count"><strong id="courseSelectedCount">0</strong> courses selected</span>
                    <div class="bulk-actions">
                        <button class="bulk-action-btn" onclick="bulkActivateCourses()">
                            <i class="fas fa-play"></i> Activate
                        </button>
                        <button class="bulk-action-btn" onclick="bulkDeactivateCourses()">
                            <i class="fas fa-pause"></i> Deactivate
                        </button>
                        <button class="bulk-action-btn" onclick="bulkExportCourses()">
                            <i class="fas fa-download"></i> Export Selected
                        </button>
                        <button class="bulk-action-btn" onclick="bulkDuplicateCourses()">
                            <i class="fas fa-copy"></i> Duplicate
                        </button>
                        <button class="bulk-action-btn danger" onclick="bulkDeleteCourses()">
                            <i class="fas fa-trash"></i> Delete Selected
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div id="examinationsModal" class="modal">
        <div class="modal-content large-modal">
            <div class="modal-header examinations-header">
                <h2><i class="fas fa-clipboard-check"></i> Examinations Management</h2>
                <span class="close" onclick="closeModal('examinationsModal')">&times;</span>
            </div>
            <div class="modal-body">
                
                <div class="examinations-toolbar">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="examinationsSearch" placeholder="Search by exam title, course, or instructor..." onkeyup="filterExaminations()">
                    </div>
                    <div class="toolbar-filters">
                        <select id="examinationsStatusFilter" onchange="filterExaminations()">
                            <option value="">All Status</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="graded">Graded</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <select id="examinationsTypeFilter" onchange="filterExaminations()">
                            <option value="">All Types</option>
                            <option value="midterm">Midterm</option>
                            <option value="final">Final Exam</option>
                            <option value="quiz">Quiz</option>
                            <option value="practical">Practical</option>
                        </select>
                        <select id="examinationsDepartmentFilter" onchange="filterExaminations()">
                            <option value="">All Departments</option>
                            <option value="computer-science">Computer Science</option>
                            <option value="engineering">Engineering</option>
                            <option value="business">Business</option>
                            <option value="medicine">Medicine</option>
                            <option value="law">Law</option>
                        </select>
                    </div>
                    <div class="toolbar-actions">
                        <button class="btn-primary" onclick="openScheduleExamModal()">
                            <i class="fas fa-plus"></i> Schedule Exam
                        </button>
                        <button class="btn-secondary" onclick="exportExamsCalendar()">
                            <i class="fas fa-calendar-alt"></i> Calendar View
                        </button>
                        <button class="btn-secondary" onclick="exportExamsReport()">
                            <i class="fas fa-file-export"></i> Export Report
                        </button>
                    </div>
                </div>

                
                <div class="exam-stats-row">
                    <div class="exam-stat-card total">
                        <div class="stat-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="stat-info">
                            <h3>186</h3>
                            <p>Total Exams</p>
                        </div>
                    </div>
                    <div class="exam-stat-card scheduled">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3>42</h3>
                            <p>Upcoming</p>
                        </div>
                    </div>
                    <div class="exam-stat-card completed">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>128</h3>
                            <p>Completed</p>
                        </div>
                    </div>
                    <div class="exam-stat-card average">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-info">
                            <h3>73.2%</h3>
                            <p>Avg. Score</p>
                        </div>
                    </div>
                </div>

                
                <div class="table-container">
                    <table class="examinations-management-table">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkbox-container">
                                        <input type="checkbox" id="selectAllExams" onchange="toggleSelectAllExams()">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <th>Exam Details</th>
                                <th>Course</th>
                                <th>Type</th>
                                <th>Date & Time</th>
                                <th>Duration</th>
                                <th>Students</th>
                                <th>Avg. Score</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="examinationsTableBody">
                            <tr data-department="computer-science" data-type="final" data-status="scheduled">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="exam-checkbox" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="exam-info">
                                        <div class="exam-icon final">
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>
                                        <div class="exam-details">
                                            <h4>Data Structures Final Exam</h4>
                                            <p>Comprehensive assessment covering all topics</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="course-mini">
                                        <span class="course-code">CS301</span>
                                        <span class="dept-badge cs">Computer Science</span>
                                    </div>
                                </td>
                                <td><span class="exam-type-badge final">Final Exam</span></td>
                                <td>
                                    <div class="datetime-display">
                                        <div><i class="fas fa-calendar"></i> Dec 20, 2025</div>
                                        <div><i class="fas fa-clock"></i> 09:00 AM</div>
                                    </div>
                                </td>
                                <td><span class="duration-badge">3 hours</span></td>
                                <td>
                                    <div class="students-count">
                                        <i class="fas fa-users"></i> 89 students
                                    </div>
                                </td>
                                <td><span class="score-display">-</span></td>
                                <td><span class="status-badge scheduled">Scheduled</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewExam(1)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editExam(1)" title="Edit Exam">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn students" onclick="manageExamStudents(1)" title="Manage Students">
                                            <i class="fas fa-users-cog"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteExam(1)" title="Cancel Exam">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="business" data-type="midterm" data-status="completed">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="exam-checkbox" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="exam-info">
                                        <div class="exam-icon midterm">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <div class="exam-details">
                                            <h4>Business Communication Midterm</h4>
                                            <p>Written and oral communication assessment</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="course-mini">
                                        <span class="course-code">ENG201</span>
                                        <span class="dept-badge business">Business</span>
                                    </div>
                                </td>
                                <td><span class="exam-type-badge midterm">Midterm</span></td>
                                <td>
                                    <div class="datetime-display">
                                        <div><i class="fas fa-calendar"></i> Nov 15, 2025</div>
                                        <div><i class="fas fa-clock"></i> 02:00 PM</div>
                                    </div>
                                </td>
                                <td><span class="duration-badge">2 hours</span></td>
                                <td>
                                    <div class="students-count">
                                        <i class="fas fa-users"></i> 76 students
                                    </div>
                                </td>
                                <td>
                                    <div class="score-display-with-bar">
                                        <span class="score-value">78.5%</span>
                                        <div class="score-bar">
                                            <div class="score-fill" style="width: 78.5%; background: linear-gradient(90deg, #ffd700, #ffed4e);"></div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="status-badge graded">Graded</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewExam(2)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn results" onclick="viewExamResults(2)" title="View Results">
                                            <i class="fas fa-chart-bar"></i>
                                        </button>
                                        <button class="action-btn download" onclick="downloadExamReport(2)" title="Download Report">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="business" data-type="final" data-status="in-progress">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="exam-checkbox" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="exam-info">
                                        <div class="exam-icon final">
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>
                                        <div class="exam-details">
                                            <h4>Strategic Management Final</h4>
                                            <p>Case study analysis and strategic planning</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="course-mini">
                                        <span class="course-code">BUS401</span>
                                        <span class="dept-badge business">Business</span>
                                    </div>
                                </td>
                                <td><span class="exam-type-badge final">Final Exam</span></td>
                                <td>
                                    <div class="datetime-display">
                                        <div><i class="fas fa-calendar"></i> Dec 16, 2025</div>
                                        <div><i class="fas fa-clock"></i> 10:00 AM</div>
                                    </div>
                                </td>
                                <td><span class="duration-badge">3 hours</span></td>
                                <td>
                                    <div class="students-count">
                                        <i class="fas fa-users"></i> 54 students
                                    </div>
                                </td>
                                <td><span class="score-display">Pending</span></td>
                                <td>
                                    <span class="status-badge in-progress">
                                        <i class="fas fa-spinner fa-spin"></i> In Progress
                                    </span>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewExam(3)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn monitor" onclick="monitorExam(3)" title="Monitor Exam">
                                            <i class="fas fa-desktop"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="medicine" data-type="practical" data-status="graded">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="exam-checkbox" value="4">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="exam-info">
                                        <div class="exam-icon practical">
                                            <i class="fas fa-heartbeat"></i>
                                        </div>
                                        <div class="exam-details">
                                            <h4>Anatomy Practical Examination</h4>
                                            <p>Hands-on assessment of anatomical knowledge</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="course-mini">
                                        <span class="course-code">MED101</span>
                                        <span class="dept-badge medicine">Medicine</span>
                                    </div>
                                </td>
                                <td><span class="exam-type-badge practical">Practical</span></td>
                                <td>
                                    <div class="datetime-display">
                                        <div><i class="fas fa-calendar"></i> Nov 28, 2025</div>
                                        <div><i class="fas fa-clock"></i> 01:00 PM</div>
                                    </div>
                                </td>
                                <td><span class="duration-badge">4 hours</span></td>
                                <td>
                                    <div class="students-count">
                                        <i class="fas fa-users"></i> 45 students
                                    </div>
                                </td>
                                <td>
                                    <div class="score-display-with-bar">
                                        <span class="score-value">82.3%</span>
                                        <div class="score-bar">
                                            <div class="score-fill" style="width: 82.3%; background: linear-gradient(90deg, #00d4ff, #090979);"></div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="status-badge graded">Graded</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewExam(4)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn results" onclick="viewExamResults(4)" title="View Results">
                                            <i class="fas fa-chart-bar"></i>
                                        </button>
                                        <button class="action-btn download" onclick="downloadExamReport(4)" title="Download Report">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-department="law" data-type="quiz" data-status="scheduled">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="exam-checkbox" value="5">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="exam-info">
                                        <div class="exam-icon quiz">
                                            <i class="fas fa-question-circle"></i>
                                        </div>
                                        <div class="exam-details">
                                            <h4>Constitutional Law Quiz 3</h4>
                                            <p>Quick assessment on recent constitutional cases</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="course-mini">
                                        <span class="course-code">LAW302</span>
                                        <span class="dept-badge law">Law</span>
                                    </div>
                                </td>
                                <td><span class="exam-type-badge quiz">Quiz</span></td>
                                <td>
                                    <div class="datetime-display">
                                        <div><i class="fas fa-calendar"></i> Dec 18, 2025</div>
                                        <div><i class="fas fa-clock"></i> 11:00 AM</div>
                                    </div>
                                </td>
                                <td><span class="duration-badge">45 min</span></td>
                                <td>
                                    <div class="students-count">
                                        <i class="fas fa-users"></i> 24 students
                                    </div>
                                </td>
                                <td><span class="score-display">-</span></td>
                                <td><span class="status-badge scheduled">Scheduled</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewExam(5)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editExam(5)" title="Edit Exam">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn students" onclick="manageExamStudents(5)" title="Manage Students">
                                            <i class="fas fa-users-cog"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteExam(5)" title="Cancel Exam">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

        
                <div class="pagination-container">
                    <div class="pagination-info">
                        Showing <strong>1-5</strong> of <strong>186</strong> exams
                    </div>
                    <div class="pagination">
                        <button class="page-btn" disabled>Previous</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">...</button>
                        <button class="page-btn">38</button>
                        <button class="page-btn">Next</button>
                    </div>
                    <div class="page-size-selector">
                        <label>Show:</label>
                        <select onchange="changeExamPageSize(this.value)">
                            <option value="5" selected>5 per page</option>
                            <option value="10">10 per page</option>
                            <option value="25">25 per page</option>
                            <option value="50">50 per page</option>
                            <option value="100">100 per page</option>
                        </select>
                    </div>
                </div>

        
                <div class="bulk-actions-bar" id="examBulkActionsBar" style="display: none;">
                    <span class="selected-count"><strong id="examSelectedCount">0</strong> exams selected</span>
                    <div class="bulk-actions">
                        <button class="bulk-action-btn" onclick="bulkRescheduleExams()">
                            <i class="fas fa-calendar-alt"></i> Reschedule
                        </button>
                        <button class="bulk-action-btn" onclick="bulkNotifyStudents()">
                            <i class="fas fa-bell"></i> Notify Students
                        </button>
                        <button class="bulk-action-btn" onclick="bulkExportExams()">
                            <i class="fas fa-download"></i> Export Selected
                        </button>
                        <button class="bulk-action-btn danger" onclick="bulkCancelExams()">
                            <i class="fas fa-ban"></i> Cancel Selected
                        </button>
                    </div>
                    <button class="reset-selection" onclick="resetExamSelection()">
                        <i class="fas fa-times"></i> Clear Selection
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Examinations Calendar View Modal -->
    <div id="examsCalendarModal" class="modal">
        <div class="modal-content large-modal">
            <div class="modal-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <h2><i class="fas fa-calendar-alt"></i> Examinations Calendar</h2>
                <span class="close" onclick="closeModal('examsCalendarModal')">&times;</span>
            </div>
            <div class="modal-body">
                <!-- Calendar Controls -->
                <div class="calendar-controls">
                    <button class="calendar-nav-btn" onclick="changeCalendarMonth(-1)">
                        <i class="fas fa-chevron-left"></i> Previous
                    </button>
                    <div class="calendar-title">
                        <h3 id="calendarMonthYear">December 2025</h3>
                        <div class="view-toggles">
                            <button class="view-toggle-btn active" onclick="setCalendarView('month')" data-view="month">
                                <i class="fas fa-calendar"></i> Month
                            </button>
                            <button class="view-toggle-btn" onclick="setCalendarView('week')" data-view="week">
                                <i class="fas fa-calendar-week"></i> Week
                            </button>
                            <button class="view-toggle-btn" onclick="setCalendarView('day')" data-view="day">
                                <i class="fas fa-calendar-day"></i> Day
                            </button>
                        </div>
                    </div>
                    <button class="calendar-nav-btn" onclick="changeCalendarMonth(1)">
                        Next <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Calendar Legend -->
                <div class="calendar-legend">
                    <div class="legend-item">
                        <span class="legend-color scheduled"></span>
                        <span>Scheduled</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color in-progress"></span>
                        <span>In Progress</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color completed"></span>
                        <span>Completed</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color today"></span>
                        <span>Today</span>
                    </div>
                </div>

                <!-- Calendar Grid -->
                <div class="calendar-grid" id="calendarGrid">
                    <div class="calendar-weekday">Sun</div>
                    <div class="calendar-weekday">Mon</div>
                    <div class="calendar-weekday">Tue</div>
                    <div class="calendar-weekday">Wed</div>
                    <div class="calendar-weekday">Thu</div>
                    <div class="calendar-weekday">Fri</div>
                    <div class="calendar-weekday">Sat</div>

                    <!-- Calendar Days (Generated by JavaScript) -->
                    <!-- Example Day with Exams -->
                    <div class="calendar-day other-month">
                        <span class="day-number">30</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">1</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">2</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">3</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">4</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">5</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">6</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">7</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">8</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">9</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">10</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">11</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">12</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">13</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">14</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">15</span>
                    </div>
                    <div class="calendar-day today">
                        <span class="day-number">16</span>
                        <div class="exam-indicator in-progress" title="Strategic Management Final - In Progress">
                            <i class="fas fa-graduation-cap"></i>
                            <span>BUS401</span>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">17</span>
                    </div>
                    <div class="calendar-day has-exams">
                        <span class="day-number">18</span>
                        <div class="exam-indicator scheduled" title="Constitutional Law Quiz - 11:00 AM">
                            <i class="fas fa-question-circle"></i>
                            <span>LAW302</span>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">19</span>
                    </div>
                    <div class="calendar-day has-exams">
                        <span class="day-number">20</span>
                        <div class="exam-indicator scheduled" title="Data Structures Final - 09:00 AM">
                            <i class="fas fa-graduation-cap"></i>
                            <span>CS301</span>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">21</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">22</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">23</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">24</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">25</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">26</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">27</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">28</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">29</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">30</span>
                    </div>
                    <div class="calendar-day">
                        <span class="day-number">31</span>
                    </div>
                    <div class="calendar-day other-month">
                        <span class="day-number">1</span>
                    </div>
                    <div class="calendar-day other-month">
                        <span class="day-number">2</span>
                    </div>
                    <div class="calendar-day other-month">
                        <span class="day-number">3</span>
                    </div>
                </div>

                <!-- Exam Details Sidebar -->
                <div class="exam-details-sidebar" id="examDetailsSidebar">
                    <div class="sidebar-header">
                        <h3>Exams on <span id="selectedDate">December 16, 2025</span></h3>
                        <button class="close-sidebar" onclick="closeExamSidebar()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="sidebar-content" id="sidebarExamsList">
                        <!-- Example Exam Card -->
                        <div class="sidebar-exam-card in-progress">
                            <div class="exam-card-header">
                                <span class="exam-time">10:00 AM - 1:00 PM</span>
                                <span class="exam-status-badge in-progress">In Progress</span>
                            </div>
                            <h4>Strategic Management Final</h4>
                            <div class="exam-card-info">
                                <div><i class="fas fa-book"></i> BUS401</div>
                                <div><i class="fas fa-users"></i> 54 students</div>
                                <div><i class="fas fa-clock"></i> 3 hours</div>
                            </div>
                            <div class="exam-card-actions">
                                <button class="sidebar-btn" onclick="viewExam(3)">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="sidebar-btn" onclick="monitorExam(3)">
                                    <i class="fas fa-desktop"></i> Monitor
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="calendar-actions">
                    <button class="btn-secondary" onclick="exportCalendarToPDF()">
                        <i class="fas fa-file-pdf"></i> Export to PDF
                    </button>
                    <button class="btn-secondary" onclick="exportCalendarToICS()">
                        <i class="fas fa-download"></i> Download .ics
                    </button>
                    <button class="btn-primary" onclick="openScheduleExamModal()">
                        <i class="fas fa-plus"></i> Schedule New Exam
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Library Management Modal -->
    <div id="libraryModal" class="modal">
        <div class="modal-content large-modal">
            <div class="modal-header library-header">
                <h2><i class="fas fa-book-reader"></i> Library Management</h2>
                <span class="close" onclick="closeModal('libraryModal')">&times;</span>
            </div>
            <div class="modal-body">
                <!-- Library Toolbar -->
                <div class="library-toolbar">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="librarySearch" placeholder="Search by book title, author, ISBN..." onkeyup="filterLibraryBooks()">
                    </div>
                    <div class="toolbar-filters">
                        <select id="libraryCategoryFilter" onchange="filterLibraryBooks()">
                            <option value="">All Categories</option>
                            <option value="science">Science</option>
                            <option value="technology">Technology</option>
                            <option value="engineering">Engineering</option>
                            <option value="mathematics">Mathematics</option>
                            <option value="literature">Literature</option>
                            <option value="business">Business</option>
                            <option value="medicine">Medicine</option>
                        </select>
                        <select id="libraryStatusFilter" onchange="filterLibraryBooks()">
                            <option value="">All Status</option>
                            <option value="available">Available</option>
                            <option value="borrowed">Borrowed</option>
                            <option value="reserved">Reserved</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                    <div class="toolbar-actions">
                        <button class="btn-primary" onclick="openAddBookModal()">
                            <i class="fas fa-plus"></i> Add Book
                        </button>
                        <button class="btn-secondary" onclick="openBorrowBookModal()">
                            <i class="fas fa-hand-holding"></i> Issue Book
                        </button>
                        <button class="btn-secondary" onclick="openReturnBookModal()">
                            <i class="fas fa-undo"></i> Return Book
                        </button>
                    </div>
                </div>

                <!-- Library Statistics Row -->
                <div class="library-stats-row">
                    <div class="library-stat-card total">
                        <div class="stat-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-info">
                            <h3>2,456</h3>
                            <p>Total Books</p>
                        </div>
                    </div>
                    <div class="library-stat-card available">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>1,823</h3>
                            <p>Available</p>
                        </div>
                    </div>
                    <div class="library-stat-card borrowed">
                        <div class="stat-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="stat-info">
                            <h3>487</h3>
                            <p>Borrowed</p>
                        </div>
                    </div>
                    <div class="library-stat-card overdue">
                        <div class="stat-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>23</h3>
                            <p>Overdue</p>
                        </div>
                    </div>
                </div>

                <!-- Library Books Table -->
                <div class="table-container">
                    <table class="library-management-table">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkbox-container">
                                        <input type="checkbox" id="selectAllBooks" onchange="toggleSelectAllBooks()">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <th>Book Details</th>
                                <th>Author</th>
                                <th>ISBN</th>
                                <th>Category</th>
                                <th>Copies</th>
                                <th>Available</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="libraryBooksTableBody">
                            <tr data-category="science" data-status="available">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="book-checkbox" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="book-info">
                                        <div class="book-cover">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div class="book-details">
                                            <h4>Introduction to Algorithms</h4>
                                            <p>4th Edition • Published 2022</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="author-info">
                                        <strong>Thomas H. Cormen</strong>
                                    </div>
                                </td>
                                <td><span class="isbn-code">978-0262046305</span></td>
                                <td><span class="category-badge science">Science</span></td>
                                <td><span class="copy-count">5</span></td>
                                <td><span class="available-count">4</span></td>
                                <td><span class="status-badge available">Available</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewBook(1)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editBook(1)" title="Edit Book">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn borrow" onclick="issueBook(1)" title="Issue Book">
                                            <i class="fas fa-hand-holding"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteBook(1)" title="Delete Book">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-category="technology" data-status="borrowed">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="book-checkbox" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="book-info">
                                        <div class="book-cover">
                                            <i class="fas fa-laptop-code"></i>
                                        </div>
                                        <div class="book-details">
                                            <h4>Clean Code</h4>
                                            <p>A Handbook of Agile Software • 2008</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="author-info">
                                        <strong>Robert C. Martin</strong>
                                    </div>
                                </td>
                                <td><span class="isbn-code">978-0132350884</span></td>
                                <td><span class="category-badge technology">Technology</span></td>
                                <td><span class="copy-count">3</span></td>
                                <td><span class="available-count">0</span></td>
                                <td><span class="status-badge borrowed">Borrowed</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewBook(2)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editBook(2)" title="Edit Book">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn history" onclick="viewBorrowHistory(2)" title="Borrow History">
                                            <i class="fas fa-history"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-category="engineering" data-status="available">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="book-checkbox" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="book-info">
                                        <div class="book-cover">
                                            <i class="fas fa-cogs"></i>
                                        </div>
                                        <div class="book-details">
                                            <h4>Engineering Mechanics</h4>
                                            <p>Statics and Dynamics • 14th Edition</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="author-info">
                                        <strong>Russell C. Hibbeler</strong>
                                    </div>
                                </td>
                                <td><span class="isbn-code">978-0133915426</span></td>
                                <td><span class="category-badge engineering">Engineering</span></td>
                                <td><span class="copy-count">8</span></td>
                                <td><span class="available-count">6</span></td>
                                <td><span class="status-badge available">Available</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewBook(3)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editBook(3)" title="Edit Book">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn borrow" onclick="issueBook(3)" title="Issue Book">
                                            <i class="fas fa-hand-holding"></i>
                                        </button>
                                        <button class="action-btn delete" onclick="deleteBook(3)" title="Delete Book">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-category="business" data-status="reserved">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="book-checkbox" value="4">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="book-info">
                                        <div class="book-cover">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                        <div class="book-details">
                                            <h4>Strategic Management</h4>
                                            <p>Concepts and Cases • 2023</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="author-info">
                                        <strong>Fred R. David</strong>
                                    </div>
                                </td>
                                <td><span class="isbn-code">978-0134431499</span></td>
                                <td><span class="category-badge business">Business</span></td>
                                <td><span class="copy-count">4</span></td>
                                <td><span class="available-count">1</span></td>
                                <td><span class="status-badge reserved">Reserved</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewBook(4)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editBook(4)" title="Edit Book">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn reserve" onclick="viewReservations(4)" title="View Reservations">
                                            <i class="fas fa-bookmark"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-category="medicine" data-status="maintenance">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="book-checkbox" value="5">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="book-info">
                                        <div class="book-cover">
                                            <i class="fas fa-heartbeat"></i>
                                        </div>
                                        <div class="book-details">
                                            <h4>Gray's Anatomy</h4>
                                            <p>42nd Edition • Classic Reference</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="author-info">
                                        <strong>Susan Standring</strong>
                                    </div>
                                </td>
                                <td><span class="isbn-code">978-0702077050</span></td>
                                <td><span class="category-badge medicine">Medicine</span></td>
                                <td><span class="copy-count">2</span></td>
                                <td><span class="available-count">0</span></td>
                                <td><span class="status-badge maintenance">Maintenance</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewBook(5)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" onclick="editBook(5)" title="Edit Book">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn maintenance" onclick="updateBookStatus(5)" title="Update Status">
                                            <i class="fas fa-tools"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-container">
                    <div class="pagination-info">
                        Showing <strong>1-5</strong> of <strong>2,456</strong> books
                    </div>
                    <div class="pagination">
                        <button class="page-btn" disabled>Previous</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">...</button>
                        <button class="page-btn">492</button>
                        <button class="page-btn">Next</button>
                    </div>
                    <div class="page-size-selector">
                        <label>Show:</label>
                        <select onchange="changeLibraryPageSize(this.value)">
                            <option value="5" selected>5 per page</option>
                            <option value="10">10 per page</option>
                            <option value="25">25 per page</option>
                            <option value="50">50 per page</option>
                            <option value="100">100 per page</option>
                        </select>
                    </div>
                </div>

                
                <div class="bulk-actions-bar" id="libraryBulkActionsBar" style="display: none;">
                    <span class="selected-count"><strong id="librarySelectedCount">0</strong> books selected</span>
                    <div class="bulk-actions">
                        <button class="bulk-action-btn" onclick="bulkChangeCategory()">
                            <i class="fas fa-tag"></i> Change Category
                        </button>
                        <button class="bulk-action-btn" onclick="bulkExportBooks()">
                            <i class="fas fa-download"></i> Export Selected
                        </button>
                        <button class="bulk-action-btn danger" onclick="bulkDeleteBooks()">
                            <i class="fas fa-trash"></i> Delete Selected
                        </button>
                    </div>
                    <button class="reset-selection" onclick="resetLibrarySelection()">
                        <i class="fas fa-times"></i> Clear Selection
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div id="financeModal" class="modal">
        <div class="modal-content large-modal">
            <div class="modal-header finance-header">
                <h2><i class="fas fa-credit-card"></i> Finance Management</h2>
                <span class="close" onclick="closeModal('financeModal')">&times;</span>
            </div>
            <div class="modal-body">
                
                <div class="finance-toolbar">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="financeSearch" placeholder="Search by student name, ID, transaction ID..." onkeyup="filterFinanceRecords()">
                    </div>
                    <div class="toolbar-filters">
                        <select id="financeTypeFilter" onchange="filterFinanceRecords()">
                            <option value="">All Types</option>
                            <option value="tuition">Tuition Fee</option>
                            <option value="library">Library Fee</option>
                            <option value="hostel">Hostel Fee</option>
                            <option value="exam">Exam Fee</option>
                            <option value="fine">Fine</option>
                            <option value="other">Other</option>
                        </select>
                        <select id="financeStatusFilter" onchange="filterFinanceRecords()">
                            <option value="">All Status</option>
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                            <option value="overdue">Overdue</option>
                            <option value="partial">Partial</option>
                        </select>
                        <select id="financeMonthFilter" onchange="filterFinanceRecords()">
                            <option value="">All Months</option>
                            <option value="january">January</option>
                            <option value="february">February</option>
                            <option value="march">March</option>
                            <option value="april">April</option>
                            <option value="may">May</option>
                            <option value="june">June</option>
                            <option value="july">July</option>
                            <option value="august">August</option>
                            <option value="september">September</option>
                            <option value="october">October</option>
                            <option value="november">November</option>
                            <option value="december">December</option>
                        </select>
                    </div>
                    <div class="toolbar-actions">
                        <button class="btn-primary" onclick="openAddPaymentModal()">
                            <i class="fas fa-plus"></i> Add Payment
                        </button>
                        <button class="btn-secondary" onclick="openGenerateInvoiceModal()">
                            <i class="fas fa-file-invoice"></i> Generate Invoice
                        </button>
                        <button class="btn-secondary" onclick="exportFinanceReport()">
                            <i class="fas fa-download"></i> Export Report
                        </button>
                    </div>
                </div>

                
                <div class="finance-stats-row">
                    <div class="finance-stat-card total-revenue">
                        <div class="stat-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-info">
                            <h3>$2,847,500</h3>
                            <p>Total Revenue</p>
                            <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 12.5%</span>
                        </div>
                    </div>
                    <div class="finance-stat-card collected">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>$2,156,300</h3>
                            <p>Collected</p>
                            <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 8.3%</span>
                        </div>
                    </div>
                    <div class="finance-stat-card pending">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3>$487,200</h3>
                            <p>Pending</p>
                            <span class="stat-change neutral"><i class="fas fa-minus"></i> 0%</span>
                        </div>
                    </div>
                    <div class="finance-stat-card overdue">
                        <div class="stat-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>$204,000</h3>
                            <p>Overdue</p>
                            <span class="stat-change negative"><i class="fas fa-arrow-down"></i> 15.2%</span>
                        </div>
                    </div>
                </div>

                
                <div class="table-container">
                    <table class="finance-management-table">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkbox-container">
                                        <input type="checkbox" id="selectAllFinance" onchange="toggleSelectAllFinance()">
                                        <span class="checkmark"></span>
                                    </label>
                                </th>
                                <th>Transaction ID</th>
                                <th>Student Details</th>
                                <th>Fee Type</th>
                                <th>Amount</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="financeTableBody">
                            <tr data-type="tuition" data-status="paid" data-month="december">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="finance-checkbox" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td><span class="transaction-id">#TXN-2025-001</span></td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div class="student-details">
                                            <h4>Sarah Johnson</h4>
                                            <p>ID: STU-2023-045 • CS Department</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="fee-type-badge tuition">Tuition Fee</span></td>
                                <td><span class="amount">$5,000.00</span></td>
                                <td><span class="paid-amount">$5,000.00</span></td>
                                <td><span class="balance-amount zero">$0.00</span></td>
                                <td><span class="due-date">Dec 15, 2025</span></td>
                                <td><span class="status-badge paid">Paid</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewTransaction(1)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn receipt" onclick="generateReceipt(1)" title="Generate Receipt">
                                            <i class="fas fa-receipt"></i>
                                        </button>
                                        <button class="action-btn print" onclick="printReceipt(1)" title="Print">
                                            <i class="fas fa-print"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-type="hostel" data-status="pending" data-month="december">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="finance-checkbox" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td><span class="transaction-id">#TXN-2025-002</span></td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div class="student-details">
                                            <h4>Michael Chen</h4>
                                            <p>ID: STU-2023-078 • Engineering</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="fee-type-badge hostel">Hostel Fee</span></td>
                                <td><span class="amount">$2,500.00</span></td>
                                <td><span class="paid-amount">$0.00</span></td>
                                <td><span class="balance-amount">$2,500.00</span></td>
                                <td><span class="due-date">Dec 20, 2025</span></td>
                                <td><span class="status-badge pending">Pending</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewTransaction(2)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn pay" onclick="recordPayment(2)" title="Record Payment">
                                            <i class="fas fa-money-bill"></i>
                                        </button>
                                        <button class="action-btn remind" onclick="sendReminder(2)" title="Send Reminder">
                                            <i class="fas fa-bell"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-type="exam" data-status="partial" data-month="november">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="finance-checkbox" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td><span class="transaction-id">#TXN-2025-003</span></td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div class="student-details">
                                            <h4>Emily Rodriguez</h4>
                                            <p>ID: STU-2023-112 • Business</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="fee-type-badge exam">Exam Fee</span></td>
                                <td><span class="amount">$800.00</span></td>
                                <td><span class="paid-amount">$400.00</span></td>
                                <td><span class="balance-amount">$400.00</span></td>
                                <td><span class="due-date">Dec 10, 2025</span></td>
                                <td><span class="status-badge partial">Partial</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewTransaction(3)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn pay" onclick="recordPayment(3)" title="Record Payment">
                                            <i class="fas fa-money-bill"></i>
                                        </button>
                                        <button class="action-btn history" onclick="viewPaymentHistory(3)" title="Payment History">
                                            <i class="fas fa-history"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-type="library" data-status="overdue" data-month="november">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="finance-checkbox" value="4">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td><span class="transaction-id">#TXN-2025-004</span></td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div class="student-details">
                                            <h4>David Kumar</h4>
                                            <p>ID: STU-2023-156 • Medicine</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="fee-type-badge library">Library Fee</span></td>
                                <td><span class="amount">$150.00</span></td>
                                <td><span class="paid-amount">$0.00</span></td>
                                <td><span class="balance-amount">$150.00</span></td>
                                <td><span class="due-date overdue">Nov 30, 2025</span></td>
                                <td><span class="status-badge overdue">Overdue</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewTransaction(4)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn pay" onclick="recordPayment(4)" title="Record Payment">
                                            <i class="fas fa-money-bill"></i>
                                        </button>
                                        <button class="action-btn warning" onclick="sendOverdueNotice(4)" title="Send Overdue Notice">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr data-type="fine" data-status="overdue" data-month="october">
                                <td>
                                    <label class="checkbox-container">
                                        <input type="checkbox" class="finance-checkbox" value="5">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td><span class="transaction-id">#TXN-2025-005</span></td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div class="student-details">
                                            <h4>Jessica Williams</h4>
                                            <p>ID: STU-2023-189 • Law</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="fee-type-badge fine">Late Fine</span></td>
                                <td><span class="amount">$75.00</span></td>
                                <td><span class="paid-amount">$0.00</span></td>
                                <td><span class="balance-amount">$75.00</span></td>
                                <td><span class="due-date overdue">Oct 15, 2025</span></td>
                                <td><span class="status-badge overdue">Overdue</span></td>
                                <td>
                                    <div class="action-btns">
                                        <button class="action-btn view" onclick="viewTransaction(5)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn pay" onclick="recordPayment(5)" title="Record Payment">
                                            <i class="fas fa-money-bill"></i>
                                        </button>
                                        <button class="action-btn waive" onclick="waiveFee(5)" title="Waive Fee">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            
                <div class="pagination-container">
                    <div class="pagination-info">
                        Showing <strong>1-5</strong> of <strong>1,234</strong> transactions
                    </div>
                    <div class="pagination">
                        <button class="page-btn" disabled>Previous</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">...</button>
                        <button class="page-btn">247</button>
                        <button class="page-btn">Next</button>
                    </div>
                    <div class="page-size-selector">
                        <label>Show:</label>
                        <select onchange="changeFinancePageSize(this.value)">
                            <option value="5" selected>5 per page</option>
                            <option value="10">10 per page</option>
                            <option value="25">25 per page</option>
                            <option value="50">50 per page</option>
                            <option value="100">100 per page</option>
                        </select>
                    </div>
                </div>

                
                <div class="bulk-actions-bar" id="financeBulkActionsBar" style="display: none;">
                    <span class="selected-count"><strong id="financeSelectedCount">0</strong> transactions selected</span>
                    <div class="bulk-actions">
                        <button class="bulk-action-btn" onclick="bulkSendReminders()">
                            <i class="fas fa-bell"></i> Send Reminders
                        </button>
                        <button class="bulk-action-btn" onclick="bulkGenerateInvoices()">
                            <i class="fas fa-file-invoice"></i> Generate Invoices
                        </button>
                        <button class="bulk-action-btn" onclick="bulkExportFinance()">
                            <i class="fas fa-download"></i> Export Selected
                        </button>
                    </div>
                    <button class="reset-selection" onclick="resetFinanceSelection()">
                        <i class="fas fa-times"></i> Clear Selection
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Payment Modal -->
    <div id="addPaymentModal" class="modal">
        <div class="modal-content medium-modal">
            <div class="modal-header" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <h2><i class="fas fa-plus-circle"></i> Add Payment</h2>
                <span class="close" onclick="closeModal('addPaymentModal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="addPaymentForm" class="payment-form">
                    <!-- Student Search Section -->
                    <div class="form-section">
                        <h3><i class="fas fa-user-graduate"></i> Student Information</h3>
                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="studentSearch">Search Student <span class="required">*</span></label>
                                <div class="search-input-wrapper">
                                    <i class="fas fa-search"></i>
                                    <input type="text" id="studentSearch" placeholder="Search by name, ID, or email..." required>
                                    <div class="search-results" id="studentSearchResults" style="display: none;">
                                        <!-- Dynamic search results will appear here -->
                                        <div class="search-result-item" onclick="selectStudent('STU-2023-045', 'Sarah Johnson', 'Computer Science')">
                                            <div class="result-avatar"><i class="fas fa-user-graduate"></i></div>
                                            <div class="result-info">
                                                <strong>Sarah Johnson</strong>
                                                <span>STU-2023-045 • Computer Science</span>
                                            </div>
                                        </div>
                                        <div class="search-result-item" onclick="selectStudent('STU-2023-078', 'Michael Chen', 'Engineering')">
                                            <div class="result-avatar"><i class="fas fa-user-graduate"></i></div>
                                            <div class="result-info">
                                                <strong>Michael Chen</strong>
                                                <span>STU-2023-078 • Engineering</span>
                                            </div>
                                        </div>
                                        <div class="search-result-item" onclick="selectStudent('STU-2023-112', 'Emily Rodriguez', 'Business')">
                                            <div class="result-avatar"><i class="fas fa-user-graduate"></i></div>
                                            <div class="result-info">
                                                <strong>Emily Rodriguez</strong>
                                                <span>STU-2023-112 • Business</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="selectedStudentInfo" class="selected-student-card" style="display: none;">
                            <div class="student-card-avatar">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="student-card-details">
                                <h4 id="selectedStudentName">-</h4>
                                <p id="selectedStudentId">-</p>
                            </div>
                            <button type="button" class="remove-student" onclick="clearStudentSelection()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Payment Details Section -->
                    <div class="form-section">
                        <h3><i class="fas fa-credit-card"></i> Payment Details</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="feeType">Fee Type <span class="required">*</span></label>
                                <select id="feeType" required onchange="updateFeeAmount()">
                                    <option value="">Select Fee Type</option>
                                    <option value="tuition" data-amount="5000">Tuition Fee - $5,000</option>
                                    <option value="hostel" data-amount="2500">Hostel Fee - $2,500</option>
                                    <option value="exam" data-amount="800">Exam Fee - $800</option>
                                    <option value="library" data-amount="150">Library Fee - $150</option>
                                    <option value="lab" data-amount="500">Lab Fee - $500</option>
                                    <option value="sports" data-amount="300">Sports Fee - $300</option>
                                    <option value="fine" data-amount="0">Late Fine</option>
                                    <option value="other" data-amount="0">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="totalAmount">Total Amount <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                    <input type="number" id="totalAmount" placeholder="0.00" step="0.01" min="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="paidAmount">Paid Amount <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <input type="number" id="paidAmount" placeholder="0.00" step="0.01" min="0" required oninput="calculateBalance()">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="balanceAmount">Balance</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-calculator"></i>
                                    <input type="number" id="balanceAmount" placeholder="0.00" step="0.01" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-section">
                        <h3><i class="fas fa-wallet"></i> Payment Method</h3>
                        <div class="payment-method-selector">
                            <div class="payment-method-option" onclick="selectPaymentMethod('cash')">
                                <input type="radio" name="paymentMethod" id="methodCash" value="cash" required>
                                <label for="methodCash">
                                    <i class="fas fa-money-bill-alt"></i>
                                    <span>Cash</span>
                                </label>
                            </div>
                            <div class="payment-method-option" onclick="selectPaymentMethod('card')">
                                <input type="radio" name="paymentMethod" id="methodCard" value="card">
                                <label for="methodCard">
                                    <i class="fas fa-credit-card"></i>
                                    <span>Card</span>
                                </label>
                            </div>
                            <div class="payment-method-option" onclick="selectPaymentMethod('online')">
                                <input type="radio" name="paymentMethod" id="methodOnline" value="online">
                                <label for="methodOnline">
                                    <i class="fas fa-globe"></i>
                                    <span>Online Transfer</span>
                                </label>
                            </div>
                            <div class="payment-method-option" onclick="selectPaymentMethod('check')">
                                <input type="radio" name="paymentMethod" id="methodCheck" value="check">
                                <label for="methodCheck">
                                    <i class="fas fa-money-check"></i>
                                    <span>Cheque</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="transactionRef">Transaction Reference</label>
                                <input type="text" id="transactionRef" placeholder="Enter reference number...">
                            </div>
                            <div class="form-group">
                                <label for="paymentDate">Payment Date <span class="required">*</span></label>
                                <input type="date" id="paymentDate" required>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-section">
                        <h3><i class="fas fa-info-circle"></i> Additional Information</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="receivedBy">Received By</label>
                                <input type="text" id="receivedBy" placeholder="Staff name..." value="<?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester/Term</label>
                                <select id="semester">
                                    <option value="">Select Semester</option>
                                    <option value="fall2025">Fall 2025</option>
                                    <option value="spring2026">Spring 2026</option>
                                    <option value="summer2026">Summer 2026</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="paymentNotes">Notes/Remarks</label>
                                <textarea id="paymentNotes" rows="3" placeholder="Add any additional notes or remarks..."></textarea>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-section">
                        <div class="checkbox-options">
                            <label class="checkbox-label">
                                <input type="checkbox" id="generateReceipt" checked>
                                <span class="checkbox-custom"></span>
                                <span class="checkbox-text">Generate receipt automatically</span>
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" id="sendNotification" checked>
                                <span class="checkbox-custom"></span>
                                <span class="checkbox-text">Send payment confirmation to student</span>
                            </label>
                        </div>
                    </div>

                    
                    <div class="form-actions">
                        <button type="button" class="btn-secondary" onclick="closeModal('addPaymentModal')">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button type="button" class="btn-secondary" onclick="resetPaymentForm()">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-check"></i> Save Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div id="reportsModal" class="modal">
        <div class="modal-content large-modal">
            <div class="modal-header reports-header">
                <h2><i class="fas fa-chart-bar"></i> Reports & Analytics</h2>
                <span class="close" onclick="closeModal('reportsModal')">&times;</span>
            </div>
            <div class="modal-body">
            
                <div class="report-categories-grid">
                    
                    <div class="report-category-card academic">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h3>Academic Reports</h3>
                        </div>
                        <div class="category-description">
                            Student performance, grades, and academic progress tracking
                        </div>
                        <div class="report-list">
                            <div class="report-item" onclick="generateReport('student-performance')">
                                <i class="fas fa-chart-line"></i>
                                <div class="report-info">
                                    <h4>Student Performance Report</h4>
                                    <p>Overall academic performance analysis</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('grade-distribution')">
                                <i class="fas fa-chart-pie"></i>
                                <div class="report-info">
                                    <h4>Grade Distribution</h4>
                                    <p>Grade statistics by course and semester</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('attendance')">
                                <i class="fas fa-calendar-check"></i>
                                <div class="report-info">
                                    <h4>Attendance Report</h4>
                                    <p>Student attendance records and trends</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('transcript')">
                                <i class="fas fa-file-alt"></i>
                                <div class="report-info">
                                    <h4>Academic Transcripts</h4>
                                    <p>Official student transcripts</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                        </div>
                    </div>

                    
                    <div class="report-category-card financial">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <h3>Financial Reports</h3>
                        </div>
                        <div class="category-description">
                            Revenue, payments, fees, and financial analytics
                        </div>
                        <div class="report-list">
                            <div class="report-item" onclick="generateReport('fee-collection')">
                                <i class="fas fa-money-bill-wave"></i>
                                <div class="report-info">
                                    <h4>Fee Collection Report</h4>
                                    <p>Payment collection and outstanding dues</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('revenue-analysis')">
                                <i class="fas fa-chart-area"></i>
                                <div class="report-info">
                                    <h4>Revenue Analysis</h4>
                                    <p>Monthly and yearly revenue trends</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('outstanding-fees')">
                                <i class="fas fa-exclamation-triangle"></i>
                                <div class="report-info">
                                    <h4>Outstanding Fees</h4>
                                    <p>Pending and overdue payments</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('payment-methods')">
                                <i class="fas fa-credit-card"></i>
                                <div class="report-info">
                                    <h4>Payment Methods Report</h4>
                                    <p>Transaction analysis by payment type</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                        </div>
                    </div>

                    
                    <div class="report-category-card student">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h3>Student Reports</h3>
                        </div>
                        <div class="category-description">
                            Student enrollment, demographics, and activity reports
                        </div>
                        <div class="report-list">
                            <div class="report-item" onclick="generateReport('enrollment')">
                                <i class="fas fa-users"></i>
                                <div class="report-info">
                                    <h4>Enrollment Report</h4>
                                    <p>Student enrollment statistics</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('demographics')">
                                <i class="fas fa-globe"></i>
                                <div class="report-info">
                                    <h4>Demographics Report</h4>
                                    <p>Student demographics and distribution</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('alumni')">
                                <i class="fas fa-user-tie"></i>
                                <div class="report-info">
                                    <h4>Alumni Report</h4>
                                    <p>Graduate tracking and placement</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('student-activity')">
                                <i class="fas fa-running"></i>
                                <div class="report-info">
                                    <h4>Student Activity Report</h4>
                                    <p>Extracurricular participation</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                        </div>
                    </div>

                
                    <div class="report-category-card faculty">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <h3>Faculty Reports</h3>
                        </div>
                        <div class="category-description">
                            Faculty performance, workload, and evaluation reports
                        </div>
                        <div class="report-list">
                            <div class="report-item" onclick="generateReport('faculty-workload')">
                                <i class="fas fa-tasks"></i>
                                <div class="report-info">
                                    <h4>Faculty Workload</h4>
                                    <p>Course assignments and teaching hours</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('teaching-evaluation')">
                                <i class="fas fa-star"></i>
                                <div class="report-info">
                                    <h4>Teaching Evaluation</h4>
                                    <p>Student feedback and ratings</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('faculty-attendance')">
                                <i class="fas fa-user-check"></i>
                                <div class="report-info">
                                    <h4>Faculty Attendance</h4>
                                    <p>Faculty attendance and leave records</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('research-output')">
                                <i class="fas fa-microscope"></i>
                                <div class="report-info">
                                    <h4>Research Output</h4>
                                    <p>Publications and research activities</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                        </div>
                    </div>

                    
                    <div class="report-category-card examination">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="fas fa-file-signature"></i>
                            </div>
                            <h3>Examination Reports</h3>
                        </div>
                        <div class="category-description">
                            Exam schedules, results, and analysis reports
                        </div>
                        <div class="report-list">
                            <div class="report-item" onclick="generateReport('exam-schedule')">
                                <i class="fas fa-calendar-alt"></i>
                                <div class="report-info">
                                    <h4>Exam Schedule</h4>
                                    <p>Examination timetables and venues</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('exam-results')">
                                <i class="fas fa-poll"></i>
                                <div class="report-info">
                                    <h4>Exam Results</h4>
                                    <p>Comprehensive examination results</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('result-analysis')">
                                <i class="fas fa-chart-bar"></i>
                                <div class="report-info">
                                    <h4>Result Analysis</h4>
                                    <p>Pass/fail rates and performance trends</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('hall-tickets')">
                                <i class="fas fa-id-card"></i>
                                <div class="report-info">
                                    <h4>Hall Tickets</h4>
                                    <p>Examination admit cards</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                        </div>
                    </div>

                
                    <div class="report-category-card library">
                        <div class="category-header">
                            <div class="category-icon">
                                <i class="fas fa-book-reader"></i>
                            </div>
                            <h3>Library Reports</h3>
                        </div>
                        <div class="category-description">
                            Book circulation, inventory, and usage statistics
                        </div>
                        <div class="report-list">
                            <div class="report-item" onclick="generateReport('book-circulation')">
                                <i class="fas fa-exchange-alt"></i>
                                <div class="report-info">
                                    <h4>Book Circulation</h4>
                                    <p>Borrowing and return statistics</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('library-inventory')">
                                <i class="fas fa-boxes"></i>
                                <div class="report-info">
                                    <h4>Library Inventory</h4>
                                    <p>Complete book catalog and stock</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('overdue-books')">
                                <i class="fas fa-clock"></i>
                                <div class="report-info">
                                    <h4>Overdue Books</h4>
                                    <p>Late returns and fines</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                            <div class="report-item" onclick="generateReport('popular-books')">
                                <i class="fas fa-fire"></i>
                                <div class="report-info">
                                    <h4>Popular Books</h4>
                                    <p>Most borrowed and trending books</p>
                                </div>
                                <button class="generate-btn"><i class="fas fa-download"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="custom-report-section">
                    <div class="section-header">
                        <h3><i class="fas fa-magic"></i> Custom Report Builder</h3>
                        <p>Create customized reports with specific parameters</p>
                    </div>
                    <div class="custom-report-form">
                        <div class="form-row-inline">
                            <div class="form-field">
                                <label>Report Type</label>
                                <select id="customReportType">
                                    <option value="">Select Report Type</option>
                                    <option value="academic">Academic</option>
                                    <option value="financial">Financial</option>
                                    <option value="student">Student</option>
                                    <option value="faculty">Faculty</option>
                                    <option value="examination">Examination</option>
                                    <option value="library">Library</option>
                                </select>
                            </div>
                            <div class="form-field">
                                <label>Date Range</label>
                                <select id="customDateRange">
                                    <option value="today">Today</option>
                                    <option value="week">This Week</option>
                                    <option value="month" selected>This Month</option>
                                    <option value="quarter">This Quarter</option>
                                    <option value="year">This Year</option>
                                    <option value="custom">Custom Range</option>
                                </select>
                            </div>
                            <div class="form-field">
                                <label>Format</label>
                                <select id="customReportFormat">
                                    <option value="pdf">PDF</option>
                                    <option value="excel">Excel</option>
                                    <option value="csv">CSV</option>
                                </select>
                            </div>
                            <div class="form-field">
                                <button class="btn-primary" onclick="generateCustomReport()">
                                    <i class="fas fa-cog"></i> Generate Custom Report
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            
                <div class="report-stats-overview">
                    <div class="stat-box">
                        <div class="stat-icon academic">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-details">
                            <h4>2,847</h4>
                            <p>Reports Generated</p>
                        </div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-icon success">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-details">
                            <h4>124</h4>
                            <p>This Month</p>
                        </div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-icon info">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="stat-details">
                            <h4>5,692</h4>
                            <p>Total Downloads</p>
                        </div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-icon warning">
                            <i class="fas fa-history"></i>
                        </div>
                        <div class="stat-details">
                            <h4>15 mins</h4>
                            <p>Avg. Generation Time</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

        
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        }

        function openAddUserModal() {
            openModal('addUserModal');
        }

        function openUserManagementModal() {
            openModal('userManagementModal');
        }

        
        function filterUsers() {
            const searchInput = document.getElementById('userSearchInput').value.toLowerCase();
            const roleFilter = document.getElementById('roleFilter').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
            const tableBody = document.getElementById('userTableBody');
            const rows = tableBody.getElementsByTagName('tr');

            let visibleCount = 0;

            for (let row of rows) {
                const userRole = row.getAttribute('data-role');
                const userStatus = row.getAttribute('data-status');
                const userText = row.textContent.toLowerCase();

                const matchesSearch = userText.includes(searchInput);
                const matchesRole = !roleFilter || userRole === roleFilter;
                const matchesStatus = !statusFilter || userStatus === statusFilter;

                if (matchesSearch && matchesRole && matchesStatus) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }
        }

        function viewUser(userId) {
            alert('Viewing user details for User ID: ' + userId + '\n\nThis will open a detailed user profile view.');
        }

        function editUser(userId) {
            alert('Editing user: ' + userId + '\n\nThis will open the edit form with user details pre-filled.');
        }

        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?\n\nThis action cannot be undone.')) {
                alert('User ' + userId + ' has been deleted successfully.');
                
                const row = event.target.closest('tr');
                if (row) {
                    row.style.animation = 'fadeOut 0.3s ease-out';
                    setTimeout(() => row.remove(), 300);
                }
            }
        }

        function toggleSelectAll(checkbox) {
            const checkboxes = document.getElementsByClassName('user-checkbox');
            for (let cb of checkboxes) {
                cb.checked = checkbox.checked;
            }
            updateBulkActionsBar();
        }

        function updateBulkActionsBar() {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            const bulkActionsBar = document.getElementById('bulkActionsBar');
            const selectedCount = document.getElementById('selectedCount');

            if (checkedBoxes.length > 0) {
                bulkActionsBar.style.display = 'flex';
                selectedCount.textContent = checkedBoxes.length;
            } else {
                bulkActionsBar.style.display = 'none';
            }

            
            const selectAllCheckbox = document.getElementById('selectAllUsers');
            selectAllCheckbox.checked = checkedBoxes.length === checkboxes.length && checkboxes.length > 0;
            selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < checkboxes.length;
        }

        
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateBulkActionsBar);
            });
        });

        function bulkActivate() {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            if (confirm('Activate ' + checkedBoxes.length + ' selected users?')) {
                alert(checkedBoxes.length + ' users have been activated successfully.');
                resetSelection();
            }
        }

        function bulkDeactivate() {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            if (confirm('Deactivate ' + checkedBoxes.length + ' selected users?')) {
                alert(checkedBoxes.length + ' users have been deactivated successfully.');
                resetSelection();
            }
        }

        function bulkExport() {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            alert('Exporting ' + checkedBoxes.length + ' selected users to CSV file...');
            resetSelection();
        }

        function bulkDelete() {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            if (confirm('⚠️ WARNING: Delete ' + checkedBoxes.length + ' selected users?\n\nThis action cannot be undone!')) {
                if (confirm('Are you absolutely sure? Type DELETE to confirm')) {
                    alert(checkedBoxes.length + ' users have been deleted successfully.');
                    checkedBoxes.forEach(checkbox => {
                        const row = checkbox.closest('tr');
                        if (row) {
                            row.style.animation = 'fadeOut 0.3s ease-out';
                            setTimeout(() => row.remove(), 300);
                        }
                    });
                    setTimeout(resetSelection, 400);
                }
            }
        }

        function resetSelection() {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = false);
            document.getElementById('selectAllUsers').checked = false;
            updateBulkActionsBar();
        }

        function exportUsers() {
            alert('Exporting all users to CSV file...\n\nThe file will be downloaded to your computer.');
        }

        function changePageSize(size) {
            alert('Changing page size to ' + size + ' users per page...');
        }

        function openAddUserModal() {
            closeModal('userManagementModal');
            openModal('addUserModal');
        }

        function openStudentsModal() {
            openModal('studentsModal');
            
            setTimeout(function() {
                const studentCheckboxes = document.querySelectorAll('.student-checkbox');
                studentCheckboxes.forEach(checkbox => {
                    checkbox.removeEventListener('change', updateStudentBulkActionsBar);
                    checkbox.addEventListener('change', updateStudentBulkActionsBar);
                });
            }, 100);
        }

        
        function filterStudents() {
            const searchInput = document.getElementById('studentSearchInput').value.toLowerCase();
            const deptFilter = document.getElementById('departmentFilter').value.toLowerCase();
            const yearFilter = document.getElementById('yearFilter').value;
            const statusFilter = document.getElementById('studentStatusFilter').value.toLowerCase();
            const tableBody = document.getElementById('studentTableBody');
            const rows = tableBody.getElementsByTagName('tr');

            let visibleCount = 0;

            for (let row of rows) {
                const dept = row.getAttribute('data-department');
                const year = row.getAttribute('data-year');
                const status = row.getAttribute('data-status');
                const rowText = row.textContent.toLowerCase();

                const matchesSearch = rowText.includes(searchInput);
                const matchesDept = !deptFilter || dept === deptFilter;
                const matchesYear = !yearFilter || year === yearFilter;
                const matchesStatus = !statusFilter || status === statusFilter;

                if (matchesSearch && matchesDept && matchesYear && matchesStatus) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }
        }

        function viewStudent(studentId) {
            alert('Opening student profile for Student ID: ' + studentId + '\n\n' +
                  'This will display:\n' +
                  '• Personal Information\n' +
                  '• Academic Records\n' +
                  '• Enrolled Courses\n' +
                  '• Attendance History\n' +
                  '• Financial Status\n' +
                  '• Documents');
        }

        function editStudent(studentId) {
            alert('Opening edit form for Student ID: ' + studentId + '\n\n' +
                  'You can modify:\n' +
                  '• Personal details\n' +
                  '• Contact information\n' +
                  '• Academic status\n' +
                  '• Emergency contacts');
        }

        function viewTranscript(studentId) {
            alert('Generating transcript for Student ID: ' + studentId + '\n\n' +
                  'The transcript will include:\n' +
                  '• All completed courses\n' +
                  '• Grades and credits\n' +
                  '• Cumulative GPA\n' +
                  '• Honors and awards');
        }

        function deleteStudent(studentId) {
            if (confirm('⚠️ WARNING: Delete this student?\n\n' +
                       'This will permanently remove:\n' +
                       '• Student record\n' +
                       '• Academic history\n' +
                       '• Enrollment data\n\n' +
                       'This action cannot be undone!')) {
                alert('Student ' + studentId + ' has been deleted successfully.');
                const row = event.target.closest('tr');
                if (row) {
                    row.style.animation = 'fadeOut 0.3s ease-out';
                    setTimeout(() => row.remove(), 300);
                }
            }
        }

        function toggleSelectAllStudents(checkbox) {
            const checkboxes = document.getElementsByClassName('student-checkbox');
            for (let cb of checkboxes) {
                cb.checked = checkbox.checked;
            }
            updateStudentBulkActionsBar();
        }

        function updateStudentBulkActionsBar() {
            const checkboxes = document.querySelectorAll('.student-checkbox');
            const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
            const bulkActionsBar = document.getElementById('studentBulkActionsBar');
            const selectedCount = document.getElementById('studentSelectedCount');

            if (checkedBoxes.length > 0) {
                bulkActionsBar.style.display = 'flex';
                selectedCount.textContent = checkedBoxes.length;
            } else {
                bulkActionsBar.style.display = 'none';
            }

            const selectAllCheckbox = document.getElementById('selectAllStudents');
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = checkedBoxes.length === checkboxes.length && checkboxes.length > 0;
                selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < checkboxes.length;
            }
        }

        function bulkEnrollCourse() {
            const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
            alert('Enrolling ' + checkedBoxes.length + ' students in a course.\n\n' +
                  'Next step: Select the course from the available courses list.');
            resetStudentSelection();
        }

        function bulkSendNotification() {
            const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
            closeModal('studentsModal');
            openModal('sendNotificationModal');
        }

        function bulkExportStudents() {
            const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
            alert('Exporting ' + checkedBoxes.length + ' student records to Excel file...\n\n' +
                  'The file will include all student information and academic records.');
            resetStudentSelection();
        }

        function bulkGenerateReports() {
            const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
            alert('Generating comprehensive reports for ' + checkedBoxes.length + ' students...\n\n' +
                  'Reports will include:\n' +
                  '• Academic performance\n' +
                  '• Attendance records\n' +
                  '• Financial status\n' +
                  '• Course enrollment');
            resetStudentSelection();
        }

        function bulkDeleteStudents() {
            const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
            if (confirm('⚠️ CRITICAL WARNING!\n\n' +
                       'Delete ' + checkedBoxes.length + ' students?\n\n' +
                       'This will permanently remove ALL their:\n' +
                       '• Academic records\n' +
                       '• Enrollment data\n' +
                       '• Personal information\n' +
                       '• Financial records\n\n' +
                       'THIS ACTION CANNOT BE UNDONE!')) {
                if (confirm('Type "DELETE ALL" mentally to confirm this critical action.\n\nAre you absolutely sure?')) {
                    alert(checkedBoxes.length + ' students have been deleted successfully.');
                    checkedBoxes.forEach(checkbox => {
                        const row = checkbox.closest('tr');
                        if (row) {
                            row.style.animation = 'fadeOut 0.3s ease-out';
                            setTimeout(() => row.remove(), 300);
                        }
                    });
                    setTimeout(resetStudentSelection, 400);
                }
            }
        }

        function resetStudentSelection() {
            const checkboxes = document.querySelectorAll('.student-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = false);
            const selectAllCheckbox = document.getElementById('selectAllStudents');
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = false;
            }
            updateStudentBulkActionsBar();
        }

        function exportStudents() {
            alert('Exporting all student records to Excel file...\n\n' +
                  'The file will include:\n' +
                  '• Student information\n' +
                  '• Academic records\n' +
                  '• Contact details\n' +
                  '• Enrollment status\n\n' +
                  'The download will begin shortly.');
        }

        function importStudents() {
            alert('Import Students from Excel/CSV file\n\n' +
                  'Requirements:\n' +
                  '• File format: Excel (.xlsx) or CSV\n' +
                  '• Required columns: Name, Email, Student ID, Department\n' +
                  '• Maximum: 1000 students per import\n\n' +
                  'Please select your file to continue.');
        }

        function changeStudentPageSize(size) {
            alert('Changing page size to ' + size + ' students per page...');
        }

        function openAddStudentModal() {
            closeModal('studentsModal');
            alert('Opening Add New Student form...\n\n' +
                  'You can enter:\n' +
                  '• Personal information\n' +
                  '• Contact details\n' +
                  '• Academic information\n' +
                  '• Emergency contacts\n' +
                  '• Upload documents');
        }

        function openLecturersModal() {
            openModal('lecturersModal');
            
            setTimeout(function() {
                const lecturerCheckboxes = document.querySelectorAll('.lecturer-checkbox');
                lecturerCheckboxes.forEach(checkbox => {
                    checkbox.removeEventListener('change', updateLecturerBulkActionsBar);
                    checkbox.addEventListener('change', updateLecturerBulkActionsBar);
                });
            }, 100);
        }

        
        function filterLecturers() {
            const searchInput = document.getElementById('lecturerSearchInput').value.toLowerCase();
            const deptFilter = document.getElementById('lecturerDepartmentFilter').value.toLowerCase();
            const qualFilter = document.getElementById('lecturerQualificationFilter').value.toLowerCase();
            const statusFilter = document.getElementById('lecturerStatusFilter').value.toLowerCase();
            const tableBody = document.getElementById('lecturerTableBody');
            const rows = tableBody.getElementsByTagName('tr');

            let visibleCount = 0;

            for (let row of rows) {
                const dept = row.getAttribute('data-department');
                const qual = row.getAttribute('data-qualification');
                const status = row.getAttribute('data-status');
                const rowText = row.textContent.toLowerCase();

                const matchesSearch = rowText.includes(searchInput);
                const matchesDept = !deptFilter || dept === deptFilter;
                const matchesQual = !qualFilter || qual === qualFilter;
                const matchesStatus = !statusFilter || status === statusFilter;

                if (matchesSearch && matchesDept && matchesQual && matchesStatus) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }
        }

        function viewLecturer(lecturerId) {
            alert('Opening lecturer profile for Lecturer ID: ' + lecturerId + '\n\n' +
                  'This will display:\n' +
                  '• Personal Information\n' +
                  '• Academic Qualifications\n' +
                  '• Teaching Experience\n' +
                  '• Assigned Courses\n' +
                  '• Student Ratings & Feedback\n' +
                  '• Research Publications\n' +
                  '• Documents');
        }

        function editLecturer(lecturerId) {
            alert('Opening edit form for Lecturer ID: ' + lecturerId + '\n\n' +
                  'You can modify:\n' +
                  '• Personal details\n' +
                  '• Contact information\n' +
                  '• Qualifications\n' +
                  '• Department assignment\n' +
                  '• Employment status');
        }

        function manageCourses(lecturerId) {
            alert('Managing courses for Lecturer ID: ' + lecturerId + '\n\n' +
                  'You can:\n' +
                  '• View assigned courses\n' +
                  '• Assign new courses\n' +
                  '• Remove course assignments\n' +
                  '• View course schedules\n' +
                  '• Manage course materials');
        }

        function deleteLecturer(lecturerId) {
            if (confirm('⚠️ WARNING: Delete this lecturer?\n\n' +
                       'This will:\n' +
                       '• Remove lecturer record\n' +
                       '• Unassign all courses\n' +
                       '• Archive teaching history\n\n' +
                       'This action cannot be undone!\n\n' +
                       'Consider setting status to "Retired" instead.')) {
                alert('Lecturer ' + lecturerId + ' has been deleted successfully.');
                const row = event.target.closest('tr');
                if (row) {
                    row.style.animation = 'fadeOut 0.3s ease-out';
                    setTimeout(() => row.remove(), 300);
                }
            }
        }

        function toggleSelectAllLecturers(checkbox) {
            const checkboxes = document.getElementsByClassName('lecturer-checkbox');
            for (let cb of checkboxes) {
                cb.checked = checkbox.checked;
            }
            updateLecturerBulkActionsBar();
        }

        function updateLecturerBulkActionsBar() {
            const checkboxes = document.querySelectorAll('.lecturer-checkbox');
            const checkedBoxes = document.querySelectorAll('.lecturer-checkbox:checked');
            const bulkActionsBar = document.getElementById('lecturerBulkActionsBar');
            const selectedCount = document.getElementById('lecturerSelectedCount');

            if (checkedBoxes.length > 0) {
                bulkActionsBar.style.display = 'flex';
                selectedCount.textContent = checkedBoxes.length;
            } else {
                bulkActionsBar.style.display = 'none';
            }

            const selectAllCheckbox = document.getElementById('selectAllLecturers');
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = checkedBoxes.length === checkboxes.length && checkboxes.length > 0;
                selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < checkboxes.length;
            }
        }

        function bulkAssignCourses() {
            const checkedBoxes = document.querySelectorAll('.lecturer-checkbox:checked');
            alert('Assigning courses to ' + checkedBoxes.length + ' lecturers.\n\n' +
                  'Next step: Select courses to assign from the course catalog.');
            resetLecturerSelection();
        }

        function bulkSendLecturerNotification() {
            const checkedBoxes = document.querySelectorAll('.lecturer-checkbox:checked');
            closeModal('lecturersModal');
            openModal('sendNotificationModal');
        }

        function bulkExportLecturers() {
            const checkedBoxes = document.querySelectorAll('.lecturer-checkbox:checked');
            alert('Exporting ' + checkedBoxes.length + ' lecturer records to Excel file...\n\n' +
                  'The file will include:\n' +
                  '• Personal information\n' +
                  '• Qualifications\n' +
                  '• Teaching history\n' +
                  '• Assigned courses\n' +
                  '• Performance ratings');
            resetLecturerSelection();
        }

        function bulkGenerateLecturerReports() {
            const checkedBoxes = document.querySelectorAll('.lecturer-checkbox:checked');
            alert('Generating comprehensive reports for ' + checkedBoxes.length + ' lecturers...\n\n' +
                  'Reports will include:\n' +
                  '• Teaching performance\n' +
                  '• Student feedback\n' +
                  '• Course completion rates\n' +
                  '• Research activities\n' +
                  '• Professional development');
            resetLecturerSelection();
        }

        function bulkDeleteLecturers() {
            const checkedBoxes = document.querySelectorAll('.lecturer-checkbox:checked');
            if (confirm('⚠️ CRITICAL WARNING!\n\n' +
                       'Delete ' + checkedBoxes.length + ' lecturers?\n\n' +
                       'This will permanently remove:\n' +
                       '• Lecturer records\n' +
                       '• Course assignments\n' +
                       '• Teaching history\n' +
                       '• Performance data\n\n' +
                       'THIS ACTION CANNOT BE UNDONE!\n\n' +
                       'Consider changing status to "Retired" instead.')) {
                if (confirm('Type "DELETE ALL" mentally to confirm this critical action.\n\nAre you absolutely sure?')) {
                    alert(checkedBoxes.length + ' lecturers have been deleted successfully.');
                    checkedBoxes.forEach(checkbox => {
                        const row = checkbox.closest('tr');
                        if (row) {
                            row.style.animation = 'fadeOut 0.3s ease-out';
                            setTimeout(() => row.remove(), 300);
                        }
                    });
                    setTimeout(resetLecturerSelection, 400);
                }
            }
        }

        function resetLecturerSelection() {
            const checkboxes = document.querySelectorAll('.lecturer-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = false);
            const selectAllCheckbox = document.getElementById('selectAllLecturers');
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = false;
            }
            updateLecturerBulkActionsBar();
        }

        function exportLecturers() {
            alert('Exporting all lecturer records to Excel file...\n\n' +
                  'The file will include:\n' +
                  '• Personal information\n' +
                  '• Academic qualifications\n' +
                  '• Teaching experience\n' +
                  '• Course assignments\n' +
                  '• Performance ratings\n\n' +
                  'The download will begin shortly.');
        }

        function assignCourses() {
            alert('Bulk Course Assignment Tool\n\n' +
                  'This will allow you to:\n' +
                  '• View all available courses\n' +
                  '• Assign courses to lecturers\n' +
                  '• Set course schedules\n' +
                  '• Manage teaching workload\n\n' +
                  'Please proceed to the course assignment interface.');
        }

        function changeLecturerPageSize(size) {
            alert('Changing page size to ' + size + ' lecturers per page...');
        }

        function openAddLecturerModal() {
            closeModal('lecturersModal');
            alert('Opening Add New Lecturer form...\n\n' +
                  'You can enter:\n' +
                  '• Personal information\n' +
                  '• Contact details\n' +
                  '• Academic qualifications\n' +
                  '• Teaching experience\n' +
                  '• Specializations\n' +
                  '• Upload documents (CV, certificates)');
        }

        function openCreateCourseModal() {
            openModal('createCourseModal');
            currentStep = 1;
            showStep(1);
        }

        
        let currentStep = 1;
        const totalSteps = 3;

        function showStep(step) {
        
            document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('.step').forEach(s => {
                s.classList.remove('active');
                s.classList.remove('completed');
            });

            
            document.querySelector(`.form-step[data-step="${step}"]`).classList.add('active');
            document.querySelector(`.step[data-step="${step}"]`).classList.add('active');

            
            for (let i = 1; i < step; i++) {
                document.querySelector(`.step[data-step="${i}"]`).classList.add('completed');
            }

            
            const prevBtn = document.querySelector('.btn-prev');
            const nextBtn = document.querySelector('.btn-next');
            const submitBtn = document.querySelector('.btn-submit');

            if (step === 1) {
                prevBtn.style.display = 'none';
            } else {
                prevBtn.style.display = 'flex';
            }

            if (step === totalSteps) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'flex';
            } else {
                nextBtn.style.display = 'flex';
                submitBtn.style.display = 'none';
            }
        }

        function nextStep() {
            if (validateStep(currentStep)) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                }
            }
        }

        function previousStep() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        }

        function validateStep(step) {
            const currentStepElement = document.querySelector(`.form-step[data-step="${step}"]`);
            const requiredFields = currentStepElement.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value || (field.type === 'radio' && !currentStepElement.querySelector(`input[name="${field.name}"]:checked`))) {
                    field.style.borderColor = '#e74c3c';
                    isValid = false;
                } else {
                    field.style.borderColor = '#e0e6ed';
                }
            });

            if (!isValid) {
                alert('Please fill in all required fields before proceeding.');
            }

            return isValid;
        }

    
        document.addEventListener('DOMContentLoaded', function() {
            const thumbnailInput = document.getElementById('courseThumbnail');
            if (thumbnailInput) {
                thumbnailInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) {
                            alert('File size must be less than 2MB');
                            this.value = '';
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(event) {
                            document.getElementById('thumbnailPreview').src = event.target.result;
                            document.querySelector('.file-upload-label').style.display = 'none';
                            document.querySelector('.file-preview').style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            
            const descriptionField = document.querySelector('textarea[name="description"]');
            if (descriptionField) {
                descriptionField.addEventListener('input', function() {
                    const count = this.value.length;
                    const currentSpan = document.querySelector('.character-count .current');
                    if (currentSpan) {
                        currentSpan.textContent = count;
                        if (count > 500) {
                            this.value = this.value.substring(0, 500);
                            currentSpan.textContent = 500;
                        }
                    }
                });
            }
        });

        function removeThumbnail() {
            document.getElementById('courseThumbnail').value = '';
            document.getElementById('thumbnailPreview').src = '';
            document.querySelector('.file-upload-label').style.display = 'flex';
            document.querySelector('.file-preview').style.display = 'none';
        }

        
        function addLearningOutcome() {
            const container = document.getElementById('learningOutcomes');
            const newOutcome = document.createElement('div');
            newOutcome.className = 'outcome-item';
            newOutcome.innerHTML = `
                <input type="text" name="outcomes[]" class="form-control" placeholder="Enter learning outcome">
                <button type="button" class="btn-remove-outcome" onclick="removeOutcome(this)">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(newOutcome);
        }

        function removeOutcome(button) {
            const container = document.getElementById('learningOutcomes');
            if (container.children.length > 1) {
                button.parentElement.remove();
            } else {
                alert('At least one learning outcome is required.');
            }
        }

        
        
        let currentExamStep = 1;
        const totalExamSteps = 3;

        function openScheduleExamModal() {
            openModal('scheduleExamModal');
            currentExamStep = 1;
            showExamStep(1);
            
            
            const durationSelect = document.querySelector('select[name="duration"]');
            const startTimeInput = document.querySelector('input[name="start_time"]');
            const endTimeInput = document.querySelector('input[name="end_time"]');
            
            if (durationSelect && startTimeInput && endTimeInput) {
                const updateEndTime = () => {
                    if (startTimeInput.value && durationSelect.value) {
                        const [hours, minutes] = startTimeInput.value.split(':');
                        const startDate = new Date();
                        startDate.setHours(parseInt(hours), parseInt(minutes), 0);
                        startDate.setMinutes(startDate.getMinutes() + parseInt(durationSelect.value));
                        
                        const endHours = String(startDate.getHours()).padStart(2, '0');
                        const endMinutes = String(startDate.getMinutes()).padStart(2, '0');
                        endTimeInput.value = `${endHours}:${endMinutes}`;
                    }
                };
                
                durationSelect.addEventListener('change', updateEndTime);
                startTimeInput.addEventListener('change', updateEndTime);
            }
        }

        function showExamStep(step) {
            
            document.querySelectorAll('#scheduleExamModal .form-step').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('#scheduleExamModal .step').forEach(s => {
                s.classList.remove('active');
                s.classList.remove('completed');
            });


            document.querySelector(`#scheduleExamModal .form-step[data-step="${step}"]`).classList.add('active');
            document.querySelector(`#scheduleExamModal .step[data-step="${step}"]`).classList.add('active');

            
            for (let i = 1; i < step; i++) {
                document.querySelector(`#scheduleExamModal .step[data-step="${i}"]`).classList.add('completed');
            }

            
            const prevBtn = document.querySelector('#scheduleExamModal .btn-prev');
            const nextBtn = document.querySelector('#scheduleExamModal .exam-next-btn');
            const submitBtn = document.querySelector('#scheduleExamModal .exam-submit-btn');

            if (step === 1) {
                prevBtn.style.display = 'none';
            } else {
                prevBtn.style.display = 'flex';
            }

            if (step === totalExamSteps) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'flex';
            } else {
                nextBtn.style.display = 'flex';
                submitBtn.style.display = 'none';
            }
        }

        function nextExamStep() {
            if (validateExamStep(currentExamStep)) {
                if (currentExamStep < totalExamSteps) {
                    currentExamStep++;
                    showExamStep(currentExamStep);
                }
            }
        }

        function previousExamStep() {
            if (currentExamStep > 1) {
                currentExamStep--;
                showExamStep(currentExamStep);
            }
        }

        function validateExamStep(step) {
            const currentStepElement = document.querySelector(`#scheduleExamModal .form-step[data-step="${step}"]`);
            const requiredFields = currentStepElement.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value || (field.type === 'radio' && !currentStepElement.querySelector(`input[name="${field.name}"]:checked`))) {
                    field.style.borderColor = '#e74c3c';
                    isValid = false;
                } else {
                    field.style.borderColor = '#e0e6ed';
                }
            });

            if (!isValid) {
                alert('Please fill in all required fields before proceeding.');
            }

            return isValid;
        }

    
        function addInvigilator() {
            const container = document.getElementById('invigilatorsList');
            const newInvigilator = document.createElement('div');
            newInvigilator.className = 'invigilator-item';
            newInvigilator.innerHTML = `
                <select name="invigilators[]" class="form-control">
                    <option value="">Select Invigilator</option>
                    <option value="5">Ms. Jennifer Wilson</option>
                    <option value="6">Mr. David Lee</option>
                    <option value="7">Dr. Lisa Anderson</option>
                    <option value="8">Prof. Robert Taylor</option>
                </select>
                <button type="button" class="btn-remove-invigilator" onclick="removeInvigilator(this)">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(newInvigilator);
        }

        function removeInvigilator(button) {
            const container = document.getElementById('invigilatorsList');
            if (container.children.length > 1) {
                button.parentElement.remove();
            } else {
                alert('At least one invigilator is required.');
            }
        }

    
        function addInstruction() {
            const container = document.getElementById('instructionsList');
            const newInstruction = document.createElement('div');
            newInstruction.className = 'instruction-item';
            newInstruction.innerHTML = `
                <input type="text" name="instructions[]" class="form-control" placeholder="Enter exam instruction">
                <button type="button" class="btn-remove-outcome" onclick="removeInstruction(this)">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(newInstruction);
        }

        function removeInstruction(button) {
            const container = document.getElementById('instructionsList');
            if (container.children.length > 1) {
                button.parentElement.remove();
            }
        }

        
        document.addEventListener('DOMContentLoaded', function() {
            const examForm = document.getElementById('scheduleExamForm');
            if (examForm) {
                examForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
        
                    let allValid = true;
                    for (let i = 1; i <= totalExamSteps; i++) {
                        if (!validateExamStep(i)) {
                            allValid = false;
                            currentExamStep = i;
                            showExamStep(i);
                            break;
                        }
                    }

                    if (allValid) {
                
                        const formData = new FormData(this);
                        
                        
                        alert('Exam scheduled successfully! Students will be notified.');
                        closeModal('scheduleExamModal');
                        
                        
                        this.reset();
                        currentExamStep = 1;
                        showExamStep(1);
                        
                        
                    }
                });
            }
        });

        
        
        let currentNotifStep = 1;
        const totalNotifSteps = 3;

        function openNotificationModal() {
            openModal('sendNotificationModal');
            currentNotifStep = 1;
            showNotificationStep(1);
        }

        function showNotificationStep(step) {
            
            document.querySelectorAll('#sendNotificationModal .form-step').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('#sendNotificationModal .step').forEach(s => {
                s.classList.remove('active');
                s.classList.remove('completed');
            });

            
            document.querySelector(`#sendNotificationModal .form-step[data-step="${step}"]`).classList.add('active');
            document.querySelector(`#sendNotificationModal .step[data-step="${step}"]`).classList.add('active');

            
            for (let i = 1; i < step; i++) {
                document.querySelector(`#sendNotificationModal .step[data-step="${i}"]`).classList.add('completed');
            }

        
            const prevBtn = document.querySelector('#sendNotificationModal .btn-prev');
            const nextBtn = document.querySelector('#sendNotificationModal .notif-next-btn');
            const submitBtn = document.querySelector('#sendNotificationModal .notif-submit-btn');

            if (step === 1) {
                prevBtn.style.display = 'none';
            } else {
                prevBtn.style.display = 'flex';
            }

            if (step === totalNotifSteps) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'flex';
                updatePreview();
            } else {
                nextBtn.style.display = 'flex';
                submitBtn.style.display = 'none';
            }
        }

        function nextNotificationStep() {
            if (validateNotificationStep(currentNotifStep)) {
                if (currentNotifStep < totalNotifSteps) {
                    currentNotifStep++;
                    showNotificationStep(currentNotifStep);
                }
            }
        }

        function previousNotificationStep() {
            if (currentNotifStep > 1) {
                currentNotifStep--;
                showNotificationStep(currentNotifStep);
            }
        }

        function validateNotificationStep(step) {
            const currentStepElement = document.querySelector(`#sendNotificationModal .form-step[data-step="${step}"]`);
            const requiredFields = currentStepElement.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value || (field.type === 'radio' && !currentStepElement.querySelector(`input[name="${field.name}"]:checked`))) {
                    field.style.borderColor = '#e74c3c';
                    isValid = false;
                } else {
                    field.style.borderColor = '#e0e6ed';
                }
            });

            if (!isValid) {
                alert('Please fill in all required fields before proceeding.');
            }

            return isValid;
        }

        function updatePreview() {
            
            const subject = document.querySelector('input[name="subject"]').value || 'Your notification subject will appear here';
            document.getElementById('previewSubject').textContent = subject;

        
            const category = document.querySelector('select[name="category"]');
            const categoryText = category.options[category.selectedIndex].text || 'Not selected';
            document.getElementById('previewCategory').textContent = 'Category: ' + categoryText;

            
            const message = document.querySelector('textarea[name="message"]').value || 'Your message content will appear here...';
            document.getElementById('previewMessage').textContent = message;

        
            const priority = document.querySelector('input[name="priority"]:checked');
            if (priority) {
                const priorityValue = priority.value.toUpperCase();
                const priorityEl = document.getElementById('previewPriority');
                priorityEl.textContent = priorityValue;
                priorityEl.className = 'preview-priority ' + priority.value;
            }

            
            const channels = [];
            document.querySelectorAll('input[name="notification_type[]"]:checked').forEach(cb => {
                channels.push(cb.value);
            });
            const channelsText = channels.map(ch => {
                const icons = { email: 'envelope', sms: 'sms', push: 'bell', portal: 'browser' };
                return `<i class="fas fa-${icons[ch]}"></i> ${ch.toUpperCase()}`;
            }).join(' ');
            document.getElementById('previewChannels').innerHTML = channelsText || '<i class="fas fa-envelope"></i> Email';

            
            const audience = document.querySelector('input[name="audience"]:checked');
            if (audience) {
                const audienceText = audience.nextElementSibling.querySelector('span').textContent;
                document.getElementById('summaryRecipients').textContent = audienceText;
            }

            
            document.getElementById('summaryChannels').textContent = channels.join(', ') || 'Email';

        
            document.getElementById('summaryPriority').textContent = priority ? priority.value.charAt(0).toUpperCase() + priority.value.slice(1) : 'Medium';
        }

        
        document.addEventListener('DOMContentLoaded', function() {
            const customAudienceRadio = document.getElementById('audience-custom');
            if (customAudienceRadio) {
                document.querySelectorAll('input[name="audience"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        const customFilters = document.getElementById('customFilters');
                        if (this.value === 'custom') {
                            customFilters.style.display = 'block';
                        } else {
                            customFilters.style.display = 'none';
                        }
                    });
                });
            }

        
            document.querySelectorAll('input[name="send_time"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const scheduleDateTime = document.getElementById('scheduleDateTime');
                    if (this.value === 'scheduled') {
                        scheduleDateTime.style.display = 'block';
                    } else {
                        scheduleDateTime.style.display = 'none';
                    }
                });
            });

        
            const messageTextarea = document.getElementById('notificationMessage');
            if (messageTextarea) {
                messageTextarea.addEventListener('input', function() {
                    const count = this.value.length;
                    document.getElementById('charCount').textContent = count;
                    if (count > 1000) {
                        this.value = this.value.substring(0, 1000);
                        document.getElementById('charCount').textContent = 1000;
                    }
                });
            }

            const attachmentsInput = document.getElementById('notificationAttachments');
            if (attachmentsInput) {
                attachmentsInput.addEventListener('change', function(e) {
                    const files = Array.from(e.target.files);
                    const attachmentsList = document.getElementById('attachmentsList');
                    
                    files.forEach(file => {
                        if (file.size > 5 * 1024 * 1024) {
                            alert(`File ${file.name} is too large. Maximum size is 5MB.`);
                            return;
                        }

                        const item = document.createElement('div');
                        item.className = 'attachment-item';
                        item.innerHTML = `
                            <div class="attachment-info">
                                <i class="fas fa-file"></i>
                                <span>${file.name} (${(file.size / 1024).toFixed(2)} KB)</span>
                            </div>
                            <button type="button" class="btn-remove-attachment" onclick="this.parentElement.remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                        attachmentsList.appendChild(item);
                    });
                });
            }
        });

        
        function loadTemplate(type) {
            const messageTextarea = document.getElementById('notificationMessage');
            const templates = {
                exam: 'Dear Students,\n\nThis is to inform you that the Mid-Semester Examination is scheduled for [Date]. Please ensure you arrive 15 minutes before the exam starts.\n\nVenue: [Location]\nTime: [Time]\nDuration: [Duration]\n\nBest regards,\nAcademic Office',
                event: 'Dear All,\n\nWe are pleased to invite you to [Event Name] scheduled for [Date] at [Time].\n\nVenue: [Location]\nAgenda: [Brief Description]\n\nYour attendance is highly appreciated.\n\nBest regards,\nEvent Committee',
                deadline: 'Important Reminder!\n\nThis is a friendly reminder that the deadline for [Task/Submission] is approaching.\n\nDeadline: [Date and Time]\n\nPlease ensure timely completion to avoid any penalties.\n\nThank you,\nAdministration'
            };
            
            if (templates[type]) {
                messageTextarea.value = templates[type];
                document.getElementById('charCount').textContent = templates[type].length;
            }
        }

        
        document.addEventListener('DOMContentLoaded', function() {
            const notifForm = document.getElementById('sendNotificationForm');
            if (notifForm) {
                notifForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    
                    let allValid = true;
                    for (let i = 1; i <= totalNotifSteps; i++) {
                        if (!validateNotificationStep(i)) {
                            allValid = false;
                            currentNotifStep = i;
                            showNotificationStep(i);
                            break;
                        }
                    }

                    if (allValid) {
                        
                        const formData = new FormData(this);
                        
                        
                        alert('Notification sent successfully! Recipients will be notified shortly.');
                        closeModal('sendNotificationModal');
                        
                    
                        this.reset();
                        currentNotifStep = 1;
                        showNotificationStep(1);
                        document.getElementById('attachmentsList').innerHTML = '';
                        
                    
                    }
                });
            }
        });

        
        document.addEventListener('DOMContentLoaded', function() {
            const courseForm = document.getElementById('createCourseForm');
            if (courseForm) {
                courseForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                
                    let allValid = true;
                    for (let i = 1; i <= totalSteps; i++) {
                        if (!validateStep(i)) {
                            allValid = false;
                            currentStep = i;
                            showStep(i);
                            break;
                        }
                    }

                    if (allValid) {
                        
                        const formData = new FormData(this);
                        
                    
                        alert('Course created successfully! (This will submit to your backend)');
                        closeModal('createCourseModal');
                        
                        
                        this.reset();
                        currentStep = 1;
                        showStep(1);
                        
                       
                    }
                });
            }
        });

        function showCoursesSection() {
            openModal('coursesModal');
            
            setTimeout(function() {
                const courseCheckboxes = document.querySelectorAll('.course-checkbox');
                courseCheckboxes.forEach(checkbox => {
                    checkbox.removeEventListener('change', updateCourseBulkActionsBar);
                    checkbox.addEventListener('change', updateCourseBulkActionsBar);
                });
            }, 100);
        }

        
        function filterCourses() {
            const searchInput = document.getElementById('courseSearchInput').value.toLowerCase();
            const deptFilter = document.getElementById('courseDepartmentFilter').value.toLowerCase();
            const levelFilter = document.getElementById('courseLevelFilter').value;
            const statusFilter = document.getElementById('courseStatusFilter').value.toLowerCase();
            const tableBody = document.getElementById('courseTableBody');
            const rows = tableBody.getElementsByTagName('tr');

            let visibleCount = 0;

            for (let row of rows) {
                const dept = row.getAttribute('data-department');
                const level = row.getAttribute('data-level');
                const status = row.getAttribute('data-status');
                const rowText = row.textContent.toLowerCase();

                const matchesSearch = rowText.includes(searchInput);
                const matchesDept = !deptFilter || dept === deptFilter;
                const matchesLevel = !levelFilter || level === levelFilter;
                const matchesStatus = !statusFilter || status === statusFilter;

                if (matchesSearch && matchesDept && matchesLevel && matchesStatus) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }
        }

        function viewCourse(courseId) {
            alert('Opening course details for Course ID: ' + courseId + '\n\n' +
                  'This will display:\n' +
                  '• Course Information\n' +
                  '• Syllabus & Learning Outcomes\n' +
                  '• Enrolled Students\n' +
                  '• Schedule & Materials\n' +
                  '• Assessments & Grades\n' +
                  '• Student Feedback\n' +
                  '• Course Analytics');
        }

        function editCourse(courseId) {
            alert('Opening edit form for Course ID: ' + courseId + '\n\n' +
                  'You can modify:\n' +
                  '• Course details\n' +
                  '• Syllabus content\n' +
                  '• Instructor assignment\n' +
                  '• Schedule and duration\n' +
                  '• Enrollment limits\n' +
                  '• Prerequisites');
        }

        function viewCourseStudents(courseId) {
            alert('Viewing enrolled students for Course ID: ' + courseId + '\n\n' +
                  'You can:\n' +
                  '• View student list\n' +
                  '• Check attendance\n' +
                  '• View grades\n' +
                  '• Manage enrollments\n' +
                  '• Export student data\n' +
                  '• Send notifications');
        }

        function deleteCourse(courseId) {
            if (confirm('⚠️ WARNING: Delete this course?\n\n' +
                       'This will:\n' +
                       '• Remove course from catalog\n' +
                       '• Unenroll all students\n' +
                       '• Archive course materials\n' +
                       '• Delete assessments\n\n' +
                       'This action cannot be undone!\n\n' +
                       'Consider setting status to "Inactive" instead.')) {
                alert('Course ' + courseId + ' has been deleted successfully.');
                const row = event.target.closest('tr');
                if (row) {
                    row.style.animation = 'fadeOut 0.3s ease-out';
                    setTimeout(() => row.remove(), 300);
                }
            }
        }

        function toggleSelectAllCourses(checkbox) {
            const checkboxes = document.getElementsByClassName('course-checkbox');
            for (let cb of checkboxes) {
                cb.checked = checkbox.checked;
            }
            updateCourseBulkActionsBar();
        }

        function updateCourseBulkActionsBar() {
            const checkboxes = document.querySelectorAll('.course-checkbox');
            const checkedBoxes = document.querySelectorAll('.course-checkbox:checked');
            const bulkActionsBar = document.getElementById('courseBulkActionsBar');
            const selectedCount = document.getElementById('courseSelectedCount');

            if (checkedBoxes.length > 0) {
                bulkActionsBar.style.display = 'flex';
                selectedCount.textContent = checkedBoxes.length;
            } else {
                bulkActionsBar.style.display = 'none';
            }

            const selectAllCheckbox = document.getElementById('selectAllCourses');
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = checkedBoxes.length === checkboxes.length && checkboxes.length > 0;
                selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < checkboxes.length;
            }
        }

        function bulkActivateCourses() {
            const checkedBoxes = document.querySelectorAll('.course-checkbox:checked');
            if (confirm('Activate ' + checkedBoxes.length + ' selected courses?\n\n' +
                       'This will make these courses visible and available for enrollment.')) {
                alert(checkedBoxes.length + ' courses have been activated successfully.');
                resetCourseSelection();
            }
        }

        function bulkDeactivateCourses() {
            const checkedBoxes = document.querySelectorAll('.course-checkbox:checked');
            if (confirm('Deactivate ' + checkedBoxes.length + ' selected courses?\n\n' +
                       'This will hide these courses from students and prevent new enrollments.')) {
                alert(checkedBoxes.length + ' courses have been deactivated successfully.');
                resetCourseSelection();
            }
        }

        function bulkExportCourses() {
            const checkedBoxes = document.querySelectorAll('.course-checkbox:checked');
            alert('Exporting ' + checkedBoxes.length + ' course records to Excel file...\n\n' +
                  'The file will include:\n' +
                  '• Course information\n' +
                  '• Enrollment statistics\n' +
                  '• Instructor details\n' +
                  '• Performance metrics\n' +
                  '• Student feedback summaries');
            resetCourseSelection();
        }

        function bulkDuplicateCourses() {
            const checkedBoxes = document.querySelectorAll('.course-checkbox:checked');
            if (confirm('Duplicate ' + checkedBoxes.length + ' selected courses?\n\n' +
                       'This will create copies with suffix "(Copy)" in the title.')) {
                alert(checkedBoxes.length + ' courses have been duplicated successfully.\n\n' +
                      'The copies have been created with "Draft" status.');
                resetCourseSelection();
            }
        }

        function bulkDeleteCourses() {
            const checkedBoxes = document.querySelectorAll('.course-checkbox:checked');
            if (confirm('⚠️ CRITICAL WARNING!\n\n' +
                       'Delete ' + checkedBoxes.length + ' courses?\n\n' +
                       'This will permanently remove:\n' +
                       '• Course records\n' +
                       '• Student enrollments\n' +
                       '• Course materials\n' +
                       '• Assessments and grades\n\n' +
                       'THIS ACTION CANNOT BE UNDONE!\n\n' +
                       'Consider setting status to "Inactive" instead.')) {
                if (confirm('Are you absolutely sure?\n\nThis will affect all enrolled students.')) {
                    alert(checkedBoxes.length + ' courses have been deleted successfully.');
                    checkedBoxes.forEach(checkbox => {
                        const row = checkbox.closest('tr');
                        if (row) {
                            row.style.animation = 'fadeOut 0.3s ease-out';
                            setTimeout(() => row.remove(), 300);
                        }
                    });
                    setTimeout(resetCourseSelection, 400);
                }
            }
        }

        function resetCourseSelection() {
            const checkboxes = document.querySelectorAll('.course-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = false);
            const selectAllCheckbox = document.getElementById('selectAllCourses');
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = false;
            }
            updateCourseBulkActionsBar();
        }

        function exportCourses() {
            alert('Exporting all course records to Excel file...\n\n' +
                  'The file will include:\n' +
                  '• Course catalog\n' +
                  '• Instructor assignments\n' +
                  '• Enrollment data\n' +
                  '• Performance metrics\n' +
                  '• Schedule information\n\n' +
                  'The download will begin shortly.');
        }

        function generateCatalog() {
            alert('Generating Course Catalog PDF...\n\n' +
                  'This will create a professional course catalog document with:\n' +
                  '• Course listings by department\n' +
                  '• Course descriptions\n' +
                  '• Prerequisites\n' +
                  '• Credit hours\n' +
                  '• Instructor information\n\n' +
                  'The PDF will be ready for download in a moment.');
        }

        function changeCoursePageSize(size) {
            alert('Changing page size to ' + size + ' courses per page...');
        }

        function openAddCourseModal() {
            closeModal('coursesModal');
            openModal('createCourseModal');
            currentStep = 1;
            showStep(1);
        }

        function showExaminationsSection() {
            openModal('examinationsModal');
            
            
            setTimeout(() => {
                const examCheckboxes = document.querySelectorAll('.exam-checkbox');
                examCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateExamBulkActionsBar);
                });
            }, 100);
        }

        function filterExaminations() {
            const searchTerm = document.getElementById('examinationsSearch').value.toLowerCase();
            const statusFilter = document.getElementById('examinationsStatusFilter').value;
            const typeFilter = document.getElementById('examinationsTypeFilter').value;
            const departmentFilter = document.getElementById('examinationsDepartmentFilter').value;
            const tableBody = document.getElementById('examinationsTableBody');
            const rows = tableBody.getElementsByTagName('tr');

            for (let row of rows) {
                const examTitle = row.querySelector('.exam-details h4')?.textContent.toLowerCase() || '';
                const examDesc = row.querySelector('.exam-details p')?.textContent.toLowerCase() || '';
                const courseCode = row.querySelector('.course-code')?.textContent.toLowerCase() || '';
                const rowStatus = row.getAttribute('data-status');
                const rowType = row.getAttribute('data-type');
                const rowDepartment = row.getAttribute('data-department');

                const matchesSearch = examTitle.includes(searchTerm) || examDesc.includes(searchTerm) || courseCode.includes(searchTerm);
                const matchesStatus = !statusFilter || rowStatus === statusFilter;
                const matchesType = !typeFilter || rowType === typeFilter;
                const matchesDepartment = !departmentFilter || rowDepartment === departmentFilter;

                if (matchesSearch && matchesStatus && matchesType && matchesDepartment) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }

        function viewExam(examId) {
            alert(`Viewing exam details for exam ID: ${examId}`);
            
        }

        function editExam(examId) {
            alert(`Editing exam ID: ${examId}`);
            
        }

        function manageExamStudents(examId) {
            alert(`Managing students for exam ID: ${examId}`);
            
        }

        function deleteExam(examId) {
            if (confirm('Are you sure you want to cancel this exam?')) {
                alert(`Exam ID ${examId} has been cancelled`);
                
            }
        }

        function viewExamResults(examId) {
            alert(`Viewing results for exam ID: ${examId}`);
            
        }

        function downloadExamReport(examId) {
            alert(`Downloading report for exam ID: ${examId}`);
            
        }

        function monitorExam(examId) {
            alert(`Monitoring exam ID: ${examId} in real-time`);
            
        }

        function toggleSelectAllExams() {
            const selectAll = document.getElementById('selectAllExams');
            const checkboxes = document.querySelectorAll('.exam-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
            updateExamBulkActionsBar();
        }

        function updateExamBulkActionsBar() {
            const checkboxes = document.querySelectorAll('.exam-checkbox:checked');
            const bulkActionsBar = document.getElementById('examBulkActionsBar');
            const selectedCount = document.getElementById('examSelectedCount');
            
            if (checkboxes.length > 0) {
                bulkActionsBar.style.display = 'flex';
                selectedCount.textContent = checkboxes.length;
            } else {
                bulkActionsBar.style.display = 'none';
            }
        }

        function resetExamSelection() {
            const checkboxes = document.querySelectorAll('.exam-checkbox');
            const selectAll = document.getElementById('selectAllExams');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            selectAll.checked = false;
            updateExamBulkActionsBar();
        }

        function bulkRescheduleExams() {
            const selected = document.querySelectorAll('.exam-checkbox:checked');
            if (selected.length > 0) {
                alert(`Rescheduling ${selected.length} exam(s)`);
                
            }
        }

        function bulkNotifyStudents() {
            const selected = document.querySelectorAll('.exam-checkbox:checked');
            if (selected.length > 0) {
                if (confirm(`Send notifications to students for ${selected.length} exam(s)?`)) {
                    alert('Notifications sent successfully!');
                    
                }
            }
        }

        function bulkExportExams() {
            const selected = document.querySelectorAll('.exam-checkbox:checked');
            if (selected.length > 0) {
                alert(`Exporting ${selected.length} exam(s)...`);
        
            }
        }

        function bulkCancelExams() {
            const selected = document.querySelectorAll('.exam-checkbox:checked');
            if (selected.length > 0) {
                if (confirm(`Are you sure you want to cancel ${selected.length} exam(s)? This action cannot be undone.`)) {
                    alert(`${selected.length} exam(s) cancelled successfully`);
                    resetExamSelection();
                    
                }
            }
        }

        function exportExamsCalendar() {
            openModal('examsCalendarModal');
            initializeCalendar();
        }

        let currentCalendarDate = new Date();
        let currentCalendarView = 'month';

        function initializeCalendar() {
            updateCalendarDisplay();
        }

        function updateCalendarDisplay() {
            const monthYear = document.getElementById('calendarMonthYear');
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 
                          'July', 'August', 'September', 'October', 'November', 'December'];
            monthYear.textContent = `${months[currentCalendarDate.getMonth()]} ${currentCalendarDate.getFullYear()}`;
        }

        function changeCalendarMonth(delta) {
            currentCalendarDate.setMonth(currentCalendarDate.getMonth() + delta);
            updateCalendarDisplay();
            
        }

        function setCalendarView(view) {
            currentCalendarView = view;
            
            document.querySelectorAll('.view-toggle-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`[data-view="${view}"]`).classList.add('active');
            
            alert(`Switched to ${view} view - Full implementation would render ${view} layout`);
        }

        function showExamDetails(date) {
            const sidebar = document.getElementById('examDetailsSidebar');
            const selectedDateSpan = document.getElementById('selectedDate');
            selectedDateSpan.textContent = date;
            sidebar.classList.add('show');
        }

        function closeExamSidebar() {
            const sidebar = document.getElementById('examDetailsSidebar');
            sidebar.classList.remove('show');
        }

        function exportCalendarToPDF() {
            alert('Exporting calendar to PDF...');
        
        }

        function exportCalendarToICS() {
            alert('Downloading calendar as .ics file...');
            
        }

        function exportExamsReport() {
            alert('Generating examinations report...');
            
        }

        function changeExamPageSize(size) {
            alert(`Changing page size to ${size} exams per page`);
        }

        
        function showLibrarySection() {
            openModal('libraryModal');
        }

        function filterLibraryBooks() {
            const searchTerm = document.getElementById('librarySearch').value.toLowerCase();
            const categoryFilter = document.getElementById('libraryCategoryFilter').value;
            const statusFilter = document.getElementById('libraryStatusFilter').value;
            
            const rows = document.querySelectorAll('#libraryBooksTableBody tr');
            
            rows.forEach(row => {
                const bookTitle = row.querySelector('.book-details h4').textContent.toLowerCase();
                const author = row.querySelector('.author-info strong').textContent.toLowerCase();
                const isbn = row.querySelector('.isbn-code').textContent.toLowerCase();
                const category = row.dataset.category;
                const status = row.dataset.status;
                
                const matchesSearch = bookTitle.includes(searchTerm) || 
                                     author.includes(searchTerm) || 
                                     isbn.includes(searchTerm);
                const matchesCategory = !categoryFilter || category === categoryFilter;
                const matchesStatus = !statusFilter || status === statusFilter;
                
                if (matchesSearch && matchesCategory && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function openAddBookModal() {
            alert('Opening Add Book modal...\n\nFields:\n- Book Title\n- Author\n- ISBN\n- Category\n- Publisher\n- Publication Year\n- Number of Copies\n- Description');
        }

        function openBorrowBookModal() {
            alert('Opening Issue Book modal...\n\nFields:\n- Select Book\n- Student ID/Name\n- Due Date\n- Notes');
        }

        function openReturnBookModal() {
            alert('Opening Return Book modal...\n\nFields:\n- Student ID\n- Book Selection\n- Return Condition\n- Late Fees (if any)');
        }

        function viewBook(bookId) {
            alert(`Viewing detailed information for Book ID: ${bookId}\n\nIncludes:\n- Full book details\n- Current borrowing status\n- Borrowing history\n- Reviews and ratings\n- Availability across branches`);
        }

        function editBook(bookId) {
            alert(`Opening edit form for Book ID: ${bookId}\n\nEditable fields:\n- Title, Author, ISBN\n- Category, Publisher\n- Number of copies\n- Description\n- Cover image`);
        }

        function issueBook(bookId) {
            alert(`Opening issue form for Book ID: ${bookId}\n\nRequired:\n- Student ID/Name\n- Due date\n- Notes`);
        }

        function deleteBook(bookId) {
            if (confirm('Are you sure you want to delete this book?\n\nThis will:\n- Remove the book from catalog\n- Archive borrowing history\n- This action cannot be undone')) {
                alert(`Book ID ${bookId} has been deleted successfully.`);
            }
        }

        function viewBorrowHistory(bookId) {
            alert(`Showing borrowing history for Book ID: ${bookId}\n\nIncludes:\n- All past borrowers\n- Borrow/return dates\n- Condition reports\n- Late returns`);
        }

        function viewReservations(bookId) {
            alert(`Showing reservations for Book ID: ${bookId}\n\nCurrent reservations:\n- Student names\n- Reservation dates\n- Priority queue\n- Expected availability`);
        }

        function updateBookStatus(bookId) {
            alert(`Updating status for Book ID: ${bookId}\n\nOptions:\n- Available\n- Under maintenance\n- Lost\n- Damaged`);
        }

        function toggleSelectAllBooks() {
            const selectAll = document.getElementById('selectAllBooks');
            const checkboxes = document.querySelectorAll('.book-checkbox');
            const bulkActionsBar = document.getElementById('libraryBulkActionsBar');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
            
            updateLibrarySelectedCount();
        }

        function updateLibrarySelectedCount() {
            const checkedBoxes = document.querySelectorAll('.book-checkbox:checked');
            const count = checkedBoxes.length;
            const bulkActionsBar = document.getElementById('libraryBulkActionsBar');
            const selectedCountSpan = document.getElementById('librarySelectedCount');
            
            selectedCountSpan.textContent = count;
            
            if (count > 0) {
                bulkActionsBar.style.display = 'flex';
            } else {
                bulkActionsBar.style.display = 'none';
                document.getElementById('selectAllBooks').checked = false;
            }
        }

        function resetLibrarySelection() {
            document.getElementById('selectAllBooks').checked = false;
            document.querySelectorAll('.book-checkbox').forEach(checkbox => {
                checkbox.checked = false;
            });
            updateLibrarySelectedCount();
        }

        function bulkChangeCategory() {
            const checkedBoxes = document.querySelectorAll('.book-checkbox:checked');
            alert(`Change category for ${checkedBoxes.length} selected books\n\nAvailable categories:\n- Science\n- Technology\n- Engineering\n- Mathematics\n- Literature\n- Business\n- Medicine`);
        }

        function bulkExportBooks() {
            const checkedBoxes = document.querySelectorAll('.book-checkbox:checked');
            alert(`Exporting ${checkedBoxes.length} selected books...\n\nExport formats:\n- PDF (Catalog)\n- Excel (Spreadsheet)\n- CSV (Data file)`);
        }

        function bulkDeleteBooks() {
            const checkedBoxes = document.querySelectorAll('.book-checkbox:checked');
            if (confirm(`Are you sure you want to delete ${checkedBoxes.length} selected books?\n\nThis action cannot be undone.`)) {
                alert(`${checkedBoxes.length} books have been deleted successfully.`);
                resetLibrarySelection();
            }
        }

        function changeLibraryPageSize(size) {
            alert(`Changing page size to ${size} books per page`);
        }

        // Finance Management Functions
        function showFinanceSection() {
            openModal('financeModal');
        }

        function filterFinanceRecords() {
            const searchTerm = document.getElementById('financeSearch').value.toLowerCase();
            const typeFilter = document.getElementById('financeTypeFilter').value;
            const statusFilter = document.getElementById('financeStatusFilter').value;
            const monthFilter = document.getElementById('financeMonthFilter').value;
            
            const rows = document.querySelectorAll('#financeTableBody tr');
            
            rows.forEach(row => {
                const studentName = row.querySelector('.student-details h4').textContent.toLowerCase();
                const studentId = row.querySelector('.student-details p').textContent.toLowerCase();
                const transactionId = row.querySelector('.transaction-id').textContent.toLowerCase();
                const type = row.dataset.type;
                const status = row.dataset.status;
                const month = row.dataset.month;
                
                const matchesSearch = studentName.includes(searchTerm) || 
                                     studentId.includes(searchTerm) || 
                                     transactionId.includes(searchTerm);
                const matchesType = !typeFilter || type === typeFilter;
                const matchesStatus = !statusFilter || status === statusFilter;
                const matchesMonth = !monthFilter || month === monthFilter;
                
                if (matchesSearch && matchesType && matchesStatus && matchesMonth) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function openAddPaymentModal() {
            openModal('addPaymentModal');
            // Set today's date as default
            document.getElementById('paymentDate').valueAsDate = new Date();
            // Show search results on focus
            document.getElementById('studentSearch').addEventListener('focus', function() {
                document.getElementById('studentSearchResults').style.display = 'block';
            });
        }

        function selectStudent(id, name, department) {
            document.getElementById('selectedStudentName').textContent = name;
            document.getElementById('selectedStudentId').textContent = id + ' • ' + department;
            document.getElementById('selectedStudentInfo').style.display = 'flex';
            document.getElementById('studentSearch').value = name;
            document.getElementById('studentSearchResults').style.display = 'none';
        }

        function clearStudentSelection() {
            document.getElementById('selectedStudentInfo').style.display = 'none';
            document.getElementById('studentSearch').value = '';
        }

        function selectPaymentMethod(method) {
            document.getElementById('method' + method.charAt(0).toUpperCase() + method.slice(1)).checked = true;
        }

        function updateFeeAmount() {
            const select = document.getElementById('feeType');
            const selectedOption = select.options[select.selectedIndex];
            const amount = selectedOption.getAttribute('data-amount');
            if (amount && amount !== '0') {
                document.getElementById('totalAmount').value = amount;
                calculateBalance();
            }
        }

        function calculateBalance() {
            const total = parseFloat(document.getElementById('totalAmount').value) || 0;
            const paid = parseFloat(document.getElementById('paidAmount').value) || 0;
            const balance = total - paid;
            document.getElementById('balanceAmount').value = balance.toFixed(2);
        }

        function resetPaymentForm() {
            document.getElementById('addPaymentForm').reset();
            clearStudentSelection();
            document.getElementById('paymentDate').valueAsDate = new Date();
        }

        // Handle form submission
        document.addEventListener('DOMContentLoaded', function() {
            const paymentForm = document.getElementById('addPaymentForm');
            if (paymentForm) {
                paymentForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const studentName = document.getElementById('selectedStudentName').textContent;
                    const feeType = document.getElementById('feeType').options[document.getElementById('feeType').selectedIndex].text;
                    const paidAmount = document.getElementById('paidAmount').value;
                    const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked')?.value;
                    
                    if (studentName === '-') {
                        alert('Please select a student');
                        return;
                    }
                    
                    if (!paymentMethod) {
                        alert('Please select a payment method');
                        return;
                    }
                    
                    if (confirm(`Confirm Payment\n\nStudent: ${studentName}\nFee Type: ${feeType}\nAmount: $${paidAmount}\nMethod: ${paymentMethod.toUpperCase()}\n\nProceed with payment?`)) {
                        alert('Payment recorded successfully!\n\nTransaction ID: #TXN-2025-' + Math.floor(Math.random() * 1000).toString().padStart(3, '0') + '\n\nReceipt has been generated.');
                        closeModal('addPaymentModal');
                        resetPaymentForm();
                    }
                });
            }
        });

        function openGenerateInvoiceModal() {
            alert('Opening Generate Invoice modal...\\n\\nFields:\\n- Student Selection\\n- Fee Types\\n- Due Date\\n- Additional Charges\\n- Discounts\\n- Terms & Conditions');
        }

        function exportFinanceReport() {
            alert('Exporting Finance Report...\\n\\nOptions:\\n- PDF (Detailed Report)\\n- Excel (Spreadsheet)\\n- CSV (Raw Data)\\n- Custom Date Range\\n- Filter by Status/Type');
        }

        function viewTransaction(transactionId) {
            alert(`Viewing transaction details: #${transactionId}\\n\\nIncludes:\\n- Full payment details\\n- Student information\\n- Payment history\\n- Receipt copies\\n- Audit trail`);
        }

        function generateReceipt(transactionId) {
            alert(`Generating receipt for transaction #${transactionId}...\\n\\nReceipt will include:\\n- Transaction details\\n- Student information\\n- Payment breakdown\\n- Official stamps\\n- QR code for verification`);
        }

        function printReceipt(transactionId) {
            alert(`Printing receipt for transaction #${transactionId}...\\n\\nPrinting in progress...`);
        }

        function recordPayment(transactionId) {
            alert(`Recording payment for transaction #${transactionId}\\n\\nFields:\\n- Payment Amount\\n- Payment Method (Cash/Card/Online)\\n- Reference Number\\n- Payment Date\\n- Received By`);
        }

        function sendReminder(transactionId) {
            alert(`Sending payment reminder for transaction #${transactionId}\\n\\nReminder will be sent via:\\n- Email\\n- SMS\\n- In-app notification`);
        }

        function viewPaymentHistory(transactionId) {
            alert(`Viewing payment history for transaction #${transactionId}\\n\\nShowing:\\n- All payments made\\n- Payment dates\\n- Payment methods\\n- Amounts\\n- Remaining balance`);
        }

        function sendOverdueNotice(transactionId) {
            alert(`Sending overdue notice for transaction #${transactionId}\\n\\nNotice includes:\\n- Overdue amount\\n- Late fees\\n- Consequences of non-payment\\n- Payment options`);
        }

        function waiveFee(transactionId) {
            if (confirm('Are you sure you want to waive this fee?\\n\\nThis action requires approval and will:\\n- Mark the fee as waived\\n- Update the account balance\\n- Create an audit log entry')) {
                alert(`Fee for transaction #${transactionId} has been waived.\\n\\nPlease provide reason for waiver in the audit log.`);
            }
        }

        function toggleSelectAllFinance() {
            const selectAll = document.getElementById('selectAllFinance');
            const checkboxes = document.querySelectorAll('.finance-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
            
            updateFinanceSelectedCount();
        }

        function updateFinanceSelectedCount() {
            const checkedBoxes = document.querySelectorAll('.finance-checkbox:checked');
            const count = checkedBoxes.length;
            const bulkActionsBar = document.getElementById('financeBulkActionsBar');
            const selectedCountSpan = document.getElementById('financeSelectedCount');
            
            selectedCountSpan.textContent = count;
            
            if (count > 0) {
                bulkActionsBar.style.display = 'flex';
            } else {
                bulkActionsBar.style.display = 'none';
                document.getElementById('selectAllFinance').checked = false;
            }
        }

        function resetFinanceSelection() {
            document.getElementById('selectAllFinance').checked = false;
            document.querySelectorAll('.finance-checkbox').forEach(checkbox => {
                checkbox.checked = false;
            });
            updateFinanceSelectedCount();
        }

        function bulkSendReminders() {
            const checkedBoxes = document.querySelectorAll('.finance-checkbox:checked');
            alert(`Sending payment reminders for ${checkedBoxes.length} selected transactions...\\n\\nReminders will be sent via:\\n- Email\\n- SMS\\n- In-app notifications`);
        }

        function bulkGenerateInvoices() {
            const checkedBoxes = document.querySelectorAll('.finance-checkbox:checked');
            alert(`Generating invoices for ${checkedBoxes.length} selected transactions...\\n\\nInvoices will be:\\n- Generated as PDF\\n- Sent to students\\n- Saved in records`);
        }

        function bulkExportFinance() {
            const checkedBoxes = document.querySelectorAll('.finance-checkbox:checked');
            alert(`Exporting ${checkedBoxes.length} selected transactions...\\n\\nExport formats:\\n- PDF (Report)\\n- Excel (Spreadsheet)\\n- CSV (Data file)`);
        }

        function changeFinancePageSize(size) {
            alert(`Changing page size to ${size} transactions per page`);
        }

        // Reports Management Functions
        function showReportsSection() {
            openModal('reportsModal');
        }

        function generateReport(reportType) {
            const reportNames = {
                'student-performance': 'Student Performance Report',
                'grade-distribution': 'Grade Distribution Report',
                'attendance': 'Attendance Report',
                'transcript': 'Academic Transcripts',
                'fee-collection': 'Fee Collection Report',
                'revenue-analysis': 'Revenue Analysis Report',
                'outstanding-fees': 'Outstanding Fees Report',
                'payment-methods': 'Payment Methods Report',
                'enrollment': 'Enrollment Report',
                'demographics': 'Demographics Report',
                'alumni': 'Alumni Report',
                'student-activity': 'Student Activity Report',
                'faculty-workload': 'Faculty Workload Report',
                'teaching-evaluation': 'Teaching Evaluation Report',
                'faculty-attendance': 'Faculty Attendance Report',
                'research-output': 'Research Output Report',
                'exam-schedule': 'Examination Schedule',
                'exam-results': 'Exam Results Report',
                'result-analysis': 'Result Analysis Report',
                'hall-tickets': 'Hall Tickets',
                'book-circulation': 'Book Circulation Report',
                'library-inventory': 'Library Inventory Report',
                'overdue-books': 'Overdue Books Report',
                'popular-books': 'Popular Books Report'
            };
            
            const reportName = reportNames[reportType] || 'Report';
            
            if (confirm(`Generate ${reportName}?\n\nThis report will be generated in PDF format and include:\n- Comprehensive data analysis\n- Visual charts and graphs\n- Detailed statistics\n- Export options\n\nProceed with generation?`)) {
                alert(`Generating ${reportName}...\n\nReport ID: #RPT-2025-${Math.floor(Math.random() * 1000).toString().padStart(3, '0')}\n\nEstimated time: 15-30 seconds\n\nYou will be notified when the report is ready.`);
            }
        }

        function generateCustomReport() {
            const reportType = document.getElementById('customReportType').value;
            const dateRange = document.getElementById('customDateRange').value;
            const format = document.getElementById('customReportFormat').value;
            
            if (!reportType) {
                alert('Please select a report type');
                return;
            }
            
            const typeNames = {
                'academic': 'Academic',
                'financial': 'Financial',
                'student': 'Student',
                'faculty': 'Faculty',
                'examination': 'Examination',
                'library': 'Library'
            };
            
            const rangeNames = {
                'today': 'Today',
                'week': 'This Week',
                'month': 'This Month',
                'quarter': 'This Quarter',
                'year': 'This Year',
                'custom': 'Custom Range'
            };
            
            const formatNames = {
                'pdf': 'PDF',
                'excel': 'Excel',
                'csv': 'CSV'
            };
            
            if (confirm(`Generate Custom Report?\n\nType: ${typeNames[reportType]}\nPeriod: ${rangeNames[dateRange]}\nFormat: ${formatNames[format]}\n\nProceed?`)) {
                alert(`Custom ${typeNames[reportType]} Report is being generated...\n\nFormat: ${formatNames[format]}\nDate Range: ${rangeNames[dateRange]}\n\nReport ID: #CUSTOM-${Math.floor(Math.random() * 10000).toString().padStart(4, '0')}\n\nEstimated time: 30-60 seconds`);
            }
        }

        
        document.addEventListener('DOMContentLoaded', function() {
            const bookCheckboxes = document.querySelectorAll('.book-checkbox');
            bookCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateLibrarySelectedCount);
            });

            const financeCheckboxes = document.querySelectorAll('.finance-checkbox');
            financeCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateFinanceSelectedCount);
            });
        });

        
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        }

        
        const passwordInput = document.querySelector('input[name="password"]');
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strengthBar = document.querySelector('.password-strength-bar');
                const strengthText = document.querySelector('.password-strength-text');
                
                let strength = 0;
                if (password.length >= 8) strength++;
                if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
                if (password.match(/[0-9]/)) strength++;
                if (password.match(/[^a-zA-Z0-9]/)) strength++;
                
                strengthBar.className = 'password-strength-bar';
                if (strength <= 2) {
                    strengthBar.classList.add('weak');
                    strengthText.textContent = 'Weak password';
                } else if (strength === 3) {
                    strengthBar.classList.add('medium');
                    strengthText.textContent = 'Medium password';
                } else {
                    strengthBar.classList.add('strong');
                    strengthText.textContent = 'Strong password';
                }
            });
        }

        
        function animateValue(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                element.textContent = Math.floor(progress * (end - start) + start).toLocaleString();
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

    
        window.addEventListener('load', function() {
            const statValues = document.querySelectorAll('.stat-content h3');
            statValues.forEach(stat => {
                const endValue = parseInt(stat.textContent.replace(/,/g, ''));
                animateValue(stat, 0, endValue, 1500);
            });
        });

        
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                
                if (!this.getAttribute('href').includes('logout')) {
                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });

        
        const searchInput = document.querySelector('.search-box input');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                console.log('Searching for:', searchTerm);
            });
        }

        
        setTimeout(function() {
            const notificationBadge = document.querySelector('.notification-badge');
            if (notificationBadge) {
                notificationBadge.style.opacity = '0.5';
            }
        }, 5000);
    </script>
</body>
</html>