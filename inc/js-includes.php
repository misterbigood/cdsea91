<?php
//if($_SERVER['SERVER_NAME'] == 'localhost') { ?>
	<script type="text/javascript" src="js/jquery-1.10.0.min.js"></script>
	<script type="text/javascript" src="js/plugins.js"></script>
	<script type="text/javascript" src="js/meanMenu/jquery.meanmenu.js"></script>
	<script type="text/javascript" src="js/uniform/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="js/responsiveslides.js"></script>
	<script type="text/javascript" src="js/ajax-jquery-plugin.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/doubleTapToGo.js"></script>
        <script>
                $(document).ready( function () {
                    // Add return on top button
                    $('#contenu').append('<div id="returnOnTop" title="Retour en haut">&nbsp;</div>');

                    // On button click, let's scroll up to top
                    $('#returnOnTop').click( function() {
                        $('html,body').animate({scrollTop: 0}, 'slow');
                    });
                });

                $(window).scroll(function() {
                    // If on top fade the bouton out, else fade it in
                    if ( $(window).scrollTop() < 160 )
                        $('#returnOnTop').fadeOut();
                    else
                        $('#returnOnTop').fadeIn();
                });
                </script>
<?php
//}
//else { ?>
	<!--<script type="text/javascript" src="/min/b=js&amp;f=jquery-1.10.0.min.js,plugins.js,meanMenu/jquery.meanmenu.js,uniform/jquery.uniform.min.js,responsiveslides.js,ajax-jquery-plugin.js,main.js,doubleTapToGo.js"></script>-->
<?php// } ?>