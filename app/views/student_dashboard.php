<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$flash_success = $_SESSION['flash_success'] ?? null;
$flash_error = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);
$courses = $courses ?? [];
$assignments = $assignments ?? [];
$transcript = $transcript ?? []; // array of ['term','code','course','credits','grade'] optional
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <div class="d-flex" id="wrapper">
    <nav id="sidebar" class="bg-dark text-white">
      <div class="sidebar-header py-4 px-3 text-center">
        <h4 class="mb-0">Student</h4>
        <small class="text-muted">Dashboard</small>
      </div>
      <ul class="nav flex-column px-2">
        <li class="nav-item mb-1"><a class="nav-link text-white" href="#">Overview</a></li>
        <li class="nav-item mb-1"><a class="nav-link text-white" href="#courses">My Courses</a></li>
        <li class="nav-item mb-1"><a class="nav-link text-white" href="#assignments">Assignments</a></li>
        <li class="nav-item mb-1"><a class="nav-link text-white" href="#fees">Fees</a></li>
        <li class="nav-item mt-3"><a class="nav-link text-white" href="#support">Support</a></li>
      </ul>
    </nav>

    <div id="page-content" class="flex-grow-1">
      <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container-fluid">
          <button class="btn btn-outline-secondary" id="sidebarToggle">☰</button>
          <div class="ms-auto d-flex align-items-center">
            <span id="headerUserName" class="me-3 d-none d-md-inline">Welcome, <strong><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Student'); ?></strong></span>
            <a href="/index.php?page=student-profile" class="btn btn-sm btn-outline-primary me-2">Open Profile Page</a>
            <button class="btn btn-sm btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</button>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#payFeesModal">Pay Fees</button>
          </div>
        </div>
      </nav>

      <?php if ($flash_success): ?>
        <div class="container-fluid mt-3"><div class="alert alert-success"><?php echo htmlspecialchars($flash_success); ?></div></div>
      <?php endif; ?>
      <?php if ($flash_error): ?>
        <div class="container-fluid mt-3"><div class="alert alert-danger"><?php echo htmlspecialchars($flash_error); ?></div></div>
      <?php endif; ?>

      <main class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div>
            <h2 class="mb-0">My Dashboard</h2>
            <small class="text-muted">Overview of your courses, assignments and balance</small>
          </div>
          <div>
            <button class="btn btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#transcriptModal">View Transcript</button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#payFeesModal">Pay Fees</button>
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-sm-6 col-lg-3">
            <div class="card shadow-sm student-card h-100">
              <div class="card-body">
                <h6 class="card-title">Credits</h6>
                <div class="d-flex align-items-end justify-content-between">
                  <div><h3 class="card-text">120</h3><small class="text-muted">Completed</small></div>
                  <i class="bi bi-mortarboard fs-2 text-primary"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card shadow-sm student-card h-100">
              <div class="card-body">
                <h6 class="card-title">GPA</h6>
                <div class="d-flex align-items-end justify-content-between">
                  <div><h3 class="card-text">3.78</h3><small class="text-success">Good standing</small></div>
                  <i class="bi bi-bar-chart-line fs-2 text-success"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card shadow-sm student-card h-100">
              <div class="card-body">
                <h6 class="card-title">Courses</h6>
                <div class="d-flex align-items-end justify-content-between">
                  <div><h3 class="card-text">6</h3><small class="text-muted">Active</small></div>
                  <i class="bi bi-journal-bookmark fs-2 text-info"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card shadow-sm student-card h-100">
              <div class="card-body">
                <h6 class="card-title">Balance</h6>
                <div class="d-flex align-items-end justify-content-between">
                  <div><h3 id="studentBalance" class="card-text text-warning">$420.00</h3><small class="text-muted">Due</small></div>
                  <i class="bi bi-wallet2 fs-2 text-warning"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row g-4">
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5 class="mb-0">My Courses</h5>
                  <div class="d-flex gap-2">
                    <input id="courseSearch" class="form-control form-control-sm" placeholder="Search courses" aria-label="Search courses">
                    <select id="courseFilter" class="form-select form-select-sm" aria-label="Filter by status">
                      <option value="">All</option>
                      <option value="active">Active</option>
                      <option value="completed">Completed</option>
                    </select>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover" id="coursesTable">
                    <thead>
                      <tr><th>Course</th><th>Code</th><th>Instructor</th><th>Status</th><th class="text-end">Actions</th></tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($courses) && is_array($courses)): ?>
                        <?php foreach ($courses as $c): ?>
                          <tr data-title="<?php echo htmlspecialchars($c['title'] ?? ''); ?>" data-status="<?php echo htmlspecialchars($c['status'] ?? ''); ?>">
                            <td><?php echo htmlspecialchars($c['title'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($c['code'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($c['instructor'] ?? ''); ?></td>
                            <td><span class="badge bg-<?php echo ($c['status'] ?? '') === 'completed' ? 'success' : 'info'; ?>"><?php echo htmlspecialchars(ucfirst($c['status'] ?? 'Active')); ?></span></td>
                            <td class="text-end"><button class="btn btn-sm btn-outline-secondary me-1 view-course" data-id="<?php echo htmlspecialchars($c['id'] ?? ''); ?>">View</button></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td>Intro to Programming</td>
                          <td>CS101</td>
                          <td>Dr. Smith</td>
                          <td><span class="badge bg-info">Active</span></td>
                          <td class="text-end"><button class="btn btn-sm btn-outline-secondary">View</button></td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <div class="text-muted" id="coursesCount">Showing 0 of 0</div>
                  <nav aria-label="Courses pagination"><ul class="pagination mb-0" id="coursesPagination"></ul></nav>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">Upcoming Assignments</h5>
                <ul class="list-group list-group-flush" id="assignmentsList">
                  <?php if (!empty($assignments) && is_array($assignments)): ?>
                    <?php foreach ($assignments as $a): ?>
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div>
                          <div class="fw-bold"><?php echo htmlspecialchars($a['title'] ?? ''); ?></div>
                          <small class="text-muted"><?php echo htmlspecialchars($a['course'] ?? ''); ?> — Due <?php echo htmlspecialchars($a['due'] ?? ''); ?></small>
                        </div>
                        <span class="badge bg-warning rounded-pill"><?php echo htmlspecialchars($a['status'] ?? 'Pending'); ?></span>
                      </li>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div><div class="fw-bold">Final Essay</div><small class="text-muted">English 201 — Due 2025-12-20</small></div>
                      <span class="badge bg-warning rounded-pill">Pending</span>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Notifications</h5>
                <ul class="list-unstyled mb-0">
                  <li class="mb-2"><i class="bi bi-info-circle text-primary me-2"></i>Library will be closed on Dec 24.</li>
                  <li class="mb-2"><i class="bi bi-exclamation-triangle text-warning me-2"></i>Fee payment deadline: Jan 10.</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Course Modal -->
  <div class="modal fade" id="courseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Course Detail</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="courseModalBody">Loading…</div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
      </div>
    </div>
  </div>

  <!-- Transcript Modal -->
  <div class="modal fade" id="transcriptModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Academic Transcript</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="transcriptContent">
            <div class="transcript-header d-flex justify-content-between align-items-center mb-3">
              <div>
                <h5 class="mb-0"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Student'); ?></h5>
                <small class="text-muted">Student ID: <?php echo htmlspecialchars($_SESSION['user_id'] ?? 'N/A'); ?></small>
              </div>
              <div class="text-end">
                <div><strong>Total Credits:</strong> <span id="transcriptCredits">0</span></div>
                <div><strong>GPA:</strong> <span id="transcriptGPA"><?php echo htmlspecialchars($gpa ?? '3.78'); ?></span></div>
              </div>
            </div>

            <div class="table-responsive">
              <table id="transcriptTable" class="table table-sm table-striped align-middle">
                <thead>
                  <tr><th>Term</th><th>Code</th><th>Course</th><th class="text-end">Credits</th><th class="text-end">Grade</th></tr>
                </thead>
                <tbody>
                <?php if (!empty($transcript) && is_array($transcript)): ?>
                  <?php $tc=0; foreach ($transcript as $row): $tc += floatval($row['credits'] ?? 0); ?>
                    <tr>
                      <td><?php echo htmlspecialchars($row['term'] ?? ''); ?></td>
                      <td><?php echo htmlspecialchars($row['code'] ?? ''); ?></td>
                      <td><?php echo htmlspecialchars($row['course'] ?? ''); ?></td>
                      <td class="text-end"><?php echo htmlspecialchars($row['credits'] ?? '0'); ?></td>
                      <td class="text-end"><?php echo htmlspecialchars($row['grade'] ?? ''); ?></td>
                    </tr>
                  <?php endforeach; ?>
                  <script>document.addEventListener('DOMContentLoaded', function(){ document.getElementById('transcriptCredits').textContent = '<?php echo $tc; ?>'; });</script>
                <?php else: ?>
                  <tr><td>2025 Fall</td><td>CS101</td><td>Intro to Programming</td><td class="text-end">3</td><td class="text-end">A</td></tr>
                  <tr><td>2025 Fall</td><td>MATH201</td><td>Calculus II</td><td class="text-end">4</td><td class="text-end">B+</td></tr>
                  <tr><td>2024 Spring</td><td>HIST100</td><td>World History</td><td class="text-end">3</td><td class="text-end">A-</td></tr>
                  <script>document.addEventListener('DOMContentLoaded', function(){ document.getElementById('transcriptCredits').textContent = '10'; });</script>
                <?php endif; ?>
                </tbody>
              </table>
            </div>

            <div class="d-flex justify-content-between mt-3">
              <div class="text-muted small">This transcript is an unofficial copy for student reference.</div>
              <div class="btn-group">
                <button id="printTranscript" class="btn btn-sm btn-outline-secondary">Print</button>
                <button id="downloadTranscriptPdf" class="btn btn-sm btn-outline-primary">Download PDF</button>
                <button id="exportTranscriptCSV" class="btn btn-sm btn-outline-secondary">Export CSV</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Profile Modal -->
  <div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="profileForm" method="post" action="/index.php?page=student_profile_update">
          <div class="modal-header">
            <h5 class="modal-title">Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="d-flex align-items-center mb-3">
              <div><span id="profileAvatar" class="profile-avatar me-3" aria-hidden="true"></span></div>
              <div>
                <div class="fw-bold" id="profileNameView"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Student'); ?></div>
                <div class="text-muted small" id="profileIdView">ID: <?php echo htmlspecialchars($_SESSION['user_id'] ?? 'N/A'); ?></div>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Full name</label>
              <input name="name" id="profileName" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?>" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" id="profileEmail" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user_email'] ?? ''); ?>" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Phone</label>
              <input name="phone" id="profilePhone" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user_phone'] ?? ''); ?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Address</label>
              <textarea name="address" id="profileAddress" class="form-control"><?php echo htmlspecialchars($_SESSION['user_address'] ?? ''); ?></textarea>
            </div>

            <div class="form-text">This demo saves profile fields to session only. For production, persist to the database.</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="profileSaveBtn">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Pay Fees Modal -->
  <div class="modal fade" id="payFeesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="payFeesForm">
          <div class="modal-header">
            <h5 class="modal-title">Pay Fees</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Amount (USD)</label>
              <input type="number" name="amount" id="feeAmount" min="0.01" step="0.01" class="form-control" required value="420.00">
            </div>
            <div class="mb-3">
              <label class="form-label">Method</label>
              <select name="method" id="feeMethod" class="form-select" required>
                <option value="card">Debit/Credit Card</option>
                <option value="bank">Bank Transfer</option>
              </select>
            </div>
            <div id="cardFields">
              <div class="mb-3">
                <label class="form-label">Cardholder Name</label>
                <input name="card_name" class="form-control" placeholder="Name on card">
              </div>
              <div class="row g-2">
                <div class="col-8"><label class="form-label">Card Number</label><input name="card_number" class="form-control" inputmode="numeric" pattern="[0-9\s]{13,19}" placeholder="1234 5678 9012 3456"></div>
                <div class="col-4"><label class="form-label">Expiry</label><input name="card_expiry" class="form-control" placeholder="MM/YY"></div>
              </div>
              <div class="mb-3 mt-2"><label class="form-label">CVC</label><input name="card_cvc" class="form-control" inputmode="numeric" maxlength="4" style="max-width:120px" placeholder="123"></div>
            </div>
            <div id="bankInfo" class="d-none">
              <p class="small text-muted">Send payment to account: ACME Bank — Acc: 123456789 — Use your student ID as reference.</p>
            </div>
            <div class="form-text mt-2">This is a demo payment form. For production, integrate a PCI-compliant payment gateway.</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="paySubmit"><span class="spinner-border spinner-border-sm d-none" id="paySpinner" role="status" aria-hidden="true"></span> Pay</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> 
 
</body>
</html>
