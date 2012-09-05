$(document).ready(function () {
    updatePlurkBox();
    $(window).resize(function () {
        updatePlurkBox();
    });
});

function updatePlurkBox() {
    var plurkUrl = 'http://www.plurk.com/getWidget?uid=4114702&amp;h={{ height }}&amp;w={{ width }}&amp;u_info=2&amp;bg=cf682f&tl=cae7fd';
    var bodyWidth = $('body').css('width');
    var plurkBoxHeight = 0;
    var plurkBoxWidth = 0;
    switch (parseInt(bodyWidth)) {
        case 320:
            plurkBoxHeight = 430;
            plurkBoxWidth = 300;
            break;
        case 480:
            plurkBoxHeight = 430;
            plurkBoxWidth = 400;
            break;
        case 700:
            plurkBoxHeight = 430;
            plurkBoxWidth = 200;
            break;
        case 960:
            plurkBoxHeight = 430;
            plurkBoxWidth = 240;
            break;
        default:
            return;
    }

    plurkUrl = plurkUrl.replace('{{ height }}', plurkBoxHeight).replace('{{ width }}', plurkBoxWidth);
    $('#plurk-box iframe').attr('height', plurkBoxHeight);
    $('#plurk-box iframe').attr('width', plurkBoxWidth);
    $('#plurk-box iframe').attr('src', plurkUrl);
}
