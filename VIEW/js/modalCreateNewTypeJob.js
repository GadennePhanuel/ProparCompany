/*
envoie en call ajax des donnée du formulaire pour création du nouveau type de job
 */
$('#validateNewTypeJob').click(function (e){
    e.preventDefault();

    $.ajax({
        url: '../CONTROLER/createNewTypeJob.action.php',
        type: 'POST',
        dataType: 'json',
        data: {
            nameType : $("#nameType").val(),
            priceType : $("#priceType").val()
        },
        success: function (response){
            console.log(response)
            if (response.msg == false){
                alert('New type name already exist, error !')
            }else{
                alert('New type is registered, thank you')
                window.location.href = 'menu.php'
            }
        },
        error: function (response){
            console.log('error')
            alert('error')
        }
    })
})
