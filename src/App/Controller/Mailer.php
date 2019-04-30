<?php

class Mailer {

    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->CharSet      = "UTF-8";
        $this->mailer->Host         = "XXXXXXXXX";
        $this->mailer->Port         = 587;
        $this->mailer->SMTPAuth     = true;
        $this->mailer->SMTPSecure   = "tls";
        $this->mailer->Username     = "XXXXXXXX@XXXXX.XXX";
        $this->mailer->Password     = "XXXXXXXX";
        $this->mailer->setFrom("XXXXXXXX@XXXXX.XXX", "Contato - Site");
        $this->mailer->addAddress("XXXXXXXX@XXXXX.XXX");
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

        $view = new Template();
        $view->setHeader('');
        $view->setFooter('');
        $view->setFile('email.email');
        $view->replace('{{assunto}}', $email->getAssunto());
        $view->replace('{{email}}', $email->getEmail());
        $view->replace('{{nome}}', $email->getNome());
        $view->replace('{{telefone}}', $email->getTelefone());
        $view->replace('{{data}}', $email->getData());
        $view->replace('{{hora}}', $email->getHora());
        $view->replace('{{mensagem}}', $email->getMensagem());
        
        $this->mailer->Body = $view->getFile();
        $this->mailer->addReplyTo($email->getEmail(), $email->getNome());
        
        // $this->mailer->SMTPDebug = 3;
        // $this->mailer->Debugoutput = 'html';
        $this->mailer->setLanguage('pt');

        $view->setHeader('header');
        $view->setFooter('footer');
        $view->setFile('contato');

        if (!$this->mailer->send()) {
            error_log("Erro no envio do email: " . $this->mailer->ErrorInfo);
            echo $view->getFile();
            echo '<div id="overlay" class="erro open"><p>Erro no envio do email. Tente novamente mais tarde.</p><button onclick="fecharOverlay()" type="button">Fechar</button></div>';
        } else {
            echo $view->getFile();
            echo '<div id="overlay" class="sucesso open"><p>Email enviado com sucesso</p><button onclick="fecharOverlay()" type="button">Fechar</button></div>';
        }
        die ();
    }
}

?>