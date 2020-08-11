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

    $("#orut-list-details-section1").sortable({
        placeholder: ".orut-list-details-section1 div",
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
    orut_upload_images();
    orut_section1_save();
    orut_section1_toggle();

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

        if(wineditor_caller=="orut-img-upload-slider"){
           $('#'+ wineditor_caller ).val(imgurl);        
        }else{
            alert(imgurl);
           $('#'+ wineditor_caller ).closet(".disp-section1-list").find(".orut-img-section1").val(imgurl);
        }
       
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

        $('#orut-btn-save-layout-section'+ section_num).hide();
        $('#orut-layout-loader'+ section_num).show();

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
                        title : $("#orut-txt-title-section"+ section_num).val(),
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

        setTimeout(function(){
                $('#orut-btn-save-layout-section'+ section_num).show();
                $('#orut-layout-loader'+ section_num).hide();    
            }, 2000
        );

    });

    $(".layout-choice").click(function(){
        var myValue = $(this).val();
        var mySection ="";

        if($(this).hasClass("layout-choice-section1")){
            mySection = "section1";
        }else if($(this).hasClass("layout-choice-section2")){
            mySection = "section2";
        }else if($(this).hasClass("layout-choice-section3")){
            mySection = "section3";   
        }

        if(myValue=="card"){
            $("#div-details-"+mySection).show();
            $("#orut-buttontext-"+mySection).attr("disabled","disabled");

            $("#orut-img-"+mySection).removeAttr("disabled");
            $("#orut-btn-image-"+mySection).removeAttr("disabled");

        }else if(myValue=="card-with-title"){

            $("#div-details-"+mySection).show();
            $("#orut-buttontext-"+mySection).removeAttr("disabled");

            $("#orut-img-"+mySection).attr("disabled","disabled");
            $("#orut-btn-image-"+mySection).attr("disabled","disabled");
            
        }else{
            $("#div-details-"+mySection).hide();
        }
    })

    $(".orut-btn-add-section").click(function(){
        var section = "";

        if($(this).hasClass("section1")){
            section = "1";
        }else if($(this).hasClass("section2")){
            section = "2";
        }else{
            section = "3";
        }

        var newheading = $("#orut-txt-heading-section"+section).val();
        var newdesc = $("#orut-txt-desc-section"+section).val();
        var newimg = $("#orut-img-section"+section).val();   
        var newbtntext = $("#orut-txt-btn-section"+section).val();
        var newurl = $("#orut-link-section"+section).val(); 
        
        $(".orut-list-details-section"+section+"-clone").clone().prependTo("#orut-list-details-section"+section);        
    
        var newthing = $("#orut-list-details-section"+section).find(".orut-list-details-section"+section+"-clone");

        newthing.find(".orut-txt-heading-section"+section).val(newheading);
        newthing.find(".orut-lbl-heading-section"+section).text(newheading);
        newthing.find(".orut-txt-desc-section"+section).val(newdesc);
        newthing.find(".orut-txt-btn-section"+section).val(newbtntext);
        newthing.find(".orut-link-section"+section).val(newurl);
        newthing.find(".orut-img-section"+section).val(newimg);
        newthing.find(".orut-disp-section"+section).attr("src",newimg);

        var num = Number($("#orut-list-length-section"+section).val()) + 1;
        newthing.find(".orut-img-list-uploader").attr("id", "orut-img-section"+section+"-"+num);
        newthing.find(".orut-img-section"+section).attr("id", "txt-orut-img-section"+section+"-"+num);

        $("#orut-list-length-section"+section).val(num);

        newthing.removeClass("orut-list-details-section"+section+"-clone");
        newthing.addClass("orut-list-details-section"+section);
        newthing.show();

        orut_section1_toggle();
        orut_upload_images();
    });

function orut_section1_toggle()
{
    $(".btn-toggle-section1-list").click(function(){
        $(this).closest(".orut-list-details-section1").find(".disp-section1-list").toggle();
    });    

    $(".btn-remove-section1-list").click(function(){
        $(this).closest(".orut-list-details-section1").remove();
    });  
}

function orut_read_list( section_number )
{
    var theList = [];
    var temp = {};

    if( $(".orut-list-details-section" + section_number).length > 0 ){
        $(".orut-list-details-section" + section_number).each(function(){
            temp = {};

            temp.image = $(this).find(".orut-img-section"+section_number).val();
            temp.heading = $(this).find(".orut-txt-heading-section"+section_number).val();
            temp.desc = $(this).find(".orut-txt-desc-section"+section_number).val();
            temp.button = $(this).find(".orut-txt-btn-section"+section_number).val();
            temp.link = $(this).find(".orut-link-section"+section_number).val();

            theList.push(temp);
        });
    }

    return theList;
}

function orut_section1_save()
{
    $("#orut-btn-details-section1").click(function(){
        var section_num = "1";
        var list_items = orut_read_list( section_num );

        $(this).hide();
        $("#orut-load-details-section1").show();

        $.ajax({
            type  : "post",
            url   :  orutajax.url,
            data  : {   action: "orangutantheme_update_section_list",
                        section_number : section_num,
                        section_items  : list_items,
                        section_column : $("#orut-num-col-section"+ section_num).val(),
                        section_row    : $("#orut-num-row-section"+ section_num).val(),
                        title : $("#orut-txt-title-section"+ section_num).val(),
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

        setTimeout(function(){
            $("#orut-btn-details-section1").show();
            $("#orut-load-details-section1").hide();                
        }, 2000);
    });  
}

function orut_upload_images()
{
    $(".orut-img-list-uploader").click(function() {
        var myID = $(this).attr("id");

        formfield = $(this).find('#txt--' + myID).attr('name');
        wineditor_caller = myID;

        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;        
    });

    $(".orut-uploader").click(function() {
        var section = $(this).attr("name");

        formfield = $(this).find('.orut-img-'+section).attr('name');
        wineditor_caller = $(this).attr("id");

        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;        
    });

    window.send_to_editor = function(html) {
       imgurl = $('img',html).attr('src');

        if(wineditor_caller=="orut-img-upload-slider"){
           $('#'+ wineditor_caller ).val(imgurl);        
        }else{
           $('#txt-'+ wineditor_caller ).val(imgurl);
        }
       
       tb_remove();
    }      
}

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