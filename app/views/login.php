<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUCATION SITE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    

</head>
<body>
    <div class="container-fluid bg-secondary text-white vh-100 md-5 lg-6 sm-12">
        <div class="row">
            <div class="col">
                <div class="card mt-5 mx-auto" style="max-width: 400px;">

              <?php
                if (isset($_GET['success'])) {
                echo "<div class='alert alert-success'>
                        Registration successful. Please login.
                    </div>";}
                    ?>

                <div class="card-header text-center ">
                   <h1>LOGIN PAGE</h1> 
                </div>
                <div class="card-body p-4 ">
                    <form action="index.php?page=login" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
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
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                             <p class="sign-up-label text-center mt-2">
                    New user? Rgister here<span><a href="index.php?page=register" class="m-1">Register</a></span>
                </p>
                   
                </div>
                </div>
               
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
    
</body>
</html>