<!DOCTYPE html>
<html>
<head>
	<title>Creation Questions</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header-container-creation-question">
		PARAMETRER VOTRE QUESTION
	</div>
<div class="container-creation-question">
	<form method="post" id="form-questions">
	<div class="element-question">
		<label for="textarea">Question</label>
		<textarea  id="textarea-questions" name="question" cols="40px" rows="6px"></textarea>
	</div>
	<div class="element-question">
		<label for="nb-point">Nbre de Points</label>
		<input type="number" id="nb-points"name="nb-point" min="1">
	</div>
	<div class="element-question" >
		<label for="select">Type de Réponse</label>
		<select name="type-reponse" id="select" onclick="DoEvent()">
				<option>Donner le type de réponse</option>
				<option value="Texte à Saisir">Texte à Saisir</option>
				<option value="Choix Simple">Choix Simple</option>
				<option value="Choix Multiple">Choix Multiple</option>
		</select>

		<div class="btn_ajout" onclick="AddChampQuestionSimple()">
			
		</div>

	</div>

	<div class="newInput" id="parent">
		
	</div>
	<div class="record">
		<input type="submit" name="record" value="Enregistrer" id="record" submit=';'>
	</div>
</form>
</div>
</body>
</html>


<script>
var num=1;
var select=document.getElementById('select');	
		var newInput=document.createElement('div');
		var parent = document.getElementById('parent');
		newInput.setAttribute('class','row');
	function DoEvent()
	{
		
		switch (select.value)
		{
			case "Donner le type de réponse":newInput.innerHTML='';num=1;
			break;

			case "Texte à Saisir":newInput.innerHTML='<input type="text" class="champ-js" name="question_simple">';
					parent.innerHTML="";
						parent.appendChild(newInput);break;
			
				case "Choix Multiple": 
				num=1;
				newInput.innerHTML='<input type="text" name="reponse_multiple_'+num+'"class="champ-js" id="input_'+num+'"><input type="checkbox" class="btn_check" name="check_'+num+'"><button type="button" class="btn_supp" onclick="DeleteInput(${num})"></button>';
					parent.innerHTML="";
					parent.appendChild(newInput);
					break;

					case "Choix Simple": 
				num=1;
				newInput.innerHTML='<input class="champ-js" type="text" name="reponse_simple_'+num+'"><input type="radio" class="btn_radio" id="input_'+num+'" name="radio" value="reponse_simple_'+num+'"><button type="button" class="btn_supp" onclick="DeleteInput(${num})"></button>';
					parent.innerHTML="";
					parent.appendChild(newInput);
					break;
		}
}
		function AddChampQuestionSimple()
		{
			var input=document.createElement('div');
			input.setAttribute('class','row');
			num++;
					switch (select.value)
					{
						case "Choix Simple":
			 input.innerHTML='<input id="input_'+num+'" class="champ-js" type="text" name="reponse_simple_'+num+'"><input type="radio" class="btn_radio" name="radio" value="reponse_simple_'+num+'"><button type="button" class="btn_supp" onclick="DeleteInput(${num})"></button>';break;


			 		case "Choix Multiple":
							input.innerHTML='<input type="text" name="reponse_multiple_'+num+'"class="champ-js" id="input_'+num+'"><input type="checkbox" class="btn_check" name="check_'+num+'"><button type="button" class="btn_supp" onclick="DeleteInput(${num})"></button>';
								break;
								}	 		
					parent.appendChild(input);
		}
	
	function DeleteInput(n)
	{
		alert('ok');
		 var target=document.getElementById('input_'+n);
		 target.remove();
	}
var btn=document.getElementById('form-questions');
btn.addEventListener('submit',function(e)
		{
			if (select.value=="Donner le type de réponse") 
	{ 
		e.preventDefault();
	}
});
	

</script>



<?php  
unset($_POST["record"]);
$json=file_get_contents("questions.json");
$json=json_decode($json,true);
$json[]=$_POST;
$json=json_encode($json);
file_put_contents("questions.json",$json);
?>