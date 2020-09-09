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
foreach ($req as $workerAuthentication) {
    if ($workerAuthentication['login'] == $login && password_verify($password, $workerAuthentication['password']) == true) {

        //on récupére dans la DT son nom, prénom et status
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare("SELECT name, firstname, status
                                FROM workers
                                WHERE login = :login
        ");
        $req->execute([
            'login' => $login
        ]);
        $req = $req->fetch(\PDO::FETCH_ASSOC);

        //create token header as a JSON string
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        //create token payload as a JSON string
        $payload = json_encode([
            'name' => $req['name'],
            'firstname' => $req['firstname'],
            'status' => $req['status'],
            'login' => $login,
        ]);
        //encode header to base64Url string
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'cléSecreteDeOuf!', true);
        //on encode en base 64 notre signature haché
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        //on crée enfin notre token JWT (je rappel que chaque partie est séparé des autres pas un 'poin'
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;


        //on revoit le token à notre view pour qu'il puisse le stocker
        echo json_encode($jwt);
    }
}

if (!isset($jwt) || empty($jwt))             //ca veut dire que les logs sont mauvais et qu'aucun token jwt n'a été généré, on donc on renvoi un msg d'erreur
{
    $errorMsg['errorLogin'] =  "Incorrect or unknown login !";
    $errorMsg['errorPassword'] = "Wrong password !";
    echo json_encode($errorMsg);

}


