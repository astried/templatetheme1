<div class="orangutantheme_box">

   
    <div  class="orangutantheme_grid">
            <label for="orangutantheme_postbanner">Post Banner</label>
            <button id="orut-postbanner-upload">upload</button>
    </div>
     <div class="meta-options orangutantheme_field orangutantheme_grid">
        <input class="orangutantheme_grid" id="orangutantheme_postbanner" type="text" name="orangutantheme_postbanner" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'orangutantheme_postbanner', true ) ); ?>">
    </div>

    <div class="orangutantheme_grid">
    </div>
    <div class="orangutantheme_grid">
        <img src="<?php echo esc_attr( get_post_meta( get_the_ID(), 'orangutantheme_postbanner', true ) ); ?>">
    </div>

    <?php
    $widget = esc_attr( get_post_meta( get_the_ID(), 'orangutantheme_blogpost-widget', true ) );
    ?>
    <div class="orangutantheme_grid"><label for="orangutantheme_blogpost-widget" class="orangutantheme_grid">Post Widgets</label></div>
    <div class="orangutantheme_grid">
        <div class="meta-options orangutantheme_field">
        <select name="orangutantheme_blogpost-widget" class="orangutantheme_grid">
            <option value="">None</option>
            <option value="right" <?php if($widget=="right") echo "selected"; ?>>Right</option>
            <option value="left" <?php if($widget=="left") echo "selected"; ?>>Left</option>
        </select>
        </div>
    </div>

    <?php
    $commentOn = esc_attr( get_post_meta( get_the_ID(), 'orangutantheme_blogpost-comments', true ) );
    ?>
    <div class="orangutantheme_grid"><label class="orangutantheme_grid">Comments</label></div>
    <div class="orangutantheme_grid">
         <div class="meta-options orangutantheme_field">
            <label class="orut-field-post-radio"><input <?php if($commentOn=="on") echo "checked";?> type="radio" value="on" name="orangutantheme_blogpost-comments"> ON</label>
            <label class="orut-field-post-radio"><input <?php if($commentOn!="on") echo "checked";?> type="radio" value="off" name="orangutantheme_blogpost-comments"> OFF</label>
        </div>
    </div>
</div>