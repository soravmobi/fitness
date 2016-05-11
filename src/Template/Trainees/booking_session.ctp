<?php include "trainee_dashboard.php"; ?>

<form method="post" id="booking_session_form" action="<?php echo $this->request->webroot; ?>trainees/confirmPay">
<div class="top_bar_wrap sec_pad">
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
    
    <section class="calendor_wrap">
           
           
            <div class="container">
            <div class="session_user">
              <div class="img_user"><img src="<?php echo $this->Custom->getImageSrc('uploads/trainer_profile/'.$trainer_details[0]['trainer_image']) ?>" class="img-responsive"></div> <?php if(!empty($trainer_details)) echo ucwords($trainer_details[0]['trainer_name'] ." ".$trainer_details[0]['trainer_lname']); ?>
            </div>
            <div class="top_row">
              <div class="row">
              <div class="col-md-3 col-sm-3 col-xs-4">
                <div class="drop_box dropdown">
                       <h2 aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" id="change_session" class="dropdown-toggle"><?php echo $session; ?> Sessions  <i class="fa fa-caret-down"></i></h2>
                       <ul class="dropdown-menu">
                         <li><a main="1" class="select_session" href="javascript:void(0);">1 session</a></li>
                         <li><a main="3" class="select_session" href="javascript:void(0);">3 session</a></li>
                         <li><a main="10" class="select_session" href="javascript:void(0);">10 session</a></li>
                         <li><a main="20" class="select_session" href="javascript:void(0);">20 session</a></li>
                       </ul>
                       </div>
              </div>
               <div class="col-md-4 col-sm-3 col-xs-4">
                 <h2><i class="fa fa-calendar"></i> select date</h2>
              </div>
              <div class="col-md-5 col-sm-3 col-xs-4">
               <h2><i class="fa fa-clock-o"></i> select time</h2>
              </div>
            </div>
            </div>
             <div class="appointe_box">
                <div class="heading_payment_main">
                       </div>
                   <div class="session_content">
                    <div class="head_row"></br>
                      <h3 class="session_heading">session #01</h3>
                      <p>please fill in the following information and select the date and time</p>
                    </div>
                    <div class="row">
               <div class="col-md-3 col-sm-6">
                 <div class="preference_wrap">
                   <div class="pref_box pref_color1">
                      <h2 class="session_number"> 01 <span>session</span></h2>
                   </div>
                   <div class="pref_box pref_color2">
                   <div class="pop_over_main"> <span class="icon_block question_icon"><i class="fa fa-question"></i></span>
                                  <div class="pop_over">
                                     <h3>local</h3>
                                     <p>meet your trainre in person at a gym or a specific location</p>
                                     <h3>virtual</h3>
                                     <p>train virtually through our platform using our built in 1-1 video chat.Restriction apply as not supported on all devices . we recommend desktop and gogle chrome browser. </p>
                                      <a class="btn_okay" href="javascript:void(0);">okay</a>
                                 </div>
                               </div>
                     <h4>Select Training Preference</h4>
                     <ul>
                      <li>
                        <input type="radio" id="f-option" checked name="selector" value="0" class="local-option">
                        <label for="f-option">Local</label>
                        <div class="check"></div>
                      </li>
                      <li>
                        <input type="radio" id="s-option" name="selector" value="1">
                        <label for="s-option">Virtual</label>
                        <div class="check"><div class="inside"></div></div>
                      </li>
                      </ul>
                   </div>
                   <?php 
                      $own_location_details = $this->Custom->getlatlngbyip();
                      if(!empty($own_location_details) && $own_location_details['status'] != "fail"){
                        $lat = $own_location_details['lat'];
                        $lon = $own_location_details['lon'];
                        $address = $own_location_details['city']." ".$own_location_details['regionName']." ".$own_location_details['country'];
                      }else{
                        $lat = $profile_details[0]['lat'];
                        $lon = $profile_details[0]['lng'];
                        $address = $profile_details[0]['city_name']."-".$profile_details[0]['state_name'].",".$profile_details[0]['country_name'];
                      }
                    ?>
                   <div class="pref_box pref3">
                    <div class="location_section">
                      <p>please enter the address of your local meetup</p>
                      <div title="Select Location" main="2" class="icon_block select_location" title="Select Location"><i class="fa fa-map-marker"></i> </div>
                      <p class="location_address" title="<?php echo $address; ?>"><?php echo $address; ?></p>
                    </div>
                    <div class="virtual_section" style="display:none;">
                      <center>
                        <p>virtual training</p>
                        <img style="width: 15%;" src="<?php echo $this->request->webroot; ?>img/favicon.ico" title="Virtual Training">
                      </center>
                   </div> 
                   </div>
                 </div>
               </div>
                  <div class="col-md-4 col-sm-6">
                    <!-- Responsive calendar - START -->
                        <div class="responsive-calendar">
                        <div class="controls clearfix">
                        <h4 ><span data-head-year></span> <span data-head-month></span></h4>
                            <a class="pull-left" data-go="prev"><div class="btn prev_btn "><i class="fa fa-angle-double-left"></i>
