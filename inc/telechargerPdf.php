<?php
if(!isset($_GET['pdf'])) {
	header("Location: http://www.cdsea91.fr");
}
else {
	header("Content-type: application/pdf");
	header("Content-Disposition: attachment; filename=$_GET[pdf]");
	readfile('../' . $_GET['pdf']);
}
?>