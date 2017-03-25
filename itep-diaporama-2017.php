
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Diaporama Simple JQuery</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 
        <script type="text/javascript" src="js/coin-slider/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/coin-slider/coin-slider.min.js"></script>
        <link rel="stylesheet" href="js/coin-slider/coin-slider-styles.css" type="text/css" />
        
    </head>
 
    <body>
    <h1>Concours de dessin</h1>
        <?php
        $dir    = './diaporama/itep-2017/';
        $files = scandir($dir);
        ?>
        <div id='coin-slider'>
        <?php
        foreach($files as $value):
            if(substr($value,-6)=="-S.jpg"):
                ?>
                    <a href='diaporama/itep-2017/<?php echo substr($value,0, strlen($value)-6).'-M.jpg'; ?>' target="_blank">
                        <img src='diaporama/itep-2017/<?php echo $value; ?>' height="800" >
                        <span>
                                <?php echo str_replace('_',' ',substr($value,0, strlen($value)-6)); ?>
                        </span>
                    </a>
                <?php
            endif;
        endforeach;
        ?>  
        </div>
        <!--<div id='coin-slider'>
	<a href='http://www.cdsea91.fr/' target="_blank">
		<img src='diaporama/itep-2017/001.jpg' >
		<span>
			Description for img01
		</span>
	</a>
    <a href='http://www.cdsea91.fr/' target="_blank">
		<img src='diaporama/itep-2017/BenjaminC-S.jpg' >
		<span>
			Description for img02
		</span>
	</a>
        </div>-->
        
 <script type="text/javascript">
	$(document).ready(function() {
		$('#coin-slider').coinslider({
                    width: 420, // width of slider panel
height: 600, // height of slider panel
spw: 7, // squares per width
sph: 5, // squares per height
delay: 5000, // delay between images in ms
sDelay: 30, // delay beetwen squares in ms
opacity: 0.6, // opacity of title and navigation
titleSpeed: 500, // speed of title appereance in ms
effect: '', // random, swirl, rain, straight
navigation: true, // prev next and buttons
links : true, // show images as links 
hoverPause: true // pause on hover
                });
	});
</script>
    </body>
 
</html>