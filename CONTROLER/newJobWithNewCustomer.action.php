<?php
session_start();
include_once '../vendor/autoload.php';
use ProparCompany\Singleton;
use ProparCompany\DBManagement;
use ProparCompany\Factory;


$dbi = Singleton::getInstance()->getConnection();


$name = $_POST['name'];
$firstname = $_POST['firstname'];
$birthday = $_POST['birthday'];   //string
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];
$nameJobType = $_POST['nameJobType'];
$commentary = $_POST['commentary'];


/*
 * on commence par vérifier si ce customer n'existe pas déjà en comparant son email avec ceux de notre DT
 */
//on récupére tout les emails existant en DT
$req = $dbi->prepare("SELECT email
                        FROM customers 
");
$req->execute();
$req = $req->fetchAll(PDO::FETCH_ASSOC);   //return = array multidimensionnel, chaque sous tableau contient l'email d'un client à la clé ['email']

//on parcours le tableau
foreach ($req as $customer){
    if ($customer['email'] == $email){               //si l'email existe déjà on revoie un message d'erreur et on stop le process
        $errorMsg['msg'] = false;
        echo json_encode($errorMsg);
        exit();
    }
}



//sinon on traite la demande et on crée l'employé dans la DT

//on a besoin de birthday en Datetime
$birthdayDate = new DateTime($birthday);

$customer = Factory::getCustomer($name, $firstname, $birthdayDate, $address, $city, $email, $phone);

//on envoie en DT
DBManagement::createCustomer($customer);

//on crée le job demandé pour ce nouveau customer
//pour cela on doit récupérer l'id de ce nouveau customer qui lui a été attribué lors de l'insertion en DT
$req2 = $dbi->prepare("SELECT id_customer
                                        FROM customers
                                        WHERE email = :email
        ");
$req2->execute([
    'email' => $email
]);
$id_customer = $req2->fetch(PDO::FETCH_ASSOC);

//on peux maintenant insérer en DT le nouveau job
DBManagement::addJob($id_customer['id_customer'], $commentary, $nameJobType);

$errorMsg['msg'] = true;
echo json_encode($errorMsg);


























