<?php
require_once("../../Connection/connection.php");

$tableExists = $conn->query("SHOW TABLES LIKE 'questions'")->num_rows > 0;

if ($tableExists) {
    return;
} else {
    $sql = "CREATE TABLE questions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        question TEXT NOT NULL,
        answer TEXT NOT NULL
    )";

    $result = $conn->query($sql);
}
?>
