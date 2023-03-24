<?php

function bd_connect(){
    $server_name = "localhost";
    $database = "finance";
    $username = "root";
    $password = "";

    try {
        $bdd = new PDO("mysql:host=$server_name;dbname=$database",$username,$password);
        //set the pdo error mode to exception
        $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $bdd;
        echo "connected succesfully";
    } catch(PDOException $e){
        echo "connection failed:" .  $e->getMessage();
    }
}

function  verify_user($username,$pass_word){
    $bdd = bd_connect();
    $query_user = $bdd->prepare("SELECT * FROM user WHERE username=?AND pass_word=?");
    $query_user->execute([$username,$pass_word]);
    $user_find = $query_user->rowCount();

    if($user_find==1){
        return "true";
    }
    
}

function  find_client($client_num){
    $bdd = bd_connect();
    $query_client = $bdd->prepare("SELECT * FROM client WHERE client_num=? OR id_client=?");
    $query_client->execute([$client_num,$client_num]);
    $client_find = $query_client->rowCount();

    if($client_find==1){
        return "true";
    }
    
}

function  client_info($identifier){
    $bdd = bd_connect();
    $query_client = $bdd->prepare("SELECT * FROM client WHERE id_client=? OR client_num=?");
    $query_client->execute([$identifier,$identifier]);
    $client_found = $query_client->fetch();
    $client = [
        "id" => $client_found['id_client'],
        "nom" => $client_found['first_name'],
        "prenom" => $client_found['last_name'],
        "tel" => $client_found['client_num'],
        "statut" => "emprunt en cours",
    ];
    
    return $client;
    
}

function emprunt_info($client_identifier){
    $bdd = bd_connect();
    $query_emprunt = $bdd->prepare("SELECT * FROM emprunt WHERE id_client=? AND statut_emprunt=1");
    $query_emprunt->execute([$client_identifier]);
    $emprunt_found = $query_emprunt->fetch();
    if($query_emprunt->rowCount() == 0){
        $emprunt_info = [
            "id_emprunt" => "",
            "montant" => "",
            "rembourse" => "",
            "restant" => "",
        ];
    }else {
        $montant_rest = $emprunt_found['montant_remb'] - $emprunt_found['montant_emprunt'];

        $emprunt_info = [
            "id_emprunt" => $emprunt_found['id_emprunt'],
            "montant" => $emprunt_found['montant_emprunt'],
            "rembourse" => $emprunt_found['montant_remb'],
            "restant" => $montant_rest,
        ];
    }

    return $emprunt_info;
}


function remb_info($emprunt_id,$client_id){
    $bdd = bd_connect();
    $query_remb = $bdd->prepare("SELECT id_remb,montant_remb,id_emprunt,id_client,date_remb,DATE_FORMAT(date_remb,'%d/%m/%Y') as date_remb_fr FROM remboursement WHERE id_client=? AND id_emprunt=? ORDER BY id DESC");
    $query_remb->execute([$client_id,$emprunt_id]);
    $remb_info = [
        "date_remb" => [],
        "mont_remb" => []
    ];

    $i=0;
    while($remb_found = $query_remb->fetch()){
        $remb_info['date_remb'][$i] = $remb_found['date_remb_fr'];
        $remb_info['mont_remb'][$i] = $remb_found['montant_remb'];
        $i++;
    }

    return $remb_info;
}




function insert_client($client_id,$first_name,$last_name,$activity,$location,$client_num,$register_date){

    $bdd = bd_connect();
    $query= $bdd->prepare("INSERT INTO client(id_client,first_name,last_name,activity,locations,client_num,register_date) VALUES(?,?,?,?,?,?,?)");
    $inserted = $query->execute([$client_id,$first_name,$last_name,$activity,$location,$client_num,$register_date]);

    if($inserted){
        return "true";
    }
    
}

function insert_historic($date_emp,$heure_op,$id_client,$type_op,$montant_emp,$id_op){
    $bdd = bd_connect();
    $query= $bdd->prepare("INSERT INTO historique(date_his,heure_his,id_client_his,type_op,mont_op,id_op) VALUES(?,?,?,?,?,?)");
    $inserted = $query->execute([$date_emp,$heure_op,$id_client,$type_op,$montant_emp,$id_op]);
}

