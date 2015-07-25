<?php include("AP/adminpro_class.php");
$prot = new protect();
if ($prot->showPage) {
	@ session_start();
	$_SESSION['is_admin'] = true;
	$page = 'accueil';
	include_once('../class/mysql.php');
	include_once('class/utils.php');
	?>
	<!DOCTYPE html>
	<html lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/normalize.css" rel="stylesheet" type="text/css">
		<link href="css/admin.css" rel="stylesheet" type="text/css" />
		<link href="css/ajaxAdmin.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="conteneur">
			<?php
			include_once('inc/banniereAdmin.php');
			include_once('inc/menuAdmin.php');
			?>
			<div id="contenu">
				<h1>Bienvenue dans l'administration CDSEA</h1>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p class="infoTop">Utilisez le bouton "actualiser les suggestions de recherche" après ajout / modification de contenu<br>pour intégrer le nouveau contenu aux résultats de recherche sur le site.</p>
				<p>&nbsp;</p>
				<div class="centre"><button class="btn-green" onclick="$('#divAjax').ajax({'url' : 'inc/actualiser-suggestions-recherche.php', 'btnFermer': true, 'appear': 0});"><span class="icon icon-plus-round"></span>actualiser les suggestions de recherche</button></div>
				<p>&nbsp;</p>
			</div> <!-- #contenu -->
			<hr class="separation" />
		</div> <!-- #conteneur -->
		<div id="divAjax"></div>
		<script src="js/jquery-1.10.0.min.js"></script>
		<script src="js/ajax-jquery-plugin.js"></script>
		<script src="js/uniform/jquery.uniform.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/main-admin.js"></script>
	</body>
	</html>
<?php } ?>