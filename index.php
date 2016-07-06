<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
	<meta property="og:site_name" content="The Thrill Tour">
	<meta property="og:type" content="website">
	<meta property="og:description" content="Vivez une expérience unique en immersion totale au coeur des festivals. Privilégiés, vous profiterez d'un service haut de gamme guidé par un initié.">
	<meta property="og:image" content="http://thethrilltour.com/media/img/thumb.jpg">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, user-scalable=no">

	<link href="src/css/landing.css" rel="stylesheet">
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-79837328-1', 'auto');
	  ga('send', 'pageview');

	</script>
	<!-- FAVICON -->
	<link rel="apple-touch-icon" sizes="57x57" href="/media/img/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/media/img//apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/media/img//apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/media/img//apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/media/img//apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/media/img//apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/media/img//apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/media/img//apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/media/img//apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/media/img//android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/media/img//favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/media/img//favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/media/img//favicon-16x16.png">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/media/img/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
    <meta name="keywords" content="THE THRILL TOUR, THETHRILLTOUR, THRILL, TOUR">
    <meta name="description" content="Vivez une expérience unique en immersion totale au coeur des festivals. Privilégiés, vous profiterez d'un service haut de gamme guidé par un initié.">
    <title>THE THRILL TOUR</title>
</head>
<body id="accueil">
<div id="particles-js"></div>
<div id="chargement">
    <h2 class="cutText">C</h2>
    <div id="chargement-infos">
        <span class="loading">0</span>
    </div>
</div>
<div class="mask">
</div>
<?php include("src/include/header.html") ?>
<div id="main">
    <h2 class="baseline">UNE IMMERSION TOTALE AU COEUR DES FESTIVALS</h2>
    <div class="containerSvg">
        <div class="centerTransform">
            <img class="firstCircle" src="media/img/grey-circle.svg" width="" height="" alt="Cercle gris" />
        </div>
        <div class="centerTransform">
            <img class="secondCircle" src="media/img/blue-circle.svg" width="" height="" alt="Cercle bleu" />
        </div>
        <div class="centerTransform">
            <img class="thirdCircle" src="media/img/red-circle.svg" width="14" height="14" alt="Cercle rouge" />
        </div>
        <div>
            <img class="openCircle" src="media/img/grey-small.svg" width="" height="" alt="Cercle gris" />
        </div>
        <div class="containerBtn selectFest centerTransform" id="btn-0">
            <div class="btn-festival bigCircle">
                <div></div>
            </div>
        </div>
        <div class="containerBtn centerTransform" id="btn-1">
            <div class="btn-festival bigCircle">
                <div></div>
            </div>
        </div>
        <div class="containerBtn centerTransform" id="btn-2">
            <div class="btn-festival bigCircle">
                <div></div>
            </div>
        </div>
        <div class="contentCircle">
            <?php
				include("src/include/festival.php")
            ?>
        </div>
    </div>
    <p class="subscribe">Ne manquez pas les plus grands évènements de l'année</p>
    <p class="smallText">Entrez votre adresse mail pour participer</p>
    <form action="php/mail.php" method="POST">
        <input type="email" placeholder="EMAIL" value="" class="mail" name="mail">
        <input type="submit" value="JE PARTICIPE" class="submit">
    </form>
</div>
<?php
	include("src/include/footer.html");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="src/js/bootstrap.min.js"></script>
<script src="src/js/loader.js"></script>
<script type="text/javascript" src="src/js/main2.js"></script>
<script type="text/javascript" src="src/js/lib/particles/particles.js"></script>
<script type="text/javascript" src="src/js/lib/mousewheel/mousewheel.js"></script>
<script type="text/javascript" src="src/js/lib/touchswipe/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="src/js/particles-config.js"></script>
</body>
</html>