<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$flash_success = $_SESSION['flash_success'] ?? null;
$flash_error = $_SESSION['flash_error'] ?? null;
$undo_book = $_SESSION['undo_book'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error'], $_SESSION['undo_book']);
$books = $books ?? [];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library Officer — Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <nav id="sidebar" class="bg-primary text-white">
            <div class="sidebar-header py-4 px-3 text-center">
                <h5 class="mb-0">Library Officer</h5>
                <small class="text-white-50">Manage Books & Members</small>
            </div>
            <ul class="nav flex-column px-2">
                <li class="nav-item mb-1"><a class="nav-link text-white" href="#">Dashboard</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="#books">Books</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="#members">Members</a></li>
                <li class="nav-item mb-1"><a class="nav-link text-white" href="#borrowed">Borrowed</a></li>
                <li class="nav-item mt-3"><a class="nav-link text-white" href="#settings">Settings</a></li>
            </ul>
        </nav>

        <div id="page-content" class="flex-grow-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-outline-secondary" id="sidebarToggle">☰</button>
                    <div class="ms-auto d-flex align-items-center">
                        <span class="me-3 d-none d-md-inline">Welcome, <strong><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Officer'); ?></strong></span>
                        <a class="btn btn-sm btn-outline-primary" href="#">Profile</a>
                    </div>
                </div>
            </nav>

            <?php if ($flash_success): ?>
                <div class="container-fluid mt-3">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($flash_success); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>

            
            <?php if (!empty($undo_book)): ?>
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
                    <div id="undoToast" class="toast" role="status" aria-live="polite" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">Book archived</strong>
                            <small class="text-muted">just now</small>
                            <button type="button" class="btn-close ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            <?php echo htmlspecialchars($undo_book['title'] ?? ''); ?>
                            <div class="mt-2 pt-2 border-top">
                                <a href="/index.php?page=book_restore&id=<?php echo urlencode($undo_book['id']); ?>" class="btn btn-sm btn-success">Undo</a>
                                <a href="/index.php?page=library-officer" class="btn btn-sm btn-link">Dismiss</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($flash_error): ?>
                <div class="container-fluid mt-3">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($flash_error); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>

            <main class="container-fluid p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h2 class="mb-0">Library Dashboard</h2>
                        <small class="text-muted">Overview of library resources</small>
                    </div>
                    <div>
                        <a class="btn btn-outline-secondary me-2" href="/index.php?page=library-archived">Archived</a>
                        <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addBookModal">Add Book</button>
                        <button class="btn btn-outline-secondary">Reports</button>
                    </div>
                </div>

            
                <div class="row g-2 align-items-center mb-3" role="region" aria-label="Books filters">
                    <div class="col-md-5">
                        <input id="bookSearch" type="search" class="form-control" placeholder="Search by title, author or ISBN" aria-label="Search books">
                    </div>
                    <div class="col-md-3">
                        <select id="filterCategory" class="form-select" aria-label="Filter by category">
                            <option value="">All categories</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select id="filterAvail" class="form-select" aria-label="Filter by availability">
                            <option value="">All</option>
                            <option value="1">Available</option>
                            <option value="0">Borrowed</option>
                        </select>
                    </div>
                    <div class="col-md-2 text-end">
                        <label class="me-2">Rows:
                            <select id="rowsPerPage" class="form-select d-inline-block" style="width:auto" aria-label="Rows per page">
                                <option value="10">10</option>
                                <option value="25">25</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">Total Books</h6>
                                        <h3 class="card-text">8,420</h3>
                                    </div>
                                    <div class="align-self-center text-primary">
                                        <i class="bi bi-book" style="font-size:28px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h6 class="card-title">Borrowed</h6>
                                <h3 class="card-text text-warning">136</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h6 class="card-title">Overdue</h6>
                                <h3 class="card-text text-danger">18</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h6 class="card-title">Members</h6>
                                <h3 class="card-text">3,250</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">Books</h5>
                            <small class="text-muted">Latest added</small>
                        </div>

                        <div class="table-responsive">
                            <table id="booksTable" class="table table-hover align-middle" role="table" aria-label="Books table">
                                <thead>
                                    <tr>
                                        <th>ISBN</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Category</th>
                                        <th>Availability</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($books) && is_array($books)): ?>
                                        <?php foreach ($books as $b): ?>
                                            <tr data-isbn="<?php echo htmlspecialchars($b['isbn']); ?>" data-title="<?php echo htmlspecialchars($b['title']); ?>" data-author="<?php echo htmlspecialchars($b['author']); ?>" data-category="<?php echo htmlspecialchars($b['category']); ?>" data-available="<?php echo htmlspecialchars($b['available']); ?>">
                                                <td><?php echo htmlspecialchars($b['isbn'] ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($b['title'] ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($b['author'] ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($b['category'] ?? ''); ?></td>
                                                <td><?php echo ($b['available'] ?? 0) ? '<span class="badge bg-success">Available</span>' : '<span class="badge bg-secondary">Borrowed</span>'; ?></td>
                                                <td class="text-end">
                                                    <button class="btn btn-sm btn-outline-primary edit-book-btn" data-bs-toggle="tooltip" title="Edit"
                                                        data-id="<?php echo htmlspecialchars($b['id']); ?>"
                                                        data-isbn="<?php echo htmlspecialchars($b['isbn']); ?>"
                                                        data-title="<?php echo htmlspecialchars($b['title']); ?>"
                                                        data-author="<?php echo htmlspecialchars($b['author']); ?>"
                                                        data-category="<?php echo htmlspecialchars($b['category']); ?>"
                                                        data-available="<?php echo htmlspecialchars($b['available']); ?>"
                                                    ><i class="bi bi-pencil"></i></button>
                                                    <a class="btn btn-sm btn-outline-danger ms-1" href="/index.php?page=book_delete&id=<?php echo urlencode($b['id']); ?>" onclick="return confirm('Archive this book? It will be hidden from lists.');" data-bs-toggle="tooltip" title="Archive"><i class="bi bi-archive"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td>978-3-16-148410-0</td>
                                            <td>Intro to Modern PHP</td>
                                            <td>Jane Doe</td>
                                            <td>Programming</td>
                                            <td><span class="badge bg-success">Available</span></td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></button>
                                                <a class="btn btn-sm btn-outline-danger ms-1" href="#" onclick="return confirm('Archive this book? It will be hidden from lists.');"><i class="bi bi-archive"></i></a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted" id="booksCount">Showing 0 of 0</div>
                            <nav aria-label="Books pagination">
                                <ul class="pagination mb-0" id="booksPagination"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addBookForm" method="post" action="/index.php?page=book_create">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Book</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label">ISBN</label>
                            <input name="isbn" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Title</label>
                            <input name="title" class="form-control" required>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label">Author</label>
                                <input name="author" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <input name="category" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="editBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editBookForm" method="post" action="/index.php?page=book_update">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Book</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editBookId">
                        <div class="mb-2">
                            <label class="form-label">ISBN</label>
                            <input name="isbn" id="editBookIsbn" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Title</label>
                            <input name="title" id="editBookTitle" class="form-control" required>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label">Author</label>
                                <input name="author" id="editBookAuthor" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <input name="category" id="editBookCategory" class="form-control">
                            </div>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="editBookAvailable" name="available">
                            <label class="form-check-label" for="editBookAvailable">Available</label>
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
        
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });

        
        function initEditButtons() {
            document.querySelectorAll('.edit-book-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    document.getElementById('editBookId').value = this.dataset.id || '';
                    document.getElementById('editBookIsbn').value = this.dataset.isbn || '';
                    document.getElementById('editBookTitle').value = this.dataset.title || '';
                    document.getElementById('editBookAuthor').value = this.dataset.author || '';
                    document.getElementById('editBookCategory').value = this.dataset.category || '';
                    document.getElementById('editBookAvailable').checked = this.dataset.available === '1' || this.dataset.available === 'true';

                    var editModal = new bootstrap.Modal(document.getElementById('editBookModal'));
                    editModal.show();
                });
            });
        }

        
        (function(){
            var table = document.getElementById('booksTable');
            if (!table) return;
            var tbody = table.tBodies[0];
            var rows = Array.from(tbody.querySelectorAll('tr'));
            var search = document.getElementById('bookSearch');
            var filterCategory = document.getElementById('filterCategory');
            var filterAvail = document.getElementById('filterAvail');
            var rowsPerPageEl = document.getElementById('rowsPerPage');
            var paginationEl = document.getElementById('booksPagination');
            var booksCount = document.getElementById('booksCount');

            
            var categories = new Set();
            rows.forEach(function(r){ if (r.dataset.category) categories.add(r.dataset.category); });
            categories.forEach(function(c){ var opt = document.createElement('option'); opt.value=c; opt.textContent=c; filterCategory.appendChild(opt); });

            var currentPage = 1;
            function render() {
                var q = (search.value || '').toLowerCase().trim();
                var cat = filterCategory.value;
                var avail = filterAvail.value;
                var rowsPerPage = parseInt(rowsPerPageEl.value,10) || 10;

                var filtered = rows.filter(function(r){
                    var title = (r.dataset.title||'').toLowerCase();
                    var author = (r.dataset.author||'').toLowerCase();
                    var isbn = (r.dataset.isbn||'').toLowerCase();
                    if (q && !(title.includes(q) || author.includes(q) || isbn.includes(q))) return false;
                    if (cat && r.dataset.category !== cat) return false;
                    if (avail !== '' && r.dataset.available !== avail) return false;
                    return true;
                });

                var total = filtered.length;
                var totalPages = Math.max(1, Math.ceil(total / rowsPerPage));
                if (currentPage > totalPages) currentPage = totalPages;

                rows.forEach(function(r){ r.style.display = 'none'; });
                var start = (currentPage-1)*rowsPerPage;
                var pageRows = filtered.slice(start, start+rowsPerPage);
                pageRows.forEach(function(r){ r.style.display = ''; });

                
                paginationEl.innerHTML = '';
                var prev = document.createElement('li'); prev.className='page-item '+(currentPage===1?'disabled':''); prev.innerHTML='<a class="page-link" href="#" aria-label="Previous">&laquo;</a>';
                prev.addEventListener('click', function(e){ e.preventDefault(); if(currentPage>1){ currentPage--; render(); } });
                paginationEl.appendChild(prev);

                for (var p=1;p<=totalPages;p++){
                    var li = document.createElement('li'); li.className='page-item '+(p===currentPage?'active':''); li.innerHTML='<a class="page-link" href="#">'+p+'</a>';
                    (function(page){ li.addEventListener('click', function(e){ e.preventDefault(); currentPage = page; render(); }); })(p);
                    paginationEl.appendChild(li);
                }

                var next = document.createElement('li'); next.className='page-item '+(currentPage===totalPages?'disabled':''); next.innerHTML='<a class="page-link" href="#" aria-label="Next">&raquo;</a>';
                next.addEventListener('click', function(e){ e.preventDefault(); if(currentPage<totalPages){ currentPage++; render(); } });
                paginationEl.appendChild(next);

                booksCount.textContent = 'Showing ' + (pageRows.length) + ' of ' + total;
            }

            
            [search, filterCategory, filterAvail, rowsPerPageEl].forEach(function(el){ el.addEventListener('input', function(){ currentPage=1; render(); }); });

            render();
            initEditButtons();

            
            var undoToastEl = document.getElementById('undoToast');
            if (undoToastEl) {
                var toast = new bootstrap.Toast(undoToastEl, { delay: 8000 });
                toast.show();
            }
        })();

    </script>
</body>
</html>
