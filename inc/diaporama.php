<?php
if(preg_match('`aed|sais|itep|mecs`', $_GET['repertoire'])) {
	include_once('../class/diaporama.php');
	$diaporama = new diaporama($_GET['repertoire']);
	$diaporama->afficher();
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		if($('.rslides')[0]) {
			$(".rslides").responsiveSlides({
				pager: false,
				nav: true,
				speed: 800,
				maxwidth: 300,
        		namespace: "large-btns"
			});
		}
	});
</script>