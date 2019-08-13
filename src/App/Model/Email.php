<?php

class Email {

    private $nome;
    private $telefone;
    private $email;
    private $assunto;
    private $mensagem;
    private $data;
    private $hora;

    public function setNome($nome) {
        if (!$nome) throw new Exception('Nome não informado.');
        $this->nome = $nome;
    }

    public function setTelefone($telefone) {
        if (!$telefone) throw new Exception('Telefone não informado.');
        if (!preg_match('/^\(\d{2}\)\s\d{4,5}-\d{4}$/', $telefone)) throw new Exception('Por favor, informe um telefone válido.');
        $this->telefone = $telefone;
    }

    public function setEmail($email) {
        if (!$email) throw new Exception('Email não informado.');
        if (!preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/", $email)) throw new Exception(('Por favor, informe um email válido.'));
        $this->email = $email;
    }

    public function setAssunto($assunto) {
        if (!$assunto) throw new Exception('Assunto não informado.');
        $this->assunto = $assunto;
    }

    public function setMensagem($mensagem) {
        if (!$mensagem) throw new Exception('Mensagem não informada.');
        $this->mensagem = $mensagem;
    }

    public function setData($data) {
        if (!$data) throw new Exception('Data não informada.');
        $this->data = $data;
    }

    public function setHora($hora) {
        if (!$hora) throw new Exception('Hora não informada.');
        $this->hora = $hora;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAssunto() {
        return $this->assunto;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    public function getData() {
        return $this->data;
    }

    public function getHora() {
        return $this->hora;
    }
}

?>