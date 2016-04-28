  <main class="animsition">
    <!--Main container sec start-->
    <div class="main_container">
    <!--Trainee top sec start-->
        <section class="trainee_top parallax-window" data-parallax="scroll" data-image-src="<?php echo $this->request->webroot; ?>images/trainee_top_bg.jpg">
            <div class="trainee_top_inner tr_grad">
                <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="trainee_top_wrap">
                            <div class="trainee_img">
                                <?php
                                if($profile_details[0]['trainer_image'] != "")
                                { ?>
                                    <a class="example-image-link" href="<?php echo $this->Custom->getImageSrc('uploads/trainer_profile/'.$profile_details[0]['trainer_image']) ?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                                    <img style="width:200px;height:190px;" src="<?php echo $this->Custom->getImageSrc('uploads/trainer_profile/'.$profile_details[0]['trainer_image']) ?>" alt="img" class="img-responsive"></a>
                            <?php }
                                else
                                { ?>
                                    <img style="width:200px;height:190px;" src="<?php echo $this->request->webroot; ?>img/default.png" alt="img" class="img-responsive">
                            <?php } ?>
                            </div>
                            <div class="trainee_detail">
                                <h1 class="trainee_name"><?php echo $profile_details[0]['trainer_name']; ?></h1>
                                 <div class="retting_box">
                                    <h3 class="trainee_rank">Rank Level : </h3><input class="trainer-rank" value="<?php echo $profile_details[0]['trainer_rating']; ?>" type="number" /> <span class="gray_grad"><?php echo $profile_details[0]['trainer_rating']; ?></span>
                                </div>     
                                <!--<nav class="trainee_streams">
                                    <ul>
                                    <?php $skills =  $profile_details[0]['trainer_skills']; 
                                        $skillArr = explode(",", $skills);
                                        if(!empty($skillArr)) {
                                        foreach($skillArr as $s) { ?>
                                        <li><a href="javascript:void(0);" class="red_grad" title="<?php echo $s; ?>"><?php echo $s; ?> </a></li>
                                        <?php } } ?>
                                    </ul>
                                </nav>
                               <nav class="trainee_social_link">
                                    <ul>
                                    <?php
                                        if(!empty($profile_details[0]['trainer_linkedin'])) { ?>
                                    <li><a target="_blank" href="<?php echo $profile_details[0]['trainer_linkedin']; ?>" title="Linked In" class="linkedin_grad"><span class="fa fa-linkedin"></span></a></li>
                                    <?php } ?>
                                    <?php
                                        if(!empty($profile_details[0]['trainer_facebook'])) { ?>
                                    <li><a target="_blank" href="<?php echo $profile_details[0]['trainer_facebook']; ?>" title="Facebook" class="facebook_grad"><span class="fa fa-facebook"></span></a></li>
                                    <?php } ?>
                                    <?php
                                        if(!empty($profile_details[0]['trainer_twitter'])) { ?>
                                    <li><a target="_blank" href="<?php echo $profile_details[0]['trainer_twitter']; ?>" title="Twitter" class="twitter_grad"><span class="fa fa-twitter"></span></a></li>
                                    <?php } ?>
                                    <?php
                                        if(!empty($profile_details[0]['trainer_belibitv'])) { ?>
                                    <li><a target="_blank" href="<?php echo $profile_details[0]['trainer_belibitv']; ?>" title="BelibiTv" class="belibitv_grad"><span class="belivitv_icon"><img src="<?php echo $this->request->webroot; ?>img/favicon.png"></span></a></li>
                                    <?php } ?>
                                    <?php
                                        if(!empty($profile_details[0]['trainer_google'])) { ?>
                                    <li><a target="_blank" href="<?php echo $profile_details[0]['trainer_google']; ?>" title="Google" class="google_grad"><span class="fa fa-google-plus"></span></a></li>
                                    <?php } ?>
                                    <?php
                                        if(!empty($profile_details[0]['trainer_instagram'])) { ?>
                                    <li><a target="_blank" href="<?php echo $profile_details[0]['trainer_instagram']; ?>" title="Instagram" class="instagram_grad"><span class="fa fa-instagram"></span></a></li>
                                    <?php } ?>
                                    
                                    
                                    </ul>
                                </nav>
                                <div class="profile_btn_main">
                                    <a href="<?php echo $this->request->webroot; ?>trainers/completeProfile" title="Edit Profile" class="hireme_btn gray_grad"><span class="fa fa-edit"></span> Edit Profile</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    <!--Trainee top  sec end--> 
    <section class="trainee_dash_body">
        <div class="container">
            <div class="row">
                      <!-- Tab panes -->
                  <div class="tab-content">
                      <div class="panel_block_heading">
                            <h4>V-Drive</h4>
                        </div>
                    <div class="dash_photo_gallery">
                              <!-- Tab panes -->
                              <div class="tab-content photos_tab_content">

                                <div role="tabpanel" class="tab-pane active" id="progress_photo">
                                   <div class="photo_gall_content">
                                   <?php
                                        if(!empty($files)) { ?>
                                      <ul class="photo_gallery_list">
                                      <?php
                                        foreach($files as $f) { 
                                        $fileArr = "";
                                        $img_ext = array("jpeg","jpg","tif","gif","png");
                                        $fileArr = explode(".", $f['src']);
                                        if(in_array($fileArr[1], $img_ext)) { ?>
                                        <li>
                                            <div class="download_inbox">
                                                <a href="<?php echo $this->request->webroot; ?>trainees/downloadSharedFile/<?php echo $f['src']; ?>">
                                                    <span class="download_file" ><i class="fa fa-download"></i></span>
                                                </a>

                                                 <a class="example-image-link" href="<?php echo $this->Custom->getImageSrc('uploads/chat_data/'.$f['src']) ?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                                                    <span class="download_file" ><i class="fa fa-eye"></i></span>
                                                </a>
                                            </div>
                                            <a class="img_verticle_text" href="javascript:void(0);"><img style="height:170px;" class="img-responsive" src="<?php echo $this->request->webroot; ?>/<?php echo $f['url']; ?>"/></a>
                                        </li>
                                        <?php } else { ?>
                                        <li><div class="download_inbox">
                                                <a href="<?php echo $this->request->webroot; ?>trainees/downloadSharedFile/<?php echo $f['src']; ?>">
                                                    <span class="download_file" ><i class="fa fa-download"></i></span>
                                                </a>
                                                
                                            </div>
                                            <a class="img_verticle_text" href="javascript:void(0);" title="<?php echo $f['src']; ?>"><span><?php echo $f['src']; ?></span></a>
                                        </li>
                                        <?php } } ?>
                                        </ul>
                                        <?php } else { ?>
                                            <div><center><h4>Data not found !</h4></center></div>
                                        <?php } ?>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                              </div>
                            </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
     </section>   
        
    </div>
    <!--Main container sec end-->

    <!-- Rating Start -->

    <script>
        jQuery(document).ready(function () {
         $('.trainer-rank').rating({
                  step: 1,
                  size: 'xs',
                  showClear: false,
                  disabled: true
            });
        });
    </script>

    <!-- Rating End -->

