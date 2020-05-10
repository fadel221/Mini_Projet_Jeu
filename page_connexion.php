


<html>
<head>
	<title>Page de Connexion</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<div class="header-container">
				<div class="header-title">
				Login Form
				</div>
			</div>
			<div class="container-body">
				<form method="post" action="" id="form-connexion">
				<div class="input-form">
				<input type="text" class="form-control" name="login" id="Input1">
				<div class="icone-form icon-form-login">
				
				</div>
				</div>
				<div id="error-form1" class="error-form">
				
				
				</div>

				<div class="input-form">
				<input type="password" class="form-control" name="password" id="Input2">
				<div class="icone-form icon-form-pwd">
				
				</div>
				</div>
				<div id="error-form2" class="error-form">
				</div>

				<div class="input-form">
				<button type="submit" class="submit-btn" name="sub">Connexion
					</button>
				</form>
					<a href="inscription_joueur.php" class="link-form">S'inscrire pour jouer</a>
				</div>

			</div>
		</div>
</body>

<script>

	var form=document.getElementById('form-connexion');
	form.addEventListener('submit',function(e){
		var login=document.getElementById('Input1');
		var password=document.getElementById('Input2');
			if (login.value.trim()=="" || password.value.trim()=="")
			{
				var myError1=document.getElementById('error-form1');
				var myError2=document.getElementById('error-form2');
				myError1.innerHTML="Ce champ est obligatoire";
				myError2.innerHTML="Ce champ est obligatoire";
				e.preventDefault();
			}
	})
	
	
</script>

</html>

<?php
session_start();
		$json=file_get_contents("bd.json");
		$json=json_decode($json,true);

if (isset($_POST["sub"]))
{
	if (!empty($_POST["login"])&& !empty($_POST["password"]))
	{
		for ($i=0;$i<count($json);$i++)
		{
			if ($_POST["login"]==$json[$i]["login"] && $_POST["password"]==$json[$i]["password"])
			{
				$_SESSION["joueur"]=$json[$i];
				if ($json[$i]["role"]=="player")

					header('Location: page_joueur.php');
				else 

					header('Location: menu_admin.php');
				
			}
			
			
		
}

	

}
	else
				echo "
		<script>
			alert ('Login ou Mot de Passe incorrect' );
		</script>
		";

	
}


?>
