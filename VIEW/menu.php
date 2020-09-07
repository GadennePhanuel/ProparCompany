<?php
session_start();
//on empêche l'accès à menu.php si on est pas log
if(!isset($_SESSION['login']) OR empty($_SESSION['login'])){
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to ProparCompany</title>
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=M+PLUS+1p:wght@100;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<header class="blog-header py-3 bg-dark static-top">
    <div class="container">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <h1>ProparCompany</h1>
            </div>
            <div class="col-4 text-center">
                <h1 id="my-hour"></h1>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-warning btn-rounded" id="buttonLogin"><a href="#modalLogin" class="js-modal" id="linkLogin">Log In</a></button>
            </div>
        </div>
    </div>
</header>

<div class="container-xl">
    <div class="welcomeBack">
        <h3>Welcome back
            <span id="welcomeBackContent">
                <?php
                echo $_SESSION['name'] . ' ' . $_SESSION['firstname'] . '.';
                ?>
            </span>
        </h3>
    </div>

    <div class="myCurrentJobs">
        <h1>Your current jobs :</h1>
        <div id="yourCurrentJob">

        </div>
    </div>

    <div class="menu">
        <div class="navMenu">
            <h4>1</h4>  
            <div class="subjectMenu">
               <h5>List of finish or current jobs</h5>
                <p>no-restricted</p>
            </div>
            <a href="modalListJobC&F.php#modal1" class="js-modal round-button" id="buttonListC&FJobs"></a>
        </div>
        <div class="navMenu">
            <h4>2</h4>
            <div class="subjectMenu">
                <h5>Unassigned jobs list</h5>
                <p>no-restricted</p>
            </div>
            <a href="modalListJobNA.php#modal2" class="js-modal round-button" id="buttonListNAJobs"></a>
        </div>
        <div class="navMenu">
            <h4>3</h4>
            <div class="subjectMenu">
                <h5>Validate a job</h5>
                <p>no-restricted</p>
            </div>
            <a href="modalValidateAJob.php#modal3" class="js-modal round-button" id="buttonListC&FJobs"></a>
        </div>
        <div class="navMenu">
            <h4>4</h4>
            <div class="subjectMenu">
                <h5>Create a new job</h5>
                <p>no-restricted</p>
            </div>
            <a href="modalCreateJob.php#modal4" class="js-modal round-button" id="buttonListC&FJobs"></a>
        </div>
        <?php
        if ($_SESSION['status'] == 'expert'){
            echo " 
                <div class='navMenu'>
                <h4>5</h4>
                <div class='subjectMenu'>
                    <h5>Create a new type of job</h5>
                    <p>restricted</p>
                </div>
                <a href='modalCreateNewTypeJob.php#modal5' class='js-modal round-button' id='buttonListC&FJobs'></a>
            </div>
            <div class='navMenu'>
                <h4>6</h4>
                <div class='subjectMenu'>
                    <h5>Add a new worker</h5>
                    <p>restricted</p>
                </div>
                <a href='modalCreateWorker.php#modal6' class='js-modal round-button' id='buttonListC&FJobs'></a>
            </div>
            <div class='navMenu'>
                <h4>7</h4>
                <div class='subjectMenu'>
                    <h5>Worker list</h5>
                    <p>restricted</p>
                </div>
                <a href='modalWorkerList.php#modal7' class='js-modal round-button' id='buttonListC&FJobs'></a>
            </div>
            <div class='navMenu'>
                <h4>8</h4>
                <div class='subjectMenu'>
                    <h5>Revenue</h5>
                    <p>restricted</p>
                </div>
                <a href='modalRevenu.php#modal8' class='js-modal round-button' id='buttonListC&FJobs'></a>
            </div>
            ";
        }
        ?>



    </div>








</div>


</body>
<script src="js/libs/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="js/libs/main.js"></script>
<script src="js/libs/modal.js"></script>
<script src="js/menu.js"></script>

</html>

