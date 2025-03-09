<?php

function successResponse($message, $data = []): string {
    return json_encode([
        'status' => 'success',
        'message' => $message,
        'data' => $data
    ]);
}

function errorResponse($message, $data = []): string {
    return json_encode([
        'status' => 'error',
        'message' => $message,
        'data' => $data
    ]);
}

?>