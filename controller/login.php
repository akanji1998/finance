<?php

require('model/model.php');

if(isset($_POST['submit'])){

    $username = htmlspecialchars(htmlentities($_POST['username'],ENT_QUOTES));
    $password = htmlspecialchars($_POST['password']);

    if(!empty($username) && !empty($password)){
        if(strlen($username) <= 15){
            if(strlen($password) <= 15){


                $login = verify_user($username,$password);

                if($login=="true"){
                    $_SESSION['login'] = "true";
                    
                    header('Location:index.php?page=accueil');
                }else{
                    $error = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">".
                            "<strong>ERREUR:</strong> le nom d'utilisateur ou le mot de passe est erroné".
                            "</div>";
                    header("Refresh:2.5;url=index.php?page=connexion");
                }
                



            }else{
                $error = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">".
                            "<strong>ERREUR:</strong> 15 caractères au maximum requis  pour le mot de passe".
                            "</div>";
                            header("Refresh:3;url=index.php?page=connexion");
            }
        }else{
            $error = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">".
                        "<strong>ERREUR:</strong> 15 caractères au maximum requis  pour le nom d'utilisateur".
                        "</div>";
                        header("Refresh:3;url=index.php?page=connexion");
        }
    }else{
        $error = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">".
                    "<strong>ERREUR:</strong>Le username ou le mot de passe ne doit pas être vide".
                    "</div>";
                    header("Refresh:3;url=index.php?page=connexion");
        
    }

}
require('views/connexion.php');
?>