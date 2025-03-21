<?php
require_once "dbConnect.php";
class UserModel {
    public function getUserById($userId) {
        // kod do pobrania danych użytkownika z bazy danych
        // statyczne dane
        return [
            'id' => $userId,
            'name' => 'Tomasz Lewandowski',
            'email' => '69_igraszki@gmail.com',
        ];
    }
}


