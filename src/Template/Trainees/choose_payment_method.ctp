<?php include "trainee_dashboard.php"; ?>

		<section class="payment_details paymnet_page">
         <div class="top_bar_wrap">
            <div class="container">
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="tbw_text">
                  <i class="fa fa-cc-mastercard"></i> select payment method
                  </div>
              </div>
             </div>
           </div>
           <?php
              if(empty($total_wallet_ammount)){
                  $wallet_balance = "0";
              }
              else
              {
                  $wallet_balance =  $total_wallet_ammount[0]['total_ammount'];
              }
              $remaining_amount = (round($total_amount - $wallet_balance,2) > 0) ? round($total_amount - $wallet_balance,2) : "0";
          ?>
         </div>
         <div class="payment_option_page">
           <div class="container">
               <div class="head_payment">
                 total payment to be made <span>$<?php echo round($total_amount,2); ?></span>
               </div>

               <div class="payment_wallet_wrap">
                   <form method="post" class="wallet_pay" action="<?php echo $this->request->webroot; ?>trainees/doSessionPayment">
                   <input type="hidden" name="voucher_id" id="voucher-id" value="<?php echo $voucherid; ?>">
                   <div class="heading_payment_main">
                          </div>
                     <div class="payment_field">
                     <div class="check_box">
                           <div class="checkbox">
                            <input type="checkbox" id="test1" class="wallet-btn" checked/>
                            <label for="test1">use payment wallet<span id="wallet_amt"><span></label>    
                           </div>
                          </div>
                  <input type="hidden" name="wallet_amount" id="wallet_amount" value="<?php echo $wallet_balance; ?>">
	                  <div class="wallet_section">
                      <?php if($wallet_balance >= $total_amount) { ?>
                        <div class="form-group bal_amount">
                            <div class="payment_method ">money in your wallet <strong>$<?php echo round($wallet_balance,2); ?></strong></div>
                           <span class="fa fa-minus"></span>
                           <label class="remain_bal">Remaining Balance: $<?php echo round(($wallet_balance - $total_amount),2); ?></label>
                        </div>
                        <div class="form-group">
                           <div class="payment_method ">payment to be made <strong>$<?php echo round($total_amount,2); ?></strong></div>
                        </div>
                        <div class="form-group">
                          <button type="submit" name="pay_type" value="wallet">pay now</button>
                        </div>
                      <?php } else { ?>
                          <div class="form-group">
                           <div class="payment_method ">payment to be made <strong>$<?php echo round($total_amount,2); ?></strong></div>
                             <span class="fa fa-minus"></span>
                           <label class="remain_bal">Remaining Balance: $<?php if($total_amount >= $wallet_balance) echo "0"; ?></label>
                        </div>
                        <div class="form-group bal_amount">
                            <div class="payment_method ">money in your wallet <strong>$<?php echo round($wallet_balance,2); ?></strong></div>
                           <span class="fa fa-bars"></span>
                        </div>
                        <div class="form-group pay_option">
                        <div class="payment_method ">select an option to pay balance <strong>$<?php echo $remaining_amount; ?></strong></div>
                        </div>
                      <?php } ?>
                    </div>
                     </div>
                     <div class="payment_card ">
                     <?php if($wallet_balance >= $total_amount) { ?>
                      <div class="blur_card" id="transparent_section"></div>
                     <?php } ?>
                      <!-- Nav tabs -->
                      <div class="row">
                            <div class="col-md-12 col-sm-12">  
                              <ul class="nav nav-tabs clearfix" role="tablist">
                                <li role="presentation" class="active"><a href="#paypal" aria-controls="paypal" role="tab" data-toggle="tab"><i class="fa fa-paypal"></i>
                                  paypal</a></li>
                                <li role="presentation"><a href="#amezon" aria-controls="amezon" role="tab" data-toggle="tab"><i class="fa fa-amazon"></i>
                                  amazon</a></li>
                                <!-- <li role="presentation"><a href="#credit_card" aria-controls="credit_card" role="tab" data-toggle="tab"><i class="fa fa-credit-card"></i>
                                  credit card</a></li> -->
                              </ul>
                            </div>
                              <!-- Tab panes -->
                              <div class="col-md-12 col-sm-12"> 
                                  <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="paypal">
                                       <div class="form-group">
                                          <input type="text" class="form-control total_amount_gateway"  name="total_amount_gateway" readonly value="<?php echo $remaining_amount; ?>"></br>
                                          <input type="text" class="form-control" readonly value="USD">
                                       </div>
                                       <button type="submit" name="pay_type" value="paypal">payment now</button>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="amezon">
                                      <div class="form-group">
                                          <input type="text" class="form-control total_amount_gateway"  name="total_amount_gateway" readonly value="<?php echo $remaining_amount; ?>"></br>
                                          <input type="text" class="form-control" readonly value="USD">
                                       </div>
                                       <button type="submit" name="pay_type" value="amazon">payment now</button>
                                    </div>
                                    <!-- <div role="tabpanel" class="tab-pane" id="credit_card">Credit Cards</div> -->
                                  </div>
                               </div>
                             </div>
                     </div>
                   </form>
               </div>	
              
           </div>
         </div>
         </form>
        </section>

<!-- For Choose Wallet Option Start -->

<script type="text/javascript">
	$(document).ready(function(){
		$('body').on('change','.wallet-btn',function(){
		var wallet_ammount = "<?php echo $wallet_balance; ?>";
			if(this.checked){
        $('.total_amount_gateway').val("<?php echo $remaining_amount; ?>");
        $('#wallet_amount').val("<?php echo $wallet_balance; ?>")
				$('#wallet_amt').text('');
        $('#transparent_section').addClass('blur_card');
				$('.wallet_section').show();
			}else{
        $('.total_amount_gateway').val("<?php echo round($total_amount,2); ?>");
        $('#wallet_amount').val("0")
				$('#wallet_amt').text('($'+wallet_ammount+')');
        $('#transparent_section').removeClass('blur_card');
				$('.wallet_section').hide();
			}
		});
	});
</script>

<!-- For Choose Wallet Option End -->