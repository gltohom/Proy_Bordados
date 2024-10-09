<?php
    class ColoresModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        //para la funcion de seleccionar los colores desde la base de datos
        public function selectColores()
        {
            //para recuperar datos de la base de datos
            $sql = "SELECT c.idColor, c.color, c.descripción
            FROM color AS c
            WHERE status > 0";
            $request = $this->select_all($sql);
            return $request;
        }

        //para seleccionar un color y cargarlo en el formulario
        public function selectColor(int $idColor)
        {
            //Buscar color en la base de datos
            $this->intIdColor = $idColor;
            $sql ="SELECT *FROM color WHERE idColor = $this->intIdColor";
            $request = $this->select($sql);
            return $request;
        }

        //para insertar Colores en la base de datos
        public function insertColor(string $color, string $descripción)
        {

            $return = "";
            $this->strColor = $color;
            $this->strDescripción = $descripción;

            $sql = "SELECT * FROM color WHERE color = '{$this->strColor}' ";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $query_insert  = "INSERT INTO color(color, descripción) VALUES(?,?)";
                $arrData = array($this->strColor, $this->strDescripción);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
            }else{
                $return = "exist";
            }
            return $return;
        }


        //actualizar un dato en la tabla color
        public function updateColor(int $idcolor, string $color, string $descripción)
        {
            $this->intIdcolor = $idcolor;
            $this->strColor = $color;
            $this->strDescripción = $descripción;

            $sql = "SELECT * FROM color WHERE color = '$this->strColor' AND idColor != $this->intIdcolor";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $sql = "UPDATE color SET color = ?, descripción = ? WHERE idColor = $this->intIdcolor";
                $arrData = array($this->strColor, $this->strDescripción);
                $request = $this->update($sql,$arrData);
            }else{
                $request = "exist";
            }
            return $request;            
        }

        //eliminar un color en la base de datos
        public function deleteColor(int $idcolor)
        {
            $this->intIdcolor = $idcolor;
            $sql = "SELECT * FROM hilos WHERE idColor = $this->intIdcolor";
            $request = $this->select_all($sql);
            if(empty($request))
            {
                $sql = "UPDATE color SET status = ? WHERE idColor = $this->intIdcolor ";
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