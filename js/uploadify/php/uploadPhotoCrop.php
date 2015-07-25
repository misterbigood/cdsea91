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
		
		$photo_dir = '../../../images/articles/diaporama/';
		$photo_largeur_fixe = 817;
		$photo_hauteur_fixe = 240;
		$photo_hauteur_max = 1000;
			
		if(isset($_FILES['Filedata'])) { // SI IL Y A UNE PHOTO
		
			if(!empty($_FILES['Filedata']['error'])) {
				$result['filedataError'] = 	$_FILES['Filedata']['error'];
				$result['error'] = 'impossible de télécharger l\'image';
			}
			else {
			
				/*______ Validation ______ */
				
				$nomFichier = $_FILES['Filedata']['name'];
				$result['error'] = ajoutPhoto::verifierPhoto('Filedata', 2); // 2 = sizeMax 2Mb. renvoie false si pas d'erreur.
				
				/* on vérifie que la photo fasse bien 817px mini de large */
				
				$size = @ getimagesize($_FILES['Filedata']['tmp_name']);
				$largeur_src = $size[0];
				
				if($largeur_src < $photo_largeur_fixe) {
					$result['error'] = 'La photo doit avoir une largeur minimum de 817px';
				}
				
				$result['nomFichier'] = ajoutPhoto::formaterNom($nomFichier);
				if(empty($result['error'])) {
					ajoutPhoto::init(); // memoire + time limit
					$name_filephoto = ajoutPhoto::formaterNom($nomFichier); // transforme le nom du fichier en nom valide
					$_SESSION['photoUploadee'] = $name_filephoto;	
					$tmp_file = $_FILES['Filedata']['tmp_name'];
					$type_file = $_FILES['Filedata']['type'];
					
					$result['copyPhoto'] = ajoutPhoto::copyPhoto($tmp_file, $type_file, $name_filephoto, $photo_dir);
					if($result['copyPhoto'] == true) { // SI LA PHOTO A ETE COPIEE
						$result['resize'] = ajoutPhoto::resizePhoto($name_filephoto, $photo_dir, $photo_largeur_fixe, $photo_hauteur_max, $prefixePhoto, '', 'largeurFixe');
						$result['photo_diaporama'] = ajoutPhoto::crop($name_filephoto, $photo_dir, $photo_dir, $photo_largeur_fixe, $photo_hauteur_fixe, $prefixeVignette);
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
		$retour['display'] = utf8_encode('<img src="images/articles/diaporama/' . $result['nomFichier'] . '" alt="' . $result['nomFichier'] . '">');
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