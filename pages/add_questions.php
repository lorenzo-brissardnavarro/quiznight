<?php
include '../includes/header.php';
require_once '../config/bdd.php';
require_once '../models/quiz.php';
require_once '../models/question.php';

$quiz = Quiz::getById((int)$_GET['idQuiz']);

if (!$quiz) {
    die("Quiz introuvable");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = new Question(htmlspecialchars($_POST['libelle']), $_POST['type'],$_POST["correction"],$quiz->getId());
    $question->saveQuestion();
    header("Location: add_answers.php?idQuestion=" . $question->getId());
    exit;
}
?>

<form method="POST" class="create-quiz">
    <h2>Ajouter une question au quiz : <?php echo $quiz->getTitre(); ?></h2>
    <input type="text" name="libelle" placeholder="Libellé question" required>
    <select name="type">
        <option value="qcm">QCM</option>
        <option value="vf">Vrai / Faux</option>
    </select>
    <textarea name="correction" placeholder="Saisissez la phrase de correction de la question"></textarea>
    <button type="submit">Créer la question</button>
    <section>
        <h3>Questions existantes :</h3>
        <ul>
        <?php
        $questions = $quiz->getQuestions();

        foreach ($questions as $q) {
            echo '<li>' . htmlspecialchars($q->getLibelleQuestion()) . '</li>';
        }
        ?>
        </ul>
    </section>
</form>





<?php include '../includes/footer.php'; ?>