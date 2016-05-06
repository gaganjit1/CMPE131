<?php
//$dbtype="mssql";
$dbtype="mysql";
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "sjsu";

echo '<div class="container" style="overflow: auto;">';	
echo '<table class="white" border="1" style="font-size:18px;"><tr><td>SJSU ID</td> ';
$i=1;
		while ( $i < 21 ) {
			echo '<td>Question '.$i.'</td>';
			$i=$i+1;
		}

echo '</tr>'; 
if ( $dbtype == "mysql") {
// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$query = "SELECT * FROM User_Response";
if ($result = $mysqli->query($query)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
		echo '<tr>';
        echo '<td>'.str_pad($row["SJSU_ID"], 9, "0", STR_PAD_LEFT).'</td>';
		$i=1;
		while ( $i < 21 ) {
			echo '<td>'.$row["Q$i"].'</td>';
			$i=$i+1;
		}
		echo '</tr>';
		}

    /* free result set */
    $result->free();
}
/* close connection */
$mysqli->close();

}

echo '</table></div>';
?>
