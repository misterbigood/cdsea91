<div id="aside-content">
        <form action="recherche.php" method="get">
		<input type="hidden" name="search" value="1">
		<p id="recherche-form"><input name="query" type="text" size="18" class="recherche-input" placeholder="Rechercher"><button name="envoyer" type="submit" class="loupeBtn"><img src="images/btn-recherche.png" width="30" height="30" alt="rechercher"></button></p>
        </form>
        <?php   
                $date_min[74]="2020-01-05";
<<<<<<< HEAD
                $date_max[74]="2020-03-15";
                $date_min[76]="2020-02-16";
                $date_max[76]="2020-03-15";
=======
                $date_max[74]="2020-02-09";
                $date_min[75]="2020-01-18";
                $date_max[75]="2020-02-15";
>>>>>>> 407e6c1184ba8dbbfa3dd8c0f3d0447770d0b683
                
        ?>
        <?php if ((date("Y-m-d") <= max($date_max)) AND (date("Y-m-d") >= min($date_min)) ): ?>
        <a href="#"><h3 class="iconimage iconimage-photos">Offres d'emploi</h3></a>
        <ul>
<<<<<<< HEAD
            <?php if((date("Y-m-d") <= $date_max[74]) AND (date("Y-m-d") >= $date_min[74])):?><li><a href='./documentation/offres/74 - SAEMF - Educateur spécialisé.pdf'>SAEMF - Educateur spécialisé (H/F) - CDD</a></li><?php endif;?>
            <?php if((date("Y-m-d") <= $date_max[76]) AND (date("Y-m-d") >= $date_min[76])):?><li><a href='./documentation/offres/76 - MECS - Secrétaire.pdf'>MECS - Secrétaire - 50% ETP - CDI</a></li><?php endif;?>
=======
            <?php if((date("Y-m-d") <= $date_max[72]) AND (date("Y-m-d") >= $date_min[72])):?><li><a href='./documentation/offres/72 - ITEP - Psychologue.pdf'>ITEP - Psychologue (H/F) - 50% ETP - CDI</a></li><?php endif;?>
        
            <?php if((date("Y-m-d") <= $date_max[73]) AND (date("Y-m-d") >= $date_min[73])):?><li><a href='./documentation/offres/73 - ITEP - Psychomotricien.pdf'>ITEP - Psychomotricien (H/F) - CDI</a></li><?php endif;?>
        
            <?php if((date("Y-m-d") <= $date_max[74]) AND (date("Y-m-d") >= $date_min[74])):?><li><a href='./documentation/offres/74 - SAEMF - Educateur spécialisé.pdf'>SAEMF - Educateur spécialisé (H/F) - CDD</a></li><?php endif;?>

            <?php if((date("Y-m-d") <= $date_max[75]) AND (date("Y-m-d") >= $date_min[75])):?><li><a href='./documentation/offres/75 - MECS - Educateur spécialisé.pdf'>MECS - Educateur spécialisé (H/F) - CDI</a></li><?php endif;?>
>>>>>>> 407e6c1184ba8dbbfa3dd8c0f3d0447770d0b683
        </ul>
        <?php endif; ?>
	<?php if($actualites->nbre() > 0) {
		echo '<a href="actualites.html"><h3 class="iconimage iconimage-news">actualités</h3></a>' . " \n";
		$actualites->afficherActusAccueil();
	}
           
	$class_contact = '';
	$class_emploi = '';
        $class_documentation = '';
	if($page == 'cdsea-contact') $class_contact = ' class="menu-on"';
	else if($page == 'cdsea-offres_emploi') $class_emploi = ' class="menu-on"';
        else if($page== 'cdsea-documentation')$class_documentation = ' class="menu-on"';
	?>
        <h4>Diaporama des <a href="http://www.cdsea91.fr/itep-diaporama-2017.html">dessins des enfants de l'ITEP</a></h4>
    <br>
	<a href="contact.html"<?php echo $class_contact; ?>><h3 class="iconimage iconimage-map">accès / contact</h3></a>
        <a href="documentation.html"<?php echo $class_documentation; ?>><h3 class="iconimage iconimage-documentation">documentation</h3></a>  
</div>
