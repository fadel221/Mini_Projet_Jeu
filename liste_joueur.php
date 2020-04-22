<?php  

if (empty($_SESSION))
    header('location:index.php.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Liste joueur</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div align="center"class="header-list">
		Liste des Joueurs par Score
	</div>
<div class="container-list">



<?php  

$json=file_get_contents("bd.json");
$json=json_decode($json,true);
echo "<table>";
echo "<tr>";
echo "<td>PRENOM</td>";
echo "<td>NOM</td>";
echo "<td>SCORE</td>";
echo "</tr>"; 
for ($i=0;isset($json[$i]["username"]);$i++)
{
	echo "<tr>";
	if (isset($json[$i]["score"]))
	{
	echo "<td>".$json[$i]["username"]."</td>";
	echo "<td>".$json[$i]["nom"]."</td>";
	echo "<td>".$json[$i]["score"]."pts</td>";
	echo "</tr>";
	}
}

echo "</table>";
?>


	
</div>
<form method="post">
	<input class="next-btn" type="submit" value="Suivant" name="suivant">
</form>
</body>
</html>
