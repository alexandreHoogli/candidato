                <div class="mt_container_fluid mt_container_fluid2">
					<span class="open_sidebar_toggle" onclick="$('.mt_sidebar_editor').addClass('mt_hide');$('#customcss_editor').removeClass('mt_hide').addClass('open_editor'); $('.mt_main_structure').removeClass('mt_hide_sidebar') " ><!--  -->
						<svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="
						">
						<path d="M7.5 14.5L1 8L7.5 1.5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg>
					</span>
					<div class="mt_editor_toggle">
						<span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 485.219 485.22">
							<path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897
								C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436
								c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44
								c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421
								c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z
									M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919
								c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703
								c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986
								C147.097,447.637,146.36,447.193,145.734,446.572z"></path>
						</svg></span>
					</div>
					<?php include_once('text_editor.php'); ?>
					<?php include_once('image_editor.php'); ?>
					<?php include_once('background_editor.php'); ?>
					
					<?php include_once('form_editor.php'); ?>
					<?php include_once('customcss_editor.php'); ?>
					
					<div class="mt_popup_live_preview">
					<div data-replace-path="<?= isset( $cData[0]['zip_path'] )? base64_encode( base_url( $cData[0]['zip_path'].'/') ): 'NA' ?>" class="mt_edit_template_container <?= isset( $cData[0]['template_html'] )? 'ppd_my_template' : '' ?> ">
											
						<?php if( isset(  $cData[0]['zip_path'] ) ) {
								$file_contents = file_get_contents( getcwd().'/'.$cData[0]['zip_path'].'/index.html' );
								$file_contents = str_replace("assets/", base_url( $cData[0]['zip_path'].'/assets/') , $file_contents );
								echo $file_contents;
							}
							else if( isset( $cData[0]['template_html'] ) ){
								if( file_exists( getcwd().'/'.$cData[0]['template_html'] ) ){
									$template_html = file_get_contents( getcwd().'/'.$cData[0]['template_html'] );
									echo $template_html;
								}
								else{
									$template_html = $cData[0]['template_html'];
									$upload_path  = createTemplateDirectory();
									$p            = $upload_path.time().'.html';
									file_put_contents( getcwd().$p, $cData[0]['template_html'] );
									$res          = $this->Qdb->update_data('user_campaigns', array( 'template_html' => $p ), array( 'user_id' => $this->session->userdata('user_id'), 'id' => $cData[0]['id'] ));
									echo $template_html;
								}
							} 
						?>	
    
					</div>
					</div>
				    <div class="mt_btn_sticky">
    					<div class="mt_next_prev_btn">
    						<ul>
    							<input type="hidden" id="campId" value="<?=$cData[0]['id'];?>">
    						</ul>
    					</div>
					</div>
				</div>