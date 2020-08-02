<div id="aside-content">
        <form action="recherche.php" method="get">
		<input type="hidden" name="search" value="1">
		<p id="recherche-form"><input name="query" type="text" size="18" class="recherche-input" placeholder="Rechercher"><button name="envoyer" type="submit" class="loupeBtn"><img src="images/btn-recherche.png" width="30" height="30" alt="rechercher"></button></p>
        </form>
        <?php   
               
                $date_min[82]="2020-06-30";
                $date_max[82]="2020-07-31";
                $date_min[83]="2020-07-23";
                $date_max[83]="2020-08-31";
                
        ?>
        <?php if ((date("Y-m-d") <= max($date_max)) AND (date("Y-m-d") >= min($date_min)) ): ?>
        <a href="#"><h3 class="iconimage iconimage-photos">Offres d'emploi</h3></a>
        <ul>
            <?php if((date("Y-m-d") <= $date_max[82]) AND (date("Y-m-d") >= $date_min[82])):?><li><a href='./documentation/offres/82 - ITEP - Directeur.pdf'>ITEP - Directeur (H/F) - CDI</a></li><?php endif;?>
            <?php if((date("Y-m-d") <= $date_max[83]) AND (date("Y-m-d") >= $date_min[83])):?><li><a href='./documentation/offres/83 - CRE - Travailleur social AVDL - CDD.pdf'>CRE - Travailleur social AVDL (H/F) - CDD</a></li><?php endif;?>
        </ul>
        <?php endif; ?>
	<?php /* if($actualites->nbre() > 0) {
		echo '<a href="actualites.html"><h3 class="iconimage iconimage-news">actualités</h3></a>' . " \n";
		$actualites->afficherActusAccueil();
	        }*/
           
	$class_contact = '';
	$class_emploi = '';
        $class_documentation = '';
	if($page == 'cdsea-contact') $class_contact = ' class="menu-on"';
	else if($page == 'cdsea-offres_emploi') $class_emploi = ' class="menu-on"';
        else if($page== 'cdsea-documentation')$class_documentation = ' class="menu-on"';
	?>
        <!--<h4>Diaporama des <a href="http://www.cdsea91.fr/itep-diaporama-2017.html">dessins des enfants de l'ITEP</a></h4>-->
    <br>
	<a href="contact.html"<?php echo $class_contact; ?>><h3 class="iconimage iconimage-map">accès / contact</h3></a>
        <a href="documentation.html"<?php echo $class_documentation; ?>><h3 class="iconimage iconimage-documentation">documentation</h3></a>  
</div>
