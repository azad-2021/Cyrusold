<?php


include('connection.php'); 
include 'session.php';
$card = base64_decode($_GET['cardno']);

$fileImg='/technician/jobcard/'.$card.'.jpg';
$fileImg2='/technician/jobcard/'.$card.'.jpeg';
$filePdf='/technician/jobcard/'.$card.'.pdf';
//echo $fileImg;
if(file_exists($fileImg)){
    echo 'exist';
    header("location:$fileImg");
}elseif (file_exists($filePdf)) {
    // code...
    header("location:$filePdf");
}elseif(file_exists($fileImg2)){
    echo 'exist';
    header("location:$fileImg2");
}


?>
