<?php
include('menu.php');

$password="";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$password = $_POST['password'];
}

if($password == "admin")
{
/* todo set admin login cookie so we dont need password everytime
$user = array(
    'id' => "admin",
    'login' => $login
)

-- login
setcookie("loginCredentials", $user, time() * 7200); 

-- logout
setcookie("loginCredentials", "", time() - 3600); 
*/
        include("secure.php");
}
else
{
//admin login form
echo '<div class="container"><br>';
echo '<span class="white">Admin password: </span>';
echo '<form name="admin" id="admin" method="post" action="admin.php" onsubmit="return validateForm()">
<input type="password" name="password"></input>
<input type="submit" value="Submit">
</form></div>';
	
}