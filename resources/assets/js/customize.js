$(document).ready(function () {
    //Top slide aaa
    $("#top-slide").owlCarousel({
        singleItem: true,
        autoPlay: true,
        slideSpeed: 200,
        lazyLoad: true,
        stopOnHover: true,
        navigation: true,
        navigationText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>',
        ],
    });

    //Film-hot slide
    $("#film-hot").owlCarousel({
        items: 5,
        itemsTablet: [979, 4],
        itemsMobile: [479, 2],
        lazyLoad: true,
        navigation: true,
        scrollPerPage: true,
        slideSpeed: 800,
        paginationSpeed: 400,
        pagination: false,
        autoPlay: 8000,
        navigationText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>',
        ],
    });
    $(".block_slider").owlCarousel({
        items: 4,
        itemsTablet: [979, 4],
        itemsMobile: [479, 2],
        navigation: true, // Show next and prev buttons
        slideSpeed: 300,
        paginationSpeed: 400,
        stopOnHover: true,
        pagination: false,
        lazyLoad: true,
        navigationText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>',
        ],
    });
    //Lazyload image
    $("img.lazy").lazyload({
        effect: "fadeIn",
    });

    $("#btn_lightbulb").click(function () {
        var $this = $(this);
        var $overlay = '<div id="background_lamp"></div>';
        if ($this.hasClass("off")) {
            $this.removeClass("off");
            $this.attr("title", "Chế Độ Rạp Phim");
            $("#background_lamp").remove();
        } else {
            $this.addClass("off");
            $this.attr("title", "Tắt Chế Độ Rạp Phim");
            $("body").append($overlay);
        }
    });
    $("#btn_autonext").click(function () {
        var $this = $(this);
        if ($this.hasClass("active")) {
            $this.removeClass("active");
            $this.attr("title", "Chuyển Tập : Bật");
            autonext = false;
        } else {
            $this.addClass("active");
            $this.attr("title", "Chuyển Tập : Tắt");
            autonext = true;
        }
    });
    $("#link-report").click(function () {
        $.post(
            BASE_URL + "/ajax/error",
            {
                filmid: filmID,
                epid: episodeID,
            },
            function (data) {
                if (data) {
                    alert("Cảm ơn bạn đã báo lỗi");
                }
            }
        );
    });
});

$(document).ready(function () {
    wPlayer = $("#box-player").width();
    hPlayer = (wPlayer * 9) / 16;
    $("#media-player").height(hPlayer);
    $(window).resize(function () {
        playerw = $("#box-player").width();
        playerh = (playerw * 9) / 16;
        $("#box-player").height(playerh);
    });
});

var episodeID = parseInt(29762),
    filmID = parseInt(2175);
var svID = parseInt(0);

function next_link() {
    $elm = $(".list-episode a.current").parent().next();
    if ($elm.size() > 0) {
        var next_link = $("a", $elm).attr("href");
        if (typeof next_link != "undefined") {
            window.location.href = next_link;
        }
    }
}

$(document).ready(function () {
    var first_img_w = $(".img-film").eq(0).width();
    var first_img_h = first_img_w * 1.42;
    $(".img-film").height(first_img_h);
    $("img.lazy").lazyload({
        effect: "fadeIn",
    });
});
