<?php
include("../../Connection/connection.php");
include("../../Models/question.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['question'], $data['answer'])) {
        $question = trim($data['question']);
        $answer = trim($data['answer']);

        $newQuestion = new Question($question, $answer);

        if ($newQuestion->createQuestion()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Question added successfully.',
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to add question.',
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Question and answer are required.',
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method. Only POST is allowed.',
    ]);
}
?>