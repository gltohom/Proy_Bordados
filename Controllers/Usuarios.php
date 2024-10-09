<?php
    class Usuarios extends Controllers
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
			getPermisos(2);
        }

        public function usuarios()
        {
            //validacion para permisos
            if(empty($_SESSION['permisosMod']['consultar']))
            {
                header("Location:".base_url().'/principal');
            }
            $data['page_tag'] = "Usuarios";
            $data['page_title'] = "Usuario <small>Bordados</small>";
            $data['page_name'] = "usuarios";
            $this->views->getView($this,"usuarios",$data);
        }

        //metodo para obtener listado de roles
        public function getUsuarios()
        {
            $arrData = $this->model->selectUsuarios();

            //para trabajar el estado activo e inactivo
            for($i=0; $i<count($arrData); $i++)
            {
                if($arrData[$i]['estado'] == 1)
                {
                    $arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                }
                else
                {
                    $arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                //boton Ver datos de usuario
                $arrData[$i]['ver'] = '<div class="text-center">
                <button class="btn btn-outline-info btnVerUsuario" onClick="fntVerUsuario('.$arrData[$i]['idUsuario'].')" title="Ver">Ver</button>
                </div>';
                
                //boton actualizar
                $arrData[$i]['actualizar'] = '<div class="text-center">
                <button class="btn btn-outline-warning btnActualizarUsuario" onClick="fntActualizarUsuario('.$arrData[$i]['idUsuario'].')" title="Actualizar">Actualizar</button>
                </div>';

                //boton eliminar
                $arrData[$i]['eliminar'] = '<div class="text-center">
                <button class="btn btn-outline-danger btnEliminarUsuario" onClick="fntEliminarUsuario('.$arrData[$i]['idUsuario'].')" title="Eliminar">Eliminar</button>
                </div>';
            }

            //para convertir el array en formato json
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

        //validacion de campos e ingreso de nuevo usuario
        public function setUsuario()
        {
            if ($_POST)
            {
                if(empty($_POST['txtUsuario']) || empty($_POST['txtContraseña']) || empty($_POST['listEstado']) || empty($_POST['listIdRol']) || empty($_POST['listIdPersonal']))
                {
                    $arrResponsive = array("status" => false, "msg" => 'Datos incorrectos');
                }
                else
                {
                    $intIdUsuario = intval($_POST['idUsuario']);
                    $strUsuario =strClean($_POST['txtUsuario']);    //strtolower() sirve para comvertir todas las letras a minusculas
                    $strContraseña = strClean($_POST['txtContraseña']);
                    $intEstado = intval($_POST['listEstado']);
                    $intIdRol = intval($_POST['listIdRol']);
                    $intIdPersonal = intval($_POST['listIdPersonal']);

                    //para encriptar la contraseña
                    $strContraseña = hash("SHA256", $_POST['txtContraseña']);
                    if($intIdUsuario == 0)
                    {
                        //limpiar campo y preparalo para recibir datos
                        $request_usuario = $this->model->insertUsuario($strUsuario, $strContraseña, $intEstado, $intIdRol, $intIdPersonal);
                        $option = 1;
                    }
                    
                    //proceso para almacernar y mostrar mensaje
                    if ($request_usuario > 0) 
                    {
                        $arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente');
                    }
                    else if ($request_usuario == 'exist') 
                    {
                        $arrResponse = array('estado' => false, 'msg' => 'Ya existe el usuario');
                    }
                    else
                    {
                        $arrResponse = array('estado' => false, "msg" => 'No se puede almacenar los datos');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        //para extraer dato de un usuario
        public function getUsuarioTabla(int $idUsuario)
        {
           $idusuario = intval($idUsuario);
           if($idusuario > 0) 
           {
               $arrData = $this->model->selectUsuarioTabla($idusuario);
               if (empty($arrData)) 
                {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
                }
                else
                {
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
           }
            die(); 
        }

        //para extraer un dato de la tabla y editar
        public function getUsuario(int $idUsuario)
        {
           $idUsuario = intval($idUsuario);
           if($idUsuario > 0) 
           {
               $arrData = $this->model->selectUsuario($idUsuario);
               if (empty($arrData)) 
                {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
                }
                else
                {
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
           }
            die(); 
        }

        //para eliminar usuario
        public function eliminarUsuario()
        {
            if($_POST){
                $intIdusuario = intval($_POST['idUsuario']);
                $requestDelete = $this->model->deleteUsuario($intIdusuario);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('estado' => true, 'msg' => 'Eliminado correctamente');
                }
                else
                {
                    $arrResponse = array('estado' => false, 'msg' => 'Error al eliminar el Usuario.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>