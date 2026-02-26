<?php
require_once '../models/question.php';

$question = Question::getById((int)$_GET['id']);

if ($question) {
    $idQuiz = $question->getIdQuiz();
    $question->deleteQuestion();
    header("Location: edit_quiz.php?id=".$idQuiz);
}