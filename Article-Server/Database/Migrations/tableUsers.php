<?php
require_once("../../Connection/connection.php");

$tableExists = $conn->query("SHOW TABLES LIKE 'users'")->num_rows > 0;

if ($tableExists) {
    return;
} else {
    $sql = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password TEXT NOT NULL
    )";

    $result = $conn->query($sql);
}

?>
