<?php

include("../../Connection/connection.php");
include("../../Models/question.php");

$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $question = new Question('', '');

    $questions = $question->getQuestions();

    if ($questions) {
        echo $questions;
        exit();
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No questions found.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method. Only GET is allowed.',
    ]);
}
?>