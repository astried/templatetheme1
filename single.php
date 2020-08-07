<?php get_header(); ?>

<?php

$post_id = get_the_ID(); 

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
      ?>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card mb-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="inpug-group-append">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">Web Design</a>
                  </li>
                  <li>
                    <a href="#">HTML</a>
                  </li>
                  <li>
                    <a href="#">Freebies</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">JavaScript</a>
                  </li>
                  <li>
                    <a href="#">CSS</a>
                  </li>
                  <li>
                    <a href="#">Tutorials</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
          </div>
        </div>

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
      <?php if($isComment=="on"): ?>
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form>
              <div class="form-group">
                <textarea class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

      <?php

        $comments = get_comments(array(
          'post_id' => $post_id,
           'status' => 'approve'
        ));

        foreach($comments as $comment) {
        ?>
        <!-- Single Comment -->
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0"><?php echo $comment->comment_author; ?></h5>
            <?php echo esc_html($comment->comment_content); ?>
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

        <!-- Search Widget -->
        <div class="card mb-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="inpug-group-append">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">Web Design</a>
                  </li>
                  <li>
                    <a href="#">HTML</a>
                  </li>
                  <li>
                    <a href="#">Freebies</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">JavaScript</a>
                  </li>
                  <li>
                    <a href="#">CSS</a>
                  </li>
                  <li>
                    <a href="#">Tutorials</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
          </div>
        </div>

      </div>
      <?php
      endif;
      ?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

<?php get_footer(); ?>