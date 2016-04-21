    <!--Main container sec start-->
    <div class="main_container">
    <!--Banner sec start-->
    	<section class="banner_sec">
        	<div id="main_carousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="9000">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#main_carousel" data-slide-to="0" class="active"></li>
			<li data-target="#main_carousel" data-slide-to="1"></li>
			<li data-target="#main_carousel" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
		
			<!-- First slide -->
			<div class="item active banner_bg1" data-type="background" data-speed="8">
				<div class="container">
					<div class="carousel-caption">
					<h1 data-animation="animated fadeInDown">
						<img src="<?php echo $this->request->webroot; ?>images/logo1.png" class="img-responsive">
					</h1>
					<h2 data-animation="animated fadeInDown">
						Welcome to the Future of Fitness
					</h2>
                    <p data-animation="animated fadeInDown">
                    Virtual TrainR now allows people to connect and train with certified 
fitness specialists. </br>Anywhere, anytime.
                    </p>
					<button class="btn carusel_btn" id="learn_more" data-animation="animated fadeInDown">Learn More</button>
                    <!-- <a href="<?php echo $this->request->webroot; ?>learnmore" class="btn carusel_btn" data-animation="animated fadeInDown">Learn More</a> -->
				</div>
                </div>
			</div> <!-- /.item -->
			
			<!-- Second slide -->
			<div class="item banner_bg2" data-type="background" data-speed="8">
            	<div class="container">
					<div class="carousel-caption">
					<h1 data-animation="animated fadeInDown">
						<img src="<?php echo $this->request->webroot; ?>images/logo1.png" class="img-responsive">
					</h1>
					<h2 data-animation="animated fadeInDown">
						No excuses! Get ready to achieve your goals. 
					</h2>
                    <p data-animation="animated fadeInDown">
                    Sign up and train with a local expert today.
                    </p>
					<button class="btn carusel_btn" data-target="#signup_Modal" data-toggle="modal" data-animation="animated fadeInDown">start now</button>
				</div>
                </div>
			</div><!-- /.item -->
			
			<!-- Third slide -->
			<div class="item banner_bg3" data-type="background" data-speed="8">
            	<div class="container">
					<div class="carousel-caption">
					<h1 data-animation="animated fadeInDown">
						<img src="<?php echo $this->request->webroot; ?>images/logo1.png" class="img-responsive">
					</h1>
					<h2 data-animation="animated fadeInDown">
						Got what it takes? Get paid to train.
					</h2>
                    <p data-animation="animated fadeInDown">
                    Become a partner in our growing fitness community and train people today. 
                    </p>
					<button class="btn carusel_btn" id="become_trainr" data-animation="animated fadeInDown">Become a Trainer</button>
				</div>
                </div>
			</div><!-- /.item -->
		
		</div><!-- /.carousel-inner -->
	</div>
        </section>
    <!--Banner sec end--> 
    
     <!--Latest News sec start-->
        <section class="latest_news">
        	<div class="container">
            	<div class="row">
                	<div class="col-sm-12">
                    	<div class="sec_heading ln_heading">
                        	<h1>How <span>it</span> works</h1>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="row ln_body">
                    <div class="col-sm-4">
                    	<div class="lnews_block">
                        	<div class="lnb_top">
                            	<img src="<?php echo $this->request->webroot; ?>images/news_img1.jpg" alt="img" class="img-responsive">
                                <a href="javascript:void(0);" class="man"><i class="flaticon1-man316"></i></a>
                            </div>
                            <div class="lnb_bot">
                            	<h3>Discover</h3>
                                <p>Find a certified personal trainer that will guide you to 
achieve your fitness goals. </p>
             <div class="step_btn_box"><a href="javascript:void(0);" class="step_btn">step 1</a></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                    	<div class="lnews_block">
                        	<div class="lnb_top">
                            	<img src="<?php echo $this->request->webroot; ?>images/news_img2.jpg" alt="img" class="img-responsive">
                                <a href="javascript:void(0);" class="cloud"><i class="flaticon1-cloud229"></i> </a>
                            </div>
                            <div class="lnb_bot">
                            	<h3>Connect</h3>
                                <p>Interact with your selected trainer, book a session 
