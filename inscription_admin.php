<html>
    <head>
        <title>Page Connexion</title>
        <link rel="stylesheet" href= "style.css">
    </head>
    <body>
        
        
            <div class="white-content2">
                <div class="header-inscription-text">

                    <h1>
                        S'inscrire
                    </h1>
                    <p>
                        Pour tester votre niveau de culture générale
                    </p>
                    <div class="dessin-trait">
                        
                    </div>
                </div>
                    <div class="container-form-inscription">
                        <form method="post" enctype="multipart/form-data">
                        <div class="form-inscription">

                            <label for="username"><p>Prenom</p></label>

                            <input type="text" name="username" class="input-form-inscription">
                        </div>

                        
                        <div class="form-inscription">

                            <label for="nom"><p>Nom</p></label>
                        <input type="text" name="nom"  class="input-form-inscription">
                        </div>
                            <div class="form-inscription">
                        <label for="login"><p>Login</p></label>
                        <input type="text" name="login"  class="input-form-inscription">
                        </div>

                        <div class="form-inscription">
                        <label for="password"><p>Password</p></label>
                        <input type="password" name="password" class="input-form-inscription">

                        </div>
                        <div class="form-inscription">
                            <label for="conf_pass"><p>Confirmer Password</p></label>

                        <input type="password" name="conf_pass" class="input-form-inscription">
                        </div>
                        
                               
                        <input type="file" name="img" class="file-form" value="Choisir un fichier">
                        
                            <div style="margin-top:10%;">   
                        <input type="submit" name="cree_compte" class="input-creer_compte" value="Creer Compte">
                        </div>
                            </form>
                    </div> 
                    <div class="avatar">        
                            <div class="circle2">

                            </div>
                    </div>  
                </div>

        
       </div>

    </body>
</html>


<?php 
if (empty($_SESSION))

    //Seul l'admin peut s'y connecter
    header('Location:index.php.php');
    
if (!empty($_POST["cree_compte"]))
{
    
    if (!empty($_POST["username"]) && !empty($_POST["nom"]) && !empty($_POST["login"]) && !empty($_POST["password"]) && !empty($_POST["conf_pass"]) && !empty($_FILES["img"]))
    {
        $json=file_get_contents("bd.json");
        $json=json_decode($json,true);
        //Création d'un tab qui contiendra les logins
        foreach ($json as $key => $value) {
                foreach ($value as $key2 =>$value2)
                {
                    if ($key2=="login")
                    {
                        $tab[]=$value2;
                        break;
                    }
                }
        }
        //Vérification existence login
        if (!in_array($_POST["login"],$tab))
        { 
            
        if($_POST["password"]==$_POST["conf_pass"])
        {

            $file_name=$_FILES["img"]["name"];
             $file_extension=strrchr($file_name, ".");
            $extensions_autorisés=array(".PNG",".png",".JPEG",".jpeg");
                    
                    if (in_array($file_extension,$extensions_autorisés))
                    {
                $file_tmp_name=$_FILES["img"]["tmp_name"];
                $file_dest="images/"."".$file_name;
                
                move_uploaded_file($file_tmp_name,$file_dest);
            
        unset($_POST["cree_compte"]);
        unset($_POST["conf_pass"]);
        $_POST["score"]=0;
        $_POST["role"]="admin";
        $_POST["img"]=$file_dest;
        $json[]=$_POST;
        $json=json_encode($json);
        file_put_contents("bd.json",$json);
        echo "<script>
            alert('Enregistrement avec succées');
                </script>";
        exit();
<<<<<<< HEAD
        header('Location:index.php.php');
=======
>>>>>>> 4be828dec293a427b71879451b1057fcec0f2973

        }
            echo "<script>
            alert('Seul les formats PNG et JPEG');
                </script>";

        }
        echo "<script>
            alert('Les mots de passe doivent etre identiques');
                </script>
        ";
        
    }
    echo "<script>
            alert('Le login existe');
                </script>";
            }
    echo "<script>
            alert('Tout les champs sont obligatoires');
                </script>";
}





?>
