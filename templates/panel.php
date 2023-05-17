<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes, then redirect him to the login page
if($_SESSION["loggedin"] == false)
{
    header("location: /");
    exit;
}

// Check if the user is an Admin
if($_SESSION["role"] == 1)
{   
    // Set links for admin account
    $users="<li><a href='/users'>Manage users</a></li>";
}
else
{
    // Unset the variables if the user is not an Admin
    unset($users);
}

// Connect to the DB
include_once root . "/logic/native/dbconnect.php";

// Include getbeacons function
include_once root . "/logic/beacons/renderbeacons.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include_once "libs.php"; ?>
</head>
<body>

<div class="container-fluid">

    <div id="header" class="row shadow align-items-center">
        <h1 id="headertext"><?php echo "Welcome, " . $_SESSION["username"]; ?></h1> 
    </div>

	<div class="row">
	    <div id="sidebardiv" class="col-2 p-0">
        <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Panel</h3>
                </div>

                <ul class="list-unstyled components">
                    
                    <?php echo $users; ?>

                    <li>
                        <a href="/logout">Logout</a>
                    </li>

                </ul>
            </nav>  

		</div>
    
        
        <div class="col-10" style="background-color:rgb(242, 242, 242);">
            <div class="wrapper m-5 p-5 rounded" style="background-color: rgba(200, 200, 200, 0.6);">
                <h3>>Beacon list</h3>
                <br>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Victim IP</th>
                        <th>Last active</th>
                        <th>Execute</th>
                        <th>Command</th>
                        <th>Result</th>
                        <th>Get the file</th>
                        <th>TERMINATE</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php renderbeacons($conn); ?>
                    </tbody>
                </table>
                <br>
                <h3>>Create a new beacon</h3>
                <br>
                <div class="form-inline">
                <button type="submit" class="btn btn-primary" id="create_beacon">Create</button>
                <div id="error"></div>
                </div>
                </br>

            </div>
        </div>
        
    </div>

</div>

</body>
</html>

<?php

//close the DB connection 
require_once root . "/logic/native/dbclose.php";

?>