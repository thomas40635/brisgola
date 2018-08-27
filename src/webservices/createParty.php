<?php

require "config.php";

try{
	echo $_POST['code'];exit;
    $req = $PDO->prepare("INSERT INTO Party (login, password, email, infos, roles_id) VALUES (:login, :password, :email, :infos, '2')");

    $req->execute(array(
            "login" => $login, 
            "password" => $password,
            "email" => $email,
            "infos" => $infos
            ));

    $data = $req->fetchAll();
        if(count($data)>0){
            $_SESSION'Auth'] = $data[0];
            return true;
    }

}

catch(PDOException $e){

    echo 'Connexion impossible';

}

?>