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
		<label id="text-nbpage-question">Nbre de questions/Jeu</label>
		<input class="input-nb-question" type="text" name="question">
		<input class="btn-nb-question" type="submit"name="OK" value="OK">
	</div>
	
<div class="container-list2">
<?php 
include 'fonctions.php';
$json=file_get_contents("questions.json");
$json=json_decode($json,true);
define("NB_QUESTION_PAGE",5);
$nb_question=count($json);
$nb_page=ceil($nb_question/NB_QUESTION_PAGE);

if (isset($_GET["numero_page"]) && !empty($_GET["numero_page"]))
{
	if ($_GET["numero_page"]>$nb_page)
		$_GET["numero_page"]=1;
$page_actuelle=$_GET["numero_page"];
$indice_debut=($page_actuelle-1)*NB_QUESTION_PAGE;
$indice_fin=($page_actuelle)*NB_QUESTION_PAGE;
	for ($i=$indice_debut;$i<$indice_fin;$i++)
	{
		if (!isset($json[$i]))
								break;

		switch($json[$i]["type-reponse"])
		{

			case 'Choix Simple':
			{
				echo "<h2>".($i+1)." .".$json[$i]["question"]."</h2>";
				$tab_cle=reccupere_cle_reponse_simple($json[$i]);
								foreach ($tab_cle  as $cle) {
												if ($json[$i]["radio"]==$cle)
												{
												
														echo "<input type='radio' name='radio_".($i+1)."' checked>".$json[$i][$cle]."<br>";
												}
													else
																	if ($cle!=("radio"))
														echo "<input type='radio' name='radio_".($i+1)."'>".$json[$i][$cle]."<br>";
				}
						break;
				}
				

				case 'Choix Multiple':
			{
				echo "<h2>".($i+1)." .".$json[$i]["question"]."</h2>";
								
								for ($j=0;$j<count($json[$i]);$j++)
								{
									$reponse="reponse_multiple_".($j+1);
									 if (isset($json[$i]["check_".($j+1)]))
									 	echo "<input type='checkbox' checked>".$json[$i][$reponse]."<br>";
									 else
									 	if (isset($json[$i][$reponse]))
									 	echo "<input type='checkbox' >".$json[$i][$reponse]."<br>";
								}
									
									break;
								}
				
						case 'Texte à Saisir':
						{
							echo "<h2>".($i+1)." .".$json[$i]["question"]."</h2>";
						 echo "<input type='text'  value='".$json[$i]["question_simple"]."'>";
					break;
						}
				
				
			}
		}
	
}

else
		{

															$_GET["numero_page"]=1;
															$page_actuelle=$_GET["numero_page"];
															$indice_debut=($page_actuelle-1)*NB_QUESTION_PAGE;
															$indice_fin=($page_actuelle)*NB_QUESTION_PAGE;
																for ($i=$indice_debut;$i<$indice_fin;$i++)
																{
																	
																	switch($json[$i]["type-reponse"])
																	{

																		case 'Choix Simple':
																		{
																			echo "<h2>".($i+1)." .".$json[$i]["question"]."</h2>";
																			$tab_cle=reccupere_cle_reponse_simple($json[$i]);
																							foreach ($tab_cle  as $cle) {
																											if ($json[$i]["radio"]==$cle)
																											{
																											
																													echo "<input type='radio' name='radio_".($i+1)."' checked>".$json[$i][$cle]."<br>";
																											}
																												else
																																if ($cle!=("radio"))
																													echo "<input type='radio' name='radio_".($i+1)."'>".$json[$i][$cle]."<br>";
																			}
																					break;
																			}
																			

																			case 'Choix Multiple':
																		{
																			echo "<h2>".($i+1)." .".$json[$i]["question"]."</h2>";
																							
																							for ($j=0;$j<count($json[$i]);$j++)
																							{
																								$reponse="reponse_multiple_".($j+1);
																								 if (isset($json[$i]["check_".($j+1)]))
																								 	echo "<input type='checkbox' checked>".$json[$i][$reponse]."<br>";
																								 else
																								 	if (isset($json[$i][$reponse]))
																								 	echo "<input type='checkbox' >".$json[$i][$reponse]."<br>";
																							}
																								
																								break;
																							}
																			
																					case 'Texte à Saisir':
																					{
																						echo "<h2>".($i+1)." .".$json[$i]["question"]."</h2>";
																					 echo "<input type='text'  value='".$json[$i]["question_simple"]."'>";
																				break;
																					}
																			
																			
																		}
																	}
																

																	}

 

	
	?>
	</div>
	<div>

		
</div>

</form>
</body>
</html>

<?php
			echo "<a href='menu_admin.php?numero_page=".($page_actuelle+1)."&page=1'><input type='submit' class='next-btn 'value='suivant'></a>";


?>