//appel ajax pour remplir le selecteur de client déja existant
$.ajax({
    url: '../CONTROLER/loadCustomerList.action.php',
    type: 'POST',
    dataType: 'json',
    success: function (response){
        //response est un tableau multidimensionnel, chaque sous tableau étant un customer

        //on parcours le tableau response et on crée un option du select pour chaque customer
        response.forEach(function (element){
            $('#selectExistantCustomer').append(
                "<option value='" + element.id_customer + "'>" +
                    element.name + ' ' + element.firstname + ' ' + element.city + ' ' + element.email +
                "</option>"
            )
        })




    },
    error: function (response){
        console.log('error')
        alert('error')
    }
})


//par défaut on passe en disabled la partie du formulaire createNewCustomer
$(".formNewCustomer :input").attr("disabled", true)

//on crée un event pour le choix de créer ou non un nouveau customer, le but étant de grisé la partie du formulaire ne correspondant pas au choix fait
$('#selectCustomer').click(function (){
    $('#selectCustomer').attr('checked', true)
    $('#createCustomer').removeAttr('checked')
    selectOption()
})
$('#createCustomer').click(function (){
    $('#selectCustomer').removeAttr('checked')
    $('#createCustomer').attr('checked', true)
    selectOption()
})


let selectOption = function (){
    if ($('#selectCustomer').is(":checked")){
        $('#selectExistantCustomer').prop('disabled', false)
    }
    else{
        $('#selectExistantCustomer').prop('disabled', true)
    }
    if ($('#createCustomer').is(":checked")){
        $(".formNewCustomer :input").attr("disabled", false)
    }
    else{
        $(".formNewCustomer :input").attr("disabled", true)
    }
}


/*
ENVOIE DES DONNEES DU FORMULAIRE EN CALL AJAX quand on submit le formulaire
 */
$('#validateNewJob').click(function (e){
    e.preventDefault();

    if ($('#selectExistantCustomer').is(':disabled') == false)
    {
        $.ajax({
            url: '../CONTROLER/newJobWithExistantCustomer.action.php',
            type: 'POST',
            dataType: 'json',
            data: {
                id_customer : $("#selectExistantCustomer").val(),
                nameJobType : $("input[name=type_job]:checked").val(),
                commentary : $("#commentary").val()
            },
            success: function (response){
                console.log(response)
                alert('a new job has created, thank you')
                window.location.href = 'menu.php'
            },
            error: function (response){
                console.log('error')
                alert('error')
            }
        })

    }else
    {
        $.ajax({
            url: '../CONTROLER/newJobWithNewCustomer.action.php',
            type: 'POST',
            dataType: 'json',
            data: {
                name : $('#nameNewCustomer').val(),
                firstname : $('#firstnameNewCustomer').val(),
                birthday : $('#birthdayNewCustomer').val(),   //format string
                email : $('#emailNewCustomer').val(),
                phone : $('#phoneNewCustomer').val(),
                address : $('#addressNewCustomer').val(),
                city : $('#cityNewCustomer').val(),
                nameJobType : $("input[name=type_job]:checked").val(),
                commentary : $("#commentary").val()
            },
            success: function (response){
                console.log(response.msg)
                if (response.msg == false){
                    alert('email already exist')
                    
                }else{
                    alert('a new job has created, thank you')
                    window.location.href = 'menu.php'
                }

            },
            error: function (response){
                console.log('error')
                alert('merde')
            }
        })

    }







})


























