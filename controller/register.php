<?php

require('model/model.php');

if(isset($_POST['submit'])){

    $first_name = htmlspecialchars(htmlentities($_POST['nom'],ENT_QUOTES));
    $last_name = htmlspecialchars(htmlentities($_POST['prenom'],ENT_QUOTES));
    $activity = htmlspecialchars(htmlentities($_POST['activite'],ENT_QUOTES));
    $client_num = htmlspecialchars(htmlentities($_POST['contact'],ENT_QUOTES));
    $location = htmlspecialchars(htmlentities($_POST['lieu'],ENT_QUOTES));
    $register_date = date('Y/m/d');
    $client_id = uniqid();

    

    
    if(!empty($first_name) && !empty($last_name) && !empty($activity) && !empty($client_num) && !empty($location)){
        
        if(strlen($client_num) == 10 ){
            
            if(find_client($client_num) !=  "true"){

                

                
                $isClientInsert = insert_client($client_id,$first_name,$last_name,$activity,$location,$client_num,$register_date);

                if($isClientInsert=="true"){

                    $error = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">".
                    "<strong>SUCCES:</strong> Le client est enrégistré".
                    "</div>";
                    header("Refresh:3;url=index.php?page=enregistrement");
                    
                    
                }else{
                    $error = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">".
                            "<strong>ERREUR:</strong> Le client n'est pas enrégistré".
                            "</div>";
                    header("Refresh:3;url=index.php?page=enregistrement");
                }
                



            }else{
                $error = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">".
                            "<strong>ERREUR:</strong> Le numéro de téléphone est déjà utilisé".
                            "</div>";
                            header("Refresh:3;url=index.php?page=enregistrement");
            }
        }else{
            $error = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">".
                        "<strong>ERREUR:</strong> le numéro de telephon est inférieur ou supérieur à 10 chiffres".
                        "</div>";
                        header("Refresh:3;url=index.php?page=enregistrement");
        }
        
    }else{
        $error = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">".
                    "<strong>ERREUR:</strong>Tous les champs sont obligatoires".
                    "</div>";
                    header("Refresh:3;url=index.php?page=enregistrement");
        
    }

}
require('views/client.php');
?>