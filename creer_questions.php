<?php 
if (empty($_SESSION))
	header('Location:index.php.php');

 ?>

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
		<label id="label-question" for="textarea">Question</label>
		<textarea  id="textarea-questions" name="question" cols="40px" rows="6px" required='required'></textarea>
	</div>
	<div class="element-question">
		<label id="label-question" for="nb-point">Nbre de Points</label>
		<input type="number" required="required" id="nb-points"name="nb-point" min="1">
	</div>
	<div class="element-question" >
		<label id="label-question" for="select">Type de Réponse</label>
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
		<input type="submit" name="record" value="Enregistrer" id="record" onclick="Error()">
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
		newInput.setAttribute('id','input_'+num);
	function DoEvent()
	{
		
		switch (select.value)
		{
			case "Donner le type de réponse":newInput.innerHTML='';
			break;

			case "Texte à Saisir":newInput.innerHTML='<input type="text" class="champ-js" name="question_simple" required="required">';
					parent.innerHTML="";
						parent.appendChild(newInput);break;
			
				case "Choix Multiple": 
				num=1;
				newInput.innerHTML='<input type="text" name="reponse_multiple_'+num+'"class="champ-js" id="input_'+num+'" required="required"><input type="checkbox" class="btn_check" name="check_'+num+'" value="reponse_multiple_'+num+'"><button type="button" class="btn_supp" id="btn_supp" onclick=DeleteInput(num);num--;></button>';
					parent.innerHTML="";
					parent.appendChild(newInput);
					break;

					case "Choix Simple": 
				num=1;
				newInput.innerHTML='<input class="champ-js" type="text" required="required" name="reponse_simple_'+num+'"><input type="radio" class="btn_radio" id="input_'+num+'" name="radio" value="reponse_simple_'+num+'"><button type="button" class="btn_supp" id="btn_supp" onclick=DeleteInput(num);num--;></button>';
					parent.innerHTML="";
					parent.appendChild(newInput);
					break;
		}
}
		function AddChampQuestionSimple()
		{
			num++;
			var input=document.createElement('div');
			input.setAttribute('class','row');
			input.setAttribute('id','row_'+num)
			
					switch (select.value)
					{
						case "Choix Simple":
			 input.innerHTML='<input id="input_'+num+'" class="champ-js" required="required" type="text" name="reponse_simple_'+num+'"><input type="radio" class="btn_radio" name="radio" value="reponse_simple_'+num+'"><button type="button" class="btn_supp" id="btn_supp" onclick=DeleteInput(num);num--;></button>';break;


			 		case "Choix Multiple":
							input.innerHTML='<input type="text" name="reponse_multiple_'+num+'"class="champ-js" id="input_'+num+'" required="required"><input type="checkbox" class="btn_check" name="check_'+num+'" value="reponse_multiple_'+num+'"><button type="button" id="btn_supp" class="btn_supp" onclick=DeleteInput(num);num--; ></button>';
								break;
								}	 		
					parent.appendChild(input);
		}
	
	


var btn=document.getElementById('form-questions');
btn.addEventListener('submit',function(e)
		{
			if (select.value=="Donner le type de réponse") 
	{ 
		alert('Choisissez un type de réponses');
		e.preventDefault();
	}
	else
		alert ("Question enregistrèe avec succés <3")
});
	

function DeleteInput(num)
	{

		if (num==3 && select.value=="Choix Multiple")
		{
			alert ('Pour ce type choix il faut au minimum trois champs');
		DeleteInput.preventDefault();
		}
		else
			if (num==2 && select.value=="Choix Simple")
			{
				alert ('Pour ce type choix il faut au minimum deux champs');
				DeleteInput.preventDefault();
			}
		else
		{	
		var fils=document.getElementById('row_'+num);
		fils.remove();
		}
	}

function Error ()
{
	var element=document.getElementsByClassName('row');
		for (var i=0; i<element.length; i++) {
			if (element[i].value=="")
			{
				var a =document.createElement('div');
				a.innerHTML="Error";
				a.style.color="red";
				element[i].appendChild(a);	
			}
}
}

</script>



<?php  


$json=file_get_contents("questions.json");
$json=json_decode($json,true);
if (isset($_POST) && !empty($_POST))
{
	if (isset($_POST["record"]) && !empty($_POST["record"]))
	{
	unset($_POST["record"]);
	$_POST["index"]=count($json);
	$json[]=$_POST;
	var_dump($json);
	$json=json_encode($json);
	file_put_contents("questions.json",$json);
}
}
?>