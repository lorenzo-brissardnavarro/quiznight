<?php
include '../includes/header.php';
require_once '../config/bdd.php';
require_once '../models/question.php';
require_once '../models/reponse.php';

$question = Question::getById((int)$_GET['idQuestion']);

if (!$question) {
    die("Question introuvable");
}

$reponses = $question->getAnswers();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_reponses'])) {
    foreach ($_POST['reponses'] as $idRep => $libelle) {
        $rep = Reponse::getReponseById((int)$idRep);
        if ($rep) {
            $rep->setLibelleReponse(htmlspecialchars($libelle));
            $rep->update();
        }
    }
    header("Location: edit_reponses.php?idQuestion=" . $question->getId());
    exit;
}
?>

<form method="POST" class="create-quiz">
    <h2>Modifier les réponses de : <?php echo $question->getLibelleQuestion(); ?></h2>
    <?php
    for ($i = 0; $i < 4; $i++) {
        $rep = $reponses[$i];
        echo '<div>';
        if ($i === 0) {
            echo '<input type="text" name="reponses[' . $rep->getId() . ']" value="' . $rep->getLibelleReponse() . '" required id="correct">';
        } else {
            echo '<input type="text" name="reponses[' . $rep->getId() . ']" value="' . $rep->getLibelleReponse() . '" required>';
        }
        echo '</div>';
    }
    ?>
    <button type="submit" name="update_reponses">Mettre à jour les réponses</button>
    <a href="edit_question.php?id=<?php echo $question->getId(); ?>">Retour à la question</a>
</form>

<?php include '../includes/footer.php'; ?>