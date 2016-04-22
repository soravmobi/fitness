<?php include "trainee_dashboard.php"; ?>

     <section class="trainee_dash_body">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="meal_plan_sec">

                      <!-- Tab panes -->
                  <div id="msg_tab">
                  <div class="panel_block_heading">
                        <h4>Messages</h4>
                    </div>
                    </div>
                <div class="row">
			<div class="col-md-12">
                <div class="conversation-wrap col-lg-3">
                <?php
                if(empty($all_trainers)) { ?>
                <div class="well"><center>Data Not Found </center></div>
               <?php }
                else
                {
                    foreach($all_trainers as $td) { ?>
                    <div class="media conversation side_users" main="<?php echo base64_encode($td['user_id']); ?>">
                        <a class="pull-left" href="<?php echo $this->request->webroot; ?>mytrainerProfile/<?php echo base64_encode($td['user_id']); ?>">
                            <img class="media-object" style="width: 50px; height: 50px;" src="<?php echo $this->request->webroot; ?>uploads/trainer_profile/<?php echo $td['trainer_image']; ?>">
                        </a>
                        <div class="media-body">
                            <h5 class="media-heading"><?php echo substr(ucwords($td['trainer_name']),0,25); ?></h5>
                            <small><?php echo substr($td['trainer_displayName'],0,30); ?></small>
                        </div>
                    </div>
                <?php } } ?>
                </div>
                <div class="message-wrap col-lg-9">
                    <div class="msg-wrap" id="chat_msgs">
                    <?php
                if(empty($chat_data)) { ?>
                <div><center>You have recieved no messages </center></div>
               <?php }
                else
                {
                foreach($chat_data as $cd) { 
                    // trainee_messages
                if($cd['chat_reciever_id'] != $trainee_id) { ?>
                <div class="media msg">
                        <a class="pull-left" href="<?php echo $this->request->webroot; ?>trainees/profile">
                            <img class="media-object" style="width: 32px; height: 32px;" src="<?php echo $this->request->webroot; ?>uploads/trainee_profile/<?php echo $profile_details[0]['trainee_image']; ?>">
                        </a>
                        <div class="media-body">
                            <small class="pull-right"><i class="fa fa-clock-o"></i> <?php echo date('d F y,h:i A', strtotime($cd["chat_added_date"])); ?></small>
                            <h5 class="media-heading"><?php echo ucwords($profile_details[0]['trainee_name']); ?></h5>
    
                            <small><?php echo $cd['chat_messsage']; ?></small>
                        </div>
                    </div>
                    <hr>
                <?php } 
                // trainer_messages
                else { ?>
                <div class="media msg">
                        <a class="pull-left" href="<?php echo $this->request->webroot; ?>mytrainerProfile/<?php echo base64_encode($trainer_details[0]['user_id']); ?>">
                            <img class="media-object" style="width: 32px; height: 32px;" src="<?php echo $this->request->webroot; ?>uploads/trainer_profile/<?php echo $trainer_details[0]['trainer_image']; ?>">
                        </a>
                        <div class="media-body">
                            <small class="pull-right"><i class="fa fa-clock-o"></i> <?php echo date('d F y,h:i A', strtotime($cd["chat_added_date"])); ?></small>
                            <h5 class="media-heading"><?php echo ucwords($trainer_details[0]['trainer_name']); ?></h5>
    
                            <small><?php echo $cd['chat_messsage']; ?></small>
                        </div>
                    </div>
                    <hr>
                <?php } } } ?>
                    </div>

                    <!-- <div class="send-wrap ">
                        <textarea class="form-control send-message" rows="3" placeholder="Write a reply..."></textarea>
                    </div>
                    
                    <div class="btn-panel">
                        <a href="" class="text-right bt  send-message-btn pull-right" role="button">Send Message</a>
                    </div> -->
                    
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

<!-- Side Users Messages Start -->

<script type="text/javascript">
    $(document).ready(function(){
    $('body').on('click','.side_users',function(){
    var trainer_id = $(this).attr('main');
        $.ajax({
                url:"<?php echo $this->request->webroot; ?>trainees/getMessages",
                type:"post",
                data:{trainer_id:trainer_id},
                dataType:"json",
                success: function(data){
                    $('#chat_msgs').html(data.message);
                }
            });
    });
    });
</script>


<!-- Side Users Messages End -->


