<?php

try{

    $PDO = new PDO('mysql:host=mysql-thomas97bb.alwaysdata.net;dbname=','thomas97bb_brisgola','5B45a3da61');
    $PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

}

catch(PDOException $e){

    echo 'Connexion impossible';

}