<?php session_start();
include('/menu.php');
require 'class.phpmailer.php';

echo '<script>

function validateEmail() {
    var x = document.forms["send"]["email"].value;
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (re.test(x) == false) {
        alert("Invalid email. Please try again!");
        return false;
    }
}

</script>'; 

$dbtype="mysql";
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "sjsu";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) { // receiving "get" data 

$sjsuid = $_GET["sjsuid"];
$response_id = $_GET["id"];

$shell_resp = shell_exec("C:/python27/python.exe C:/wamp64/www/python/WebInterface.py ".$response_id);

echo $shell_resp;

if ( $dbtype == "mysql") {
// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$query = 'SELECT SJSU_ID, Rec_Major FROM User_Response where User_Response_ID="'.$response_id.'"';


if ($result = $mysqli->query($query)) {

    /* fetch associative array */
    $row = $result->fetch_assoc();
		$Rec_Major = $row["Rec_Major"];
	    echo '<br><div class="container">';
		echo '<table class="white" border="1"><tr><td>SJSU ID</td><td>Recommended Major</td></tr>';
        echo '<tr><td>'.str_pad($row["SJSU_ID"], 9, "0", STR_PAD_LEFT).'</td><td>'.$row["Rec_Major"].'</td></tr>';
		echo '</table></div>';
    /* free result set */
    $result->free();
}
/* close connection */
$mysqli->close();

}
}

//email input form
$_SESSION['Rec_Major'] = $Rec_Major;
echo '<div class="container"><br>';
echo '<span class="white">Email: </span>';
echo '<form name="send" id="send" method="post" action="send-email.php" onsubmit="return validateEmail()">
<input type="text" name="email" style="height: 28px;width: 200px;font-size: large;">
<input type="submit" value="Submit" style="width: 64px;height: 28px;font-size: large;">
</form></div>';

?>