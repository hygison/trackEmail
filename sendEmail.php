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


    require 'includes/autoload.inc.php';

    /**
     * Below are the lines responsible for bringing PHPMailer to this page. 
     * You can use composer to add the required files here.
     * Make sure you can use PHPMailer
     */
    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;

    //Path to the file isEmailOpen.php Full path!
    $pathTrack = 'https://path To  isEmailOpen.php';

    $userEmail =  'user@gmail.com';
    $subject = 'Email Subject';
    $senderEmail = 'info@example.com';
    $senderName = 'Sender Name';

    // HTML TEMPLATE EMAIL
    $fileName = 'email.html';
    $message = file_get_contents('email/'.$fileName);

    

    $trackCode = md5(time().'__'.rand());
    $messageBody = '<img src="'.$pathTrack.'?trackCode='.$trackCode.'" width="1" height="1" style="display:none"/>';
    $messageBody .= $message;
    

    $mailer = new PHPMailer;
    /**
     * To remove SMTP remove the next 7 lines of code 
     */
    
    $mailer->IsSMTP();
    $mailer->Host = 'check with your server -> email-smtp.us-east-1.amazonaws.com';
    $mailer->Port = '587 -> check with the server';
    $mailer->SMTPAuth = true;
    $mailer->Username = '';
    $mailer->Password = '';
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
        echo '<p style="background:red; color:white; padding: 5px 5px;">Error: Mail Functil Error</p>';
    }

    unset($mailer);

?>