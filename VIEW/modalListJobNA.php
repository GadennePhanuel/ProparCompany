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
    <link rel="stylesheet" href="css/style.css">
    <title>Fenêtre modale 2</title>
</head>
<body>


<aside id="modal2" class="modal"  aria-labelledby="title_modal" >
    <div class="modal-wrapper-ListJob js-modal-stop" >
        <a href="#" class="js-modal-close"><img src="img/button-cross.png" width="50px"></a>
        <div class="jobsDisplayButton">
            <button type="button" class="buttonJob2 active buttonUnassignedJob"><h4>Unassigned Jobs</h4><p id="jobUnassigned"></p></button>
        </div>
        <div id="divTableUnassignedJob">
            <table  class="table" id="tableUnassignedJob">
                <thead class=" thead-dark">
                <tr>
                    <th class="columnID" scope="col">#</th>
                    <th class="columnDate" scope="col">Init Date</th>
                    <th class="columnCustomer" scope="col">Customer</th>
                    <th class="columnType" scope="col">type</th>
                    <th class="columnCommentary" scope="col">Commentary</th>
                    <th class="columnAssign" scope="col"></th>
                </tr>
                </thead>
                <tbody id="tBodyTableUnassignedJob">

                </tbody>
            </table>
        </div>
    </div>





    <script src="js/libs/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="js/libs/main.js"></script>
    <script src="js/libs/modal.js"></script>
    <script src="js/modalListJobNA.js"></script>
</aside>

</body>
</html>