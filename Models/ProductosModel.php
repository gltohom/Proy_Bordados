<?php
    class ProductosModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }
        
        //para la funcion de seleccionar los roles
        public function selectProductos()
        {
            //para recuperar datos de la base de datos
            $sql = "SELECT p.idProducto, d.nombre, c.color, p.precio, p.cantidad, p.descripción
            FROM productos AS p
            INNER JOIN diseño AS d
            INNER JOIN color AS c
            ON p.idDiseño = d.idDiseño AND p.idColor = c.idColor";
            $request = $this->select_all($sql);
            return $request;
        }
    }
?>