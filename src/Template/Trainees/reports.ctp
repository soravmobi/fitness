<?php include "trainee_dashboard.php"; ?>

<section class="trainee_top">

    <!--Main container sec start-->
    <div class="main_container">
       <div class="customer_report_main">
          <div class="container-fluid">
             <div class="row">
                 <div class="col-md-8 col-sm-8">
                    <div class="session_setails_sec">
                          <div class="heading_payment_main">
                            <h2> transaction history</h2>
                          </div>
                           
                           <ul class="session_content">
                              <div class="transaction_date_wrap">
                               <div class="form-group">
                                <input type="radio" id="f-option" name="selector">
                                  <label for="f-option">Transaction Date From</label>
                                  <div class="check"><div class="inside"></div></div>
                               
                                  </div>
                                   <div class="form-group">
                                        <div class='input-group date' id='datetimepicker2'>
                                        <input type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                           <span class="divider">to</span>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker2'>
                                        <input type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    </div>
                                </div>
                              <div class="transaction_date_wrap">
                               <div class="form-group">
                               <input type="radio" id="f-option1" name="selector">
                                  <label for="f-option1">Transaction Date From</label>
                                  <div class="check"><div class="inside"></div></div>
                                
                                  </div>
                                   <div class="form-group">
                                      <div class="input-group date">
                                        <select class="form-control"> <option>Last 1 Month</option></select>
                                        <div class="icon_arrow"><i class="fa fa-caret-down"></i></div>
                                       </div>
                                    </div>
                                    
                                </div>
                                <div class="statement_button">
                                  <button type="submit" class="clear">clear</button>
                                  <button type="submit">Get Statement</button>
                                </div>
                            </ul>
                        </div>
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
                 <div class="col-md-4 col-sm-4">
                     <div class="session_setails_sec wallet_balance">
                          <div class="heading_payment_main">
                            <h2> Wallet balance</h2>
                          </div>
                          <ul class="session_content">
                              <p>Current Balance</p>
                              <div class="cloud_box">
                                 <div class="cloud"><i class="fa fa-money"></i></div>
                              </div>
                              <div class="rate_box">$<?php echo round($wallet_balance,2); ?></div>
                          </ul>
                      </div>
                  </div>
                </div>
             <div class="row">
               <div class="col-sm-12 col-md-12">
                <div class="customer_report_table_sec">
                     <div class="cr_table_head">
                        <div class="row">
                           <div class="col-md-6 col-sm-6">
                             <h2>transactions list - <?php echo $profile_details[0]['trainee_name']." ".$profile_details[0]['trainee_lname']; ?></h2>
                           </div>
                           <div class="col-md-6 col-sm-6 text-right">
                              <ul class="list_table_icon">
                                <li><a href="#"><i class="fa fa-file-pdf-o"></i> </a></li>
                                <li><a href="#"> <i class="fa fa-file-excel-o"></i> </a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="cr_table_content">
                        <table class="table">
                            <thead >
                                <tr>
                                    <th>TRANS</th>
                                    <th>transaction name</th>
                                    <th>transaction id</th>
                                    <th>transaction type</th>
                                    <th>amount</th>
                                    <th>Transaction date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                  foreach($txns_details as $t){ ?>
                                  <tr>
                                    <td>SK<?php echo ($i >= 10) ? $i : "0".$i ?></td>                                   
                                    <td><?php echo $t['txn_name']; ?></td>
                                    <td><?php echo $t['txn_id']; ?></td>
                                    <td><?php echo $t['txn_type']; ?></td>
                                    <td>$<?php echo $t['ammount']; ?></td>
                                    <td><?php echo date('d F Y, h:i A', strtotime($t['added_date'])); ?></td>
                                  </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                     </div>
                 </div>   
               </div>
             </div>
       </div>
        
    </div>
    <!--Main container sec end-->

</section>