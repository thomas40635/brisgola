<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
    $json = json_decode($request_body, true);

    $code = $json["code"];
    echo("LE CODE : ".$code)

}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>