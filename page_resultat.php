<?php
session_start();
if (empty($_SESSION))
   header('location:index.php.php');
 
require_once "fonctions.php";
$json_question=file_get_contents("questions.json");
$json_question=json_decode($json_question,true);
$json_seeting=file_get_contents("seetings.json");
$json_seeting=json_decode($json_seeting,true);


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
                
                        
                    
                
                        <h1></h1>
                        

                        
            
               
            <?php

/*----------------------------Traitement des Réponses-----------------------*/        

    $score=0;
    $score_totale=0;                
    for ($i=0;$i<$_SESSION["nbre_pages"];$i++)
    {
        if (isset($_SESSION["type_question"][$i]))
        {
            $score_totale+=$_SESSION["nb-point"][$i];
            switch ($_SESSION["type_question"][$i])
            {
                case 'radio': 
                
                  $indice =reccupere_indice_question($json_question,$_SESSION["index"][$i]);
                  if ($_SESSION["reponse_radio"][$i]==$json_question[$indice]["radio"])
                  {
                        $_SESSION["joueur"]["score"]+=$_SESSION["nb-point"][$i];
                        $score+=$_SESSION["nb-point"][$i];
                        echo "<h2>Question ".($i+1)." trouvé</h1>";



                  }
                  else
                    echo "<h2>Question ".($i+1)."non trouvé</h1>";
                    break;
                

                case 'multiple':
                
                
                    $indice=reccupere_indice_question($json_question,$_SESSION["index"][$i]);
                    $tab_reponse=reccupere_reponse_multiple($json_question,$indice);          
                    if (!(count ($tab_reponse)==count($_SESSION["reponse_multiple"][$i])))
                    {
                        echo "<h2>Question ".($i+1)." trouvé</h2>";
                    }
                    else
                    {
                        for ($j=0; $j<count($tab_reponse);$j++) 
                        { 
                            if ($tab_reponse[$j]==$_SESSION["reponse_multiple"][$i][$j])
                            {
                                $echec=0;
                            }
                            else
                            {
                                $echec=1;
                                break;
                            }
                        }
                        if ($echec==1)
                            echo "<h2>Question ".($i+1)."non trouvé</h2>";
                        else
                        {
                        $_SESSION["joueur"]["score"]+=$_SESSION["nb-point"][$i];
                        $score+=$_SESSION["nb-point"][$i];
                        echo "<h2>Question ".($i+1)." trouvé</h2>";

                        }
                    }
                    break;

            case 'simple':$indice=reccupere_indice_question($json_question,$_SESSION["index"][$i]);
                var_dump($_SESSION);
                if ($json_question[$indice]["question_simple"]==$_SESSION["reponse_simple"][$i])
                {
                        $_SESSION["joueur"]["score"]+=$_SESSION["nb-point"][$i];
                        $score+=$_SESSION["nb-point"][$i];
                        echo "<h2>Question ".($i+1)." trouvé</h2>";
                        
                }
                else
                    echo "<h2>Question ".($i+1)."pas trouvé</h1>";
                
                break;
            }
    }
    
    }


echo"<h1> Votre score est ".$score."/".$score_totale."</h1>";


$Json=file_get_contents("bd.json");
$Json=json_decode($Json,true);
for ($i=0; $i<count($Json) ; $i++) 
{ 
    if ($Json[$i]["login"]==$_SESSION["joueur"]["login"])
    {
        $Json[$i]["score"]=$_SESSION["joueur"]["score"];
        break;
    }    
}
$Json=json_encode($Json);
file_put_contents("bd.json", $Json);


        
        
        
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

                


<?php
if (empty($_SESSION))
    //Test pour sécuriser l'accées
    header('location:index.php.php');

if (isset($_POST["deconnect"])&& !empty($_POST["deconnect"]))

{
    

    echo "
<script>
if (!confirm('Voulez vous déconnectez ?'))

    

</script>";
session_destroy();
unset($_SESSION);
}



?>


  
