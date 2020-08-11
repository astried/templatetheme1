<?php

function test_comment()
{
  $time = current_time('mysql');
  $data = array(
        'comment_post_ID' => 50,
        'comment_author' => 'HOLA',
        'comment_author_email' => '',
        'comment_author_url' => '',
        'comment_content' => 'WHATS UP PEOPLE',
        'comment_type' => '',
        'comment_parent' => 0,
        'user_id' => 5,
        'comment_author_IP' => '127.0.0.1',
        'comment_agent' => 'egysp.com',
        'comment_date' => $time,
         'comment_approved' => 1,
      );

  wp_insert_comment($data);
}

?>