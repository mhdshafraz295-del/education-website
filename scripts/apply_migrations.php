<?php

require_once __DIR__ . '/../config/database.php';

$dir = __DIR__ . '/../database/migrations';
$files = glob($dir . '/*.sql');
sort($files);

foreach ($files as $file) {
    $sql = file_get_contents($file);
    if (!$sql) continue;
    if ($connection->multi_query($sql)) {
        
        do { $connection->store_result(); } while ($connection->more_results() && $connection->next_result());
        echo "Applied: " . basename($file) . PHP_EOL;
    } else {
        echo "Failed: " . basename($file) . " - " . $connection->error . PHP_EOL;
    }
}

$connection->close();
