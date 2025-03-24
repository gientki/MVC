<?php
session_start();
require_once 'OfferRemover.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['userId'])) {
        echo json_encode(["status" => "error", "message" => "Nie jesteś zalogowany"]);
        exit();
    }

    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['offerId'])) {
        echo json_encode(["status" => "error", "message" => "Brak ID ogłoszenia"]);
        exit();
    }

    $offerId = intval($data['offerId']);
    $userId = $_SESSION['userId'];

    $remover = new OfferRemover();
    $response = $remover->removeOffer($offerId, $userId);

    echo json_encode($response);
} else {
    echo json_encode(["status" => "error", "message" => "Nieprawidłowe żądanie"]);
}
?>
