
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Lecturer Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background:#f6f8fb; }
    .sidebar { min-height:100vh; background:#fff; border-right:1px solid #e9eef6; }
    .card-sm { border-radius:.6rem; }
    .stat { font-weight:700; font-size:1.45rem; }
    .course-row:hover { background:#f8fafc; }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">EDUCATION SITE - LECTURE</a>
    <div class="d-flex align-items-center gap-3">
      <div class="text-muted small">Signed in as</strong></div>
      <a class="btn btn-outline-secondary btn-sm" href="index.php?page=profile">Profile</a>
      <a class="btn btn-outline-danger btn-sm" href="index.php?page=login&logout=1">Logout</a>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row g-4 p-4">
    <aside class="col-12 col-md-3 col-lg-2 sidebar p-3">
      <h6 class="text-uppercase text-muted">Menu</h6>
      <nav class="nav flex-column">
        <a class="nav-link active" href="index.php?page=lecture-dashboard">Overview</a>
        <a class="nav-link" href="index.php?page=courses">My Courses</a>
        <a class="nav-link" href="index.php?page=assignments">Assignments</a>
        <a class="nav-link" href="index.php?page=gradebook">Gradebook</a>
        <a class="nav-link" href="index.php?page=announcements">Announcements</a>
      </nav>
    </aside>

    <main class="col-12 col-md-9 col-lg-10">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h3 class="mb-0">Welcome</h3>
          <small class="text-muted">Lecturer dashboard — quick overview</small>
        </div>
        <div>
          <a class="btn btn-primary" href="index.php?page=create-course">Create Course</a>
          <a class="btn btn-outline-secondary" href="index.php?page=announcements">New Announcement</a>
        </div>
      </div>

      <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
          <div class="card card-sm p-3">
            <div class="text-muted small">Courses</div>
            <div class="stat"></div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="card card-sm p-3">
            <div class="text-muted small">Pending Grading</div>
            <div class="stat"></div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <div class="text-muted small">Quick Actions</div>
                <div class="mt-2">
                  <a class="btn btn-outline-primary btn-sm me-2" href="index.php?page=gradebook">Open Gradebook</a>
                  <a class="btn btn-outline-primary btn-sm me-2" href="index.php?page=create-assignment">Create Assignment</a>
                  <a class="btn btn-outline-secondary btn-sm" href="index.php?page=student-communication">Message Students</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-lg-7">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <strong>My Courses</strong>
              <a class="small" href="index.php?page=courses">View all</a>
            </div>
            <div class="table-responsive">
              <table class="table mb-0 align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Course</th>
                    <th>Students</th>
                    <th>Progress</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr class="course-row">
                    <td>
                      <div class="fw-semibold"></div>
                      <div class="text-muted small"></div>
                    </td>
                    <td><?= intval($c['studens']?? 0) ?></td>
                    <td style="width:30%">
                      <div class="progress" style="height:.6rem">
                        <div class="progress-bar" role="progressbar" style="width:<?= intval($c['progress'] ?? 0) ?>%"></div>
                      </div>
                    </td>
                    <td class="text-end">
                      <a class="btn btn-sm btn-outline-primary" href="index.php?page=course&id=<?= intval($c['id']) ?>">Open</a>
                      <a class="btn btn-sm btn-outline-secondary" href="index.php?page=gradebook&course=<?= intval($c['id']) ?>">Grade</a>
                    </td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
          </div>

          <div class="card mt-3">
            <div class="card-header d-flex justify-content-between">
              <strong>Recent Submissions</strong>
              <a class="small" href="index.php?page=gradebook">See all</a>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">John Doe — Assignment 1 (Database Systems) • Submitted 3h ago <span class="badge bg-warning text-dark ms-2">Needs grading</span></li>
              <li class="list-group-item">Jane Smith — Quiz 2 (Algorithms) • Submitted 1d ago</li>
            </ul>
          </div>
        </div>

        <div class="col-lg-5">
          <div class="card mb-3">
            <div class="card-header"><strong>Announcements</strong></div>
            <div class="list-group list-group-flush">
              <div class="list-group-item">
                <div class="fw-semibold">Week 7 materials uploaded</div>
                <div class="text-muted small">Posted 6h ago</div>
              </div>
              <div class="list-group-item">
                <div class="fw-semibold">Exam schedule published</div>
                <div class="text-muted small">Posted 2d ago</div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header"><strong>Quick Notes</strong></div>
            <div class="card-body">
              <p class="small text-muted">This dashboard is a UI template — connect it to real data in the controller (courses, submissions, announcements).</p>
              <a href="index.php?page=create-announcement" class="btn btn-outline-primary btn-sm">New Announcement</a>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
