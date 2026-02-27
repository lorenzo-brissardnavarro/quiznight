<?php
include '../includes/header.php';
require_once '../config/bdd.php';
require_once '../models/question.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: accueil.php");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: accueil.php");
    exit;
}

$question = Question::getById((int)$_GET['id']);

if (!$question) {
    die("Question introuvable");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question->setLibelleQuestion(htmlspecialchars($_POST['libelle']));
    $question->saveQuestion();
    header("Location: edit_quiz.php?id=" . $question->getIdQuiz());
    exit;
}
?>

<form method="POST" class="create-quiz">
    <h2>Modifier Question</h2>
    <input type="text" name="libelle" value="<?php echo $question->getLibelleQuestion(); ?>" required>
    <button type="submit">Modifier</button>
    <?php if($question->getTypeQuestion()=="qcm") echo '<a href="edit_reponses.php?idQuestion=' . $question->getId() . '">Gérer les réponses</a>' ?>
    <a href="edit_quiz.php?id=<?php echo $question->getIdQuiz(); ?>">Retour à la gestion du quiz</a>
</form>



<?php include '../includes/footer.php'; ?>