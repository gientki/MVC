<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your website description here">
    <meta name="author" content="Your Name">

    <!-- Add your own title -->
    <title>Ogłoszenia</title>

    <!-- Add your own stylesheets, if needed -->
    <link rel="stylesheet" href="style.css">

    <!-- Add your own scripts or external libraries -->
    <script defer src="script.js"></script>
</head>
<body>
<?php

// Inicjalizacja kontrolera 
require_once 'controller.php';
require_once 'UserModel.php';
require_once 'validation.php';

//session_start();
$userId = -1;
if(isset($_POST['login'])&&isset($_POST['pass'])) 
{
    $_SESSION['login'] = $_POST['login'];
  

    $userData = new UserData();
    $userId = $userData->getUserId($_SESSION['login']);

    $user = new UserModel();
    $user = $user->getUserById($userId);
    

    if (!$userId || !password_verify($_POST['pass'], $user['pass'])) {
        $_SESSION['error'] = "";
        header("Location: logowanie.php");
        exit();
    }

    session_destroy();
}
$controller = new UserController();

$controller->showUser($userId);
$controller->showOffers();
?>
</body>
