$(document).ready(function () {
    var _btnBackToTop = $(".back-to-top");
    $(window).scroll(function () {
        var _scrollTop = $(window).scrollTop();
        if (_scrollTop > 72) {
            $("#main-menu").addClass("fix-nav");
            $(".caudoi").addClass("fix");
            _btnBackToTop.removeClass("hide");
            return false;
        } else {
            $("#main-menu").removeClass("fix-nav");
            _btnBackToTop.addClass("hide");
            $(".caudoi").removeClass("fix");
            return false;
        }
    });
    _btnBackToTop.click(function () {
        $("body,html").animate({ scrollTop: 0 }, 500);
    });
    $(".format-currency").on("keyup", function (e) {
        var $this = $(this);
        var fomarted = formatNumber($this.val());
        $this.val(fomarted);
    });
    $("#sub_email").keyup(function () {
        var key = event.keyCode || event.charCode;
        var mail = $(this).val();
        if (key != 8 && key != 46) {
            var pos_gmail = mail.indexOf("@g");
            var pos_yahoo_mail = mail.indexOf("@y");
            var pos_hot_mail = mail.indexOf("@h");
            if (
                (pos_gmail > 0 || pos_yahoo_mail) &&
                (pos_gmail == mail.length - 2 ||
                    pos_yahoo_mail == mail.length - 2 ||
                    pos_hot_mail == mail.length - 2)
            ) {
                if (pos_gmail > 0) {
                    mail = mail.substring(0, pos_gmail) + "@gmail.com";
                    $(this).val(mail);
                    return false;
                } else if (pos_yahoo_mail > 0) {
                    mail = mail.substring(0, pos_yahoo_mail) + "@yahoo.com";
                    $(this).val(mail);
                    return false;
                } else if (pos_hot_mail > 0) {
                    mail = mail.substring(0, pos_hot_mail) + "@hotmail.com";
                    $(this).val(mail);
                    return false;
                }
            }
        }
    });
});
function MakeSearch() {
    if (window.innerWidth <= 1000 && window.innerHeight <= 800) {
        var kw = $("#keyword").val();
    } else {
        var kw = $("#keyword").val();
    }
    kw = kw.toLowerCase();
    kw = kw.replace(
        /!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~/g,
        "-"
    );
    kw = kw.replace(/-+-/g, "-");
    kw = kw.replace(/^\-+|\-+$/g, "");
    if (kw == "") alert("Vui lòng nhập từ khóa !");
    else location.href = BASE_URL + "/tim-kiem/" + kw + ".html";
}
