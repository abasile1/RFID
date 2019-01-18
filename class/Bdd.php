<?php
	class Bdd 
	{
		private $_db; 

		/* constructeur qui permet la connection à la bdd */
		public function __construct($ip_bdd,$name_bdd,$user_bdd,$mdp_bdd) 
		{
			try
			{
				$this->_db = new PDO('mysql:host='.$ip_bdd.';dbname='.$name_bdd.';charset=utf8',$user_bdd,$mdp_bdd);
			}
			catch (Exception $e)
			{
	        	die('Erreur : ' . $e->getMessage());
			}
		}
		public function requete($requete)
		{
			$requeste=$this->_db->query($requete);
			return $requeste;
		}
			
	}
?>