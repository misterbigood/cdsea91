var curseur = $('.curseur');
var curseurTop = curseur.position().top;
$(document).ready(function(){
	var URL = $.getRoot('cdsea');
	$('#main-nav').meanmenu({meanScreenWidth:767, meanExpand:"+", meanContract:"-", meanMenuClose: "x", meanMenuCloseSize: "18px"});

	/* curseur menu */

	function curseurMove() {
		var top = $(this).position().top;
		curseur.stop( true, true ).animate({'top': (top - 2), 'duration': 'fast'});
	};
	function curseurBack() {
		curseur.delay(500).animate({'top': curseurTop});
	};
	$('#main-nav li a').hoverIntent({
		over: 	curseurMove,
		out: 	curseurBack
	});

	/* actus */

	if($('.rslides')[0]) {
		$(".rslides").responsiveSlides({
			pager: true,
			nav: false,
			speed: 500,
			maxwidth: 800,
			namespace: "centered-btns"
		});
	}

	/* diaporama */

	if($('#diaporama')[0]) {
		var repertoire = $('#diaporama').attr('data-repertoire');
		$('#diaporama').ajax({'url' : 'inc/diaporama.php', 'vars': 'repertoire=' + repertoire, 'divAjaxContenu': false, 'resize': false});
	}

	$("select, input[type=checkbox], input[type=radio]").uniform();
	if($('#formContact')[0]) $('#formContact').addFormCheckedButtons().sizeLabels();
});