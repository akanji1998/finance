<?php
$title = "Historique";
ob_start();

//print_r($client_info);
?>  
  <style>
    #bg_hist {
    
        background-image: url(public/images/login_bg.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
  </style>
  
  <div>
    <div id="bg_hist">
      <div style="background-color:rgba(0,0,0,0.5);height:250px;display:flex;justify-content:center;align-items:end;color:#fff" class="text-center">
        <h1 style="margin-bottom: 90px;"> HISTORIQUE</h1>
      </div>
    </div>
  </div>

  <div style="background-color:rgba(0,0,0,0.1);position:fixed;top:0;bottom:0;left:0;right:0;z-index:10;display: none;justify-content: center;align-items: center;">
    <div style="width:100px;height:100px;background-color:#fff;border-radius: 8px;box-shadow: 0px 0px 5px 0px;">

    </div>
  </div>
  <div class="" style="padding: 25px;">
    <div class="container">
      <div class="center">
        <div class="table-responsive-lg table-responsive-md table-responsive-sm">
          <?php if(!empty($historic['id_op'])){ ?>
          <table class="table table-striped table-hover text-center" id="example">
            <thead class="table-active">
              <th>Date</th>
              <th>Heure</th>
              <th>Identifiant</th>
              <th>Nom et Prénoms</th>
              <th>Types d'Opérations</th>
              <th>Montant</th>            
            </thead>
            <tbody>
              <?php for($i=0;$i<count($historic['id_op']);$i++){ ?> 
              <tr class=" <?= ($historic['type_op'][$i] == "remboursement")? "table-danger" : "table-success"  ?>">
                
                <td><?= $historic['date'][$i]; ?></td>
                <td><?= $historic['heure'][$i]; ?></td>
                <td><?= $historic['id_client'][$i]; ?></td>
                <td><?= html_entity_decode($historic['nom_client'][$i]); ?> <?= $historic['prenom_client'][$i]; ?></td>
                <td><?= $historic['type_op'][$i]; ?></td>
                <td>
                  
                  <div class="form-group">
                    <form id="modification_<?= $i; ?>" onsubmit="event.preventDefault(); modification('<?= $i; ?>');" style="display:inline;">
                      <small style="color:red" id=show_debug_<?= $i; ?>></small>
                      <input type="number" id="reset_input_<?= $i; ?>" class="form-control text-center" style="display:inline;width:fit-content" value="<?= $historic['mont_op'][$i]; ?>" name="mont_op" readonly>
                      
                      <div style="display:none" id="submit_btn_<?= $i; ?>">
                        <input type="hidden" value="<?= $historic['type_op'][$i]; ?>" id="type_op_<?= $i; ?>"> 
                        <button type="submit" class="btn btn-success"><img src="public/images/icon/circular.png" width="20px" height="20px"></button>
                        <button type="reset" class="btn btn-warning"><img src="public/images/icon/circular.png" width="20px" height="20px"></button>
                                            
                      </div>                    
                    </form>
                    <button class="btn btn-danger" onclick="cancel('<?= $i; ?>')" id="cancel_btn_<?= $i; ?>" style="display:none"><img src="public/images/icon/circular.png" width="20px" height="20px"></button>
                    
                    <!-- <button class="btn" onclick="edit('<?= $i; ?>')" id="edit_<?= $i; ?>"><img src="public/images/icon/edit.png" width="20px" height="20px"></button> -->
                  </div>
                  
                  
                  
                </td>
              </tr>
              <?php } ?>
              <!-- <tr class="table-success">
                <td>12/10/2022</td>
                
                <td>12:30</td>
                <td>1237649234GFH</td>
                <td>YALI BAMBA</td>
                <td>remboursement</td>
                <td>
                  <div class="form-group">
                  <input type="number" class="form-control text-center" style="display:inline;width:fit-content" value="230000" name="mont">
                    
                    <button class="btn">modifier</button>
                    <button class="btn">save</button>
                  </div>
                  
                </td>
              </tr>
              -->
            </tbody>
          </table>
          <?php } else  {
            echo "<h1>Aucune opération n'est effectuée</h1>";
          }
          
          ?>
          
        </div>
      </div>
    </div>
  </div>

<?php

  $content = ob_get_clean();
  require('accueil.php');

?>  
