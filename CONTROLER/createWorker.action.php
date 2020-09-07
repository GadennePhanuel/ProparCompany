<?php
session_start();
include_once '../vendor/autoload.php';
use ProparCompany\Singleton;
use ProparCompany\DBManagement;

$name = $_POST['name'];
$firstname = $_POST['firstname'];
$birthday = $_POST['birthday'];
$phone = $_POST['phone'];
$hiringDate = $_POST['hiringDate'];
$status = $_POST['status'];
$login = $_POST['login'];
$password = $_POST['password'];


//on vérifie que les champs envoyés existe et sont pleins
if (
    isset($name) && !empty($name) &&
    isset($firstname) && !empty($firstname) &&
    isset($birthday) && !empty($birthday) &&
    isset($phone) && !empty($phone) &&
    isset($hiringDate) && !empty($hiringDate) &&
    isset($status) && !empty($status) &&
    isset($login) && !empty($login) &&
    isset($password) && !empty($password)
    ){

    //ok les champs sont remplis, on vérifie maintenant si le login n'existe pas déja dans la DT
        //on récupére dans la DT tous le login existant
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare("SELECT login
                                        FROM workers
        ");
        $req->execute();
        $req = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($req as $worker){
            if ($worker['login'] == $login){       //si le login existe déja on renvoi un msg d'erreur
                $errorMsg['login'] = false;
                echo json_encode($errorMsg);
                exit();
            }                           //sinon ok, on enregistre le nouvel employé
        }
            //on hash le password
            $password = password_hash($password, PASSWORD_DEFAULT );
            //transformation des dates en object DateTime
            $birthdayND = new DateTime($birthday);
            $hiringDateND = new DateTime($hiringDate);
            //on insére en Dt
            DBManagement::createWorker($name, $firstname, $birthdayND, $phone, $hiringDateND, $status, $login, $password);
            //on revoie un errorMSG a true
            $errorMsg['msg'] = true;
            echo json_encode($errorMsg);


}else{       //sinon c'est qu'un ou plusieurs champs du formulaire sont vide
    $errorMsg['msg'] = false;
    echo json_encode($errorMsg);
}


