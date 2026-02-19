<?php
require_once '../config/bdd.php';


class User extends BDD {

    private ?int $id = null;
    private string $email;
    private string $password;

    public function __construct(string $email, string $password) {
        parent::__construct();
        $this->email = $email;
        $this->password = $password;
    }

    // ------------------------------------- Inscription ------------------------------------------

    // Vérification validité données inscription utilisateur
    private function field_verification(string $confirm_password){
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return "L'adresse mail n'est pas valide";
        }
        elseif (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $this->password)) {
            return "Le mot de passe doit contenir au moins 8 caractères dont une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial";
        }
        elseif ($this->password !== $confirm_password) {
            return "Les deux mots de passe doivent être égaux";
        }
        return true;
    }

    // Fonction pour enregistrer les données d'inscription de l'utilisateur dans la BDD
    private function recording(string $role){
        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (email, password, role) VALUES (:email, :password, :role)";
        $query = $this->pdo->prepare($sql);
        $query->execute([':email' => $this->email, ':password' => $hash, ':role' => $role]);
        return true;
    }

    // Vérification si username existe déjà dans la BDD
    private function email_exists(): bool {
        $sql = "SELECT id FROM user WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute([':email' => $this->email]);
        if ($query->fetch(PDO::FETCH_ASSOC)) {
            return true;
        }
        return false;
    }

    // Processus d'appel pour vérification puis enregistrement inscription dans BDD
    public function sign_up(string $confirm_password) {
        if ($this->email_exists()) {
            return "Cet email est déjà utilisé";
        }
        $validation = $this->field_verification($confirm_password);
        if ($validation !== true) {
            return $validation;
        }
        $role = "utilisateur";
        if (str_contains($this->email, 'admin')) {
            $role = "admin";
        }
        return $this->recording($role);
    }


    // ------------------------------------- Connexion ------------------------------------------

    // Récupération des informations d'un utilisateur
    private function user_by_email(){
        $sql = "SELECT id, password, role FROM user WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute([':email' => $this->email]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Verification validité données
    public function log_in() {
        $user = $this->user_by_email();
        if ($user === false || !password_verify($this->password, $user["password"])) {
            return "Identifiant ou mot de passe incorrect";
        }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        return true;
    }


    // ------------------------------------- Role Admin ------------------------------------------

    // Récupération informations utilisateur par ID
    private function get_information_user($id){
        $sql = "SELECT * FROM user WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Fonction pour déterminer si l'utilisateur est un administrateur
    public function is_admin(): bool{
        $data = $this->get_information_user($this->id);
        return $data["role"] === "admin";
    }

}





?>