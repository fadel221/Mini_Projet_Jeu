<?php  
if (empty($_SESSION))
    header('location:index.php.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Liste Questions</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container_nb_question">
	<form method="post">
		<label>Nbre de questions/Jeu</label>
		<input class="input-nb-question" type="text" name="question">
		<input class="btn-nb-question" type="submit"name="OK" value="OK">
	</div>
	
<div class="container-list2">
	
</div>
	<input class="next-btn" type="submit" value="Suivant" name="suivant">
</form>
</body>
</html>
