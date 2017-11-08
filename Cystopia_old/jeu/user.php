<?php
if (!isset($_SESSION)) session_start();
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
	unset($_SESSION['CY']);
	header('location:.');
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
	</head>
	<body>
		<h2>Bienvenue dans votre compte cystopia</h2><a href="?logout=1">Deconnexion</a>
	</body>
</html>
<?php
	var_dump($_SESSION['CY']);


?>