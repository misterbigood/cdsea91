<?php
	$page = 'cdsea-recherche';
	include_once('class/menu.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Comité départemental de sauvegarde de l'enfant à l'adulte de l'Essonne - Recherche</title>
        <meta name="description" content="Recherche sur le site du Comité départemental de sauvegarde de l'enfant à l'adulte de l'Essonne">
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
		<link href="sphider/include/js_suggest/SuggestFramework.css" rel="stylesheet" type="text/css">
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
				<section id="contenu" class="units-row cdsea recherche">
					<h1>Rechercher sur le site CDSEA</h1>
					<?php
/*******************************************
* Sphider Version 1.3.x
* This program is licensed under the GNU GPL.
* By Ando Saabas          ando(a t)cs.ioc.ee
********************************************/
//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
//error_reporting(E_ALL);
$include_dir = "sphider/include";
include ("$include_dir/commonfuncs.php");
//extract(getHttpVars());

if (isset($_GET['query']))
	$query = $_GET['query'];
if (isset($_GET['search']))
	$search = $_GET['search'];
if (isset($_GET['domain']))
	$domain = $_GET['domain'];
if (isset($_GET['type']))
	$type = $_GET['type'];
if (isset($_GET['catid']))
	$catid = $_GET['catid'];
if (isset($_GET['category']))
	$category = $_GET['category'];
if (isset($_GET['results']))
	$results = $_GET['results'];
if (isset($_GET['start']))
	$start = $_GET['start'];
if (isset($_GET['adv']))
	$adv = $_GET['adv'];

$include_dir = "sphider/include";
$template_dir = "sphider/templates";
$settings_dir = "sphider/settings";
$language_dir = "sphider/languages";


require_once("$settings_dir/database.php");
require_once("$language_dir/en-language.php");
require_once("$include_dir/searchfuncs.php");
require_once("$include_dir/categoryfuncs.php");

include "$settings_dir/conf.php";

//include "$template_dir/$template/header.html";
include "$language_dir/$language-language.php";

if ($type != "or" && $type != "and" && $type != "phrase") {
	$type = "and";
}
if (preg_match("/[^a-z0-9-.]+/", $domain)) {
	$domain="";
}
if ($results != "") {
	$results_per_page = $results;
}
if (get_magic_quotes_gpc()==1) {
	$query = stripslashes($query);
}
if (!is_numeric($catid)) {
	$catid = "";
}
if (!is_numeric($category)) {
	$category = "";
}
if ($catid && is_numeric($catid)) {
	$tpl_['category'] = sql_fetch_all('SELECT category FROM '.$mysql_table_prefix.'categories WHERE category_id='.(int)$_REQUEST['catid']);
}

$count_level0 = sql_fetch_all('SELECT count(*) FROM '.$mysql_table_prefix.'categories WHERE parent_num=0');
$has_categories = 0;

if ($count_level0) {
	$has_categories = $count_level0[0][0];
}

require_once("$template_dir/$template/search_form.html");

function getmicrotime()
{
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
}
function poweredby ()
{
	//global $sph_messages;
    //If you want to remove this, please donate to the project at http://www.sphider.eu/donate.php
    // c'est fait, j'ai donné 10 € !
}
function saveToLog ($query, $elapsed, $results)
{
        global $mysql_table_prefix;
    if ($results =="") {
        $results = 0;
    }
	$qry = "SET NAMES 'utf8'";
	mysql_query($qry);
    $query =  "insert into ".$mysql_table_prefix."query_log (query, time, elapsed, results) values ('$query', now(), '$elapsed', '$results')";
	mysql_query($query);
	echo mysql_error();
}

switch ($search) {
	case 1:
		if (!isset($results)) {
			$results = "";
		}
		$search_results = get_search_results($query, $start, $category, $type, $results, $domain);
		require("$template_dir/$template/search_results.html");
	break;
	default:
		if ($show_categories) {
			if ($_REQUEST['catid']  && is_numeric($catid)) {
				$cat_info = get_category_info($catid);
			} else {
				$cat_info = get_categories_view();
			}
			require("$template_dir/$template/categories.html");
		}
	break;
	}

//include "$template_dir/$template/footer.html";
?>
					</section> <!-- #contenu -->
			 </div><!-- #conteneur -->
			<div id="spacer-footer"></div>
		</div> <!-- #footerWrapper -->
		<footer id="footer">
			<?php include_once('inc/footer.php'); ?>
		</footer>
		<script type="text/javascript" src="sphider/include/js_suggest/SuggestFramework.js"></script>
		<?php include_once('inc/js-includes.php'); ?>
		<script type="text/javascript">
		$(document).ready(function(){
			$('#query').on('focus', startSuggest);
		});
		function startSuggest() {
			initializeSuggestFramework();
			$('#query').off('focus');
		}
	</script>
    </body>
</html>