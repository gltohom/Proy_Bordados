<?php
    class Principal extends Controllers
    {
        public function __construct()
        {
            parent::__construct();

            session_start();
			//session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
			}
			getPermisos(1);
        }

        public function principal()
        {
            $data['page_id'] = 2;        
            $data['page_tag'] = "Principal - Bordados";
            $data['page_title'] = "Principal - Bordados";
            $data['page_name'] = "principal";
            //$data['page_content'] = "Lorem ipsum dolor sit amet consectetur adipiscing elit fusce facilisis nulla, pretium vestibulum litora potenti et tristique augue sociosqu eu maecenas sodales, gravida nullam cursus aliquam curabitur arcu netus consequat id. Orci turpis dapibus nullam fermentum gravida natoque himenaeos tempus, suspendisse mauris eleifend lectus vehicula non nisi dictum, felis ultricies curabitur nisl morbi nulla consequat. Tellus ante donec in litora duis fusce eget nunc, potenti rhoncus bibendum nisl fringilla pharetra platea, arcu vel facilisis purus dui libero commodo.";
            $this->views->getView($this,"principal",$data);
        }
    }
?>