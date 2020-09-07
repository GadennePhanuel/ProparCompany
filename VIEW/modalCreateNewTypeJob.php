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
    <title>Fenêtre modale 5</title>
</head>
<body>


<aside id="modal5" class="modal"  aria-labelledby="title_modal" >
    <div class="modal-wrapper js-modal-stop" >
        <a href="#" class="js-modal-close"><img src="img/button-cross.png" width="50px"></a>
        <h1>Create a new type job</h1>
        <form>
            <div>
                <input type="text" placeholder="Name" id="nameType">
            </div>
            <div>
                <input type="text" placeholder="Price" id="priceType">
            </div>
            <div id="errorFieldEmpty">

            </div>
            <div>
                <button type="submit" class="btn btn-danger" id="validateNewTypeJob">VALIDATE</button>
            </div>
        </form>
    </div>




    <script src="js/libs/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="js/libs/main.js"></script>
    <!--    <script src="js/libs/modal.js"></script>-->
    <script src="js/modalCreateNewTypeJob.js"></script>
</aside>

</body>

</html>