<?php 
include_once('../../class/mysql.php');
preg_match('`([a-z0-9]+)-([a-zA-Z0-9_-]+)-([0-9]+)`', $_POST['id'], $out);
$table = $out[1];
$champ = $out[2];
$ID = $out[3];
$nouvelleValeur = $_POST['value'];
$qry = "SET NAMES 'utf8'";
$db = new MySQL();
$db->Open();
$db->query($qry);
$filter["ID"] = MySQL::SQLValue($ID);  
$update[$champ] = MySQL::SQLValue($nouvelleValeur);
$db = new MySQL();
$db->UpdateRows($table, $update, $filter);
if($champ == 'actif') {
	if($nouvelleValeur > 0) $img = 'actif.png';
	else $img = 'inactif.png';
	echo '<img src="images/' . $img . '">';
}
else echo $nouvelleValeur;
?>