<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your website description here">
    <meta name="author" content="Your Name">

    <title>Ogłoszenia22</title>
    <link rel="stylesheet" href="style.css">

   
</head>
        

<body>

<?php
class Button
{
  public function __construct($href,$description)
  {
    echo  '<a href="'.$href.'">
            <div class="box-3">
                        <div class="btn btn-three">
                          <span>'.$description.'</span>
                        </div>
                      </div>
                </a>';
  }
}
class UserView {
    public function displayUser($userData) {

        if(isset($userData))
        {
            //echo "User ID: {$userData['id']}<br>";
            echo "</br>";
            echo "Siemaneczko {$userData['name']} </br>mam nadzieję że znajdziesz jakieś fajne coś <br>";
            echo "</br>";
            $logoutButton = new Button('logout.php','Wyloguj się');
            
            echo '<div  class="box-3" id="openModal">
            <div class="btn btn-three">
            <span>Dodaj ogłoszenie</span>
            </div>
            </div>';
            echo "</br>";
        }
        else 
        {
            echo "</br>";
            $loginButton = new Button('logowanie.php','Zaloguj się');
            $registryButton = new Button('rejestracja.php','Zarejestruj się');
            echo '</br>';
        }
    }
}
class OffersView{
    public function displayOffers($num,$types,$content,$userId,$postId) {
       for($i=0;$i<$num;$i++)    {
                
            if(isset($_SESSION['userId'])&&($userId[$i] == $_SESSION['userId']))
                    echo '<div class="offer"> <button class="close-btn" id="removeOffer" onclick="removeOffer('.$postId[$i].')">X</button><h1>'
                    .$types[$i].'</h1></br>'.$content[$i].' </br>
                    </div>';
                
            else    {
                echo '<div class="offer"><h1>'
                    .$types[$i].'</h1></br>'.$content[$i].' </br>
                    </div>';
            }
            }
    ;
    }
}?>

</body>