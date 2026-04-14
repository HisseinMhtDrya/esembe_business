<?php

  	class connexiondb {
		private $host    = 'localhost';   
		private $dbname  = 'esembe_business';   
		private $user    = 'root';      
		private $pass    = '';     
		private $connexion;
		
		function __construct($host = null, $dbname = null, $user = null, $pass = null){
			if($host != null){
		        $this->host = $host;           
		        $this->name = $dbname;           
		        $this->user = $user;          
		        $this->pass = $pass;
			}
			try{
		    	$this->connexion = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname,
					$this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8MB4', 
					PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		  	}catch (PDOException $e){
		        echo 'Erreur : Impossible de se connecter  à la base de données !';
				die();
			}
		}
		
		public function connexion(){
			return $this->connexion;
		}
  	}
  	
  	$db = new connexiondb;
  	
  	$bdd = $db->connexion();
 
?>
