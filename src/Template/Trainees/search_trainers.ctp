<?php include "trainee_dashboard.php"; ?>
<!--Main container sec start--> 
	<section class="search_location_wrap">
       <div class="container">
          <div class="row">
             <div class="col-md-12 col-sm-12">
                 <div class="search_wrap">
                   <form>
                    <div class="row">
                       <div class="col-md-4 col-sm-4">
                         <div class="form-group">
                            <!-- <div class="select_icon"><i class="fa fa-caret-down"></i></div> -->
                         	<input type="text" class="form-control" id="byname" placeholder="let's find a trainer" value="<?php echo (!empty($_GET["name"]))? $_GET["name"] : ""; ?>">		
                         </div>
                       </div>
                       <div class="col-md-6 col-sm-6">
                        <div class="interest_field">
                         <div class="form-group">
                             <!-- <div class="select_icon"><i class="fa fa-caret-down"></i></div> -->
                         	<input type="text" class="form-control" id="byinterest" placeholder="by interest ?" value="<?php echo (!empty($_GET["int"]))? $_GET["int"] : ""; ?>">		
                         </div>
                         <div class="form-group">
                             <!-- <div class="select_icon"><i class="fa fa-caret-down"></i></div> -->
                         	<input type="text" class="form-control" id="bylocation" placeholder="by location ?" value="<?php echo (!empty($_GET["loc"]))? $_GET["loc"] : ""; ?>">		
                         </div>
                       </div>
                       </div>
                       <div class="col-md-2 col-sm-2">
                         <div class="form-group">
                             <button type="button" id="search_trainer">search</button>
                         </div>
                       </div>
                    </div>
                    </form>
                 </div>
             
             </div>
          </div>
       </div>
    </section>
    <section class="search_map_wrap" id="map">
      	<!--<img src="<?php echo $this->request->webroot; ?>images/map_search.jpg">-->
    	<a href="javascript:void(0)" class="hide_map_btn">hide map</a>
    </section>
    <section class="trainer_wrap">
        <div class="trainer_top_row clearfix">
          <ul>
            <li><a href="javascript:void(0)" class="order_by_rate"><i class="fa fa-star"></i> highest rated</a></li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-long-arrow-down"></i> sort by</a>
            <ul class="dropdown-menu">
              <li><a href="javascript:void(0)" class="order_by_price" main="DESC">highest price to lowest price</a></li>
              <li><a href="javascript:void(0)" class="order_by_price" main="ASC">lowest price to highest price</a></li>
            </ul>
            </li>
            <li class="dropdown"><a href="javascript:void(0)"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter"></i> more filters</a>   
	            <ul class="dropdown-menu">
	              <li><a href="javascript:void(0)" class="more_filter" main="male">male</a></li>
	              <li><a href="javascript:void(0)" class="more_filter" main="female">female</a></li>
	            </ul>
            </li>
          </ul>
        </div>
        <div class="container">
         <div class="row" id="load_data">
           <?php if(!empty($trainers)){ ?>	
           <?php foreach($trainers as $t) { ?>
           <div class="col-md-3 col-sm-3">
             <div class="trainer_wrap_box">
             	<div class="heading_payment_main"></div>
                <div class="trainer_top_main">
                  <div class="trainer_top clearfix">
                    <h2>$ <?php if($t['rate_hour']) { echo $t['rate_hour']; } else { echo "0"; } ?></h2>
                    </div>
                     <div class="img_trainer">
                       <a href="<?php echo $this->request->webroot; ?>trainerProfile/<?php echo base64_encode($t['user_id']); ?>"><img src="<?php echo $this->request->webroot; ?>uploads/trainer_profile/<?php echo $t['trainer_image']; ?>" class="img-responsive"></a>
                     </div>
                </div>
                <div class="trainer_bottom">
                   <div class="name_wrap"><a href="<?php echo $this->request->webroot; ?>trainerProfile/<?php echo base64_encode($t['user_id']); ?>"><?php echo ucwords($t['trainer_name']." ".$t['trainer_lname']); ?></a></div>
                   <div class="location_wrap">
                      <ul>
                        <li><span>Location :</span> <?php echo $t['city_name']; ?></li>
                         <li>
                     		<span>skore :</span>
                            <div id="greencircle" data-percent="<?php echo (10 * $t['trainer_rating']); ?>" class="small green"></div>
                        </li>
                      </ul>
                   </div>
                   <div class="describe_wrap">
                      <ul>
                        <p><span>Skills:</span> <?php echo substr($t['trainer_skills'],0,45); ?></p>
                        <p><span>Interests :</span> <?php echo substr($t['interests_hobby'],0,45); ?><span class="show_div"> <?php echo $t['interests_hobby']; ?></span></p>
                        <p><span>Certifications :</span> <?php echo substr($t['certification'],0,45); ?><span class="show_div"> <?php echo $t['certification']; ?></span></p>
                      </ul>
                   </div>
                </div>
             </div>
           </div>
           <?php } } else{ ?>
           <div class="col-md-12 col-sm-12 text-center">
             <div class="no_match">no match found</div>
           </div>
           <?php } ?>
         </div>
         <div class="row">
           <div class="col-md-12 col-sm-12 text-center">
             <div class="no_more_data" style="display:none">no more data</div>
           </div>
         </div>
       </div>
    </section>
    <input type="hidden" id="rate_order" value="<?php echo (!empty($_GET["rate"]))? $_GET["rate"] : "DESC"; ?>">
    <input type="hidden" id="price_order" value="<?php echo (!empty($_GET["price"]))? $_GET["price"] : ""; ?>">
    <input type="hidden" id="filter_more" value="<?php echo (!empty($_GET["mf"]))? $_GET["mf"] : ""; ?>">
    <input type="hidden" id="pagination" value="1">
