<?php
session_start();
include_once '../vendor/autoload.php';
use ProparCompany\Singleton;

$login = $_POST['login'];
$password = $_POST['password'];

$dbi = Singleton::getInstance()->getConnection();

$req = $dbi->prepare("SELECT login, password
                        FROM workers"
                    );
$req->execute();

$req = $req->fetchAll(\PDO::FETCH_ASSOC);       //je récupére un tableau multidimensionnel, structure de chaque sous tableau ["login"]=> ****** et ["password"]=> *******  pour chaque worker existant


//je parcours le tableau
foreach ($req as $workerAuthentication){

    if ($workerAuthentication['login'] == $login && password_verify($password , $workerAuthentication['password']) == true){
       //donc ok les logs sont bon, on stocke dans la session le login de l'employé connecté
        $_SESSION['login'] = $login;
        //on récupére dans la DT son nom, prénom et status pour les stocker en session également
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare("SELECT name, firstname, status
                                FROM workers
                                WHERE login = :login
        ");
        $req->execute([
            'login' => $login
        ]);
        $req = $req->fetch(\PDO::FETCH_ASSOC);
        $_SESSION['name'] = $req['name'];
        $_SESSION['firstname'] = $req['firstname'];
        $_SESSION['status'] = $req['status'];

        //on revoit un msg en json pour dire que tout s'est bien passé
        $errorMsg['validConnection'] = true;

    }else
        {          //sinon les logs sont mauvais et on revois un json pour dire que l'un des deux paramétres est faux
        $errorMsg['errorLogin'] =  "Incorrect or unknown login !";
        $errorMsg['errorPassword'] = "Wrong password !";

    }
}

echo json_encode($errorMsg);
