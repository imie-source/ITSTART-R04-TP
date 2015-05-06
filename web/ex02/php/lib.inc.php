<?php

	/*
	 * Fichier contenant les fonctions "g�n�rales" de l'application
	 *
	 * @since 1.0
	 * @author Serge COUD�
	 */
	 
	/**
	 * V�rifie si le couple identifiant/mot de passe est correcte ou non
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
	 * Renvoie le nom de la page si l'utilisateur est authentifi�, ou bien la page '403
	 * 
	 * @param $page Page qui est demand�e
	 * @return string nom de la page demand�e ou '403'
	 * @since 1.0
	 */
	function authorizedArea($page) {
		if (isLogged())
			return $page;
		else
			return "/403.html";
	}

	/**
	 * Renvoie si l'utilisateur est identifi� ou non
	 *
	 * @return Vrai si l'utilisateur est identifi�, faux sinon
	 * @since 1.0
	 */
	function isLogged() {
		return isset($_SESSION["id"]);
	}

	/**
	 * D�connecte l'utilisateur
	 *
	 * @since 1.0
	 */
	function deconnexion() {
		// On d�truit la session
		session_destroy();
		// On d�-d�fini la variable contenant tout ce qui a �t� mis en session
		unset($_SESSION);
	}