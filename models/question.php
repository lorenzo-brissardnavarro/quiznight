<?php
require_once '../config/bdd.php';
require_once 'reponse.php';

class Question extends BDD {

    private ?int $id;
    private string $libelleQuestion;
    private string $typeQuestion;
    private int $idQuiz;

    public function __construct(string $libelleQuestion, string $typeQuestion, int $idQuiz, ?int $id = null){
        parent::__construct();
        $this->id = $id;
        $this->libelleQuestion = $libelleQuestion;
        $this->typeQuestion = $typeQuestion;
        $this->idQuiz = $idQuiz;
    }

    // -------------------------------------- Getters ------------------------------------

    public function getId(): ?int {
        return $this->id;
    }

    public function getLibelleQuestion(): string {
        return $this->libelleQuestion;
    }

    public function getTypeQuestion(): string {
        return $this->typeQuestion;
    }

    public function getIdQuiz(): int {
        return $this->idQuiz;
    }


    // -------------------------------------- Setters ------------------------------------

    public function setLibelleQuestion(string $newLibelleQuestion): void {
        $this->libelleQuestion = $newLibelleQuestion;
    }

    public function setTypeQuestion(string $newTypeQuestion): void {
        $this->typeQuestion = $newTypeQuestion;
    }

    // -------------------------------------- Méthodes CRUD ------------------------------------

    // Fonction pour créer une question dans BDD
    private function createQuestion(): bool {
        $sql = "INSERT INTO questions (libelleQuestion, typeQuestion, idQuiz) VALUES (:libelleQuestion, :typeQuestion, :idQuiz)";
        $query = $this->pdo->prepare($sql);
        $success = $query->execute([':libelleQuestion' => $this->libelleQuestion, ':typeQuestion' => $this->typeQuestion, ':idQuiz' => $this->idQuiz]);
        if ($success) {
            $this->id = $this->pdo->lastInsertId();
        }
        return $success;
    }

    // Fonction pour modifier une question dans BDD
    private function updateQuestion(): bool {
        if (!$this->id) {
            return false;
        }
        $sql = "UPDATE questions SET libelleQuestion = :libelleQuestion, typeQuestion = :typeQuestion WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':libelleQuestion' => $this->libelleQuestion,':typeQuestion' => $this->typeQuestion,':id' => $this->id]);
    }

    // Fonction pour supprimer une question dans BDD
    public function delete(): bool {
        if (!$this->id) {
            return false;
        }
        $sql = "DELETE FROM questions WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $success = $query->execute([':id' => $this->id]);
        return $success;
    }

    public function saveQuestion(): bool{
        if ($this->id === null) {
            return $this->createQuestion();
        } else {
            return $this->updateQuestion();
        }
    }

    // -------------------------------------- Autres méthodes ------------------------------------

    // Fonction pour récupérer toutes les questions d'un quiz de la BDD
    public static function getByQuizId(int $idQuiz): array {
        $bdd = new BDD();
        $sql = "SELECT * FROM questions WHERE idQuiz = :idQuiz";
        $stmt = $bdd->pdo->prepare($sql);
        $stmt->execute([':idQuiz' => $idQuiz]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $questions = [];
        foreach ($rows as $row) {
            $questions[] = new Question($row['libelleQuestion'], $row['typeQuestion'], $row['idQuiz'], $row['id']);
        }
        return $questions;
    }

    // Fonction pour récupérer une question en particulier à partir de son ID
    public static function getById(int $id): ?Question {
        $bdd = new BDD();
        $sql = "SELECT * FROM questions WHERE id = :id";
        $stmt = $bdd->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row){
            return null;
        }
        return new Question($row['libelleQuestion'], $row['typeQuestion'], $row['idQuiz'], $row['id']);
    }

    // Fonction pour récupérer les réponses d'une question en particulier
    public function getAnswers(): array{
        if (!$this->id) {
            return [];
        }
        $sql = "SELECT * FROM reponses WHERE idQuestion = :idQuestion";
        $query = $this->pdo->prepare($sql);
        $query->execute([':idQuestion' => $this->id]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $reponsesList = [];
        foreach ($results as $row) {
            $reponsesList[] = new Reponse($row['libelleReponse'],$row['verite'],$row['idQuestion'],$row['id']);
        }
        return $reponsesList;
    }

}
