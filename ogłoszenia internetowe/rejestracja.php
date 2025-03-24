<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your website description here">
    <meta name="author" content="Your Name">

    <title>Ogłoszenia</title>
    <link rel="stylesheet" href="style.css">

   
</head>
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
<body>
<form class="registry validate" method="post" action="index.php">

  <input type="text" name="login" class="question" id="nme" required autocomplete="off" />
  <label for="nme"><span >Login</span></label>
  <input type="password" name="pass1" class="question" id="nme" required autocomplete="off" />
  <label for="nme"><span>Hasło</span></label>
  <input type="password" name="pass2" class="question" id="nme" required autocomplete="off" />
  <label for="nme"><span>Powtóż hasło</span></label>
 
  <div class="box-3">
        <button id="zaloguj" class="btn btn-three" type="submit" >zaloguj</button>
</div>
    </form>
</body>

