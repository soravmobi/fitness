<?php include "trainer_dashboard.php"; ?>

<!--Main container sec start-->
<section class="wallet_dash_body">
<div class="main_container">
<div class=" customer_report_main trainer_report_main">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="session_setails_sec">
          <div class="heading_payment_main">
            <h2> Search</h2>
          </div>
          <div class="session_content">
            <div class="transaction_date_wrap">
              <div class="form-group">
                <input type="radio" id="f-option" name="selector">
                <label for="f-option"> From</label>
                <div class="check">
                  <div class="inside"></div>
                </div>
              </div>
              <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                  <input type='text' class="form-control" />
                  <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> <span class="divider">to</span> </div>
              </div>
              <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                  <input type='text' class="form-control" />
                  <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span> </span> </div>
              </div>
            </div>
            <div class="transaction_date_wrap year_wrap">
              <div class="form-group">
                <input type="radio" id="f-option1" name="selector">
                <label for="f-option1">Weekly</label>
                <div class="check">
                  <div class="inside"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group date">
                  <select class="form-control">
                    <option>1 Week</option>
                    <option>2 Week</option>
                    <option>3 Week</option>
                    <option>4 Week</option>
                  </select>
                  <div class="icon_arrow"><i class="fa fa-caret-down"></i></div>
                </div>
              </div>
              <div class="form-group">
                <input type="radio" id="f-option3" name="selector">
                <label for="f-option3">Monthly</label>
                <div class="check">
                  <div class="inside"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group date">
                  <select class="form-control">
                    <option>Month</option>
                  </select>
                  <div class="icon_arrow"><i class="fa fa-caret-down"></i></div>
                </div>
              </div>
              <div class="form-group">
                <input type="radio" id="f-option4" name="selector">
                <label for="f-option4">Annual</label>
                <div class="check">
                  <div class="inside"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group date">
                  <select class="form-control">
                    <option>Annual</option>
                  </select>
                  <div class="icon_arrow"><i class="fa fa-caret-down"></i></div>
                </div>
              </div>
            </div>
            <div class="statement_button">
              <button type="submit" class="clear">clear</button>
              <button type="submit">Get Statement</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="session_setails_sec wallet_balance">
          <div class="heading_payment_main">
            <h2>My Total Earnings</h2>
          </div>
          <div class="session_content total_earn">
            <p>Current Balance</p>
            <div class="cloud_box">
              <div class="cloud"><i class="fa fa-usd"></i></div>
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
            <div class="rate_box">$200</div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
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
                <h2>custom packages sold</h2>
              </div>
              <div class="col-md-6 col-sm-6 text-right">
                <ul class="list_table_icon">
                  <li><a href="javascript:void(0);"><i class="fa fa-file-pdf-o"></i> </a></li>
                  <li><a href="javascript:void(0);"> <i class="fa fa-file-excel-o"></i> </a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="cr_table_content">
            <table class="table">
              <thead >
                <tr>
                  <th>TRANS</th>
                  <th>Trainee</th>
                  <th>package name</th>
                  <th>price</th>
                  <th>date</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                  foreach($custom_packages as $t){ ?>
                  <tr>
                    <td><a class="txns" href="<?php echo $this->request->webroot; ?>trainers/packagepdf?id=<?php echo $t['cp_id']; ?>">SK<?php echo ($i >= 10) ? $i : "0".$i ?></a></td>                                   
                    <td><?php echo $t['trainee_name']." ".$t['trainee_lname']; ?></td>
                    <td><?php echo $t['package_name']; ?></td>
                    <td>$<?php echo $t['price']; ?></td>
                    <td><?php echo date('d F Y, h:i A', strtotime($t['created_date'])); ?></td>
                  </tr>
                <?php $i++; } ?>
            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="session_setails_sec wallet_balance trainer_earning">
          <div class="heading_payment_main">
            <h2>highest trainer earnings of the month</h2>
          </div>
          <div class="session_content">
            <div class="row">
              <div class="col-md-3 col-sm-4">
                <div class="trainer_wrap_box">
                  <div class="heading_payment_main"> </div>
                  <div class="trainer_top_main">
                    <div class="trainer_top clearfix">
                      <h2>$45/HR</h2>
                    </div>
                    <div class="img_trainer"> <img class="img-responsive" src="<?php echo $this->request->webroot; ?>images/trainer.png"> </div>
                  </div>
                  <div class="trainer_bottom">
                    <div class="name_wrap">Andre Eloumou</div>
                    <div class="location_wrap">
                      <ul>
                        <li><span>Location :</span> Ottawa, Canada</li>
                        <li><span>score :</span>
                          <div class="small green percircle animate gt50" data-percent="94" id="greencircle"> <span>94%</span>
                            <div class="slice">
                              <div class="bar" style="transform: rotate(338.4deg);"></div>
                              <div class="fill"></div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="describe_wrap">
                      <ul>
                        <p><span>Skills:</span> Biceps, Tricpes, Shoulder</p>
                        <p><span>Interests :</span> Make the world a better<span class="show_div"> place through fitness.</span></p>
                        <p><span>Certifications :</span> Certificate in Personal<span class="show_div"> Training CYQ Level 3.</span></p>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="earn_box"> Total Earning : <span>$1500</span> </div>
              </div>
              <div class="col-md-3 col-sm-4">
                <div class="trainer_wrap_box">
                  <div class="heading_payment_main"> </div>
                  <div class="trainer_top_main">
                    <div class="trainer_top clearfix">
                      <h2>$45/HR</h2>
                    </div>
                    <div class="img_trainer"> <img class="img-responsive" src="<?php echo $this->request->webroot; ?>images/trainer.png"> </div>
                  </div>
                  <div class="trainer_bottom">
                    <div class="name_wrap">Andre Eloumou</div>
                    <div class="location_wrap">
                      <ul>
                        <li><span>Location :</span> Ottawa, Canada</li>
                        <li><span>score :</span>
                          <div class="small green percircle animate gt50" data-percent="94" id="greencircle"> <span>94%</span>
                            <div class="slice">
                              <div class="bar" style="transform: rotate(338.4deg);"></div>
                              <div class="fill"></div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="describe_wrap">
                      <ul>
                        <p><span>Skills:</span> Biceps, Tricpes, Shoulder</p>
                        <p><span>Interests :</span> Make the world a better<span class="show_div"> place through fitness.</span></p>
                        <p><span>Certifications :</span> Certificate in Personal<span class="show_div"> Training CYQ Level 3.</span></p>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="earn_box"> Total Earning : <span>$1500</span> </div>
              </div>
              <div class="col-md-3 col-sm-4">
                <div class="trainer_wrap_box">
                  <div class="heading_payment_main"> </div>
                  <div class="trainer_top_main">
                    <div class="trainer_top clearfix">
                      <h2>$45/HR</h2>
                    </div>
                    <div class="img_trainer"> <img class="img-responsive" src="<?php echo $this->request->webroot; ?>images/trainer.png"> </div>
                  </div>
                  <div class="trainer_bottom">
                    <div class="name_wrap">Andre Eloumou</div>
                    <div class="location_wrap">
                      <ul>
                        <li><span>Location :</span> Ottawa, Canada</li>
                        <li><span>score :</span>
                          <div class="small green percircle animate gt50" data-percent="94" id="greencircle"> <span>94%</span>
                            <div class="slice">
                              <div class="bar" style="transform: rotate(338.4deg);"></div>
                              <div class="fill"></div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="describe_wrap">
                      <ul>
                        <p><span>Skills:</span> Biceps, Tricpes, Shoulder</p>
                        <p><span>Interests :</span> Make the world a better<span class="show_div"> place through fitness.</span></p>
                        <p><span>Certifications :</span> Certificate in Personal<span class="show_div"> Training CYQ Level 3.</span></p>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="earn_box"> Total Earning : <span>$1500</span> </div>
              </div>
              <div class="col-md-3 col-sm-4">
                <div class="trainer_wrap_box">
                  <div class="heading_payment_main"> </div>
                  <div class="trainer_top_main">
                    <div class="trainer_top clearfix">
                      <h2>$45/HR</h2>
                    </div>
                    <div class="img_trainer"> <img class="img-responsive" src="<?php echo $this->request->webroot; ?>images/trainer.png"> </div>
                  </div>
                  <div class="trainer_bottom">
                    <div class="name_wrap">Andre Eloumou</div>
                    <div class="location_wrap">
                      <ul>
                        <li><span>Location :</span> Ottawa, Canada</li>
                        <li><span>score :</span>
                          <div class="small green percircle animate gt50" data-percent="94" id="greencircle"> <span>94%</span>
                            <div class="slice">
                              <div class="bar" style="transform: rotate(338.4deg);"></div>
                              <div class="fill"></div>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="describe_wrap">
                      <ul>
                        <p><span>Skills:</span> Biceps, Tricpes, Shoulder</p>
                        <p><span>Interests :</span> Make the world a better<span class="show_div"> place through fitness.</span></p>
                        <p><span>Certifications :</span> Certificate in Personal<span class="show_div"> Training CYQ Level 3.</span></p>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="earn_box"> Total Earning : <span>$1500</span> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="customer_report_table_sec">
          <div class="cr_table_head">
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <h2>withdrawals</h2>
              </div>
              <div class="col-md-6 col-sm-6 text-right">
                <ul class="list_table_icon">
                  <li><a href="javascript:void(0);"><i class="fa fa-file-pdf-o"></i> </a></li>
                  <li><a href="javascript:void(0);"> <i class="fa fa-file-excel-o"></i> </a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="cr_table_content">
            <table class="table">
              <thead>
                <tr>
                  <th>TRANS</th>
                  <th>Amount</th>
                  <th>Withdraw Fee</th>
                  <th>Type</th>
                  <th>withdrawal date</th>
                  <th>status</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                  foreach($withdraw_details as $t){ ?>
                  <tr>
                    <td><a class="txns" href="<?php echo $this->request->webroot; ?>trainers/withdrawpdf?id=<?php echo $t['id']; ?>">SK<?php echo ($i >= 10) ? $i : "0".$i ?></a></td>                                   
                    <td>$<?php echo $t['ammount']; ?></td>
                    <td>$<?php echo $t['withdraw_fees']; ?></td>
                    <td>
                      <?php
                        switch ($t['withdraw_payment_type']) {
                          case '0':
                            echo "Paypal";
                            break;
                          case '1':
                            echo "Amazon";
                            break;
                          default:
                            echo "Direct Payment";
                            break;
                        }
                      ?>
                    </td>
                    <td><?php echo date('d F Y, h:i A', strtotime($t['added_date'])); ?></td>
                    <td>
                      <?php
                        switch ($t['withdraw_status']) {
                          case '0':
                            echo "Pending";
                            break;
                          case '1':
                            echo "Completed";
                            break;
                          case '2':
                            echo "Failed";
                            break;
                          default:
                            echo "NA";
                            break;
                        }
                      ?>
                    </td>
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
</section>
<!--Main container sec end--> 