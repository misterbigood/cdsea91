<?php
	preg_match('`(cdsea|mecs|itep|sais|aed|cre|documentation)([-]?)([a-z_-]*)`', $page, $out);
	$class = $out[1]; // ex : cdsea
        
?>
<header id="banniere" class="banniere-<?php echo $class; ?>">
	<a href="index.html"><div id="logo-wrapper"><img src="images/logo_cdsea_web.jpg" alt="CDSEA"></div></a>
	<?php $main_menu = new menu('main-nav', $page); ?>
	<hr class="separation">
</header>