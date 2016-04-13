<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Datasource\ConnectionManager;

class CustomHelper extends Helper
{
    
    public function p($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    public function defaultImage($class,$style)
    {
        $img = "<img style=" .$style. " class=" .$class. " src='img/default-user.png' alt='Default Image' >";
        return $img;
    }

    public function showImage($class,$style,$src)
    {
        $img1 = "<img style=" .$style. " class=" .$class. " src=".$src. ">";
        return $img1;
    }

    public function successMsg()
    {
        $successmsg = "";
        $successmsg .=  '<div class="alert alert-success alert-dismissable" style="display:none;" id="success_msg">';
        $successmsg .= '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
        $successmsg .= '<b></b> <center> <i class="fa fa-times"></i></center></div>';
        return $successmsg;
    }

    public function errorMsg()
    {
        $errormsg = "";
        $errormsg .= '<div class="alert alert-danger alert-dismissable" style="display:none;" id="error_msg">';
        $errormsg .= '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
        $errormsg .= '<b></b> <center> <i class="fa fa-times"></i></center></div>';
        return $errormsg;
    }

    public function loadingImg()
    {
        $loading_img = "";
        $loading_img .= '<center><img style="display:none;width:2.2%;" id="loading-img" src="'. $this->request->webroot .'img/loading-spinner-grey.gif" /></center>';
        return $loading_img;
    }

    public function getTimeSlots($i)
    {
        $timesArr = array(
             '0' => "00:00 AM",
             '1' => "01:00 AM",
             '2' => "02:00 AM",
             '3' => "03:00 AM",
             '4' => "04:00 AM",
             '5' => "05:00 AM",
             '6' => "06:00 AM",
             '7' => "07:00 AM",
             '8' => "08:00 AM",
             '9' => "09:00 AM",
             '10' => "10:00 AM",
             '11' => "11:00 AM",
             '12' => "12:00 PM",
             '13' => "01:00 PM",
             '14' => "02:00 PM",
             '15' => "03:00 PM",
             '16' => "04:00 PM",
             '17' => "05:00 PM",
             '18' => "06:00 PM",
             '19' => "07:00 PM",
             '20' => "08:00 PM",
             '21' => "09:00 PM",
             '22' => "10:00 PM",
             '23' => "11:00 PM",
             '24' => "00:00 AM"
            );
        return $timesArr[$i];
    }

    public function getSessionRate($session,$rates_plan)
    {
        $hour_rate = $rates_plan[0]['rate_hour'];
        switch ($session) {
          case '1':
            $discount = $rates_plan[0]['adgust1'];
            break;
          case '3':
            $discount = $rates_plan[0]['adgust2'];
            break;
          case '10':
            $discount = $rates_plan[0]['adgust3'];
            break;
          case '20':
            $discount = $rates_plan[0]['adgust4'];
            break;
          default:
            $discount = "0";
            break;
        }
        $discountBySession = $discount / $session;
        $finalSessionPrice = round($rates_plan[0]['rate_hour'] - $discountBySession,2);
        return $finalSessionPrice;
    }

    public function getHourlyRate($tid)
    {
        $this->conn = ConnectionManager::get('default'); 
        $results = $this->conn->execute('SELECT * FROM `trainer_ratemaster` WHERE `trainer_id` = '.$tid)->fetchAll('assoc');
        if(!empty($results)){
            $hourlyrate = $results[0]['rate_hour'];
        }else{
            $hourlyrate = 0;
        }
        return $hourlyrate;
    }

    public function getCityName($cid)
    {
        $this->conn = ConnectionManager::get('default'); 
        $results = $this->conn->execute('SELECT * FROM `cities` WHERE `id` = '.$cid)->fetchAll('assoc');
        if(!empty($results)){
            $city = $results[0]['name'];
        }else{
            $city = "";
        }
        return $city;
    }


}



?>