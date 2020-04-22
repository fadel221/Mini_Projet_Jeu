<?php 
include ('fonctions.php');

if (!empty($_SESSION))
{
	echo $_SESSION["score"];
}

$json=file_get_contents("bd.json");
$json=json_decode($json,true);
$tab_score=array();
foreach ($json as $key => $value) {
		foreach ($value as $key1 => $value1) {
			{
				if ($key1=="score")
				{
					$tab_score[]=$value1;
					break;
				}
			}
		}
}
$best_five_score=five_best_score($tab_score);
;
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Top Score</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php 
	foreach($best_five_score as $i)
		echo "<br>".$i;

 ?>

</body>
</html>






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