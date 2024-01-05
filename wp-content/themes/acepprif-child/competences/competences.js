function openClose(button) {
	var formId = button.getAttribute('data-form-id');
	var form = document.getElementById(formId);
	jQuery(form).slideToggle('slow', 'linear');
	jQuery(form).toggleClass('closed');

	if (jQuery(form).hasClass('closed')) {
		button.innerHTML='Questionner / Évaluer';
	}
	else {
		button.innerHTML='Questionner / Évaluer ';
		console.log(button.innerHTML);
	}
}

jQuery(function() {
	var hasChange = false;

	jQuery('.bloc_questionner_form textarea').keyup(function(e) {
		hasChange = true;
	});
	window.addEventListener('beforeunload', function(e) {
		if (hasChange) {
			e.returnValue = true;
			hasChange = false;
			return true;
		}
	});

	jQuery('.btn_print').click(function() {
		if (hasChange) {
			hasChange = false;
		}
		window.print();
	});
	
	jQuery('.open-close').click(function() {
		openClose(this);
	});
});
