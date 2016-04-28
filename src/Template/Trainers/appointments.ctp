<?php include "trainer_dashboard.php"; ?>

    <section class="payment_details appointements_page">
         <div class="top_bar_wrap">
            <div class="container">
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="tbw_text">
                  <i class="fa fa-book"></i> Appointments 
  
                  </div>
                  <div class="step_box">
                    Step 3 of 3
                  </div>
              </div>
             </div>
           </div>
         </div>
         <div class="container">
              
               <div class="row">
               <div class="col-md-4 col-sm-4">
                  <!-- Responsive calendar - START -->

                        <div class="responsive-calendar">
                        <div class="controls clearfix">
                        <h4 class="text-center"><span data-head-year></span> <span data-head-month></span></h4>
                            <a class="pull-left" data-go="prev"><div class="btn prev_btn "><i class="fa fa-angle-double-left"></i>
                            </div></a>
                            <a class="pull-right" data-go="next"><div class="btn next_btn"><i class="fa fa-angle-double-right"></i>
                            </div></a>
                        </div>
                        <div class="calendor_content">
                        <div class="heading_payment_main">
                          </div>
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
                        <div class="days" data-group="days">
                         </div> 
                        </div>
                      </div>
                     </div>
      <!-- Responsive calendar - END -->
               </div>
                  <div class="col-md-4 col-sm-4">
                    <div class="appointement_head">
                      Upcoming Appointments
                    </div>
                        <div class="session_setails_sec appointement_sec">
                          <div class="heading_payment_main">
                          
                          </div>
                           
                           <ul class="session_content scroll_content mCustomScrollbar _mCS_1">
                            <?php       
                            if(!empty($upcomingArr)){
                              $upcomingArrCount = count($upcomingArr['trainee_name']);
                            }else{
                              $upcomingArrCount = 0; ?>
                              </br><center><h4>Not found upcoming appointments</h4></center>
                          <?php } 
                            for ($i=0; $i < $upcomingArrCount; $i++) { ?>
                                <li>
                                <div class="main_block">
                                 <div class="circle_box_main">
                                  <div class="small_circle"></div>
                                <div class="icon_block big_icon gray_color">
                                <img src="<?php echo $this->Custom->getImageSrc('uploads/trainee_profile/'.$upcomingArr['trainee_image'][$i]) ?>" class="img-responsive">
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
                                <?php } else { ?>
                                  <div class="icon_main">
                                    <img style="width: 100%;" src="<?php echo $this->request->webroot; ?>img/favicon.ico" title="Virtual Training">
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
                    <div class="appointement_head">
                      Pending Appointments 
                    <!-- <div class="icon_block big_icon gray_color">
                        <a href="<?php echo $this->request->webroot; ?>trainers/appointmentsAvailability" id="trainer-appointments"><i class="fa fa-sliders"></i></a>
                    </div> -->
                    </div>
                        <div class="session_setails_sec appointement_sec pending_appointement">
                          <div class="heading_payment_main">
                          </div>
                           
                           <ul class="session_content scroll_content mCustomScrollbar _mCS_1">
                           <?php if(empty($pending_appointments)){ ?>
                            </br><center><h4>Not found pending appointments</h4></center>
                           <?php }else{ ?>
                            <?php foreach($pending_appointments as $pa) { ?>
                              <li>
                                <div class="main_block">
                                <div class="circle_box_main">
                                   <div class="small_circle"></div>
                                      <div class="icon_block big_icon gray_color">
                                        <img src="<?php echo $this->Custom->getImageSrc('uploads/trainee_profile/'.$pa['trainee_image']) ?>" class="img-responsive">
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
                                          $timer_details = $this->Custom->getTimerDetails($pa['created_date']);
                                        ?>
                                        <div id="clockdiv_<?php echo $pa['app_id']; ?>"  onload="counter(<?php echo $pa['app_id']; ?>,<?php echo $timer_details['hours'] ; ?>,<?php echo $timer_details['minutes']; ?>,<?php echo $timer_details['seconds']; ?>)">
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
                                    <div class="bullet_box"><a title="View Details" href="<?php echo $this->request->webroot; ?>trainers/viewPendingAppointment?aid=<?php echo base64_encode($pa['app_id']); ?>"><i class="fa fa-circle"></i> <i class="fa fa-circle"></i> <i class="fa fa-circle"></i></a></div>
                                </div>
                            </li>
                            <?php } } ?>
                            </ul>
                        </div>
                  </div>
               </div>
            </div>
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