</div></a>
                            
                            <a class="pull-right" data-go="next"><div class="btn next_btn"><i class="fa fa-angle-double-right"></i>
                            
</div></a>
                        </div>
                        <div class="day-headers">
                         <div class="day header">Sun</div>
                          <div class="day header">Mon</div>
                          <div class="day header">Tue</div>
                          <div class="day header">Wed</div>
                          <div class="day header">Thu</div>
                          <div class="day header">Fri</div>
                          <div class="day header">Sat</div>
                         
                        </div>
                        <div class="days" data-group="days">
                          
                        </div>
                      </div>
      <!-- Responsive calendar - END -->
                  </div>
                  <div class="col-md-5 col-sm-12">
                    <div class="calendor_caption">

                    <?php 
                      if(!empty($time_slots)){
                        $times = unserialize($time_slots[0]['times']);
                      }else{
                        $times = array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
                      }
                      for ($i=0; $i < 24; $i++) {
                    ?>
                     
                      <div class="checkbox <?php echo ($times[$i] == 1) ? 'blocked_section' : '' ?>">
                       <div class="not_avail"><?php echo ($times[$i] == 1) ? 'Not Available' : 'Available' ?> </div>
                       <div class="roundedOne <?php echo ($times[$i] == 1) ? 'bookedlabel' : 'unbookedlabel' ?>">
                          <input <?php if($times[$i] == 1) echo "checked"; ?> <?php if($times[$i] == 1) echo "disabled"; ?> type="checkbox" class="time <?php echo ($times[$i] == 1) ? 'booked' : 'unbooked' ?>" value="0" time1="<?php echo $this->Custom->getTimeSlots($i); ?>" time2="<?php echo $this->Custom->getTimeSlots($i+1); ?>" main="<?php echo $i; ?>" id="roundedOne_<?php echo $i; ?>" />
                          <label for="roundedOne_<?php echo $i; ?>"></label>
                          <input type="hidden" name="times[]" class="hidden_time" id="time_<?php echo $i; ?>" value="<?php echo $times[$i]; ?>"/>
                        </div>
                        <div class="chekbox_txt"> 
                        <?php if($times[$i] == 1) { ?>
                          <span class="blocked_time"><?php echo $this->Custom->getTimeSlots($i); ?></span><?php echo $this->Custom->getTimeSlots($i+1); ?>
                        <?php } else{ ?>
                          <span><?php echo $this->Custom->getTimeSlots($i); ?></span><?php echo $this->Custom->getTimeSlots($i+1); ?>
                        <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                      
                      
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12">
                   <div class="request_btn save_nxt">
                      <button type="button" id="back-btn" main="1" style="display:none;">back</button>
                      <button type="button" id="save-next-btn" main="1">Save & Next</button>
                    </div>
                  </div>
               </div>
                  </div>
              </div>
               <div class="row">
                 <div class="col-md-12 col-sm-12">
                   <div class="price_box">
                     <div class="heading_payment_main">
                          <h5>price</h5>
                       </div>
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
                        <input type="hidden" name="sessions_price" value="<?php echo $finalSessionPrice; ?>">
                        <input type="hidden" name="service_fee" value="<?php echo $finalServiceFee; ?>">
                        <input type="hidden" name="total_price" value="<?php echo $finalSessionPrice + $finalServiceFee; ?>">

                        <?php for ($i=1; $i <= $session; $i++) { ?>
                          <input type="hidden" name="booking[<?php echo $i; ?>][preference]" id="prefernce_val_<?php echo $i; ?>" value="0">
                          <input type="hidden" name="booking[<?php echo $i; ?>][status]" id="status_val_<?php echo $i; ?>" value="0">
                          <input type="hidden" name="booking[<?php echo $i; ?>][locations]" id="location_val_<?php echo $i; ?>" value="">
                          <input type="hidden" name="booking[<?php echo $i; ?>][location_address]" id="location_address_<?php echo $i; ?>" value="">
                          <input type="hidden" name="booking[<?php echo $i; ?>][modified_dates]" id="date_val_<?php echo $i; ?>" value="">
                          <input type="hidden" name="booking[<?php echo $i; ?>][modified_times]" id="time_val_<?php echo $i; ?>" value="">
                        <?php } ?>
                        <div class="price_box_content session_content mCustomScrollbar_mCS_4">
                          <ul>
                            <li>
                              $<?php echo $finalSessionPrice1; ?> x <?php echo $session; ?>  Sessions <span>$<?php echo $finalSessionPrice; ?></span></li>
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
    var no  = $('#save-next-btn').attr('main');
    var latlng = $('#location_val_'+no).val();
    var loc_addr = $('#location_address_'+no).val();
    if(latlng != "" && loc_addr != ""){
      lat_long_val = latlng;
      address_text = loc_addr;
    }else{
      lat_long_val = '<?php echo $lat; ?>'+","+'<?php echo $lon; ?>';
      address_text = '<?php echo $address; ?>';
    }
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

    $('body').on('click','.select_session',function(){
      var session = $(this).attr('main');
      var rid     = $('#rid').val();
      var tid     = $('#tid').val();
      window.location.href= "<?php echo $this->request->webroot; ?>trainees/bookingSession?session="+session+"&rid="+rid+"&tid="+tid;
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
          beforeSend: function() {
              $('.loading').show();
              $('.loading_icon').show();
          },     
          success: function(response){
              $('.calendor_caption').html(response.message);
              $('.loading').hide();
              $('.loading_icon').hide();
          },
          error:function(error){
              console.log(error);  
          }
        });
    });

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

    $('body').on('change','input[name="selector"]',function(){
      var no  = $('#save-next-btn').attr('main');
      var preference_val = $('input[name="selector"]:checked').val();
      $('#prefernce_val_'+no).val(preference_val);
      if(preference_val == 0){
        $('.virtual_section').hide();
        $('.location_section').show();
      }else{
        $('.virtual_section').show();
        $('.location_section').hide();
      }
    });

    $('body').on('click','#save-location-btn',function(){
      var no  = $('#save-next-btn').attr('main');
      $('#location_val_'+no).val(place.geometry.location.lat() + "," + place.geometry.location.lng());
      $('#location_address_'+no).val(marker_title);
      $('.location_address').text(marker_title);
      $('.location_address').attr('title',marker_title);
      $('#location_model').modal('hide');
    });

    $('body').on('click','#save-next-btn',function(){
      var no    = parseInt($(this).attr('main'));
      var year  = $('div.today > a').attr('data-year');
      var month = ($('div.today > a').attr('data-month') >= 10) ? $('div.today > a').attr('data-month') : "0" + $('div.today > a').attr('data-month');
      var day   = ($('div.today > a').attr('data-day') >= 10) ? $('div.today > a').attr('data-day') : "0" + $('div.today > a').attr('data-day');
      var date  =  year + "-" + month + "-" + day;
      $('#date_val_'+no).val(date);
      var time  = $('.unbooked:checked').attr('time1')+"-"+$('.unbooked:checked').attr('time2');
      $('#time_val_'+no).val(time);
      var datetime = date + time;
      var preference_val = $('#prefernce_val_'+no).val();
      var errorMsgs = "";
      if($('#prefernce_val_'+no).val() == ""){
          errorMsgs += 'Please select training preference ..';
      }
      if(preference_val == 0){
        if($('#location_val_'+no).val() == ""){
            errorMsgs += 'Please select location .. ';
        }
      }
      if($('#date_val_'+no).val() == ""){
          errorMsgs += 'Please select training date ..';
      }
      if($('#time_val_'+no).val() == "undefined-undefined"){
          errorMsgs += 'Please select training time ..';
      }
      if(errorMsgs != ""){
        showAlert('error','Error - Session '+no,errorMsgs);
        return false;
      }else{
        no = parseInt(no + 1);
        $('#save-next-btn').attr('main',no);
        var nth_session = (no >= 10) ? no : "0" + no;
        $('.loading').show();
        $('.loading_icon').show();
        $('#back-btn').show(); 
        $('.local-option').prop('checked',true);
        $('.unbooked').prop('checked',false);
        $('.virtual_section').hide();
        $('.location_section').show();
        $('.location_address').text('<?php echo $address; ?>');
        $('.location_address').attr('title','<?php echo $address; ?>');
        $('.session_number').html(nth_session + "<span>Session</span>");
        $('.session_heading').text('session #'+nth_session);
        $('.loading').hide();
        $('.loading_icon').hide();
      }
      
    });

    $('body').on('click','#back-btn',function(){
      var back_index = (parseInt($('#save-next-btn').attr('main')) - 1);
    });

  });
</script>