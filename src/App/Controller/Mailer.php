<?php

class Mailer {

    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->Host = "stmp.gmail.com";
        $this->mailer->Port = 587;
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = "thalesvinicius.26@gmail.com";
        $this->mailer->Password = "123456789";
        // $this->mailer->
        
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
    }
}

?>