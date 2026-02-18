<?php
require_once '../config/bdd.php';

class Quiz extends BDD {

    private ?int $id;
    private string $titre;
    private string $description;
    private string $image;
    private string $difficulte;

    public function __construct(string $titre, string $description, string $image, string $difficulte, ?int $id = null){
        parent::__construct();
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->image = $image;
        $this->difficulte = $difficulte;
    }

    // -------------------------------------- Getters ------------------------------------

    public function getId(): ?int {
        return $this->id;
    }

    public function getTitre(): string {
        return $this->titre;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function getDifficulte(): string {
        return $this->difficulte;
    }

    // -------------------------------------- Setters ------------------------------------

    public function setTitre(string $newTitre): void {
        $this->titre = $newTitre;
    }

    public function setDescription(string $newDescription): void {
        $this->description = $newDescription;
    }

    public function setImage(string $newImage): void {
        $this->image = $newImage;
    }

    public function setDifficulte(string $newDifficulte): void {
        $this->difficulte = $newDifficulte;
    }

    // -------------------------------------- Méthodes CRUD ------------------------------------

    // Fonction pour créer un quiz dans BDD
    public function create(): bool {
        $sql = "INSERT INTO quiz (titre, description, image, difficulte) VALUES (:titre, :description, :image, :difficulte)";
        $query = $this->pdo->prepare($sql);
        $success = $query->execute([':titre' => $this->titre, ':description' => $this->description, ':image' => $this->image, ':difficulte' => $this->difficulte]);
        if ($success) {
            $this->id = $this->pdo->lastInsertId();
        }
        return $success;
    }

    // Fonction pour modifier un quiz dans BDD
    public function update(): bool {
        if (!$this->id) {
            return false;
        }
        $sql = "UPDATE quiz SET titre = :titre, description = :description, image = :image, difficulte = :difficulte WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':titre' => $this->titre,':description' => $this->description,':image' => $this->image,':difficulte' => $this->difficulte,':id' => $this->id]);
    }

    // Fonction pour supprimer un quiz dans BDD
    public function delete(): bool {
        if (!$this->id) {
            return false;
        }
        $sql = "DELETE FROM quiz WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $success = $query->execute([':id' => $this->id]);
        if($success){
            $filePath = '../images/' . $this->image;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        return $success;
    }

    // -------------------------------------- Autres méthodes ------------------------------------

    // Fonction pour récupérer tous les quiz de la BDD
    public static function getAll(): array {
        $bdd = new BDD();
        $sql = "SELECT * FROM quiz";
        $query = $bdd->pdo->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $quizList = [];
        foreach ($results as $row) {
            $quizList[] = new Quiz($row['titre'],$row['description'],$row['image'],$row['difficulte'],$row['id'])};
        return $quizList;
    }

    // Fonction pour récupérer un quiz de la BDD à partir de son id
    public static function getById(int $id): ?Quiz {
        $bdd = new BDD();
        $sql = "SELECT * FROM quiz WHERE id = :id";
        $query = $bdd->pdo->prepare($sql);
        $query->execute([':id' => $id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return new Quiz($row['titre'],$row['description'],$row['image'],$row['difficulte'],$row['id']);
    }

    // Fonction pour compter le nombre de questions qu quiz
    public function countQuestions(): int {
        if (!$this->id) {
            return 0;
        }
        $sql = "SELECT COUNT(*) as total FROM questions WHERE idQuiz = :idQuiz";
        $query = $this->pdo->prepare($sql);
        $query->execute([':idQuiz' => $this->id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return (int)$result['total'];
    }

    // Fonction pour vérifier l'image ajoutée par l'utilisateur
    public function imageProcessing(array $files): bool {
        if (!isset($files["image"]) || $files["image"]["error"] !== 0) {
            return false;
        }
        $file_basename  = pathinfo($files["image"]["name"], PATHINFO_FILENAME);
        $file_extension = pathinfo($files["image"]["name"], PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array(strtolower($file_extension), $allowedExtensions)) {
            return false;
        }
        $new_image_name = $file_basename . '_' . date('Ymd_His') . '.' . $file_extension;
        move_uploaded_file($files["image"]["tmp_name"], '../images/' . $new_image_name);
        $this->setImage($new_image_name);
        return true;
    }

    // -------------------------------------- Méthodes pour lier Quiz et Question ------------------------------------

    // Fonction pour récupérer les questions d'un quiz en particulier
    public function getQuestions(): array{
        if (!$this->id) {
            return [];
        }
        $sql = "SELECT * FROM questions WHERE idQuiz = :idQuiz";
        $query = $this->pdo->prepare($sql);
        $query->execute([':idQuiz' => $this->id]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $questionList = [];
        foreach ($results as $row) {
            $questionList[] = new Question($row['libelleQuestion'],$row['typeQuestion'],$row['idQuiz'],$row['id'])};
        return $questionList;
    }

}
