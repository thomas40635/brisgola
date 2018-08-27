<?php

try{

    $PDO = new PDO('mysql:host=mysql-thomas97bb.alwaysdata.net;dbname=thomas97bb_brisgola','164082_brisgola','5B45a3da61');

}

catch(PDOException $e){

    echo 'Connexion impossible';

}