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
	if(preg_match("/(.*)\/delete_folder\.php/",$pageURL,$matches)){
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


if(!CanDeleteFolder()){
	$output["success"] = 0;
	$output["msg"] = "Vous n'avez pas la permission de supprimer des répertoires.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

if(isset($_GET["folder"]) AND $_GET["folder"] != ""){
	$folder = urldecode(clean($_GET["folder"]));
}else{
	$output["success"] = 0;
	$output["msg"] = "Le nom du répertoire est requis.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

if(!startsWith($folder, LIBRARY_FOLDER_PATH)){
	$output["success"] = 0;
	$output["msg"] = "Vous ne pouvez pas supprimer ce répertoire";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

if(!file_exists($folder)){
	$output["success"] = 0;
	$output["msg"] = "Le répertoire n'existe pas.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

if(!is_dir($folder)){
	$output["success"] = 0;
	$output["msg"] = "Ce n'est pas un répertoire.";
	header("Content-type: text/plain;");
	echo json_encode($output);
	exit();
}

lc_delete($folder);


include 'contents.php';


header("Content-type: text/plain;");
echo json_encode($output);
exit();
