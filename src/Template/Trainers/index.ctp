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
                  if(!empty($weather_details)){
                    $weather = round($weather_details['main']['temp'] - 273.15,1);
                    $windy   = round($weather_details['wind']['speed'],1);
                    $city    = $weather_details['name'];
                  }else{
                    $weather = "NA";
                    $windy   = "NA";
                    $city   = "NA";
                  }
                ?>
                  <div class="cloud_box blue_light">
                    <div class="cloud blue"><i class="flaticon1-cogwheel" aria-hidden="true"></i><span>Friday</span></div>
                  </div>
                  <div class="cloud_text">
                    <div class="degree_main"><?php echo $weather; ?><span class="degree">0<span class="cvalue">c</span></span></div>
                    <span><?php if(isset($city)) echo $city; ?></span>
                    <span>Weather</span>
                  </div>
                </li>
                <!-- <li>
                  <div class="cloud_box">
                    <div class="cloud"><i class="fa fa-cloud" aria-hidden="true"></i> <span>sunday</span></div>
                  </div>
                  <div class="cloud_text">
                    <div class="kilo_box"><?php echo $windy; ?><span>M/S</span></div>
                    <span>Windy</span> </div>
                </li> -->
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
                    <span class="withraw"><a style="color:#979090;" href="<?php echo $this->request->webroot; ?>trainers/wallet">Withdraw</a></span> </div>
                </li>
                <li>
                  <div class="cloud_box">
                    <div class="cloud"><i class="flaticon1-money-1"></i><span>earing</span></div>
                  </div>
                  <div class="cloud_text"> <span>My Total Earnings</span>
                    <div class="rate_box">$0</div>
                    <span class="last_month">Last Month</span> <span class="last_month">$0</span> </div>
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
                      <div class="day header">Sun</div>
                      <div class="day header">Mon</div>
                      <div class="day header">Tue</div>
                      <div class="day header">Wed</div>
                      <div class="day header">Thu</div>
                      <div class="day header">Fri</div>
                      <div class="day header">Sat</div>
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
                <ul class="session_content scroll_content mCustomScrollbar _mCS_1" id="upcoming_section">
                <?php       
                            if(!empty($upcomingArr)){
                              $upcomingArrCount = count($upcomingArr['trainee_name']);
                            }else{
                              $upcomingArrCount = 0; ?>
                              </br><center><h4>You have no upcoming appointments</h4></center>
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
              <div class="appointement_head"> Pending Appointments </div>
              <div class="session_setails_sec appointement_sec pending_appointement">
                <div class="heading_payment_main"> </div>
                <ul class="session_content scroll_content mCustomScrollbar _mCS_1">
                <?php if(empty($pending_appointments)){ ?>
                            </br><center><h4>You have no pending appointments</h4></center>
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
                                    <div class="clock_main pending_appo">
                                        <?php 
                                          $timer_details = $this->Custom->getTimerDetails($pa['created_date']);
                                        ?>
                                        <div id="clockdiv_<?php echo $pa['app_id']; ?>"  onload="counter(<?php echo $pa['app_id']; ?>,<?php echo $timer_details['hours'] ; ?>,<?php echo $timer_details['minutes']; ?>,<?php echo $timer_details['seconds']; ?>)">
                                            <span id="<?php echo $pa['app_id']; ?>"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat_box">
                                    <div class="icon_block big_icon">
                                        <a href="javascript:void(0);" id="trainer-appointments" c_type="chat" t_type="trainer" from_id="<?php echo $from_id; ?>" to_id="<?php echo $pa['trainee_id']; ?>" class="user_call" title="Text Chat"><i class="fa fa-weixin"></i></a>
                                    </div>
                                    <div class="bullet_box"><a title="View Pending Appointment" href="<?php echo $this->request->webroot; ?>trainers/viewPendingAppointment?aid=<?php echo base64_encode($pa['app_id']); ?>"><i class="fa fa-circle"></i> <i class="fa fa-circle"></i> <i class="fa fa-circle"></i></a>
                                      <div class="pop_over">
                                         <h4>View Appointments</h4>
                                         <p>View, modify appointments</p>
                                          <a href="javascript:void(0);" class="btn_okay">okay</a>
                                      </div>
                                    </div>
                                </div>
                            </li>
                            <?php } } ?>
                            </ul>
              </div>
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
              <form method="post" action="<?php echo $this->request->webroot; ?>trainers/notesmgmt">
                <div class="heading_payment_main">
                  <h2 class="text-center">Notes <span id="add_notes" title="Add Notes"><i class="fa fa-plus-circle"></i>
                   <span class="ad_notes_main">
                  <span class="pop_over">
                    <input type="hidden" value="" id="notes_id" name="notes_id">
                    <textarea requiredd class="form-control" id="notes_data" name="notes" placeholder="Notes"></textarea>
                    <a href="javascript:void(0);" class="btn_okay notes-cancel-btn">cancel</a>
                    <button class="btn_okay notes-save-btn">Save</button>
                 </span>
                </span>
                  </span></h2>
                </div>
              </form>
                <div class="session_content scroll_content">
                <?php if(!empty($notes)) { 
                  foreach($notes as $n) { ?>
                    <p id="notes_row_<?php echo $n['id']; ?>"><span class="agenda_icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>  <?php echo $n['notes']; ?>
                     <span class="icon_edit_delete">
                       <a title="Edit Notes" class="edit_notes" href="javascript:void(0);" main="<?php echo $n['id']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                       <a title="Delete Notes" class="delete_notes" href="javascript:void(0);" main="<?php echo $n['id']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                     </span>
                    </p>
                <?php }
                  }else{ ?>
                  <br>
                  <center><h4>No notes created. Press the (+) on the top-right corner to insert your private note.</h4></center>
                 <?php } ?>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="message_wrap">
          <div class="message_wrap_head">
            <h3>inbox </h3>
            <div class="clearfix"></div>
          </div>
          <div class="message_wrap_content_box">
            <ul>
              <li><span class="flaticon1-tool"></span> Inbox</li>
              <li><input type="checkbox" checked="" class="select-all-btn"> Select All</li>
              <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">action <i class="fa fa-chevron-down"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="javascript:void(0);" id="delete-msgs"><i class="fa fa-trash-o"></i> Delete</a></li>
                </ul>
              </li>
              <li class="pull-right">
              </li>
            </ul>
            <div class="message_wrap_content">
            <?php if(!empty($messages)) { ?>
              <table class="table table-striped">
                <tbody>
                <?php $i = 1; foreach($messages as $m){ ?>
                  <tr>
                    <td><div class="squaredThree">
                        <input type="checkbox" class="msg_cb" value="<?php echo $m['chat_id']; ?>" id="squaredThree_<?php echo $i; ?>" name="check" checked />
                        <label for="squaredThree_<?php echo $i; ?>"></label>
                      </div></td>
                    <td><?php echo $m['trainee_name']." ".$m['trainee_lname']; ?></td>
                    <td><?php echo $m['chat_messsage']; ?></td>
                    <td><?php echo $m['chat_added_date']; ?></td>
                  </tr>
                <?php $i++; } ?>
                </tbody>
              </table>
              <?php } else { ?>
              <center><h4>You have no new messages</h4></center>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Main container sec end--> 

</section>  

<script type="text/javascript">

$(document).ready(function(){
  $('body').on('click','#delete-msgs',function(){
    var msg = [];
     $.each($("input.msg_cb:checked"), function(){            
            msg.push($(this).val());
      });
    var chatids = msg.join(",");
    if(chatids == ""){
      showAlert('error','Error','Please select messages !!');
      return false;
    }
    $.ajax({
          url:"<?php echo $this->request->webroot; ?>trainers/deleteMessages",
          type:"post",
          data:{chatids:chatids},
          dataType:"json",
          success: function(response){
            if(response.message == "success"){
              showAlert('success','Success','Messages deleted successfully');
              setTimeout(function(){
                window.location.reload();
              }, 1000);
            }
          },
          error:function(error){
              console.log(error);  
          }
      });
  });
$('body').on('click','#add_notes .notes-cancel-btn',function(){
  setTimeout(function(){
    $('.ad_notes_main  > .pop_over').css("display","none");
  },100);
});

  $('body').on('click','#add_notes',function(){
    $('#add_notes .ad_notes_main .pop_over').css("display","block");
  });

$('body').on('click','.delete_notes',function(){
  var notesid = $(this).attr('main');
  $.ajax({
          url:"<?php echo $this->request->webroot; ?>trainers/deleteNotes",
          type:"post",
          data:{notesid:notesid},
          dataType:"json",
          success: function(data){
              $('#notes_row_'+notesid).remove();
          }
      });
});

$('body').on('click','.edit_notes',function(){
  var notesid = $(this).attr('main');
  $.ajax({
          url:"<?php echo $this->request->webroot; ?>trainers/getNotesData",
          type:"post",
          data:{notesid:notesid},
          dataType:"json",
          success: function(data){
            var result = data.message;
            $('#notes_data').val(result[0]['notes']);
            $('#notes_id').val(result[0]['id']);
            $('#add_notes .ad_notes_main .pop_over').css("display","block");
          }
      });
});

$(".select-all-btn").change(function () {
    $("input.msg_cb").prop('checked', $(this).prop("checked"));
});

});
</script>

<script type="text/javascript">
  $(document).ready(function(){

  $('.responsive-calendar').responsiveCalendar({
  onInit:function(){
    $(".al_heading h4").text( $(this).data('year'));
    },
    allRows:false,
    startFromSunday:true,
    events: <?php echo json_encode($app_counts); ?>
  });

  $('body').on('click','div.day > a',function(){
        var year  = $(this).attr('data-year');
        var month = ($(this).attr('data-month') >= 10) ? $(this).attr('data-month') : "0" + $(this).attr('data-month');
        var day = ($(this).attr('data-day') >= 10) ? $(this).attr('data-day') : "0" + $(this).attr('data-day');
        var date =  year + "-" + month + "-" + day;
        $('.day').removeClass('today');
        $(this).parent().addClass('today');
        $.ajax({
          url:"<?php echo $this->request->webroot; ?>trainers/getUpcomingAppointmentsByDate",
          type:"post",
          data:{date:date},
          dataType:"json",
          success: function(response){
            var appendHTML = response.message;
            $('#upcoming_section').html(appendHTML);
          },
          error:function(error){
              console.log(error);  
          }
      });
    });

  });
</script>
