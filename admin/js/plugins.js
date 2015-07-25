// Avoid `console` errors in browsers that lack a console.
if (!(window.console && console.log)) {
    (function() {
        var noop = function() {};
        var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'markTimeline', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
        var length = methods.length;
        var console = window.console = {};
        while (length--) {
            console[methods[length]] = noop;
        }
    }());
}

/*=========================================================
			compteur de mots / caractères (auth:migli) 
=========================================================*/

/*

$('#textareaID').compteurMotsCaracteres(200);

résultat : 

<div class="compteurWrapper" id="compteurWrappertextareaID">
	<textarea id="textareaID" ...></textarea>
	<p class="compteur"><span id="compteurMotstextareaID">0</span> mot(s) | <span id="compteurCaracterestextareaID">0</span> Caractère(s) / maximumAutorise</p>
</div>

css : voir dans normalize.css

*/

(function($)
{
	$.fn.compteurMotsCaracteres=function(maximumAutorise){
		var textareaID = $(this).attr('ID');
		$(this).css('margin-bottom', '2px').wrap('<div class="compteurWrapper" id="compteurWrapper' + textareaID + '">');
		$('<p class="compteur">').html('<span id="compteurMots' + textareaID + '">0</span> mot(s) | <span id="compteurCaracteres' + textareaID + '">0</span> Caractère(s) / ' + maximumAutorise).appendTo($('#compteurWrapper' + textareaID));
		$(this).keyup(function() {
			var nombreCaractere = $(this).val().length;
			var nombreMots = jQuery.trim($(this).val()).split(' ').length;
			if($(this).val() === '') {
				nombreMots = 0;
			}
			var msg = ' ' + nombreMots + ' mot(s) | ' + nombreCaractere + ' Caractere(s) / ' + maximumAutorise;
			$('#compteurMots' + textareaID).text(nombreMots);
			$('#compteurCaracteres' + textareaID).text(nombreCaractere);
			if (nombreCaractere > maximumAutorise) { 
				$('#compteurMots' + textareaID).addClass("alerte");
				$('#compteurCaracteres' + textareaID).addClass("alerte");
			} 
			else if($('#compteurMots' + textareaID).hasClass("alerte")) { 
				$('#compteurMots' + textareaID).removeClass("alerte");
				$('#compteurCaracteres' + textareaID).removeClass("alerte");
			}
		});
		$(this).trigger('keyup');
	}
})(jQuery);

/*==============================================
			form checked buttons (auth:migli) 
==============================================*/

/*

insère un span après chaque input, textarea, à styler avec input:invalid ~ span:after || input:valid ~ span:after

$('#form').addFormCheckedButtons();

*/

(function($)
{
	$.fn.addFormCheckedButtons=function(){
		var champs = this.find('textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"]');
		champs.after('<span style="position:relative; display:none;"></span>').one('blur', function() {
			$(this).next('span').show(400);
		});
		return this;
	};
})(jQuery);

/*==============================================
			form size labels (auth:migli) 
==============================================*/

/* 

uniformise la largeur des labels

$('#form').sizeLabels();

*/

(function($)
{
	$.fn.sizeLabels=function(){
		var max = 0;
		var labels = this.find('label, .radioCheckboxDiv div.labelDiv p').not('.radioCheckboxDivContent label');
		labels.each(function(){
			if ($(this).width() > max)
				max = $(this).width();   
		});
		labels.width(max);
		if($('.captcha')[0]) $('.captcha').css('margin-left', labels.outerWidth()); 
		this.find('.radioCheckboxDivContent').each(function(){
			var max2 = 0;
			var radioCheckboxLabels = $(this).find('label');
			radioCheckboxLabels.each(function(){
				if ($(this).width() > max2)
					max2 = $(this).width();   
			});
			radioCheckboxLabels.width(max2);
		});
		return this;
	};
})(jQuery);

/*==============================================
			colorColumns (auth:migli) 
==============================================*/

/*

ajoute un background aux colonnes indiquées (numérotées)

$('#table').colorColumns(columnsNumbersArray, color);
$('#table').colorColumns(colonnes, '#F4F0E3');
*/

(function($)
{
	$.fn.colorColumns=function(columnsNumbersArray, color){
		var rows = this.find('tr');
		rows.each(function(trCount){
			if($(this).parent().tagName == 'thead') { return false; } 
			$(this).children('td').each(function(tdCount) {
				if($.inArray(tdCount + 1, columnsNumbersArray) > -1) { 
					$(this).css('background-color', color); 
				} 
			}); 
		});
		return this;
	};
})(jQuery);

/*==============================================
			hoverIntent 
==============================================*/
/**
* hoverIntent r6 // 2011.02.26 // jQuery 1.5.1+
* <http://cherne.net/brian/resources/jquery.hoverIntent.html>
* 
* @param  f  onMouseOver function || An object with configuration options
* @param  g  onMouseOut function  || Nothing (use configuration options object)
* @author    Brian Cherne brian(at)cherne(dot)net

=============
 UTILISATION
=============

$("#demo2 li").hoverIntent( function() {} )

=============

var config = {    
     over: makeTall, // function = onMouseOver callback (REQUIRED)    
     timeout: 500, // number = milliseconds delay before onMouseOut    
     out: makeShort // function = onMouseOut callback (REQUIRED)    
};

$("#demo3 li").hoverIntent( config )

=============

*/
(function($){$.fn.hoverIntent=function(f,g){var cfg={sensitivity:4,interval:100,timeout:500};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev])}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev])};var handleHover=function(e){var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t)}if(e.type=="mouseenter"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob)},cfg.timeout)}}};return this.bind('mouseenter',handleHover).bind('mouseleave',handleHover)}})(jQuery);
