<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="initial-scale=1.0,width=device-width">
		<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
		<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
		<meta name="msapplication-TileColor" content="#2d89ef">
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="js/uploadify/uploadify.css">

        <!--[if lt IE 9]>
            <script type="text/javascript" src="js/html5-3.6-respond-1.1.0.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
		<div id="conteneur">
			<div id="conteneurInner">
				<section id="contenu">
				<form>
					<input id="photo1" name="photo1" type="file" class="uploadify">
					<input id="photo2" name="photo2" type="file" class="uploadify">
				</form>		
				</section> <!-- #contenu -->
			</div> <!-- #conteneurInner -->
		</div> <!-- #conteneur -->
		<?php include_once('inc/footer.php'); ?>
		<div id="divAjax"></div>
		<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="js/uploadify/jquery.uploadify.js"></script>
		<script type="text/javascript">
			<?php $timestamp = time();?>
			$(function() {
				var champs = $('.uploadify');
				$.each(champs, function(index) {
					$(this).wrap('<div class="uploadifyWrapper"></div>');
					var champID = $(this).attr('id');console.log(champID);
					$('#' + champID).uploadify({
					'formData'     : {
						'timestamp' : '<?php echo $timestamp;?>',
						'token'     : '<?php echo md5('salt_unique' . $timestamp);?>'
					},
					'swf'      : 'js/uploadify/uploadify.swf',
					'uploader' : 'js/uploadify/php/uploadify.php',
					'buttonClass' : 'btn',
					'fileTypeDesc' : 'images',
					'fileTypeExts' : '*.jpg; *.jpeg; *.png; *.gif',
					'onSelectError' : function() {
						alert('Le fichier ' + file.name + ' a généré une erreur : ');
					},
					'onUploadError' : function(file, errorCode, errorMsg, errorString) { // http error only
						alert('Le fichier ' + file.name + ' n\'a pas pu être téléchargé : ' + errorString);
					},
					'onUploadCustomError' : function(file, errorTxt) { // file upload error
						$('#' + file.id + ' > span.data').addClass('alerte').html('<br>' + errorTxt);
					},
					'onUploadSuccess' : function(file, data, response) {
						var retour = JSON.parse(data); // retour.logRetour ; retour.display ; retour.nomFichier ; retour.error
						//console.log(retour.logRetour);
						//console.log(champID);
						//console.log(file.id);
						if(retour.error != '') {
							this.settings.onUploadCustomError.call(this, file, retour.error);
						}
						else {
							$('#' + champID).hide(200, function() {
								$('<div />').attr({'class': 'uploadResult', 'id': champID + 'UploadResult'}).insertAfter($('#' + champID)).html(retour.display).show();
								$('<input />').attr({'type': 'hidden', 'name': champID}).val(retour.nomFichier).appendTo('#' + champID + 'UploadResult');
							});
							var cancelBtn = $('<a />').addClass('btnCancelUpload').attr('href', "javascript:$('#" + champID + "').uploadify('cancel', '*')").text('annuler').appendTo($('#' + file.id));
							cancelBtn.on('click', function() {
								$.ajax({
									url : 'js/uploadify/php/supprimerPhoto.php', 
									data : 'photo=' + file.name + '&repertoire1=uploads/&repertoire2=uploads/zoom/',
									complete : function(xhr, result) {
										var response = xhr.responseText;
										//console.log(response);
										$('#' + champID + 'UploadResult').hide(200, function() {
											$('#' + champID + 'UploadResult').empty();
											$('#' + file.id).hide().remove();
											$('#' + champID).show();
										});
									}
								});
							});
						}
					}
				});
			});
		});
		</script>
    </body>
</html>
