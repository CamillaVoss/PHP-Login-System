<?php
	session_start();
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
	<?php
		// Establishes connection to the table theories in the db, where the coloumn theory is randomized, and the first element is used as random fact
		require_once('db_con.php');
		$theories_sql = 'SELECT theory FROM theories ORDER BY RAND() LIMIT 1';
		$stmt = $con->prepare($theories_sql);
		$stmt->execute();
		$stmt->bind_result($theory);

		while ($stmt->fetch()) {
					
		}

		if (empty($_SESSION['id'])) { ?>
			<h2>You need to be logged in to view the content of this page</h2>
			<h3>Curious? Click <a href='index.php'>here</a> to login</h3>
		<?php } else { ?>
			<h2> Hi <?=$_SESSION['username']?> </h2>
			<h3> <?=$theory?> </h3>
			</br>
			</br>
			</br>
			</br>
			<h4>Can't handle the truth? Click <a href='logout.php'>here</a> to logout</h4>
		<?php }
	?>
	</body>
</html>