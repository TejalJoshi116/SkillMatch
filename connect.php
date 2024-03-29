<?php

$user = 'root';
$pass = '';
$db = 'skillmatch';
$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

echo"Worked";

?>