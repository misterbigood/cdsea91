<?php

/*
   #############################################
   EXEMPLE D'UTILISATION -PAGE FORMULAIRE
   #############################################

   <?php
   session_start();
   include_once('class/form.php');
   $form = new form($formID);
   $form->setAction('$page'); // si l'action n'est pas définie, le form envoie sur lui-même ($_SERVER['PHP_SELF'])

   if($form->verif == "yes" and $form->envoyerForm == 'lucky') {

   }

   ----------------------

   UNE SEULE COLONNE

   $form->uneColonne = true; // insère un <br> entre chaque legend / input

   ----------------------

   VERIFICATIONS

   $form->verifChampsVides('nom, prenom, msg');
   $form->verifMail('email');
   $form->verifNumero('tel');
   $form->verifAlphanum('nomAnnu');
   $form->mini('nomAnnu', '4');
   $form->maxi('nomAnnu', '15');
   $form->verifCaptcha();
   $form->posterSiOk("postMail.php");

   ----------------------

   FIELDSET

   $form->startFieldset('legend'); // légende optionnelle
   $form->...
   $form->endFieldset();

   ----------------------

   INPUT, TEXTAREA, FILE

   $form->addInput('type', 'name', 'value', 'label', 'size=30, id=id');
   $form->addInput('type', 'name', 'value', 'label', 'size=30, id=id, placeholder=votre texte ici, required=required');
   $form->addInput('password', 'pass', '', 'Mot de passe : ', 'size=30, required=required, pattern=(.){7\,15}');
   $form->addTextarea('msg', 'contenu affiché', 'message : ', 'cols=30, rows=4');
   $form->addFile($name, $label);

    ----------------------

	SELECT

   	$form->addOption('materiau', '', 'sélectionnez ...', '', 'disabled=disabled');

    $form->addOption($selectName, $value, $txt, $groupName = '');
	$form->addSelect($name, $label, $attributs = '', $displayGroupLabels = true);

	----------------------

	RADIO

	$form->addRadioBtn($groupName, $label, $value);
	$form->printRadioGroup($groupName, $titre, $nbreParLigne = 2);
	Pour cocher : $_SESSION[$groupName] = $value;

	----------------------

	CHECKBOX

    $form->addCheckbox($groupName, $label, $value);
    $form->printCheckboxGroup($groupName, $titre, $nbreParLigne = 2);
	Pour cocher : $_SESSION[$value] = 1;

	----------------------

	RESET, CANCEL, SUBMIT

	$form->addBtnEffacer($value, $class, $js);
	$form->addBtnAnnuler($value, $class, $js);
	$form->addSubmit('valider', 'btn');

	----------------------

	TXT EN FIN DE FORMULAIRE

	$this->txt = '<p class="small"><span class="alerte">*</span> Champs obligatoires</p>

	----------------------

	CAPTCHA

   $form->addCaptcha("class/captcha.php", '50'); //($classCaptchaAdress, $inputSize);
   $form->addAccessibiliteText('texte', 'adresseMail', 'imageArobase');

   CAPTCHA OPTIONS FACULTATIVES

   $form->captchaFonts = array('class/captcha/fonts/CONSTAN.TTF', 'class/captcha/fonts/gothic.ttf');
   $form->captchaWidth = 170; // defaut 170 max 500
   $form->captchaHeight = 40; // defaut 40 max 200
   $form->captchaBackgroundImage = ;
   $form->captchaUseColour = true;
   $form->captchaDisplayShadow = true;
   $form->captchaSetNumLines = 10;
   $form->captchaMinFontSize = 14;
   $form->captchaMaxFontSize = 22;
   ?>

*/


