<?php 
/*
 * Base Controller
 * Loads Models And Views
 */

class Controller {
    public function model($model) {
        // Require Model
        require_once "../app/models/" . $model . ".php";
        return new $model;
    }
    public function view($view, $data = []) {
        // Load View
        if (file_exists("../app/views/". $view . ".php")) {
            require_once "../app/views/". $view . ".php";
        } else {
            // View Doesn't Exist
            die("View Doesn't Exist");
        }
    }
}

?>