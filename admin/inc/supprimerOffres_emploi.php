<?php 
@session_start(); 
include_once('../class/form.php'); 
include_once('../../class/mysql.php'); 
include_once('../class/utils.php'); 
$qry = "SET NAMES 'utf8'"; 
$db = new MySQL(); 
$db->Open(); 
$db->query($qry); 
$qry = "SELECT titre FROM offres_emploi WHERE ID = '" . $_GET['ID'] . "' LIMIT 1"; 
$db = new MySQL(); 
$db->Open(); 
$db->query($qry); 
$row = $db->Row(); 
$titre = $row->titre; 
$form = new form('formSupprOffres_emploi'); 
$form->setAction($_SESSION['adressePage'], false); 
$form->addInput('hidden', 'offres_emploiID', $_GET['ID']); 
$form->startFieldset('Supprimer une offre d\'emploi'); 
$form->html .= '<p class="alerte">Supprimer l\'offre d\'emploi "' . $titre . '" ?</p>'; 
$form->html .= '<p>&nbsp;</p>'; 
$form->addRadioBtn('supprimerOffres_emploi', 'oui', 1); 
$form->addRadioBtn('supprimerOffres_emploi', 'non', 0); 
$form->PrintRadioGroup('supprimerOffres_emploi', '&ecirc;tes-vous s&ucirc;r ? '); 
$form->addSubmit('valider', 'btn-green'); 
$form->addBtnAnnuler('annuler', 'btn-orange', 'onClick="fermer(\'divAjax\');"'); 
$form->endFieldset(); 
$form->afficher(); 
?> 

<script type="text/javascript">
var js = function(divAjax) { 
	$(divAjax).find('form').sizeLabels(); 
	$(divAjax).find('select, input[type="checkbox"], input[type="radio"]').uniform(); 
};
</script>