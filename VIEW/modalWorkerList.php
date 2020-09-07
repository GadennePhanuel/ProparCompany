<?php
session_start();
//on empêche l'accès à menu.php si on est pas log
if(!isset($_SESSION['login']) OR empty($_SESSION['login'])){
    header('Location: index.php');
    exit();
}
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&family=M+PLUS+1p:wght@100;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Fenêtre modale 6</title>
</head>
<body>


<aside id="modal7" class="modal"  aria-labelledby="title_modal" >
    <div class="modal-wrapper-ListJob js-modal-stop" >
        <a href="#" class="js-modal-close"><img src="img/button-cross.png" width="50px"></a>
        <h1>Workers List</h1>

        <div id="divTableWorkerList">
            <table  class="table" id="tableWorkerList">
                <thead class=" thead-dark">
                <tr>
                    <th class=id_worker"" scope="col">ID</th>
                    <th class=nameWorker"" scope="col">Name</th>
                    <th class="firstnameWorker" scope="col">firstname</th>
                    <th class="hiringDate" scope="col">Hiring Date</th>
                    <th class="phoneWorker" scope="col">Phone</th>
                    <th class="statusWorker" scope="col">Status</th>
                    <th class="initWorker" scope="col">Init</th>
                </tr>
                </thead>
                <tbody id="tBodyTableWorkerList">

                </tbody>
            </table>
        </div>
    </div>




    <script src="js/libs/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="js/libs/main.js"></script>
    <!--    <script src="js/libs/modal.js"></script>-->
    <script src="js/modalWorkerList.js"></script>
</aside>

</body>

</html>
