$('.content').html("<h2>Phase 1</h2>" + "Installation des composants de base.");

AR.GET('install.php?phase=1', function (data) {
    if (data == "IP1Ok") {
        $('.content').html("<h2>Phase 1 : OK</h2><h2>Phase 2</h2>" + "Suppression des fichiers d'installation");
        setTimeout(function () {
            AR.GET('install.php?phase=2', function (data2) {
                if (data2 == "IP2Ok") {
                    $('.content').html('Votre site est configuré ! <br /> <div> Nom d\'utilisateur : l\'adresse email que vous avez entrée aux étapes précédentes.<br />Mot de passe : celui que vous avez défini il y a 2 étapes.</div> <a href="../scms-admin">Me connecter sur mon site</a>');
                } else {
                    IFailure();
                }
            }, IFailure);
        }, 1500);
    } else {
        
        IFailure();
    }
}, IFailure);

function IFailure() {
    alert('Une erreur est survenue lors de la création de votre site');
    $('body').html('/x-error-Installation-Failure/');
}