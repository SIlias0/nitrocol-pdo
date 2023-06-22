<?php

session_start();

include_once './config/config.php';
include_once './classes/auth.php';

$database = new Database();
$db = $database->getConnection();
$auth = new Auth($db);


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = $_POST['f_name'];
    $password = $_POST['l_name'];
    $password = $_POST['img'];

    $message = $auth->inscription($username, $password);
    echo $message;

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
    <p>register</p>
    <form action="register.php" method="POST">
        <div>
            <label for="username"></label>
            <input type="text" name="username" placeholder="nom d'utilisateur" required>
        </div>

        <div>
            <label for="password"></label>
            <input type="password" name="password" placeholder="mot de passe" required>
        </div>

        <div>
            <label for="f_name"></label>
            <input type="text" name="f_name" placeholder="nom" required>
        </div>

        <div>
            <label for="l_name"></label>
            <input type="text" name="l_name" placeholder="prénom" required>
        </div>

        <div>
            <label for="img"></label>
            <input type="text" name="img" placeholder="photo de profil" required>
        </div>

        <div>
            <input type="submit" value="go">
        </div>
    </form>
</body>
</html>