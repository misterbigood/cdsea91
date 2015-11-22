<?php 
class actualites
{
    public $ID;
	public $titre; 
	public $intro; 
	public $html;
        public $video;
	public $date_pub;
	public $actif;
	
	public $index_page; /* $this->index_page[$ID] */
	
	public $nbreActualites = '';
	public $nbreActualitesParPage = 8; /* pour calcul de la pagination lors du renvoi vers le site */
    
    function __construct()
    {
		$champs = array('actualites.rubrique', 'actualites.actif'); 
		$tables = array('actualites'); // toutes les tables filtrées 
		$typesChamps = array('texte', 'booleen'); // texte OU booleen 
		$titresChamps = array('rubrique', 'actif'); 
		$colonnesIndex = array(2, 5); // index des colonnes à surligner 
		$formAction = 'actualites.php'; 
		$this->qryFiltres = $this->recupererQryFiltres($champs, $colonnesIndex); 
		$this->tableauFiltres = $this->construireTableauFiltres($champs, $tables, $typesChamps, $titresChamps, $formAction); 
		$this->tri = $this->recupererTri(); 
		$debutQry = 'SELECT * FROM actualites'; 
		$this->qryFiltres .= " ORDER BY" . $this->tri; 
		$qry = "SET NAMES 'utf8'"; 
		$db = new MySQL(); 
		$db->Open(); 
		$db->query($qry); 
		$db = new pagination(); 
		$db->Open(); 
		$adressePagination = $_SESSION['adressePage']; 
		if(isset($_GET['npp']) && is_numeric($_GET['npp'])) $_SESSION['npp'] = $_GET['npp']; 
		else if(!isset($_SESSION['npp'])) $_SESSION['npp'] = 10; 
		$this->paginationHtml = $db->pagine($this->qryFiltres,$_SESSION['npp'],"p",$adressePagination, 5, $debutQry); 

		$this->nbreActualites = $db->RowCount(); 
		while (! $db->EndOfSeek()) { 
		      $row = $db->Row(); 
		      $this->ID[] = $row->ID; 
		      $this->titre[] = $row->titre;
		      $this->rubrique[] = $row->rubrique; 
		      $this->intro[] = $row->intro; 
		      $this->html[] = $row->html;
                      $this->video[] = $row->video;
                      $date = DateTime::createFromFormat('Y-m-d H:i:s', $row->date_publication);
                      $this->date_publication[] = $date->format('d-m-Y');
	              $this->actif[] = $row->actif;
		}
		
		/* 2ème requête pour déterminer la page de chaque actu sur le site */
		 
		$qry = "SELECT ID FROM actualites WHERE actif > 0 ORDER BY date_publication DESC";
		$db = new MySQL();
		$db->Open();
		$db->query($qry);		
		$nbre = $db->RowCount();
		$index_page = 1;
		$index_enregistrement = 0;	
		if(!empty($nbre)) { // SI LA REQUETE N'EST PAS VIDE
			while (! $db->EndOfSeek()) {
				$index_enregistrement ++;
				if($index_enregistrement > $this->nbreActualitesParPage * $index_page) {
					$index_page ++;
				}
				$row = $db->Row();
				$actu_ID = $row->ID;
				$this->index_page[$actu_ID] = $index_page;
			}
		}
	}  
	
	/*____________ AFFICHAGE DU TABLEAU CATEGORIES + SOUS CATEGORIES AVEC BOUTONS MODIF/SUPPR ____________*/
    
