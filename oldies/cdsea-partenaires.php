<?php session_start();
$page = 'cdsea-partenaires';
include_once('class/menu.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <meta name="description" content="">
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
				<section id="contenu" class="units-row cdsea">
					<article class="unit-66">
						<h1><strong>cdsea</strong> <br>comité départemental pour la sauvegarde de l'enfant à l'adulte</h1>
						<p class="header">Projet associatif 2014-2019</p>
						<h2>Les partenaires</h2>
						<dl class="units-row" id="partenaires">
							<dt class="unit-40"><img src="images/partenaires/sauvegarde-yvelines.jpg" alt="La Sauvegarde des Yvelines" class="image-left"></dt><dd class="unit-60">La Sauvegarde des Yvelines<br><a href="http://www.sauvegarde-yvelines.org/">http://www.sauvegarde-yvelines.org/</a></dd>
							<dt class="unit-40 clear"><img src="images/partenaires/sauvegarde-paris.jpg" alt="La Sauvegarde de Paris" class="image-left"></dt><dd class="unit-60">La Sauvegarde de Paris<br><a href="http://www.sauvegarde-paris.fr/">http://www.sauvegarde-paris.fr/</a></dd>
							<dt class="unit-40 clear"><img src="images/partenaires/sauvegarde93.jpg" alt="La Sauvegarde du 93" class="image-left"></dt><dd class="unit-60">La Sauvegarde du 93<br><a href="http://www.sauvegarde93.fr/">http://www.sauvegarde93.fr/</a></dd>
							<dt class="unit-40 clear"><img src="images/partenaires/sauvegarde95.jpg" alt="La Sauvegarde du 95" class="image-left"></dt><dd class="unit-60">La Sauvegarde du 95<br><a href="http://www.sauvegarde95.fr/">http://www.sauvegarde95.fr/</a></dd>
							<dt class="unit-40 clear"><img src="images/partenaires/adsea77.jpg" alt="La Sauvegarde du 77" class="image-left"></dt><dd class="unit-60">La Sauvegarde du 77<br><a href="http://adsea77.fr/">http://adsea77.fr/</a></dd>
							<dt class="unit-40 clear"><img src="images/partenaires/syneas.jpg" alt="Le Syneas" class="image-left"></dt><dd class="unit-60">Le Syneas<br><a href="http://www.syneas.fr/">http://www.syneas.fr/</a></dd>
							<dt class="unit-40 clear"><img src="images/partenaires/uriopss-idf.jpg" alt="L'URIOPS" class="image-left"></dt><dd class="unit-60">L'URIOPS<br><a href="http://www.uriopss-idf.asso.fr/">http://www.uriopss-idf.asso.fr/</a></dd>
							<dt class="unit-40 clear"><img src="images/partenaires/cnaemo.jpg" alt="Le CNAEMO" class="image-left"></dt><dd class="unit-60">Le CNAEMO<br><a href="http://www.cnaemo.com/">http://www.cnaemo.com/</a></dd>
							<dt class="unit-40 clear"><img src="images/partenaires/adapss.jpg" alt="L'ADAPSS" class="image-left"></dt><dd class="unit-60">L'ADAPSS<br><a href="http://www.adapss.fr/">http://www.adapss.fr/</a></dd>
							<dt class="unit-40 clear"><img src="images/partenaires/irfase.jpg" alt="L'IRFASE" class="image-left"></dt><dd class="unit-60">L'IRFASE<br><a href="http://www.irfase.com/">http://www.irfase.com/</a></dd>
							<dt class="unit-40 clear"><img src="images/partenaires/andesi.jpg" alt="L'ANDESI" class="image-left"></dt><dd class="unit-60">L'ANDESI<br><a href="http://www.andesi.asso.fr/">http://www.andesi.asso.fr/</a></dd>
						</dl>
					</article>
					<aside class="unit-33">
						<!--<div id="diaporama" data-repertoire="mecs">
							<noscript><img src="images/mecs/DSCN0320-bis.jpg" alt="MECS"></noscript>
						</div>-->
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