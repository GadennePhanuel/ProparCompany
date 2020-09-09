<?php
require_once '../vendor/autoload.php';
use ProparCompany\Singleton;
use ProparCompany\DBManagement;


//je connais déja l'id du job que l'employé cherche à valider et le login de l'employé
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


        $errorMsg['loginExist'] = true;

//on appel notre fonction pour mettre a jour la DT
        $response = DBManagement::endJob($id_job);

        if ($response == true){
            $errorMsg['endJob'] = true;
            echo json_encode($errorMsg);
        }else{
            $errorMsg['endJob'] = false;
            echo json_encode($errorMsg);
        }

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