    public function afficherTableauActualitesAdmin()
    {
		$html = $this->tableauFiltres;
		$html .= '<table id="tableauActualitesAdmin" class="tableAdmin centre">' . " \n"; 
		$numbersArray = array(10,20,50); 
		$html .= '<caption>liste des actualités' . utils::selectNbreParPage($numbersArray, $_SESSION['npp']) . '</caption>' . " \n"; 
		$html .= '<thead>' . " \n"; 
		$html .= '<tr>' . " \n"; 
		if(isset($_GET['p'])) { 
			$arrayUrlVarsUp = array('tri', 'direction', 'p'); 
			$arrayUrlValeursUp = array('date_publication', 'ASC', $_GET['p']); 
			$arrayUrlVarsDown = array('tri', 'direction', 'p'); 
			$arrayUrlValeursDown = array('date_publication', 'DESC', $_GET['p']); 
		} 
		else { 
			$arrayUrlVarsUp = array('tri', 'direction'); 
			$arrayUrlValeursUp = array('date_publication', 'ASC'); 
			$arrayUrlVarsDown = array('tri', 'direction'); 
			$arrayUrlValeursDown = array('date_publication', 'DESC'); 
		} 
		$html .= '<th class="titre"><div class="tri">date de publication' . utils::lienAjax('inc/afficherActualites.php', $arrayUrlVarsUp, $arrayUrlValeursUp, '<img src="images/tri.png" alt="" />', 'divActualites', 'triUp'). utils::lienAjax('inc/afficherActualites.php', $arrayUrlVarsDown, $arrayUrlValeursDown, '<img src="images/tri.png" alt="" />', 'divActualites', 'triDown').'</div></th>' . " \n";
		if(isset($_GET['p'])) { 
			$arrayUrlVarsUp = array('tri', 'direction', 'p'); 
			$arrayUrlValeursUp = array('rubrique', 'ASC', $_GET['p']); 
			$arrayUrlVarsDown = array('tri', 'direction', 'p'); 
			$arrayUrlValeursDown = array('rubrique', 'DESC', $_GET['p']); 
		} 
		else { 
			$arrayUrlVarsUp = array('tri', 'direction'); 
			$arrayUrlValeursUp = array('rubrique', 'ASC'); 
			$arrayUrlVarsDown = array('tri', 'direction'); 
			$arrayUrlValeursDown = array('rubrique', 'DESC'); 
		} 
		$html .= '<th class="titre"><div class="tri">rubrique' . utils::lienAjax('inc/afficherActualites.php', $arrayUrlVarsUp, $arrayUrlValeursUp, '<img src="images/tri.png" alt="" />', 'divActualites', 'triUp'). utils::lienAjax('inc/afficherActualites.php', $arrayUrlVarsDown, $arrayUrlValeursDown, '<img src="images/tri.png" alt="" />', 'divActualites', 'triDown').'</div></th>' . " \n";
		if(isset($_GET['p'])) { 
			$arrayUrlVarsUp = array('tri', 'direction', 'p'); 
			$arrayUrlValeursUp = array('titre', 'ASC', $_GET['p']); 
			$arrayUrlVarsDown = array('tri', 'direction', 'p'); 
			$arrayUrlValeursDown = array('titre', 'DESC', $_GET['p']); 
		} 
		else { 
			$arrayUrlVarsUp = array('tri', 'direction'); 
			$arrayUrlValeursUp = array('titre', 'ASC'); 
			$arrayUrlVarsDown = array('tri', 'direction'); 
			$arrayUrlValeursDown = array('titre', 'DESC'); 
		} 
		$html .= '<th class="titre"><div class="tri">titre' . utils::lienAjax('inc/afficherActualites.php', $arrayUrlVarsUp, $arrayUrlValeursUp, '<img src="images/tri.png" alt="" />', 'divActualites', 'triUp'). utils::lienAjax('inc/afficherActualites.php', $arrayUrlVarsDown, $arrayUrlValeursDown, '<img src="images/tri.png" alt="" />', 'divActualites', 'triDown').'</div></th>' . " \n"; 
		$html .= '<th class="titre">introduction</th>' . " \n"; 
		if(isset($_GET['p'])) { 
			$arrayUrlVarsUp = array('tri', 'direction', 'p'); 
			$arrayUrlValeursUp = array('actif', 'ASC', $_GET['p']); 
			$arrayUrlVarsDown = array('tri', 'direction', 'p'); 
			$arrayUrlValeursDown = array('actif', 'DESC', $_GET['p']); 
		} 
		else { 
			$arrayUrlVarsUp = array('tri', 'direction'); 
			$arrayUrlValeursUp = array('actif', 'ASC'); 
			$arrayUrlVarsDown = array('tri', 'direction'); 
			$arrayUrlValeursDown = array('actif', 'DESC'); 
		} 
		$html .= '<th class="titre"><div class="tri">actif' . utils::lienAjax('inc/afficherActualites.php', $arrayUrlVarsUp, $arrayUrlValeursUp, '<img src="images/tri.png" alt="" />', 'divActualites', 'triUp'). utils::lienAjax('inc/afficherActualites.php', $arrayUrlVarsDown, $arrayUrlValeursDown, '<img src="images/tri.png" alt="" />', 'divActualites', 'triDown').'</div></th>' . " \n"; 
		$html .= '<th class="titre">afficher</th>' . " \n"; 
		$html .= '<th class="titre">modifier</th>' . " \n"; 
		$html .= '<th class="titre">supprimer</th>' . " \n"; 
		$html .= '</tr>' . " \n"; 
		$html .= '</thead>' . " \n"; 
		for($i=0; $i<$this->nbreActualites; $i++) { 
    		if(!empty($this->actif[$i])) { 
        		$txtActif = '<img src="images/actif.png" alt="actif" />'; 
    		} 
    		else { 
        		$txtActif = '<img src="images/inactif.png" alt="inactif" />'; 
    		} 
    		if(utils::pair($i)) { 
        		$class='td1'; 
    		} 
    		else { 
        		$class='td2'; 
    		} 
			$html .= '<tr>' . " \n"; 
			$html .= '<td class="' . $class.'">' . $this->date_publication[$i] . '</td>' . " \n";
			$html .= '<td class="' . $class.'">' . $this->rubrique[$i] . '</td>' . " \n";
    		$html .= '<td class="' . $class.'">' . $this->titre[$i] . '</td>' . " \n"; 
    		$html .= '<td class="' . $class.'">' . $this->intro[$i] . '</td>' . " \n";  
    		$html .= '<td class="' . $class.'">' . $txtActif . '</td>' . " \n";
			$actu_ID = $this->ID[$i];
			if($this->index_page[$actu_ID] < 2) $txt_index_page = '';
			else $txt_index_page = '-p' . $this->index_page[$actu_ID];
    		$html .= '<td class="' . $class.'"><a href="../actualites' . $txt_index_page . '.html#actualite-' . $this->ID[$i] . '" title="voir sur le site (nouvelle fen&ecirc;tre)" target="_blank"><img src="images/oeil.png" alt="voir" /></a>' . '</td>' . " \n"; 
    		$html .= '<td class="' . $class.'">'.utils::lienAjax('inc/modifActualites.php', 'ID', $this->ID[$i], '<span class="icon icon-pencil"></span>modif', 'divAjax', 'btn-orange').'</td>' . " \n"; 
    		$html .= '<td class="' . $class.'">'.utils::lienAjax('inc/supprimerActualites.php', 'ID', $this->ID[$i], '<span class="icon icon-remove"></span>suppr', 'divAjax', 'btn-red').'</td>' . " \n"; 
    		$html .= '</tr>' . " \n"; 
		} 
		$html .= '</table>' . " \n"; 
		echo $html; 
		echo $this->paginationHtml;	
	}
	
