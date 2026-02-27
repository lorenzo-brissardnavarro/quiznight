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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['difficulte']) && !empty($_FILES)){
        $quiz = new Quiz(htmlspecialchars($_POST['titre']),htmlspecialchars($_POST['description']),"",$_POST['difficulte']);
        $quiz->imageProcessing($_FILES);
        $quiz->create();
        header("Location: add_questions.php?id=" . $quiz->getId());
        exit;
    }
}
?>

<form method="POST" enctype="multipart/form-data" class="create-quiz">
    <h2>Créer un Quiz</h2>
    <input type="text" name="titre" placeholder="Titre" required>
    <textarea name="description" placeholder="Description"></textarea>
    <select name="difficulte">
        <option value="facile">Facile</option>
        <option value="moyen">Moyen</option>
        <option value="difficile">Difficile</option>
    </select>
    <input type="file" name="image" accept="image/png, image/jpeg, image/webp">
    <button type="submit">Créer le quiz</button>
</form>

<?php include '../includes/footer.php'; ?>