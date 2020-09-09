<?php
require_once '../vendor/autoload.php';
use ProparCompany\Singleton;
use ProparCompany\DBManagement;





//je connais déja l'id du job que l'employé cherche à s'attribuer et le login de l'employé est récupérable dans le token
$id_job = $_POST['id_job'];


$errorMsg = array();


if (isset($_POST['tokenJWT']) && !empty($_POST['tokenJWT'])){
    $jwt = $_POST['tokenJWT'];
    //on récupére séparemment le header et le payload du token jwt reçu
    $jwtExplode = explode(".", $jwt);

    //je recrée un signature maison du header (avec ma clé secrète que moi seul connais) et du payload récupére en position 0 et 1
    $signatureExtrapole = hash_hmac('sha256', $jwtExplode[0] . "." . $jwtExplode[1], 'cléSecreteDeOuf!', true);
    $base64UrlSignatureExtrapole = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signatureExtrapole));

    //MAINTENANT JE PEUX COMPARER, ici on verifie si les 2 signatures sont identiques,
    if ($base64UrlSignatureExtrapole == $jwtExplode[2]){

        $payload = $jwtExplode[1];
//        var_dump($payload);
        $payloadDecode64 = base64_decode($payload);
//        var_dump($payloadDecode64);
        $payloadDecodeJson = json_decode($payloadDecode64, true);
//        var_dump($payloadDecodeJson['login']);
        $login = $payloadDecodeJson['login'];
        $nameWorker = $payloadDecodeJson['name'];
        $firstnameWorker = $payloadDecodeJson['firstname'];
        $statusWorker = $payloadDecodeJson['status'];
//        var_dump($login);


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



    }else{ //cas où le mec qui essaye d'accéder posséde un token falsifié
        $errorMsg['loginExist'] = false;
        echo json_encode($errorMsg);
        exit();
    }



}else{ //cas où le mec qui essaye d'accéder à la page ne posséde pas de token donc n'est pas authentifié
    $errorMsg['loginExist'] = false;
    echo json_encode($errorMsg);
    exit();
}




