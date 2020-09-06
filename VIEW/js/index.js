getTime();

//on cache par défaut les div des tableaux des job fini et non assigné, on veut qu'on chargement de la page on soit focus sur les currentJobs
$('#divTableUnassignedJob').hide();
$('#divTableEndJob').hide();

refreshTableAndCount();

createActiveOnButton();

hideAndShowTableJob();

checkLog();


/*
on crée un petit event sur le formulaire de connection pour disabled le button submit si les champs sont pas rempli
 */
//par défaut on disabled le button submit du formulaire de connection
$('.actions[type="submit"]').attr('disabled', 'disabled');

$('.field').keyup(function() {

    let empty = false;
    $('.field').each(function() {
        if ($(this).val().length == 0) {
            empty = true;
        }
    });

    if (empty) {
        $('.actions[type="submit"]').attr('disabled', 'disabled');
    } else {
        $('.actions[type="submit"]').removeAttr('disabled');
    }
});


makeLogIn();

makeLogOut();

