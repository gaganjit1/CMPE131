<?php
include('menu.php');
include('answer-array.php');
//$dbtype="mssql";
//database configuration
$dbtype="mysql";
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "sjsu";
//this is the question array, this holds all the questions being asked
$questions=array(
'I would like to design computers.',
'I enjoy programming on my spare time.',
'I have an interest in computer hardware.',
'I am able to quickly recognize patterns.',
'I like to learn and discuss how computers and electronics work.',
'I like the idea of performing alchemy.',
'I am interested in the chemical manufacturing process.',
'I enjoy working with chemicals including mixing solutes and solvents.',
'I enjoy being in a Chemistry lab.',
'I enjoy watching chemical reactions.',
'I would like to learn more about analog circuit boards and electronic equipment.',
'I am interested in signal processing.',
'I want to design more energy-efficient or powerful electronic devices.',
'I am interested in Power Electronics.',
'I enjoy the electromagnetic theory and would like to learn about it.',
'I enjoy taking things apart and reassembling them.',
'I would like to draw or create 3D models.',
'I enjoy welding.',
'I enjoy learning about kinematics.',
'I enjoy building and improving mechanical parts.'
);
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
    	header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }
    exit();
}
if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) { // receiving "get" data 
 $sjsuid = $_GET["sjsuid"];
}
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) { // receiving "post" data 
	$sjsuid = $_POST["SJSUID"]; // creating variable sjsuid and setting it equal to the "post method" extracted data for the inputted sjsuid from the user
	$major = $_POST["major"];
	$sjsuid = str_pad($sjsuid, 9, "0", STR_PAD_LEFT);
	
	$i=1; // declare variable i to incremennt for the question number
	$list=""; // initizing a string labeled list for mysql field id (question 1,question2) This is the question names being stored)
	$list2=""; // initilizing a string labeled list2 for mysql field values (numberical values for the answers) This is the numerical value of each answer being stored
	foreach ( $questions as $question ) { // we are finding the field id's for each question 
		${"question$i"} = $_POST["question$i"]; // receiving question input
		$list=$list."Q$i, "; // make a list of field ids to insert into mysql database
		$list2=$list2.${'question'.$i}.", "; // make a list of field values to insert in mysql database
		$i=$i+1; // increment question (variable i)
	}
	
	$list=rtrim($list,', '); // remove trailing comma from the list
	$list2=rtrim($list2,', ');	// remove trailing comma from the list2
	
	$delete = "DELETE FROM User_Response WHERE SJSU_ID ='".str_pad($sjsuid, 9, "0", STR_PAD_LEFT)."'";
    $sql = "INSERT INTO User_Response (SJSU_ID, ".$list.", Major) VALUES ('".str_pad($sjsuid, 9, "0", STR_PAD_LEFT)."', $list2, '$major')"; // build mysql query string
	   
//code for mysql backend
if ( $dbtype == "mysql") { 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($conn->query($delete) === TRUE) {
    echo "Deleted successfully";
} else {
    echo "Error: " . $delete . "<br>" . $conn->error;
}
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
	$id = mysqli_insert_id($conn);
	Redirect('/results.php?sjsuid='.$sjsuid.'&id='.$id, false);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
} 
}
//begin building html webpage
echo '<html>';
//javascript section using php to build javascript checking to see if the user inputted all the values into the radio form (if they did not submit all the answers an error message appears)
echo '<script> 
function validateRadio (radios)
{
    for (i = 0; i < radios.length; ++ i)
    {
        if (radios [i].checked) return true;
    }
    return false;
}';
$validatelist=""; // initilize a list labeled validatelist for radio inputs to check
$i=1; // creating an incrementer labeled i
foreach ( $questions as $question ) { // building the string
	$validatelist=$validatelist.'validateRadio(document.forms["recommendation"]["question'.$i.'"]) && '; // creating a formatted list of questions
	$i=$i+1; // increment the counter
}
$validatelist=rtrim($validatelist,'&& '); // removing trimming && space from the list
	
	//javascript function that checks to see if every question is answered
echo '
function validateForm(){ 
     
	 if('.$validatelist.')
	    {
        return true;
    }
    else
    {
        alert("Please answer all questions");
        return false;
    }
}
</script>
<div class="container">
<form class="white" id="recommendation" name="recommendation" action="survey.php" method="post" onsubmit="return validateForm()">
<br>
SJSU ID: <input type="text" name="SJSUID" value="'.$sjsuid.'" style="height: 28px;width: 154px;font-size: large;" readonly><br>
 <br> 
What Major would you aspire to go in, or what major are you currently in?:
<select name="major" style="height: 26px;font-size: large;">
  <option value="Computer Engineering">Computer Engineering</option>
  <option value="Chemical Engineering">Chemical Engineering</option>
  <option value="Electrical Engineering">Electrical Engineering</option>
  <option value="Mechanical Engineering">Mechanical Engineering</option>
  <option value="none" selected="">None</option>
</select>
<br> 
<br>';
//end javascript and start form
//build form inputs for each question in questions array 
$i=1;
/*
 * Melissa's Edits - Masked original radio buttons to customize/make them bigger.
 * (MP - inserted second loop to source values from answers-array.php)
 */
$aSize = sizeof($answers);
foreach ( $questions as $question ) {
	$t=1;
	echo $i.". ".$question;
	echo '<br>';
    echo '<div class="container">
		<ul>';
	foreach ( $answers as $w => $v) {
		echo '<li>
			<input id="input'.$i.'-'.$t.'" type="radio" name="question'.$i.'" value="'.$v.'"> '.$w.'<br>
			<label for="input'.$i.'-'.$t.'"></label>
			<div class="check">';
		if ($t != 1)
			echo '<div class="inside"></div>';
		echo '</div>';
		if ($t++ == $aSize)
			echo '</ul>';
		echo '</li>';
	}
	echo '</div>
		<br>'; 
	$i=$i+1;
}
//Melissa - modified the Size of the "Submit" button and it's text.
echo '<input class="submit" type="submit" style="width:200px"; height:200px; value="Submit">
</form>
</div>
</html>';
//TODO
/*
/*
*remove current major on survey page
*make sjsu id take one survey only.
add engineer field (to page and db)
add validation checks for engineer field and sjsuid 
create better db schema
add validation for sjsuid number characters (9)
*/
?>