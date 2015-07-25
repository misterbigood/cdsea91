<?php

require_once('config.php');
require_once('functions.php');

if(!defined('LIBRARY_FOLDER_PATH')){
	define('LIBRARY_FOLDER_PATH', 'uploads/');
}

if(!defined('LIBRARY_FOLDER_PATH')){
	$pageURL = 'http';
	if(isset($_SERVER["HTTPS"]) AND $_SERVER["HTTPS"] == "on"){
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if($_SERVER["SERVER_PORT"] != "80"){
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	}else{
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	if(preg_match("/(.*)\/new_folder\.php/",$pageURL,$matches)){
		define('LIBRARY_FOLDER_URL', $matches[1] . '/uploads/');
	}
}

$output = array();

$output["success"] = 1;
$output["msg"] = "";

if(isset($_GET["path"]) AND $_GET["path"] != ""){
	$current_folder = urldecode(clean($_GET["path"]));
}else{
	$current_folder = LIBRARY_FOLDER_PATH;
}


if(!is_writable($current_folder)){
	$output["success"] = 0;
	$output["msg"] = "Le répertoire courant est interdit en écriture.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

if(!CanCreateFolders()){
	$output["success"] = 0;
	$output["msg"] = "Vous n'avez pas la permisdsion de créer des répertoires.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

if(isset($_GET["folder"]) AND $_GET["folder"] != ""){
	$new_folder = $current_folder . '/' . clean($_GET["folder"]);
}else{
	$output["success"] = 0;
	$output["msg"] = "Le nom du répertoire est requis.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

if(file_exists($new_folder)) {
	$output["success"] = 0;
	$output["msg"] = "Un autre répertoire du même nom existe. SVP indiquez un autre nom.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();   
}

if(!strpbrk($_GET["folder"], "\\/?%*:|\"<>") === FALSE){
	$output["success"] = 0;
	$output["msg"] = "Le nom du répertoire est invalide.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit(); 
}

$old = umask(0);
if(!mkdir($new_folder, 0777)){
	$output["success"] = 0;
	$output["msg"] = "Le répertoire n'a pas pu être créé.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit(); 
}
umask($old);

include 'contents.php';


header("Content-type: text/plain;");
echo json_encode($output);
exit();
