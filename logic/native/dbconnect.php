<?php

$json = file_get_contents(root . "/logic/config/db.json");

$dbconf = json_decode($json, true);

try

{
  	$conn = new PDO("mysql:host=$dbconf[host];dbname=$dbconf[database]", $dbconf['username'], $dbconf['password']);
  	// set the PDO error mode to exception
  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//  	echo "Database connected successfully";
//	echo "<br><br>";
}

catch(PDOException $e)

{
  echo "Connection failed: " . $e->getMessage();
  die();
}
