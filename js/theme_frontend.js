$j = jQuery.noConflict();
var wineditor_caller = "";

$j(document).ready(function( $ ) {

    $('#orangutan_comment-savebtn').click(function() {

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

    });

});