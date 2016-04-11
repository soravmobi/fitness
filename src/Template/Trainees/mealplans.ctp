
<?php include "trainee_dashboard.php"; ?>

     <section class="trainee_dash_body">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="meal_plan_sec">
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                        	<div class="meal_plan_heading">
                            	<div class="row">
                                	<div class="col-sm-4 mph_left">
                                    	<h2>Meal Plans</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="meal_plan_body clearfix">
                                <div class="mp_days" id="view_meal_plans">
                                <div class="table_meal">
                                        <table class="table table-bordered" id="planner_table">
                                      <thead>
                                        <tr>
                                            <th></th>
                                            <th>sunday</th>
                                            <th>monday</th>
                                            <th>tuesday</th>
                                            <th>wednesday</th>
                                            <th>Thursday </th>
                                            <th>Friday </th>
                                            <th>Saturday </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 1;
                                      foreach($meal_plans_arr as $ma){ ?>
                                        <tr main="<?php echo $ma['trainee_id']; ?>" id="<?php echo $ma['row_id']; ?>">
                                            <td main="meal_plan"><?php echo $ma['meal_plan']; ?></td>
                                            <td main="sunday"><?php echo $ma['sunday']; ?></td>
                                            <td main="monday"><?php echo $ma['monday']; ?></td>
                                            <td main="tuesday"><?php echo $ma['tuesday']; ?></td>
                                            <td main="wednesday"><?php echo $ma['wednesday']; ?></td>
                                            <td main="thursday"><?php echo $ma['thursday']; ?></td>
                                            <td main="friday"><?php echo $ma['friday']; ?></td>
                                            <td main="saturday"><?php echo $ma['saturday']; ?></td>
                                        </tr>
                                    <?php $count++;  } ?>
                                    </tbody>
                                </table>
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



