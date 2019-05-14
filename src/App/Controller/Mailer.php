<?php

class Mailer {

    private $mailer;
    private $view;

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

        $this->view = new Template();
    }

    public function loadEmail() {

        $email = new Email();
        try {
            $email->setNome         (isset($_POST['nome'])     ? $_POST['nome']     : false);
            $email->setTelefone     (isset($_POST['tel'])      ? $_POST['tel']      : false);
            $email->setEmail        (isset($_POST['email'])    ? $_POST['email']    : false);
            $email->setAssunto      (isset($_POST['assunto'])  ? $_POST['assunto']  : false);
            $email->setMensagem     (isset($_POST['mensagem']) ? $_POST['mensagem'] : false);
            $email->setData         (date('d/m/Y'));
            $email->setHora         (date('H:i:s'));
        } catch (Exception $e) {

            $this->view->setHeader('header');
            $this->view->setFooter('footer');
            $this->view->setFile('contato');

            echo $this->view->getFile();
            echo '<div id="overlay" class="erro open"><p>' . $e->getMessage() . '</p><button onclick="fecharOverlay()" type="button">Fechar</button></div>';
            return;
        }

        $this->mailer->isHTML(true);
        $this->mailer->Subject = "Contato: " . $email->getAssunto();

        $this->view->setHeader('');
        $this->view->setFooter('');
        $this->view->setFile('email.email');
        $this->view->replace('{{assunto}}', $email->getAssunto());
        $this->view->replace('{{email}}', $email->getEmail());
        $this->view->replace('{{nome}}', $email->getNome());
        $this->view->replace('{{telefone}}', $email->getTelefone());
        $this->view->replace('{{data}}', $email->getData());
        $this->view->replace('{{hora}}', $email->getHora());
        $this->view->replace('{{mensagem}}', $email->getMensagem());
        
        $this->mailer->Body = $this->view->getFile();
        $this->mailer->addReplyTo($email->getEmail(), $email->getNome());
        
        // $this->mailer->SMTPDebug = 3;
        // $this->mailer->Debugoutput = 'html';
        $this->mailer->setLanguage('pt');

        $this->view->setHeader('header');
        $this->view->setFooter('footer');
        $this->view->setFile('contato');

        if (!$this->mailer->send()) {
            error_log("Erro no envio do email: " . $this->mailer->ErrorInfo);
            echo $this->view->getFile();
            echo '<div id="overlay" class="erro open"><p>Erro no envio do email. Tente novamente mais tarde.</p><button onclick="fecharOverlay()" type="button">Fechar</button></div>';
        } else {
            echo $this->view->getFile();
            echo '<div id="overlay" class="sucesso open"><p>Email enviado com sucesso</p><button onclick="fecharOverlay()" type="button">Fechar</button></div>';
        }
    }
}

?>