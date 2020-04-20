<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Interface Jeu</title>
</head>
<body>
	<div id ="fond1" >
		<div id="logo">
			
		</div>
		<div>
		<p align="center" style="position:relative;display:block; color: white;font-size:35px;margin: auto;top:20px;">Le plaisir de jouer</p>
	</div>
</div>
	<div id="container">

			<div id ="fond2">

				<div id="fond3">
					<p align="center">BIENVENUE SUR LA PLATEFORME DE JEU ET DE QUIZZ</p>
					<p align="center">JOUER ET TESTER VOTRE NIVEAU DE CULTURE GENERALE</p>
					<form method="post" action="">
						<input type="submit" name="deconnect" value="déconnexion">
					</form>
				</div>
			
				<div id="fond4">
					
					<div id="fond5">
						
						<div id="fond_question">

					</div>
						
						<div id="fond_point">
						</div>

						<div id="affichage_question">

							<div id="bouton">
							
					<input type="submit"name="previous"value="Précédent">
					<input type="submit"name="next"value="Suivant">

							</div>

						</div>

			</div>

			

			</div>
		</div>
	</div>
</body>
</html>

<style>

body
{

}

#logo
{
	position: absolute;
	display: inline-block;
	background-image: url('logo-QuizzSA.png');
	background-size: 35%; 
	background-repeat: no-repeat;
	width:10%;
	height: 75px;
}

#fond1
{
	width:100%;
	height: 80px;
	background-color:#00011F;
	margin: auto;
}

#container
{
margin: auto;
width:100%;
height:55em; 
background-image: url('img-bg.jpg');
background-size: 100%;
background-repeat: no-repeat;
}

#fond2
{
position: relative;
width: 90%;
height: 48em;
background-color: lightgray;
margin: auto;
border-radius: 12px;
margin-bottom:2px;
top:10px;
}
#fond3
{
	width:100%;
	height: 15%;
	background-color: skyblue;

}
p
{
	position: relative;
	display: block;
	margin: auto;
	font-size:30px;
	color:white;
	top:25px; 
}
input[name="deconnect"]
{
	position: relative;
	display: inline-block;
	width:12%;
	height: 30px;
	background-color: lightblue;
	left: 85%;
	bottom: 20px;
	cursor: pointer;
}
#fond4
{
	margin:auto;
	position: relative;
	background-color: white;
	width:80%;
	height: 80%;
	margin-top: 15px;
	border-radius: 10px;
}

#fond5
{
	width:60%;
	height: 95%;
	border: 1.4px solid skyblue;
	position: relative;
	display: inline-block; 
	top:20px;	
	border-radius: 13px;
	left: 2%;
}
#fond_question
{
width:90%;
height: 22%;
position: relative;
display: inline-block;
border: 2px solid skyblue;
background-color: lightgray;
left:5%;
top:3%;
}
#fond_point
{
width:12%;
height: 5%;
position: relative;
display: inline-block;
background-color: lightgray;
border:2px solid skyblue;
top:6%;
left:83%;
}

#affichage_question
{
width:100%;
position: relative;
display: inline-block;
height:62%;
top:7%;
}

#bouton
{
	width:100%;
	height: 17%;
	position: absolute;
	display:block;
	top:83%;
}
input[name="previous"]
{
	width: 22%;
	height: 65%;
	position: relative;
	display: inline-block;
	background-color: lightgray;
	top:20%;
	font-size:20px;
	color:white;
	cursor:pointer;
}

input[name="next"]
{
	width: 22%;
	height: 65%;
	position: absolute;
	display: inline-block;
	background-color:skyblue;
	margin-left:56%;
	top:20%;
	font-size:20px;
	color:white;
	cursor:pointer;
}




<?php
if (empty($_SESSION))
	//Test pour sécuriser l'accées
	header('location:index.php.php');

if (isset($_POST["deconnect"])&& !empty($_POST["deconnect"]))

{
	session_destroy();
	header('location:index.php.php');
}



?>
