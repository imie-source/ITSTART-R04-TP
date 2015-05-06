<?php

	/*
	 * Script contenant les d�finitions des constantes
	 * et des param�tres pouvant �tre modifi�s
	 *
	 * @since 1.0
	 * @author Serge COUD�
	 */

	// Constante indiquant le chemin absolu du r�pertoire contenant les fichiers HTML 
	// Utilisation de la constante magique __DIR__
	define("REP_HTML", __DIR__ . "/../html");
	// Constante indiquant le chemin absolu du r�pertoire contenant les fichiers PHP 
	define("REP_PHP", __DIR__ . "/../php");
	
	// Constante indiquant l'URL o� aller r�cup�rer les informations des courses 
	define("URL_COURSES", "http://localhost:80/courses/index2.php");
	// Constante indiquant l'identifiant � utiliser pour r�cup�rer les informations des courses
	define("LOGIN_COURSES", "itstart");
	// Constante indiquant le mot de passe � utiliser pour r�cup�rer les informations des courses
	define("MDP_COURSES", "2015");
	
	// Constante indiquant le chemin absolu du r�pertoire contenant les m�dias
	define("REP_MEDIAS", __DIR__ . "/../medias");
	// Constante indiquant le chemin absolu du r�pertoire des images
	define("REP_IMAGES", REP_MEDIAS . "/images/");
	// Constante indiquant l'URL de l'image du profil par d�faut
	define("URL_IMAGE_PROFIL_DEFAUT", "medias/images/image_profil-defaut.png");
	// Constante indiquant l'URL de l'image du profil
	define("URL_IMAGE_PROFIL", "medias/images/image_profil.png");
	// Constante indiquant le chemin absolu de l'image du profil
	define("NOM_IMAGE_PROFIL", REP_IMAGES . "/image_profil.png");
	// Constante indiquant le nom de la page en cas d'erreur d'upload
	define("NOM_PAGE_UPLOADKO", "/uploadko.html");