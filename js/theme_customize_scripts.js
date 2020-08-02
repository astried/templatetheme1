$j = jQuery.noConflict();

$j(document).ready(function( $ ) {

    $("#orut-slider-unordered-list").sortable({
        placeholder: ".orut-slider-list div",
        helper    : "clone",
        revert    : true,
        forcePlaceholderSize: true,
        axis    : 'y',
        start: function (e, ui) {         
                },
        update: function (e, ui) {
                },
        stop: function(e, ui){
                 
                },
        received: function(e, ui){
                }
    });

    orut_sliderimage_toggle();

    $("#orut-btn-add-slider").click(function(){
    	var newheading = $("#orut-txt-heading").val();
    	var newsubheading = $("#orut-txt-heading").val();
    	var newimg = $("#orut-img-upload-slider").val();

    	$(".orut-slider-list-clone").clone().prependTo("#orut-slider-unordered-list");

    	var newthing = $("#orut-slider-unordered-list").find(".orut-slider-list-clone");
    	newthing.find(".orut-txt-heading").val(newheading);
    	newthing.find(".orut-txt-subheading").val(newsubheading);
        newthing.find(".orut-img-slider").attr("src",newimg);
        newthing.find(".orut-imgurl-slider").val(newimg);

    	newthing.removeClass("orut-slider-list-clone");
    	newthing.addClass("orut-slider-list");
    	newthing.show();

        orut_sliderimage_toggle();      
    });

    $('#orut-btn-upload-slider').click(function() {
       formfield = $('#orut-img-upload-slider').attr('name');
       wineditor_caller = "orut-img-upload-slider";

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

    $("#orut-btn-save-slider").click(function(){
        $("#orut-btn-save-slider").hide();
        $("#orut-btn-save-slider-load").show();

        var slider_list = orut_read_slider();

        $.ajax({
            type  : "post",
            url   :  orutajax.url,
            data  : {   action: "orangutantheme_save_sliders",
                        sliders : slider_list,
                        nonce : orutajax.nonce 
                    },
            success: function(resp)
                    {
                        var response = JSON.parse(resp);

                        if(response['code'] == '200' ){

                        }
                    },
            error: function(xhr, status, error)
                        {
                            console.log( error );
                        },
            complete : function(xhr, status, error)
                        {
                            orut_sliderimage_toggle();
                        }
        });        

        setTimeout(function(){ 
            $("#orut-btn-save-slider").show();
            $("#orut-btn-save-slider-load").hide();
        }, 2000);
    })

    $(".btn-save-layout").click(function(){
        var section_num = $(this).attr("data-section");
        var nav_section = "nav-section" + section_num;
        var layout_choice = "";

        $(".layout-choice-section" + section_num).each(function(){
            if( $(this).is(":checked") )
            {
                layout_choice = $(this).val();
            }
        });


        $.ajax({
            type  : "post",
            url   :  orutajax.url,
            data  : {   action: "orangutantheme_update_section_layout",
                        section_number : section_num,
                        section_layout : layout_choice,
                        section_column : $("#orut-num-col-section"+ section_num).val(),
                        section_row : $("#orut-num-row-section"+ section_num).val(),
                        nonce : orutajax.nonce 
                    },
            success: function(resp)
                    {
                        var response = JSON.parse(resp);

                        if(response['code'] == '200' ){

                        }
                    },
            error: function(xhr, status, error)
                        {
                            console.log( error );
                        },
            complete : function(xhr, status, error)
                        {
                            
                        }
        });           
    });

function orut_read_slider()
{
    var list = [];

    $(".orut-slider-list").each(function(){
        var heading = $(this).find(".orut-txt-heading").val();
        var subheading = $(this).find(".orut-txt-subheading").val();
        var imgurl = $(this).find(".orut-imgurl-slider").val();

        list.push([heading, subheading, imgurl]);
    });

    return list;
}

function orut_sliderimage_toggle()
{
    $(".btn-show-slider-image").click(function(){
        $(this).closest(".orut-slider-list").find(".orut-img-div-slider").toggle();
    });

    $(".btn-remove-list").click(function(){
        $(this).closest(".orut-slider-list").remove();
    });         
}

});