class form
{
    public $action = '';
	public $accessibiliteText;
	public $ajouterVariablesGet;
	public $alerteChamp = array();    //Tableau contenant les messages des alertes trouvées
    public $alerteMsg = array();
	public $btnEffacer = '';
    public $btnAnnuler = '';
	public $captcha;
    public $checkbox = array();
	public $envoyerForm;
    public $formID = '';
	public $groupName = array();
    public $hasFile = false;
	public $hidden = '';
    public $html;
	public $indexFieldset = 0;
	public $optiongroupID = array();
    public $option = array();
    public $printSubmit;
	public $endFieldsetFinForm;
    public $radio = array();
    public $txt;
    public $uneColonne = false;
	public $verif = false;

	/*=================================

       crée des tableaux d'alerte,
       passe automatiquement les variables postées dans la session et les sécurise

    =================================*/

    function __construct($formID)
    {
        $this->formID = $formID;
		if (isset($_POST[$formID])) {
            $this->verif = true;
        }
        if ($this->verif == true) {
            $this->envoyerForm = 'lucky';
            $this->creerVariablesSession();
        }
        if (isset($_GET['alerteChamp'])) {
            $this->alerteChamp[] = $_GET['alerteChamp'];
            $this->alerteMsg[] = $_GET['alerteMsg'];
        }
		$this->addInput('hidden', $formID, true, '');
    }


    function setAction($page, $ajouterVariablesGet = true)
    {
        $this->action = $page;
        $this->ajouterVariablesGet = $ajouterVariablesGet;
    }

    function addCaptcha()
    {
        if(!isset($this->captchaFonts)) $this->captchaFonts = array('class/captcha/fonts/CONSTAN.TTF', 'class/captcha/fonts/GOTHIC.TTF');
		if(!isset($this->captchaWidth)) $this->captchaWidth = 170; // defaut 170 max 500
		if(!isset($this->captchaHeight)) $this->captchaHeight = 40; // defaut 40 max 200
		if(!isset($this->captchaBackgroundImage)) $this->captchaBackgroundImage = '';
		if(!isset($this->captchaUseColour)) $this->captchaUseColour = true;
		if(!isset($this->captchaDisplayShadow)) $this->captchaDisplayShadow = false;
		if(!isset($this->captchaSetNumLines)) $this->captchaSetNumLines = 0;
		if(!isset($this->captchaMinFontSize)) $this->captchaMinFontSize = 18;
		if(!isset($this->captchaMaxFontSize)) $this->captchaMaxFontSize = 22;

		$this->captcha[0] = "yes";

		require_once('class/captcha/captcha.php');
		$aFonts = $this->captchaFonts;

		$oVisualCaptcha = new PhpCaptcha($aFonts, $this->captchaWidth, $this->captchaHeight);

		if(!empty($this->captchaBackgroundImage)) {
			$oVisualCaptcha->SetBackgroundImages($this->captchaBackgroundImage);
		}

		$oVisualCaptcha->UseColour($this->captchaUseColour);
		$oVisualCaptcha->DisplayShadow($this->captchaDisplayShadow);
		$oVisualCaptcha->SetNumLines($this->captchaSetNumLines);
		$oVisualCaptcha->SetMinFontSize($this->captchaMinFontSize);
		$oVisualCaptcha->SetMaxFontSize($this->captchaMaxFontSize);

		$oVisualCaptcha->Create('visual-captcha.php');
		$this->captchaNom = 'visual-captcha.php';
    }

    function addAccessibiliteText($texte, $adresseMail, $imageArobase)
    {
        $remplace = '<span class="arobase"><img src="' . $imageArobase . '" alt="at" /></span>';
        $adresseMail = str_replace('@', $remplace, $adresseMail);
        $adresseMail = '<span class="adresseMail">' . $adresseMail . '</span>';
        $this->accessibiliteText .= '<p class="accessibiliteText">' . $texte . ' ' . $adresseMail . '</p>' . " \n";
    }

