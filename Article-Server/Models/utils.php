<?php

function successResponse($message): string {
    return json_encode([
        'status' => 'success',
        'message' => $message
    ]);
}

function errorResponse($message): string {
    return json_encode([
        'status' => 'error',
        'message' => $message
    ]);
}

function verifyPassword($password, $hashedPassword)
{
    return hash("sha256", $password) === $hashedPassword;
}

?>