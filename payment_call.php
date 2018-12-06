<?php
 
	$GroupPrivateToken="c23b6530-ea60-424a-86e2-f55501e4a907";
	$email=$_POST['email'];
	$name=$_POST['name'];
	$lname=$_POST['lname'];
	$add=$_POST['add'];
	$city=$_POST['city'];
	//$state=$_POST['state'];
	$country=$_POST['country_sel'];
	$zipcode=$_POST['zipcode'];
	
	$data = array(
		        "GroupPrivateToken" => $GroupPrivateToken,
		        "Items" => array(array(
		            "Id" => 0,
		            //"CatalogNumber" => "SKU",
		            "Quantity" => 1,
		            "UnitPrice" => 0,
		            "Description" => "ציפית לתינוק"
		        ),array(
		            "Id" => 0,
		            //"CatalogNumber" => "SKU",
		            "Quantity" => 1,
		            "UnitPrice" => 27, 
		            "Description" => "משלוח"
		        )),
			  //"Custom1" => "123",
			  "Custom2" => $email,
			  //"Custom3" => $state,
			  "Custom4" => $country,
			  "RedirectURL" => "https://www.ndoto.co.il/pages/thank-you/",
			  "IPNURL" => "https://apps.adexlabs.com/app/billing_upgrade_test/order_csv/ipn.php",
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
	echo json_encode($resp);
?>
