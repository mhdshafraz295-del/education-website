<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Education Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow-x: hidden;
            padding: 40px 20px;
        }

        body::before {
            content: "";
            position: absolute;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent 0%,
                rgba(255, 255, 255, 0.05) 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.05) 75%,
                transparent 100%
            );
            animation: shimmer 15s infinite linear;
        }

        @keyframes shimmer {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }
            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .register-container {
            width: 100%;
            max-width: 900px;
            z-index: 1;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px;
            text-align: center;
            color: white;
        }

        .register-header i {
            font-size: 50px;
            margin-bottom: 15px;
        }

        .register-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .register-header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .register-body {
            padding: 40px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin-bottom: 25px;
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
            color: #2c3e50;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group label i {
            color: #667eea;
            font-size: 16px;
        }

        .form-group label .required {
            color: #e74c3c;
            margin-left: 2px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
            font-size: 18px;
        }

        .form-control {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .form-control.error {
            border-color: #e74c3c;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
            padding-top: 14px;
        }

        /* Role Selection */
        .role-selection {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .role-option {
            position: relative;
        }

        .role-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .role-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border: 2px solid #e0e6ed;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            min-height: 120px;
        }

        .role-label:hover {
            border-color: #667eea;
            background: #f8f9ff;
            transform: translateY(-2px);
        }

        .role-option input[type="radio"]:checked + .role-label {
            border-color: #667eea;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }

        .role-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-bottom: 12px;
            transition: all 0.3s ease;
        }

        .role-option input[type="radio"]:checked + .role-label .role-icon {
            transform: scale(1.1);
        }

        .role-name {
            font-size: 15px;
            font-weight: 600;
            color: #2c3e50;
            text-align: center;
        }

        .role-description {
            font-size: 12px;
            color: #7f8c8d;
            text-align: center;
            margin-top: 5px;
        }

        /* Password Strength */
        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: #e0e6ed;
            border-radius: 2px;
            overflow: hidden;
            display: none;
        }

        .password-strength.active {
            display: block;
        }

        .strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-bar.weak {
            width: 33%;
            background: #e74c3c;
        }

        .strength-bar.medium {
            width: 66%;
            background: #f39c12;
        }

        .strength-bar.strong {
            width: 100%;
            background: #27ae60;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #7f8c8d;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            display: none;
        }

        .error-message.active {
            display: block;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-group label {
            font-size: 14px;
            color: #2c3e50;
            cursor: pointer;
            margin: 0;
        }

        .checkbox-group label a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .checkbox-group label a:hover {
            text-decoration: underline;
        }

        .btn-register {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .btn-register i {
            font-size: 18px;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 25px 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e0e6ed;
        }

        .divider span {
            color: #7f8c8d;
            font-size: 14px;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #2c3e50;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Success Message */
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: none;
            align-items: center;
            gap: 10px;
        }

        .success-message.active {
            display: flex;
        }

        .success-message i {
            font-size: 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .role-selection {
                grid-template-columns: 1fr;
            }

            .register-header {
                padding: 30px 20px;
            }

            .register-header h1 {
                font-size: 26px;
            }

            .register-body {
                padding: 30px 20px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 20px 10px;
            }

            .register-header i {
                font-size: 40px;
            }

            .register-header h1 {
                font-size: 24px;
            }
        }

        /* Loading State */
        .btn-register.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-register.loading i {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <!-- Header -->
            <div class="register-header">
                <i class="fas fa-user-plus"></i>
                <h1>Create Your Account</h1>
                <p>Join our education portal and start your learning journey</p>
            </div>

            <!-- Body -->
            <div class="register-body">
                <!-- Success Message -->
                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i>
                    <span>Registration successful! Redirecting to login...</span>
                </div>

                <form action="/app/controllers/registercontroller.php" method="POST" id="registerForm">
                    <div class="form-grid">
                        <!-- Full Name -->
                        <div class="form-group">
                            <label>
                                <i class="fas fa-user"></i>
                                Full Name
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="input-icon fas fa-user"></i>
                                <input 
                                    type="text" 
                                    name="fullname" 
                                    id="fullname" 
                                    class="form-control" 
                                    placeholder="Enter your full name"
                                    required
                                >
                            </div>
                            <span class="error-message" id="fullnameError">Please enter your full name</span>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label>
                                <i class="fas fa-envelope"></i>
                                Email Address
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="input-icon fas fa-envelope"></i>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    class="form-control" 
                                    placeholder="your.email@example.com"
                                    required
                                >
                            </div>
                            <span class="error-message" id="emailError">Please enter a valid email address</span>
                        </div>

                        <!-- Username -->
                        <div class="form-group">
                            <label>
                                <i class="fas fa-at"></i>
                                Username
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="input-icon fas fa-at"></i>
                                <input 
                                    type="text" 
                                    name="username" 
                                    id="username" 
                                    class="form-control" 
                                    placeholder="Choose a username"
                                    required
                                >
                            </div>
                            <span class="error-message" id="usernameError">Username must be at least 3 characters</span>
                        </div>

        
                        <div class="form-group">
                            <label>
                                <i class="fas fa-phone"></i>
                                Phone Number
                            </label>
                            <div class="input-wrapper">
                                <i class="input-icon fas fa-phone"></i>
                                <input 
                                    type="tel" 
                                    name="phone" 
                                    id="phone" 
                                    class="form-control" 
                                    placeholder="+1 (555) 000-0000"
                                >
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label>
                                <i class="fas fa-lock"></i>
                                Password
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="input-icon fas fa-lock"></i>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    class="form-control" 
                                    placeholder="Create a strong password"
                                    required
                                >
                                <i class="password-toggle fas fa-eye" onclick="togglePassword('password')"></i>
                            </div>
                            <div class="password-strength" id="passwordStrength">
                                <div class="strength-bar" id="strengthBar"></div>
                            </div>
                            <span class="error-message" id="passwordError">Password must be at least 8 characters</span>
                        </div>

                    
                        <div class="form-group">
                            <label>
                                <i class="fas fa-lock"></i>
                                Confirm Password
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <i class="input-icon fas fa-lock"></i>
                                <input 
                                    type="password" 
                                    name="confirm_password" 
                                    id="confirmPassword" 
                                    class="form-control" 
                                    placeholder="Re-enter your password"
                                    required
                                >
                                <i class="password-toggle fas fa-eye" onclick="togglePassword('confirmPassword')"></i>
                            </div>
                            <span class="error-message" id="confirmPasswordError">Passwords do not match</span>
                        </div>

                    
                        <div class="form-group full-width">
                            <label>
                                <i class="fas fa-map-marker-alt"></i>
                                Address
                            </label>
                            <div class="input-wrapper">
                                <i class="input-icon fas fa-map-marker-alt"></i>
                                <textarea 
                                    name="address" 
                                    id="address" 
                                    class="form-control" 
                                    placeholder="Enter your complete address"
                                    rows="3"
                                ></textarea>
                            </div>
                        </div>

                        
                        <div class="form-group full-width">
                            <label>
                                <i class="fas fa-user-tag"></i>
                                Select Your Role
                                <span class="required">*</span>
                            </label>
                            <div class="role-selection">
                                <div class="role-option">
                                    <input type="radio" name="role" id="roleStudent" value="student" required>
                                    <label for="roleStudent" class="role-label">
                                        <div class="role-icon">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                        <div class="role-name">Student</div>
                                        <div class="role-description">I'm here to learn</div>
                                    </label>
                                </div>

                                <div class="role-option">
                                    <input type="radio" name="role" id="roleLecturer" value="lecturer">
                                    <label for="roleLecturer" class="role-label">
                                        <div class="role-icon">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                        </div>
                                        <div class="role-name">Lecturer</div>
                                        <div class="role-description">I teach courses</div>
                                    </label>
                                </div>

                                <div class="role-option">
                                    <input type="radio" name="role" id="roleExam" value="examination_officer">
                                    <label for="roleExam" class="role-label">
                                        <div class="role-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <div class="role-name">Examination Officer</div>
                                        <div class="role-description">Manage exams</div>
                                    </label>
                                </div>

                                <div class="role-option">
                                    <input type="radio" name="role" id="roleLibrary" value="library_officer">
                                    <label for="roleLibrary" class="role-label">
                                        <div class="role-icon">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div class="role-name">Library Officer</div>
                                        <div class="role-description">Manage library</div>
                                    </label>
                                </div>
                            </div>
                            <span class="error-message" id="roleError">Please select a role</span>
                        </div>
                    </div>

            
                    <div class="checkbox-group">
                        <input type="checkbox" name="terms" id="terms" required>
                        <label for="terms">
                            I agree to the <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>
                        </label>
                    </div>

                    
                    <button type="submit" class="btn-register" id="submitBtn">
                        <span>Create Account</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>

        
                    <div class="login-link">
                        Already have an account?
                        <a href="/education_site/app/views/login.php">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        
        const passwordInput = document.getElementById('password');
        const strengthIndicator = document.getElementById('passwordStrength');
        const strengthBar = document.getElementById('strengthBar');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            
            if (password.length === 0) {
                strengthIndicator.classList.remove('active');
                return;
            }

            strengthIndicator.classList.add('active');
            let strength = 0;

            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            
            strengthBar.className = 'strength-bar';
            if (strength <= 2) {
                strengthBar.classList.add('weak');
            } else if (strength === 3) {
                strengthBar.classList.add('medium');
            } else {
                strengthBar.classList.add('strong');
            }
        });

        
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling;
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

    
        const form = document.getElementById('registerForm');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isValid = true;

            
            const fullname = document.getElementById('fullname');
            if (fullname.value.trim().length < 2) {
                showError('fullname', 'Please enter your full name');
                isValid = false;
            } else {
                hideError('fullname');
            }

        
            const email = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                showError('email', 'Please enter a valid email address');
                isValid = false;
            } else {
                hideError('email');
            }

            
            const username = document.getElementById('username');
            if (username.value.trim().length < 3) {
                showError('username', 'Username must be at least 3 characters');
                isValid = false;
            } else {
                hideError('username');
            }

        
            const password = document.getElementById('password');
            if (password.value.length < 8) {
                showError('password', 'Password must be at least 8 characters');
                isValid = false;
            } else {
                hideError('password');
            }

            
            const confirmPassword = document.getElementById('confirmPassword');
            if (confirmPassword.value !== password.value) {
                showError('confirmPassword', 'Passwords do not match');
                isValid = false;
            } else {
                hideError('confirmPassword');
            }

        
            const roleSelected = document.querySelector('input[name="role"]:checked');
            if (!roleSelected) {
                showError('role', 'Please select a role');
                isValid = false;
            } else {
                hideError('role');
            }

        
            const terms = document.getElementById('terms');
            if (!terms.checked) {
                alert('Please accept the Terms & Conditions');
                isValid = false;
            }

            if (isValid) {
        
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = '<span>Creating Account...</span><i class="fas fa-spinner"></i>';
                
        
                form.submit();
            }
        });

        function showError(fieldId, message) {
            const field = document.getElementById(fieldId);
            const errorElement = document.getElementById(fieldId + 'Error');
            
            field.classList.add('error');
            errorElement.textContent = message;
            errorElement.classList.add('active');
        }

        function hideError(fieldId) {
            const field = document.getElementById(fieldId);
            const errorElement = document.getElementById(fieldId + 'Error');
            
            field.classList.remove('error');
            errorElement.classList.remove('active');
        }

        
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && this.value.trim() === '') {
                    showError(this.id, 'This field is required');
                } else {
                    hideError(this.id);
                }
            });
        });
    </script>
</body>
</html>
