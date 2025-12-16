<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$flash_success = $_SESSION['flash_success'] ?? null;
$flash_error = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);
$users = $users ?? [];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <div class="d-flex" id="wrapper">
    <nav id="sidebar" class="bg-dark text-white">
      <div class="sidebar-header py-4 px-3 text-center">
        <h4 class="mb-0">Admin</h4>
        <small class="text-muted">Control Panel</small>
      </div>
      <ul class="nav flex-column px-2">
        <li class="nav-item mb-1"><a class="nav-link text-white" href="#">Overview</a></li>
        <li class="nav-item mb-1"><a class="nav-link text-white" href="#users">Users</a></li>
        <li class="nav-item mb-1"><a class="nav-link text-white" href="#settings">Settings</a></li>
        <li class="nav-item mb-1"><a class="nav-link text-white" href="#logs">Activity Logs</a></li>
      </ul>
    </nav>

    <div id="page-content" class="flex-grow-1">
      <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container-fluid">
          <button class="btn btn-outline-secondary" id="sidebarToggle">☰</button>
          <div class="ms-auto d-flex align-items-center">
            <div class="dropdown">
              <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo htmlspecialchars($_SESSION['user_avatar'] ?? '/css/avatar-placeholder.png'); ?>" alt="avatar" class="rounded-circle me-2" style="width:32px;height:32px;object-fit:cover;">
                <strong class="d-none d-md-inline"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Admin'); ?></strong>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                <li><a class="dropdown-item" href="/index.php?page=student-profile">Profile</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#accountModal">Account</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="/index.php?page=logout" onclick="return confirm('Logout?');">Logout</a></li>
              </ul>
            </div>
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
            <h2 class="mb-0">Admin Dashboard</h2>
            <small class="text-muted">Site overview and quick actions</small>
          </div>
          <div>
            <div class="btn-group me-2">
              <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Export</button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#" id="exportCsv">Export visible (CSV)</a></li>
                <li><a class="dropdown-item" href="#" id="exportJson">Export visible (JSON)</a></li>
                <li><a class="dropdown-item" href="#" id="exportSelectedCsv">Export selected (CSV)</a></li>
                <li><a class="dropdown-item" href="#" id="exportPdf">Print / PDF</a></li>
              </ul>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-sm-6 col-lg-3">
            <div class="card shadow-sm">
              <div class="card-body">
                <h6 class="card-title">Active Users</h6>
                <h3 class="card-text">1,234</h3>
                <small class="text-muted">Last 30 days</small>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card shadow-sm">
              <div class="card-body">
                <h6 class="card-title">New Signups</h6>
                <h3 class="card-text">184</h3>
                <small class="text-success">+12% vs prev</small>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card shadow-sm">
              <div class="card-body">
                <h6 class="card-title">Open Issues</h6>
                <h3 class="card-text text-danger">6</h3>
                <small class="text-muted">Unresolved</small>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card shadow-sm">
              <div class="card-body">
                <h6 class="card-title">Server Load</h6>
                <h3 class="card-text">0.52</h3>
                <small class="text-muted">Last 5m</small>
              </div>
            </div>
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="mb-0">Users</h5>
              <div class="d-flex align-items-center gap-2">
                <input id="userSearch" class="form-control form-control-sm" placeholder="Search users" aria-label="Search users">
                <select id="userRole" class="form-select form-select-sm">
                  <option value="">All roles</option>
                  <option value="admin">Admin</option>
                  <option value="student">Student</option>
                 
                </select>
              </div>
            </div>

            <div class="table-responsive">
              <table id="usersTable" class="table table-hover align-middle">
                <thead>
                  <tr>
                    <th class="text-center" style="width:48px;"><input type="checkbox" id="selectAllUsers" aria-label="Select all users"></th>
                    <th>Name</th><th>Email</th><th>Role</th><th>Status</th><th class="text-end">Actions</th>
                  </tr>
                </thead> 
                <tbody>
                  <?php if (!empty($users) && is_array($users)): ?>
                    <?php foreach ($users as $u): ?>
                      <tr data-name="<?php echo htmlspecialchars($u['name']); ?>" data-role="<?php echo htmlspecialchars($u['role']); ?>">
                        <td class="text-center"><input type="checkbox" class="select-user" value="<?php echo htmlspecialchars($u['id'] ?? ''); ?>" aria-label="Select user"></td>
                        <td><?php echo htmlspecialchars($u['name']); ?></td>
                        <td><?php echo htmlspecialchars($u['email']); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst($u['role'])); ?></td>
                        <td><span class="badge bg-<?php echo ($u['active'] ? 'success' : 'secondary'); ?>"><?php echo ($u['active'] ? 'Active' : 'Inactive'); ?></span></td>
                        <td class="text-end">
                          <button class="btn btn-sm btn-outline-primary me-1 edit-user" data-id="<?php echo htmlspecialchars($u['id']); ?>" data-name="<?php echo htmlspecialchars($u['name']); ?>" data-email="<?php echo htmlspecialchars($u['email']); ?>" data-role="<?php echo htmlspecialchars($u['role']); ?>">Edit</button>
                          <a href="#" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove user?');">Remove</a>
                        </td>
                      </tr> 
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td class="text-center"><input type="checkbox" class="select-user" value="sample-1" aria-label="Select user"></td>
                      <td>Jane Doe</td>
                      <td>jane.doe@example.com</td>
                      <td>Admin</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td class="text-end"><button class="btn btn-sm btn-outline-primary">Edit</button></td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
              <div class="text-muted" id="usersCount">Showing 0 of 0</div>
              <nav aria-label="Users pagination"><ul class="pagination mb-0" id="usersPagination"></ul></nav>
            </div>
          </div>
        </div>

        <div class="row g-4">
          <div class="col-lg-6">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title">Recent Activity</h5>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">User <strong>alice</strong> created a new exam — 2h ago</li>
                  <li class="list-group-item">Backup completed — 5h ago</li>
                  <li class="list-group-item">New registration: <strong>bob@example.com</strong> — 1d ago</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title">Quick Settings</h5>
                <div class="form-check form-switch mb-2"><input class="form-check-input" type="checkbox" id="maintenanceToggle"><label class="form-check-label" for="maintenanceToggle">Maintenance mode</label></div>
                <div class="form-check form-switch mb-2"><input class="form-check-input" type="checkbox" id="emailToggle" checked><label class="form-check-label" for="emailToggle">Email notifications</label></div>
              </div>
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>

  <!-- Account Modal -->
  <div class="modal fade" id="accountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="d-flex align-items-center mb-3">
            <img src="<?php echo htmlspecialchars($_SESSION['user_avatar'] ?? '/css/avatar-placeholder.png'); ?>" alt="avatar" class="rounded-circle me-3" style="width:64px;height:64px;object-fit:cover;">
            <div>
              <div class="fw-bold"><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Admin'); ?></div>
              <div class="text-muted small"><?php echo htmlspecialchars($_SESSION['user_email'] ?? 'admin@example.com'); ?></div>
            </div>
          </div>
          <p class="small text-muted">Manage your profile, account settings, and security options.</p>
          <div class="d-flex gap-2">
            <a href="/index.php?page=student-profile" class="btn btn-primary">View Profile</a>
            <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
          </div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
      </div>
    </div>
  </div>

  <!-- Change Password Modal -->
  <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="changePasswordForm" method="post" action="#">
          <div class="modal-header"><h5 class="modal-title">Change Password</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
          <div class="modal-body">
            <div class="mb-3"><label class="form-label">Current password</label><input name="current_password" type="password" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">New password</label><input name="new_password" id="newPassword" type="password" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Confirm new password</label><input name="confirm_password" id="confirmPassword" type="password" class="form-control" required></div>
            <div class="form-text">This is a demo form. Implement secure server-side password change in production.</div>
          </div>
          <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary">Change password</button></div>
        </form>
      </div>
    </div>
  </div>

  
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="addUserForm" method="post" action="#">
          <div class="modal-header"><h5 class="modal-title">Add User</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
          <div class="modal-body">
            <div class="mb-3"><label class="form-label">Full name</label><input name="name" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Role</label><select name="role" class="form-select"><option value="student">Student</option><option value="officer">Officer</option><option value="admin">Admin</option></select></div>
          </div>
          <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary">Create</button></div>
        </form>
      </div>
    </div>
  </div>

  
  <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="editUserForm" method="post" action="#">
          <div class="modal-header"><h5 class="modal-title">Edit User</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
          <div class="modal-body">
            <input type="hidden" name="id" id="editUserId">
            <div class="mb-3"><label class="form-label">Full name</label><input id="editUserName" name="name" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Email</label><input id="editUserEmail" type="email" name="email" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Role</label><select id="editUserRole" name="role" class="form-select"><option value="student">Student</option><option value="officer">Officer</option><option value="admin">Admin</option></select></div>
            <div class="form-check"><input id="editUserActive" name="active" class="form-check-input" type="checkbox"><label class="form-check-label" for="editUserActive">Active</label></div>
          </div>
          <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary">Save changes</button></div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    
    document.getElementById('sidebarToggle').addEventListener('click', function(){ document.getElementById('sidebar').classList.toggle('collapsed'); });

    
    document.querySelectorAll('.edit-user').forEach(function(btn){ btn.addEventListener('click', function(){ var id = this.dataset.id; document.getElementById('editUserId').value = id; document.getElementById('editUserName').value = this.dataset.name; document.getElementById('editUserEmail').value = this.dataset.email; document.getElementById('editUserRole').value = this.dataset.role; document.getElementById('editUserActive').checked = (this.dataset.active === '1'); new bootstrap.Modal(document.getElementById('editUserModal')).show(); }); });

    
    (function(){
      var table = document.getElementById('usersTable'); if(!table) return; var tbody = table.tBodies[0]; var rows = Array.from(tbody.querySelectorAll('tr'));
      var search = document.getElementById('userSearch'); var role = document.getElementById('userRole'); var pagination = document.getElementById('usersPagination'); var count = document.getElementById('usersCount'); var currentPage = 1; var perPage = 8;
      function render(){ var q = (search.value||'').toLowerCase().trim(); var r = role.value; var filtered = rows.filter(function(tr){ var name = (tr.dataset.name||'').toLowerCase(); var rr = (tr.dataset.role||''); if(q && !name.includes(q)) return false; if(r && r !== rr) return false; return true; }); var total = filtered.length; var totalPages = Math.max(1, Math.ceil(total/perPage)); if(currentPage>totalPages) currentPage = totalPages; rows.forEach(function(x){ x.style.display='none'; }); var start = (currentPage-1)*perPage; var pageRows = filtered.slice(start, start+perPage); pageRows.forEach(function(x){ x.style.display=''; }); pagination.innerHTML=''; var prev = document.createElement('li'); prev.className='page-item '+(currentPage===1?'disabled':''); prev.innerHTML='<a class="page-link" href="#">&laquo;</a>'; prev.addEventListener('click', function(e){ e.preventDefault(); if(currentPage>1){ currentPage--; render(); }}); pagination.appendChild(prev); for(var p=1;p<=totalPages;p++){ var li=document.createElement('li'); li.className='page-item '+(p===currentPage?'active':''); li.innerHTML='<a class="page-link" href="#">'+p+'</a>'; (function(pp){ li.addEventListener('click', function(e){ e.preventDefault(); currentPage=pp; render(); }); })(p); pagination.appendChild(li); } var next=document.createElement('li'); next.className='page-item '+(currentPage===totalPages?'disabled':''); next.innerHTML='<a class="page-link" href="#">&raquo;</a>'; next.addEventListener('click', function(e){ e.preventDefault(); if(currentPage<totalPages){ currentPage++; render(); }}); pagination.appendChild(next); count.textContent = 'Showing ' + pageRows.length + ' of ' + total; }
      [search, role].forEach(function(el){ el.addEventListener('input', function(){ currentPage=1; render(); }); }); render();
    })();

    
    (function(){
      function getVisibleRows(){
        return Array.from(document.querySelectorAll('#usersTable tbody tr')).filter(function(r){ return r.style.display !== 'none'; });
      }
      function tableRowsToObjects(rows){
        return rows.map(function(r){ var cells = r.querySelectorAll('td'); return {
          id: (r.querySelector('.select-user')||{}).value || null,
          name: cells[1] ? cells[1].innerText.trim() : '',
          email: cells[2] ? cells[2].innerText.trim() : '',
          role: cells[3] ? cells[3].innerText.trim() : '',
          status: cells[4] ? cells[4].innerText.trim() : ''
        }; });
      }

      function download(filename, content, mime){ var blob = new Blob([content], {type: mime}); var url = URL.createObjectURL(blob); var a = document.createElement('a'); a.href = url; a.download = filename; document.body.appendChild(a); a.click(); a.remove(); URL.revokeObjectURL(url); }

      document.getElementById('exportCsv').addEventListener('click', function(e){ e.preventDefault(); var rows = tableRowsToObjects(getVisibleRows()); if(!rows.length){ alert('No rows visible'); return; } var csv = Object.keys(rows[0]).filter(k=>k!=='id').join(',') + '\n' + rows.map(function(r){ return [r.name,r.email,r.role,r.status].map(function(v){ return '"'+String(v).replace(/"/g,'""')+'"'; }).join(','); }).join('\n'); download('users.csv', csv, 'text/csv'); });

      document.getElementById('exportJson').addEventListener('click', function(e){ e.preventDefault(); var rows = tableRowsToObjects(getVisibleRows()); download('users.json', JSON.stringify(rows, null, 2), 'application/json'); });

      document.getElementById('exportSelectedCsv').addEventListener('click', function(e){ e.preventDefault(); var checked = Array.from(document.querySelectorAll('.select-user')).filter(function(cb){ return cb.checked; }); if(!checked.length){ alert('No users selected'); return; } var objs = checked.map(function(cb){ var tr = cb.closest('tr'); return tableRowsToObjects([tr])[0]; }); var csv = 'name,email,role,status\n' + objs.map(function(r){ return [r.name,r.email,r.role,r.status].map(function(v){ return '"'+String(v).replace(/"/g,'""')+'"'; }).join(','); }).join('\n'); download('users-selected.csv', csv, 'text/csv'); });

      document.getElementById('exportPdf').addEventListener('click', function(e){ e.preventDefault(); var content = document.querySelector('#usersTable').outerHTML; var w = window.open('', '_blank'); w.document.write('<html><head><title>Users</title><link rel="stylesheet" href="/css/style.css"></head><body>'); w.document.write('<h3>Users</h3>'); w.document.write(content); w.document.write('</body></html>'); w.document.close(); w.focus(); setTimeout(function(){ w.print(); }, 300); });

      
      var selectAll = document.getElementById('selectAllUsers'); if(selectAll){ selectAll.addEventListener('change', function(){ var visible = getVisibleRows(); visible.forEach(function(r){ var cb = r.querySelector('.select-user'); if(cb) cb.checked = selectAll.checked; }); }); }

      
      (function(){
        var form = document.getElementById('changePasswordForm'); if(!form) return;
        form.addEventListener('submit', function(e){ e.preventDefault(); var n = document.getElementById('newPassword').value; var c = document.getElementById('confirmPassword').value; if(n.length < 8){ alert('Password must be at least 8 characters.'); return; } if(n !== c){ alert('Passwords do not match.'); return; } // simulate success
          var modalEl = document.getElementById('changePasswordModal'); var modal = bootstrap.Modal.getInstance(modalEl); if(modal) modal.hide(); var accountModalEl = document.getElementById('accountModal'); var acct = bootstrap.Modal.getInstance(accountModalEl); if(acct) acct.hide(); var container = document.querySelector('main.container-fluid'); if(container){ var alert = document.createElement('div'); alert.className = 'alert alert-success mt-3'; alert.textContent = 'Password changed (demo).'; container.insertBefore(alert, container.firstChild); setTimeout(function(){ alert.remove(); },5000); } });
      })();
    })();
  </script>
</body>
</html>
