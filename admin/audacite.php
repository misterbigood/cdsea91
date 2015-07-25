<?php include("AP/adminpro_class.php");
$prot = new protect();
if ($prot->showPage) {
    @ session_start();
	$_SESSION['is_admin'] = true;
    $page = 'ag_bureau';
    include_once('../class/mysql.php');
    include_once('class/utils.php');
?> 
<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/normalize.css" rel="stylesheet" type="text/css">
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="screen" href="js/jquery-ui/smoothness/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" media="screen" href="js/elfinder/css/elfinder.min.css">
</head>
<body>
<div id="conteneur">
	<?php 
		include_once('inc/banniereAdmin.php'); 
		include_once('inc/menuAdmin.php');
	?>
  <div id="contenu">
    <h1>Audacité</h1>
	<div class="infoTop">
		<p>Le nom de chaque dossier est affiché sur la page Audacité.</p>
		<p>&nbsp;</p>
		<p>Les accents et espaces sont autorisés.</p>
		<p>&nbsp;</p>
		<p>types de fichiers autorisés : pdf, excel (.xls, .xlsx), powerpoint (.ppt, .pptx), word (.docx)</p>
	</div>
	<div id="elfinder"></div>
  </div> <!-- #contenu -->
  <hr class="separation" />
</div> <!-- #conteneur -->
<div id="divAjax"></div>
<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui/jquery-ui.min.js" ></script>
<script type="text/javascript" src="js/elfinder/js/elfinder.min.js"></script>
<script type="text/javascript" src="js/elfinder/js/i18n/elfinder.fr.js"></script>
<script src="js/ajax-jquery-plugin.js"></script>
<script src="js/uniform/jquery.uniform.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main-admin.js"></script>
<script type="text/javascript" charset="utf-8">
	$().ready(function() {
		var elf = $('#elfinder').elfinder({
			url : 'js/elfinder/php/connector_audacite.php',  // connector URL (REQUIRED)
			lang : 'fr',
			commands : [
				'upload', 'open', 'reload', 'rm', 'download', 'info', 'rename', 'mkdir', 'sort', 'cut', 'paste'
			]
		}).elfinder('instance');
		
		/*
		open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook', 
	'download', 'rm', 'duplicate', 'rename', 'mkdir', 'mkfile', 'upload', 'copy', 
	'cut', 'paste', 'edit', 'extract', 'archive', 'search', 'info', 'view', 'help',
	'resize', 'sort'
	*/		
	});
</script>
</body>
</html>
<?php } ?>
