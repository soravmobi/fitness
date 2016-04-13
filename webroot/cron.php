<?php
$to = "soravgarg123@gmail.com";
		$subject = "My subject";
		$txt = "Hello world! cron.php";
		$headers = "From: soravgarg123@gmail.com" . "\r\n" .
		"CC: soravgarg123@gmail.com";
		mail($to,$subject,$txt,$headers);
		die;
echo date('Y-m-d H:i:s');die;
if($_SERVER['SERVER_NAME'] == "localhost"){
	$servername = "localhost";
	$username   = "root";
	$password   = "";
	$dbname     = "fitness";
}else{
	$servername = "localhost";
	$username   = "virtuds6_fitness";
	$password   = "H+sLTUp%5rzD";
	$dbname     = "virtuds6_fitness";
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = 'SELECT *,`a`.`id` AS `app_id` FROM `appointments` AS `a` INNER JOIN `trainees` AS `t` ON `a`.`trainee_id` = `t`.`user_id` INNER JOIN `trainers` AS `t1` ON `a`.`trainer_id` = `t1`.`user_id` WHERE `a`.`trainer_status` = 0 AND `a`.`trainee_status` = 0 AND `a`.`created_date` >= DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY `a`.`id` DESC';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	
    while($row = $result->fetch_assoc()) {
       	$arr[] = $row;
    }
} else {
    $arr = array();	
}
echo "<pre>";
print_r($arr);
die;