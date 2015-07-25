<?php 
function menu($page, $adresse, $txt)
{
    $html = '<li ';
    if($page == $adresse) {
        $html .= 'id="menuOn">';
    }
    else {
        $html .= 'class="menuOff">';
    }
    $html .= '<a href="' . $adresse . '.php">' . $txt . '</a>' . " \n";
    $html .= '</li>' . " \n";
    echo $html;
}
?>
<div id="menuConteneur">
    <ul id="menu">
    <?php 
		menu($page, 'accueil', 'accueil');
		menu($page, 'actualites', 'actualités');
		menu($page, 'offres_emploi', 'offres d\'emploi'); 
		menu($page, 'documentation', 'documentation');
		//menu($page, 'marche_public', 'marché public');
		menu($page, 'audacite', 'Audacité');
	?>
    </ul>
	<form action="accueil.php" method="POST">
	<input type="hidden" name="action" value="logout">
	<button type="submit" class="btn btn-red btn-small" id="logoutBtn">logout</button>
	</form>
</div>