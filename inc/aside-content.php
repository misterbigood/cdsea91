<div id="aside-content">
        <form action="recherche.php" method="get">
		<input type="hidden" name="search" value="1">
		<p id="recherche-form"><input name="query" type="text" size="18" class="recherche-input" placeholder="Rechercher"><button name="envoyer" type="submit" class="loupeBtn"><img src="images/btn-recherche.png" width="30" height="30" alt="rechercher"></button></p>
        </form>
        <?php $date_max="2018-07-31"; ?>
        <?php if (date("Y-m-d") < $date_max): ?>
        <a href="actualites.html"><h3 class="iconimage iconimage-photos">Offres d'emploi</h3></a>
        <ul>
            <?php if(date("Y-m-d")<$date_max):?><li><a href='./documentation/offres/60 - SAEMF - Educateur spécialisé.pdf'>SAEMF - Travailleur social (ES/AS)</a></li><?php endif;?>
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
        <h4>Le SAEMF donne la parole aux parents: <a href="http://www.cdsea91.fr/aed-media.html">quatre extraits</a> ou <a class="video" href="https://www.youtube.com/watch?v=1d84QiLy5QU&t=192s&list=PLlCxHYFy8GZFE96RSB4bHYoXnXp4_y_iY&index=2">Paroles de parents - Film complet</a>
                                                    </h4>
        <br><h4>Diaporama des <a href="http://www.cdsea91.fr/itep-diaporama-2017.html">dessins des enfants de l'ITEP</a></h4>
    <br>
        
	<a href="contact.html"<?php echo $class_contact; ?>><h3 class="iconimage iconimage-map">accès / contact</h3></a>
        <a href="documentation.html"<?php echo $class_documentation; ?>><h3 class="iconimage iconimage-documentation">documentation</h3></a>  
</div>
