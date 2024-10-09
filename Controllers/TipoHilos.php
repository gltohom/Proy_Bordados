<?php
    class TipoHilos extends Controllers
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

        public function tipoHilos()
        {        
            $data['page_tag'] = "Tipo de hilos";
            $data['page_title'] = "Tipo de hilos para <small>Bordados</small>";
            $data['page_name'] = "tipoHilos";
            $this->views->getView($this,"tipoHilos",$data);
        }

        //metodo para obtener listado de Tipo de hilos
        public function getTipoHilos()
        {
            $arrData = $this->model->selectTipoHilos();

            //para trabajar el estado activo e inactivo
            for($i=0; $i<count($arrData); $i++)
            {

                //boton actualizar
                $arrData[$i]['actualizar'] = '<div class="text-center">
                <button class="btn btn-outline-warning btnActualizarTipoHilo" onClick="fntActualizarTipoHilo('.$arrData[$i]['idTipoHilo'].')" title="Actualizar">Actualizar</button>
                </div>';

                //boton eliminar
                $arrData[$i]['eliminar'] = '<div class="text-center">
                <button class="btn btn-outline-danger btnEliminarTipoHilo" onClick="fntEliminarTipoHilo('.$arrData[$i]['idTipoHilo'].')" title="Eliminar">Eliminar</button>
                </div>';
            }

            //para convertir el array en formato json
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

        //para cargar un Tipo al formulario
        public function getTipoHilo(int $idTipoHilo)
        {
            $intIdTipoHilo = intval(strClean($idTipoHilo));
            if ($intIdTipoHilo > 0) 
            {
                $arrData = $this->model->selectTipoHilo($intIdTipoHilo);
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

        //para insertar un nuevo tipo
        public function setTipoHilo()
        {
            $intIdTipoHilo = intval($_POST['idTipoHilo']);
            $strTipo = strClean($_POST['txtNombreTipoHilos']);

            //validación de los campos
            if($intIdTipoHilo == 0)
            {
                //limpiar campo y preparalo para recibir datos
                $request_tipoHilo = $this->model->insertTipoHilo($strTipo);
                $option = 1;
            }
            else
            {
                //para actualizar
                $request_tipoHilo = $this->model->updateTipoHilo($intIdTipoHilo, $strTipo);
                $option = 2;
            }

            //proceso para almacernar y mostrar mensaje
            if ($request_tipoHilo > 0) 
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
            else if ($request_tipoHilo == 'exist') 
            {
                $arrResponse = array('estado' => false, 'msg' => 'Ya existe el tipo');
            }
            else
            {
                $arrResponse = array('estado' => false, "msg" => 'No se puede almacenar los datos');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
        }

        //para eliminar un tipo
        public function eliminarTipoHilo()
        {
            if($_POST){
                $intIdTipoHilo = intval($_POST['idTipoHilo']);
                $requestDelete = $this->model->deleteTipoHilo($intIdTipoHilo);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('estado' => true, 'msg' => 'Eliminado correctamente');
                }
                else if($requestDelete == 'exist')
                {
                    $arrResponse = array('estado' => false, 'msg' => 'No se pudo eliminar el tipo por estar vinculado a un hilo.');
                }
                else
                {
                    $arrResponse = array('estado' => false, 'msg' => 'Error al eliminar el tipo.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>