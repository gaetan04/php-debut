<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title> page d'inscription </title>
            <link rel="stylesheet" href="style2.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
        </head>
        <body>
            <form action="INSCRIPTION3.php" method="POST">
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
                    <input type="email" name="email" placeholder="email" required="" autocomplete="off">
                    <input type="password" name="password" placeholder="mot de passe" required="" autocomplete="off">
                    <input type="password" name="repeatpassword" placeholder="repeter mot de passe" required="" autocomplete="off">

                </div>

                <p class="inscription"> vous avez deja un compte? <span> <a href="connection.php">connecter-vous.</a></span></p>

                <div align="center">
                    <button type="submit" name="envoi"> s'inscrire </button>
                </div>  
            </form>           
        </body>
    </html> 
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

die("INSCRIPTION TREMINEE cliquez sur <a href='connection.php'> connection </a> pour vous connecter");

   }else{
    echo "ce pseudo n'est pas disponible veuillez choisir un autre";
   }

}else{
    echo "passwords don't match";
}



        echo "";
    }else{
        echo "les passwords doivent etres identiques";
    }

       echo "";
    }else{
        echo "veuillez remplir tous les champs";
    }


?>