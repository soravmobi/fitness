<?php include "trainee_dashboard.php"; ?>

<section class="trainee_dash_body">
<div class="main_container">
    <div class="customer_report_main customer_dashboard">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <!-- <div class="head_dashboard">
              <h3><i class="fa fa-exclamation-circle"></i> Any notifications that require the customer response or immediate attention displays here.</h3>
              <p>If there nothing to display than it dissapears</p>
            </div> -->
            <?php 
              $weather_details = $this->Custom->getWheatherDetails();
              $weather = $weather_details['main']['temp'];
              $windy   = $weather_details['wind']['speed'];
            ?>
            <div class="notification_wrap">
              <ul>
                <!-- <li>
                  <div class="cloud_box">
                    <div class="cloud"><i class="flaticon1-schedule" aria-hidden="true"></i></div>
                  </div>
                  <div class="cloud_text"> Current and <span>upcoming</span> <span>appointment</span> </div>
                </li> -->
                <li>
                  <div class="cloud_box">
                    <div class="cloud"><i class="fa fa-cloud" aria-hidden="true"></i></div>
                  </div>
                  <div class="cloud_text">
                    <div class="degree_main"><?php echo round($weather- 273.15,1); ?><span class="degree">0</span></div>
                    <span>Weather</span>
                  </div>
                </li>
                <li>
                  <div class="cloud_box">
                    <div class="cloud"><i class="flaticon1-money"></i></div>
                  </div>
                  <?php
                        if(empty($total_wallet_ammount)){
                            $wallet_balance =  "0";
                        }
                        else
                        {
                            $wallet_balance =  $total_wallet_ammount[0]['total_ammount'];
                        }
                    ?>
                  <div class="cloud_text"> my wallet
                    <div class="rate_box">$<?php echo round($wallet_balance,2); ?></div>
                  </div>
                </li>
                <li>
                  <div class="cloud_box">
                    <div class="cloud"><i class="flaticon1-scale"></i></div>
                  </div>
                  <div class="cloud_text"> Current weight : <?php echo $profile_details[0]['trainee_current_weight']; ?> LBS <span>goal : <?php echo $profile_details[0]['trainee_goal']; ?> LBS</span>
                  </div>
                </li>
                <!-- <li>
                  <div class="cloud_box">
                    <div class="cloud"><i class="fa fa-users" aria-hidden="true"></i></div>
                  </div>
                  <div class="cloud_text"> social media & news
                    <ul class="list_icon">
                      <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                      <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                      <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                      <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                  </div>
                </li>
                <li>
                  <div class="cloud_box">
                    <div class="cloud"><i class="fa fa-pencil" aria-hidden="true"></i></div>
                  </div>
                  <div class="cloud_text"> Health & tips
                    <ul class="list_icon">
                      <li  class="icon_bg1"><a href="#" ><i class="flaticon1-medical"></i></a></li>
                      <li class="icon_bg2"><a href="#" ><i class="flaticon1-food"></i></a></li>
                      <li class="icon_bg3"><a href="#" ><i class="flaticon1-dropper"></i></a></li>
                      <li class="icon_bg4"><a href="#"><i class="flaticon1-medical-1"></i></a></li>
                    </ul>
                  </div>
                </li> -->
              </ul>
            </div>
          </div>
        </div>
        <!-- <div class="Workout_wrap">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="session_setails_sec">
                <div class="heading_payment_main">
                  <h2>Workout SCHEDULE</h2>
                </div>
                <div class="session_content">
                  <div class="common_btn Get_Started">
                    <button class="Get_Started" type="submit">Let’s Get Started</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        <div class="meal_paln">
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="session_setails_sec work_out">
                <div class="heading_payment_main">
                  <h2>meal plans</h2>
                </div>
                <div class="session_content">
                  <ul class="nav_tabs">
                  <?php $i = 1; foreach($trainer_meal_plans as $m) { ?>
                    <li <?php if($i == 1){echo "class='active'";}?>><a data-toggle="tab" role="tab" aria-controls="profile" title="<?php echo $m['trainer_name']." ".$m['trainer_lname']; ?>" href="#profile_<?php echo $i; ?>"><?php echo substr($m['trainer_name']." ".$m['trainer_lname'],0,11); ?></a></li>
                  <?php $i++; } ?>
                  </ul>
                  <div class="tab-content">
                  <?php $j = 1; foreach($meal_plans_details as $md) { ?>
                    <div id="profile_<?php echo $j; ?>" class="tab-pane <?php if($j == 1){echo "active";}?>" role="tabpanel">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="table_meal">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th></th>
                                  <th>sunday</th>
                                  <th>monday</th>
                                  <th>tuesday</th>
                                  <th>wednesday</th>
                                  <th>Thursday </th>
                                  <th>Friday </th>
                                  <th>Saturday </th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 
                                $inner_arr = array();
                                $inner_arr = $md; 
                                foreach($inner_arr as $ia) { 
                              ?>
                                <tr>
                                  <td><?php echo $ia['meal_plan']; ?></td>
                                  <td><?php echo $ia['sunday']; ?></td>
                                  <td><?php echo $ia['monday']; ?></td>
                                  <td><?php echo $ia['tuesday']; ?></td>
                                  <td><?php echo $ia['wednesday']; ?></td>
                                  <td><?php echo $ia['thursday']; ?></td>
                                  <td><?php echo $ia['friday']; ?></td>
                                  <td><?php echo $ia['saturday']; ?></td>
                                </tr>
                              <?php } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php $j++; } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="graph_sec">
          <div class="row ">
            <div class="col-sm-6 col-md-6 text-right">
              <div class="img_link"> <img src="images/structure.png" alt="img" class="img-responsive image_link" usemap="#structure_link">
                <map name="structure_link">
                  <area title="My Trainers" href="#" shape="poly" coords="179,180,356,180,357,172,357,165,356,157,355,151,354,145,353,140,351,133,349,128,347,121,345,116,344,110,342,106,339,101,337,95,334,91,331,86,328,80,324,76,322,72,319,68,315,63,311,58,307,55,304,50,299,47,295,43,290,40,287,37,283,34,279,31,276,28,269,24,180,178"  data-placement="right" class="right-popover" id="crm" data-pcontent="crm_content" data-ptitle="crm_title">
                  <area title="Of Sessions" href="#" shape="poly" coords="180,179,269,25,252,16,238,11,224,6,209,3,195,1,180,0,164,1,149,3,136,5,122,9,108,14,89,23"  data-placement="top" class="top-popover" id="online_security" data-pcontent="online_security_content" data-ptitle="online_security_title">
                  <area title="Of Booking" href="#" shape="poly" coords="179,179,0,179,1,160,4,140,8,125,13,112,18,100,26,86,35,72,45,60,58,47,71,36,89,24"  data-placement="left" class="left-popover" id="field_activity" data-pcontent="field_activity_content" data-ptitle="field_activity_title">
                  <area title="Canceled" shape="poly" href="#" coords="179,180,0,179,1,199,4,217,9,235,15,252,23,268,33,284,46,300,58,313,72,323,89,335" data-placement="left" class="left-popover" id="debt_control" data-pcontent="debt_control_content" data-ptitle="debt_control_title">
                </map>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <ul class="graph_list">
                <li><a href="#"> <span class="squre"></span> My Trainers</a></li>
                <li><a href="#"><span class="squre blue"></span> Of Sessions</a></li>
                <li><a href="#"><span class="squre gray"></span> Of Booking</a></li>
                <li><a href="#"><span class="squre green"></span> Canceled</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="trainer_wrap_main">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-sm-4">
            <div class="trainer_wrap_box">
              <div class="heading_payment_main"> </div>
              <div class="trainer_top_main">
                <div class="trainer_top clearfix">
                  <h2>$45/HR</h2>
                </div>
                <div class="img_trainer"> <img src="images/trainer.png" class="img-responsive"> </div>
              </div>
              <div class="trainer_bottom">
                <div class="name_wrap">Andre Eloumou</div>
                <div class="location_wrap">
                  <ul>
                    <li><span>Location :</span> Ottawa, Canada</li>
                    <li><span>score :</span>
                      <div id="greencircle" data-percent="94" class="small green percircle animate gt50"> <span>94%</span>
                        <div class="slice">
                          <div style="transform: rotate(338.4deg);" class="bar"></div>
                          <div class="fill"></div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="describe_wrap">
                  <ul>
                    <p><span>Skills:</span> Biceps, Tricpes, Shoulder</p>
                    <p><span>Interests :</span> Make the world a better<span class="show_div"> place through fitness.</span></p>
                    <p><span>Certifications :</span> Certificate in Personal<span class="show_div"> Training CYQ Level 3.</span></p>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-4">
            <div class="trainer_wrap_box">
              <div class="heading_payment_main"> </div>
              <div class="trainer_top_main">
                <div class="trainer_top clearfix">
                  <h2>$45/HR</h2>
                </div>
                <div class="img_trainer"> <img src="images/trainer.png" class="img-responsive"> </div>
              </div>
              <div class="trainer_bottom">
                <div class="name_wrap">Andre Eloumou</div>
                <div class="location_wrap">
                  <ul>
                    <li><span>Location :</span> Ottawa, Canada</li>
                    <li><span>score :</span>
                      <div id="greencircle" data-percent="94" class="small green percircle animate gt50"> <span>94%</span>
                        <div class="slice">
                          <div style="transform: rotate(338.4deg);" class="bar"></div>
                          <div class="fill"></div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="describe_wrap">
                  <ul>
                    <p><span>Skills:</span> Biceps, Tricpes, Shoulder</p>
                    <p><span>Interests :</span> Make the world a better<span class="show_div"> place through fitness.</span></p>
                    <p><span>Certifications :</span> Certificate in Personal<span class="show_div"> Training CYQ Level 3.</span></p>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-4">
            <div class="trainer_wrap_box">
              <div class="heading_payment_main"> </div>
              <div class="trainer_top_main">
                <div class="trainer_top clearfix">
                  <h2>$45/HR</h2>
                </div>
                <div class="img_trainer"> <img src="images/trainer.png" class="img-responsive"> </div>
              </div>
              <div class="trainer_bottom">
                <div class="name_wrap">Andre Eloumou</div>
                <div class="location_wrap">
                  <ul>
                    <li><span>Location :</span> Ottawa, Canada</li>
                    <li><span>score :</span>
                      <div id="greencircle" data-percent="94" class="small green percircle animate gt50"> <span>94%</span>
                        <div class="slice">
                          <div style="transform: rotate(338.4deg);" class="bar"></div>
                          <div class="fill"></div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="describe_wrap">
                  <ul>
                    <p><span>Skills:</span> Biceps, Tricpes, Shoulder</p>
                    <p><span>Interests :</span> Make the world a better<span class="show_div"> place through fitness.</span></p>
                    <p><span>Certifications :</span> Certificate in Personal<span class="show_div"> Training CYQ Level 3.</span></p>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-4">
            <div class="trainer_wrap_box">
              <div class="heading_payment_main"> </div>
              <div class="trainer_top_main">
                <div class="trainer_top clearfix">
                  <h2>$45/HR</h2>
                </div>
                <div class="img_trainer"> <img src="images/trainer.png" class="img-responsive"> </div>
              </div>
              <div class="trainer_bottom">
                <div class="name_wrap">Andre Eloumou</div>
                <div class="location_wrap">
                  <ul>
                    <li><span>Location :</span> Ottawa, Canada</li>
                    <li><span>score :</span>
                      <div id="greencircle" data-percent="94" class="small green percircle animate gt50"> <span>94%</span>
                        <div class="slice">
                          <div style="transform: rotate(338.4deg);" class="bar"></div>
                          <div class="fill"></div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="describe_wrap">
                  <ul>
                    <p><span>Skills:</span> Biceps, Tricpes, Shoulder</p>
                    <p><span>Interests :</span> Make the world a better<span class="show_div"> place through fitness.</span></p>
                    <p><span>Certifications :</span> Certificate in Personal<span class="show_div"> Training CYQ Level 3.</span></p>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div> -->
        <div class="message_wrap">
          <div class="message_wrap_head">
            <h3>inbox </h3>
            <ul class="pagination">
              <li>Showing 1 - 10 of 96 Messages</li>
              <li> <a href="#" aria-label="Previous"> <span aria-hidden="true"><i class="fa fa-chevron-left"></i></span> </a> </li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li> <a href="#" aria-label="Next"> <span aria-hidden="true"><i class="fa fa-chevron-right"></i></span> </a> </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="message_wrap_content_box">
            <ul>
              <li><span class="flaticon1-tool"></span> Inbox</li>
              <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">action <i class="fa fa-chevron-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="javascript:void(0);"><i class="fa fa-trash-o"></i> Delete</a></li>
                  <li><a href="javascript:void(0);"><i class="fa fa-eye"></i> Mark Read</a></li>
                </ul>
              </li>
              <!-- <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">select <i class="fa fa-chevron-down"></i> </a>
                <ul class="dropdown-menu">
                  <li><a href="#">profile</a></li>
                  <li><a href="#">setting</a></li>
                </ul>
              </li> -->
              <li class="pull-right">
            </ul>
            <div class="message_wrap_content">
              <table class="table table-striped">
                <tbody>
                <?php $i = 1; foreach($messages as $m){ ?>
                  <tr>
                    <td><div class="squaredThree">
                        <input type="checkbox" value="None" id="squaredThree" name="check" checked />
                        <label for="squaredThree"></label>
                      </div></td>
                    <td><?php echo $m['trainer_name']." ".$m['trainer_lname']; ?></td>
                    <td><?php echo $m['chat_messsage']; ?></td>
                    <td><?php echo $m['chat_added_date']; ?></td>
                  </tr>
                <?php $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- <div class="resources_sec">
          <div class="head_resources"> Tools / Resources </div>
          <div class="resources_tab">
            <ul role="tablist" class="nav nav-tabs clearfix">
              <li class="active" role="presentation"><a data-toggle="tab" role="tab" aria-controls="Calorie" href="#Calorie"> Calorie Tracker</a></li>
              <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="Workout" href="#Workout"> Workout Plans </a></li>
              <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="Reciepies" href="#Reciepies">Reciepies</a></li>
              <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="Grocery" href="#Grocery">Grocery List</a></li>
            </ul>
            <div class="tab-content">
              <div id="Calorie" class="tab-pane active" role="tabpanel">
                <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <div class="img_resorces"> <img src="images/graph.png"> </div>
                  </div>
                  <div class="col-md-9 col-sm-9">
                    <div class="text_resorces">
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div id="Workout" class="tab-pane" role="tabpanel"> </div>
              <div id="Reciepies" class="tab-pane" role="tabpanel"> </div>
              <div id="Grocery" class="tab-pane" role="tabpanel"> </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>

</section>
