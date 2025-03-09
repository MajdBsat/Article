<?php
include ("utils.php");
require_once 'QuestionSkeleton.php';
require_once '../../Connection/connection.php';

class Question extends QuestionSkeleton {

    public function __construct($question, $answer) {
        parent::__construct($question, $answer);
        global $conn;
        $this->conn = $conn;
    }

    public function createQuestion() {
        $query = "INSERT INTO questions (question, answer) VALUES (?, ?)";
        $result = $this->conn->prepare($query);
        $result->bind_param("ss", $this->question, $this->answer);

        if ($result->execute()) {
            return successResponse("Question created successfully.");
        } else {
            return errorResponse("Error creating Question: " . $this->conn->error);
        }
    }

    public function deleteQuestion($question) {
        $query = "DELETE FROM questions WHERE question = ?";
        $result = $this->conn->prepare($query);
        $result->bind_param("s", $question);

        if ($result->execute()) {
            return successResponse("Question deleted successfully.");
        } else {
            return errorResponse("Error deleting Question: " . $this->conn->error);
        }
    }

    public function getQuestions() {
        $query = "SELECT * FROM questions";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            $questions = [];
            while ($row = $result->fetch_assoc()) {
                $questions[] = [
                    'question' => $row['question'],
                    'answer' => $row['answer']
                ];
            }
            return json_encode([
                'status' => 'success',
                'message' => 'Questions retrieved successfully.',
                'data' => $questions
            ]);
        } else {
            return errorResponse("No questions found.");
        }
    }
}