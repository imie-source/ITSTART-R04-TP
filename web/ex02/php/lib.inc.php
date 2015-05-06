<?php

	/*
	 * Fichier contenant les fonctions "générales" de l'application
	 *
	 * @since 1.0
	 * @author Serge COUDÉ
	 */
	 
	/**
	 * Vérifie si le couple identifiant/mot de passe est correcte ou non
	 *
	 * @param $ident Identifiant de l'utilisateur
	 * @param $mdp Mot de passe de l'utilisateur
	 * @return Vrai si le couple est correcte, faux sinon
	 * @since 1.0
	 */
	function checkIdMdp($ident, $mdp) {
		if ($ident == "serge" && 
			$mdp == "coucou")
			return true;
		else
			return false;	
	}
	
	/**
	 * Renvoie le nom de la page si l'utilisateur est authentifié, ou bien la page '403
	 * 
	 * @param $page Page qui est demandée
	 * @return string nom de la page demandée ou '403'
	 * @since 1.0
	 */
	function authorizedArea($page) {
		if (isLogged())
			return $page;
		else
			return "/403.html";
	}

	/**
	 * Renvoie si l'utilisateur est identifié ou non
	 *
	 * @return Vrai si l'utilisateur est identifié, faux sinon
	 * @since 1.0
	 */
	function isLogged() {
		return isset($_SESSION["id"]);
	}

	/**
	 * Déconnecte l'utilisateur
	 *
	 * @since 1.0
	 */
	function deconnexion() {
		// On détruit la session
		session_destroy();
		// On dé-défini la variable contenant tout ce qui a été mis en session
		unset($_SESSION);
	}