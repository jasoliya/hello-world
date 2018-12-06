<?php
 
	$GroupPrivateToken="c23b6530-ea60-424a-86e2-f55501e4a907";
	$email=$_POST['email'];
	$name=$_POST['name'];
	$lname=$_POST['lname'];
	$add=$_POST['add'];
	$city=$_POST['city'];
	$country=$_POST['country_sel'];
	$zipcode=$_POST['zipcode'];
	
	$data = array(
		        "GroupPrivateToken" => $GroupPrivateToken,
		        "Items" => array(array(
		            "Id" => 0,
		            "Quantity" => 1,
		            "UnitPrice" => 0,
		            "Description" => "ציפית לתינוק"
		        ),array(
		            "Id" => 0,
		            "Quantity" => 1,
		            "UnitPrice" => 27, 
		            "Description" => "משלוח"
		        )),
			  "Custom2" => $email,
			  "Custom4" => $country,
			  "RedirectURL" => "https://www.ndoto.co.il/pages/thank-you/",
			  "IPNURL" => "www.example.com/ipn.php",
			  "EmailAdress" => $email,
			  "CustomerLastName" => $lname,
			  "CustomerFirstName" =>$name,
			  "Address" =>$add,
			  "City" => $city,
			  "Zipcode" => $zipcode
	    	);

	$url = "https://testicredit.rivhit.co.il/API/PaymentPageRequest.svc/GetUrl";
	$post = json_encode($data); 
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$result = curl_exec($ch);
	curl_close($ch);

	$url_to_view = json_decode($result)->URL;
	$resp['status'] = "success";
        $resp['url'] = $url_to_view;  
	echo json_encode($resp);//Return URL, That load in I-fram in store
?>
