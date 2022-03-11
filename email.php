<?php
if($_GET['reportEmail']){
include '../wp-load.php';
require_once __DIR__ . '/mpdf/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

   $url_base 		= "https://api.dynarisk.net/";
	$access_token = token();
   $query_email=$_GET['reportEmail'];
	if ( strpos($query_email, '@') ) {
		$url 			= $url_base . 'breach/api/v1/broker/scan/email';
      $bodyString = '{"email":"' . $query_email . '"}';
      $response = wp_remote_post( $url, array(
         'method' => 'POST',
         'timeout' => 45,
         'redirection' => 5,
         'httpversion' => '1.0',
         'blocking' => true,
         'headers' => array('content-type' => 'application/json', 'Authorization' => 'Bearer ' . $access_token),
         'body' => $bodyString,
         'cookies' => array()
      ));
   
		$responseData	= json_decode(wp_remote_retrieve_body($response));
   }

$mpdf->WriteHTML('<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link href="http://fonts.cdnfonts.com/css/proxima-nova-2?styles=44818,44819,44822,44823,44817,44816,44820,44821,44812,44813,44814,44815,44810,44811" rel="stylesheet">
<style>
p, h2, ul li {font-family: "Proxima Nova", sans-serif;}
p{
	
}
h2{
	margin-bottom:0px;
}
</style>
</head>
<body>
<div class="pdf-creater">
	<div class="logo" style="text-align:center;">
		 <img src="https://securecyberid.com/wp-content/uploads/email/logo-email.png" style=" width:50%;">
	</div>
	<hr style="border-color: #1e7db414;    margin: 20px 0px 0px 0px;" />
	   <h2 style="color:#1e7db4;text-align:center;font-size:30px;">EMAIL DATA BREACH REPORT</h2>
	   <p style="color:#001e2e; font-size: 18px; margin: 5px 0px 0px 0px;">We have checked your email address against our proprietary database which contains over 30 billion stolen and leaked records.</p>
	   <p style="color:#001e2e; font-size: 18px;"><b>Email address scanned: </b>'.$query_email.' </p>
	   <p style="color:#de791c;font-weight:bold;">Status: Vulnerable</p>
	   <hr style="border-color: #1e7db414;    margin: 0px 0px 0px 0px;" />
	   <h2 style="color:#1e7db4; font-size:30px; margin:0px; margin-top:30px;">YOUR RESULTS</h2>
	   <p  style="margin: 10px 0px 0px 0px; font-size: 18px;" >Your information has been breached or leaked '.$responseData->results->no_unique_breaches.' times. </p>
	   <p style="margin: 0px 0px 10px 0px; font-size: 18px;">60% of people we scan receive a positive result and we are consistently adding new records to our database, meaning your information may appear in new breaches and leaks over time.</p>
	    <hr style="border-color: #1e7db414;    margin: 20px 0px 20px 0px;" />
	   <h2 style="color:#1e7db4; font-size:30px; margin:0px 0px 10px 0px;">RISKS YOU ARE EXPOSED TO</h2>
	    <table style="margin-bottom:50px !important;width:100%;text-align: left;" cellpadding="35" border="1">
                              <tr>
                                 <th style="border:1px solid #001e2e;color:#57a022;padding:6px 8px;font-size: 18px;">Fraud</th>
                                 <td style="border:1px solid #001e2e;color:#57a022;padding:6px 8px; font-size: 18px;">Wire transfer fraud and identity theft can cost thousands.</td>
                              </tr>
                              <tr>
                                 <th style="border:1px solid #001e2e;color:#57a022;padding:6px 8px; font-size: 18px;">Viruses</th>
                                 <td style="border:1px solid #001e2e;color:#57a022;padding:6px 8px; font-size: 18px;">Viruses can steal your account details from social media platforms, shopping sites, banks and more. Criminals can then takeover these accounts and pretend to be you.</td>
                              </tr>
                              <tr>
                                 <th style="border:1px solid #001e2e;color:#57a022;padding:6px 8px; font-size: 18px;">Cyber Ransom</th>
                                 <td style="border:1px solid #001e2e;color:#57a022;padding:6px 8px;font-size: 18px;">Ransomware is on the rise. Would you know what to do if your family photos or sensitive financial documents were withheld until a ransom is paid? </td>
                              </tr>
                              <tr>
                                 <th style="border:1px solid #001e2e;color:#57a022;padding:6px 8px;font-size: 18px;">Data Privacy </th>
                                 <td style="border:1px solid #001e2e;color:#57a022;padding:6px 8px;font-size: 18px;">Unscrupulous advertising companies may use your information for targeted marketing purposes and your email address may be in a database you are completely unaware of, in locations all over the world. </td>
                              </tr>
                           </table>
						     <hr style="border-color: #1e7db414;    margin: 30px 0px 30px 0px;" />
		<h2 style="color:#1e7db4; font-size:30px; margin:5px 0px 0px 0px ;">WHAT TO DO NEXT ?</h2>
                           <p style="font-size: 18px;">Start protecting yourself and your family with Secure Cyber360. While you complete the simple, easy-to-understand personal cyber risk assessment, we’ll conduct a remote vulnerability scan of your device to look for known vulnerabilities that cyber criminals and hackers are known to exploit. </p>
                           <p style="font-size: 18px;">The results will generate your personal Cyber Health & Wellness Score. This score indicates how safe you are online (or not).  More importantly, you’ll then receive a personalized step-by-step action plan for what you need to do to improve your online safety.</p>
                           <p style="font-size: 18px;">We will monitor your details against our database, alerting you if we discover is has been breached or leaked on the Dark Web.</p>
                           <p style="font-size: 18px;">We’ll tell you where your information was stolen from, what vulnerabilities you may have on your devices and we’ll help you protect yourself from scams that can defraud victims out of thousands of pounds </p>
						   <div style="height:35px; border-radius:3px; width:50%; margin:0 auto;background-color:#de791c; padding-top:8px;display:inline-block; text-align:center;" id="btn-id">
   <a style="color: #fff; line-height:35px; display:block; padding: 10px 30px; font-size: 18px;text-decoration: none;" href="https://securecyberid.com/cyber-health-score/?scroll=1" target="_blank">Start Protecting Yourself Now</a>
   </div>
      <hr style="border-color: #1e7db414;    margin: 30px 0px 20px 0px;" />
    <div style="text-align:center;" id="btn-id">
   <h2>Cybersecurity Risk Solutions, LLC (CRS)</h2>
   <p style="margin:0px 0px 2px 0px; font-size:18px;">1090 King George’s Post Road,Suite 603</p>
   <p style="margin:0px 0px 2px 0px; font-size:18px;">Edison, New Jersey 08837</p>
   <p style="margin:0px 0px 2px 0px; font-size:18px;">Phone: (877) 214-4561</p>
   <p style="margin:0px 0px 2px 0px; font-size:18px;">sales@securecyberid.com | www.SecureCyberID.com</p>
   <p style="margin:0px 0px 2px 0px; font-size:18px;">CRS is a StrikeForce Technologies company</p>
					  
</div>
</body>
</html>');
$fileName="email-scan-report-".date("l-d-m-yy-h:i:s-A").".pdf";
$mpdf->Output($fileName, 'I');
$path='/www/sites/securecyberid.com/public_html/mpdf/pdfs/'.$fileName;
$mpdf->Output($path, 'F');

$to = 's.ravichandran@resourcifi.com';
$subject = 'Email Scan Report';
$headers[] = array('Content-Type: text/html; charset=UTF-8');
$headers[] = 'From: Secure Cyber360 <info@securecyberid.com>';
$headers[] = 'Cc: wlynch@securecyberid.com';
//$headers[] = 'Cc: vipin.kumar@resourcifi.com';			
$message='You got a email report pdf. Please check attachments.';
$attachments = array($path);
wp_mail( $to, $subject, $message, $headers, $attachments );
//die;
wp_redirect('https://securecyberid.com/email-scanner/?msg=1');
//$mpdf->Output();
}else{
   echo "Unauthorized access.";
}