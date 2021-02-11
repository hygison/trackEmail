<?php

    /**
     * Track emails
     * Store on the dbh
     * Update teh dbh
     * Get from dbh
     * 
     * 
     * $fileName is the name of the file we are taking the email. Since I normally use some html template it is normally 
     * smart to store the name of the file as well for future comparison.
     */
    class EmailTrack extends Dbh{

        public $userEmail;
        public $trackCode;

        private $dbhTable = 'email_marketing';

        public static $subject;
        public static $message;
        public static $fileName;
        public static $senderEmail ='info@example.com';
        public static $senderName ='Sender Name';
        

        public static function setSenderEmail(string $newSenderEmail){
            self::$senderEmail = $newSenderEmail;
        }

        public static function setSenderName(string $newSenderName){
            self::$senderName = $newSenderName;
        }


        public static function setMessage(string $newMessage, string $newSubject, string $newFileName){
            self::$message = $newMessage;
            self::$subject = $newSubject;
            self::$fileName = $newFileName;
        }
        
        public function setTrackCode(string $trackCode){
            $this->trackCode = $trackCode;
        }

        public function setUserEmail(string $userEmail){
            $this->userEmail = $userEmail;
        }

        private function getDate(){
            date_default_timezone_set("Asia/Tokyo");
            $now = date("Y-m-d H:i:s");
            return $now;
        }

        public function insertEmailTrackDBH(){
            $now = $this->getDate();
            try{
                $query = "INSERT INTO ".$this->dbhTable." SET 
                    senderName=?, 
                    senderEmail=?, 
                    subject=?, 
                    message=?, 
                    email=?, 
                    fileName=?, 
                    trackCode=?, 
                    sentDate=?
                ";

                $stmt = $this->connect()->prepare($query);
                $stmt->execute([self::$senderName, self::$senderEmail, self::$subject, self::$message, $this->userEmail, self::$fileName, $this->trackCode, $now]);
                echo '<p style="background:green; color:white; padding: 5px 5px;">Email Send to: '.$this->userEmail.'And Stored</p>';

            }catch(PDOException $e){
                echo $query.'Error'.$e->getMessage();
            } 
        }

        public function isOpen($getTrackCode){
            $now =$this->getDate();
            try{
                $query = "UPDATE ".$this->dbhTable." SET openDate=?, isOpen=? WHERE trackCode=? AND isOpen='no'";
                
                $stmt = $this->connect()->prepare($query);
                $stmt->execute([$now, 'yes', $getTrackCode]);
                
                echo '<p style="background:green; color:white; padding: 5px 5px;">DATABASE UPDATED'.$getTrackCode.'</p>';
                echo $query;
            }catch(PDOException $e){
                echo $query.'Error '.$e->getMessage();
            }
        }

        public function getEmails(){
            $query ="SELECT * FROM ".$this->dbhTable;
            $stmt = $this->connect()->query($query);

            $return = '<table>';
            $return .='<tr>';
            $return .='<th>#</th>';
            $return .='<th>Subject</th>';
            $return .='<th>User Email</th>';
            $return .='<th>Sent Date</th>';
            $return .='<th>Open Date</th>';
            $return .='<th>Open</th>';
            $return .='<tr>';
            while($row = $stmt->fetch()){
                if($row['isOpen']=='no'){
                    $style = 'style="background:red; color:white;"';
                }else{
                    $style = 'style="background:green; color:white;"';
                }

                $return .='<tr '.$style.'>';
                $return .='<td>'.$row['id'].'</td>';
                $return .='<td>'.$row['subject'].'</td>';
                $return .='<td>'.$row['email'].'</td>';
                $return .='<td>'.$row['sentDate'].'</td>';
                $return .='<td>'.$row['openDate'].'</td>';
                $return .='<td>'.$row['isOpen'].'</td>';
                $return .='</tr>';
            }

            $return .= '</table>';
            return $return;
        }

    }
?>