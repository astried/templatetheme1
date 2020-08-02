$j = jQuery.noConflict();
var wineditor_caller = "";

$j(document).ready(function( $ ) {

    $('#orut-postbanner-upload').click(function() {
       formfield = $('#orangutantheme_postbanner').attr('name');
       wineditor_caller = "orangutantheme_postbanner";

       tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
       return false;
    });

    window.send_to_editor = function(html) {
       imgurl = $('img',html).attr('src');
       $('#'+ wineditor_caller ).val(imgurl);
       tb_remove();
    }

    $(".orut-uploader").click(function() {
      var myname = $(this).attr("name");
       formfield = $('#orut-img-' + myname).attr('name');
       wineditor_caller = "orut-img-" + myname;

       tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
       return false;
    });

});