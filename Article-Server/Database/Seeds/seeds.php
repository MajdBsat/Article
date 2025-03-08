<?php
include("../../Connection/connection.php");

$questions = [
    "Hello World?",
    "Is it working?"
];

$answers = [
    "Goodbye World!",
    "Yes! It's Working!"
];

$query = $conn->prepare("INSERT INTO questions (question, answer) VALUES (?, ?)");

for ($i = 0; $i < count($questions); $i++) {
    $query->bind_param("ss", $questions[$i], $answers[$i]);
    $result = $quesry->execute();
}

echo "Seed data inserted successfully.";

$conn->close();
?>
