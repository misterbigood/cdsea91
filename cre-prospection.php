<?php session_start();
$page = 'cre-prospection';
include_once('class/menu.php');
include_once('class/mysql.php');
include_once('class/actualites.php');
$actualites = new actualites('cre');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Comité Relogement Essonne - Pôle prospection</title>
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
						<h1><strong>C.R.E. </strong>Pôle prospection</h1>
						<div class="doc-inser">
                                                    <h4>Documentation</h4>
                                                    <a class="pdf" href="http://cdsea91.fr/inc/telechargerPdf.php?pdf=documentation/SAEMF/SAEMF - Projet de service.pdf">Projet de service</a>
                                                    <p style="text-align:right"><a href="http://cdsea91.fr/documentation.html#CRE">Plus...</a></p>
                                                </div>
                                                <p>Le pôle prospection reçoit les dossiers relatifs aux demandes de logement des personnes hébergées ponctuellement dans des structures telles que « les Centres d’Hébergement et de Réinsertion Sociale », « les Centres de Réfugiés Politiques », « les Centres de Demandeurs d’Asile », « les centres maternels », adhérentes à l’Association « Collectif Relogement Essonne ». a pour mission de soutenir les dossiers des demandeurs de logement</p>
<p>Préalablement, avant toute démarche de prospection, chaque dossier fait l’objet d’une étude approfondie permettant ainsi d’orienter les recherches de logement en adéquation avec la situation sociale et les attentes des personnes concernées  en tenant compte des obligations des différents réservataires ,Etat, Collectivités Territoriales et bailleurs sociaux..</p>
<p><strong>L’intervention des deux chargées de mission du Pôle Prospection </strong><strong> repose sur deux actions principales :</strong></p>
<ul><li>la mobilisation de dispositifs prioritaires d&rsquo;accès au logement prévus dans le cadre du Plan Départemental d’Actions pour l’hébergement et le Logement des Personnes Défavorisées (Accord Collectif Départemental, mission fluidité CHRS, le Droit Au Logement Opposable) et le relogement des publics non prioritaire (droit commun)</li>
    <li>le partenariat avec de nombreux réservataires de logements (Direction Départementale de la Cohésion Sociale, bailleurs sociaux, collectivités locales, Organismes d’Action logement)</li></ul>
<p>De plus, des commissions techniques et des réunions d&rsquo;information sont proposées aux adhérents sur l&rsquo;actualité sociale et juridique.</p>
<h5>Témoignages :</h5>
<p style="text-align: left;">«<em> De longue date, le CRE travaille en étroite collaboration avec les bailleurs sociaux implantés sur le département de l’Essonne. Ces partenariats, formalisés ou non, permettent de faciliter le relogement de ménages en situation de fragilités économiques et sociales, suivis par l’association. Des relations de confiance, fondées sur un professionnalisme reconnu des intervenants de l&rsquo;association et une écoute favorable des collaborateurs des bailleurs sociaux, permettent le rapprochement de deux mondes, celui des bailleurs sociaux et celui des associations.</em> »</p>
<p style="text-align: right;">Magali VALLET, Conseillère technique – AORIF</p>
<p>«<em> Sans le Pôle Prospection du CRE nous ne pourrions reloger nos familles accueillies en centre maternel. En effet le relogement n’est pas la mission prioritaire d’un centre maternel, c’est un plus que nous offrons aux familles. SANS LE CRE PAS DE RELOGEMENT car les dossiers de nos familles sont souvent fragiles : mères élevant seules leurs enfants, emploi précaire et peu payé. Nous n’avons pour l’instant jamais eu de proposition en direct par une mairie. Le CRE est donc notre seul « pourvoyeur » de logements et sans lui, nos familles en fin de séjour au centre maternel n’auraient comme unique solution de sortie, que des orientations vers des hôtels sociaux ou en CHRS</em>. »</p>
<p style="text-align: right;">Murielle RAFFINI, Educatrice spécialisée &#8211; Centre maternel LE MOULIN VERT</p>
<p>«<em> L’association Thalie, centre maternel, adhère au CRE depuis 2004. Elle partage ses valeurs associatives et défend la notion de « collectif d’associations », qui permet de se retrouver autour d’objectifs communs pour aider les familles à accéder et se maintenir dans un logement autonome. Nous faisons acte de solidarité ensemble, en mettant en œuvre et en commun nos compétences et nos moyens d’agir. Le service prospection répond aux besoins des familles que nous suivons ensemble. Concrètement, lorsqu’une famille va être prête à accéder au logement, nous transmettons son dossier complet au service prospection, qui s’en empare véritablement et cherche alors activement la meilleure adéquation possible entre le projet de la famille et un logement disponible. Le service prospection recherche un logement auprès de tous les réservataires avec qui il a noué des partenariats depuis de nombreuses années : des bailleurs, des collecteurs d’Action Logement et la DDCS bien sûr. Il continue à nouer de nouveaux partenariats chaque année pour augmenter toujours le nombre de relogements. Et les chiffres parlent d’eux-mêmes, les relogements sont en constante augmentation depuis plusieurs années. Lorsque cet accompagnement est dévolu au CRE, nous pouvons assurer un passage de relais efficace et rapide, dans la continuité d’un parcours sécurisant pour la famille, et rassurant pour l’équipe de Thalie.</em> »</p>
<p style="text-align: right;"><i>Véronique CHALMANDRIER, </i><i>Coordinatrice réseaux logement et parrainage </i></p>
<p  style="text-align: right;"><i>ASSOCIATION THALIE</i><em style="font-size: 1em;"> </em></p>
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