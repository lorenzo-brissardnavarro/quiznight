<?php

include '../includes/header.php';
require_once '../config/bdd.php';
require_once '../models/quiz.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

$qcm_id = 0;
$question_number = 0;
$selected_answer_id = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['quiz_id'])){
        $qcm_id = (int)$_POST['quiz_id'];
    }
    if(isset($_POST['question_number'])){
        $question_number = (int)$_POST['question_number'];
    }
    if(isset($_POST['answer_id'])){
        $selected_answer_id = (int)$_POST['answer_id'];
    }
    header("Location: qcm.php?id=$qcm_id&number=$question_number&answer=$selected_answer_id");
    exit;
}


if(isset($_GET['id'])){
    $qcm_id = (int)$_GET['id'];
}
if(isset($_GET['number'])){
    $question_number = (int)$_GET['number'];
}
if(isset($_GET['answer'])){
    $selected_answer_id = (int)$_GET['answer'];
}


$current_quiz = Quiz::getById($qcm_id);
if (!$current_quiz) {
    die("Quiz introuvable.");
}

$questionsList = $current_quiz->getQuestions();

if (!isset($questionsList[$question_number])) {
    die("Question introuvable.");
}
$current_question = $questionsList[$question_number];
$answers = $current_question->getAnswers();

$correction_text = null;
if ($selected_answer_id !== null) {
    foreach ($answers as $answer) {
        if ($answer->getId() === $selected_answer_id) {
            if ($answer->getVerite()) {
                $correction_text = "Bonne réponse !";
            } else {
                $correction_text = "Mauvaise réponse.";
            }
        }
    }
}

?>

<section class="qcm-container">
    <div class="qcm-header">
        <h2 class="qcm-title">
            <?php echo $current_quiz->getTitre(); ?>
        </h2>
        <div class="qcm-subtitle">
            <p>Question <?php echo $question_number + 1; ?> / <?php echo $current_quiz->countQuestions(); ?>
            </p>
            <span class="qcm-score">Score : 0</span>
        </div>
    </div>
    <div class="qcm-card">
        <div class="qcm-icon">
            <i class="fa-solid fa-bolt"></i>
            <h3>
                <?php echo htmlspecialchars($current_question->getLibelleQuestion()); ?>
            </h3>
        </div>
        <div class="qcm-info">
            <div class="qcm-info-text">
                <?php
                foreach ($answers as $answer) {
                    $class = "qcm-option";
                    if ($selected_answer_id !== null) {
                        if ($answer->getVerite()) {
                            $class .= " correct";
                        } else {
                            $class .= " incorrect";
                        }
                    }
                    echo '<form method="POST">
                        <input type="hidden" name="quiz_id" value="' . $qcm_id . '">
                        <input type="hidden" name="question_number" value="' . $question_number . '">
                        <input type="hidden" name="answer_id" value="' . $answer->getId() . '">';
                    if ($selected_answer_id !== null) {
                        echo '<button disabled class="' . $class . '">';
                    } else {
                        echo '<button type="submit" class="' . $class . '">';
                    }
                    echo htmlspecialchars($answer->getLibelleReponse()) . '</button>
                    </form>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    if ($correction_text !== null) {
        echo '<div class="qcm-correction">
        <h3>' . $correction_text . '</h3>
        </div>';
        if ($question_number + 1 < $current_quiz->countQuestions()) {
            echo '<a class="qcm-next-btn" href="qcm.php?id=' . $qcm_id . '&number=' . ($question_number + 1) . '">Question suivante</a>';
        } else {
            echo '<p>Voir mon score</p>';
        }
    }
    ?>
</section>


<?php include '../includes/footer.php'; ?>