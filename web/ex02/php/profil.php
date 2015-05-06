<?php

	/**
	 * Fichier contenant les fonctionnalit�s du profil
	 *
	 * @since 1.0
	 * @author Serge COUD�
	 */
	
	/**
	 * Fonction prenant en charge l'upload de l'image du profil utilisateur
	 * 
	 * @param $page Page qui sera affich�e si cela s'est bien pass�
	 * @return String Page qui devra �tre affich�e
	 */
	function uploadProfil($page) {
		// le fichier � �t� upload� dans un r�pertoire et porte un nom temporaire
		// que l'on peut retrouver par $_FILES["fileUp"]["tmp_name"]
		// On v�rifie s'il s'agit bien d'une image via la fonction getimagesize
		// Cette derni�re renvoie faux si elle n'a pas pu r�cup�rer les dimensions
		$check = getimagesize($_FILES["fileUp"]["tmp_name"]);
		// Si les dimensions ont �t� r�cup�es, c'est qu'il s'agit d'une image
		if ($check !== false) {
			// "Mettons" une limite haute sur le nombre d'octets de l'image : 1Mo
			if ($_FILES["fileUp"]["size"] <= 1048576) {
				// L'image fait moins de 1Mo 
				// alors d�pla�ons le fichier temporaire vers sa destination finale
				if (move_uploaded_file($_FILES["fileUp"]["tmp_name"],
									   NOM_IMAGE_PROFIL))
					// Si cela se passe bien, on renvoie la page qui doit �tre affich�e
					// apr�s un upload correct
					return $page;
			}
		}
		// Un probl�me est survenu, on renvoie la page d'erreur...
		return NOM_PAGE_UPLOADKO;
	}
	
	/** 
	 * Fonction renvoyant l'URL de l'image du profil
	 *
	 * Si l'image n'existe pas, on prend l'image par d�faut
	 * @return String URL de l'image � afficher
	 * @since 1.0
	 */
	function checkImageProfil() {
		// V�rifions si l'image "standard" est pr�sente
		if (file_exists(NOM_IMAGE_PROFIL))
			// Oui, on peut alors indiquer l'URL de l'image
			return URL_IMAGE_PROFIL;
		else
			// Non, alors on renvoie l'URL de l'image par d�faut
			return URL_IMAGE_PROFIL_DEFAUT;
	}