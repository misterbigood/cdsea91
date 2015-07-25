<?php

class utils
{
	function lienAjax($adresse, $var, $valeur, $txt, $divID, $class = '', $options = '', $valeursOptions = '')
    {

		/* =============================================
		$var, $valeur = valeurs passées en GET (string OU array)
		$options, $valeursOptions = options functtion ajax (string OU array)

		ex : echo utils::lienAjax(URL . 'inc/login.php', '', '', 'identifiez-vous', 'divAjax', '', 'btnFermer', true);

		ex :
		$vars = array('var1', 'var2');
		$valeurs = array('valeurs1', 'valeurs2');
		echo utils::lienAjax(URL . 'inc/login.php', $vars, $valeurs, 'txt_du_lien', 'divAjax');

  		============================================= */

        if(empty($divID)) $divID = 'divAjax';
		$txtClass = '';
        if(!empty($class)) $txtClass = ' class="' . $class . '"';
		$variables = '';
        if(is_array($var)) {    // SI PLUSIEURS VARIABLES PASSEES EN ARRAY
            $nbre = count($var);
			$variables =  ", 'vars' : '" . $var[0] . "=" . addslashes($valeur[0]);
            for($i = 1; $i<$nbre; $i++) {
                $variables .= "&" . $var[$i] . "=" . addslashes($valeur[$i]);
            }
			$variables .= "'";
        }
		else if(!empty($var)) $variables = ", 'vars' : '" . $var . "=" . $valeur . "'"; // SI 1 VARIABLE PASSEE EN STRING
		$txtOptions = '';
		if(is_array($options)) {    // SI PLUSIEURS VARIABLES PASSEES EN ARRAY
			$txtOptions = ', ' . $options[0] . " : " . "'" . addslashes($valeursOptions[0]) . "'";
			$nbre = count($options);
			for($i = 0; $i<$nbre; $i++) {
				$txtOptions .= ', ' . $options[$i] . " :" . "'" . $valeursOptions[$i] . "'";
			}
		}
		else if(!empty($options)) $txtOptions = ', ' . $options . " : " . "'" . addslashes($valeursOptions) . "'"; // SI 1 OPTION PASSEE EN STRING
		$txt = '<a href="#"' . $txtClass . " onclick=\"$('#" . $divID . "').ajax({'url' : '" . $adresse . "'" . $variables . $txtOptions . "}); return false;\">" . $txt . "</a>";
        return $txt;
    }

	function printTableUneColonnes($tab, $tableId = '', $tableClass = '')
    {
        $i = 0;
        $print = "<table";
        if(!empty($tableId)) $print .= ' id="' . $tableId . '"';
        if(!empty($tableClass)) $print .= ' class="' . $tableClass . '"';
        $print .= "> \n";
        foreach($tab as $tab) {
            $print .= "<tr> \n";
            $print .= "<td>" . $tab . "</td> \n";
            $print .= "</tr> \n";
            $i++;
        }
        $print .= "</table> \n";
        print$print;
    }

    function printTableDeuxColonnes($tab, $tableId = '', $tableClass = '')
    {
        $i = 0;
        $print = "<table";
        if(!empty($tableId)) $print .= ' id="' . $tableId . '"';
        if(!empty($tableClass)) $print .= ' class="' . $tableClass . '"';
        $print .= "> \n";
        foreach($tab as $tab) {
            if( utils:: pair($i)) {    // TRUE si $i est est pair
                $print .= "<tr> \n";
            }
            $print .= "<td>" . $tab . "</td> \n";
            if(! utils:: pair($i)) {    //  FALSE si $i ou $i+2 est pair
                $print .= "</tr> \n";
            }
            $i++;
        }
        if(! utils:: pair($i)) {    // FERME LA DERNIERE LIGNE SI LE NBRE DE BTNS EST IMPAIR
            $print .= "</tr> \n";
        }
        $print .= "</table> \n";
        print$print;
    }

	function printTableTroisColonnes($tab, $tableId = '', $tableClass = '')
    {
        $i = 0;
        $print = "<table";
        if(!empty($tableId)) $print .= ' id="' . $tableId . '"';
        if(!empty($tableClass)) $print .= ' class="' . $tableClass . '"';
        $print .= "> \n";
        foreach($tab as $tab) {
            if( utils:: multipleTrois($i)) {    // TRUE si $i est est multiple de 3
                $print .= "<tr> \n";
            }
            $print .= "<td>" . $tab . "</td> \n";
            if(! utils:: multipleTrois($i) AND ! utils:: multipleTrois($i+2)) {    //  FALSE si $i ou $i+2 est multiple de 3
                $print .= "</tr> \n";
            }
            $i++;
        }
        if(! utils:: multipleTrois($i)) {    // FERME LA DERNIERE LIGNE SI LE NBRE DE BTNS EST IMPAIR
            $print .= "</tr> \n";
        }
        $print .= "</table> \n";
        print$print;
    }

	function formaterNombre($nbre)
	{
		$nbre = number_format($nbre, 2, '.', ' ');
		return $nbre;
	}

	function pair($nb)
	{
		$calcul = (round($nb / 2) - ($nb / 2));
		if($calcul == "0") return TRUE; // $nb est pair
		else return FALSE; // $nb n'est pas impair
	}

	function multiple($i, $nb)
	{
		$calcul = (round($i / $nb) - ($i / $nb));
		if($calcul == "0") return TRUE; // $i est multiple de $nb
		else return FALSE; // $i n'est pas multiple de $nb
	}

