<?php
//session_start();
//
//if (isset($_SESSION['login']) && !empty($_SESSION['login'])){
//    $errorMsg['loginExist'] = true;
//    echo json_encode($errorMsg);
//    exit();
//}else{
//    $errorMsg['loginExist'] = false;
//    echo json_encode($errorMsg);
//    exit();
//}


if (isset($_POST['tokenJWT']) && !empty($_POST['tokenJWT'])){
    $jwt = $_POST['tokenJWT'];
    //on récupére séparemment le header et le payload du token jwt reçu
    $jwtExplode = explode(".", $jwt);

    //je recrée un signature maison du header (avec ma clé secrète que moi seul connais) et du payload récupére en position 0 et 1
    $signatureExtrapole = hash_hmac('sha256', $jwtExplode[0] . "." . $jwtExplode[1], 'cléSecreteDeOuf!', true);
    $base64UrlSignatureExtrapole = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signatureExtrapole));

    //MAINTENANT JE PEUX COMPARER, ici on verifie si les 2 signatures sont identiques,
    if ($base64UrlSignatureExtrapole == $jwtExplode[2]){
        $errorMsg['loginExist'] = true;
        echo json_encode($errorMsg);
        exit();
    }else{ //cas où le mec qui essaye d'accéder à la page posséde un token falsifié
        $errorMsg['loginExist'] = false;
        echo json_encode($errorMsg);
        exit();
    }

}else{ //cas où le mec qui essaye d'accéder à la page ne posséde pas de token donc n'est pas authentifié
    $errorMsg['loginExist'] = false;
    echo json_encode($errorMsg);
    exit();
}