<?php
	// starts a session
	session_start();

	// Checks if submit has been clicked and if inputs are valid
	if (filter_input(INPUT_POST, 'submit')) {
		$un = filter_input(INPUT_POST,'username')
			or die('You must enter a valid username');

		$pw = filter_input(INPUT_POST,'password')
			or die('You must enter a valid password');

		// Establishes a connection, and checks if a row contains certain username
		require_once('db_con.php');
		$exists_sql = 'SELECT id FROM users WHERE username = ?';
		$stmt = $con->prepare($exists_sql);
		$stmt->bind_param('s', $un);
		$stmt->execute();
		$stmt->bind_result($id);
		while ($stmt->fetch()) {}

		// checks if username already exists in db
		if (!empty($id)) {
			$exists = true;
		} else {		
			// Password is hashed for protection	
			$pw = password_hash($pw, PASSWORD_DEFAULT);

			// Inserts username and hashed password in db table
			$sql = 'INSERT INTO users (username, pwhash) VALUES (?, ?)';
			$stmt = $con->prepare($sql);
			$stmt->bind_param('ss', $un, $pw);
			$stmt->execute();

			// If creating user is a succes, user is redirected to login page
			$_SESSION['new_username'] = $un;
			header("Location: index.php?create_succes=true");
			die();
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
		<h2>Create a user to expand you knowledge</h2>
		</br>
		<?php
			if ($exists) {
				echo "<h4>Username does already exist</h4>";
			}
		?>
		<form action = "<?=$_SERVER['PHP_SELF']?>" method = "post">
			<input type="text" name="username" placeholder = "Username" required>
			<input type="password" name="password" placeholder = "Password" required>
			<input type="submit" name="submit" value="Create User">
		</form>

		</br>
		<h3>Already have a user? Click <a href="index.php">here</a> to login</h3>

	</body>
</html>
