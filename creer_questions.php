<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<link rel="stylesheet"  href="style.css">
	<title>Menu Creation questions</title>
</head>
<body>

<div class="header-container-creation-question">
		PARAMETRER VOTRE QUESTION
	</div>

<div class="container-creation-question">
	<div class="form-creation-question">
		<form method="post">
			<div>
			<label id="label-questions">Questions</label>
			<textarea name="questions" cols="50px" rows="7px" id="textarea-questions">
				
			</textarea>
			</div>

			<div class="nb-point">
				<label for="nb-points">Nbre de Points</label>
				<input type="number" name="nb-points" id="nb-points">
			</div>

			<div id="type-reponse">
				<label>Type de réponses</label>
				<select name="type-reponse" id="select" value="bcwd w">
					<option>Choix Simple</option>
					<option>Choix Multiple</option>
					<option>Texte à Saisir</option>
				</select>
				<button type="button" class="btn_ajout" onclick="AddInput()">
				</button>

				</div>
				<div class="record">
			<input type="submit" name="record" value="Enregistrer">
			</div>
			</div>
				 
				
				
		
		

		
<script>
	var nb=0;
	function AddInput() 
	{
		nb++;
		var divInputs=document.getElementById('type-reponse');
		var newInput=document.createElement('div');
		newInput.setAttribute('class','row');
		newInput.setAttribute('id','row_'+nb);
		newInput.innerHTML='<label id="labels">Réponse '+nb+'</label><input type="text" name="rep_'+nb+'" id="champ-js"><input type="checkbox" class="btn_check" name="check_'+nb+'"><input type="radio" name="radio_'+nb+'" class="btn_radio"><button class="btn_supp" onclick="DeleteInput(${nb})"></button>';
		divInputs.appendChild(newInput);
	}

	function DeleteInput(n)
	{
		var target=document.getElementById('row_'+n);
		target.remove();
	}
</script>	

</form>
</body>
</html>


<?php 
if (isset($_POST["record"])&& !empty($_POST["record"]))
{
	if (isset($_POST["questions"])&& !empty($_POST["questions"]))
	{
		if (isset($_POST["nb-points"]) && !empty($_POST["nb-points"]))

		{
			if ($_POST["nb-points"]>=1)
			{
				if (isset($_POST["type-reponse"]) && !empty($_POST["type-reponse"]))
				{
					$json=file_get_contents("questions.json");
					$json=json_decode($json,true);
					$json[]=$_POST;
					$json=json_encode($json);
					file_put_contents("questions.json",$json);
				}
				else
				echo "<script>
            alert('Saisissez le type de réponses');
                </script>";
			}
			else
			echo "<script>
            alert('Le nombre doit etre supérieur ou égale à 1');
                </script>";
		}
		else
		echo "<script>
            alert('Saisissez le nombre de points');
                </script>";
	}
	else
	echo "<script>
            alert('Saisissez la question');
                </script>";
}



?>

