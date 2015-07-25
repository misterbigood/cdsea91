<!DOCTYPE html>
<html lang="fr">
<head>
<title>Login Page</title>
<link href="css/normalize.css" rel="stylesheet" type="text/css">
<link href="css/admin.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="login">
    <form action="accueil.php" method="post">
	<div><input type="hidden" name="action" value="login"></div>
	<fieldset>
	<legend>ADMINISTRATION</legend>
	<p>
		<label for="userName">Identifiant : </label>
		<input type="text" name="userName">
	</p>
	<p>
		<label for="userName">Mot de passe : </label>
		<input type="password" name="userPass">
	</p>
    <div class="centre"><button type="submit" value="Login" class="btn-green">VALIDER</button></div> 
	</fieldset>
    </form>
</div>
</body>
</html>