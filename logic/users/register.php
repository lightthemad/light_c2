<?php
 
// Processing form data when form is submitted
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


    // Define variables and initialize with empty values
    $username = $password = $confirm_password = "";

    // Validate username
    if(empty(trim($_POST["username"])))
    {
        die();
    } 

    elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"])))
    {
        die();
    } 

    else
    {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        // Set parameters
        $param_username = trim($_POST["username"]);
        // Attempt to execute the prepared statement
        $stmt->execute();
    
        if($stmt->rowCount() == 1)
        {
            echo 2;
            die();
        } 

        else
        {
            $username = trim($_POST["username"]);
        }

        // Close statement
        unset($stmt);
        
    }
    
    // Validate password
    if(strlen(trim($_POST["password"])) < 6)
    {
        echo 3;
        die(); 
    } 

    else
    {
        $password = trim($_POST["password"]);
    }
    
    // Set roles
    if($_POST["role"]=="admin")
    {
        $param_role=1;
    }

    else
    {
        $param_role=0;
}

    
        
    // Prepare an insert statement
    $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
         
    if($stmt = $conn->prepare($sql))
    {
         // Bind variables to the prepared statement as parameters
         $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
         $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
         $stmt->bindParam(":role", $param_role, PDO::PARAM_INT);
            
        // Set parameters
        $param_username = $username;
        $param_password = hash('sha256', $password); // Creates a password hash
            
        // Attempt to execute the prepared statement
        if($stmt->execute())
        {
            echo 1;
        } 

    }

    // Close the DB connection 
    require_once root . "/logic/native/dbclose.php";

}

else
{
    header("location: /users");
}