    private function printCaptcha()
    {
		$c = '<p>' . " \n";
		$c .= '<label></label>' . " \n";
        $c .= '<img src="' . $this->captchaNom . '" width="' . $this->captchaWidth . '" height="' . $this->captchaHeight . '" alt="Visual CAPTCHA" class="captcha" />' . " \n";
        $c .= '<br>' . " \n";
        $c .= '<label ' . $this->setClassAlerte('captcha')  . '>' . $this->setRequired('text', 'code de validation : ', 'required="required"') . '</label>' . " \n";
        $c .= '<input name="captchaCode" type="text" size="30" required="required" />' . " \n";
        $c .= '</p>' . " \n";
        return $c;
    }

    function addFile($name, $label, $attributs = '')
    {
        $this->hasFile = true;
		$this->html .= '<p class="fileConteneur">' . " \n";
		$this->html .= '<label for="' . $name . '"' . $this->setClassAlerte($name)  . '>' . $this->setRequired('file', $label, $attributs) . '</label>' . " \n";
        $this->html .= '<input id="' . $name . '" name="' . $name . '" type="file" class="uploadify">' . " \n";
        $this->html .= '</p>' . " \n";
    }

    function addInput($type, $name, $value, $label = '', $attributs = '')
    {
		$attributs = $this->recupererAttributs($attributs);
		$retour = $this->recupererID($name, $attributs); // = $name si aucun ID n'est passé en attribut
		$id = $retour['id'];
		$attributs = $retour['attributs']; // si $attributs contenait l'ID, on l'a supprimé
		if($type == 'hidden') {
			$this->hidden .= '<input name="' . $name . '" type="hidden" value="' . $value . '" ' . $attributs . '>';
		}
		else {
			$this->html .= '<p>' . " \n";
			if(!empty($label)) {
				$this->html .= '<label ' . $this->setClassAlerte($name)  . ' for="' . $id . '">' . $this->setRequired($type, $label, $attributs) . '</label>' . " \n";
				if ($this->uneColonne == true) {
					$this->html .= "<br> \n";
				}
			}
			$valeur = str_replace('"', '&quot;', $this->afficherVar($name, $value));
			$this->html .= '<input id="' . $id . '" name="' . $name . '" type="' . $type . '" value="' . $valeur . '" ' . $attributs . '>' . " \n";
			$this->html .= '</p>' . " \n";
		}
    }

    function addTextarea($name, $value, $label, $attributs = '')
    {
		$attributs = $this->recupererAttributs($attributs);
        $this->html .= '<p class="textarea">' . " \n";
		if(!empty($label)) {
			$this->html .= '<label ' . $this->setClassAlerte($name)  . ' for="' . $name . '">' . $this->setRequired('textarea', $label, $attributs) . '</label>' . " \n";
			if ($this->uneColonne == true) {
				$this->html .= "<br> \n";
			}
		}
		$valeur = str_replace('"', '&quot;', $this->afficherVar($name, $value));
        $this->html .= '<textarea name="' . $name . '" ' . $attributs . '>' . $valeur . "</textarea>";
        $this->html .= "</p> \n";
    }

	function addOption($selectName, $value, $txt, $groupName = '', $attributs = '')
    {
		$optionValues = array('value' => $value, 'txt' => $txt, 'attributs' => $attributs);
		if(!empty($groupName)) {
			$this->option[$selectName][$groupName][] = $optionValues;
			if(!isset($this->groupName[$selectName])) $this->groupName[$selectName] = array();
			if(!in_array($groupName, $this->groupName[$selectName])) {
				$this->groupName[$selectName][] = $groupName;
			}
		}
		else {
			$this->option[$selectName][] = $optionValues;
		}
    }

