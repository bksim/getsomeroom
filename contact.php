<?php

// Contact subject
$subject =$_POST['subject']; 

// Details
$message=$_POST['detail'];

// Mail of sender
$mail_from=$_POST['customer_mail']; 

$name = $_POST['name'];
// From 
$header="from: '$name' <'$mail_from'>";

// Enter your email address
$to ='bsim@college.harvard.edu';
$send_contact=mail($to,$subject,$message,$header);

// Check, if message sent to your email 
// display message "We've recived your information"
if($send_contact){
echo "We've recived your contact information";
}
else {
echo "ERROR";
}

?>