<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\Network\Email\Email;
use mPDF;

class TrainersController extends AppController
{
	public function beforeFilter(Event $event)
    {
    	  $this->blockIP();
        $this->checkSession();
        parent::beforeFilter($event);
        $this->loadComponent('Auth'); 
        $this->Auth->allow(['addTrainer','downloadDocument']);
        $this->data = $this->Custom->getSessionData();
        if(!empty($this->data)){
        $this->total_notifications = $this->Notifications->find()->where(['noti_receiver_id' => $this->data['id'],'noti_status' => 0])->count();
        $noti_data = $this->getNotifications();
        $messages = $this->getChatMessages();
        $this->set('messages', $messages);
        $this->set('notifications', $this->total_notifications);
        $this->set('noti_data', $noti_data);
        }else{
          $this->set('messages', array());
          $this->set('notifications', array());
          $this->set('noti_data', array());
        }
    }

  public function getChatMessages()
  {
    $messages = $this->conn->execute("SELECT * FROM `chating` AS `c` INNER JOIN `trainees` AS `t` ON `c`.`chat_sender_id` = `t`.`user_id` WHERE `c`.`chat_reciever_id` = ".$this->data['id']." ORDER BY `c`.`chat_id` DESC LIMIT 10")->fetchAll('assoc');
    return $messages;
  }

  public function index()
	{
		$profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
    $total_wallet_ammount = $this->Total_wallet_ammount->find()->where(['user_id' => $this->data['id']])->toArray();
    $messages = $this->getChatMessages();
    $pending_appointments  = $this->conn->execute('SELECT *,`a`.`id` AS `app_id` FROM `appointments` AS `a` INNER JOIN `trainees` AS `t` ON `a`.`trainee_id` = `t`.`user_id` WHERE `a`.`trainer_id` = '.$this->data['id'].' AND `a`.`trainer_status` = 0 AND `a`.`trainee_status` = 0 AND `a`.`created_date` >= DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY `a`.`id` DESC')->fetchAll('assoc');
    $upcoming_appointments = $this->conn->execute('SELECT *,`a`.`id` AS `app_id` FROM `appointments` AS `a` INNER JOIN `trainees` AS `t` ON `a`.`trainee_id` = `t`.`user_id` WHERE `a`.`trainer_id` = '.$this->data['id'].' AND `a`.`trainer_status` = 1 AND `a`.`trainee_status` = 1 AND `a`.`created_date` >= CURDATE() ORDER BY `a`.`id` DESC')->fetchAll('assoc');
     if(!empty($upcoming_appointments)){
        foreach($upcoming_appointments as $ua){
          $sessionArr = unserialize($ua['session_data']);
          for ($i=1; $i <= count($sessionArr); $i++) { 
              $upcomingArr['trainee_name'][] = $ua['trainee_name']." ".$ua['trainee_lname'];
              $upcomingArr['user_id'][]      = $ua['user_id'];
              $upcomingArr['trainee_image'][]= $ua['trainee_image'];
              $upcomingArr['location_name'][]= $sessionArr[$i]['location_address'];
              $upcomingArr['appo_date'][]    = $sessionArr[$i]['modified_dates'];
              $upcomingArr['appo_time'][]    = $sessionArr[$i]['modified_times'];
          }
        }        
     }
     else{
          $upcomingArr = array();
     }    
    $this->set("from_id",$this->data['id']);
    $this->set('messages', $messages);
    $this->set('upcomingArr', $upcomingArr);
    $this->set('pending_appointments', $pending_appointments);
    $this->set('total_wallet_ammount', $total_wallet_ammount);
    $this->set('profile_details', $profile_details);
	}

	public function profile()
	{
		$data = $this->Custom->getSessionData();
		$gallery_img = $this->Profile_images_videos->find()->where(['piv_user_id' => $data['id'], 'piv_attachement_type' => 'image'])->order(['piv_id' => 'DESC'])->toArray();
		$profile_details = $this->Trainers->find()->where(['user_id' => $data['id']])->toArray();
        $rate_plans = $this->Trainer_ratemaster->find()->where(['trainer_id' => $data['id']])->toArray();
        $custom_packages = $this->Trainer_packagemaster->find()->where(['trainer_id' => $data['id']])->toArray();
		$quotes = $this->Latest_things->find()->where(['lt_type' => 'Quotes', 'lt_user_id' => $data['id']])->order(['id' => 'DESC'])->toArray();
		$gallery_videos = $this->Profile_images_videos->find()->where(['piv_user_id' => $data['id'], 'piv_attachement_type' => 'video'])->order(['piv_id' => 'DESC'])->toArray();
        $certificates = $this->Documents->find()->where(['trainer_id' => $this->data['id'],'document_type' => 'Certification'])->order(['id' => 'DESC'])->toArray();
        $resume = $this->Documents->find()->where(['trainer_id' => $this->data['id'],'document_type' => 'Resume'])->order(['id' => 'DESC'])->toArray();
        $feedback = $this->conn->execute('SELECT * FROM `ratings` As r inner join trainees as t ON t.user_id = r.rating_trainee_id WHERE r.rating_trainer_id = '. $this->data['id'] .' ORDER BY r.id DESC')->fetchAll('assoc');
        $this->set('feedback',$feedback);
        $this->set('resume',$resume);
        $this->set('certificates',$certificates);
        $this->set('quotes',$quotes);
		$this->set('rate_plans', $rate_plans);
        $this->set('custom_packages', $custom_packages);
        $this->set('profile_details', $profile_details);
		$this->set('gallery_img', $gallery_img);
		$this->set('gallery_videos', $gallery_videos);
		$this->render('/Trainers/trainer_profile');
	}

	public function addTrainer()
	{
		if($this->request->is('ajax'))
     	{
         $feedback = $this->conn->execute('SELECT * FROM `users` WHERE `username` = "'.$_POST['trainer_email'].'" ORDER BY id DESC')->fetchAll('assoc');   
    if(empty($feedback)){
            $trainer_email = $_POST['trainer_email'];
            $admin_email = "business@virtualtrainr.com";
     		$data = array(
    				'username' => $_POST['trainer_email'],
    				'password' => $_POST['trainer_password'],
    				'display_name' => $_POST['trainer_displayName'],
    				'user_type' => 'trainer',
    				'user_status' => 0,
    				'created' => Time::now(),
    			);
    		$article = $this->users->newEntity($data);
    		$result1 = $this->users->save($article);
    		$user_id = $result1->id;

            $trainer_data = $this->request->data;
            $trainer_data['trainer_image'] = 'default.png';
            $trainer_data['trainer_status'] = 0;
            $trainer_data['trainer_added_date'] = date("Y-m-d H:i:s");
            $address = $this->Custom->getCityName($trainer_data['trainer_city']).' '.$this->Custom->getStateName($trainer_data['trainer_state']).' '.$this->Custom->getCountryName($trainer_data['trainer_country']);
            $loc = $this->Custom->getlatlng($address);
    		
            $trainer_data['lat'] = $loc["latitude"];
            $trainer_data['lng'] = $loc["longitude"];
            
            $user = $this->Trainers->newEntity();
        		$user = $this->Trainers->patchEntity($user, $trainer_data);
        		$user['user_id'] = $user_id;
        		$result = $this->Trainers->save($user);
        		$lid = $result->id; // get last insert id

            $resumeArr = array(
                'document_name' => '',
                'document_file' => $this->Custom->fileUploading('resume_file','documents'),
                'document_type' => 'resume',
                'trainer_id'    =>  $user_id,
                'added_date'    => Time::now()
                );

            $user = $this->Documents->newEntity();
            $user = $this->Documents->patchEntity($user, $resumeArr);
            $result = $this->Documents->save($user);

            $certificateArr = array(
                'document_name' => $_POST['trainer_certificate_name'],
                'document_file' => $this->Custom->fileUploading('certificate_file','documents'),
                'document_type' => 'certifications',
                'trainer_id'    =>  $user_id,
                'added_date'    => Time::now()
                );

            $user = $this->Documents->newEntity();
            $user = $this->Documents->patchEntity($user, $certificateArr);
            $result = $this->Documents->save($user);

            $email_message = "";
            $email_message .= "<html>";
            $email_message .= "<body>";
            $email_message .= "<center>";
            $email_message .= "<img style='width:200px' src='https://" . env('SERVER_NAME')."/img/belibit_tv_logo.png' class='img-responsive'></br></br></center>";
            $email_message .= "<strong>Hello ".$_POST['trainer_name']." ".$_POST['trainer_lname'].",</strong></br></br>";
            $email_message .= "<p>Welcome to Virtual TrainR! We thank you for your interest in becoming a part of our community. Your application has been received and will be reviewed shortly. Our recruitment team will contact you within 48 hours to get you started. </p>" ;
            $email_message .= "<p>For questions and support please email <a href='mailto:support@virtualtrainr.com'>support@virtualtrainr.com</a> and a member of our support team will be in touch with you right away.We appreciate your patience.  </p>" ;
            $email_message .= "<p>Welcome to the Future of Fitness. </p>";
            $email_message .= "</body>";
            $email_message .= "</html>";


            $email = new Email('default');
            $email->emailFormat('html')
                  ->to($trainer_email)
                  ->from($admin_email)
                  ->subject('Virtual TrainR Signup')
                  ->send($email_message);

            $admin_email_message = "";
            $admin_email_message .= "<html>";
            $admin_email_message .= "<body>";
            $admin_email_message .= "<center>";
            $admin_email_message .= "<img style='width:200px' src='https://" . env('SERVER_NAME')."/img/belibit_tv_logo.png' class='img-responsive'></br></br></center>";
            $admin_email_message .= "<strong>Hello,</strong></br></br>";
            $admin_email_message .= "<p> New Trainer has registered on Virtual TrainR</p>" ;
            $admin_email_message .= "<p>Link: <a href='https://" . env('SERVER_NAME')."/trainerProfile/".base64_encode($user_id)."' target='_blank'> Click here  </a> </p>";
            $admin_email_message .= "</body>";
            $admin_email_message .= "</html>";

            $email1 = new Email('default');
            $email1->emailFormat('html')
                  ->to('business@theyoutag.com')
                  ->from($admin_email)
                  ->subject('Trainer Signup')
                  ->send($admin_email_message);

    		$this->set('message', $lid);
    		$this->set('_serialize',array('message'));
    		$this->response->statusCode(200);
        }else{
          $msg ='1';
          $this->set('message', $msg);
          $this->set('_serialize',array('message'));
          $this->response->statusCode(200);
      }
		}
	}

