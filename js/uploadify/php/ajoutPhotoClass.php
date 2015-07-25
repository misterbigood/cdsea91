<?php 
class ajoutPhoto
{
    
    function init()
    {    //ini_set("memory_limit",'500M');//AUGMENTE LA MEMOIRE DISPONIBLE ET EVITE L'ERREUR "Fatal error: Allowed memory size"

        /*if(!ini_get('safe_mode')) { // Safe Mode non-activé, on met la limite de temps d'execution à 2'.
        
            set_time_limit(2000);
        }*/
    }
    
    function verifierPhoto($photo, $sizeMax)
    {
        $error = '';
        if (!isset($_FILES[$photo]) || ! is_uploaded_file($_FILES[$photo]['tmp_name'])) {
            $error = 'Upload invalide';
        }
        if (!$error && $_FILES[$photo]['size']>$sizeMax*1024*1024) {
            $error = 'SVP la photo ne doit pas dépasser ' . $sizeMax . 'Mb';
        }
        if (!$error && !($size = @ getimagesize($_FILES['Filedata']['tmp_name']) ) ) {
            $error = 'Le fichier doit être une photo. Format non reconnu';
        }
        if (!$error && ! in_array($size[2], array(1, 2, 3, 7, 8) ) ) {
            $error = 'La photo doit être au format JPEG, GIF ou PNG.';
        }

        /*if (!$error && ($size[0] < 25) || ($size[1] < 25))
        {
            $error = 'Please upload an image bigger than 25px.';
        }*/
        return $error;
    }
    
    function formaterNom($nomFichier) // pour les fichiers, conserve le point de l'extension 
	{ /* si modif, appliquer les mêmes dans js/uploadify/php/ajoutPhotoClass/formaterNom() */
        $ancienNom = trim($nomFichier);
        $charset = 'utf-8';
        $nouveauNom = htmlentities($ancienNom, ENT_NOQUOTES, $charset);
        $nouveauNom = preg_replace('#\&([A-za-z])(?:acute|cedil|circ|grave|ring|tilde|uml)\;#', '\1', $nouveauNom);
        $nouveauNom = preg_replace('#\&([A-za-z]{2})(?:lig)\;#', '\1', $nouveauNom);    // pour les ligatures e.g. '&oelig;'
        $nouveauNom = preg_replace('#\&[^;]+\;#', '', $nouveauNom);    // supprime les autres caractères
        $nouveauNom = preg_replace('`[ &~"#{( \'\[|\\^@)\]=}$¤*µ%,;:!?/§]+`', '-', $nouveauNom);
		while(preg_match('`--`', $nouveauNom)) {
			$nouveauNom = preg_replace('`--`', '-', $nouveauNom);	
		}
		$nouveauNom = strtolower($nouveauNom);
        return $nouveauNom;
    }
    
    function verifierSiExisteDeja($prefixePhoto, $name_filephoto, $requete)
    {    // VERIFICATION DU NOM DU FICHIER  : S'IL EXISTE DEJA, ON RENOMME EN FICHIER-X
        $photo = MySQL:: SQLValue($prefixePhoto . $name_filephoto, "text");
        $qry = $requete . "WHERE photo LIKE $photo";
        $db = new MySQL();
        $db->Open();
        if (!$db->query($qry)) {
            $log = @ fopen('script.log', 'a');
            if ($log) {
                if(isset($error)) {
                    fputs($log, 'echec verifierSiExisteDeja ; $qry = ' . $qry . "\n"); fclose($log);
                }
            }
        }
        else {
            $existe = $db->Seek(0);
            if($existe[0]>0) {
                $i = 0;
                $pos = strpos($name_filephoto, '.');
                $photoname = substr($name_filephoto, 0, $pos);
                $photoExtension = strstr($name_filephoto, '.');
                do {
                    $i++;
                    $photo = MySQL:: SQLValue($prefixePhoto . $photoname . '-' . $i . $photoExtension, "text");
                    $qry = $requete . "WHERE photo LIKE $photo";
                    $db = new MySQL();
                    $db->Open();
                    $db->query($qry);
                    $existe = $db->Seek(0);
                }
                while($existe[0]>0);
                $name_filephoto = $prefixePhoto . $photoname . '-' . $i . $photoExtension;
                $photo = MySQL:: SQLValue($name_filephoto, "text");
            }
        }
        return $name_filephoto;
    }
    
