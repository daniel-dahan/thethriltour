<?php
	$nom = "COACHELLA";
	$keywords = "THE THRILL TOUR, THETHRILLTOUR, THRILL, TOUR";
	$description = "Vivez une expérience unique en immersion totale au coeur des festivals. Privilégiés, vous profiterez d'un service haut de gamme guidé par un initié.";
	include("src/include/head.html");
?>
<body id="festivalDetail">
	<div id="chargement">
		<h2 class="cutText">C</h2>
		<div id="chargement-infos">
			<span class="loading">0</span>
		</div>
	</div>
	<div class="mask">
	</div>
	<header>
		<h1>
			<a href="/" title="Accueil The Thrill Tour" >
				<img src="../../media/img/logo.svg" alt="Logo The Thrill Tour" width="200" height="50" />
				<span>THE THRILL TOUR</span>
			</a>
		</h1>
	</header>
	<div id="containerVideo">
		<video poster="/media/img/festivalgirl.jpg" >
			<source src="/media/video/coachella.mp4" type="video/mp4" />
		</video>
		<div id="play"></div>
	</div>
	<div id="main">
		<div class="infos">
			<div class="contentCircle">
				<?php
					include("src/include/festival.php")
				?>
			</div>
		</div>
		<a href="#" class="share" title="Partager Coachella avec The Thrill Tour" >
			<img src="media/img/share.svg" alt="Partager l'offre Coachella" />
			PARTAGER
		</a>
		<a href="#" class="buttonBig" title="Aller à la page de réservation" >
			Réserver votre place
		</a>
		<h2 class="titleFestival">
			Programme<br />
			<span class="nameFest">Coachella</span>
			<span class="sep"></span>
		</h2>
		<div class="wrapper900">
			<div id="festival">
				<div class="left">
					<h3 class="titleSection">Le festival</h3>
					<div class="orangeCircles">
						<div class="innerBorder">
							<div class="smallBorder">
								<div class="centerCircle">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="right">
					<p> 
						Baigné par le soleil de Californie; imprégnez-vous de l'ambiance unique du festival de Cocachella: des personnalités, des palmiers et des têtes d'affiches qu'on ne retrouve nulle part ailleurs.<br /><br />
						Une programmation éclectique de prestige qui saura vous séduire.<br /><br />
						En 2016, on retrouvait des pontes du rap comme <span class="white">Rune the Jewels, Ice Cube, Death Grips ou A$AP Rocky</span>; des rockeurs réputés tels <span class="white">The Kills, Foals, Savages, Courtney Barnett, Ex Hex, Beach House, The Last Shadow Puppets, Rancid</span>; mais aussi des producteurs de renom à linstar de <span class="white">Major Lazer, Flume, Discolsure, Hudson Mohawke, DJ Koze...</span><br />
						Cette programmation pointue s'associe à la mode hippie, bohème chic, et à l'affluence de nombreuses célébrités qui s'y rendent pour s'amuser, mais aussi pour être vues. Coachelle est devenu "the place to be". Vous côtoierez, le temps d'un week-end, les célébrités les plus branchées du moment. Ce festival est l'endroit rêvé pour vous faire remarquer.
					</p>
				</div>
			</div>
			<div class="greyCircles">
				<div class="innerBorder">
					<div class="centerCircle">
					</div>
				</div>
				<div class="smallBorder"></div>
			</div>
			<div id="services">
				<div class="left">
					<p>
						<span class="white">The Thrill Tour</span> vous permet de vivre une expérience unique en immersion totale au coeur du festival. Pris en charge à l'aéroport par notre équipe, vous aurez à votre disposition un bus haut confort équipé de sanitaires, d'une douche, de couchettes, d'un espace lounge, de l'air conditionné et du wifi à volonté.<br /><br />
						Vous n'aurez plus à vous soucier de quoi que ce soit d'autre que de vous amuser et de profiter de l'instant présent. The Thrill Tour est là pour vous.
					</p>
				</div>
				<div class="right">
					<h3 class="titleSection">Nos services</h3>
				</div>
				<div id="avantages">
					<h4>En possession de votre pass, vous profiterez d'avantages exclusifs tels que :</h4>
					<p>
						<span>La découverte des backstages</span><br />
					</p>
					<p>
						<span>La rencontre avec Elia Aboumrad, chef patissière originaire du Mexique. </span><br />
						<span>Finaliste de la saison 2 de Top Chef aux États-Unis, elle a travaillé </span><br />
						<span>quatre ans sous la tutelle de </span><br />
						<span>Joël Robuchon à Paris et à Las Vegas.</span><br />
					</p>
					<p>
						<span>Un survol en hélicoptère du festival (Blade Helicopter)</span><br />
					</p>
					<p>
						<span>Assister aux concerts depuis la scène</span><br />
					</p>
					<p>
						<span>Rencontrer les artistes et découvrir les loges</span><br />
					</p>
					<p>
						<span>Participer à la Nylon Midnight Garden Party dans le désert californien : avec plus de 500 invités VIP,</span>
						<span>c'est le lieu où il faut être si vous souhaitez danser toute la nuit</span>
						<span>avec une célébrité. Katy Perry, Justin Bieber ou Chris Brown ont participé à la soirée l'an dernier.</span>
					</p>
					<p>
						<span>L'accès aux fosses VIP accessibles uniquement aux sponsors, aux artistes et aux célébrités.</span>
					</p>
					<p>
						<span>L'accès aux zones VIP exclusives avec bars, restauration et espace détente.</span>
					</p>
					<p>
						<span>Un tour de grande roue à bord de la Coachella Ferris Wheel, pour avoir</span>
						<span>une vue panoramique imprenable sur le festival</span>
					</p>
				</div>
				<p class="photograph">
					Un photographe vous suivra pour filmer et photographier chaque moment, afin d'immortaliser votre séjour inoubliable.
				</p>
			</div>
			<div id="guide">
				<h3 class="titleSection">Votre guide</h3>
				<div class="nameGuide">
					<span class="prenom">Ronnie</span> <span class="nom">Madra</span>
				</div>
				<p class="descriptionGuide">
					Vous serez accompagné tout au long de votre séjour par Ronnie Madra, co-fondateur de Butter Group (boîtes de nuit célèbres). Il fréquente le festival de Coachella depuis plus de 10 ans. Son réseau comprend non seulement les patrons et fondateurs de marques de luxe mondiales, mais il compte également une liste d'acteurs, d'artistes et de mannequins parmi son cercle d'amis. Ronnie Madra connaît tout sur la façon dont les VIP célèbrent le festival, et vous en fera profiter comme il se doit.
				</p>
				<a href="#" class="share" title="Blog de Ronnie Madra">
					INSTAGRAM DE RONNIE MADRA<img src="/media/img/flech.svg" alt="Visiter le blog de Ronnie Madra" />
				</a>
			</div>
			<div id="partenariat">
				<div class="right">
					<h3 class="titleSection">Partenariat</h3>
				</div>
				<div class="left">
					<p>
						The Thrill Tour s'associe à la célèbre marque SUPREME, et vous offre un t-shirt qui ne manque pas de caractère, à l'image de votre expérience.
					</p>
					<a href="http//:www.supremenewyork.com/" class="share" title="Voir notre partenariat">
						Marque SUPREME <img src="/media/img/flech.svg" alt="Partenariat avec la marque SUPREME"/>
					</a>
				</div>
			</div>
		</div>
		<img src="/media/img/partner-orange.svg" class="bgPartenariat" alt="Partenariat The Thrill Tour" />
		<div class="wrapper900">
			<div class="circle"></div>
			<a href="#" class="share" title="Partager Coachella avec The Thrill Tour" >
				<img src="media/img/share.svg" alt="Partager l'offre Coachella" />
			PARTAGER
			</a>
			<a href="#" class="buttonBig" title="Aller à la page de réservation" >
				Réserver votre place
			</a>
		</div>
		<div class="bigSep"></div>
		<div class="wrapper900" id="suggest">
			<p class="more">Voir aussi</p>
			<div class="flexContent">
				<a href="#" title="Voir Tomorrowland Festival" >
					Tomorrowland
					<br />
					<span>festival</span>
				</a>
				<div class="vSep"></div>
				<a href="#" title="Voir Ultra Music Festival" />
					Ultra Music
					<br />
					<span>festival</span>
				</a>
			</div>
		</div>
	</div>
<?php
	include("src/include/footer.html");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="src/js/loader.js"></script>
<script type="text/javascript" src="src/js/festival.js"></script>
</body>
</html>