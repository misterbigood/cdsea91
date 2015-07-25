<?php include("AP/adminpro_class.php");
$prot = new protect();
if ($prot->showPage) {
    @ session_start();
    $page = 'actualites';
	$_SESSION['adressePage'] = 'actualites.php';
	include_once('../class/mysql.php');
	include_once('class/paginationAdmin.php');
	include_once('class/form.php');
    include_once('class/utils.php');
	include_once('class/BDD.php');
	include_once('class/actualitesAdmin.php');
	$actualites = new actualites();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/normalize.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="js/uniform/css/uniform.default.css">
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<link href="css/ajaxAdmin.css" rel="stylesheet" type="text/css" />
<link href="js/jquery-ui/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="conteneur">
	<?php
		include_once('inc/banniereAdmin.php');
		include_once('inc/menuAdmin.php');
	?>
  <div id="contenu">
    <h1>gestion des actualités</h1>
	<div id="result"></div>
	<div class="centre"><button class="btn-green" onclick="$('#divAjax').ajax({'url' : 'inc/ajoutActualites.php'});"><span class="icon icon-plus-round"></span>ajouter une actualité</button></div>
	<p>&nbsp;</p>
    <div id="divActualites"></div>
  </div> <!-- #contenu -->
  <hr class="separation" />
</div> <!-- #conteneur -->
<div id="divAjax"></div>
<script src="js/jquery-1.10.0.min.js"></script>
<script src="js/ajax-jquery-plugin.js"></script>
<script src="js/uniform/jquery.uniform.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/jquery-ui/jquery-ui.min.js"></script>
<script src="js/jquery-ui/jquery.ui.datepicker-fr.js"></script>
<script type="text/javascript" src="js/tinymce/jquery.tinymce.min.js"></script>
<script src="js/main-admin.js"></script>
<?php
	$BDD = new BDD();
	$BDD->testPost();
	$BDD->printResult();
?>
<script type="text/javascript">
	$('#divActualites').ajax({'url' : 'inc/afficherActualites.php', 'vars': '<?php if(!empty($_SERVER['QUERY_STRING'])) {
	echo '?'.$_SERVER['QUERY_STRING']; } ?>'});
</script>
</body>
</html>
<?php } ?>