    public function updateNotification()
    {
      if($this->request->is('ajax'))
        {
           $noti_id = (int) base64_decode($this->request->data['noti_id']);
           $this->notifications->query()->update()->set(['noti_status' => 1])->where(['id' => $noti_id])->execute();
           $this->set('message', 'success');
           $this->set('_serialize',array('message','id'));
           $this->response->statusCode(200);
        }
    }

    public function inbox()
    {
      $files = $this->conn->execute(' SELECT * FROM `files` WHERE from_id = '.$this->data['id'].' OR to_id = '.$this->data['id'].' ORDER BY id DESC ')->fetchAll('assoc');
      $profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
      $this->set('files', $files);
      $this->set('profile_details', $profile_details);
    }

	public function addGalleryImage()
		{
			if($this->request->is('ajax'))
         	{
         		$fileName = $this->Custom->fileUploading('gallery_img','trainer_gallery'); 
         		$data = $this->Custom->getSessionData();
         		$data = array(
         			'piv_attachement_type' => 'image',
         			'piv_name' => $fileName,
         			'piv_user_type' => 'trainer',
         			'piv_user_id' => $data['id'],
         			'piv_status' => 0,
         			'piv_added_date' => Time::now(),
         			);
        $user = $this->Profile_images_videos->newEntity();
		$user = $this->Profile_images_videos->patchEntity($user, $data);
        $result = $this->Profile_images_videos->save($user);
		$lid = $result->piv_id; 
        $this->set('message', $lid);
		$this->set('_serialize',array('message'));
		$this->response->statusCode(200);
         }
		}

		public function addVideos()
		{
			if($this->request->is('ajax'))
         	{
         		$fileName = $this->Custom->fileUploading('trainer_videos','trainer_videos'); 
         		$data = $this->Custom->getSessionData();
         		$data = array(
         			'piv_attachement_type' => 'video',
         			'piv_name' => $fileName,
         			'piv_user_type' => 'trainer',
         			'piv_user_id' => $data['id'],
         			'piv_status' => 0,
         			'piv_added_date' => Time::now(),
         			);
        $user = $this->Profile_images_videos->newEntity();
		$user = $this->Profile_images_videos->patchEntity($user, $data);
        $result = $this->Profile_images_videos->save($user);
		$lid = $result->piv_id; 
        $this->set('message', $lid);
		$this->set('_serialize',array('message'));
		$this->response->statusCode(200);
         }
		}

	public function completeProfile()
	{
		
		 if(isset($_REQUEST['addgym'])){
					//print_r($_REQUEST);die;
					$data=array(
					'name'=>$_REQUEST['name'],
					'address'=>$_REQUEST['address'],
					'latitude'=>$_REQUEST['lat'],
					'longitude'=>$_REQUEST['long'],
					'trainer_id'=>$this->data['id']
					);
					 $this->conn->insert('gym',$data);
									  
		}
		$data = $this->Custom->getSessionData();
		$countries = $this->Countries->find('all')->toArray();
		$profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
		
		$gyms = $this->gym->find()->where(['trainer_id' => $this->data['id']])->toArray();
		
		$quotes = $this->Latest_things->find()->where(['lt_type' => 'Quotes', 'lt_user_id' => $data['id']])->order(['id' => 'DESC'])->toArray();
		$country_id = $profile_details[0]['trainer_country'];
        $state_id = $profile_details[0]['trainer_state'];
        $states = $this->States->find()->where(['country_id' => $country_id])->order(['name' => 'ASC'])->toArray();
        $cities = $this->Cities->find()->where(['state_id' => $state_id])->order(['name' => 'ASC'])->toArray();
        $certificates = $this->Documents->find()->where(['trainer_id' => $this->data['id'],'document_type' => 'certifications'])->order(['id' => 'DESC'])->toArray();
        $resume = $this->Documents->find()->where(['trainer_id' => $this->data['id'],'document_type' => 'resume'])->order(['id' => 'DESC'])->toArray();
        
        $trainer=$this->data['id'];
        $trainerratedetail = $this->conn->execute("SELECT *  FROM `trainer_ratemaster` where `trainer_id`=$trainer")->fetchAll('assoc');
        if(count($trainerratedetail)==0)
        {
          $trainerratedetail=array(array('rate_id'=>'','rate_hour'=>0,'adgust1'=>0,'adgust2'=>0,'adgust3'=>0,'adgust4'=>0));
        }

        $package_list = $this->conn->execute("SELECT *  FROM `trainer_packagemaster` where `trainer_id`=$trainer")->fetchAll('assoc');

        $latlng = $this->Custom->getlatlngbyip();

        $time_slots = $this->Trainer_availability->find()->where(['trainer_id' => $this->data['id'],'date' => date('Y-m-d')])->toArray();
        $this->set('time_slots', $time_slots);
        
        $this->set('latlng', $latlng);
        $this->set('package_list', $package_list);
        $this->set('trainerratedetail', $trainerratedetail);
        $this->set('resume',$resume);
        $this->set('certificates',$certificates);
        $this->set('quotes',$quotes);
		    $this->set('profile_details', $profile_details);
		    $this->set('countries', $countries);
        $this->set('states', $states);
        $this->set('cities', $cities);
        $this->set('gyms', $gyms);
	}

    public function traineeReport($id)
    {
        $trainee_profile_details = $this->Trainees->find()->where(['user_id' => base64_decode($id)])->toArray();
        $profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
        $progress_img = $this->After_before_images->find()->where(['abi_trainee_id' => base64_decode($id)])->toArray();
        $meal_plans_arr = $this->Meal_plans->find()->where(['trainer_id' => $this->data['id'], 'trainee_id' => base64_decode($id)])->order(['row_id' => 'ASC'])->toArray();
        $shopping_arr = $this->Shopping->find()->where(['trainer_id' => $this->data['id'], 'trainee_id' => base64_decode($id)])->order(['row_id' => 'ASC'])->toArray();
        $bmi_results = $this->Bmi->find()->where(['bmi_trainee_id' => base64_decode($id), 'bmi_trainer_id' => $this->data['id']])->toArray();
        $this->set('bmi_results', $bmi_results);
        $this->set('meal_plans_arr', $meal_plans_arr);
        $this->set('shopping_arr', $shopping_arr);
        $this->set('progress_img', $progress_img);
        $this->set('profile_details', $profile_details);
        $this->set('trainee_profile_details', $trainee_profile_details);
    }

    public function addMealPlans()
    {
        if($this->request->is('ajax'))
        {
            $dataArr = $this->request->data;
            $meal_plans_data = $this->Meal_plans->find()->where(['row_id' => $dataArr['rowId'], 'trainee_id' => base64_decode($dataArr['trainee_id'])])->toArray();
            if(empty($meal_plans_data)){
                $finalArr = array (
                    'trainer_id' => $this->data['id'],
                    'trainee_id' => base64_decode($dataArr['trainee_id']),
                    'row_id'     => $dataArr['rowId'],
                    $dataArr['type'] => $dataArr['name'],
                    'added_date' => Time::now()
                    );
                $user = $this->Meal_plans->newEntity();
                $user = $this->Meal_plans->patchEntity($user, $finalArr);
                $result = $this->Meal_plans->save($user);
            }else{
                $this->meal_plans->query()->update()->set([$dataArr['type'] => $dataArr['name']])->where(['row_id' => $dataArr['rowId'], 'trainee_id' => base64_decode($dataArr['trainee_id'])])->execute();
            }
            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
        }
    }

