<?php session_start();
$page = 'cdsea-contact';
include_once('class/menu.php');
include_once('class/form.php');
include_once('class/utils.php');
$formContact = new form('formContact');
$formContact->verifChampsVides('nom, prenom, email, msg');
$formContact->verifMail('email');
if($formContact->verif == "yes" and $formContact->envoyerForm == 'lucky') {
	include_once('class/phpmailer/class.phpmailer.php');
	include_once('class/mysql.php');
	include_once('class/inlineCss/CSSQuery.php');
	include_once('class/inlineCss/inlineStyle.php');
        $destinataire = array('CDSEA'=>'siege@cdsea91.fr', 'MECS'=>'maison-ados@cdsea91.fr', 'ITEP'=>'itep@cdsea91.fr', 'SAIS'=>'sais@cdsea91.fr', 'SAEMF'=>'saemf@cdsea91.fr', 'CRE'=>'i.meyer-dussart@cre91.fr');
	$mail = new PHPmailer();
	$mail->IsHTML(true);
	$mail->definirStyle('defaut');
	$mail->From = 'siege@cdsea91.fr';
	$mail->FromName = 'cdsea91.fr';
        $mail->AddAddress($destinataire[$_POST['sujet']]);
	$mail->AddReplyTo($_POST['email']);
	$mail->Subject='contact cdsea91.fr';
	$mail->Body .='<div id="imgTop"><img src="http://www.cdsea91.fr/images/logo_cdsea_web.png" alt="cdsea" width="120px" height="63px" /></div>';
	$mail->Body .='<div id="main">';
	$mail->Body .='<h1>contact CDSEA</h1>';
	$mail->addToTable('sujet : ', $_POST['request']);
	$mail->addToTable('nom : ', $_POST['nom']);
	$mail->addToTable('prenom : ', $_POST['prenom']);
	$mail->addToTable('email : ', $_POST['email']);
	$mail->addToTable('message : ', $_POST['msg']);
	$mail->addTableToBody();
	$mail->Body .='</div>';
        $mail->setHtmlBody();
	if(!$mail->Send()){ //Teste le return code de la fonction
		$htmlInfoTop = $mail->ErrorInfo;
	}
	else $htmlInfoTop = '<div class="centre"><p>Votre message a été envoyé.<br>Nous vous remercions,<br>et recontacterons très prochainement.</p></div>' . " \n";
}
$formContact->addInput('text', 'nom', '', 'nom : ', 'size=56, required=required');
$formContact->addInput('text', 'prenom', '', 'prénom : ', 'size=56, required=required');
$formContact->addInput('email', 'email', '', 'e-mail : ', 'size=56, required=required');
$formContact->addOption('sujet', 'CDSEA', 'CDSEA - Comité de sauvegarde de l\'enfant à l\'adulte');
$formContact->addOption('sujet', 'MECS', 'MECS -  Protection de l\'adolescent');
$formContact->addOption('sujet', 'ITEP', 'ITEP et SESSAD -  Rééducation des troubles du comportement');
$formContact->addOption('sujet', 'SAIS', 'SAIS -  Accompagnement de l\'adulte handicapé');
$formContact->addOption('sujet', 'SAEMF', 'SAEMF - Service d\'Aide Educative en milieu familial');
$formContact->addOption('sujet', 'CRE', 'CRE - Comité Relogement Essonne');
$formContact->addSelect('sujet', 'sujet : ');
$formContact->addTextarea('msg', '', 'message : ', 'cols=42, rows=4, required=required');
$formContact->addSubmit('Envoyer', 'btn');
$formContact->txt = '<p><span class="alerte">*</span> <span class="small">obligatoire</span></p>';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Contacter le Comité Départemental de Sauvegarde de l'Enfant à l'Adulte de l'Essonne</title>
        <meta name="description" content="Contacter le Comité départemental de sauvegarde de l'enfant à l'adulte de l'Essonne">
        <meta name="viewport" content="initial-scale=1.0,width=device-width">
		<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
		<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
		<meta name="msapplication-TileColor" content="#2d89ef">
		<?php include_once('inc/css-includes.php'); ?>
        <!--[if lte IE 8]>
  			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
        <!-- Piwik -->
