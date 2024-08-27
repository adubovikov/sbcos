<?php

// Wir werden eine PDF Datei ausgeben
header("Content-Type: application/gzip");
// Es wird downloaded.pdf benannt
header("Content-Disposition: attachment; filename=\"network.tar.gz\"");

// Die originale PDF Datei heißt original.pdf
readfile("/var/www/html/files/".$mac."/network.tar.gz");

exit;

?>