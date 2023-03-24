<?php
session_start();


    if(isset($_GET['page'])){
        $page = $_GET['page'];
    } else {
        $page = "connexion";
    }

    if(!isset($_SESSION['login']) || $_SESSION['login'] != "true"){
        if($page != "connexion"){
            echo "<script>alert('veuillez vous connectez avant de continuer');</script>";
            header('Refresh:0;url=index.php?page=connexion');
        }
        $page = "connexion";
    }
    

    switch($page) {
        case 'operation':
            require('controller/search.php');
            break;

        case 'enregistrement':
            require('controller/register.php');
            break;

        case 'historique':
            require('controller/historique.php');
            break;

        case 'connexion':
            require('controller/login.php');
            break;
        case 'deconnexion':
            require('controller/logout.php');
            break;
        default:
            require('views/accueil.php');
            break;
    }
?>