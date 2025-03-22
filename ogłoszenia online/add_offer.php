<?php
session_start();
var_dump($_SESSION);

require_once 'dbConnect.php';

header('Content-Type: application/json');

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
            return ['status' => 'success', 'message' => 'Ogłoszenie dodane!']; // Zwracamy dane w formacie JSON
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Błąd bazy danych: ' . $e->getMessage()];
        }
    }
    
}

if (!isset($_SESSION['userId'])) {
    echo json_encode(["status" => "error", "message" => "Musisz być zalogowany!"]);
    exit();
}

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

if (!isset($input['title']) || !isset($input['description'])) {
    echo json_encode(["status" => "error", "message" => "Brak wymaganych danych"]);
    exit();
}

$type = trim($input['title']);
$description = trim($input['description']);
$userId = $_SESSION['userId'];

if (empty($type) || empty($description)) {
    echo json_encode(["status" => "error", "message" => "Wypełnij wszystkie pola!"]);
    exit();
}

// 📌 Dodajemy ogłoszenie
$offerModel = new OfferModel();
$result = $offerModel->addOffer($userId, $type, $description);

if ($result === true) {
    echo json_encode(["status" => "success", "message" => "Ogłoszenie dodane!"]);
} else {
    echo json_encode(["status" => "error", "message" => $result]);
}
?>
