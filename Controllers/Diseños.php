<?php
    class Diseños extends Controllers
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
			getPermisos(5);
        }

        public function diseños()
        {        
            $data['page_tag'] = "Diseños";
            $data['page_title'] = "Diseños <small>Bordados</small>";
            $data['page_name'] = "diseños";
            $this->views->getView($this,"diseños",$data);
        }

        //metodo para obtener listado de diseños
        public function getDiseños()
        {
            $arrData = $this->model->selectDiseños();

            //para trabajar el estado activo e inactivo
            for($i=0; $i<count($arrData); $i++)
            {

                //para los botones del crud
                //boton actualizar
                $arrData[$i]['actualizar'] = '<div class="text-center">
                <button class="btn btn-outline-warning btnActualizarDiseño" onClick="fntActualizarDiseño('.$arrData[$i]['idDiseño'].')" title="Actualizar">Actualizar</button>
                </div>';

                //boton eliminar
                $arrData[$i]['eliminar'] = '<div class="text-center">
                <button class="btn btn-outline-danger btnEliminarDiseño" onClick="fntEliminarDiseño('.$arrData[$i]['idDiseño'].')" title="Eliminar">Eliminar</button>
                </div>';
            }

            //para convertir el array en formato json
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

        //para cargar un diseño al formulario
        public function getDiseño(int $idDiseño)
        {
            $intIdDiseño = intval(strClean($idDiseño));
            if ($intIdDiseño > 0) 
            {
                $arrData = $this->model->selectDiseño($intIdDiseño);
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

        //para insertar un nuevo diseño
        public function setDiseño()
        {
            $intIdDiseño = intval($_POST['idDiseño']);
            $strNombre = strClean($_POST['txtNombreDiseños']);
            $strDescripción = strClean($_POST['txtDescripciónDiseños']);

            //validación de los campos
            if($intIdDiseño == 0)
            {
                //limpiar campo y preparalo para recibir datos
                $request_diseños = $this->model->insertDiseño($strNombre, $strDescripción);
                $option = 1;
            }
            else
            {
                //para actualizar
                $request_diseños = $this->model->updateDiseño($intIdDiseño, $strNombre, $strDescripción);
                $option = 2;
            }

            //proceso para almacernar y mostrar mensaje
            if ($request_diseños > 0) 
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
            else if ($request_diseños == 'exist') 
            {
                $arrResponse = array('estado' => false, 'msg' => 'Ya existe el diseño');
            }
            else
            {
                $arrResponse = array('estado' => false, "msg" => 'No se puede almacenar los datos');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        //para eliminar un color
        public function eliminarDiseño()
        {
            if($_POST){
                $intIdDiseño = intval($_POST['idDiseño']);
                $requestDelete = $this->model->deleteDiseño($intIdDiseño);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('estado' => true, 'msg' => 'Eliminado correctamente');
                }
                else if($requestDelete == 'exist')
                {
                    $arrResponse = array('estado' => false, 'msg' => 'No se pudo eliminar el diseño por estar vinculado a un producto.');
                }
                else
                {
                    $arrResponse = array('estado' => false, 'msg' => 'Error al eliminar el diseño.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

    }
?>