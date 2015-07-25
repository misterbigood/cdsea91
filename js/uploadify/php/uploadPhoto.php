<?php //include("../../../AP/adminpro_class.php"); $prot=new protect(); if ($prot->showPage) { 
// include_once('../../../class/client.php');
$session_name = session_name();
if (!isset($_POST[$session_name])) {
    exit;
} else {
    session_id($_POST[$session_name]);
    session_start();
}
$verifyToken = md5('unique_salt' . $_POST['timestamp']);
//$client = $_SESSION['client'];
//if($client->verifierIdentite() == true) {
	$result = array();
	if (count($_GET)) {
		$result['get'] = $_GET;
	}
	if (count($_POST)) {
		$result['post'] = $_POST;
	}
	if (count($_FILES)) {
		$result['files'] = $_FILES;
	}
	if (file_exists('script.log') && filesize('script.log') > 102400) {
		unlink('script.log');
	}
	if ($_POST['token'] == $verifyToken) {
		include_once('ajoutPhotoClass.php');
		include_once('../../../class/mysql.php');
		
		/*______ AJOUT PHOTO ______ */
		
		$prefixePhoto = '';
		$prefixeVignette = '';
		
		/* NOTE : les répertoires doivent déjà exister, on ne peut pas les créer ici (sinon, bug chmod) */
		
		$vignetteDir = '../../../uploads/';
		$vignetteLargeurMax = 120;
		$vignetteHauteurMax = 80;
		$photoDir = '../../../uploads/zoom/';
		$photoLargeurMax = 600;
		$photoHauteurMax = 600;
			
		if(isset($_FILES['Filedata'])) { // SI IL Y A UNE PHOTO
		
			if(!empty($_FILES['Filedata']['error'])) {
				$result['filedataError'] = 	$_FILES['Filedata']['error'];
				$result['error'] = 'impossible de télécharger l\'image';
			}
			else {
			
				/*______ Validation ______ */
				
				$nomFichier = $_FILES['Filedata']['name'];
				$result['error'] = ajoutPhoto::verifierPhoto('Filedata', 2); // 2 = sizeMax 2Mb. renvoie false si pas d'erreur.
				$result['nomFichier'] = ajoutPhoto::formaterNom($nomFichier);
				if(empty($result['error'])) {
					ajoutPhoto::init(); // memoire + time limit
					$name_filephoto = ajoutPhoto::formaterNom($nomFichier); // transforme le nom du fichier en nom valide
					//$name_filephoto = ajoutPhoto::verifierSiExisteDeja('', $name_filephoto, "SELECT COUNT(photo1) FROM objets"); // $prefixePhoto, $name_filephoto, $requete (le WHERE est ajouté après)
					$_SESSION['photoUploadee'] = $name_filephoto;	
					$tmp_file = $_FILES['Filedata']['tmp_name'];
					$type_file = $_FILES['Filedata']['type'];
					
					$result['copyPhoto'] = ajoutPhoto::copyPhoto($tmp_file, $type_file, $name_filephoto, $photoDir);
					if($result['copyPhoto'] == true) { // SI LA PHOTO A ETE COPIEE
						$result['resize'] = ajoutPhoto::resizePhoto($name_filephoto, $photoDir, $photoLargeurMax, $photoHauteurMax, $prefixePhoto);
						$result['vignette'] = ajoutPhoto::creerVignette($name_filephoto, $photoDir, $vignetteDir, $vignetteLargeurMax, $vignetteHauteurMax, $prefixeVignette, '', '');		
					}
					else $result['error'] = 'erreur lors de la copie';
				}
			}	
		}
		else {
			$result['error'] = 'impossible de t&eacute;l&eacute;charger l\'image';	
		}
	} /* if ($_POST['token'] == $verifyToken) */
	else { // invalid token
		$result['addr'] = substr_replace(gethostbyaddr($_SERVER['REMOTE_ADDR']), '******', 0, 6);
		$result['agent'] = $_SERVER['HTTP_USER_AGENT'];
		$result['token'] = 'INVALID TOKEN';
		$result['error'] = 'erreur d\'identification (INVALID TOKEN)';
	}
	
	/*____________ RETOUR _________________*/
	
	$retour['logRetour'] = '';
	foreach($result as $var => $valeur) {
		if(!empty($valeur)) {
			$retour['logRetour'] .= $var . ' : ';
			$retour['logRetour'] .= returnArray($valeur, "\t");
		}
	}
	if(!empty($result['error'])) {
		$retour['error'] = utf8_encode($result['error']);
		$retour['display'] = '';
		$retour['nomFichier'] = '';
	}
	else {
		$retour['error'] = '';
		$retour['display'] = utf8_encode('<img src="uploads/' . $result['nomFichier'] . '" alt="' . $result['nomFichier'] . '">');
		$retour['nomFichier'] = utf8_encode($result['nomFichier']);
	}
	$log = @fopen('script.log', 'a');
	fputs($log, '============ ' . date('d-m-Y H:i') . " ============\n\n");
	fputs($log, utf8_encode($retour['logRetour']));	
	fclose($log);
	$retour['logRetour'] = utf8_encode($retour['logRetour']);
	echo json_encode($retour);
//} /* if($client->verifierIdentite() == true) */
// } /* if ($prot->showPage) */

function returnArray($valeur, $tabulation)
{
	if(is_array($valeur)) {
		$retourArray =  "\n";
		foreach($valeur as $var => $valeur) {
			$retourArray .= $tabulation . $var . ' : ' . returnArray($valeur, $tabulation . "\t") . "\n";	
		}
		$retourArray .= "\n";
	}
	else $retourArray = $valeur . "\n";
	return $retourArray;
}
?>