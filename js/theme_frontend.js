$j = jQuery.noConflict();
var wineditor_caller = "";

$j(document).ready(function( $ ) {

    $('#orangutan_comment-savebtn').click(function() {
        $('#orangutan_comment-savebtn').hide();
        $('#orangutan_comment-savebtn-loader').show();

        $.ajax({
            type  : "post",
            url   :  orutajax.url,
            data  : { action  : "orangutantheme_add_comment",
                      post_id : $("#orangutan_blogpost-id").val(),
                      user_id : $("#orangutan_blogpost-user-id").val(),
                      ip_address : $("#orangutan_blogpost-ipaddress").val(),
                      content : $("#orangutan_blogpost-comment").val(),
                      nonce   : orutajax.nonce 
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
          $('#orangutan_comment-savebtn').show();
          $('#orangutan_comment-savebtn-loader').hide();
        }, 2000);
    });

    $('.orangutan_comment-savebtn').click(function(){
        var myID = $(this).data( "targetid" );
        var myContent = $("#orangutan_comment-reply-"+myID).val();
        var myAttID = $(this).attr("id");
        
        $("#"+myAttID).hide();
        $("#"+myAttID+"-loader").show();

        $.ajax({
            type  : "post",
            url   :  orutajax.url,
            data  : { action  : "orangutantheme_reply_comment",
                      post_id : $("#orangutan_blogpost-id").val(),
                      user_id : $("#orangutan_blogpost-user-id").val(),
                      ip_address : $("#orangutan_blogpost-ipaddress").val(),
                      content : myContent,
                      parent  : myID,
                      nonce   : orutajax.nonce 
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
          $("#"+myAttID).show();
          $("#"+myAttID+"-loader").hide();
        }, 2000);        
    });

    $(".orangutan_comment-show").click(function(){
      var myID = $(this).attr("id");

      if($('#'+myID+'-reply').is(":visible")){
        $('#'+myID+'-reply').hide();
        $('#'+myID).find("span").text("Reply");
      }else{
        $('#'+myID+'-reply').show();
        $('#'+myID).find("span").text("Close Reply");
      }
    });

});