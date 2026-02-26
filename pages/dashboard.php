<?php

include '../includes/header.php';
require_once '../config/bdd.php';
require_once '../models/quiz.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: accueil.php");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: accueil.php");
    exit;
}

$quizList = Quiz::getAll();

if (!empty($_POST['delete_id'])) {
    $deleteQuiz = Quiz::getById($_POST['delete_id']);
    if ($deleteQuiz) {
        $questionsList = $deleteQuiz->getQuestions();
        foreach ($questionsList as $question) {
            $answers = $question->getAnswers();
            foreach ($answers as $answer) {
                $answer->deleteReponse();
            }
            $question->deleteQuestion();
        }
        $success = $deleteQuiz->delete();
        if ($success) {
            header("Location: dashboard.php");
            exit;
        } else {
            echo "Erreur lors de la suppression du quiz.";
        }
    } else {
        echo "Quiz introuvable.";
    }
}

?>
<section class="dashboard">
    <div class="top-bar">
        <div>
            <h1>Dashboard Admin</h1>
            <p>Gérer vos quiz et créez de nouveaux défis pour la communauté !</p>
        </div>
        <a href="create_quiz.php" class="create-btn">
            <i class="fa-solid fa-circle-plus"></i>
            <p>Créer un Quiz</p>
        </a>
    </div>

    <div class="stats">
        <div class="stat-card">
            <div>
                <p>Total Quiz</p>
                <h2><?php echo Quiz::countAll(); ?></h2>
            </div>
            <i class="fa-solid fa-trophy"></i>
        </div>
    </div>

    <h2 class="dashboard-title">Mes Quiz</h2>

    <div class="quiz-list">
        <?php
        foreach($quizList as $quiz) {
            echo '<div class="quiz-card">
                    <div class="quiz-card-header">
                        <img src="../images/' . $quiz->getImage() . '" alt="' . $quiz->getTitre() . '">
                        <div class="quiz-info">
                            <div class="quiz-info-text">
                                <h3>' . $quiz->getTitre() . '</h3>
                                <p>' . $quiz->getDescription() . '</p>
                                <p class="questions">' . $quiz->countQuestions() .  ' questions</p>
                            </div>
                            <div class="quiz-actions">
                                <a href="edit_quiz.php?id=' . $quiz->getId() . '" class="modify-btn">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <p>Modifier</p>
                                </a>
                                <form method="POST">
                                    <input type="hidden" name="delete_id" value="' . $quiz->getId() . '">
                                    <button type="submit" class="delete-btn">
                                        <i class="fa-solid fa-trash"></i>
                                        <p>Supprimer</p>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        ?>
    </div>
</section>


<?php include '../includes/footer.php'; ?>