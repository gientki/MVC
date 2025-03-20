<?php
class dbConnect {
    protected $conn; // Dodajemy protected, aby klasy dziedziczące miały dostęp

    public function __construct() {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "oferty";

        $this->connect(); // Inicjalizacja połączenia z bazą danych
    }

    protected function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->servername};dbname={$this->database}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (PDOException $e) {
            die("Błąd połączenia: " . $e->getMessage()); // die() zatrzyma dalsze działanie skryptu
        }
    }

    public function __destruct() {
        $this->conn = null; // Zamknięcie połączenia
    }
}
?>
