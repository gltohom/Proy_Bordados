<?php
    class TelasModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        //para la funcion de seleccionar los colores desde la base de datos
        public function selectTelas()
        {
            //para recuperar datos de la base de datos
            $sql = "SELECT t.idTela, c.color, t.cantidad, t.descripción
            FROM telas AS t
            INNER JOIN color AS c
            ON t.idColor = c.idColor";
            $request = $this->select_all($sql);
            return $request;
        }
    }
?>