checkLogMenu()


//au chargement de la fmodal on génére le tableau par un appel ajax
$.ajax({
    url: '../CONTROLER/loadWorkerList.action.php',
    type: 'POST',
    dateType: 'json',
    success: function (response){
        response = $.parseJSON(response)
        //création du tableaux
        response.forEach(function (worker){
            $('#tBodyTableWorkerList').append(
                "<tr>" +
                    "<th>" +
                        worker.id_worker +
                    "</th>" +
                    "<td>" +
                        worker.name +
                    "</td>" +
                    "<td>" +
                        worker.firstname +
                    "</td>" +
                    "<td>" +
                        worker.dateHiring +
                    "</td>" +
                    "<td>" +
                        worker.phone +
                    "</td>" +
                    "<td>" +
                        worker.status +
                    "</td>" +
                    "<td>" +
                    "<button type='button' class='initExpert js-modal-close'> expert" + "<span hidden>" + worker.id_worker + "</span>" +"</button>" +
                    "<button type='button' class='initSenior js-modal-close'> sénior" + "<span hidden>" + worker.id_worker + "</span>" +"</button>" +
                    "<button type='button' class='initApprenti js-modal-close'> apprenti" + "<span hidden>" + worker.id_worker + "</span>" +"</button>" +
                    "</td>"+
                "</tr>"
            )
        })

        // ajout du dataTable (champs de recherche)
        $(document).ready(function () {
            $('#tableWorkerList').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });

        /*
        on crée la gestion de l'init d'un worker en expert
         */
        $('.initExpert').click(function (e){
            e.preventDefault()
            //quand on click sur le button on récupére l'id du job choisi
            let idWorker =  $(this).children('span').text()
            console.log(idWorker);
            /*
            on envoi via un appel AJAX les identifiant de l'employé et du l'id du job qui la choisi. Ceci afin de mettre a jour la DT
             */
            $.ajax({
                url: '../CONTROLER/initExpert.action.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id_worker: idWorker
                },
                success: function (response){
                    alert('Done, status change')
                    window.location.href = 'menu.php'
                },
                error: function (response){
                    console.log('error');
                    alert("error1");
                }
            })
        })
                /*
            on crée la gestion de l'init d'un worker en sénior
             */
        $('.initSenior').click(function (e) {
            e.preventDefault()
            //quand on click sur le button on récupére l'id du job choisi
            let idWorker = $(this).children('span').text()
            console.log(idWorker);
            /*
                  on envoi via un appel AJAX les identifiant de l'employé et du l'id du job qui la choisi. Ceci afin de mettre a jour la DT
                   */
            $.ajax({
                url: '../CONTROLER/initSenior.action.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id_worker: idWorker
                },
                success: function (response) {
                    alert('Done, status change')
                    window.location.href = 'menu.php'
                    },
                error: function (response) {
                    console.log('error');
                    alert("error");
                }
            })
        })

        /*
         on crée la gestion de l'init d'un worker en apprenti
        */
        $('.initApprenti').click(function (e) {
            e.preventDefault()
            //quand on click sur le button on récupére l'id du job choisi
            let idWorker = $(this).children('span').text()
            console.log(idWorker);
            /*
                           on envoi via un appel AJAX les identifiant de l'employé et du l'id du job qui la choisi. Ceci afin de mettre a jour la DT
                            */
            $.ajax({
                url: '../CONTROLER/initApprenti.action.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    id_worker: idWorker
                },
                success: function (response) {
                    alert('Done, status change')
                    window.location.href = 'menu.php'
                    },
                error: function (response) {
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

