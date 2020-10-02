<?php
namespace App\Model\Entity;

use Cake\Mailer\Email;
use Exception;

class Mail extends Email
{

    public function sendEmail($email_to, $subject, $template, $body = null, $attachments = null, $email_cc = null, $email_bcc = null)
    {
        try {
            $email = new Email('default');
            $email->setTo($email_to);
            if(!is_null($email_cc)) {
                $email->setCc(explode(';', $email_cc));
            }
            if(!is_null($email_bcc)) {
                $email->setBcc(explode(';', $email_bcc));
            }
            $email->setSubject($subject);
            $email->viewBuilder()->setTemplate($template);
            $email->setEmailFormat('html');
            $email->setViewVars([
                'body' => $body,
            ]);
            if(!is_null($attachments)) {
                $email->setAttachments($attachments);
            }
            // Send email
            return $email->send();
        }catch(Exception $e) {
            return $e->getMessage();
        }
    }

}
