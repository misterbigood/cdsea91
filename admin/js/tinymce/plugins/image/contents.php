<?php

if(isset($_SESSION['tinymce_toggle_view'])){
	$view = $_SESSION['tinymce_toggle_view'];
}else{
	$view = 'grid';
}

$current_folder_content = scandirSorted($current_folder);

if(count($current_folder_content) > 0 AND CanAcessLibrary()){
	$html = '';
	foreach($current_folder_content as $c){
		if($view == 'list'){
			if($c['is_file'] == false){
				$html .= '<tr>
				<td>
				<i class="icon-folder-open"></i>&nbsp;
				<a class="lib-folder" href="" rel="'. urlencode($c['path']).'" title="'. $c['name'] .'">
					'. TrimText($c['name'], 50) .'
				</a>
				</td>
				<td width="20%">
				'. $c['i'] .' Objets
				</td>
				<td width="10%">
					<a href="" class="transparent change-folder" title="Changer le nom" rel="'. $c['name'] .'"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
					<a href="" class="transparent delete-folder" rel="'. urlencode($c['path']).'" title="Supprimer"><i class="icon-trash"></i></a>
				</td>
				</tr>';
			}else{
				$html .= '<tr>
				<td>
				<i class="icon-picture"></i>&nbsp;
				<a href="" class="img-thumbs" rel="' .$c['path'] . '" title="'. $c['name'] .'">
					'. TrimText($c['name'], 50) .'
				</a>
				</td>
				<td width="20%">
				'. formatSizeUnits($c['s']) .'
				</td>
				<td width="10%">
					<a href="" class="transparent change-file" title="Changer le nom" rel="'. $c['name'] .'"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
					<a href="" class="transparent delete-file" rel="'. urlencode($c['p']).'" title="Supprimer"><i class="icon-trash"></i></a>
				</td>
				</tr>';
			}
		
		}else{
			if($c['is_file'] == false){
				$html .= '<div class="item">
			<a class="lib-folder" href="" rel="'. urlencode($c['path']).'" title="'. $c['name'] .'">
			<img src="bootstrap/img/130x90.png" class="img-polaroid" width="130" height="90">
			</a>
			<div>
			<a href="" class="pull-left transparent change-folder" title="Changer le nom" rel="'. $c['name'] .'"><i class="icon-pencil"></i></a>
			<a href="" class="pull-right transparent delete-folder" rel="'. urlencode($c['path']).'" title="Supprimer"><i class="icon-trash"></i></a>
			<div class="clearfix"></div>
			</div>
			</div>';
			}else{
				$html .= '<div class="item">
			<a href="" class="img-thumbs" rel="' .$c['path'] . '" title="'. $c['name'] .'">
			<img src="timthumb.php?src=' . $c['path'] . '&w=130&h=90" class="img-polaroid" width="130" height="90">
			</a>
			<div>
			<a href="" class="pull-left transparent change-file" title="Changer le nom" rel="'. $c['name'] .'"><i class="icon-pencil"></i></a>
			<a href="" class="pull-right transparent delete-file" rel="'. urlencode($c['p']).'" title="Supprimer"><i class="icon-trash"></i></a>
			<div class="clearfix"></div>
			</div>
			</div>';
			}
		}
	}
	if($html != ''){
		if($view == 'list'){
			$html = '<br/><table class="table">' . $html . '</table>';
		}
		
		$output["html"] = $html;
	}else{
		$output["html"] = '<center>Aucune image dans le répertoire.</center>';
	}
}else{
	$output["html"] = '<center>Aucune image dans le répertoire.</center>';
}
