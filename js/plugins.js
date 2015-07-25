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

/*==============================================
			getRoot (auth:migli) 
==============================================*/

/*

récupère la racine avec le répertoire de base si on est en local

$.getRoot('localhostDir'); 

	ex : $.getRoot('promosvar');
	=> en local : http://localhost/promosvar/
	=> en distant : http://www.promosvar.com/

*/

(function($)
{
	$.getRoot=function(localhostDir){
		if(location.host == 'localhost') {
			return location.protocol + '//' + location.host + '/' + localhostDir + '/';	
		}
		else return location.protocol + '//' + location.host + '/';
	};
})(jQuery);

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

/*!
 * hoverIntent r7 // 2013.03.11 // jQuery 1.9.1+
 * http://cherne.net/brian/resources/jquery.hoverIntent.html
 *
 * You may use hoverIntent under the terms of the MIT license.
 * Copyright 2007, 2013 Brian Cherne
 */
(function(e){e.fn.hoverIntent=function(t,n,r){var i={interval:50,sensitivity:7,timeout:0};if(typeof t==="object"){i=e.extend(i,t)}else if(e.isFunction(n)){i=e.extend(i,{over:t,out:n,selector:r})}else{i=e.extend(i,{over:t,out:t,selector:n})}var s,o,u,a;var f=function(e){s=e.pageX;o=e.pageY};var l=function(t,n){n.hoverIntent_t=clearTimeout(n.hoverIntent_t);if(Math.abs(u-s)+Math.abs(a-o)<i.sensitivity){e(n).off("mousemove.hoverIntent",f);n.hoverIntent_s=1;return i.over.apply(n,[t])}else{u=s;a=o;n.hoverIntent_t=setTimeout(function(){l(t,n)},i.interval)}};var c=function(e,t){t.hoverIntent_t=clearTimeout(t.hoverIntent_t);t.hoverIntent_s=0;return i.out.apply(t,[e])};var h=function(t){var n=jQuery.extend({},t);var r=this;if(r.hoverIntent_t){r.hoverIntent_t=clearTimeout(r.hoverIntent_t)}if(t.type=="mouseenter"){u=n.pageX;a=n.pageY;e(r).on("mousemove.hoverIntent",f);if(r.hoverIntent_s!=1){r.hoverIntent_t=setTimeout(function(){l(n,r)},i.interval)}}else{e(r).off("mousemove.hoverIntent",f);if(r.hoverIntent_s==1){r.hoverIntent_t=setTimeout(function(){c(n,r)},i.timeout)}}};return this.on({"mouseenter.hoverIntent":h,"mouseleave.hoverIntent":h},i.selector)}})(jQuery);

/* =============================================
	Bootstraps tabs (jquery plugin)
   ============================================= */
   
