<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "nitrocol.db.objet";

    public function getConnection() {
        try {
            $conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }
}


?>