<?php
require_once 'dbConnect.php';

class OfferRemover extends dbConnect {
    public function __construct() {
        parent::__construct();
    }

    public function removeOffer($offerId, $userId) {
        try {
            // Sprawdzenie, czy oferta należy do użytkownika
            $query = "SELECT * FROM oferty WHERE id = :offerId AND uzytkownik_id = :userId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":offerId" => $offerId, ":userId" => $userId]);
            $offer = $stmt->fetch();

            if (!$offer) {
                return ["status" => "error", "message" => "Brak dostępu do usunięcia"];
            }

            // Usunięcie ogłoszenia
            $deleteQuery = "DELETE FROM oferty WHERE id = :offerId";
            $deleteStmt = $this->conn->prepare($deleteQuery);
            $deleteStmt->execute([":offerId" => $offerId]);

            return ["status" => "success", "message" => "Ogłoszenie usunięte"];
        } catch (PDOException $e) {
            return ["status" => "error", "message" => "Błąd bazy danych: " . $e->getMessage()];
        }
    }
}
