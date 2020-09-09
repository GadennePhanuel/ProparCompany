checkLogMenu()



$('#validateRevenu').click(function (e){
    e.preventDefault()

    if ($('#dateStart').val().length == 0 || $('#dateEnd').val().length == 0 ){
        $('#errorMsgDate').text('pick date please.....')
    }else{
        $.ajax({
            url: '../CONTROLER/revenue.action.php',
            type: 'POST',
            datatype: 'json',
            data :{
                'dateStart' : $('#dateStart').val(),
                'dateEnd' : $('#dateEnd').val(),
            },
            success: function (response){
                console.log(response)
                response = $.parseJSON(response)
                if (response.value == false){
                    $('#returnRevenu').text('invalid date')
                }else{
                    $('#returnRevenu').text(response.revenue)
                }
            },
            error: function (response){
                console.log('error')
                alert('error')
            }


        })




    }
})