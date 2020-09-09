<?php
require_once '../vendor/autoload.php';
use ProparCompany\Singleton;
use ProparCompany\DBManagement;

$nameType = $_POST['nameType'];
$priceType = $_POST['priceType'];

if (
    isset($nameType) && !empty($nameType) &&
    isset($priceType) && !empty($priceType) &&
    is_numeric($priceType) == true
){

    /*
     * on récupére tous les nom de type déja existant pour vérifier que le nouveau qu'on veut créer n'exista pas déjà
     */
    $dbi = Singleton::getInstance()->getConnection();

    $req = $dbi->prepare("SELECT name
                                FROM jobs_type
                        ");
    $req->execute();

    $req = $req->fetchAll(PDO::FETCH_ASSOC);   //tableau multidimensionnel, chaque sous tableau contient le name des typeJob ['name']


    //on parcours le tableau
    foreach ($req as $name){
        if ($name['name'] == $nameType){
            $errorMsg['msg'] = false;
            echo json_encode($errorMsg);
            exit();
        }
    }


    /*
     * si c'est bon on crée le nouveau type de job
     */

    DBManagement::createNewJobType($nameType, $priceType);

    $errorMsg['msg'] = true;
    echo json_encode($errorMsg);
}
else{
    $errorMsg['check'] = false;

    echo json_encode($errorMsg);
}





