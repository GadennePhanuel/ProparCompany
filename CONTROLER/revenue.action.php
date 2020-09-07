<?php
session_start();
include_once '../vendor/autoload.php';
use ProparCompany\Singleton;

$dateStart = $_POST['dateStart'];
$dateEnd = $_POST['dateEnd'];

if (isset($dateStart) && !empty($dateStart) && isset($dateEnd) && !empty($dateEnd)){

    $dateStart = new DateTime($dateStart);
    $dateEnd = new DateTime($dateEnd);
    $dateStart = $dateStart->format('d-m-Y');
    $dateEnd = $dateEnd->format('d-m-Y');

    if ($dateStart > $dateEnd){   //si la date de début inférieur a la date de fin on renvoie un msg d'erreur
        $errorMsg['value'] = false;
        echo json_encode($errorMsg);
    }else{                //sinon ok on y va

        //on récupére pour tous les jobs leur dates init et leur prix

        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare("SELECT date_init, price
                                        FROM jobs
                                        INNER JOIN jobs_type ON jobs_type.id_jobType = jobs.id_jobType
        ");
        $req->execute();
        $req = $req->fetchAll(PDO::FETCH_ASSOC);

        $revenu = 0;

        foreach ($req as $job){
            $date = new DateTime($job['date_init']);
            $date = $date->format('d-m-Y');
            if ($date >= $dateStart && $date <= $dateEnd){
                $revenu = $revenu + floatval($job['price']);
            }
        }
        $errorMsg['revenue'] = $revenu;
        echo json_encode($errorMsg);


    }
}else{
    $errorMsg['value'] = false;
    echo json_encode($errorMsg);
}