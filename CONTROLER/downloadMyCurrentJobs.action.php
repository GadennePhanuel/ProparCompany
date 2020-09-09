<?php
include_once '../vendor/autoload.php';
use ProparCompany\Singleton;

/*
 *  CONTROLLEUR POUR CHARGER UNIQUEMENT LES JOBS EN COURS DE L'EMPLOYE CONNECTE
 */


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

        $req = $dbi->prepare("SELECT jobs.id_job, jobs.commentary, jobs.date_init, jobs.date_attributed, UPPER(customers.name) as nameCustomer, concat(UPPER(LEFT(customers.firstname,1)),LOWER(SUBSTRING(customers.firstname, 2, length(customers.firstname)))) as firstnameCustomer, customers.address, UPPER(customers.city) as cityCustomer, customers.email, customers.phone, concat(UPPER(LEFT(jobs_type.name,1)),LOWER(SUBSTRING(jobs_type.name, 2, length(jobs_type.name)))) as nameJobType
                                FROM jobs
                                INNER JOIN workers ON jobs.id_worker = workers.id_worker
                                INNER JOIN customers ON jobs.id_customer = customers.id_customer
                                INNER JOIN jobs_type ON jobs_type.id_jobType = jobs_type.id_jobType
                                WHERE login = :login AND jobs.status = 'attributed' AND jobs.id_jobType = jobs_type.id_jobType
                        ");

        $req->execute([
            'login' => $login
        ]);

        $req = $req->fetchAll(\PDO::FETCH_ASSOC);

        $errorMsg['req'] = $req;
        $errorMsg['loginExist'] = true;
        $errorMsg['login'] = $login;
        $errorMsg['nameWorker'] = $nameWorker;
        $errorMsg['firstnameWorker'] = $firstnameWorker;
        $errorMsg['statusWorker'] = $statusWorker;

        echo json_encode($errorMsg);
        exit();
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
