(function($)
{

/*===========================================

// vars (exemple) : 'var1=valeur&var2=valeur2'
// resize = true pour afficher sur toute la page. DEFAUT = true
// styleDisplay = 'block' ou 'inline'  DEFAUT = 'block'
// btnFermer = true ou false. DEFAUT = false
// appear (exemple) : 200 = opacité de 0 à 1 en 200 ms OU appear = 'slide'
// divAjaxContenu = true ou false. DEFAUT = true // '<div class="ajaxContenu"></div>'
// append = true ou false. DEFAUT = false
// lang = 'fr', 'en', 'de'. defaut : 'fr'
// asynchrone : true ou false. DEFAUT = false

$(this).ajax({'url' : 'exemple.php', 'vars': 'var1=a&amp;var2=z'});

===========================================*/

	$.fn.ajax = function(options)
	{
	   //On définit nos paramètres par défaut
		var defauts=
		{
			'url' : '',
			'vars': '', // exemple : var1=1&var2=2 ; possible de passer 1 tableau associatif ou du JSON
			'divID': this.attr('id'),
			'resize': true,
			'styleDisplay': 'block',
			'btnFermer': false,
			'appear': 200,
			'divAjaxContenu': true,
			'append': false,
			'asynchrone': true, // si false, bloque imgLoader sous IE
			'type': 'GET',
			'imgLoader': 'http://www.cdsea91.fr/images/ajax-loader.gif'
		};

		//On fusionne les deux objets (options et defauts)
		var parametres = $.extend(defauts, options);
		parametres.vars = parametres.vars.replace('&amp;', '&');
		if(parametres.type == 'GET') parametres.vars = encodeURI(parametres.vars);
		var imgLoader = '<div class="centre" id="AjaxLoaderDiv"><img src="' + parametres.imgLoader + '" alt="" /></div>';
		var chargement = '<p class="centre">chargement en cours ...</p>';
		if (parametres.btnFermer == true) {
			var fermer = '<p>&nbsp;</p><div class="centre"><a href="#" class="btn" onclick="fermer(\'' + parametres.divID + '\');">fermer</a></div>';
		}

		/*========= NBRE DE REQUETES =========*/

		if (typeof nbreRequetes == "undefined") var nbreRequetes=1;
		else if(nbreRequetes=='NULL') nbreRequetes=1;
		else nbreRequetes+=1;

		/*========= AJAX DEFAUT SETUP =========*/

		$.ajaxSetup({
  			async: parametres.asynchrone,
			type: parametres.type,
			dataType: 'html',
			context: this
		});

		/*========= ENVOI AJAX =========*/

		$.ajax({
			url: parametres.url,
			data: parametres.vars,
			beforeSend: function() {

				/*========= IMG LOADER =========*/

				if(parametres.styleDisplay == 'block' && parametres.appear == 0) {
					this.html(imgLoader + chargement);
					this.css('display', 'block');
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
			  	// En cas d'erreur, on le signale
			  	nbreRequetes-=1;
				if(nbreRequetes==0) {
					this.html('').html('<div class="error">Une erreur est survenue lors de la requête.</div>');
					nbreRequetes = null;
					return false;
				}
			},
			success: function(data, textStatus, jqXHR) {
			  	nbreRequetes-=1;
			  	if(nbreRequetes==0) {
					if(parametres.divAjaxContenu != false) {
                		var retour = '<div class="ajaxContenu">';
            		}
            		else var retour = '';
					retour += data;
					if(parametres.btnFermer == true) {
						retour += fermer;
					}
					if(parametres.divAjaxContenu != false) {
						retour += '</div>';
					}
					nbreRequetes = null;

					if(parametres.appear == 'slide') {
						var divSlide  = $('<div />').addClass('divSlide').attr('id', 'divSlide').html(retour).css('margin-left', '-1000px');
						this.prepend(divSlide);
					}

					else {
						if (parametres.appear > 0) {
							this.css('opacity', 0);
						}
						if(parametres.append == false) this.html(retour);
						else this.append(retour);
					}

					if(parametres.resize == true) {

						var hauteurFenetre = $('body').outerHeight();
						var conteneur=$('#conteneur');
						var hauteurConteneur = conteneur.outerHeight(); // 150 = banniere

						this.css('top', 0);
						scrollTo(0,0);

						if(typeof (parametres.styleDisplay) != 'undefined') {
							this.css('display', parametres.styleDisplay);
						}

						if(this.css('display') != 'none') {
							var hauteurDivAjax = this.outerHeight();
							if(hauteurFenetre > hauteurConteneur) {
								if(hauteurFenetre > hauteurDivAjax) {
									this.css('height', hauteurFenetre);
								}
							}
							else if(hauteurConteneur > hauteurDivAjax) {
								if(hauteurFenetre > hauteurDivAjax) {
									this.css('height', hauteurConteneur);
								}
							}
							if(hauteurDivAjax > hauteurConteneur) {
								$('conteneur').attr('class', hauteurConteneur); // on mémorise la hauteur du conteneur, quand on fermera on rétablira cette hauteur
								$('conteneur').css('height', hauteurDivAjax + 106);
								this.css('padding-bottom', '124px');
							}
							if($('html').hasClass('no-rgba')) { /* modernizr class */
								this.css('background', '#21454D');
							}
						}
					}

					else if(typeof (parametres.styleDisplay) != 'undefined') {
						this.css('display', parametres.styleDisplay);
					}

					if (parametres.appear > 0) {
						this.animate({
    						opacity: 1,
							duration: parametres.appear
						});
					}

					else if(parametres.appear == 'slide') {
						divSlide.animate({
    						'margin-left': 0,
							duration: 1000},
						function() { // Animation complete.
							divSlide.removeAttr('id');
						});
					}

					else this.css('opacity', 1);
					if(typeof(js) != "undefined" && $.isFunction(js)) js(this);
					return this;
				}
			}
	  	});
	};
})(jQuery);

function fermer(div)
{
	var div=$('#' + div);
	div.animate({
		'opacity': 0,
		'duration': 300
		}, function() {
			div.css('display', 'none');
		}
	);
	if($('#conteneur') && $('#conteneur').attr('class')) {
		$('conteneur').css('height', $('conteneur').attr('class') + 'px');
		$('conteneur').removeClass();
	}
	return false;
}

function printMsgOK(divID, email)
{
    div = $('#' + divID);
	var msg = $('<p />').text('message envoyé à l\'adresse ' + email + '<br />');
	div.append(msg);
    div.css('display', 'block');

    // actualiser la page

    var rafraichir = $('<div />').addClass('btn nowrap');
    var lien = $('<a />').attr('href', '#').html('<span class="icon icon-loop"></span>rafraichir la page');
    lien.click(function() {
		location.assign(location.href);
		return false;
	});
    rafraichir.append(lien);
    div.append(rafraichir);

    var divFermer = $('<div />').addClass('btn nowrap');
    var lien2 = $('<a />').attr('href', '#').html('<span class="icon icon-cancel-round"></span>fermer');
    lien2.click(function() {
		fermer(divID);
	});
    divFermer.append(lien2);
    div.append(divFermer);
}

function printModificationsOK(divID)
{
    var div=$('#' + divID);

    var tableau = $('<table />');
	var ligne1 = $('<tr />');
    var ligne2 = $('<tr />');
	var td1 = $('<td />').attr('colspan', 2);
    var td2 = $('<td />');
    var td3 = $('<td />');

    var maj = $('<p />').text('mise à jour effectuée.');

    var rafraichir = $('<div />').addClass('btn nowrap');
    var lien = $('<a />').attr('href', '#').html('<span class="icon icon-loop"></span>rafraichir la page');
    lien.click(function() {
		location.assign(location.href);
		return false;
	});
    rafraichir.append(lien);

    var divFermer = $('<div />').addClass('btn nowrap');
    var lien2 = $('<a />').attr('href', '#').html('<span class="icon icon-cancel-round"></span>fermer');
    lien2.click(function() {
		fermer(divID);
	});
    divFermer.append(lien2);

	td1.append(maj);
	td2.append(rafraichir);
	td3.append(divFermer);
	ligne1.append(td1);
	ligne2.append(td2).append(td3);
	tableau.append(ligne1).append(ligne2);
    div.append(tableau);
    div.css('display', 'block');
}

function printEchecMiseAJour(divID)
{
	var div=$('#' + divID);

    var tableau = $('<table />');
	var ligne1 = $('<tr />');
    var ligne2 = $('<tr />');
	var td1 = $('<td />').attr('colspan', 2);
    var td2 = $('<td />');
    var td3 = $('<td />');

    var maj = $('<p />').addClass('alerte').text('echec de la mise à jour.');

    var rafraichir = $('<div />').addClass('btn nowrap');
    var lien = $('<a />').attr('href', '#').html('<span class="icon icon-loop"></span>rafraichir la page');
    lien.click(function() {
		location.assign(location.href);
		return false;
	});
    rafraichir.append(lien);

    var divFermer = $('<div />').addClass('btn nowrap');
    var lien2 = $('<a />').attr('href', '#').html('<span class="icon icon-cancel-round"></span>fermer');
    lien2.click(function() {
		fermer(divID);
	});
    divFermer.append(lien2);

	td1.append(maj);
	td2.append(rafraichir);
	td3.append(divFermer);
	ligne1.append(td1);
	ligne2.append(td2).append(td3);
	tableau.append(ligne1).append(ligne2);
    div.append(tableau);
    div.css('display', 'block');
}

function printEnvoiProgramme(divID, dateEnvoi)
{
    var div = $('#' + divID);
	var maj = $('<p />').addClass('centre').text('envoi programmé le ' + dateEnvoi);
    div.append(maj).css('display', 'block');

    var divFermer = $('<div />').addClass('btn nowrap');
    var lien2 = $('<a />').attr('href', '#').html('<span class="icon icon-cancel-round"></span>fermer');
    lien2.click(function() {
		fermer(divID);
	});
    divFermer.append(lien2);
    div.append(divFermer);
}

function effacerForm(form)
{
    $('#' + form).get('input, textarea').each( function(e) {
        if(e.attr('type') != 'hidden' && e.attr('type') != 'radio' && e.attr('type') != 'button') e.attr('value', '');
    });
}