    function copyPhoto($tmp_file, $type_file, $name_filephoto, $photoDir)
    {
        $pb = false;
        if(! is_dir($photoDir)) {
            $pb = true;
            $result = "Le répertoire '" . $photoDir . "' est introuvable \n";
        }
        else if(!isset($tmp_file) ) {
            $pb = true;
            $result = "Le fichier est introuvable</p> \n";
        }    // on vérifie maintenant l'extension
        else if (!($size = @getimagesize($tmp_file) ) ) {
            $pb = true;
            $result = 'Le fichier n\'est pas une image' . " \n ";
        }    // on copie le fichier dans le dossier de destination
        else if(!move_uploaded_file($tmp_file, $photoDir . $name_filephoto) ) {
            $pb = true;
            $result = "Impossible de copier le fichier dans $photoDir \n";
        }
        if(!$pb) {    // si pas de pb.
            if( chmod($photoDir . $name_filephoto, 0775)) {
                $result = "Photo " . $photoDir . $name_filephoto . " copiée \n";
            }
            else {
                $pb = true;
                $result = "Un problème d'autorisation est survenu lors du déplacement de la photo \n";
            }
        }
        if($pb)
        return $result;
        else
        return true;
    }    // ON REDIMENSIONNE LA PHOTO

    /***************************************/

    /*    CREATION DE PHOTO           */

    /*-------------------------------------*/

    /* $image: Nom de l'image originale    */

    /* $photoLargeurMax : largeur max de la vignette */

    /* $photoHauteurMax : hauteur max de la vignette */

    /* $source: Chemin relatif du répertoire de l'image originale */

    /* $destination: Chemin relatif du répertoire de l'image réduite */

    /* $prefixePhoto : Prefixe de la photo  */

    /**************************************/

    
    function resizePhoto($name_filephoto, $photoDir, $photoLargeurMax, $photoHauteurMax, $prefixePhoto, $hauteurFixe = '', $largeurFixe = '')
    {
        $image = $name_filephoto;
        $source = $photoDir;
        $destination = $photoDir;
        if (! file_exists($source . $image)) {
            $result = "<p>ERREUR - L'image$source.$imagen'existe pas</p> \n <hr /> \n";
        }    // On verifie que l'extention du fichier est bien une image jpg,jpeg ou gif
        $ext = strtolower( strrchr($image, '.'));
        if ($ext != ".jpg" AND $ext != ".jpeg" AND $ext != ".gif" AND $ext != ".png") {
            $result = "<p>ERREUR - Votre image doit être un jpg,jpeg, png ou gif </p><hr />";
        }
        else {
            $size = getimagesize($source . $image);
            $largeur_src = $size[0];
            $hauteur_src = $size[1];    //2ieme verification -> on verifie que le type du fichier est un jpg,jpeg, png ou gif    // $size[2] -> type de l'image : 1 = GIF , 2 = JPG,JPEG , 3 = PNG
            if ($size[2] != 1 AND $size[2] != 2 AND $size[2] != 3) {
                $result = "<p>ERREUR - Format non supporté</p><hr />";
            }
            else {
                if($size[2] == 1) {    // format gif
                    $image_src = imagecreatefromgif($source . $image);
                }
                if($size[2] == 2) {    // format jpg ou jpeg
                    $image_src = imagecreatefromjpeg($source . $image);
                }
                if($size[2] == 3) {    // format png
                    $image_src = imagecreatefrompng($source . $image);
                }
                $ratio = ajoutPhoto:: ratio($photoLargeurMax, $photoHauteurMax, $largeur_src, $hauteur_src, $hauteurFixe, $largeurFixe);
                if($ratio != 1) {    // si ratio != 1
                    $image_dest = imagecreatetruecolor( round($largeur_src*$ratio) , round($hauteur_src*$ratio)); imagecopyresampled($image_dest, $image_src, 0, 0, 0, 0, round($largeur_src*$ratio) , round($hauteur_src*$ratio) , $largeur_src, $hauteur_src); imagedestroy($image_src);
                    if(! imagejpeg($image_dest, $destination . $prefixePhoto . $image)) {
                        $result = "<p>ERREUR - le dimensionnement de la photo $image a échoué. Réessayez dans quelques minutes. Si le problème persiste, contactez le webmaster.<br />destination = " . $destination . $prefixePhoto . $image . "</p> \n <hr /> \n ";
                    }
                    else {
                        imagedestroy($image_dest); chmod($destination . $prefixePhoto . $image, 0775);
                        $result = "<p>Photo $image redimensionnée </p> \n";
                    }
                }
                else {    // si ratio = 1 chmod($destination . $prefixePhoto . $image, 0775);
                    $result = "<p>la photo est au format, elle n'a pas été redimensionnée.</p> \n <hr /> \n ";
                }
            }
        }
        return $result;
    }

