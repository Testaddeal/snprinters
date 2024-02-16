<?php
include('database.inc.php');
$msg="";
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['comment'])){
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
	$comment=mysqli_real_escape_string($con,$_POST['comment']);
	
	mysqli_query($con,"insert into contact_us(name,email,mobile,comment) values('$name','$email','$mobile','$comment')");
	$msg="Thanks for showing an interest.";

    $html = "
    <table style='border-collapse: collapse; width: 400px; background-color: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); margin-top: 20px;'>
        <tr>
            <td style='border: 1px solid #ddd; padding: 12px; text-align: left;'><strong>Name :</strong></td>
            <td style='border: 1px solid #ddd; padding: 12px; text-align: left;'>$name</td>
        </tr>
        <tr>
            <td style='border: 1px solid #ddd; padding: 12px; text-align: left;'><strong>Email :</strong></td>
            <td style='border: 1px solid #ddd; padding: 12px; text-align: left;'>$email</td>
        </tr>
        <tr>
            <td style='border: 1px solid #ddd; padding: 12px; text-align: left;'><strong>Mobile :</strong></td>
            <td style='border: 1px solid #ddd; padding: 12px; text-align: left;'>$mobile</td>
        </tr>
        <tr>
            <td style='border: 1px solid #ddd; padding: 12px; text-align: left;'><strong>Message :</strong></td>
            <td style='border: 1px solid #ddd; padding: 12px; text-align: left;'>$comment</td>
        </tr>
    </table>
    ";
	
	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="soheladdeal@gmail.com";
	$mail->Password="jsvl hqjq tqxm tenm";
	$mail->SetFrom("soheladdeal@gmail.com");
	$mail->addAddress("soheladdeal@gmail.com");
	$mail->IsHTML(true);
	$mail->Subject="New Contact Us";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
		// echo "Mail send";
	}else{
		// echo "Error occur";
	}
	// echo $msg;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Sent</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        button a {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Sent Successfully.</h1>
    <button><a href="index.php">Go to Homepage</a></button>
</body>
</html>