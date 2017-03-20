<div id="aside-content">
        <form action="recherche.php" method="get">
		<input type="hidden" name="search" value="1">
		<p id="recherche-form"><input name="query" type="text" size="18" class="recherche-input" placeholder="Rechercher"><button name="envoyer" type="submit" class="loupeBtn"><img src="images/btn-recherche.png" width="30" height="30" alt="rechercher"></button></p>
        </form>
        <!-- Emplacement offres d'emploi -->
        <a href="actualites.html"><h3 class="iconimage iconimage-photos">Offres d'emploi</h3></a>
        <ul>
            <?php if(date("Y-m-d")<"2017-03-24"):?><li><a href='./documentation/offres/54 - CRE - Chargé ASLL.pdf'>CRE - Chargé(e) d'accompagnement social lié au logement</a></li><?php endif;?>
            <li><a href='./documentation/offres/53 - MECS - Coordinateur.pdf'>MECS - Un(e) coordinateur(rice) d'équipe</a></li>
        </ul>
        <!-- Fin emplacement offres d'emploi -->
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
	<a href="contact.html"<?php echo $class_contact; ?>><h3 class="iconimage iconimage-map">accès / contact</h3></a>
        <a href="documentation.html"<?php echo $class_documentation; ?>><h3 class="iconimage iconimage-documentation">documentation</h3></a>  
</div>