	function dateUsToFr($date)
	{
        sscanf($date, "%4s-%2s-%2s", $y, $mo, $d);
        return $d.'-'.$mo.'-'.$y;
	}

	function makeUrlVar($var)
	{
        $ancienNom = trim($var);
        $charset = 'utf-8';
        $nouveauNom = htmlentities($ancienNom, ENT_NOQUOTES, $charset);
        $nouveauNom = preg_replace('#\&([A-za-z])(?:acute|cedil|circ|grave|ring|tilde|uml)\;#', '\1', $nouveauNom);
        $nouveauNom = preg_replace('#\&([A-za-z]{2})(?:lig)\;#', '\1', $nouveauNom);    // pour les ligatures e.g. '&oelig;'
        $nouveauNom = preg_replace('#\&[^;]+\;#', '', $nouveauNom);    // supprime les autres caractères
        $nouveauNom = preg_replace('`[ &~"#{( \'\[|\\^@)\]=}$¤*µ%,;:!?/§.]+`', '-', $nouveauNom);
		while(preg_match('`--`', $nouveauNom)) {
			$nouveauNom = preg_replace('`--`', '-', $nouveauNom);
		}
		$nouveauNom = strtolower($nouveauNom);
        return $nouveauNom;
    }

	function formaterNom($var) // pour les fichiers, conserve le point de l'extension
	{
        $ancienNom = trim($var);
        $charset = 'utf-8';
        $nouveauNom = htmlentities($ancienNom, ENT_NOQUOTES, $charset);
        $nouveauNom = preg_replace('#\&([A-za-z])(?:acute|cedil|circ|grave|ring|tilde|uml)\;#', '\1', $nouveauNom);
        $nouveauNom = preg_replace('#\&([A-za-z]{2})(?:lig)\;#', '\1', $nouveauNom);    // pour les ligatures e.g. '&oelig;'
        $nouveauNom = preg_replace('#\&[^;]+\;#', '', $nouveauNom);    // supprime les autres caractères
        $nouveauNom = preg_replace('`[ &~"#{( \'\[|\\^@)\]=}$¤*µ%,;:!?/§]+`', '-', $nouveauNom);
		while(preg_match('`--`', $nouveauNom)) {
			$nouveauNom = preg_replace('`--`', '-', $nouveauNom);
		}
		$nouveauNom = strtolower($nouveauNom);
        return $nouveauNom;
    }

	function hexaEncode($chaine) // encodage adresses emails
	{
		$longueur=strlen($chaine);
		$retour = '';
	  	for($i=0;$i<$longueur;$i++) {
	  		$retour .= '&#x' . bin2hex(substr($chaine,$i,1)) . ';';
		}
		return $retour;
	}

	function remplacerAccents($str, $charset='utf-8')
	{
		$str = htmlentities($str, ENT_NOQUOTES, $charset);
		$str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
		$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
		$str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

		return $str;
	}

	function tronquerChaine($chaine, $nbreDeCaracteres)
	{
		if(count($chaine) <= $nbreDeCaracteres) return $chaine;
		$texte = wordwrap($chaine, $nbreDeCaracteres, ' coupure ');//on ajoute le mot 'coupure' après le dernier mot inclus jusqu'à n caractères,
		$pos = strpos($texte, ' coupure');//on récupère la position du mot 'coupure'
		$texte = substr($texte,0 ,$pos);//on coupe ce qui est après
		return $texte;
	}

	function dateTimeToDate($dateTime)
    {
        $retour = preg_replace('/([0-9]{4}-[0-9]{2}-[0-9]{2}) [0-9]{2}:[0-9]{2}:[0-9]{2}/', '$1', $dateTime);
        return $retour;
    }

    function dateTimeToTime($dateTime)
    {
        $retour = preg_replace('/[0-9]{4}-[0-9]{2}-[0-9]{2} ([0-9]{2}:[0-9]{2}:[0-9]{2})/', '$1', $dateTime);
        return $retour;
    }

    function dansUnAn()
    {
        $format = 'Y-m-d';
        $aujourdhui = date($format);
        $tab = explode('-', $aujourdhui);
        $tab[0] = $tab[0]+1;
        $dansUnAn = $tab[0] . '-' . $tab[1] . '-' . $tab[2];
        return $dansUnAn;
    }

    function traduireMois($numero)
    {    // pour les répertoires des factures, pas de multilingue
        $tabMois = array(1 => 'janvier', 2 => 'fevrier', 3 => 'mars', 4 => 'avril', 5 => 'mai', 6 => 'juin', 7 => 'juillet', 8 => 'aout', 9 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'decembre');
        return $tabMois[(int)$numero]; // (int) supprime les zéros initiaux
    }

	function selectNbreParPage($numbersArray, $selectedNumber, $titre = 'articles')
	{
		$html = '<span id="npp">' . " \n";
		$html .= '<label>nbre par page : </label>' . " \n";
		$html .= '<select id="nppSelect">' . " \n";
		foreach($numbersArray as $number) {
			$selectedText = '';
			if($number == $selectedNumber) $selectedText = ' selected="selected"';
			$html .= '<option value="' . $number . '"' . $selectedText . '>' . $number . '</option>' . " \n";
		}
		$html .= '</select>' . " \n";
		$html .= '</span>' . " \n";
		return $html;
	}
}
?>