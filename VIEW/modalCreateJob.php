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
    <title>Fenêtre modale 4</title>
</head>
<body>


<aside id="modal4" class="modal"  aria-labelledby="title_modal" >
    <div class="modal-wrapper js-modal-stop" >
        <a href="#" class="js-modal-close"><img src="img/button-cross.png" width="50px"></a>
        <h1>Create a new job</h1>
        <form>
            <div id="createOrSelectCustomer">
                <div class="customerOptions">
                    <div>
                        <input type="radio" name="customer" id="selectCustomer" checked>
                        <label for="selectCustomer">Select an existant customer</label>
                    </div>
                    <div>
                        <input type="radio" name="customer" id="createCustomer" >
                        <label for="createCustomer">Create a new customer</label>
                    </div>
                    <div id="selectCustomerForm">
                        <label for="selectExistantCustomer">Select a customer : </label>
                        <select name="selectedCustomer" id="selectExistantCustomer">
                            <option value="" >--Please choose an option--</option>
                        </select>
                    </div>
                    <div id="createCustomerForm">
                        <h3>Create new customer : </h3>
                       <div class="formNewCustomer">
                           <div>
                               <input type="text" placeholder="Name" name="name" id="nameNewCustomer">
                               <input type="text" placeholder="Firstname" name="firstname" id="firstnameNewCustomer">
                               <input type="date" placeholder="Birthday" name="birthday" id="birthdayNewCustomer">
                           </div>
                           <input type="email" placeholder="Email" name="email" id="emailNewCustomer">
                           <input type="tel" placeholder="Mobile Phone Required" name="phone" id="phoneNewCustomer" pattern="^0[0-9]{9}" minlength="10" maxlength="10">
                           <input type="text" placeholder="Address" name="address" id="addressNewCustomer">
                           <input type="text" placeholder="City" name="city" id="cityNewCustomer">
                       </div>
                    </div>
                </div>
                <div id="jobOptions">
                    <h3>Complete job options : </h3>
                    <div id="jobTypeList">
                        <div>
                            <input type="radio" name="type_job" id="big" value="big" checked>
                            <label for="big">BIG : 10000€</label>
                        </div>
                        <div>
                            <input type="radio" name="type_job" id="medium" value="medium">
                            <label for="medium">MEDIUM : 2500€</label>
                        </div>
                        <div>
                            <input type="radio" name="type_job" id="little" value="little">
                            <label for="little">LITTLE : 1000€</label>
                        </div>
                    </div>
                    <textarea name="commentary" id="commentary"  rows="2" placeholder="Commentary..." ></textarea>
                </div>
                <div>
                    <p id="errorSelectCustomer"></p>
                    <button type="submit" class="btn btn-danger" id="validateNewJob">VALIDATE</button>
                </div>
            </div>
        </form>
    </div>






    <script src="js/libs/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="js/libs/main.js"></script>
    <!--    <script src="js/libs/modal.js"></script>-->
    <script src="js/modalCreateJob.js"></script>
</aside>

</body>

</html>