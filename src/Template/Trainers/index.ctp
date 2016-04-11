<?php include "trainer_dashboard.php"; ?>
     <section class="trainee_dash_body">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="meal_plan_sec">

                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                        	<div class="row">
                            	<div class="col-sm-6">
                                	<div class="panel_block reports">
                                        <div class="panel_block_heading">
                                            <h4>Reports</h4>
                                        </div>
                                        <div class="panel_block_body1">
                                            <div id="chartdiv" style="width: 100%; height:300px;" ></div>
                                        </div>
                            		</div>
                                </div>
                                <div class="col-sm-6 current_plan">
                                	<div class="panel_block reports">
                                        <div class="panel_block_heading">
                                            <h4>Total Earning </h4>
                                        </div>
                                        <div class="panel_block_body1">
                                             <h1>$<?php if(!empty($account)) { echo number_format((float)$account[0]['total_ammount'], 2, '.', '');  } else { echo "0";} ?></h1>
                                        </div>
                                </div>
                                <div class="panel_block reports">
                                        <div class="panel_block_heading">
                                            <h4>Total Sessions </h4>
                                        </div>
                                        <div class="panel_block_body1">
                                             <h1><?php if(!empty($account)) { echo $account[0]['session']; } else { echo "0";} ?></h1>
                                        </div>
                                </div>
                                <div class="panel_block reports">
                                        <div class="panel_block_heading">
                                            <h4>Paid Amount </h4>
                                        </div>
                                        <div class="panel_block_body1">
                                             <h1>$<?php if(!empty($account)) { echo number_format((float)$account[0]['paid_ammount'], 2, '.', ''); } else { echo "0";} ?></h1>
                                        </div>
                                </div>
                                <div class="panel_block reports">
                                        <div class="panel_block_heading">
                                            <h4>Remaining Amount </h4>
                                        </div>
                                        <div class="panel_block_body1">
                                             <h1>$<?php if(!empty($account)) { echo number_format((float)$account[0]['remaining_ammount'], 2, '.', ''); } else { echo "0";} ?></h1>
                                        </div>
                                </div>
                                </div>
                               
                            </div>
                        </div>
                        
                      </div>
                    
                    </div>
                </div>
            </div>
            
            <!-- <div class="row"> -->
            	<!-- <div class="col-sm-8"> -->
                	
                    <div class="row">
                    	<!-- <div class="col-sm-12">
                        	<div class="panel_block reports">
                                        <div class="panel_block_heading">
                                            <h4>All Calls</h4>
                                        </div>
                                        <div class="panel_block_body1">
                                            <div class="table-responsive">
			                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			                                    <thead>
			                                        <tr>
			                                            <th>S.No.</th>
			                                            <th>Trainee</th>
			                                            <th>Trainee Session</th>
			                                            <th>Session Price</th>
			                                            <th>Service Fee</th>
			                                            <th>Time</th>
			                                            <th>Used Sessions</th>
			                                            <th>Amount</th>
			                                            <th>Date</th>
			                                        </tr>
			                                    </thead>
			                                    <tbody>
			                                    <?php $i = 1; 
			                                    foreach($all_calls as $ac) { ?>
			                                    <tr>
			                                    <td><?php echo $i; ?></td>
			                                    <td><?php echo substr($ac['trainee_name'],0,30); ?></td>
			                                    <td><?php echo $ac['session']; ?></td>
			                                    <td>$<?php echo $ac['final_ammount']; ?></td>
			                                    <td>$<?php echo $ac['service_fee']; ?></td>
			                                    <td><?php echo $ac['time']; ?></td>
			                                    <td><?php echo $ac['used_session']; ?></td>
			                                    <td>$<?php echo number_format((float)$ac['total_ammount'], 2, '.', ''); ?></td>
			                                    <td><?php echo date('d F Y', strtotime($ac["added_date"])); ?></td>
			                                    </tr>
			                                    <?php $i++; } ?>
			                                    </tbody>
			                                </table>
			                            </div>

                                        </div>
                            		</div>
                        </div> -->
                    <!-- </div> -->
                <!-- </div> -->
               
            </div>
        </div>
     </section>   
        
    </div>
    <!--Main container sec end-->
    <script src="<?php echo $this->request->webroot; ?>js/amcharts.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
	<!-- amCharts javascript code -->
		<script type="text/javascript">
			AmCharts.makeChart("chartdiv",
				{
					"type": "pie",
					"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
					"labelText":"",
					"innerRadius": 40,
					"labelRadius": 0,
					"colors": [
						"#fbb35d",
						"#ec463e",
						"#44c1bf",
						"#999999",
						"#F8FF01",
						"#B0DE09",
						"#04D215",
						"#0D8ECF",
						"#0D52D1",
						"#2A0CD0",
						"#8A0CCF",
						"#CD0D74",
						"#754DEB",
						"#DDDDDD",
						"#999999",
						"#333333",
						"#000000",
						"#57032A",
						"#CA9726",
						"#990000",
						"#4B0C25"
					],
					"titleField": "category",
					"valueField": "column-1",
					"allLabels": [],
					"balloon": {},
					"legend": {
						"align": "center",
						"bottom": 0,
						"fontSize": 14,
						"left": 0,
						"marginLeft": 0,
						"marginRight":100,
						"markerBorderThickness": 0,
						"markerLabelGap": 2,
						"position": "right",
						"right": 5,
						"textClickEnabled": true,
						"verticalGap": 13
					},
					"titles": [],
					"dataProvider": [
						{
							"category": "Video Calls",
							"column-1": "<?php echo $videocalls; ?>"
						},
						{
							"category": "Voice Calls",
							"column-1": "<?php echo $voicecalls; ?>"
						},
						{
							"category": "Messages",
							"column-1": "<?php  if(!empty($messages)) { echo $messages[0]['total_msg']; } else { echo '0'; } ?>"
						},
						{
							"category": "Notifications",
							"column-1": "<?php echo $total_notifications; ?>"
						}
					]
				}
			);
		</script>
    <script>
		$(".dropdown-menu li a").click(function(e){
		  $(this).parents(".dropdown").find('button').html($(this).text() + ' <span class="wcaret"></span>');
		  //$(this).parents(".dropdown").find('button').val($(this).data('value'));
		  e.preventDefault();
		});
	</script>



