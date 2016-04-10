<?php
echo '<script>

function validateForm() {
    var x = document.forms["studentid"]["sjsuid"].value;
    if (( x.length != 9 ) || (x.match(/[a-z]/i)) ) {
        alert("SJSU ID not found. Please use your SJSU 9 digit ID.");
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