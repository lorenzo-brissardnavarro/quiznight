<?php
include '../includes/header.php';
require_once '../config/bdd.php';
require_once '../models/quiz.php';

$quiz = Quiz::getById((int)$_GET['id']);

if (!$quiz) {
    die("Quiz introuvable");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quiz->setTitre(htmlspecialchars($_POST['titre']));
    $quiz->setDescription(htmlspecialchars($_POST['description']));
    $quiz->setDifficulte($_POST['difficulte']);
    $quiz->update();
    header("Location: edit_quiz.php?id=" . $quiz->getId());
    exit;
}
?>



<form method="POST" class="create-quiz">
    <h2>Modifier Quiz</h2>
    <input type="text" name="titre" value="<?php echo $quiz->getTitre(); ?>" required>
    <textarea name="description"><?php echo $quiz->getDescription(); ?></textarea>

    <select name="difficulte">
        <option value="facile" <?php if($quiz->getDifficulte()=="Facile") echo "selected"; ?>>Facile</option>
        <option value="moyen" <?php if($quiz->getDifficulte()=="Moyen") echo "selected"; ?>>Moyen</option>
        <option value="difficile" <?php if($quiz->getDifficulte()=="Difficile") echo "selected"; ?>>Difficile</option>
    </select>
    <button type="submit">Mettre à jour</button>
    <section>
        <h3>Questions</h3>
        <ul>
        <?php
        foreach ($quiz->getQuestions() as $question) {
            echo "<li class='questions-list'>";
            echo $question->getLibelleQuestion();
            echo " 
            <a href='edit_question.php?id=".$question->getId()."'>Modifier</a> 
            <a href='delete_question.php?id=".$question->getId()."'>Supprimer</a>";
            echo "</li>";
        }
        ?> 
        </ul>
        <a href="add_questions.php?idQuiz=<?php echo $quiz->getId(); ?>">Ajouter une question</a>
    </section>
</form>




<?php include '../includes/footer.php'; ?>