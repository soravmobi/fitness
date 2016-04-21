
      <?php foreach($onlineuser as $online){ ?>
            <li>
                  <a href="javascript:void(0)" class="user_call" t_type="<?php echo $type; ?>" to_id="<?php echo $online["user_id"]; ?>" from_id="<?php echo $user_id; ?>" c_type="chat"><span><img class="img-circle" src="<?php echo $this->request->webroot; ?>uploads/<?php echo $online["user_type"]; ?>_profile/<?php echo $online[$online["user_type"].'_image'];  ?>"/></span><h2><?php echo ($online["online"] == 1)? '<em class="onlin_status_sect online_active"></em>' : '<em class="onlin_status_sect"></em>';  ?><?php echo $online[$online["user_type"].'_displayName'];  ?></h2></a>
            </li>
      <?php } ?>