<?php 

include_once('header.php');

?>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="chromeframe">Vous utilisez un navigateur préhistorique .... <a href="http://browsehappy.com/"> Pourquoi pas le mettre à jour maintenant ?</a> ou <a href="http://www.google.com/chromeframe/?redirect=true">installer Google Chrome Frame</a> pour profiter de toutes les fonctionnalités de ce site</p>
        <![endif]-->
		<div id="footerWrapper">
			<?php include_once('inc/banniere.php'); ?>
			<div id="conteneur">
				<h1>Comité Départemental de Sauvegarde de l'Enfant à l'Adulte de l'Essonne</h1>
                                <section id="contenu" class="units-row cdsea">
					<article class="unit-66">
						<h1><strong>Nous contacter</strong></h1>
						<?php if(isset($htmlInfoTop)) { ?>
							<div id="infoTop"> <?php echo $htmlInfoTop; ?> </div>
						<?php }
						else $formContact->afficher();?>
					</article>

					
					<article class="unit-50 clear">
                                            <h3>Coordonnées des établissements et services</h3>
                                            <ul>
                                                <li><a href="#cdsea">C.D.S.E.A. Siège</a></li>
                                                <li><a href="#itep">ITEP et SESSAD</a></li>
                                                <li><a href="#mecs">M.E.C.S.</a></li>
                                                <li><a href="#sais">S.A.I.S.</a></li>
                                                <li><a href="#saemf">S.A.E.M.F.</a></li>
                                                <li><a href="#cre">C.R.E.</a></li>
                                            </ul>
						<address id="cdsea">
							<h2>C.D.S.E.A. Siège</h2>
							<!--<a href="https://www.google.com/maps/place/98+All%C3%A9e+des+Champs+Elys%C3%A9es/@48.6301906,2.4243476,17z/data=!4m2!3m1!1s0x47e5de1710f423bb:0xeba2c8d03d52cc09" class="image-left gmap" target="_blank"><img src="images/Google-Maps-logo-Icon-Design.png" height="40" width="40" alt="Voir sur Google Maps"></a>-->
                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2636.936843623215!2d2.424347600000002!3d48.630190600000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e5de1710f423bb%3A0xeba2c8d03d52cc09!2s98+All%C3%A9e+des+Champs+Elys%C3%A9es!5e0!3m2!1sfr!2sfr!4v1400335706886" width="400" height="220" frameborder="0" style="border:0"></iframe>
                                                        <p class="end">98, allée des Champs Elysées - 91080  Courcouronnes</p>
							<p>Tel: 01 69 91 47 20 - Fax: 01 64 57 79 10</p>
        					</address>
						<address id="itep">
							<h2>ITEP et SESSAD</h2>
							<!--<a href="https://www.google.com/maps/place/Ch%C3%A2teau+Brunehaut/@48.454289,2.179182,17z/data=!3m1!4b1!4m2!3m1!1s0x47e5c935f3103d63:0x1ccb06d49110e031" class="image-left gmap" target="_blank"><img src="images/Google-Maps-logo-Icon-Design.png" height="40" width="40" alt="Voir sur Google Maps"></a>-->
						   	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2646.116772226985!2d2.179182!3d48.454288999999996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e5c935f3103d63%3A0x1ccb06d49110e031!2sCh%C3%A2teau+Brunehaut!5e0!3m2!1sfr!2sfr!4v1400335977661" width="400" height="220" frameborder="0" style="border:0"></iframe>
                                                        <p class="end">Château de Brunehaut - 91150 Morigny Champigny</p>
						   	<p>Tel: 01 64 94 21 81 - Fax: 01 60 80 17 80</p>
						</address>
						<address id="mecs">
							<h2>M.E.C.S.</h2>
							<!--<a href="https://www.google.com/maps/place/20+Rue+de+Montlh%C3%A9ry/@48.6616617,2.3424588,17z/data=!3m1!4b1!4m2!3m1!1s0x47e5d8d0e0e76df1:0xb8b5d70f334bb701" class="image-left gmap" target="_blank"><img src="images/Google-Maps-logo-Icon-Design.png" height="40" width="40" alt="Voir sur Google Maps"></a>-->
						 	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2635.298068914895!2d2.3427469999999997!3d48.661542000000004!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e5d8d11f735de7%3A0xb1c568f2ec1c8c17!2s20+Rue+de+Montlh%C3%A9ry!5e0!3m2!1sfr!2sfr!4v1400336050770" width="400" height="220" frameborder="0" style="border:0"></iframe>
                                                        <p class="end">20, rue de Montlhéry - 91390 Morsang sur Orge</p>
						 	<p>Tel: 01 69 04 65 22 - Fax: 01 69 46 11 01</p>
						</address>
						<address id="sais">
							<h2>S.A.I.S</h2>
							<!--<a href="https://www.google.com/maps/place/3+Rue+Boole/@48.6231399,2.3129064,17z/data=!3m1!4b1!4m2!3m1!1s0x47e5d97b20590bf7:0xe543ee47bbe7c505" class="image-left gmap" target="_blank"><img src="images/Google-Maps-logo-Icon-Design.png" height="40" width="40" alt="Voir sur Google Maps"></a>-->
							<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2637.305283311926!2d2.3129063999999997!3d48.623139900000005!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e5d97b20590bf7%3A0xe543ee47bbe7c505!2s3+Rue+Boole!5e0!3m2!1sfr!2sfr!4v1400336093806" width="400" height="220" frameborder="0" style="border:0"></iframe>
                                                        <p class="end">3 rue Boole - 91240 St Michel sur Orge</p>
							<p>Tel: 01 69 43 52 27 - Fax: 01 69 06 74 88</p>
						</address>
						<address id="saemf">
							<h2>S.A.E.M.F</h2>
                                                        <h3>Direction</h3>
							<!--<a href="https://www.google.com/maps/place/9+Boulevard+de+l'Europe/@48.6305428,2.4296598,17z/data=!3m1!4b1!4m2!3m1!1s0x47e5de19047bfda9:0x427a116e5d288828" class="image-left gmap" target="_blank"><img src="images/Google-Maps-logo-Icon-Design.png" height="40" width="40" alt="Voir sur Google Maps"></a>-->
	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2636.9184380972465!2d2.4296598!3d48.63054280000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e5de19047bfda9%3A0x427a116e5d288828!2s9+Boulevard+de+l&#39;Europe!5e0!3m2!1sfr!2sfr!4v1400336135718" width="400" height="220" frameborder="0" style="border:0"></iframe>						
       <p class="end">9, Boulevard de l'Europe - 91000 Evry</p>
							<p>Tel: 01 60 79 71 80 - Fax: 01 60 79 71 84</p>
						</address>
						<address>
                                                    <h3>Antenne d'Evry</h3>
                                                    <a href="https://www.google.com/maps/place/9+Boulevard+de+l'Europe/@48.6305428,2.4296598,17z/data=!3m1!4b1!4m2!3m1!1s0x47e5de19047bfda9:0x427a116e5d288828" class="image-left gmap" target="_blank"><img src="images/Google-Maps-logo-Icon-Design.png" height="40" width="40" alt="Voir sur Google Maps"></a>
						    <p class="end">9, Boulevard de l'Europe - 91000 Evry</p>
						    <p>Tel: 01 60 79 09 72 - Fax: 01 60 79 71 84</p>
						</address>
						<address>
							<h3>Antenne de Corbeil</h3>
							<a href="https://www.google.com/maps/place/35+Avenue+Carnot,+91100+Corbeil-Essonnes,+France/@48.6098114,2.4756778,17z/data=!3m1!4b1!4m5!3m4!1s0x47e5e72a55715e39:0xc2912beb962d2dbc!8m2!3d48.6098079!4d2.4778665" class="image-left gmap" target="_blank"><img src="images/Google-Maps-logo-Icon-Design.png" height="40" width="40" alt="Voir sur Google Maps"></a>
						   	<p class="end">35 avenue Carnot - 91100 Corbeil Essonne</p>
						   	<p>Tel: 01 64 96 71 43 - Fax: 01 64 96 68 76</p>
						</address>
						<address>
							<h3>Antenne de Grigny</h3>
							<a href="https://www.google.fr/maps/place/25+Rue+de+Schio,+91350+Grigny/@48.6569363,2.3775221,17z/data=!3m1!4b1!4m2!3m1!1s0x47e5df1db55f5aeb:0xb5f4735022c69685" class="image-left gmap" target="_blank"><img src="images/Google-Maps-logo-Icon-Design.png" height="40" width="40" alt="Voir sur Google Maps"></a>
						  	<p class="end">25 rue de Schio - 91350 Grigny</p>
						  	<p>Tel: 01 69 45 56 95 - Fax: 01 69 21 48 28</p>
						</address>
						<address>
							<h3>Antenne de Vigneux</h3>
							<a href="https://www.google.com/maps/place/8+Rue+Marcel+Cachin/@48.7008674,2.4395268,17z/data=!3m1!4b1!4m2!3m1!1s0x47e67553b525076f:0x8d4f869bef2922d4" class="image-left gmap" target="_blank"><img src="images/Google-Maps-logo-Icon-Design.png" height="40" width="40" alt="Voir sur Google Maps"></a>
						  	<p class="end">8, rue Marcel Cachin - 91270 Vigneux</p>
						  	<p>Tel: 01 69 40 16 84 - Fax: 01 69 03 89 99</p>
						</address>
						<address>
							<h3>Antenne de St Michel</h3>
							<a href="https://www.google.com/maps/place/1+Rue+Berlioz/@48.635828,2.3196877,17z/data=!3m1!4b1!4m2!3m1!1s0x47e5d9134b8ece1b:0x6506a3a1ea116c1b" class="image-left gmap" target="_blank"><img src="images/Google-Maps-logo-Icon-Design.png" height="40" width="40" alt="Voir sur Google Maps"></a>
						   	<p class="end">1, Place Berlioz - 91240 St Michel sur Orge</p>
						   	<p>Tel: 01 69 04 18 36 - Fax: 01 60 15 62 43</p>
						</address>
						<address>
							<h3>Antenne de Savigny</h3>
							<a href="https://www.google.com/maps/place/46+Rue+%C3%89douard+Branly/@48.6856262,2.3516278,17z/data=!3m1!4b1!4m2!3m1!1s0x47e5d8ad5c609b6d:0x57de4396128cc961" class="image-left gmap" target="_blank"><img src="images/Google-Maps-logo-Icon-Design.png" height="40" width="40" alt="Voir sur Google Maps"></a>
						  	<p class="end">46, rue Edouard Branly - 91600 Savigny sur Orge</p>
						  	<p>Tel: 01 69 54 05 01 - Fax: 01 69 24 34 39</p>
						</address>
                                            <address id="cre">
							<h2>C.R.E.</h2>
							<!--<a href="https://www.google.com/maps/place/3+Rue+Boole/@48.6231399,2.3129064,17z/data=!3m1!4b1!4m2!3m1!1s0x47e5d97b20590bf7:0xe543ee47bbe7c505" class="image-left gmap" target="_blank"><img src="images/Google-Maps-logo-Icon-Design.png" height="40" width="40" alt="Voir sur Google Maps"></a>-->
                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2637.094184075352!2d2.4269228151719386!3d48.627179724913226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e5de1bca468c79%3A0xf385e304cc5a38f6!2s15+All%C3%A9e+Jacquard%2C+91000+%C3%89vry!5e0!3m2!1sfr!2sfr!4v1485079167910" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                                        <p class="end">15 allée Jacquard - 91000 Evry</p>
							<p>Tel: 01 69 87 01 80 - Fax: 01 60 78 88 21</p>
						</address>
					</article>
				</section> <!-- #contenu -->
			 </div><!-- #conteneur -->
			<div id="spacer-footer"></div>
		</div> <!-- #footerWrapper -->
		<footer id="footer">
			<?php include_once('inc/footer.php'); ?>
		</footer>
		<?php include_once('inc/js-includes.php'); ?>
    </body>
</html>