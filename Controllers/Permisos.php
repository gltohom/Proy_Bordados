<?php
    class Permisos extends Controllers
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

        public function getPermisosRol(int $idrol)
        {
            $idrol = intval($idrol);
            if($idrol > 0)
            {
                $arrModulos = $this->model->selectModulos();
                $arrPermisosRol = $this->model->selectPermisosRol($idrol);
                //asignar array
                $arrPermisos = array('insertar' => 0, 'consultar' => 0, 'actualizar' => 0, 'eliminar' => 0);
                $arrPermisoRol = array('idRol' => $idrol);
                //validación
                if(empty($arrPermisosRol))
                {
                    for ($i=0; $i < count($arrModulos) ; $i++)
                    { 

                        $arrModulos[$i]['permisos'] = $arrPermisos;
                    }
                }
                else
                {
                    for ($i=0; $i < count($arrModulos); $i++)
                    {
                        $arrPermisos = array('insertar' => 0, 'consultar' => 0, 'actualizar' => 0, 'eliminar' => 0);
                        if(isset($arrPermisosRol[$i]))
                        {

                            $arrPermisos = array('insertar'     => $arrPermisosRol[$i]['insertar'], 
                                                 'consultar'    => $arrPermisosRol[$i]['consultar'], 
                                                 'actualizar'   => $arrPermisosRol[$i]['actualizar'], 
                                                 'eliminar'     => $arrPermisosRol[$i]['eliminar'] 
                                                );
                        }
                        $arrModulos[$i]['permisos'] = $arrPermisos;
                        

                    }
                }
                $arrPermisoRol['modulo'] = $arrModulos;
                //mostrando los datos en el modal
                $html = getModal("modalPermisos",$arrPermisoRol);
                //dep($arrPermisoRol);
                /*dep($arrPermisosRol);*/
            }
            die();
        }
        
        //para guardar permisos
        public function setPermisos()
        {
            if($_POST)
            {
                $intIdrol = intval($_POST['idRol']);
                $modulos = $_POST['modulo'];

                $this->model->deletePermisos($intIdrol);
                foreach ($modulos as $modulo) {
                    $idModulo = $modulo['idModulo'];
                    $insertar = empty($modulo['insertar']) ? 0 : 1;
                    $consultar = empty($modulo['consultar']) ? 0 : 1;
                    $actualizar = empty($modulo['actualizar']) ? 0 : 1;
                    $eliminar = empty($modulo['eliminar']) ? 0 : 1;
                    $requestPermiso = $this->model->insertPermisos($intIdrol, $idModulo, $insertar, $consultar, $actualizar, $eliminar);
                }
                if($requestPermiso > 0)
                {
                    $arrResponse = array('status' => true, 'msg' => 'Permisos guardados.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible asignar los permisos.');
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>