<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class CustomComponent extends Component
{
    public function fileUploading($name,$subfolder)
    {
        $f_name1 = $_FILES[$name]['name'];
        $f_tmp1 = $_FILES[$name]['tmp_name'];
        $f_size1 = $_FILES[$name]['size'];
        $f_extension1 = explode('.',$f_name1); 
        $f_extension1 = strtolower(end($f_extension1)); 
        $f_newfile1="";
        if($f_name1){
        $f_newfile1 = uniqid().'.'.$f_extension1; 
        $store1 = "uploads/".$subfolder."/". $f_newfile1;
        $image2 =  move_uploaded_file($f_tmp1,$store1);
        }
        return $f_newfile1;
    }

    public function getSessionData()
    {
        $session = $this->request->session();
        $user_data = $session->read('Auth.User');
        return $user_data;
    }

    public function deleteFile($fileName,$folderName)
    {
        $path =   "uploads/".$folderName."/".$fileName;
        unlink($path);
    }

    public function downloadFile($file)
    {
        if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
        }
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

    public function getlatlng($address)
    {
        $loc = array();
        $loc["latitude"] = "";
        $loc["longitude"] = "";
        $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
        $geo = json_decode($geo, true);
        if ($geo['status'] = 'OK') {
          $loc["latitude"] = $geo['results'][0]['geometry']['location']['lat'];
          $loc["longitude"] = $geo['results'][0]['geometry']['location']['lng'];
        }
        return $loc;
    }

    public function getlatlngbyip()
    {
        $ip = $_SERVER['REMOTE_ADDR']; // the IP address to query
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'));
        return $query;
    }
}

?>