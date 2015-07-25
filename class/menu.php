<?php

############################################
############# UTILISATION ##################
############################################

class menu {

	public $html;

	public function __construct($element, $page) // $element = main-nav || page-nav
	{
		$this->element = $element;
		preg_match('`(cdsea|mecs|itep|sais|aed|documentation)([-]?)([a-z_-]*)`', $page, $out);
		$this->main_page = $out[1]; // ex : cdsea
		$this->s_page = $out[3]; // ex : association
		if($this->element == 'main-nav') {
			// echo $this->main_page . '<br />' . $this->s_page;
			$this->html = '<nav id="main-nav">' . " \n";
			$this->html .= '<span id="curseur-' . $this->main_page . '" class="curseur" aria-hidden="true"></span>' . " \n";
			$this->html .= '<a class="toggleMenu" href="#">Menu</a>' . " \n";
			$this->html .= '<ul>' . " \n";
			$this->html .= $this->menu('index', '<span>cdsea l\'association</span>', 'cdsea');
			$this->html .= $this->menu('mecs-structure', '<span>protection de l\'adolescent</span>', 'mecs');
			$this->html .= $this->menu('itep-structure', '<span>rééducation des troubles du comportement</span>', 'itep');
			$this->html .= $this->menu('sais-structure', '<span>accompagnement de l\'adulte en situation de handicap</span>', 'sais');
			$this->html .= $this->menu('aed-structure', '<span>aide éducative en milieu familial</span>', 'aed');
			$this->html .= $this->menu('documentation', '<span>documentation</span>', 'documentation');
			$this->html .= '</ul>' . " \n";
			$this->html .= '</nav>' . " \n";
		}
		else { // page-nav
			$this->html = '<nav id="page-nav">' . " \n";
			$this->html .= '<ul>' . " \n";
			if($this->main_page == 'cdsea') {
				$this->html .= $this->menu('index', 'L\'association', 'association');
				$this->html .= $this->menu('cdsea-missions', 'Missions', 'missions');
				$this->html .= $this->menu('cdsea-conseil-d-administration', 'Conseil d\'administration', 'conseil-d-administration');
				$this->html .= $this->menu('cdsea-equipe', '&Eacute;quipe', 'equipe');
				$this->html .= $this->menu('cdsea-partenaires', 'Partenaires', 'partenaires');
				$this->html .= $this->menu('cdsea-financeurs', 'Financeurs', 'financeurs');
				$this->html .= $this->menu('cdsea-audacite', 'Audacité', 'audacite');
			}
			else if($this->main_page == 'mecs') {
				$this->html .= $this->menu('mecs-structure', 'Structure', 'structure');
				$this->html .= $this->menu('mecs-equipe', '&Eacute;quipe', 'equipe');
			}
			else if($this->main_page == 'itep') {
				$this->html .= $this->menu('itep-structure', 'Structure', 'structure');
				$this->html .= $this->menu('itep-equipe', '&Eacute;quipe', 'equipe');
			}
			else if($this->main_page == 'sais') {
				$this->html .= $this->menu('sais-structure', 'Structure', 'structure');
				$this->html .= $this->menu('sais-equipe', '&Eacute;quipe', 'equipe');
			}
			else if($this->main_page == 'aed') {
				$this->html .= $this->menu('aed-structure', 'Structure', 'structure');
				$this->html .= $this->menu('aed-equipe', '&Eacute;quipe', 'equipe');
			}
			else if($this->main_page == 'documentation') {
				$this->html .= $this->menu('documentation', 'Documentation', 'documentation');
				//$this->html .= $this->menu('marche-public', 'Marché public', 'marche_public');
				//$this->html .= $this->menu('ag-bureau', 'AG bureau', 'ag_bureau');
                                $this->html .= $this->menu('audacite', 'Audacité', 'audacite');
			}
			$this->html .= '</ul>' . " \n";
			$this->html .= '</nav>' . " \n";
		}
		echo $this->html;
	}

	private function menu($adresse, $txt, $id)
	{
		$on = '';
		if($this->element == 'main-nav') {
			if($this->main_page == $id) {
				$on = ' class="on"';
			}
		}
		else { // page-nav
			if($this->s_page == $id) {
				$on = ' class="on"';
			}
		}
		$html = '<li>';
		$html .= '<a href="' . $adresse . '.html" id="' . $this->element . '-' . $id . '"' . $on . '>' . $txt . '</a>' . " \n";
		$html .= '</li>' . " \n";
		return $html;
	}
}
?>