<?php
$fichier = addslashes($_GET['fichier']);
$fichier = str_replace('.', '-fichier.', $fichier);
$repertoire = '../../../uploads/';
@chmod($repertoire . $fichier, '0755');
if(is_file($repertoire . $fichier)) {
	if(unlink($repertoire . $fichier)) $retour = 'fichier supprimé' . "\n";
	else $retour = 'echec de la suppression ' . "\n";
}
else $retour = 'fichier non trouvé' . "\n";
echo utf8_encode($retour);