<?php
// require_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'PHPMailer.php';

class Mailer {

    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->CharSet      = "UTF-8";
        $this->mailer->Host         = "*******";
        $this->mailer->Port         = 587;
        $this->mailer->SMTPAuth     = true;
        $this->mailer->SMTPSecure   = "tls";
        $this->mailer->Username     = "*******@talibrasilengenharia.com.br";
        $this->mailer->Password     = "*******";
        $this->mailer->setFrom("*******@talibrasilengenharia.com.br", "Contato - Site");
        $this->mailer->addAddress("*******@talibrasilengenharia.com.br");
    }

    public function loadEmail() {

        $email = new Email();
        $email->setNome         (isset($_POST['nome'])     ? $_POST['nome']     : false);
        $email->setTelefone     (isset($_POST['tel'])      ? $_POST['tel']      : false);
        $email->setEmail        (isset($_POST['email'])    ? $_POST['email']    : false);
        $email->setAssunto      (isset($_POST['assunto'])  ? $_POST['assunto']  : false);
        $email->setMensagem     (isset($_POST['mensagem']) ? $_POST['mensagem'] : false);
        $email->setData         (date('d/m/Y'));
        $email->setHora         (date('H:i:s'));

        $this->mailer->isHTML(true);
        $this->mailer->Subject = "Contato: " . $email->getAssunto();
        // Montar html para Body
        $this->mailer->Body = "Email enviado pelo site no dia ".$email->getData()." às ".$email->getHora().
                                ". Por ".$email->getNome()." (".$email->getEmail().") - Telefone: ".$email->getTelefone().
                                "Mensagem: ".$email->getMensagem();
        $this->mailer->addReplyTo($email->getEmail(), $email->getNome());
        
        $this->mailer->SMTPDebug = 3;
        $this->mailer->Debugoutput = 'html';
        $this->mailer->setLanguage('pt');

        if (!$this->mailer->send()) {
            error_log("Erro no envio do email: " . $this->mailer->ErrorInfo);
            echo "Erro no envio do email: " . $this->mailer->ErrorInfo;
        } else {
            echo "Mensagem enviada";
        }
    }
}

?>