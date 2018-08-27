<?php

require "config.php";

try{
	$request_body = file_get_contents('php://input');
	$code = json_decode($request_body);

    $req = $PDO->prepare("SELECT player1, player2, player3 FROM party WHERE code = :code");

    $req->execute(array(
            "code" => $code
            ));

    $data = $req->fetchAll();

    echo $data['player1'];exit;
    if(count($data)>0){
        echo "OK";
	}
	else{
		echo "NOPE";
	}

}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>