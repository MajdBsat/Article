<?php

include("../../Connection/connection.php");
include("../../Models/question.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $question = new Question('', '');

    echo $question->getQuestions();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method. Only GET is allowed.',
    ]);
}
?>