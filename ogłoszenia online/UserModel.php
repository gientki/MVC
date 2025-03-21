<?php
session_start();
require_once "dbConnect.php";
class UserModel extends dbConnect {
    public function getUserById($userId) {
        if($userId == -1)
            return null;
        // kod do pobrania danych użytkownika z bazy danych
        else
        {
            try{
                $query = 'SELECT * FROM uzytkownicy WHERE id="'  
                .$userId.
                '"';
        
                $result = $this->conn->query($query);
                $row = $result->fetch(PDO::FETCH_ASSOC);
                    
                return [ 
                    'id' => $userId,
                    'name' => $row['login'],
                    'pass' => $row['haslo']
                    //'email' => 'normalne@gmail.com',
                ];
            }
                catch (PDOException $e) {
                echo "Błąd połączenia: " . $e->getMessage();
            }
        }
      
    }
}


