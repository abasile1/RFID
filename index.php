<?php session_start();?>
<!DOCTYPE html>
	<html>
		<head>
				<title>Lecteur RFID</title>
    			<?php 
    					include 'class/TcpClient.php';
    					include 'class/Bdd.php';
    					$tcp = new TcpClient("","");
    					
    			?>
		</head>

		<body>
				<?php
					$bdd = new Bdd("127.0.0.1","lecteur","root",""); // connexion a la bdd 
					$reponse = $bdd->query('SELECT * FROM user ');

					while ($resultat = $reponse->fetch())

					//WHERE id = 671DD869
					{
						echo $resultat['id'] ;
					}
				?>
		</body>



</html>