	private function construireTableauFiltres($champs, $tables, $typesChamps, $titresChamps, $formAction) 
	{ 
		$nbreChamps = count($champs); 
		$tables_string = implode(', ', $tables); 
		$echo = false; 
		$retour = '<form action="' . $formAction . '" method="post">' . " \n"; 
		$retour .= '<table id="tableauFiltres">' . " \n"; 
		$retour .= '<thead>'; 
		$retour .= '<tr><th colspan="' . $nbreChamps . '"><span id="filtrerTxt">FILTRER</span></th></tr>'; 
		$retour .= '</thead>'; 
		$retour .= '<tr>'; 
		for($i=0; $i<$nbreChamps; $i++) { 
			$qryFiltresTableauFiltres = $this->recupererQryFiltres($champs, '', $champs[$i]); 

			/*==================================================================================================================== 
						on récupère tous les filtres, sauf celui du champ en cours (on filtre la liste déroulante en fonction des autres champs, 
						mais pas du champ lui-même. ex : si une catégorie est choisie, on les affiche quand même toutes dans la liste. 
					====================================================================================================================== */ 

			if(empty($qryFiltresTableauFiltres)) $transision = ' WHERE '; 
			else $transision = ' AND '; 
			$qry = "SET NAMES 'utf8'"; 
			$db = new MySQL(); 
			$db->Open(); 
			$db->query($qry);  
			$champsTitres = array(); 
			$champsValeurs = array(); 
			$qry = 'SELECT DISTINCT ' . $champs[$i] . ' FROM ' . $tables_string . $qryFiltresTableauFiltres; 
			$db = new MySQL(); 
			$db->Open(); 
			$db->query($qry);	 
			$nbreValeurs = $db->RowCount(); 
			if(!empty($nbreValeurs)) { // SI LA REQUETE N'EST PAS VIDE 
				$form = new form('filtresActualites'); 
				$retour .= '<td>' . " \n"; 
				while (! $db->EndOfSeek()) { 
					$row = $db->Row(); 
					if($champs[$i] == 'scID') {  
						$champsTitres[] = $row->nom;  
						$champsValeurs[] = $row->$champs[$i];  
					}  
					else { 
						$champ_var = $champs[$i]; 
						foreach($tables AS $table) { 
							$champ_var = preg_replace('`' . $table . '.`', '', $champ_var); 
						} 
						$champsTitres[] = $row->$champ_var; 
						$champsValeurs[] = $row->$champ_var; 
					} 
				} 
				array_multisort($champsValeurs, $champsTitres); 
				$nomFiltre = 'actualitesFiltre' . preg_replace('`\.`', '_', $champs[$i]); 
				for($j=-1; $j<$nbreValeurs; $j++) { 
					if($j == -1) $form->addOption($nomFiltre, 'tout', 'tout afficher'); 
					else if($typesChamps[$i] == 'texte') { 
						$form->addOption($nomFiltre, $champsValeurs[$j], $champsTitres[$j]); 
					} 
				} 
				if($typesChamps[$i] == 'booleen') {  
					if(in_array('1', $champsValeurs)) $form->addOption($nomFiltre, '1', 'oui');  
					if(in_array('0', $champsValeurs)) $form->addOption($nomFiltre, '0', 'non');  
				}  
				$form->addSelect($nomFiltre, $titresChamps[$i].' : '); 
				$retour .= $form->html; 
				$retour .= '</td>' . " \n"; 
			} 
		} 
		$retour .= '</tr>'; 
		$retour .= '<tr>'; 
		$retour .= '<td class="btnTd" colspan="' . $nbreChamps . '"><table class="centre"><tr><td><button class="btn-green" value="submitFiltres" type="submit"><span class="icon icon-filter"></span>filtrer</button></td><td><button class="btn-orange" name="annulerFiltres" value="annulerFiltres" type="submit"><span class="icon icon-cancel-round"></span>annuler tous les filtres</button></td></tr></table></td>' . " \n";
		$retour .= '</tr>'; 
		$retour .= '</table>'; 
		$retour .= '</form>' . " \n"; 
		return $retour; 
	}
	
