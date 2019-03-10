<?php

// Manually start the PHP session.  If the client browser sent a
// PHPSESSIONID cookie that has a valid value, that session will be loaded.
// If not, a new empty session is created.
session_start();

// Delete all the data associated with the session.
// Note that this does not delete the PHPSESSIONID cookie from the user's browser.
session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Session Data</title>
</head>
<body>
All session data has been deleted!<br/><br/>

View the stored session data <a href="step3_view_session_data.php">here</a>.<br/>
Go back to the input form <a href="step1_form.html">here</a>.
</body>
</html>