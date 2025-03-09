<?php

include("../../Connection/connection.php");
include("../../Models/user.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['email'], $data['password'])) {
        $email = trim($data['email']);
        $password = trim($data['password']);

        $user = new User('', $email, $password);
        echo $user->signIn();
    } else {
        echo json_encode(["status" => "error", "message" => "Email and password are required."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}

?>