<?php

include '../includes/header.php';
require_once '../config/bdd.php';
require_once '../models/quiz.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: accueil.php");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['admin'] !== "admin") {
    header("Location: accueil.php");
    exit;
}

$quizList = Quiz::getAll();


?>
<section class="dashboard">
    <div class="top-bar">
        <div>
            <h1>Dashboard Admin</h1>
            <p>Gérer vos quiz et créez de nouveaux défis pour la communauté !</p>
        </div>
        <a href="#" class="create-btn">
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
                                <a href="#" class="modify-btn">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <p>Modifier</p>
                                </a>
                                <a href="#" class="delete-btn">
                                    <i class="fa-solid fa-trash"></i>
                                    <p>Supprimer</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>';
        }
        ?>
    </div>
</section>


<?php include '../includes/footer.php'; ?>