    public function addShoppingList()
    {
        if($this->request->is('ajax'))
        {
            $dataArr = $this->request->data;
            $shopping_data = $this->Shopping->find()->where(['row_id' => $dataArr['rowId'], 'trainee_id' => base64_decode($dataArr['trainee_id'])])->toArray();
            if(empty($shopping_data)){
                $finalArr = array (
                    'trainer_id' => $this->data['id'],
                    'trainee_id' => base64_decode($dataArr['trainee_id']),
                    'row_id'     => $dataArr['rowId'],
                    $dataArr['type'] => $dataArr['name'],
                    'added_date' => Time::now()
                    );
                $user = $this->Shopping->newEntity();
                $user = $this->Shopping->patchEntity($user, $finalArr);
                $result = $this->Shopping->save($user);
            }else{
                $this->shopping->query()->update()->set([$dataArr['type'] => $dataArr['name']])->where(['row_id' => $dataArr['rowId'], 'trainee_id' => base64_decode($dataArr['trainee_id'])])->execute();
            }
            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
        }
    }

	public function getStates()
     {
        if($this->request->is('ajax'))
        {
             $state = $this->request->data['state'];
             $states = $this->States->find()->where(['country_id' => $state])->order(['name' => 'ASC'])->toArray();
             $this->set('message', $states);
             $this->set('_serialize',array('message'));
             $this->response->statusCode(200);
        }
     }

    public function getCities()
     {
        if($this->request->is('ajax'))
        {
             $city = $this->request->data['city'];
             $cities = $this->Cities->find()->where(['state_id' => $city])->order(['name' => 'ASC'])->toArray();
             $this->set('message', $cities);
             $this->set('_serialize',array('message'));
             $this->response->statusCode(200);
        }
     }

	public function changePassword()
	{
		if($this->request->is('ajax'))
     	{
     		$sess_data = $this->Custom->getSessionData();
     		$data = array('trainer_password' => $this->request->data['new_pswd']);
     		$password = $this->request->data['new_pswd'];
     		$hashPswdObj = new DefaultPasswordHasher;
     		$hashpswd = $hashPswdObj->hash($password);
		    $this->trainers->query()->update()->set(['trainer_password' => $this->request->data['new_pswd']])->where(['user_id' => $sess_data['id']])->execute();
		    $this->users->query()->update()->set(['password' => $hashpswd])->where(['id' => $sess_data['id']])->execute();
     		$this->set('message', 'success');
		    $this->set('_serialize',array('message'));
		    $this->response->statusCode(200);
     	}
	}

	public function updatePersonalInfo($type)
	{
        if($this->request->is('post'))
        {
     		$sess_data = $this->Custom->getSessionData();
     		$data = $this->request->data;
            if(isset($_POST['trainer_skills'])){
                $skills = $data['trainer_skills'];
                $skillsArr = explode(",", $skills);
                if(in_array("", $skillsArr) || in_array(" ", $skillsArr))
                {
                  $this->Flash->error('Skills can not be blank !', ['key' => 'edit1']); 
                  return $this->redirect('/trainers/completeProfile');
                }
                if(count($skillsArr) > 5)
                {
                    $this->Flash->error('You Can Add Only Five Skills !', ['key' => 'edit1']); 
                }
            }
            if($type == "informaiton"){
                $key = 'edit1';
                $address = $this->Custom->getCityName($data['trainer_city']).' '.$this->Custom->getStateName($data['trainer_state']).' '.$this->Custom->getCountryName($data['trainer_country']);
                $loc = $this->Custom->getlatlng($address);
                $data['lat'] = $loc["latitude"];
                $data['lng'] = $loc["longitude"];
                $this->users->query()->update()->set(array('display_name' => $data['trainer_displayName']))->where(['id' => $this->data['id']])->execute();
            }
            if($type == "social_links"){
                $key = 'edit2';
            }
            if($type == "achievements"){
                $key = 'edit4';
            }
            if($type == "others"){
                $key = 'edit5';
            }
            $this->trainers->query()->update()->set($data)->where(['user_id' => $sess_data['id']])->execute();
            $this->Flash->success('Profile Has Been Updated Successfully', ['key' => $key]); 
     		   return $this->redirect('/trainers/completeProfile/'.$type);
        }
	}

    public function updateBankDetails($type)
    {
        if($this->request->is('post'))
        {
            $data = $this->request->data;
            $this->trainers->query()->update()->set($data)->where(['user_id' => $this->data['id']])->execute();
            $this->Flash->success('Bank Details Updated Successfully', ['key' => 'edit3']); 
            return $this->redirect('/trainers/completeProfile/'.$type);
        }
    }


  function addpackage()
    {
        $package_name=$this->request->data['package_name'];
        $package_detail=$this->request->data['package_detail'];
        $package_price=$this->request->data['package_price'];
        $hidden_packeage_id=$this->request->data['hidden_packeage_id'];
        $trainer=$this->data['id'];
        $data = array(
            'trainer_id'=>$trainer,
            'package_name' => $package_name,
            'package_discription' =>$package_detail,
            'package_price' =>$package_price,
            'status' => 1,
            'created_date' =>date('Y-m-d H:i:s'),
            );
        if(empty($hidden_packeage_id)){
            $user = $this->Trainer_packagemaster->newEntity();
            $user = $this->Trainer_packagemaster->patchEntity($user, $data);
            $result = $this->Trainer_packagemaster->save($user);
            $packageId = $result->package_id;
            $divPackId = "pac_".$packageId;
            $response="<div class='item' id=" . $divPackId . "> <div class='session_top'> <div class='session_head'>".$package_name."<a href='javascript:void(0);' class='edit-package-btn' main=" . $packageId . "><i class='fa fa-edit'></i></a></div>
                   <div class='price_session'>".$package_detail."</div>
                    <a href='javascript:void(0);' class='order_btn'>$".$package_price."</a> </div>  </div>";
        }else{
            $this->trainer_packagemaster->query()->update()->set($data)->where(['package_id' => $hidden_packeage_id])->execute();
            $packageId = $hidden_packeage_id;
            $divPackId = "pac_".$packageId;
            $response="<div class='session_top'> <div class='session_head'>".$package_name."<a href='javascript:void(0);' class='edit-package-btn' main=" . $packageId . "><i class='fa fa-edit'></i></a></div>
                   <div class='price_session'>".$package_detail."</div>
                    <a href='javascript:void(0);' class='order_btn'>$".$package_price."</a> </div>";
        }
        
        $this->set('message', $response);
        $this->set('_serialize',array('message'));
        $this->response->statusCode(200);
    }

    public function getPackageData()
    {
        if($this->request->is('ajax'))
        {
            $pack_id = $this->request->data['pack_id'];
            $result = $this->Trainer_packagemaster->find()->where(['package_id' => $pack_id]);
            $this->set('message', $result);
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
        }
    }

	public function updateProfileImage()
	{
		if($this->request->is('ajax'))
     	{
     		$fileName = $this->Custom->fileUploading('trainer_profile_img','trainer_profile'); 
     		$sess_data = $this->Custom->getSessionData();
     		$this->trainers->query()->update()->set(['trainer_image' => $fileName])->where(['user_id' => $sess_data['id']])->execute();
     		$this->set('message', $fileName);
			$this->set('_serialize',array('message'));
			$this->response->statusCode(200);
     	}
	}

	public function addQuotes($type)
    {
    	$sessData = $this->Custom->getSessionData();
        $data = $this->request->data;
        $data['lt_type'] = 'Quotes';
        $data['lt_status'] = 0;
        $data['lt_user_id'] = $sessData['id'];
        $data['lt_added_date'] = Time::now();
        $user = $this->Latest_things->newEntity();
        $user = $this->Latest_things->patchEntity($user, $data);
        $result = $this->Latest_things->save($user);
        $this->Flash->success('Quotes Added Successfully', ['key' => 'edit6']);
        return $this->redirect('/trainers/completeProfile/'.$type);
    }

    public function deleteGallery()
    {
        if($this->request->is('ajax'))
        {
            $id = (int) base64_decode($this->request->data['p_id']);
            $fileName = $this->request->data['file'];
            $this->gallery->query()->delete()->where(['piv_id' => $id])->execute();
            $this->Custom->deleteFile($fileName,'trainer_gallery');
            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
        }
    }

