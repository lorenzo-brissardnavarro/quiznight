<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>OtakuQuiz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Young+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
    <header class="navbar">
        <h1 class="logo">OtakuQuiz</h1>
        <nav class="nav-links">
            <ul>
                <?php 
                if(!empty($_SESSION['id'])){
                    echo '
                    <li>
                        <a href="accueil.php">
                            <i class="fa-solid fa-house"></i>
                        </a>
                    </li>
                    <li>
                        <a href="deconnexion.php">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    </li>
                    ';

                }else{
                    echo '
                    <li>
                        <a href="connexion.php">
                            <i class="fa-solid fa-circle-user"></i>
                        </a>
                    </li>
                    ';
                }
                ?>
            </ul>
        </nav>
    </header>
<main>