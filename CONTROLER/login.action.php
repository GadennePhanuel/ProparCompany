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
    if ($workerAuthentication['login'] === $login && $workerAuthentication['password'] === $password){
        $_SESSION['login'] = $login;
        $errorMsg['validConnection'] = true;
        echo json_encode($errorMsg);
        exit();
    }else
    if ($workerAuthentication['login'] != $login & $workerAuthentication['password'] === $password){
        $errorMsg['errorLogin'] =  "Incorrect or unknown login !";
        echo json_encode($errorMsg);
        exit();

    }else
    if ($workerAuthentication['login'] === $login & $workerAuthentication['password'] != $password){
        $errorMsg['errorPassword'] = "Wrong password !";
        echo json_encode($errorMsg);
        exit();
    }else{
        $errorMsg['errorLogin'] =  "Incorrect or unknown login !";
        $errorMsg['errorPassword'] = "Wrong password !";
        echo json_encode($errorMsg);
        exit();
    }
}

