<?php

class QuestionSkeleton {
    protected $question;
    protected $answer;

    public function __construct($question, $answer) {
        $this->question = $question;
        $this->answer = $answer;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

    public function getAnswer() {
        return $this->answer;
    }

    public function setAnswer($answer) {
        $this->answer = $answer;
    }
}
