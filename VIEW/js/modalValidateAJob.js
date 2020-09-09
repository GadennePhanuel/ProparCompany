checkLogMenu()


/*
call ajax créant des div contenant chacune un job en cours perso avec un bouton
 */

$.ajax({
    url : '../CONTROLER/downloadMyCurrentJobs.action.php',
    type: 'POST',
    dataType: 'json',
    data: {
        'tokenJWT' : localStorage.tokenJWT,
    },
    success : function (response){
        //on recoit les infos, on crée les divs
            if (response.loginExist == false){
                window.location.href = 'index.php'
            }else {
                response.req.forEach(function (element){
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

                if (response.req[0] === undefined){
                    $('#personalCurrentJob').append(
                        "<div class='personnalCurrentJobContent'>" +
                        "<h5>" +
                        "No work in progress" +
                        "</h5>" +
                        "</div>"
                    )
                }
            }


        /*
        on crée maintenant la gestion du click pour valider un job
         */
        $('.buttonValidateAJob').click(function (e){
            e.preventDefault()
            //quand on click sur le button on récupére l'id du job choisi
            let idJobTarget =  $(this).children('span').text()
            console.log(idJobTarget)
            /*
            on envoi via un appel AJAX les identifiant de l'employé et du l'id du job qui la choisi. Ceci afin de mettre a jour la DT
             */
            $.ajax({
                url: '../CONTROLER/validateAJob.action.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'tokenJWT' : localStorage.tokenJWT,
                    id_job: idJobTarget
                },
                success: function (response){
                    if(response.loginExist == true){
                        //si la demande de validation revoie false (donc n'a pas été faites, on fait une alert)
                        if (response.endJob == false){
                            alert("error process, contact admin please ")
                        }
                        //si l'assignation du job a bien été faites renvoi sur la page menu.php pour forcer la fermeture de la fmodal et le rechergement des div YourCurrentJob
                        if (response.endJob == true){
                            window.location.href = 'menu.php';
                        }
                    }else if (response.loginExist == false){
                        window.location.href = 'index.php'
                    }
                },
                error: function (response){
                    console.log('error');
                    alert("error");
                }
            })

        })


    },
    error:function(response){
        console.log('error');
        alert("error");
    }
})

