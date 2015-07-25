<?php
class BDD
{
    public $reponse = array();
    private $result;

    function __autoload()
    {
        @include_once("../../class/mysql.php");
        @include_once("../class/mysql.php");
    }

    function testPost()
    {
        if(isset($_POST['formAjoutActualites'])) {
        $this->result = 'ajoutActualite';
        }
        else if(isset($_POST['formModifActualites'])) {
            $this->result = 'modifActualite';
        }
        else if(isset($_POST['formSupprActualites'])) {
            $this->result = 'supprimerActualite';
        }
		else if(isset($_POST['formAjoutOffres_emploi'])) {
            $this->result = 'ajoutOffres_emploi';
        }
        else if(isset($_POST['formModifOffres_emploi'])) {
            $this->result = 'modifOffres_emploi';
        }
        else if(isset($_POST['formSupprOffres_emploi'])) {
            $this->result = 'supprimerOffres_emploi';
        }
    }
    function printResult()
    {
        if($this->result == 'ajoutActualite') {
			include_once('class/form.php');
            $form = new form('formAjoutActualites');
            $form->verif = "yes";
            $form->envoyerForm = 'lucky';
            $form->verifChampsVides('titre, html');
			$form->maxi('intro', 200);
            if($form->envoyerForm == 'unlucky') {
                $vars = "alerteMsg=" . $form->alerteMsg[0] . "&alerteChamp=" . $form->alerteChamp[0];
                echo "<script type=\"text/javascript\">$('#divAjax').ajax({'url' : 'inc/ajoutActualites.php', 'vars': '" . $vars . "'});</script> \n";
            }
            else {
            	$qry = "SET NAMES 'utf8'";
            	$db = new MySQL();
            	$db->Open();
            	$db->query($qry);
            	$insert['ID'] = MySQL::SQLValue('');
            	$insert['titre'] = MySQL::SQLValue($_POST['titre']);
		$insert['rubrique'] = MySQL::SQLValue($_POST['rubrique']);
            	$insert['intro'] = MySQL::SQLValue($_POST['intro']);
            	$insert['html'] = MySQL::SQLValue($_POST['html']);
                $insert['video'] = MySQL::SQLValue($_POST['video']);
                
            	//$insert['date_publication'] = 'NOW()';
                if($_POST['date_publication']<>''):
                    $date = DateTime::createFromFormat('d-m-Y', $_POST['date_publication']);
                    $date_publication = $date->format('Y-m-d H:i:s');
                    /*$a_date=explode('-',$_POST['date_publication']);
                    $date_publication = $a_date[2]."-".$a_date[1]."-".$a_date[0];
                    $date_publication .= ' '.date('H:i:s');*/
                else:

                    $date_publication = date('Y-m-d H:i:s');

                endif;
                $insert['date_publication'] = MySQL::SQLValue($date_publication);
            	$insert['actif'] = MySQL::SQLValue($_POST['actif']);
            	$db = new MySQL();
            	$db->Open();
                $divID = 'result';
                if (!$db->InsertRow("actualites", $insert)) {
                    echo '<script type="text/javascript">printEchecMiseAJour(\'' . $divID . '\');</script>';
                }
                else echo '<script type="text/javascript">printModificationsOK(\'' . $divID . '\');</script>';
            }
		}
        else if($this->result == 'modifActualite') {
			include_once('class/form.php');
            $form = new form('formModifActualites');
            $form->verif = "yes";
            $form->envoyerForm = 'lucky';
            $form->verifChampsVides('titre, html');
			$form->maxi('intro', 150);
            if($form->envoyerForm == 'unlucky') {
                $vars = "ID=" . $_POST['ID'] . "&alerteMsg=" . $form->alerteMsg[0] . "&alerteChamp=" . $form->alerteChamp[0];
                echo "<script type=\"text/javascript\">$('#divAjax').ajax({'url' : 'inc/modifActualites.php', 'vars': '" . $vars . "'});</script> \n";
            }
            else {

                /*_______________ FORMATTAGE DES VALEURS _______________*/

             	$filter["ID"] = MySQL::SQLValue($_POST['ID']);
            	$update['titre'] = MySQL::SQLValue($_POST['titre']);
		$update['rubrique'] = MySQL::SQLValue($_POST['rubrique']);
            	$update['intro'] = MySQL::SQLValue($_POST['intro']);
            	$update['html'] = MySQL::SQLValue($_POST['html']);
                $update['video'] = MySQL::SQLValue($_POST['video']);
                $date_publication = $_POST['date_publication'];
                if($date_publication <> ''):
                    $date = DateTime::createFromFormat('d-m-Y', $date_publication);
                    $date_publication = $date->format('Y-m-d H:i:s');
                    /*$a_date=explode('-',$_POST['date_publication']);
                    $date_publication = $a_date[2]."-".$a_date[1]."-".$a_date[0];
                    $date_publication .= ' '.date('H:i:s');*/
                else:
                    $date_publication = date("Y-m-d H:i:s");
                endif;
                $update['date_publication'] = MySQL::SQLValue($date_publication);
            	$update['actif'] = MySQL::SQLValue($_POST['actif']);
				$qry = "SET NAMES 'utf8'";
				$db = new MySQL();
				$db->Open();
				$db->query($qry);
            	$db = new MySQL();
				$db->Open();
            	$divID = 'result';
            	if (!$db->UpdateRows("actualites", $update, $filter)) {
            		echo '<script type="text/javascript">printEchecMiseAJour(\'' . $divID . '\');</script>';
            	}
            	else echo '<script type="text/javascript">printModificationsOK(\'' . $divID . '\');</script>';
            }
		}
        else if($this->result == 'supprimerActualite') {
			if($_POST['supprimerActualites'] > 0) {
				$filter['ID'] = $_POST['actualitesID'];
				$db = new MySQL();
				$db->Open();
				$divID = 'result';
				if (!$db->DeleteRows("actualites", $filter)) {
					echo '<script type="text/javascript">printEchecMiseAJour(\'' . $divID . '\');</script>';
				}
				else echo '<script type="text/javascript">printModificationsOK(\'' . $divID . '\');</script>';
			}
		}
		else if($this->result == 'ajoutOffres_emploi') {
			include_once('class/form.php');
            $form = new form('formAjoutOffres_emploi');
            $form->verif = "yes";
            $form->envoyerForm = 'lucky';
            $form->verifChampsVides('titre, html');
            if($form->envoyerForm == 'unlucky') {
                $vars = "alerteMsg=" . $form->alerteMsg[0] . "&alerteChamp=" . $form->alerteChamp[0];
                echo "<script type=\"text/javascript\">$('#divAjax').ajax({'url' : 'inc/ajoutOffres_emploi.php', 'vars': '" . $vars . "'});</script> \n";
            }
            else {
            	$qry = "SET NAMES 'utf8'";
            	$db = new MySQL();
            	$db->Open();
            	$db->query($qry);
            	$insert['ID'] = MySQL::SQLValue('');
            	$insert['titre'] = MySQL::SQLValue($_POST['titre']);
				$insert['rubrique'] = MySQL::SQLValue($_POST['rubrique']);
            	$insert['html'] = MySQL::SQLValue($_POST['html']);
            	$insert['date_publication'] = 'NOW()';
            	$insert['actif'] = MySQL::SQLValue($_POST['actif']);
            	$db = new MySQL();
            	$db->Open();
                $divID = 'result';
                if (!$db->InsertRow("offres_emploi", $insert)) {
                    echo '<script type="text/javascript">printEchecMiseAJour(\'' . $divID . '\');</script>';
                }
                else echo '<script type="text/javascript">printModificationsOK(\'' . $divID . '\');</script>';
            }
		}
        else if($this->result == 'modifOffres_emploi') {
			include_once('class/form.php');
            $form = new form('formModifOffres_emploi');
            $form->verif = "yes";
            $form->envoyerForm = 'lucky';
            $form->verifChampsVides('titre, html');
            if($form->envoyerForm == 'unlucky') {
                $vars = "ID=" . $_POST['ID'] . "&alerteMsg=" . $form->alerteMsg[0] . "&alerteChamp=" . $form->alerteChamp[0];
                echo "<script type=\"text/javascript\">$('#divAjax').ajax({'url' : 'inc/modifOffres_emploi.php', 'vars': '" . $vars . "'});</script> \n";
            }
            else {

                /*_______________ FORMATTAGE DES VALEURS _______________*/

             	$filter["ID"] = MySQL::SQLValue($_POST['ID']);
            	$update['titre'] = MySQL::SQLValue($_POST['titre']);
		$update['rubrique'] = MySQL::SQLValue($_POST['rubrique']);
            	$update['html'] = MySQL::SQLValue($_POST['html']);
            	$update['actif'] = MySQL::SQLValue($_POST['actif']);
				$qry = "SET NAMES 'utf8'";
				$db = new MySQL();
				$db->Open();
				$db->query($qry);
            	$db = new MySQL();
				$db->Open();
            	$divID = 'result';
            	if (!$db->UpdateRows("offres_emploi", $update, $filter)) {
            		echo '<script type="text/javascript">printEchecMiseAJour(\'' . $divID . '\');</script>';
            	}
            	else echo '<script type="text/javascript">printModificationsOK(\'' . $divID . '\');</script>';
            }
		}
        else if($this->result == 'supprimerOffres_emploi') {
			if($_POST['supprimerOffres_emploi'] > 0) {
				$filter['ID'] = $_POST['offres_emploiID'];
				$db = new MySQL();
				$db->Open();
				$divID = 'result';
				if (!$db->DeleteRows("offres_emploi", $filter)) {
					echo '<script type="text/javascript">printEchecMiseAJour(\'' . $divID . '\');</script>';
				}
				else echo '<script type="text/javascript">printModificationsOK(\'' . $divID . '\');</script>';
			}

		}
    }
}
?>