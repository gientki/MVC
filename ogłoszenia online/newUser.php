<?php
require_once 'dbConnect.php';

class newUser extends dbConnect {
    public function __construct($login, $pass) {
        parent::__construct(); // Musimy wywołać konstruktor klasy dbConnect!

        try {
            $query = 'INSERT INTO uzytkownicy (id, login, haslo) VALUES (NULL, :login, :pass)';
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ':login' => $login,
                ':pass' => password_hash($pass, PASSWORD_DEFAULT) // Hashowanie hasła
            ]);
            echo "Rejestracja zakończona sukcesem!";
        } catch (PDOException $e) {
            echo "Błąd bazy danych: " . $e->getMessage();
        }
    }
}
?>
