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
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("offerModal");
    const openModalBtn = document.getElementById("openModal");
    const closeModalBtn = document.querySelector(".close"); // POPRAWKA!

    // Otwieranie modala
    openModalBtn.addEventListener("click", function() {
        modal.style.display = "flex";  // POPRAWKA: Teraz modal pojawia się poprawnie
    });

    // Zamknięcie modala
    closeModalBtn.addEventListener("click", function() {
        modal.style.display = "none";
    });

    // Zamknięcie modala po kliknięciu w tło
    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});
</script>

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
    $_SESSION['userId'] = $userId;
    $user = new UserModel();
    $user = $user->getUserById($userId);
    

    if (!$userId || !password_verify($_POST['pass'], $user['pass'])) {
        $_SESSION['error'] = "";
        header("Location: logowanie.php");
        exit();
    }

    //session_destroy();
}
$controller = new UserController();

$controller->showUser($userId);
$controller->showOffers();
?>
<!-- Modal -->
<div id="offerModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Dodaj Ogłoszenie</h2>

        <form id="offerForm">
            <label>
                <input type="radio" name="title" value="Sprzedam" required> Sprzedam
            </label>
            <label>
                <input type="radio" name="title" value="Kupię" required> Kupię
            </label>
            <br><br>
            
            <textarea name="description" placeholder="Wpisz opis ogłoszenia..." required></textarea>
            <br><br>
            
            <button type="submit">Dodaj</button>
        </form>
    </div>
</div>
<div id="offerModal" style="display: none;">
    <form id="offerForm">
        <label>
            <input type="radio" name="title" value="sprzedam" required> Sprzedam
        </label>
        <label>
            <input type="radio" name="title" value="kupie" required> Kupię
        </label>
        <br>
        <textarea name="description" placeholder="Wpisz opis ogłoszenia" required></textarea>
        <br>
        <button type="submit">Dodaj</button>
        <button type="button" id="closeModal">Anuluj</button>
    </form>
</div>
</body>
