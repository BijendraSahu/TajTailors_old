Please wait, It will automatically take you back.<br/>
<?php
session_start();
		$status = $_POST['status'];
		$firstname = $_POST['firstname'];
		$email=$_POST["email"];
		$amount = $_POST['amount'];
		$txnid = $_POST['txnid'];
		$posted_hash = $_POST['hash'];
		$key = $_POST['key'];
		$productinfo = $_POST['productinfo'];
		
		$payable_id = "";
		if(!empty($_POST['payable_id']))
			$payable_id = $_POST['payable_id'];
		
		$payable_type = "";
		if(!empty($_POST['payable_type']))
			$payable_type = $_POST['payable_type'];
		
		$mihpayid = "";
		if(!empty($_POST['mihpayid']))
			$mihpayid = $_POST['mihpayid'];
		
		$phone = "";
		if(!empty($_POST['phone']))
			$phone = $_POST['phone'];
		
		$discount = "";
		if(!empty($_POST['discount']))
			$discount = $_POST['discount'];
		
		$net_amount_debit = "";
		if(!empty($_POST['net_amount_debit']))
			$net_amount_debit = $_POST['net_amount_debit'];
		
		$data = "";
		if(!empty($_POST['$data']))
			$data = $_POST['data'];
		
		$unmappedstatus = "";
		if(!empty($_POST['$unmappedstatus']))
			$unmappedstatus = $_POST['unmappedstatus'];
		
		$salt="x2fGRxrwL7";
		
		
	// Used in Payment PayU controller for status verification
	$_SESSION["Payu_transaction_status"] = $status;
	/////////////////////////
	echo "<b>Following are the transaction details:</b><br/>";
	echo "Transaction status: " . $status . "<br/>";
	echo "Transaction id: " . $txnid . "<br/>";
	echo "Hash: " . $posted_hash . "<br/>";
	echo "key: " . $key . "<br/>";
	echo "Amount: " . $amount . "<br/>";
	/////////////////////////
	if (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
    }
	else {	  
		$retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
	}
	   $hash = hash("sha512", $retHashSeq);
		 
    if ($hash != $posted_hash) 
	{
		// Checksum Failed
	       echo "Invalid Transaction. Please try again";
		  
	}		
	else
	{
		addPayU_TransactionDetails($status,$firstname,$txnid,$email, $payable_id, $payable_type, $mihpayid, $phone, $amount, $discount, $net_amount_debit, $data, $unmappedstatus);
		// Transaction Successful
		if($status == 'success'){
			updatePaymentStatus($_SESSION["UID"], 'PayU', $txnid);	
		}
		
		
	}
function addPayU_TransactionDetails($status, $firstname, $txnid, $email, $payable_id, $payable_type, $mihpayid, $phone, $amount, $discount, $net_amount_debit, $data, $unmappedstatus){
		include('../connect_db.php');
		if(!isset($amount))
			$amount = 0;
		if(!isset($discount))
			$discount = 0;
		if(!isset($net_amount_debit))
			$net_amount_debit = 0;

		$q = "INSERT INTO payu_payments(payable_id,payable_type,txnid,mihpayid,firstname,email,phone,amount,discount,net_amount_debit,data,status,unmappedstatus) VALUES('" .  $payable_id ."','" . $payable_type ."','" . $txnid ."','" .  $mihpayid ."','" . $firstname ."','" . $email ."','" . $phone ."','" . $amount ."','" . $discount  ."','" . $net_amount_debit ."','" . $data ."','" . $status ."','" . $unmappedstatus . "')";
		mysqli_query($con,$q);
}
function updatePaymentStatus($user_id, $gateway, $t_id){
		include('../connect_db.php');
		$q = "UPDATE relations SET PaymentStatus=1,Gateway='" . $gateway . "',t_id='" . $t_id ."' WHERE child_id='" . $user_id . "'";
		mysqli_query($con,$q);
		
		$q = "UPDATE users SET member_type='paid' WHERE id="  . $user_id;
		mysqli_query($con,$q);
}
?>
<script>
function rBck(){
	window.location = 'http://www.connecting-one.com/payu-transaction-completed';
}
setTimeout(rBck, 10000);
</script>