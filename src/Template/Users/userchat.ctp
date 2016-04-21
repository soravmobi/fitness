<div class="chating_wind_wrapper">
   <div class="panel panel-default">
        <div class="panel-heading top-bar">
            <h3 class="panel-title"><span class="online_Status_g active_status"></span><?php echo $profile[0][$rtype."_displayName"]; ?></h3>
            <div class="chat_seting_sect">
                 <a href="javascript:void(0)"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                 <a href="javascript:void(0)"><span class="glyphicon glyphicon-remove icon_close" main="<?php echo $count; ?>" main_id="<?php echo $main_id; ?>"></span></a><strong></strong>
            </div>
        </div>
        <div class="panel-body msg_container_base" id="load_chat_<?php echo $uniqe; ?>">
            <?php foreach($chat_data as $chat){ ?>
            <?php  if($chat["chat_sender_id"] == $user_id){  ?>
                <div class="msg_container base_sent">
                    <div class="messages msg_sent">
                        <p><?php echo nl2br($chat["chat_messsage"]); ?></p>
                    </div>
                    <div class="chat_avatar">
                        <img src="<?php echo $this->request->webroot ?>uploads/<?php echo $type."_profile/".$s_profile[0][$type."_image"] ?>" class="img-responsive img-circle">
                    </div>
                </div>
            <?php }else{ ?>
                <div class="msg_container base_receive">
                    <div class="chat_avatar">
                        <img src="<?php echo $this->request->webroot ?>uploads/<?php echo $rtype."_profile/".$profile[0][$rtype."_image"] ?>" class="img-responsive img-circle">
                    </div>
                    <div class="messages msg_receive">
                        <p><?php echo nl2br($chat["chat_messsage"]); ?></p>
                    </div>
                </div>
            <?php } } ?>
        </div>
        <div class="panel-footer">
            <div class="input-group clearfix">
                <textarea id="btn-input" class="form-control input-sm chat_input_<?php echo $uniqe; ?>" uniqe="<?php echo $uniqe; ?>" user="<?php echo $user_id; ?>" to_id="<?php echo $to_id; ?>"  main_id="<?php echo $main_id; ?>" placeholder="Write your message here..." ></textarea>
                <input type="hidden" id="alldata_<?php echo $count; ?>" value="<?php echo $all; ?>">
                <form class="soravgarg" id="send_file_<?php echo $uniqe; ?>">
                    <div class="file_attched_field">
                        <span class="fa fa-paperclip"></span>
                        <input type="file" name="chat_file" class="chat_file_<?php echo $uniqe; ?>" unique="<?php echo $uniqe; ?>" to_id="<?php echo $main_id; ?>" uid="<?php echo $user_id; ?>">
                        <input type="hidden" name="unique" value="<?php echo $uniqe; ?>">
                        <input type="hidden" name="to_id" value="<?php echo $main_id; ?>">
                        <input type="hidden" name="uid" value="<?php echo $user_id; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
var user_id = <?php echo $user_id; ?>;

