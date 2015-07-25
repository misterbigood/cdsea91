<?php @session_start();
if($_SERVER['SERVER_NAME'] == 'localhost') {
	$url = 'http://localhost/cdsea/';
}
else {
	$url = 'http://www.cdsea91.fr';
}
$reindex = 1;
$maxlevel = -1;
$soption = 'full';
$in = '';
$out = '';
$domaincb = 0;
$_SESSION['admin'] = 'migli';
$_SESSION['admin_pw'] = 'migliori1';
error_reporting(E_STRICT);
echo '<div id="spider">' . " \n";
include_once('../../sphider/admin/spider.php');
//index_site($url, $reindex, $maxlevel, $soption, $in, $out, $domaincb); (appelé directement par spider.php)
echo '</div>' . " \n";
?>