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
	
</div>
<form method="post">
	<input class="next-btn" type="submit" value="Suivant" name="suivant">
</form>
</body>
</html>
