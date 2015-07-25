<div id="aside-content">
	<?php if($page == 'cdsea-association' && $actualites->nbre() > 0) {
		echo '<a href="actualites.html"><h3 class="iconimage iconimage-news">actualités</h3></a>' . " \n";
		$actualites->afficherActusAccueil();
	}
	$class_contact = '';
	$class_emploi = '';
	if($page == 'cdsea-contact') $class_contact = ' class="menu-on"';
	else if($page == 'cdsea-offres_emploi') $class_emploi = ' class="menu-on"';
	?>
	<a href="contact.html"<?php echo $class_contact; ?>><h3 class="iconimage iconimage-map">accès / contact</h3></a>
	<?php //if ($offres_emploi->nbre() > 0):?>
        <a href="offres_emploi.html"<?php echo $class_emploi; ?>><h3 class="iconimage iconimage-photos">offres d'emploi</h3></a>
        <?php //endif; ?>
        <form action="recherche.php" method="get">
		<input type="hidden" name="search" value="1">
		<p id="recherche-form"><input name="query" type="text" size="18" class="recherche-input" placeholder="Rechercher"><button name="envoyer" type="submit" class="loupeBtn"><img src="images/btn-recherche.png" width="30" height="30" alt="rechercher"></button></p>
        </form>
</div>