jQuery(function($){
    $(".lat-tab").not(":first-child").hide();

    $(".lat-nav-tab").on("click",function () {
        var activeId = $(this).attr("href");

        $(".nav-tab-active").removeClass("nav-tab-active");
        $(this).addClass("nav-tab-active");

        $(".lat-tab").hide();
        $(activeId).show();

        return false;
    });
});