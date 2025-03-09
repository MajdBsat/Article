<?php
include ("utils.php");
include ("../../Connection/connection.php");
require_once ("userSkeleton.php");
require_once ("../../Database/Migrations/tableUsers.php");
require_once ("../../Database/Migrations/tableQuestions.php");
require_once ("../../Database/Seeds/seeds.php");

class User extends SkeletonUser {

    public function __construct($full_name = '', $email, $password) {
        parent::__construct($full_name, $email, $password);
        global $conn;
        $this->conn = $conn;
    }

    public function createUser() {

        $query = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $query->bind_param("s", $this->email);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            return errorResponse("User already exists");
        }
        $query->close();

        $query = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
        $result = $this->conn->prepare($query);
        $hashedPassword = hash("sha256", $this->password);
        $result->bind_param("sss", $this->full_name, $this->email, $hashedPassword);

        if ($result->execute()) {
            return successResponse("User created successfully.");
        } else {
            return errorResponse("Error creating user: " . $this->conn->error);
        }
    }

    public function signIn()
    {
        if (empty($this->email) || empty($this->password)) {
            return errorResponse("Missing field is required.");
        }

        $query = $this->conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $query->bind_param("s", $this->email);
        $query->execute();
        $result = $query->get_result();
        $user = $result->fetch_assoc();

        if ($user && verifyPassword($this->password, $user["password"])) {
            return successResponse("Sign in successful", ["id" => $user["id"], "email" => $this->email]);
        } else {
            return errorResponse("Wrong Email or Password");
        }
    }

    public function updateUser($email) {
        $query = "UPDATE users SET full_name = ?, password = ? WHERE email = ?";
        $result = $this->conn->prepare($query);
        $hashedPassword = hash("sha256", $this->password);
        $result->bind_param("sss", $this->full_name, $hashedPassword, $email);

        if ($result->execute()) {
            return successResponse("User created successfully.");
        } else {
            return errorResponse("Error creating user: " . $this->conn->error);
        }
    }

    public function deleteUser($email) {
        $query = "DELETE FROM users WHERE email = ?";
        $result = $this->conn->prepare($query);
        $result->bind_param("s", $email);

        if ($result->execute()) {
            return successResponse("User created successfully.");
        } else {
            return errorResponse("Error creating user: " . $this->conn->error);
        }
    }
}
