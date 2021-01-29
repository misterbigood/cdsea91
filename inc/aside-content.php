<div id="aside-content">
        <form action="recherche.php" method="get">
		<input type="hidden" name="search" value="1">
		<p id="recherche-form"><input name="query" type="text" size="18" class="recherche-input" placeholder="Rechercher"><button name="envoyer" type="submit" class="loupeBtn"><img src="images/btn-recherche.png" width="30" height="30" alt="rechercher"></button></p>
        </form>
        <?php 
                $annonces[] = array("date_min" => "2021-01-04", 
                                "date_max" => "2021-02-15",
                                "fichier" => "89 - DITEP - ASS", 
                                "titre"=> "DITEP - Assistante de service social (H/F) - CDI");
                $annonces[] = array("date_min" => "2021-01-14", 
                                "date_max" => "2021-02-15",
                                "fichier" => "90 - MECS - Surveillant de nuit", 
                                "titre"=> "MECS - Surveillant de nuit qualifié (H/F) - CDI");
                $annonces[] = array("date_min" => "2021-01-14", 
                                "date_max" => "2021-02-28",
                                "fichier" => "91 - MECS - Directeur", 
                                "titre"=> "MECS - Directeur (H/F) - CDI");
                $annonces[] = array("date_min" => "2021-01-29", 
                                "date_max" => "2021-02-28",
                                "fichier" => "92 - DITEP - ES - Externat", 
                                "titre"=> "DITEP - Educateur spécialisé - Externat (H/F) - CDI");
                $annonce_active = 0;
                if(is_array($annonces)):
                        foreach($annonces as $key => $annonce):
                                if($annonce["date_min"] <= date("Y-m-d") && $annonce["date_max"] >= date("Y-m-d")):
                                        if($annonce_active == 0):
                                                $annonce_active = 1;
                                                ?>
                                                <a href="#"><h3 class="iconimage iconimage-photos">Offres d'emploi</h3></a>
                                                <ul>
                                                        <li><a href='./documentation/offres/<?php echo $annonce["fichier"]?>.pdf'><?php echo $annonce ["titre"];?></a></li>
                                                <?php
                                        else:
                                                $annonce_active = 2;
                                                ?><li><a href='./documentation/offres/<?php echo $annonce["fichier"]?>.pdf'><?php echo $annonce ["titre"];?></a></li>
                                                <?php
                                                if ($key == count($annonces)-1):
                                                        ?>
                                                        </ul>
                                                        <?php
                                                endif;
                                        endif;
                                endif;
                        endforeach;
                endif;
        

	/* if($actualites->nbre() > 0) {
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
