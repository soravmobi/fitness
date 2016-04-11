<?php include "trainer_dashboard.php"; ?>
     <section class="trainee_dash_body">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="meal_plan_sec">

                      <!-- Tab panes -->
                      <div class="tab-content">
                      <?php echo $this->Flash->render('edit') ?>    
                        <div class="panel_block notification">
        
                                <div class="panel_block_heading">
                                    <h4>Notification</h4>
                                </div>
                                
                                <div class="notification_panel_body">
                                    <ul id="accordion" role="tablist">
                            <?php $i = 1; 
                            foreach($noti_data as $nd) { 
                                if($nd['noti_type'] == "Appoinment Request") { ?>
                                <li class="panel" id="appo_<?php echo $nd['noti_id']; ?>">
                                    <div class="panel-heading">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#notification<?php echo $nd['noti_id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="pbb_left">
                                            <div class="pbbl_img">
                                        <?php
                                            if($nd['trainee_image'] != "")
                                            { ?>

                                                <img src="<?php echo $this->request->webroot; ?>uploads/trainee_profile/<?php echo $nd['trainee_image'];  ?>" alt="img" class="img-circle">
                                        <?php }
                                            else
                                            { ?>
                                                <img src="<?php echo $this->request->webroot; ?>img/default.png" alt="img" class="img-circle">
                                        <?php } ?>
                                            </div>
                                            <div class="pbbl_txt">
                                                <h5><?php echo ucwords($nd['noti_message']); ?> </strong></h5>
                                            </div>
                                        </div>
                                        <div class="pbb_right">
                                            <div class="mesg_time">
                                                <?php echo time_elapsed_string($nd['noti_added_date']); ?>
                                            </div>
                                        </div>
                                        </a>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="notification<?php echo $nd['noti_id']; ?>" class="panel-collapse collapse">
                                      <div class="panel-body">
                                       <!-- <p> <?php echo $nd['noti_message']; ?></p></br> -->
                                       <!-- <strong>Appoinment Date :</strong> <?php echo $nd['app_date']; ?></br></br>
                                       <strong>Start Time :</strong> <?php echo $nd['app_start_time']; ?></br></br>
                                       <strong>End Time :</strong> <?php echo $nd['app_end_time']; ?></br></br>
                                       <strong>Message :</strong> <?php echo $nd['app_message']; ?></br></br> -->
                                      
                                       <div class="row">
                                         <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 notification_table">
                                           <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                               <tr>
                                                   <th>Appoinment Date :</th>
                                                   <td><?php echo $nd['app_date']; ?></td>
                                               </tr>
                                               <tr>
                                                   <th>Start Time :</th>
                                                   <td><?php echo $nd['app_start_time']; ?></td>
                                               </tr>
                                               <tr>
                                                   <th>End Time :</th>
                                                   <td><?php echo $nd['app_end_time']; ?></td>
                                               </tr>
                                               <tr>
                                                   <th>Message :</th>
                                                   <td><?php echo $nd['app_message']; ?></td>
                                               </tr>
                                             <?php 
                                        if($nd['noti_status'] == 0) { ?>
                                       <tr>
                                           <th> </th>
                                           <td><a href="<?php echo $this->request->webroot; ?>trainers/acceptAppoinment/<?php echo base64_encode($nd['app_id']); ?>/<?php echo base64_encode($nd['noti_id']); ?>/<?php echo base64_encode($nd['user_id']); ?>" title="Accept Appoinment" class="btn btn-success accept_request">Accept</a> <a href="<?php echo $this->request->webroot; ?>trainers/rejectAppoinment/<?php echo base64_encode($nd['app_id']); ?>/<?php echo base64_encode($nd['noti_id']); ?>/<?php echo base64_encode($nd['user_id']); ?>"  title="Delete Appoinment" class="btn btn-danger delete_appo">Delete</a></td>
                                       </tr>
                                       <?php } 
                                       if($nd['noti_status'] == 1) { ?>
                                       <th>Status :</th>
                                       <td>Appoinmnet Accepted</td>
                                       <?php } 
                                       if($nd['noti_status'] == 2) { ?>
                                       <th>Status :</th>
                                       <td>Appoinmnet Rejected</td>
                                       <?php } ?>
                                           </table>
                                         </div>
                                       </div>
                                      </div>
                                    </div>
                                </li>

                                <?php } 
                                if($nd['noti_type'] == "Hire") { ?>
                                <li class="panel" id="hire_trainer<?php echo $nd['noti_id']; ?>">
                                    <div class="panel-heading">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#notification<?php echo $nd['noti_id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="pbb_left">
                                            <div class="pbbl_img">
                                                 <?php
                                            if($nd['trainee_image'] != "")
                                            { ?>

                                                <img src="<?php echo $this->request->webroot; ?>uploads/trainee_profile/<?php echo $nd['trainee_image'];  ?>" alt="img" class="img-circle">
                                        <?php }
                                            else
                                            { ?>
                                                <img src="<?php echo $this->request->webroot; ?>img/default.png" alt="img" class="img-circle">
                                        <?php } ?>
                                            </div>
                                            <div class="pbbl_txt">
                                                <h5><?php echo ucwords($nd['noti_message']); ?> </strong></h5>
                                            </div>
                                        </div>
                                        <div class="pbb_right">
                                            <div class="mesg_time">
                                                <?php echo time_elapsed_string($nd['noti_added_date']); ?>
                                            </div>
                                        </div>
                                        </a>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="notification<?php echo $nd['noti_id']; ?>" class="panel-collapse collapse">
                                      <div class="panel-body">
                                      <?php
                                      if($nd['noti_status'] == 0) { ?>
                                       <a href="<?php echo $this->request->webroot; ?>trainers/acceptRequest/<?php echo base64_encode($nd['hire_id']); ?>/<?php echo base64_encode($nd['noti_id']); ?>/<?php echo base64_encode($nd['user_id']); ?>" title="Accept Request" class="btn btn-success accept_request">Accept</a> &nbsp; &nbsp; 
                                       <a href="javascript:void(0);" main1="<?php echo base64_encode($nd['noti_id']); ?>" main2="<?php echo base64_encode($nd['hire_id']); ?>" main3="<?php echo base64_encode($nd['user_id']); ?>" title="Delete Request" class="btn btn-danger delete_request">Delete</a>
                                       <?php } 
                                       if($nd['noti_status'] == 1) { ?>
                                       Status :
                                       Request Accepted
                                       <?php } 
                                       if($nd['noti_status'] == 2) { ?>
                                       Status :
                                       Request Rejected
                                       <?php } ?>
                                        
                                      </div>
                                    </div>
                                </li>
                                <?php } 
                                if($nd['noti_type'] == "Appoinment Accept" || $nd['noti_type'] == "Appoinment Delete") { ?>
                                 <li class="panel appoinment_status" main="<?php echo base64_encode($nd['noti_id']); ?>">
                                    <div class="panel-heading">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#notification<?php echo $nd['noti_id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="pbb_left">
                                            <div class="pbbl_img">
                                                 <?php
                                            if($nd['trainee_image'] != "")
                                            { ?>

                                                <img src="<?php echo $this->request->webroot; ?>uploads/trainee_profile/<?php echo $nd['trainee_image'];  ?>" alt="img" class="img-circle">
                                        <?php }
                                            else
                                            { ?>
                                                <img src="<?php echo $this->request->webroot; ?>img/default.png" alt="img" class="img-circle">
                                        <?php } ?>
                                            </div>
                                            <div class="pbbl_txt">
                                                <h5><?php echo ucwords($nd['noti_message']); ?> </strong></h5>
                                            </div>
                                        </div>
                                        <div class="pbb_right">
                                            <div class="mesg_time">
                                                <?php echo time_elapsed_string($nd['noti_added_date']); ?>
                                            </div>
                                        </div>
                                        </a>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="notification<?php echo $nd['noti_id']; ?>" class="panel-collapse collapse">
                                      <div class="panel-body">
                                       <p> <?php echo $nd['noti_message']; ?></p></br>
                                       <strong>Appoinment Date :</strong> <?php echo $nd['app_date']; ?></br></br>
                                       <strong>Start Time :</strong> <?php echo $nd['app_start_time']; ?></br></br>
                                       <strong>End Time :</strong> <?php echo $nd['app_end_time']; ?></br></br>
                                       <strong>Message :</strong> <?php echo $nd['app_message']; ?></br></br>
                                      </div>
                                    </div>
                                </li>
                                <?php } $i++; } ?>
                            </ul> 
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

