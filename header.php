<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo get_bloginfo('name'); ?></title>
  
  <?php wp_head(); ?>

</head>

<body>

<?php

  $custom_logo_id = get_theme_mod( 'custom_logo' );
  $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

?>

  <header>
  
  <?php
    get_template_part( 'template-parts/nav-menu' );
  ?>

  <?php
  if(is_home()){

    $sliders = get_option('orut_frontend_sliders');
                                    
    if(!empty($sliders))
    {
      $sliders = (array)unserialize($sliders);
      $i = 0;
      ?>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      
      <ol class="carousel-indicators">        
      <?php
      foreach($sliders as $slide){
      ?>
        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>" class="<?php if($i==0) echo 'active';?>"></li>
      <?php  
        $i++;
      }
      ?>
      </ol>

      <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
      <?php
      $i = 0;

      foreach($sliders as $slide)
      {
      ?>
      <div class="carousel-item <?php if($i==0) echo 'active';?>" style="background-image: url('<?php echo $slide['image']; ?>')">
          <div class="carousel-caption d-none d-md-block">
            <h3><?php echo $slide['title']; ?></h3>
            <p><?php echo $slide['subtitle']; ?></p>
          </div>
        </div>
      <?php  
        $i++;
      }
      ?>
      </div>

      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <?php
    }
  }
  ?>

  </header>