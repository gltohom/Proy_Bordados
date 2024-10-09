<?php
    class Roles extends Controllers
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

        public function roles()
        {
            $data['page_id'] = 3;        
            $data['page_tag'] = "Roles de usuario";
            $data['page_name'] = "rol_usuario";
            $data['page_title'] = "Roles Usuario <small>Bordados</small>";
            //$data['page_content'] = "Lorem ipsum dolor sit amet consectetur adipiscing elit fusce facilisis nulla, pretium vestibulum litora potenti et tristique augue sociosqu eu maecenas sodales, gravida nullam cursus aliquam curabitur arcu netus consequat id. Orci turpis dapibus nullam fermentum gravida natoque himenaeos tempus, suspendisse mauris eleifend lectus vehicula non nisi dictum, felis ultricies curabitur nisl morbi nulla consequat. Tellus ante donec in litora duis fusce eget nunc, potenti rhoncus bibendum nisl fringilla pharetra platea, arcu vel facilisis purus dui libero commodo.";
            $this->views->getView($this,"roles",$data);
        }

 

        //metodo para obtener listado de roles
        public function getRoles()
        {
            $arrData = $this->model->selectRoles();

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

                //para los botones del crud
                //boton permisos
                $arrData[$i]['permisos'] = '<div class="text-center">
                <button class="btn btn-outline-info btnPermisosRol" rl="'.$arrData[$i]['idRol'].'" title="Permisos">Permisos</button>
                </div>';

                //boton actualizar
                $arrData[$i]['actualizar'] = '<div class="text-center">
                <button class="btn btn-outline-warning btnActualizarRol" rl="'.$arrData[$i]['idRol'].'" title="Actualizar">Actualizar</button>
                </div>';

                //boton eliminar
                $arrData[$i]['eliminar'] = '<div class="text-center">
                <button class="btn btn-outline-danger btnEliminarRol" rl="'.$arrData[$i]['idRol'].'" title="Eliminar">Eliminar</button>
                </div>';
            }

            //para convertir el array en formato json
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

        //para la funcion de la lista a mostrar en el formulario de usuarios
        public function getSelectRoles()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectRoles();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                    if($arrData[$i]['estado'] == 1 ){
                    $htmlOptions .= '<option value="'.$arrData[$i]['idRol'].'">'.$arrData[$i]['rol'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();      
        }

        //para cargar un rol al formulario
        public function getRol(int $idRol)
        {
            $intIdRol = intval(strClean($idRol));
            if ($intIdRol > 0) 
            {
                $arrData = $this->model->selectRol($intIdRol);
                if (empty($arrData)) 
                {
                    $arrResponse = array('estado' => false, 'msg' => 'Datos no encontrados');
                }
                else
                {
                    $arrResponse = array('estado' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);   
            }
            die();
        }

        //para insertar un nuevo rol
        public function setRol()
        {
            $intIdRol = intval($_POST['idRol']);
            $strRol = strClean($_POST['txtNombre']);
            $strDescripción = strClean($_POST['txtDescripción']);
            $intEstado = intval($_POST['listEstado']);

            //validación de los campos
            if($intIdRol == 0)
            {
                //limpiar campo y preparalo para recibir datos
                $request_rol = $this->model->insertRol($strRol, $strDescripción, $intEstado);
                $option = 1;
            }
            else
            {
                //para actualizar
                $request_rol = $this->model->updateRol($intIdRol, $strRol, $strDescripción, $intEstado);
                $option = 2;
            }

            //proceso para almacernar y mostrar mensaje
            if ($request_rol > 0) 
            {
                if($option == 1)
                {
                    $arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente');
                }
                else
                {
                    $arrResponse = array('estado' => true, 'msg' => 'Datos actualizados correctamente');
                }
            }
            else if ($request_rol == 'exist') 
            {
                $arrResponse = array('estado' => false, 'msg' => 'Ya existe el rol');
            }
            else
            {
                $arrResponse = array('estado' => false, "msg" => 'No se puede almacenar los datos');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
        }

        //para eliminar un rol
        public function eliminarRol()
        {
            if($_POST){
                $intIdrol = intval($_POST['idRol']);
                $requestDelete = $this->model->deleteRol($intIdrol);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('estado' => true, 'msg' => 'Eliminado correctamente');
                }
                else if($requestDelete == 'exist')
                {
                    $arrResponse = array('estado' => false, 'msg' => 'No se pudo eliminar el rol por estar vinculado a un usuario.');
                }
                else
                {
                    $arrResponse = array('estado' => false, 'msg' => 'Error al eliminar el Rol.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>
 