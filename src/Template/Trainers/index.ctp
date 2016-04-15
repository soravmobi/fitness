<?php include "trainer_dashboard.php"; ?>
     
<section class="trainee_dash_body">

  <!--Main container sec start-->
  <div class="main_container">
    <div class="customer_report_main trainer_dashboard">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="notification_wrap">
              <ul>
                <li>
                <?php 
                  $weather_details = $this->Custom->getWheatherDetails();
                  $weather = $weather_details['main']['temp'];
                  $windy   = $weather_details['wind']['speed'];
                ?>
                  <div class="cloud_box blue_light">
                    <div class="cloud blue"><i class="flaticon1-cogwheel" aria-hidden="true"></i><span>Friday</span></div>
                  </div>
                  <div class="cloud_text">
                    <div class="degree_main"><?php echo round($weather- 273.15,1); ?><span class="degree">0</span></div>
                    <span>Weather</span>
                  </div>
                </li>
                <li>
                  <div class="cloud_box">
                    <div class="cloud"><i class="fa fa-cloud" aria-hidden="true"></i> <span>sunday</span></div>
                  </div>
                  <div class="cloud_text">
                    <div class="kilo_box"><?php echo round($windy,1); ?><span>M/S</span></div>
                    <span>Windy</span> </div>
                </li>
                <li>
                  <div class="cloud_box">
                    <div class="cloud"><i class="flaticon1-money"></i><span> wallet</span></div>
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
                  <div class="cloud_text"> <span>my wallet</span>
                    <div class="rate_box">$<?php echo round($wallet_balance,2); ?></div>
                    <span class="withraw">Withdraw</span> </div>
                </li>
                <li>
                  <div class="cloud_box">
                    <div class="cloud"><i class="flaticon1-money-1"></i><span>earing</span></div>
                  </div>
                  <div class="cloud_text"> <span>My Total Earnings</span>
                    <div class="rate_box">$7,448</div>
                    <span class="last_month">Last Month</span> <span class="last_month">$83,541</span> </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="appointement_dashboard">
          <div class="row">
            <div class="col-md-4 col-sm-4"> 
              <!-- Responsive calendar - START -->
              <div class="responsive-calendar">
                <div class="controls clearfix">
                  <h4 class="text-center"><span data-head-year></span> <span data-head-month></span></h4>
                  <a class="pull-left" data-go="prev">
                  <div class="btn prev_btn "><i class="fa fa-angle-double-left"></i> </div>
                  </a> <a class="pull-right" data-go="next">
                  <div class="btn next_btn"><i class="fa fa-angle-double-right"></i> </div>
                  </a> </div>
                <div class="calendor_content">
                  <div class="heading_payment_main"> </div>
                  <div class="session_content">
                    <div class="day-headers">
                      <div class="day header">Mon</div>
                      <div class="day header">Tue</div>
                      <div class="day header">Wed</div>
                      <div class="day header">Thu</div>
                      <div class="day header">Fri</div>
                      <div class="day header">Sat</div>
                      <div class="day header">Sun</div>
                    </div>
                    <div class="days" data-group="days"> </div>
                  </div>
                </div>
              </div>
              <!-- Responsive calendar - END --> 
            </div>
            <div class="col-md-4 col-sm-4">
              <div class="appointement_head"> Upcoming Appointments </div>
              <div class="session_setails_sec appointement_sec">
                <div class="heading_payment_main"> </div>
                <ul class="session_content scroll_content mCustomScrollbar _mCS_1">
                            <?php for ($i=0; $i < count($upcomingArr); $i++) { ?>
                                <li>
                                <div class="main_block">
                                 <div class="circle_box_main">
                                  <div class="small_circle"></div>
                                <div class="icon_block big_icon gray_color">
                                <img src="<?php echo $this->request->webroot; ?>uploads/trainee_profile/<?php echo $upcomingArr['trainee_image'][$i]; ?>" class="img-responsive">
                                 </div>
                                 </div>
                                  <div class="text_block"><div class="appointer_name"><?php echo $upcomingArr['trainee_name'][$i]; ?></br> <span><?php echo date('d F, Y', strtotime($upcomingArr['appo_date'][$i])); ?>  </span></div> <span><?php echo $upcomingArr['appo_time'][$i]; ?></span></div>
                                  <div class="timer">
                                    <div id="defaultCountdown"></div>
                                  </div>
                               </div>
                                <?php if(!empty($upcomingArr['location_name'][$i])){ ?>
                                 <div class="icon_main">
                                    <div class="icon_block"><i class="fa fa-map-marker"></i> </div>
                                    <div class="text_block"><?php echo $upcomingArr['location_name'][$i]; ?></div>                    
                                  </div>
                                <?php } ?>
                                <div class="chat_box">
                                    <div class="icon_block big_icon">
                                      <a href="javascript:void(0);" id="trainer-appointments" c_type="chat" t_type="trainer" from_id="<?php echo $from_id; ?>" to_id="<?php echo $upcomingArr['user_id'][$i]; ?>" class="user_call" title="Text Chat"><i class="fa fa-weixin"></i></a>
                                    </div>
                                    <div class="bullet_box"><i class="fa fa-circle"></i>  <i class="fa fa-circle"></i> <i class="fa fa-circle"></i> </div>
                                </div>
                              </li>
                            <?php } ?>
                            </ul>
              </div>
            </div>
            <div class="col-md-4 col-sm-4">
              <div class="appointement_head"> pending Appointments </div>
              <div class="session_setails_sec appointement_sec pending_appointement">
                <div class="heading_payment_main"> </div>
                <ul class="session_content scroll_content mCustomScrollbar _mCS_1">
                            <?php foreach($pending_appointments as $pa) { ?>
                              <li>
                                <div class="main_block">
                                <div class="circle_box_main">
                                   <div class="small_circle"></div>
                                      <div class="icon_block big_icon gray_color">
                                        <img src="<?php echo $this->request->webroot; ?>uploads/trainee_profile/<?php echo $pa['trainee_image']; ?>" class="img-responsive">
                                     </div>   
                                    </div>
                                    <?php $session_data = unserialize($pa['session_data']); ?>
                                    <div class="text_block">
                                        <div class="appointer_name"><?php echo ucwords($pa['trainee_name']." ".$pa['trainee_lname']); ?> </div> <span><?php echo count($session_data); ?> <?php echo (count($session_data) > 1) ? "Sessions" : "Session"; ?> - $<?php echo round($pa['final_price'],2); ?></span>
                                    </div>
                                </div>
                                <div class="icon_main">
                                    <div class="clock_main">
                                        <?php 
                                          date_default_timezone_set("Asia/Calcutta");
                                          $purchase_date     = $pa['created_date']; 
                                          $current_date      = date('Y-m-d H:i:s');
                                          $start_date        = new DateTime($current_date);
                                          $since_start       = $start_date->diff(new DateTime($purchase_date));
                                          $remaining_hour    = 24 - $since_start->h;
                                          $remaining_minutes = $since_start->i;
                                          $remaining_seconds = $since_start->s;
                                        ?>
                                        <div id="clockdiv_<?php echo $pa['app_id']; ?>"  onload="counter(<?php echo $pa['app_id']; ?>,<?php echo $remaining_hour ; ?>,<?php echo $remaining_minutes; ?>,<?php echo $remaining_seconds; ?>)">
                                            <ul>
                                                <li>
                                                    <span class="hours"></span>
                                                </li>
                                                <li>
                                                    <span class="minutes"></span>
                                                </li>
                                                <li>
                                                    <span class="seconds"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat_box">
                                    <div class="icon_block big_icon">
                                        <a href="javascript:void(0);" id="trainer-appointments" c_type="chat" t_type="trainer" from_id="<?php echo $from_id; ?>" to_id="<?php echo $pa['trainee_id']; ?>" class="user_call" title="Text Chat"><i class="fa fa-weixin"></i></a>
                                    </div>
                                    <div class="bullet_box"><a title="View Pending Appointment" href="<?php echo $this->request->webroot; ?>trainers/viewPendingAppointment?aid=<?php echo base64_encode($pa['app_id']); ?>"><i class="fa fa-circle"></i> <i class="fa fa-circle"></i> <i class="fa fa-circle"></i></a></div>
                                </div>
                            </li>
                            <?php } ?>
                            </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="dashboard_mid_sec">
          <div class="row">
            <div class="col-md-4 col-sm-4">
              <div class="request_sec customer_report_table_sec">
                <div class="cr_table_content">
                  <table class="table">
                    <thead >
                      <tr>
                        <th>New Request</th>
                        <th>Details</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Jerry 3 Sessions</td>
                        <td>Details</td>
                        <td><a href="#" class="chk_img"><img src="<?php echo $this->request->webroot; ?>images/chk_img.png"></a> <a href="#" class="cross_img"><img src="<?php echo $this->request->webroot; ?>images/cross_img.png"></a></td>
                      </tr>
                      <tr>
                        <td>Jerry 3 Sessions</td>
                        <td>Details</td>
                        <td><a href="#" class="chk_img"><img src="<?php echo $this->request->webroot; ?>images/chk_img.png"></a> <a href="#" class="cross_img"><img src="<?php echo $this->request->webroot; ?>images/cross_img.png"></a></td>
                      </tr>
                      <tr>
                        <td>Jerry 3 Sessions</td>
                        <td>Details</td>
                        <td><a href="#" class="chk_img"><img src="<?php echo $this->request->webroot; ?>images/chk_img.png"></a> <a href="#" class="cross_img"><img src="<?php echo $this->request->webroot; ?>images/cross_img.png"></a></td>
                      </tr>
                      <tr>
                        <td>Jerry 3 Sessions</td>
                        <td>Details</td>
                        <td><a href="#" class="chk_img"><img src="<?php echo $this->request->webroot; ?>images/chk_img.png"></a> <a href="#" class="cross_img"><img src="<?php echo $this->request->webroot; ?>images/cross_img.png"></a></td>
                      </tr>
                      <tr>
                        <td>Jerry 3 Sessions</td>
                        <td>Details</td>
                        <td><a href="#" class="chk_img"><img src="<?php echo $this->request->webroot; ?>images/chk_img.png"></a> <a href="#" class="cross_img"><img src="<?php echo $this->request->webroot; ?>images/cross_img.png"></a></td>
                      </tr>
                      <tr>
                        <td>Jerry 3 Sessions</td>
                        <td>Details</td>
                        <td><a href="#" class="chk_img"><img src="<?php echo $this->request->webroot; ?>images/chk_img.png"></a> <a href="#" class="cross_img"><img src="<?php echo $this->request->webroot; ?>images/cross_img.png"></a></td>
                      </tr>
                      <tr>
                        <td>Jerry 3 Sessions</td>
                        <td>Details</td>
                        <td><a href="#" class="chk_img"><img src="<?php echo $this->request->webroot; ?>images/chk_img.png"></a> <a href="#" class="cross_img"><img src="<?php echo $this->request->webroot; ?>images/cross_img.png"></a></td>
                      </tr>
                      <tr>
                        <td>Jerry 3 Sessions</td>
                        <td>Details</td>
                        <td><a href="#" class="chk_img"><img src="<?php echo $this->request->webroot; ?>images/chk_img.png"></a> <a href="#" class="cross_img"><img src="<?php echo $this->request->webroot; ?>images/cross_img.png"></a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-4">
              <div class="sales_map"> <img src="<?php echo $this->request->webroot; ?>images/sales_chart.png" class="img-responsive"> </div>
            </div>
            <div class="col-md-4 col-sm-4">
              <div class="diary_map"> <img src="<?php echo $this->request->webroot; ?>images/diary.png" class="img-responsive"> </div>
            </div>
          </div>
        </div>
        <div class="visiter_map_sec">
          <div class="row">
            <div class="col-md-8 col-sm-8">
              <div class="visitor_map"> 
               <div id="chartdiv"></div>									
                			
              </div>
            </div>
            <div class="col-md-4 col-sm-4">
              <div class="session_setails_sec agenda">
                <div class="heading_payment_main">
                  <h2 class="text-center">My Agenda</h2>
                </div>
                <div class="session_content">
                  <p> <span class="agenda_icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text </p>
                  <p> <span class="agenda_icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text </p>
                  <p> <span class="agenda_icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text </p>
                </div>
              </div>
            </div>
          </div>
        </div>
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
                  <li><a href="#">profile</a></li>
                  <li><a href="#">setting</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">select <i class="fa fa-chevron-down"></i> </a>
                <ul class="dropdown-menu">
                  <li><a href="#">profile</a></li>
                  <li><a href="#">setting</a></li>
                </ul>
              </li>
              <li class="pull-right">
                <div class="input-group">
                  <input type="text" placeholder="Search Message" aria-label="Amount (to the nearest dollar)" class="form-control">
                  <span class="input-group-addon"><i class="fa fa-search"></i></span> </div>
              </li>
            </ul>
            <div class="message_wrap_content">
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td><div class="squaredThree">
                        <input type="checkbox" value="None" id="squaredThree" name="check" checked />
                        <label for="squaredThree"></label>
                      </div></td>
                    <td>Steve Jobs</td>
                    <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
                    <td>9:43</td>
                  </tr>
                  <tr>
                    <td><div class="squaredThree">
                        <input type="checkbox" value="None" id="squaredThree1" name="check" checked />
                        <label for="squaredThree1"></label>
                      </div></td>
                    <td>Steve Jobs</td>
                    <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
                    <td>9:43</td>
                  </tr>
                  <tr>
                    <td><div class="squaredThree">
                        <input type="checkbox" value="None" id="squaredThree2" name="check" checked />
                        <label for="squaredThree2"></label>
                      </div></td>
                    <td>Steve Jobs</td>
                    <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
                    <td>9:43</td>
                  </tr>
                  <tr>
                    <td><div class="squaredThree">
                        <input type="checkbox" value="None" id="squaredThree3" name="check" checked />
                        <label for="squaredThree3"></label>
                      </div></td>
                    <td>Steve Jobs</td>
                    <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
                    <td>9:43</td>
                  </tr>
                  <tr>
                    <td><div class="squaredThree">
                        <input type="checkbox" value="None" id="squaredThree4" name="check" checked />
                        <label for="squaredThree4"></label>
                      </div></td>
                    <td>Steve Jobs</td>
                    <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
                    <td>9:43</td>
                  </tr>
                  <tr>
                    <td><div class="squaredThree">
                        <input type="checkbox" value="None" id="squaredThree5" name="check" checked />
                        <label for="squaredThree5"></label>
                      </div></td>
                    <td>Steve Jobs</td>
                    <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
                    <td>9:43</td>
                  </tr>
                  <tr>
                    <td><div class="squaredThree">
                        <input type="checkbox" value="None" id="squaredThree6" name="check" checked />
                        <label for="squaredThree6"></label>
                      </div></td>
                    <td>Steve Jobs</td>
                    <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
                    <td>9:43</td>
                  </tr>
                  <tr>
                    <td><div class="squaredThree">
                        <input type="checkbox" value="None" id="squaredThree7" name="check" checked />
                        <label for="squaredThree7"></label>
                      </div></td>
                    <td>Steve Jobs</td>
                    <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
                    <td>9:43</td>
                  </tr>
                  <tr>
                    <td><div class="squaredThree">
                        <input type="checkbox" value="None" id="squaredThree8" name="check" checked />
                        <label for="squaredThree8"></label>
                      </div></td>
                    <td>Steve Jobs</td>
                    <td>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</td>
                    <td>9:43</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Main container sec end--> 

</section>  

<script type="text/javascript">

/************************************* js for clockdiv timer start ***********************************************************/

function counter(appid,hour,minutes,seconds){
  var deadline = new Date(Date.parse(new Date()) + hour * minutes * seconds * 1000);
  initializeClock('clockdiv_'+appid, deadline);
}

$(function(){
  $('div[onload]').trigger('onload');
});

function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  return {
    'total': t,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    var t = getTimeRemaining(endtime);
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

/************************************* js for clockdiv timer end ***********************************************************/

</script> 



