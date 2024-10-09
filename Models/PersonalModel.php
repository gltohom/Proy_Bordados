<?php
    class PersonalModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }

        //para la funcion de seleccionar el personal desde la base de datos
        public function selectPersonal()
        {
            //para recuperar datos de la base de datos
            $sql = "SELECT p.idPersonal, p.nombre, p.apellido, p.dirección, p.teléfono, p.status
            FROM personal AS p
            WHERE status != 0";
            $request = $this->select_all($sql);
            return $request;

            /*$sql = "SELECT * FROM personal WHERE status != 0";
            $request = $this->select_all($sql);
            return $request;*/
        }

        //para seleccionar una persona y cargarlo en el formulario
        public function selectPersona(int $idPersonal)
        {
            //Buscar personal en la base de datos
            $this->intIdPersonal = $idPersonal;
            $sql ="SELECT *FROM personal WHERE idPersonal = $this->intIdPersonal";
            $request = $this->select($sql);
            return $request;
        }

        //para insertar personal en la base de datos
        public function insertPersona(string $nombre, string $apellido, string $dirección, int $teléfono)
        {

            $return = "";
            $this->strNombre = $nombre;
            $this->strApellido = $apellido;
            $this->strDirección = $dirección;
            $this->intTeléfono = $teléfono;

            $sql = "SELECT * FROM personal WHERE nombre = '{$this->strNombre}' AND apellido = '{$this->strApellido}'";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $query_insert  = "INSERT INTO personal(nombre, apellido, dirección, teléfono) VALUES(?,?,?,?)";
                $arrData = array($this->strNombre, $this->strApellido, $this->strDirección, $this->intTeléfono);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $request_insert;
            }else{
                $return = "exist";
            }
            return $return;
        }

        //actualizar un dato en la tabla Personal
        public function updatePersona(int $idpersonal, string $nombre, string $apellido, string $dirección, int $teléfono)
        {
            $this->intIdpersonal = $idpersonal;
            $this->strNombre = $nombre;
            $this->strApellido = $apellido;
            $this->strDirección = $dirección;
            $this->intTeléfono = $teléfono;

            $sql = "SELECT * FROM personal WHERE nombre = '$this->strNombre' AND idPersonal != $this->intIdpersonal";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                $sql = "UPDATE personal SET nombre = ?, apellido = ?, dirección = ?, teléfono = ? WHERE idPersonal = $this->intIdpersonal";
                $arrData = array($this->strNombre, $this->strApellido, $this->strDirección, $this->intTeléfono);
                $request = $this->update($sql,$arrData);
            }else{
                $request = "exist";
            }
            return $request;            
        }

        //eliminar un color en la base de datos
        public function deletePersona(int $idpersonal)
        {
            $this->intIdpersonal = $idpersonal;
            $sql = "SELECT * FROM usuario WHERE idPersonal = $this->intIdpersonal";
            $request = $this->select_all($sql);
            if(empty($request))
            {
                $sql = "UPDATE personal SET status = ? WHERE idPersonal = $this->intIdpersonal ";
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