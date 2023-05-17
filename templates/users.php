<?php

// Initialize the session
session_start();

// Check if user is an Admin

if($_SESSION["role"] != 1)
{
    header("Location: /panel");
}

// Connect to the DB
include_once root . "/logic/native/dbconnect.php";

// Include getusers and getgroups function
include_once root . "/logic/users/renderusers.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage users and groups</title>
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
	    <div id="sidebardiv" class="col-2 p-0 sticky-top">
        <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Manage users</h3>
                </div>

                <ul class="list-unstyled components">
                    <li>
                        <a href="/panel">Return to panel</a>
                    </li>

                    <li>
                        <a href="/logout">Logout</a>
                    </li>

                </ul>
            </nav>  

		</div>
    
        
        <div class="col-10" style="background-color:rgb(242, 242, 242);">
            <div class="wrapper m-5 p-5 rounded" style="background-color: rgba(200, 200, 200, 0.6);">
                <h3>>User list</h3>
                <br>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Change Role</th>
                        <th>Change password</th>
                        <th>Delete a user</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php renderusers($conn); ?>
                    </tbody>
                </table>
                </br>
                <h3>>Register a new user</h3>
                <br>
                
                <div class="form-inline">
                <div class="form-group">
                    <label class="sr-only" for="username">Username:</label>
                    <input type="username" class="form-control" placeholder="username:" id="username" name="username">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="pwd">Password:</label>
                    <input type="password" class="form-control" placeholder="password:" id="password" name="password">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="role">Role:</label>
                    <select class="form-control" placeholder="role" id="role" name="role">
                    <option>user</option>
                    <option>admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" id="register">Submit</button>
                <div id="error"></div>
                </div>
                

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