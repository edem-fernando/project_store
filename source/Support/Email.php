<?php

namespace Source\Support;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;
use Source\Support\Message;

/**
 * Class Email
 * 
 * @author Edem Fernando Bastos <edem.fbc@gmail.com>
 * @package Source\Support
 */
class Email 
{
    /** @var stdClass */
    private $data;
    
    /** @var Message */
    private $message;
    
    /** @var Message */
    private $mail;
    
    /**
     * Email Constructor
     */
    public function __construct()
    {
        $this->message = new Message();
        $this->mail = new PHPMailer(true);
        
        $this->mail->isSMTP();
        $this->mail->isHTML(CONF_MAIL_OPTION_HTML);
        $this->mail->setLanguage(CONF_MAIL_OPTION_LANG);
        $this->mail->SMTPSecure = CONF_MAIL_OPTION_SECURE;
        $this->mail->SMTPAuth = CONF_MAIL_OPTION_AUTH;
        $this->mail->CharSet = CONF_MAIL_OPTION_CHARSET;
        $this->mail->Host = CONF_MAIL_HOST;
        $this->mail->Port = CONF_MAIL_PORT;
        $this->mail->Username = CONF_MAIL_USER;
        $this->mail->Password = CONF_MAIL_PASSWD;
    }
    
    /**
     * @param string $subject
     * @param string $message
     * @param string $toEmail
     * @param string $toName
     * @return Email
     */
    public function bootstrap(string $subject, string $message, string $toEmail, string $toName): Email
    {
        $this->data = new \stdClass();
        $this->data->subject = $subject;
        $this->data->message = $message;
        $this->data->toEmail = $toEmail;
        $this->data->toName = $toName;
        return $this;
    }
    
    /**
     * @param string $filePath
     * @param string $fileName
     * @return Email
     */
    public function attach(string $filePath, string $fileName): Email
    {
        $this->data->attach[$filePath] = $fileName;
        return $this;
    }
    
    /**
     * @param $fromEmail
     * @param $fromName
     * @return bool
     */
    public function send($fromEmail = CONF_MAIL_SENDER["address"], $fromName = CONF_MAIL_SENDER["name"]): bool
    {
        if (empty($this->data)) {
            $this->message->warning("Por favor verifique os dados!");
            return false;
        }

        if (!is_email($this->data->toEmail)) {
            $this->message->error("E-mail de destinatário inválido!");
            return false;
        }

        if (!is_email($fromEmail)) {
            $this->message->error("E-mail de remetente inválido!");
            return false;
        }

        try {
            $this->mail->Subject = $this->data->subject;
            $this->mail->msgHTML($this->data->message);
            $this->mail->addAddress($this->data->toEmail, $this->toName);
            $this->mail->setFrom($from_email, $from_name);

            if (!empty($this->data->attach)) {
                foreach ($this->data->attach as $path => $name) {
                    $this->mail->addAttachment($path, $name);
                }
            }
            
            $this->mail->send();
            return true;
        } catch (MailException $exception) {
            $this->message->error($exception);
            return false;
        }
    }
    
    /**
     * @return PHPMailer
     */
    public function mail(): PHPMailer
    {
        return $this->mail;
    }
    
    /**
     * @return Message
     */
    public function message(): Message
    {
        return $this->message;
    }
}
