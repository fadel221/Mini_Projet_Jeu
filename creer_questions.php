<!DOCTYPE html>
<html>
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

			<div class="type-reponse">
				<label>Type de réponses</label>
				<select name="type-reponse" id="select">
					<option>Choix Unique</option>
					<option>Choix Multiple</option>
				</select>

				<button onclick="alert ('ok');">
				<img src="ic-ajout-réponse.png" id="icone-ajout-reponse">
				</button>

			</div>

		</form>
	</div>
	
</div>


</body>
</html>





<?php  ?>