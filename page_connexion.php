
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
				<input type="text" class="form-control"name="login" error="error-1">
				<div class="icone-form icon-form-login">
				
				</div>
				</div>
				<div class="error-form" error="error-1">
				*Ce champ est obligatoire
				
				
				</div>

				<div class="input-form">
				<input type="password" class="form-control" name="password" error="error-2">
				<div class="icone-form icon-form-pwd">
				
				</div>
				</div>
				<div class="error-form" error="error-2">*Ce champ est obligatoire
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
	alert ('ok');
	const inputs=document.getElementByTagname("input");
	for (input of inputs)
	{
		input.addEventListener("keyup",function(e){
			if (e.target.hasAttribute("error"))
			{
				var idDiverror=input.getAttribute("error");
				document.getElementById(idDiverror).innerTexte"Ce champ est obligatoire";
			}
		})
			}
		
	


    documentgetElementById("form-connexion").addEventListener("submit",function(e)
    {
        const inputs=document.getElementByTagname("input");
        var error="false";
        for(input of inputs)
        	if (input.hasAttribute("error"))
                 
            {
                var idDiverror=input.getAttribute("error");
                if (!input.value)
                {
                document.getElementById(idDivError).innerText="Ce champ est obligatoire";
            	}
            error="true";
            }}
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
				$_SESSION=$json[$i];
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
else
		echo "
		<script>
			alert ('Le login et le Mot de Passe sont obligatoires' );
		</script>
		";


?>
