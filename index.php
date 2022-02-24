<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../wp-load.php';
require_once __DIR__ . '/mpdf/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style>
h1{margin:20px 20px 0px 0px;}
p{margin:0px; padding:0px;}
a{padding:200px;}
a{margin:30px;}
</style>
</head>
<body>
<img src="https://securecyberid.com/wp-content/uploads/email/logo.png">
<h1>This is a Heading</h1>
<p>This is a paragraph.</p>
<a style="padding:20px;" href="#">Hello</a>
</body>
</html>');

$fileName="email-scan-report-".date("l-d-m-yy-h:i:s-A").".pdf";
$mpdf->Output($fileName, 'I');
$path='/var/www/html/mpdf/pdfs/'.$fileName;
$mpdf->Output($path, 'F');

$to = 'vipinkumar353@gmail.com';
$subject = 'Email subject';
$headers[] = array('Content-Type: text/html; charset=UTF-8');
$headers[] = 'From: Testing <info@example.com>';
$headers[] = 'Cc: info@example.com';
$message='You got a email report pdf. Please check attachments.';
$attachments = array($path);
wp_mail( $to, $subject, $message, $headers, $attachments );
wp_redirect('redirect url');
//$mpdf->Output();