    /***************************************/

    /*    CREATION DE VIGNETTE           */

    /*-------------------------------------*/

    /* $image: Nom de l'image originale    */

    /* $vignetteLargeurMax : largeur max de la vignette */

    /* $vignetteHauteurMax : hauteur max de la vignette */

    /* $source: Chemin relatif du répertoire de l'image originale */

    /* $destination: Chemin relatif du répertoire de l'image réduite */

    /* $prefixeVignette : Prefixe de la vignette  */

    /**************************************/

    
    function creerVignette($name_filephoto, $photoDir, $vignetteDir, $vignetteLargeurMax, $vignetteHauteurMax, $prefixeVignette, $hauteurFixe = '', $largeurFixe = '')
    {
        $image = $name_filephoto;
        $source = $photoDir;
        $destination = $vignetteDir;
        if (! file_exists($source . $image)) {
            $result = "<p>ERREUR - L'image$imagen'existe pas </p><hr /> \n";
        }
        else {    // On verifie que l'extention du fichier est bien une image jpg,jpeg ou gif
            $ext = strtolower( strrchr($image, '.'));
            if ($ext != ".jpg" AND $ext != ".jpeg" AND $ext != ".gif" AND $ext != ".png") {
                $result = '<p>ERREUR - Votre image doit être un jpg,jpeg, png ou gif. $ext = ' . $ext . "  </p> \n";
            }
            $size = getimagesize($source . $image);
            $largeur_src = $size[0];
            $hauteur_src = $size[1];    //2ieme verification -> on verifie que le type du fichier est un jpg,jpeg, png ou gif    // $size[2] -> type de l'image : 1 = GIF , 2 = JPG,JPEG , 3 = PNG
            if ($size[2] != 1 AND $size[2] != 2 AND $size[2] != 3) {
                $result = "<p>ERREUR - Format non supporté</p><hr />";
            }
            if($size[2] == 1) {    // format gif
                $image_src = imagecreatefromgif($source . $image);
            }
            if($size[2] == 2) {    // format jpg ou jpeg
                $image_src = imagecreatefromjpeg($source . $image);
            }
            if($size[2] == 3) {    // format png
                $image_src = imagecreatefrompng($source . $image);
            }
            $ratio = ajoutPhoto:: ratio($vignetteLargeurMax, $vignetteHauteurMax, $largeur_src, $hauteur_src, $hauteurFixe, $largeurFixe);
            $image_dest = imagecreatetruecolor( round($largeur_src*$ratio) , round($hauteur_src*$ratio)); imagecopyresampled($image_dest, $image_src, 0, 0, 0, 0, round($largeur_src*$ratio) , round($hauteur_src*$ratio) , $largeur_src, $hauteur_src); 
			imagedestroy($image_src);
            if(! imagejpeg($image_dest, $destination . $prefixeVignette . $image)) {
                $result = "<p>ERREUR - le dimensionnement de la vignette $image a échoué. Réessayez dans quelques minutes. Si le problème persiste, contactez le webmaster</p> \n <hr /> \n";
            }
            else {    // release the memory imagedestroy($image_dest); chmod($destination . $prefixeVignette . $image, 0775);
                $result = "<p>Vignette $prefixeVignette $image créée</p> \n";
            }
        }    // fin si l'image existe
        return $result;
    }
	
