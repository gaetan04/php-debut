
<?php
    try {
        $bd= new PDO('mysql:host=localhost;dbname=restaurantdb','root','');
    } catch (Exception $e) {
        die('erreur de connection;'.$e->getmessage());
    }

    if (isset($_POST['envoi'])) {
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $repeatpassword=$_POST['repeatpassword'];
        if ($nom&&$prenom&&$email&&$password&&$repeatpassword) {
            if ($password==$repeatpassword) {
                $reponse = $bd->query("SELECT * FROM users WHERE nom='$nom' AND prenom='$prenom'");
                $rows = $reponse->fetch();
                if ($rows==0) {
                    $stmt=$bd->prepare('insert into users(nom,prenom,email,password,repeatpassword) values (?,?,?,?,?)');
                    $stmt->execute(array($nom,$prenom,$email,$password,$repeatpassword));
                  //  die("INSCRIPTION TREMINEE cliquez sur <a href='connection.php'> connection </a> pour vous connecter");
                    //$reussite = "INSCRIPTION TREMINEE";
                    header ("location:connection.php");
                }else{
                $reussite = "ce pseudo n'est pas disponible veuillez choisir un autre";
                
                }
            }else{
                echo "passwords don't match"; 
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
            <link rel="stylesheet" href="css/style2.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
            <link rel="stylesheet" href="css/style.css">
        </head>
        <body>

            <form action="INSCRIPTION3.php" method="POST">
            <div class="reussite">
                    <?php
                        if (isset($_POST['envoi']) AND !empty($reussite)) {
                          echo "<h2>".$reussite."</h2>";
                        }
                    ?>
            </div>
                <h1>s'inscrire </h1>
                <div class="social-media">
                    <p> <i class="fab fa-google"></i> </p>
                    <p> <i class="fab fa-youtube"></i> </p>
                    <p> <i class="fab fa-facebook"></i> </p>
                    <p> <i class="fab fa-instagram"></i> </p>
                    <p> <i class="fab fa-twitter"></i> </p>
                </div> 
                <p class="choose-email"> ou utiliser mon adresse email:</p>
                  
                <div class="inputs">
                    <input type="nom" name="nom" placeholder="nom" required="" autocomplete="off">
                    <input type="prenom" name="prenom" placeholder="prenom" required="" autocomplete="off">
                    <input type="Email" name="email" placeholder="email" required="" autocomplete="off" title="xyz@example.com">
                    <input type="password" name="password" placeholder="mot de passe" required="" autocomplete="off" pattern="\w{8,}" title="8 caracteres au minimum sans caracteres speciaux">
                    <input type="password" name="repeatpassword" placeholder="repeter mot de passe" required="" autocomplete="off" pattern="\w{8,}">
                </div>
                <p class="inscription"> vous avez deja un compte? <span> <a href="connection.php">connecter-vous.</a></span></p>
                <div align="center">
                    <button type="submit" name="envoi"> s'inscrire </button>
                    <button type="submit" name="retour"><a href="index.php"> retour a l'acceuil </a> </button>
                </div>  
            </form>           
        </body>
    </html> 