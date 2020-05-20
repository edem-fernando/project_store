<?php


namespace Source\Support;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;
use Source\Support\Message;

/**
 * Class Email: utiliza os componentes do packgist para enviar e-mails autenticados
 * PHPMailer\PHPMailer\PHPMailer
 * PHPMailer\PHPMailer\Exception as MailException;
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
     * bootstrap(): cria o objeto para mandar e-mail
     * @param string $subject
     * @param string $message
     * @param string $to_email
     * @param string $to_name
     * @return Email
     */
    public function bootstrap(string $subject, string $message, string $to_email, string $to_name): Email
    {
        $this->data = new \stdClass();
        $this->data->subject = $subject;
        $this->data->message = $message;
        $this->data->to_email = $to_email;
        $this->data->to_name = $to_name;
        return $this;
    }
    
    /**
     * attach(): adiciona anexos ao e-mail
     * @param string $file_path
     * @param string $file_name
     * @return Email
     */
    public function attach(string $file_path, string $file_name): Email
    {
        $this->data->attach[$file_path] = $file_name;
        return $this;
    }
    
    /**
     * send(): verifica dados e envia o e-mail
     * @param $from_email = CONF_MAIL_SENDER["address"]
     * @param $from_name = CONF_MAIL_SENDER["name"]
     * @return bool
     */
    public function send($from_email = CONF_MAIL_SENDER["address"], $from_name = CONF_MAIL_SENDER["name"]): bool
    {
        if (empty($this->data)) {
            $this->message->warning("Por favor verifique os dados!");
            return false;
        }

        if (!is_email($this->data->to_email)) {
            $this->message->error("E-mail de destinatário inválido!");
            return false;
        }

        if (!is_email($from_email)) {
            $this->message->error("E-mail de remetente inválido!");
            return false;
        }

        try {
            $this->mail->Subject = $this->data->subject;
            $this->mail->msgHTML($this->data->message);
            $this->mail->addAddress($this->data->to_email, $this->to_name);
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
