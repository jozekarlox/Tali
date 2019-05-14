<?php

class Loader {

    private $template;

    public function __construct() {
        $this->template = new Template();
    }

    public function homePage() {
        $this->template->setFile('home');
        echo ( $this->template->getFile() );
    }

    public function negocioPage() {
        $this->template->setFile('negocio');
        echo ( $this->template->getFile() );
    }

    public function governancaPage() {
        $this->template->setFile('governanca');
        echo ( $this->template->getFile() );
    }

    public function sustentabilidadePage() {
        $this->template->setFile('sustentabilidade');
        echo ( $this->template->getFile() );
    }

    public function empresaPage() {
        $this->template->setFile('empresa');
        echo ( $this->template->getFile() );
    }

    public function contatoPage() {
        $this->template->setFile('contato');
        echo ( $this->template->getFile() );
    }
}

?>