<?php
$title = "Opération";
ob_start();

//print_r($client_info);
?>
<style>
    #table, #table_rem {
        display: flex;
        justify-content: center;
    }
     #table table,#table_rem table{
        margin-top: 15px;
        text-align: center;      
     }
    #table table th,#table table td,#table_rem table th,#table_rem table td{
        width: 350px;
     }
    #table table td,#table_rem table td{
      
        width: 350px;
        padding: 15px;
        padding-top: 5px;
        font-size: larger;
    }
</style>
<div class="" style="padding: 25px;">
    <div class="box-shadow">   
    <div>
        <div class="info">
            <h3>Information du client</h3>
            <hr>
            <div id="table">
                <div class="table-responsive-lg table-responsive-md table-responsive-sm">
                    <?php echo isset($show_client_info)?  $show_client_info : "<p style=\"text-align:center;color:red\">client non trouvé</p>"; ?>
                </div>
            </div>
            
        
        </div>

        <div class="info" style="margin-top: 20px;">
            <h3>Historique de l'emprunt</h3>
            <hr>
            <div id="table_rem">
                <?php echo (!empty($emprunt_id))?  $show_emprunt_info : "<p style=\"text-align:center;color:red\">Pas d'emprunt en cours</p>"; ?>
            </div>

            <h5>Tableau de remboursement</h5>
            
            <div style="height: 250px;overflow-y: auto;margin-bottom: 25px;">
                
                <table class="table table-bordered">
                    
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Montant versement</th>
                        <th scope="col">Date</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        
                        if(!empty($emprunt_id)){ 
                            $cpt=count($remb_info['date_remb']); 
                            for($j=0;$j<count($remb_info['date_remb']);$j++){ 
                                $cpt--;
                    ?>
                    <tr>
                        <th scope="row"><?= $cpt+1; ?></th>
                        <td><?= $remb_info['mont_remb'][$j]; ?></td>
                        <td><?= $remb_info['date_remb'][$j]; ?></td>
                    </tr>
                    <?php 
                            }
                        } 
                    
                    ?>
                    </tbody>
                </table>
            </div>
            
            
        </div>

        <div class="opera" style="margin-top: 30px; margin-bottom:50px">
            <h3>Opérations</h3>
            <hr>
            <div id="liveAlertPlaceholder"></div>
            <form method="post" action="" id="operation">
                <table>
                    <tr>
                        <td><input type="number" placeholder="Montant" min="0" id="montant" class="form-control" name="montant" required></td>
                        <td><input type="hidden" value="<?= $client_id; ?>" class="form-control" id="client_id"></td> 
                        <td><input type="hidden" value="<?= $emprunt_id; ?>" class="form-control" id="emprunt_id"></td>                                  
                    </tr>
                    <tr>                                
                        <td class="btns" >
                            <?php echo (empty($emprunt_id))? "<input type=\"submit\" value=\"Prêt\" id=\"type_op\" class=\"btn btn-secondary\">" : ""; ?>
                            <?php echo (!empty($emprunt_id))? "<input type=\"submit\" value=\"Remboursement\" id=\"type_op\" class=\"btn btn-primary\">" : ""; ?>
                            
                        </td>                                
                    
                    </tr>
                </table>
            </form>
        </div>
    </div>
    </div>
</div>

<?php

$content = ob_get_clean();
require('accueil.php');

?>    

 