and prepare to discover your potential.  </p>
<div class="step_btn_box"><a href="javascript:void(0);" class="step_btn">step 2</a></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                    	<div class="lnews_block">
                        	<div class="lnb_top">
                            	<img src="<?php echo $this->request->webroot; ?>images/news_img3.jpg" alt="img" class="img-responsive">
                                <a href="javascript:void(0);" class="goa"><i class="flaticon1-goal5"></i> </a>
                            </div>
                            <div class="lnb_bot">
                            	<h3>achieve</h3>
                                <p>Train with your certified personal trainer at a local gym, 
at home, or anywhere using our one-to-one 
video chat.</p>              <div class="step_btn_box"><a href="javascript:void(0);" class="step_btn">step 3</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--Latest News sec end --> 
    
    <!--How it works sec start-->   
        <section class="how_it_works">
        	<div class="container">
            	<div class="row">
                	<div class="col-sm-7">
                    	<div class="hiw_left">
                        	<div class="hiw_left_heading sec_heading">
                            	<h1>Become your Own Boss</h1>
                            </div>
                            <div class="hiw_left_body sec_body">
                            	<p>Get paid what you deserve. Train clients in our growing fitness community. </br> Sign up with Virtual TrainR today and begin your independent personal training career.  </p>
                                
                                <a href="<?php echo $this->request->webroot; ?>becometrainer" title="Become a Trainer" class="trainer1">Become a Trainer</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                    	<div class="hiw_right">
                        	<img src="<?php echo $this->request->webroot; ?>images/how_it_works.png" alt="img" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--How it works sec end--> 
    
    <!--Our services sec start-->       
        <section class="our_services">
        	<div class="container">
            	<div class="row">
                	<div class="col-sm-12">
                    	<div class="searvices_heading sec_heading">
                        	<h1>Variety of <span>Activities</span> to choose from</h1>
                            
                            <p>
                           Spice up your fitness. We offer various types of fitness activities for your satisfaction. Sign up with Virtual TrainR today and discover our growing fitness community. Fitness revolutionized through Virtual TrainR.
                            </p>
                            <h2>Yours To Discover</h2>
                        </div>
                    </div>
                    <div class="col-sm-12">
                    	<div class="services_body">
                        	<ul class="clearfix">
                            	<li>
                                <div class="ser_img"><img src="<?php echo $this->request->webroot; ?>images/services_img1.jpg" alt="img" class="img-circle image_hover">
                                </div>
                                <div class="ser_txt">
                                	<h3>Cardio</h3>
                                    <p>Enjoy a variety of classes that provide an effective workout to build cardiovascular endurance.</p>
                                </div>
                                </li>
                                
                                <li>
                                <div class="ser_img"><img src="<?php echo $this->request->webroot; ?>images/services_img2.jpg" alt="img" class="img-circle image_hover">
                                </div>
                                <div class="ser_txt">
                                	<h3>Boot Camp </h3>
                                    <p>Enjoy a variety of classes that provide an effective workout to build cardiovascular endurance.</p>
                                </div>
                                </li>
                                
                                <li>
                                <div class="ser_img"><img src="<?php echo $this->request->webroot; ?>images/services_img3.jpg" alt="img" class="img-circle image_hover">
                                </div>
                                <div class="ser_txt">
                                	<h3>Kick Boxing </h3>
                                    <p>Enjoy a variety of classes that provide an effective workout to build cardiovascular endurance.</p>
                                </div>
                                </li>
                                
                                <!--<li>
                                <div class="ser_img"><img src="images/services_img4.jpg" alt="img" class="img-circle image_hover">
                                </div>
                                <div class="ser_txt">
                                	<h3>Cycling Classes</h3>
                                    <p>Enjoy a variety of classes that provide an effective workout to build cardiovascular endurance.</p>
                                </div>
                                </li>-->
                                
                                <li>
                                <div class="ser_img"><img src="<?php echo $this->request->webroot; ?>images/services_img5.jpg" alt="img" class="img-circle image_hover">
                                </div>
                                <div class="ser_txt">
                                	<h3>Mind &amp; Body </h3>
                                    <p>Enjoy a variety of classes that provide an effective workout to build cardiovascular endurance.</p>
                                </div>
                                </li>
                                
                                <li>
                                <div class="ser_img"><img src="<?php echo $this->request->webroot; ?>images/services_img6.jpg" alt="img" class=" img-circle image_hover">
                                </div>
                                <div class="ser_txt">
                                	<h3>Active Aging </h3>
                                    <p>Enjoy a variety of classes that provide an effective workout to build cardiovascular endurance.</p>
                                </div>
                                </li>
                                
                                <!--<li>
                                <div class="ser_img"><img src="images/services_img7.jpg" alt="img" class="img-circle image_hover">
                                </div>
                                <div class="ser_txt">
                                	<h3>Strength Classes</h3>
                                    <p>Enjoy a variety of classes that provide an effective workout to build cardiovascular endurance.</p>
                                </div>
                                </li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--Our services sec end-->
    
    <!--Mobile App sec start-->
        <section class="mobileapp_sec">
        	<div class="container">
            	<div class="row">
                  <div class="col-sm-3">
                    <div class="ms_left">
                        	<img src="<?php echo $this->request->webroot; ?>images/app_img1.png" alt="img" class="img-responsive">
                        </div>
                  </div>
                	<div class="col-sm-6">
                    	<div class="ms_center">
                            <div class="ms_heading sec_heading">
                                <h2><span>Virtual</span> Train<span>R</span> App</h2>
                            </div>
                            <div class="ms_body sec_body">
                                <p>All Trainers On Your Mobile</p>
                                <h3>COMING SOON</h3>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    	<div class="ms_right">
                        	<img src="<?php echo $this->request->webroot; ?>images/app_img.png" alt="img" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--Mobile App sec end-->
     
    <!--Testimonial sec start-->   
        <section class="testimonial_sec">
        	<div class="tetimonialsec_inner">
        		<div class="container">
                <div class="testimonial_carousel">
                    <div id="testi_carousel" class="carousel slide" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                              	<div class="testimonial_block clearfix">
                                	<div class="testi_img">
                                    	<img src="<?php echo $this->request->webroot; ?>images/services_img1.jpg" alt="img" class="img-responsive">
                                    </div>
                                    <div class="testi_txt">
                                    	<p>Because of Virtual TrainR I was able to stay connected with my personal trainer through out the program. The 1-1 video chat allowed me to stay in touch even when I was out of town.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item">
                              	<div class="testimonial_block clearfix">
                                	<div class="testi_img">
                                    	<img src="<?php echo $this->request->webroot; ?>images/services_img2.jpg" alt="img" class="img-responsive">
                                    </div>
                                    <div class="testi_txt">
                                    	<p>Because of Virtual TrainR I was able to stay connected with my personal trainer through out the program. The 1-1 video chat allowed me to stay in touch even when I was out of town.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item">
                              	<div class="testimonial_block clearfix">
                                	<div class="testi_img">
                                    	<img src="<?php echo $this->request->webroot; ?>images/services_img3.jpg" alt="img" class="img-responsive">
                                    </div>
                                    <div class="testi_txt">
                                    	<p>Because of Virtual TrainR I was able to stay connected with my personal trainer through out the program. The 1-1 video chat allowed me to stay in touch even when I was out of town.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="item">
                              	<div class="testimonial_block clearfix">
                                	<div class="testi_img">
                                    	<img src="<?php echo $this->request->webroot; ?>images/services_img1.jpg" alt="img" class="img-responsive">
                                    </div>
                                    <div class="testi_txt">
                                    	<p>Because of Virtual TrainR I was able to stay connected with my personal trainer through out the program. The 1-1 video chat allowed me to stay in touch even when I was out of town.</p>
                                    </div>
                                </div>
                            </div>
                         </div>
    
                    </div>
                </div>
            </div>
            </div>
        </section>
  
     <!--Testimonial sec end-->   
    <!--Price sec start-->
        <!-- <section class="price_sec">
        	<div class="container">
              <div class="get">
               <div class="row">
            		<div class="col-sm-12">
                        <div class="ps_heading sec_heading get_head">
                        	<h1>Let’s <span>Get</span> Started</h1>
                            <h5>Training Packages - All Plans</h5>
                            <p>Choose a personal training package today. We recommend that you purchase a single session for a trial-run with a trainer of your choice. Once you’ve found a trainer that suits your needs you can purchase larger packages at a premium rate.  Every package includes workouts, nutrition information, supplement advice and much more. Whatever your goal, we’ve got you covered..</p>
                        </div>
                	</div>
                </div>
               </div>
            	<div class="row">
            		<div class="col-sm-12">
                        <div class="ps_heading sec_heading">
                        	<h1>Bronze plan</h1>
                            <p>The bronze plan has everything to get you started with a fitness expert today. Whether your goals include weight loss, strength training or staying in shape,  we can find you a certified trainer to help you along the journey.</p>
                        </div>
                	</div>
                </div>
                
                <div class="row ps_body">
                <?php 
                foreach($all_sessions as $as) { ?>
                    <div class="col-sm-3">
                        <div class="price_block">
                            <div class="pb_heading gray_grad">
                                <h2><?php echo $as['ps_name']; ?> <?php echo ($as['ps_name'] == 1)? " Session" : " Sessions"; ?></h2>
                            </div>
                            <div class="pb_body">
                                <div class="session_price">
                                    <span>$<?php echo $as['ps_price']; ?></span>
                                </div>
                                <div class="session_order">
                                    <a href="<?php echo $this->request->webroot; ?>plans"  title="Click Here To Order">Order Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </section> -->
    <!--Price sec end-->
    
    <!--Contact Sec start-->    
        <section class="contact_sec">
        <div id="map_display"></div>
            <div class="container">
         
                <div class="row">
                    <div class="col-sm-12">
                        <div class="contact_block">
                            <div class="cb_heading">
                                <h1>Contact Us Now</h1>
                            </div>
                            <div class="cb_body">
                                <form id="contactForm" method="post" action="<?php echo $this->request->webroot; ?>docontact">
                                    <div class="cb_row clearfix">
                                     <div class="form-group">
                                        <select class="form-control" name="type">
                                          <option value="customer">Customer Service</option>
                                          <option value="business">Business</option>
                                          <option value="sales">Sales</option>
                                        </select>
                                      </div>
                                        <div class="form-group">
                                            <input type="text"  name="name" class="form-control"  placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="text"  name="subject" class="form-control"  placeholder="Subject">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" id="contact_email"  name="email" class="form-control"  placeholder="Email ">
                                        </div>
                                     </div>
                                    <div class="form-group">
                                        <textarea class="form-control"  name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="button" value="" class="con_submit" title="Click Here To Send">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--Contact Sec end-->
    </div>
    <!--Main container sec end-->

    <script type="text/javascript">
        $(document).ready(function(){
            $('body').on('click','#learn_more',function(){
                window.location.href="<?php echo $this->request->webroot; ?>learnmore";
            });
             $('body').on('click','#become_trainr',function(){
                window.location.href="<?php echo $this->request->webroot; ?>becometrainer";
            });
        });
    </script>

    <!-- Contact Form Start -->

<script type="text/javascript">
  $(document).ready(function(){
    $('body').on('click','.con_submit',function(e){
      $('#contactForm input[type=text],#contactForm select, #contactForm input[type=email], #contactForm textarea').each(function() {
        var val = $(this).val();
        var email = $('#contact_email').val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(val == "")
            {
               e.preventDefault();
               $(this).addClass('required-error');
            }
        if(!filter.test(email))
            {
               e.preventDefault();
               $('#contact_email').addClass('required-error');
            }
        if(val != "" && filter.test(email))
            {
               $(this).removeClass('required-error');
               $('#contactForm').submit();
            }
        });
    });
  });
</script>

<!-- Contact Form End -->
