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
		$couleur = $donnees['couleur'];
	}
	$retour=1;
	if(!empty($_POST)) {
		foreach($_POST as $cle=>$val) {
			if(empty($val)) {
				/* echo 'Le champ ',$cle,' est obligatoire.<br />';*/
				$retour=0;
			}
		}
		if($retour != 0) {
			// Déclaration des variables 
				$festival = filter_var( $_POST['festival'], FILTER_SANITIZE_STRING );
				$name = ucfirst(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
				$email = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL);
				$prenom = ucfirst(filter_var($_POST['prenom'], FILTER_SANITIZE_STRING));
				$pays = strtoupper(filter_var($_POST['pays'], FILTER_SANITIZE_STRING));
				$city = ucfirst(filter_var($_POST['city'], FILTER_SANITIZE_STRING));
				$zipcode = filter_var($_POST['zipcode'], FILTER_SANITIZE_NUMBER_INT);
				$tel = filter_var($_POST['tel'], FILTER_SANITIZE_NUMBER_INT);
				$adresse = ucfirst(filter_var($_POST['adresse'], FILTER_SANITIZE_STRING));
				$birthdate =  filter_var($_POST['birthdate'], FILTER_SANITIZE_STRING);
				$erreur=[];
			// On effectue les vérifications
				if( !empty( $festival ) && strlen($festival) > 150 ){
					$erreur['festival']="Attention, le festival est un champ obligatoire (maximum 150car)";
				}
				if( !empty( $name ) && strlen($name) > 150 ){
					$erreur['name']="Attention, le nom est un champ obligatoire (maximum 150car)";
				}
				if(!empty( $prenom ) && strlen($prenom) > 150){
					$erreur['prenom']="Attention, le prénom est un champ obligatoire (maximum 150car)";
				}
				if(!empty( $email ) && strlen($email) > 150){
					$erreur['email']="Attention, le mail est un champ obligatoire (maximum 150car)";
				}
				if(!empty( $pays ) && strlen($pays) > 150){
					$erreur['pays']="Attention, le pays est un champ obligatoire (maximum 150car)";
				}
				if(!empty( $city ) && strlen($city) > 150){
					$erreur['city']="Attention, la ville est un champ obligatoire (maximum 150car)";
				}
				if(!empty( $zipcode ) && strlen($zipcode) > 5){
					$erreur['zipcode']="Attention, le code postal est un champ obligatoire (maximum 5car)";
				}
				if(!empty( $adresse ) && strlen($adresse) > 255){
					$erreur['adresse']="Attention, l'adresse est un champ obligatoire (maximum 255car)";
				}
				if(!empty( $tel ) && strlen($tel) != 10){
					$erreur['tel']="Attention, le téléphone est un champ obligatoire (format attendu 0123456789)";
				}
				if(!empty( $birthdate ) && strlen($birthdate) > 30){
					$erreur['birthdate']="Attention, la date est un champ obligatoire (maximum 30car)";
				}
				
			if( empty( $erreur ) ){
				$numero = 1;
				$date = date("d/m/y");
				$add = $bdd->prepare('INSERT INTO `reservations` (`id`, `festival`, `nom`, `prenom`, `numero`, `date`, `email`, `pays`, `city`, `zipcode`, `adresse`, `tel`, `birthdate`) VALUES (NULL, :festival, :name, :prenom, :numero, :date, :email, :pays, :city, :zipcode, :adresse, :tel, :birthdate );');
				$add->execute(array(
					'festival' => $festival,
					'name' => $name,
					'prenom' => $prenom,
					'numero' => $numero,
					'date' => $date,
					'email' => $email,
					'pays' => $pays,
					'city' => $city,
					'zipcode' => $zipcode,
					'adresse' => $adresse,
					'tel' => str_pad( $tel, 10, '0',  STR_PAD_LEFT ),
					'birthdate' => $birthdate
				));
				$lastId = $bdd->lastInsertId();
				$numero = str_pad( $lastId, 7, '0',  STR_PAD_LEFT );
				$edit = $bdd->prepare('UPDATE reservations SET numero = :numero WHERE id = :id;');
				$edit->execute(array(
					'numero' => $numero,
					'id' => $lastId
				));
				$n = "\n";
				//=====Définition du sujet.
				$sujet = "Commande The Thrill Tour";
				$sujet = htmlspecialchars($sujet);
				//=====Création du header de l'e-mail.
				$header = "From: The Thrill Tour < eightballagency@gmail.com >" . $n;
				$header .= "MIME-Version: 1.0" . $n;
				$header .= "Content-Type: text/html; charset=\"utf-8\";";

				$message = '<table align="center" bgcolor="#131822" border="0" cellpadding="0" cellspacing="0" width="600">
				<tbody>
					<tr>
						<td align="center">
							<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-size: 10px; color: #686E7B; font-family: Helvetica, Arial, sans-serif; text-align: center; text-decoration: none;" width="600" bgcolor="#131822">
								<tbody>
									<tr>
										<td align="left" height="26">
											<a href="http://thethrilltour.com/" style="color:#686E7B; text-decoration:none;" target="_blank" title="ALLER SUR LE SITE"></a>
										</td><td align="left" height="26">
										<td align="center" height="26" width="20">&nbsp;|&nbsp;</td>
											<a href="http://thethrilltour.com/" style="color:#686E7B; text-decoration:none;" target="_blank" title="ALLER SUR LE SITE">ALLER SUR LE SITE</a>
										</td>
									</tr>
									<tr>
										<td align="center" colspan="3" height="10">&nbsp;</td>
									</tr>
								</tbody>
							</table>
							<table align="center" border="0" cellpadding="0" cellspacing="0" style="line-height:100%; vertical-align:middle;" width="600" bgcolor="#131822">
								<tbody>
									<tr>
										<td align="center" valign="middle">
											<div align="center" style="height: 50px;width:350px">
												<a href="" >
													<img align="middle" alt="The Thrill Tour" border="0" height="50" style="display: block !important;" width="350" src="http://thethrilltour.com/media/img/logo.jpg">
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td height="20">&nbsp;</td>
									</tr>
								</tbody>
							</table>
						   
							<table border="0" cellpadding="0" cellspacing="0" align="center" width="600" bgcolor="#131822">
									<tbody>
										
										<tr>
											<td width="20" bgcolor="#131822"> 
									   </td>
										<td align="left" bgcolor="#131822" height="242" width="560" >
																<span style="font: 18px Georgia, \'Times New Roman\', Times, serif; text-decoration:none;color:#ffffff;line-height:40px; color: #fff; font-family: Helvetica, Arial, sans-serif;">Bonjour '.$prenom.',</span>
																<br>
															  <span style="font: 14px Helvetica, Arial, sans-serif;; text-decoration:none;color:white;text-align:left; letter-spacing:1px; line-height:22px;">Bonne nouvelle ! Nous vous confirmons la réservation de votre
																pass The Thrill Tour.<br />
																Vous trouverez ci-dessous les informations relatives à votre
																réservation.<br /><br />
																L’équipe The Thrill Tour reviendra vers vous très vite si vous faites
																partis des 10 sélectionnés. Nous vous tiendrons informé de la suite
																de votre réservation.<br /><br />
																Vous avez des questions ? N\'hésitez pas à <a href="eightballagency@gmail.com" style="color:#686E7B;">nous contacter.</a><br /><br />
															  </span>
														  </td>
															<td width="20" bgcolor="#131822"> 
															
															</td>
														</tr>
											</tbody>
							   </table>
							   <table cellpadding="0" cellspacing="0" align="center" width="560" bgcolor="#131822" border="1px solid #ffffff">
									<tbody>
										   <tr>
									 
										   <td width="350" bgcolor="#131822" align="center" style="border-right: none; color: #fff; " border-left="1px solid #ffffff">
												<span style="color:#fff; font-size:22px;">'.$nom.'</span>
										   </td>
										   
										   <td bgcolor="#131822" width="250" style="border-left: none; color: #fff !important" "align="left">
										   <span style="font: 14px Helvetica, Arial, sans-serif; color: #fff !important; text-decoration:none;color:white;text-align:left; letter-spacing:1px; line-height:22px; text-transform:uppercase;">
										   <br />
											Nom
											<br />
											'.$name.'
											<br /><br />
											Prénom
											<br />
											'.$prenom.'
											<br /><br />
											NUMéRO DE LA RéSERVATION
											<br />
											'.$numero.'
											<br /><br />
											DATE DE LA RéSERVATION
											<br />
											'.$date.'
											<br /><br />
											 </span>
										   </td>
										   
										   </tr>
													</tbody>
												</table>
												
												<tr>
												<td>
												 <table align="center"  border="0" cellpadding="0" cellspacing="0" height="68" style="color: #000000 !important" width="560">
							<tbody>
							   <tr>
							   <td height="40"></td>
							   </tr>
								<tr>
									<td align="center" height="42" width="42" border="1px solid #ffffff">
									   <div style="text-align:center; width:65%;">
						<ul style="text-align:center; width:271px; height:30px; margin 0 auto;">
							<li style="display:inline-block;"><a href="http://bit.ly/ThrillTourFb" target="_blank" style="display: block; width: 80px; height: 28px;font-size: 10px; text-align: center; line-height: 28px; color: #686E7B; font-family: Calibri, Arial, Helvetica, sans-serif; text-decoration:none;" title="Suivre The Thrill Tour sur Facebook">Facebook</a></li>
							<li style="display:inline-block;"><a href="http://bit.ly/ThrillTourTw" target="_blank" style="display: block; width: 80px; height: 28px;font-size: 10px; text-align: center; line-height: 28px; color: #686E7B;font-family: Calibri, Arial, Helvetica, sans-serif; text-decoration:none;"  title="Suivre The Thrill Tour sur Twitter">Twitter</a></li>
							<li style="display:inline-block; margin-left: -10px;"><a href="http://bit.ly/ThrillTourIn" target="_blank" style="display: block; width: 80px; height: 28px;font-size: 10px; text-align: center; line-height: 28px; color: #686E7B;font-family: Calibri, Arial, Helvetica, sans-serif; text-decoration:none;" title="Suivre The Thrill Tour sur Instagram">Instagram</a></li>
							<li style="display:inline-block; margin-left: -15px;"><a href="http://bit.ly/ThrillTourYt" target="_blank" style="display: block; width: 80px; height: 28px;font-size: 10px; text-align: center;			line-height: 28px; color: #686E7B;font-family: Calibri, Arial, Helvetica, sans-serif; text-decoration:none;" title="Suivre The Thrill Tour sur Youtube">Youtube</a></li>
						</ul>
					</div>
						</td>
					   
					</tr>
					<tr>
						<td colspan="19" height="13">&nbsp;</td>
					</tr>
				</tbody>
			</table>
			<div style="line-height:20px;">&nbsp;</div>
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="#131822" color="white">
				<tbody>
					<tr>
						<td colspan="9">
							<div style="color: white; font: 10px Calibri, Arial, Helvetica, sans-serif; text-align: center; margin: 0 8px 15px; text-align: center; line-height: 100%; letter-spacing:1px;">
								
								 <p>Merci de ne pas répondre à cet e-mail.</p>
								 <p>Pour toute question ou probleme relatif à votre commande, <a href="&&&" style="color:#686E7B;">cliquez ici.</a></p>
							</div>
						</td>
					</tr>
					
				</tbody>
			</table>
		</td>
		</tr>
	</td></tr></tbody></table></div>';
				//=====Envoi de l'e-mail.
				if (!mail($email, $sujet, $message, $header)) {
					exit("Nous n'avons pas réussi à envoyer le mail !");
				}
				header("location: /confirmation/".$slug.".html");
				//==========
			}
		}
	}
	include("src/include/head.html");