    function addSelect($selectName, $label, $attributs = '', $displayGroupLabels = true)
    {
		$attributs = $this->recupererAttributs($attributs);
        $this->html .= '<p>' . " \n";
		if(!empty($label)) {
        	$this->html .= '<label ' . $this->setClassAlerte($selectName)  . '>' . $this->setRequired('select', $label, $attributs) . '</label>' . " \n";
		}
		$this->html .= '<select name="' . $selectName . '" ' . $attributs . '>' . " \n";
		if (isset($this->groupName[$selectName])) {
			foreach($this->groupName[$selectName] as $groupName) {
				$nbreOptions = count($this->option[$selectName][$groupName]);
				$groupLabel = '';
				if($displayGroupLabels == true) $groupLabel = ' label="' . $groupName . '"';
				$this->html .= '<optgroup' . $groupLabel . '>' . " \n";
				for($i=0; $i<$nbreOptions; $i++) {
					$txt = $this->option[$selectName][$groupName][$i]['txt'];
                    $value = $this->option[$selectName][$groupName][$i]['value'];
					$attributs = $this->option[$selectName][$groupName][$i]['attributs'];
					$attributs = $this->recupererAttributs($attributs);
                    $this->html .= '<option value="' . $value . '"';
                    if (isset($_SESSION[$selectName]) and $_SESSION[$selectName] == $value) {
                    	$this->html .= ' selected="selected"';
                    }
                    $this->html .= ' ' . $attributs . '>' . $txt . "</option> \n";
				}
				$this->html .= '</optgroup>' . " \n";
			}
		}
		else {
			$nbreOptions = count($this->option[$selectName]);
			for($i=0; $i<$nbreOptions; $i++) {
				$txt = $this->option[$selectName][$i]['txt'];
				$value = $this->option[$selectName][$i]['value'];
				$attributs = $this->option[$selectName][$i]['attributs'];
				$attributs = $this->recupererAttributs($attributs);
				$this->html .= '<option value="' . $value . '"';
				if (isset($_SESSION[$selectName]) and $_SESSION[$selectName] == $value) {
					$this->html .= ' selected="selected"';
				}
				$this->html .= ' ' . $attributs . '>' . $txt . "</option> \n";
			}
		}
        $this->html .= "</select> \n";
        $this->html .= "</p> \n";
    }

    function addRadioBtn($groupName, $label, $value)
    {
        $this->radio[$groupName][] = array($label => $value);
    }

    function printRadioGroup($groupName, $titre, $nbreParLigne = 2)    // affiche les boutons par lignes de deux dans un tableau
    {
        $i = 0;
        $this->html .= '<div id="' . $groupName . '" class="radioCheckboxDiv">' . " \n";
		$this->html .= '<div class="labelDiv"><p' . $this->setClassAlerte($groupName)  . '>' . $titre . '</p></div>' . " \n";
		$this->html .= '<div class="radioCheckboxDivContent">' . " \n";
        while (isset($this->radio[$groupName][$i])) {
            $tab = $this->radio[$groupName][$i];
            foreach($tab as $label => $value) {
                if ($this->multiple($i, $nbreParLigne)) {    // retourne TRUE si $i est multiple de $nbreParLigne
                    $this->html .= '<p>';
                }
                $this->html .= '<input type="radio" id="' . $value . '" name="' . $groupName . '" value="' . $value . '"';
                if (isset($_SESSION[$groupName])) {
                    if ($_SESSION[$groupName] == $value) {
                        $this->html .= ' checked="checked"';
                    }
                }
                else {
                    if ($i == 0) {
                        $this->html .= ' checked="checked"';
                    }    // ON COCHE LE PREMIER BTN PAR DEFAUT
                }
                $this->html .= '><label class="radioCheckboxLabel">' . $label . '</label>' . " \n";
                if ($this->multiple($i+1, $nbreParLigne)) {
                    $this->html .= '</p>' . " \n";
                }
                $i++;
            }
        }
        if (!$this->multiple($i, $nbreParLigne)) {    // FERME LA DERNIERE LIGNE SI LE NBRE DE BTNS EST IMPAIR
            $this->html .= '</p>' . " \n";
        }
		$this->html .= '</div>' . " \n";
        $this->html .= '</div>' . " \n";
    }

    function addCheckbox($groupName, $label, $name)
    {
        $this->checkbox[$groupName][] = array($label => $name);
    }

