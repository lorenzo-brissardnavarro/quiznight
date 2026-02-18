<?php
require_once '../config/bdd.php';

class Quiz extends BDD {

    private int $id;
    private string $titre;
    private string $description;
    private string $image;
    private string $difficulte;

    public function __construct(string $titre, string $description, string $difficulte){
        parent::__construct();
        $this->titre = $titre;
        $this->description = $description;
        $this->difficulte = $difficulte;
    }

    private setImage($newImage): void{
        $this->image = $newImage;
    }

    // Fonction pour enregistrer les informations du quiz en BDD
    public function create(): bool{
        $sql = "INSERT INTO quiz (titre, description, image, difficulte) VALUES (:titre, :description, :image, :difficulte)";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':titre' => $this->titre, ':description' => $this->description, ':image' => $this->image, ':difficulte' => $this->difficulte]);
    }

    // Fonction pour modifier les informaions du quiz en BDD
    public function update(): bool{
        $sql = "UPDATE quiz SET titre = :titre, description = :description, image = :image, difficulte = :difficulte WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':titre' => $this->titre, ':description' => $this->description, ':image' => $this->image, ':difficulte' => $this->difficulte, ':id' => $this->id]);
    }

    // Fonction pour supprimer un quiz en BDD
    public function delete(): bool {
        $sql = "DELETE FROM quiz WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute([':id' => $this->id]);
    }

    // Récupérer l'ensemble des quiz de la BDD
    public function getAll(): array {
        $sql = "SELECT * FROM quiz";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Récupérer un seul quiz de la BDD à partir d'un id
    public function getById(int $id): array {
        $sql = "SELECT * FROM quiz WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':id' => $id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function count_questions(): int{
        $sql = "SELECT COUNT(*) FROM questions INNER JOIN quiz ON questions.idQuiz = quiz.id WHERE idQuiz = :idQuiz";
        $query = $pdo->prepare($sql);
        $query->execute([':idQuiz' => $this->id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public image_processing($files): bool{
        $file_basename  = pathinfo($files["image"]["name"], PATHINFO_FILENAME);
        $file_extension = pathinfo($files["image"]["name"], PATHINFO_EXTENSION);
        $new_image_name = $file_basename . '_' . date('Ymd_His') . '.' . $file_extension;
        move_uploaded_file($files["image"]["tmp_name"], '../images/' . $new_image_name);
        $this->setImage($new_image_name);
        return true;
    }


}






?>