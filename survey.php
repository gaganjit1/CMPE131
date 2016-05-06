<?php
include('/menu.php');
//$dbtype="mssql";

//database configuration
$dbtype="mysql";
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "sjsu";

//this is the question array, this holds all the questions being asked
$questions=array(
'Would you like to design computers?',
'Do you like programming in your spare time?',
'Are you interested in Computer Hardware?',
'Are you able to quickly recognize patterns?',
'Do you like talking and learning about how computers and electronics work?',
'Do you like the idea of performing alchemy?',
'Are you interested in the chemical manufacturing process?',
'Do you like the periodic table of elements?',
'Do you like chemistry?',
'Are you interested in creating new (chemical) materials?',
'Would you like to learn more about circuit boards and electronic equiptment?',
'Would you be interested in signal processing?',
'Are you interested in designing more energy-efficient or powerful electronic devices?',
'Are you interested in Power Electronics?',
'Do you enjoy tinkering on projects and or creating your own electrical devices?',
'Do you like taking things apart and reassembling them?',
'Are you interested in creating 3D models?',
'Are you comfortable and confident in Geometery and Trigonometery?',
'Are you interested with the mechanical generation, distribution, and use of energy?',
'Do you like building mechanical parts and think about how you can improve them?'
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
	
    $sql = "REPLACE INTO User_Response (SJSU_ID, ".$list.", Major)
       VALUES ($sjsuid, $list2, '$major')"; // build mysql query string
	   
//code for mysql backend
if ( $dbtype == "mysql") { 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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

//code for mssql backend
if ( $dbtype == "mssql") {
	
$connectionInfo = array("Database"=>$dbname, "UID" => $username, "PWD" => $password);

$conn = sqlsrv_connect($myServer, $connectionInfo); //returns false
if( $conn === false )
{
    echo "failed connection";
}

$stmt = sqlsrv_query($conn,$sql);
if(sqlsrv_fetch($stmt) ===false)
{
    echo "couldn't fetch data"; 
}
$name = sqlsrv_get_field($stmt,0);
echo $name;
sqlsrv_close( $conn );

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
SJSU ID: <input type="text" name="SJSUID" value="'.$sjsuid.'" readonly><br>


 <br> 
What Major would you aspire to go in, or what major are you currently in?:
 <select name="major">
  <option value="CmpE">CmpE</option>
  <option value="ChemE">ChemE</option>
  <option value="EE">EE</option>
  <option value="MechE">MechE</option>
  <option value="none" selected>None</option>
</select>
<br> 
<br>';
//end javascript and start form

//build form inputs for each question in questions array 
$i=1;

/*
 * Melissa's Edits - Masked original radio buttons to customize/make them bigger.
 */
foreach ( $questions as $question ) {
	echo $i.". ".$question;
	echo '<br>';
    echo '
<div class="container">
<ul>
<li>
<input id="input'.$i.'-1" type="radio" name="question'.$i.'" value="100"> Strongly Agree<br>
<label for="input'.$i.'-1"></label>
<div class="check"></div>
</li>

<li>
<input id="input'.$i.'-2"  type="radio" name="question'.$i.'" value="75"> Agree<br>
<label for="input'.$i.'-2"></label>
<div class="check"><div class="inside"></div>
</div>
</li>

<li>
<input id="input'.$i.'-3" type="radio" name="question'.$i.'" value="50"> Content<br>
<label for="input'.$i.'-3"></label>
<div class="check"><div class="inside"></div>
</div></li>

<li>
<input id="input'.$i.'-4" type="radio" name="question'.$i.'" value="25"> Disagree<br>
<label for="input'.$i.'-4"></label>
<div class="check"><div class="inside"></div>
</div></li>

<li>
<input id="input'.$i.'-5" type="radio" name="question'.$i.'" value="0"> Strongly Disagree<br>
<label for="input'.$i.'-5"></label>  
<div class="check"><div class="inside"></div>
</div>
</ul>
</li>
</div>
';
	echo '<br>'; 
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

