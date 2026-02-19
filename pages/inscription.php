<?php
include '../includes/header.php';


?>
<section class="container-form">
    <div class="card-form">
        <div class="icon">
            <i class="fa-solid fa-user-plus"></i>
        </div>
        <h1>Inscription</h1>
        <p class="subtitle">Rejoins l’arène des otakus !</p>
        <form>
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
            <div class="form-group">
                <div class="form-fiels">
                    <i class="fa-solid fa-lock"></i>
                    <label for="confirm-password">Confirmation du mot de passe</label>
                </div>
                <input type="password" name="confirm-password" id="confirm-password" required>
            </div>
            <button type="submit" class="btn">S’inscrire</button>
        </form>
        <div class="bottom-text">
            Vous êtes déjà inscrit ?
            <a href="connexion.php">Se connecter</a>
        </div>
    </div>
</section>


<?php include '../includes/footer.php'; ?>