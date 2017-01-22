<?php session_start();
$page = 'cre-structure';
include_once('class/menu.php');
include_once('class/mysql.php');
include_once('class/actualites.php');
$actualites = new actualites('cre');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Comité Relogement Essonne - La Structure</title>
        <meta name="description" content="Le CRE a pour mission de favoriser l'accès et le maintien dans le logement de personnes en situation d'exclusion ou de difficultés économiques et sociales.">
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
				<section id="contenu" class="units-row cre">
					<article class="unit-66">
						<h1><strong>C.R.E. </strong>Comité Relogement Essonne</h1>
						<p class="header">Le CRE a pour mission de favoriser l'accès et le maintien dans le logement de personnes en situation d'exclusion ou de difficultés économiques et sociales.</p>
						
                                                <p>Le Collectif Relogement Essonne défend le caractère universel du principe du droit au logement :</p>
                                                <ul><li><strong>Par la promotion et la défense du droit au logement</strong></li></ul>
                                                <p>Considérant que l&rsquo;obtention d’un logement est un facteur important d’insertion et d&rsquo;équilibre, le Collectif Relogement Essonne s&rsquo;est donné pour mission de faciliter l&rsquo;accès, l&rsquo;appropriation et le maintien  des personnes dans un logement autonome.</p>
                                                <ul><li><strong>Par l&rsquo;application des lois en matière de logement, d’accès au droit commun et de lutte contre les exclusions</strong></li></ul>
                                                <p>Attentif et vigilant aux évolutions des politiques de logement, nous avons pour objectif principal de favoriser l’accès au logement et le maintien dans l’habitat de toute personne fragilisée par sa situation sociale ou économique.</p>
                                                <ul><li><strong>Par la construction d’un réseau d’acteurs</strong></li></ul>
                                                <p>Fort d&rsquo;un ancrage depuis plus de 30 ans sur le département, c&rsquo;est un souci permanent pour l&rsquo;association, d&rsquo;entretenir, de consolider et de développer des partenariats.</p></ul>
                                                <div class="doc-inser">
                                                    <h4>Documentation</h4>
                                                    <a class="pdf" href="http://cdsea91.fr/inc/telechargerPdf.php?pdf=documentation/SAEMF/SAEMF - Projet de service.pdf">Projet de service</a>
                                                    <p style="text-align:right"><a href="http://cdsea91.fr/documentation.html#CRE">Plus...</a></p>
                                                </div>
                                                <p>Le Collectif Relogement Essonne privilégie l’acquisition du statut de locataire à toute solution transitoire ne peut être qu’une étape pour y accéder – et accorde une place particulière à la lutte contre toutes les formes de discrimination.</p>
                                                <br/><p>Nos missions :</p>
                                                <ul>
                                                <li>Favoriser l&rsquo;accès au logement des personne en situation d&rsquo;exclusion</li>
                                                <li>Permettre le maintien dans le logement des personnes en difficultés économiques et sociale</li>
                                                <li>Mener des actions d&rsquo;ingénierie sociale, d&rsquo;animation des réseaux.</li>
                                                </ul>
                                                <p>Le Collectif Relogement Essonne rassemble des adhérents et est constitué d&rsquo;un Pôle Prospection et d&rsquo;un Pôle Social.</p>
					</article>

					<aside class="unit-33">
						<div id="diaporama" data-repertoire="cre">
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