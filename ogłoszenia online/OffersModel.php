<?php
require_once "dbConnect.php";

class OffersModel extends dbConnect {
   public function getNumber()
   {
    try{
        
        $query = "SELECT COUNT(*) as liczba_wierszy FROM Oferty";
        $result = $this->conn->query($query);

        $row = $result->fetch(PDO::FETCH_ASSOC);
        $liczbaWierszy = $row['liczba_wierszy'];
        //echo "Liczba wierszy w tabeli: " . $liczbaWierszy;
        return $liczbaWierszy;
    }
    catch 
    (PDOException $e) {
        echo "Błąd połączenia: " . $e->getMessage();
    }
   }
    public function getTypes() {
        try {
            // nie trzeba łączyć się db bo dziedziczy.

            // zapytanie
            $query = "SELECT typ_oferty FROM Oferty";
            $result = $this->conn->query($query);


            $type = array_fill(0,$result->rowCount(),'');
            $i=0;
            // wynik
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $type[$i] = $row['typ_oferty'];
                    $i++;
                }
               
            } else {
                echo "Brak wyników.";
                return null;
            }

            return $type;

        } catch (PDOException $e) {
            echo "Błąd połączenia: " . $e->getMessage();
        }
    }
    
    public function getContent()
    {
        try {

            // zapytanie
            $query = "SELECT tresc FROM Oferty";
            $result = $this->conn->query($query);
            $message = '';

            $content = array_fill(0,$result->rowCount(),'');
            $i=0;
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $content[$i] = $row['tresc'];
                    $i++;
                }
               
            } else {
                echo "Brak wyników.";
                return null;
            }

            return $content;

        } catch (PDOException $e) {
            echo "Błąd połączenia: " . $e->getMessage();
        }
    }
}