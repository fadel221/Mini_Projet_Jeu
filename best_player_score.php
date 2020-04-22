<!DOCTYPE html>
<html>
<head>
	<title>Top Score</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

</body>
</html>

<?php 
if (!empty($_SESSION))
{
	echo $_SESSION["score"];
}

 ?>