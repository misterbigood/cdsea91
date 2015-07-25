<?php session_start(); 
$page = 'cdsea-mentions-legales';
include_once('class/menu.php');
include_once('class/mysql.php');
include_once('class/pagination.php');
include_once('class/offres_emploi.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Comité départemental de sauvegarde de l'enfant à l'adulte de l'Essonne - Offres d'Emploi</title>
        <meta name="description" content="Offres d'Emploi du Comité départemental de sauvegarde de l'enfant à l'adulte de l'Essonne">
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
					<article class="unit-66">
						<h2>Mentions légales</h2>
                                                <p>Le site <a href="http://www.cdsea91.fr">www.cdsea91.fr</a> est le site web du <strong>Comité Départemental de la Sauvegarde de l’Enfance à l’Adulte de l’Essonne</strong> (C.D.S.E.A. 91). Le C.D.S.E.A. 91 est une association régie par le loi du 1er juillet 1901. Ce site internet vise à être un support central de toutes les informations relatives à l’Association et à l’activité des établissements et services du C.D.S.E.A. 91.

                                                <h3>Responsabilité</h3>
                                                <p><strong>Directeur de la publication</strong> : Frédéric MAMBRINI, Directeur Général du C.D.S.E.A. 91.</p>
                                                <p>Les contenus publiés sur ce site ne revêtent qu’une valeur purement informative, valable à leur date de publication. Sauf mention contraire explicite, ils ne sauraient être considérés comme ayant une quelconque valeur contractuelle.
                                                A ce titre, ils peuvent être amendés, modifiés ou supprimés à tout moment et sans préavis, sans que ces amendements, modifications ou suppressions ne puissent être considérés comme constitutifs d’un préjudice quelconque à l’encontre des visiteurs et lecteurs.</p>
                                                <p>Le C.D.S.E.A. 91 décline toute responsabilité concernant :</p>
                                                <ul>
                                                    <li>Les conséquences liées au fonctionnement et/ou défaillances des  liens hypertextes présents sur le site&nbsp;;</li>
                                                    <li>Les contenus des pages externes (autres sites non hébergés par le C.D.S.E.A. 91) pointées par ces liens.</li>
                                                </ul>
                                                <p>En cas de lien erroné, non valide, ou pointant sur une page dont les contenus vous sembleraient inappropriés ou illégaux, merci d’en informer au plus vite le C.D.S.E.A. 91.</p>
                                                <p>La langue officielle du site est le français et le site est soumis au droit français et relève de la compétence exclusive des juridictions françaises.</p>
                                                <h3>Crédits et propriété</h3>
                                                <p><strong>Etude, conception et réalisation</strong> : Idées Fraîches, 2 Rue Jules Lemoine, 91290 Arpajon.</br>
                                                   <strong>Maintenance, animation éditoriale</strong> : Christophe Violeau.</p>

                                                <p><strong>Animations, illustrations, photographies et vidéos</strong> : &copy; CDSEA91, sauf crédit mentionné directement sur le média.</br>
                                                    <strong>Autres contenus, textes</strong> : &copy; CDSEA91, sauf crédit mentionné directement dans le contenu.</p>
                                                <p>Les contenus et les informations de ce site sont protégés par le droit sur la propriété intellectuelle. Il est interdit de les utiliser ou de les reproduire sans l’autorisation expresse et préalable du C.D.S.E.A. 91.</br>
                                                    Toute reproduction, utilisation ou représentation, intégrale ou partielle des pages, des données, et d’une manière générale de tout élément constituant ce site sur quelque support que ce soit est strictement interdite sans autorisation préalable du C.D.S.E.A. 91.</p>
                                                <h3>Création de liens vers le site du C.D.S.E.A. 91</h3>
                                                <p>Le C.D.S.E.A. 91 autorise tout site Internet ou tout autre support à le citer ou à mettre en place un lien hypertexte pointant vers son contenu. L’autorisation de mise en place d’un lien est valable pour tout site, à l’exception de ceux diffusant des informations à caractère polémique, pornographique, xénophobe ou pouvant, dans une plus large mesure, porter atteinte à la sensibilité du plus grand nombre, ou causer un préjudice quelconque au C.D.S.E.A. 91, à sa réputation, à son image ainsi qu’à celle de ses membres.</p>
                                                <h3>Informations techniques</h3>
                                                <p>Le site www.cdsea91.fr est conçu en mode responsive, ce qui doit permettre un affichage optimisé sur tous supports de lecture (ordinateurs, tablettes et smartphones).</br>
                                                    Toutefois, afin de bénéficier de la meilleure qualité de visualisation et de navigation, nous conseillons la consultation du site sur un écran d’une résolution minimale de 1024x768, sur un navigateur bénéficiant de la mise à jour la plus récente.</p>
                                                <h3>Hébergement</h3>
                                                <p>OVH</br>
                                                    SAS au capital de 500 k€ RCS Roubaix</br>
                                                    Tourcoing 424 761 419 00011</br>
                                                    Code APE 721Z</br>
                                                    N° TVA : FR 22-424-761-419-00011</br>
                                                Siège social : 140 Quai du Sartel, 59100 Roubaix, France
                                                </p>
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