    function printCheckboxGroup($groupName, $titre, $nbreParLigne = 2)    // affiche les cases par lignes de $nbreParLigne dans un tableau
    {
        $i = 0;
        $this->html .= '<div id="' . $groupName . '" class="radioCheckboxDiv">' . " \n";
		if(!empty($titre)) {
			$this->html .= '<div class="labelDiv"><p' . $this->setClassAlerte($groupName)  . '>' . $titre . '</p></div>' . " \n";
		}
		$this->html .= '<div class="radioCheckboxDivContent">' . " \n";
        while (isset($this->checkbox[$groupName][$i])) {
            $tab = $this->checkbox[$groupName][$i];
            foreach($tab as $label => $name) {
                if ($this->multiple($i, $nbreParLigne)) {    // retourne TRUE si $i est multiple de $nbreParLigne
                    $this->html .= '<p>';
                }
                $this->html .= '<input type="checkbox"  id="' . $groupName . $name . '" name="' . $name . '"';
                if (isset($_SESSION[$name])) {
					if ($_SESSION[$name] > 0) {
						$this->html .= ' checked="checked"';
					}
                }
                $this->html .= '><label for="' . $groupName . $name . '" class="radioCheckboxLabel">' . $label . '</label>' . " \n";
                if ($this->multiple($i+1, $nbreParLigne)) {
                    $this->html .= '</p>' . " \n";
                }
                $i++;
            }
        }
        if (!$this->multiple($i, $nbreParLigne)) {    // FERME LA DERNIERE LIGNE SI LE NBRE DE BTNS EST IMPAIR
            $this->html .= '</p>' . " \n";
        }
		$this->html .= '</div>' . " \n";
        $this->html .= '</div>' . " \n";
    }

    function addSubmit($txt, $class)
    {
        $this->printSubmit .= '<div class="btnDiv"><button type="submit" class="' . $class . '" >' . $txt . "</button></div>\n ";
    }

    function addBtnEffacer($value, $class, $js)
    {
        $this->btnEffacer .= '<div class="btnDiv"><input type="reset"';
		if (!empty($class)) {
            $this->btnEffacer .= ' class="' . $class . '"';
        }
		$this->btnEffacer .= ' value="' . $value . '" ' . $javascript . '></div>' . "\n ";
    }

    function addBtnAnnuler($value, $class, $js)
    {
        $this->btnAnnuler = '<div class="btnDiv"><button type="button"';
        if ($class != "") {
            $this->btnAnnuler .= ' class="' . $class . '" ';
        }
        $this->btnAnnuler .= $js . ">" . $value . "</button></div>\n ";
    }

	function startFieldset($legend = '')
	{
		$this->html .= '<fieldset>' . " \n";
		if(!empty($legend)) {
			$this->html .= '<legend>' . $legend . '</legend>' . " \n";
		}
		if($this->indexFieldset < 1) {
			$this->html	.= $this->afficherAlertes();
		}
		$this->indexFieldset += 1;
	}

	function endFieldset()
	{
		if(!empty($this->printSubmit)) {
			// si endFieldset en fin de formulaire
			$this->endFieldsetFinForm .= '</fieldset>' . " \n";
		}
		else $this->html .= '</fieldset>' . " \n";
	}

    function multiple($index, $nbre)
    {    // true si index est multiple de nbre    // modulo, retourne le reste de la division
        $calcul = $index%$nbre;    // $nb est un multiple
        if ($calcul == "0")
        return true;
        else
        return false;
    }

	/*=================================

       affichage

    =================================*/

