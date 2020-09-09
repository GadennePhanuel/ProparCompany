checkLogMenu()


/*
call ajax pour remplir les inputs type radio des options de status possible au sein de la company
 */
$.ajax({
    url: '../CONTROLER/loadWorkerStatus.action.php',
    type: 'POST',
    dataType: 'json',
    success: function(response){
        //response[0].status = premier status

        //on génére les inputs
        response.forEach(function (element){
            $('#selectWorkerStatusContent').append(
                "<div>" +
                "<input checked type='radio' id='"+ element.status +"' name='statusWorker' value='"+ element.status +"'>" +
                "<label for='"+ element.status +"'>"+ element.status +"</label>" +
                "</div>"
            )
        })


    },
    error: function(response){
        console.log('error')
        alert("error")
    }
})

/*
event clik on VALIDATE BUTTON ---> envoie donnée vers le back en call ajax
 */
$('#validateNewWorker').click(function (e){
    e.preventDefault()

    if ( $("#nameWorker").val().length == 0 &&
        $("#firstnameWorker").val().length == 0 &&
        $("#birthdayWorker").val().length == 0 &&
        $("#phoneWorker").val().length == 0 &&
        $("#hiringDate").val().length == 0 &&
        $("#loginWorker").val().length == 0 &&
        $("#passwordWorker").val().length == 0
    ){
        $('#errorWorkerFieldEmpty').text('error fields...')
    }else{
        $.ajax({
            url: '../CONTROLER/createWorker.action.php',
            type: 'POST',
            dateType: 'json',
            data: {
                name : $('#nameWorker').val(),
                firstname: $('#firstnameWorker').val(),
                birthday: $('#birthdayWorker').val(),
                phone: $('#phoneWorker').val(),
                hiringDate: $('#hiringDate').val(),
                status: $("input[name=statusWorker]:checked").val(),
                login: $('#loginWorker').val(),
                password: $('#passwordWorker').val(),
            },
            success: function (response){
                response = $.parseJSON(response)
                console.log(response)
                if (response.login == false){
                    alert('Login already exist, choose an other login please')
                }else{
                    if (response.msg == true){
                        alert('New worker has registered')
                        window.location.href = 'menu.php'
                    }else if (response.msg == false){
                        alert('invalid form, error')
                    }
                }
            },
            error: function (response){
                console.log('errror')
                alert('error')
            }
        })
    }
})