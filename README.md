## W - Framework pédagogique

W est un framework minimaliste et pédagogique. Il suit les structures et les grand thèmes des frameworks PHP OO MVC actuels, tout en en facilitant l'approche. 

La documentation est en cours de rédaction.

### Installation

Pour installer le framework  :

* Dans un terminal, naviguez vers votre dossier contenant vos projets web (htdocs/ ou www/).

* Cloner le repo :
```
git clone https://github.com/WebForce3Admin/FrameworkPedagogique.git votre_nouveau_dossier/
```
* Installer les dépendances avec Composer :
```
cd votre_nouveau_dossier/
composer install
```
* Lancer la commande d'installation :
```
php W/console install
```

### Test de l'installation
Une page d'accueil devrait s'afficher si vous naviguez vers http://localhost/votre_nouveau_dossier/public/ , et une base de données contenant une table pour les utilisateurs devrait avoir été créée. 
