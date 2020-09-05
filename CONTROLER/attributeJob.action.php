<?php
require_once '../vendor/autoload.php';
use ProparCompany\Singleton;
use ProparCompany\DBManagement;
session_start();


//je connais déja l'id du job que l'employé cherche à s'attribuer et le login de l'employé
$id_job = $_POST['id_job'];
$login = $_SESSION['login'];

$errorMsg = array();


$dbi = Singleton::getInstance()->getConnection();


//on récupére la liste de tous les jobs en cours de l'employé
$req = $dbi->prepare("SELECT jobs.id_job
                                FROM jobs
                                INNER JOIN workers ON jobs.id_worker = workers.id_worker
                                WHERE login = :login AND jobs.status = 'attributed'
");
$req->execute([
    'login' => $login
]);
$req = $req->fetchAll(\PDO::FETCH_ASSOC);    //on récupére un tableau multidimensionnel, chaque sous tableau étant un job attribué a l'employé
//on fera un count de $req, et des IF  -> le but étant de renvoyer un message d'erreur si l'employé cherche a s'attribuer un job alors qu'il est déja au max en fonction de son status


//on récupére maintenant l'id et le status de l'employé
$req2 = $dbi->prepare("SELECT id_worker, status
                                FROM workers  
                                WHERE login = :login 
");
$req2->execute([
    'login' => $login
]);
$req2 = $req2->fetchAll(\PDO::FETCH_ASSOC);
//$req2[0]['status']
//$req2[0]['id_worker']


if ( ($req2[0]['status'] == 'apprenti' && count($req)>= 1) || ($req2[0]['status'] == 'sénior' && count($req)>= 3) || ($req2[0]['status'] == 'expert' && count($req)>= 5 ) ) {
    //si la condition est FAUSSE alors on renvoi un message d'erreur
    $errorMsg['nbJob'] = 'you have reached your maximum number of jobs';
    $errorMsg['validate'] = false;
    echo json_encode($errorMsg);
}
else{
    //si la condition est OK alors on peut traiter la demande d'attribution et renvoyer un message de validation
    DBManagement::attributeJob($id_job, $req2[0]['id_worker']);
    $errorMsg['nbJob'] = 'job well assigned, thank you';
    $errorMsg['validate'] = true;
    echo json_encode($errorMsg);
};