	private function recupererQryFiltres($champs, $colonnesIndex, $champTableauFiltres = '')  
	{ 
		$qryFiltres = ''; 
		if(isset($_POST['annulerFiltres'])) { 
			foreach($champs AS $champs) { 
				$champPoste = 'actualitesFiltre' . preg_replace('`\.`', '_', $champs); 
				unset($_SESSION[$champPoste]); 
			} 
			$_SESSION['colonnesSurlignees'] = ''; 
			return $qryFiltres; 
		} 
		else { 
			$colonnesSurlignees = ''; 
			$i = 0; 
			foreach($champs AS $champs) { 
				$champPoste = 'actualitesFiltre' . preg_replace('`\.`', '_', $champs); 
				if(isset($_POST[$champPoste])) { 
					if($_POST[$champPoste] == 'tout') $_SESSION[$champPoste] = 'tout'; 
					else $_SESSION[$champPoste] = $_POST[$champPoste]; 
					$_SESSION[$champPoste] = $_POST[$champPoste]; 
				} 
				else if(!isset($_SESSION[$champPoste])) $_SESSION[$champPoste] = 'tout'; 
				if($_SESSION[$champPoste] != 'tout' && $champs != $champTableauFiltres) { 
					if(!isset($transition)) $transition = ' WHERE '; 
					else $transition = ' AND ';  
					$qryFiltres .= $transition . $champs . ' = ' . '\'' . $_SESSION[$champPoste] . '\''; 
					if(empty($champTableauFiltres)) $colonnesSurlignees[] = $colonnesIndex[$i]; 
				} 
				$i++; 
			} 
			if(empty($champTableauFiltres)) $_SESSION['colonnesSurlignees'] = $colonnesSurlignees; 
			return $qryFiltres; 
		} 
	}
	
	private function recupererTri() 
	{
		if(isset($_GET['tri'])) $_SESSION['triActualites'] = ' '.$_GET['tri'];
		else if(!isset($_SESSION['triActualites'])) $_SESSION['triActualites'] = ' ID';
		if(isset($_GET['direction'])) $_SESSION['directionActualites'] = ' '.$_GET['direction'];
		else if(!isset($_SESSION['directionActualites'])) $_SESSION['directionActualites'] = ' DESC';
		return $_SESSION['triActualites'].$_SESSION['directionActualites'];
	} 
}
?> 