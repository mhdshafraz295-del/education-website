<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUCATION SITE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid bg-light vh-100 md-5 lg-6 sm-12">
        <div class="row">
            <div class="col">
                <div class="card mt-2 mx-auto" style="max-width: 450px;">
                <div class="card-header text-center">
                   <h1>REGISTER NOW</h1> 
                </div>
                <div class="card-body">
                    <form action="index.php?page=register" method="POST">
                        <div class="mb-1">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="fullname" required placeholder="Enter your full name">
                        </div>
                        <div class="mb-1">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required placeholder="Enter your email">
                        </div>
                        <div class="mb-1">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required placeholder="Enter your password">
                        </div>
                         <div class="mb-1">
                            <label for="mobilenumber" class="form-label">Mobile Number</label>
                            <input type="number" class="form-control" name="mobilenumber" required placeholder="Enter your mobile number">
                        </div>
                                                <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" name="address"placeholder="Enter your address" required>
                        </div>
                        <label>Role</label><br>
                        <select name="role" required class="container w-100 p-2 mb-3">
                            <option value="" class="text-center p-3"> Select Role </option>
                            <option value="Lecturer">Lecturer</option>
                            <option value="Student">Student</option>
                            <option value="Examination Officer">Examination Officer</option>
                            <option value="Library Officer">Library Officer</option>
                            <option value="Finance Officer">Finance Officer</option>
                        </select><br><br>
                        <div class="d-grid gap-1">  
                            <button type="submit" name="register" class="btn btn-primary">Register</button>
                          </form>
                   
                   
                </div>
                </div>
               
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
    
</body>
</html>