<?php include "trainer_common_header.php"; ?>

     <section class="trainee_dash_body parallax-window">
     	<div class="container trainee_profile_wrap">
        	
        	<div class="row">
            	<div class="col-sm-3">
                    <div class="trainee_tabs_sect">
                    	  <h3>Complete Profile</h3>
                    	  <!-- Nav tabs -->
                          <ul class="nav_tabs">
                            
                            
                            
                            
                            <li class="active informaiton"><a href="#informaiton" aria-controls="informaiton" role="tab" data-toggle="tab">Personal Informaiton </a></li>
                            <li class="social_links"><a href="#social_links" aria-controls="social_links" role="tab" data-toggle="tab">Social Links </a></li>
                            <li class="bank_details"><a href="#bank_details" aria-controls="bank_details" role="tab" data-toggle="tab">Bank Details </a></li>
                            <li class="password"><a href="#password" aria-controls="password" role="tab" data-toggle="tab">Change Password </a></li>
                            <li class="achievements"><a href="#achievements" aria-controls="achievements" role="tab" data-toggle="tab">Achievements</a></li>
                            <li class="others"><a href="#others" aria-controls="others" role="tab" data-toggle="tab">Others</a></li>
                            <li class="quotes"><a href="#quotes" aria-controls="quotes" role="tab" data-toggle="tab">Quotes</a></li>
                            <li class="certifications"><a href="#certifications" aria-controls="certifications" role="tab" data-toggle="tab">Certifications</a></li>
                            <li class="resume"><a href="#resume" aria-controls="resume" role="tab" data-toggle="tab">Resume</a></li>
                            <li class="rateplan"><a href="#rateplan" aria-controls="rateplan" role="tab" data-toggle="tab">Rate plan</a></li>
                            <li class="package"><a href="#package" aria-controls="package" role="tab" data-toggle="tab">Packages</a></li>
                            <li class="addgym"><a href="#addgym" aria-controls="addgym" role="tab" data-toggle="tab">Gyms of Access</a></li>                            
                          </ul>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="img-profile">
                        <?php echo $this->Flash->render('edit') ?>
                        <?php echo $this->Custom->successMsg(); ?>
                         <?php echo $this->Custom->errorMsg(); ?>
                         <?php echo $this->Custom->loadingImg(); ?>
                    </div>
                	<div class="trainee_tab_content">
                    	<!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active informaiton" id="informaiton">


                            	<h3 class="trai_title_sect">Personal Informaiton</h3>
                                <?=  $this->Flash->render('edit1') ?>
                                <form method="post" action="<?php echo $this->request->webroot; ?>trainers/updatePersonalInfo/informaiton">
                                <div class="form_wrapper">
                                	<!-- <div class="form-group">
                                        <div class="photo_upload_sect">
                                                	<input type="file" value="Photo Upload">
                                                    <span class="fa fa-cloud-upload"></span>
                                                    <h5>Upload your Photo</h5>
                                                </div>
                                    </div> -->
                                    
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input required name="trainer_name" type="text" value="<?php echo $profile_details[0]['trainer_name']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" value="<?php echo $profile_details[0]['trainer_email']; ?>" readonly class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Display Name</label>
                                        <input required name="trainer_displayName" type="text" value="<?php echo $profile_details[0]['trainer_displayName']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select required id="trainer_country" name="trainer_country" class="form-control ">
                                            <option value="">Country</option>
                                            <?php 
                                            foreach($countries as $c) { ?>
                                                <option value="<?php echo $c['id']; ?>" <?php if(isset($profile_details[0]['trainer_country']) && $profile_details[0]['trainer_country'] == $c['id'])  echo "selected='selected'"; ?>><?php echo $c['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Province</label>
                                        <select required id="trainer_state"  name="trainer_state" class="form-control ">
                                            <option value="">Select Province</option>
                                            <?php 
                                            foreach($states as $c) { ?>
                                                <option value="<?php echo $c['id']; ?>" <?php if(isset($profile_details[0]['trainer_state']) && $profile_details[0]['trainer_state'] == $c['id'])  echo "selected='selected'"; ?>><?php echo $c['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>City</label>
                                        <select required id="trainer_city" name="trainer_city" class="form-control ">
                                            <option value="">City</option>
                                            <?php 
                                            foreach($cities as $c) { ?>
                                                <option value="<?php echo $c['id']; ?>" <?php if(isset($profile_details[0]['trainer_city']) && $profile_details[0]['trainer_city'] == $c['id'])  echo "selected='selected'"; ?>><?php echo $c['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input required name="trainer_zip" type="text" value="<?php echo $profile_details[0]['trainer_zip']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Trainer Skills (Please enter skills by comma seprated)</label>
                                        <input required name="trainer_skills" type="text" value="<?php echo $profile_details[0]['trainer_skills']; ?>" class="form-control">
                                    </div>
                                </div>
                                <input type="submit" class="btn submit_btn"  value="Update" />
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane social_links" id="social_links">
                                <h3 class="trai_title_sect">Social Links</h3>
                                <?=  $this->Flash->render('edit2') ?>
                                <form method="post" action="<?php echo $this->request->webroot; ?>trainers/updatePersonalInfo/social_links">
                                <div class="form_wrapper">
                                <div class="form-group">
                                        <label>Facebook URL</label>
                                        <input  name="trainer_facebook" type="url" value="<?php echo $profile_details[0]['trainer_facebook']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Linked In URL</label>
                                        <input type="url" value="<?php echo $profile_details[0]['trainer_linkedin']; ?>" name="trainer_linkedin"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>BelibiTv URL</label>
                                        <input  name="trainer_belibitv" type="url" value="<?php echo $profile_details[0]['trainer_belibitv']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Twitter URL</label>
                                        <input  name="trainer_twitter" type="url" value="<?php echo $profile_details[0]['trainer_twitter']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Google URL</label>
                                        <input  name="trainer_google" type="url" value="<?php echo $profile_details[0]['trainer_google']; ?>" class="form-control">
                                    </div>
                                     <div class="form-group">
                                        <label>Instagram URL</label>
                                        <input  name="trainer_instagram" type="url" value="<?php echo $profile_details[0]['trainer_instagram']; ?>" class="form-control">
                                    </div>
                                </div>
                                <input type="submit" class="btn submit_btn"  value="Update" />
                                </form>
                            </div>

                            <div role="tabpanel" class="tab-pane bank_details" id="bank_details">
                                <h3 class="trai_title_sect">Setup Bank Details </h3>
                                <?=  $this->Flash->render('edit3') ?>
                                <ul class="tai_sub_tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#paypal" aria-controls="photos" role="tab" data-toggle="tab">Paypal</a></li>
                                        <li role="presentation"><a href="#amazon" aria-controls="gallery" role="tab" data-toggle="tab">Amazon</a></li>
                                        <li role="presentation"><a href="#money_order" aria-controls="gallery" role="tab" data-toggle="tab">Money Order</a></li>
                                </ul>
                                </br></br>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="paypal">
                                        <form method="post" action="<?php echo $this->request->webroot; ?>trainers/updateBankDetails/bank_details">
                                           <!--  <div class="form-group">
                                                <label>Paypal Url</label>
                                                <input type="url" name="paypal_url" required value="<?php if(isset($profile_details[0]['paypal_url'])) echo $profile_details[0]['paypal_url']; ?>" placeholder="Paypal Url" class="form-control">
                                            </div> -->
                                            <div class="form-group">
                                                <label>Paypal Bussiness Id</label>
                                                <input type="email" name="paypal_email" required value="<?php if(isset($profile_details[0]['paypal_email'])) echo $profile_details[0]['paypal_email']; ?>" placeholder="Paypal Bussiness Id" class="form-control">
                                            </div>
                                            <input type="submit" class="btn submit_btn" value="Update" />
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="amazon">
                                        <form method="post" action="<?php echo $this->request->webroot; ?>trainers/updateBankDetails">
                                            <!-- <div class="form-group">
                                                <label>Amazon Url</label>
                                                <input type="url" name="amazon_url" required value="<?php if(isset($profile_details[0]['amazon_url'])) echo $profile_details[0]['amazon_url']; ?>" placeholder="Amazon Url" class="form-control">
                                            </div> -->
                                            <!-- <div class="form-group">
                                                <label>Amazon Bussiness Id</label>
                                                <input type="email" name="amazon_email" required value="<?php if(isset($profile_details[0]['amazon_email'])) echo $profile_details[0]['amazon_email']; ?>" placeholder="Amazon Bussiness Id" class="form-control">
                                            </div> -->
                                            <!-- <input type="submit" class="btn submit_btn" value="Update" /> -->
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="money_order">
                                    <form method="post" action="<?php echo $this->request->webroot; ?>trainers/updateBankDetails">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea class="form-control" name="money_order_address" required rows="5" ><?php if(isset($profile_details[0]['money_order_address'])) echo $profile_details[0]['money_order_address']; ?></textarea>
                                            </div>
                                            <input type="submit" class="btn submit_btn" value="Update" />
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane password" id="password">
                            	<h3 class="trai_title_sect">Change Password </h3>

                                <?php echo $this->Custom->successMsg(); ?>
                                <?php echo $this->Custom->errorMsg(); ?>
                                <?php echo $this->Custom->loadingImg(); ?>
                                

                                <div class="form_wrapper">
                                    <div class="form-group">
                                        <label>Current Password </label>
                                        <input type="password" name="trainer_password" id="current_pswd" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>New Password </label>
                                        <input type="password" name="trainer_password" id="new_pswd" class="form-control">
                                    </div>
                                    <input type="hidden" value="<?php echo $profile_details[0]['trainer_password']; ?>" id="old_pswd">
                                    <div class="form-group">
                                        <label>Confirm Password </label>
                                        <input type="password" name="trainer_password" id="cnfm_pswd" class="form-control">
                                    </div>
                                </div>
                                <input type="button" class="btn submit_btn" id="change_pswd" value="Update" />
                            </div>
                            <div role="tabpanel" class="tab-pane achievements" id="achievements">
                            	<h3 class="trai_title_sect">Achievements</h3>
                                <?=  $this->Flash->render('edit4') ?>
                                <form method="post" action="<?php echo $this->request->webroot; ?>trainers/updatePersonalInfo/achievements">
                                <h4>Biography</h4>
                                <div class="form_wrapper">
                                    <div class="form-group">
                                        <textarea name="biography" class="form-control" cols="5" role="4"> <?php echo $profile_details[0]['biography']; ?></textarea>
                                    </div>
                                </div>
                                <h4>Certification</h4>
                                <div class="form_wrapper">
                                    <div class="form-group">
                                        <textarea name="certification" class="form-control" cols="5" role="4"><?php echo $profile_details[0]['certification']; ?> </textarea>
                                    </div>
                                </div>
                                 <h4>Awards</h4>
                                <div class="form_wrapper">
                                    <div class="form-group">
                                        <textarea name="awards" class="form-control" cols="5" role="4"> <?php echo $profile_details[0]['awards']; ?></textarea>
                                    </div>
                                </div>
                                 <h4>Accomplishments</h4>
                                <div class="form_wrapper">
                                    <div class="form-group">
                                        <textarea name="accomplishments" class="form-control" cols="5" role="4"> <?php echo $profile_details[0]['accomplishments']; ?></textarea>
                                    </div>
                                </div>
                                <input type="submit" class="btn submit_btn"  value="Update" />
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane others" id="others">
                                <?=  $this->Flash->render('edit5') ?>
                                <form method="post" action="<?php echo $this->request->webroot; ?>trainers/updatePersonalInfo/others">
                                <h3 class="trai_title_sect">Others</h3>
                                
                               <h4>Location</h4>
                                <div class="form_wrapper">
                                    <div class="form-group">
                                        <textarea name="location" class="form-control" cols="5" role="4"> <?php echo $profile_details[0]['location']; ?></textarea>
                                    </div>
                                </div>
                                 <h4>Credentials</h4>
                                <div class="form_wrapper">
                                    <div class="form-group">
                                        <textarea name="credentials" class="form-control" cols="5" role="4"> <?php echo $profile_details[0]['credentials']; ?></textarea>
                                    </div>
                                </div>
                                 <h4>Interests*</h4>
                                <div class="form_wrapper">
                                    <div class="form-group">
                                        <textarea name="interests_hobby" class="form-control" cols="5" role="4"> <?php echo $profile_details[0]['interests_hobby']; ?></textarea>
                                    </div>
                                </div>
                                 <h4>Hobbies*</h4>
                                <div class="form_wrapper">
                                    <div class="form-group">
                                        <textarea name="hobby" class="form-control" cols="5" role="4"> <?php echo $profile_details[0]['hobby']; ?></textarea>
                                    </div>
                                </div>
                                 <input type="submit" class="btn submit_btn"  value="Update" />
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane quotes" id="quotes">
                                <h3 class="trai_title_sect">Quotes</h3>
                                <?=  $this->Flash->render('edit6') ?>

                                <?php echo $this->Custom->successMsg(); ?>
                                <?php echo $this->Custom->errorMsg(); ?>
                                <?php echo $this->Custom->loadingImg(); ?>
                                <div class="form_wrapper">
                                   <input type="button" data-toggle="modal" data-target="#myModal" style="float:right;" class="btn submit_btn" id="add_quotes" value="Add Quotes" />
                                </div></br></br>
                                <div class="table-responsive">
                                    <table class="table table-striped  table-hover trainers_table_cont" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Content</th>
                                                <th width="14%" align="center">Added Date</th>
                                                <th width="10%" align="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1;
                                        foreach($quotes as $q) { ?>
                                            <tr id="row_<?php echo $q['id']; ?>">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $q['lt_content']; ?></td>
                                                <td><?php echo date('d F, h:i A', strtotime($q["lt_added_date"])); ?></td>
                                                <td class="table_icon_btn">
                                                   <a class="icon_btn delete" href="javascript:void(0);"  title="Delete Quotes" main="<?php echo $q['id']; ?>"><i class="fa fa-trash-o"></i></a>  
                                                </td>
                                            </tr>
                                        <?php $i++; }  ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane " id="rateplan">
                                <h3 class="trai_title_sect">Rate Plan</h3>
                                  <div class="form_wrapper">
                                        <div class="form-group">
                                        <label>Enter Hourly Rate</label>
                                        <div class="row">
                                          <div class="col-sm-11">
                                            <input type="text" name="rate" id="rate" class="form-control" value="<?php echo $trainerratedetail[0]['rate_hour'];?>">
                                            <input type="hidden" name="rateid" id="rateid" value="<?php echo $trainerratedetail[0]['rate_id'];?>">
                                           </div>
                                        <div class="col-sm-1">
                                           <div class="session">/Session</div>
                                        </div>
                                       </div>
                                    </div>
                                    <a class="btn submit_btn set_rate" href="javascript:">submit</a>
                                     <?php
                                    if(!empty($trainerratedetail)) { $rate1=1*$trainerratedetail[0]['rate_hour']-$trainerratedetail[0]['adgust1'];$rate2=3*$trainerratedetail[0]['rate_hour']-$trainerratedetail[0]['adgust2'];$rate3=10*$trainerratedetail[0]['rate_hour']-$trainerratedetail[0]['adgust3'];$rate4=20*$trainerratedetail[0]['rate_hour']-$trainerratedetail[0]['adgust4'];} ?>


                                      <div class="plan_session">
                                       <h5>Rate Plan</h5>
                                       <div class="plan_session_content">
                                         <ul>
                                           <li>
                                             <div class="session_top">
                                               <div class="session_head">1 Session</div>
                                               <div class="price_session rate1">$<?php echo $rate1;?></div>
                                             </div>
                                             <div class="session_bottom">
                                              <input type="text" ratet="1" value="<?php echo $trainerratedetail[0]['adgust1'];?>" id="adjust1"   class="form-control adjust">
                                             </div>
                                           </li>
                                           <li>
                                             <div class="session_top">
                                               <div class="session_head">3 Session</div>
                                               <div class="price_session rate2">$<?php echo $rate2;?></div>
                                             </div>
                                             <div class="session_bottom">
                                              <input type="text" ratet="2" value="<?php echo $trainerratedetail[0]['adgust2'];?>" id="adjust2" class="form-control adjust">
                                             </div>
                                           </li>
                                           <li>
                                             <div class="session_top">
                                               <div class="session_head">10 Session</div>
                                               <div class="price_session rate3">$<?php echo $rate3;?></div>
                                             </div>
                                             <div class="session_bottom">
                                              <input type="text" ratet="3" value="<?php echo $trainerratedetail[0]['adgust3'];?>" id="adjust3"  class="form-control adjust">
                                             </div>
                                           </li>
                                           <li>
                                             <div class="session_top">
                                               <div class="session_head">20 Session</div>
                                               <div class="price_session  rate4" >$<?php echo $rate4;?></div>
                                             </div>
                                             <div class="session_bottom">
                                              <input type="text" value="<?php echo $trainerratedetail[0]['adgust4'];?>" ratet="4" id="adjust4" class="form-control adjust">
                                             </div>
                                           </li>
                                         </ul>
                                       </div>


                                      </div>
                                <a class="btn submit_btn set_adjust" href="javascript:">Adjust</a>
                               </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="package">
                                <h3 class="trai_title_sect">Packages</h3>
                                <div class="form_wrapper" id="custom_packages"  <?php if(count($package_list) == 6) echo "style='display:none'"; ?> >
                                    <div class="form-group">
                                        <label>Manage Packages</label>
                                        <input type="text" name="package_name" id="package_name" class="form-control" placeholder="Package Name">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" id="package_detail" name="package_detail" cols="5" role="4" placeholder="Description"></textarea>
                                    </div>
                                    <input type="hidden" id="hidden_packeage_id" name="hidden_packeage_id" value="">
                                    <div class="form-group">
                                     <div class="row">
                                       <div class="col-sm-3">
                                         <input type="text" class="form-control" name="package_price" id="package_price" placeholder="price">
                                       </div>
                                      </div>
                                    </div>
                                     <a class="btn addpack submit_btn" href="javascript:">create</a>
                                </div>
                                <div class="plan_session">
                                    <h5>Custom Packages</h5>
                                   <div class="session_slider">
                                     <div class="owl-demo6">
                                      <?php
                                         if(!empty($package_list)) { foreach($package_list as $package){?> 
                                       <div class="item" id="pac_<?php echo  $package['package_id'];?>">
                                       <div class="session_top">
                                           <div class="session_head"><?php echo  $package['package_name'];?><a href="javascript:void(0);" class="edit-package-btn" main="<?php echo  $package['package_id'];?>"><i class="fa fa-edit"></i></a></div>
                                           <div class="price_session"><?php echo  $package['package_discription'];?></div>
                                           <a href="javascript:void(0);" class="order_btn"><?php echo "$".$package['package_price'];?></a>
                                         </div>
                                         
                                      </div>
                                      <?php } } ?>

                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane certifications" id="certifications">
                                <h3 class="trai_title_sect">Certifications</h3>
                                <?=  $this->Flash->render('edit7') ?>
                                <?php echo $this->Custom->errorMsg(); ?>
                                <div class="form_wrapper">
                                   <input type="button" data-toggle="modal" data-target="#certificationsModal" style="float:right;" class="btn submit_btn" id="add_certifications" value="Add Certifications" />
                                </div></br></br>
                                <div class="table-responsive">
                                    <table class="table table-striped  table-hover trainers_table_cont" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Certificate</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1;
                                        foreach($certificates as $c) { ?>
                                        <tr id="row_<?php echo $c['id']; ?>">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $c['document_name']; ?></td>
                                            <td>
                                            <?php if($c['publish_type'] == 0){
                                                echo "Private";
                                                }
                                                else{
                                                    echo "Public";
                                                } ?></td>
                                            <td class="table_icon_btn">
                                               <a class="icon_btn" href="<?php echo $this->request->webroot; ?>trainers/downloadDocument/<?php echo $c['document_file']; ?>" class="download_certificate" title="Download Certificate"><i class="fa fa-download"></i></a> |
                                               <a class="icon_btn delete_certificate" href="javascript:void(0);"  title="Delete Certificate" main="<?php echo $c['id']; ?>"><i class="fa fa-trash-o"></i></a>  
                                            </td>
                                        </tr>
                                        <?php $i++; }  ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane resume" id="resume">
                                <h3 class="trai_title_sect">Resume</h3>
                                <?=  $this->Flash->render('edit8') ?>
                                 <?php echo $this->Custom->errorMsg(); ?>
                                <div class="form_wrapper">
                                   <input type="button" data-toggle="modal" data-target="#resumeModal" style="float:right;" class="btn submit_btn" id="add_certifications" value="Add Resume" />
                                </div></br></br>
                                <div class="table-responsive">
                                    <table class="table table-striped  table-hover trainers_table_cont" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Resume</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1;
                                        foreach($resume as $r) { ?>
                                        <tr id="row_<?php echo $r['id']; ?>">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $r['document_file']; ?></td>
                                            <td>
                                            <?php if($r['publish_type'] == 0){
                                                echo "Private";
                                                }
                                                else{
                                                    echo "Public";
                                                } ?></td>
                                            <td class="table_icon_btn">
                                               <a class="icon_btn"  href="<?php echo $this->request->webroot; ?>trainers/downloadDocument/<?php echo $r['document_file']; ?>" title="Download Resume"><i class="fa fa-download"></i></a> |
                                               <a class="icon_btn delete_certificate"  href="javascript:void(0);"  title="Delete Resume" main="<?php echo $r['id']; ?>"><i class="fa fa-trash-o"></i></a>  
                                            </td>
                                        </tr>
                                        <?php $i++; }  ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane access_gym active" id="addgym"  style="opacity: 0;">

                                <h4>favorite gym</h4>
                                <div class="access_gym_form">
                                <form name="gym" method="post">
                                  <div class="form-group">
                                    <input type="text" class="form-control" placeholder="name" name="name">
                                  </div>
                                 
                                  <div class="form-group" >
	
                                    <input type="text" class="form-control" placeholder="address" name="address" id="address111">
                                    <input type="hidden" class="form-control" value="0" name="lat" id="lat">
                                    <input type="hidden" class="form-control" value="0" name="long" id="long">

                                  </div>
                                   <button type="submit" name="addgym" class="gym_favorite">add favorite</button>

                                </form>
                                
                                </div>
                                <div class="add_gym pull-right"><button>add gym</button></div>
                                
                                <div class="access_map">
									<!--<div id="gmap_canvas2"></div>-->
									
<style type="text/css">
    #gmap-dropdown1 {
      width: 400px;
      height: 400px;
    }
  </style> 
  <?php //print_r($gyms); ?>
<div id="gmap-dropdown1">map</div>
<script>
  
$('.addgym').on('click',function(){
  
  $('#addgym').css('opacity','1');
  $('#gmap-dropdown1').css('width','100%');
  $('#gmap-dropdown1').css('height','400px');
  var map = new GMaps({
      el: '#gmap-dropdown1',
      lat: -12.043333,
      lng: -77.028333
    });
  <?php 
foreach($gyms as $gym){
?>
var latitude = "<?php echo $gym->latitude; ?>";
var longitude = "<?php echo $gym->longitude; ?>";
var address = "<?php echo $gym->address; ?>"; 
console.log('address '+address);
console.log('longitude '+longitude);
console.log('latitude '+latitude);
map.addMarker({
  lat: latitude,
  lng:longitude,
  title:address,
  click: function(e) {
    alert(address);
  }
}); 
map.setCenter(latitude,longitude);
map.zoom(8);
<?php 
	
}
?>   
})

</script>
                                 <!-- <img src="../images/fitness1.jpg"> -->
                                  <!--  <div id="gmap_canvas"></div>-->
                                    
                                </div>
                            </div>

                           
                            <!-- Quotes Modal Start -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Quotes</h4>
                                  </div>
                                  <div class="modal-body">
                                    <form method="post" action="<?php echo $this->request->webroot; ?>trainers/addQuotes/quotes" >
                                      <div class="col-md-12">                        
                                          <div class="col-md-4"><p style="text-align:center;margin-top:20px;">Content</p></div>
                                          <div class="col-md-8">
                                            <textarea required name="lt_content" class="form-control" rows="2"></textarea>
                                          </div>
                                      </div></br></br>
                                   </div></br>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <!-- Quotes Modal End -->

                            <!-- Certifications Modal Start -->
                            <div class="modal fade" id="certificationsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Certifications</h4>
                                  </div>
                                  <div class="modal-body">
                                  <div class="certificate_msgs">
                                        <?php echo $this->Custom->errorMsg(); ?>
                                  </div>
                                    <form method="post" action="<?php echo $this->request->webroot; ?>trainers/addDocuments/certifications" enctype="multipart/form-data">
                                      <div class="col-md-12">                        
                                          <div class="col-md-4">Certificate Name</div>
                                          <div class="col-md-8">
                                          <input type="text" required class="form-control" name="document_name">
                                          </div>
                                      </div></br></br>
                                      <div class="col-md-12">                        
                                          <div class="col-md-4">Certificate File</div>
                                          <div class="col-md-8">
                                          <input type="file" main="certificate" id="document_file" required class="form-control" name="document_file">
                                          </div>
                                      </div></br></br>
                                      <div class="col-md-12">                        
                                          <div class="col-md-4">Publish Type</div>
                                          <div class="col-md-8">
                                          <select class="form-control" required name="publish_type">
                                              <option value="">Select Publish Type</option>
                                              <option value="0">Private</option>
                                              <option value="1">Public</option>
                                          </select>
                                          </div>
                                      </div></br></br>
                                   </div></br>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <!-- Certifications Modal End -->

                            <!-- Resume Modal Start -->
                            <div class="modal fade" id="resumeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Resume</h4>
                                  </div>
                                  <div class="modal-body">
                                  <div class="resume_msgs">
                                        <?php echo $this->Custom->errorMsg(); ?>
                                  </div>
                                    <form method="post" action="<?php echo $this->request->webroot; ?>trainers/addDocuments/resume" enctype="multipart/form-data">
                                      <div class="col-md-12">                        
                                          <div class="col-md-4">Resume File</div>
                                          <div class="col-md-8">
                                          <input type="file" main="resume" id="document_file_resume" required class="form-control" name="document_file">
                                          </div>
                                      </div></br></br>
                                      <div class="col-md-12">                        
                                          <div class="col-md-4">Publish Type</div>
                                          <div class="col-md-8">
                                          <select class="form-control" required name="publish_type">
                                              <option value="">Select Publish Type</option>
                                              <option value="0">Private</option>
                                              <option value="1">Public</option>
                                          </select>
                                          </div>
                                      </div></br></br>
                                   </div></br>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <!-- Resume Modal End -->
                        </div>
                    </div>
                          
                    <div class="clearfix"></div>
                    	  <!-- <a class="btn submit_btn" href="#">Update</a> -->
                </div>
                </div>
            </div>
        </div>
     </section>   
  
    </div>
    <!--Main container sec end-->
  </main>

  <!-- Change Password Start -->
  
  <script type="text/javascript">
  $(document).ready(function(){ 
    $('#change_pswd').click(function(){
        var current_pswd = $('#current_pswd').val();
        var new_pswd = $('#new_pswd').val();
        var cnfm_pswd = $('#cnfm_pswd').val();
        var old_pswd = $('#old_pswd').val();
        if(current_pswd == "" || new_pswd =="" || cnfm_pswd == "")
        {
            $("div#password div#error_msg").html("<center><i class='fa fa-times'> Please Fill All Fields First ! </i></center>").show();
            $("div#password div#success_msg").hide();
            return false;
        }
        if(current_pswd != old_pswd)
        {
            $("div#password div#error_msg").html("<center><i class='fa fa-times'> Wrong Current Password ! </i></center>").show();
            $("div#password div#success_msg").hide();
            return false;
        }
        if(new_pswd != cnfm_pswd)
        {
            $("div#password div#error_msg").html("<center><i class='fa fa-times'> Password Not Matched ! </i></center>").show();
            $("div#password div#success_msg").hide();
            return false;
        }
        if(old_pswd == new_pswd)
        {
            $("div#password div#error_msg").html("<center><i class='fa fa-times'>  You Didn`t Have Any Changes !</i></center>").show();
            $("div#password div#success_msg").hide();
            return false;
        }
        $('div#password img#loading-img').show();
        $.ajax({
                url:"<?php echo $this->request->webroot; ?>trainers/changePassword",
                type:"post",
                data:{new_pswd : new_pswd},   
                dataType : "json",                 
                success: function(data){
                     $('div#password img#loading-img').hide();
                    if(data.message == "success")
                    {
                        $('#old_pswd').val(new_pswd);
                        $('input[type="password"]').val("");
                        $("div#password div#success_msg").html("<center><i class='fa fa-check'> Password Successfully Changed </i></center>").show();
                        $("div#password div#error_msg").hide();
                    }
                    else
                    {
                        $("div#password div#error_msg").html("<center><i class='fa fa-times'>  Something is Wrong Please Try Again !</i></center>").show();
                        $("div#password div#success_msg").hide();
                    }
                    
            }
            });

    });
  });
  </script>

  <!-- Change Password End -->

    <!-- Profile Image Uploading Start -->

    <script type="text/javascript">
        $(document).ready(function(){
        $('#trainer_profile_img').change(function(){
            var file_name = $(this).val();
            var fileObj = this.files[0]; // get file object
            var calculatedSize = fileObj.size/(1024*1024); // in MB
            var split_extension = file_name.split(".");
            var ext = [ "jpg", "gif" ];
            if(jQuery.inArray(split_extension[1].toLowerCase(), ext ) == -1)
            {
                $('#trainer_profile_img').val(fileObj.value = null);
                $("div.img-profile div#error_msg").html("<center><i class='fa fa-times'> You Can Upload Only .jpg, gif files ! </i></center>").show();
                $("div.img-profile div#success_msg").hide();
                return false;
            }
            if(calculatedSize > 10)
            {
                $('#trainer_profile_img').val(fileObj.value = null);
                $("div.img-profile div#error_msg").html("<center><i class='fa fa-times'>  File size should be less than 10 MB ! </i></center>").show();
                return false;
            }
            if(jQuery.inArray(split_extension[1].toLowerCase(), ext ) != -1 && calculatedSize < 10)
            {
                    $("div.img-profile div#error_msg").hide();
                    $('div.img-profile img#loading-img').show();
                    var data = new FormData($('#profile_form')[0]);
                    $.ajax({
                        type: "post",
                        url: "<?php echo $this->request->webroot; ?>trainers/updateProfileImage",
                        data: data,
                        dataType : "json",
                        contentType: false,
                        processData: false,
                        success: function(data){
                           if(data.message != "")
                               {
                                $('img#profile-img').attr('src','<?php echo $this->request->webroot; ?>uploads/trainer_profile/' + data.message);
                                $("div.img-profile div#success_msg").html("<center><i class='fa fa-check'> Image Uploaded Successfully </i></center>").show();
                                $("div.img-profile div#error_msg").hide();
                               }
                            else
                                {
                                $("div.img-profile div#error_msg").html("<center><i class='fa fa-times'> Something is Wrong Please Try Again ! </i></center>").show();
                                $("div.img-profile div#success_msg").hide();
                                }
                             $('img#loading-img').hide();
                        }
                    });
            }
        });
        });
    </script>

    <!-- Profile Image Uploading End --> 

<!-- Delete Quotes Start -->
	<script type="text/javascript">
	function getLatLong(address=''){
	var geocoder = new google.maps.Geocoder();
	//var address = "new york";
	var latitude='0'; var longitude='0';
	geocoder.geocode( { 'address': address}, function(results, status) {

	if (status == google.maps.GeocoderStatus.OK) {
	 latitude = results[0].geometry.location.lat();
	 longitude = results[0].geometry.location.lng();
	  console.log('sssss'+longitude);
	  $('#lat').val(latitude);
	  $('#long').val(longitude);
	} 
	});
	
	} 

</script>
<script type="text/javascript">
    $(document).ready(function(){     
		
		
		
		$('#address111').on('change',function(){
	//alert();
	getLatLong($(this).val());	
	console.log('call '+$(this).val());
	});
         $(".table").on('click','.delete',function(){
          if (confirm("Are You Sure?")) {
            var id = btoa($(this).attr('main'));
            var table = ['Latest_things'];
            $.ajax({
                    url:"<?php echo $this->request->webroot; ?>trainers/delete",
                    type:"post",
                    data:{id:id, table:table},
                    dataType:"json",
                    success: function(data){
                        if(data.message == 'success')
                        {
                            $('tr#row_'+atob(id)).remove();
                        }
                    }
                });
             }
          else{
            return false;
          }
        });
    });
</script>

<!-- Delete Quotes End -->  

<!-- Delete Certificate Start -->

<script type="text/javascript">
    $(document).ready(function(){
         $(".table").on('click','.delete_certificate',function(){
          if (confirm("Are You Sure?")) {
            var id = btoa($(this).attr('main'));
            var table = ['Documents'];
            $.ajax({
                    url:"<?php echo $this->request->webroot; ?>trainers/delete",
                    type:"post",
                    data:{id:id, table:table},
                    dataType:"json",
                    success: function(data){
                        if(data.message == 'success')
                        {
                            $('tr#row_'+atob(id)).remove();
                        }
                    }
                });
             }
          else{
            return false;
          }
        });
    });
</script>

<!-- Delete Certificate End --> 

<!-- State Populate Start -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#trainer_country').change(function(){
            var state = $(this).val();
            $.ajax({
                    url:"<?php echo $this->request->webroot; ?>users/getStates",
                    type:"post",
                    data:{state : state},   
                    dataType : "json",  
                    beforeSend: function() {
                        $('.loading').show();
                        $('.loading_icon').show();
                     },               
                    success: function(data){
                        $('.loading').hide();
                        $('.loading_icon').hide();
                        if(data.message != ""){
                        var states = data.message;
                        var i;
                        var option;
                        option += '<option value="">State</option>';
                        for(i = 0; i < states.length; i++)
                         {
                            option += '<option value="'+states[i]["id"]+'">' + states[i]["name"] + '</option>';
                         }
                         $('#trainer_state').html(option);
                        }
                    }
                });
        });
    });
</script>
<!-- State Populate End -->

<!-- City Populate Start -->
<script type="text/javascript">
$(document).ready(function(){
    $('#trainer_state').change(function(){
        var city = $(this).val();
        $.ajax({
                url:"<?php echo $this->request->webroot; ?>users/getCities",
                type:"post",
                data:{city : city},   
                dataType : "json",  
                beforeSend: function() {
                    $('.loading').show();
                    $('.loading_icon').show();
                 },               
                success: function(data){
                    $('.loading').hide();
                    $('.loading_icon').hide();
                    if(data.message != ""){
                    var cities = data.message;
                    var i;
                    var option;
                    option += '<option value="">City</option>';
                    for(i = 0; i < cities.length; i++)
                     {
                        option += '<option value="'+cities[i]["id"]+'">' + cities[i]["name"] + '</option>';
                     }
                     $('#trainer_city').html(option);
                    }
                }
            });
    });
});
</script>
<!-- City Populate End -->

<!-- Certificate Validation Start -->

<script type="text/javascript">
  $(document).ready(function(){
  $('#document_file').change(function(){
        var type = $(this).attr('main');
        var file_name = $(this).val();
        var fileObj = this.files[0]; // get file object
        var calculatedSize = fileObj.size/(1024*1024); // in MB
        var split_extension = file_name.split(".");
        var ext = [ "jpg", "gif" ];
        if(jQuery.inArray(split_extension[1].toLowerCase(), ext ) == -1)
            {
              $('#document_file').val(fileObj.value = null);
              $("div.certificate_msgs div#error_msg").html("<center><i class='fa fa-times'> You Can Upload Only .jpg, gif Files ! </i></center>").show();
              return false;
            }
        if(calculatedSize > 3)
            {
                $('#document_file').val(fileObj.value = null);
                $("div.certificate_msgs div#error_msg").html("<center><i class='fa fa-times'>  File size should be less than 3 MB ! </i></center>").show();
                return false;
            }
        if(jQuery.inArray(split_extension[1].toLowerCase(), ext ) != -1 && calculatedSize < 3)
            {
              $("div.certificate_msgs div#error_msg").hide();
            }   
      });
  });
</script>

<!-- Certificate Validation End --> 

<!-- Resume Validation Start -->

<script type="text/javascript">
  $(document).ready(function(){
  $('#document_file_resume').change(function(){
        var type = $(this).attr('main');
        var file_name = $(this).val();
        var fileObj = this.files[0]; // get file object
        var calculatedSize = fileObj.size/(1024*1024); // in MB
        var split_extension = file_name.split(".");
        var ext = [ "doc", "docs", "docx" , "odt", "ppt", "pdf" ];
        if(jQuery.inArray(split_extension[1].toLowerCase(), ext ) == -1)
            {
              $('#document_file_resume').val(fileObj.value = null);
              $("div.resume_msgs div#error_msg").html("<center><i class='fa fa-times'> You Can Upload Only .doc, docx, ppt, pdf, odt Files ! </i></center>").show();
              return false;
            }
        if(calculatedSize > 2)
            {
                $('#document_file_resume').val(fileObj.value = null);
                $("div.resume_msgs div#error_msg").html("<center><i class='fa fa-times'>  File size should be less than 2 MB ! </i></center>").show();
                return false;
            }
        if(jQuery.inArray(split_extension[1].toLowerCase(), ext ) != -1 && calculatedSize < 2)
            {
              $("div.resume_msgs div#error_msg").hide();
            }   
      });
  });
</script>

<!-- Resume Validation End -->

<script type="text/javascript">
    $(document).ready(function(){ 
		
        var pageURL = $(location).attr("href");
        var splitURL = pageURL.split("/"); 
        var result = splitURL[splitURL.length - 1];  

        if(result == "completeProfile")
            {
                $('.'+result).removeClass('active');
                $('.informaiton').addClass('active');
            }
        else
            {
                $('.informaiton').removeClass('active');
                $('.'+result).addClass('active');
            }

    $('body').on('click','.set_rate',function(){
        var rate=$('#rate').val();
        var rateid=$('#rateid').val();
        var number = /[0-9 -()+]+$/; 
        if(rate=="" || !number.test(rate))
        {
            $('#rate').val(); 
            $("#rate").css({"border-color": "red", "border-weight":"1px", "border-style":"solid"});
             return false;
        }
        else
        {
            $("#rate").css({"border-color": "#ccc","border-weight":"1px", "border-style":"solid"});
        }
         $.ajax({
                url:"<?php echo $this->request->webroot; ?>trainers/setrate",
                type:"post",
                data:{rate:rate,rateid:rateid},
                dataType:"json",
                success: function(data){
                    $('.plan_session').html(data.message);
                }
            });
    });
    
    $('body').on('keyup','.adjust',function(){
        rate     = $('#rate').val();
        adjust   = $(this).val();
        ratetype = $(this).attr('ratet');

          if(ratetype==1)
          {
             ratetypes=1;
          }
           else if(ratetype==2)
          {
             ratetypes=3;
          }
          else if(ratetype==3)
          {
             ratetypes=10;
          }

           else if(ratetype==4)
          {
             ratetypes=20;
          }
      setfinalrate=rate*ratetypes-adjust;
      $('.rate'+ratetype).html("$"+setfinalrate);
    });

    $('body').on('click','.set_adjust',function(){
        var rateid=$('#rateid').val();
        var adjust1=$('#adjust1').val();
        var adjust2=$('#adjust2').val();
        var adjust3=$('#adjust3').val();
        var adjust4=$('#adjust4').val();
        var number = /[0-9 -()+]+$/; 
        var status=0;
        if(adjust1=="" || !number.test(adjust1))
        {
            $("#adjust1").css({"border-color": "red", 
            "border-weight":"1px", 
            "border-style":"solid"});
            status=1;
        }
        else
        {
            $("#adjust1").css({"border-color": "#ccc", 
            "border-weight":"1px", 
            "border-style":"solid"});
        }
        if(adjust2=="" || !number.test(adjust2))
        {
            $("#adjust2").css({"border-color": "red", 
            "border-weight":"1px", 
            "border-style":"solid"});
            status=1;
        }
        else
        {
            $("#adjust2").css({"border-color": "#ccc", 
            "border-weight":"1px", 
            "border-style":"solid"});
        }
        if(adjust3=="" || !number.test(adjust3))
        {
            $("#adjust3").css({"border-color": "red", 
            "border-weight":"1px", 
            "border-style":"solid"});
            status=1;
        }
        else
        {
            $("#adjust3").css({"border-color": "#ccc", 
            "border-weight":"1px", 
            "border-style":"solid"});
        }
        if(adjust4=="" || !number.test(adjust4))
        {
            $("#adjust4").css({"border-color": "red", 
            "border-weight":"1px", 
            "border-style":"solid"});
            status=1;
        }
        else
        {
            $("#adjust4").css({"border-color": "#ccc", 
            "border-weight":"1px", 
            "border-style":"solid"});
        }
        if(status==1)
        {
            return false;
        }
        $.ajax({
            url:"<?php echo $this->request->webroot; ?>trainers/adjust",
            type:"post",
            data:{rateid:rateid,adjust1:adjust1,adjust2:adjust2,adjust3:adjust3,adjust4:adjust4},
            dataType:"json",
            success: function(data){
            }
        });
    });

    $('.addpack').click(function(){
        var package_name=$('#package_name').val();
        var package_detail=$('#package_detail').val();
        var package_price=$('#package_price').val();  
        var hidden_packeage_id=$('#hidden_packeage_id').val();
        var number = /[0-9 -()+]+$/; 
        status=1;
        if(package_name=="")
        {
            $("#package_name").css({"border-color": "red", 
            "border-weight":"1px", 
            "border-style":"solid"});
            status=0;
        }
        else
        {
            $("#package_name").css({"border-color": "#ccc", 
            "border-weight":"1px", 
            "border-style":"solid"});
        }
        if(package_detail=="")
        {
              
            $("#package_detail").css({"border-color": "red", 
            "border-weight":"1px", 
            "border-style":"solid"});
            status=0;
        }
        else
        {
            $("#package_detail").css({"border-color": "#ccc", 
            "border-weight":"1px", 
            "border-style":"solid"});
        }
        if(package_price=="" || !number.test(package_price))
        {
            $("#package_price").css({"border-color": "red", 
            "border-weight":"1px", 
            "border-style":"solid"});
            status=0;
        }
        else
        {
            $("#package_price").css({"border-color": "#ccc", 
            "border-weight":"1px", 
            "border-style":"solid"});
        }
        if(status==0)
        {
            return false;
        }
        $.ajax({
            url:"<?php echo $this->request->webroot; ?>trainers/addpackage",
            type:"post",
            data:{package_name:package_name,package_detail:package_detail,package_price:package_price,hidden_packeage_id:hidden_packeage_id},
            dataType:"json",
            success: function(data){
                if(hidden_packeage_id != ""){
                    $('.owl-demo6 #pac_'+hidden_packeage_id).html(data.message);
                }else{
                    $('.owl-demo6').append(data.message);
                    $('.osession_slider').append(data.message);
                }
                $('#package_name').val('');
                $('#package_detail').val('');
                $('#package_price').val('');
                $('#hidden_packeage_id').val('');
                var totalitem=$('.item').length;
                if(totalitem>5)
                {
                   $('#custom_packages').hide();
                }
            }
        });
    });

    $('body').on('click','.edit-package-btn',function(){
        var pack_id = $(this).attr('main');
        $.ajax({
            url:"<?php echo $this->request->webroot; ?>trainers/getPackageData",
            type:"post",
            data:{pack_id:pack_id},
            dataType:"json",
            success: function(response){
                var data = response.message[0];
                $('#package_name').val(data.package_name);
                $('#package_detail').val(data.package_discription);
                $('#package_price').val(data.package_price);
                $('#hidden_packeage_id').val(data.package_id); 
                $('#custom_packages').show();
            },
            error:function(error){
                console.log(error);  
            }
        });
    });

 });
</script>

<script type="text/javascript">
	
    $(document).ready(function(){ 
		



        /*var geocoder;
        var map;
        var markers = Array();
        var infos = Array();
        var lat = <?php echo $latlng["lat"]; ?>;
        var lng = <?php echo $latlng["lon"]; ?>;
        // var mygym = [{}]

        function initialize() {
            // prepare Geocoder
            geocoder = new google.maps.Geocoder();

            // set initial position (New York)
            var myLatlng = new google.maps.LatLng(lat,lng);

            var myOptions = { // default map options
                zoom: 14,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
            findPlaces();
        }

        // clear overlays function
        function clearOverlays() {
            if (markers) {
                for (i in markers) {
                    markers[i].setMap(null);
                }
                markers = [];
                infos = [];
            }
        }

        // clear infos function
        function clearInfos() {
            if (infos) {
                for (i in infos) {
                    if (infos[i].getMap()) {
                        infos[i].close();
                    }
                }
            }
        }

        

        // find custom places function
        function findPlaces() {

            // prepare variables (filter)
            var type = "gym";
            var radius = "1500";
            
            var cur_location = new google.maps.LatLng(lat, lng);
            
            // prepare request to Places
            var request = {
                location: cur_location,
                radius: radius,
                types: [type]
            };
            
            // send request
            service = new google.maps.places.PlacesService(map);
            service.search(request, createMarkers);
        }

        // create markers (from 'findPlaces' function)
        function createMarkers(results, status) {
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                // if we have found something - clear map (overlays)
                clearOverlays();
                // console.log(results);
                // and create new markers by search result
                for (var i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
            } else if (status == google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
                alert('Sorry, nothing is found');
            }
        }

        // creare single marker function
        function createMarker(obj) {
            var jay = obj.name;
            // prepare new Marker object
            var mark = new google.maps.Marker({
                position: obj.geometry.location,
                map: map,
                title: jay
            });
            markers.push(mark);

            // prepare info window
            var infowindow = new google.maps.InfoWindow({
                content: '<img src="' + obj.icon + '" /><font style="color:#000;">' + obj.name + 
                '<br />Rating: ' + obj.rating + '<br />Vicinity: ' + obj.vicinity + '</font>'
            });

            // add event handler to current marker
            google.maps.event.addListener(mark, 'click', function(event) {
                clearInfos();
                infowindow.open(map,mark);
                // console.log(obj);
                alert( "Latitude: "+event.latLng.lat()+" "+", longitude: "+event.latLng.lng()+"name = "+jay+" add "+obj.vicinity ); 
            });
            infos.push(infowindow);
        }

        // initialization
        google.maps.event.addDomListener(window, 'load', initialize);
        */

    });
</script> 
