<?php include "trainee_dashboard.php"; ?>

<form method="post" id="booking_session_form" action="<?php echo $this->request->webroot; ?>trainees/confirmPay">

<div class="top_bar_wrap">
            <div class="container">
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="tbw_text">
                  <i class="fa fa-calendar"></i> select session
  
                  </div>
                  <div class="step_box">
                    Step 2 of 3
                  </div>
              </div>
             </div>
           </div>
         </div>
         <?php echo $this->Flash->render('edit') ?>
<section class="calendor_wrap session_wrap">
            <div class="head_row">
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <div class="session_user">
                      <div class="img_user"><img src="<?php echo $this->Custom->getImageSrc('uploads/trainer_profile/'.$trainer_details[0]['trainer_image']) ?>" class="img-responsive"></div> <?php if(!empty($trainer_details)) echo ucwords($trainer_details[0]['trainer_name'] ." ".$trainer_details[0]['trainer_lname']); ?>
                    </div>
                    
                    <!-- Responsive calendar - START -->
                        <div class="responsive-calendar">
                        <div class="controls clearfix">
                        <h4><span data-head-year></span> <span data-head-month></span></h4>
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

                    <div class="calendor_caption">
                    <div class="heading_payment_main">
                    </div>
                    <div class="session_content scroll_content">
                    <!-- <div class="session_content scroll_content mCustomScrollbar _mCS_1"> -->
                    <?php 
                      if(!empty($time_slots)){
                        $times = unserialize($time_slots[0]['times']);
                      }else{
                        $times = array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
                      }
                      for ($i=0; $i < 24; $i++) {
                    ?>
                     
                      <div class="checkbox">
                       <div title="<?php echo ($times[$i] == 1) ? 'Blocked' : 'Available' ?>" class="roundedOne <?php echo ($times[$i] == 1) ? 'bookedlabel' : 'unbookedlabel' ?>">
                          <input <?php if($times[$i] == 1) echo "checked"; ?> <?php if($times[$i] == 1) echo "disabled"; ?> type="checkbox" class="time <?php echo ($times[$i] == 1) ? 'booked' : 'unbooked' ?>" value="0" time1="<?php echo $this->Custom->getTimeSlots($i); ?>" time2="<?php echo $this->Custom->getTimeSlots($i+1); ?>" main="<?php echo $i; ?>" id="roundedOne_<?php echo $i; ?>" />
                          <label for="roundedOne_<?php echo $i; ?>"></label>
                          <input type="hidden" name="times[]" class="hidden_time" id="time_<?php echo $i; ?>" value="<?php echo $times[$i]; ?>"/>
                        </div>
                        <div class="chekbox_txt"> <span><?php echo $this->Custom->getTimeSlots($i); ?></span><?php echo $this->Custom->getTimeSlots($i+1); ?></div>
                    </div>
                    <?php } ?>
                    </div>
                    

                    </div>

                       <div class="price_box">
                       <div class="heading_payment_main">
                         
                          <h5>price</h5>
                       </div>
                          <div class="price_box_content session_content">
                          <?php
                            $finalSessionPrice1 = $this->Custom->getSessionRate($session,$rates_plan);
                            $finalSessionPrice = round($finalSessionPrice1 * $session,2);
                            if(!empty($service_fee_details)){
                              $service_fee = $service_fee_details[0]['txn_fee'];
                            }else{
                              $service_fee = '0';
                            }
                            $finalServiceFee = round(($finalSessionPrice * $service_fee) / 100,2);
                          ?>
                             <ul>
                              <input type="hidden" name="sessions_price" value="<?php echo $finalSessionPrice; ?>">
                              <input type="hidden" name="service_fee" value="<?php echo $finalServiceFee; ?>">
                              <input type="hidden" name="total_price" value="<?php echo $finalSessionPrice + $finalServiceFee; ?>">
                               <li>
                                  $<?php echo $finalSessionPrice; ?> x <?php echo $session; ?>  Sessions <span>$<?php echo $finalSessionPrice; ?></span></li>
                               <li>
                                  Service Fee <div class="button_in"> <div class="pop_over_main"> <span class="icon_block question_icon"><i class="fa fa-question"></i></span>
                                  <div class="pop_over">
                                     <h4>service fee</h4>
                                     <p>service fees let us provide 24 hours support that you love</p>
                                      <a href="javascript:void(0);" class="btn_okay">okay</a>
                                 </div>
                               </div>
                              </div>
                              <span>$<?php echo $finalServiceFee; ?></span></li>
                               <li>total<span class="red_color">$<?php echo $finalSessionPrice + $finalServiceFee; ?></span></li>
                               </ul>
                          </div>
                       </div>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <div class="right_session_bar">
                     <div class="drop_box dropdown">
                       <h2 class="dropdown-toggle" id="change_session" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $session; ?> Sessions <i class="fa fa-caret-down"></i></h2>
                       <ul class="dropdown-menu">
                         <li><a href="javascript:void(0);" class="select_session" main="1">1 session</a></li>
                         <li><a href="javascript:void(0);" class="select_session" main="3">3 session</a></li>
                         <li><a href="javascript:void(0);" class="select_session" main="10">10 session</a></li>
                         <li><a href="javascript:void(0);" class="select_session" main="20">20 session</a></li>
                       </ul>
                       </div>
                    <div class="right_session_content mCustomScrollbar _mCS_1" id="session_section">
                    <?php for ($i=1; $i <= $session; $i++) { ?>
                       <div class="session_block ">
                          <div class="session_block_head heading_payment_main">
                           Session <?php echo $i; ?>  <!-- <span class="notes-label" main="<?php echo $i; ?>" title="Click here to save notes"> Notes </span> -->
                            <div class="pop_over_main" id="notes_window_<?php echo $i; ?>" style="display:none;">
                                  <div class="pop_over">
                                    <textarea class="form-control" placeholder="message" name="booking[<?php echo $i; ?>][notes]"></textarea>
                                    <a href="javascript:void(0);" class="btn_okay notes-cancel-btn">cancel</a><a href="javascript:void(0);" class="btn_okay notes-save-btn">save</a>
                                 </div>
                            </div>
                          </div>
                          <div class="session_block_content session_content">
                            <ul>
                              <?php $timestamp = strtotime(date('Y-m-d')) + 60*60; ?>
                              <li id="modify_date_time_<?php echo $i; ?>">
                                <div class="icon_block modify_date_time" id="modify_btn_<?php echo $i; ?>" main="<?php echo $i; ?>" title="Modify Date & Time"><i class="fa fa-pencil"></i> </div>
                                <div class="modify_date_time1 save_cancel_section_<?php echo $i; ?>" style="display:none;">
                                  <div class="icon_block cancel-modify-btn" id="cancel_modify_btn_<?php echo $i; ?>" main="<?php echo $i; ?>" title="Cancel"><i class="fa fa-times"></i> </div>
                                  <div class="icon_block save-modify-btn" id="save_modify_btn_<?php echo $i; ?>" main="<?php echo $i; ?>" title="Save"><i class="fa fa-check"></i> </div>
                                </div>
                                <div class="text_block" id="date_time_block_<?php echo $i; ?>"><?php echo date('F', strtotime(date('Y-m-d'))); ?> <?php echo date('d', strtotime(date('Y-m-d'))); ?>th <?php echo date('Y', strtotime(date('Y-m-d'))); ?> </br> <b> <?php echo date('h:i A', strtotime(date('Y-m-d'))); ?></b> - <span><?php echo date('h:i A', $timestamp); ?></span></div>
                              </li>
                              <?php 
                                $own_location_details = $this->Custom->getlatlngbyip();
                                if(!empty($own_location_details)){
                                  $lat = $own_location_details['lat'];
                                  $lon = $own_location_details['lon'];
                                  $address = $own_location_details['city']." ".$own_location_details['regionName']." ".$own_location_details['country'];
                                }else{
                                  $lat = $profile_details[0]['lat'];
                                  $lon = $profile_details[0]['lng'];
                                  $address = $profile_details[0]['city_name']."-".$profile_details[0]['state_name'].",".$profile_details[0]['country_name'];
                                }
                              ?>
                              <li id="map_icon_<?php echo $i; ?>">
                                <div class="icon_block select_location" main="<?php echo $i; ?>" title="Select Location"><i class="fa fa-map-marker"></i> </div>
                                <div class="text_wrap">
                                <div class="text_block" id="location_text_<?php echo $i; ?>" title="<?php echo $address; ?>"><?php echo $address; ?></div>
                              </div>
                              </li>
                            </ul>
                            <div class="button_box clearfix">
                              <div class="button_in">Select Training Preference <div class="pop_over_main"> <span class="icon_block question_icon"><i class="fa fa-question"></i></span>
                               </div>
                             </div>
                              <ul>
                                <li class="active"  id="local_btn_<?php echo $i; ?>"><a href="javascript:void(0);" class="preference-btn" main="<?php echo $i; ?>" type="0">local</a></li>
                                <li  id="virtual_btn_<?php echo $i; ?>"><a href="javascript:void(0);" class="preference-btn" main="<?php echo $i; ?>" type="1">virtual</a></li>
                              </ul>
                              <input type="hidden" name="booking[<?php echo $i; ?>][preference]" id="prefernce_val_<?php echo $i; ?>" value="0">
                              <input type="hidden" name="booking[<?php echo $i; ?>][status]" id="status_val_<?php echo $i; ?>" value="0">
                              <input type="hidden" name="booking[<?php echo $i; ?>][locations]" id="location_val_<?php echo $i; ?>" value="<?php echo $lat; ?>,<?php echo $lon; ?>">
                              <input type="hidden" name="booking[<?php echo $i; ?>][location_address]" id="location_address_<?php echo $i; ?>" value="<?php echo $address; ?>">
                              <input type="hidden" name="booking[<?php echo $i; ?>][modified_dates]" id="date_val_<?php echo $i; ?>" value="<?php echo date('Y-m-d'); ?>">
                              <input type="hidden" name="booking[<?php echo $i; ?>][modified_times]" id="time_val_<?php echo $i; ?>" value="<?php echo date('h:i A', strtotime(date('Y-m-d'))); ?>-<?php echo date('h:i A', $timestamp); ?>">
                            </div>
                          </div>
                       </div>
                    <?php } ?>
                    </div>

                    </div>
                    
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <div class="request_btn">
                      <button>Request To Book</button>
                    </div>
                  </div>
               </div>
            </div>
        </section>
        <input type="hidden" id="rid" name="rid" value="<?php echo $rateid; ?>">
        <input type="hidden" id="tid" name="tid" value="<?php echo $trainer_id; ?>">
        <input type="hidden" id="totalsession" name="totalsession" value="<?php echo $session; ?>">
        <input type="hidden" id="trainer_id" name="trainer_id" value="<?php echo $trainer_details[0]['user_id']; ?>">
        </form>

  <!-- Choose Location Modal Start -->

  <div class="modal fade" id="location_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-map-marker"></i> choose a location</h4>
        </div>
        <div class="modal-body">
          <input type="text" class="span6 form-control" name="keyword" id="keyword" placeholder="Select Location"></br>
           <div class="map_sec thumbnail" id="map-container">
             
           </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="save-location-btn">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Choose Location Modal End -->

  <script src="https://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
  <script>
  function map_init(var_lati,var_long,var_markerTitle,var_contentString){
    
    var var_location = new google.maps.LatLng(var_lati,var_long);
  
    var var_mapoptions = {
      zoom: 14,
      mapTypeControl: false,
      center:var_location,
      panControl:false,
      rotateControl:false,
      streetViewControl: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
 
    var_map = new google.maps.Map(document.getElementById("map-container"), var_mapoptions);
 
    var_infowindow = new google.maps.InfoWindow({
      content: var_contentString
    });
    
    var_marker = new google.maps.Marker({
    position: var_location,
    map: var_map,
    title:var_markerTitle,
    icon : "<?php echo $this->request->webroot; ?>img/favicon.ico",
    maxWidth: 200,
    maxHeight: 200
    });

    input = document.getElementById("keyword");

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo("bounds", var_map);

    google.maps.event.addListener(autocomplete, "place_changed", function()
    {
        place = autocomplete.getPlace();
        marker_title = place.formatted_address;
        lat_lng = place.geometry.location;
        if (!place.geometry) {
          window.alert("Please enter valid location");
          return;
        }

        if (place.geometry.viewport) {
            var_map.fitBounds(place.geometry.viewport);
        } else {
            var_map.setCenter(place.geometry.location);
            var_map.setZoom(15);
        }

        contentHTML = "";
        contentHTML += '<div id="mapInfo">';
        contentHTML += '<p><strong>' + marker_title + '</strong>';
        contentHTML += '</div>';

        var_infowindow.setContent(contentHTML);
        var_marker.setPosition(place.geometry.location);
        var_marker.setTitle(marker_title);
        var_infowindow.open(var_map, var_marker);
    });

    google.maps.event.addListener(var_marker, 'click', function() {
      var_infowindow.open(var_map,var_marker);
    });
 
      $('#location_model').on('shown.bs.modal', function () {
          google.maps.event.trigger(var_map, "resize");
          var_map.setCenter(var_location);
      });
  }
 
  $(document).on("click", ".select_location", function () {
    location_no = $(this).attr('main');
    lat_long_val = $('#location_val_'+location_no).val();
    address_text = $('#location_text_'+location_no).attr('title');
    var lat_long_arr = lat_long_val.split(",");
    map_init(lat_long_arr[0],lat_long_arr[1],address_text,
            '<div id="mapInfo">'+
            '<p><strong>'+ address_text +'</strong>'+
            '</div>');
    $('#keyword').val(address_text);
    $('#location_model').modal('show');
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('body').on('click','.preference-btn',function(){
      $(this).parent().addClass('active');
      var type = $(this).attr('type');
      var main = $(this).attr('main');
      if(type == 1){
        $('#map_icon_'+main).hide();
        $('#local_btn_'+main).removeClass('active');
        $('#prefernce_val_'+main).val('1');  
        $('#location_address_'+main).val('');
        $('#location_val_'+main).val('');
      }else{
        $('#map_icon_'+main).show();
        $('#virtual_btn_'+main).removeClass('active');
        $('#prefernce_val_'+main).val('0');
      }
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('body').on('click','#save-location-btn',function(){
      $('#location_val_'+location_no).val(place.geometry.location.lat() + "," + place.geometry.location.lng());
      $('#location_text_'+location_no).text(marker_title);
      $('#location_text_'+location_no).attr('title',marker_title);
      $('#location_model').modal('hide');
      $('#location_address_'+location_no).val(marker_title);
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){

    $('body').on('change','.time',function(){
        var i = $(this).attr('main');
        if(this.checked){
          $(this).val('1');
          $('#time_'+i).val('1');
          $('.unbooked').each(function() { 
            this.checked = false;  
          });
          $('#roundedOne_'+i).prop('checked',true);
        }else{
          $(this).val('0');
          $('#time_'+i).val('0');
        }
    });

    $('body').on('click','div.day > a',function(){
          var year  = $(this).attr('data-year');
          var month = ($(this).attr('data-month') >= 10) ? $(this).attr('data-month') : "0" + $(this).attr('data-month');
          var day = ($(this).attr('data-day') >= 10) ? $(this).attr('data-day') : "0" + $(this).attr('data-day');
          var date =  year + "-" + month + "-" + day;
          $('#selected_date').val(date);   
          var trainer_id = $('#trainer_id').val();
          $('.day').removeClass('today');
          $(this).parent().addClass('today');
          $.ajax({
            url:"<?php echo $this->request->webroot; ?>trainees/getTimeSlotsDateWise",
            type:"post",
            data:{date:date,trainer_id:trainer_id},
            dataType:"json",
            success: function(response){
                $('.calendor_caption').html(response.message);
            },
            error:function(error){
                console.log(error);  
            }
          });
    });

    $('body').on('click','.modify_date_time',function(){
        var no = $(this).attr('main');
        $(this).hide();
        $('.save_cancel_section_'+no).show();
    });

    $('body').on('click','.cancel-modify-btn',function(){
        var no1 = $(this).attr('main');
        $('.save_cancel_section_'+no1).hide();
        $('#modify_btn_'+no1).show();
    });

    $('body').on('click','.save-modify-btn',function(){
        var no2      = $(this).attr('main');
        var year     = $('div.today > a').attr('data-year');
        var month    = ($('div.today > a').attr('data-month') >= 10) ? $('div.today > a').attr('data-month') : "0" + $('div.today > a').attr('data-month');
        var day      = ($('div.today > a').attr('data-day') >= 10) ? $('div.today > a').attr('data-day') : "0" + $('div.today > a').attr('data-day');
        var date     =  year + "-" + month + "-" + day;
        var time_val = $('.unbooked:checked').attr('main');
        var time1    = $('.unbooked:checked').attr('time1');
        var time2    = $('.unbooked:checked').attr('time2');
        if(time_val == undefined){
          alert('Please select time');
          return false;
        }
        var converted_date = convertDate(date);
        appendHTML = "";
        appendHTML += converted_date + "</br>" + time1 + "- <span>" + time2 + "</span>";
        $('#date_time_block_'+no2).html(appendHTML);
        $('.unbooked').prop('checked',false).val('0');
        $('#time_'+no2).val('0');
        $('#date_val_'+no2).val(date);
        $('#time_val_'+no2).val(time1 + "-" + time2);
        $('.save_cancel_section_'+no2).hide();
        $('#modify_btn_'+no2).show();
    });

    $('body').on('click','.notes-label',function(){
      var count = $(this).attr('main');
      $('.pop_over_main').css('display','none');
      $('#notes_window_'+count).css('display','block');
    });

    $('body').on('click','.notes-cancel-btn, .notes-save-btn',function(){
      $('.pop_over_main').css('display','none');
    });

    $('body').on('click','.select_session',function(){
      var session = $(this).attr('main');
      var rid     = $('#rid').val();
      var tid     = $('#tid').val();
      window.location.href= "<?php echo $this->request->webroot; ?>trainees/bookingSession?session="+session+"&rid="+rid+"&tid="+tid;
    });

  });

  function convertDate(val) 
    {
      var t = val.split(/[- :]/);
      var month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
      var mo = parseInt(t[1]);
      var newmonth  = month[mo-1];
      var s = newmonth+' '+t[2]+'th '+t[0];
      return s;
    }

</script>



