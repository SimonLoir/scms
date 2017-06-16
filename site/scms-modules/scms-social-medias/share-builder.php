<?php $num = rand(2,2000000); ?>
<div class="scms-share-icons-div div<?= $num ?> style-simple-band" style="background:#333;">
<div class="scms-centred-element">
<img src="scms-modules/scms-social-medias/share_icons/Twitter-circle.svg" class="twitter">
<img src="scms-modules/scms-social-medias/share_icons/Facebook-circle.svg" class="facebook">
<img src="scms-modules/scms-social-medias/share_icons/Linkedin-circle.svg" class="linkedin">
<img src="scms-modules/scms-social-medias/share_icons/Skype-circle.svg" class="skype">
</div>
<style>
.scms-share-icons-div.div<?= $num ?> img{
height: 50px;
margin-left: 15px;margin-right: 15px;
cursor:pointer;
transition:3s;
}
.scms-share-icons-div.div<?= $num ?> img:hover{
transform:rotateX(360deg);
}
</style>
<script>
$(document).ready(function () {
$('.scms-share-icons-div.div<?= $num ?> .twitter').click(function() {
var url = "http://www.twitter.com/intent/tweet?text= &url=" + encodeURIComponent(window.location.href) + '&via=Simon_Loir';
window.open(url, 'partage', 'scrollable=yes');
});
$('.scms-share-icons-div.div<?= $num ?> .facebook').click(function() {
var url = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
window.open(url, 'partage', 'scrollable=yes');
});
$('.scms-share-icons-div.div<?= $num ?> .linkedin').click(function() {
var url = "https://www.linkedin.com/shareArticle?url=" + encodeURIComponent(window.location.href);
window.open(url, 'partage', 'scrollable=yes');
});
$('.scms-share-icons-div.div<?= $num ?> .skype').click(function() {
var url = "https://web.skype.com/share?url=" + encodeURIComponent(window.location.href);
window.open(url, 'partage', 'scrollable=yes');
});
})
</script>
</div>



