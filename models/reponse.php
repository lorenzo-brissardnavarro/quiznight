<?php
require_once '../config/bdd.php';

class Reponse extends BDD {

    private ?int $id;
    private string $libelleReponse;
    private bool $verite;
    private int $idQuestion;

    public function __construct(string $libelleReponse, bool $verite, int $idQuestion, ?int $id = null){
        parent::__construct();
        $this->id = $id;
        $this->libelleReponse = $libelleReponse;
        $this->verite = $verite;
        $this->idQuestion = $idQuestion;
    }

    // -------------------------------------- Getters ------------------------------------

    public function getId(): ?int {
        return $this->id;
    }

    public function getLibelleReponse(): string {
        return $this->libelleReponse;
    }

    public function getVerite(): bool {
        return $this->verite;
    }

    public function getIdQuestion(): int {
        return $this->idQuestion;
    }


    // -------------------------------------- Setters ------------------------------------

    public function setLibelleReponse(string $newLibelleReponse): void {
        $this->libelleReponse = $newLibelleReponse;
    }

    public function setVerite(bool $newVerite): void {
        $this->verite = $newVerite;
    }

    // -------------------------------------- Méthodes CRUD ------------------------------------

    // Fonction pour créer une réponse dans BDD
    private function createReponse(): bool {
        $sql = "INSERT INTO reponses (libelleReponse, verite, idQuestion) VALUES (:libelleReponse, :verite, :idQuestion)";
        $query = $this->pdo->prepare($sql);
        $success = $query->execute([':libelleReponse' => $this->libelleReponse, ':verite' => $this->verite, ':idQuestion' => $this->idQuestion]);
        if ($success) {
            $this->id = $this->pdo->lastInsertId();
        }
        return $success;
    }

    // Fonction pour modifier une réponse dans BDD
    private function updateReponse(): bool {
        if (!$this->id) {
            return false;
        }
        $sql = "UPDATE reponses SET libelleReponse = :libelleReponse, verite = :verite WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':libelleReponse' => $this->libelleReponse,':verite' => $this->verite,':id' => $this->id]);
    }

    // Fonction pour supprimer une réponse dans BDD
    public function delete(): bool {
        if (!$this->id) {
            return false;
        }
        $sql = "DELETE FROM reponses WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $success = $query->execute([':id' => $this->id]);
        return $success;
    }

    public function saveReponse(): bool{
        if ($this->id === null) {
            return $this->createReponse();
        } else {
            return $this->updateReponse();
        }
    }

    // -------------------------------------- Autres méthodes ------------------------------------

    // Fonction pour récupérer toutes les réponses d'une question de la BDD
    public static function getByQuestionId(int $idQuestion): array {
        $bdd = new BDD();
        $sql = "SELECT * FROM reponses WHERE idQuestion = :idQuestion";
        $stmt = $bdd->pdo->prepare($sql);
        $stmt->execute([':idQuestion' => $idQuestion]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $reponses = [];
        foreach ($rows as $row) {
            $reponses[] = new Reponses($row['libelleReponse'], $row['verite'], $row['idQuestion'], $row['id']);
        }
        return $reponses;
    }

    // Fonction pour récupérer une reponse en particulier à partir de son ID
    public static function getReponseById(int $id): ?Reponse {
        $bdd = new BDD();
        $sql = "SELECT * FROM reponses WHERE id = :id";
        $stmt = $bdd->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row){
            return null;
        }
        return new Reponse($row['libelleReponse'], $row['verite'], $row['idQuestion'], $row['id']);
    }

}
