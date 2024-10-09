<?php
    class Login extends Controllers
    {
        public function __construct()
        {
            session_start();
			if(isset($_SESSION['login']))
			{
				header('Location: '.base_url().'/principal');
			}
            parent::__construct();
        }

        public function login()
        {     
            $data['page_tag'] = "Login - Bordados";
            $data['page_title'] = "Bienvenidos a Bordados Say";
            $data['page_name'] = "home";
            $data['page_functions_js'] = "functions_login.js";
            
            $this->views->getView($this,"login",$data);
        }

        public function loginUsuario()
        {
            //dep($_POST);
            if($_POST)
            {
                if(empty($_POST['txtUsuarioLogin']) || empty($_POST['txtContraseñaLogin']))
                {
                    $arrResponse = array('status' => false, 'msg' => 'Error de datos' );
                }else
                {
                    $strUsuario  =  strtolower(strClean($_POST['txtUsuarioLogin']));
                    $strContraseña = hash("SHA256",$_POST['txtContraseñaLogin']);
                    $requestUsuario = $this->model->loginUsuario($strUsuario, $strContraseña);
                    if(empty($requestUsuario))
                    {
                        $arrResponse = array('status' => false, 'msg' => 'El usuario o la contraseña es incorrecto.' ); 
                    }
                    else
                    {
                        $arrData = $requestUsuario;
                        if($arrData['estado'] == 1)
                        {
                            $_SESSION['idUsuarioSesión'] = $arrData['idUsuario'];
                            $_SESSION['login'] = true;

                            //envio de variables, obtencion de datos del usuario
                            $arrData = $this->model->sessionLogin($_SESSION['idUsuarioSesión']);
                            $_SESSION['userData'] = $arrData;

                            $arrResponse = array('status' => true, 'msg' => 'ok');
                        }
                        else
                        {
                            $arrResponse = array('status' => false, 'msg' => 'Este usuario no esta activo.');
                        }
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();

        }
    }
?>