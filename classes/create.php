<?php
class Create {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function CreateData($username, $password) {
        $query = "INSERT INTO  users ( username, password) VALUES (:username , :password)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username" , $username);
        $stmt->bindParam(":password" , $password);
        if($stmt-> execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>