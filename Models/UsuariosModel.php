<?php
    class UsuariosModel extends Mysql
    {
        //propiedades
        private $intIdUsuario;
        private $strUsuario;
        private $strContraseña;
        private $intEstado;
        private $intIdRol;
        private $intIdPersonal;

        public function __construct()
        {
            parent::__construct();
        }
        
        //para la funcion de seleccionar los usuarios
        public function selectUsuarios()
        {
            //para la validación del super usuario
            $whereAdmin = "";
			if($_SESSION['idUsuarioSesión'] != 1 )
            {
				$whereAdmin = " AND u.idUsuario != 1 ";
			}

            //para recuperar datos de usuarios la base de datos
            $sql = "SELECT u.idUsuario, u.usuario, p.nombre, p.apellido, r.rol, u.estado
            FROM usuario AS u
            INNER JOIN personal AS p
            INNER JOIN rol AS r
            ON u.idRol = r.idRol AND u.idPersonal = p.idPersonal
            WHERE u.estado != 0".$whereAdmin;
            $request = $this->select_all($sql);
            return $request;
        }

        //para insertar un nuevo usuario
        public function insertUsuario(string $usuario, string $contraseña, int $estado, int $rol, int $personal)
        {
            $return = "";
            $this->strUsuario=$usuario;
            $this->strContraseña=$contraseña;
            $this->intEstado=$estado;
            $this->intIdRol=$rol;
            $this->intIdPersonal=$personal; 
            

            $sql = "SELECT * FROM usuario WHERE
            usuario = '{$this->strUsuario}'";
            $request =$this->select_all($sql);

            //insertar
            if (empty($request))
            {
                $query_insert = "INSERT INTO usuario(usuario, contra, estado, idRol, idPersonal) VALUES(?, ?, ?, ?, ?)";
                $arrData = array($this->strUsuario, $this->strContraseña, $this->intEstado, $this->intIdRol, $this->intIdPersonal);
                $request_insert = $this->insert($query_insert,$arrData);
                $return = $query_insert;
            }
            else
            {
                $return = "exist";
            }
            return $return;
        }

        //para ver un usuario en la tabla
        public function selectUsuarioTabla(int $idUsuario)
        {
            $this->intIdUsuario = $idUsuario;
            $sql = "SELECT p.nombre, p.apellido, u.usuario, p.dirección, p.teléfono, r.rol, u.estado, DATE_FORMAT(u.fechaRegistro, '%d-%m-%y') AS fechaRegistro
            FROM personal p
            INNER JOIN usuario AS u
            INNER JOIN rol AS r
            ON u.idRol = r.idRol AND u.idPersonal = p.idPersonal
            WHERE u.idUsuario = $this->intIdUsuario";

            $request = $this->select($sql);
            return $request;   
        }

        //para cargar un usuario a la tabla y cargarlo al formulario
        public function selectUsuario(int $idUsuario)
        {
            //Buscar color en la base de datos
            $this->intIdUsuario = $idUsuario;

           $sql ="SELECT u.usuario, u. usuario, u.estado, u.estado, u.idRol, u.idPersonal
            FROM usuario AS u
            WHERE idUsuario = $this->intIdUsuario";
            $request = $this->select($sql);
            return $request;
        }

        /*public function selectUsuario(int $idUsuario)
        {
            //Buscar rol en la base de datos
            $this->intIdUsuario = $idUsuario;
            $sql ="SELECT *FROM usuario WHERE idUsuario = $this->intIdUsuario";
            $request = $this->select($sql);
            return $request;
        }*/

        //para eliminar usuario
        public function deleteUsuario(int $idusuario)
        {
            $this->intIdusuario = $idusuario;
            
            $sql = "UPDATE usuario SET estado = ? WHERE idUsuario = $this->intIdusuario ";
            $arrData = array(0);
            $request = $this->update($sql,$arrData);
            return $request;
        }
    } 
?>