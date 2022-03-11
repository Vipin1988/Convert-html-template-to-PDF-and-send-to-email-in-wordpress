<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/mpdf/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<style>
h1{margin:20px 20px 0px 20px;}
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
ob_start();
ob_end_flush();
$fileName="email-scan-report-".date("l-d-m-yy-h:i:s-A").".pdf";
$mpdf->Output($fileName, 'I');
$path='/var/www/html/mpdf/pdfs/'.$fileName;
$mpdf->Output($path, 'F');

//$mpdf->Output();
