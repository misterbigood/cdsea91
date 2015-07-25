<?php

	if($_SERVER['SERVER_NAME'] == 'localhost') {

		$database="cdsea";

		$mysql_user = "root";

		$mysql_password = "";

		$mysql_host = "localhost";

		$mysql_table_prefix = "";

	}

	else {

		$database="cdseabddsql";

		$mysql_user = "cdseabddsql";

		$mysql_password = "uTxbklgUO";

		$mysql_host = "mysql51-111.perso";

		$mysql_table_prefix = "";

	}

	$success = mysql_pconnect ($mysql_host, $mysql_user, $mysql_password);

	if (!$success)

		die ("<b>Cannot connect to database, check if username, password and host are correct.</b>");

    $success = mysql_select_db ($database);

	if (!$success) {

		print "<b>Cannot choose database, check if database name is correct.";

		die();

	}

?>



