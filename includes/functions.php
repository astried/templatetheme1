<?php
if(!function_exists("orangutantheme_nav_menu"))
{
function orangutantheme_nav_menu($name)
{
  global $wpdb;

  $menuLocations = get_nav_menu_locations(); // Get our nav locations (set in our theme, usually functions.php)                                         // This returns an array of menu locations ([LOCATION_NAME] = MENU_ID);
  $menuID = $menuLocations[$name]; // Get the *primary* menu ID
  $primaryNav = wp_get_nav_menu_items($menuID); // Get the array of wp objects, the nav items for our queried location.

  $menus = array();
  $menu_child = array();

  $sql = "SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key = %s AND meta_value = %s";

  foreach ( $primaryNav as $navItem )
  {
      $navid = $navItem->ID;
      $menus[$navid]['ID']   = $navid;
      $menus[$navid]['url']   = $navItem->url;
      $menus[$navid]['title'] = $navItem->title;
      $menus[$navid]['parent'] = $navItem->menu_item_parent;

      $menu_child[$navid] = array();
      
      $child_items = $wpdb->get_results( $wpdb->prepare($sql, '_menu_item_menu_item_parent', $navid), ARRAY_A );

      if(!empty($child_items))
      {
        $i = 0;
        foreach($child_items as $ch_item){
          if(!in_array($ch_item['post_id'], $menu_child[$navid] ) )
          {
            $menu_child[$navid][] = $ch_item['post_id'];
            $i++;
          }
        }
      }

  }//foreach

?>
  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top <?php if(is_user_logged_in()) echo "is_logged"; ?> ">
    <div class="container">
      <a class="navbar-brand" href="<?php echo home_url(); ?>"><img src="<?php echo $image[0]; ?>" alt=""> <?php echo get_bloginfo('name'); ?></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <?php
          foreach ( $menus as $menuItem )
          {
            if(empty($menuItem['parent']))
            {
              $ID = $menuItem['ID'];
              $hasChild = false;

              if( isset($menu_child[$ID]) && count($menu_child[$ID]) > 0 ){
                $hasChild = true;
              }
            ?>
            <li class="nav-item <?php if($hasChild) echo "dropdown";?>">
              <a id="menu-<?php echo $ID; ?>" class="nav-link <?php if($hasChild) echo "dropdown-toggle";?>" href="<?php echo $menuItem['url'];?>" title="<?php echo $menuItem['title'];?>"  <?php if($hasChild) echo 'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';?> ><?php echo $menuItem['title'];?></a>
              
              <?php
              if($hasChild){
                $submenu_id = $menu_child[$ID];
              ?>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="menu-<?php echo $ID; ?>">
              <?php  
              
              foreach($submenu_id as $sb_id){
              ?>
                <a class="dropdown-item" href="<?php echo $menus[$sb_id]['url'];?>"><?php echo $menus[$sb_id]['title'];?></a>             
              <?php  
              }

              ?>
              </div>
              <?php  
              }
              ?>
            </li>
            <?php
            }
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>

<?php
}
}//orangutantheme_nav_menu

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