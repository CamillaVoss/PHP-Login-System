<?php
	// starts a session
	session_start();

	// Checks if submit has been clicked and if inputs are valid
	if (filter_input(INPUT_POST, 'submit')) {
		$un = filter_input(INPUT_POST,'username')
			or die('You must enter a valid username');

		$pw = filter_input(INPUT_POST,'password')
			or die('You must enter a valid password');

		// Establishes a connection, and checks table for matching username
		require_once('db_con.php');	
		$sql = 'SELECT id, pwhash FROM users WHERE username = ?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('s', $un);
		$stmt->execute();
		$stmt->bind_result($id, $pwhash);

		while ($stmt->fetch()) {
			
		}

		// if there is a matching username, password is then verified - and if this is a succes, user is redirected to content page
		if (password_verify($pw, $pwhash)) {
			$_SESSION['id'] = $id;
			$_SESSION['username'] = $un;
			header("Location: content.php");
			die();
		} else {
			$login_failure = true;
	 	}				
	}
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

	<h1>Welcome to The More You Know</h1>
	<h2>Login to expand your knowledge</h2>
	</br>
	</br>
	<?php
		if ($_GET['create_succes']) {
			echo '<h4> User named <strong>' . $_SESSION['new_username'].'</strong> has succesfully been created </h4>';
		}
	?>
		<form action = "<?=$_SERVER['PHP_SELF']?>" method = "post">
			<input type="text" name="username" placeholder = "Username" required>
			<input type="password" name="password" placeholder = "Password" required>
			<input type="submit" name="submit" value="Login">
		</form>
		<?php
			if ($login_failure) {
				echo "Wrong username and password combination";
			}
		?>
		</br>
		<h3>Don't have a user? Click <a href="createuser.php">here</a> to create one</h3>
	</body>
</html>