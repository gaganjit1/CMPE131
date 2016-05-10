<?php
include('/menu.php');

$password="";

echo '<script>

function validate() {
    var x = document.forms["admin"]["password"].value;
    if (x != "admin") {
        alert("Wrong password. Try again!");
        return false;
    }
}

</script>'; 

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
echo '<form name="admin" id="admin" method="post" action="admin.php" onsubmit="return validate()">
<input type="password" name="password" style="height: 28px;width: 154px;font-size: large;"></input>
<input type="submit" value="Submit" style="width: 64px;height: 28px;font-size: large;">
</form></div>';
	
}