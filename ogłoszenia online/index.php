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

    <script>
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("offerModal");
    const openModalBtn = document.getElementById("openModal");
    const closeModalBtn = document.querySelector(".close");
    const offerForm = document.getElementById("offerForm");

    if (!modal || !openModalBtn || !closeModalBtn || !offerForm) {
        console.error("Błąd: Nie znaleziono elementów modala!");
        return;
    }

    openModalBtn.addEventListener("click", function() {
        modal.style.display = "flex";
    });

    closeModalBtn.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    offerForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = {
            title: offerForm.querySelector('input[name="title"]:checked')?.value,
            description: offerForm.querySelector('textarea[name="description"]').value
        };

        if (!formData.title || !formData.description) {
            alert("Wypełnij wszystkie pola!");
            return;
        }

        fetch("add_offer.php", {
    method: "POST",
    body: JSON.stringify(formData),
    headers: { "Content-Type": "application/json" }
})
.then(response => {
    console.log('Raw response:', response); // Zobacz, co zwraca serwer
    return response.json(); // Parsowanie JSON
})
.then(data => {
    console.log("Odpowiedź serwera:", data);
    if (data.status === "success") {
        alert("Ogłoszenie dodane!");
        modal.style.display = "none";
        window.location.reload();
    } else {
        alert("Błąd: " + data.message);
    }
})
.catch(error => console.error("Błąd wysyłania formularza:", error));
    
window.location.reload();
    });
    
});

</script>

<script>
function removeOffer(x)
{   
    console.log(x);

    fetch("removeOffer.php",{
        method: "POST",
        body: JSON.stringify({offerId: x}),
        headers: { "Content-Type": "application/json"}
    })
    .then(response => response.text())
    .then(data => {
        console.log("serwer odpowiedział",data);
        window.location.reload();
    })
    .catch(error => console.error("Błąd",error));
}
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
</body>
