<?php
 
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: /panel");
    exit;
}
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    // Connect to the DB
    include_once root . "/logic/native/dbconnect.php";

    // Define variables and initialize with empty values
    $username = $password = "";
 
    // Check if username is empty
    if(empty(trim($_POST["username"])) || empty(trim($_POST["password"])))
    {
        die();
    } 
    
    else
    
    {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
    }
    
    
    // Validate credentials
    if(empty($username_err) && empty($password_err))
    {
        // Prepare a select statement
        $sql = "SELECT username, password, role FROM users WHERE username = :username";
        
        $stmt = $conn->prepare($sql);
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        
        // Set parameters
        $param_username = $username;
        
        
        try 
        {
            // Attempt to execute the prepared statement
            $stmt->execute();
            // Check if username exists, if yes then verify password
            if($stmt->rowCount() == 1)
            {
                if($row = $stmt->fetch())
                {
                    $username = $row["username"];
                    $hashed_password = $row["password"];
                    $role = $row["role"];
                    
                    $password = hash('sha256', $_POST['password']);
                    if($password == $hashed_password)
                    {
                        // Password is correct, so start a new session
                        session_start(); 
                        
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["role"] = $role;
                        $_SESSION["username"] = $username;                            
                        
                    } 
                    
                    else
                    
                    {
                        // Password is not valid, display a generic error message
                        echo 2;
                        die();
                    }
                }
            } 
            
            else
            
            {
                // Username doesn't exist, display a generic error message
                echo 2;
                die();
            }
        }
        catch(PDOException $e)
        {
            echo 3;
            die();
        }

        echo 1;
        // Close statement
        unset($stmt);
    }

    // Close the DB connection 
    require_once root . "/logic/native/dbclose.php"; 

}
