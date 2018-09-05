<?php
/**
 * Created by PhpStorm.
 * User: dubeyamit
 * Date: 27-01-2017
 * Time: 06:58 PM
 */

namespace App;


class Mail
{
    public $to;
    public $subject;
    public $body;

    public function send_mail()
    {
        if (!class_exists("phpmailer")) {
            require_once('class.phpmailer.php');
        }

        $mail = new PHPMailer();

        $mail->IsSMTP();
        $mail->SMTPAuth = true;
//        $mail->Host = 'smtpout.secureserver.net:80';
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'retinodes.bijendra@gmail.com';
        $mail->Password = 'bijendra12';

        $mail->From = $mail->Username;
        $mail->FromName = "Organic Dolchi - Support Team";
        foreach (explode(",", $this->to) as $recepient)
            $mail->AddAddress($recepient);

//        $mail->AddBCC('a@a.com');
        $mail->Subject = $this->subject;
        $mail->Body = $this->body;
        //$mail->WordWrap = 50;
        $mail->IsHTML(true);
        $str1 = "gmail.com";
        $str2 = strtolower($mail->Username);

        If (strstr($str2, $str1)) {
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            if (!$mail->Send()) {
                return false;
//                echo "Mailer Error: " . $mail->ErrorInfo;
//                echo "<br><br> * Please double check the user name and password to confirm that both of them are correct. <br><br>";
//                echo "* If you are the first time to use gmail smtp to send email, please refer to this link :http://www.smarterasp.net/support/kb/a1546/send-email-from-gmail-with-smtp-authentication-but-got-5_5_1-authentication-required-error.aspx?KBSearchID=137388";
            } else {
                return true;
//                echo "Message has been sent";
            }
        } else {
            $mail->Port = 25;
            if (!$mail->Send()) {
                return false;
//                echo "Mailer Error: " . $mail->ErrorInfo;
//                echo "<br><BR>* Please double check the user name and password to confirm that both of them are correct. <br>";
            } else {
                return true;
//                echo "Message has been sent";
            }
        }
    }
}