     function setrate()
    {
        $trainer=$this->data['id'];
        $rate=$_POST['rate'];
        $rateid=$_POST['rateid'];
        if($rateid==""){
        $data = array(
                    'trainer_id'=>$trainer,
                    'rate_hour' => $rate,
                    'status' =>1,
                    'update_time' => Time::now()
                    );
        $user = $this->Trainer_ratemaster->newEntity();
        $user = $this->Trainer_ratemaster->patchEntity($user, $data);
        $result = $this->Trainer_ratemaster->save($user);
        $rid = $result->rate_id;
        }
        else
        {
            $data = array('rate_hour' =>$rate);
            $this->Trainer_ratemaster->query()->update()->set($data)->where(['rate_id' => $rateid])->execute();
            $rid = $rateid;
        }
         $rate_detail=$this->conn->execute('SELECT *  FROM `trainer_ratemaster` where  `rate_id`='.$rid)->fetchAll('assoc');
         $rate1=$rate*1-$rate_detail[0]['adgust1'];
         $rate2=$rate*3-$rate_detail[0]['adgust2'];
         $rate3=$rate*10-$rate_detail[0]['adgust3'];
         $rate4=$rate*20-$rate_detail[0]['adgust4'];

        $response="<h5>Rate Plan</h5><div class='plan_session_content'> <ul>";
        $response.="<li><div class='session_top'><div class='session_head'>1 Session</div> <div class='price_session rate1'>$".$rate1."</div></div><div class='session_bottom'><input type='text' ratet='1' id='adjust1' value='".$rate_detail[0]['adgust1']."' class='form-control adjust'></div></li>";
        $response.="<li><div class='session_top'><div class='session_head'>3 Session</div> <div class='price_session rate2'>$".$rate2."</div></div><div class='session_bottom'><input type='text' ratet='2' id='adjust2' value='".$rate_detail[0]['adgust2']."'  class='form-control adjust'></div></li>";
        $response.="<li><div class='session_top'><div class='session_head'>10 Session</div> <div class='price_session rate3'>$".$rate3."</div></div><div class='session_bottom'><input type='text' ratet='3' id='adjust3' value='".$rate_detail[0]['adgust3']."'  class='form-control adjust'></div></li>";
        $response.="<li><div class='session_top'><div class='session_head'>20 Session</div> <div class='price_session rate4'>$".$rate4."</div></div><div class='session_bottom'><input type='text' ratet='4' id='adjust4' value='".$rate_detail[0]['adgust4']."'  class='form-control adjust'></div></li></ul></div> ";
        $this->set('message', $response);
        $this->set('_serialize',array('message'));
        $this->response->statusCode(200);

   }
    function adjust()
    {
        $rateid=$_POST['rateid'];
        $adjust1=$_POST['adjust1'];
        $adjust2=$_POST['adjust2'];
        $adjust3=$_POST['adjust3'];
        $adjust4=$_POST['adjust4'];
        $data = array('adgust1' =>$adjust1,'adgust2' =>$adjust2,'adgust3' =>$adjust3,'adgust4' =>$adjust4);
        $this->Trainer_ratemaster->query()->update()->set($data)->where(['rate_id' => $rateid])->execute();
        $response="";
        $this->set('message', $response);
        $this->set('_serialize',array('message'));
        $this->response->statusCode(200);
    }

