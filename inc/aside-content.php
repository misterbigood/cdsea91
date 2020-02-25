<div id="aside-content">
        <form action="recherche.php" method="get">
		<input type="hidden" name="search" value="1">
		<p id="recherche-form"><input name="query" type="text" size="18" class="recherche-input" placeholder="Rechercher"><button name="envoyer" type="submit" class="loupeBtn"><img src="images/btn-recherche.png" width="30" height="30" alt="rechercher"></button></p>
        </form>
        <?php   
               
                $date_min[76]="2020-02-16";
                $date_max[76]="2020-03-15";
                $date_min[77]="2020-02-24";
                $date_max[77]="2020-03-31";
                $date_min[78]="2020-02-24";
                $date_max[78]="2020-03-31";
                $date_min[79]="2020-01-05";
                $date_max[79]="2020-03-31";
                $date_min[80]="2020-02-25";
                $date_max[80]="2020-03-31";
                
        ?>
        <?php if ((date("Y-m-d") <= max($date_max)) AND (date("Y-m-d") >= min($date_min)) ): ?>
        <a href="#"><h3 class="iconimage iconimage-photos">Offres d'emploi</h3></a>
        <ul>
            <?php if((date("Y-m-d") <= $date_max[76]) AND (date("Y-m-d") >= $date_min[76])):?><li><a href='./documentation/offres/76 - MECS - Secrétaire.pdf'>MECS - Secrétaire - 50% ETP - CDI</a></li><?php endif;?>
            <?php if((date("Y-m-d") <= $date_max[77]) AND (date("Y-m-d") >= $date_min[77])):?><li><a href='./documentation/offres/77 - SAEMF - Educateur spécialisé.pdf'>SAEMF St-Michel-sur-Orge - Educateur spécialisé (H/F) - CDI</a></li><?php endif;?>
            <?php if((date("Y-m-d") <= $date_max[78]) AND (date("Y-m-d") >= $date_min[78])):?><li><a href='./documentation/offres/78 - SAEMF - Educateur spécialisé.pdf'>SAEMF Vigneux-sur-Seine - Educateur spécialisé (H/F) - CDI</a></li><?php endif;?>
            <?php if((date("Y-m-d") <= $date_max[79]) AND (date("Y-m-d") >= $date_min[79])):?><li><a href='./documentation/offres/79 - SAEMF - Educateur spécialisé.pdf'>SAEMF Evry - Educateur spécialisé (H/F) - CDD</a></li><?php endif;?>
            <?php if((date("Y-m-d") <= $date_max[80]) AND (date("Y-m-d") >= $date_min[80])):?><li><a href='./documentation/offres/80 - ITEP - Educateur spécialisé.pdf'>ITEP - Educateur spécialisé (H/F) - CDI</a></li><?php endif;?>
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
