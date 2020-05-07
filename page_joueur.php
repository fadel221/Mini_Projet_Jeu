<?php
session_start();
if (empty($_SESSION))
   header('location:index.php.php');
 
require_once "fonctions.php";
$json_question=file_get_contents("questions.json");
$json_question=json_decode($json_question,true);
$json_seeting=file_get_contents("seetings.json");
$json_seeting=json_decode($json_seeting,true);

/*----------------------------Algorithme de Pagination-------------------*/
                          
$nbre_pages=$json_seeting[0]["nb_questions_par_jeu"];
if (isset($_GET["num_page"])&& !empty($_GET["num_page"]))
{
    if ($_GET["num_page"]==$nbre_pages || 0>$_GET["num_page"])
        $_GET["num_page"]=0;
    $page_actuelle=$_GET["num_page"];

    
}
else 
    $page_actuelle=0;
/*-------------------------------------------------------------------------*/
?>




<!DOCTYPE html>
<html>
<head>
	<title>Interface Joueur</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
<div class="header">

            <div class="logo">
                
            </div>

                <div align="center" class="header-text">
                    Le Plaisir de jouer
                </div>

        </div>
        
        <div class="content">
        	<div class="container-page-joueur">
        		<div class="header-container-page-joueur">
        			
        			<div class="info-joueur">
        				
        			<div class="img-circle-joueur"style="background-image:url('<?php  echo$_SESSION["img"]; ?>');background-size: 100%; background-repeat: no-repeat;">
        				</div>
                        <div class="nom-joueur">
                            
                        

<?php 
echo $_SESSION["username"]." ".$_SESSION["nom"] 
?>
                        </div>    			
    
                    	

        			</div>

            <div class="text-header-container-joueur">
                <p>BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ</p>
                <p>JOUER ET TESTER VOTRE NIVEAU DE CULTURE GENERALE</p>
                

                <input type="submit" name="deconnect" id="btn-deconnexion" value="Deconnexion">
                


            </div>

        		</div>


        <div class="font-body-container-joueur">
                    
            <div class="body-container-joueur">
                    
                <div class="container-questionnaire">
                
                    <div class="number-question">

<?php


/*----------------------------Affichage des Questions-------------------*/


    echo "<h1 align='center'>Question ".($page_actuelle+1)."/".$nbre_pages."</h1><h2 align='center'>".$json_question[$page_actuelle]['question']."</h2>";


?>




                    
                        </div>
                            <input type="text" name="nbre_point" id="nbre_point" value= <?php

    echo $json_question[$page_actuelle]["nb-point"]."pts";
?>>
                        
                        
                        </div>
                                    

                        <div class="cocher-reponse">
            
                    
            <?php
/*----------------------------Affichage des Réponses-----------------------*/ 
echo "<form method='post'>";

$i=$page_actuelle;
switch($json_question[$i]["type-reponse"])
    
{
case "Choix Simple":
    foreach ($json_question[$i] as $key => $value) {
            
    if (!($key=="nb-point" || $key=="type-reponse" || $key=="radio" || $key=="question")) 
            echo "<input type='radio' id='radio' class='btn-radio' name='reponse' value=".$value.">"." ".$value."<br>";


        }
        break;
case 'Texte à Saisir':
            
 echo "<input type='text' class='row'>"; 

    break;

case 'Choix Multiple':

for ($j=0;$j<count($json_question[$i]);$j++)
        {
            $reponse="reponse_multiple_".($j+1);
             if (isset($json_question[$i]["check_".($j+1)]))
                echo "<input type='checkbox'>".$json_question[$i][$reponse]."<br>";
             else
                if (isset($json_question[$i][$reponse]))
                echo "<input type='checkbox'>".$json_question[$i][$reponse]."<br>";
        }
            
            break;
        }

echo "</form>";

?>


        



        

             

                        </div>


                        <div class="container-score">
                            
                            <div class="menu-score">
                                
                            <div class="menu-score1" 

                                      <?php  
            if (isset ($_GET["page"]) && $_GET["page"]==1)

        echo "style='background-color:darkturquoise;color:brown;border:1px solid black;border-radius:5px;'";?>>
                            
                            
                            <a href="page_joueur.php?page=1">Top Score</a>        
                                </div>

                                <div class="menu-score2"

                                <?php  
            if (isset ($_GET["page"]) && $_GET["page"]==2)

        echo "style='background-color:silver;color:brown;border:1px solid black;border-radius:5px;'";?>>


                                
                            
                            <a href="page_joueur.php?page=2">Mon meilleur score</a>        
                                </div>

                            </div>

                            <div class="page-choisie">
                                
                                <?php

        if (!empty($_GET["page"]))
        {
            if ($_GET["page"]=='2')
                require('Top_score.php');

            else if($_GET["page"]=='1')
                require('best_player_score.php');
        }

            else
                require('Top_score.php');
                
                
                ?>
                            </div>

                        </div>

                    </div>

                    </div>

                </div>

                </div>

    </form>


                <div class="bouton">
                    
          


                    
                        
                        
                        <?php


/*-------------------------Bouton Precedent pour retour-------------------*/



   echo" <a href='page_joueur.php?num_page=".($page_actuelle-1)."'><input type='submit'  value='Précedent' id='btn-precedent'></a>";



/*--------------------------Bouton suivant pour avancer-------------------*/

    echo "<a href='page_joueur.php?num_page=".($page_actuelle+1)."'><input type='submit' name='suivant' value='Suivant' id='btn-suivant'></a>";

    if ($page_actuelle==($nbre_pages-1))
    {

            echo "<script>
                var element=document.getElementById('btn-suivant');
                element.value='Terminé';


                </script>";

    }
    else
        if ($page_actuelle==0)
            {

                echo "<script>
                var element=document.getElementById('btn-precedent');
                element.style.backgroundColor='silver';
                element.addEventListener('click',function (e){
                    e.preventDefault();
                    
                    });

                </script>";

            }  
echo "</div>";
if (empty($_SESSION))
	//Test pour sécuriser l'accées
	header('location:index.php.php');

/*-------------------------------Déconnexion-------------------------------*/
 if (isset($_POST["deconnect"]) && !empty($_POST["deconnect"]))
{

unset($_SESSION);
session_destroy();


}
?>


  
