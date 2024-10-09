<?php
    class TipoHilosModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        //para la funcion de seleccionar los colores desde la base de datos
        public function selectTipoHilos()
        {
            //para recuperar datos de la base de datos
            $sql = "SELECT t.idTipoHilo, t.tipo
            FROM tipohilos AS t
            WHERE status > 0";
            $request = $this->select_all($sql);
            return $request;
        }

        //para seleccionar un tipo y cargarlo en el formulario
        public function selectTipoHilo(int $idTipoHilo)
        {
            //Buscar rol en la base de datos
            $this->intIdTipoHilo = $idTipoHilo;
            $sql ="SELECT *FROM tipoHilos WHERE idTipoHilo = $this->intIdTipoHilo";
            $request = $this->select($sql);
            return $request;
        }

        //para insertar tipos de hilo en la base de datos
        public function insertTipoHilo(string $tipo)
        {

			$return = "";
			$this->strTipo = $tipo;

			$sql = "SELECT * FROM tipoHilos WHERE tipo = '{$this->strTipo}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO tipoHilos(tipo) VALUES(?)";
	        	$arrData = array($this->strTipo);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}

        //actualizar un dato en la tabla tipo de Hilos
        public function updateTipoHilo(int $idtipoHilo, string $tipo)
        {
			$this->intIdtipoHilo = $idtipoHilo;
			$this->strTipo = $tipo;

			$sql = "SELECT * FROM tipoHilos WHERE tipo = '$this->strTipo' AND idTipoHilo != $this->intIdtipoHilo";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE tipoHilos SET tipo = ? WHERE idTipoHilo = $this->intIdtipoHilo";
				$arrData = array($this->strTipo);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

        //eliminar un Tipo de hilo
		public function deleteTipoHilo(int $idtipoHilo)
		{
			$this->intIdtipoHilo = $idtipoHilo;
			$sql = "SELECT * FROM hilos WHERE idTipoHilo = $this->intIdtipoHilo";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE tipoHilos SET status = ? WHERE idTipoHilo = $this->intIdtipoHilo ";
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