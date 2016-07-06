<?php
	include("src/include/head.html");
?>
<body id="accueil">
<div id="particles-js"></div>
<div id="chargement">
    <h2 class="cutText">C</h2>
    <div id="chargement-infos">
        <span class="loading">0</span>
    </div>
</div>
<div class="mask maskVideo">
</div>
<div class="mask">
</div>
<?php include("src/include/header.html") ?>
<div id="intro">
	<div id="containerVideo">
		<video poster="/media/img/festivalgirl.jpg" autoplay >
			<source src="/media/video/teaser.mp4" type="video/mp4" />
		</video>
		<div id="play"></div>
		<div id="mouse"></div>
	</div>
</div>
<div id="main">
    <h2 class="baseline">UNE IMMERSION TOTALE<br />AU COEUR DES FESTIVALS</h2>
	<div id="centerSvg">
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
	</div>
</div>
<?php
	include("src/include/footer.html");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="src/js/bootstrap.min.js"></script>
<script src="src/js/loader.js"></script>
<script type="text/javascript" src="src/js/main.js"></script>
<script type="text/javascript" src="src/js/lib/particles/particles.js"></script>
<script type="text/javascript" src="src/js/lib/mousewheel/mousewheel.js"></script>
<script type="text/javascript" src="src/js/lib/touchswipe/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="src/js/particles-config.js"></script>
</body>
</html>