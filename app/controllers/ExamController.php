<?php
class ExamController {
    /**
     * Return all exams as an array
     */
    public function index() {
        require_once __DIR__ . '/../../config/database.php';

        $exams = [];
        $sql = "SELECT id, title, date, duration, marks, status FROM exams ORDER BY date DESC";
        $result = $connection->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $exams[] = $row;
            }
        }
        return $exams;
    }

    /**
     * Handle update POST for an exam
     */
    public function updateExam() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /index.php?page=examination-officer');
            exit;
        }
        if (session_status() === PHP_SESSION_NONE) session_start();

        require_once __DIR__ . '/../../config/database.php';

        $id = intval($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $date = $_POST['date'] ?? '';
        $duration = trim($_POST['duration'] ?? '');
        $marks = intval($_POST['marks'] ?? 0);

        if ($id <= 0 || $title === '' || $date === '') {
            $_SESSION['flash_error'] = 'Invalid input for update.';
            header('Location: /index.php?page=examination-officer');
            exit;
        }

        $stmt = $connection->prepare("UPDATE exams SET title = ?, date = ?, duration = ?, marks = ? WHERE id = ?");
        if (!$stmt) {
            $_SESSION['flash_error'] = 'DB error: ' . $connection->error;
            header('Location: /index.php?page=examination-officer');
            exit;
        }
        $stmt->bind_param('sssii', $title, $date, $duration, $marks, $id);
        if ($stmt->execute()) {
            $_SESSION['flash_success'] = 'Exam updated successfully.';
        } else {
            $_SESSION['flash_error'] = 'DB error: ' . $stmt->error;
        }
        $stmt->close();
        $connection->close();

        header('Location: /index.php?page=examination-officer');
        exit;
    }

    /**
     * Delete an exam by id (GET)
     */
    public function deleteExam() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        require_once __DIR__ . '/../../config/database.php';
        $id = intval($_GET['id'] ?? 0);
        if ($id <= 0) {
            $_SESSION['flash_error'] = 'Invalid exam id for delete.';
            header('Location: /index.php?page=examination-officer');
            exit;
        }
        $stmt = $connection->prepare("DELETE FROM exams WHERE id = ?");
        if (!$stmt) {
            $_SESSION['flash_error'] = 'DB error: ' . $connection->error;
            header('Location: /index.php?page=examination-officer');
            exit;
        }
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            $_SESSION['flash_success'] = 'Exam deleted.';
        } else {
            $_SESSION['flash_error'] = 'DB error: ' . $stmt->error;
        }
        $stmt->close();
        $connection->close();
        header('Location: /index.php?page=examination-officer');
        exit;
    }
}
