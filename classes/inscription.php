<?php

class Inscription {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function enregistrerUtilisateur($username, $password) {
        $query = "SELECT id FROM users WHERE username = :username, password = :password, f_name = :f_name, l_name = :l_name, img = :img";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username" , $username);
        $stmt->bindParam(":password" , $password);
        $stmt->bindParam(":f_name" , $f_name);
        $stmt->bindParam(":l_name" , $l_name);
        $stmt->bindParam(":img" , $img);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return "Ce nom existe deja";
        } else {
            $query = "INSERT INTO users (username, password, f_name, l_name, img, role) VALUES (:username, :password, :ilias, :via, :img, 'utilisateur')";
            $stmt = $this->conn->prepare($query);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(":f_name" , $f_name);
            $stmt->bindParam(":l_name" , $l_name);
            $stmt->bindParam(":img" , $img);
            
            if($stmt->execute()){
                return "C'est bon";
            } else {
                return "erreur";
            }
        }
    }
    
}

?>
