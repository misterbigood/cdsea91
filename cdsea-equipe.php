<?php session_start(); 
$page = 'cdsea-equipe';
include_once('class/menu.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Comité départemental de sauvegarde de l'enfant à l'adulte de l'Essonne - L'Equipe</title>
        <meta name="description" content="Equipe du Comité départemental de sauvegarde de l'enfant à l'adulte de l'Essonne">
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
		<?php include_once('inc/menu-fixed.php'); ?>
		<div id="footerWrapper">
			<?php include_once('inc/banniere.php'); ?>
			<div id="conteneur">
				<h1>Comité Départemental de Sauvegarde de l'Enfant à l'Adulte de l'Essonne</h1>
                                <?php $main_menu = new menu('page-nav', $page); ?>
				<section id="contenu" class="units-row cdsea">
					<article id="organigramme">
						<h1><strong>cdsea</strong> <br>comité départemental pour la sauvegarde de l'enfant à l'adulte</h1>
						<p class="header">Projet associatif 2014-2019</p>
						<h2>L'équipe</h2>
						<p>&nbsp;</p>
						<div class="unit-centered unit-40 join-bottom">
							<div class="org-1 no-icon">
								<h4 class="fonction">conseil d'administration</h4>
								<p><strong class="name">M-C. CARVALHO</strong><br>Présidente</p>
							</div>
						</div>
						<h3 class="unit-centered join-top">siège</h3>
						
						
						<div class="unit-centered unit-50 join-bottom org-1 no-icon">
							<div class="unit-centered unit-90 join-bottom">
								<div class="org-2  no-icon //iconpeople iconpeople-3">
									<p><strong class="name">F.  MAMBRINI</strong><br>Directeur Général</p>
								</div>
							</div>
							<div class="unit-centered unit-90 join-top org-last">
								<div class="org-3 no-icon //iconpeople iconpeople-2">
									<p>1 comptable Responsable Ressources Humaines</p>
									<p>1 comptable Responsable Contrôle de Gestion</p>
								</div>
							</div>
						</div>
						<div id="rateau" class="unit-centered width-80 rateau-cdsea"></div>
						<div class="units-row units-split">
							<div class="unit-20 join-top">
								<h3>ITEP & SESSAD</h3>
								<div class="org-3 no-icon //iconpeople iconpeople-3">
									<p><strong class="name">N.AGAMIS</strong> Directrice</p>
									<p><strong class="name">L.RAMBURE</strong> Adjoint</p>
								</div>
								<div class="org-4 no-icon //iconpeople iconpeople-2">
									<p><strong class="name">K. HAUGUET<br>S. OUANANI</strong> <br>Chefs de service ITEP</p>
									<p><strong class="name">J. VALENS</strong> <br>Chef de service SESSAD</p>
								</div>
							</div>
							<div class="unit-20 join-top">
								<h3>MECS</h3>
								<div class="org-3 no-icon //iconpeople iconpeople-3">
									<p><strong class="name">JJ. ANTOINE</strong> Directeur</p>
								</div>
								<div class="org-4 no-icon //iconpeople iconpeople-2">
                                                                    <p><strong class="name">G. MALONGA<br>N. RODRIGUES</strong><br/>Chefs de service</p>
								</div>
							</div>
							<div class="unit-40 join-top">
								<h3>AED</h3>
								<div class="org-3 no-icon unit-80 unit-centered //iconpeople iconpeople-3 ">
									<p><strong class="name">C. REGNARD</strong> Directeur</p>
								</div>
								<div class="unit-33">
									<h3 class="small">corbeil</h3>
									<div class="org-4 no-icon //iconpeople iconpeople-2">
										<p><strong class="name">M. A&Iuml;SSAOUI</strong><br>Chef de service</p>									</div>
								</div>
                                                                <div class="unit-33">
									<h3 class="small">evry</h3>
									<div class="org-4 no-icon //iconpeople iconpeople-2">
										<p><strong class="name">B. DESPALLES</strong><br>Chef de service</p>
									</div>
								</div>
                                                                <div class="unit-33">
									<h3 class="small">grigny</h3>
									<div class="org-4 no-icon //iconpeople iconpeople-2">
										<p><strong class="name">B. HANS</strong><br>Chef de service</p>
									</div>
								</div>
                                                                <div class="unit-33">
									<h3 class="small">saint michel</h3>
									<div class="org-4 no-icon //iconpeople iconpeople-2">
										<p><strong class="name">G. BOISEAU</strong><br>Chef de service</p>
									</div>
								</div>
								<div class="unit-33">
									<h3 class="small">Savigny</h3>
									<div class="org-4 no-icon //iconpeople iconpeople-2">
										<p><strong class="name">C. COUDRAY</strong><br>Chef de service</p>
									</div>
								</div>
								<div class="unit-33">
									<h3 class="small">vigneux</h3>
									<div class="org-4 no-icon //iconpeople iconpeople-2">
										<p><strong class="name">C. VIOLEAU</strong><br>Chef de service</p>
									</div>
								</div>
							</div>
							<div class="unit-20 join-top">
								<h3>SAIS</h3>
								<div class="org-3 no-icon //iconpeople iconpeople-3">
									<p><strong class="name">J.LERICOLLAIS</strong> Directeur</p>
								</div>
								<div class="org-4 no-icon //iconpeople iconpeople-2">
									<p><strong class="name">B.DELAUNAY<br>I.AUBERT</strong> <br>Chefs de service</p>
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