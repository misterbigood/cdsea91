<?php @session_start();
include_once('../class/form.php');
include_once('../../class/mysql.php');
include_once('../class/utils.php');
$form = new form('formAjoutOffres_emploi');
$form->setAction($_SESSION['adressePage'], false);

if(isset($_GET['alerteMsg'])) { // l'alerte est envoyée en GET
    $form->alerteMsg[] = $_GET['alerteMsg'];
    $form->alerteChamp[] = $_GET['alerteChamp'];
}
else {
    $_SESSION['date_publication'] = '';
    $_SESSION['association'] = '';
    $_SESSION['service'] = '';
    $_SESSION['autre_service'] = '';
    $_SESSION['lieu_travail'] = '';
    $_SESSION['intitule_poste'] = '';
    $_SESSION['type_contrat'] = '';
    $_SESSION['statut'] = '';
    $_SESSION['etp'] = '';
    $_SESSION['prise_fonction'] = '';
    $_SESSION['profil'] = '';
    $_SESSION['date_limite'] = '';
    $_SESSION['contact'] = '';
    $_SESSION['actif'] = 1;
    
}
$form->startFieldset('Ajouter une offre d\'emploi');

$form->addInput('text', 'date_publication', '', 'Date de publication :', 'size=60, id=\'date_publication\'');

$form->addOption('association', 'cdsea91', 'CDSEA Essonne');
$form->addOption('association', 'adsea93', 'ADSEA Seine Saint-Denis');
$form->addOption('association', 'adsea75', 'ADSEA Paris');
$form->addOption('association', 'adsea95', 'ADSEA Val d\'Oise');
$form->addSelect('association', 'Association : ');

$form->addOption('service', 'saemf', 'SAEMF');
$form->addOption('service', 'sais', 'SAIS');
$form->addOption('service', 'itep', 'ITEP');
$form->addOption('service', 'mecs', 'MECS');
$form->addOption('service', 'autre', 'Autre');
$form->addSelect('service', 'Service : ');
$form->addInput('text', 'autre_service', '', 'Autre service :', 'size=60');
 
$form->addInput('text', 'lieu_travail', '', 'Lieu de travail :', 'size=60');
    
$form->addInput('text', 'intitule_poste', '', 'Intitulé du poste : ', 'size=60, required=required');

$form->addInput('text', 'type_contrat', '', 'Type de contrat : ', 'size=60');

$form->addInput('text', 'statut', '', 'Statut : ', 'size=60');

$form->addInput('text', 'etp', '', 'ETP : ', 'size=60');
    
$form->addInput('text', 'prise_fonction', '', 'Prise de fonction : ', 'size=60');
    
$form->addTextarea('profil', '', 'Profil : ', 'cols=100, rows=8');

$form->addInput('text', 'date_limite', '', 'Date limite de dépôt des candidatures :', 'size=60, id=\'date_limite\'');

$form->addTextarea('contact', '', 'Contact : ', 'cols=100, rows=8');

$form->addRadioBtn('actif', 'oui', 1);
$form->addRadioBtn('actif', 'non', 0);
$form->PrintRadioGroup('actif', 'actif : ');

$form->addSubmit('<span class="icon icon-checkmark"></span>valider', 'btn-green');
$form->addBtnAnnuler('<span class="icon icon-cancel"></span>annuler', 'btn-orange', 'onClick="fermer(\'divAjax\');"');
$form->endFieldset();
$form->afficher();
?>
<script type="text/javascript">
var js = function(divAjax) {
	$(divAjax).find('form').sizeLabels();
	$(divAjax).find('select, input[type="checkbox"], input[type="radio"]').uniform();
	$(".info a").tooltip();
        $(document).ready(function() {
            $('#date_publication').datepicker();
            $('#date_limite').datepicker();
        });
};
</script>