<?php

require_once './QuestionSkeleton.php';
require_once '../Connection/connection.php';

class Question extends QuestionSkeleton {
    //private $conn;

    public function __construct($question, $answer) {
        parent::__construct($question, $answer);
        global $conn;
        $this->conn = $conn;
    }

    public function createQuestion() {
        $query = "INSERT INTO questions (question, answer) VALUES (?, ?)";
        $result = $this->conn->prepare($query);
        $result->bind_param("ss", $this->question, $this->answer);
        return $result->execute();
    }

    public function deleteQuestion($question) {
        $query = "DELETE FROM questions WHERE question = ?";
        $result = $this->conn->prepare($query);
        $result->bind_param("s", $question);
        return $result->execute();
    }
}
