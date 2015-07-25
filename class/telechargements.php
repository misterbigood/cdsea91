<?php

class telechargements {

	public $repertoires = array();
	public $fichiers = array();
	public $dir;
	public $na = array('.', '..', '.tmb', '.quarantine'); // répertoires à ne pas répertorier
	public $extensions_autorisees = array('.pdf', '.doc', '.docx', '.ppt', '.pptx', '.xls', '.xlsx');

	/*
		$repertoires['nom'][$i]
		$fichiers[$nom_repertoire]['nom'][$i]
		$fichiers[$nom_repertoire]['extension'][$i]
	*/

	/* Pour autoriser de nouvelles extensions, ajouter les types MIME dans admin/js/elfinder/php/connector.php */

	public function __construct($repertoire)
	{
		$this->dir = $repertoire;
		$dir = dir($this->dir);
		$this->repertoires['nom'] = array();
		while($nom_repertoire = $dir->read()) {
			if(is_dir($this->dir . '/' . $nom_repertoire) && !in_array($nom_repertoire, $this->na)) {
				$this->repertoires['nom'][] = $nom_repertoire;
			}
			else { // fichiers à la racine
				$nom_fichier = $nom_repertoire; // ça n'est pas un répertoire, c'est un fichier
				if(is_file($this->dir . '/' . $nom_fichier)) {
					$extension = strrchr($nom_fichier, '.');
					if(in_array($extension, $this->extensions_autorisees)) {
						if(!in_array('racine', $this->repertoires['nom'])) {
							$this->repertoires['nom'][] = 'racine';
						}
						$this->fichiers['racine']['nom'][] = $nom_fichier;
						$this->fichiers['racine']['extension'][] = str_replace('.', '', $extension);
                                                $this->fichiers['racine']['date'][] = filemtime($this->dir . '/' . $nom_fichier);
					}
				}
			}
		}
		$dir->close();
		for($i=0; $i<count($this->repertoires['nom']); $i++) {
			$nom_repertoire = $this->repertoires['nom'][$i];
			if($nom_repertoire != 'racine') {
				$f = dir($this->dir . '/' . $nom_repertoire);
				while($nom_fichier = $f->read()) {
					if(is_file($this->dir . '/' . $nom_repertoire . '/' . $nom_fichier)) {
						$extension = strrchr($nom_fichier, '.');
						if(in_array($extension, $this->extensions_autorisees)) {
							$this->fichiers[$nom_repertoire]['nom'][] = $nom_fichier;
							$this->fichiers[$nom_repertoire]['extension'][] = str_replace('.', '', $extension);
                                                        $this->fichiers[$nom_repertoire]['date'][] = filemtime($this->dir . '/' . $nom_fichier);
						}
					}
				}
				$f->close();
			}
		}
	}

	public function afficher($tri='nom')
	{
		$html = '';
                asort($this->repertoires['nom']);
		foreach($this->repertoires['nom'] as $cle => $nom_repertoire) {
			//$nom_repertoire = $this->repertoires['nom'][$i];
			if(isset($this->fichiers[$nom_repertoire]['nom']) && !empty($this->fichiers[$nom_repertoire]['nom'])) {
				$html .= '<article>' . " \n";
				if($nom_repertoire != 'racine') {
					$html .= '<h2>' . $nom_repertoire . '</h2>' . " \n";
				}
				$html .= '<ul>' . " \n";
                                asort($this->fichiers[$nom_repertoire][$tri]);
                                foreach($this->fichiers[$nom_repertoire]['nom'] as $key => $nom_fichier) {
					//$nom_fichier = $this->fichiers[$nom_repertoire]['nom'][$j];
					if($this->fichiers[$nom_repertoire]['extension'][$key] == 'pdf') {
						if($nom_repertoire == 'racine') {
							$lien = 'inc/telechargerPdf.php?pdf=' . $this->dir . '/' . $nom_fichier;
						}
						else $lien = 'inc/telechargerPdf.php?pdf=' . $this->dir . '/' . $nom_repertoire . '/' . $nom_fichier;
					}
					else {
						if($nom_repertoire == 'racine') {
							$lien = $this->dir . '/' . $nom_fichier;
						}
						else $lien = $this->dir . '/' . $nom_repertoire . '/' . $nom_fichier;
					}
					$html .= '<li><a href="' . $lien . '" class="' .$this->fichiers[$nom_repertoire]['extension'][$key] . '">' . $nom_fichier . '</a></li>' . " \n";
				}
				$html .= '</ul>' . " \n";
				$html .= '</article>' . " \n";
			}
		}
		echo $html;
	}
}
?>