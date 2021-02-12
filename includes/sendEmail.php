<?php 

    /**
     * The file sendEmail.php along with the file called isEmailOpen.php are 2 
     * files that must be used combined in order to track if users open or not 
     * the emails we requested.This file will be responsible for sending the email 
     * while the isEmailOpen.php will be responsible for updating the database in 
     * case the email is open or not.Basically, each email will receive a unique ID 
     * and whenever the email opens we supposed to call the sEmailOpen.php and do the 
     * action written there in order to track emails.
     */


    require 'autoload.inc.php';

    /**
     * Below are the lines responsible for bringing PHPMailer to this page. 
     * You can use composer to add the required files here.
     * Make sure you can use PHPMailer
     */
    require '../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;

    $userEmail =  $_POST['userEmail'];
    $subject = $_POST['subject'];
    $senderEmail = $_POST['senderEmail'];
    $senderName = $_POST['senderName'];

    
    $fileName = $_POST['fileName'];

    if(file_exists('../email/'.$fileName)){
        $message = file_get_contents('../email/'.$fileName);
    }else{
        $message = $_POST['message'];
    }
    
    $pathTrack = 'https://path To -> isEmailOpen.php';
    $trackCode = md5(time().'__'.rand());
    $messageBody = '<img src="'.$pathTrack.'?trackCode='.$trackCode.'" width="1" height="1" style="display:none"/>';
    $messageBody .= $message;
    

    $mailer = new PHPMailer;
    $mailer->IsSMTP();
    $mailer->Host = '-----';
    $mailer->Port = '587';
    $mailer->SMTPAuth = true;
    $mailer->Username = '------';
    $mailer->Password = '-----';
    $mailer->SMTPSecure = '';
    $mailer->From = $senderEmail;
    $mailer->FromName = $senderName;
    $mailer->AddAddress($userEmail);
    $mailer->WordWrap = 50;
    $mailer->IsHTML(true);
    $mailer->Subject = $subject;
    $mailer->Body = $messageBody;
    
    if($mailer->Send()){
        
        EmailTrack::setMessage($message, $subject,$fileName);
        $dbhStore = new EmailTrack;
        $dbhStore->setUserEmail($userEmail);          
        $dbhStore->setTrackCode($trackCode); 
        $dbhStore->insertEmailTrackDBH();
        unset($dbhStore);      
                
    }else{
        echo 'Error';
    }

    unset($mailer);

    
?>