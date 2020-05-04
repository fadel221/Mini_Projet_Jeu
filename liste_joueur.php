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
define("NBRE_VAL_PAGE",15);
$nb_pages=ceil($nb_joueurs/NBRE_VAL_PAGE);

		
	

echo "<table align='center' cellpadding='3px' cellspacing='25px'>";
echo "<tr>";
echo "<td>PRENOM</td>";
echo "<td></td>";
echo "<td>NOM</td>";
echo "<td></td>";
echo "<td>SCORE</td>";
echo "<td></td>";
echo "</tr>";
if (isset($_GET["num_pages"]) && !empty($_GET["num_pages"]))
{
	if ($_GET["num_pages"]>$nb_pages)
		$_GET["num_pages"]=1;
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
echo "<td></td>";
echo "<td>".$tab_joueur[$i]["nom"]." </td>";
echo "<td></td>";
echo "<td>".$tab_joueur[$i]["score"]." </td>";
echo "<td></td>";
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
	
		echo "<table align='center' cellpadding='3px' cellspacing='25px'>";

	for ($i=$indice_dep;$i<$indice_fin;$i++)
	{
		if (isset($tab_joueur[$i]))
	{
	echo "<tr>";
	echo "<td>".$tab_joueur[$i]["username"]." </td>";
	echo "<td></td>";
	echo "<td>".$tab_joueur[$i]["nom"]." </td>";
	echo "<td></td>";
	echo "<td>".$tab_joueur[$i]["score"]." </td>";
	echo "<td></td>";
	echo "</tr>";
	}
}
echo "</table>";
		

	}

 

?>


	
</div>

<div >
	<?php  
	echo "<a href='menu_admin.php?num_pages=".($page_actuelle+1)."'><input type='submit' class='next-btn 'value='suivant'></a>";

	?>
</div>

<form method="post">
	 
	
	 
</form>
</body>
</html>
