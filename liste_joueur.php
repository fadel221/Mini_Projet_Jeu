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
include 'fonctions.php';
$json=file_get_contents("bd.json");
$json=json_decode($json,true);
$tab_joueur=reccupere_joueur($json);
$nb_joueurs=taille_tab_json($json);
$nb_pages=ceil($nb_joueurs/15);
define("NBRE_VAL_PAGE",15);
	
	for ($i=1;$i<=$nb_pages;$i++)
		echo "<a href='menu_admin.php?num_pages=$i'>[".$i."] </a>";

echo "<table cellpadding='3px' cellspacing='10px'>";
echo "<tr>";
echo "<td>PRENOM</td>";
echo "<td>NOM</td>";
echo "<td>SCORE</td>";
echo "</tr>";
if (isset($_GET["num_pages"]))
{
	$page_actuelle=$_GET["num_pages"];
	$indice_dep=($page_actuelle-1)*NBRE_VAL_PAGE;
	$indice_fin=($page_actuelle)*NBRE_VAL_PAGE;
	{
		
for ($i=$indice_dep;$i<$indice_fin;$i++)
{
	if (isset($tab_joueur[$i]))
	{
echo "<tr>";
echo "<td>".$tab_joueur[$i]["username"]." </td>";
echo "<td>".$tab_joueur[$i]["nom"]." </td>";
echo "<td>".$tab_joueur[$i]["score"]." </td>";
echo "</tr>";
}
}
echo "</table>";


	}
}
else
	{
		$page_actuelle=1;
		$indice_dep=($page_actuelle-1)*NBRE_VAL_PAGE;
		$indice_fin=($page_actuelle)*NBRE_VAL_PAGE;
	
		echo "<table cellpadding='3px' cellspacing='10px'>";

	for ($i=$indice_dep;$i<$indice_fin;$i++)
	{
		if (isset($tab_joueur[$i]))
	{
	echo "<tr>";
	echo "<td>".$tab_joueur[$i]["username"]." </td>";
	echo "<td>".$tab_joueur[$i]["nom"]." </td>";
	echo "<td>".$tab_joueur[$i]["score"]." </td>";
	echo "</tr>";
	}
}
echo "</table>";

	}

 

?>


	
</div>
<form method="post">
	 
	<a href="menu_admin.php?num_pages=<?php echo $page_actuelle++;?>"><input class='next-btn' type='submit' value='Suivant' name='suivant'></a>
	 
</form>
</body>
</html>
