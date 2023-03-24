<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FINANCE</title>
    <link href="public/bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/style.css" rel="stylesheet">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css"/>
    <style>
    #bg_accueil {
    
        background-image: url(public/images/accueil_bg.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    #navbar li a{
      font-size: medium;
      font-weight: bold;
    }
  </style>

  </head>
<body>

  <nav class="navbar" id="navbar" style="position: fixed;right: 0px;left: 0px;top: 0px;background-color: rgba(0,0,0,0.5);">
      <div class="container">
          <header class="d-flex justify-content-center py-3">
              <ul class="nav nav-pills text-left">
                <li class="nav-item"><a href="index.php?page=accueil" class="nav-link <?= (isset($_GET['page']) && $_GET['page'] != "historique")? "active" : ""; ?>">Accueil</a></li>

                  <li class="nav-item"><a href="index.php?page=historique" class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == "historique")? "active" : ""; ?>">Historique</a></li>

                  <li class="nav-item"><a href="index.php?page=deconnexion" class="nav-link">Déconnexion</a></li>
                </ul>
          </header>
      </div>
  </nav>

  
  
  <div class="">
    
      
        <?php if(isset($_GET['page']) && $_GET['page'] != "historique"){ ?>
          <div>
            <div id="bg_accueil">
              <div style="background-color:rgba(0,0,0,0.5);height:250px;display:flex;justify-content:center;align-items:end;color:#fff" class="text-center">
                <h1 style="margin-bottom: 90px;"> ACCUEIL</h1>
              </div>
            </div>
          </div>
          <div style="background-color:rgba(0,0,0,0.1);position:fixed;top:0;bottom:0;left:0;right:0;z-index:10;display: none;justify-content: center;align-items: center;">
            <div style="width:100px;height:100px;background-color:#fff;border-radius: 8px;box-shadow: 0px 0px 5px 0px;">

            </div>
          </div>
          <div style="display: flex;justify-content: center;">
            <div class="search_form text-center box-shadow">
              <?php echo (isset($error))? $error : ""; ?> 
              <form action="index.php?page=operation" method="post">
                  <div class="form-group">
                      <input type="search" placeholder="Entrer le numero téléphone ou Identifiant" class="text-center form-control" name="search_client" style="width:550px;display:inline" required>
                      <input type="submit" value="Rechercher" name="search" class="btn btn-primary">
                      <a href="index.php?page=enregistrement" class="btn btn-success" style="text-decoration:none;color:#fff">Nouveau client</a>
                  </div>
              </form>
            </div>
          </div>
        <?php } ?>
            <?php echo isset($content)? $content : ""; ?>
    
        
      <script src="public/js/jquery.min.js"></script>
      <script src="public\bootstrap-5.2.0\js\bootstrap.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
      <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
          var currentScrollPos = window.pageYOffset;
          if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
          } else {
            document.getElementById("navbar").style.top = "-70px";
          }
          prevScrollpos = currentScrollPos;
        }
      </script>
      <script>
        //formulaire de modification
        function edit(element){
          const edit_btn = document.getElementById('edit_'+element);
          const submit_btn = document.getElementById('submit_btn_'+element);
          const cancel_btn = document.getElementById('cancel_btn_'+element);
          const reset_input = document.getElementById('reset_input_'+element);
          //edit_btn.addEventListener('click',function(){
            console.log('edit_btn_fonction');
            reset_input.removeAttribute('readonly');
            edit_btn.style = "display:none";
            submit_btn.style = "display:inline";
            cancel_btn.style = "display:inline";
          //});
        }

        function cancel(element){
          const edit_btn = document.getElementById('edit_'+element);
          const submit_btn = document.getElementById('submit_btn_'+element);
          const cancel_btn = document.getElementById('cancel_btn_'+element);
          const reset_input = document.getElementById('reset_input_'+element);
          const modification = document.getElementById('modification_'+element);

            console.log('cancel_btn');
            reset_input.setAttribute('readonly',true);
            modification.reset();
            edit_btn.style = "display:visible";
            submit_btn.style = "display:none";
            cancel_btn.style = "display:none";
        }        
        //Début de traitement
        function modification(element){
          
          //const modification = document.getElementById('modification');
          const reset_input = document.getElementById('reset_input_'+element);
          const type_op = document.getElementById('type_op_'+element);
          const show_debug = document.getElementById('show_debug_'+element);
          const change_value = reset_input.value;
          const change_op = type_op.value;
          
          if(change_value <= 0){
            console.log('error montant <= 0');
            show_debug.innerText = "le montant ne devrait pas etre null";
          }
        }
      </script>
      <script>
        //formulaire de l'operation
        const operation = document.getElementById('operation');
        //montant de l'emprunt
        const montant = document.getElementById('montant');
        //type d'operation
        const type = document.getElementById('type_op');
        //identifiant du client
        const id = document.getElementById('client_id');
        //identifiant de l'emprunt
        const id_em = document.getElementById('emprunt_id');
        //Lieu d'affichage de notification
        const alertPlaceholder = document.getElementById('liveAlertPlaceholder')


        //function génératrice de notification
        const alert = (message, type) => {
          const wrapper = document.createElement('div')
          wrapper.innerHTML = [
            `<div class="alert alert-${type} alert-dismissible" role="alert">`,
            `   <div>${message}</div>`,
            '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            '</div>'
          ].join('')
          alertPlaceholder.append(wrapper);
        
        }
        
        //Début de traitement
        operation.addEventListener('submit',function(e){
          e.preventDefault();
          var id_client = id.value;
          var montant_op = montant.value;
          var type_op = type.value;
          var id_emprunt = id_em.value;
          //alert('donner','success');
          console.log(id_client);
          console.log(montant_op);
          console.log(type_op);
          console.log(id_emprunt);
          $.ajax('http://localhost/finance/controller/operation.php',{
                    type:'POST',                    
                    data:{
                      'type_op':type_op,
                      'id_client':id_client,
                      'id_emprunt':id_emprunt,
                      'montant_op':montant_op,                                                
                    },
                    success: function(response){
                      
                        console.log(response);
                        var retour = JSON.parse(response);
                        if(retour['statut'] == 200){
                          alert(retour['msg'],'success');
                          setTimeout(() => {
                            document.location.reload();
                          }, 2000);
                        } else{
                          alert(retour['msg'],'warning');
                        }
                      
                        
                  
                    },
                    error: function(){
                        alert('Erreur: impossible de communiquer avec le serveur','warning');
                        setTimeout(() => {
                          document.location.reload();
                        }, 6000);
                    }
                      

                  }
              );
        });
      
      
      </script>
<!-- 
    <script>
        const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

        const alert = (message, type) => {
          const wrapper = document.createElement('div')
          wrapper.innerHTML = [
            `<div class="alert alert-${type} alert-dismissible" role="alert">`,
            `   <div>${message}</div>`,
            '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
            '</div>'
          ].join('')

          alertPlaceholder.append(wrapper)
        }

        const alertTrigger = document.getElementById('liveAlertBtn')
        if (alertTrigger) {
          alertTrigger.addEventListener('click', () => {
            alert('Nice, you triggered this alert message!', 'success')
          })
        }
    </script>

  <script>
        const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

    const alert = (message, type) => {
      const wrapper = document.createElement('div')
      wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
      ].join('')

      alertPlaceholder.append(wrapper)
    }

    const alertTrigger = document.getElementById('liveAlertBtn')
    if (alertTrigger) {
      alertTrigger.addEventListener('click', () => {
        alert('Nice, you triggered this alert message!', 'success')
      })
    } 
  </script>-->
</body>
</html>