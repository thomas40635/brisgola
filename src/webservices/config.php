<?php

try{
    $PDO = new PDO('mysql:host=localhost;dbname=projet','root','root');
}

catch(PDOException $e){
    echo 'Connexion impossible';
}