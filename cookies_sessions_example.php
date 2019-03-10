<?php

// A variable to hold any messages we want to display to the user.
$messages = "";

// manually start the PHP session
session_start();

// Depending on how PHP is configured, cookies need to be set before any HTML output is sent.
// Check the form input to see if we need to set a cookie.
// $_REQUEST holds data for both GET and POST requests.  It is the same as using $_GET with a GET request
// and $_POST with a POST request.
if (isset($_REQUEST["CookieAction"])) {
    if ($_REQUEST["CookieAction"] === "Set") {
        // Cookies must be a string, so create a new string with the form data
        $cookie_value = $_REQUEST["FirstName"] . ";" . $_REQUEST["LastName"] . ";" .
            $_REQUEST["Age"] . ";" . $_REQUEST["Gender"];
        // Set a cookie named ExampleCookie that expires 1 hour from now.
        // time() returns the number of seconds from January 1st, 1970 (the Unix epoch).
        // So add 3600 seconds to the current time to get an hour from now.
        setcookie("ExampleCookie", $cookie_value, time()+3600);
        // tell the user we set a cookie
        $messages .= "Cookie set to: $cookie_value<br/><br/>\n";
    } elseif ($_REQUEST["CookieAction"] === "Delete") {
        // Set a cookie named ExampleCookie that expires in the past.  This will cause the browser to delete
        // any cookie it has stored with the same name.
        setcookie ("ExampleCookie", "", time() - 3600);
        $messages .= "Cookie deleted!<br/><br/>\n";
    }
}

// The HTML form fields to process.
$fields = array("FirstName", "LastName", "Age", "Gender");
// Check if there is some action the script should take on a PHP session.
if (isset($_REQUEST["SessionAction"])) {
    // Save the form input data to a PHP session.
    if ($_REQUEST["SessionAction"] === "Set") {
        $messages .= "Session keys set:<br/>\n";
        // We can save whatever data we want into the associative array $_SESSION.
        // That data will be stored on the server where PHP is running and NOT sent to the client.
        // So, we will store the data from each form field as an element in the $_SESSION array.
        foreach($fields as $field) {
            $_SESSION[$field] = $_REQUEST[$field];
            $messages .= '$_SESSION["' . $field . '"] = ' . $_REQUEST[$field] . "<br/>\n";
        }
        // Immediately save the session data.
        session_commit();
    }

    // Delete and clear the session data.
    if ($_REQUEST["SessionAction"] === "ClearDelete") {
        // Delete session variables so they can't be used anymore during the current instance of the script.
        // If we don't do this, the session data will still be active for the remainder of this script
        // even though we are telling PHP to delete the session.
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        // Tell PHP to delete all data associated with the current PHP session.
        session_destroy();
        // Immediately save the session data.
        session_commit();
        $messages .= "Session cleared and deleted!<br/>\n";
    }

    // Delete the session data.
    if ($_REQUEST["SessionAction"] === "Delete") {
        // Tell PHP to delete all data associated with the current PHP session.
        session_destroy();
        // Immediately save the session data.
        session_commit();
        $messages .= "Session deleted!<br/>\n";
    }
}

// The HTML form:
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cookies and Sessions</title>
</head>
<body>

<style>
    /* simple way to align HTML forms: http://stackoverflow.com/a/23741073 */
    label { text-align: right; font-weight: bold; }
    label.inline { text-align: left; }
    form  { display: table;      }
    p     { display: table-row;  border-top: solid transparent 50px; }
    label { display: table-cell; }
    span { display: table-cell; text-align: right; font-weight: bold; }
    input { display: table-cell; margin-left: 10px; margin-right: 10px;}

    /* box with title example: http://stackoverflow.com/a/2936888 */
    .title_box {
        border: #000000 1px solid;
    }

    .title_box_title {
        position: relative;
        top : -0.5em;
        margin-left: 1em;
        display: inline;
        background-color: white;
    }

    .title_box_content {
        margin: 10px;
    }
</style>

<!-- leaving out the action property will cause the form to be submitted to this page -->
<form method="POST" id="cookiesSessionForm">
    <!-- fieldset groups fields in a form -->
    <fieldset>
        <!-- legend is the label used for the field set -->
        <legend>Test Cookies and Sessions</legend>
        <!-- Labels are used to label form inputs.  They are important for screen readers. -->
        <!-- One can click on the rendered label to interact with a form input as well as the input itself. -->
        <p><label for="FirstName">First Name:</label><input type="text" id="FirstName" name="FirstName"/></p>
        <p><label for="LastName">Last Name:</label><input type="text" id="LastName" name="LastName"/></p>
        <p><label for="Age">Age:</label><input type="text" id="Age" name="Age"></p>
        <p><span>Gender:</span><label class="inline"><input type="radio" name="Gender" id="Gender_Female" value="Female" checked/> Female</label></p>
        <p><span></span><label class="inline"><input type="radio" name="Gender" value="Male"/> Male</label><br/>&nbsp;</p>
        <p><span>Cookie Action</span><label class="inline"><input type="radio" name="CookieAction" value="Set"/> Set Cookie</label></p>
        <p><span></span><label class="inline"><input type="radio" name="CookieAction" value="Delete"/> Delete Cookie</label></p>
        <p><span></span><label class="inline"><input type="radio" name="CookieAction" value="Nothing" checked/> Do Nothing</label><br/>&nbsp;</p>
        <p><span>Session Action</span><label class="inline"><input type="radio" name="SessionAction" value="Set"/> Set Session</label></p>
        <p><span></span><label class="inline"><input type="radio" name="SessionAction" value="Delete"/> Delete Session</label></p>
        <p><span></span><label class="inline"><input type="radio" name="SessionAction" value="ClearDelete"/> Clear & Delete Session</label></p>
        <p><span></span><label class="inline"><input type="radio" name="SessionAction" value="Nothing" checked/> Do Nothing</label></p>
        <div style="text-align: center"><input type="submit"/><input type="reset"/></div>
    </fieldset>
</form>
<br/>
Click <a href="#" onclick="document.getElementById('cookiesSessionForm').method = 'GET'; alert('Form submission method set to GET'); false;">here</a> to set the form submission method to GET.<br/><br/>
<!-- print out any messages we have for the user -->
<div class="title_box">
    <div class="title_box_title">Messages</div>
    <div class="title_box_content">
<?php
echo $messages;
?>
    </div>
</div>
<br/>

<div class="title_box">
    <div class="title_box_title">Cookies Sent by the Browser</div>
    <div class="title_box_content">
<?php
// Check if any cookies were sent by the web browser.
if (isset($_COOKIE)) {
  // Print out all the cookies sent by the web browser.
  foreach($_COOKIE as $name => $value) {
      echo "Name: $name<br/>\n";
      echo "Value: $value<br/>\n";
      echo "<br/>\n";
  }
} else {
  echo "No cookies were sent by the web browser!<br/>\n";
}
?>
    </div>
</div>
<br/>

<div class="title_box">
    <div class="title_box_title">PHP Session Data</div>
    <div class="title_box_content">
<?php
// Print out any session data we may have.
foreach($_SESSION as $key => $value) {
    echo '$_SESSION["' . $key . '"] = ' . $value . "<br/>\n";
}
?>
    </div>
</div>
</body>
</html>
