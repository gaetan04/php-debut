<?php
session_start();
    try{
        $bd=new PDO("mysql:host=localhost;dbname=restaurantdb",'root','');
    }catch(PDOException $e){
        die('erreur de connection;'.$e->getmessage());
    }
        if (isset($_POST) && !empty($_POST)) 
        {
           if (isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) 
           {
               $email=$_POST['email'];
               $password=$_POST['password'];

            $insert=$bd->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
            $insert->execute(array($email,$password));
            $recup = $insert->fetch();
            if (!($insert->rowcount() > 0)) 
            {
                $erreur = "Email ou password incorrect";
            }else{
                $_session['user'] = [                 
                  "nom" => $recup["nom"],
                  "email" => $recup["email"],
                  "password" => $recup["password"],
                ];
                $_SESSION["autoriser"]="oui";
                header('Location: reservation.php');
                exit;
            }
           }
        }

?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title> RESTAURANT SOLEIL D'AFRIQUE </title>
            <link rel="stylesheet" href="css/style4.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
        </head>
        <body>
            <form action="connection.php" method="POST">
                <div class="erreur">
                    <?php
                        if (isset($_POST['envoyer']) AND !empty($erreur)) {
                          echo "<h2>".$erreur."</h2>";
                        }
                    ?>
                </div>
                <h1>se connecter </h1>
                <div class="social-media">
                    <p> <i class="fab fa-google"></i> </p>
                    <p> <i class="fab fa-youtube"></i> </p>
                    <p> <i class="fab fa-facebook"></i> </p>
                    <p> <i class="fab fa-instagram"></i> </p>
                    <p> <i class="fab fa-twitter"></i> </p>
                </div> 
                <div class="inputs">
                    <input type="Email" placeholder="email" title="xyz@example.com" required="" name="email">
                    <input type="password" placeholder="mot de passe" required="" name="password">
                </div>
                <p class="inscription">Je n'ai pas de <span> compte </span>  <span> <a href="INSCRIPTION3.php"> crée </a></span> un.</p>
                <div align="center">
                    <button type="submit" name="envoyer"> se connecter </button>
                    <button type="submit" name="retour"><a href="index.php"> retour a l'acceuil </a> </button>
                </div>        
            </form>
        </body>
    </html> 