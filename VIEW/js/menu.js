getTime();

//on cache par défaut les div des tableaux des job fini et non assigné, on veut qu'on chargement de la page on soit focus sur les currentJobs
$('#divTableUnassignedJob').hide();
$('#divTableEndJob').hide();

refreshTableAndCount();

createActiveOnButton();

hideAndShowTableJob();

checkLog();

makeLogIn();

makeLogOut();


$.ajax({
    url : '../CONTROLER/downloadMyCurrentJobs.action.php',
    type: 'POST',
    dataType: 'json',
    success : function (response){
       // response = $.parseJSON(response)
        response.forEach(function (element){
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

        if (response[0] === undefined){
            $('#yourCurrentJob').append(
                "<div class='yourCurrentJobContent'>" +
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



