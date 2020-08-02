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
						<h1><strong>cdsea</strong> <br>comité départemental pour la sauvegarde de l'enfant à l'adulte</h1>
						<h2>L'équipe</h2>
						<p>&nbsp;</p>
						<div class="unit-centered unit-40 join-bottom">
							<div class="org-1 no-icon">
								<h4 class="fonction">conseil d'administration</h4>
								<p>Président<br><strong class="name">J-M. POUJOL</strong></p>
							</div>
						</div>
						<h3 class="unit-centered join-top">siège</h3>
                                                <p class="unit-centered">(4 salariés)<br>&nbsp;</p>
						
						
						<div class="unit-centered unit-50 join-bottom org-1 no-icon">
							<div class="unit-centered unit-90 join-bottom">
								<div class="org-2  no-icon //iconpeople iconpeople-3">
									<p>Directrice Générale<br><strong class="name">C. AZEMARD</strong></p>
								</div>
							</div>
							<div class="unit-centered unit-90 join-top org-last">
								<div class="org-3 no-icon //iconpeople iconpeople-2">
                                                                    <p>1 Responsable Ressources Humaines<br><strong class="name">M. TANAZACQ</strong></p>
									<p>1 comptable Responsable Administratif & Financier<br><strong class="name">F. FERREIRA</strong></p>
                                                                        <p>1 assistante comptable<br><strong class="name">L. CORTI</strong></p>
								</div>
							</div>
						</div>
                                                <div id="rateau" class="unit-centered width-83 rateau-5-divs"><span></span></div>
						<div class="units-row units-split">
							<div class="unit-16 join-top">
								<h3>ITEP & SESSAD</h3>
                                                                <p>(81 salariés)</p>
								<div class="org-3 no-icon //iconpeople iconpeople-3">
									<p>Directrice<br><strong class="name">A. BASSOT</strong></p>
								</div>
								<div class="org-4 no-icon //iconpeople iconpeople-2">
									<p>Chefs de service ITEP<br><strong class="name">M. YASSEF</strong></p>
									<p>Cheffe de service SESSAD<br><strong class="name">V. FLEURY</strong></p>
									<p>Chef de service technique<br><strong class="name">E. BROUANT</strong></p>
								</div>
							</div>
							<div class="unit-16 join-top">
								<h3>MECS</h3>
                                                                <p>(35 salariés)</p>
								<div class="org-3 no-icon //iconpeople iconpeople-3">
									<p>Directeur<br><strong class="name">M. MAXIMIN-TARTARE</strong></p>
								</div>
								<div class="org-4 no-icon //iconpeople iconpeople-2">
                                                                    <p>Cheffes de service<br><strong class="name">G. GOMES<br>C. SZENFELD</strong></p>
																	<p>Chef de service technique<br><strong class="name">M. DARRAS</strong></p>
								</div>
							</div>
							<div class="unit-33 join-top">
								<h3>AED</h3>
                                                                <p>(60 salariés)</p>
								<div class="org-3 no-icon unit-95 unit-centered //iconpeople iconpeople-3 ">
									<p>Directrice<br><strong class="name">N. DIARD</strong></p>
								</div>
								<div class="unit-33">
									<h3 class="small">corbeil</h3>
									<div class="org-4 no-icon //iconpeople iconpeople-2">
										<p>Chef de service<br><strong class="name">M. A&Iuml;SSAOUI</strong></p>									</div>
								</div>
                                                                <div class="unit-33">
									<h3 class="small">evry</h3>
									<div class="org-4 no-icon //iconpeople iconpeople-2">
										<p>Cheffe de service<br><strong class="name">C. COUDRAY</strong></p>
									</div>
								</div>
                                                                <div class="unit-33">
									<h3 class="small">grigny</h3>
									<div class="org-4 no-icon //iconpeople iconpeople-2">
										<p>Cheffe de service<br><strong class="name">B. HANS</strong></p>
									</div>
								</div>
                                                                <div class="unit-33">
									<h3 class="small">saint michel</h3>
									<div class="org-4 no-icon //iconpeople iconpeople-2">
										<p>Chef de service<br><strong class="name">G. BOISEAU</strong></p>
									</div>
								</div>
								<div class="unit-33">
									<h3 class="small">Savigny</h3>
									<div class="org-4 no-icon //iconpeople iconpeople-2">
										<p>Cheffe de service<br><strong class="name">M. RODRIGUES</strong></p>
									</div>
								</div>
								<div class="unit-33">
									<h3 class="small">vigneux</h3>
									<div class="org-4 no-icon //iconpeople iconpeople-2">
										<p>Cheffe de service<br><strong class="name">N. MARIE-JULIE</strong></p>
									</div>
								</div>
							</div>
							<div class="unit-16 join-top">
								<h3>SAIS</h3>
                                                                <p>(16 salariés)</p>
								<div class="org-3 no-icon //iconpeople iconpeople-3">
									<p>Directeur<br><strong class="name">C. VIOLEAU</strong></p>
								</div>
								<div class="org-4 no-icon //iconpeople iconpeople-2">
									<p>Cheffes de service<br><strong class="name">B. DELAUNAY<br>I. AUBERT</strong></p>
								</div>
							</div>
                                                    <div class="unit-16 join-top">
								<h3>CRE</h3>
                                                                <p>(16 salariés)</p>
								<div class="org-3 no-icon //iconpeople iconpeople-3">
									<p>Directeur<br><strong class="name">C. VIOLEAU</strong></p>
								</div>
                                                                <div class="org-4 no-icon //iconpeople iconpeople-2">
									<p>Coordinatrice<br><strong class="name">C. DAUBE</strong></p>
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