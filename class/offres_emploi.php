<?php

############################################
############# UTILISATION ##################
############################################

class offres_emploi {
	
	public $ID; 
	public $titre; 
	public $rubrique; // cdsea | aed | sais | itep | mecs | documentation
	public $html; 
	public $date_publication;
	
	public $nbre_par_page = 5; /* si modifié, penser à changer dans l'admin $nbreoffres_emploiParPage (class offres_emploi) */
	
	public function __construct($page = '') {	
		$qry = "SET NAMES 'utf8'";
        $db = new MySQL();
        $db->Open();
        $db->query($qry);
		$debut_qry = "SELECT * ";
		$qry = " FROM offres_emploi WHERE actif='1' ORDER BY date_publication DESC";
		$adressePagination = 'offres_emploi';
		$db = new pagination();
		$db->Open();
		$this->paginationHtml = $db->pagine($debut_qry, $qry, $this->nbre_par_page,"p",$adressePagination);
		$this->nbreOffres_emploi = $db->RowCount();
		while (! $db->EndOfSeek()) {
			$row = $db->Row(); 
            $this->ID[] = $row->ID; 
            $this->titre[] = $row->titre;
			$this->rubrique[] = nl2br($row->rubrique); 
            $this->html[] = $row->html;
			preg_match('`([0-9]{2})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):[0-9]{2}`', $row->date_publication, $out);
			$this->dateActu[] = $out[3] . '/' . $out[2] . '/' . $out[1];
            $this->heureActu[] = $out[4] . 'h' . $out[5]; 
        }
	}
	
	public function afficher() {
		if(empty($this->nbreOffres_emploi)) echo '<p class="header">Aucune offre d\'emploi enregistrée</p>' . " \n";
		else {
			$html = '';
			for($i=0; $i<$this->nbreOffres_emploi; $i++) {
				$html .= '<article class="actualite" id="offre-' . $this->ID[$i] . '">' . " \n";
				$html .= '<header>' . " \n";
				$html .= '<p class="info-actu units-row-end"><span class="rubrique-actu ' . $this->rubrique[$i] . '-color">' . $this->rubrique[$i] . '</span><span class="date-actu">Le ' . $this->dateActu[$i] . ' à ' . $this->heureActu[$i] . '</span></p>' . " \n";
				$html .= '<h1 id="titre-actus-' . $this->ID[$i] . '">' . $this->titre[$i] . '</h1>' . " \n";
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
        
        public function nbre() {
            return $this->nbreOffres_emploi;
        }
}
?>