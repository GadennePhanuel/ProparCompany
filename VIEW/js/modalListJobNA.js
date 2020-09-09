checkLogMenu()



//au chargement de la fmodal on génére le tableau par un appel ajax
$.ajax({
    url: '../CONTROLER/loadTask.action.php',
    type: 'POST',
    dateType: 'json',
    success: function (response){
        response = $.parseJSON(response)

        //mise a jour des totaux dans les buttons
        $('#jobUnassigned').text(response[0].length);

        //création du tableaux
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
                "<td>"+
                    "<button type='button' class='pickJob js-modal-close' style='width: 100px; height: 25px'> Pick n°" + "<span>" + element.id_job + "</span>" +"</button>" +
                    // "<a href='#' class='pickJob js-modal-close' style='display: block; width: 100px; height: 25px; border: 1px solid #3751FF'> Pick n°" + "<span>" + element.id_job + "</span>" +"</a>" +
                "</td>" +
                "</tr>"
            )
        })

        // ajout du dataTable (champs de recherche)
        $(document).ready(function () {
            $('#tableUnassignedJob').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });

        /*
        on crée la gestion de la selection d'un job
         */
        $('.pickJob').click(function (e){
            e.preventDefault()
            //quand on click sur le button on récupére l'id du job choisi
            let idJobTarget =  $(this).children('span').text()

            /*
            on envoi via un appel AJAX les identifiant de l'employé et du l'id du job qui la choisi. Ceci afin de mettre a jour la DT
             */
            $.ajax({
                url: '../CONTROLER/attributeJob.action.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    'tokenJWT' : localStorage.tokenJWT,
                    id_job: idJobTarget
                },
                success: function (response){
                    //si la demande d'attribution revoie false (donc n'a pas été faites, on fait une alert)
                    if (response.validate == false){
                        alert(response.nbJob)
                    }
                    //si l'assignation du job a bien été faites renvoi sur la page menu.php pour forcer la fermeture de la fmodal et le rechergement des div YourCurrentJob
                    if (response.validate == true){
                        window.location.href = 'menu.php';
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

