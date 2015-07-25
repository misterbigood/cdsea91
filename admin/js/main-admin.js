$(document).ready(function(){
	if($('form')[0]) {
		$('form').addFormCheckedButtons().sizeLabels();
		$('select, input[type="checkbox"], input[type="radio"]').uniform();
	}
});