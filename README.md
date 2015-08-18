## W - Framework pédagogique

W est un framework minimaliste et pédagogique. Il suit les structures et les grand thèmes des frameworks PHP OO MVC actuels, tout en en facilitant l'approche. 

La documentation est en cours de rédaction.

---

## Installation

Pour installer le framework  :

* Dans un terminal, naviguez vers votre dossier contenant vos projets web (htdocs/ ou www/).

* Cloner le repo :
```
git clone https://github.com/guillaumewf3/W.git votre_nouveau_dossier/
```
* Installer les dépendances avec Composer :
```
cd votre_nouveau_dossier/
composer install
```
* Congifurez votre application dans `app/config.php` et `app/routes.php`

Naviguez vers http://localhost/votre_nouveau_dossier/public/

---

## Aperçu des répertoires
`public/` contient vos fichiers css, js, images (vos assets)... tous les fichiers auxquels vous donnez volotiers accès à un navigateur.
Il contient également le contrôleur frontal de l'application.

`W/` contient le framework en tant que tel. Il ne faut rien modifier ici. Si vous avez envie d'y faire des modifications, faites un Pull Request ! 

`vendor/` contient les dépendances installées par Composer. Il ne faut toucher à rien là. 

`app/` contient le code spécifique à votre projet. On y retrouve vos contrôleurs, vos managers et vos templates, et la configuration.

---

## Créer une page
Pour créer une page simple avec W, vous avez besoin de 3 éléments : 

* Une route
* Une méthode de contrôleur
* Un template

### Définir une route
Les routes permettent de faire le lien entre l'URL et une méthode spécifique de vos contrôleurs.

W utilise [AltoRouter](http://altorouter.com/ AltoRouter), un composant de routage. N'hésitez pas à en consulter [la documentation](http://altorouter.com/usage/install.html Documentation de AltoRouter). 

Les routes sont définie dans le fichier `app/routes.php`, dans le tableau `$w_routes`. Chaque route est elle-même un tableau, contenant les données suivantes : 

1. La ou les méthodes HTTP
2. Le pattern d'URL
3. Le contrôleur et la méthode à appeler
4. Le nom de la route

Ainsi, si un pattern d'URL (2) est reconnu et que la méthode HTTP (1) est la bonne, la méthode du contrôleur (3) sera automatiquement exécutée. Le nom de la route (4) est utile pour générer des URL pointant vers cette route.

Les méthodes HTTP sont séparées par des barres verticales `|`, les patterns d'URL peuvent contenir des paramètres variables (entre crochets `[]`), la méthode des contrôleurs est définie sous la forme `NomDuContrôleur#méthode` et le nom de la route est un simple chaîne. 

### Créer une méthode de contrôleur
Les contrôleurs doivent suivre une certaine convention : 

1. Ils se trouvent dans le dossier `app/Controller/`
2. Le nom de la classe est suffixé par `Controller`
3. Ils doivent normalement hériter de `\W\Controller\Controller`

Les méthodes des contrôleur devraient, après avoir effectuer un éventuel traitement, soit effectuer une redirection, soit afficher un template avec la méthode `show()`. Cette méthode accepte deux paramètres : 

1. Le chemin et le nom du template, sans l'extension
2. Un tableau de variable à rendre disponible au template

### Créer un template
W utilise [Plates](http://platesphp.com/ Native PHP Templates), un moteur de template en PHP, inspiré de [Twig](http://twig.sensiolabs.org/ Twig).

Pour créer un nouveau template, il suffit créer un fichier php dans le dossier `app/templates/`. Par convention, on place toutefois ces fichiers dans un sous-dossier portant le nom du contrôleur (ie. dossier `templates/admin/` pour les templates du contrôleur `AdminController`).  

Il est habituel de n'avoir que quelques layouts (voir un seul) pour vos applications, et que vos différentes pages "héritent" de celui-ci. Voir [la documentation de Plates à ce sujet](http://platesphp.com/templates/inheritance/ L'héritage dans Plates).

### En résumé, pour créer une page

Dans app/routes.php : 
```
<?php

$w_routes = array(
	['GET|POST', '/contact/', 'Default#contact', 'contact'],
);
``` 

Dans app/Controller/DefaultController.php : 
```
<?php	
namespace Controller;

class DefaultController extends \W\Controller\Controller
{

	public function contact()
	{
		//traiter le formulaire contact ici...
		
		$this->show('default/contact');
	}

	//...
``` 

Dans app/templates/default/contact.php : 
```
<?php 
//hérite du fichier layout.php à la racine de app/templates/
$this->layout('layout')
?>

<?php 
//début du bloc main_content
$this->start('main_content'); ?>
<h1>Contactez-nous !</h1>

<?php 
//fin du bloc
$this->stop('main_content'); ?>

``` 