<?php
session_start();
if ($_SESSION["autoriser"]!="oui"){
	header ("location:connection.php");
    exit();
}
	try {
       $bd= new PDO('mysql:host=localhost;dbname=restaurantdb','root','');
} catch (Exception $e) {
    die('erreur de connection;'.$e->getmessage());
}
if (isset($_POST['envoyer'])) {
	$date=$_POST['date'];		
	$heure=$_POST['heure'];
	$np=$_POST['np'];
	if ($date&&$heure&&$np) {
		$coordonnees = array (
		'date' => $date,
		'heure' => $heure,
		'nombre de personne' => $np);
 		echo '<pre>';
		print_r($coordonnees);
		echo '</pre>';
 		$stmt=$bd->prepare('insert into reservation(date,heure,np) values (?,?,?)');
		$stmt->execute(array($date,$heure,$np));
		die();
		echo "Rendez-vous le ".$date." à ".$heure."; D'ici là portez vous bien et bonne suite de journée."."<br><br>" ;
		
	}else{
			echo "veuillez remplir tous les champs";
	}				
}
?>	
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>RESERVATION</title>
			<link rel="stylesheet" href="css/style6.css">
			<link rel="stylesheet" href="css/style.css">
		</head>
			<body>
				<nav>
		            <ul class="menu">
		                <li><a href="PLATS_DISPONIBLES.php">PLATS DISPONIBLES</a></li>
		                <li><a href="INSCRIPTION3.php">INSCRIPTION</a></li>
		                <li><a href="connection.php">CONNECTION</a></li>
						<li><a href="index.php">ACCEUIL</a></li>
		             </ul>
       			 </nav>
				<center><h1>Veuillez faire votre reservation ici</h1></center>
				<form action="reservation.php" method="POST">
				  <fieldset>				          
                     <label for="date"> DATE </label>
                     <input type="date" name="date" /> <br><br>

                      <label for="time"> HEURE </label>
                     <input type="time" name="heure" /> <br><br>

                     <label for="number"> NOMBRE DE PERSONNE </label>
                     <select name="np">
						 <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option>
					 </select>
                   </fieldset>
                   	   <center>
                   		<input type="submit" name="envoyer" value="reserver">
                   		<input type="reset" name="" value="reinitialiser"><br><br> 
                   	   </center>
				</form>	
					
<center><button id="submit" ><a href="connection.php">se deconnecter</a></button></center>
            </body>
	</html>