<?php
class Update {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function updateData($id, $username , $password) {
        $query = "UPDATE users SET :username , :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id" , $id);
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