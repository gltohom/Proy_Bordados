<?php
    class Home extends Controllers
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function home()
        {
            $data['page_id'] = 1;        
            $data['page_tag'] = "Inicio";
            $data['page_title'] = "Página principal";
            $data['page_name'] = "home";
            
            $this->views->getView($this,"home",$data);
        }
    }
?>