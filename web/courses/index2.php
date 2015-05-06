<?php

	/**
	 * Script générant la page contenant la liste des courses du jour
	 *
	 * Une sécurité a été mise en place, la page doit être accédée 
	 * avec une authentification "basic"
	 * 
	 * @since 1.0
	 * @author Serge COUDÉ
	 */
	 
	// Définition de l'identifiant de connexion
	define("LOGIN", "itstart");
	// définition du mot de passe de connexion
	define("MDP", "2015");
	
	// Si le navigateur ne présente pas de couple login/mot de passe
	// ou que l'identifiant ne correspond pas
	// ou que le mot de passe ne correspond pas
	if(!isset($_SERVER['PHP_AUTH_USER']) || 
		$_SERVER['PHP_AUTH_USER'] != LOGIN ||
		$_SERVER['PHP_AUTH_PW'] != MDP) {
		// On envoie des entêtes HTTP pour forcer la demande de login/mot de passe
		header('WWW-Authenticate: Basic realm="Zone restreinte pour les ITStarts 2015"');
		header('HTTP/1.0 401 Unauthorized');
		// Si l'utilisateur annule, alors on affiche le message suivant :
		die("Vous devez saisir un login/mot de passe authoris&eacute;...");
	} else {
		// l'identification est correcte
		// On génère la liste des courses...
		echo date("d/m/Y") . "\n";
		echo "12h45;La course du midi;galop;8\n";
		echo "13h25;La pero course;trot;3\n";
		echo "14h30;La digest yves;galop;4\n";
		echo "15h10;La reloud;trot attelé;8\n";
		echo "16h00;Le gout T;trot;5\n";
		echo "16h45;La effun;galop;8\n";
		echo "16h64;Selle dont on ne doit pas dire le nom;galop;1\n";
		echo "21h00;La prime time;trot;7\n";
		echo "23h30;La horse pryde (-18, chevaux de moins de...);galipette;10";
	}