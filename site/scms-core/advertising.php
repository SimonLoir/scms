<?php
if(is_file('show_pub')){
?>
<div class="scms-advertising made-with" data-core-no-index>
    Made with SCMS free version, make your own website now !
    <!--remove-https
        <img src="http://hgfjdhjksfjhk.com" display="none"/>
    remove-https-->
</div>

<style data-core-no-index>
.scms-advertising{
    position: fixed;
    right: 1px;
    bottom: 1px;
    background:#ce1338;
    font-family: sans-serif;
    color:white;
    padding-top: 8px;
    padding-bottom: 8px;
    padding-left: 12px;padding-right: 12px;
    border-radius: 4px;
}

.made-with{
    cursor: pointer;
    font-size:10px;
    transition:0.75s;
}

.made-with:hover{
    font-size: 14px;
}
</style>

<script data-core-no-index>
$('.made-with').click(function () {window.location.href = "http://simonloir.be/scms";});

$(document).ready(function ( ) {
    var adBlock = false;
    var testAd = document.createElement('div');
        testAd.innerHTML = "&nbsp;";
        testAd.className = "adsbox";
    document.body.appendChild(testAd);
    setTimeout(function() {
        if(testAd.offsetHeight === 0){
            adBlock = true;
            
            $('.scms-content-container').html("").child('div').addClass('scms-content-block').html(
                
                 '<h2>Un bloqueur de pub est activé, désactivez le pour accèder au contenu</h2>' +

                'SCMS est gratuit et pour que ce CMS reste gratuit, nous utilisons la publicité sur les sites créés avec SCMS. En désactivant votre bloqueur de pub, vous aidez le développement de SCMS.'
                
            );
         }
        testAd.remove();
        
    }, 500);
});

</script>

<?php
}
?>


