<?php 

try
{
$pdo = new PDO('mysql:host=localhost;dbname=moviesite', 'movie','Eastern1957');
$pdo->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec ('SET NAMES "utf8"');
}
catch (PDOException $e)
{
echo $e->getMessage ();
exit ();
}




?> 