	function creerVignetteCarree($name_filephoto, $photoDir, $vignetteDir, $hauteurLargeur, $prefixeVignette)
    {
        $image = $name_filephoto;
        $source = $photoDir;
        $destination = $vignetteDir;
        if (! file_exists($source . $image)) {
            $result = "<p>ERREUR - L'image$imagen'existe pas </p><hr /> \n";
        }
        else {    // On verifie que l'extention du fichier est bien une image jpg,jpeg ou gif
            $ext = strtolower( strrchr($image, '.'));
            if ($ext != ".jpg" AND $ext != ".jpeg" AND $ext != ".gif" AND $ext != ".png") {
                $result = '<p>ERREUR - Votre image doit être un jpg,jpeg, png ou gif. $ext = ' . $ext . "  </p> \n";
            }
            $size = getimagesize($source . $image);
            $largeur_src = $size[0];
            $hauteur_src = $size[1];    //2ieme verification -> on verifie que le type du fichier est un jpg,jpeg, png ou gif    // $size[2] -> type de l'image : 1 = GIF , 2 = JPG,JPEG , 3 = PNG
            if ($size[2] != 1 AND $size[2] != 2 AND $size[2] != 3) {
                $result = "<p>ERREUR - Format non supporté</p><hr />";
            }
            if($size[2] == 1) {    // format gif
                $image_src = imagecreatefromgif($source . $image);
            }
            if($size[2] == 2) {    // format jpg ou jpeg
                $image_src = imagecreatefromjpeg($source . $image);
            }
            if($size[2] == 3) {    // format png
                $image_src = imagecreatefrompng($source . $image);
            }
			
			/* on calcule le ratio pour avoir :
				largeur = $hauteurLargeur et hauteur > $hauteurLargeur
				OU largeur > $hauteurLargeur et hauteur = $hauteurLargeur 
			*/
			
			if($largeur_src > $hauteur_src) {
				$ratio = ajoutPhoto:: ratio(10000, $hauteurLargeur, $largeur_src, $hauteur_src, 'hauteurFixe', '');	
			}
			else {
				$ratio = ajoutPhoto:: ratio($hauteurLargeur, 10000, $largeur_src, $hauteur_src, '', 'largeurFixe');	
			}
			$image_dest = imagecreatetruecolor(round($largeur_src*$ratio) , round($hauteur_src*$ratio));
			imagecopyresampled($image_dest, $image_src, 0, 0, 0, 0, round($largeur_src*$ratio) , round($hauteur_src*$ratio) , $largeur_src, $hauteur_src);
			
			/* on rogne pour faire un carré */
			
			$image_dest_carree = imagecreatetruecolor($hauteurLargeur , $hauteurLargeur);
			
			imagecopy($image_dest_carree, $image_dest, 0, 0, 0, 0, $hauteurLargeur, $hauteurLargeur);
			imagedestroy($image_src);
			imagedestroy($image_dest);
            if(! imagejpeg($image_dest_carree, $destination . $prefixeVignette . $image)) {
                $result = "<p>ERREUR - le dimensionnement de la vignette $image a échoué. Réessayez dans quelques minutes. Si le problème persiste, contactez le webmaster</p> \n <hr /> \n";
            }
            else {    // release the memory imagedestroy($image_dest); chmod($destination . $prefixeVignette . $image, 0775);
                $result = "<p>Vignette $prefixeVignette $image créée</p> \n";
            }
        }    // fin si l'image existe
        return $result;
    }
	
