<?php
include '../includes/header.php';
require_once '../config/bdd.php';
require_once '../models/user.php';

$error = "";

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $user = new User($_POST['email'], $_POST['password']);
    $result = $user->log_in();
    if ($result === true) {
        header("Location: accueil.php");
        exit;
    } else {
        $error = $result;
    }
}

?>
<section class="container-form">
    <div class="card-form">
        <div class="icon">
            <i class="fa-solid fa-user-check"></i>
        </div>
        <h1>Connexion</h1>
        <p class="subtitle">Viens prouver ta valeur d'otaku !</p>
        <?php 
        if (!empty($error)){
            echo '<p class="form-error">' . $error .  '</p>';
        }
        ?>
        <form method="POST" action="">
            <div class="form-group">
                <div class="form-fiels">
                    <i class="fa-regular fa-envelope"></i>
                    <label for="email">Email</label>
                </div>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <div class="form-fiels">
                    <i class="fa-solid fa-lock"></i>
                    <label for="password">Mot de passe</label>
                </div>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="btn">Se connecter</button>
        </form>
        <div class="bottom-text">
            Pas encore de compte ?
            <a href="inscription.php">S'inscrire</a>
        </div>
    </div>
</section>


<?php include '../includes/footer.php'; ?>