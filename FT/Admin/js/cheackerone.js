$(document).ready(function() {

    $(".cbox").on("click", function() {
        var numberOfChecked = $('input.cbox:checkbox:checked').length;
        if (numberOfChecked > 1) {
            $(this).prop('checked', false);
        }
    });

});