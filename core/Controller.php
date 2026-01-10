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

        // Calculate base URL
        $scriptName = $_SERVER['SCRIPT_NAME']; // e.g., /coachPro_v3/public/index.php
        $dir = dirname($scriptName);           // e.g., /coachPro_v3/public
        $dir = str_replace('\\', '/', $dir);   // Normalize for Windows
        if ($dir === '/') $dir = '';           // Handle root case
        
        $this->twig->addGlobal('base_url', $dir);
    }

    protected function render($view, $data = []) {
        echo $this->twig->render($view, $data);
    }
}
