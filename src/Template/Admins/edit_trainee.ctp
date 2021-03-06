        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Edit Trainee</h2>   
                        <!-- <h5>Welcome Jhon Deo , Love to see you back. </h5> -->
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            <div class="row">
                <div class="col-md-12">
                <?php echo $this->Custom->successMsg(); ?>
                 <?php echo $this->Custom->errorMsg(); ?>
                 <?php echo $this->Custom->loadingImg(); ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Trainee
                        </div>
                        <div class="panel-body">
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#personal" data-toggle="tab">Personal Informaiton</a>
                                </li>
                                <li class=""><a href="#password" data-toggle="tab">Change Password</a>
                                </li>
                                <li class=""><a href="#social_links" data-toggle="tab">Social Links</a>
                                </li>
                                <li class=""><a href="#about" data-toggle="tab">About Me</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="personal">
                                <form method="post" action="<?php echo $this->request->webroot; ?>admins/updateTraineeProfile/<?php echo base64_encode($trainee_details[0]['user_id']); ?>">
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Name
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" required value="<?php if(isset($trainee_details[0]['trainee_name'])) echo $trainee_details[0]['trainee_name']; ?>" name="trainee_name" class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Email Id
                                        </div>
                                        <div class="col-md-10">
                                            <input type="email" required value="<?php if(isset($trainee_details[0]['trainee_email'])) echo $trainee_details[0]['trainee_email']; ?>" readonly class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Display Name
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" required value="<?php if(isset($trainee_details[0]['trainee_displayName'])) echo $trainee_details[0]['trainee_displayName']; ?>" name="trainee_displayName"  class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Gender
                                        </div>
                                        <div class="col-md-10">
                                            <select required name="trainee_gender" class="form-control">
                                                <option value="male" <?php if(isset($trainee_details[0]['trainee_gender']) && $trainee_details[0]['trainee_gender'] == "male") echo "selected"; ?>>Male</option>
                                                <option value="female" <?php if(isset($trainee_details[0]['trainee_gender']) && $trainee_details[0]['trainee_gender'] == "female") echo "selected"; ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Zip Code
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" required value="<?php if(isset($trainee_details[0]['trainee_zip'])) echo $trainee_details[0]['trainee_zip']; ?>" name="trainee_zip" class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Current Weight (in lbs)
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" required value="<?php if(isset($trainee_details[0]['trainee_current_weight'])) echo $trainee_details[0]['trainee_current_weight']; ?>" name="trainee_current_weight" class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Goal (in lbs)
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" required value="<?php if(isset($trainee_details[0]['trainee_goal'])) echo $trainee_details[0]['trainee_goal']; ?>" name="trainee_goal" class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Country
                                        </div>
                                        <div class="col-md-10">
                                        <select required id="trainer_country" name="trainee_country" class="form-control ">
                                            <option value="">Country</option>
                                            <?php 
                                            foreach($countries as $c) { ?>
                                                <option value="<?php echo $c['id']; ?>" <?php if(isset($trainee_details[0]['trainee_country']) && $trainee_details[0]['trainee_country'] == $c['id'])  echo "selected='selected'"; ?>><?php echo $c['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                           State
                                        </div>
                                        <div class="col-md-10">
                                        <select required id="trainer_state"  name="trainee_state" class="form-control ">
                                            <option value="">State</option>
                                            <?php 
                                            foreach($states as $c) { ?>
                                                <option value="<?php echo $c['id']; ?>" <?php if(isset($trainee_details[0]['trainee_state']) && $trainee_details[0]['trainee_state'] == $c['id'])  echo "selected='selected'"; ?>><?php echo $c['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            City
                                        </div>
                                        <div class="col-md-10">
                                        <select required id="trainer_city" name="trainee_city" class="form-control ">
                                            <option value="">City</option>
                                            <?php 
                                            foreach($cities as $c) { ?>
                                                <option value="<?php echo $c['id']; ?>" <?php if(isset($trainee_details[0]['trainee_city']) && $trainee_details[0]['trainee_city'] == $c['id'])  echo "selected='selected'"; ?>><?php echo $c['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Update" />
                                    </div>
                                </form>
                                </div>
                                <div class="tab-pane fade" id="password">
                                <form method="post" id="passwordForm" action="<?php echo $this->request->webroot; ?>admins/changeTraineePassword/<?php echo base64_encode($trainee_details[0]['user_id']); ?>">
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            New Password
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" value="<?php if(isset($trainee_details[0]['trainee_password'])) echo $trainee_details[0]['trainee_password']; ?>" id="new_password" name="trainee_password" class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Confirm Password
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" value="<?php if(isset($trainee_details[0]['trainee_password'])) echo $trainee_details[0]['trainee_password']; ?>"  id="cnfm_password" class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <input type="button" id="password-btn" class="btn btn-primary" value="Update" />
                                    </div>
                                </form>
                                     
                                </div>
                                <div class="tab-pane fade" id="social_links">
                                <form method="post" action="<?php echo $this->request->webroot; ?>admins/updateTraineeProfile/<?php echo base64_encode($trainee_details[0]['user_id']); ?>">
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Facebook
                                        </div>
                                        <div class="col-md-10">
                                            <input type="url" required value="<?php if(isset($trainee_details[0]['trainee_facebook'])) echo $trainee_details[0]['trainee_facebook']; ?>" name="trainee_facebook" class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Linked
                                        </div>
                                        <div class="col-md-10">
                                            <input type="url" required value="<?php if(isset($trainee_details[0]['trainee_linkedin'])) echo $trainee_details[0]['trainee_linkedin']; ?>" name="trainee_linkedin" class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            BelibiTv
                                        </div>
                                        <div class="col-md-10">
                                            <input type="url" required value="<?php if(isset($trainee_details[0]['trainee_belibitv'])) echo $trainee_details[0]['trainee_belibitv']; ?>" name="trainee_belibitv" class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Twitter
                                        </div>
                                        <div class="col-md-10">
                                            <input type="url" required value="<?php if(isset($trainee_details[0]['trainee_twitter'])) echo $trainee_details[0]['trainee_twitter']; ?>" name="trainee_twitter" class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Google
                                        </div>
                                        <div class="col-md-10">
                                            <input type="url" required value="<?php if(isset($trainee_details[0]['trainee_google'])) echo $trainee_details[0]['trainee_google']; ?>" name="trainee_google" class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            Instagram
                                        </div>
                                        <div class="col-md-10">
                                            <input type="url" required value="<?php if(isset($trainee_details[0]['trainee_instagram'])) echo $trainee_details[0]['trainee_instagram']; ?>" name="trainee_instagram" class="form-control" />
                                        </div>
                                    </div>
                                    </div></br></br>
                                    <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Update" />
                                    </div>
                                </form>
                                </div>
                                <div class="tab-pane fade" id="about">
                                <form method="post" action="<?php echo $this->request->webroot; ?>admins/updateTraineeProfile/<?php echo base64_encode($trainee_details[0]['user_id']); ?>">
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            About Me
                                        </div>
                                        <div class="col-md-10">
                                            <textarea required class="form-control" rows="20" name="trainee_aboutme"><?php if(isset($trainee_details[0]['trainee_aboutme'])) echo $trainee_details[0]['trainee_aboutme']; ?></textarea>
                                        </div>
                                    </div>
                                    </div></br></br></br></br>
                                    <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Update" />
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- /. ROW  -->
        </div>
               
            </div>
             <!-- /. PAGE INNER  -->
            </div>

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

<!-- Change Password Start -->

<script type="text/javascript">
    $(document).ready(function(){
    $('body').on('click','#password-btn',function(){
    var pswd = $('#new_password').val();
    var cnfm_pswd = $('#cnfm_password').val();
    $('div#success_msg').hide();
    if(pswd == "" || cnfm_pswd == "")
    {
        $("div#error_msg").html("<center><i class='fa fa-times'> Please Fill All Fields ! </i></center>").show();
        return false;
    }
    if(pswd != cnfm_pswd)
    {
        $("div#error_msg").html("<center><i class='fa fa-times'> Password Not Matched ! </i></center>").show();
        return false;
    }
    if(pswd == cnfm_pswd)
    {
        $("#passwordForm").submit();
    }

    });
    });
</script>

<!-- Change Password Start -->        



