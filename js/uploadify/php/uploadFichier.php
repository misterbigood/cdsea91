<?php 
include_once('../../../class/utils.php');
$session_name = session_name();
if (!isset($_POST[$session_name])) {
	$upload_max_filesize = ini_get("upload_max_filesize");
	$memory_limit = ini_get("memory_limit");
	$post_max_size = ini_get("post_max_size");
	$txtConfigPhp = 'upload_max_filesize : ' . $upload_max_filesize . " \n";
	$txtConfigPhp .= 'post_max_size : ' . $post_max_size . " \n";
	$txtConfigPhp .= 'memory_limit : ' . $memory_limit . " \n";
    $log = fopen('script.log', 'a');
	fputs($log, '============ ' . date('d-m-Y H:i') . " ============\n\n");
	fputs($log, "Erreur de session \n" . $$txtConfigPhp);
	
	fclose($log);
	//var_dump($_POST);
} else {
    session_id($_POST[$session_name]);
    session_start();
}
$verifyToken = md5('unique_salt' . $_POST['timestamp']);
$result = array();
$result['error'] = '';
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
	
	/* NOTE : les répertoires doivent déjà exister, on ne peut pas les créer ici (sinon, bug chmod) */
	
	$fichierDir = '../../../uploads/';
		
	if(isset($_FILES['Filedata'])) { // SI IL Y A UN FICHIER
	
		if(!empty($_FILES['Filedata']['error'])) {
			$result['filedataError'] = 	$_FILES['Filedata']['error'];
			$result['error'] .= "impossible de télécharger le fichier \n";
		}
		else {
		
			/*______ Validation ______ */
			
			$nomFichier = $_FILES['Filedata']['name'];
			$ext = pathinfo($nomFichier, PATHINFO_EXTENSION);
			
			//if($ext != 'jpg') { //  && $ext != 'avi'
			if($ext != 'jpg' && $ext !='jpeg' && $ext !='gif' && $ext !='png' && $ext !='doc' && $ext !='docx' && $ext !='txt' && $ext !='pdf') {
				$result['error'] .= "fichier invalide \n";
			}
			else {
				/*ini_set("memory_limit",'500M');
				if(!ini_get('safe_mode')) { // Safe Mode non-activé, on met la limite de temps d'execution à 5'.
					set_time_limit(5000);
				}*/
				$name_file = utils::formaterNom($nomFichier); // transforme le nom du fichier en nom valide
				
				/*============================== 
				
				Par sécurité, on ajoute '-fichier' avant l'extension : l'utilisateur ne connaîtra pas le chemin du fichier uploadé. 

				============================== */
				
				$name_file = str_replace('.', '-fichier.', $name_file);
				$tmp_file = $_FILES['Filedata']['tmp_name'];
				$type_file = $_FILES['Filedata']['type'];
					
				if(!is_dir($fichierDir)) {
					@chmod($fichierDir, '0775');
					if(!mkdir($fichierDir)) {
						$pb = true;
						$result['error'] .= "Impossible de créer le répertoire $fichierDir \n";	
					}
				}
	
				if(!move_uploaded_file($tmp_file, $fichierDir . $name_file) ) { // on copie le fichier dans le dossier de destination
					$pb = true;
					$result['error'] .= "Impossible de copier le fichier dans $fichierDir \n";
				}
				if(!isset($pb))  { // si pas de pb.
					if(chmod($fichierDir.$name_file, 0775)) {
						$result['log'] = "Fichier ".$fichierDir.$name_file." copié \n";
					}
					else {
						$pb = true;
						$result['error'] .= "Un problème d'autorisation est survenu lors du déplacement du fichier \n";
					}
				}
			}
		}	
	}
	else {
		$result['error'] .= 'impossible de télécharger le fichier';	
	}
} /* if ($_POST['token'] == $verifyToken) */
else { // invalid token
	$result['addr'] = substr_replace(gethostbyaddr($_SERVER['REMOTE_ADDR']), '******', 0, 6);
	$result['agent'] = $_SERVER['HTTP_USER_AGENT'];
	$result['token'] = 'INVALID TOKEN';
	$result['error'] .= "erreur d\'identification (INVALID TOKEN) \n";
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
	$retour['display'] = utf8_encode($result['error']);
	$retour['nomFichier'] = '';
}
else {
	$retour['error'] = '';
	$retour['display'] = utf8_encode('Votre fichier a bien été téléchargé.');
	$retour['nomFichier'] = utf8_encode($name_file);
}
$retour['logRetour'] = utf8_encode($retour['logRetour']);
$log = @fopen('script.log', 'a');
fputs($log, '============ ' . date('d-m-Y H:i') . " ============\n\n");
fputs($log, $retour['logRetour']);	
fputs($log, json_encode($retour));
fclose($log);
echo json_encode($retour);

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