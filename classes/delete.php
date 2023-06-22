<?php
class Delete {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function deleteData($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id" , $id);
        if($stmt-> execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>