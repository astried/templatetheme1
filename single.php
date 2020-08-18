<?php get_header(); ?>

<?php

$post_id = get_the_ID(); 
$user_id = "";
$ipaddress = "";

if(is_user_logged_in()){
  $user_id = get_current_user_id();
}

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
  $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
  $ipaddress = $_SERVER['REMOTE_ADDR'];
}  

$banner = get_post_meta( $post_id, 'orangutantheme_postbanner', true );
$blogWidget = get_post_meta( $post_id, 'orangutantheme_blogpost-widget', true );
$isComment = get_post_meta( $post_id, 'orangutantheme_blogpost-comments', true);

$isWidget = false;

if( $blogWidget=='left' || $blogWidget=='right' ){
  $isWidget = true;
}

$title = get_the_title($post_id); 
$author_id = get_post_field ('post_author', $post_id);
$display_name = get_the_author_meta( 'display_name' , $author_id ); 

?>

  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3"><?php echo $title;?>
      <small>by
        <a href="#"><?php echo $display_name;?></a>
      </small>
    </h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo home_url(); ?>">Home</a>
      </li>
      <li class="breadcrumb-item active"><?php echo $title;?></li>
    </ol>

    <div class="row">

      <?php 
      if($blogWidget=='left'):


      if ( is_active_sidebar( 'sidebar-3' ) ) :
      ?>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
          <?php dynamic_sidebar( 'sidebar-3' ); ?>
        <?php endif; ?>

        <?php  
        endif;
      ?>
      <!-- Sidebar Widgets Column -->
      </div>
      
      <?php
      endif;
      ?>      
  

      <!-- Post Content Column -->
      <div class="<?php if($isWidget) echo "col-lg-8"; else echo "col-lg-12"?>">

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="<?php echo $banner;?>" alt="">

        <hr>

      <?php
      		query_posts('p='.$post_id);

      		while (have_posts()) : the_post();
      	?>
              <!-- Date/Time -->
              <p>Posted on <?php the_date(); ?> , <?php the_time(); ?></p>

              <hr>

              <!-- Post Content -->
              <?php the_content(); ?>  

              <hr>
      	<?php		
      		endwhile;
      ?>
      
      <!-- Comments Form -->      
      <?php if($isComment=="on"): 
      ?>
        <input type="hidden" id="orangutan_blogpost-id" value="<?php echo $post_id;?>">
        <input type="hidden" id="orangutan_blogpost-user-id" value="<?php echo $user_id;?>">
        <input type="hidden" id="orangutan_blogpost-ipaddress" value="<?php echo $ipaddress;?>">

        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <div class="form-group">
              <textarea id="orangutan_blogpost-comment" class="form-control" rows="3"></textarea>
            </div>
            <button id="orangutan_comment-savebtn" class="btn btn-primary">Submit</button>
            <span id="orangutan_comment-savebtn-loader" style="display:none;">sending <img src="<?php echo get_template_directory_uri() . "/images/loader.gif";?>"></span>
          </div>
        </div>
        <hr><br>

      <?php
        $comments = get_comments(array(
          'post_id' => $post_id,
           'status' => 'approve'
        ));

        $ori_comment = array(); $i = 0;
        $reply_comment = array();
        $comment_reply = array();

        foreach($comments as $comment)
        {
          $userid = $comment->user_id;
          $author = $comment->comment_author;
          $content = $comment->comment_content;
          $id = $comment->comment_ID;
          $parent = $comment->comment_parent;

          if( !empty($parent) ){
            if( !isset($comment_reply[$parent]) ){
              $comment_reply[$parent] = array();
            }

            $comment_reply[$parent][] = $id;

            $reply_comment[$id] = array();
            $reply_comment[$id]['userid'] = $userid;
            $reply_comment[$id]['author'] = $author;
            $reply_comment[$id]['content'] = $content;
            $reply_comment[$id]['id'] = $id;
            
          }//if not empty parent
          else{
            $ori_comment[$i] = array();
            $ori_comment[$i]['userid'] = $userid;
            $ori_comment[$i]['author'] = $author;
            $ori_comment[$i]['content'] = $content;
            $ori_comment[$i]['id'] = $id;
            $i++; 
          }
        }

        //rsort($ori_comment);

        foreach($ori_comment as $comment)
        {
          $userid = $comment['userid'];
          $avatar = get_avatar_url( $userid );

          $id = $comment['id'];

          if(empty($avatar)){
            $avatar = "http://placehold.it/50x50";
          }
        ?>
        <!-- Single Comment -->
        <div class="media mb-4">
          <img class="d-flex mr-3 avatar-img rounded-circle" src="<?php echo $avatar;?>" alt="<?php echo $comment['author'];?>">
          <div class="media-body">
            <h5 class="mt-0"><?php echo $comment['author']; ?></h5>
            <div class="row">
              <div class="col-lg-12 mb-4">
                <?php echo esc_html($comment['content']); ?>
              </div>            
            </div>  

            <?php
            if( isset($comment_reply[$id]) && (count($comment_reply[$id]) > 0) ){
              $replies = (array)$comment_reply[$id];
              sort($replies);

              foreach($replies as $replyid)
              {
                if(isset($reply_comment[$replyid]))
                {
                  $userid = $reply_comment[$replyid]['userid'];
                  $avatar = get_avatar_url( $userid );
                  ?>
                  <!--Replies-->
                  <div class="media mb-4">
                    <img class="d-flex mr-3 avatar-img rounded-circle" src="<?php echo $avatar;?>" alt="<?php echo $reply_comment[$replyid]['author'];?>">
                    <div class="media-body">
                      <h5 class="mt-0"><?php echo $reply_comment[$replyid]['author']; ?></h5>
                      <div class="row">
                        <div class="col-lg-12 mb-4">
                          <?php echo esc_html($reply_comment[$replyid]['content']); ?>
                        </div>
                      </div>  
                    </div>
                  </div>
                  <!--Replies-->
                  <?php
                }//if isset
              }
            }
            ?>

            <div class="row">
            <div class="col-lg-12 mb-4">
                <button id="orangutan_comment-<?php echo $id;?>" class="btn btn-default orangutan_comment-show"><span>Reply</span> <i class="fa fa-comments-o" aria-hidden="true"></i></button>
            </div>  
              <div id="orangutan_comment-<?php echo $id;?>-reply" style="display:none;" class="comment-reply card my-4">
                <div class="card-body">
                  <div class="form-group">
                    <textarea id="orangutan_comment-reply-<?php echo $comment['id'];?>" class="form-control" rows="3"></textarea>
                  </div>
                  <button id="orangutan_replybtn-<?php echo $comment['id'];?>" data-targetid="<?php echo $comment['id'];?>" class="orangutan_comment-savebtn btn btn-primary">Reply</button>
                  <span id="orangutan_replybtn-<?php echo $comment['id'];?>-loader" style="display:none;">sending <img src="<?php echo get_template_directory_uri() . "/images/loader.gif";?>"></span>
                </div>
              </div>              
            </div>

          </div>
        </div>        
        <?php  
        }

      ?>        
    <?php endif; ?>
      <!--end comments-->

      </div>

      <?php 
      if($blogWidget=='right'):
      ?>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

      <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
          <?php dynamic_sidebar( 'sidebar-3' ); ?>
      <?php endif; ?>

      </div>
      <?php
      endif;
      ?>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

<?php get_footer(); ?>