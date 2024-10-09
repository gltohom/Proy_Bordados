<?php
    class Personal extends Controllers
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

        public function personal()
        {        
            $data['page_tag'] = "Personal";
            $data['page_title'] = "Personal <small>Bordados</small>";
            $data['page_name'] = "personal";
            $this->views->getView($this,"personal",$data);
        }

        //metodo para obtener listado de Personal
        public function getPersonal()
        {
            $arrData = $this->model->selectPersonal();

            //para trabajar el estado activo e inactivo
            for($i=0; $i<count($arrData); $i++)
            {

                //para los botones del crud
                //boton actualizar
                $arrData[$i]['actualizar'] = '<div class="text-center">
                <button class="btn btn-outline-warning btnActualizarPersona" onClick="fntActualizarPersona('.$arrData[$i]['idPersonal'].')" title="Actualizar">Actualizar</button>
                </div>';

                //boton eliminar
                $arrData[$i]['eliminar'] = '<div class="text-center">
                <button class="btn btn-outline-danger btnEliminarPersona" onClick="fntEliminarPersona('.$arrData[$i]['idPersonal'].')" title="Eliminar">Eliminar</button>
                </div>';
            }

            //para convertir el array en formato json
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

        //para la funcion de la lista a mostrar en el formulario de usuarios
        public function getSelectPersonal()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectPersonal();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                    if($arrData[$i]['status'] == 1 ){
                    $htmlOptions .= '<option value="'.$arrData[$i]['idPersonal'].'">'.$arrData[$i]['nombre'].' '.$arrData[$i]['apellido'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();      
        }

        //para cargar personal al formulario
        public function getPersona(int $idPersonal)
        {
            $intIdPersonal = intval(strClean($idPersonal));
            if ($intIdPersonal > 0) 
            {
                $arrData = $this->model->selectPersona($intIdPersonal);
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

        //para insertar una nueva persona a la base de datos
        public function setPersona()
        {
            $intIdPersonal = intval($_POST['idPersonal']);
            $strNombre = strClean($_POST['txtNombrePersonal']);
            $strApellido = strClean($_POST['txtApellidoPersonal']);
            $strDirección = strClean($_POST['txtDirecciónPersonal']);
            $intTeléfono = strClean($_POST['intTeléfonoPersonal']);

            //validación de los campos
            if($intIdPersonal == 0)
            {
                //limpiar campo y preparalo para recibir datos
                $request_personal = $this->model->insertPersona($strNombre, $strApellido, $strDirección, $intTeléfono);
                $option = 1;
            }
            else
            {
                //para actualizar
                $request_personal = $this->model->updatePersona($intIdPersonal, $strNombre, $strApellido, $strDirección, $intTeléfono);
                $option = 2;
            }

            //proceso para almacernar y mostrar mensaje
            if ($request_personal > 0) 
            {
                if($option == 1)
                {
                    $arrResponse = array('estado' => true, 'msg' => 'Datos guardados correctamente');
                }
                else if($option == 2)
                {
                    $arrResponse = array('estado' => true, 'msg' => 'Datos actualizados correctamente');
                }
            }
            else if ($request_personal == 'exist') 
            {
                $arrResponse = array('estado' => false, 'msg' => 'Ya existe la persona');
            }
            else
            {
                $arrResponse = array('estado' => false, "msg" => 'No se puede almacenar los datos');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        //para eliminar una persona de la base de datos
        public function eliminarPersona()
        {
            if($_POST){
                $intIdPersonal = intval($_POST['idPersonal']);
                $requestDelete = $this->model->deletePersona($intIdPersonal);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('estado' => true, 'msg' => 'Eliminado correctamente');
                }
                else if($requestDelete == 'exist')
                {
                    $arrResponse = array('estado' => false, 'msg' => 'No se pudo eliminar a la persona por estar vinculado a un usuario.');
                }
                else
                {
                    $arrResponse = array('estado' => false, 'msg' => 'Error al eliminar al personal.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>