<?php 
//error handling functions to display all errors
ini_set('display_errors', 1);
error_reporting(E_ALL); 

//create variables to store the relevant form fields,
//trimming whitespace for textboxes
//a variable to hold the message to be displayed, 
//a variable for validation testing,
//and a variable to determine if they want a free e-magazine

$firstname = trim($_POST['fname']);
$lastname = trim($_POST['lname']);
$email = trim($_POST['email']);
$donation = $_POST['amount'];
$msg = "<p class='error'>Please <a href='javascript: history.back()'>GO BACK</a> and fill in the following errors: </p>\n\r";
$pass = true;
$magazine = "";

//formatting predefined HTML characters for textboxes
$firstname = htmlspecialchars($firstname);
$lastname = htmlspecialchars($lastname);
$email = htmlspecialchars($email);

//form validation:
//use if conditionals to validate textboxes to ensure that they are not empty
//display error message if they are empty, otherwise continue validating
if (empty($firstname)) {
    $msg .= "\t<p>Please enter your first name.</p>\n\r";
    $pass = false;
} //end if conditional check for empty first name

if (empty($lastname)) {
    $msg .= "\t<p>Please enter your last name.</p>\n\r";
    $pass = false;
} //end if conditional check for empty last name

if (empty($email)) {
    $msg .= "\t<p>Please enter your email address.</p>\n\r";
    $pass = false;
} //end if conditional check for empty email

//use if conditional to validate donation amount
if (empty($donation)) {
    $msg .= "\t<p>Please enter your desired donation amount.</p>\n\r";
    $pass = false;
} //end if conditional check for empty donation

//use if conditional to check if donation is not empty, and if true, format it
if (!empty($donation)) {
    //format donation amount to display with $ and 2 decimals
    $donation = '$'.number_format($donation, 2);
}

//use if conditional to see if the e-magazine checkbox has been checked
//and make the magazine variable indicate that they do NOT want one
if (isset($_POST['subscription'])) {
    $magazine .= "You have selected not to receive a free year subscription to our e-magazine.";
}

//use if conditional to see if the e-magazine checkbox has NOT been checked
//and make the magazine variable indicate that they do want one
if (!isset($_POST['subscription'])) {
    $magazine .= "You have selected to receive a free year subscription to our e-magazine.";
}

//final if conditional to check if the $pass variable is present/true
//and set success message in $msg variable, which will display the $magazine selection text
if ($pass) {
    $msg = "\t<p>Thank you for your donation of $donation, $firstname $lastname!</p>\n\r";
    $msg .= "\t<p>We will email a receipt to you at $email</p>\n\r";
    $msg .= "\t<p>$magazine</p>\n\r";
}

?>
<!DOCTYPE html>
<!-- Mikaela Rhoads -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    //display whatever the message is, determined by validation above
    //this will either be errors relevant to form submission context
    //or the success message indicating submission values including
    //their e-magazine selection
    echo "<div>$msg</div>";

?>
</body>
</html>