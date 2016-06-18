<?php session_start();
$page = 'cdsea-missions';
include_once('class/menu.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Comité départemental de sauvegarde de l'enfant à l'adulte de l'Essonne - Missions</title>
        <meta name="description" content="Dans le respect de ses valeurs, le CDSEA entend contribuer à la réalisation et au développement d'un véritable projet de cohésion sociale sur le territoire Essonnien.">
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
		<?php include_once('inc/menu-fixed.php'); ?>
		<div id="footerWrapper">
			<?php include_once('inc/banniere.php'); ?>
			<div id="conteneur">
				<h1>Comité Départemental de Sauvegarde de l'Enfant à l'Adulte de l'Essonne</h1>
                                <?php $main_menu = new menu('page-nav', $page); ?>
				<section id="contenu" class="units-row cdsea">
					<article class="unit-66">
						<h1><strong>cdsea</strong> <br>comité départemental pour la sauvegarde de l'enfant à l'adulte</h1>
						<p class="header">Projet associatif 2014-2019</p>
						<h2>Des missions</h2>
						<p>Dans le respect de ses valeurs, le CDSEA entend contribuer à la réalisation et au développement d'un véritable projet de cohésion sociale sur le territoire Essonnien.</p>
						<p>L'association a pour mission principale de proposer, de porter et faire évoluer tout projet permettant de favoriser la vie et l'expression citoyenne des personnes les plus vulnérables.</p>
						<h3>Aujourd'hui le CDSEA</h3>
						<ul><li>Accompagne 1 300 enfants, adolescents ou adultes</li>
							<li>Avec l'aide de 200 professionnels</li>
							<li>Dans une vingtaine de communes de l'Essonne</li>
							<li>Pour un budget de 11M &euro;</li>
						</ul>

					</article>

					<aside class="unit-33">
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