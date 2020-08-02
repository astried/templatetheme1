<?php
if (session_status() == PHP_SESSION_NONE){
    session_start();
}

if ( !defined( 'ABSPATH' ) ) exit;

//if is_admin
if( is_user_logged_in() && is_admin() ){

$ajax_admin_list = array( "orangutantheme_save_sliders",
                              "orangutantheme_update_section_layout"
				);

if(!function_exists("orangutantheme_save_sliders")){
      function orangutantheme_save_sliders()
	{
		$response = array( "code" => "",
								"message" => "",
								"result" => ""
							);

			//Check the nonce
            $nonce = sanitize_text_field($_POST['nonce']);
                
            if( !wp_verify_nonce( $nonce, 'orangutantheme-admin-nonce' ) ){
            	$response['code'] = "500";
            	$response['message'] = "nonce is not recognize";
            }else{

            	$saved_sliders = get_option('orut_frontend_sliders');

            	$new_sliders = array();
            	$sent_sliders = array();
            	$i = 0;

            	foreach((array)$_POST['sliders'] as $slide){
            		$slide = (array)$slide;

            		$sent_sliders[$i] = array( "title" => sanitize_text_field($slide[0]),
            									"subtitle" => sanitize_text_field($slide[1]),
            									"image" => sanitize_text_field($slide[2])
            								);
            		$i++;
            	}

            	if( empty($sent_sliders) ){
	            	$new_sliders = "";
            	}else{
            		$new_sliders = serialize($sent_sliders);
            	}

            	if( !$saved_sliders  ){
            		add_option('orut_frontend_sliders', $new_sliders);
            	}else{
            		update_option('orut_frontend_sliders', $new_sliders);
            	}

            	$response['code'] = "200";
            	$response['message'] = "ok";
            	$response['result'] = $sent_sliders;
            }

            echo json_encode($response);
		wp_die();
	}
}

if(!function_exists("orangutantheme_update_section_layout")){
function orangutantheme_update_section_layout()
{
      $response = array( "code" => "",
                        "message" => "",
                        "result" => ""
                        );

      $nonce = sanitize_text_field($_POST['nonce']);
                
      if( !wp_verify_nonce( $nonce, 'orangutantheme-admin-nonce' ) ){
            $response['code'] = "500";
            $response['message'] = "nonce is not recognize";
      }else{

            $sect_num = sanitize_text_field($_POST['section_number']);
            $sect_layout = sanitize_text_field($_POST['section_layout']);
            $sect_col = sanitize_text_field($_POST['section_column']);
            $sect_row = sanitize_text_field($_POST['section_row']);

            update_option('orut_title_section' . $sect_num , sanitize_text_field($_POST['title']) );
            update_option('orut_layout_section' . $sect_num , $sect_layout);
            update_option('orut_gridsize_section' . $sect_num , $sect_col . ";" . $sect_row );
      }


      echo json_encode($response);
      wp_die();      
}// endfunc orangutantheme_update_section_layout
}

foreach( $ajax_admin_list as $stripe_ajax_gateway_call )
{
    add_action("wp_ajax_".$stripe_ajax_gateway_call, $stripe_ajax_gateway_call );
}

}//if is_admin

?>