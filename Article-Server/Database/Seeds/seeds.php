<?php
require_once("../../Connection/connection.php");

$questions = [
    "Hello World?",
    "Is it working?"
];

$answers = [
    "Goodbye World!",
    "Yes! It's Working!"
];

$query = $conn->prepare("SELECT * FROM questions WHERE question = ?");

$insertQuery = $conn->prepare("INSERT INTO questions (question, answer) VALUES (?, ?)");

for ($i = 0; $i < count($questions); $i++) {
    $query->bind_param("s", $questions[$i]);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 0) {
        $insertQuery->bind_param("ss", $questions[$i], $answers[$i]);
        $insertQuery->execute();
    }
}

echo "Seed data inserted successfully.";
?>