     public function rateplan()
    {
       $profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
       $all_trainees = $this->conn->execute('SELECT *,t.id as trainee_id,c.name as country_name,s.name as state_name,ct.name as city_name  FROM trainees as t inner join countries as c on c.id = t.trainee_country inner join states as s on s.id = t.trainee_state inner join cities as ct on ct.id = t.trainee_city where `t`.`trainer_status` = 1 ORDER BY t.id DESC ')->fetchAll('assoc');
       $trainer=$this->data['id'];
       $trainerratedetail = $this->conn->execute("SELECT *  FROM `trainer_ratemaster` where `trainer_id`=$trainer")->fetchAll('assoc');
       if(count($trainerratedetail)==0)
       {
          $trainerratedetail=array(array('rate_id'=>'','rate_hour'=>0,'adgust1'=>0,'adgust2'=>0,'adgust3'=>0,'adgust4'=>0));
       }
       if(!empty($all_trainees))
       {
       $recent_trainee_id = $all_trainees[0]['user_id'];
       $trainer_id = $this->data['id'];
       $trainee_details = $this->Trainees->find()->where(['user_id' => $recent_trainee_id])->toArray();
       $chat_data = $this->conn->execute(" SELECT 
                                            chating.*
                                            FROM chating
                                            WHERE 
                                            (chating.chat_sender_id = $trainer_id AND chating.chat_reciever_id = $recent_trainee_id AND chating.chat_type = 0 )
                                            OR 
                                            (chating.chat_sender_id = $recent_trainee_id AND chating.chat_reciever_id = $trainer_id AND chating.chat_type = 0 )
                                         ")->fetchAll('assoc');
        $chat_final_arr = array();
        foreach ($chat_data as $c)
         {
          $chat_final_arr[] = $c['chat_id'];
         }
        array_multisort($chat_final_arr, SORT_DESC, $chat_data);
        $this->set('trainer_id', $trainer_id); 
        $this->set('trainee_details', $trainee_details); 
        }
        else
        {
            $chat_data = array();
        }
       $this->set('chat_data', $chat_data); 
       $this->set('trainerratedetail', $trainerratedetail); 
       $this->set('all_trainees', $all_trainees);
       $this->set('profile_details', $profile_details); 
    }

    public function appointments()
    {
       $profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
       $pending_appointments  = $this->conn->execute('SELECT *,`a`.`id` AS `app_id` FROM `appointments` AS `a` INNER JOIN `trainees` AS `t` ON `a`.`trainee_id` = `t`.`user_id` WHERE `a`.`trainer_id` = '.$this->data['id'].' AND `a`.`trainer_status` = 0 AND `a`.`trainee_status` = 0 AND `a`.`created_date` >= DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY `a`.`id` DESC')->fetchAll('assoc');
       $upcoming_appointments = $this->conn->execute('SELECT *,`a`.`id` AS `app_id` FROM `appointments` AS `a` INNER JOIN `trainees` AS `t` ON `a`.`trainee_id` = `t`.`user_id` WHERE `a`.`trainer_id` = '.$this->data['id'].' AND `a`.`trainer_status` = 1 AND `a`.`trainee_status` = 1 AND `a`.`created_date` >= CURDATE() ORDER BY `a`.`id` DESC')->fetchAll('assoc');
       if(!empty($upcoming_appointments)){
          foreach($upcoming_appointments as $ua){
            $sessionArr = unserialize($ua['session_data']);
            for ($i=1; $i <= count($sessionArr); $i++) { 
                $upcomingArr['trainee_name'][] = $ua['trainee_name']." ".$ua['trainee_lname'];
                $upcomingArr['user_id'][]      = $ua['user_id'];
                $upcomingArr['trainee_image'][]= $ua['trainee_image'];
                $upcomingArr['location_name'][]= $sessionArr[$i]['location_address'];
                $upcomingArr['appo_date'][]    = $sessionArr[$i]['modified_dates'];
                $upcomingArr['appo_time'][]    = $sessionArr[$i]['modified_times'];
            }
          }        
       }
       else{
            $upcomingArr = array();
       }    
       $this->set('upcomingArr', $upcomingArr);
       $this->set('pending_appointments', $pending_appointments);
       $this->set('profile_details', $profile_details);
       $this->set("from_id",$this->data['id']);
    }

    public function appointmentsAvailability()
    {
       $profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
       $time_slots = $this->Trainer_availability->find()->where(['trainer_id' => $this->data['id'],'date' => date('Y-m-d')])->toArray();
       $this->set('time_slots', $time_slots);
       $this->set('profile_details', $profile_details);
    }

    public function viewPendingAppointment()
    {
       $aid = base64_decode($this->request->query['aid']);
       $profile_type_arr = $this->Users->find()->where(['id' => $this->data['id']])->toArray();
        if(!empty($profile_type_arr[0]['social_type']))
          {
            $session_details = $this->conn->execute('SELECT *,`a`.`id` AS `app_id` FROM `appointments` AS `a` INNER JOIN `trainees` AS `t` ON `a`.`trainee_id` = `t`.`user_id` WHERE `a`.`id` = '.$aid)->fetchAll('assoc');
          }
        else
          {
            $session_details = $this->conn->execute('SELECT *,`a`.`id` AS `app_id`,c.name as country_name,ct.name as city_name,s.name as state_name FROM `appointments` AS `a` INNER JOIN `trainees` AS `t` ON `a`.`trainee_id` = `t`.`user_id` inner join `countries` as c on t.trainee_country = c.id inner join `states` as s on t.trainee_state = s.id inner join `cities` as ct on t.trainee_city = ct.id WHERE `a`.`id` = '.$aid)->fetchAll('assoc');
          }
       $profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
       $time_slots = $this->Trainer_availability->find()->where(['trainer_id' => $this->data['id'],'date' => date('Y-m-d')])->toArray();
       $this->set('time_slots', $time_slots);
       $this->set('session_details', $session_details);
       $this->set('profile_details', $profile_details);
    }

    public function respondnow()
    {
        $type  = $this->request->query['type'];
        $appid = base64_decode($this->request->query['appid']);
        if($type == 1){ // for approve
            $this->approveAppointment($appid);
            $this->request->session()->write('sucess_alert','Appointment successfully approved !!');
            return $this->redirect('/trainers');
        }else{ // for decline
            $this->declineAppointment($appid);
            $this->request->session()->write('sucess_alert','Appointment successfully declined !!');
            return $this->redirect('/trainers');
        }
    }

    public function approveAppointment($appid){
        $appoinment_details = $this->Appointments->find()->where(['id' => $appid])->toArray();
        $appArr = array(
                'trainer_status' => 1,
                'trainee_status' => 1
            );
        $this->appointments->query()->update()->set($appArr)->where(['id' => $appid])->execute();
        $notificationArr = array(
                'noti_type'          => 'Approve Appointment',
                'parent_id'          => $appid,
                'noti_sender_type'   => 'trainer',
                'noti_sender_id'     => $appoinment_details[0]['trainer_id'],
                'noti_receiver_type' => 'trainee',
                'parent_id_status'   => 1,
                'noti_receiver_id'   => $appoinment_details[0]['trainee_id'],
                'noti_message'       => 'has approved your appoinment',
                'noti_added_date'    => Time::now()
            );
        $notifications = $this->Notifications->newEntity();
        $notifications = $this->Notifications->patchEntity($notifications, $notificationArr);
        $result = $this->Notifications->save($notifications);

        $trainer_earning_fee = $this->Fees->find()->where(['type' => 'Trainer Earning'])->toArray();
        $trainer_wallet_fee  = $this->Fees->find()->where(['type' => 'Administration'])->toArray();
        $wallet_details      = $this->Total_wallet_ammount->find()->where(['user_id' => $this->data['id']])->toArray();
        $session_price       = $appoinment_details[0]['final_price'];
        $total_deduct_amount = ($session_price * ($trainer_earning_fee[0]['txn_fee'] + $trainer_wallet_fee[0]['txn_fee']))/100;
        $final_wallet_amount = round($session_price - $total_deduct_amount,2);
        if(empty($wallet_details)){
            $walletArr = array(
                'user_id'       => $this->data['id'],
                'user_type'     => 'trainer',
                'total_ammount' => $final_wallet_amount,
                'added_date'    => Time::now()
            );
            $wallet = $this->Total_wallet_ammount->newEntity();
            $wallet = $this->Total_wallet_ammount->patchEntity($wallet, $walletArr);
            $result = $this->Total_wallet_ammount->save($wallet);
        }else{
            $wallet_current_balance = round($wallet_details[0]['total_ammount'] + $final_wallet_amount,2);
            $this->total_wallet_ammount->query()->update()->set(['total_ammount'=> $wallet_current_balance])->where(['user_id' => $this->data['id']])->execute();
        }
        $trainer_txn_arr = array(
            'trainer_id'  => $this->data['id'],
            'txn_name'    => 'Rate Plan Earning',
            'txn_type'    => 0,
            'txn_id'      => $this->data['id'].uniqid(),
            'parent_id'   => $appid,
            'total_amount'=> $session_price,
            'administration_fee'=> ($session_price * $trainer_wallet_fee[0]['txn_fee'])/100,
            'service_fee'=> ($session_price * $trainer_earning_fee[0]['txn_fee'])/100,
            'added_date' => Time::now()
          );
        $txns   = $this->Trainer_txns->newEntity();
        $txns   = $this->Trainer_txns->patchEntity($txns, $trainer_txn_arr);
        $result = $this->Trainer_txns->save($txns);
    }

    public function declineAppointment($appid){
        $appoinment_details = $this->Appointments->find()->where(['id' => $appid])->toArray();
        $appArr = array(
                'trainer_status' => 2,
                'trainee_status' => 2
            );
        $this->appointments->query()->update()->set($appArr)->where(['id' => $appid])->execute();
        $notificationArr = array(
                'noti_type'          => 'Decline Appointment',
                'parent_id'          => $appid,
                'noti_sender_type'   => 'trainer',
                'parent_id_status'   => 2,
                'noti_sender_id'     => $appoinment_details[0]['trainer_id'],
                'noti_receiver_type' => 'trainee',
                'noti_receiver_id'   => $appoinment_details[0]['trainee_id'],
                'noti_message'       => 'has declined your appoinment',
                'noti_added_date'    => Time::now()
            );
        $notifications = $this->Notifications->newEntity();
        $notifications = $this->Notifications->patchEntity($notifications, $notificationArr);
        $result = $this->Notifications->save($notifications);
        $refund_amount = $appoinment_details[0]['final_price'];
        
        $trainee_txns_arr = array(
             'trainee_id' => $appoinment_details[0]['trainee_id'],
             'txn_name'   => 'Decline Appoinment',
             'payment_type'=> 'Wallet',
             'txn_type'   => 'Credit',
             'txn_id'     => $appoinment_details[0]['trainee_id']."-".uniqid(),
             'ammount'    => $refund_amount,
             'status'     => 'Approved',
             'added_date' => Time::now()
            );    
        $txns   = $this->Trainee_txns->newEntity();
        $txns   = $this->Trainee_txns->patchEntity($txns, $trainee_txns_arr);
        $result = $this->Trainee_txns->save($txns);   
        $wallet_details = $this->Total_wallet_ammount->find()->where(['user_id' => $appoinment_details[0]['trainee_id']])->toArray();
        if(empty($wallet_details)){
            $walletArr = array(
                'user_id'       => $appoinment_details[0]['trainee_id'],
                'user_type'     => 'trainee',
                'total_ammount' => $refund_amount,
                'added_date'    => Time::now()
            );
            $wallet = $this->Total_wallet_ammount->newEntity();
            $wallet = $this->Total_wallet_ammount->patchEntity($wallet, $walletArr);
            $result = $this->Total_wallet_ammount->save($wallet);
        }else{
            $wallet_current_balance = round($wallet_details[0]['total_ammount'] + $refund_amount,2);
            $this->total_wallet_ammount->query()->update()->set(['total_ammount'=> $wallet_current_balance])->where(['user_id' => $appoinment_details[0]['trainee_id']])->execute();
        } 
    }

    public function dropEvent()
    {
        if($this->request->is('ajax'))
        {
            $id = (int) base64_decode($this->request->data['event_id']);
            $start_date = explode("T",$this->request->data['start_droped_date']);
            $end_date = explode("T",$this->request->data['end_droped_date']);
            $data = array(
                'app_date' => $start_date[0],
                'app_start_time' => $start_date[1],
                'app_end_time' => $end_date[1],
                );
            $this->appointments->query()->update()->set($data)->where(['app_id' => $id])->execute();
            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
        }
    }

    public function getBookSlotsData()
    {
        if($this->request->is('ajax'))
        {
            $id = (int) base64_decode($this->request->data['app_id']);
            $result_data = $this->conn->execute('SELECT * FROM `appointments` where `app_id` ='.$id)->fetchAll('assoc');
            $this->set('message', $result_data);
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
        }
    }

    public function getViewAppoData()
    {
        if($this->request->is('ajax'))
        {
            $id = (int) base64_decode($this->request->data['app_id']);
            $result_data = $this->conn->execute('SELECT * FROM `appointments` as a inner join trainers as t on t.user_id = a.app_reciever_id where a.`app_id` ='.$id)->fetchAll('assoc');
            $this->set('message', $result_data);
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
        }
    }

    public function deleteAppoinment()
    {
        if($this->request->is('ajax'))
        {
            $id = (int) base64_decode($this->request->data['id']);
            $this->appointments->query()->delete()->where(['app_id' => $id])->execute();
            $this->conn->execute('DELETE FROM notifications WHERE parent_id = '.$id. ' AND noti_type IN("Appoinment","Appoinment Accept","Appoinment Delete","Appoinment Request")');
            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
        }
    }

    public function messages()
    {
       $profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
       $all_trainees = $this->conn->execute('SELECT *,t.id as trainee_id,c.name as country_name,s.name as state_name,ct.name as city_name  FROM trainees as t inner join countries as c on c.id = t.trainee_country inner join states as s on s.id = t.trainee_state inner join cities as ct on ct.id = t.trainee_city where `t`.`trainee_status` = 1 ORDER BY t.id DESC ')->fetchAll('assoc');
       if(!empty($all_trainees))
       {
       $recent_trainee_id = $all_trainees[0]['user_id'];
       $trainer_id = $this->data['id'];
       $trainee_details = $this->Trainees->find()->where(['user_id' => $recent_trainee_id])->toArray();
       $chat_data = $this->conn->execute(" SELECT 
                                            chating.*
                                            FROM chating
                                            WHERE 
                                            (chating.chat_sender_id = $trainer_id AND chating.chat_reciever_id = $recent_trainee_id AND chating.chat_type = 0 )
                                            OR 
                                            (chating.chat_sender_id = $recent_trainee_id AND chating.chat_reciever_id = $trainer_id AND chating.chat_type = 0 )
                                         ")->fetchAll('assoc');
        $chat_final_arr = array();
        foreach ($chat_data as $c)
         {
          $chat_final_arr[] = $c['chat_id'];
         }
        array_multisort($chat_final_arr, SORT_DESC, $chat_data);
        $this->set('trainer_id', $trainer_id); 
        $this->set('trainee_details', $trainee_details); 
        }
        else
        {
            $chat_data = array();
        }
       $this->set('chat_data', $chat_data); 
       $this->set('all_trainees', $all_trainees);
       $this->set('profile_details', $profile_details); 
    }

    public function getMessages()
    {
        if($this->request->is('ajax'))
        {
            $trainee_id = base64_decode($this->request->data['trainee_id']);
            $trainer_id = $this->data['id'];
            $trainer_details = $this->Trainers->find()->where(['user_id' => $trainer_id])->toArray();
            $trainee_details = $this->Trainees->find()->where(['user_id' => $trainee_id])->toArray();
            $chat_data = $this->conn->execute(" SELECT 
                                            chating.*
                                            FROM chating
                                            WHERE 
                                            (chating.chat_sender_id = $trainee_id AND chating.chat_reciever_id = $trainer_id AND chating.chat_type = 0 )
                                            OR 
                                            (chating.chat_sender_id = $trainer_id AND chating.chat_reciever_id = $trainee_id AND chating.chat_type = 0 )
                                         ")->fetchAll('assoc');
            $chat_final_arr = array();
            foreach ($chat_data as $c)
             {
              $chat_final_arr[] = $c['chat_id'];
             }
            array_multisort($chat_final_arr, SORT_DESC, $chat_data);
            $chat_msgs = "";
            if(empty($chat_data))
            {
                $chat_msgs = '<div><center>You have recieved no messages </center></div>';
            }
            else
            {
                foreach($chat_data as $cd) { 
                 if($cd['chat_reciever_id'] != $trainer_id) { 

                    $chat_msgs .= '<div class="media msg">';
                    $chat_msgs .= '<a class="pull-left" href="'.$this->request->webroot.'trainers/profile">';
                    $chat_msgs .= '<img class="media-object" style="width: 32px; height: 32px;" src="'.$this->request->webroot.'uploads/trainer_profile/'.$trainer_details[0]['trainer_image'].'"></a>';
                    $chat_msgs .= '<div class="media-body">';
                    $chat_msgs .= '<small class="pull-right"><i class="fa fa-clock-o"></i>'. date('d F y,h:i A', strtotime($cd["chat_added_date"])).'</small>';
                    $chat_msgs .= '<h5 class="media-heading">'.ucwords($trainer_details[0]['trainer_name']).'</h5>';
                    $chat_msgs .= '<small>'.$cd['chat_messsage'].'</small></div></div><hr>';
                }
                else
                {
                    $chat_msgs .= '<div class="media msg">';
                    $chat_msgs .= '<a class="pull-left" href="'.$this->request->webroot.'trainers/traineeReport/'.base64_encode($trainee_details[0]['user_id']).'">';
                    $chat_msgs .= '<img class="media-object" style="width: 32px; height: 32px;" src="'.$this->request->webroot.'uploads/trainee_profile/'.$trainee_details[0]['trainee_image'].'"></a>';
                    $chat_msgs .= '<div class="media-body">';
                    $chat_msgs .= '<small class="pull-right"><i class="fa fa-clock-o"></i>'. date('d F y,h:i A', strtotime($cd["chat_added_date"])).'</small>';
                    $chat_msgs .= '<h5 class="media-heading">'.ucwords($trainee_details[0]['trainee_name']).'</h5>';
                    $chat_msgs .= '<small>'.$cd['chat_messsage'].'</small></div></div><hr>';
                }
                }
            }
            $this->set('message', $chat_msgs);
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
        }
    }

    public function mytrainees()
    {
       $id = $this->data['id'];
       $appointment_data = $this->conn->execute('SELECT `trainee_id` FROM `appointments` WHERE `trainer_status` = 1 AND `trainee_status` = 1 AND `trainer_id` = '.$this->data['id'].' GROUP BY `trainee_id` ')->fetchAll('assoc');
       $custom_package_data = $this->conn->execute('SELECT `trainee_id` FROM `custom_packages_history` WHERE `trainer_id` = '.$this->data['id'].' GROUP BY `trainee_id` ')->fetchAll('assoc');
       $common_arr = array_merge($appointment_data,$custom_package_data);
       if(!empty($common_arr)){
        foreach($common_arr as $c)
         {
          $trainee_id[] = $c['trainee_id'];
         }
         $id_arr = array_unique($trainee_id);
         $ids    = implode(",", $id_arr);
         $trainee_data = $this->conn->execute('SELECT *,t.id as trainee_id,c.name as country_name,s.name as state_name,ct.name as city_name  FROM  trainees as t  inner join countries as c on c.id = t.trainee_country inner join states as s on s.id = t.trainee_state inner join cities as ct on ct.id = t.trainee_city where `t`.`user_id` IN('.$ids.') ORDER BY t.id DESC ')->fetchAll('assoc');
         $this->set('trainee_data', $trainee_data);  
       }else{
         $this->set('trainee_data', array());  
       }
       $profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
       $this->set('user_id', $id);  
       $this->set('profile_details', $profile_details); 
    }

    public function getNotifications()
    {
      $id = $this->data['id'];
      $noti_data   = $this->conn->execute('SELECT *,`n`.`id` AS `noti_id` FROM `notifications` AS `n` INNER JOIN `trainees` AS `t` ON `t`.`user_id` = `n`.`noti_sender_id` WHERE `n`.`noti_receiver_id` = '.$this->data['id'].' ORDER BY `n`.`id` DESC ')->fetchAll('assoc');
      $noti_final_arr = array();
        foreach ($noti_data as $user)
         {
          $noti_final_arr[] = $user['noti_id'];
         }
      array_multisort($noti_final_arr, SORT_DESC, $noti_data);
      return $noti_data;
    }

    public function notifications()
    {
      $profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
      $noti_data = $this->getNotifications();
      $this->set('noti_data', $noti_data);
      $this->set('profile_details', $profile_details); 
    }

    public function acceptAppoinment($appo_id,$noti_id,$trainee_id)
    {
        $this->appointments->query()->update()->set(['app_status' => 1])->where(['app_id' => base64_decode($appo_id)])->execute();
        $this->notifications->query()->update()->set(['noti_status' => 1])->where(['id' => base64_decode($noti_id)])->execute();

        $noti_data = array(
            'noti_type' => 'Appoinment Accept',
            'parent_id' => base64_decode($appo_id),
            'noti_sender_type' => 'trainer',
            'noti_sender_id' => $this->data['id'],
            'noti_receiver_type' => 'trainee',
            'noti_receiver_id' => base64_decode($trainee_id),
            'noti_message' => ' '.$this->data['display_name'].' Accepted Your Appoinment ',
            'noti_status' => 0,
            'noti_added_date' =>Time::now()
            );

        $user1 = $this->Notifications->newEntity();
        $user1 = $this->Notifications->patchEntity($user1, $noti_data);
        $result1 = $this->Notifications->save($user1);

        $this->Flash->success('Appoinment Accepted Successfully', ['key' => 'edit']);
        return $this->redirect('/trainers/notifications');
    }

    public function rejectAppoinment($app_id,$noti_id,$trainee_id)
    {
           $noti_data = array(
            'noti_type' => 'Appoinment Delete',
            'parent_id' => base64_decode($app_id),
            'noti_sender_type' => 'trainer',
            'noti_sender_id' => $this->data['id'],
            'noti_receiver_type' => 'trainee',
            'noti_receiver_id' => base64_decode($trainee_id),
            'noti_message' => ' '.$this->data['display_name'].' Rejected Your Appoinment ',
            'noti_status' => 0,
            'noti_added_date' =>Time::now()
            );

        $user1 = $this->Notifications->newEntity();
        $user1 = $this->Notifications->patchEntity($user1, $noti_data);
        $result1 = $this->Notifications->save($user1);

        $this->appointments->query()->update()->set(['app_status' => 2])->where(['app_id' => base64_decode($app_id)])->execute();
        $this->notifications->query()->update()->set(['noti_status' => 2])->where(['id' => base64_decode($noti_id)])->execute();
        $this->Flash->error('Appoinment Rejected Successfully', ['key' => 'edit']);
        return $this->redirect('/trainers/notifications');
    }

    public function photoalbum()
    {
       $gallery_img = $this->Profile_images_videos->find()->where(['piv_user_id' => $this->data['id'], 'piv_attachement_type' => 'image'])->order(['piv_id' => 'DESC'])->toArray();
       $gallery_videos = $this->Profile_images_videos->find()->where(['piv_user_id' => $this->data['id'], 'piv_attachement_type' => 'video'])->order(['piv_id' => 'DESC'])->toArray();
       $profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
       $this->set('profile_details', $profile_details); 
       $this->set('gallery_img', $gallery_img);
       $this->set('gallery_videos', $gallery_videos);
    }

    public function traineeBookAppoinments()
    {
        if($this->request->is('post'))
        {
            $data = $this->request->data;
            $data['app_type'] = 'Book';
            $data['app_sender_type'] = 'trainer';
            $data['app_sender_id'] = $this->data['id'];
            $data['app_reciever_type'] = 'trainee';
            $data['app_status'] = 0;
            $data['app_added_date'] = Time::now();
            $user = $this->Appointments->newEntity();
            $user = $this->Appointments->patchEntity($user, $data);
            $result = $this->Appointments->save($user);
            $lid = $result->app_id;

            $noti_data = array(
              'noti_type' => 'Appoinment Request',
              'parent_id' => $lid,
              'noti_sender_type' => 'trainer',
              'noti_sender_id' => $this->data['id'],
              'noti_receiver_type' => 'trainee',
              'noti_receiver_id' => $data['app_reciever_id'],
              'noti_message' => ' '.$this->data['display_name'].' sent an appoinment request ',
              'noti_status' => 0,
              'noti_added_date' =>Time::now()
              );
            $user1 = $this->Notifications->newEntity();
            $user1 = $this->Notifications->patchEntity($user1, $noti_data);
            $result1 = $this->Notifications->save($user1);

            $this->Flash->success('Appointment created successfully please wait for trainee approval', ['key' => 'edit']);
            return $this->redirect('/trainers/appointments');
        }
    }

    public function addDocuments($type)
    {
        $data = $this->request->data;
        $data['document_file'] = $this->Custom->fileUploading('document_file','documents'); 
        $data['document_type'] = $type;
        $data['trainer_id'] = $this->data['id'];
        $data['status'] = 0;
        $data['added_date'] = Time::now();
        $user = $this->Documents->newEntity();
        $user = $this->Documents->patchEntity($user, $data);
        $result = $this->Documents->save($user);
        if($type == 'certifications'){
            $key = "edit7";
        }
        if($type == 'resume'){
            $key = "edit8";
        }
        $this->Flash->success( ucwords($type) .' Added Successfully', ['key' => $key]);
        return $this->redirect('/trainers/completeProfile/'.$type);
    }

    public function downloadDocument($filename)
    {
        $file = 'uploads/documents/'.$filename;
        $this->Custom->downloadFile($file);
    }

    public function bookAppoinments($id)
    {
      $trainee_id = (int) base64_decode($id);
      $result = $this->Trainees->find()->where(['user_id' => $trainee_id])->toArray();
      $slots = $this->Appointments->find()->where(['app_sender_id' => $trainee_id,'app_reciever_id' => 0])->toArray();
      $booked_appo = $this->Appointments->find()->where(['app_reciever_id' => $trainee_id,'app_status' => 1])->toArray();
      $book_appo = array_merge($slots,$booked_appo);
      if(!empty($book_appo))
       {
            foreach($book_appo as $ba)
            {
                $dateArr = explode(" ",$ba['app_date']);
                $date = $dateArr[0];
                $newDate = date("Y-m-d", strtotime($date));
                $book_appo_arr[] = array(
                        'title' => preg_replace( "/\r|\n/", " ", $ba['app_message']),
                        'id' => $ba['app_id'],
                        'start' => $newDate ." ".$ba['app_start_time'],
                        'end' => $newDate ." ".$ba['app_end_time'],
                        'backgroundColor' => $ba['app_color']
                      );
            }
       }
       else
       {
            $book_appo_arr = array();
       }
      $this->set('book_appo_arr', $book_appo_arr);
      $this->set('trainee_detail', $result);
    }

    public function addAppoinments($id)
      {
        if($this->request->is('post'))
            {
                $data = $this->request->data;
                $data['app_type'] = 'Book';
                $data['app_sender_type'] = 'trainer';
                $data['app_sender_id'] = $this->data['id'];
                $data['app_status'] = 0;
                $data['app_reciever_type'] ='trainee';
                $data['app_reciever_id'] = base64_decode($id);
                $data['app_added_date'] = Time::now();
                $user = $this->Appointments->newEntity();
                $user = $this->Appointments->patchEntity($user, $data);
                $result = $this->Appointments->save($user);
                $lid = $result->app_id;

                $noti_data = array(
                'noti_type' => 'Appoinment Request',
                'parent_id' => $lid,
                'noti_sender_type' => 'trainee',
                'noti_sender_id' => $this->data['id'],
                'noti_receiver_type' => 'trainer',
                'noti_receiver_id' => base64_decode($id),
                'noti_message' => ' '.$this->data['display_name'].' sent an appoinment request ',
                'noti_status' => 0,
                'noti_added_date' =>Time::now()
                );
                $user1 = $this->Notifications->newEntity();
                $user1 = $this->Notifications->patchEntity($user1, $noti_data);
                $result1 = $this->Notifications->save($user1);

                $this->Flash->success('Appoinment Created Successfully Please Wait For Trainee Approval', ['key' => 'edit']);
                return $this->redirect('/trainers/bookAppoinments/'.$id);
            }
    }

    public function savebmi()
    {
        if($this->request->is('ajax'))
        {
            $bmi_data = array(
                'bmi_date' => date('Y-m-d'),
                'bmi_calculated' => $this->request->data['bmi'],
                'bmi_weight_status' => $this->request->data['status'],
                'bmi_trainee_id' => base64_decode($this->request->data['trainee_id']),
                'bmi_trainer_id' => $this->data['id'],
                'bmi_status' => 0,
                'bmi_added_date' => Time::now()
                );
            $user = $this->Bmi->newEntity();
            $user = $this->Bmi->patchEntity($user, $bmi_data);
            $result = $this->Bmi->save($user);
            $lid = $result->id;
            $this->set('message', $lid);
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
        }
    }

    public function delete()
    {
        if($this->request->is('ajax'))
        {
            $id = (int) base64_decode($this->request->data['id']);
            $table = $this->request->data['table'];
            foreach($table as $t)
            {
                if($t == "Trainers")
                {
                    $this->trainers->query()->delete()->where(['user_id' => $id])->execute();
                }
                if($t == "Trainees")
                {
                    $this->trainees->query()->delete()->where(['user_id' => $id])->execute();
                }
                if($t != "Trainees" && $t != "Trainers")
                {
                   $entity = $this->$t->get($id);
                   $result = $this->$t->delete($entity); 
                }
            }
            $this->set('message', 'success');
            $this->set('_serialize',array('message'));
            $this->response->statusCode(200);
        }
    }

    public function traineravailability()
    {
      if($this->request->is('ajax'))
        {
           $data = $this->request->data();
           $dataArr = array(
                'trainer_id' => $this->data['id'],
                'date'       => $data['selected_date'],
                'times'      => serialize($data['times'])
                );

           $results = $this->Trainer_availability->find()->where(['trainer_id' => $this->data['id'],'date' => $data['selected_date']])->toArray();
           if(empty($results)){
                $dataArr['created_date'] = Time::now();
                $user = $this->Trainer_availability->newEntity();
                $user = $this->Trainer_availability->patchEntity($user, $dataArr);
                $result = $this->Trainer_availability->save($user);
           }else{
                $this->trainer_availability->query()->update()->set($dataArr)->where(['trainer_id' => $this->data['id'],'date' => $data['selected_date']])->execute();
           }
           $this->set('message', 'success');
           $this->set('_serialize',array('message'));
           $this->response->statusCode(200);
        }
    }

  public function getTimeSlotsDateWise()
  {
    if($this->request->is('ajax'))
      {
         $date = $this->request->data['date'];
         $trainer_id = $this->data['id'];
         $results = $this->Trainer_availability->find()->where(['trainer_id' => $trainer_id,'date' => $date])->toArray();
         $response = "";
         if(empty($results)){
              for ($i=0; $i < 24; $i++) { 
                 $response .= "<div class='checkbox'><div title='Available' class='roundedOne unbookedlabel'>";
                 $response .= "<input type='checkbox' class='time unbooked'  time1='".$this->Custom->getTimeSlots($i)."' time2='".$this->Custom->getTimeSlots($i+1)."' value='0' main='".$i."' id='roundedOne_".$i."' />";
                 $response .= "<label for='roundedOne_".$i."'></label>";
                 $response .= "<input type='hidden' name='times[]' class='hidden_time' id='time_".$i."' value='0'/> </div>";
                 $response .= "<div class='chekbox_txt'> <span>" .$this->Custom->getTimeSlots($i). "</span>";
                 $response .= $this->Custom->getTimeSlots($i+1)."</div></div>";
             }
         }else{
             $times = unserialize($results[0]['times']);
             for ($i=0; $i < count($times); $i++) { 
                  if($times[$i] > 0){
                      $check = "checked";
                      $disabled = "disabled";
                      $class = "booked";
                      $classlabel = "bookedlabel";
                      $title = "Blocked";
                  }else{
                      $check = "";
                      $disabled = "";
                      $class = "unbooked";
                      $classlabel = "unbookedlabel";
                      $title = "Available";
                  }
                 $response .= "<div class='checkbox'><div title='".$title."' class='roundedOne ".$classlabel."'>";
                 $response .= "<input type='checkbox' ".$check." " .$disabled. " class='time ".$class."' value='0' time1='".$this->Custom->getTimeSlots($i)."' time2='".$this->Custom->getTimeSlots($i+1)."' main='".$i."' id='roundedOne_".$i."' />";
                 $response .= "<label for='roundedOne_".$i."'></label>";
                 $response .= "<input type='hidden' name='times[]' class='hidden_time' id='time_".$i."' value='".$times[$i]."'/> </div>";
                 $response .= "<div class='chekbox_txt'> <span>" .$this->Custom->getTimeSlots($i). "</span>";
                 $response .= $this->Custom->getTimeSlots($i+1)."</div></div>";
             }
         }
         $this->set('message', $response);
         $this->set('_serialize',array('message'));
         $this->response->statusCode(200);
      }
  }

  public function makeSpecialOffer($appid)
  {
    if($this->request->is('post')){
        $dataArr = $this->request->data;
        $appid   = base64_decode($appid);
        $appoinment_details = $this->Appointments->find()->where(['id' => $appid])->toArray();
        if(!empty($appoinment_details[0]['special_offer_modify_date'])){
            $this->request->session()->write('error_alert','You already created request for special offer !!');
            return $this->redirect('/trainers');
        }
        $updateArr = array(
            'special_offer_price' => $dataArr['set_price'],
            'special_offer_modify_date' => Time::now(),
            'session_data' => serialize($dataArr['booking'])
          );
        $this->appointments->query()->update()->set($updateArr)->where(['id' => $appid])->execute();
        $notificationArr = array(
            'noti_type'          => 'Make Special Offer',
            'parent_id'          => $appid,
            'noti_sender_type'   => 'trainer',
            'noti_sender_id'     => $this->data['id'],
            'noti_receiver_type' => 'trainee',
            'parent_id_status'   => 3,
            'noti_receiver_id'   => $appoinment_details[0]['trainee_id'],
            'noti_message'       => 'have make a request for special offer',
            'noti_added_date'    => Time::now()
            );
        $notifications = $this->Notifications->newEntity();
        $notifications = $this->Notifications->patchEntity($notifications, $notificationArr);
        $result = $this->Notifications->save($notifications);
        $this->request->session()->write('sucess_alert','Special offer request successfully created !!');
        return $this->redirect('/trainers');
    }else{
       return $this->redirect('/trainers');
    }
  }

  public function wallet()
    {
      $profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
      $total_wallet_ammount = $this->Total_wallet_ammount->find()->where(['user_id' => $this->data['id']])->toArray();
      $wallet_txn = $this->Trainer_txns->find()->where(['trainer_id' => $this->data['id']])->order(['id' => 'DESC'])->toArray();
      $this->set('wallet_txn', $wallet_txn);
      $this->set('total_wallet_ammount', $total_wallet_ammount);
      $this->set('profile_details', $profile_details);
    }

  public function reports()
    {
      $profile_details = $this->Trainers->find()->where(['user_id' => $this->data['id']])->toArray();
      $withdraw_details = $this->Trainer_withdraw->find()->where(['trainer_id' => $this->data['id']])->toArray();
      $total_wallet_ammount = $this->Total_wallet_ammount->find()->where(['user_id' => $this->data['id']])->toArray();
      $custom_packages = $this->conn->execute('SELECT *,`cp`.`id` AS `cp_id` FROM `custom_packages_history` AS `cp` INNER JOIN `trainees` AS `t` ON `cp`.`trainee_id` = `t`.`user_id` WHERE `cp`.`trainer_id` ='.$this->data['id'].' ORDER BY `cp`.`id` DESC')->fetchAll('assoc');
      $this->set('withdraw_details', $withdraw_details);
      $this->set('custom_packages', $custom_packages);
      $this->set('total_wallet_ammount', $total_wallet_ammount);
      $this->set('profile_details', $profile_details);
    }

  public function withdrawRequest()
  {
    if($this->request->is('post')){
        $dataArr = $this->request->data;
        $service_fee_details = $this->Fees->find()->where(['type' => 'Withdrawal'])->toArray();
        if(!empty($service_fee_details)){
            $txn_fee =  $service_fee_details[0]['txn_fee'];
        }else{
            $txn_fee = 0;
        }
        $withdraw_fees = round(($dataArr['withdraw_amount'] * $txn_fee)/100,2);
        $final_withdraw_amount = round(($dataArr['withdraw_amount'] - $withdraw_fees),2);
        $trainerWithdrawArr = array(
            'trainer_id'      => $this->data['id'],
            'ammount'         => $dataArr['withdraw_amount'],
            'withdraw_payment_type' => $dataArr['payment_type'],
            'withdraw_fees'         => $withdraw_fees,
            'final_withdraw_amount' => $final_withdraw_amount,
            'withdraw_status' => 0,
            'added_date'      => Time::now()
            );
        $trainerWithdraw = $this->Trainer_withdraw->newEntity();
        $trainerWithdraw = $this->Trainer_withdraw->patchEntity($trainerWithdraw, $trainerWithdrawArr);
        $result = $this->Trainer_withdraw->save($trainerWithdraw);
        $lid = $result->id;

        $total_wallet_ammount = $this->Total_wallet_ammount->find()->where(['user_id' => $this->data['id']])->toArray();
        $total_wallet_ammount_arr = array(
              'total_ammount' => $total_wallet_ammount[0]['total_ammount'] - $dataArr['withdraw_amount'],
              );
        $this->total_wallet_ammount->query()->update()->set($total_wallet_ammount_arr)->where(['user_id' => $this->data['id']])->execute();

        $this->request->session()->write('sucess_alert','Your withdraw request successfully created !!');
        return $this->redirect('/trainers/wallet');
    }else{
       return $this->redirect('/trainers');
    }
  }

  public function packagepdf()
  {
    $pid = $this->request->query['id'];
    $custom_packages = $this->conn->execute('SELECT *,`cp`.`id` AS `cp_id` FROM `custom_packages_history` AS `cp` INNER JOIN `trainees` AS `t` ON `cp`.`trainee_id` = `t`.`user_id` WHERE `cp`.`id` ='.$pid)->fetchAll('assoc');
    $filename = 'Custom Package '.date('Y-m-d').'.pdf';
    $html  = "";
    $html .= "<div style='width:100%; float:left;'><div style='float:left; width:50%;'><img style='width:300px;' src='".$this->request->webroot."img/belibit_tv_logo_old1.png'></div><div style='float:right; width:200px;'><h1 style='color:#666;'>INVOICE</h1></div></div> ";
    $html .= "<div style='width:100%; float:left;'> <div style='float:left; width:50%;'><p style='font-size:14px; color:#666; margin:0px;'>You Tag Media & Business Solutions, Inc 1950 Broad Street, Unit 209 Regina, SK S4P 1X6 Canada</p><p style='font-size:14px; color:#666;  margin:0px;'>help@virtualtrainr.com</p><p style='font-size:14px; color:#666; margin:0px;'>+403-800-4843</p><br><br><h3 style='font-size:22px; color:#666; margin:0px 0px 5px 0px;'>Invoice to: </h3><p style='font-size:14px; padding:5px 0px; color:#666; margin:0px;'>Name : ".ucwords($custom_packages[0]['trainee_name']." ".$custom_packages[0]['trainee_lname'])."</div></div>";
    $html .= "<div style='width:100%; float:left;'><br><br><h3 style='font-size:22px; color:#666; margin:0px 0px 5px 0px;'>Details: </h3>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Purchase Date : ".date('d F Y, h:i A', strtotime($custom_packages[0]['created_date']))."</p>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Package Name : ".$custom_packages[0]['package_name']."</p>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Package Description   : ".$custom_packages[0]['package_description']."</p>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Package Price : $".$custom_packages[0]['price']."</p>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Service Fee : $".$custom_packages[0]['service_fee']."</p>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Discount : $".round($custom_packages[0]['total_price'] - $custom_packages[0]['final_price'],2)."</p>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Final Price : $".$custom_packages[0]['final_price']."</p>
              </div>";
    $this->Custom->downloadpdf($html,$filename);
  }

  public function withdrawpdf()
  {
    $tid = $this->request->query['id'];
    $txn_details = $this->conn->execute("SELECT * FROM `trainer_withdraw` AS `tx` INNER JOIN `trainers` AS `t` ON `tx`.`trainer_id` = `t`.`user_id` WHERE `tx`.`id` = ".$tid)->fetchAll('assoc');
    $filename = 'Withdraw '.$txn_details[0]['withdraw_txn_id'].' '.date('Y-m-d').'.pdf';
    switch ($txn_details[0]['withdraw_payment_type']) {
          case '0':
            $type = "Paypal";
            break;
          case '1':
            $type = "Amazon";
            break;
          default:
            $type = "Direct Payment";
            break;
        }
    switch ($txn_details[0]['withdraw_status']) {
          case '0':
            $status = "Pending";
            break;
          case '1':
            $status = "Completed";
            break;
          case '2':
            $status = "Failed";
            break;
          default:
            $status = "NA";
            break;
      }
    $html  = "";
    $html .= "<div style='width:100%; float:left;'><div style='float:left; width:50%;'><img style='width:300px;' src='".$this->request->webroot."img/belibit_tv_logo_old1.png'></div><div style='float:right; width:200px;'><h1 style='color:#666;'>INVOICE</h1></div></div> ";
    $html .= "<div style='width:100%; float:left;'> <div style='float:left; width:50%;'><p style='font-size:14px; color:#666; margin:0px;'>You Tag Media & Business Solutions, Inc 1950 Broad Street, Unit 209 Regina, SK S4P 1X6 Canada</p><p style='font-size:14px; color:#666;  margin:0px;'>help@virtualtrainr.com</p><p style='font-size:14px; color:#666; margin:0px;'>+403-800-4843</p><br><br><h3 style='font-size:22px; color:#666; margin:0px 0px 5px 0px;'>Invoice to: </h3><p style='font-size:14px; padding:5px 0px; color:#666; margin:0px;'>Name : ".ucwords($txn_details[0]['trainer_name']." ".$txn_details[0]['trainer_lname'])."</div></div>";
    $html .= "<div style='width:100%; float:left;'><br><br><h3 style='font-size:22px; color:#666; margin:0px 0px 5px 0px;'>Details: </h3>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Withdraw Date : ".date('d F Y, h:i A', strtotime($txn_details[0]['added_date']))."</p>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Withdraw Amount : $".$txn_details[0]['ammount']."</p>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Administration Fee : $".$txn_details[0]['withdraw_fees']."</p>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Final Amount : $".$txn_details[0]['final_withdraw_amount']."</p>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Withdraw Id : ".$txn_details[0]['withdraw_txn_id']."</p>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Payment Gateway : ".$type."</p>
              <p style='font-size:16px; color:#666; margin:0px; padding:5px 0px;'>Status : ".$status."</p>
              </div>";
    $this->Custom->downloadpdf($html,$filename);
  }

  public function deleteMessages()
  {
    if($this->request->is('ajax'))
      {
         $chatids = $this->request->data['chatids'];
         $this->conn->execute('DELETE FROM chating WHERE chat_id IN ('.$chatids.')');
         $this->set('message', 'success');
         $this->set('_serialize',array('message'));
         $this->response->statusCode(200);
      }
  }




}

?>
