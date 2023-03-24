<?php
$title = "Opération";
ob_start();




?>
     <?php echo (isset($error))? $error : ""; ?>
<style>
    #register small{
        color: red;
        font-weight: bold;
    }
    #register form{
        margin-top: 25px;
    }
    #register form label{
        font-weight: bold;
        font-size: medium;
        margin-bottom: 5px;
        margin-left: 5px;
    }
    #register form .boutton input{
        width: 100%;
        text-align: center;
        font-weight: bold;
        font-size:large;
    }
</style>
<div class="" style="padding: 25px;">
    <div class="box-shadow">
        <div class="container" id="register">
            <h1>Enrégistrement de client</h1>
            <hr>
            <small>N.B:Tous les champs sont obligatoires</small>
            <form action="index.php?page=enregistrement" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" name="nom" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label for="prenom">Prénoms</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label for="contact">Numéro de téléphone</label>
                            <input type="number" id="contact" max-lenght="10" class="form-control" placeholder="Ex: 0525142316" name="contact" required>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label for="contact">Genre</label>
                            <select name="genre" class="form-control">
                                <option selected></option>
                                <option value="homme">homme</option>
                                <option value="femme">femme</option>
                            </select>
                            <!-- <input type="number" id="contact" max-lenght="10"  placeholder="Ex: 0525142316" name="contact" required> -->
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 15px;">
                            <label for="activite">Activités</label>
                            <input type="text" id="activite" class="form-control" placeholder="Ex: commerçante"  name="activite" required>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 25px;">
                            <label for="lieu">Lieu d'exercice</label>
                            <input type="text" id="lieu" name="lieu" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="boutton">
                    <input type="submit" name="submit" value="Enregistrer" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<?php

$content = ob_get_clean();
require('accueil.php');

?>    

 