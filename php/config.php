<?php
   define('DB_SERVER', '127.0.0.1'); // 'localhost' 127.0.0.1
   define('DB_USERNAME', 'lithathampan'); //application user
   define('DB_PASSWORD', 'lithathampanpass');
   define('DB_DATABASE', 'lithathampandatabase');
   $db = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE, DB_USERNAME, DB_PASSWORD);
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $currency = "$";
?>