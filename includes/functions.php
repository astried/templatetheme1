<?php
if(!function_exists("orangutantheme_postlayout_frontend"))
{
function orangutantheme_postlayout_frontend($col, $row)
{
  if ( have_posts() ) :
    $classNum = 12;

    if($col==1)
    {

    $nRow = 1;

    while ( have_posts() ) : the_post();  
    if($nRow <= $row)
    {      
      $banner = get_the_post_thumbnail_url(get_the_ID());
    ?>
    <!-- Blog Post -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-md-7">
            <a href="<?php echo the_permalink(); ?>">
              <img class="img-fluid rounded mb-3 mb-md-0" src="<?php echo $banner;?>" width="700" height="300" alt="">
            </a>
          </div>
          <div class="col-md-5">
            <h3><?php the_title(); ?></h3>
            <?php wp_trim_words( the_excerpt(), 100); ?>
            <a class="btn btn-primary" href="<?php echo the_permalink(); ?>">View Project
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div>
        </div>   
    </div>
      <div class="card-footer text-muted">
        <?php the_date(); ?> by
        <a href="#"><?php the_author(); ?></a>
      </div>    
  </div>
    <!-- /.row -->
       
    <?php  
        $nRow++;
    }else{
      break; 
    }
    endwhile;

    }else if($col==2){
    ?>
    <div class="row">
    <?php
    $nRow = 1;

    while ( have_posts() ) : the_post();  
    if( $nRow <= ($row * 2) )
    {      
      $banner = get_the_post_thumbnail_url(get_the_ID());
    ?>  
      <div class="col-lg-6 portfolio-item">
        <div class="card h-100">
          <a href="<?php echo the_permalink(); ?>">
            <img class="card-img-top" src="<?php echo $banner;?>" width="700" height="400" alt="">
          </a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
             <?php wp_trim_words( the_excerpt(), 100); ?>
          </div>
        </div>
      </div>
    <?php
        $nRow++;
    }else{
      break; 
    }
    endwhile;    
    ?>  
    </div>
    <?php
    }else if($col==3){
    ?>
    <div class="row">
    <?php
    $nRow = 1;

    while ( have_posts() ) : the_post();  
    if( $nRow <= ($row * 3) )
    {      
      $banner = get_the_post_thumbnail_url(get_the_ID());
    ?>  
      <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100">
          <a href="<?php echo the_permalink(); ?>">
            <img class="card-img-top" src="<?php echo $banner;?>" width="700" height="400" alt="">
          </a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
             <?php wp_trim_words( the_excerpt(), 100); ?>
          </div>
        </div>
      </div>
    <?php
        $nRow++;
    }else{
      break; 
    }
    endwhile;    
    ?>  
    </div>
    <?php
    }      

  endif;
}
}

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