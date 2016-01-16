<?php session_start();
$page = 'aed-structure';
include_once('class/menu.php');
include_once('class/mysql.php');
include_once('class/actualites.php');
$actualites = new actualites('aed');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Service d'Aide Educative en milieu familial - La Structure</title>
        <meta name="description" content="Le Service d'Aide Educative en Milieu Familial propose un accompagnement visant à améliorer la situation de l'enfant au sein de sa famille.">
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
				<section id="contenu" class="units-row aed">
					<article class="unit-66">
						<h1><strong>S.A.E.M.F </strong>Service d'Aide Educative en milieu familial</h1>
						<p class="header">Le Service d'Aide Educative en Milieu Familial propose un accompagnement visant à améliorer la situation de l'enfant au sein de sa famille.</p>
						<div class="doc-inser">
                                                    <h4>Documentation</h4>
                                                    <a class="pdf" href="http://cdsea91.fr/inc/telechargerPdf.php?pdf=documentation/SAEMF/SAEMF - Projet de service.pdf">Projet de service</a>
                                                    <p style="text-align:right"><a href="http://cdsea91.fr/documentation.html#SAEMF">Plus...</a></p>
                                                </div>
                                                <p>Le Service d'Aide Educative en Milieu Familial, (S.A.E.M.F) exerce 920 mesures d'Aide Educative à Domicile, (A.E.D), qui lui sont confiées par le Conseil Général de l'Essonne, dans le cadre de sa politique de prévention et de protection de l'enfance.
Ces interventions sont décidées par les Inspecteurs de l'Aide Sociale à l'Enfance et concernent nominativement des enfants de 0 à 18 ans.</p>
						<p>Installées en proximité des familles, les six antennes du  SAEMF sont actuellement situées à Grigny, Corbeil, Evry, Vigneux sur Seine, Saint Michel sur Orge et Savigny sur Orge.</p>
						<p>L'aide éducative est attribuée soit à la demande des parents soit avec leur accord et s'engage dans le cadre d'une relation formalisée avec le service de l'Aide Sociale à l'Enfance.</p>
						<p>L'accompagnement proposé par le SAEMF s'adresse aux parents confrontés à des difficultés sur le plan éducatif pour lesquelles ils ne parviennent pas à trouver seuls les réponses adaptées.</p>
						<p>Le soutien éducatif mis en place prend en compte les difficultés et les préoccupations des parents et de leurs enfants, mais aussi leurs capacités et leurs potentiels.</p>
						<p>Il s'engage avec la participation active de la famille à la conception du Projet d'Accompagnement Personnalisé, (P.A.P) et sa mise en œuvre. Ce projet s'appuie sur la prise en compte des attentes des parents, de leurs potentiels, des besoins et des capacités de l'enfant ainsi que des propositions du service.</p>
						<p>L'intervention du SAEMF consiste, pour chaque situation, à mettre en place un soutien à la fonction parentale en proposant une écoute et une aide, dans le cadre d'une relation de confiance et d'un respect réciproque. </p>
						<p>L'accompagnement proposé par les éducateurs s'effectue principalement à travers des rencontres individuelles et/ou familiales, avec l'enfant et ses parents, au service ou à domicile, à l'occasion d'entretiens réguliers, mais aussi par le biais d'activités éducatives individuelles ou collectives et des démarches socio-éducatives en lien avec l'environnement habituel de l'enfant.</p>
						<p>L'engagement effectif des parents dans le projet de travail est primordial. Il implique leur collaboration active au projet négocié dans le cadre de l'A.E.D. Cette collaboration entre la famille et le SAEMF constitue un des fondements de notre projet de service. </p>
						<p>Le travail engagé avec l'enfant et sa famille s'inscrit dans le respect du rythme de chacun et nécessite parfois du temps, afin de consolider progressivement les changements qui s'opèrent. Le Projet d'Accompagnement Personnalisé est donc réactualisé avec la famille à intervalles réguliers.</p>
						<p>L'accompagnement éducatif proposé au S.A.E.M.F vise : </p>
						<ul>
							<li>A soutenir les parents dans l'exercice de leur responsabilité éducative;</li>
							<li>A Favoriser l'émergence des compétences parentales;</li>
							<li>A accompagner l'enfant dans le développement de ses capacités;</li>
							<li>A rechercher avec les familles les solutions les mieux adaptées pour améliorer durablement la situation de l'enfant.</li>
						</ul>
					</article>

					<aside class="unit-33">
						<div id="diaporama" data-repertoire="aed">
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