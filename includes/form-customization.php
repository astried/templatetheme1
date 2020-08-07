<div class="wrap">
<h1>Custom Theme Options Page</h1>

<style>
.layout-box{
width:100%;
margin-left:5%;
margin-top:20px;
}

img.layout-image{
margin-left:10%;
}

div.radio.radio-adjust{
margin-left:2%;
}      
</style>

<!-- Tabs -->
<section id="tabs">
	<div class="container">
		<h6 class="section-title h1">Tabs</h6>
		<div class="row col-xs-12">
			<div class="col-xs-12" style="width:100%;">
				<nav>
					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="nav-sliders-tab" data-toggle="tab" href="#nav-sliders" role="tab" aria-controls="nav-sliders" aria-selected="true">Slider</a>
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-section1" role="tab" aria-controls="nav-profile" aria-selected="false">Section 1</a>
						<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-section2" role="tab" aria-controls="nav-contact" aria-selected="false">Section 2</a>
						<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-section3" role="tab" aria-controls="nav-about" aria-selected="false">Section 3</a>
					</div>
				</nav>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-sliders" role="tabpanel" aria-labelledby="nav-sliders-tab">
						<h2>Sliders</h2>

						<div class="row form-group">
      						<div class="col-lg-12 mb-12">
      							<input id="orut-txt-heading" type="text" class="form-control" placeholder="heading">
      						</div>
      					</div>	
      					<div class="row form-group">
      						<div class="col-lg-12 mb-12">
      							<input id="orut-txt-subheading" type="text" class="form-control" placeholder="sub heading">
      						</div>
      					</div>	
      					<div class="row form-group">
      						<div class="col-lg-12 input-group mb-12">
      							<input id="orut-img-upload-slider" type="text" class="form-control" placeholder="...">
						  		<div class="input-group-append">
						    	<button id="orut-btn-upload-slider" class="btn btn-primary" type="button">upload</button>
      							</div>
      						</div>
      						<div class="col-lg-12 input-group mb-12">
      							Size 1900 x 1080
      						</div>
      					</div>	

      					<div class="row form-group">
      						<div class="col-lg-12 mb-12">
      							<button id="orut-btn-add-slider" class="btn btn-primary" type="button">+</button>
      						</div>
      					</div>

      					<style>
      						#orut-slider-unordered-list{
      							padding: 10px;
      						}

      						.orut-slider-list{
      							margin: 15px 0;
      							padding: 15px 0;
      							background-color: #eee;
      						}

      						.orut-img-upload-slider{
      							width  : 633px;
      							height : 360px;
      						}

      						.btn-drag-list{
      							cursor: grab;
      						}

      						.btn-show-slider-image{
      							margin:0 5px 0 0;
      							cursor: grab;
      						}

                                          .btn-remove-list{
                                                margin:0 0 0 10px;
                                                cursor: grab;
                                          }
      					</style>

      					<div class="row orut-slider-list-clone" style="display:none;">
      					      <div class="row col-lg-12 mb-12">
      						      <div class="col-lg-5 mb-5">
			      					<input type="text" class="orut-txt-heading form-control" placeholder="heading">
				      			</div>
				      			<div class="col-lg-5 mb-5">
				      				<input type="text" class="form-control orut-txt-subheading" placeholder="sub heading">
				      			</div>
				      			<div class="col-lg-2 mb-2 text-right">
				      				<span class="btn-show-slider-image"><i class="fa fa-image"></i></span>
				      				<span class="btn-drag-list"><i class="fa fa-arrows"></i></span>
				      			</div>
      						</div>
      						<div class="row col-lg-12 mb-12 orut-img-div-slider" style="display: none;">
      							<div class="col-lg-10 mb-10">
                                                      <input type="hidden" class="orut-imgurl-slider">
			      					<img class="form-control orut-img-slider" style="height:360px;width:633px;">
				      			</div>
      						</div>
      					</div>
                                    <br>
                                    <div class="row form-group">
                                          <div class="col-lg-9 mb-9">
                                          <h3>LIST</h3>      
                                                <button id="orut-btn-save-slider" class="btn btn-primary" type="button"> Save <i class="fa fa-save"></i></button><img id="orut-btn-save-slider-load" style="display:none;" src="<?php echo get_template_directory_uri(). "/images/loader.gif"; ?>">
                                          </div>
                                    </div>                                    
      					<div id="orut-slider-unordered-list" class="col-xs-12">
                                    <?php
                                    $sliders = get_option('orut_frontend_sliders');
                                    
                                    if(!empty($sliders))
                                    {
                                          $sliders = (array)unserialize($sliders);

                                          foreach($sliders as $slide){
                                          ?>
                                          <div class="row orut-slider-list">
                                          <div class="row col-lg-12 mb-12">
                                                <div class="col-lg-5 mb-5">
                                                      <input type="text" class="orut-txt-heading form-control" placeholder="heading" value="<?php echo $slide['title']; ?>">
                                                </div>
                                                <div class="col-lg-5 mb-5">
                                                      <input type="text" class="form-control orut-txt-subheading" value="<?php echo $slide['subtitle']; ?>">
                                                </div>
                                                <div class="col-lg-2 mb-2 text-right">
                                                      <span class="btn-show-slider-image"><i class="fa fa-image"></i></span>
                                                      <span class="btn-drag-list"><i class="fa fa-arrows"></i></span>
                                                      <span class="btn-remove-list"><i class="fa fa-times"></i></span>
                                                </div>
                                          </div>
                                          <div class="row col-lg-12 mb-12 orut-img-div-slider" style="display: none;">
                                                <div class="col-lg-10 mb-10">
                                                      <input type="hidden" class="orut-imgurl-slider" value="<?php echo $slide['image']; ?>">
                                                      <img class="form-control orut-img-slider" style="height:360px;width:633px;" src="<?php echo $slide['image']; ?>">
                                                </div>
                                          </div>
                                          </div>
                                          <?php      
                                          }
                                    }
                                    ?>
      					</div>
					</div><!-- nav-sliders-->

                              <?php
                              
                              $section1_layout = get_option('orut_layout_section1');
                              $section1_grids = get_option('orut_gridsize_section1');

                              $index = explode(";", $section1_grids);

                              $row = 1;
                              $col = 1;

                              if(isset($index[0])) $col = $index[0];
                              if(isset($index[1])) $row = $index[1];

                              $post_grid = "";

                              ?>

					<div class="tab-pane fade" id="nav-section1" role="tabpanel" aria-labelledby="nav-section1-tab">

                              <div class="panel panel-default">
                                    <div class="panel-heading"><h2>Layout</h2></div>
                              <div class="panel-body">                                
                                    <div class="layout-box">
                                    <div class="row">
                                    <div class="row form-group col-lg-12">
                                          <div class="col-lg-12 mb-12">
                                                <input id="orut-txt-title-section1" type="text" class="form-control" placeholder="title">
                                          </div>
                                    </div>                                            
                                          <div class="col-md-3 col-sm-3">
                                          <div class="radio radio-adjust">
                                                <label>
                                                <input type="radio" name="layout-radio" value="card" <?php if($section1_layout != "card-with-title") echo "checked";?> class="layout-choice layout-choice-section1">Card Theme
                                                <br>
                                                <img src="<?php echo get_template_directory_uri(). "/images/theme-card.png"; ?>" class="layout-image">
                                                </label>
                                          </div>
                                          </div>

                                          <div class="col-md-3 col-sm-3">
                                          <div class="radio radio-adjust">
                                                <label><input type="radio" name="layout-radio" value="card-with-title" <?php if($section1_layout == "card-with-title") echo "checked";?> class="layout-choice layout-choice-section1">Card Theme with Title<br>
                                                <img src="<?php echo get_template_directory_uri(). "/images/theme-card-with-header.png"; ?>">
                                                </label>
                                          </div>
                                          </div>

                                          <div class="col-md-3 col-sm-3">
                                          <div class="radio radio-adjust">
                                                <label><input type="radio" name="layout-radio" value="posts" <?php if($section1_layout == "posts") echo "checked";?> class="layout-choice layout-choice-section1">Show posts<br>
                                                <img src="<?php echo get_template_directory_uri(). "/images/grid-rows.png"; ?>">
                                                </label>
                                          </div>
                                          </div>
                                    </div>
                                    </div>

                                    <div class="row form-group posts-layout col-lg-12 layout-box">
                                          <h2>Grid</h2>
                                          <div class="row form-group col-lg-12">
                                                <div class="col-lg-6 mb-6">
                                                      Grid Columns<br>                                       
                                                      <select id="orut-num-col-section1" type="text" class="form-control">
                                                            <option value="1" <?php if($col==1) echo "selected";?>>1</option>
                                                            <option value="2" <?php if($col==2) echo "selected";?>>2</option>
                                                            <option value="3" <?php if($col==3) echo "selected";?>>3</option>
                                                      </select>
                                                </div>
                                                <div class="col-lg-6 mb-6">
                                                      Grid Rows<br>
                                                      <select id="orut-num-row-section1" type="text" class="form-control">
                                                            <option value="1" <?php if($row==1) echo "selected";?>>1</option>
                                                            <option value="2" <?php if($row==2) echo "selected";?>>2</option>
                                                            <option value="3" <?php if($row==3) echo "selected";?>>3</option>
                                                            <option value="4" <?php if($row==4) echo "selected";?>>4</option>
                                                      </select>
                                                </div>
                                          </div>   
                                    </div>

                                    <div class="row form-group layout-box">
                                          <div class="col-lg-12 mb-12">
                                          <div class="col-lg-12 mb-12">      
                                          <button id="orut-btn-save-layout-section1" data-section="1" class="btn btn-primary btn-save-layout" type="button">Save Layout <i class="fa fa-save"></i></button>
                                          </div>
                                          </div>
                                    </div>
                              </div><!--panelbody-->
                              </div><!--panel-->

                              <br><br>

                              <div id="div-details-section1" class="panel panel-default">
                                    <div class="panel-heading"><h2>Layout Details</h2></div>
                              <div class="panel-body">  
                                    <div class="layout-box">
                                          <div class="row">
                                    <!--Details-->            
                                    <div class="row form-group col-lg-12">
                                          <div class="col-lg-12 input-group mb-12">
                                                <input id="orut-img-section1" type="text" class="form-control" placeholder="...">
                                                <div class="input-group-append">
                                          <button id="orut-btn-image-section1" class="btn btn-primary orut-uploader" name="section1" type="button">upload</button>
                                                </div>
                                          </div>
                                    </div>      
                                    <div class="row form-group col-lg-12">
                                          <div class="col-lg-12 mb-12">
                                                <input id="orut-txt-heading-section1" type="text" class="form-control" placeholder="heading">
                                          </div>
                                    </div>      
                                    <div class="row form-group col-lg-12">
                                          <div class="col-lg-12 mb-12">
                                                <textarea id="orut-txt-desc-section1" class="form-control"></textarea>
                                          </div>
                                    </div>
                                    <div class="row form-group col-lg-12">
                                          <div class="col-lg-12 mb-12">
                                                <input id="orut-buttontext-section1" type="text" class="form-control" placeholder="button text">
                                          </div>
                                    </div>  
                                    <div class="row form-group col-lg-12">
                                          <div class="col-lg-12 mb-12">
                                                <input id="orut-link-section1" type="text" class="form-control" placeholder="url link">
                                          </div>
                                    </div>     
                                    <div class="row form-group col-lg-12">
                                          <div class="col-lg-12 mb-12">
                                                <button id="orut-btn-add-section1" name="section1" class="btn btn-primary" type="button">+</button>
                                          </div>
                                    </div>

                                    <style>
                                          #orut-slider-unordered-list{
                                                padding: 10px;
                                          }

                                          .orut-slider-list{
                                                margin: 15px 0;
                                                padding: 15px 0;
                                                background-color: #eee;
                                          }

                                          .orut-img-upload-slider{
                                                width  : 633px;
                                                height : 360px;
                                          }

                                          .btn-drag-list{
                                                cursor: grab;
                                          }

                                          .btn-show-slider-image{
                                                margin:0 5px 0 0;
                                                cursor: grab;
                                          }

                                          .btn-remove-list{
                                                margin:0 0 0 10px;
                                                cursor: grab;
                                          }
                                    </style>

                                    <div class="row orut-slider-list-clone" style="display:none;">
                                          <div class="row col-lg-12 mb-12">
                                                <div class="col-lg-5 mb-5">
                                                      <input type="text" class="orut-txt-heading form-control" placeholder="heading">
                                                </div>
                                                <div class="col-lg-5 mb-5">
                                                      <input type="text" class="form-control orut-txt-subheading" placeholder="sub heading">
                                                </div>
                                                <div class="col-lg-2 mb-2 text-right">
                                                      <span class="btn-show-slider-image"><i class="fa fa-image"></i></span>
                                                      <span class="btn-drag-list"><i class="fa fa-arrows"></i></span>
                                                </div>
                                          </div>
                                          <div class="row col-lg-12 mb-12 orut-img-div-slider" style="display: none;">
                                                <div class="col-lg-10 mb-10">
                                                      <input type="hidden" class="orut-imgurl-slider">
                                                      <img class="form-control orut-img-slider" style="height:360px;width:633px;">
                                                </div>
                                          </div>
                                    </div>
                                    <br>
                                    <div class="row form-group col-lg-12">
                                          <div class="col-lg-9 mb-9">
                                          <h3>LIST</h3>      
                                                <button id="orut-btn-save-slider" class="btn btn-primary" type="button"> Save <i class="fa fa-save"></i></button><img id="orut-btn-save-slider-load" style="display:none;" src="<?php echo get_template_directory_uri(). "/images/loader.gif"; ?>">
                                          </div>
                                    </div>                                    
                                    <div id="orut-slider-unordered-list" class="col-xs-12">
                                    <?php
 
                                    ?>
                                    </div>
                                    <!--end details-->
                                          </div>
                                    </div>
                              </div><!--end panelbody-->
                              </div><!--end panel-->

                              <div class="row form-group card-layout <?php if($section1_layout == "posts") echo "hideme";?> col-lg-12">

                              </div>

					</div><!-- nav-section1-->

					<div class="tab-pane fade" id="nav-section2" role="tabpanel" aria-labelledby="nav-section2-tab">
						Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
					</div>
					<div class="tab-pane fade" id="nav-section3" role="tabpanel" aria-labelledby="nav-section3-tab">
						Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
					</div>
				</div>
			
			</div>
		</div>
	</div>
</section>
<!-- ./Tabs -->

</div>