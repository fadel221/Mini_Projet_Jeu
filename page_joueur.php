<?php
session_start();
if (empty($_SESSION))
   header('location:index.php.php');
 
require_once "fonctions.php";
$json_question=file_get_contents("questions.json");
$json_question=json_decode($json_question,true);
$json_seeting=file_get_contents("seetings.json");
$json_seeting=json_decode($json_seeting,true);


/*---------------------Algorithme de Pagination sans url-------------------*/
                          
$_SESSION["nbre_pages"]=$json_seeting[0]["nb_questions_par_jeu"];
$_SESSION["question_total"]=count($json_question)-1;
if ( empty($_POST["next"]) && empty($_POST["cancel"]))
{ 
    $_SESSION["position"]=0;
    $_SESSION["indice"]=range(0,$_SESSION["question_total"]);

    $_SESSION["indice"]=array_rand($_SESSION["indice"],$_SESSION["nbre_pages"]);
    shuffle($_SESSION["indice"]);
    
}

    else if (!empty($_POST["next"]))

        $_SESSION["position"]++;

else if ( !empty($_POST["cancel"]) )
{ 
    $_SESSION["position"]--;
}
/*----------------------------------------------------------------------------------------------*/

/*-----------------------------------Redirection à la page résultat lorsque le jeu se termine--------*/  

if ($_SESSION["position"]==$_SESSION["nbre_pages"])
    header('Location:page_resultat.php');
    
    $page_actuelle=$_SESSION["position"];
    
/*----------------------------------------------------------------------------------------------*/
$indice=$_SESSION["indice"][$page_actuelle];

    if (!empty($_POST["next"]))
    {
        $new_indice=$_SESSION["indice"][$page_actuelle-1];
        if ($_SESSION["choix"]==1)
        {

            if (!empty($_POST["reponse_radio"]))
            {
                $_SESSION["type_question"][$page_actuelle-1]="radio";
                $_SESSION["reponse_radio"][$page_actuelle-1]=$_POST["reponse_radio"];
                $_SESSION["index"][$page_actuelle-1]=$json_question[$new_indice]["index"];
                $_SESSION["nb-point"][$page_actuelle-1]=$json_question[$new_indice]["nb-point"];
            }
        }
            else if ($_SESSION["choix"]==2)
            {
                if (!empty($_POST["reponse_simple"]))
                {
                    $_SESSION["type-question"][$page_actuelle-1]="simple";
                    $_SESSION["reponse_simple"][$page_actuelle-1]=$_POST["reponse_simple"];
                    $_SESSION["index"][$page_actuelle-1]=$json_question[$new_indice]["index"];
                    $_SESSION["nb-point"][$page_actuelle-1]=$json_question[$new_indice]["nb-point"];
                }
            }
            else if ($_SESSION["choix"]==3)
            {
                if (count($_POST)>=3)
                {
                $_SESSION["type_question"][$page_actuelle-1]="multiple";
                nb_reponse_checkbox($_SESSION["nbre_checkbox"],$page_actuelle-1);
                $_SESSION["index"][$page_actuelle-1]=$json_question[$new_indice]["index"];
                $_SESSION["nb-point"][$page_actuelle-1]=$json_question[$new_indice]["nb-point"];
            }
        }

    }

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
                        
                    <div class="img-circle-joueur"style="background-image:url('<?php  echo$_SESSION["joueur"]["img"]; ?>');background-size: 100%; background-repeat: no-repeat;">
                        </div>
                        <div class="nom-joueur">
                            
                        

<?php 
echo $_SESSION["joueur"]["username"]." ".$_SESSION["joueur"]["nom"] 
?>
                        </div>              
    
                        

                    </div>

            <div class="text-header-container-joueur">
                <p>BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ</p>
                <p>JOUER ET TESTER VOTRE NIVEAU DE CULTURE GENERALE</p>
                <form method="POST">
                <input type="submit" name="deconnect" id="btn-deconnexion" value="Deconnexion">
                


            </div>

                </div>

        <div class="font-body-container-joueur">
                    
            <div class="body-container-joueur">
                    
                <div class="container-questionnaire">
                
                    <div class="number-question">

<?php

/*----------------------------Affichage des Questions-------------------*/


    echo "<h1 align='center'>Question ".($page_actuelle+1)."/".$_SESSION["nbre_pages"]."</h1>";

    echo"<h2 align='center'>".$json_question[$indice]["question"]."<h2>";


?>
    



                    
                        </div>
                        
                            <input type="text" name="nbre_point" id="nbre_point" value= <?php

    echo $json_question[$indice]["nb-point"]."pts";
?>>
                
                        
                        </div>

                        <div class="cocher-reponse">
            
               
            <?php

/*----------------------------Affichage des Réponses-----------------------*/                                    
$i=$page_actuelle;


switch($json_question[$indice]["type-reponse"])
    
{
case "Choix Simple":
$_SESSION["choix"]=1;
$i=1;
    foreach ($json_question[$indice] as $key => $value) {
      $name_reponse="reponse_simple_".$i;      
    if (!($key=="nb-point" || $key=="type-reponse" || $key=="radio" || $key=="question" || $key=="index"))
        { 
            echo "<input type='radio' name='reponse_radio' value='".$name_reponse."'>"." ".$value."<br>";
        $i++;
        }
        }
        
        break;
case 'Texte à Saisir':
            
 echo "<input type='text' class='row' name='reponse_simple'>"; 
$_SESSION["choix"]=2;
    break;

case 'Choix Multiple':
$_SESSION["nbre_checkbox"]=0;
for ($j=0;$j<count($json_question[$indice]);$j++)
        {
            $reponse="reponse_multiple_".($j+1);
                if (isset($json_question[$indice][$reponse]))
                {
                    $_SESSION["nbre_checkbox"]++;
                echo "<input type='checkbox' name='".$reponse."' value='".$reponse."'>".$json_question[$indice][$reponse]."<br>";
                }
        }
            $_SESSION["choix"]=3;   
            break;
        }
        
    
        
/*-------------------------------------------------------------------------*/
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

            </div>
       </div>
</body>
</html>

                <div class="bouton">
                    
          


                    
                        
                        
                    






    <input type='submit' name="cancel"  value='Précedent' id='btn-precedent'>





    <input  type='submit' name="next" value='Suivant' id='btn-suivant' >

<?php
    if ($page_actuelle==($_SESSION["nbre_pages"]-1))
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
              
?>


</div>


<?php
if (empty($_SESSION))
    //Test pour sécuriser l'accées
    header('location:index.php.php');

if (isset($_POST["deconnect"])&& !empty($_POST["deconnect"]))

{
    

    echo "
<script>
if (confirm('Voulez vous déconnectez ?'))

    document.location.href='index.php.php';


</script>";
unset($_SESSION);
session_destroy();

}



?>


  