?>
<body id="reservation" class="<?=$couleur?>">
	<?php include("src/include/header.html") ?>
	<div class="wrapper900">
		<div class="sep">
		</div>
		<h2 class="titleSection">
			Demande de réservation<br />
			<span class="subTitle">Les places sont limitées</span>
		</h2>
		<div class="contentCircle">
			<div class="circle">
			</div>
			<h3>
				<?php echo $nom ?>
				<br />
				<span>festival</span>
			</h3>
		</div>
	</div>
	<div id="changeStep">
		<div class="step1">
			<div class="circle">
			</div>
		</div>
		<div class="step2">
			<div class="circle nonActive">
			</div>
		</div>
	</div>
	<form action="#" method="POST">
		<div id="slideForm">
			<div class="part1">
				<div class="wrapper900">
					<h3 class="textResa">
						<?php 
							if($retour == 0){ 
								echo '<span style="color:#D0021B">Veuillez remplir tous les champs pour continuer</span>';
							}
							else{
								echo 'Merci de remplir le formulaire pour continuer';
							}
							if( !empty( $erreur ) ){
								foreach( $erreur as $ktemErreur=>$itemErreur ){
									echo '<br /><span style="color:#D0021B; font-size:9px; letter-spacing:1px;">'.$itemErreur.'</span>';
								}
							}
						?>
					</h3>
					<div class="row">
						<label for="name">Nom</label>
						<input type="text" name="name" value="<?php if( $_POST['name']){ echo $_POST['name'];}?>" />
					</div>
					<div class="row">
						<label for="prenom">Prénom</label>
						<input type="text" name="prenom" value="<?php if( $_POST['prenom']){ echo $_POST['prenom'];}?>" />
					</div>
					<div class="row">
						<label for="email">Email</label>
						<input type="text" name="email" value="<?php if( $_POST['email']){ echo $_POST['email'];}?>" />
					</div>
					<div class="row">
						<label for="pays">Pays</label>
						<input type="text" name="pays" value="<?php if( $_POST['pays']){ echo $_POST['pays'];}?>" />
					</div>
					<div class="rowLast">
						<div class="center">
							<div class="buttonBig">Continuer</div>
						</div>
					</div>
				</div>
			</div>
			<div class="part2">
				<div class="wrapper900">
					<h3 class="textResa">
						Afin de prendre contact avec vous si vous êtes sélectionné, merci de compléter vos informations.
					</h3>
					<div class="row">
						<label for="adresse">Adresse</label>
						<input type="text" name="adresse" value="<?php if( $_POST['adresse']){ echo $_POST['adresse'];}?>" />
					</div>
					<div class="row">
						<label for="zipcode">Code Postal</label>
						<input type="tel" name="zipcode" maxlength="5" value="<?php if( $_POST['zipcode']){ echo $_POST['zipcode'];}?>" />
					</div>
					<div class="row">
						<label for="city">Ville</label>
						<input type="text" name="city" value="<?php if( $_POST['city']){ echo $_POST['city'];}?>" />
					</div>
					<div class="row">
						<label for="tel">Téléphone</label>
						<input type="tel" name="tel" value="<?php if( $_POST['tel']){ echo $_POST['tel'];}?>" />
					</div>
					<div class="row">
						<label for="birthdate">Date de naissance</label>
						<input type="date" name="birthdate" value="<?php if( $_POST['birthdate']){ echo $_POST['birthdate'];}?>" />
					</div>
					<input type="hidden" name="festival" value="<?php echo $nom; ?>" />
					<div class="rowLast">
						<div class="center">
							<input type="submit" class="buttonBig" value="Valider" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php
	include("src/include/footer.html");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="/src/js/reservation.js"></script>
</body>
</html>