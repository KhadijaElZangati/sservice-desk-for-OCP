<!DOCTYPE html>
<html>
<head>
	<title>À propos de nous</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="">
	<style>
		
		body {
	background-color: #f7f7f7;
	font-family: Arial, Helvetica, sans-serif;
		}
  .container {
	max-width: 960px;
	margin: 0 auto;
	padding: 30px;
	display: flex;
	flex-wrap: wrap;
	margin-left:300px;
}

.section {
	box-shadow: 12px 12px 40px rgba(0, 0, 0, 0.2);
	padding: 20px;
	margin: 10px;
	flex: 1;
	background-color: azure;
	color:azure;
   
}

.section h2 {
	font-size: 24px;
	margin-bottom: 20px;
	color: black;
}

.section p {
	font-size: 16px;
	color: azure;
	line-height: 1.6;
}

@media only screen and (max-width: 768px) {
	.section {
		flex-basis: 100%;
	}
}
/* CSS code for hover effect on sections */
.section:hover {
    background-color: limegreen;
    cursor: pointer;
    color:azure;
  }
  
  


        .sidebar {
  width: 300px;
  background-color:white;
  height: 100%;
  position: fixed;
  top: 0;
  left: 0;
  box-shadow: 12px 12px 40px black;
}

.sidebar ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.sidebar li a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

.sidebar li a:hover {
  background-color: limegreen;
  color: azure;
}
		</style>
</head>
<body>

<div class="sidebar">
  <ul>
    <li><a href="homerec.php">Home</a></li>
	<li><a href="demande.php">Nouveau ticket</a></li>
    <li><a href="about_us.php">À propos de nous</a></li>
    <li><a href="profile.php">profile</a></li>
    <li><a href="login.php">logout </a></li>
  </ul>
</div>

	<div class="container">
		<div class="section section1">
			<h2>Le Groupe OCP</h2>
			<p>Le Groupe OCP est une entreprise semi-publique sous contrôle de l'Etat marocain,
			qui extrait les phosphates et produit des engrais et de l'acide phosphorique. Les activités
			du groupe couvrent l'ensemble de la chaîne de valeur, depuis l'extraction des phosphates
			jusqu'à la commercialisation de produits finis.</p>
		</div>
		<div class="section section2">
			<h2>Notre Help Desk</h2>
			<p>Notre help desk est votre guichet unique pour obtenir de l'aide technique rapide et professionnelle pour nos produits et services. Que vous ayez besoin d'aide pour résoudre un problème technique ou que vous cherchiez simplement des informations sur l'utilisation de notre produit, notre équipe d'experts est là pour vous aider.</p>
		</div>

		
	</div>
	<div class="container">

	<div class="section section3">
			<h2>l’historique de l’OCP </h2>
			<p>OCP a été créé en 1920 en tant que Office Chérifien des Phosphates. Ils ont démarré leur activité avec l’exploitation d’une première mine à Khouribga. Leurs activités s’étendent aujourd’hui sur cinq continents et ils travaillent tout au long de la chaîne de valeur des phosphates que ce soit dans l’extraction minière, la transformation industrielle ou encore l’éducation et le développement de communautés.
OCP a démarré sa production en mars 1921 à Khouribga et exporté ses premiers produits depuis le port de Casablanca plus tard la même année. Une deuxième mine a été ouverte à Youssoufia en 1931 ainsi qu’une troisième plus tard en 1976 à Benguerir. Le Groupe OCP s’est ensuite diversifié en investissant dans la transformation des phosphates et en implantant des sites chimiques à Safi (1965) et Jorf Lasfar (1984).
En 2008, l’Office Chérifien des Phosphates est devenu OCP Group S.A., propriété de l’Etat marocain et du Groupe Banque Populaire. Leur success-story a renforcé leur relation avec leurs communautés, ancré leur engagement à réduire l’impact de leurs activités sur l’environnement et motivé leurs partenariats avec des entreprises locales et internationales innovantes.
</p>
		</div>
	
		<div class="section section2">
			<h2> Digital Office </h2>
			<p>Digitale au sein du Groupe, notamment en charge de :
	Elaborer une stratégie digitale du Groupe et la décliner en feuille de route, en Co-création avec les différentes entités du Groupe ;
	Conduite de la mise en œuvre des initiatives digitales de la feuille de route, en étroite collaboration avec les différentes entités du Groupe ;
	Mettre en place, en collaboration avec les différentes entités du groupe, les infrastructures, moyens et structures nécessaires à la réussite de la transformation digitale du Groupe (digitale Factory et modes de fonctionnement agiles, data lake, staffing, capability building, etc.,) ;
	Promouvoir une culture digitale au sein du groupe, et insuffler de nouveaux modes de travail et de collaboration via le digital ;
	Mettre en place des plateformes d’incubation permettant l’émergence d’initiatives innovantes et de nouveau modes de fonctionnement
</p>
		</div>
			
	</div>
</body>
</html>
