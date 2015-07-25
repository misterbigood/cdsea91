<?php @session_start();
include_once('../class/form.php');
include_once('../../class/mysql.php');
include_once('../class/utils.php');
$form = new form('formAjoutActualites');
$form->setAction($_SESSION['adressePage'], false);
if(isset($_GET['alerteMsg'])) { // l'alerte est envoyée en GET
    $form->alerteMsg[] = $_GET['alerteMsg'];
    $form->alerteChamp[] = $_GET['alerteChamp'];
}
else {
    $_SESSION['titre'] = '';
    $_SESSION['rubrique'] = '';
    $_SESSION['intro'] = '';
    $_SESSION['html'] = '';
    $_SESSION['video'] = '';
    $_SESSION['date_publication'] = '';
    $_SESSION['actif'] = 1;
}
$form->startFieldset('Ajouter une actualité');
$form->addInput('text', 'titre', '', 'titre : ', 'size=60, required=required');
$form->addOption('rubrique', 'cdsea', 'CDSEA');
$form->addOption('rubrique', 'aed', 'AED');
$form->addOption('rubrique', 'sais', 'SAIS');
$form->addOption('rubrique', 'itep', 'ITEP');
$form->addOption('rubrique', 'mecs', 'MECS');
$form->addSelect('rubrique', 'rubrique : ');
$form->addTextarea('intro', '', 'intro : <span class="info"><a href="#" title="Court texte d\'introduction affiché en page d\'accueil, 150 caractères maximum" class="tooltipLien">?</a></span>', 'cols=64, rows=8, id=textareaIntro');
$form->html .= '<div class="infoTop width-80"><p>Utilisez les Formats pour créer vos titres, paragraphes et liste selon le design du site.</p><p>Pour insérer une image "flottante" ( = avec du texte à côté) : </p><ol><li>appuyez sur la touche "entrée"</li><li>remontez le curseur</li><li>insérez votre image</li><li>sélectionnez l\'image puis menu "format", image flottante à [gauche | droite]</li><li>replacez votre curseur pour écrire à côté de l\'image</li></ol><p>&nbsp;</p><p>Pour aller à la ligne sans changer de paragraphe, utilisez :<br> [ctrl] + [entree] <br>ou sous mac : [pomme] + [entree]</p></div>' . " \n";
$form->addTextarea('html', '', 'texte complet : ', 'cols=100, rows=20, id=tinyMceHtml, class=tinyMce');
$form->addInput('text', 'video', '', 'Attacher une vidéo (nom de fichier.flv)', 'size=100, id=\'video\'');
$form->addInput('text', 'date_publication', '', 'Date de publication :', 'size=60, id=\'date_publication\'');
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
	$('#textareaIntro').compteurMotsCaracteres(200);
	$(".info a").tooltip();
        $(document).ready(function() {
            $('#date_publication').datepicker();
        });
    $('.tinyMce').tinymce({
		/* CONFIGURER tinymce/plugins/image/config.php */
		script_url : 'js/tinymce/tinymce.min.js',
		<?php if($_SERVER['SERVER_NAME'] == 'localhost') { ?>
		document_base_url: "http://localhost/cdsea/",
		<?php } else { ?>
		document_base_url: "http://www.cdsea91.fr/",
		<?php } ?>
		relative_urls: false,
		theme: "modern",
		language: 'fr_FR',
		element_format: "html",
		menubar: "edit view insert table tools",
		content_css: "admin/js/tinymce/site-styles.css",
		style_formats: [
			{title: 'Titre 1', block: 'h1'},
			{title: 'Titre 2', block: 'h2'},
			{title: 'Paragraphe', block: 'p'},
			{title: 'Image flottante à droite', block: 'figure', classes: 'image-right'},
			{title: 'Image flottante à gauche', block: 'figure', classes: 'image-left'},
			{title: 'Cadre à droite', block: 'aside', classes: 'cadre right'},
		],
		plugins: [
			"advlist autolink autoresize charmap code contextmenu fullscreen image link lists paste preview table visualblocks textcolor"
		],
		contextmenu: "link image inserttable | cell row column deletetable",
		toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image preview",
		image_advtab: true
	});
};
</script>