<!-- Time Ago Script Start -->

  <?php
      function time_elapsed_string($datetime, $full = false)
      {
      $now     = new DateTime;
      $ago     = new DateTime($datetime);
      $diff    = $now->diff($ago);
      $diff->w = floor($diff->d / 7);
      $diff->d -= $diff->w * 7;

      $string = array(
          'y' => 'year',
          'm' => 'month',
          'w' => 'week',
          'd' => 'day',
          'h' => 'hour',
          'i' => 'minute',
          's' => 'second'
      );
      foreach ($string as $k => &$v) {
          if ($diff->$k) {
              $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
          } else {
              unset($string[$k]);
          }
      }

      if (!$full)
          $string = array_slice($string, 0, 1);
      return $string ? implode(', ', $string) . ' ago' : 'just now';
      }
  ?>

<!-- Time Ago Script End -->

<!--Update Notifications Start -->

<script type="text/javascript">
  $(document).ready(function(){
    $('body').on('click','.appoinment_status',function(){
      var noti_id = $(this).attr('main');
      $.ajax({
            url:"<?php echo $this->request->webroot; ?>trainers/updateNotification",
            type:"post",
            data:{noti_id:noti_id},
            dataType:"json",
            success: function(data){
                
            }
        });
    });
  });
</script>

<!--Update Notifications End -->