	function crop($name_filephoto, $photoDir, $vignetteDir, $hauteur, $largeur, $prefixeVignette = '')
	{
		$image = $name_filephoto;
        $source = $photoDir;
        $destination = $vignetteDir;
        if (! file_exists($source . $image)) {
            $result = "<p>ERREUR - L'image$imagen'existe pas </p><hr /> \n";
        }
        else {    // On verifie que l'extention du fichier est bien une image jpg,jpeg ou gif
            $ext = strtolower( strrchr($image, '.'));
            if ($ext != ".jpg" AND $ext != ".jpeg" AND $ext != ".gif" AND $ext != ".png") {
                $result = '<p>ERREUR - Votre image doit être un jpg,jpeg, png ou gif. $ext = ' . $ext . "  </p> \n";
            }
            $size = getimagesize($source . $image);
            $largeur_src = $size[0];
            $hauteur_src = $size[1];    //2ieme verification -> on verifie que le type du fichier est un jpg,jpeg, png ou gif    // $size[2] -> type de l'image : 1 = GIF , 2 = JPG,JPEG , 3 = PNG
            if ($size[2] != 1 AND $size[2] != 2 AND $size[2] != 3) {
                $result = "<p>ERREUR - Format non supporté</p><hr />";
            }
            if($size[2] == 1) {    // format gif
                $image_src = imagecreatefromgif($source . $image);
            }
            if($size[2] == 2) {    // format jpg ou jpeg
                $image_src = imagecreatefromjpeg($source . $image);
            }
            if($size[2] == 3) {    // format png
                $image_src = imagecreatefrompng($source . $image);
            }
			$image_dest_crop = imagecreatetruecolor($hauteur , $largeur);
			imagecopy($image_dest_crop, $image_src, 0, 0, 0, 0, $hauteur, $largeur);
			imagedestroy($image_src);
            if(! imagejpeg($image_dest_crop, $destination . $prefixeVignette . $image)) {
                $result = "<p>ERREUR - le dimensionnement de la vignette $image a échoué. Réessayez dans quelques minutes. Si le problème persiste, contactez le webmaster</p> \n <hr /> \n";
            }
            else {    // release the memory imagedestroy($image_dest); chmod($destination . $prefixeVignette . $image, 0775);
                $result = "<p>Image $prefixeVignette $image créée</p> \n";
            }
		}    // fin si l'image existe
        return $result;
	}
    
    function ratio($vignetteLargeurMax, $vignetteHauteurMax, $largeur_src, $hauteur_src, $hauteurFixe, $largeurFixe)
    {    // SI LARGEUR FIXE
        if ($largeurFixe == 'largeurFixe') {
            $ratio = $vignetteLargeurMax/$largeur_src;
            if($hauteur_src*$ratio>$vignetteHauteurMax) {    // si hauteur x ratio > hauteur max
                $ratio = $vignetteHauteurMax/$hauteur_src;
            }
        }    // SI HAUTEUR FIXE
        else if ($hauteurFixe == 'hauteurFixe') {
            $ratio = $vignetteHauteurMax/$hauteur_src;
            if($largeur_src*$ratio>$vignetteLargeurMax) {    // si hauteur x ratio > hauteur max
                $ratio = $vignetteLargeurMax/$largeur_src;
            }
        }    // SINON on verifie que l'image source ne soit pas plus petite que l'image de destination
        else if ($largeur_src>$vignetteLargeurMax || $hauteur_src>$vignetteHauteurMax) {

            /*
                 on calcule les 2 ratios, on garde le + petit.
             */

            $ratio_hauteur = 1;
            $ratio_largeur = 1;
            if ($hauteur_src>$vignetteHauteurMax) {
                $ratio_hauteur = $vignetteHauteurMax/$hauteur_src;
            }
            if ($largeur_src>$vignetteLargeurMax) {
                $ratio_largeur = $vignetteLargeurMax/$largeur_src;
            }
            if($ratio_hauteur<$ratio_largeur) $ratio = $ratio_hauteur;
            else $ratio = $ratio_largeur;
        }
        else {
            $ratio = 1;    // l'image créee sera identique à l'originale
        }
        return $ratio;
    }
}
?>