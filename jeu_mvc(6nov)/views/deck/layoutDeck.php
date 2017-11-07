<?php 
// var_dump($tabdecks);
/*
echo "get > <br>";
var_dump($_GET);

echo "POST > <br>";
var_dump($_POST);


echo "Session > <br>";
if (isset($_SESSION))
    var_dump($_SESSION);



if (isset($_SESSION['carteDeck']))
var_dump($_SESSION['carteDeck']);
*/

?>

<html>
<head>
	<meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="assets/css/deck.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<title>Document</title>
</head>
<body class='body'>
	<nav class="navbar">
  		<a class="navbar-brand " href="./Destroy.php" name="deconectMenu" ><i class="fa fa-sign-out"></i></a>
  	</nav>
  	<?=$view?>
</body>
</html>