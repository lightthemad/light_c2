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

    if($_POST["user"]=="admin")
    {
        header("Location: /users");
    }

    // Connect to the DB
    include_once root . "/logic/native/dbconnect.php";

    // Prepare delete statement
    $u = "DELETE from users where username= :username";
         
    $b = $conn->prepare($u);
    
    // Bind variables to the prepared statement as parameters
    $b->bindParam(":username", $_POST['user'], PDO::PARAM_STR);

    // Attempt to execute the prepared statement
    $b->execute();
    
    // Redirect to users page
    header("location: /users");
        
    // Close the DB connection 
    require_once root . "/logic/native/dbclose.php";
}

else
{
    header("location: /users");
}