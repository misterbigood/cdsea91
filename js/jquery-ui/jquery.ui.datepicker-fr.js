jQuery(function($){
$.datepicker.regional['fr'] = {
closeText: 'Fermer',
prevText: 'Précédent',
nextText: 'Suivant',
currentText: 'Aujourd\'hui',
monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
monthNamesShort: ['Janv.','Févr.','Mars','Avril','Mai','Juin',
'Juil.','Août','Sept.','Oct.','Nov.','Déc.'],
dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
dayNamesMin: ['D','L','M','M','J','V','S'],
weekHeader: 'Sem.',
altField: '#alt_date',
altFormat: 'yyyy-mm-dd', // format envoyé
dateFormat: "dd MM yy",//"DD dd MM yy", // format affiché. EX : Samedi 22 Décembre 2012
firstDay: 1,
isRTL: false,
showMonthAfterYear: false,
yearSuffix: ''};
$.datepicker.setDefaults($.datepicker.regional['fr']);
});