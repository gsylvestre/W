<?php

	//vendor installé ? 
	if (!file_exists("../vendor/autoload.php")){
		echo '<p>Vous devez installer les dépendances du projet avec la commande <code>composer install</code>. En effet, ceux-ci ne sont pas versionnés.</p>';
		die();
	}

	require("../vendor/autoload.php");

	//config.php créé ?
	if (!file_exists("../app/config.php")){
		echo '<p>Vous devez créer le fichier <code>app/config.php</code>, en créant une copie du fichier <code>app/config.dist.php</code></p>';
		die();
	}

	require("../app/config.php");
	require("../W/globals.php");

	$app = new W\App($w_routes, $w_config);

	//base_url configuré si en localhost ?
	if ($app->getConfig('base_url') == "" && $_SERVER['HTTP_HOST'] == "localhost"){
		echo '<p>La configuration <code>base_url</code> est peut-être manquante !</p><p>Requise par AltoRouter si votre site est accessible dans un sous-dossier, même si ce celui-ci est <code>public/</code>, la configuration <code>base_url</code> permet de spécifier le chemin relatif à votre domaine, menant à la racine de votre appli. Ainsi, si vous travaillez dans <code>http://localhost/mes-projets/projet-lorem/public/</code>, la valeur de base_url devrait être <code>/mes-projets/projet-lorem/public</code>.</p>';
		echo 'Attention : vous devez inclure le slash initial, et exclure le slash final !</p>';
		echo '<p>Si votre site est accessible par un domaine pointant directement dans le dossier <code>public/</code>, alors vous pouvez omettre cette clef de configuration.</p>';
		die();
	}

	//tout a l'air OK !
	echo '<p>Good job.</p>';
	echo '<a href="./">Accueil</a>';