<?php

require_once './userSkeleton.php';
require_once '../Connection/connection.php';

class User extends SkeletonUser {
    private $conn;

    public function __construct($full_name, $email, $password) {
        parent::__construct($full_name, $email, $password);
        global $conn;
        $this->conn = $conn;
    }

    public function createUser() {
        $query = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        $result = $this->conn->prepare($query);
        $hashedPassword = hash("sha256", $this->password);
        $result->bind_param("sss", $this->full_name, $this->email, $hashedPassword);
        return $result->execute();
    }

    public function updateUser($email) {
        $query = "UPDATE users SET full_name = ?, password = ? WHERE email = ?";
        $result = $this->conn->prepare($query);
        $hashedPassword = hash("sha256", $this->password);
        $result->bind_param("sss", $this->full_name, $hashedPassword, $email);
        return $result->execute();
    }

    public function deleteUser($email) {
        $query = "DELETE FROM users WHERE email = ?";
        $result = $this->conn->prepare($query);
        $result->bind_param("s", $email);
        return $result->execute();
    }
}
