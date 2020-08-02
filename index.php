<?php get_header(); ?>

<?php
/*SECTION1*/
$section1_layout = get_option('orut_layout_section1');
$section1_grids = get_option('orut_gridsize_section1');
$title1 = get_option('orut_title_section1');;

$index = explode(";", $section1_grids);
$row = 1;
$col = 1;
if(isset($index[0])) $col = $index[0];
if(isset($index[1])) $row = $index[1];

?>

 <!-- Page Content -->
  <div class="container">

    <h1 class="my-4"><?php echo $title1;?></h1>
    <?php
    if($section1_layout=="posts"){
      orangutantheme_postlayout_frontend($col, $row);
    }
    ?>

    <hr>

<?php get_footer(); ?>4 agustis