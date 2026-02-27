<?php
include '../includes/header.php';
require_once '../config/bdd.php';
require_once '../models/question.php';
require_once '../models/reponse.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: accueil.php");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "admin") {
    header("Location: accueil.php");
    exit;
}

$question = Question::getById((int)$_GET['idQuestion']);

if (!$question) {
    die("Question introuvable");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($question->getTypeQuestion() === 'qcm') {
        foreach ($_POST['reponses'] as $index => $libelle) {
            $isTrue = ($index === 0);
            $rep = new Reponse(htmlspecialchars($libelle),$isTrue,$question->getId());
            $rep->saveReponse();
        }
    } else {
        $bonne = $_POST['bonne_reponse'];
        $repVrai = new Reponse("Vrai", $bonne === "vrai", $question->getId());
        $repFaux = new Reponse("Faux", $bonne === "faux", $question->getId());
        $repVrai->saveReponse();
        $repFaux->saveReponse();
    }
    header("Location: add_questions.php?idQuiz=" . $question->getIdQuiz());
    exit;
}
?>

<form method="POST" class="create-quiz">
    <h2>Réponses pour : <?php echo $question->getLibelleQuestion(); ?></h2>
<?php

if ($question->getTypeQuestion() === 'qcm') {
    for ($i = 0; $i < 4; $i++) {
        echo '<div>';
        if($i === 0){
            echo '<input type="text" name="reponses[' . $i . ']" placeholder="Saisissez la bonne réponse" required id="correct">';
        } else {
            echo '<input type="text" name="reponses[' . $i . ']" placeholder="Réponse ' . ($i + 1) . '" required>';
        }
        echo '</div>';
    }

} else {
    echo '<label><input type="radio" name="bonne_reponse" value="vrai" required id="radio"> Vrai</label>
        <label><input type="radio" name="bonne_reponse" value="faux" id="radio"> Faux</label>';
}
echo '<button type="submit">Enregistrer les réponses</button>
    </form>';
?>

<?php include '../includes/footer.php'; ?>