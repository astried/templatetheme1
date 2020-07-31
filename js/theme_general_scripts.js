$j = jQuery.noConflict();

$j(document).ready(function( $ ) {

    $('#orut-postbanner-upload').click(function() {
       formfield = $('#orangutantheme_postbanner').attr('name');
       tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
       return false;
    });

    window.send_to_editor = function(html) {
       imgurl = $('img',html).attr('src');
       $('#orangutantheme_postbanner').val(imgurl);
       tb_remove();
    }

});