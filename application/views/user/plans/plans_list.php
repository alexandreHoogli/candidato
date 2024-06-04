<div class="pxg_admin_content">
                <!--Header Start-->
                <header class="pxg_header_wrapper">
                    <div class="toggle-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="pxg_header_heading">
                        <h4><?= $page_info['page_title'] ?> </h4>
                    </div>
                    <div class="pxg_hdr_right_content d-none">
                        <div class="pxg_hdr_rgt_inner_content">
                            <div class="search_wrapper">
                                <input type="text" placeholder="Pesquise aqui">
                                <span class="search_icn">
                                <img src="<?= base_url() ?>assets/images/svg/search.svg" alt="search-icon">
                                </span>
                            </div>
                        </div>
                    </div>
                </header>
                <!--Header End-->
                
                <!--Inner Content Start-->
                <div class="pxg__inner_content">
                    <!--Plans & Billing Section Start-->
                    <div class="pxg_plans_main">
                        <div class="pxg_plans_inner_content">
                            <?php if( !empty($plans_list) ){  $plans = json_decode( PLANS_DURATION, true );  foreach( $plans_list as $key => $value ) { 
                                $plan_state = ($plans_data['status'] == 1 && $plans_data['plan_id'] == $value['id']);    
                            ?>
                                <div class="pxg_plans_details <?= $plan_state ? '' : ' recurring_plane' ?> ">
                                    <h3><?= $value['p_name'] ?></h3>
                                    <p><?= $value['p_description'] ?></p>
                                    <p><strong> Create Upto <?= $value['p_sites'] ?> Sites </strong></p>
                                    <a href="<?= $plan_state ? 'javascript:;' : base_url('purchase/'. base64_encode( $value['id'] ) ) ?>" class="edit_plan_btn"> <?= $plan_state ? 'Ativo atualmente' : 'Comprar' ?> </a>
                                    <h2><?= $value['p_price']. $symbol_ar[ $value['p_currency'] ] . ' ' .$value['p_currency'] ?>  <span>/ <?= $plans[ $value['p_interval'] ] ?></span>  <?= $plan_state ? '<span>( '.$plans_data['remaining_days'].' days remaining )</span>' : '' ?> </h2>
                                    <a class="show_plans_template" data-plan-id="<?= $value['id'] ?>" href="javascript:;">Modelos incluídos</a>
                                </div>
                            <?php } }  else {  ?>
                        <div class="pxg_create_site">
                            <div class="pxg_create_thumb">
                                <span>
                                    <svg 
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="1.389in" height="1.278in">
                                    <path fill-rule="evenodd"  opacity="0.8" fill="#7D809D"
                                    d="M94.994,83.269 L26.660,83.269 L19.820,90.122 C18.604,91.340 16.983,92.011 15.255,92.011 C13.528,92.011 11.906,91.340 10.691,90.122 C8.874,88.302 8.331,85.613 9.214,83.269 L5.006,83.269 C2.243,83.269 -0.004,81.017 -0.004,78.249 L-0.004,5.009 C-0.004,2.241 2.243,-0.011 5.006,-0.011 L47.751,-0.011 L56.423,5.781 L94.994,5.781 C97.757,5.781 100.004,8.033 100.004,10.801 L100.004,78.249 C100.004,81.017 97.757,83.269 94.994,83.269 ZM13.689,87.119 C14.104,87.535 14.660,87.764 15.255,87.764 C15.851,87.764 16.407,87.535 16.822,87.119 L34.820,69.085 C33.682,68.138 32.632,67.086 31.687,65.945 L13.689,83.978 C12.825,84.844 12.825,86.253 13.689,87.119 ZM50.000,69.675 C60.423,69.675 68.902,61.178 68.902,50.735 C68.902,40.292 60.423,31.795 50.000,31.795 C39.577,31.795 31.098,40.292 31.098,50.735 C31.098,61.178 39.577,69.675 50.000,69.675 ZM95.765,10.801 C95.765,10.375 95.419,10.029 94.994,10.029 L55.139,10.029 L46.468,4.236 L5.006,4.236 C4.581,4.236 4.235,4.583 4.235,5.009 L4.235,17.365 L95.765,17.366 L95.765,10.801 ZM95.765,21.613 L4.235,21.613 L4.235,78.249 C4.235,78.675 4.581,79.021 5.006,79.021 L12.641,79.021 L29.243,62.386 C27.252,58.837 26.202,54.820 26.202,50.735 C26.202,37.587 36.878,26.890 50.000,26.890 C63.122,26.890 73.798,37.587 73.798,50.735 C73.798,63.883 63.122,74.580 50.000,74.580 C45.923,74.580 41.914,73.528 38.372,71.533 L30.899,79.021 L94.994,79.021 C95.419,79.021 95.765,78.675 95.765,78.249 L95.765,21.613 ZM11.448,7.385 C13.453,7.385 15.084,9.019 15.084,11.028 C15.084,13.037 13.453,14.672 11.448,14.672 C9.443,14.672 7.811,13.037 7.811,11.028 C7.811,9.019 9.443,7.385 11.448,7.385 ZM21.425,7.385 C23.430,7.385 25.061,9.019 25.061,11.028 C25.061,13.037 23.430,14.672 21.425,14.672 C19.420,14.672 17.789,13.037 17.789,11.028 C17.789,9.019 19.420,7.385 21.425,7.385 ZM31.402,7.385 C33.407,7.385 35.039,9.019 35.039,11.028 C35.039,13.037 33.407,14.672 31.402,14.672 C29.397,14.672 27.766,13.037 27.766,11.028 C27.766,9.019 29.397,7.385 31.402,7.385 ZM84.920,11.942 C85.924,11.942 86.741,12.755 86.741,13.754 C86.741,14.753 85.924,15.566 84.920,15.566 C83.916,15.566 83.099,14.753 83.099,13.754 C83.099,12.755 83.916,11.942 84.920,11.942 ZM91.268,11.942 C92.272,11.942 93.089,12.755 93.089,13.754 C93.089,14.753 92.272,15.566 91.268,15.566 C90.264,15.566 89.447,14.753 89.447,13.754 C89.447,12.755 90.264,11.942 91.268,11.942 ZM50.000,40.042 C50.777,40.042 51.437,40.271 51.962,40.723 C52.508,41.194 52.797,41.850 52.797,42.620 L52.794,42.681 L52.766,42.989 L51.733,52.031 C51.677,52.555 51.491,52.969 51.177,53.268 C50.858,53.573 50.451,53.734 50.000,53.734 C49.549,53.734 49.142,53.573 48.823,53.267 C48.509,52.968 48.322,52.554 48.268,52.037 L48.267,52.031 L47.203,42.620 C47.203,41.850 47.492,41.194 48.038,40.723 C48.562,40.271 49.223,40.042 50.000,40.042 ZM50.000,55.880 C50.781,55.880 51.442,56.151 51.963,56.685 C52.479,57.216 52.741,57.878 52.741,58.654 C52.741,59.431 52.479,60.094 51.963,60.624 C51.442,61.158 50.782,61.429 50.000,61.429 C49.218,61.429 48.558,61.158 48.037,60.624 C47.521,60.094 47.259,59.431 47.259,58.654 C47.259,57.878 47.521,57.216 48.037,56.685 C48.559,56.151 49.219,55.880 50.000,55.880 Z"/>
                                    </svg>
                                </span>
                            </div>
                            <p>Nenhum plano disponível</p>
                        </div>
                    <?php } ?>
                        </div>
                    </div>
                    <!--Plans & Billing Section End-->
                    
                </div>
                <!--Inner Content  End-->
            </div>
        </div>
            <!--//========Select Template According Plan Popup Start=========//-->
            <div class="modal pxg_common_model pxg_select_temp_according_plan fade" id="pxg_temp_plan_model" data-bs-keyboard="false" tabindex="-1" aria-labelledby="basicModal" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="basicModal">Included templates with plan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="<?= base_url() ?>assets/images/cancel-icon.svg" alt="cancel-icon">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body-filter"></div>

                            <div class="pxg_create_site nothing_found_elem_ d-none">
                                <div class="pxg_create_thumb">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1.389in" height="1.278in">
                                        <path fill-rule="evenodd" opacity="0.8" fill="#7D809D" d="M94.994,83.269 L26.660,83.269 L19.820,90.122 C18.604,91.340 16.983,92.011 15.255,92.011 C13.528,92.011 11.906,91.340 10.691,90.122 C8.874,88.302 8.331,85.613 9.214,83.269 L5.006,83.269 C2.243,83.269 -0.004,81.017 -0.004,78.249 L-0.004,5.009 C-0.004,2.241 2.243,-0.011 5.006,-0.011 L47.751,-0.011 L56.423,5.781 L94.994,5.781 C97.757,5.781 100.004,8.033 100.004,10.801 L100.004,78.249 C100.004,81.017 97.757,83.269 94.994,83.269 ZM13.689,87.119 C14.104,87.535 14.660,87.764 15.255,87.764 C15.851,87.764 16.407,87.535 16.822,87.119 L34.820,69.085 C33.682,68.138 32.632,67.086 31.687,65.945 L13.689,83.978 C12.825,84.844 12.825,86.253 13.689,87.119 ZM50.000,69.675 C60.423,69.675 68.902,61.178 68.902,50.735 C68.902,40.292 60.423,31.795 50.000,31.795 C39.577,31.795 31.098,40.292 31.098,50.735 C31.098,61.178 39.577,69.675 50.000,69.675 ZM95.765,10.801 C95.765,10.375 95.419,10.029 94.994,10.029 L55.139,10.029 L46.468,4.236 L5.006,4.236 C4.581,4.236 4.235,4.583 4.235,5.009 L4.235,17.365 L95.765,17.366 L95.765,10.801 ZM95.765,21.613 L4.235,21.613 L4.235,78.249 C4.235,78.675 4.581,79.021 5.006,79.021 L12.641,79.021 L29.243,62.386 C27.252,58.837 26.202,54.820 26.202,50.735 C26.202,37.587 36.878,26.890 50.000,26.890 C63.122,26.890 73.798,37.587 73.798,50.735 C73.798,63.883 63.122,74.580 50.000,74.580 C45.923,74.580 41.914,73.528 38.372,71.533 L30.899,79.021 L94.994,79.021 C95.419,79.021 95.765,78.675 95.765,78.249 L95.765,21.613 ZM11.448,7.385 C13.453,7.385 15.084,9.019 15.084,11.028 C15.084,13.037 13.453,14.672 11.448,14.672 C9.443,14.672 7.811,13.037 7.811,11.028 C7.811,9.019 9.443,7.385 11.448,7.385 ZM21.425,7.385 C23.430,7.385 25.061,9.019 25.061,11.028 C25.061,13.037 23.430,14.672 21.425,14.672 C19.420,14.672 17.789,13.037 17.789,11.028 C17.789,9.019 19.420,7.385 21.425,7.385 ZM31.402,7.385 C33.407,7.385 35.039,9.019 35.039,11.028 C35.039,13.037 33.407,14.672 31.402,14.672 C29.397,14.672 27.766,13.037 27.766,11.028 C27.766,9.019 29.397,7.385 31.402,7.385 ZM84.920,11.942 C85.924,11.942 86.741,12.755 86.741,13.754 C86.741,14.753 85.924,15.566 84.920,15.566 C83.916,15.566 83.099,14.753 83.099,13.754 C83.099,12.755 83.916,11.942 84.920,11.942 ZM91.268,11.942 C92.272,11.942 93.089,12.755 93.089,13.754 C93.089,14.753 92.272,15.566 91.268,15.566 C90.264,15.566 89.447,14.753 89.447,13.754 C89.447,12.755 90.264,11.942 91.268,11.942 ZM50.000,40.042 C50.777,40.042 51.437,40.271 51.962,40.723 C52.508,41.194 52.797,41.850 52.797,42.620 L52.794,42.681 L52.766,42.989 L51.733,52.031 C51.677,52.555 51.491,52.969 51.177,53.268 C50.858,53.573 50.451,53.734 50.000,53.734 C49.549,53.734 49.142,53.573 48.823,53.267 C48.509,52.968 48.322,52.554 48.268,52.037 L48.267,52.031 L47.203,42.620 C47.203,41.850 47.492,41.194 48.038,40.723 C48.562,40.271 49.223,40.042 50.000,40.042 ZM50.000,55.880 C50.781,55.880 51.442,56.151 51.963,56.685 C52.479,57.216 52.741,57.878 52.741,58.654 C52.741,59.431 52.479,60.094 51.963,60.624 C51.442,61.158 50.782,61.429 50.000,61.429 C49.218,61.429 48.558,61.158 48.037,60.624 C47.521,60.094 47.259,59.431 47.259,58.654 C47.259,57.878 47.521,57.216 48.037,56.685 C48.559,56.151 49.219,55.880 50.000,55.880 Z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <p>No Templates Found</p>
                            </div>
                            
                            <div class="pxg_template_list selct_temp_for_plan_container">
                                
                            </div>
                            <div class="pxg_model_btn">
                                <a class="pxg_btn load_more_temp_btn" data-offset="0" >Load More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--//========Select Template According Plan Popup End=========//-->
        <div>