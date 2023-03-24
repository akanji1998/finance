<?php 
require('../model/model.php');

$reponse = [
    "statut"=>404,
    "msg"=>"votre requete est vide"
];

if(isset($_POST['type_op']) && $_POST['type_op'] == "Prêt"){

    $id_client = htmlspecialchars($_POST['id_client']);
    $montant_emp = htmlspecialchars($_POST['montant_op']);
    $date_emp = date('Y/m/d');
    $heure_op = date('H:i');
    $emprunt_id = uniqid();
    $statut_emp = 1;
    $type_op = "emprunt";

    

    $isEmpruntInserted = insert_emprunt($emprunt_id,$montant_emp,$date_emp,$statut_emp,$id_client);

    if($isEmpruntInserted == "true"){
        insert_historic($date_emp,$heure_op,$id_client,$type_op,$montant_emp,$emprunt_id);
        
        $reponse['statut'] = 200;
        $reponse['msg'] = "SUCCESS: Emprunt enregistrer";    
    } else {
        $reponse['statut'] = 404;
        $reponse['msg'] = "ERREUR: Emprunt non enrégistrer";
    
    }

}

if(isset($_POST['type_op']) && $_POST['type_op'] == "Remboursement"){

    $id_client = htmlspecialchars($_POST['id_client']);
    $montant_remb = htmlspecialchars($_POST['montant_op']);
    $date_remb = date('Y/m/d');
    $emprunt_id = htmlspecialchars($_POST['id_emprunt']);
    $remb_id = uniqid();
    $heure_op = date('H:i');
    $type_op = "remboursement";
    
    //$rem_restant = remb_restant($id_client);

    $isRemboursementInserted = insert_remboursement($remb_id,$montant_remb,$emprunt_id,$id_client,$date_remb); 

    if($isRemboursementInserted=="true"){
        insert_historic($date_remb,$heure_op,$id_client,$type_op,$montant_remb,$remb_id);
        $reponse['statut'] = 200;
        $reponse['msg'] = "SUCCESS: Remboursement enrégistrer";    
    }else if($isRemboursementInserted=="false"){
        $reponse['statut'] = 404;
        $reponse['msg'] = "ERREUR: Le montant entré est supérieur au montant à payer";

    } else {
        $reponse['statut'] = 404;
        $reponse['msg'] = "ERREUR: Remboursement non enrégistrer";
    
    }
    
}

echo json_encode($reponse);




