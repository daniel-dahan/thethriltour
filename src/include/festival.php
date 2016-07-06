<?php 
  $json = file_get_contents('/htdocs/src/festivals.json');
  $json = json_decode($json);
  $idButton = 0;
  if($_POST["idButton"]){
	$idButton = $_POST["idButton"];
  }
?>
<div class="centerFestival">
	<div class="circle green">
	</div>
	<h3>
		<?php echo $json[$idButton]->name ?>
		<br />
		<span>festival</span>
	</h3>
	<p class="place">
		<?php echo $json[$idButton]->place ?>
	</p>
	<p class="date">
		<span class="day"><?php echo $json[$idButton]->date[0]->day ?></span>
		<span class="month"><?php echo $json[$idButton]->date[0]->month ?></span>
		<span class="year"><?php echo $json[$idButton]->date[0]->year ?></span>
	</p>
	<a class="discoverMore" href="/festival/<?php echo $json[$idButton]->slug ?>.html" title="Découvrez <?php echo $json[$idButton]->name ?>">Découvrez</a>
	<!--
	<p class="description">
		<?php echo $json[$idButton]->description ?>
	</p>
	-->
</div>