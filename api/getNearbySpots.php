<?php 
 
 date_default_timezone_set("Asia/Kolkata");

 $city=$_GET['city'];
 //Importing database
 require_once('dbConnect.php');

 if(!empty($city))
 {
 	 if($city=='All Cities')
 	 {
 	 	$sql="SELECT * FROM  spots";
 	 }else
 	 {
 	 	$sql="SELECT * FROM spots where city='".$city."'";
 	 }
 	 
 	
 }
 else
 {
 	$sql="SELECT * FROM  spots";
 	
 }
 // echo "http://" . $_SERVER['SERVER_NAME'];exit;
 //getting result 
 $r = mysqli_query($con,$sql);
 // print_r($r);exit;
 //pushing result to an array 
 $result = array();

 while($row = mysqli_fetch_array($r)){ 
 	// Fetch Working Hours
 	$spotId = $row['spotId'];
 	$dayInText = date("D");
	array_push($result,array(
		"admin_id"=>$row['admin_id'],
		"city"=>$row['city'],
		"spotId"=>$row['spotId'],
		"trending"=>$row['trending'],
		"name"=>$row['name'],
		"image"=>'http://'.$_SERVER['SERVER_NAME'].'/Restaurant/uploads/'.$row['image'],
		"rating"=>$row['rating'],
	 	"lat"=>$row['lat'],
		"lng"=>$row['lng'],
		"location"=>$row['address'],
		"cuisines"=>$row['cuisines'],
		"priceLevel"=>$row['priceLevel'],
		"cost"=>$row['cost'],
		"openStatus"=>$row['openStatus'],
		"openingTime"=>$row['openingTime'],
		"closingTime"=>$row['closingTime'],
		"phone"=>$row['phone'],
		"address"=>$row['address'],
		"imageList"=>explode(",", $row['imageList']),
		"amenities"=>explode(",", $row['amenities']),
		"verified"=>$row['verified'],
		"distance"=>$row['distance']
	 ));
 }
//  print_r($result);exit;
 //displaying in json format 
 echo json_encode(array('time'=>(date("H").(":").date("i").(" ").date("d").("-").date("m").("-").date("Y")),'spots'=>$result));
 
 mysqli_close($con);