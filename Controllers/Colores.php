<?php
    class Colores extends Controllers
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

        public function colores()
        {        
            $data['page_tag'] = "Colores";
            $data['page_title'] = "Colores <small>Bordados</small>";
            $data['page_name'] = "colores";
            $this->views->getView($this,"colores",$data);
        }

        //metodo para obtener listado de colores
        public function getColores()
        {
            $arrData = $this->model->selectColores();

            //para trabajar el estado activo e inactivo
            for($i=0; $i<count($arrData); $i++)
            {

                //para los botones del crud
                //boton actualizar
                $arrData[$i]['actualizar'] = '<div class="text-center">
                <button class="btn btn-outline-warning btnActualizarColor" onClick="fntActualizarColor('.$arrData[$i]['idColor'].')" title="Actualizar">Actualizar</button>
                </div>';

                //boton eliminar
                $arrData[$i]['eliminar'] = '<div class="text-center">
                <button class="btn btn-outline-danger btnEliminarColor" onClick="fntEliminarColor('.$arrData[$i]['idColor'].')" title="Eliminar">Eliminar</button>
                </div>';
            }

            //para convertir el array en formato json
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }

        //para la funcion de la lista a mostrar en el formulario de hilos, telas y productos
        public function getSelectColor()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectColores();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                    if($arrData[$i]['status'] == 1 ){
                    $htmlOptions .= '<option value="'.$arrData[$i]['idColor'].'">'.$arrData[$i]['color'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();      
        }

        //para cargar un color al formulario
        public function getColor(int $idColor)
        {
            $intIdColor = intval(strClean($idColor));
            if ($intIdColor > 0) 
            {
                $arrData = $this->model->selectColor($intIdColor);
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

        //para insertar un nuevo color
        public function setColor()
        {
            $intIdColor = intval($_POST['idColor']);
            $strColor = strClean($_POST['txtNombreColores']);
            $strDescripción = strClean($_POST['txtDescripciónColores']);

            //validación de los campos
            if($intIdColor == 0)
            {
                //limpiar campo y preparalo para recibir datos
                $request_colores = $this->model->insertColor($strColor, $strDescripción);
                $option = 1;
            }
            else
            {
                //para actualizar
                $request_colores = $this->model->updateColor($intIdColor, $strColor, $strDescripción);
                $option = 2;
            }

            //proceso para almacernar y mostrar mensaje
            if ($request_colores > 0) 
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
            else if ($request_colores == 'exist') 
            {
                $arrResponse = array('estado' => false, 'msg' => 'Ya existe el color');
            }
            else
            {
                $arrResponse = array('estado' => false, "msg" => 'No se puede almacenar los datos');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }

        //para eliminar un color
        public function eliminarColor()
        {
            if($_POST){
                $intIdColor = intval($_POST['idColor']);
                $requestDelete = $this->model->deleteColor($intIdColor);
                if($requestDelete == 'ok')
                {
                    $arrResponse = array('estado' => true, 'msg' => 'Eliminado correctamente');
                }
                else if($requestDelete == 'exist')
                {
                    $arrResponse = array('estado' => false, 'msg' => 'No se pudo eliminar el color por estar vinculado a un hilo o tela.');
                }
                else
                {
                    $arrResponse = array('estado' => false, 'msg' => 'Error al eliminar el color.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

    }
?>