    <?php
		include("php/bdd.php");
		$nomFest = $_SERVER["REQUEST_URI"];
		$nomFest = str_replace("/","", $nomFest);
		$nomFest = str_replace("-"," ", $nomFest);
		$nomFest = str_replace(".html","", $nomFest);
		$festival = $bdd->query('SELECT * FROM `festival` WHERE `nom` = \''.$nomFest.'\'');
		if(!$festival){
			return;
		}
		while ($donnees = $festival->fetch()){
			$nom = $donnees['nom'];
			$description = $donnees['description'];
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
		include("src/include/head.html");
	?>
</head>
<body id="festivalDetail" class="<?php echo $couleur; ?>">
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
					<span class="day"><?php echo $day ?></span>
					<span class="month"><?php echo $month ?></span>
					<span class="year"><?php echo $year ?></span>
				</p>
			</div>
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
					<?php echo $description; ?>
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
		<div id="guide">
			<h3 class="titleSection">Votre guide</h3>
			<div class="nameGuide">
				<span class="prenom"><?php echo $prenomGuide; ?></span> <span class="nom"><?php echo $nomGuide ?></span>
			</div>
			<p class="descriptionGuide">
				<?php echo $descriptionGuide ?>
			</p>
			<a href="<?php echo $lienGuide; ?>" target="_blank" class="share" title="Blog de <?php echo (''.$prenomGuide.' '.$nomGuide.''); ?>">
				Le blog de <?php echo (''.$prenomGuide.' '.$nomGuide.''); ?><img src="/media/img/flech.svg" alt="Visiter le blog de <?php echo (''.$prenomGuide.' '.$nomGuide.''); ?>" />
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
				<a href="#" class="share" title="Voir notre partenariat">
					Marque SUPREME <img src="/media/img/flech.svg" alt="Partenariat avec la marque SUPREME"/>
				</a>
			</div>
		</div>
	</div>
	<img src="/media/img/partner-<?php echo $couleur; ?>.svg" class="bgPartenariat" alt="Partenariat The Thrill Tour" />
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
<script src="src/js/bootstrap.min.js"></script>
<script src="src/js/loader.js"></script>
<script type="text/javascript" src="src/js/festival.js"></script>
</body>
</html>