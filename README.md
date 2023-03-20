# webtor-php-api-wrapper
PHP Wrapper around webtor.io API

The code is a wrapper for the webtor.io API. It allows you to get the resource id from a magnet link, list the contents of a resource id, export a content from a resource id and get the name of a content from a resource id.

It also has some additional functions that are not part of the API, such as checking whether a torrent contains video content and finding subtitles in a torrent.

Usage example:
```php
<?php
	require 'webtor-class.php';
	$webtor = new webtor();

	$magnet = "magnet:?xt=urn:btih:B62D475DD1E7E8E337B72D041638C085B18A47B2&dn=Good+Luck+to+You%2C+Leo+Grande+%282022%29+%5B720p%5D+%5BYTS.MX%5D&tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969%2Fannounce&tr=udp%3A%2F%2F9.rarbg.to%3A2710%2Fannounce&tr=udp%3A%2F%2Fp4p.arenabg.ch%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.cyberia.is%3A6969%2Fannounce&tr=http%3A%2F%2Fp4p.arenabg.com%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.internetwarriors.net%3A1337%2Fannounce";

	$resourceid = $webtor->GetResourceID($magnet);
	echo $resourceid;

?>
```
