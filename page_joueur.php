<?php
session_start();

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
                <form method="POST">
                <input type="submit" name="deconnect" id="btn-deconnexion" value="Deconnexion">
                </form>


            </div>

        		</div>

        <div class="font-body-container-joueur">
                    
            <div class="body-container-joueur">
                    
                <div class="container-questionnaire">
                
                    <div class="number-question">
                    
                        </div>
                        <form>
                            <input type="text" name="nbre_point" id="nbre_point" value="x pts">
                        </form>
                        
                        </div>

                        <div class="cocher-reponse">
                            


                        </div>

                <div class="bouton">
                    <form method="post">
                        
                    <input type="submit" name="previous" value="Précedent"
                    id="btn-precedent">

                    <input type="submit" name="next" value="Suivant" id="btn-suivant">

                    </form>
                        
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
            if ($_GET["page"]=='1')
                require('Top_score.php');

            else if($_GET["page"]=='2')
                require('best_player_score.php');
        }

            else
                require('best_player_score.php');
                
                
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
	session_destroy();

    echo "
<script>
if (confirm('Voulez vous déconnectez ?'))

    document.location.href='index.php.php'

</script>";

}



?>
