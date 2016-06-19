<?php session_start();
$page = 'itep-structure';
include_once('class/menu.php');
include_once('class/mysql.php');
include_once('class/actualites.php');
$actualites = new actualites('itep');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ITEP et SESSAD - Rééducation des Troubles du Comportement -  La Structure</title>
        <meta name="description" content="Structure de l'ITEP et SESSAD - Rééducation des Troubles du Comportement">
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
                                <?php $main_menu = new menu('page-nav', $page); ?>
				<section id="contenu" class="units-row itep">
					<article class="unit-66">
						<h1><strong>ITEP et SESSAD</strong> rééducation des troubles du comportement</h1>
						<p class="header">L'Institut Thérapeutique Educatif et Pédagogique de BRUNEHAUT (internat et externat) et son Service d'Education Spécialisée et de Soins à Domicile, prennent en charge des enfants de 6 à 16 ans présentant des troubles du comportement.</p>
						<div class="doc-inser">
                                                    <h4>Documentation</h4>
                                                    <a class="pdf" href="http://cdsea91.fr/inc/telechargerPdf.php?pdf=documentation/ITEP/ITEP - Projet d'établissement.pdf">Projet d'établissement</a>
                                                    <p style="text-align:right"><a href="http://cdsea91.fr/documentation.html#ITEP">Plus...</a></p>
                                                </div>
                                                <p>Situé dans un parc de 5 hectares, au cœur de la vallée classée de la Juine, l'Institut Thérapeutique Educatif et Thérapeutique du Château de BRUNEHAUT, à MORIGNY dans le sud du département de l'Essonne, bénéficie d'un agrément pour accueillir des garçons ou des filles âgés de 6 à 16 ans.</p>
						<p>Les modalités de prise en charge s'organisent tout au long de l'année selon le rythme hebdomadaire d'un internat de 36 places ou le rythme quotidien d'un externat de 24 places.</p>
						<p>Le travail avec les enfants s'articulent autour : du SOIN avec des rendez-vous réguliers auprès de psychologues et rééducateurs ; de l'ACCOMPAGNEMENT EDUCATIF au quotidien visant à promouvoir l'autonomie, la socialisation de l'enfant ; de l'ACQUISITION PEDAGOGIQUE grâce à une unité d'enseignement de l'Education Nationale intégrée à l'ITEP et SESSAD de BRUNEHAUT.</p>
						<p>Les objectifs de ce travail sont de permettre l'élaboration d'un PROJET PERSONNALISE D'ACCOMPAGNEMENT évoluant chaque année selon les problématiques mais surtout les potentialités de chaque enfant afin de favoriser pour lui et le plus rapidement possible la réintégration vers un milieu ordinaire d'apprentissage.</p>
						<p>L'ITEP et SESSAD de BRUNEHAUT organise aussi un accueil spécifique avec un internat de week-end. Ce dispositif est accessible aux enfants pris en charge par l'établissement en fonction de leur progression et de leur projet personnalisé.</p>
						<p>Les conditions d'admission à l'ITEP et SESSAD de BRUNEHAUT sont définies comme suit : dès réception de la notification d'orientation vers un ITEP, envoyée par la MDPH, il s'agit pour les familles de prendre contact avec l'établissement.</p>
						<p>Une période d'essai de 5 jours est organisée avant toute décision d'admission.</p>
 						<p>La commission d'admission se prononce pour une entrée de l'enfant dans l'établissement ou préconise une autre orientation mieux adaptée à sa situation.</p>
						<p>Situé à ETAMPES, le Service d'Education Spécialisée et de Soins à Domicile de BRUNEHAUT s'organise autour d'une équipe pluridisciplinaire composée d'un psychologue, de rééducateurs, d'éducateurs et d'une assistante sociale.</p>
						<p>Ce service de 22 places s'adresse à des enfants qui présentent des troubles du comportement, et qui bénéficient d'une notification d'orientation envoyée par la MDPH pour une prise en charge SESSAD.</p>
						<p>Les conditions d'admission sont définies comme suit : dès réception de la notification d'orientation vers un  SESSAD, envoyée par la MDPH, il s'agit pour les familles de prendre contact avec le service.</p>
						<p>L'objectif des professionnels du SESSAD est de soutenir l'enfant dans son environnement scolaire et familial tout en lui permettant de développer ses potentialités. L'accompagnement s'effectue dans les lieux de vie de l'enfant mais également dans les locaux du SESSAD.</p>
						<p>L'accompagnement, l'aide à la parentalité et la guidance parentale sont aussi proposés par l'équipe aux familles.</p>
					</article>

					<aside class="unit-33">
						<div id="diaporama" data-repertoire="itep">
							<noscript><img src="images/itep/1-Photo-chateau-2008.jpg" alt="ITEP"></noscript>
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