<?php get_header(); ?>

<?php
$page_id = get_the_ID(); //Page ID
$page_data = get_page( $page_id ); 

$banner = get_post_meta( $page_id, 'oranguttheme1_postbanner', true );
$content = apply_filters('the_content', $page_data->post_content);

$author_id = get_post_field ('post_author',$page_id);
$display_name = get_the_author_meta( 'display_name' , $author_id ); 
?>


<?php get_footer(); ?>