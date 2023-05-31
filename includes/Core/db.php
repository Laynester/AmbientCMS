<?php
if (!defined('AmbientCMS')) {
	die('Sorry but you cannot access this file!');
}
try {
	$conn = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['db'] . '', $db['user'], $db['pass']);
} catch (PDOException $e) {
	echo ("<div style='padding:15px;
		border: 1px solid maroon !important;
		color: #000;
		background: #FFA07A;
		display: table;
		margin: 0 auto;
		font-size: 15px;
		font-family: Tahoma;border-radius:7px;'><b>AmbientCMS Configuration Error:</b><br>I was unable to connect to the provided MySQL server. Please ask the administrator to review the error message log for details.</div>");
	die();
}
