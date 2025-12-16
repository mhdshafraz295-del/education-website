<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$flash_success = $_SESSION['flash_success'] ?? null;
$flash_error = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);
$transactions = $transactions ?? [];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finance Officer — Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <nav id="sidebar" class="bg-dark text-white">
            <div class="sidebar-header py-4 px-3 text-center">
                <h4 class="mb-0">Finance</h4>
                <small class="text-muted">Officer Dashboard</small>
            </div>
            <ul class="nav flex-column px-2">
                <li class="nav-item mb-1"><a class="nav-link text-white" href="#">Dashboard</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="#transactions">Transactions</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="#reports">Reports</a></li>
                <li class="nav-item mt-3"><a class="nav-link text-white" href="#settings">Settings</a></li>
            </ul>
        </nav>

        <div id="page-content" class="flex-grow-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-outline-secondary" id="sidebarToggle">☰</button>
                    <div class="ms-auto d-flex align-items-center">
                        <span class="me-3 d-none d-md-inline">Welcome, <strong><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Officer'); ?></strong></span>
                        <a class="btn btn-sm btn-outline-primary" href="#" role="button">Profile</a>
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
                        <h2 class="mb-0">Finance Dashboard</h2>
                        <small class="text-muted">Summary of funds and recent transactions</small>
                    </div>
                    <div>
                        <button class="btn btn-outline-secondary me-2">Export</button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTxModal">Add Transaction</button>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">Total Income</h6>
                                <h3 class="card-text">$56,420</h3>
                                <small class="text-success">+8% since last month</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">Total Expense</h6>
                                <h3 class="card-text">$23,120</h3>
                                <small class="text-danger">+2% since last month</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">Balance</h6>
                                <h3 class="card-text">$33,300</h3>
                                <small class="text-muted">Available funds</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">Pending</h6>
                                <h3 class="card-text text-warning">$4,100</h3>
                                <small class="text-muted">Awaiting approvals</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transactions toolbar -->
                <div class="row g-2 align-items-center mb-3" role="region" aria-label="Transactions filters">
                    <div class="col-md-4">
                        <input id="txSearch" class="form-control" placeholder="Search by description or reference" aria-label="Search transactions">
                    </div>
                    <div class="col-md-3">
                        <select id="txType" class="form-select" aria-label="Filter by type">
                            <option value="">All types</option>
                            <option value="income">Income</option>
                            <option value="expense">Expense</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input id="txDate" type="month" class="form-control" aria-label="Filter by month">
                    </div>
                    <div class="col-md-2 text-end">
                        <label class="me-2">Rows:
                            <select id="txRows" class="form-select d-inline-block" style="width:auto">
                                <option>10</option>
                                <option>25</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Recent Transactions</h5>
                        <div class="table-responsive">
                            <table id="txTable" class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Ref</th>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th class="text-end">Amount</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($transactions) && is_array($transactions)): ?>
                                        <?php foreach ($transactions as $t): ?>
                                            <tr data-desc="<?php echo htmlspecialchars($t['description'] ?? ''); ?>" data-ref="<?php echo htmlspecialchars($t['ref'] ?? ''); ?>" data-type="<?php echo htmlspecialchars($t['type'] ?? ''); ?>">
                                                <td><?php echo htmlspecialchars($t['date'] ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($t['ref'] ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($t['description'] ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars(ucfirst($t['type'] ?? '')); ?></td>
                                                <td class="text-end"><strong><?php echo htmlspecialchars($t['amount'] ?? '0.00'); ?></strong></td>
                                                <td class="text-end">
                                                    <button class="btn btn-sm btn-outline-primary edit-tx" data-id="<?php echo htmlspecialchars($t['id']); ?>" data-bs-toggle="tooltip" title="Edit"><i class="bi bi-pencil"></i></button>
                                                    <a class="btn btn-sm btn-outline-danger ms-1" href="#" onclick="return confirm('Delete transaction?');" data-bs-toggle="tooltip" title="Delete"><i class="bi bi-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td>2025-12-01</td>
                                            <td>REF-001</td>
                                            <td>Tuition payment</td>
                                            <td>Income</td>
                                            <td class="text-end"><strong>$3,500.00</strong></td>
                                            <td class="text-end"><button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted" id="txCount">Showing 0 of 0</div>
                            <nav aria-label="Transactions pagination">
                                <ul class="pagination mb-0" id="txPagination"></ul>
                            </nav>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Add Transaction Modal -->
    <div class="modal fade" id="addTxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="addTxForm" method="post" action="#">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Transaction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Reference</label>
                                <input name="ref" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-select" required>
                                    <option value="income">Income</option>
                                    <option value="expense">Expense</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <input name="description" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Amount</label>
                                <input name="amount" type="number" step="0.01" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });

        // tooltips
        var tList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tList.map(function (el) { return new bootstrap.Tooltip(el); });

        // simple client-side table search & pagination (small dataset)
        (function(){
            var table = document.getElementById('txTable');
            if (!table) return;
            var tbody = table.tBodies[0];
            var rows = Array.from(tbody.querySelectorAll('tr'));
            var search = document.getElementById('txSearch');
            var txType = document.getElementById('txType');
            var txDate = document.getElementById('txDate');
            var rowsPerPageEl = document.getElementById('txRows');
            var paginationEl = document.getElementById('txPagination');
            var txCount = document.getElementById('txCount');

            var currentPage = 1;
            function render(){
                var q = (search.value||'').toLowerCase().trim();
                var type = txType.value;
                var month = txDate.value; // yyyy-mm
                var rowsPerPage = parseInt(rowsPerPageEl.value,10) || 10;

                var filtered = rows.filter(function(r){
                    var desc = (r.dataset.desc||'').toLowerCase();
                    var ref = (r.dataset.ref||'').toLowerCase();
                    var ttype = (r.dataset.type||'');
                    var date = r.children[0] ? r.children[0].textContent.trim().slice(0,7) : '';
                    if (q && !(desc.includes(q) || ref.includes(q))) return false;
                    if (type && ttype !== type) return false;
                    if (month && date !== month) return false;
                    return true;
                });

                var total = filtered.length;
                var totalPages = Math.max(1, Math.ceil(total/rowsPerPage));
                if (currentPage > totalPages) currentPage = totalPages;
                rows.forEach(function(r){ r.style.display = 'none'; });
                var start = (currentPage-1)*rowsPerPage;
                var pageRows = filtered.slice(start, start+rowsPerPage);
                pageRows.forEach(function(r){ r.style.display = ''; });

                // pagination
                paginationEl.innerHTML = '';
                var prev = document.createElement('li'); prev.className = 'page-item '+(currentPage===1?'disabled':''); prev.innerHTML = '<a class="page-link" href="#">&laquo;</a>';
                prev.addEventListener('click', function(e){ e.preventDefault(); if(currentPage>1){ currentPage--; render(); } }); paginationEl.appendChild(prev);
                for(var p=1;p<=totalPages;p++){ var li = document.createElement('li'); li.className = 'page-item '+(p===currentPage?'active':''); li.innerHTML = '<a class="page-link" href="#">'+p+'</a>'; (function(page){ li.addEventListener('click', function(e){ e.preventDefault(); currentPage=page; render(); }); })(p); paginationEl.appendChild(li); }
                var next = document.createElement('li'); next.className = 'page-item '+(currentPage===totalPages?'disabled':''); next.innerHTML = '<a class="page-link" href="#">&raquo;</a>'; next.addEventListener('click', function(e){ e.preventDefault(); if(currentPage<totalPages){ currentPage++; render(); } }); paginationEl.appendChild(next);

                txCount.textContent = 'Showing ' + pageRows.length + ' of ' + total;
            }

            [search, txType, txDate, rowsPerPageEl].forEach(function(el){ el.addEventListener('input', function(){ currentPage=1; render(); }); });
            render();
        })();
    </script>
</body>
</html>
