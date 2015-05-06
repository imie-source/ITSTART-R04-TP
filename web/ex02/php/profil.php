<?php

	/**
	 * Fichier contenant les fonctionnalités du profil
	 *
	 * @since 1.0
	 * @author Serge COUDÉ
	 */
	
	/**
	 * Fonction prenant en charge l'upload de l'image du profil utilisateur
	 * 
	 * @param $page Page qui sera affichée si cela s'est bien passé
	 * @return String Page qui devra être affichée
	 */
	function uploadProfil($page) {
		// le fichier à été uploadé dans un répertoire et porte un nom temporaire
		// que l'on peut retrouver par $_FILES["fileUp"]["tmp_name"]
		// On vérifie s'il s'agit bien d'une image via la fonction getimagesize
		// Cette dernière renvoie faux si elle n'a pas pu récupérer les dimensions
		$check = getimagesize($_FILES["fileUp"]["tmp_name"]);
		// Si les dimensions ont été récupées, c'est qu'il s'agit d'une image
		if ($check !== false) {
			// "Mettons" une limite haute sur le nombre d'octets de l'image : 1Mo
			if ($_FILES["fileUp"]["size"] <= 1048576) {
				// L'image fait moins de 1Mo 
				// alors déplaçons le fichier temporaire vers sa destination finale
				if (move_uploaded_file($_FILES["fileUp"]["tmp_name"],
									   NOM_IMAGE_PROFIL))
					// Si cela se passe bien, on renvoie la page qui doit être affichée
					// après un upload correct
					return $page;
			}
		}
		// Un problème est survenu, on renvoie la page d'erreur...
		return NOM_PAGE_UPLOADKO;
	}
	
	/** 
	 * Fonction renvoyant l'URL de l'image du profil
	 *
	 * Si l'image n'existe pas, on prend l'image par défaut
	 * @return String URL de l'image à afficher
	 * @since 1.0
	 */
	function checkImageProfil() {
		// Vérifions si l'image "standard" est présente
		if (file_exists(NOM_IMAGE_PROFIL))
			// Oui, on peut alors indiquer l'URL de l'image
			return URL_IMAGE_PROFIL;
		else
			// Non, alors on renvoie l'URL de l'image par défaut
			return URL_IMAGE_PROFIL_DEFAUT;
	}