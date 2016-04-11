<?php include "trainee_dashboard.php"; ?>

     <section class="trainee_dash_body">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="meal_plan_sec">
        <!-- Book Appoinment Modal Start -->
        <div class="modal fade" id="book_appo_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Book Appointments</h4>
              </div>
              <div class="modal-body">
                <form method="post" action="<?php echo $this->request->webroot; ?>trainees/trainerBookAppoinments" >
                  <div class="col-md-12">                        
                      <div class="col-md-4"> Date</div>
                      <div class="col-md-8">
                        <input type="text" readonly id="app_date" name="app_date" class="form-control" />
                      </div>
                  </div></br></br>
                  <div class="col-md-12">                        
                      <div class="col-md-4"> Select Trainr</div>
                      <div class="col-md-8">
                        <select class="form-control" name="app_reciever_id" required>
                          <option value="">Select Trainr</option>
                          <?php foreach($trainer_data as $t) { ?>
                          <option value="<?php echo $t['user_id']; ?>"><?php echo $t['trainer_name']." ".$t['trainer_lname']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                  </div></br></br>
                  <div class="col-md-12">                        
                      <div class="col-md-4">Start Time</div>
                      <div class="col-md-8">
                        <input type="text"   data-format="hh:mm A" id="app_start_time" required="required" name="app_start_time" class="form-control" />
                      </div> 
                  </div></br></br>
                  <div class="col-md-12">                        
                      <div class="col-md-4">End Time</div>
                      <div class="col-md-8">
                        <input type="text"  data-format="hh:mm A" id="app_end_time" required="required" name="app_end_time" class="form-control" />
                      </div>
                  </div></br></br>
                  <div class="col-md-12">                        
                      <div class="col-md-4">Color</div>
                      <div class="col-md-8">
                        <input type="color"  id="app_color"  name="app_color" class="form-control" />
                      </div>
                  </div></br></br>
                  <div class="col-md-12">                        
                    <div class="col-md-4"> Message</div>
                    <div class="col-md-8">
                      <textarea required name="app_message" id="app_message" class="form-control" rows="2"></textarea>
                    </div>
                </div></br></br></br></br>
                <div class="col-md-12">                        
                    <!-- <div class="col-md-4"> Address</div> -->
                    <div class="col-md-8">
                      <!-- <input id="pac-input" required class="controls form-control" type="text" placeholder="Enter a location"> -->
                      <div id="appo_map"></div>
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
        <!--  Book Appoinment Modal End -->

        <!-- Book Appoinment View Modal Start -->
        <div class="modal fade" id="book_appo_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Appoinment</h4>
              </div>
              <div class="modal-body">
                  <div class="col-md-12">                        
                      <div class="col-md-4"> Date</div>
                      <div class="col-md-8">
                        <input type="text" readonly id="app_date_view"  class="form-control" />
                      </div>
                  </div></br></br>
                  <div class="col-md-12">                        
                      <div class="col-md-4">Start Time</div>
                      <div class="col-md-8">
                        <input type="text" readonly id="app_start_time_view"  class="form-control" />
                      </div>
                  </div></br></br>
                  <div class="col-md-12">                        
                      <div class="col-md-4">End Time</div>
                      <div class="col-md-8">
                        <input type="text" readonly id="app_end_time_view"  class="form-control" />
                      </div>
                  </div></br></br>
                  <div class="col-md-12">                        
                    <div class="col-md-4"> Message</div>
                    <div class="col-md-8">
                      <textarea readonly id="app_message_view" class="form-control" rows="2"></textarea>
                    </div>
                </div></br></br>
               </div></br>
              <div class="modal-footer">
              <!-- <button type="button" id="edit-btn" data-dismiss="modal" class="btn btn-primary">Edit</button> -->
              <button type="button" id="delete-btn" class="btn btn-danger">Delete</button>
              </div>
            </div>
          </div>
        </div>
        <!--  Book Appoinment View Modal End -->

        <!-- View Appoinment View Modal Start -->
        <div class="modal fade" id="view_appo_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Appoinment</h4>
              </div>
              <div class="modal-body">
                  <div class="col-md-12">                        
                      <div class="col-md-4">Appoinment Date</div>
                      <div class="col-md-8">
                        <input type="text" readonly id="tainee_app_date_view"  class="form-control" />
                      </div>
                  </div></br></br>
                  <div class="col-md-12">                        
                      <div class="col-md-4">Start Time</div>
                      <div class="col-md-8">
                        <input type="text" readonly id="tainee_app_start_time_view"  class="form-control" />
                      </div>
                  </div></br></br>
                  <div class="col-md-12">                        
                      <div class="col-md-4">End Time</div>
                      <div class="col-md-8">
                        <input type="text" readonly id="tainee_app_end_time_view"  class="form-control" />
                      </div>
                  </div></br></br>
                  <div class="col-md-12">                        
                    <div class="col-md-4">
                        Trainee 
                    </div>
                    <div class="col-md-8">
                      <input type="text" readonly id="tainee_app_reciever_id_view"  class="form-control" />
                    </div>
                </div></br></br>
                  <div class="col-md-12">                        
                    <div class="col-md-4">Appoinment Message</div>
                    <div class="col-md-8">
                      <textarea readonly id="tainee_app_message_view" class="form-control" rows="2"></textarea>
                    </div>
                </div></br></br>
               </div></br>
              <div class="modal-footer">
              </div>
            </div>
          </div>
        </div>
        <!--  View Appoinment View Modal End -->

        <div class="tab-content">
        <?php echo $this->Flash->render('edit') ?>
        <?php echo $this->Custom->successMsg(); ?>
        <?php echo $this->Custom->errorMsg(); ?>
        <?php echo $this->Custom->loadingImg(); ?>
              <!-- Nav tabs -->
              <ul class="nav nav-tabs inner_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#book_app" aria-controls="home" role="tab" data-toggle="tab">Book Appointments</a></li>
              </ul>

              <div class="tab-content inner_tab_cont">
                <div class="full_calander">
                  <div class="row"> 
                    <div class="col-sm-6">
                        <!-- Responsive calendar - START -->
                              <div class="responsive-calendar">
                                <div class="controls clearfix">
                                    <a class="pull-left" data-go="prev"><div class="btn"><i class=" glyphicon glyphicon-menu-left"></i></div></a>
                                    <h4><span data-head-day></span><span data-head-month></span> <span data-head-year></span> </h4>
                                    <a class="pull-right" data-go="next"><div class="btn"><i class=" glyphicon glyphicon-menu-right"></i></div></a>
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
                                  <!-- the place where days will be generated -->
                                </div>
                              </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="appointment_list">
                            <div class="al_heading">
                                <h4>7 August 2015</h4>
                              </div>
                              <div class="al_body">
                                <ul>
                                    <li>
                                        <div class="alb_img">
                                        <img src="<?php echo $this->request->webroot; ?>images/trainee_img.jpg" alt="img" class="img-circle">
                                          </div>
                                          <div class="alb_txt">
                                            <p><span>Appointments with</span> <strong>John Reart</strong></p>
                                              <span>02 / jan / 2015</span>
                                          </div>
                                      </li>
                                      <li>
                                        <div class="alb_img">
                                        <img src="<?php echo $this->request->webroot; ?><?php echo $this->request->webroot; ?>images/trainee_img.jpg" alt="img" class="img-circle">
                                          </div>
                                          <div class="alb_txt">
                                            <p><span>Appointments with</span> <strong>John Reart</strong></p>
                                              <span>02 / jan / 2015</span>
                                          </div>
                                      </li>
                                      <li>
                                        <div class="alb_img">
                                        <img src="<?php echo $this->request->webroot; ?>images/trainee_img.jpg" alt="img" class="img-circle">
                                          </div>
                                          <div class="alb_txt">
                                            <p><span>Appointments with</span> <strong>John Reart</strong></p>
                                              <span>02 / jan / 2015</span>
                                          </div>
                                      </li>
                                      <li>
                                        <div class="alb_img">
                                        <img src="<?php echo $this->request->webroot; ?>images/trainee_img.jpg" alt="img" class="img-circle">
                                          </div>
                                          <div class="alb_txt">
                                            <p><span>Appointments with</span> <strong>John Reart</strong></p>
                                              <span>02 / jan / 2015</span>
                                          </div>
                                      </li>
                                      <li>
                                        <div class="alb_img">
                                        <img src="<?php echo $this->request->webroot; ?>images/trainee_img.jpg" alt="img" class="img-circle">
                                          </div>
                                          <div class="alb_txt">
                                            <p><span>Appointments with</span> <strong>John Reart</strong></p>
                                              <span>02 / jan / 2015</span>
                                          </div>
                                      </li>
                                      <li>
                                        <div class="alb_img">
                                        <img src="<?php echo $this->request->webroot; ?>images/trainee_img.jpg" alt="img" class="img-circle">
                                          </div>
                                          <div class="alb_txt">
                                            <p><span>Appointments with</span> <strong>John Reart</strong></p>
                                              <span>02 / jan / 2015</span>
                                          </div>
                                      </li>
                                      <li>
                                        <div class="alb_img">
                                        <img src="<?php echo $this->request->webroot; ?>images/trainee_img.jpg" alt="img" class="img-circle">
                                          </div>
                                          <div class="alb_txt">
                                            <p><span>Appointments with</span> <strong>John Reart</strong></p>
                                              <span>02 / jan / 2015</span>
                                          </div>
                                      </li>
                                      <li>
                                        <div class="alb_img">
                                        <img src="<?php echo $this->request->webroot; ?>images/trainee_img.jpg" alt="img" class="img-circle">
                                          </div>
                                          <div class="alb_txt">
                                            <p><span>Appointments with</span> <strong>John Reart</strong></p>
                                              <span>02 / jan / 2015</span>
                                          </div>
                                      </li>
                                      <li>
                                        <div class="alb_img">
                                        <img src="<?php echo $this->request->webroot; ?>images/trainee_img.jpg" alt="img" class="img-circle">
                                          </div>
                                          <div class="alb_txt">
                                            <p><span>Appointments with</span> <strong>John Reart</strong></p>
                                              <span>02 / jan / 2015</span>
                                          </div>
                                      </li>
                                      <li>
                                        <div class="alb_img">
                                        <img src="<?php echo $this->request->webroot; ?>images/trainee_img.jpg" alt="img" class="img-circle">
                                          </div>
                                          <div class="alb_txt">
                                            <p><span>Appointments with</span> <strong>John Reart</strong></p>
                                              <span>02 / jan / 2015</span>
                                          </div>
                                      </li>
                                      <li>
                                        <div class="alb_img">
                                        <img src="<?php echo $this->request->webroot; ?>images/trainee_img.jpg" alt="img" class="img-circle">
                                          </div>
                                          <div class="alb_txt">
                                            <p><span>Appointments with</span> <strong>John Reart</strong></p>
                                              <span>02 / jan / 2015</span>
                                          </div>
                                      </li>
                                      <li>
                                        <div class="alb_img">
                                        <img src="<?php echo $this->request->webroot; ?>images/trainee_img.jpg" alt="img" class="img-circle">
                                          </div>
                                          <div class="alb_txt">
                                            <p><span>Appointments with</span> <strong>John Reart</strong></p>
                                              <span>02 / jan / 2015</span>
                                          </div>
                                      </li>
                                  </ul>
                              </div>
                          </div>
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

<!-- Book Appoinments Calendar Start -->

<script type="text/javascript">
  
  function getParsedTime(time)
  {
    var splitTime = time.split(":");
    var splitAMPM = time.split(" ");
    var secondPart = splitTime[1].split(" ");
    var getHour   = parseInt((splitTime[0] < 10 ? "0" : "") + splitTime[0]);
    // var addHour   = getHour + 2;
    var addHour   = getHour + 1;
    var finalTime;
    if(addHour == 12 || addHour > 12){
      if(splitAMPM[1] == "PM"){
          finalTime = addHour + ":" + secondPart[0] + " AM" ;
      }else{
          finalTime = addHour + ":" + secondPart[0] + " PM" ;
      }
    }else{
        finalTime = (addHour < 10 ? "0" : "") + addHour + ":" + splitTime[1];
    }
    return finalTime;
  }

  $(document).ready(function() {
    var cal = '<?php echo json_encode($book_appo_arr); ?>';
    var array1 = $.parseJSON(cal);
    $('#book_calendar').fullCalendar({ 
    defaultView: 'agendaWeek',
    slotMinutes: 15,
    editable: true,
    droppable: true,
    events: array1,
    dayClick: function(date) {
      var today = date.format();
      var todayArr = today.split("T");
      var cur_date = new Date();
      var sel_date = new Date(date.format());
      if(cur_date < sel_date || todayArr[0] == '<?php echo date("Y-m-d"); ?>')
      {
        $('#app_date').val(todayArr[0]);
        $('#book_appo_Modal').modal('show');
      }
    },
    eventDrop: function(event, delta, revertFunc) {
      var event_id = $(this).attr('main');
      var start_droped_date = event.start.format();
      var end_droped_date = event.end.format();
      $.ajax({
        url:"<?php echo $this->request->webroot; ?>trainees/dropEvent",
        type:"post",
        data:{event_id : event_id,start_droped_date : start_droped_date,end_droped_date : end_droped_date},   
        dataType : "json",                 
        success: function(data){
            $('html, body').animate({ scrollTop: $(".meal_plan_sec").offset().top }, 1000);
            if(data.message == "success")
            {
              $("div#success_msg").html("<center><i class='fa fa-check'> Slots Update Successfully </i></center>").show();
              $("div#error_msg").hide();
            }
            else
            {
              $("div#error_msg").html("<center><i class='fa fa-times'> Something is Wrong Please Try Again ! </i></center>").show();
              $("div#success_msg").hide();
            }
            setTimeout(function(){ window.location.reload(1); }, 2000);
          }
      });
    },
    eventResize: function(event, delta, revertFunc) {
        var event_id = $(this).attr('main');
        var start_droped_date = event.start.format();
        var end_droped_date = event.end.format();
        $.ajax({
            url:"<?php echo $this->request->webroot; ?>trainees/dropEvent",
            type:"post",
            data:{event_id : event_id,start_droped_date : start_droped_date,end_droped_date : end_droped_date},   
            dataType : "json",                 
            success: function(data){
                $('html, body').animate({ scrollTop: $(".meal_plan_sec").offset().top }, 1000);
                if(data.message == "success")
                {
                  $("div#success_msg").html("<center><i class='fa fa-check'> Slots Update Successfully </i></center>").show();
                  $("div#error_msg").hide();
                }
                else
                {
                  $("div#error_msg").html("<center><i class='fa fa-times'> Something is Wrong Please Try Again ! </i></center>").show();
                  $("div#success_msg").hide();
                }
                setTimeout(function(){ window.location.reload(1); }, 2000);
              }
      });
      }
  });
});
</script>

<!-- Book Appoinments Calendar End -->

<!-- View Appoinments Calendar Start -->

<script type="text/javascript">
  $(document).ready(function() {
  var cal1 = '<?php echo json_encode($view_appo_arr); ?>';
  var array2 = $.parseJSON(cal1);
  $('#view_calendar').fullCalendar({
    defaultView: 'agendaWeek',
    slotMinutes: 15,
    events: array2
  });
});
</script>

<!-- View Appoinments Calendar End -->

<!-- Calendar On RunTime Start -->

<script type="text/javascript">
  $(document).ready(function () {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      $('#book_calendar').fullCalendar('render');
      $('#view_calendar').fullCalendar('render');
    });
  });
