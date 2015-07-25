<?php include("../../../admin/AP/adminpro_class.php"); $prot=new protect(); if ($prot->showPage) { 
// include_once('../../../class/client.php');
@session_start();
//$client = $_SESSION['client'];
//if($client->verifierIdentite() == true) {
	$photo = addslashes($_GET['photo']);
	$repertoire1 = '../../../' . addslashes($_GET['repertoire1']);
	@chmod($repertoire1 . $photo, '0755');
	if(is_file($repertoire1 . $photo)) {
		if(unlink($repertoire1 . $photo)) $retour = 'photo ' . $repertoire1 . $photo . ' supprimée' . "\n";
		else $retour = 'echec de la suppression photo ' . $repertoire1 . $photo . "\n";
		if(isset($_GET['repertoire2'])) {
			$repertoire2 = '../../../' . addslashes($_GET['repertoire2']);
			@chmod($repertoire2 . $photo, '0755');
			if(unlink($repertoire2 . $photo)) $retour .= 'photo ' . $repertoire2 . $photo . ' supprimée' . "\n";
			else $retour .= 'echec de la suppression photo ' . $repertoire1 . $photo . "\n";
		}
	}
	else $retour = 'photo ' . $repertoire1 . $photo . ' non trouvée' . "\n";
	echo utf8_encode($retour);
//} /* if($client->verifierIdentite() == true) */
} /* if ($prot->showPage) */
?>