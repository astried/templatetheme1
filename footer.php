 <?php wp_footer(); ?>

<?php
$tab = array();
$tab[0] = get_option('orut_layout_footer_tab1');                
$tab[1] = get_option('orut_layout_footer_tab2');                
$tab[2] = get_option('orut_layout_footer_tab3');                
$tablayout = get_option('orut_layout_footer_column');

$col = 12 / (int)$tablayout;
?>

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="row col-lg-12 mb-4">
    <?php
    for($i = 0; $i < $tablayout; $i++){
    ?>
    <div class="col-md-<?php echo $col; ?>">
        <p class="m-0 text-white"><?php echo $tab[$i];?></p>
      </div>
    <?php	
    }
    ?>

    </div>
    
  </footer>

</body>

</html>
