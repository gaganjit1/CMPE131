<?php
include('answer-array.php');
//$dbtype="mssql";
$dbtype="mysql";
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "sjsu";
echo '<input type="button" value="Download" id="download-btn">';
echo '<div class="container" style="overflow: auto;">';	

echo '<form id="download-form" method="POST" action="download.php">';
echo '</form>';
echo '<table class="white" border="1" style="font-size:16px;"><tr><td>SJSU ID</td> ';
$i=1;
		while ( $i < 21 ) {
			echo '<td>Question '.$i.'</td>';
			$i=$i+1;
		}
		echo '<td>Recommended Major</td>';
		echo '<td>Major</td>';
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
		$it = 0;
		$dict = array_flip($answers);
	    /* fetch associative array */
	    while ($row = $result->fetch_assoc()) {
	    	$data[$it++] = $row;
			echo '<tr>';
	        echo '<td><div class="id_space">'.str_pad($row["SJSU_ID"], 9, "0", STR_PAD_LEFT).'</div></td>';
			$i=1;
			while ( $i < 21 ) {
				echo '<td><div class="q_space">'.$dict[$row["Q$i"]].'</div></td>';
				$i=$i+1;
			}
			echo '<td><div class="rec_space">'.$row["Rec_Major"].'</div></td>';
			echo '<td><div class="maj_space">'.$row["Major"].'</div></td>';
			echo '</tr>';
		}
		echo '<div id="result" style="display: none;">'.json_encode($data).'</div>';
	    /* free result set */
	    $result->free();
	}
	/* close connection */
	$mysqli->close();
}
echo '</table></div>';
echo '<script type="text/javascript">
	$(document).ready( function() {
		$("#download-btn").click(function() {
			var v = $("#result").html();
			v = JSON.stringify(v);
			var d = $("<input>", { type: "hidden", name: "data"});
			d.val(v);
			var form = $("#download-form");
			form.append(d);
			form.submit();
			return false;
		});
	});
</script>';
?>