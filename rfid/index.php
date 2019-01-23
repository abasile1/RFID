<?php 				
	//inclure de la class de connexion tcp et bdd
	include 'class/TcpClient.php';
	include 'class/Bdd.php';
?>
<!DOCTYPE html>
<html>
	<!--début de lentete de page-->
	<head>
		<title>Lecteur RFID</title>
		<!--inclure le fichier de mise en page-->
		 <link rel="stylesheet" href="style.css" />
		 <!--inclure le fichier Jquery -->
		 <script src="http://code.jquery.com/jquery.min.js"></script>
		 <!--inclure le fichier JS -->
		 <script type="text/javascript" src="js/script.js"></script>
	</head>
	<!--Fin de lentete de page-->
	<!--début du corps de page-->
	<body>
		<?php
			// connexion au serveur tcp 
			$tcp = new TcpClient("192.168.65.7","1200");
			// connexion a la bdd 
			$bdd = new Bdd("127.0.0.1","lecteur","root","root");
			//connexion au serveur tcp/ip		
			$tcp->connect();
		?>
		<div id='here'>	<!--div pour effectuer une actualisation-->
			<?php
				
				//envoie la requette pour comuniquer avec le serveur
				$tcp->request("1");
				//on recupere dans la variable $reponse_tcp 
				$reponse_tcp = trim($tcp->answer());
				if($reponse_tcp!="NO CARTE")
				{
					//on recupere dans la varible $reponse_bdd la requette pour recuperer les info de la carte scanée  
					$reponse_bdd = $bdd->requete("SELECT * FROM user WHERE id='$reponse_tcp'");
							if($reponse_bdd->rowCount()==1) // si la reponse dans la basse de donné retourne une ligne on rentre dans la condition
							{	
								while ($resultat = $reponse_bdd->fetch()) //on boucle pour que les info recup dans la basse de donnée soient dans la vaible $resultat['non_de_la_colone']
								{	
									if($resultat['id']==$reponse_tcp)
									{
			?>
										<!--debut tu tableau avec un colone pour afficher le numero de care une pou le nom associer au numero de carte et la dernier limage de la personne-->
										<table>
											<tr>
												<th> Id de la carte: </th>
												<th> Nom: </th>
												<th> Image: </th>

											</tr>

											<tr>
												<td> <?php echo $resultat['id'] ;//on affiche l'id de la carte scanée?> </td>
												<td> <?php echo $resultat['name'] ;//on affiche le nom de la personne qui a scannée la carte ?> </td>
												<td> <?php echo "<img src='".$resultat['img']."'>";//on affiche limage de la personn qui a scanée la carte ?> </td>

											</tr>
										</table> 
										<!--Fin du Tableau afficher personne connu -->
			<?php
									}
								}
							}
							//si il n'y a pas de cohesion d'id de la carte avec la BDD on affiche un tableau avec les erreurs
							else
							{
			?>	
								 <table>
									<tr>
										<th> Id de la carte: </th>
										<th> description: </th>
										<th> Image: </th>

									</tr>

									<tr>
										 <td> <?php echo $reponse_tcp; //affiche le numero non connu de la carte  ?> </td>  
										 <td> <?php echo "cette identifiant n'est pas connu"; //commentaire dereur?> </td> 
										<td> <?php echo "<img src='images/interdit.png'>"; //affiche une image type d'erreur?> </td> 

									</tr>
								</table> 
								 <!-- Fin du Tableau afficher personne non connu  -->
			<?php
							}
				} 
				else
				{
			?>		<table>
						<tr>
							<th>Passer une carte devant le lecteur</th>
						</tr>
						<tr>
							<td><img src='images/passrfid.jpg'></td>
						</tr>
					</table>
			
			<?php		
					
				}

	
				
			?>
		</div>
	</body>
			<!--Fin du corps de page-->
</html>
