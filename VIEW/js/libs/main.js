/////////////////////////////////////////////////////////////////////////
/////                                                               /////
/////                   LIBRAIRIE PERSO                             /////
/////                                                               /////
/////////////////////////////////////////////////////////////////////////

/*
Horloge de la navbar
 */

function getTime () {
    let date = new Date();
    let hours = date.getHours();
    let minutes = date.getMinutes();
    let seconds = date.getSeconds();
    hours = ((hours < 10) ? " 0" : " ") + hours;
    minutes = ((minutes < 10) ? ":0" : ":") + minutes;
    seconds = ((seconds < 10) ? ":0" : ":") + seconds;
    let myHour = document.getElementById("my-hour");
    myHour.textContent = hours + minutes + seconds;
    setTimeout("getTime()",1000);

}


/**
 * call AJAX au chargement pour mettre à jours les totaux des jobs dans les  buttons et crée tous les tableaux
 */
function refreshTableAndCount (){
    $.ajax({
        url: '../CONTROLER/loadTask.action.php',
        type: 'POST',
        dateType: 'json',
        success: function (response){
            response = $.parseJSON(response)

            //mise a jour des totaux dans les buttons
            $('#jobEnd').text(response[2].length);
            $('#jobCurrent').text(response[1].length);
            $('#jobUnassigned').text(response[0].length);

            //création des 3 tableaux
            response[0].forEach(function (element){
                $('#tBodyTableUnassignedJob').append(
                    "<tr>" +
                        "<th>"+
                        element.id_job +
                        "</th>" +
                        "<td>"+
                        element.date_init +
                        "</td>" +
                        "<td style=' text-transform:capitalize;'>"+
                        element.name + ' ' + element.firstname +
                        "</td>" +
                        "<td>"+
                        element.nameType +
                        "</td>" +
                        "<td>"+
                        element.commentary +
                        "</td>" +
                    "</tr>"
                )
            })
            response[1].forEach(function (element){
                $('#tBodyTableCurrentJob').append(
                    "<tr>" +
                        "<th>"+
                        element.id_job +
                        "</th>" +
                        "<td>"+
                        element.date_init +
                        "</td>" +
                        "<td>"+
                        element.date_init +
                        "</td>" +
                        "<td style=' text-transform:capitalize;'>"+
                        element.name + ' ' + element.firstname +
                        "</td>" +
                        "<td>"+
                        element.nameType +
                        "</td>" +
                        "<td>"+
                        element.commentary +
                        "</td>" +
                        "<td style=' text-transform:capitalize;'>"+
                        element.nameWorker + ' ' + element.firstnameWorker +
                        "</td>" +
                    "</tr>"
                )
            })
            response[2].forEach(function (element){
                $('#tBodyTableEndJob').append(
                    "<tr>" +
                        "<th>"+
                        element.id_job +
                        "</th>" +
                        "<td>"+
                        element.date_init +
                        "</td>" +
                        "<td>"+
                        element.date_init +
                        "</td>" +
                        "<td style=' text-transform:capitalize;'>"+
                        element.name + ' ' + element.firstname +
                        "</td>" +
                        "<td >"+
                        element.nameType +
                        "</td>" +
                        "<td>"+
                        element.commentary +
                        "</td>" +
                        "<td style=' text-transform:capitalize;'>"+
                        element.nameWorker + ' ' + element.firstnameWorker +
                        "</td>" +
                        "<td>"+
                        element.date_end +
                        "</td>" +
                    "</tr>"
                )
            })

            //ajout du dataTable (champs de recherche)
            $(document).ready(function () {
                $('#tableCurrentJob').DataTable();
                $('.dataTables_length').addClass('bs-select');
            });
            $(document).ready(function () {
                $('#tableUnassignedJob').DataTable();
                $('.dataTables_length').addClass('bs-select');
            });
            $(document).ready(function () {
                $('#tableEndJob').DataTable();
                $('.dataTables_length').addClass('bs-select');
            });

        },
        error:function(response){
            console.log('error');
            alert("error");
        }
    })
}



/*
ajout/delete la classe active sur les buttonJob
 */
function createActiveOnButton(){
    $('.buttonJob').click(function (e){
        $('.buttonJob').removeClass('active');

        $(this).addClass('active')
    })
}


/*
hide and show des div contenant les tables en fonction du click sur button
 */
