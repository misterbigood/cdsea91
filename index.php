<?php session_start();
$page = 'cdsea-association';
include_once('class/menu.php');
include_once('class/mysql.php');
include_once('class/actualites.php');
$actualites = new actualites('index');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Comité départemental de sauvegarde de l'enfant à l'adulte de l'Essonne</title>
        <meta name="description" content="Comité départemental de sauvegarde de l'enfant à l'adulte de l'Essonne - Projet associatif 2014-2019">
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
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//www.mdfconseil.fr/piwik/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 2]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//www.mdfconseil.fr/piwik/piwik.php?idsite=2" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->

    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="chromeframe">Vous utilisez un navigateur préhistorique .... <a href="http://browsehappy.com/"> Pourquoi pas le mettre à jour maintenant ?</a> ou <a href="http://www.google.com/chromeframe/?redirect=true">installer Google Chrome Frame</a> pour profiter de toutes les fonctionnalités de ce site</p>
        <![endif]-->
		<?php /*include_once('inc/menu-fixed.php'); */ ?>
		<div id="footerWrapper">
			<?php include_once('inc/banniere.php'); ?>
			<div id="conteneur">

				<h1>Comité Départemental de Sauvegarde de l'Enfant à l'Adulte de l'Essonne</h1>
                                <?php $main_menu = new menu('page-nav', $page); ?>
				<section id="contenu" class="units-row cdsea">
					<article class="unit-66">
						<h1><strong>cdsea</strong></h1>
						<p class="header">Projet associatif 2014-2019</p>
						<h2>Une histoire</h2>
						<img src="images/photocdsea.jpg" height="147" width="280" alt="CDSEA" class="image-right">
						<p>Le CDSEA est créé en 1970, sur l'initiative du président du Conseil Général de l'Essonne, afin de restructurer des établissements en difficulté sur les communes de Morigny (ITEP et SESSAD de Brunehaut), de Morsang-sur-Orge (MECS) et de porter des projets dans le champ médico-social.<br>La gouvernance du CDSEA sera assurée par le Conseil Général (administrateurs nommés par l'Assemblée Départementale) entre 1970 et 2007.</p>
						<p>Sous un statut d'association à but non lucratif (Loi 1901), le CDSEA va restructurer les deux établissements dont la gestion lui est confiée et développer des activités dans les champs de la protection de l'enfance (Services d'Action Educative en Milieu Familial) et du handicap (Service d'Accompagnement et d'Insertion Sociale).</p>
						<p>Le changement de statuts en 2007 repositionne l'association dans une dimension territoriale plus élargie avec des administrateurs moins dépendants du Conseil Général et représentant les acteurs de la société civile.<br>Une convention de partenariat avec les cinq autres Sauvegardes franciliennes est signée en 2008.<br>Depuis janvier 2013, le CDSEA a accentué son rapprochement avec les Sauvegardes de Paris, de Seine Saint Denis et du Val d'Oise en adhérant à un groupement des quatre associations dénommé AUDACITE.<br>Le développement du CDSEA se fera désormais dans le cadre de ce regroupement (les réponses aux appels à projets se font au nom d'AUDACITE sur le territoire régional).</p>
						<h2>Des valeurs</h2>
						<ul id="valeurs">
							<li><strong>Solidarité</strong>l'association oriente prioritairement son action au bénéfice des personnes les plus vulnérables et entend contribuer au projet de cohésion sociale sur son territoire d'intervention.</li>
							<li><strong>Humanisme</strong>l'association défend des principes d'éducation reposant sur la capacité de chaque personne à rester actrice de sa destinée.<br>Elle favorise la collaboration des personnes en mobilisant et en renforçant les potentialités.</li>
							<li><strong>Citoyenneté</strong>l'association défend et représente l'intérêt des personnes les plus vulnérables dans l'exercice de leur citoyenneté.<br>Elle propose et adapte ses projets en fonction de l'évolution des besoins des personnes.</li>
							<li><strong>Laïcité</strong>l'association défend des principes d'éducation laïque dans un esprit républicain. Elle respecte le fait religieux mais interdit toute forme de prosélytisme.</li>
						</ul>
                                                <h2>Des missions</h2>
						<p>Dans le respect de ses valeurs, le CDSEA entend contribuer à la réalisation et au développement d'un véritable projet de cohésion sociale sur le territoire Essonnien.</p>
						<p>L'association a pour mission principale de proposer, de porter et faire évoluer tout projet permettant de favoriser la vie et l'expression citoyenne des personnes les plus vulnérables.</p>
						<h3>Aujourd'hui le CDSEA</h3>
						<ul><li>Accompagne 1 300 enfants, adolescents ou adultes</li>
							<li>Avec l'aide de 200 professionnels</li>
							<li>Dans une vingtaine de communes de l'Essonne</li>
							<li>Pour un budget de 11M &euro;</li>
						</ul>
                                                <h2>Conseil d'Administration</h2>
						<h3>Membres du bureau :	</h3>
						<dl class="units-row">
							<dt class="unit-50">Marie-Christine CARVALHO</dt>
							<dd class="unit-50"><span class="width-50">Présidente</span></dd>

							<dt class="unit-50">Jean-Marie POUJOL</dt>
							<dd class="unit-50"><span class="width-50">Vice-Président</span></dd>
							<dt class="unit-50">Germaine PEYRONNET</dt>
							<dd class="unit-50"><span class="width-50">Secrétaire</span></dd>
							<dt class="unit-50">Béatrice PERIE</dt>
							<dd class="unit-50"><span class="width-50">Trésorière</span></dd>
						</dl>
                                                <h2>Les partenaires</h2>
						<dl class="units-row" id="partenaires">
							<dt class="unit-16"><img src="images/partenaires/sauvegarde-yvelines.jpg" alt="La Sauvegarde des Yvelines" class="image-left"></dt><dd class="unit-33">La Sauvegarde des Yvelines<br><a href="http://www.sauvegarde-yvelines.org/">http://www.sauvegarde-yvelines.org/</a></dd>
							<dt class="unit-16"><img src="images/partenaires/sauvegarde-paris.jpg" alt="La Sauvegarde de Paris" class="image-left"></dt><dd class="unit-33">La Sauvegarde de Paris<br><a href="http://www.sauvegarde-paris.fr/">http://www.sauvegarde-paris.fr/</a></dd>
							<dt class="unit-16 clear"><img src="images/partenaires/sauvegarde93.jpg" alt="La Sauvegarde du 93" class="image-left"></dt><dd class="unit-33">La Sauvegarde du 93<br><a href="http://www.sauvegarde93.fr/">http://www.sauvegarde93.fr/</a></dd>
							<dt class="unit-16"><img src="images/partenaires/sauvegarde95.jpg" alt="La Sauvegarde du 95" class="image-left"></dt><dd class="unit-33">La Sauvegarde du 95<br><a href="http://www.sauvegarde95.fr/">http://www.sauvegarde95.fr/</a></dd>
							<dt class="unit-16 clear"><img src="images/partenaires/adsea77.jpg" alt="La Sauvegarde du 77" class="image-left"></dt><dd class="unit-33">La Sauvegarde du 77<br><a href="http://adsea77.fr/">http://adsea77.fr/</a></dd>
							<dt class="unit-16"><img src="images/partenaires/syneas.jpg" alt="Le Syneas" class="image-left"></dt><dd class="unit-33">Le Syneas<br><a href="http://www.syneas.fr/">http://www.syneas.fr/</a></dd>
							<dt class="unit-16 clear"><img src="images/partenaires/uriopss-idf.jpg" alt="L'URIOPS" class="image-left"></dt><dd class="unit-33">L'URIOPS<br><a href="http://www.uriopss-idf.asso.fr/">http://www.uriopss-idf.asso.fr/</a></dd>
							<dt class="unit-16"><img src="images/partenaires/cnaemo.jpg" alt="Le CNAEMO" class="image-left"></dt><dd class="unit-33">Le CNAEMO<br><a href="http://www.cnaemo.com/">http://www.cnaemo.com/</a></dd>
							<dt class="unit-16 clear"><img src="images/partenaires/adapss.jpg" alt="L'ADAPSS" class="image-left"></dt><dd class="unit-33">L'ADAPSS<br><a href="http://www.adapss.fr/">http://www.adapss.fr/</a></dd>
							<dt class="unit-16"><img src="images/partenaires/irfase.jpg" alt="L'IRFASE" class="image-left"></dt><dd class="unit-33">L'IRFASE<br><a href="http://www.irfase.com/">http://www.irfase.com/</a></dd>
							<dt class="unit-16 clear"><img src="images/partenaires/andesi.jpg" alt="L'ANDESI" class="image-left"></dt><dd class="unit-33">L'ANDESI<br><a href="http://www.andesi.asso.fr/">http://www.andesi.asso.fr/</a></dd>
						</dl>
                                                <h2>Les financeurs</h2>
                                                <dl class="units-row" id="partenaires">
                                                    <dt class="unit-50"><img src="images/conseil-general-essonne.png" alt="Conseil Départemental de l'Essonne" class="image-left"></dt>
                                                    <dt class="unit-50"><img src="images/agence-regionale-de-sante.png" alt="Agence Régionale de Santé" class="image-left"></dt>
                                                </dl>
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
