$('.content').html("<h2>Phase 1</h2>" + "Installation des composants de base.");

AR.GET('install.php?phase=1', function (data) {
    if(data == "IP1Ok"){
        $('.content').html("<h2>Phase 1 : OK</h2><h2>Phase 2</h2>" + "Installation de la partie d'administration");
    }else{
        IFailure();
    }
}, IFailure);

function IFailure(){
    alert('Une erreur est survenue lors de la création de votre site');
    $('body').html('/x-error-Installation-Failure/');
}