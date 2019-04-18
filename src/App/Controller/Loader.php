<?php

class Loader {

    private $template;

    public function __construct() {
        $this->template = new Template();
    }

    public function homePage() {
        $this->template->setFile('home');
        die( $this->template->getFile() );
    }

    public function negocioPage() {
        $this->template->setFile('negocio');
        die( $this->template->getFile() );
    }

    public function governancaPage() {
        $this->template->setFile('governanca');
        die( $this->template->getFile() );
    }

    public function sustentabilidadePage() {
        $this->template->setFile('sustentabilidade');
        die( $this->template->getFile() );
    }

    public function empresaPage() {
        $this->template->setFile('empresa');
        die( $this->template->getFile() );
    }

    public function contatoPage() {
        $this->template->setFile('contato');
        die( $this->template->getFile() );
    }
}

?>