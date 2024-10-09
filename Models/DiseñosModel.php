<?php
    class DiseñosModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        //para la funcion de seleccionar los colores desde la base de datos
        public function selectDiseños()
        {
            //para recuperar datos de la base de datos
            $sql = "SELECT d.idDiseño, d.nombre, d.descripción
            FROM diseño AS d
            WHERE status > 0";
            $request = $this->select_all($sql);
            return $request;
        }

        //para seleccionar un diseño y cargarlo en el formulario
        public function selectDiseño(int $idDiseño)
        {
            //Buscar diseño en la base de datos
            $this->intIdDiseño = $idDiseño;
            $sql ="SELECT *FROM diseño WHERE idDiseño = $this->intIdDiseño";
            $request = $this->select($sql);
            return $request;
        }

        //para insertar Diseños en la base de datos
        public function insertDiseño(string $nombre, string $descripción)
        {

            $return = "";
            $this->strNombre = $nombre;
            $this->strDescripción = $descripción;

            $sql = "SELECT * FROM diseño WHERE nombre = '{$this->strNombre}' ";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $query_insert  = "INSERT INTO diseño(nombre, descripción) VALUES(?,?)";
                $arrData = array($this->strNombre, $this->strDescripción);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
            }else{
                $return = "exist";
            }
            return $return;
        }

        //actualizar un dato en la tabla diseño
        public function updateDiseño(int $iddiseño, string $nombre, string $descripción)
        {
            $this->intIddiseño = $iddiseño;
            $this->strNombre = $nombre;
            $this->strDescripción = $descripción;

            $sql = "SELECT * FROM diseño WHERE nombre = '$this->strNombre' AND idDiseño != $this->intIddiseño";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $sql = "UPDATE diseño SET nombre = ?, descripción = ? WHERE idDiseño = $this->intIddiseño";
                $arrData = array($this->strNombre, $this->strDescripción);
                $request = $this->update($sql,$arrData);
            }else{
                $request = "exist";
            }
            return $request;            
        }

        //eliminar un diseño en la base de datos
        public function deleteDiseño(int $iddiseño)
        {
            $this->intIddiseño = $iddiseño;
            $sql = "SELECT * FROM productos WHERE idDiseño = $this->intIddiseño";
            $request = $this->select_all($sql);
            if(empty($request))
            {
                $sql = "UPDATE diseño SET status = ? WHERE idDiseño = $this->intIddiseño ";
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