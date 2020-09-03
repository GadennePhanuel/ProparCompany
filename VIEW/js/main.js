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
getTime();

$('#tableUnassignedJob').hide();
$('#tableEndJob').hide();

/**
 * call AJAX au chargement pour mettre à jours les totaux des jobs dans les  buttons et crée tous les tableaux
 */
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

        console.log(response[0][0].id_job)


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
            $('#tableUnassignedJob').DataTable({
                "paging":   false,
                "ordering": false,
                "info":     false
            });
        });
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
ajout/delete la classe active sur les buttonJob
 */
$('.buttonJob').click(function (e){
    $('.buttonJob').removeClass('active');

    $(this).addClass('active')
})


/*
hide and show des tables en fonction du click sur button
 */
$('.buttonCurrentJob').click(function (e){
    $('#divtableUnassignedJob').hide()
    $('#divtableEndJob').hide()
    $('#divtableCurrentJob').show()
})
$('.buttonUnassignedJob').click(function (e){
    $('#tableEndJob').hide()
    $('#tableCurrentJob').hide()
    $('#tableUnassignedJob').show()
})
$('.buttonEndJob').click(function (e){
    $('#tableCurrentJob').hide()
    $('#tableUnassignedJob').hide()
    $('#tableEndJob').show()
})