function historic_list($date_du_jour){
    $bdd = bd_connect();
    $query_hist = $bdd->prepare("SELECT heure_his,id_client_his,first_name,last_name,type_op,mont_op,id_op,DATE_FORMAT(date_his,'%d/%m/%Y') as date_his_fr FROM historique INNER JOIN client ON historique.id_client_his=client.id_client WHERE date_his=? ORDER BY historique.id DESC");
    $query_hist->execute([$date_du_jour]);
    $hist_info = [
        "date" => [],
        "heure" => [],
        "id_client" => [],
        "nom_client" => [],
        "prenom_client" => [],
        "type_op" => [],
        "montant_op" => [],
        "id_op" => [],
    ];

    $i=0;
    while($hist_found = $query_hist->fetch()){
        $hist_info['date'][$i] = $hist_found['date_his_fr'];
        $hist_info['heure'][$i] = $hist_found['heure_his'];
        $hist_info['id_client'][$i] = $hist_found['id_client_his'];
        $hist_info['nom_client'][$i] = $hist_found['first_name'];
        $hist_info['prenom_client'][$i] = $hist_found['last_name'];
        $hist_info['type_op'][$i] = $hist_found['type_op'];
        $hist_info['mont_op'][$i] = $hist_found['mont_op'];
        $hist_info['id_op'][$i] = $hist_found['id_op'];
        $i++;
    }

    return $hist_info;
}

function insert_emprunt($emprunt_id,$montant_emp,$date_emp,$statut_emp,$id_client){
    $bdd = bd_connect();
    $query= $bdd->prepare("INSERT INTO emprunt(id_emprunt,montant_emprunt,date_emprunt,statut_emprunt,id_client) VALUES(?,?,?,?,?)");
    $inserted = $query->execute([$emprunt_id,$montant_emp,$date_emp,$statut_emp,$id_client]);

    if($inserted){
        return "true";
    }
}

function totalRembousement($id_emprunt,$id_client){
    $bdd = bd_connect();
    $query= $bdd->prepare("SELECT SUM(montant_remb) AS totalRemboursement FROM remboursement WHERE id_client=? AND id_emprunt=?");
    $query->execute([$id_client,$id_emprunt]);
    $result = $query->fetch();
    $totalRemboursement = $result['totalRemboursement'];

    return $totalRemboursement;
}

function remb_restant($client_identifier){
    $bdd = bd_connect();
    $query_emprunt = $bdd->prepare("SELECT * FROM emprunt WHERE id_client=? AND statut_emprunt=1");
    $query_emprunt->execute([$client_identifier]);
    $emprunt_found = $query_emprunt->fetch();

    $montant_rest = $emprunt_found['montant_remb'] - $emprunt_found['montant_emprunt'];

    return $montant_rest;
}



function updateEmprunt($sumRemb,$client_id,$emprunt_id,$montant_remb){
    $bdd = bd_connect();
    $remb_restant = remb_restant($client_id);

    $verif_remb =   $remb_restant + $montant_remb;

    if($verif_remb < 0){

        $query= $bdd->prepare("UPDATE emprunt SET montant_remb='$sumRemb' WHERE id_client=? AND id_emprunt=?");
        $update = $query->execute([$client_id,$emprunt_id]);
        if($update){
            return "true";
        }

    }else if($verif_remb == 0){

        $query= $bdd->prepare("UPDATE emprunt SET montant_remb='$sumRemb', statut_emprunt=0 WHERE id_client=? AND id_emprunt=?");
        $update = $query->execute([$client_id,$emprunt_id]);
        if($update){
            return "true";
        }

    }else {
        return "false";
    }
    //$query= $bdd->prepare("UPDATE emprunt SET montant_remb='$sumRemb' WHERE id_client=? AND id_emprunt=?");
    
}

function insert_remboursement($remb_id,$montant_remb,$emprunt_id,$id_client,$date_remb){
    $bdd = bd_connect();

    $remb_restant = remb_restant($id_client);

    $verif_remb =   $remb_restant + $montant_remb;
    if($verif_remb <= 0){
        $query= $bdd->prepare("INSERT INTO remboursement(id_remb,montant_remb,id_emprunt,id_client,date_remb) VALUES(?,?,?,?,?)");
        $inserted = $query->execute([$remb_id,$montant_remb,$emprunt_id,$id_client,$date_remb]);
    }else{
        return "false";
    }
  

    if($inserted){
        $totalRemboursement = totalRembousement($emprunt_id,$id_client);
        $isUpdateEmprunt = updateEmprunt($totalRemboursement,$id_client,$emprunt_id,$montant_remb);

        if($isUpdateEmprunt == "true"){
            return "true";   
        }else {
            return "false";
        }
        
    }
    
}


?>