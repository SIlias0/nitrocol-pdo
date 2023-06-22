<?php
session_start();
include_once './config/config.php';
include_once './classes/auth.php';

$database = new Database();
$db = $database->getConnection();
$auth = new Auth($db);

if ($auth->isAuthenticated()) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($auth->login($username, $password)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Identifiants invalides.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>login</p>
    <form action="login.php" method="POST">
        <div>
            <label for="username"></label>
            <input type="text" name="username" placeholder="username" required>
        </div>

        <div>
            <label for="password"></label>
            <input type="text" name="password" placeholder="password" required>
        </div>

        <div>
            <input type="submit" value="Seconnecter">
        </div>
    </form>
</body>
</html>