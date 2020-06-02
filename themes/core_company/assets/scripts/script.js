$(function () {
    var time_efect = 400;

    $(".main_header_content_menu_mobile_obj").on("click", function () {
        $(".main_header_content_menu_mobile_sub").toggleClass("ds_none");
        $(this).toggleClass("main_header_content_menu_mobile_obj_active");

        if ($(this).hasClass("icon-menu")) {
            $(this).removeClass("icon-menu").addClass("icon-cross");
        } else if ($(this).hasClass("icon-cross")) {
            $(this).removeClass("icon-cross").addClass("icon-menu");
        }
    });
});