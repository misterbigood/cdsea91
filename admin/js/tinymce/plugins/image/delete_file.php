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
	if(preg_match("/(.*)\/delete_file\.php/",$pageURL,$matches)){
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


if(!CanDeleteFiles()){
	$output["success"] = 0;
	$output["msg"] = "Vous n'avez pas la permission de supprimer des fichiers.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

if(isset($_GET["file"]) AND $_GET["file"] != ""){
	$file = urldecode(clean($_GET["file"]));
}else{
	$output["success"] = 0;
	$output["msg"] = "Le nom du fichier est requis.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

if(!startsWith($file, LIBRARY_FOLDER_PATH)){
	$output["success"] = 0;
	$output["msg"] = "Vous ne pouvez pas supprimer ce fichier";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

if(!file_exists($file)){
	$output["success"] = 0;
	$output["msg"] = "Le fichier n'existe pas.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

if(!is_file($file)){
	$output["success"] = 0;
	$output["msg"] = "Ce n'est pas un fichier.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

if(!unlink($file)){
	$output["success"] = 0;
	$output["msg"] = "Le fichier n'a pas pu être effacé.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

include 'contents.php';


header("Content-type: text/plain;");
echo json_encode($output);
exit();
