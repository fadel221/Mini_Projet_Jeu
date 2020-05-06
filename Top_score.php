<?php 
require_once('fonctions.php');

if (empty($_SESSION))
	header('Location:index.php.php');

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
$best_players=trouve_best_players($json,$best_five_score);
 
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Top Score</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<table cellspacing="10px" cellspacing="10px">

<?php 
		echo "<tr><td>".$best_players[0]."</td><td style='border-bottom:4px solid #00FFFF;'>".$best_five_score[0]."pts</td></tr>";

		echo "<tr><td>".$best_players[1]."</td><td style='border-bottom:4px solid #66CDAA;'>".$best_five_score[1]."pts</td></tr>";

		echo "<tr><td>".$best_players[2]."</td><td style='border-bottom:4px solid #F6A600;'>".$best_five_score[2]."pts</td></tr>";

		echo "<tr><td>".$best_players[3]."</td><td style='border-bottom:4px solid #A52A2A;'>".$best_five_score[3]."pts</td></tr>";

		echo "<tr><td>".$best_players[4]."</td><td style='border-bottom:4px solid silver;'>".$best_five_score[4]."pts</td></tr>";
 ?>
</table>
</body>
</html>






