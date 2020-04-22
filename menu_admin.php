<?php
session_start();
if (empty($_SESSION))
    header('location:index.php.php'); 
?>

<html>
    <head>
        <title>Menu Admin</title>
        <link rel="stylesheet" href= "style.css">
    </head>
    <body>
        <div class="header">

            <div class="logo">
                
            </div>

                <div align="center"class="header-text">
                    Le Plaisir de jouer
                </div>

        </div>
        
        <div class="content">
       
                <div class="container-menu">

        <div class="header-container-menu">
            <div align="center" class="text-header-container-menu">CREER ET PARAMETRER VOS QUIZZS
                <form method="post">
                <input class="deconnect-btn" type="submit" name="deconnect" value="Déconnexion">
            </form>
            </div>
        </div>

        <div class="body-container">
            <div class="menu-container">

                <div class="header-menu-container">
                    <div class="decoration-circle" style="background-size:100%;background-image:url(<?php
                     echo $_SESSION["img"]; ?>);">

                        <div class="nom-admin">
                        <?php 
                        if (!empty($_SESSION))
                        echo $_SESSION["username"]." ".$_SESSION["nom"]; ?>
                        </div>
                        </div>
            </div>
                        <a href="menu_admin.php?page=1">
                    <div class="choix-page">

                        <div class="text-choix-page">
                        Liste Questions

                    </div>

                        <div class="logo-choix1">
                            
                    </div>
                    </div>
                </a>
                <a href="menu_admin.php?page=2">
                    <div class="choix-page">

                        <div class="text-choix-page">
                        Créer Admin

                    </div>

                        <div class="logo-choix2">
                            
                    </div>

                    </div>
                </a>
                        <a href="menu_admin.php?page=3">
                    <div class="choix-page">

                        <div class="text-choix-page">
                        Liste Joueurs

                    </div>

                        <div class="logo-choix1">
                            
                    </div>

                    </div>
                </a>
                            <a href="menu_admin.php?page=4">
                    <div class="choix-page">
                        <div class="text-choix-page">
                        Créer Questions

                    </div>

                        <div class="logo-choix2">
                            
                    </div>

                    </div>
                </a>

            </div>

            <div class="menu-choice">

        <?php

        if (!empty($_GET["page"]))
        {
            switch ($_GET["page"]) {
                case '1':
                    require_once('liste_questions.php');
                    break;

                case '2':
                    include('inscription_admin.php');
                    break;

                    case '3':
                    require_once('liste_joueur.php');
                    break;

                    case '4':
                    require_once('creer_questions.php');
                    break;
                
                    }
                }
                else
                    require_once('liste_joueur.php');
                            
                    
                ?>
            </div>

        </div>
       </div>



    </body>
</html>

<?php



    if (isset($_POST["deconnect"]) && !empty($_POST["deconnect"]))
{
    unset($_SESSION);
    session_destroy();
    header('location:index.php.php');

}
?>
