<?php 
@session_start(); 
include_once('../class/form.php'); 
include_once('../../class/mysql.php'); 
include_once('../class/utils.php'); 
$qry = "SET NAMES 'utf8'"; 
$db = new MySQL(); 
$db->Open(); 
$db->query($qry); 
$qry = "SELECT titre FROM actualites WHERE ID = '" . $_GET['ID'] . "' LIMIT 1"; 
$db = new MySQL(); 
$db->Open(); 
$db->query($qry); 
$row = $db->Row(); 
$titre = $row->titre; 
$form = new form('formSupprActualites'); 
$form->setAction($_SESSION['adressePage'], false); 
$form->addInput('hidden', 'actualitesID', $_GET['ID']); 
$form->startFieldset('Supprimer une actualité'); 
$form->html .= '<p class="alerte">Supprimer l\'actualité "' . $titre . '" ?</p>'; 
$form->html .= '<p>&nbsp;</p>'; 
$form->addRadioBtn('supprimerActualites', 'oui', 1); 
$form->addRadioBtn('supprimerActualites', 'non', 0); 
$form->PrintRadioGroup('supprimerActualites', '&ecirc;tes-vous s&ucirc;r ? '); 
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