	function afficher($afficherEnLigne = false)
    {
        $retour = '';
		if($this->indexFieldset < 1) { /* si fieldset, l'alerte est affichée sous le 1er. si pas de fieldset, on affiche ici */
        	$retour .= $this->afficherAlertes();
		}
        if (!empty($_SERVER['QUERY_STRING'])) {
            $get = '?' . $_SERVER['QUERY_STRING'];
        }
        if (empty($this->action)) {
            $this->action = $_SERVER['PHP_SELF'];
        }
        if ($this->btnEffacer != "") {
            $retour .= $this->btnEffacer;
        }
        $retour .= "<form ";
        if (!empty($this->formID)) {
            $retour .= 'id="' . $this->formID . '" ';
        }
        $retour .= "action=\"" . $this->action;
        if (isset($get) and $this->ajouterVariablesGet != false) {
            $retour .= $get;
        }
        $retour .= "\" method=\"post\"";
        if ($this->hasFile == true) {    // s'il y a un champ de fichier
            $retour .= " enctype=\"multipart/form-data\"";
        }
        $retour .= " > \n";
        if ($this->hidden != "") {
            $retour .= "<div>" . $this->hidden . "</div> \n";
        }
        $retour .= $this->html;
        if ($this->captcha[0] == 'yes') {
            $retour .= $this->printCaptcha();
        }
        $retour .= $this->printSubmit;
        if (!empty($this->btnAnnuler)) {
            $retour .= $this->btnAnnuler;
        }
        if (!empty($this->txt)) {
            $retour .= $this->txt;
        }
		if (!empty($this->endFieldsetFinForm)) {
            $retour .= $this->endFieldsetFinForm;
        }
        $retour .= "</form> \n";
        echo $retour;
    }

    /*=================================

       passe les variables dans la session
       securise les champs texte
       de manière à pouvoir être stockés dans une base de données.

    =================================*/

    function creerVariablesSession()
    {
        foreach($_POST as $var => $valeur)
        {
            if ($var != 'nbre') {    //EVITE DE PASSER LE NUMERO DU FORM DANS LA SESSION    // suppression des espaces
                $valeur = trim($valeur);    //$valeur = htmlentities(utf8_decode($valeur));
                $valeur = strip_tags($valeur);
                $_SESSION[$var] = $valeur;
            }
        }
    }

    /*=================================

       envoie le formulaire s'il est OK

    =================================*/

