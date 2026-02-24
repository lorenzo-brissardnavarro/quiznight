<?php
include '../includes/header.php';
require_once '../config/bdd.php';
require_once '../models/quiz.php';

$quizList = Quiz::getAll();

?>


<section class="hero">
    <ul class="hero-icons">
        <li>
            <i class="fa-solid fa-bolt"></i>
        </li>
        <li>
            <i class="fa-solid fa-trophy"></i>
        </li>
        <li>
            <i class="fa-solid fa-star"></i>
        </li>
    </ul>
    <h2>Teste ta puissance d’Otaku Ultime</h2>
    <p>Mesure tes connaissances sur les mangas et animes japonais avec nos quiz immersifs !</p>
</section>

<section class="quiz-section">
    <h3>Quiz disponibles</h3>
    <div class="quiz-grid">
        <?php 
        foreach($quizList as $quiz)
            echo '
            <article class="card">
                <img src="../images/' . $quiz->getImage() . '" alt="Quiz image">
                <div class="card-content">
                    <h4>' . $quiz->getTitre() . '</h4>
                    <p>' . $quiz->getDescription() . '</p>
                    <div class="card-content-infos">
                        <p>' . $quiz->countQuestions() .  ' questions</p>
                        <span class="badge ' . strtolower($quiz->getDifficulte()) . '">' . $quiz->getDifficulte() . '</span>
                    </div>
                    <a href="quiz.php?id=' . $quiz->getId() .  '"class="btn">
                        <i class="fa-solid fa-bolt"></i>
                        <p>Jouer</p>
                    </a>
                </div>
            </article>';
        ?>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
