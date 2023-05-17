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

    if($_POST['user']=="admin")
    {
        header("Location: /users");
    }

    // Connect to the DB
    include_once root . "/logic/native/dbconnect.php";

    // Prepare update statement
    $up = "UPDATE users SET role=:role WHERE username= :username";

    $update = $conn->prepare($up);

    // Bind variables to the prepared statement as parameters
    $update->bindParam(":username", $_POST['user'], PDO::PARAM_STR);
    $update->bindParam(":role", $_POST['newrole'], PDO::PARAM_STR);
   
    // Attempt to execute the prepared statements
    if($update->execute())
    {
        // Redirect to users page
        header("location: /users");
    } 
    else
    {
        echo "Oops! Something went wrong. Please try again later.";
    }

    


    // Close the DB connection 
    require_once root . "/logic/native/dbclose.php";
}

else
{
    header("location: /users");
}