    function posterSiOk($adresse)
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            header("Location:$adresse");
        }
    }

    /*=================================

       affiche les variables de session dans les champs du formulaire

    =================================*/

    function afficherVar($var, $value)
    {
        if (!empty($value)) {
            return $value;
        }
        else if (isset($_SESSION[$var])) {
            return $_SESSION[$var];
        }
        else
        return '';
    }

    /*=================================

       affiche les alertes

    =================================*/

    function afficherAlertes()
    {
		$alerte = '';
        if ( in_array('vide', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">Merci de remplir les champs obligatoires S.V.P</p> \n";
        }
        else if ( in_array('email', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">Adresse e-mail invalide</p> \n";
        }
        else if ( in_array('numero', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">Champ num&eacute;rique invalide</p> \n";
        }
        else if ( in_array('alphanum', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">Caract&egrave;res non-autoris&eacute;s</p> \n";
        }
        else if ( in_array('mini', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">Nombre de caract&egrave;res insuffisant</p> \n";
        }
        else if ( in_array('maxi', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">Trop grand nombre de caract&egrave;res</p> \n";
        }
        else if ( in_array('nomIndisponible', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">Ce nom est d&eacute;jà utilis&eacute;<br />Merci d'en choisir un autre</p> \n";
        }
        else if ( in_array('captcha', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">code de validation (captcha) incorrect</p> \n";
        }
        else if ( in_array('photoInvalide', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">votre photo doit &ecirc;tre au format jpg, jpeg ou gif</p> \n";
        }
        else if ( in_array('emailExisteDeja', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">Cette adresse e-mail est d&eacute;j&agrave; utilis&eacute;e</p> \n";
        }
        else if ( in_array('emailNexistePas', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">Aucun compte n'est enregistr&eacute; &agrave; cette adresse</p> \n";
        }
        else if ( in_array('pasPareil', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">Le mot de passe n'est pas identique &agrave sa confirmation</p> \n";
        }
        else if ( in_array('reference', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">cette r&eacute;f&eacute;rence est d&eacute;j&agrave; utilis&eacute;e</p> \n";
        }
        else if ( in_array('apostrophe', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">apostrophe interdite.</p> \n";
        }
        else if ( in_array('nombreEntier', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">entrez un nombre entier SVP.</p> \n";
        }
		else if ( in_array('identification', $this->alerteMsg)) {
            $alerte = "<p class=\"alerte\">Echec de l'identification</p> \n";
        }
		return $alerte;
    }

    function setClassAlerte($champ)
    {
        if ( in_array($champ, $this->alerteChamp)) {
            return " class=\"alerte\"";
        }
    }

	function setRequired($type, $label, $attributs)
	{
		if(preg_match('`required`', $attributs)) {
			preg_match('`([^:]+)(: )*(.*)`', $label, $out);
			if($type == 'password') $motif = '**';
			else $motif = '*';
			return $out[1] . '<span class="obligatoire">' . $motif . '</span>' . $out[2] . $out[3];

		}
		else return $label;
	}

	/*=================================

       	renvoie les attributs linéarisés

		exemple : size=30, required=required => size="30" required="required"

   	=================================*/

	function recupererAttributs($attributs)
	{
		if(empty($attributs)) return '';
		else {
			$attributs = preg_replace('`\s*=\s*`', '="', $attributs) .  '"';
			$attributs = preg_replace_callback('`(.){1},\s*`', array($this, 'replaceCallback'), $attributs);
			// echo $attributs . '<br />';
			return $attributs;
		}
	}

	function replaceCallback($motif)
	{
		if(preg_match('`[^\\\]`', $motif[1])) { // s'il n'y a pas d'antislash avant la virgule
			return $motif[1] . '" ';
		}
		else return ',';
	}

	function recupererID($name, $attributs)
	{
		if(empty($attributs)) {  // si pas d'id dans $attribut
			$retour['id'] = $name;
			$retour['attributs'] = '';
		}
		else {
			if(preg_match('` id="([a-zA-Z0-9_-]+)"`', $attributs, $out)) {
				$retour['id'] = $out[1];
				$retour['attributs'] = preg_replace('` id="([a-zA-Z0-9_-]+)"`', '', $attributs);
			}
			else {
				$retour['id'] = $name;
				$retour['attributs'] = $attributs;
			}
		}
		return $retour;
	}

    /*=================================

       vérifie que les champs ne sont pas incorrects

    =================================*/

	function verifAlphanum($var)
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            $post = $_SESSION[$var];
            if ( !preg_match("`^[A-Za-z0-9-]+$`", $post)) {
                $this->envoyerForm = 'unlucky';
                $this->alerteChamp[] = $var;
                $this->alerteMsg[] = 'alphanum';
            }
        }
    }

	function verifApostrophes($var)
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            $post = $_SESSION[$var];
            if ( preg_match('/\'/', $post)) {
                $this->envoyerForm = 'unlucky';
                $this->alerteChamp[] = $var;
                $this->alerteMsg[] = 'apostrophe';
            }
        }
    }

	function verifCaptcha($adresse = 'class/captcha/captcha.php')
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            require_once($adresse);
            if (! PhpCaptcha:: Validate($_SESSION['captchaCode'])) {
                $this->envoyerForm = 'unlucky';
                $this->alerteChamp[] = 'captcha';
                $this->alerteMsg[] = 'captcha';
            }
        }
    }

    function verifChampsVides($vars)
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {    // transformation des variables en tableau
            $tableau = explode(',', $vars);
            foreach($tableau as $valeur) {
                $valeur = trim($valeur);
                $post = $_SESSION[$valeur];
                if (empty($post)) {
                    $this->alerteChamp[] = $valeur;
                    $this->alerteMsg[] = 'vide';
                    $this->envoyerForm = 'unlucky';
                }
            }
        }
    }

	function verifFormatPhoto($var)
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            $type_file = $_FILES['fichier']['type'];
            if (! strstr($type_file, 'jpg') && ! strstr($type_file, 'jpeg') && ! strstr($type_file, 'gif')) {
                $this->envoyerForm = 'unlucky';
                $this->alerteChamp[] = $var;
                $this->alerteMsg[] = 'photoInvalide';
            }
        }
    }

    function verifMail($var)
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            $post = $_SESSION[$var];
            if (!preg_match("`^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$`", $post)) {
                $this->envoyerForm = 'unlucky';
                $this->alerteChamp[] = $var;
                $this->alerteMsg[] = 'email';
            }
        }
    }

    function verifMailExisteDeja($var)    // UNLUCKY SI LE MAIL EST PRESENT DANS LA BDD
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            $post = $_SESSION[$var];
            @include_once('class/mysql.php');
            @include_once('../class/mysql.php');
            $qry = "SELECT emailClient FROM clients WHERE emailClient='$post'";
            $db =new mysql();
            $db->Open();
            $db->query($qry);
            $result = $db->RowCount();
            if ($result > 0) {
                $this->envoyerForm = 'unlucky';
                $this->alerteChamp[] = $var;
                $this->alerteMsg[] = 'emailExisteDeja';
            }
        }
    }

    function verifMailExisteDeja2($var)    // LE CONTRAIRE : UNLUCKY SI LE MAIL N'EST PAS DANS LA BDD
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            $post = $_SESSION[$var];

            include_once('class/mysql.php');
            $qry = "SELECT emailClient FROM clients WHERE emailClient='$post'";
            $db = new mysql();
            $db->Open();
            $db->query($qry);
            $result = $db->RowCount();
            if (empty($result)) {
                $this->envoyerForm = 'unlucky';
                $this->alerteChamp[] = $var;
                $this->alerteMsg[] = 'emailNexistePas';
            }
        }
    }

	function maxi($var, $maxi)
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            $post = $_SESSION[$var];
            $lenght = strlen($post);
            if ($lenght>$maxi) {
                $this->envoyerForm = 'unlucky';
                $this->alerteChamp[] = $var;
                $this->alerteMsg[] = 'maxi';
            }
        }
    }

	function mini($var, $mini)
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            $post = $_SESSION[$var];
            $lenght = strlen($post);
            if ($lenght<$mini) {
                $this->envoyerForm = 'unlucky';
                $this->alerteChamp[] = $var;
                $this->alerteMsg[] = 'mini';
            }
        }
    }

    function verifNumero($var)
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            $cherche = " ";
            $remplace = "";
            $post = str_replace($cherche, $remplace, $_SESSION[$var]);
            $cherche = ",";
            $remplace = ".";
            $post = str_replace($cherche, $remplace, $post);
            if (! is_numeric($post)) {
                $this->envoyerForm = 'unlucky';
                $this->alerteChamp[] = $var;
                $this->alerteMsg[] = 'numero';
            }
        }
    }

    function verifNombreEntier($var)
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            $post = $_SESSION[$var];
            if (preg_match("`^[0-9\s]+$`", $post) == false) {
                $this->envoyerForm = 'unlucky';
                $this->alerteChamp[] = $var;
                $this->alerteMsg[] = 'nombreEntier';
            }
        }
    }

    function pareil($var1, $var2)
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            $post1 = $_SESSION[$var1];
            $post2 = $_SESSION[$var2];
            if ($post1 != $post2) {
                $this->envoyerForm = 'unlucky';
                $this->alerteChamp[] = $var1;
                $this->alerteMsg[] = 'pasPareil';
            }
        }
    }

    function verifUrl($url)
    {
        if ($this->verif == true and $this->envoyerForm == 'lucky') {
            $post = $_SESSION[$url];
            $conn = @fopen($post, "r");
            if (!$conn) {
                $this->envoyerForm = 'unlucky';
                $this->alerteChamp[] = $url;
                $this->alerteMsg[] = 'urlInvalide';
            }
        }
    }
}
?>