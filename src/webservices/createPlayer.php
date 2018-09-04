<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
    $json = json_decode($request_body, true);

    $code = $json["code"];
    $pseudo = $json["playerID"];

    $req = $PDO->prepare("SELECT Player.pseudo FROM Player WHERE Player.code = :code");

    $req->execute(array(
            "code" => $code
            ));

    $data = $req->fetchAll();
    if(count($data) == 0){
        $place = 1;
    }
    else if(count($data) == 1){
        $place = 2;
    }
    else if(count($data) == 2){
        $place = 3;
    }
    else{
        $place = null;
    }

    $req = $PDO->prepare("INSERT INTO Player (code, pseudo, place) VALUES (:code, :pseudo, :place)");
    $req->execute(array(
            "code" => $code,
            "pseudo" => $pseudo,
            "place" => $place
            ));
    $data = $req->fetchAll();
    print_r($req);
}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>