function hideAndShowTableJob(){
    $('.buttonCurrentJob').click(function (e){
        $('#divTableUnassignedJob').hide()
        $('#divTableEndJob').hide()
        $('#divTableCurrentJob').show()
    })
    $('.buttonUnassignedJob').click(function (e){
        $('#divTableEndJob').hide()
        $('#divTableCurrentJob').hide()
        $('#divTableUnassignedJob').show()
    })
    $('.buttonEndJob').click(function (e){
        $('#divTableCurrentJob').hide()
        $('#divTableUnassignedJob').hide()
        $('#divTableEndJob').show()
    })
}


/*
appel ajax simplement pour vérifier si il y a déja un session de conection en cours ou pas (au quel cas on modifie le button Log In en Log Out
 */
function checkLog(){
    $.ajax({
        url: '../CONTROLER/checkSession.action.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'tokenJWT' : localStorage.tokenJWT,
        },
        success: function (response){
            // response = JSON.parse(response)
            if(response.loginExist == true){
                $('#buttonLogin').removeClass('btn-warning');
                $('#buttonLogin').addClass('btn-danger');

                $('#linkLogin').attr('href', '#');
                $('#linkLogin').removeClass('js-modal')
                $('#linkLogin').text('Log Out');
            }else if (response.loginExist == false){

            }
        },
        error:function(response){
            console.log('error');
            alert("error");
        }
    })
}
function checkLogMenu(){
    $.ajax({
        url: '../CONTROLER/checkSession.action.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'tokenJWT' : localStorage.tokenJWT,
        },
        success: function (response){
            // response = JSON.parse(response)
            if(response.loginExist == true){
                $('#buttonLogin').removeClass('btn-warning');
                $('#buttonLogin').addClass('btn-danger');

                $('#linkLogin').attr('href', '#');
                $('#linkLogin').removeClass('js-modal')
                $('#linkLogin').text('Log Out');
            }else if (response.loginExist == false){
               window.location.href = 'index.php'
            }
        },
        error:function(response){
            console.log('error');
            alert("error");
        }
    })
}
/*
gestion de l'appel AJAX lors de la demande de connection
 */
function makeLogIn(){
    $('#connect').click(function (e){
        e.preventDefault();
        $('#errorLogin').text('');
        $('#errorPassword').text('');

            $.ajax({
                url: '../CONTROLER/login.action.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    login : $("#login").val(),  // Nous récupérons la valeur de nos input que l'on fait passer à login.action.php
                    password : $("#password").val()
                },
                success: function (response){
                    console.log(response)
                    // response = $.parseJSON(response)
                    if (response.errorLogin != null || response.errorPassword != null){
                        $('#errorLogin').text(response.errorLogin);
                        $('#errorPassword').text(response.errorPassword);
                    }else{    // ca veut dire que response est notre token JWT
                        //on stocke en localstorage notre token
                        localStorage.setItem('tokenJWT', response)
                        //on redirige vers le menu
                        window.location.href = 'menu.php'
                    }

                },
                error:function(response){
                    console.log('error');
                    alert("error");
                }
            })
    })

}
/*
evenement log Out
 */
function makeLogOut(){
    $('#linkLogin').click(function (e){
        localStorage.removeItem('tokenJWT')
        if (window.location.href != "http://localhost:7080/ProparCompany/VIEW/index.php" && window.location.href != "http://localhost:7080/www/ProparCompany/VIEW/index.php"
            && window.location.href != "http://localhost/ProparCompany/VIEW/index.php" && window.location.href != "http://localhost/www/ProparCompany/VIEW/index.php" ){
            window.location.href = 'index.php';
        }
    })
}


