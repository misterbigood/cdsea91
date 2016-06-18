<?php session_start();
$page = 'cdsea-audacite';
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
						<figure><img src="images/logo-audacite.png" alt="AudaCité"></figure>
						<p></p>
						<h2>PROJET</h2>
						<p>AudaCité est un nouveau réseau d'actions sociales qui a été créé le 7 décembre 2011 par la Sauvegarde de l'Adolescence à Paris et la Sauvegarde de l'enfant, de l'adolescent et de l'adulte de la Seine-Saint-Denis, rejoint en 2012 par  la Sauvegarde de l'Essonne et du Val d'Oise . AudaCité a pour ambition de réunir en réseau des associations de terrain pour leur permettre de porter ensemble des initiatives et d'apporter des solutions plus efficaces, plus globales et plus personnalisées aux publics en grande difficulté sociale sur le territoire de l'Ile de France.</p>
						<h2>Nos engagements</h2>
						<p>Face à l'accroissement des besoins des enfants, des jeunes et des familles en grande détresse, AudaCité propose aux associations qui partagent son constat et ses convictions de rejoindre son réseau. Mises ainsi en synergie, les associations peuvent partager leurs expériences, se renforcer par leurs complémentarités, essaimer des pratiques innovantes et mettre en place des solutions mieux adaptées et plus efficientes dans l'intérêt des bénéficiaires.</p>
						<h2>Nos moyens</h2>
						<p>AudaCité additionne les ressources humaines et les moyens techniques de ses membres dans une organisation réunissant des expertises mises au service de chaque association et du projet commun. Elle renforce les capacités et les compétences des associations constituant le réseau en matière d'ingénierie sociale, de gestion, financière et économique, de ressources humaines et de communication mais aussi en matière patrimoniale et juridique.</p>
						<p>Forte de l'expérience des associations de terrain qui la composeront, AudaCité lutte contre les préjugés et porte au débat public les observations mais aussi les actions qui feront évoluer les regards sur la question sociale. Ce réseau est force de proposition militante dans son domaine d'activité éducatif et social.</p>

						<p class="header">AUDACITE, aujourd'hui c'est ...</p>
						<ul>
							<li>49 structures</li>
							<li>20 000 personnes suivies (enfants et familles)</li>
							<li>1 100 salariés</li>
							<li>Près de 80 bénévoles, dont 50 Administrateurs</li>
							<li>60 132 K€ de budget</li>
						</ul>
					</article>
					<aside class="unit-33">
						<!--<div id="diaporama" data-repertoire="audacite">
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