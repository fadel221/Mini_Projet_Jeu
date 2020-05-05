


<?php  
if (empty($_SESSION))
    header('location:index.php.php');

include 'fonctions.php';
$json=file_get_contents("questions.json");
$json=json_decode($json,true);
define("NB_QUESTION_PAGE",5);
$nb_question=count($json);
$nb_page=ceil($nb_question/NB_QUESTION_PAGE);
if (isset($_POST["OK"]) && !empty($_POST["OK"])) 

{
	if (isset($_POST["question"]) && !empty($_POST["question"]))
	{
			$json[0]["nb_questions_par_jeu"]=(int)$_POST["question"];
		 $_SESSION["nb_questions_par_jeu"]=(int)$_POST["question"];
		 $json=json_encode($json);
		 file_put_contents("questions.json",$json);
	}
}
else
	$_SESSION["nb_questions_par_jeu"]=$json[0]["nb_questions_par_jeu"];

 $json=json_encode($json);

		file_put_contents("questions.json",$json);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Liste Questions</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container_nb_question" id="nb_question">
	<form method="post" id="form-question">
		<label id="text-nbpage-question">Nbre de questions/Jeu</label>
		<input class="input-nb-question" <?php  echo 'value='.$_SESSION["nb_questions_par_jeu"]; ?> type="text" name="question" id="question">
		<input class="btn-nb-question" type="submit"name="OK" value="OK" onclick="Validation();">
	</form>
	</div>
	<form>
<div class="container-list2">
<?php  

$json=file_get_contents("questions.json");
$json=json_decode($json,true);

if (isset($_GET["numero_page"]) && !empty($_GET["numero_page"]))
{
	if ($_GET["numero_page"]>$nb_page)
		$_GET["numero_page"]=1;
$page_actuelle=$_GET["numero_page"];
$indice_debut=(($page_actuelle-1)*NB_QUESTION_PAGE)+1;
$indice_fin=(($page_actuelle)*NB_QUESTION_PAGE)+1;
	for ($i=$indice_debut;$i<$indice_fin;$i++)
	{
				if($i==0)
				continue;						
		if (!isset($json[$i]))
								break;

		switch($json[$i]["type-reponse"])
		{

			case 'Choix Simple':
			{
				echo "<h2>".($i)." .".$json[$i]["question"]."</h2>";
				$tab_cle=reccupere_cle_reponse_simple($json[$i]);
								foreach ($tab_cle  as $cle) {
												if ($json[$i]["radio"]==$cle)
												{
												
														echo "<input type='radio' name='radio_".($i)."' checked>".$json[$i][$cle]."<br>";
												}
													else
																	if ($cle!=("radio"))
														echo "<input type='radio' name='radio_".($i)."'>".$json[$i][$cle]."<br>";
				}
						break;
				}
				

				case 'Choix Multiple':
			{
				echo "<h2>".($i)." .".$json[$i]["question"]."</h2>";
								
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
							echo "<h2>".($i)." .".$json[$i]["question"]."</h2>";
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
															$indice_debut=(($page_actuelle-1)*NB_QUESTION_PAGE)+1;
															$indice_fin=(($page_actuelle)*NB_QUESTION_PAGE)+1;
																for ($i=$indice_debut;$i<$indice_fin;$i++)
																{
																			if ($i==0)
																				continue;
																		
																	switch($json[$i]["type-reponse"])
																	{

																		case 'Choix Simple':
																		{
																			echo "<h2>".($i)." .".$json[$i]["question"]."</h2>";
																			$tab_cle=reccupere_cle_reponse_simple($json[$i]);
																							foreach ($tab_cle  as $cle) {
																											if ($json[$i]["radio"]==$cle)
																											{
																											
																													echo "<input type='radio' name='radio_".($i)."' checked>".$json[$i][$cle]."<br>";
																											}
																												else
																																if ($cle!=("radio"))
																													echo "<input type='radio' name='radio_".($i)."'>".$json[$i][$cle]."<br>";
																			}
																					break;
																			}
																			

																			case 'Choix Multiple':
																		{
																			echo "<h2>".($i)." .".$json[$i]["question"]."</h2>";
																							
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
																						echo "<h2>".($i)." .".$json[$i]["question"]."</h2>";
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
			echo "<a href='menu_admin.php?numero_page=".($page_actuelle+1)."&page=1'><input type='submit' class='next-btn-question 'value='Suivant'></a>";


?>

<script type="text/javascript">
	function Validation()
	{
		var formulaire=document.getElementById('form-question');
		var input=document.getElementById('question');
		var div=document.getElementById('nb_question');
		if (input.value=="" || input.value < 5)
		{
			var msg=document.createElement('div');
			msg.innerHTML="Le nombre de questions par jeu est au minimum 5";
			msg.style.color="red";
			div.appendChild(msg);
			input.value=5;
			alert("Le nombre de questions par jeu est au minimum 5");
		}
		else
			alert ('Modification fait avec succées');
	}
</script>