function loadYourCurrentJob(){
    $.ajax({
        url : '../CONTROLER/downloadMyCurrentJobs.action.php',
        type: 'POST',
        dataType: 'json',
        data : {
          'tokenJWT' : localStorage.tokenJWT
        },
        success : function (response){
            if (response.loginExist == false){
                window.location.href = 'index.php'
            }else{
                $('#welcomeBackContent').text(response.nameWorker + ' ' + response.firstnameWorker)
                $('#statusWorkerToken').text(response.statusWorker)

                console.log(response.statusWorker)
                if (response.statusWorker == 'expert'){
                    $('#restrictedMenu').show()
                    // $('#restrictedMenu').append(
                    //     "<div class='navMenu'>" +
                    //         "<h4>5</h4>" +
                    //         "<div class='subjectMenu'>" +
                    //             "<h5>Create a new type of job</h5>" +
                    //             "<p>restricted</p>" +
                    //         "</div>" +
                    //         "<a href='modalCreateNewTypeJob.php#modal5' class='js-modal round-button' id='buttonListC&FJobs'></a>" +
                    //     "</div>" +
                    // "<div class='navMenu'>" +
                    //     "<h4>6</h4>" +
                    //     "<div class='subjectMenu'>" +
                    //         "<h5>Add a new worker</h5>" +
                    //        " <p>restricted</p>" +
                    //     "</div>" +
                    //     "<a href='modalCreateWorker.php#modal6' class='js-modal round-button' id='buttonListC&FJobs'></a>" +
                    // "</div>" +
                    // "<div class='navMenu'>" +
                    //     "<h4>7</h4>" +
                    //     "<div class='subjectMenu'>" +
                    //         "<h5>Worker list</h5>" +
                    //         "<p>restricted</p>" +
                    //     "</div>" +
                    //     "<a href='modalWorkerList.php#modal7' class='js-modal round-button' id='buttonListC&FJobs'></a>" +
                    // "</div>" +
                    // "<div class='navMenu'>" +
                    //     "<h4>8</h4>" +
                    //     "<div class='subjectMenu'>" +
                    //         "<h5>Revenue</h5>" +
                    //         "<p>restricted</p>" +
                    //     "</div>" +
                    //     "<a href='modalRevenu.php#modal8' class='js-modal round-button' id='buttonListC&FJobs'></a>" +
                    // "</div>"
                    // )
                }

                response.req.forEach(function (element){
                    $('#yourCurrentJob').append(
                        "<div class='yourCurrentJobContent'>" +
                        "<h5>" +
                        "Job number " + element.id_job + ' of ' + element.date_init +
                        "</h5>" +
                        "<p>" +
                        "Type: " + element.nameJobType +
                        "</p>" +
                        "<p>" +
                        "Starting date: " + element.date_attributed +
                        "</p>" +
                        "<p>" +
                        "Customer: " + element.nameCustomer + ' ' + element.firstnameCustomer +"<br>" + element.address + "<br>" + element.cityCustomer +
                        "</p>" +
                        "<p>" +
                        "Commentary: " + element.commentary +
                        "</p>" +
                        "</div>"
                    )
                })

                if (response.req[0] === undefined){
                    $('#yourCurrentJob').append(
                        "<div class='yourCurrentJobContent'>" +
                        "<h5>" +
                        "No work in progress" +
                        "</h5>" +
                        "</div>"
                    )
                }
            }



        },
        error:function(response){
            console.log('error');
            alert("error");
        }
    })
}

function loadYourCurrentJobModal(){
    $.ajax({
        url : '../CONTROLER/downloadMyCurrentJobs.action.php',
        type: 'POST',
        dataType: 'json',
        success : function (response){
            // response = $.parseJSON(response)
            response.forEach(function (element){
                $('#personalCurrentJob').append(
                    "<div class='personnalCurrentJobContent'>" +
                        "<h5>" +
                            "Job number " + element.id_job + ' of ' + element.date_init +
                        "</h5>" +
                        "<div class='personnalCurrentJobContentText'>"+
                            "<div>" +
                                "<p>" +
                                "Type: " + element.nameJobType +
                                "</p>" +
                                "<p>" +
                                "Starting date: " + element.date_attributed +
                                "</p>" +
                                "<p>" +
                                "Customer: " + element.nameCustomer + ' ' + element.firstnameCustomer +"<br>" + element.address + "<br>" + element.cityCustomer +
                                "</p>" +
                                "<p>" +
                                "Commentary: " + element.commentary +
                                "</p>" +
                            "</div>" +
                            "<div>" +
                                "<button type='button' class='buttonValidateAJob'> Validate this work n°" + "<span>" + element.id_job + "</span>" + "</button>" +
                            "</div>" +
                        "</div>"+
                    "</div>"
                )
            })

            if (response[0] === undefined){
                $('#yourCurrentJob').append(
                    "<div class='personnalCurrentJobContent'>" +
                    "<h5>" +
                    "No work in progress" +
                    "</h5>" +
                    "</div>"
                )
            }

        },
        error:function(response){
            console.log('error');
            alert("error");
        }
    })
}




























