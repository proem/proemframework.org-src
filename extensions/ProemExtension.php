<?php

namespace Gen;

class ProemExtension extends TwigExtension
{
    public function getFunctions()
    {
        return array(
            'someFunction' => new \Twig_Function_Method($this, 'someFunction' )
        );
    }

    public function getName()
    {
        return 'proem_extension';
    }

    public function someFunction() {
        return $this->currentDirectory . " " . $this->currentFile;
    }
}
