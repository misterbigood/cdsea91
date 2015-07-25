<?php

############################################
############# UTILISATION ##################
############################################

class actualites {

	public $ID;
	public $titre;
	public $rubrique; // cdsea | aed | sais | itep | mecs | documentation
	public $intro;
	public $html;
	public $date_publication;

	public $nbre_par_page = 6; /* si modifié, penser à changer dans l'admin $nbreActualitesParPage (class actualites) */

	public function __construct($page = '') {
		$qry = "SET NAMES 'utf8'";
        $db = new MySQL();
        $db->Open();
        $db->query($qry);
        $id_actu=$_GET['id_actu'];
        if($id_actu<>""):
            $qry = "SELECT * FROM actualites WHERE actif='1' AND id=".$id_actu;
            $db->Open();
            $db->query($qry);
        else:
        	if($page == 'index') {
			$qry = "SELECT * FROM actualites WHERE actif='1' ORDER BY date_publication DESC LIMIT 10";
			$db = new MySQL();
			$db->Open();
			$db->query($qry);
		}
		else {
			$debut_qry = "SELECT * ";
			$qry = " FROM actualites WHERE actif='1' ORDER BY date_publication DESC";
			$adressePagination = 'actualites';
			$db = new pagination();
			$db->Open();
			$this->paginationHtml = $db->pagine($debut_qry, $qry, $this->nbre_par_page,"p",$adressePagination);

		}
        endif;
		$this->nbreActus = $db->RowCount();
		while (! $db->EndOfSeek()) {
			$row = $db->Row();
            $this->ID[] = $row->ID;
            $this->titre[] = $row->titre;
			$this->rubrique[] = nl2br($row->rubrique);
            $this->intro[] = nl2br($row->intro);
            $this->html[] = $row->html;
            $this->video[] = $row->video;
			preg_match('`([0-9]{2})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):[0-9]{2}`', $row->date_publication, $out);
			$this->dateActu[] = $out[3] . '/' . $out[2] . '/' . $out[1];
            $this->heureActu[] = $out[4] . 'h' . $out[5];
        }
	}

	public function afficherActusAccueil()
	{
		$html = '';
		if(!empty($this->nbreActus)) {
			$html .= '<div class="units-row">' . " \n";
			$html .= '<section id="actualites-accueil" class="unit-100 unit-centered">' . " \n";
			$html .= '<ul class="rslides">' . " \n";
			for($i=0; $i<$this->nbreActus; $i++) {
				$html .= '<li>';
				$html .= '<a href="actualites.html#news-' . $this->ID[$i] . '">' . " \n";
				$html .= '<p class="info-actu units-row-end"><span class="rubrique-actu ' . $this->rubrique[$i] . '-color">' . $this->rubrique[$i] . '</span><span class="date-actu">Publié le ' . $this->dateActu[$i] . '</span></p>' . " \n";
				$html .= '<h2>' . $this->titre[$i] . '</h2>' . " \n";
				$html .= '<p class="intro-actu">' . $this->intro[$i] . '</p>' . " \n";
				$html .= '<div class="width-100 text-centered"><a href="detail-actu.html?id_actu=' . $this->ID[$i] . '" class="btn btn-blue">Lire la suite<span class="icon icon-angle-right append"></span></a></div>' . " \n";
				$html .= '</a>' . " \n";
				$html .= '</li>';
			}
			$html .= '</ul>' . " \n";
			$html .= '</section>' . " \n";
			$html .= '</div>';
		}
		echo $html;
	}

	public function afficher() {
		if(empty($this->nbreActus)) echo '<p class="header">Aucune actualité enregistrée</p>' . " \n";
		else {
			$html = '';
			for($i=0; $i<$this->nbreActus; $i++) {
				$class_last = '';
				if($i + 1 == $this->nbreActus) $class_last = ' last';
				$html .= '<article class="actualite' . $class_last . '" id="actualite-' . $this->ID[$i] . '">' . " \n";
				$html .= '<header>' . " \n";
				$html .= '<p class="info-actu units-row-end"><span class="rubrique-actu ' . $this->rubrique[$i] . '-color">' . $this->rubrique[$i] . '</span><span class="date-actu">Le ' . $this->dateActu[$i] . ' à ' . $this->heureActu[$i] . '</span></p>' . " \n";
				$html .= '<h1 id="titre-actus-' . $this->ID[$i] . '">' . $this->titre[$i] . '</h1>' . " \n";
				$html .= '<p class="header">' . $this->intro[$i] . '</p>' . " \n";
				$html .= '</header>' . " \n";
				$html .= '<section class="suite" id="actus-' . $this->ID[$i] . '">' . " \n";
				$html .= '<p>' . $this->html[$i] . '</p>' . " \n";
				$html .= '<hr class="separation" />' . " \n";
				$html .= '</section>' . " \n";
				$html .= '</article>' . " \n";
			}
			$html .= '<hr class="separation" />' . " \n";
			$html .= $this->paginationHtml;
			echo $html;
		}
	}
        
