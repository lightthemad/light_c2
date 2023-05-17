<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php 

//Include different libs according to requested URI
if($_SERVER["REQUEST_URI"] == "/")
{
    echo "<link rel='stylesheet' href='css/home.css'>";
    echo "<script src='js/auth.js'></script>";
}  
elseif($_SERVER["REQUEST_URI"] == "/users")
{
    echo "<link rel='stylesheet' href='css/main.css'>";
    echo "<script src='js/register.js'></script>";
}
elseif($_SERVER["REQUEST_URI"] == "/panel")
{
    echo "<link rel='stylesheet' href='css/main.css'>";
    echo "<script src='js/beacon.js'></script>";
}
else
{
    echo "<link rel='stylesheet' href='css/main.css'>";
}

?>
