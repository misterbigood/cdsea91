<?php session_start();
$page = 'cre-social';
include_once('class/menu.php');
include_once('class/mysql.php');
include_once('class/actualites.php');
$actualites = new actualites('cre');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Comité Relogement Essonne - Pôle social</title>
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
						<h1><strong>C.R.E. </strong>Pôle social</h1>
						<p><strong>L’accompagnement social lié au logement</strong> est destiné aux ménages rencontrant des difficultés à accéder ou à se maintenir dans un logement. Ces difficultés peuvent être budgétaires, administratives, relationnelles ou d&rsquo;appropriation du logement et de l’environnement.</p>
<p>Elle s’inscrit sur le département de l&rsquo;Essonne et principalement en visite à domicile. Afin de rencontrer les personnes dans leur environnement, nous adaptons nos horaires de travail en fonction de leurs contraintes.</p>
<p>Pour toutes familles suivies, nous prenons un temps d’évaluation afin de les accompagner au plus près de leurs réalités et besoins.</p>
<p>Ainsi, un projet socio éducatif se construit et se contractualise avec l&rsquo;ensemble des acteurs sociaux compétents.</p>
<p>Nos actions peuvent différées en fonction des dispositifs (avant le relogement, lors de l’accès au logement ou dans le cadre du maintien dans les lieux) mais la finalité de nos accompagnements reste la même, <strong>l’autonomie du ménage dans une perspective d’insertion durable.</strong></p>
<p>Nos champs d’intervention, ne sont pas exhaustifs mais s’inscrivent dans le domaine du logement :</p>
<p><strong>En amont du logement :    </strong></p>
<ul>
<li>Elaboration du projet logement en fonction des besoins et capacités</li>
<li>Actionner les différents dispositifs d’accès au logement</li>
<li>Projection et stabilité budgétaire en lien avec le futur logement</li>
</ul>
<p><strong>Lors de l’accès au logement</strong></p>
<ul>
<li>Ouverture des droits</li>
<li>Apprentissage du statut de locataire</li>
<li>Travail autour de l’équilibre budgétaire, régularité du paiement du loyer et des charges</li>
<li>Appropriation du logement et de l’environnement</li>
</ul>
<p><strong>Dans le cadre du maintien</strong></p>
<ul>
<li>Identifier la problématique qui a conduit le ménage à un impayé locatif</li>
<li>Action éducative budgétaire</li>
<li>Relation et négociation avec le bailleur pour valider le projet de maintien dans les lieux</li>
<li>Connaissance des droits et devoirs du locataire et prise de conscience de la procédure d&rsquo;expulsion.</li>
</ul>
<h3>Témoignages</h3>
<p style="font-style: italic">« Le CRE est intervenu car j’avais des difficultés financières. […] (il) a joué la médiation entre le bailleur et moi. Il m&rsquo;a guidé dans mes démarches. Sa capacité d&rsquo;écoute, sa présence, sa rigueur de jugement, ses conseils éclairés m’ont aidée. »</p>
<p style="text-align: right">Rose-Marie, 50 ans</p>
<p style="font-style: italic">« Elle venait me voir chez moi et ça c&rsquo;était un avantage. »</p>
<p style="text-align: right">Florence, 35 ans</p>
<p style="font-style: italic">« Le CRE a travaillé à mon rythme, rien ne m’était imposé. »</p>
<p style="text-align: right">Mamdiou, 25 ans</p>

<h3>FN AVDL 2014</h3>
<p>La mission FN AVDL Accompagnateur portée par le CRE et 4 opérateurs partenaires (AISH, Société de Saint Vincent de Paul, Communauté Jeunesse &#8211; Logis Mons et Oppélia &laquo;&nbsp;Les Buissonnets&nbsp;&raquo; perdure.</p>
<p>Le réajustement des objectifs sur le réalisé 2013 a fait état d’une grande différence sur le nombre d’orientations de suivis Approfondis. Initialement, l’estimation portait sur 33 et finalement, 7 ont été réalisés alors même que c’est la mesure la plus financée. Pour rester cohérente avec le budget prévisionnel, la DDCS a augmenté les objectifs de manière proportionnelle au réalisé 2013 :</p>
<ul>
<li>96 légers</li>
<li>135 moyens</li>
<li>20 approfondis</li>
</ul>
<p>Les objectifs sont portés à 251 mesures à la place de 192.</p>
					</article>

					<aside class="unit-33">
						<!--<div id="diaporama" data-repertoire="cre">
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