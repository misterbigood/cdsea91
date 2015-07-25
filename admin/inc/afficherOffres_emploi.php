<?php @session_start();
include_once('../../class/mysql.php');
include_once('../class/paginationAdmin.php');
include_once('../class/form.php');
include_once('../class/utils.php');
include_once('../class/offres_emploiAdmin.php');
$offres_emploi = new offres_emploi();
$offres_emploi->afficherTableauOffres_emploiAdmin();
?>
<script type="text/javascript"> 
var js = function(divAjax) {
	$('select, input[type="checkbox"], input[type="radio"]').uniform();
	<?php if(!empty($_SESSION['colonnesSurlignees'])) { ?> 
		var colonnesFiltrees = [<?php echo implode(', ', $_SESSION['colonnesSurlignees']); ?>]; // ne pas utiliser la fonction new Array(), qui ne fonctionnera pas s'il n'y a qu'un seul élément. 
		$('#tableauOffres_emploiAdmin').colorColumns(colonnesFiltrees, '#EFEFEF'); 
	<?php } ?> 
	if($('#nppSelect')[0]) {
		$('#nppSelect').on('change', function() {
			<?php $url = preg_replace('`(?|&)npp=[0-9]+`', '', $_SERVER['REQUEST_URI']); ?>
			$('#divaAtualites').ajax({'url' : '<?php echo $url; ?>', 'vars': 'npp=' + $(this).val()}); /* adapter $('#divClients') au fichier */
			$('select, input[type="checkbox"], input[type="radio"]').uniform();	
		});
		
	}
}; 
</script> 