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
        <div class="container-xl">
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

    <div class="banner">
    </div>

    <div class="container-xl">
        <div class="jobsDisplayButton">
            <button type="button" class="buttonJob buttonEndJob"><h4>Jobs completed</h4><p id="jobEnd"></p></button>
            <button type="button" class="buttonJob active buttonCurrentJob"><h4>Current Jobs</h4><p id="jobCurrent"></p></button>
            <button type="button" class="buttonJob buttonUnassignedJob"><h4>Unassigned Jobs</h4><p id="jobUnassigned"></p></button>
        </div>

        <div id="divTableUnassignedJob">
            <table data-page-length='25' class="table" id="tableUnassignedJob">
                <thead class=" thead-dark">
                    <tr>
                        <th class="columnID" scope="col">#</th>
                        <th class="columnDate" scope="col">Init Date</th>
                        <th class="columnCustomer" scope="col">Customer</th>
                        <th class="columnType" scope="col">type</th>
                        <th class="columnCommentary" scope="col">Commentary</th>
                    </tr>
                </thead>
                <tbody id="tBodyTableUnassignedJob">

                </tbody>
            </table>
        </div>

        <div id="divTableCurrentJob">
            <table data-page-length='25' class="table" id="tableCurrentJob">
                <thead class=" thead-dark">
                <tr>
                    <th class="columnID" scope="col">#</th>
                    <th class="columnDate" scope="col">Init Date</th>
                    <th class="columnDate" scope="col">Start Date</th>
                    <th class="columnCustomer" scope="col">Customer</th>
                    <th class="columnType" scope="col">type</th>
                    <th class="columnCommentary" scope="col">Commentary</th>
                    <th class="columnCustomer" scope="col">Worker</th>
                </tr>
                </thead>
                <tbody id="tBodyTableCurrentJob">

                </tbody>
            </table>
        </div>

        <div id="divTableEndJob">
            <table data-page-length='25' class="table" id="tableEndJob">
                <thead class=" thead-dark">
                <tr>
                    <th class="columnID" scope="col">#</th>
                    <th class="columnDate" scope="col">Init Date</th>
                    <th class="columnDate" scope="col">Start Date</th>
                    <th class="columnCustomer" scope="col">Customer</th>
                    <th class="columnType" scope="col">type</th>
                    <th class="columnCommentary" scope="col">Commentary</th>
                    <th class="columnCustomer" scope="col">Worker</th>
                    <th class="columnDate" scope="col">Date End</th>

                </tr>
                </thead>
                <tbody id="tBodyTableEndJob">

                </tbody>
            </table>
        </div>

        <div id="modalLogin" class="modal" aria-hidden="true" role="dialog" aria-modal="false" aria-labelledby="title_modal" style="display:none">
            <div class="modal-wrapper js-modal-stop">
                <a href="#" class="js-modal-close"><img src="img/button-cross.png" width="50px"></a>
                <form action="#" class="login">
                    <label for="login">Login</label>
                    <input type="text" name="login" id="login" placeholder="your login">
                    <p id="errorLogin"></p>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="your password">
                    <p id="errorPassword"></p>
                    <button type="submit" class="btn btn-primary " id="connect">Connect !</button>
                </form>
            </div>
        </div>
    </div>



</body>
<script src="js/libs/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="js/libs/main.js"></script>
<script src="js/libs/modal.js"></script>
<script src="js/index.js"></script>



</html>