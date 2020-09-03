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

$('#divTableUnassignedJob').hide();
$('#divTableEndJob').hide();

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


/*
ajout/delete la classe active sur les buttonJob
 */
$('.buttonJob').click(function (e){
    $('.buttonJob').removeClass('active');

    $(this).addClass('active')
})


/*
hide and show des div contenant les tables en fonction du click sur button
 */
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


/*
Gestion du bouton LogIn pour appeller une fenêtre modale
 */


































