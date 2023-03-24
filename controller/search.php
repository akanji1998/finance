<?php

require('model/model.php');


if(isset($_POST['search'])){

    $search_value = htmlspecialchars(htmlentities($_POST['search_client'],ENT_QUOTES));

    

    
    if(!empty($search_value)){
        
        if(strlen($search_value) <= 15 ){
            
            if(find_client($search_value) ==  "true"){
                
                $client_info = client_info($search_value);

                $client_id = $client_info['id'];

                $emprunt_info = emprunt_info($client_id);

                $emprunt_id = $emprunt_info['id_emprunt'];

                

                $client_info['statut'] = (empty($emprunt_id))? "Pas d'emprunt en cours" : "Emprunt en cours";


                $show_emprunt_info = " 
                <table>
                    <thead>
                        <th class=\"histo_h\">Montant prêté</th>
                        <th class=\"histo_h\">Montant remboursé</th>
                        <th class=\"histo_h\">montant Restant</th>
                    </thead>
                    <tr>                                
                        <td class=\"histo_t\" >".$emprunt_info['montant']."</td>                                
                        <td class=\"histo_t\" >".$emprunt_info['rembourse']."</td>                            
                        <td class=\"histo_t\">".$emprunt_info['restant']."</td>
                    </tr>
                </table>";
                


               
                $show_client_info = "
                <table>
                    <thead>
                        <th>Identifiant</th>
                        <th>Nom et Prénoms</th>
                        <th>Numéro Téléphone</th>
                    </thead>
                    <tbody>
                    <tr>                        
                        <td style=\"color:green;font-weight:700\">".$client_info['id']."</td>
                        <td>".htmlspecialchars_decode($client_info['nom'])." ".htmlspecialchars_decode($client_info['prenom'])."</td>
                        <td>".$client_info['tel']."</td>
                    </tr>
                   
                    </tbody>
                </table>
                <table>
                    <thead>
                        <th>Statut</th>                        
                                              
                    </thead>
                    <tbody>
                        <tr>
                            <td class=\"bg-secondary\" style=\"color:#fff\">".$client_info['statut']."</td> 
                            <!--<td><button class=\"btn btn-primary\">Voir la liste  d'emprunt</button></td>-->  
                        </tr>                        
                    </tbody>
                    
                </table>";

                $remb_info = remb_info($emprunt_id,$client_id);

            }else{
                $error = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">".
                            "<strong>ERREUR:</strong> Le client n'exist pas".
                            "</div>";
                            header("Refresh:3;url=index.php?page=operation");
            }
        }else{
            $error = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">".
                        "<strong>ERREUR:</strong> le nombre maximal de caractère est 15.".
                        "</div>";
                        header("Refresh:3;url=index.php?page=enregistrement");
        }
        
    }else{
        $error = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">".
                    "<strong>ERREUR:</strong> le champs de rechercher est vide".
                    "</div>";
                    header("Refresh:3;url=index.php?page=operation");
        
    }

}

require('views/operation.php');

?>