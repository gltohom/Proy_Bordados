<?php
    class HilosModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }
        
        //para la funcion de seleccionar los roles
        public function selectHilos()
        {
            //para recuperar datos de la base de datos
            $sql = "SELECT h.idHilo, c.color, h.código, t.tipo, h.cantidad, h.descripción
            FROM hilos AS h
            INNER JOIN tipoHilos AS t
            INNER JOIN color AS c
            ON h.idcolor=c.idColor AND h.idTipoHilo = t.idTipoHilo";
            $request = $this->select_all($sql);
            return $request;
        }
    }
?>