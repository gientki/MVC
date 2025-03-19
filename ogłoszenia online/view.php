<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your website description here">
    <meta name="author" content="Your Name">

    <title>Ogłoszenia22</title>
    <link rel="stylesheet" href="style.css">

   
</head>
        

<?php
class UserView {
    public function displayUser($userData) {

        if(isset($userData))
        {
            //echo "User ID: {$userData['id']}<br>";
            echo "</br>";
            echo "siemaneczko {$userData['name']} mam nadzieję że znajdziesz jakieś fajne coś <br>";
            echo "</br>";
            $logoutButton = '<a href="logout.php">
            <div class="box-3">
                        <div class="btn btn-three">
                          <span>wyloguj się</span>
                        </div>
                      </div>
                </a>';
            echo $logoutButton;
            echo "</br>";
        }
        else 
        {
            $loginButton = '<a href="logowanie.php">
            <div class="box-3">
                        <div class="btn btn-three">
                          <span>zaloguj się</span>
                        </div>
                      </div>
                </a>';
            $registryButton = '<a href="rejestracja.php">  
            <div class="box-3">
                    <div class="btn btn-three">
                      <span>zarejestruj się</span>
                    </div>
                  </div>
        </a>';
            echo $loginButton;
            echo $registryButton;
            echo '</br>';
        }
    }
}
class OffersView{
    public function displayOffers($num,$types,$content) {
       for($i=0;$i<$num;$i++)    {
                echo '<div class="offer"><h1>'.$types[$i].'</h1></br>'.$content[$i].' </br></div>';
            }
    ;
    }
}
