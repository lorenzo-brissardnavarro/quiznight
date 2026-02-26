<?php
include '../includes/header.php';
require_once '../config/bdd.php';
require_once '../models/question.php';

$question = Question::getById((int)$_GET['id']);

if (!$question) {
    die("Question introuvable");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question->setLibelleQuestion(htmlspecialchars($_POST['libelle']));
    $question->setTypeQuestion($_POST['type']);
    $question->saveQuestion();
    header("Location: edit_quiz.php?id=" . $question->getIdQuiz());
    exit;
}
?>

<form method="POST" class="create-quiz">
    <h2>Modifier Question</h2>
    <input type="text" name="libelle" value="<?php echo $question->getLibelleQuestion(); ?>" required>
    <select name="type">
        <option value="qcm" <?php if($question->getTypeQuestion()=="qcm") echo "selected"; ?>>QCM</option>
        <option value="vf" <?php if($question->getTypeQuestion()=="vf") echo "selected"; ?>>Vrai/Faux</option>
    </select>
    <button type="submit">Modifier</button>
    <?php if($question->getTypeQuestion()=="qcm") echo '<a href="edit_reponses.php?idQuestion=' . $question->getId() . '">Gérer les réponses</a>' ?>
</form>



<?php include '../includes/footer.php'; ?>