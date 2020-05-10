<!DOCTYPE html>
<html>
<head>
	<title>Top Score</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

</body>
</html>
<table>
	<td></td>
<?php 
if (!empty($_SESSION))
{
	echo "<tr>";
	echo "<td align='center'>".$_SESSION["joueur"]["score"]."</td>";
	echo "</tr>";
}
else
header('Location:index.php.php');
 ?>
 </table>