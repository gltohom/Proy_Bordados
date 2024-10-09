<?php
    class RolesModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }
        
        //para la funcion de seleccionar los roles
        public function selectRoles()
        {
            //para recuperar datos de la base de datos
            $sql = "SELECT * FROM rol WHERE estado != 0 ";
            $request = $this->select_all($sql);
            return $request;
        }

        //para seleccionar un rol y cargarlo en el formulario
        public function selectRol(int $idRol)
        {
            //Buscar rol en la base de datos
            $this->intIdRol = $idRol;
            $sql ="SELECT *FROM rol WHERE idRol = $this->intIdRol";
            $request = $this->select($sql);
            return $request;
        }

        //para insertar roles en la base de datos
        public function insertRol(string $rol, string $descripción, int $estado)
        {

			$return = "";
			$this->strRol = $rol;
			$this->strDescripción = $descripción;
			$this->intEstado = $estado;

			$sql = "SELECT * FROM rol WHERE rol = '{$this->strRol}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO rol(rol,descripción,estado) VALUES(?,?,?)";
	        	$arrData = array($this->strRol, $this->strDescripción, $this->intEstado);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}

        //actualizar un dato en la tabla rol
        public function updateRol(int $idrol, string $rol, string $descripción, int $estado)
        {
			$this->intIdrol = $idrol;
			$this->strRol = $rol;
			$this->strDescripción = $descripción;
			$this->intEstado = $estado;

			$sql = "SELECT * FROM rol WHERE rol = '$this->strRol' AND idRol != $this->intIdrol";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE rol SET rol = ?, descripción = ?, estado = ? WHERE idRol = $this->intIdrol ";
				$arrData = array($this->strRol, $this->strDescripción, $this->intEstado);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		//eliminar un rol
		public function deleteRol(int $idrol)
		{
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM usuario WHERE idRol = $this->intIdrol";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE rol SET estado = ? WHERE idRol = $this->intIdrol ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else
				{
					$request = 'error';
				}
			}
			else
			{
				$request = 'exist';
			}
			return $request;
		}

    } 
?>