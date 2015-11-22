<?php

class diaporama {

	public $images = array();
	public $nbre_images = 0;

	public function __construct($repertoire)
	{
		$this->repertoire = 'images/' . $repertoire . '/';
		$dir = dir('../' . $this->repertoire);
		while($fichier = $dir->read()) {
			$ext = strtolower( strrchr($fichier, '.'));
			if ($ext == ".jpg" || $ext == ".jpeg" || $ext == ".gif" || $ext == ".png") {
				$this->images[] = $fichier;
			}
		}
		$this->nbre_images = count($this->images);
	}

	public function afficher()
	{
		if(!empty($this->nbre_images)) {
			$html = '<ul class="dslides">' . " \n";
			for($i=0; $i<$this->nbre_images; $i++) {
				$html .= '<li><img src="' . $this->repertoire . $this->images[$i] . '" alt=""></li>' . " \n";
			}
			$html .= '</ul>' . " \n";
			echo $html;
		}
	}
}
?>