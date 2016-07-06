<?php
	include("php/bdd.php");
	include("php/functions.php");
	$slug = $_GET["slug"];
	$festival = $bdd->prepare('SELECT * FROM `festival` WHERE `slug` = :slug');
	$festival->execute(array(
		'slug' => $_GET['slug']
	));
	if(!$festival){
		return;
	}
	while ($donnees = $festival->fetch()){
		$nom = $donnees['nom'];
		$descriptionFest = $donnees['description'];
		$place = $donnees['place'];
		$day = $donnees['day'];
		$month = $donnees['month'];
		$year = $donnees['year'];
		$video = $donnees['video'];
		$thumbnail = $donnees['thumbnail'];
		$couleur = $donnees['couleur'];
		$guide = $bdd->query('SELECT * FROM `guide` WHERE `id` = '.$donnees["id_guide"].'');
		$id_services = $bdd->query('SELECT * FROM `festival_services` WHERE `id_festival` = '.$donnees["id"].'');	
		while ($data_guide = $guide->fetch()){
			$nomGuide = $data_guide['nom'];
			$prenomGuide = $data_guide['prenom'];
			$descriptionGuide = $data_guide['description'];
			$lienGuide = $data_guide['blog'];
		}
	}
	
	$listFestivalRand = listFestivalRand($nom,2);
	$keywords = 'THE THRILL TOUR, THETHRILLTOUR, THRILL, TOUR, '.$nom;
	$description = 'Vivez une expérience unique en immersion totale au coeur du festival de '.$nom.'. Privilégiés, vous profiterez d\'un service haut de gamme guidé par un initié.';
	include("src/include/head.html");
?>
<body id="festivalDetail" class="<?php echo $couleur; ?>">
<?php include("src/include/header.html") ?>
<div id="containerVideo">
	<video poster="/media/img/<?php if($thumbnail == ""){echo 'festivalgirl.jpg';} else{echo $thumbnail;} ?>" >
		<source src="/media/video/<?php if($video == ""){echo 'coachella';} else{echo $video;} ?>.mp4" type="video/mp4" />
	</video>
	<div id="play"></div>
</div>
<div id="main">
	<div class="infos">
		<div class="contentCircle">
			<div class="centerFestival">
				<div class="circle green">
				</div>
				<h3>
					<?php echo $nom ?>
					<br />
					<span>festival</span>
				</h3>
				<p class="place">
					<?php echo $place ?>
				</p>
				<p class="date">
					<span class="day"><?php echo str_pad( $day, 2, '0',  STR_PAD_LEFT )  ?></span>
					<span class="month"><?php echo str_pad( $month, 2, '0',  STR_PAD_LEFT ) ?></span>
					<span class="year"><?php echo $year ?></span>
				</p>
			</div>
		</div>
	</div>
	<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A//thethrilltour.com/festival/<?php echo $slug ?>.html" target="_blank" class="share" title="Partager Coachella avec The Thrill Tour" >
		<img src="/media/img/share.svg" alt="Partager l'offre Coachella" />
		PARTAGER
	</a>
	<a href="/reservation/<?php echo $slug ?>.html" class="buttonBig" title="Aller à la page de réservation" >
		Réserver votre place
	</a>
	<h2 class="titleFestival">
		Programme<br />
		<span class="nameFest"><?php echo $nom; ?></span>
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
					<?php echo $descriptionFest; ?>
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
				<?php
					while ($data_id_services = $id_services->fetch()){
						$services = $bdd->query('SELECT * FROM `services` WHERE `id` = '.$data_id_services["id_services"].'');	
						while ($data_services = $services->fetch()){
							echo('<p><span>'.$data_services['detail'].'</span><br /></p>');
						}
					}
				?>
			</div>
			<p class="photograph">
				Un photographe vous suivra pour filmer et photographier chaque moment, afin d'immortaliser votre séjour inoubliable.
			</p>
		</div>
	</div>
	<div class="contentServices">
		<img src="/media/img/services-<?php echo $couleur; ?>.svg" class="bgServices" alt="Services The Thrill Tour" />
	</div>
	<div class="wrapper900">
		<div id="guide">
			<h3 class="titleSection">Votre guide</h3>
			<div class="nameGuide">
				<span class="prenom"><?php echo $prenomGuide; ?></span> <span class="nom"><?php echo $nomGuide ?></span>
			</div>
			<p class="descriptionGuide">
				<?php echo $descriptionGuide ?>
			</p>
			<a href="<?php echo $lienGuide; ?>" target="_blank" class="share" title="Blog de <?php echo (''.$prenomGuide.' '.$nomGuide.''); ?>">
				Voir plus sur <?php echo (''.$prenomGuide.' '.$nomGuide.''); ?><img src="/media/img/flech.svg" alt="Visiter le blog de <?php echo (''.$prenomGuide.' '.$nomGuide.''); ?>" />
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
				<a href="http://www.supremenewyork.com/shop" class="share" target="_blank" title="Voir notre partenariat">
					Marque SUPREME <img src="/media/img/flech.svg" alt="Partenariat avec la marque SUPREME"/>
				</a>
			</div>
		</div>
	</div>
	<div class="contentPartner">
		<img src="/media/img/partner-<?php echo $couleur; ?>.svg" class="bgPartenariat" alt="Partenariat The Thrill Tour" />
	</div>
	<div class="wrapper900">
		<div class="circle"></div>
		<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A//thethrilltour.com/festival/<?php echo $slug ?>.html" class="share" target="_blank" title="Partager Coachella avec The Thrill Tour" >
			<img src="/media/img/share.svg" alt="Partager l'offre Coachella" />
		PARTAGER
		</a>
		<a href="/reservation/<?php echo $slug ?>.html" class="buttonBig" title="Aller à la page de réservation" >
			Réserver votre place
		</a>
	</div>
	<div class="bigSep"></div>
	<div class="wrapper900" id="suggest">
		<p class="more">Voir aussi</p>
		<div class="flexContent">
			<?php
				foreach( $listFestivalRand as $key => $festival ) {
			?>
				<div>
					<div class="circle <?php echo $festival['couleur']; ?>"></div>
					<a href="/festival/<?php echo $festival['slug'] ?>.html" title="Voir <?php echo $festival['nom'] ?>" >
						<?php echo $festival['nom'] ?>
						<br />
						<span>festival</span>
					</a>
				</div>
			<?php
				}
			?>
		</div>
	</div>
</div>
<?php
	include("src/include/footer.html");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="/src/js/festival.js"></script>
</body>
</html>