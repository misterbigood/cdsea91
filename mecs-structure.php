<?php session_start(); 
$page = 'mecs-structure';
include_once('class/menu.php');
include_once('class/mysql.php');
include_once('class/actualites.php');
$actualites = new actualites('mecs');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>MECS DE MORSANG - Protection de l'Adolescent - La Structure</title>
        <meta name="description" content="Structure de la MECS DE MORSANG - Protection de l'Adolescent">
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
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="chromeframe">Vous utilisez un navigateur préhistorique .... <a href="http://browsehappy.com/"> Pourquoi pas le mettre à jour maintenant ?</a> ou <a href="http://www.google.com/chromeframe/?redirect=true">installer Google Chrome Frame</a> pour profiter de toutes les fonctionnalités de ce site</p>
        <![endif]-->
		
		<div id="footerWrapper">
			<?php include_once('inc/banniere.php'); ?>
			<div id="conteneur">
				<h1>Comité Départemental de Sauvegarde de l'Enfant à l'Adulte de l'Essonne</h1>
                                <?php $main_menu = new menu('page-nav', $page); ?>
				<section id="contenu" class="units-row mecs">
					<article class="unit-66">
                                            
						<h1><strong>MECS DE MORSANG</strong> protection de l'adolescent</h1>
						<p class="header">La Maison d'Enfants à Caractère Social héberge, en internat ou en appartements partagés, 30 jeunes en difficulté âgés de 10 à 21 ans nécessitant un soutien éducatif continu.</p>
                                                <div class="doc-inser">
                                                    <h4>Documentation</h4>
                                                    <a class="pdf" href="http://cdsea91.fr/inc/telechargerPdf.php?pdf=documentation/MECS/MECS - Projet d'établissement.pdf">Projet d'établissement</a>
                                                    <p style="text-align:right"><a href="http://cdsea91.fr/documentation.html#MECS">Plus...</a></p>
                                                </div>
                                                <p>Située dans un parc arboré de deux hectares proche du centre-ville de Morsang sur Orge, la Maison d'Adolescents est au carrefour des principaux axes de communication d'Epinay sur Orge, Villemoisson sur Orge et Sainte Geneviève des Bois.</p>
						<p>L'action de la Maison d'Adolescents se situe dans le cadre d'une mission de protection de l'enfance avec une habilitation de l'Aide Sociale à l'Enfance.</p>
						<p>Les adolescents sont confiés à la Maison d'Adolescents pour une durée déterminée et renouvelable :</p>
						<ul>
							<li>dans le cadre d'une mesure de placement décidée par le Juge des Enfants ou, avec l'accord des parents, par l'Aide Sociale à l'Enfance ;</li>
							<li>dans le cadre d'un Contrat Jeune Majeur, avec l'accord du jeune majeur.</li>
						</ul>
						<p>Le Projet Personnalisé, axe central de l'accompagnement éducatif proposé par la Maison d'Adolescents, s'engage avec la participation active du jeune et de sa famille. Ce projet s'appuie sur la prise en compte des besoins et capacités du jeune ainsi que des propositions de l'équipe.</p>
						<p>Les éducateurs apportent aux jeunes des réponses adaptées à leur âge et à leurs besoins immédiats et à venir. Ils s'attachent à :</p>
						<ul>
							<li>Les protéger en leur offrant un cadre de vie stable, rassurant et favorable à leur épanouissement ;</li>
							<li>Les accompagner dans leur développement physique, affectif, intellectuel et social ;</li>
							<li>Les scolariser dans les établissements adaptés à leurs besoins ;</li>
							<li>Les inscrire dans la vie locale en leur donnant accès aux activités culturelles, sportives et de loisirs ;</li>
							<li>Soutenir leurs parents pendant toute la durée du placement afin de les aider à développer leurs compétences éducatives et à construire de nouvelles relations avec leur enfant.</li>
						</ul>
						<p>Les adolescents sont hébergés toute l'année, en fonction des droits de leurs parents, au sein d'une unité collective de 24 adolescents ou en appartements partagés pour les jeunes femmes majeures.</p>
						<p>La Maison d'Adolescents veille à une continuité de la prise en charge, y compris pendant les périodes d'absence des jeunes.</p>
					</article>
	
					<aside class="unit-33">
						<div id="diaporama" data-repertoire="mecs">
							<noscript><img src="images/mecs/DSCN0320-bis.jpg" alt="MECS"></noscript>
						</div>
						<?php include_once('inc/aside-content.php'); ?>
					</aside>
	
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