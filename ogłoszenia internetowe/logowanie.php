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

    <title>Ogłoszenia</title>
    <link rel="stylesheet" href="style.css">

   
</head>
        

<body>
<form class="validate" method="post" action="index.php">

  <input type="text" name="login" class="question" id="nme" required autocomplete="off" />
  <label for="nme"><span >Login</span></label>
  <input type="password" name="pass" class="question" id="nme" required autocomplete="off" />
  <label for="nme"><span>Hasło</span></label>
 
  <div class="box-3">
        <button id="zaloguj" class="btn btn-three" type="submit" >zaloguj</button>
</div>
    </form>
   

</body>