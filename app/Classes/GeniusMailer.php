<?php
/**
 * Created by PhpStorm.
 * User: ShaOn
 * Date: 11/29/2018
 * Time: 12:49 AM
 */

namespace App\Classes;

use App\{
    Models\Order,
    Models\EmailTemplate,
    Models\Generalsettings
};
use PDF;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Str;

class GeniusMailer
{

    public $mail;
    public $gs;

    public function __construct()
    {
        $this->gs = Generalsettings::findOrFail(1);

        $this->mail = new PHPMailer(true);

        if($this->gs->is_smtp == 1){

            $this->mail->isSMTP();                          // Send using SMTP
            $this->mail->Host       = $this->gs->smtp_host;       // Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                 // Enable SMTP authentication
            $this->mail->Username   = $this->gs->smtp_user;   // SMTP username
            $this->mail->Password   = $this->gs->smtp_pass;   // SMTP password
            $this->mail->SMTPSecure = $this->gs->email_encryption;      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $this->mail->Port       = $this->gs->smtp_port; 

        }
    }


    public function sendAutoMail(array $mailData)
    {

        $temp = EmailTemplate::where('email_type','=',$mailData['type'])->first();

        try{

            $body = preg_replace("/{customer_name}/", $mailData['cname'] ,$temp->email_body);
            $body = preg_replace("/{order_amount}/", $mailData['oamount'] ,$body);
            $body = preg_replace("/{admin_name}/", $mailData['aname'] ,$body);
            $body = preg_replace("/{admin_email}/", $mailData['aemail'] ,$body);
            $body = preg_replace("/{order_number}/", $mailData['onumber'] ,$body);
            $body = preg_replace("/{website_title}/", $this->gs->title ,$body);

            //Recipients
            $this->mail->setFrom($this->gs->from_email, $this->gs->from_name);
            $this->mail->addAddress($mailData['to']);     // Add a recipient

            // Content
            $this->mail->isHTML(true);  

            $this->mail->Subject = $temp->email_subject; 

            $this->mail->Body = $body; 

            $this->mail->send();

        }
        catch (Exception $e){

        }

        return true;

    }

    public function sendCustomMail(array $mailData)
    {
    //   return $mailData;
        try{

            //Recipients
            $this->mail->setFrom($this->gs->from_email, $this->gs->from_name);
            $this->mail->addAddress($mailData['to']);     // Add a recipient

            // Content
            $this->mail->isHTML(true);  

            $this->mail->Subject = $mailData['subject']; 

            $this->mail->Body = $mailData['body']; 

            $this->mail->send();

        }
        catch (Exception $e){
            dd($e->getMessage());
        }

        return true;
    }

}