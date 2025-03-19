<?php
session_start();
if ((isset($_SESSION['error']))||(isset($_SESSION['login']))) {
    
    echo "<p style='color: red;'>"."źle"."</p>"; 
    unset($_SESSION['error']); 
}

?>
<form method="post" action="index.php">
  

    <input placeholder="login" type="text" name = "login"></br>
    <input placeholder="hasło" type="password" name="pass"></br>
    <input type="submit" value="zaloguj"> </br>

    </form>
