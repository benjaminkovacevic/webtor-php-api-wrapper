<?php
	// Error reporting 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	// Include webtor class
	require 'webtor-class.php';
	$webtor = new webtor();

	$magnet = "magnet:?xt=urn:btih:B62D475DD1E7E8E337B72D041638C085B18A47B2&dn=Good+Luck+to+You%2C+Leo+Grande+%282022%29+%5B720p%5D+%5BYTS.MX%5D&tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969%2Fannounce&tr=udp%3A%2F%2F9.rarbg.to%3A2710%2Fannounce&tr=udp%3A%2F%2Fp4p.arenabg.ch%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.cyberia.is%3A6969%2Fannounce&tr=http%3A%2F%2Fp4p.arenabg.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.internetwarriors.net%3A1337%2Fannounce";

	$resourceid = $webtor->GetResourceID($magnet);

	echo $resourceid;

?>