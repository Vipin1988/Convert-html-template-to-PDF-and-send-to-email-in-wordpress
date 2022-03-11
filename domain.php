<?php
if($_POST['domain'] && $_POST['email']){
	include '../wp-load.php';
	require_once __DIR__ . '/mpdf/vendor/autoload.php';
	$mpdf = new \Mpdf\Mpdf();
	$upload_dir = wp_upload_dir();
	$url_base 		= "https://api.dynarisk.net/";
	$access_token = token();
	$url 			= $url_base . 'breach/api/v1/report/domain-ex';
	$query_domain	= $_POST['domain'];
	$upload_dir = wp_upload_dir();
	$bodyString = '{"domain":"' . $query_domain . '"}';

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

	$responseBody	= json_decode(wp_remote_retrieve_body($response));

	$urls 			= $url_base . 'breach/api/v1/broker/scan/domain';
	$response = wp_remote_post( $urls, array(
		'method' => 'POST',
		'timeout' => 45,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array('content-type' => 'application/json', 'Authorization' => 'Bearer ' . $access_token),
		'body' => $bodyString,
		'cookies' => array()
	));

	$responseResult	= json_decode(wp_remote_retrieve_body($response));
	$nos = $responseResult->results->no_unique_breaches;
	//print_r($nos); die;
	$count=0;
	if(count($responseBody->results) > 0){ 

			$output = [];
			foreach ($responseBody->results as $info){
					$output[] = $info->leak_name;
			}
			
			$emails = [];
			foreach ($responseBody->results as $info){
					$emails[] = $info->email;
			}
			foreach(array_count_values($output) as $key => $value) {
				$count += $value;
			}

		}

$data = '<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link href="http://fonts.cdnfonts.com/css/proxima-nova-2?styles=44818,44819,44822,44823,44817,44816,44820,44821,44812,44813,44814,44815,44810,44811" rel="stylesheet">
<style>
p, h2, ul li {font-family: "Proxima Nova", sans-serif;}
 @page {
        margin:20px 0px;
    }
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
		 <img src="'.$upload_dir["baseurl"].'/email/logo-new.png" style=" width:50%;">
	</div>
	<div class="text" style="margin: 20px 0 0 0; padding:30px 40px 20px 40px">
											
											<h2 style="color:#1e7db4; text-align:center; font-size:30px; margin:0px; margin-bottom:20px;">INTRODUCTION</h2>
											<h2 style="font-size:30px; color:#1e7db4; margin:0px; padding-bottom:20px;">Welcome</h2>
											<p style=" font-size: 18px; color:#001e2e; margin:0px; padding-bottom:15px;">Our security operations team has discovered over 30 billion pieces of data stolen and leaked
											from hundreds of hacking forums, communities, and chat rooms on the Dark Web. The
											information stolen is highly sensitive and can include email addresses, usernames, passwords,
											password reset hints, credit card numbers, physical addresses, Dates of Birth, and more.</p>
				
											<p style=" font-size: 18px; color:#001e2e; margin:0px; padding-bottom:15px;">We also have over 250 million records in cyber criminals actively mentioning companies that
											are targeting what we call <i>“Hacker Chatter”</i>.</p>
				
											<p style=" font-size: 18px; color:#001e2e; margin:0px; padding-bottom:15px;">After searching our database, we’ve discovered 
											that:</p>
											<ul style="font-size: 18px;margin: 0px 0px 16px 0px;color: #88c147;padding: 0px 0px 0px 30px;">
											<li>'.$nos.' staff have been exposed '.$count.'  times in '.$nos.' separate data breaches.</li>
											<li>'.$query_domain.' has also been mentioned '.$count.' times by cyber criminals planning or executing attacks against the business and there have been vulnerabilities discovered.</li>
											</ul>
											
											<p style="font-size:18px; color:#001e2e; margin:10px 0px 0px 0px; padding-bottom:15px;">Using this information, cyber criminals could target your company in several ways from wire
											transfer fraud to holding data for ransom.</p>
										</div>
										
										<div class="text" style="padding:10px 40px 55px 40px">
												
											
												<h2 style="color:#1e7db4; font-size:26px; margin:0px; margin-bottom:10px; ">TABLE OF CONTENTS</h2>
												<ul style="padding:0px; margin:0px;">
												<li style="color:#001e2e; font-size:16px; list-style:none; padding-bottom: 8px;">Types of information at risk</li>
													<li style="color:#001e2e; font-size:16px; list-style:none;     padding-bottom: 8px;">Affected staff </li>
													<li style="color:#001e2e; font-size:16px;     padding-bottom: 8px; list-style:none;"> Data breach summary </li>
													<li style="color:#001e2e; font-size:16px; padding-bottom: 8px;  list-style:none;"> Leaked data </li> 
													
													
													<li style="color:#001e2e; padding-bottom: 8px; font-size:16px; list-style:none;"> 	What you should do next </li>
													<li style="color:#001e2e; padding-bottom: 8px;font-size:16px; list-style:none;"> 	Risks your company is exposed to </li>
												</ul>
				
												
											</div>
										
										
									
										<h2 style="color:#1e7db4;text-align:center;font-size:26px; margin:0px; margin-bottom:20px;  padding:0px 40px 20px 40px">TYPES OF INFORMATION AT RISK</h2>
											<table style="margin:0px 0px 50px 80px; width:100%;     border-spacing: 0 !important; border-collapse: collapse !important;">
													<tr>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline;"> <img src="https://securecyberid.com/32.png" style=" width:4%; margin: 0 6px 0 0;"></span> Username</td>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline; margin-right: 6px;">  <img src="https://securecyberid.com/32.png" style=" margin: 0 6px 0 0; width:4%;"></span> Other personal information</td>
													</tr>
													<tr>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline; margin-right: 6px;">  <img src="https://securecyberid.com/32.png" style=" margin: 0 6px 0 0; width:4%;"></span> Email address</td>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline; margin-right: 6px;">  <img src="https://securecyberid.com/32.png" style=" margin: 0 6px 0 0; width:4%;"></span> Gender</td>
													</tr>
													<tr>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline; margin-right: 6px;">  <img src="https://securecyberid.com/32.png" style=" margin: 0 6px 0 0; width:4%;"></span> Password</td>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline; margin-right: 6px;">  <img src="https://securecyberid.com/32.png" style=" margin: 0 6px 0 0; width:4%;"></span> Address</td>
													</tr>
													<tr>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline; margin-right: 6px;">  <img src="https://securecyberid.com/32.png" style=" margin: 0 6px 0 0; width:4%;"></span> Security question</td>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline; margin-right: 6px;">  <img src="https://securecyberid.com/32.png" style=" margin: 0 6px 0 0; width:4%;"></span> Country</td>
													</tr>
													<tr>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline; margin-right: 6px;">  <img src="https://securecyberid.com/32.png" style=" margin: 0 6px 0 0; width:4%;"></span> Credit card information</td>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline; margin-right: 6px;">  <img src="https://securecyberid.com/32.png" style=" margin: 0 6px 0 0; width:4%;"></span> City</td>
													</tr>
													<tr>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline; margin-right: 6px;">  <img src="https://securecyberid.com/32.png" style=" margin: 0 6px 0 0; width:4%;"></span> IP address</td>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline; margin-right: 6px;">  <img src="https://securecyberid.com/32.png" style=" margin: 0 6px 0 0; width:4%;"></span> ID number</td>
													</tr>
													<tr>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline; margin-right: 6px;">  <img src="https://securecyberid.com/32.png" style=" margin: 0 6px 0 0; width:4%;"></span> Phone number</td>
														<td style="color:#000; padding:6px 8px;"><span style="color:#f00; font-size:27px; vertical-align: baseline; margin-right: 6px;">  <img src="https://securecyberid.com/32.png" style=" margin: 0 6px 0 0; width:4%;"></span> Birthday</td>
													</tr>
											</table>
											
											
												<h2 style="color:#1e7db4; font-size:26px; margin:0px; margin-bottom:20px;  padding:0px 0px 0px 40px;">AFFECTED STAFF</h2>
												<p style="color:#001e2e;   padding:0px 0px 0px 40px;font-size: 16px;">We have discovered information relating to the following staff… </p>
												
												<div style="text-align:center;">
												<table class="affected_staff_data" style="margin:0 0 20px 45px; width:95%;     border-spacing: 0 !important; border-collapse: collapse !important;">
													<tr>
														<th style="border: 1px solid #001e2e; background-color:#001e2e; color:#fff; padding:6px 8px;">Email</th>
														
														<th style="border: 1px solid #001e2e; background-color:#001e2e; color:#fff; padding:6px 8px;"> Leak description</th>
														<th style="border: 1px solid #001e2e; background-color:#001e2e; color:#fff; padding:6px 8px;"> Leak name</th>
														</tr>';
													
														foreach($responseBody->results as $row){
				
															$data .='<tr>
																<td style="border: 1px solid #001e2e; padding:6px 8px; color:#57a022">'.$row->email.'</td>
																							
																<td style="border: 1px solid #001e2e; padding:6px 8px; color:#57a022;">'.$row->leak_description.'</td>
																<td style="border: 1px solid #001e2e; padding:6px 8px; color:#57a022;">'.$row->leak_name.'</td>
																</tr>';
																}
		
														
														$data .='</table>
												</div>
												
											
												<h2 style="color:#1e7db4; font-size:26px; margin:0px; margin-bottom:20px;  padding:0px 0px 0px 40px;">DATA BREACH SUMMARY</h2>
												<table class="affected_staff_data data_breach_summary" style="margin:0 0 20px 45px; width:95%; border-spacing: 0 !important; border-collapse: collapse !important; font-size: 16px; font-weight: 400;">
													<tr style="background-color:#001e2e;">
														<th style="border:1px solid #001e2e;background-color:#001e2e;color:#fff;padding:6px 8px;font-weight: 400;">Data breach/leak name</th>
														<th style="border:1px solid #001e2e;background-color:#001e2e;color:#fff;padding:6px 8px;font-weight: 400;"> Number of leaks</th>
													</tr>
													
													
													</tr>';
													$count=0;
													foreach(array_count_values($output) as $key => $value) {
														$count += $value;
															$data .='<tr>
															<td style="border:1px solid #001e2e;color:#57a022;padding:6px 8px;">'.$key.'</td>
															<td style="border:1px solid #001e2e;color:#57a022;padding:6px 8px;">'.$value.'</td>
														</tr>';
															
														}
														
														$data .='<tr style="background-color:#001e2e">
															<td style="color:#fff;">Total</td>
															<td style="color:#fff;">'.$count.'</td>
														</tr>';
													
												
				
										$data .='</table>
				
											
													<h2 style="color:#1e7db4; font-size:26px; margin:0px; margin-bottom:20px;  padding:0px 0px 0px 40px;">DATA BREACH SUMMARY</h2>
				
												<table class="affected_staff_data data_breach_summary"  style="margin:0 0 20px 45px; width:95%;border-spacing: 0 !important; border-collapse: collapse !important; font-size: 16px; font-weight: 400;">
										<tr style="background-color:#001e2e;">
											<th style="border:1px solid #001e2e;background-color:#001e2e;color:#fff;padding:6px 8px;font-weight: 400;">Data breach/leak</th>
											<th style="border:1px solid #001e2e;background-color:#001e2e;color:#fff;padding:6px 8px;font-weight: 400;">Description</th>
										</tr>
										</tr>';
	
										foreach($responseBody->results as $row){
			
											$data .='
											<tr>
											<td style="border:1px solid #001e2e;color:#57a022;padding:6px 8px;">
												<strong style="color:#57a022; font-weight:700;"> '.$row->leak_name.' </strong> 
											</td>
											<td style="border:1px solid #001e2e;color:#57a022;padding:6px 8px;">
												<p style="font-size:14px; color:#57a022;">'.$row->leak_description.'  </p>
											</td>
										</tr>';
												}
										$data.='  					
										
									</table>
									
									
									<div class="column_heading" style="margin:0 45px 20px 45px;">
									
													<h2 style="color:#1e7db4; font-size:26px; margin:0px; margin-bottom:20px;  ">Leaked Data</h2>
													<p style="font-size:14px; color:#001e2e;">The following are stolen username & password combinations and other data records we fond for company accounts. They may be re-used on other websites, putting the company at risk of fraud, ransom and sophisticated social engineering scams. </p>
												</div>
				
												<table class="affected_staff_data data_breach_table leaked-data"  style="margin:0 0 20px 45px; width:95%;border-spacing: 0 !important; border-collapse: collapse !important; font-size: 16px; font-weight: 400;">';
													
												foreach(array_count_values($emails) as $key => $value) {
		
													$data .='<tr style="background-color:#e2efda;">
													<td style="font-size:14px; color:#001e2e; border-top:1px solid #a9d08e; border-bottom:1px solid #a9d08e; padding:6px 6px;">'.$key.'</td>
												</tr>';
														}
																			
												$data .='</table>
				
												<div class="tb_common_content" style="margin:0 45px 20px 45px;">
													<h2 style="margin:30px 0px 0px 0px; font-size:26px; color:#1e7db4; padding-bottom:20px;">WHAT YOU SHOULD DO NEXT </h2>
				
													<ul style="margin:0px 0px 30px 0px; padding:0px 0px 0px 20px;">
														<li style="color:#001e2e; font-weight:400; font-size:16px; list-style: decimal; padding-bottom:10px;">Contact your affected staff and ask them to check to see if they use any of this information</li>
														<li style="color:#001e2e; font-weight:400; font-size:16px; list-style: decimal; padding-bottom:10px;">Staff should change passwords, request credit cards get replaced, change security challenge questions and other actions to address the leaked data
														 </li>
														<li style="color:#001e2e; font-weight:400; font-size:16px; list-style: decimal; padding-bottom:10px;"> For companies with managed IT service providers, contact them and ask if they can automatically check your systems to see if these passwords are in use. </li> 
														<li style="color:#001e2e; font-weight:400; font-size:16px; list-style: decimal; padding-bottom:10px;">Implement additional security measures such as two-step verification, anti-virus, frequent software updates, penetration testing, vulnerability scanning, hacker chatter monitoring, backups and other controls. </li>
													</ul>
												</div>
				
												
				
												<div class="tb_common_content" style="margin:0 45px 20px 45px;">
													
				<h2 style="color:#1e7db4; font-size:26px; margin:0px; margin-bottom:20px;">RISKS YOUR COMPANY IS EXPOSED TO</h2>
													<ul style="margin:0px 0px; padding:0px 0px 0px 20px;">
														<li style="font-size:16px; color:#001e2e; list-style:decimal; padding-bottom:8px;">Wire transfer fraud also known as CEO Fraud or Business Email Compromise (BEC)</li>
														<li style="font-size:16px; color:#001e2e; list-style:decimal; padding-bottom:8px;">Theft of intellectual property </li>
														<li style="font-size:16px; color:#001e2e; list-style:decimal; padding-bottom:8px;"> Disruption of business activities </li> 
														<li style="font-size:16px; color:#001e2e; list-style:decimal; padding-bottom:8px;">Ransom </li>
														<li style="font-size:16px; color:#001e2e; list-style:decimal; padding-bottom:8px;">Extortion </li>
														<li style="font-size:16px; color:#001e2e; list-style:decimal; padding-bottom:8px;">Regulatory fines under Data Protection Regulations such as GDPR </li>
													</ul>
												</div>
				
												<div class="tb_common_content" style="margin:0 45px 20px 45px;">
												
				<h2 style="color:#1e7db4; font-size:24px; margin:0px; margin-bottom:20px;">HOW CRIMINALS COULD TARGET YOUR COMPANY</h2>
													<!--<h6 style="margin:0px 0px 20px 0px; font-size:14px; font-weight:900; color:#57a022;">WIRE FRAUD </h6>-->
													<h6 style="color:#57a022; font-size:14px; margin:0px; margin-bottom:20px;">WIRE FRAUD</h6>
													<p style="font-size:14px; color:#001e2e; padding-bottom:15px;">Using stolen passwords to log into staff email accounts, criminals could conduct wire fraud. </p>
				
													<h6 style="color:#57a022; font-size:14px; margin:0px; margin-bottom:20px;">SOCIAL ENGINEERING SCAMS </h6>
													<p style="font-size:14px; color:#001e2e; padding-bottom:15px;">Criminals could send your employees scam emails designed to steal login details for sensitive company systems, allowing them to steal intellectual property. </p>
			
													<h6 style="color:#57a022; font-size:14px; margin:0px; margin-bottom:20px;">SURVEILLANCE </h6>
													<p  style="font-size:14px; color:#001e2e; padding-bottom:15px;">Criminals may use stolen email addresses to stalk your executives and key staff on social media, giving them points of reference to use in intelligent scams </p>
				
													<h6 style="color:#57a022; font-size:14px; margin:0px; margin-bottom:20px;">DISTRIBUTING MALWARE </h6>
													<p  style="font-size:14px; color:#001e2e; padding-bottom:15px;">Using staff emails a criminal would be able to send scam emails to trick staff into clicking links or downloading files that contain malware including ransomware. Ransomware locks down your systems and limits access to all data until a ransom is paid. </p>
													
												</div>
												
												
												
			
	    
						   <div style="height:35px; border-radius:3px; width:50%; margin:0 auto; background-color:#de791c; padding-top:8px;display:inline-block; text-align:center;" id="btn-id">
   <a style="color: #fff; line-height:35px; display:block; padding: 10px 30px; font-size: 18px;text-decoration: none;" href="https://securecyberid.com/product/breach-defense/?scroll=1" target="_blank">Start Protecting Your Business Now</a>
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
</html>';
//wp_mail( 'vipin.kumar@resourici.com', 'testing', 'hello');
//echo $data; die;
$mpdf->WriteHTML($data);

$fileName="domain-scan-report-".date("l-d-m-yy-h:i:s-A").".pdf";
$mpdf->Output($fileName, 'I');
$path='/www/sites/securecyberid.com/public_html/mpdf/pdfs/'.$fileName;
$mpdf->Output($path, 'F');

$to = 's.ravichandran@resourcifi.com';
$subject = 'Domain Scan Report';
$headers[] = array('Content-Type: text/html; charset=UTF-8');
$headers[] = 'From: Secure Cyber360 <info@securecyberid.com>';
$headers[] = 'Cc: wlynch@securecyberid.com';
//$headers[] = 'Cc: vipin.kumar@resourcifi.com';				
$message='You got a domain report pdf. Please check attachments.';
$attachments = array($path);
$status = wp_mail( $to, $subject, $message, $headers, $attachments ); 
//die;
wp_redirect('https://securecyberid.com/domain-scanner/?msg=1');
//$mpdf->Output();
}else{
   echo "Unauthorized access.";
}

//$mpdf->Output();
