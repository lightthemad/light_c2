<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Initialize the session
    session_start();

    // Check if user is an Admin
    if($_SESSION["role"] != 1)
    {
        header("Location: /panel");
    }

    // Connect to the DB
    include_once root . "/logic/native/dbconnect.php";

    $password=hash('sha256', $_POST['pass']);

    // Prepare update statement
    $sql = "UPDATE users SET password=:password WHERE username= :username";
         
    if($stmt = $conn->prepare($sql))
    {
         // Bind variables to the prepared statement as parameters
         $stmt->bindParam(":username", $_POST['user'], PDO::PARAM_STR);
         $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            
        // Attempt to execute the prepared statement
        if($stmt->execute())
        {
            // Redirect to users page
            header("location: /users");
        } 

        else
        {
            echo "Oops! Something went wrong. Please try again later.";
        }

    }


    // Close the DB connection 
    require_once root . "/logic/native/dbclose.php";
}

else
{
    header("location: /users");
}