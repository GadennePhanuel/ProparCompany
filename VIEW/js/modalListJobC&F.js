checkLogMenu()


$('#divTableEndJob').hide();


createActiveOnButton()

$.ajax({
    url: '../CONTROLER/loadTask.action.php',
    type: 'POST',
    dateType: 'json',
    success: function (response){
        response = $.parseJSON(response)

        //mise a jour des totaux dans les buttons
        $('#jobEnd').text(response[2].length);
        $('#jobCurrent').text(response[1].length);

        //création des 2 tableaux
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
            $('#tableEndJob').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });

    },
    error:function(response){
        console.log('error');
        alert("error");
    }
})

/*
hide and show des div contenant les tables en fonction du click sur button
 */
    $('.buttonCurrentJob').click(function (e){
        $('#divTableEndJob').hide()
        $('#divTableCurrentJob').show()
    })
    $('.buttonEndJob').click(function (e){
        $('#divTableCurrentJob').hide()
        $('#divTableEndJob').show()
    })

