<?php    // CLASSE A UTILISER EN EXTENSION DE mysql.php

/*
$db = new pagination();
$db->Open();
$query_rs_pagination = "FROM liens WHERE nomAnnu = '$nomAnnu' AND rubriqueID = '$rubriqueID' AND actif='1'"; 
$adresse = 'rubrique.php?ID='.$_GET['ID'];
$this->pagination = $db->pagine($query_rs_pagination,1,"p",$adresse);
                
while (! $db->EndOfSeek()) {
    $row = $db->Row();
    $this->lienTitre[] = $row->lienTitre;
    $this->lienDescription[] = $row->lienDescription;
    $this->lienUrl[] = $row->lienUrl;
    $this->hits[] = $row->hits;
    $this->PR[] = $row->PR;            
}
*/


class pagination extends MySQL
{
    public $pagine;
    
    function pagine($debutQry
	, $query_rs_pagination    // Elément commun de requête : "FROM..." auquel sera ajouté le "LIMIT..."
    , $mpp    // Nombre max de lignes par page
    , $query    // Elément de querystring indiquant le n° de page
    , $url    // URL de la page
    , $long = 5    // Nombre max de pages avant et après la page courante
    )
    {    // Pour construire les liens, regarde si $url contient déjà un ?
        $t = '-';    // Nombre total d'enregistrements retournés
        $sql = $debutQry . $query_rs_pagination;    //$rs_pagination = mysql_query($sql);
        $rs_pagination = parent:: Query($sql); // echo $sql;
        if(!empty($rs_pagination)) {
            $nbres = mysql_num_rows($rs_pagination);
            $_SESSION['result_rs'] = $nbres;    // Calcul du nombre de pages
            $nbpage = ceil($nbres/$mpp);    // La page courante est
            $p = @$_GET[$query];
            if(!$p) $p = 1;
            if($p>$nbpage) $p = $nbpage;    // Longueur de la liste de pages
            $deb = max(1, $p-$long);
            $fin = min($nbpage, $p+$long);    // Construction de la liste de pages
            $this->pagine = "";
            if($nbpage>1) {
                for($i = $deb; $i<=$fin; $i++) {    // Page courante ?
                    if($i == $p) $this->pagine .= '<li class="active"><span>' . $i . '</span></li>';    // Page 1 > lien sans query
                    else if($i == 1) $this->pagine .= '<li><a href="' . $url . '.html">' . $i . '</a></li>';    // Autre page -> lien avec query
                    else $this->pagine .= '<li><a href="' . $url . $t . $query . $i . '.html">' . $i . '</a></li>';
                }
                //if($this->pagine) $this->pagine = '<td>page</td>' . $this->pagine;    // Premier, précédent
                if($this->pagine && ($p > 1)) {
                    if($p == 2) $this->pagine = '<li><a href="' . $url . '.html"><span class="icon-angle-left"></span>Pr&eacute;c&eacute;dent</a></a></li>' . $this->pagine;    //PRECEDENT
                    else $this->pagine = '<li><a href="' . $url . $t . $query . ($p-1)  . '.html"><span class="icon-angle-left"></span>Pr&eacute;c&eacute;dent</a></li>' . $this->pagine;    //PRECEDENT
                    if($p>1) $this->pagine = '<li><a href="' . $url . '.html"><span class="icon-double-angle-left"></span>Premier</a></li>' . $this->pagine;    //PREMIER
                }    // Suivant, dernier
                if($this->pagine && ($p<$nbpage)) {
                    $this->pagine .= '<li><a href="' . $url . $t . $query . ($p+1)  . '.html">Suivant<span class="icon-angle-right"></span></a></li>';    //SUIVANT
                    if($p<$nbpage) $this->pagine .= '<li><a href="' . $url . $t . $query . ($nbpage)  . '.html">Dernier<span class="icon-double-angle-right"></span></a></li>';    //FIN
                }    // Modification de la requête
                $suppr = 'LIMIT';
                $cherche = strstr($sql, $suppr);
                $sql = str_replace($cherche, "", $sql);    // si vide on supprime la clause "LIMIT"
                $sql .= ' LIMIT ' . (($p-1) *$mpp)  . ',' . $mpp;
                $rs_pagination = parent:: Query($sql);    // nouveau jeu d'enregistrements avec la clause LIMIT
                $nbrePageActu = mysql_num_rows($rs_pagination);    // affichage 'résultats n à m sur x    // départ = $depart    //fin = $fin    // total = $nbres
                $depart = $mpp*($p-1) +1;    // nbre par page x page actuelle.
                $fin = $depart+$nbrePageActu-1;
                $this->resultats = '<div id="resultatsPagination"><p>r&eacute;sultats ' . $depart . ' &agrave; ' . $fin . ' sur ' . $nbres . '</p></div>' . " \n";
			}
            else {    //s'il n'y a qu'une seule page
                $this->pagine .= '' . " \n";
                $this->resultats = '';
            }
			$htmlPagination = $this->resultats;
			$htmlPagination .= '<div class="pagination pagination-centered">' . " \n";
            $htmlPagination .= '<ul>' . " \n";
			$htmlPagination .= $this->pagine . " \n";
            $htmlPagination .= '</ul>' . " \n";
			$htmlPagination .= '</div>' . " \n";
            return $htmlPagination;
        }
    }
}
?>