$(document).ready(function(){

    $('#load_chat_<?php echo $uniqe; ?>').animate({scrollTop: $('#load_chat_<?php echo $uniqe; ?>')[0].scrollHeight}, 1);

    $("body").on("keypress",".chat_input_<?php echo $uniqe; ?>",function(e){
      if ( e.keyCode == 13 && !e.shiftKey ) {
        e.preventDefault();
        var user_msg = $(this).val().trim();
        if(user_msg != "")
        {
            var uid = $(this).attr("user");
            var tid = $(this).attr("uniqe");
            var to_id = $(this).attr("to_id");
            var main_id = $(this).attr("main_id");
            var d = new Date();
            $(this).val("");

            var chat = "";
            var rchat = "";

            var sdata = sessionStorage.getItem("rclose_"+main_id); // check to_id in rclose session data
            if(sdata != null)
            {  
               sdata = "reopen,"+sdata;
                sessionStorage.removeItem("rclose_"+main_id);
                send(sdata);
            }

            /* Save chat data in database Start */
            $.ajax({
                    url:"<?php echo $this->request->webroot; ?>users/savetextchat",
                    type:"post",
                    data:{ to_id:main_id, from_id:uid, msg:user_msg},
                    dataType:"json",
                    success: function(data)
                    {
                        //console.log(data);
                    }
            });
            /* Save chat data in database End */
            user_msg = nl2br(user_msg);
            /* store chat data in variable start */
            chat += '<div class="msg_container base_sent">';
            chat += '    <div class="messages msg_sent">';
            chat += '        <p>'+user_msg+'</p>';
            chat += '    </div>'
            chat += '    <div class="chat_avatar">'
            chat += '        <img src="<?php echo $this->request->webroot ?>uploads/<?php echo $type."_profile/".$s_profile[0][$type."_image"] ?>" class="img-responsive img-circle">';
            chat += '    </div>';
            chat += '</div>';
          
            rchat += '<div class="msg_container base_receive">';
            rchat += '    <div class="chat_avatar">';
            rchat += '        <img src="<?php echo $this->request->webroot ?>uploads/<?php echo $type."_profile/".$s_profile[0][$type."_image"] ?>" class="img-responsive img-circle">';
            rchat += '    </div>';
            rchat += '    <div class="messages msg_receive">';
            rchat += '        <p>'+user_msg+'</p>';
            rchat += '    </div>';
            rchat += '</div>';
            /* store chat data in variable End */

            /* Append data on Sender Side Start */
            $('#load_chat_'+tid).append(chat);
            $('#load_chat_'+tid).animate({scrollTop: $('#load_chat_'+tid)[0].scrollHeight}, 1000);
            /* Append data on Sender Side End */

            /* Send Data to Receiver Start */
            var jay = "userchat$@"+main_id+"$@"+tid+"$@"+rchat;
            send(jay);
            /* Send Data to Receiver Start */
        }
      }
    });

    /* For File Transfer in TextChat */
   $("body").on("change",".chat_file_<?php echo $uniqe; ?>", function(){
        var unique   = $(this).attr("unique");
        var uid      = $(this).attr("uid");            
        var to_id    = $(this).attr("to_id");
        var fd = new FormData($("#send_file_<?php echo $uniqe; ?>")[0]);
        $(this).val("");
        var sdata = sessionStorage.getItem("rclose_"+to_id); // check to_id in rclose session data
        if(sdata != null)
        {   sdata = "reopen,"+sdata;
            sessionStorage.removeItem("rclose_"+to_id);
            send(sdata);
        }
        
        $.ajax({
                url:"<?php echo $this->request->webroot; ?>users/sendfile",
                type:"post",
                data:fd,
                dataType:"json",
                cache:false,
                contentType:false,
                processData:false,
                success: function(data)
                {
                    if(data.message.trim() == "success")
                    {
                        var img_ext = ["jpeg","jpg","tif","gif","png"];
                        var msg = "";
                        var rmsg = "";
                        var ext = data.ext.toLowerCase();
                        var file;

                        if($.inArray(ext,img_ext) == -1)
                        {
                           file = '<a target="_blank" href="<?php echo $this->request->webroot; ?>uploads/chat_data/'+data.newname+'"  class="file_data">'+data.newname+'</a>';
                        }else
                        {
                           file = '<img src="<?php echo $this->request->webroot; ?>uploads/chat_data/'+data.newname+'" class="file_img">';
                        }

                        /* store chat data in variable start */
                        msg += '<div class="msg_container base_sent">';
                        msg += '    <div class="messages msg_sent">';
                        msg += '        <p>'+file+'</p>';
                        //msg += '        <time datetime="2009-11-13T20:00">Timothy • 51 min</time>';
                        //msg += '        <span>'+dtime+'</span>';
                        msg += '    </div>'
                        msg += '    <div class="chat_avatar">'
                        msg += '        <img src="<?php echo $this->request->webroot ?>uploads/<?php echo $type."_profile/".$s_profile[0][$type."_image"] ?>" class="img-responsive img-circle">';
                        msg += '    </div>';
                        msg += '</div>';
                      
                        rmsg += '<div class="msg_container base_receive">';
                        rmsg += '    <div class="chat_avatar">';
                        rmsg += '        <img src="<?php echo $this->request->webroot ?>uploads/<?php echo $type."_profile/".$s_profile[0][$type."_image"] ?>" class="img-responsive img-circle">';
                        rmsg += '    </div>';
                        rmsg += '    <div class="messages msg_receive">';
                        rmsg += '        <p>'+file+'</p>';
                        // rmsg += '        <time datetime="2009-11-13T20:00">Timothy • 51 min</time>';
                        //rmsg += '        <span>'+dtime+'</span>';
                        rmsg += '    </div>';
                        rmsg += '</div>';
                        /* store chat data in variable End */

                        /* Append data on Sender Side Start */
                        $('#load_chat_'+unique).append(msg);
                        $('#load_chat_'+unique).animate({scrollTop: $('#load_chat_'+unique)[0].scrollHeight}, 1000);
                        /* Append data on Sender Side End */

                        /* Send Data to Receiver Start */
                        var jay = "userchat$@"+to_id+"$@"+unique+"$@"+rmsg;
                        send(jay);
                        /* Send Data to Receiver Start */
                    }
                }
        });
   });

   function nl2br(someText) {
      return someText.replace ( /\n/gm, '<br />' );
   }

/*function changedatetime(dat)
{
    var diff;
    var olddate = dat;
    olddate = new Date(olddate).getTime();
    olddate = olddate.toString().substr(0, olddate.toString().length - 3);
    var today = new Date().getTime();
    today = parseInt(today.toString().substr(0, today.toString().length - 3));
    diff = today - olddate;
    if(diff/60 < 1)
    {
        return parseInt(diff) + " seccond";
    }else if(diff/(60*60) < 1)
    {
        return parseInt(diff/60) + " minut";
    }else if(diff/(60*60*24) < 1)
    {
        return parseInt(diff/(60*60)) + " hour";
    }else if(diff/(60*60*24) > 1)
    {
        return parseInt(diff/(60*60*24)) + " day";
    }else{
        var d = new Date(dat);
        return d.toLocaleString();
    }
}*/
})

</script>