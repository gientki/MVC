<?php
session_start();
if ((isset($_SESSION['error']))||(isset($_SESSION['login']))) {
    
    echo "<p style='color: red;'>"."źle"."</p>"; 
    unset($_SESSION['error']); 
}

?>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your website description here">
    <meta name="author" content="Your Name">

    <title>Ogłoszenia22</title>
    <link rel="stylesheet" href="style.css">

   
</head>
        

<body>
<form method="post" action="index.php">
  

    <input placeholder="login" type="text" name = "login"></br>
    <input placeholder="hasło" type="password" name="pass"></br>
    <input type="submit" value="zaloguj"> </br>

    </form>
</body>