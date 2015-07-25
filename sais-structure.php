<?php session_start();
$page = 'sais-structure';
include_once('class/menu.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>SAIS - Accompagnement de l'adulte en situation de handicap - La Structure</title>
        <meta name="description" content="Structure SAIS - Accompagnement de l'adulte en situation de handicap">
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
				<section id="contenu" class="units-row sais">
					<article class="unit-66">
						<h1><strong>sais</strong> accompagnement de l'adulte en situation de handicap</h1>
						<p class="header">Le Service d'Accompagnement et d'Insertion Sociale, S.A.I.S., composé de 2 services, accompagne et héberge 41 personnes adultes présentant une déficience intellectuelle. Un Foyer Appartement – FOA – héberge 20 personnes et un Service d'Accompagnement à la Vie Sociale – SAVS – assure la prise en charge de 21 personnes.</p>
						<p>Situé en centre-ville à Saint-Michel-sur-Orge, le foyer appartements FOA regroupe 7 logements associatifs collectifs et 2 studios individuels permettant l'hébergement de 20 personnes.</p>
						<p>Situé dans un rayon de 20 kms autour de Saint-Michel-sur-Orge, le Service d'Accompagnement à la Vie Sociale se compose de 18 logements dont les 21 personnes accueillies, célibataires ou en couple,  sont locataires ou propriétaires.</p>
						<p>Les personnes accueillies doivent disposer d'une notification de décision en faveur du foyer appartement ou du service d'accompagnement à la vie sociale, délivrée par la Maison Départementale des Personnes Handicapées.</p>
						<p>La durée de prise en charge est conditionnée par la date de validité de la décision MDPH.</p>
						<p>Afin de pérenniser l'accompagnement, l'établissement assure le renouvellement des dossiers de prise en charge MDPH et Aide Sociale.</p>
						<p>L'accompagnement socio-éducatif des adultes se réalise au domicile de la personne et au service. Il s'articule autour d'une aide et d'un soutien dans le champ de l'insertion sociale, de l'accès aux soins et du suivi médical. Cet accompagnement se concrétise par l'élaboration et la mise en œuvre de projets personnalisés réactualisés annuellement et validés par les représentants légaux. Ces projets s'appuient sur la prise en compte des personnes accueillies, de leur potentiel, de leurs besoins ainsi que des propositions du service. Les actions menées par le service concernent principalement :</p>
						<h3>La vie quotidienne :</h3>
						<ul>
							<li>Assistance et/ou accompagnement dans l'accomplissement des activités de la vie domestique;</li>
							<li>Aide et gestion administrative;</li>
							<li>Délivrance d'informations et de conseils personnalisés;</li>
						</ul>
						<h3>L'insertion sociale :</h3>
						<ul>
							<li>Accompagnement et soutien en faveur de l'activité professionnelle;</li>
							<li>Maintien des relations avec l'environnement familial et social;</li>
							<li>Aide à l'exercice de la parentalité des personnes déficientes;</li>
							<li>Inscription dans une vie citoyenne;</li>
							<li>Organisation du temps libre, des loisirs et des vacances;</li>
						</ul>
						<h3>La santé :</h3>
						<ul>
							<li>Coordination du suivi médical en tenant compte des capacités d'autonomie;</li>
							<li>Orientation et accompagnement vers les soins appropriés;</li>
							<li>Conseils personnalisés en matière d'hygiène de vie.</li>
						</ul>
						<hr>
						<p>Le service veille à la continuité de la prise en charge pendant les périodes d'absences (hospitalisation, vacances, séjours).</p>
						<p>Afin de garantir un soutien de qualité, le service assure une astreinte téléphonique 24h/24 et 7j/7.</p>
					</article>
					<aside class="unit-33">
						<div id="diaporama" data-repertoire="sais">
							<noscript><img src="images/sais/transfert-centerparc.jpg" alt="MECS"></noscript>
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