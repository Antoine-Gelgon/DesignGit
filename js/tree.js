$(document).ready( function () {

  $(".dir").hide();

    $(".dirName").click( function () {
        if ($(this).next(".dir:visible").length != 0) {
            $(this).next(".dir").slideUp("normal");
            $(this).removeClass("dirNameClicked");
        }
        else {
            $(this).next(".dir").slideDown("normal");
            $(this).addClass("dirNameClicked");
        }
        return false;
    });

} ) ;
