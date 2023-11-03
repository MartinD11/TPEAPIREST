<?php
    require_once 'app/views/api.view.php';
    
    abstract class ApiController {
        protected $View;
        private $data;
        
        function __construct() {
            $this->View = new ApiView();
            $this->data = file_get_contents('php://input');
        }

        function getData() {
            return json_decode($this->data);
        }
    }
