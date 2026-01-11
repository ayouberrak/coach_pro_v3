<?php
namespace Core;

class Controller {
    
    protected $twig;

    public function __construct() {

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../app/Views');
        
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false,  
            'debug' => true,   
        ]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());

        $scriptName = $_SERVER['SCRIPT_NAME']; 
        $dir = dirname($scriptName);           
        $dir = str_replace('\\', '/', $dir);   
        if ($dir === '/') $dir = '';           
        $this->twig->addGlobal('base_url', $dir);

        $this->helperUrl();
    }

    protected function render($view, $data = []) {
        echo $this->twig->render($view, $data);
    }

    protected function helperUrl() {
        $this->twig->addFunction(
            new \Twig\TwigFunction('url', [\Core\Helpers::class, 'url'])
        );
    }


}
