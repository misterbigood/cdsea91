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
    
    function pagine($query_rs_pagination    // Elément commun de requête : "FROM..." auquel sera ajouté le "LIMIT..."
    , $mpp    // Nombre max de lignes par page
    , $query    // Elément de querystring indiquant le n° de page
    , $url    // URL de la page
    , $long = 5, $debutQry = "SELECT * "    // Nombre max de pages avant et après la page courante
    )
    {    // Pour construire les liens, regarde si $url contient déjà un ?
        $t = ( strpos($url, "?")) ?"&amp;":
        "?";    // Nombre total d'enregistrements retournés
        $sql = $debutQry . $query_rs_pagination;    // echo $sql . '<br />';    //$rs_pagination = mysql_query($sql);
        $rs_pagination = parent:: Query($sql);
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
                    if($i == $p) $this->pagine .= "<td><span class=\"souligne\">" . $i . "</span></td>";    // Page 1 > lien sans query
                    else if($i == 1) $this->pagine .= "<td><a href='" . $url . "'>" . $i . "</a></td>";    // Autre page -> lien avec query
                    else $this->pagine .= "<td><a href='" . $url . $t . $query . "=" . $i . "'>" . $i . "</a></td>";
                }
                if($this->pagine) $this->pagine = "<td>Page </td>" . $this->pagine;    // Premier, précédent
                if($this->pagine && ($p>1)) {
                    if($p == 2) $this->pagine = "<td id=\"prec\"><a href='" . $url . "'><img src=\"images/nav/prev.gif\" alt=\"precedent\" /></a></td>" . $this->pagine;    //PRECEDENT
                    else $this->pagine = "<td id=\"prec\"><a href='" . $url . $t . $query . "=" . ($p-1)  . "'><img src=\"images/nav/prev.gif\" alt=\"precedent\" /></a></td>" . $this->pagine;    //PRECEDENT
                    if($p>1) $this->pagine = "<td id=\"first\"><a href='" . $url . "'><img src=\"images/nav/first.gif\" alt=\"premier\" /></a></td>" . $this->pagine;    //PREMIER
                }    // Suivant, dernier
                if($this->pagine && ($p<$nbpage)) {
                    $this->pagine .= "<td id=\"next\"><a href='" . $url . $t . $query . "=" . ($p+1)  . "'><img src=\"images/nav/next.gif\" alt=\"suivant\" /></a></td>";    //SUIVANT
                    if($p<$nbpage) $this->pagine .= "<td id=\"last\"><a href='" . $url . $t . $query . "=" . ($nbpage)  . "'><img src=\"images/nav/last.gif\" alt=\"dernier\" /></a></td>";    //FIN
                }    // Modification de la requête
                $suppr = "LIMIT";
                $cherche = strstr($sql, $suppr);
                $sql = str_replace($cherche, "", $sql);    //si vide on supprime la clause "LIMIT"
                $sql .= " LIMIT " . (($p-1) *$mpp)  . "," . $mpp;
                $rs_pagination = parent:: Query($sql);    // nouveau jeu d'enregistrements avec la clause LIMIT
            }
            else {    //s'il n'y a qu'une seule page
                $this->pagine .= "<td>&nbsp;</td> \n";
            }
            return "<table id=\"pagination\"> \n<tr>" . $this->pagine . "</tr></table>";
        }
    }
}
?> 