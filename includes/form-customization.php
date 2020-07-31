<div class="wrap">
<h1>Custom Theme Options Page</h1>

<!-- Tabs -->
<section id="tabs">
	<div class="container">
		<h6 class="section-title h1">Tabs</h6>
		<div class="row col-xs-12">
			<div class="col-xs-12" style="width:100%;">
				<nav>
					<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Slider</a>
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Options2</a>
						<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">options1</a>
						<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">About</a>
					</div>
				</nav>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
                                          <h3>LIST</h3>
                                          <div class="col-lg-9 mb-9">
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
					</div>

					<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
					</div>
					<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
						Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
					</div>
					<div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
						Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim. Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore. Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
					</div>
				</div>
			
			</div>
		</div>
	</div>
</section>
<!-- ./Tabs -->

</div>