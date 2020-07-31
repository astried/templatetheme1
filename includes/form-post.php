<div class="orangutantheme_box">
    <style scoped>
        .orangutantheme_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .orangutantheme_field{
            display: contents;
        }
        #orut-postbanner-upload{
            width: 200px;
        }
    </style>
    <p class="meta-options orangutantheme_field">
        <label for="orangutantheme_postbanner">Post Banner</label><button id="orut-postbanner-upload">upload</button>
        <br>
        <input id="orangutantheme_postbanner" type="text" name="orangutantheme_postbanner" value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'orangutantheme_postbanner', true ) ); ?>">
    </p><br>
    <p>
    <img src="<?php echo esc_attr( get_post_meta( get_the_ID(), 'orangutantheme_postbanner', true ) ); ?>">
    </p>
</div>