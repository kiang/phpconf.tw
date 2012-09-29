$(function() {
    $('#show-archive-news').click(function() {
        var $hideArchiveNews = $('#hide-archive-news');

        $('article.news-archive').show();

        if ($hideArchiveNews.hasClass('hidden')) {
            $hideArchiveNews.removeClass('hidden');
        }
        $(this).addClass('hidden');

        return false;
    });

    $('#hide-archive-news').click(function() {
        var $showArchiveNews = $('#show-archive-news');

        $('article.news-archive').hide();

        if ($showArchiveNews.hasClass('hidden')) {
            $showArchiveNews.removeClass('hidden');
        }
        $(this).addClass('hidden');

        return false;
    });
});