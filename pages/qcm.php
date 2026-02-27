<?php

include '../includes/header.php';
require_once '../config/bdd.php';
require_once '../models/quiz.php';
require_once '../models/question.php';

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

if (!isset($_SESSION['quiz_score']) || $question_number === 0) {
    $_SESSION['quiz_score'] = 0;
    $_SESSION['answered'] = [];
}


$current_quiz = Quiz::getById($qcm_id);
if (!$current_quiz) {
    die("Quiz introuvable.");
}

if (!isset($_SESSION['questions_order']) || ($question_number === 0 && $selected_answer_id === null)) {
    $questions = $current_quiz->getQuestions();
    $questionIds = [];
    foreach ($questions as $question) {
        $questionIds[] = $question->getId();
    }
    shuffle($questionIds);
    $_SESSION['questions_order'] = $questionIds;
}
$questionsOrder = $_SESSION['questions_order'];

$current_question_id = $questionsOrder[$question_number];
$current_question = Question::getById($current_question_id);

$answers = $current_question->getAnswers();

if (!$current_question) {
    die("Question introuvable.");
}

if (!isset($_SESSION['answers_order'])) {
    $_SESSION['answers_order'] = [];
}

if($question_number === 0 && $selected_answer_id === null){
    unset($_SESSION['answers_order']);
}

if (!isset($_SESSION['answers_order']) || !isset($_SESSION['last_question_number']) || $_SESSION['last_question_number'] !== $question_number) {
    $answerIds = [];
    foreach ($answers as $answer) {
        $answerIds[] = $answer->getId();
    }
    shuffle($answerIds);
    $_SESSION['answers_order'] = $answerIds;
    $_SESSION['last_question_number'] = $question_number;
}
$answersOrder = $_SESSION['answers_order'];

$correction_text = null;
if ($selected_answer_id !== null) {
    foreach ($answers as $answer) {
        if ($answer->getId() === $selected_answer_id) {
            if ($answer->getVerite()) {
                $correction_text = "Bonne réponse !";
                $newclass = " correct";
                if (!isset($_SESSION['answered'][$question_number])) {
                    $_SESSION['quiz_score']++;
                    $_SESSION['answered'][$question_number] = true;
                }
            } else {
                $correction_text = "Mauvaise réponse.";
                $newclass = " incorrect";
                $_SESSION['answered'][$question_number] = true;
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
            <span class="qcm-score">Score : <?php echo $_SESSION['quiz_score']; ?>
</span>
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
                foreach ($answersOrder as $answer_id) {
                    $answer = null;
                    foreach ($answers as $a) {
                        if ($a->getId() === $answer_id) {
                            $answer = $a;
                            break;
                        }
                    }
                    if (!$answer) {
                        continue;
                    }
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
        echo '<div class="qcm-correction ' . $newclass . '">
        <h3>' . $correction_text . '</h3>
        <p>' . $current_question->getCorrection() . '</p>
        </div>';
        if ($question_number + 1 < $current_quiz->countQuestions()) {
            echo '<a class="qcm-next-btn" href="qcm.php?id=' . $qcm_id . '&number=' . ($question_number + 1) . '">Question suivante</a>';
        } else {
            $percentage = round(($_SESSION['quiz_score'] / $current_quiz->countQuestions()) * 100);
            echo '<div class="end-game-modal">
                    <div class="end-game-content">
                        <h2>Quiz terminé !</h2>
                        <p>Votre score final : <strong>' . $_SESSION['quiz_score'] . ' / ' . $current_quiz->countQuestions() . '</strong></p>
                        <p>Soit ' . $percentage . '% de réussite</p>
                        <a href="qcm.php?id=' . $qcm_id . '&number=0" class="btn btn-replay">Rejouer</a>
                        <a href="accueil.php" class="btn btn-home">Retour à l\'accueil</a>
                    </div>
                </div>';
            unset($_SESSION['answered']);
            unset($_SESSION['quiz_score']);
            unset($_SESSION['questions_order']);
            unset($_SESSION['answers_order']);
        }
    }
    ?>
</section>


<?php include '../includes/footer.php'; ?>