<?php

// Manually start the PHP session.  If the client browser sent a
// PHPSESSIONID cookie that has a valid value, that session will be loaded.
// If not, a new empty session is created.
session_start();

// set up default values for all required input fields
$first_name = 'DefaultFirstName';
$last_name = 'DefaultLastName';
$age = '0';
$favorite_numbers = array(1,3,6,12);

// Now process each form input field.
// FirstName and FavoriteNumbers are done for you.  You need to do the rest.

// If $_REQUEST['FirstName'] exists and isn't an empty string, use it instead of the default value.
if(array_key_exists('FirstName', $_REQUEST) && $_REQUEST['FirstName'] != '') {
    $first_name = $_REQUEST['FirstName'];
}

// If $_REQUEST['LastName'] exists and isn't an empty string, use it instead of the default value.
// Your code here.

// If $_REQUEST['Age'] exists and isn't an empty string, use it instead of the default value.
// Your code here.

// If $_REQUEST['FavoriteNumbers'] exists, validate it so it can be used with the explode function.
if(array_key_exists('FavoriteNumbers', $_REQUEST)) {
    // The validation code below uses regular expressions, also known as regexes.
    // We want a string that contains only numbers and commas.  Delete everything else.
    $favorite_numbers_input = preg_replace("/[^0-9,]/", "", $_REQUEST['FavoriteNumbers']);
    // We may have more than one comma in a row after stripping out all everything besides numbers and commas.
    // So, replace all sequences of more than one comma with one comma.
    $favorite_numbers_input = preg_replace("/,{2,}/", ",", $favorite_numbers_input);
    // There may be a comma at the beginning and/or end of the string.  Delete those as well.
    $favorite_numbers_input = preg_replace("/^,|,$/", "", $favorite_numbers_input);
    // Make sure we aren't left with the empty string.
    if ($favorite_numbers_input != '') {
        // use explode to split the string into an array
        $favorite_numbers = explode(',', $favorite_numbers_input);
    }
}

// Now store all the data to a session.
// Store $first_name to the session.
$_SESSION['FirstName'] = $first_name;

// Store $last_name to the session.
// Your code here.

// Store $age to the session.
// Your code here.

// Store $favorite_numbers to the session.
// Your code here.

// Commit the session manually to save it now.
session_commit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Step 2 - Process Form Input</title>
</head>
<body>
<h2>Input from Form:</h2>
First Name: <?php echo $first_name; ?><br/>
Last Name: <?php echo $last_name; ?><br/>
Age: <?php echo $age; ?><br/>
Favorite Numbers: <?php echo implode(', ', $favorite_numbers); ?><br/><br/>

View the stored session data <a href="step3_view_session_data.php">here</a>.<br/>
Delete the stored session data <a href="delete_session_data.php">here</a>.
</body>
</html>
