<?php
	// starts a session
	session_start();

	// Resets the session's variables 
	$_SESSION = array();

	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	}
	// Ends the session
	session_destroy();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>The more you know</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	    <meta name="description" content="Demo project">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style type="text/css"></style>
	</head>
	<body style="margin: 50px auto; text-align: center;">
		<h2>You have now been logged out</h2>
		<h3>Full of regrets? Click <a href="index.php">here</a> to return to login</h3>
	</body>
</html>