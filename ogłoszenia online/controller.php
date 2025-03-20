<?php

require_once 'OffersModel.php';
require_once 'UserModel.php';
require_once 'view.php';

class UserController {

    private $modelUser;
    private $viewUser;

    private $modelOffers;
    private $viewOffers;

    public function __construct() {
        $this -> modelOffers = new OffersModel();
        $this -> viewOffers = new OffersView();
        
        $this->modelUser = new UserModel();
        $this->viewUser = new UserView();
    }
    public function showOffers()
    {
            $numRows = $this->modelOffers->getNumber();
            $types = $this->modelOffers->getTypes();
            $content = $this->modelOffers->getContent();
            $userId = $this->modelOffers->getUserId();


            $this->viewOffers->displayOffers($numRows,$types,$content,$userId);
    }
    public function showUser($userId) {
        // Pobierz dane użytkownika z modelu
        $userData = $this->modelUser->getUserById($userId);

        // Wyświetl dane użytkownika za pomocą widoku
        $this->viewUser->displayUser($userData);
    }
}