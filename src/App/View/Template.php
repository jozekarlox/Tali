<?php

define ('__TEMPLATE__', dirname(__FILE__, 4) . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR);


class Template {
    private $html = null;
    private $pathFile = __TEMPLATE__;
    private $header = 'header.html';
    private $footer = 'footer.html';

    /**
     * Construtor da classe
     * Seta o caminho raiz da pasta do projeto
     */
    public function __construct() {}

    /**
     * Localiza o arquivo
     * @param file string - Nome do arquivo
     */
    public function setFile($file) {
        $file = $this->setDirectory($file);
        $file = $this->pathFile.$file.'.html';
        if ( !is_file($file) ) throw new Exception('Arquivo '.$file.' não localizado.');
        $this->html = file_get_contents($file); 
    }

    /**
     * Retorna o html do arquivo localizado
     * @return string - HTML
     */
    public function getFile() {
        $this->replace('{{header}}', file_get_contents($this->pathFile.$this->header));
        $this->replace('{{footer}}', file_get_contents($this->pathFile.$this->footer));
        return $this->html;
    }

    /**
     * Substitui um campo do HTML selecionado
     * @param from string - O campo no qual será substituido
     * @param to string - O novo valor para o campo
     */
    public function replace($from, $to) {
        $this->html = str_replace($from, $to, $this->html);
    }

    /**
     * Substitui uma série de campos do HTML selecionado
     * @param values array - Indice com o nome do campo no qual será substituido e o valor, o novo valor para o campo
     */
    public function replaceAll($values) {
        foreach($values as $from => $to) {
            $this->html = str_replace($from, $to, $this->html);
        }
    }

    /**
     * Para localizção de templates dentro de outras pastas. Ex.: cadastro.usuario
     * @param file string - Nome do template
     * @return string - Nome do template com separador de diretório, de acordo com o S.O
     */
    private function setDirectory($file) {
        return str_replace('.', DIRECTORY_SEPARATOR, $file);
    }
}
?>