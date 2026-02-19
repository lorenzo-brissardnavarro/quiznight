<?php
include '../includes/header.php';

$quiz = [
    [
        "titre" => "Fairy Tail",
        "description" => "As-tu la magie nécessaire pour rejoindre Fairy Tail ? Prouve ta valeur avec ce quiz !",
        "image" => "../images/fairytail.jpg",
        "difficulte" => "Moyen",
        "badge" => "medium"
    ],
    [
        "titre" => "Kuroko's Basket",
        "description" => "As-tu le talent pour entrer dans la Génération Miracle ? Montre-nous ton niveau !",
        "image" => "../images/kurokosbasket.jpg",
        "difficulte" => "Moyen",
        "badge" => "medium"
    ],
    [
        "titre" => "Card Captor Sakura",
        "description" => "Es-tu prêt(e) à capturer les cartes de Clow ? Prouve ta magie dans ce quiz !",
        "image" => "../images/cardcaptorsakura.jpeg",
        "difficulte" => "Difficile",
        "badge" => "hard"
    ],
    [
        "titre" => "Dragon Ball Z",
        "description" => "As-tu la puissance d’un Super Saiyan ? Teste ton niveau dans ce quiz ultime !",
        "image" => "../images/dragonballz.jpg",
        "difficulte" => "Facile",
        "badge" => "easy"
    ],
    [
        "titre" => "Eyeshield 21",
        "description" => "As-tu la vitesse d’Eyeshield 21 ? Lance-toi et marque un touchdown avec ce quiz !",
        "image" => "../images/eyeshield21.jpeg",
        "difficulte" => "Difficile",
        "badge" => "hard"
    ],
    [
        "titre" => "Assassination Classroom",
        "description" => "Aurais-tu réussi à éliminer Koro-sensei ? Teste tes compétences dès maintenant !",
        "image" => "../images/assassinationclassroom.jpg",
        "difficulte" => "Facile",
        "badge" => "easy"
    ]
];

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
        foreach($quiz as $q)
            echo '
            <article class="card">
                <img src="' . $q["image"] . '" alt="Quiz image">
                <div class="card-content">
                    <h4>' . $q["titre"] . '</h4>
                    <p>' . $q["description"] . '</p>
                    <div class="card-content-infos">
                        <p>5 questions</p>
                        <span class="badge ' . $q["badge"] . '">' . $q["difficulte"] . '</span>
                    </div>
                    <a href="quiz.php" class="btn">
                        <i class="fa-solid fa-bolt"></i>
                        <p>Jouer</p>
                    </a>
                </div>
            </article>';
        ?>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
