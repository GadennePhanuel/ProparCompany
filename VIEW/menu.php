<?php
session_start();
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
                <h1>Welcome on ProparCompany</h1>
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




</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="js/main.js"></script>
<script src="js/modal.js"></script>



</html>