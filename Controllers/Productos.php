<?php
    class Productos extends Controllers
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
			getPermisos(4);
        }

        public function productos()
        {        
            $data['page_tag'] = "Productos";
            $data['page_title'] = "Productos <small>Bordados</small>";
            $data['page_name'] = "productos";
            $this->views->getView($this,"productos",$data);
        }

        //metodo para obtener listado de Productos
        public function getProductos()
        {
            $arrData = $this->model->selectProductos();

            //para trabajar el estado activo e inactivo
            for($i=0; $i<count($arrData); $i++)
            {

                //para los botones del crud
                //boton actualizar
                $arrData[$i]['actualizar'] = '<div class="text-center">
                <button class="btn btn-outline-warning btnActualizarProducto" onClick="fntActualizarProducto('.$arrData[$i]['idProducto'].')" title="Actualizar">Actualizar</button>
                </div>';

                //boton eliminar
                $arrData[$i]['eliminar'] = '<div class="text-center">
                <button class="btn btn-outline-danger btnEliminarProducto" onClick="fntEliminarProducto('.$arrData[$i]['idProducto'].')" title="Eliminar">Eliminar</button>
                </div>';
            }

            //para convertir el array en formato json
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>