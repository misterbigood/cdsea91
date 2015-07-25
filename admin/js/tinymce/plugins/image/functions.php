<?php

function Dirtree($path, $name = "Uploader vers : Home", $prefix = "") {
	if(isset($_SESSION["tinymce_upload_directory"]) AND $_SESSION["tinymce_upload_directory"] == $path){
		$list = '<option value="'.$path.'" selected="selected">'.$prefix.''.$name.'</option>';
	}else{
		$list = '<option value="'.$path.'">'.$prefix.''.$name.'</option>';
	}
	
	$dircont = scandir($path);
	if(count($dircont) > 0){
		foreach($dircont as $file){
			if(is_file($path . $file)){
				//do nothing
			}elseif($file !== '.' && $file !== '..'){
				$list .= Dirtree($path . $file . '/', $file, $prefix . '&hellip; ');
			}
		}
	}
	return $list;
}


function startsWith($haystack,$needle,$case=true) {
	if($case){return (strcmp(substr($haystack, 0, strlen($needle)),$needle)===0);}
	return (strcasecmp(substr($haystack, 0, strlen($needle)),$needle)===0);
}

function lc_delete($targ) {
	if(is_dir($targ)){
		$files = glob($targ . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned
		foreach($files as $file){
			lc_delete($file);
		}
		rmdir($targ);
	}else{
		unlink($targ);
	}
}

function scandirSorted($path) {
	$sortedData = array();
	$dircont = scandir($path);
	if(count($dircont) > 0){
		foreach($dircont as $file){
			if(is_file($path . $file)){
				if(ValidFileExtension($file)){
					array_push($sortedData, array('is_file'=>true, 'name'=>$file, 'path'=>PathToUrl($path) . $file, 'p'=>$path . $file, 's'=> filesize($path . $file)));
				}
			}elseif($file !== '.' && $file !== '..'){
				$count = count(scandirSorted($path . $file . '/'));
				array_unshift($sortedData,  array('is_file'=>false, 'name'=>$file, 'path'=>$path . $file . '/', 'i'=>$count));
			}
		}
	}
	return $sortedData;
}

function SearchFiles($path){
	$sortedData = array();
	$dircont = scandir($path);
	if(count($dircont) > 0){
		foreach($dircont as $file){
			if(is_file($path . $file)){
				if(ValidFileExtension($file)){
					$sortedData[] = array(0=>PathToUrl($path) . $file, 1=>$file);
				}
			}elseif($file !== '.' && $file !== '..'){
				array_merge($sortedData,  SearchFiles($path . $file . '/'));
			}
		}
	}
	return $sortedData;
}

function PathToUrl($path){
	if($path == LIBRARY_FOLDER_PATH){
		return LIBRARY_FOLDER_URL;
	}else{
		$url = str_replace(LIBRARY_FOLDER_PATH,"",$path);
		//array_shift($url);// Remove root of lib
		
		if($url != ""){
			return LIBRARY_FOLDER_URL . $url;
		}else{
			return LIBRARY_FOLDER_URL;
		}
	}
}

function ValidFileExtension($name){
	$allowed_extensions = explode(',', ALLOWED_IMG_EXTENSIONS);
	$extension = strtolower(GetExtension($name));
	if (in_array($extension, $allowed_extensions, TRUE)){
		return true;
	} else {
		return false;
	}
}
	
function GetExtension($filename){
	$x = explode('.', $filename);
	return end($x);
}

function clean($str) {
	if(is_array($str)){
		$return = array();
		foreach($str as $k=>$v){
			$return[clean($k)] = clean($v);
		}
		return $return;
	}else{
		$str = @trim($str);
		return $str;
	}
}

function set_filename($path, $filename){
	$filename = clean_file_name($filename);
	$file_ext = GetExtension($filename);
	if ( ! file_exists($path.$filename)){
		return $filename;
	}
	$new_filename = str_replace('.'.$file_ext, '', $filename);
	for ($i = 1; $i < 300; $i++){			
		if ( ! file_exists($path.$new_filename.'_'.$i.'.'.$file_ext)){
			$new_filename .= '_'.$i.'.'.$file_ext;
			break;
		}
	}
	return $new_filename;
}

function clean_file_name($filename){
	$invalid = array("<!--","-->","'","<",">",'"','&','$','=',';','?','/',"%20","%22","%3c","%253c","%3e","%0e","%28","%29","%2528","%26","%24","%3f","%3b", "%3d");		
	$filename = str_replace($invalid, '', $filename);
	$filename = preg_replace("/\s+/", "_", $filename);
	return stripslashes($filename);
}

function MBToBytes($number){
    return $number*pow(1024,2);
}

function DoUpload($field = 'userfile'){
	$output = array();
	$output["success"] = true;
	
	if(isset($_SESSION["tinymce_upload_directory"]) AND $_SESSION["tinymce_upload_directory"] != ""){
		$current_folder = $_SESSION["tinymce_upload_directory"];
	}else{
		$current_folder = LIBRARY_FOLDER_PATH;
	}
	
	if(!CanAcessUploadForm()){
		$output["reason"] = "No permission to upload.";
		$output["success"] = false;
		return $output;
	}
	
	if(!isset($_FILES[$field])){
		$output["reason"] = "File not selected.";
		$output["success"] = false;
		return $output;
	}
	
	if(!is_uploaded_file($_FILES[$field]['tmp_name'])){
		$error = (!isset($_FILES[$field]['error'])) ? 4 : $_FILES[$field]['error'];
		$output["success"] = false;
		switch($error){
			case 1:	// UPLOAD_ERR_INI_SIZE
				$output["reason"] = "File exceeds limit size.";
				break;
			case 2: // UPLOAD_ERR_FORM_SIZE
				$output["reason"] = "File exceeds limit size.";
				break;
			case 3: // UPLOAD_ERR_PARTIAL
				$output["reason"] = "File uploaded partially.";
				break;
			case 4: // UPLOAD_ERR_NO_FILE
				$output["reason"] = "File not selected.";
				break;
			case 6: // UPLOAD_ERR_NO_TMP_DIR
				$output["reason"] = "No temp directory.";
				break;
			case 7: // UPLOAD_ERR_CANT_WRITE
				$output["reason"] = "Unable to write the file.";
				break;
			case 8: // UPLOAD_ERR_EXTENSION
				$output["reason"] = "Invalid extension.";
				break;
			default :   
				$output["reason"] = "File not selected.";
				break;
		}

		return $output;
	}
	
	if(!ValidFileExtension($_FILES[$field]['name'])){
		$output["reason"] = "Invalid extension.";
		$output["success"] = false;
		return $output;
	}

	$file_name = set_filename($current_folder, $_FILES[$field]['name']);

	if(!@copy($_FILES[$field]['tmp_name'], $current_folder.$file_name)){
		if(!@move_uploaded_file($_FILES[$field]['tmp_name'], $current_folder.$file_name)){
			$output["reason"] = "Could not move file.";
			$output["success"] = false;
			return $output;
		}
	}
	
	/* =============================================
		AJOUT : on redimensionne l'image
   	============================================= */
	
	if(!resizePhoto($file_name, $current_folder, '255', '300')) {
		$output["reason"] = "Erreur lors du redimensionnement de l'image.";
		$output["success"] = false;
		return $output;
	}
	
	if(!isset($_SESSION['SimpleImageManager'])){
		$_SESSION['SimpleImageManager'] = array();
	}
	$_SESSION['SimpleImageManager'][] = PathToUrl($current_folder).$file_name;

	$output["file"] = PathToUrl($current_folder).$file_name;

	return $output;
}

function is_url_exist($url){
	$ch = curl_init($url);    
	curl_setopt($ch, CURLOPT_NOBODY, true);
	curl_exec($ch);
	$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if($code == 200){
		$status = true;
	}else{
		$status = false;
	}
	curl_close($ch);
	return $status;
}

function TrimText($input, $length) {
    $input = strip_tags($input);
    if (strlen($input) <= $length) {
        return $input;
    }
    $trimmed_text = substr($input, 0, $length);
  
    $trimmed_text .= ' &hellip;';
  
    return $trimmed_text;
}

function formatSizeUnits($bytes){
	if ($bytes >= 1073741824){
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }elseif($bytes >= 1048576){
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }elseif($bytes >= 1024){
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }elseif($bytes > 1){
            $bytes = $bytes . ' bytes';
        }elseif($bytes == 1){
            $bytes = $bytes . ' byte';
        }else{
            $bytes = '0 bytes';
        }

        return $bytes;
}

function resizePhoto($name_filephoto, $photoDir, $photoLargeurMax, $photoHauteurMax, $hauteurFixe = '', $largeurFixe = '')
    {
        $image = $name_filephoto;
        $source = $photoDir;
        $destination = $photoDir;
        if (! file_exists($source . $image)) {
           return false;
        }
        $ext = strtolower( strrchr($image, '.'));
        if ($ext != ".jpg" AND $ext != ".jpeg" AND $ext != ".gif" AND $ext != ".png") {
            return false;
        }
        else {
            $size = getimagesize($source . $image);
            $largeur_src = $size[0];
            $hauteur_src = $size[1];    //2eme verification -> on verifie que le type du fichier est un jpg,jpeg, png ou gif    // $size[2] -> type de l'image : 1 = GIF , 2 = JPG,JPEG , 3 = PNG
            if ($size[2] != 1 AND $size[2] != 2 AND $size[2] != 3) {
                return false;
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
                $ratio = ratio($photoLargeurMax, $photoHauteurMax, $largeur_src, $hauteur_src, $hauteurFixe, $largeurFixe);
                if($ratio != 1) {
                    $image_dest = imagecreatetruecolor( round($largeur_src*$ratio) , round($hauteur_src*$ratio)); imagecopyresampled($image_dest, $image_src, 0, 0, 0, 0, round($largeur_src*$ratio) , round($hauteur_src*$ratio) , $largeur_src, $hauteur_src); imagedestroy($image_src);
                    if(! imagejpeg($image_dest, $destination . $image)) {
                        return false;
                    }
                    else {
                        imagedestroy($image_dest); chmod($destination . $image, 0775);
                        return true;
                    }
                }
                else {    // si ratio = 1 chmod($destination . $image, 0775);
                     return true;
                }
            }
        }
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