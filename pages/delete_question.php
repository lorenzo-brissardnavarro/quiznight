<?php
require_once '../models/question.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: accueil.php");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: accueil.php");
    exit;
}

$question = Question::getById((int)$_GET['id']);

if ($question) {
    $idQuiz = $question->getIdQuiz();
    $answers = $question->getAnswers();
    foreach ($answers as $answer) {
        $answer->deleteReponse();
    }
    $question->deleteQuestion();
    header("Location: edit_quiz.php?id=".$idQuiz);
}