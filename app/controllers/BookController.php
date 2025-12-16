<?php
class BookController {
    public function index() {
        require_once __DIR__ . '/../../config/database.php';
        $books = [];
        $sql = "SELECT id, isbn, title, author, category, available FROM books WHERE COALESCE(deleted,0)=0 ORDER BY id DESC LIMIT 50";
        $result = $connection->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
        }
        return $books;
    }

    public function createBook() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /index.php?page=library-officer');
            exit;
        }
        if (session_status() === PHP_SESSION_NONE) session_start();
        require_once __DIR__ . '/../../config/database.php';

        $isbn = trim($_POST['isbn'] ?? '');
        $title = trim($_POST['title'] ?? '');
        $author = trim($_POST['author'] ?? '');
        $category = trim($_POST['category'] ?? '');

        if ($isbn === '' || $title === '') {
            $_SESSION['flash_error'] = 'ISBN and Title are required.';
            header('Location: /index.php?page=library-officer');
            exit;
        }

        $stmt = $connection->prepare("INSERT INTO books (isbn, title, author, category, available) VALUES (?, ?, ?, ?, 1)");
        if (!$stmt) {
            $_SESSION['flash_error'] = 'DB error: ' . $connection->error;
            header('Location: /index.php?page=library-officer');
            exit;
        }
        $stmt->bind_param('ssss', $isbn, $title, $author, $category);
        if ($stmt->execute()) {
            $_SESSION['flash_success'] = 'Book added successfully.';
        } else {
            $_SESSION['flash_error'] = 'DB error: ' . $stmt->error;
        }
        $stmt->close();
        $connection->close();
        header('Location: /index.php?page=library-officer');
        exit;
    }

    public function updateBook() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /index.php?page=library-officer');
            exit;
        }
        if (session_status() === PHP_SESSION_NONE) session_start();
        require_once __DIR__ . '/../../config/database.php';

        $id = intval($_POST['id'] ?? 0);
        $isbn = trim($_POST['isbn'] ?? '');
        $title = trim($_POST['title'] ?? '');
        $author = trim($_POST['author'] ?? '');
        $category = trim($_POST['category'] ?? '');
        $available = isset($_POST['available']) ? 1 : 0;

        if ($id <= 0 || $isbn === '' || $title === '') {
            $_SESSION['flash_error'] = 'Invalid input for update.';
            header('Location: /index.php?page=library-officer');
            exit;
        }

        $stmt = $connection->prepare("UPDATE books SET isbn = ?, title = ?, author = ?, category = ?, available = ? WHERE id = ?");
        if (!$stmt) {
            $_SESSION['flash_error'] = 'DB error: ' . $connection->error;
            header('Location: /index.php?page=library-officer');
            exit;
        }
        $stmt->bind_param('ssssii', $isbn, $title, $author, $category, $available, $id);
        if ($stmt->execute()) {
            $_SESSION['flash_success'] = 'Book updated successfully.';
        } else {
            $_SESSION['flash_error'] = 'DB error: ' . $stmt->error;
        }
        $stmt->close();
        $connection->close();
        header('Location: /index.php?page=library-officer');
        exit;
    }

    public function deleteBook() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        require_once __DIR__ . '/../../config/database.php';

        $id = intval($_GET['id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['flash_error'] = 'Invalid book id.';
            header('Location: /index.php?page=library-officer');
            exit;
        }

        // fetch title for undo
        $title = '';
        $stmt = $connection->prepare("SELECT title FROM books WHERE id = ? LIMIT 1");
        if ($stmt) {
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                $res = $stmt->get_result();
                $row = $res->fetch_assoc();
                $title = $row['title'] ?? '';
            }
            $stmt->close();
        }

        // Soft-delete: mark as archived
        $stmt = $connection->prepare("UPDATE books SET deleted = 1 WHERE id = ?");
        if (!$stmt) {
            $_SESSION['flash_error'] = 'DB error: ' . $connection->error;
            header('Location: /index.php?page=library-officer');
            exit;
        }
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            $_SESSION['flash_success'] = 'Book archived.';
            // store undo info in session for toast
            $_SESSION['undo_book'] = ['id' => $id, 'title' => $title];
        } else {
            $_SESSION['flash_error'] = 'DB error: ' . $stmt->error;
        }
        $stmt->close();
        $connection->close();
        header('Location: /index.php?page=library-officer');
        exit;
    }

    public function archived() {
        require_once __DIR__ . '/../../config/database.php';
        $books = [];
        $sql = "SELECT id, isbn, title, author, category, available FROM books WHERE COALESCE(deleted,0)=1 ORDER BY id DESC";
        $result = $connection->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
        }
        return $books;
    }

    public function restoreBook() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        require_once __DIR__ . '/../../config/database.php';

        $id = intval($_GET['id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['flash_error'] = 'Invalid book id.';
            header('Location: /index.php?page=library-archived');
            exit;
        }

        $stmt = $connection->prepare("UPDATE books SET deleted = 0 WHERE id = ?");
        if (!$stmt) {
            $_SESSION['flash_error'] = 'DB error: ' . $connection->error;
            header('Location: /index.php?page=library-archived');
            exit;
        }
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            $_SESSION['flash_success'] = 'Book restored.';
        } else {
            $_SESSION['flash_error'] = 'DB error: ' . $stmt->error;
        }
        $stmt->close();
        $connection->close();
        header('Location: /index.php?page=library-archived');
        exit;
    }
}
