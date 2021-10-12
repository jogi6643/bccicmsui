$(document).ready(function () {
    $("#articles button#collapsesidebar-btn").click(function () {
        $('#articles #collapsingsidebar').toggleClass("collapse-deactive");
        $('#articles section.body').toggleClass("collapse-deactive");
        $("#articles button#collapsesidebar-btn span").text(function (i, v) {
            return v === 'Expand sidebar' ? ' Collapse sidebar' : 'Expand sidebar'
        });
    }); 
});
