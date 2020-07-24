<?php 
/*
    * App Core CLass
    * Creates URL & Loads Core Controller
    * URL FORMAT /controller/method/params
    */
class Core {
    protected $currentController    = 'Pages';
    protected $currentMethod        = 'index';
    protected $params               = [];
    public function __construct() {
        $url = $this->getURL();
        // print_R( $url);
        if (file_exists("../app/controllers/" . ucwords($url[0]) . ".php")) {
            // If Is Set Make It Controller
            $this->currentController    = ucwords($url[0]);
            // Unset Zero Index
            unset($url[0]);
        }
        require_once "../app/controllers/" . $this->currentController . ".php";
        $this->currentController    = new $this->currentController;
        // Check The Rest Of URL
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod    = $url[1];
                unset($url[1]);

            }
        }
        // Get Params
        $this->params   = ($url) ? array_values($url) : [];

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
    public function getURL() {
        if (isset($_GET['url'])) {
            $url    = rtrim($_GET['url'], "/");
            $url    = filter_var($url, FILTER_SANITIZE_URL);
            $url    = explode("/", $url);
            return $url;
        }
    }
}
?>