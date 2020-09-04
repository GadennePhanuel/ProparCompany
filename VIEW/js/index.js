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