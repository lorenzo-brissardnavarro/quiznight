<?php
require_once '../models/question.php';

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