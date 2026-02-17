<?php
require_once '../config/bdd.php';


class User extends BDD {

    private string $email;
    private string $password;
    private string $confirm_password;
    private string $role;

    public function __construct(string $email, string $password, string $confirm_password, string $role){
        parent::__construct();
        $this->email = $email;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        $this->role = $role;
    }

    // ------------------------------------- Inscription ------------------------------------------

    // Vérification validité données inscription utilisateur
    private function field_verification(){
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return "L'adresse mail n'est pas valide";
        }
        elseif (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $this->password)) {
            return "Le mot de passe doit contenir au moins 8 caractères dont une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial";
        }
        elseif ($this->password !== $this->confirm_password) {
            return "Les deux mots de passe doivent être égaux";
        }
        return true;
    }

    // Fonction pour enregistrer les données d'inscription de l'utilisateur dans la BDD
    private function recording(){
        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (email, password, role) VALUES (:email, :password, :role)";
        $query = $this->pdo->prepare($sql);
        $query->execute([':email' => $this->email, ':password' => $hash, ':role' => $this->role]);
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
    public function sign_up() {
        if ($this->email_exists()) {
            return "Cet email est déjà utilisé";
        }
        $validation = $this->field_verification();
        if ($validation !== true) {
            return $validation;
        }
        return $this->recording();
    }


    // ------------------------------------- Connexion ------------------------------------------

    // Récupération des informations d'un utilisateur
    private function user_by_email(){
        $sql = "SELECT * FROM user WHERE email = :email";
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
        return $user;
    }

}





?>