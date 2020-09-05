
<?php
require_once '../vendor/autoload.php';
use ProparCompany\DBManagement;

/*
*   CONTROLLEUR POUR CHARGER L ENSEMBLE DES JOBS DE LA DT
*/



$jobUnassigned = DBManagement::displayJobNotAttributed();   //revoi un array

$jobAttributed = DBManagement::displayJobInProgress();   //revoi un array

$jobEnd =DBManagement::displayJobEnd();   //revoi un array

$listJobs = array($jobUnassigned, $jobAttributed, $jobEnd);   //tableau multidimensionnel


//echo '<pre>';
//var_dump($listJobs);
//echo '</pre>';

echo json_encode($listJobs);



