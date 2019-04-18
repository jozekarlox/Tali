<?php

class Loader {

    private $template;

    public function __construct() {
        $this->template = new Template();
    }

    public function homePage() {
        $this->template->setFile('teste01');
        die( $this->template->getFile() );
    }
}

?>