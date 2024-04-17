<?php
function send_email($first_name,$subject,$user_email){
	//echo 'rgrtgetgtgtr';
$from='erik@engageonline.com.au';
require_once('wp-load.php'); 
global $wpdb;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$from."\r\n".
	'Reply-To: '.$from."\r\n" .
	'X-Mailer: PHP/' . phpversion();
$message='<html>
			<head>
				<meta charset="utf-8"> 
				<meta name="viewport" content="width=device-width"> 
				<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
				<meta name="x-apple-disable-message-reformatting"> 
			   

				<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
			</head>

		<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;font-family: "Lato", sans-serif;font-weight: 400;font-size: 15px;line-height: 1.8;">
			<center style="width: 100%; background-color: #f1f1f1;">
				<div style="max-width: 600px; margin: 0 auto;">
				   
					<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
						<tr>
							<td valign="middle" style="padding: 2em 0 0 0;background: #fff">
								<img src="'.get_stylesheet_directory_uri().'/assets/images/giphy.gif" alt="" style="width: 100px; max-width: 600px; height: auto; margin: auto; display: block;">
							</td>
						</tr>
						<tr>
							<td valign="top" style="background: #fff! important">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tr>
										<td class="logo" style="text-align: center;">
											<h3>Thank you for signing up!<br><span>Please click the following link to activate your account.</span></h3>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<td valign="middle" style="padding: 2em 0;background: #fff;border-bottom: 2px solid #efefef;" >
								<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
									<tr>
										<td>
											<div class="text" style="padding: 0 2.5em; text-align: center;">
												<div style="padding: 10px 0 50px 0;text-align: center;"><a href="{account_activation_link}" style="background: #555555;color: #fff;padding: 12px 30px;text-decoration: none;border-radius: 3px;letter-spacing: 0.3px;">Activate your Account</a></div>
												
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;text-align: center;">
						<tr>
							<td valign="middle" style="background: #fff;padding-top:20px">
								<h4 style="margin: 0">&copy; '.date("Y").'  BEESmart</h4>
								
							</td>
						</tr>
						
						<tr>
							<td style="text-align: center;background: #fff;padding-bottom: 30px;">
								<p><a href="'.site_url().'" style="color: #000;text-decoration: none;">Beesmart |</a><a href="'.site_url().'/support" style="color: #000;text-decoration: none;"> Contact us |</a><a href="'.site_url().'/privacy-policy" style="color: #000;text-decoration: none;"> Privacy Policy</a></p>
							</td>
						</tr>
					</table>

				</div>
			</center>
		</body>

</html>';

mail($user_email, $subject, $message, $headers);

}