<?php session_start(); 
$page = 'cre-equipe';
include_once('class/menu.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Collectif Relogement Essonne - L'équipe</title>
        <meta name="description" content="L'équipe du Collectif Relogement Essonne">
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
                                <?php $main_menu = new menu('page-nav', $page); ?>
				<section id="contenu" class="units-row cdsea">
					<article id="organigramme">
						<h1><strong>C.R.E. </strong>Comité Relogement Essonne</h1>
						<h2>L'équipe</h2>
						<p>&nbsp;</p>
						<div class="unit-centered unit-40 join-bottom">
							<div class="org-2 no-icon //iconpeople iconpeople-3">
								<p><strong class="name">Jacques LERICOLLAIS</strong><br>Directeur</p>
                                                                </div>
						</div>
                                                <div class="unit-centered unit-40 join-bottom">
							<div class="org-2 no-icon //iconpeople iconpeople-3">
								<p><strong class="name">I. AUBERT</strong><br>Chef de service</p>
							</div>
						</div>
						<div id="rateau" class="unit-centered width-66 rateau-3-divs"></div>
						<div class="units-row units-split">
							<div class="unit-33 join-top">
								<h3>Service éducatif</h3>
								<div class="org-4 no-icon //iconpeople iconpeople-5">
									<p><strong>équipe</strong><br>13 travailleurs sociaux</p>
								</div>
							</div>
							<div class="unit-33 join-top">
								<h3>Mission Appui au Relogement</h3>
								<div class="org-4 no-icon //iconpeople iconpeople-5">
									<p><strong>équipe</strong><br>2 Chargées de Mission</p>
								</div>
							</div>
							<div class="unit-33 join-top">
								<h3>Service Administratif</h3>
								<div class="org-4 no-icon //iconpeople iconpeople-5">
									<p><strong>équipe</strong><br>1 Secrétaire<br>1 comptable</p>
								</div>
							</div>
						</div>
						
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