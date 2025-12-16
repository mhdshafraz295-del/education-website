
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Examination Officer — Dashboard</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="d-flex" id="wrapper">

        
        <nav id="sidebar" class="bg-dark text-white">
            <div class="sidebar-header py-4 px-3 text-center">
                <h4 class="mb-0">Exam Officer</h4>
                <small class="text-muted">Dashboard</small>
            </div>

            <ul class="nav flex-column px-2">
                <li class="nav-item mb-1"><a class="nav-link text-white" href="#">Dashboard</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="#exams">Exams</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="#students">Students</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="#results">Results</a></li>
                <li class="nav-item mt-3"><a class="nav-link text-white" href="#settings">Settings</a></li>
            </ul>
        </nav>
        

        
        <div id="page-content" class="flex-grow-1">
            
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-outline-secondary" id="sidebarToggle">☰</button>
                    <div class="ms-auto d-flex align-items-center">
                        <span class="me-3 d-none d-md-inline">Welcome, <strong><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Officer'); ?></strong></span>
                        <div class="dropdown">
                            <a class="btn btn-sm btn-outline-primary" href="#" role="button">Profile</a>
                        </div>
                    </div>
                </div>
            </nav>

        
            <main class="container-fluid p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Dashboard</h2>
                    <div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addExamModal">Add Exam</button>
                    </div>
                </div>

            
                <div class="row g-3 mb-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">Total Exams</h6>
                                <h3 class="card-text">12</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">Ongoing</h6>
                                <h3 class="card-text text-warning">2</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">Upcoming</h6>
                                <h3 class="card-text text-success">3</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">Students</h6>
                                <h3 class="card-text">450</h3>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Exams</h5>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Duration</th>
                                        <th>Total Marks</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($exams) && is_array($exams)): ?>
                                        <?php foreach ($exams as $exam): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($exam['title']); ?></td>
                                                <td><?php echo htmlspecialchars($exam['date']); ?></td>
                                                <td><?php echo htmlspecialchars($exam['duration']); ?></td>
                                                <td><?php echo htmlspecialchars($exam['marks']); ?></td>
                                                <td><span class="badge <?php echo (($exam['status'] ?? '') === 'Upcoming') ? 'bg-success' : 'bg-secondary'; ?>"><?php echo htmlspecialchars($exam['status'] ?? ''); ?></span></td>
                                                <td class="text-end">
                                                    <button type="button" class="btn btn-sm btn-outline-primary edit-exam-btn" 
                                                        data-id="<?php echo htmlspecialchars($exam['id']); ?>"
                                                        data-title="<?php echo htmlspecialchars($exam['title']); ?>"
                                                        data-date="<?php echo htmlspecialchars($exam['date']); ?>"
                                                        data-duration="<?php echo htmlspecialchars($exam['duration']); ?>"
                                                        data-marks="<?php echo htmlspecialchars($exam['marks']); ?>"
                                                    >Edit</button>
                                                    <a class="btn btn-sm btn-outline-danger" href="/index.php?page=exam_delete&id=<?php echo urlencode($exam['id']); ?>">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td>Mathematics 101</td>
                                            <td>2025-12-20</td>
                                            <td>2 hrs</td>
                                            <td>100</td>
                                            <td><span class="badge bg-success">Upcoming</span></td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-outline-primary">Edit</button>
                                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </main>
        </div>
        
    </div>

    
    <div class="modal fade" id="addExamModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="addExamForm" method="post" action="#">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Exam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label">Exam Title</label>
                                <input name="title" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Date</label>
                                <input name="date" type="date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Duration</label>
                                <input name="duration" class="form-control" placeholder="e.g., 2 hrs" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Total Marks</label>
                                <input name="marks" type="number" min="0" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Exam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit Exam Modal -->
    <div class="modal fade" id="editExamModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="editExamForm" method="post" action="/index.php?page=exam_update">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Exam</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editExamId">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label">Exam Title</label>
                                <input name="title" id="editExamTitle" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Date</label>
                                <input name="date" id="editExamDate" type="date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Duration</label>
                                <input name="duration" id="editExamDuration" class="form-control" placeholder="e.g., 2 hrs" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Total Marks</label>
                                <input name="marks" id="editExamMarks" type="number" min="0" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });

        // Demo add exam handler (replace with server-side POST)
        document.getElementById('addExamForm').addEventListener('submit', function (e) {
            e.preventDefault();
            alert('Exam created (demo). Integrate with your controller to store it in the database.');
            var modal = bootstrap.Modal.getInstance(document.getElementById('addExamModal'));
            modal.hide();
        });

        // Edit button -> populate and show edit modal
        document.querySelectorAll('.edit-exam-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var id = this.dataset.id;
                document.getElementById('editExamId').value = id;
                document.getElementById('editExamTitle').value = this.dataset.title || '';
                document.getElementById('editExamDate').value = this.dataset.date || '';
                document.getElementById('editExamDuration').value = this.dataset.duration || '';
                document.getElementById('editExamMarks').value = this.dataset.marks || '';

                var editModal = new bootstrap.Modal(document.getElementById('editExamModal'));
                editModal.show();
            });
        });
    </script>
</body>
</html>
