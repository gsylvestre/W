<h2>Les routes</h2>
<h3>À quoi servent les routes ?</h3>
<p>Les routes permettent d'associer simplement des URL virtuelles à des pages spécifiques de votre site. Plus précisémment, elles vous permettent d'exécuter une méthode de contrôleur que vous avez choisie, en fonction d'un masque d'URL.</p>

<p>Par exemple, vous pouvez décider d'associer l'URL <span class="code">http://www.domain.com/services/</span> à la méthode de contrôleur <span class="code">services()</span>, et l'URL <span class="code">http://www.domain.com/a-propos/</span> à la méthode <span class="code">about()</span>. 

<h3>Comment créer une nouvelle route ?</h3>
<p>Toutes les routes doivent être définie dans le fichier <span class="code">app/routes.php</span>, dans le tableau <span class="code">$w_routes</span>.
<p>Chacune des routes, ou association entre une URL et une méthode de contrôleur, est définie par un tableau associatif de 4 éléments ayant ce format : </p>

<pre><code>[
	"GET", 				//la ou les méthodes HTTP de la requête
	"/services/",		//le masque d'URL à associer 
	"Default#services",	//le nom du contrôleur et le nom de la méthode à appeler
	"default_services"	//le nom de cette route-ci
]</code></pre>

<p>Cette route sera donc sélectionnée par le routeur si les conditions suivantes sont remplies : </p>
<ul>
	<li>La requête est réalisée précisémment à l'URL <span class="code">http://www.domain.com/services/</span></li>
	<li>La requête est réalisée en GET (et non en POST par exemple)</li>
</ul>
<p>Si cette route est sélectionnée, la méthode <span class="code">services()</span> du <span class="code">\Controller\DefaultController</span> sera exécutée.</p>

<p>Voyons chacun des ces éléments de définition de routes plus en détails.</p>


<h4>Élément #1 : les méthodes HTTP</h4>
<p>Le premier élément d'un tableau de route est la méthode HTTP requise afin que la route soit sélectionnée. Il est possible de spécifier plusieurs méthodes en les séparant par une barre verticale.</p>
<p>Ainsi, la route 
<pre><code>["POST", "/contact/", "Default#contact", "default_contact"],</code></pre>
sera sélectionnée que si la requête est réalisée en POST.</p>
<p>Pour que cette même route soit sélectionnée en GET <em>et/ou</em> en POST, comme par exemple si vous souhaitez afficher et traiter le formulaire dans la même méthode, utilisez la barre verticale : 
<pre><code>["GET|POST", "/contact/", "Default#contact", "default_contact"],</code></pre>
</p>


<h4>Élément #2: le masque d'URL</h4>
<p>Le masque d'URL indique à quoi doit ressembler l'URL afin que cette route soit choisie.</p>
<p>Le masque est donc une simple chaîne, commençant toujours par un <span class="code">/</span>, et dont le chemin est relatif au nom de domaine, ou à la clef de configuration "base_url" si votre site est accessible dans un sous-dossier (public/ par exemple) (<a href="?p=configuration" title="Chapitre sur la configuration">voir ici</a> pour plus de détails).</p>
<p>Ainsi, si votre site est accessible à <span class="code">http://localhost/projet/public/</span>, vos masques d'URL seront interprétés relativement au dernier <span class="code">/</span>.</p>
<p>Vous pouvez sans problème ajouter des <em>sous-dossiers virtuels</em> dans vos URLs. En fait, vous pouvez utiliser n'importe quel caractère d'URL valide : </p>
<pre><code>$w_routes = [
	["GET", "/services/", "Default#services", "default_service"],
	["GET", "/services/vente/", "Default#vente", "default_vente"],
	["GET", "/services/location-et-services/", "Default#location", "default_location"],
]</code></pre>
<p>Notez que le <span class="code">/</span> final n'est pas obligatoire, mais qu'il devra être présent dans vos URLs si vous l'avez indiqué dans vos routes.</p>

<h5>Les paramètres dynamiques</h5>
<p>Il est possible de définir des portions d'URLs dynamiques dans vos masques. En effet, des expressions rationnelles peuvent être utilisées afin d'inclure l'équivalent de paramètres d'URLs GET, directement dans vos routes.</p>
<p>Par exemple, au lieu d'avoir des URLs de type <span class="code">http://www.domain.com/biens-en-vente/?id=456</span>, vous pourrez facilement avoir des URLs plus esthétiques, de type <span class="code">http://www.domain.com/biens-en-vente/456/</span>.

<?php @todo ?>



<h4>Élément #3 : la méthode du contrôleur associée</h4>
<h4>Élément #4 : le nom de la route</h4>
	Créer des liens
	Rediriger
