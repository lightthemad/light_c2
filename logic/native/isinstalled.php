<?php

function isinstalled()
{

// Connect to the DB
include_once root . "/logic/native/dbconnect.php";

// Check if the table exists

$stmt = $conn->prepare("SELECT 1 FROM users");

try 
{
    $stmt->execute();
}

catch(PDOException $e)

{
  return False;
}

// Check if users exist
$a = $conn->prepare("SELECT * FROM users WHERE username=:admin");

$admin="admin";

$a->bindParam(':admin', $admin);

$a->execute();


if($a->rowCount()!=1)
{
    return False;
}


// Close statements
unset($stmt);
unset($a);

// Close connection
unset($conn);

return True;

//close the DB connection 
require_once root . "/logic/native/dbclose.php"; 

}