/**
* Bootstrap.js by @fat & @mdo
* plugins: bootstrap-tab.js
* Copyright 2012 Twitter, Inc.
* http://www.apache.org/licenses/LICENSE-2.0.txt
*/
!function(a){var b=function(b){this.element=a(b)};b.prototype={constructor:b,show:function(){var b=this.element,c=b.closest("ul:not(.dropdown-menu)"),d=b.attr("data-target"),e,f,g;d||(d=b.attr("href"),d=d&&d.replace(/.*(?=#[^\s]*$)/,""));if(b.parent("li").hasClass("active"))return;e=c.find(".active:last a")[0],g=a.Event("show",{relatedTarget:e}),b.trigger(g);if(g.isDefaultPrevented())return;f=a(d),this.activate(b.parent("li"),c),this.activate(f,f.parent(),function(){b.trigger({type:"shown",relatedTarget:e})})},activate:function(b,c,d){function g(){e.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"),b.addClass("active"),f?(b[0].offsetWidth,b.addClass("in")):b.removeClass("fade"),b.parent(".dropdown-menu")&&b.closest("li.dropdown").addClass("active"),d&&d()}var e=c.find("> .active"),f=d&&a.support.transition&&e.hasClass("fade");f?e.one(a.support.transition.end,g):g(),e.removeClass("in")}};var c=a.fn.tab;a.fn.tab=function(c){return this.each(function(){var d=a(this),e=d.data("tab");e||d.data("tab",e=new b(this)),typeof c=="string"&&e[c]()})},a.fn.tab.Constructor=b,a.fn.tab.noConflict=function(){return a.fn.tab=c,this},a(document).on("click.tab.data-api",'[data-toggle="tab"], [data-toggle="pill"]',function(b){b.preventDefault(),a(this).tab("show")})}(window.jQuery);

/* =========================================================================
	image-preload v1.4  https://github.com/farinspace/jquery.imgpreload | http://www.farinspace.com/jquery-image-preload-plugin/
========================================================================= 

=============
 UTILISATION
=============

$('#content img').imgpreload(function()
{
	// this = array of dom image objects
	// callback executes when all images are loaded
});

$('#content img').imgpreload
({
	each: function()
	{
		// this = dom image object
		// check for success with: $(this).data('loaded')
		// callback executes when each image loads
	},
	all: function()
	{
		// this = array of dom image objects
		// check for success with: $(this[i]).data('loaded')
		// callback executes when all images are loaded
	}
});

$.imgpreload('/images/a.gif',function()
{
	// this = array of dom image objects
	// check for success with: $(this[i]).data('loaded')
	// callback
});

$.imgpreload(['/images/a.gif','/images/b.gif'],function()
{
	// this = array of dom image objects
	// check for success with: $(this[i]).data('loaded')
	// callback executes when all images are loaded
});

$.imgpreload(['/images/a.gif','/images/b.gif'],
	{
	each: function()
	{
		// this = dom image object
		// check for success with: $(this).data('loaded')
		// callback executes on every image load
	},
	all: function()
	{
		// this = array of dom image objects
		// check for success with: $(this[i]).data('loaded')
		// callback executes when all images are loaded
	}
});

=============

*/

if("undefined"!=typeof jQuery){(function(a){a.imgpreload=function(b,c){c=a.extend({},a.fn.imgpreload.defaults,c instanceof Function?{all:c}:c);if("string"==typeof b){b=new Array(b)}var d=new Array;a.each(b,function(e,f){var g=new Image;var h=f;var i=g;if("string"!=typeof f){h=a(f).attr("src");i=f}a(g).bind("load error",function(e){d.push(i);a.data(i,"loaded","error"==e.type?false:true);if(c.each instanceof Function){c.each.call(i)}if(d.length>=b.length&&c.all instanceof Function){c.all.call(d)}a(this).unbind("load error")});g.src=h})};a.fn.imgpreload=function(b){a.imgpreload(this,b);return this};a.fn.imgpreload.defaults={each:null,all:null}})(jQuery)}

/* =============================================	
	PRINTELEMENT + MIGRATE (pour browser)
   ============================================= */

/// <reference path="http://code.jquery.com/jquery-1.4.1-vsdoc.js" />
/*
* Print Element Plugin 1.2
*
* Copyright (c) 2010 Erik Zaadi
*
* Inspired by PrintArea (http://plugins.jquery.com/project/PrintArea) and
* http://stackoverflow.com/questions/472951/how-do-i-print-an-iframe-from-javascript-in-safari-chrome
*
* Home Page : http://projects.erikzaadi/jQueryPlugins/jQuery.printElement
* Issues (bug reporting) : http://github.com/erikzaadi/jQueryPlugins/issues/labels/printElement
* jQuery plugin page : http://plugins.jquery.com/project/printElement
*
* Thanks to David B (http://github.com/ungenio) and icgJohn (http://www.blogger.com/profile/11881116857076484100)
* For their great contributions!
*
* Dual licensed under the MIT and GPL licenses:
* http://www.opensource.org/licenses/mit-license.php
* http://www.gnu.org/licenses/gpl.html
*
* Note, Iframe Printing is not supported in Opera and Chrome 3.0, a popup window will be shown instead
*/
;(function(g){function k(c){c&&c.printPage?c.printPage():setTimeout(function(){k(c)},50)}function l(c){c=a(c);a(":checked",c).each(function(){this.setAttribute("checked","checked")});a("input[type='text']",c).each(function(){this.setAttribute("value",a(this).val())});a("select",c).each(function(){var b=a(this);a("option",b).each(function(){b.val()==a(this).val()&&this.setAttribute("selected","selected")})});a("textarea",c).each(function(){var b=a(this).attr("value");if(a.browser.b&&this.firstChild)this.firstChild.textContent=
b;else this.innerHTML=b});return a("<div></div>").append(c.clone()).html()}function m(c,b){var i=a(c);c=l(c);var d=[];d.push("<html><head><title>"+b.pageTitle+"</title>");if(b.overrideElementCSS){if(b.overrideElementCSS.length>0)for(var f=0;f<b.overrideElementCSS.length;f++){var e=b.overrideElementCSS[f];typeof e=="string"?d.push('<link type="text/css" rel="stylesheet" href="'+e+'" >'):d.push('<link type="text/css" rel="stylesheet" href="'+e.href+'" media="'+e.media+'" >')}}else a("link",j).filter(function(){return a(this).attr("rel").toLowerCase()==
"stylesheet"}).each(function(){d.push('<link type="text/css" rel="stylesheet" href="'+a(this).attr("href")+'" media="'+a(this).attr("media")+'" >')});d.push('<base href="'+(g.location.protocol+"//"+g.location.hostname+(g.location.port?":"+g.location.port:"")+g.location.pathname)+'" />');d.push('</head><body style="'+b.printBodyOptions.styleToAdd+'" class="'+b.printBodyOptions.classNameToAdd+'">');d.push('<div class="'+i.attr("class")+'">'+c+"</div>");d.push('<script type="text/javascript">function printPage(){focus();print();'+
(!a.browser.opera&&!b.leaveOpen&&b.printMode.toLowerCase()=="popup"?"close();":"")+"}<\/script>");d.push("</body></html>");return d.join("")}var j=g.document,a=g.jQuery;a.fn.printElement=function(c){var b=a.extend({},a.fn.printElement.defaults,c);if(b.printMode=="iframe")if(a.browser.opera||/chrome/.test(navigator.userAgent.toLowerCase()))b.printMode="popup";a("[id^='printElement_']").remove();return this.each(function(){var i=a.a?a.extend({},b,a(this).data()):b,d=a(this);d=m(d,i);var f=null,e=null;
if(i.printMode.toLowerCase()=="popup"){f=g.open("about:blank","printElementWindow","width=650,height=440,scrollbars=yes");e=f.document}else{f="printElement_"+Math.round(Math.random()*99999).toString();var h=j.createElement("IFRAME");a(h).attr({style:i.iframeElementOptions.styleToAdd,id:f,className:i.iframeElementOptions.classNameToAdd,frameBorder:0,scrolling:"no",src:"about:blank"});j.body.appendChild(h);e=h.contentWindow||h.contentDocument;if(e.document)e=e.document;h=j.frames?j.frames[f]:j.getElementById(f);
f=h.contentWindow||h}focus();e.open();e.write(d);e.close();k(f)})};a.fn.printElement.defaults={printMode:"iframe",pageTitle:"",overrideElementCSS:null,printBodyOptions:{styleToAdd:"padding:10px;margin:10px;",classNameToAdd:""},leaveOpen:false,iframeElementOptions:{styleToAdd:"border:none;position:absolute;width:0px;height:0px;bottom:0px;left:0px;",classNameToAdd:""}};a.fn.printElement.cssElement={href:"",media:""}})(window);
/*! jQuery Migrate v1.2.1 | (c) 2005, 2013 jQuery Foundation, Inc. and other contributors | jquery.org/license */
jQuery.migrateMute===void 0&&(jQuery.migrateMute=!0),function(e,t,n){function r(n){var r=t.console;i[n]||(i[n]=!0,e.migrateWarnings.push(n),r&&r.warn&&!e.migrateMute&&(r.warn("JQMIGRATE: "+n),e.migrateTrace&&r.trace&&r.trace()))}function a(t,a,i,o){if(Object.defineProperty)try{return Object.defineProperty(t,a,{configurable:!0,enumerable:!0,get:function(){return r(o),i},set:function(e){r(o),i=e}}),n}catch(s){}e._definePropertyBroken=!0,t[a]=i}var i={};e.migrateWarnings=[],!e.migrateMute&&t.console&&t.console.log&&t.console.log("JQMIGRATE: Logging is active"),e.migrateTrace===n&&(e.migrateTrace=!0),e.migrateReset=function(){i={},e.migrateWarnings.length=0},"BackCompat"===document.compatMode&&r("jQuery is not compatible with Quirks Mode");var o=e("<input/>",{size:1}).attr("size")&&e.attrFn,s=e.attr,u=e.attrHooks.value&&e.attrHooks.value.get||function(){return null},c=e.attrHooks.value&&e.attrHooks.value.set||function(){return n},l=/^(?:input|button)$/i,d=/^[238]$/,p=/^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,f=/^(?:checked|selected)$/i;a(e,"attrFn",o||{},"jQuery.attrFn is deprecated"),e.attr=function(t,a,i,u){var c=a.toLowerCase(),g=t&&t.nodeType;return u&&(4>s.length&&r("jQuery.fn.attr( props, pass ) is deprecated"),t&&!d.test(g)&&(o?a in o:e.isFunction(e.fn[a])))?e(t)[a](i):("type"===a&&i!==n&&l.test(t.nodeName)&&t.parentNode&&r("Can't change the 'type' of an input or button in IE 6/7/8"),!e.attrHooks[c]&&p.test(c)&&(e.attrHooks[c]={get:function(t,r){var a,i=e.prop(t,r);return i===!0||"boolean"!=typeof i&&(a=t.getAttributeNode(r))&&a.nodeValue!==!1?r.toLowerCase():n},set:function(t,n,r){var a;return n===!1?e.removeAttr(t,r):(a=e.propFix[r]||r,a in t&&(t[a]=!0),t.setAttribute(r,r.toLowerCase())),r}},f.test(c)&&r("jQuery.fn.attr('"+c+"') may use property instead of attribute")),s.call(e,t,a,i))},e.attrHooks.value={get:function(e,t){var n=(e.nodeName||"").toLowerCase();return"button"===n?u.apply(this,arguments):("input"!==n&&"option"!==n&&r("jQuery.fn.attr('value') no longer gets properties"),t in e?e.value:null)},set:function(e,t){var a=(e.nodeName||"").toLowerCase();return"button"===a?c.apply(this,arguments):("input"!==a&&"option"!==a&&r("jQuery.fn.attr('value', val) no longer sets properties"),e.value=t,n)}};var g,h,v=e.fn.init,m=e.parseJSON,y=/^([^<]*)(<[\w\W]+>)([^>]*)$/;e.fn.init=function(t,n,a){var i;return t&&"string"==typeof t&&!e.isPlainObject(n)&&(i=y.exec(e.trim(t)))&&i[0]&&("<"!==t.charAt(0)&&r("$(html) HTML strings must start with '<' character"),i[3]&&r("$(html) HTML text after last tag is ignored"),"#"===i[0].charAt(0)&&(r("HTML string cannot start with a '#' character"),e.error("JQMIGRATE: Invalid selector string (XSS)")),n&&n.context&&(n=n.context),e.parseHTML)?v.call(this,e.parseHTML(i[2],n,!0),n,a):v.apply(this,arguments)},e.fn.init.prototype=e.fn,e.parseJSON=function(e){return e||null===e?m.apply(this,arguments):(r("jQuery.parseJSON requires a valid JSON string"),null)},e.uaMatch=function(e){e=e.toLowerCase();var t=/(chrome)[ \/]([\w.]+)/.exec(e)||/(webkit)[ \/]([\w.]+)/.exec(e)||/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(e)||/(msie) ([\w.]+)/.exec(e)||0>e.indexOf("compatible")&&/(mozilla)(?:.*? rv:([\w.]+)|)/.exec(e)||[];return{browser:t[1]||"",version:t[2]||"0"}},e.browser||(g=e.uaMatch(navigator.userAgent),h={},g.browser&&(h[g.browser]=!0,h.version=g.version),h.chrome?h.webkit=!0:h.webkit&&(h.safari=!0),e.browser=h),a(e,"browser",e.browser,"jQuery.browser is deprecated"),e.sub=function(){function t(e,n){return new t.fn.init(e,n)}e.extend(!0,t,this),t.superclass=this,t.fn=t.prototype=this(),t.fn.constructor=t,t.sub=this.sub,t.fn.init=function(r,a){return a&&a instanceof e&&!(a instanceof t)&&(a=t(a)),e.fn.init.call(this,r,a,n)},t.fn.init.prototype=t.fn;var n=t(document);return r("jQuery.sub() is deprecated"),t},e.ajaxSetup({converters:{"text json":e.parseJSON}});var b=e.fn.data;e.fn.data=function(t){var a,i,o=this[0];return!o||"events"!==t||1!==arguments.length||(a=e.data(o,t),i=e._data(o,t),a!==n&&a!==i||i===n)?b.apply(this,arguments):(r("Use of jQuery.fn.data('events') is deprecated"),i)};var j=/\/(java|ecma)script/i,w=e.fn.andSelf||e.fn.addBack;e.fn.andSelf=function(){return r("jQuery.fn.andSelf() replaced by jQuery.fn.addBack()"),w.apply(this,arguments)},e.clean||(e.clean=function(t,a,i,o){a=a||document,a=!a.nodeType&&a[0]||a,a=a.ownerDocument||a,r("jQuery.clean() is deprecated");var s,u,c,l,d=[];if(e.merge(d,e.buildFragment(t,a).childNodes),i)for(c=function(e){return!e.type||j.test(e.type)?o?o.push(e.parentNode?e.parentNode.removeChild(e):e):i.appendChild(e):n},s=0;null!=(u=d[s]);s++)e.nodeName(u,"script")&&c(u)||(i.appendChild(u),u.getElementsByTagName!==n&&(l=e.grep(e.merge([],u.getElementsByTagName("script")),c),d.splice.apply(d,[s+1,0].concat(l)),s+=l.length));return d});var Q=e.event.add,x=e.event.remove,k=e.event.trigger,N=e.fn.toggle,T=e.fn.live,M=e.fn.die,S="ajaxStart|ajaxStop|ajaxSend|ajaxComplete|ajaxError|ajaxSuccess",C=RegExp("\\b(?:"+S+")\\b"),H=/(?:^|\s)hover(\.\S+|)\b/,A=function(t){return"string"!=typeof t||e.event.special.hover?t:(H.test(t)&&r("'hover' pseudo-event is deprecated, use 'mouseenter mouseleave'"),t&&t.replace(H,"mouseenter$1 mouseleave$1"))};e.event.props&&"attrChange"!==e.event.props[0]&&e.event.props.unshift("attrChange","attrName","relatedNode","srcElement"),e.event.dispatch&&a(e.event,"handle",e.event.dispatch,"jQuery.event.handle is undocumented and deprecated"),e.event.add=function(e,t,n,a,i){e!==document&&C.test(t)&&r("AJAX events should be attached to document: "+t),Q.call(this,e,A(t||""),n,a,i)},e.event.remove=function(e,t,n,r,a){x.call(this,e,A(t)||"",n,r,a)},e.fn.error=function(){var e=Array.prototype.slice.call(arguments,0);return r("jQuery.fn.error() is deprecated"),e.splice(0,0,"error"),arguments.length?this.bind.apply(this,e):(this.triggerHandler.apply(this,e),this)},e.fn.toggle=function(t,n){if(!e.isFunction(t)||!e.isFunction(n))return N.apply(this,arguments);r("jQuery.fn.toggle(handler, handler...) is deprecated");var a=arguments,i=t.guid||e.guid++,o=0,s=function(n){var r=(e._data(this,"lastToggle"+t.guid)||0)%o;return e._data(this,"lastToggle"+t.guid,r+1),n.preventDefault(),a[r].apply(this,arguments)||!1};for(s.guid=i;a.length>o;)a[o++].guid=i;return this.click(s)},e.fn.live=function(t,n,a){return r("jQuery.fn.live() is deprecated"),T?T.apply(this,arguments):(e(this.context).on(t,this.selector,n,a),this)},e.fn.die=function(t,n){return r("jQuery.fn.die() is deprecated"),M?M.apply(this,arguments):(e(this.context).off(t,this.selector||"**",n),this)},e.event.trigger=function(e,t,n,a){return n||C.test(e)||r("Global events are undocumented and deprecated"),k.call(this,e,t,n||document,a)},e.each(S.split("|"),function(t,n){e.event.special[n]={setup:function(){var t=this;return t!==document&&(e.event.add(document,n+"."+e.guid,function(){e.event.trigger(n,null,t,!0)}),e._data(this,n,e.guid++)),!1},teardown:function(){return this!==document&&e.event.remove(document,n+"."+e._data(this,n)),!1}}})}(jQuery,window);