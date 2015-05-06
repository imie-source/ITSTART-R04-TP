<?php

	/*
	 * Fichier contenant les fonctionnalités relatives aux courses
	 *
	 * @since 1.0
	 * @author Serge COUDE
	 */
	
	/**	
	 * Fonction renvoyant la liste des courses sous formes de tableau associatif
	 *
	 * @return array Tableau des courses de la date du jour
	 */
	function getCourses() {
		// Définition du tableau qui sera renvoyé
		$tab = array();	
		// Initialisation de la librairie CURL
		$ch = curl_init();
		// Paramétrage de la connexion 
		// Définition de l'URL à appeler
		curl_setopt($ch, CURLOPT_URL, URL_COURSES);
		// Définition du timeout pour ne pas attendre pour rien si la page n'est pas accsessible
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		// On souhaite avoir le contenu de la page !
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// Quelle méthode d'authentification utilisons-nous ? Toutes, la première qui est correcte !
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		// On définit le couple identifant et mot de passe
		curl_setopt($ch, CURLOPT_USERPWD, LOGIN_COURSES . ":" . MDP_COURSES);
		// On appelle la page et on récupère son contenu
		$result = curl_exec($ch);
		// On récupère le code du status HTTP de la requète
		$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		// S'il vaut 200...
		if ($statusCode == 200) {
			// ... c'est que cela s'est bien passé
			// et on découpe le contenu de la page selon les retours chariot
			$ctn = explode("\n", $result);
			// La première ligne correspond à la date du jour
			$tab["date"] = $ctn[0];
			// Les autres lignes décrivent les courses de la journée, une par ligne
			for($i = 1; $i < count($ctn); $i++) {
				// On découpe chaque ligne selon le séparateur ';'
				$l = explode(";", $ctn[$i]);
				// On crée un tableau de la course
				$c1 = array();
				// Le premier champ est l'heure de la course
				$c1["heure"] = $l[0];
				// Le deuxième champ est le nom de la course
				$c1["nom"] = $l[1];
				// Le troisième champ est le type de la course
				$c1["type"] = $l[2];
				// Le quatrième champ est le nombre de participants
				$c1["nb"] = $l[3];
				// On ajoute la course dans la liste des courses
				$tab["courses"][] = $c1;
			}
		} else {
			// On n'a pas pu récupérer la liste des courses
			// On définit néanmoins le tableau avec des valeurs qui indiqueront
			// que la liste n'est pas récupérée
			$tab["date"] = "non connecté";
			$tab["courses"] = array();
		}
		
		/*
		$ctn = file("http://10.3.6.30/courses");
		$tab["date"] = $ctn[0];
		for($i = 1; $i < count($ctn); $i++) {
			$l = explode(";", $ctn[$i]);
			$c1 = array();
			$c1["heure"] = $l[0];
			$c1["nom"] = $l[1];
			$c1["type"] = $l[2];
			$c1["nb"] = $l[3];
			$tab["courses"][] = $c1;
		}*/	
		/*$tab["date"] = date("d/m/Y");
		$tab["courses"] = array();
		
		// première course
		$c1 = array();
		$c1["heure"] = "10h45";
		$c1["nom"] = "Course 1";
		$c1["type"] = "trot";
		$c1["nb"] = 5;
		$tab["courses"][] = $c1;
		
		// deuxième course
		$c1 = array();
		$c1["heure"] = "12h30";
		$c1["nom"] = "Course 2";
		$c1["type"] = "trot";
		$c1["nb"] = 8;
		$tab["courses"][] = $c1;
		
		// troisième course
		$c1 = array();
		$c1["heure"] = "14h50";
		$c1["nom"] = "Course 3";
		$c1["type"] = "galop";
		$c1["nb"] = 8;
		$tab["courses"][] = $c1;*/
		
		// Au final, on renvoie le tableau constitué
		return $tab;
	}	