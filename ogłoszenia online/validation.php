<?php
require_once 'dbConnect.php';

class UserData extends dbConnect
{
    public function getUser($login)
    {
        try {
            $query = 'SELECT * FROM uzytkownicy WHERE login = :login';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':login', $login);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo "Błąd połączenia: " . $e->getMessage();
            return null;
        }
    }

    public function getUserId($login)
    {
        $result = $this->getUser($login);
        if ($result && $result->rowCount() == 1) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row['id'];
        } else {
            header('Location: logowanie.php');
            exit;
        }
    }
}
