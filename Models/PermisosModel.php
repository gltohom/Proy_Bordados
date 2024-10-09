<?php
    class PermisosModel extends Mysql
    {
        //variables
        public $intIdpermiso;
		public $intIdrol;
		public $intIdmodulo;
		public $insertar;
		public $consultar;
		public $actualizar;
		public $eliminar;

        public function __construct()
        {
            parent::__construct();
        }

        //para seleccionar todos sus modulos
        public function selectModulos()
		{
			$sql = "SELECT * FROM modulo WHERE estado != 0";
			$request = $this->select_all($sql);
			return $request;
		}

        //seleccionar tabla permisos
        public function selectPermisosRol(int $idrol)
		{
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM permisos WHERE idRol = $this->intIdrol";
			$request = $this->select_all($sql);
			return $request;
		}

		//eliminar un permiso
		public function deletePermisos(int $idrol)
		{
			$this->intRolid = $idrol;
			$sql = "DELETE FROM permisos WHERE idRol = $this->intRolid";
			$request = $this->delete($sql);
			return $request;
		}

		//asignar permisos
		public function insertPermisos(int $idrol, int $idmodulo, int $insertar, int $consultar, int $actualizar, int $eliminar){
			$this->intRolid = $idrol;
			$this->intModuloid = $idmodulo;
			$this->insertar = $insertar;
			$this->consultar = $consultar;
			$this->actualizar = $actualizar;
			$this->eliminar = $eliminar;
			$query_insert  = "INSERT INTO permisos(idRol,idModulo,insertar,consultar,actualizar,eliminar) VALUES(?,?,?,?,?,?)";
        	$arrData = array($this->intRolid, $this->intModuloid, $this->insertar, $this->consultar, $this->actualizar, $this->eliminar);
        	$request_insert = $this->insert($query_insert,$arrData);		
	        return $request_insert;
		}

		//para obtener los permisos de los modulos
		public function permisosModulo(int $idrol)
		{
			$this->intIdRol = $idrol;
			$sql = "SELECT p.idPermisos, p.idModulo,
						   m.título,
						   p.insertar, p.consultar, p.actualizar, p.eliminar 
					FROM permisos AS p 
					INNER JOIN modulo AS m
					ON p.idModulo = m.idModulo
					WHERE p.idRol = $this->intIdRol";
			$request = $this->select_all($sql);
			$arrPermisos = array();
			for ($i=0; $i < count($request); $i++) { 
				$arrPermisos[$request[$i]['idModulo']] = $request[$i];
			}
			return $arrPermisos;
		}
        
    }
?>