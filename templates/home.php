<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: /panel");
    exit;
}

// Check if the database is set up correctly
include_once root . "/logic/native/isinstalled.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include_once "libs.php"; ?>
  
</head>
<body>

<div class="container-fluid">
	<div class="row">
	    <div id="sidepanel" class="col-3">
            <div class="h-100 row align-items-center">
                <div class="col" style="word-wrap: break-word;">
                <h1 class="display-4 text-light text-center"> Simple <kbd id="kdb" style="color:red">C2 Server</kbd> in three days!</h1>
                </div>
            </div>
		</div>
        
	<div id="main" class="col-9">
        <div class="d-flex align-items-center justify-content-center h-100">
                <div id="login" class="wrapper m-5 p-5 rounded" style="background-color: rgba(230, 230, 230, 0.6);">
                    <h2>Login</h2>
                    <p>Please fill in your credentials to login.</p>
                    
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" id="username" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="button" class="btn btn-primary" value="Login" id="auth">
                            <?php if(isinstalled()==False) echo("<a class='btn btn-primary' href='/install'>install</a>"); ?>
                            <br></br>
                            <div id="error"></div>
                        </div>
                    
                </div>
        </div>
    </div>

</div>

</body>
</html>
