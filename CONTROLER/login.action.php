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
    if ($workerAuthentication[0] === $login && $workerAuthentication[1] === $password){
        $_SESSION['login'] = $login;
        header('Location: ../VIEW/menu.html');
    }else
    if ($workerAuthentication[0] != $login & $workerAuthentication[1] === $password){
        $errorLogin = "Incorrect or unknown login";
        $errorMsg['errorLogin'] = $errorLogin;
        echo json_encode($errorMsg);
    }else
    if ($workerAuthentication[0] === $login & $workerAuthentication[1] != $password){
        $errorPassword = "Wrong password";
        $errorMsg['errorPassword'] = $errorPassword;
        echo json_encode($errorMsg);
    }else{
        $errorLogin = "Incorrect or unknown login";
        $errorPassword = "Wrong password";
        echo json_encode($errorMsg);
    }
}

