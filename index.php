<?php
session_start();
include_once './classes/auth.php';
include_once './config/config.php';
include_once './classes/create.php';
include_once './classes/read.php';
include_once './classes/update.php';
include_once './classes/delete.php';


$database = new Database();
$db = $database->getConnection();

$auth = new Auth($db);
$create = new Create($db);
$read = new Read($db);
$update = new Update($db);
$delete = new Delete($db);

if (!$auth->isAuthenticated()) {
    header("Location: login.php");
    exit();
}

if (!$auth->isModerator() && !$auth->isAdmin()) {
    header("Location: access-denied.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];

    if ($delete->deleteData($id)) {
        echo "Enregistrement.";
    } else {
        echo "Erreur.";
    }
}


// Récupérer les données existantes
$stmt = $read->readData();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Afficher les données
    echo "ID: " . $row['id'] . "<br>";
    echo "Nom: " . $row['username'] . "<br>";
    echo "role: " . $row['role'] . "<br>";


    echo "<form action='./update.php' method='POST'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<input type='text' name='username' value='" . $row['username'] . "'>";
    echo "<input type='text' name='role' value='" . $row['role'] . "'>";
    echo "<input type='submit' value='Mettre à jour'>";
    echo "</form>";


    echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<input type='submit' name='delete' value='Supprimer'>";
    echo "</form>";


    echo "<br>";
}




?>
