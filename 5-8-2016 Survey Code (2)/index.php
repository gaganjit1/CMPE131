<?php
require 'class.phpmailer.php';
echo '<script>

function validateForm() {
    var x = document.forms["studentid"]["sjsuid"].value;
    if (( x.length != 9 ) || (x.match(/[a-z]/i)) ) {
        alert("SJSU ID not found. Please use your SJSU 9 digit ID.");
        return false;
    }


}




</script>'; 

echo '<script> 


function elsepart(){
		if ( $dbtype == "mysql") {
		// Create connection
		$mysqli = new mysqli($servername, $username, $password, $dbname);
		if ($mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error);
			exit();
		}
		$query = "SELECT SJSU_ID FROM User_Response";


		if ($result = $mysqli->query($query)) {
			/* fetch associative array */
			$row = $result->fetch_assoc();	
					$SJSUID = $row["SJSU_ID"];
			
			
			/* free result set */
			$result->free();
			
		}
		/* close connection */
		$mysqli->close();
		
		if ($SJSUID == x){
			alert("SJSU already used. Please use your SJSU 9 digit ID.");
			return false;
		}
}

</script>';

include('/menu.php');

//student login form
echo '<div class="container"><br>';
echo '<h2 class="white">The Smart Major</h2>
<h3 class="pink">A smart  way to start your future</h3>';

echo '<br>';
echo '<span class="white">SJSU Login: </span>';
echo '<form name="studentid" id="studentid" method="get" action="survey.php" onsubmit="return validateForm()">
<input type="text" name="sjsuid"></input>
<input type="submit" value="Submit">
</form></div>';

?>