</script>

<!-- Calendar On RunTime End -->

<!-- Book Appoinments View Start -->

<script type="text/javascript">
  $(document).ready(function(){
    $('a.book_slots').click(function(){
    var app_id = $(this).attr('main');
    $('#book_appo_view').modal('show');

    $.ajax({
        url:"<?php echo $this->request->webroot; ?>trainees/getBookSlotsData",
        type:"post",
        data:{app_id : app_id},   
        dataType : "json",                 
        success: function(data){
            $('#app_date_view').val(data.message[0]['app_date']);
            $('#app_start_time_view').val(data.message[0]['app_start_time']);
            $('#app_end_time_view').val(data.message[0]['app_end_time']);
            $('#app_message_view').val(data.message[0]['app_message']);
            $('button#delete-btn,button#edit-btn').attr('main',data.message[0]['app_id']);
          }
      });
    });
  });
</script>

<!-- Book Appoinments View End -->

<!-- Delete Appoinment Start -->

<script type="text/javascript">
    $(document).ready(function(){
    $("body").on('click','#delete-btn',function(){
    if (confirm("Are You Sure?")) {
    var id = btoa($(this).attr('main'));
      $.ajax({
              url:"<?php echo $this->request->webroot; ?>trainees/deleteAppoinment",
              type:"post",
              data:{id:id},
              dataType:"json",
              success: function(data){
                  if(data.message == 'success')
                  {
                    window.location.reload(1);
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

<!-- Delete Appoinment End -->

<!-- Timepicker Start -->

<script type="text/javascript">
$(document).on("focusin", "#app_start_time,#app_end_time", function(event) {
  $(this).prop('readonly', true);
});
$(document).on("focusout", "#app_start_time,#app_end_time", function(event) {

  $(this).prop('readonly', false);
});
</script>

<script type="text/javascript">
    $(function(){

        $('#app_start_time').timepicki();
    });
</script>

<!-- Timepicker End -->

<!-- View Appoinments View Start -->

<script type="text/javascript">
  $(document).ready(function(){
    $('#view_app').on("click",".book_app",function(){
    var app_id = btoa($(this).attr('main'));
    $('#view_appo_view').modal('show');

    $.ajax({
        url:"<?php echo $this->request->webroot; ?>trainees/getViewAppoData",
        type:"post",
        data:{app_id : app_id},   
        dataType : "json",                 
        success: function(data){
            var appo_date = data.message[0]['app_date'];
            var res = appo_date.split("T"); 
            $('#tainee_app_date_view').val(res[0]);
            $('#tainee_app_reciever_id_view').val(data.message[0]['trainee_name']);
            $('#tainee_app_message_view').val(data.message[0]['app_message']);
            $('#tainee_app_start_time_view').val(data.message[0]['app_start_time']);
            $('#tainee_app_end_time_view').val(data.message[0]['app_end_time']);
          }
      });
    });
  });
</script>

<!-- View Appoinments View End -->

<!-- Appoinemnt Google Map Start -->

<script>
function initMap() {
  var map = new google.maps.Map(document.getElementById('appo_map'), {
    center: {lat: 50.447978, lng: -104.6066559},
    zoom: 13
  });

  var input = document.getElementById('pac-input');

  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    icon : "<?php echo $this->request->webroot; ?>img/favicon.ico",
    title: 'Virtual TrainR'
  });
  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });

  autocomplete.addListener('place_changed', function() {
    var location = input.value;
    infowindow.close();
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      return;
    }

    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);
    }

    marker.setPlace({
      placeId: place.place_id,
      location: place.geometry.location
    });

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
        'Place ID: ' + place.place_id + '<br>' +
        place.formatted_address);
  });
}
</script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWfYCyyRD7ROK-7d9W3WLr1rHQnWaf2Bw &libraries=places&signed_in=true&callback=initMap"
        async defer></script>


<!-- Appoinemnt Google Map End -->

