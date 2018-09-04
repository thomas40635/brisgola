<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
    $json = json_decode($request_body, true);

    $code = $json["code"];

    $req = $PDO->prepare("SELECT * FROM Player WHERE code = :code ORDER BY place");

    $req->execute(array(
            "code" => $code
            ));

    $data = $req->fetchAll();
    foreach ($data as $player) {
    	$players[] = $player;
    }
    $players = json_encode($players);
    echo $players;
    return $players;
}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>