<?php
session_start();
require_once 'dbConnect.php';

class OfferModel extends dbConnect {
    public function addOffer($userId, $type, $description) {
        try {
            $query = 'INSERT INTO oferty (id, uzytkownik_id, typ_oferty, tresc) VALUES (NULL, :userId, :type, :description)';
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ':userId' => $userId,
                ':type' => $type,
                ':description' => $description
            ]);
            return "Ogłoszenie dodane!";
        } catch (PDOException $e) {
            return "Błąd bazy danych: " . $e->getMessage();
        }
    }
}

// Upewniamy się, że użytkownik jest zalogowany
if (!isset($_SESSION['userId'])) {
    echo "Musisz być zalogowany!";
    exit();
}

// Obsługa formularza
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = trim($_POST['title']);
    $description = trim($_POST['description']);
    $userId = $_SESSION['userId'];

    if (!empty($type) && !empty($description)) {
        $offerModel = new OfferModel();
        echo $offerModel->addOffer($userId, $type, $description);
    } else {
        echo "Wypełnij wszystkie pola!";
    }
}
?>
