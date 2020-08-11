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
            <img class="card-img-top" src="<?php echo $banner;?>" width="300" height="200" alt="">
          </a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
             <?php echo wp_trim_words( get_the_excerpt(), 50); ?>
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
    }else if($col==4){
    ?>
    <div class="row">
    <?php
    $nRow = 1;

    while ( have_posts() ) : the_post();  
    if( $nRow <= ($row * 4) )
    {      
      $banner = get_the_post_thumbnail_url(get_the_ID());
    ?>  
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card h-100">
          <a href="<?php echo the_permalink(); ?>">
            <img class="card-img-top" src="<?php echo $banner;?>" width="150" height="150" alt="">
          </a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
             <?php echo wp_trim_words( get_the_excerpt(), 20); ?>
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

if(!function_exists("orangutantheme_cardlayout_frontend"))
{
function orangutantheme_cardlayout_frontend($section, $col, $row)
{
  $details = get_option('orut_layout_details_section'. $section);
  
  if(!empty($details))
  {
    $details = (array)unserialize($details);
    
    $itemLimit = $col * $row;
    $nItem = 1;

    if( $col == 1 ){
      foreach($details as $detail)
      {
        if( $nItem > $itemLimit ) break;

        $detail = (array)$detail;
      ?>
       <div class="row">
        <div class="col-lg-12 portfolio-item">
        <div class="card h-100">
          <a href="<?php echo $detail["link"];?>"><img class="card-img-top" src="<?php echo $detail["image"];?>" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="<?php echo $detail["link"];?>"><?php echo $detail["heading"];?></a>
            </h4>
            <?php echo $detail["desc"];?>
          </div>
        </div>
        </div>
        </div>     
        <?php
        $nItem++;
      }
    }else if( $col == 2 ){
       ?>
      <div class="row">
      <?php
      foreach($details as $detail)
      {
        if( $nItem > $itemLimit ) break;

        $detail = (array)$detail;
      ?>
      <div class="col-lg-6 portfolio-item">
        <div class="card h-100">
          <a href="<?php echo $detail["link"];?>"><img class="card-img-top" src="<?php echo $detail["image"];?>" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="<?php echo $detail["link"];?>"><?php echo $detail["heading"];?></a>
            </h4>
            <?php echo $detail["desc"];?>
          </div>
        </div>
      </div>
      <?php
        $nItem++;
      }
      ?>
      </div>     
      <?php       
      }else if( $col == 3 ){
       ?>
      <div class="row">
      <?php
      foreach($details as $detail)
      {
        if( $nItem > $itemLimit ) break;

        $detail = (array)$detail;
      ?>
      <div class="col-lg-4 portfolio-item">
        <div class="card h-100">
          <a href="<?php echo $detail["link"];?>"><img class="card-img-top" src="<?php echo $detail["image"];?>" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="<?php echo $detail["link"];?>"><?php echo $detail["heading"];?></a>
            </h4>
            <?php echo $detail["desc"];?>
          </div>
        </div>
      </div>
      <?php
        $nItem++;
      }
      ?>
      </div>     
      <?php  
      }else if( $col == 4 ){
       ?>
      <div class="row">
      <?php
      foreach($details as $detail)
      {
        if( $nItem > $itemLimit ) break;

        $detail = (array)$detail;
      ?>
      <div class="col-lg-3 portfolio-item">
        <div class="card h-100">
          <a href="<?php echo $detail["link"];?>"><img class="card-img-top" src="<?php echo $detail["image"];?>" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="<?php echo $detail["link"];?>"><?php echo $detail["heading"];?></a>
            </h4>
            <?php echo $detail["desc"];?>
          </div>
        </div>
      </div>
      <?php
        $nItem++;
      }
      ?>
      </div>     
      <?php  
      }//cek column
  }

}
}

if(!function_exists("orangutantheme_cardtitlelayout_frontend"))
{
function orangutantheme_cardtitlelayout_frontend($section, $col, $row)
{
  $details = get_option('orut_layout_details_section'. $section);
  
  if(!empty($details)){
    $details = (array)unserialize($details);
    
    $itemLimit = $col * $row;
    $nItem = 1;

    if($col==1){
      foreach($details as $detail)
      {
        if( $nItem > $itemLimit ) break;

        $detail = (array)$detail;
      ?>  
      <div class="row">
      <div class="col-lg-12 mb-4">
        <div class="card h-100">
          <h4 class="card-header"><?php echo $detail["heading"];?></h4>
          <div class="card-body">
            <?php echo $detail["desc"];?>
          </div>
          <div class="card-footer">
            <a href="<?php echo $detail["link"];?>" class="btn btn-primary"><?php echo $detail["button"];?></a>
          </div>
        </div>
      </div>      
      </div>
      <?php
        $nItem++;
      }
    }else if($col==2){
    ?>
      <div class="row">
    <?php  
      foreach($details as $detail)
      {
        if( $nItem > $itemLimit ) break;

        $detail = (array)$detail;
      ?>  
      <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <h4 class="card-header"><?php echo $detail["heading"];?></h4>
          <div class="card-body">
            <?php echo $detail["desc"];?>
          </div>
          <div class="card-footer">
            <a href="<?php echo $detail["link"];?>" class="btn btn-primary"><?php echo $detail["button"];?></a>
          </div>
        </div>
      </div>      
      <?php
        $nItem++;
      }
    ?>
      </div>
    <?php        
    }else if($col==3){
    ?>
      <div class="row">
    <?php  
      foreach($details as $detail)
      {
        if( $nItem > $itemLimit ) break;

        $detail = (array)$detail;
      ?>  
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <h4 class="card-header"><?php echo $detail["heading"];?></h4>
          <div class="card-body">
            <?php echo $detail["desc"];?>
          </div>
          <div class="card-footer">
            <a href="<?php echo $detail["link"];?>" class="btn btn-primary"><?php echo $detail["button"];?></a>
          </div>
        </div>
      </div>      
      <?php
        $nItem++;
      }
    ?>
      </div>
    <?php  
    }else if($col==4){
    ?>
      <div class="row">
    <?php  
      foreach($details as $detail)
      {
        if( $nItem > $itemLimit ) break;

        $detail = (array)$detail;
      ?>  
      <div class="col-lg-3 mb-4">
        <div class="card h-100">
          <h4 class="card-header"><?php echo $detail["heading"];?></h4>
          <div class="card-body">
            <?php echo $detail["desc"];?>
          </div>
          <div class="card-footer">
            <a href="<?php echo $detail["link"];?>" class="btn btn-primary"><?php echo $detail["button"];?></a>
          </div>
        </div>
      </div>      
      <?php
        $nItem++;
      }
    ?>
      </div>
    <?php  
    }//if col
  }//details are not empty
}
}

$section1_layout = get_option('orut_layout_section1');
$section1_grids = get_option('orut_gridsize_section1');
$title1 = get_option('orut_title_section1');
$section = "1";

$index = explode(";", $section1_grids);
$row = 1;
$col = 1;
if(isset($index[0])) $col = $index[0];
if(isset($index[1])) $row = $index[1];

if($section1_layout=="posts")
{
  orangutantheme_postlayout_frontend($col, $row);
}else if($section1_layout=="card")
{
  orangutantheme_cardlayout_frontend($section, $col, $row);
}else if($section1_layout=="card-with-title")
{
  orangutantheme_cardtitlelayout_frontend($section, $col, $row);
}

?>