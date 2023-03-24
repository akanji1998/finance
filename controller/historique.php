<?php
require('model/model.php');

$date_du_jour = date('Y/m/d');

$historic = historic_list($date_du_jour);

require('views/historique.php');