</div>
<!--Main container sec end-->

<!-- <script src="http://maps.google.com/maps/api/js" type="text/javascript"></script>
 -->
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var surl = "<?php echo $this->request->webroot; ?>trainees/searchTrainers";
		
		/* Load map  */
		gmap();
		
		/* For percent circle */
        $("[id$='circle']").percircle();
        
        $("#clock").percircle({
            perclock: true
        });
        
        $("#custom").percircle({
            text:"custom",
            percent: 27
        });

        /*sort by menu jquery*/
		$('.trainer_top_row ul li').hover(function() {
			$(this).children('.dropdown-menu').stop(true, false, true).slideToggle(300);
		});

		$("body").on("click",".order_by_price", function(){
			var price = $(this).attr("main").trim();
			$("#price_order").val(price);
		});

		$("body").on("click",".more_filter", function(){
			var val = $(this).attr("main");
			$("#filter_more").val(val);
		});


		/* Search Trainer by search button */
		$("body").on("click","#search_trainer", function(){
			var url = [];
			var strg = "";
			var name = $("#byname").val().trim();
			var int = $("#byinterest").val().trim();
			var loc = $("#bylocation").val().trim();

			if(name != "")
			{
				url.push("name="+name);
			}

			if(int != "")
			{
				url.push("int="+int);
			}

			if(loc != "")
			{
				url.push("loc="+loc);
			}

			if(url.length != 0)
			{
				strg = "?"+url.join("&");	
			}
		
          	var newurl = surl+strg;
          	newurl = encodeURI(newurl);
          	window.location.href = newurl;
		});

		/* Search by price and more filter */
		$("body").on("click",".order_by_price,.more_filter", function(){
			var url = [];
			var strg = "";
			var name = $("#byname").val().trim();
			var int = $("#byinterest").val().trim();
			var loc = $("#bylocation").val().trim();
			var rate = $("#rate_order").val().trim();
			var price = $("#price_order").val();
			var mf = $("#filter_more").val();
			if(name != "")
			{
				url.push("name="+name);
			}

			if(int != "")
			{
				url.push("int="+int);
			}

			if(loc != "")
			{
				url.push("loc="+loc);
			}

			if(price != "")
			{
				url.push("price="+price);
			}

			if(mf != "")
			{
				url.push("mf="+mf);
			}
			
			url.push("rate="+rate);

			if(url.length != 0)
			{
				strg = "?"+url.join("&");	
			}
          	var newurl = surl+strg;
          	newurl = encodeURI(newurl);
          	window.location.href = newurl;
		});

		/* Search by rate  */
		$("body").on("click",".order_by_rate", function(){
			var url = [];
			var strg = "";
			var name = $("#byname").val().trim();
			var int = $("#byinterest").val().trim();
			var loc = $("#bylocation").val().trim();
			var rate = $("#rate_order").val().trim();
			var price = $("#price_order").val();
			var mf = $("#filter_more").val();
			rate = (rate == "DESC")? "ASC" : "DESC";

			if(name != "")
			{
				url.push("name="+name);
			}

			if(int != "")
			{
				url.push("int="+int);
			}

			if(loc != "")
			{
				url.push("loc="+loc);
			}

			if(price != "")
			{
				url.push("price="+price);
			}

			if(mf != "")
			{
				url.push("mf="+mf);
			}
			
			url.push("rate="+rate);

			if(url.length != 0)
			{
				strg = "?"+url.join("&");	
			}
          	var newurl = surl+strg;
          	newurl = encodeURI(newurl);
          	window.location.href = newurl;
		});

		/* Load more result by scrolling  */
		$(window).scroll(function() {
		    if($(window).scrollTop() == $(document).height() - $(window).height()) {
		    	var data = [];
				var strg = "";
				var name = $("#byname").val().trim();
				var int = $("#byinterest").val().trim();
				var loc = $("#bylocation").val().trim();
				var rate = $("#rate_order").val().trim();
				var price = $("#price_order").val();
				var mf = $("#filter_more").val();
				var off = $("#pagination").val();
				var newoff = parseInt(off) + 1;
				$("#pagination").val(newoff);

				if(name != "")
				{
					data.push("name="+name);
				}

				if(int != "")
				{
					data.push("int="+int);
				}

				if(loc != "")
				{
					data.push("loc="+loc);
				}

				if(price != "")
				{
					data.push("price="+price);
				}

				if(mf != "")
				{
					data.push("mf="+mf);
				}
				
				data.push("rate="+rate);
				data.push("off="+off);
				strg = data.join("&");
				var newurl = surl+"?"+strg;

		    	$.ajax({
	    			url:newurl,
	    			type:"get",
	    			dataType:"json",
	    			success: function(data)
	    			{
	    				if(data.trainers.length > 0)
	    				{
	    					$.each(data.trainers, function(i,t){
	    						var list = "";
	    						list += '<div class="col-md-3 col-sm-3">';
						        list += '     <div class="trainer_wrap_box">';
						        list += '     	<div class="heading_payment_main"></div>';
						        list += '        <div class="trainer_top_main">';
						        list += '          <div class="trainer_top clearfix">';
						        list += '            <h2>$ '+ t['rate_hour'] +'</h2>';
						        list += '            </div>';
						        list += '             <div class="img_trainer">';
						        list += '               <a href="<?php echo $this->request->webroot; ?>trainerProfile/'+btoa(t['user_id'])+'"><img src="<?php echo $this->request->webroot; ?>uploads/trainer_profile/'+t['trainer_image']+'" class="img-responsive"></a>';
						        list += '             </div>';
						        list += '        </div>';
						        list += '        <div class="trainer_bottom">';
						        list += '           <div class="name_wrap"><a href="<?php echo $this->request->webroot; ?>trainerProfile/'+btoa(t['user_id'])+'">'+t["trainer_name"].toUpperCase()+" "+t['trainer_lname'].toUpperCase()+'</a></div>';
						        list += '           <div class="location_wrap">';
						        list += '              <ul>';
						        list += '                <li><span>Location :</span>'+t['city_name']+'</li>';
						        list += '                 <li>';
						        list += '             		<span>skore :</span>';
						        list += '                    <div id="greencirclenew" data-percent="'+(10 * t['trainer_rating'])+'" class="small green"></div>';
						        list += '                </li>';
						        list += '              </ul>';
						        list += '           </div>';
						        list += '           <div class="describe_wrap">';
						        list += '              <ul>';
						        list += '                <p><span>Skills:</span>'+t['trainer_skills'].substr(0,45)+'</p>';
						        list += '                <p><span>Interests :</span>'+t['interests_hobby'].substr(0,45)+'<span class="show_div">'+t['interests_hobby']+'</span></p>';
						        list += '                <p><span>Certifications :</span>'+t['certification'].substr(0,45)+'<span class="show_div">'+t['certification']+'</span></p>';
						        list += '              </ul>';
						        list += '           </div>';
						        list += '        </div>';
						        list += '     </div>';
					           	list += '</div>';
	    						$("#load_data").append(list);
	    						$("[id$='circlenew']").percircle();
	    					});
	    				}else
	    				{
	    					var off1 = $("#pagination").val();
							var newoff1 = parseInt(off1) - 1;
							$("#pagination").val(newoff1);
							$(".no_more_data").show();
	    				}
	    			}
		    	});
		    }
		});
		
		/* Get lat lng of user start */
		function GEOprocess(position) {
			// update the page to show we have the lat and long and explain what we do next
		  	//document.getElementById('geo').innerHTML = 'Latitude: ' + position.coords.latitude + ' Longitude: ' + position.coords.longitude;
			// now we send this data to the php script behind the scenes with the GEOajax function
			// alert(position.coords.latitude+ "," + position.coords.longitude);
		}

		function GEOdeclined(error) {
		  console.log('Error: ' + error.message);
		  //document.getElementById('geo').innerHTML = 'Error: ' + error.message;
		}

		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(GEOprocess, GEOdeclined);
		}else{
			console.log('Your browser sucks. Upgrade it.');
		 // document.getElementById('geo').innerHTML = 'Your browser sucks. Upgrade it.';
		}

		/** Get lat lng of user end **/
    });
	
	/* Map function */
	function gmap(){
		var locations = [["test","64.2008413","-149.4936733","jay"]];
	    var map = new google.maps.Map(document.getElementById('map'), {
	      zoom: 13,
	      center: new google.maps.LatLng(64.8457831,-147.8296627),
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    });

	    var infowindow = new google.maps.InfoWindow();

	    var marker, i;
	    var markers = [];
	    for (i = 0; i < locations.length; i++) {  
	      marker = new google.maps.Marker({
	        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
	        map: map
	      });
	      
	      google.maps.event.addListener(marker, 'click', (function(marker, i) {
	        return function() {
	          infowindow.setContent(locations[i][0]);
	          infowindow.open(map, marker);
	        }
	      })(marker, i));
	      markers.push(marker);
	    }
	    var mc = new MarkerClusterer(map, markers);
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		
	});
</script>