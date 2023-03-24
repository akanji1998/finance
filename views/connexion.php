<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/bootstrap-5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>FINANCE-Connexion</title>
    <style>
        table{
            width:500px;
        }
        table tr td{
            padding:15px;
            
        }
        #bg {
            background-image: url("public/images/login_bg.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            padding: 35px;
            position: fixed;
            right: 0;
            left: 0;
            bottom: 0;
            top: 0;
        }
        .icon {
            padding: 10px;
            color: #000;
            /* min-width: 50px; */
            position: relative;
            text-align: center;
            top: 37px;
        }
    </style>
</head>

<body>
    <div id="bg" style="display:flex;justify-content:center;align-items:center; ">
        <div class="box-shadow" style="display:inline-block;background-color: rgba(0,0,0,.5);">
            <form action="index.php?page=connexion" method="post">
                <h1 class="text-center" style="color:#fff;margin-top:25px">Connexion</h1>
                
                
                <div style="width: 280px;">
                    <?php echo (isset($error))? $error : ""; ?>
                    <div class="form-group" style="width: 280px;">
                        <i class="fa fa-user icon"></i>
                        <input type="text" placeholder="nom utilisateur" class="form-control text-center" max="15"  name="username" required>
                    </div>
                
                        
                    <div class="form-group" style="margin-bottom: 25px;">
                        <i class="fa-solid fa fa-lock icon"></i>
                        <input type="password" placeholder="mot de passe" max="15" class="form-control text-center" name="password" required>
                    </div>
                        
                        
                    <div class="form-group text-center" style="margin-bottom: 25px;">
                    <input type="submit" style="width: 100%;color:#000;font-weight:bold" name="submit" value="se connecter" class="btn btn-primary">
                    </div>
                    
                    
                </div>
                
            </form>
        </div>
    </div>

    <script src="public/boostrap-5.2.0/js/bootstrap.bundle.js"></script>
</body>
</html>