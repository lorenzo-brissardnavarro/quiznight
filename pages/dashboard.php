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
                <h2><?php echo count($quiz); ?></h2>
            </div>
            <i class="fa-solid fa-trophy"></i>
        </div>
    </div>

    <h2 class="dashboard-title">Mes Quiz</h2>

    <div class="quiz-list">
        <?php foreach($quiz as $q): ?>
        <div class="quiz-card">
            <div class="quiz-card-header">
                <img src="<?php echo $q['image']; ?>" alt="<?php echo $q['titre']; ?>">
                <div class="quiz-info">
                    <div class="quiz-info-text">
                        <h3><?php echo $q['titre']; ?></h3>
                        <p><?php echo $q['description']; ?></p>
                        <p class="questions">5 questions</p>
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
        </div>
        <?php endforeach; ?>
    </div>
</section>


<?php include '../includes/footer.php'; ?>