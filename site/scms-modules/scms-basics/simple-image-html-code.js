if(this.childNodes[0] != undefined && this.childNodes[0].classList.contains("scms-centred-element")){
var e = this.childNodes[0];
$(e).child("img").addClass('scms-simple-image').get(0).src = "scms-modules/scms-basics/basic.jpg";
must_reload = true;
$('#scms-get-json').click();
}






