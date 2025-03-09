<?php

include("../../Connection/connection.php");
include("../../Models/user.php");

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if (isset($data["fullname"], $data["email"], $data["password"])) {
        $fullname = trim($data["fullname"]);
        $email = trim($data["email"]);
        $password = trim($data["password"]);

        $user = new User($fullname, $email, $password);
        echo $user->createUser();
    } else {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}

?>