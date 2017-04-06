$(".edit-element-button").click(function () {
    navigate($(this).get(0).getAttribute("data-id"));
});

function navigate(pos){
    window.location.href = window.location.href.replace('edit_page', "edit_elem") + "&id=" + pos;
}
