<?php
require_once 'validation.php';
require_once 'newUser.php';

$comunicate = '';

if (isset($_POST['login'])) {
    if (strlen($_POST['pass1']) < 5)
        $comunicate .= 'Za krótkie hasło. ';

    if ($_POST['pass1'] != $_POST['pass2'])
        $comunicate .= 'Hasła nie są takie same. ';

    if ($comunicate == '') {
        $newUser = new newUser($_POST['login'], $_POST['pass1']);
    } else {
        echo $comunicate;
    }
}
?>

<form action="rejestracja.php" method="post">
    <input placeholder="login" type="text" name="login"><br>
    <input placeholder="hasło" type="password" name="pass1"><br>
    <input placeholder="powtórz hasło" type="password" name="pass2"><br>
    <input type="submit" value="Zarejestruj">
</form>
