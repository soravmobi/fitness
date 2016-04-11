
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
                                    	<h2>Grocery List</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="meal_plan_body clearfix">
                                <div class="mp_days" id="view_meal_plans">
                               <div class="table_meal shopping_list">
                                        <table class="table table-bordered" id="shopping_table">
                                      <thead>
                                        <tr>
                                            <th></th>
                                            <th>item</th>
                                            <th>qty</th>
                                            <th>store</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 1;
                                      foreach($grocery_arr as $sa){ ?>
                                        <tr main="<?php echo $sa['trainee_id']; ?>" id="<?php echo $sa['row_id']; ?>">
                                            <td><div class="chk_box"><input type="checkbox" value="none" name="check<?php echo $sa['row_id']; ?>" id="checkb<?php echo $sa['row_id']; ?>" checked ><label for="checkb<?php echo $sa['row_id']; ?>"></label></div></td>
                                            <td main="item"><?php echo $sa['item']; ?></td>
                                            <td main="quantity"><?php echo $sa['quantity']; ?></td>
                                            <td main="store"><?php echo $sa['store']; ?></td>
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



