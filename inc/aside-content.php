<div id="aside-content">
        <form action="recherche.php" method="get">
		<input type="hidden" name="search" value="1">
		<p id="recherche-form"><input name="query" type="text" size="18" class="recherche-input" placeholder="Rechercher"><button name="envoyer" type="submit" class="loupeBtn"><img src="images/btn-recherche.png" width="30" height="30" alt="rechercher"></button></p>
        </form>
        <?php   
                $date_min[68]="2019-07-01";
                $date_max[68]="2019-07-31";
                $date_min[69]="2019-08-20";
                $date_max[69]="2019-09-11";
                
                
        ?>
        <?php if ((date("Y-m-d") <= max($date_max)) AND (date("Y-m-d") >= min($date_min)) ): ?>
        <a href="#"><h3 class="iconimage iconimage-photos">Offres d'emploi</h3></a>
        <ul>
            <?php if((date("Y-m-d") <= $date_max[68]) AND (date("Y-m-d") >= $date_min[68])):?><li><a href='./documentation/offres/68 - MECS - Secrétaire.pdf'>MECS - Secrétaire (H/F) - CDD</a></li><?php endif;?>
        </ul>
        <ul>
            <?php if((date("Y-m-d") <= $date_max[69]) AND (date("Y-m-d") >= $date_min[69])):?><li><a href='./documentation/offres/69 - ITEP - Educateur spécialisé H-F.pdf'>ITEP - Educateur spécialisé (H/F)</a></li><?php endif;?>
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
