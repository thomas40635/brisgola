<?php

try{

    $PDO = new PDO('mysql:host=db751243491.db.1and1.com;dbname=db751243491','dbo751243491','5B45a3da61');

}

catch(PDOException $e){

    echo 'Connexion impossible';

}