        public function afficher_detail() {
		if(empty($this->nbreActus)) echo '<p class="header">Aucune actualité enregistrée</p>' . " \n";
		else {
			$html = '';
			for($i=0; $i<$this->nbreActus; $i++) {
				$class_last = '';
				if($i + 1 == $this->nbreActus) $class_last = ' last';
				$html .= '<article class="actualite' . $class_last . '" id="actualite-' . $this->ID[$i] . '">' . " \n";
				$html .= '<header>' . " \n";
				$html .= '<p class="info-actu units-row-end"><span class="rubrique-actu ' . $this->rubrique[$i] . '-color">' . $this->rubrique[$i] . '</span><span class="date-actu">Le ' . $this->dateActu[$i] . ' à ' . $this->heureActu[$i] . '</span></p>' . " \n";
				$html .= '<h1 id="titre-actus-' . $this->ID[$i] . '">' . $this->titre[$i] . '</h1>' . " \n";
				$html .= '<p class="header">' . $this->intro[$i] . '</p>' . " \n";
				$html .= '</header>' . " \n";
				$html .= '<section class="suite" id="actus-' . $this->ID[$i] . '">' . " \n";
				$html .= '<p>' . $this->html[$i] . '</p>' . " \n";
				$html .= '<hr class="separation" />' . " \n";
				$html .= '</section>' . " \n";
                                if($this->video[$i]<>""):
                                    $html .= '<section class="video">' . " \n";
                                    $html .= '<object type="application/x-shockwave-flash" data="./player/dewtube.swf" width="640" height="480">';
                                    $html .= '<param name="allowFullScreen" value="true" />';
                                    $html .= '<param name="movie" value="./player/dewtube.swf" />';
                                    $html .= '<param name="flashvars" value="movie=/videos/'.$this->video[$i].'&width=640&height=480" />';
                                    $html .= '</object>';
                                    $html .= '<hr class="separation" />' . " \n";
                                    $html .= '</section>' . " \n";
                                endif;
				$html .= '</article>' . " \n";
			}
			$html .= '<hr class="separation" />' . " \n";
			$html .= $this->paginationHtml;
			echo $html;
		}
	}
        
        public function afficher_liste() {
		if(empty($this->nbreActus)) echo '<p class="header">Aucune actualité enregistrée</p>' . " \n";
		else {
			$html = '';
			for($i=0; $i<$this->nbreActus; $i++) {
				$class_last = '';
				if($i + 1 == $this->nbreActus) $class_last = ' last';
				$html .= '<article class="actualite' . $class_last . '" id="actualite-' . $this->ID[$i] . '">' . " \n";
				$html .= '<header>' . " \n";
				$html .= '<p class="info-actu units-row-end"><span class="rubrique-actu ' . $this->rubrique[$i] . '-color">' . $this->rubrique[$i] . '</span><span class="date-actu">Le ' . $this->dateActu[$i] . ' à ' . $this->heureActu[$i] . '</span></p>' . " \n";
				$html .= '<h1 id="titre-actus-' . $this->ID[$i] . '"><a href="detail-actu.html?id_actu='. $this->ID[$i] .'">' . $this->titre[$i] . '</a></h1>' . " \n";
				$html .= '<p class="">' . $this->intro[$i] . '</p>' . " \n";
				$html .= '</header>' . " \n";
				$html .= '</article>' . " \n";
			}
			$html .= '<hr class="separation" />' . " \n";
			$html .= $this->paginationHtml;
			echo $html;
		}
	}
        
        public function nbre() {
            return $this->nbreActus;
        }
	private function couperTexte($texte)
	{
		if(strlen($texte) > 200) {
			$texte = wordwrap($texte, 200, ' coupure ');//on ajoute le mot 'coupure' au bout de n caractères, une fois le mot en cours terminé
			$pos=strpos($texte, ' coupure');//on récupère la position du mot 'coupure'
			$texte=substr($texte,0 ,$pos);//on coupe ce qui est après
		}
		return $texte;
	}
        
}
?>