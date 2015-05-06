<?php

	/*
	 * Script en charge du contrôle de l'application
	 * Toute requète HTTP passe par lui, il route alors vers les bons scripts
	 *
	 * @since 1.0
	 * @author Serge COUDÉ
	 */
	
	// Lancement de la session à chaque chargement du script
	session_start();
	// On a besoin des constantes
	require("config.inc.php");
	// On a besoin des fonctions "générales" à l'application
	require("lib.inc.php");

	// On récupère la date...
	$date = date("d/m/Y");
	// ... et l'heure
	$heure = date("H:i:s");
	
	// Définition de la variable action qui va permettre de savoir quelle action est demandée
	// Par défaut, on ne sait pas -> ""
	$action = "";
	// Si jamais action a été passée par la méthode GET via la querystring
	if (isset($_GET["action"]))
		// On minusculise la valeur pour comparer plus facilement
		$action = strtolower($_GET["action"]);
	// Définition d'une variable contenant la page qui devra être affichée et qui
	// est située dans le répertoire contenant les "blocs" HTML
	$page = REP_HTML;	
	// Selon l'action demandée
	switch($action) {
		case "cnx": // demande d'authentification
			// Définition de la variable qui contiendra éventuellement le message
			// informant de l'erreur d'authentification
			$msgErr = "";
			// S'il y a eu soumission de formulaire
			if (isset($_POST["ident"])) {
				// Si le couple login/mot de passe est correct
				if (checkIdMdp($_POST["ident"], $_POST["mdp"])) {
					// alors on va sur la page accueil
					$page .= "/accueil.html";
					// On définit la variable contenant l'identifiant pour l'affichage
					// dans l'entête
					$ident = $_POST["ident"];
					// On définit dans la session un élément d'indice 'id' qui contiendra
					// l'identifiant de la personne
					$_SESSION["id"] = $_POST["ident"];
					break;
				} else // Le login/mot de passe n'est pas correct
					$msgErr = "mauvais identifiant/mot de passe";
			} 
			// On va/revient à la page d'authentification
			$page .= "/auth.html";
			break;
		case "courses":
			// La page des courses est demandée
			$page .= "/courses.html";
			// On a besoin de fonctions spécifiques aux courses
			require(REP_PHP . "/courses.php");
			// On récupère un tableau contenant la liste des courses de la journée
			$lesCourses = getCourses();
			break;
		case "paris":
			// On demande la page des paris, elle est "protégée", c'est à dire qu'on doit
			// être authentifié pour y accéder
			$page .= authorizedArea("/paris.html");
			break;
		case "profil":
			// On demande la page du profil, elle est "protégée", c'est à dire qu'on doit
			// être authentifié pour y accéder
			$page .= authorizedArea("/profil.html");
			// On "prépare" la page avec l'image du profil
			// On a besoin de fonctions spécfiques au profil
			require(REP_PHP . "/profil.php");
			$urlImageProfil = checkImageProfil();
			break;
		case "uploadprofil":
			// On soumet le formulaire d'upload de l'image de son profil
			// On a besoin de fonctions spécfiques au profil
			require(REP_PHP . "/profil.php");
			// On prend en charge l'upload et s'il se passe bien, on va à la page du profil
			$page .= uploadProfil("/profil.html");
			$urlImageProfil = checkImageProfil();
			break;
		case "decnx":
			// On a demandé à se déconnecter
			deconnexion();
			// et...
		default:
			// ...par défaut, on va à la page accueil
			$page .= "/accueil.html";
			break;
	}
	
	// Configuration du "bouton" de la barre de navigation 
	// Si on est authentifié
	if (isLogged()) {
		// Le libellé du "bouton" vaut
		$navBoutonCnx = "Déconnexion";
		// et son action est
		$navActionCnx = "decnx";
	} else {
		// Le libellé du "bouton" vaut
		$navBoutonCnx = "Connexion";
		// et son action est
		$navActionCnx = "cnx";
	}
	
	// Définition de la variable contenant l'id de l'utilisateur
	// Par défaut, elle vaut ""
	$id = "";
	// Si dans la session est présent l'élément d'indice 'id'
	if (isset($_SESSION["id"]))
		// alors la variable prend sa valeur
		$id = $_SESSION["id"];
	
	// Le "bouton" profil est-il ou non affiché dans la barre de navigation ?
	$profil = isLogged() ? "inline-block" : "none";
	
	// confection de la page avec les "blocs" HTML
	include(REP_HTML . "/entete.html");
	include(REP_HTML . "/nav.html");
	// Inclusion de la page qui a été demandée
	include($page);
	include(REP_HTML . "/pied.html");
