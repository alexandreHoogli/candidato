<div class="mt_sidebar_editor test" id="background_editor">
					<span class="close_editor"><svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5 14.5L1 8L7.5 1.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></span>
						<div class="mt_heading_editor">
							<p><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_1')); ?></p>
						</div>
								<div class="mt_detail_editor">
						<div class="mt_editor_tabs">
							<ul class="nav nav-tabs" id="backgroundsetting" role="tablist">
							  <li class="nav-item">
								<a class="nav-link active"  data-toggle="tab" href="#bgsetcolortb" role="tab" aria-controls="bgsetcolortb" aria-selected="true"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_2')); ?></a>
							  </li>
							  <li class="nav-item">
								<a class="nav-link bgsetimgtbclk"  data-toggle="tab"   href="#bgsetimgtb" role="tab" aria-controls="bgsetimgtb" aria-selected="false"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_3')); ?></a>
							  </li>
							</ul>
							<div class="tab-content tab_content2" id="Popbg">
							  <div class="tab-pane fade show active" id="bgsetcolortb" role="tabpanel" aria-labelledby="bgsetcolortb-tab">
								<div class="mt_editor_flex mt_tabs_flex">
									
									<div class="mt_select_editor mt_color_picker">
										<p><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_4')); ?></p>
										<div class="mt_picker mt_picker1">
										   <input data-css="color" data-element=".headline" id="popbgoptions_bgcolor" name="popbgoptions_bgcolor" type="text" value="#039be5">
										</div>
									</div>
									
									<div class="mt_select_box mt_select_editor">
										<p><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_5')); ?></p>
										<select class="wide select_font_weight" id="popbgoptions_opacity">
										  <option value="1">1</option>
										  <option value="0.9">0.9</option>
										  <option value="0.8">0.8</option>
										  <option value="0.7">0.7</option>
										  <option value="0.6">0.6</option>
										  <option value="0.5">0.5</option>
										  <option value="0.4">0.4</option>
										  <option value="0.3">0.3</option>
										  <option value="0.2">0.2</option>
										  <option value="0.1">0.1</option>
										  <option value="0">0</option>
										</select>
									</div>
								</div>
								<div class="mt_detail_editor mt_select_editor mt_editor_radiomain mt_background_type">
									<p><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_6')); ?></p>
									<div class="mt_editor_radio">
										<input type="radio" name="popbackground_type" value="mt_popup_full_wd" id="mt_popup_full_wd" checked>
										<label for="mt_popup_full_wd"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_7')); ?></label>
									</div>
									<div class="mt_editor_radio">
										<input type="radio" name="popbackground_type" value="mt_popup_left_wd" id="mt_popup_left_wd">
										<label for="mt_popup_left_wd"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_8')); ?></label>
									</div>
									<div class="mt_editor_radio">
										<input type="radio" name="popbackground_type" value="mt_popup_right_wd" id="mt_popup_right_wd">
										<label for="mt_popup_right_wd"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_9')); ?></label>
									</div>
								</div>
								
								<div class="mt_detail_editor mt_select_editor mt_editor_radiomain mt_photocontestimg_setting mt_hide">
									<p><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_10')); ?></p>
									<div class="mt_editor_radio mt_checkbox2">
										<input type="checkbox" name="mt_image_slide_1_chk"  id="mt_image_slide_1_chk" class="mt_image_slide_chk">
										<label for="mt_image_slide_1_chk"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_11')); ?></label>
									</div>
									<div class="mt_editor_radio mt_checkbox2">
										<input type="checkbox" name="mt_image_slide_2_chk"  id="mt_image_slide_2_chk" class="mt_image_slide_chk">
										<label for="mt_image_slide_2_chk"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_12')); ?></label>
									</div>
									<div class="mt_editor_radio mt_checkbox2">
										<input type="checkbox" name="mt_image_slide_3_chk"  id="mt_image_slide_3_chk" class="mt_image_slide_chk">
										<label for="mt_image_slide_3_chk"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_13')); ?></label>
									</div>
									
								</div>
									<div class="mt_photo_gallery mt_select_editor ">
									<p><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_14')); ?> </p>
										<ul  class="mt_overlay_image_container">
											<?php 
											for($i=0 ;$i<=10;$i++ ){
												echo '<li><a href="javascript:;"><img src="'.base_url().'template_assets/overlay/'.$i.'.png" alt="" class="mt_use_img" data-type="image_bg"></a></li>';
											}
											?>
										</ul>
									</div>  
							  </div>
								<div class="tab-pane fade" id="bgsetimgtb" role="tabpanel" aria-labelledby="bgsetimgtb-tab">
									<div class="mt_dropzon_section mt_dropzon_img2">
										<div class="mt_select_editor">
											<p><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_15')); ?></p>
											<div class="mt_dropzon">
												<form action="/file-upload"
												  class="dropzone"
												  id="imgbackgroundupload"></form> 
											</div>
										</div>
									</div>
									<div class="mt_editor_tabs">
										<ul class="nav nav-tabs" id="BgImgcontainer" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" id="bgimglibrary" data-toggle="tab" href="#bgimglibrarytab" role="tab" aria-controls="bgimglibrarytab" aria-selected="true"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_16')); ?></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="bgpixabaylibrary" data-toggle="tab" href="#bgpixabaylibrarytab" role="tab" aria-controls="bgpixabaylibrarytab" aria-selected="false"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_17')); ?></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="bgunsplashlibrary" data-toggle="tab" href="#bgunsplashlibrarytab" role="tab" aria-controls="bgunsplashlibrarytab" aria-selected="false"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_18')); ?></a>
											</li>
										</ul>
										<div class="tab-content" id="BgImgLibcontainerContent">
											<div class="tab-pane fade show active" id="bgimglibrarytab" role="tabpanel" aria-labelledby="bgimglibrarytab-tab">
												<div class="mt_tabs_pixabay mt_photo_gallery_container">
													<div class="mt_search_box">
														<input type="text" placeholder="Procurar..." class="search_images_lib" data-type="image_bg">
														<span><i class="fa fa-search" aria-hidden="true"></i></span>
													</div>
													<div class="mt_photo_gallery">
														<ul class="mt_media_library_container editore_img_gallery_wrapper" id="image_bg">
															
														</ul>
														<a href="javascript:;" class="mt_btn loadMoreMediaLibraryImage" data-attr="0"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_19')); ?></a>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="bgpixabaylibrarytab" role="tabpanel" aria-labelledby="bgpixabaylibrarytab-tab">
												<div class="mt_tabs_pixabay">
													<div class="mt_search_box">
														<input type="text" placeholder="Procurar..." class="search_images_from_api" data-api="pixabay" data-type="piximage_bg">
														<span><i class="fa fa-search" aria-hidden="true"></i></span>
													</div>
													<div class="mt_photo_gallery">
														<ul  class="mt_media_library_container editore_img_gallery_wrapper" id="piximage_bg">
															<li><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_20')); ?></li> 
														</ul>
														<a href="javascript:;" class="mt_btn loadPixabayImage mt_hide" data-attr="1"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_21')); ?></a>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="bgunsplashlibrarytab" role="tabpanel" aria-labelledby="bgunsplashlibrarytab-tab">
												<div class="mt_tabs_pixabay">
													<div class="mt_search_box">
														<input type="text" placeholder="Procurar..." class="search_images_from_api" data-api="unsplash" data-type="unsimage_bg">
														<span><i class="fa fa-search" aria-hidden="true"></i></span>
													</div>
													<div class="mt_photo_gallery">
														<ul  class="mt_media_library_container editore_img_gallery_wrapper" id="unsimage_bg">
															<li><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_22')); ?></li> 
														</ul>
														<a href="javascript:;" class="mt_btn loadPixabayImage mt_hide" data-attr="1"><?php echo html_escape($this->lang->line('ltr_common_bg_editor_txt_23')); ?></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
					</div>