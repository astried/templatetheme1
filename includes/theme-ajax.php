<?php
if (session_status() == PHP_SESSION_NONE){
    session_start();
}

if ( !defined( 'ABSPATH' ) ) exit;

//if is_admin
if( is_user_logged_in() && is_admin() ){

      $ajax_admin_list = array( "orangutantheme_save_sliders",
                                "orangutantheme_update_section_layout",
                                "orangutantheme_update_section_list"
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

      if(!function_exists("orangutantheme_update_section_list")){
      function orangutantheme_update_section_list(){
            $response = array( "code" => "",
                              "message" => "",
                              "result" => ""
                              );

            $nonce = sanitize_text_field($_POST['nonce']);
                      
            if( !wp_verify_nonce( $nonce, 'orangutantheme-admin-nonce' ) ){
                  $response['code'] = "500";
                  $response['message'] = "nonce is not recognize";
            }else{
                  $section_number = sanitize_text_field($_POST['section_number']);
                  $section_list = $_POST['section_items'];

                  $cleaned_items = array();

                  if(!empty($section_list)){
                        $section_list = (array)$section_list;

                        foreach($section_list as $list_item){
                              $list_item = (array)$list_item;

                              if( isset($list_item['image']) && isset($list_item['heading']) 
                                    && isset($list_item['desc']) && isset($list_item['button']) 
                                    && isset($list_item['link'])
                              )
                              {
                                    $cleanedItem = array();
                                    $cleanedItem['image'] = sanitize_text_field($list_item['image']);
                                    $cleanedItem['heading'] = sanitize_text_field($list_item['heading']);
                                    $cleanedItem['desc'] = sanitize_text_field($list_item['desc']);
                                    $cleanedItem['button'] = sanitize_text_field($list_item['button']);
                                    $cleanedItem['link'] = sanitize_text_field($list_item['link']);

                                    $cleaned_items[] = $cleanedItem;
                              }
                        }//foreach


                        update_option('orut_layout_details_section'.$section_number, serialize($cleaned_items));
                  }else{
                      update_option('orut_layout_details_section'.$section_number, "");      
                  }                  
            }//else nonce

            echo json_encode($response);
      }
      }

      foreach( $ajax_admin_list as $ajax_caller )
      {
          add_action( "wp_ajax_" . $ajax_caller, $ajax_caller );
      }

}//if is_admin
else if ( ! is_admin() ) 
{

}

      if(!function_exists("orangutantheme_add_comment")){
      function orangutantheme_add_comment()
      {
            $response = array( "code" => "",
                              "message" => "",
                              "result" => ""
                              );

            $nonce = sanitize_text_field($_POST['nonce']);
                      
            if( !wp_verify_nonce( $nonce, 'orangutantheme-nonce' ) ){
                  $response['code'] = "500";
                  $response['message'] = "nonce is not recognize";
            }else{            

                  $time = current_time('mysql');
                  
                  $userid = sanitize_text_field($_POST['user_id']);
                  $url = "";
                  $email = "";
                  $userlogin = "";

                  $WPUser = get_userdata( $userid );

                  if(!empty($WPUser))
                  {
                        $url = $WPUser->data->user_url;
                        $email = $WPUser->data->user_email;
                        $userlogin =  $WPUser->data->user_login;
                  }

                  $data = array(
                        'comment_post_ID' => sanitize_text_field($_POST['post_id']),
                        'comment_author' => $userlogin,
                        'comment_author_email' => $email,
                        'comment_author_url' => $url,
                        'comment_content' => sanitize_text_field($_POST['content']),
                        'comment_type' => '',
                        'comment_parent' => 0,
                        'user_id' => $userid,
                        'comment_author_IP' => sanitize_text_field($_POST['ip_address']),
                        'comment_agent' => '',
                        'comment_date' => $time,
                        'comment_approved' => 0,
                  );

                  wp_insert_comment($data);
            }

            echo json_encode($response);
            wp_die();   
      }
      }

      if(!function_exists('orangutantheme_reply_comment')){
      function orangutantheme_reply_comment()
      {
            $response = array( "code" => "",
                              "message" => "",
                              "result" => ""
                              );

            $nonce = sanitize_text_field($_POST['nonce']);
                      
            if( !wp_verify_nonce( $nonce, 'orangutantheme-nonce' ) ){
                  $response['code'] = "500";
                  $response['message'] = "nonce is not recognize";
            }else{            

                  $time = current_time('mysql');
                  
                  $userid = sanitize_text_field($_POST['user_id']);
                  $url = "";
                  $email = "";
                  $userlogin = "";

                  $WPUser = get_userdata( $userid );

                  if(!empty($WPUser))
                  {
                        $url = $WPUser->data->user_url;
                        $email = $WPUser->data->user_email;
                        $userlogin =  $WPUser->data->user_login;
                  }

                  $data = array(
                        'comment_post_ID' => sanitize_text_field($_POST['post_id']),
                        'comment_author' => $userlogin,
                        'comment_author_email' => $email,
                        'comment_author_url' => $url,
                        'comment_content' => sanitize_text_field($_POST['content']),
                        'comment_type' => '',
                        'comment_parent' => sanitize_text_field($_POST['parent']),
                        'user_id' => $userid,
                        'comment_author_IP' => sanitize_text_field($_POST['ip_address']),
                        'comment_agent' => '',
                        'comment_date' => $time,
                        'comment_approved' => 0,
                  );

                  wp_insert_comment($data);
            }

            echo json_encode($response);
            wp_die();   
      }            
      }

      $ajax_list = array( 'orangutantheme_add_comment',
                          'orangutantheme_reply_comment'
                        );

      foreach( $ajax_list as $ajax_caller )
      {
          add_action( "wp_ajax_" . $ajax_caller, $ajax_caller );
          add_action( "wp_ajax_priv_" . $ajax_caller, $ajax_caller );
      }
?>